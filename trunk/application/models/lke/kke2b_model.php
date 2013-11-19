<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Kke2b_model extends CI_Model
{	
	/**
	* constructor
	*/
	public function __construct()
    {
        parent::__construct();
		//$this->CI =& get_instance();
    }
	// purpose : 1=buat grid, 2=buat pdf, 3=buat excel
	public function easyGrid($filtahun=null,$file1=null,$filsasaran=null,$filiku=null,$purpose=1,$pageNumber=null,$pageSize=null){
		$lastNo = isset($_POST['lastNo']) ? intval($_POST['lastNo']) : 0;  
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;  
		
		$count = $this->GetRecordCount($filtahun,$file1,$filsasaran,$filiku);
		$response = new stdClass();
		$response->total = $count;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'sasaran_strategis';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;  
		$pdfdata = array();
		if ($count>0){
			//filter
			if($filtahun != '' && $filtahun != '-1' && $filtahun != null) {
				$this->db->where("rkt.tahun",$filtahun);
			}		
			if($file1 != '' && $file1 != '-1' && $file1 != null) {
						$this->db->where("rkt.kode_e1",$file1);
			}
			if($filsasaran != '' && $filsasaran != '-1' && $filsasaran != null) {
					$this->db->where("rkt.kode_sasaran_e1",$filsasaran);
			}
			if($filiku != '' && $filiku != '-1' && $filiku != null) {
					$this->db->where("rkt.kode_iku_e1",$filiku);
			}
			
			//$this->db->order_by($sort." ".$order );
			$this->db->order_by("sasaran.kode_sasaran_e1,iku.kode_iku_e1,sasaran.tahun");
			if ($purpose==1) $this->db->limit($limit,$offset);
			$this->db->select("sasaran.deskripsi as sasaran_strategis, iku.deskripsi as indikator_kinerja",false);
			$this->db->from('tbl_iku_eselon1 iku inner join tbl_sasaran_eselon1 sasaran on sasaran.kode_sasaran_e1 = iku.kode_sasaran_e1 and sasaran.tahun=rkt.tahun', false);
			$query = $this->db->get();
			
			$i=0;
			$sasaran_strategis ="";
			$indikator_kinerja ="";
			$no =($page-1)*$limit;//$lastNo;
			$noIndikator =0;
			foreach ($query->result() as $row)
			{
				//$response->rows[$i]['id_rkt_kl']=$row->id_rkt_kl;
				if ($sasaran_strategis!=$row->sasaran_strategis){
					$no++;
					$noIndikator =0;
					$response->rows[$i]['no']= $no;
					
					$response->rows[$i]['sasaran_strategis']=$row->sasaran_strategis;
					$sasaran_strategis=$row->sasaran_strategis;
				}
				else{
					$response->rows[$i]['sasaran_strategis']=$row->sasaran_strategis;//"";
					$response->rows[$i]['no']= "";
				}
				
				if ($indikator_kinerja!=$row->indikator_kinerja){	
					$noIndikator++;
					$response->rows[$i]['no_indikator']= $no.".".$noIndikator;
					$response->rows[$i]['indikator_kinerja']=$row->indikator_kinerja;
					$indikator_kinerja=$row->indikator_kinerja;
				}else {	
					$response->rows[$i]['indikator_kinerja']="";
					$response->rows[$i]['no_indikator']="";
				}
				
				$response->rows[$i]['target_tercapai']=$this->getIndex('target_tercapai',$row->tahun,$row->kode_sasaran_e1,$row->kode_iku_e1);//$this->utility->cekNumericFmt($row->target);
				$response->rows[$i]['kinerja_baik']=$this->getIndex('kinerja_baik',$row->tahun,$row->kode_sasaran_e1,$row->kode_iku_e1);
				$response->rows[$i]['data_andal']=$this->getIndex('data_andal',$row->tahun,$row->kode_sasaran_e1,$row->kode_iku_e1);
//utk kepentingan export excel ==========================
				//$row->program = $program[0].", ".$program[1];
			//============================================================
			//utk kepentingan export pdf===================
				$pdfdata[] = array($no,$response->rows[$i]['sasaran_strategis'],$response->rows[$i]['no_indikator'],$response->rows[$i]['indikator_kinerja'],$response->rows[$i]['target_tercapai'],$response->rows[$i]['kinerja_baik'],$response->rows[$i]['data_andal']);
			//============================================================

				$i++;
			} 
			$response->lastNo = $no;
		//	$query->free_result();
		}else {
				//$response->rows[$count]['id_rkt_kl']=$row->id_rkt_kl;
				$response->rows[$count]['no']= "";
				$response->rows[$count]['no_indikator']= "";
				$response->rows[$count]['indikator_kinerja']='';
				$response->rows[$count]['sasaran_strategis']='';
				$response->rows[$count]['target_tercapai']='';
				$response->rows[$count]['kinerja_baik']='';
				$response->rows[$count]['data_andal']='';
				$response->rows[$count]['satuan']='';
				$response->rows[$count]['target']='';
				$response->lastNo = 0;
				
		}
		
		if ($purpose==1) //grid normal
			return json_encode($response);
		else if($purpose==2){//pdf
			return $pdfdata;
		}
		else if($purpose==3){//to excel
			//tambahkan header kolom
			$colHeaders = array("Sasaran Strategis","Deskripsi Indikator","Target Tercapai","Kinerja Terbaik","Data Andal");		
			to_excel($query,"KKE1-2-E1",$colHeaders);
		}
		
	}
	
	
	public function getListTahun($objectId){
		
		$this->db->flush_cache();
		$this->db->select('distinct tahun',false);
		$this->db->from('tbl_kke2b_e1');
		$e1 = $this->session->userdata('unit_kerja_e1');
		if (($e1!="-1")&&($e1!=null)){
			$this->db->where('kode_e1',$e1);
			//$value = $e1;
		}
		$this->db->order_by('tahun');
		
		$que = $this->db->get();
		
		$out = '<select name="filter_tahun'.$objectId.'" id="filter_tahun'.$objectId.'">';
		//$out .= '<option value="">Semua</option>';
		foreach($que->result() as $r){
			$out .= '<option value="'.$r->tahun.'">'.$r->tahun.'</option>';
		}
		
		$out .= '</select>';
		//chan
		if ($que->num_rows()==0){
			$out = "Data RKT belum tersedia.";
		}
		
		echo $out;
	}
	
	
	
	public function GetRecordCount($filtahun=null,$file1=null,$filsasaran=null,$filiku=null){
		if($filtahun != '' && $filtahun != '-1' && $filtahun != null) {
			$this->db->where("rkt.tahun",$filtahun);
		}		
		if($file1 != '' && $file1 != '-1' && $file1 != null) {
					$this->db->where("rkt.kode_e1",$file1);
		}
		if($filsasaran != '' && $filsasaran != '-1' && $filsasaran != null) {
				$this->db->where("rkt.kode_sasaran_e1",$filsasaran);
		}
		if($filiku != '' && $filiku != '-1' && $filiku != null) {
				$this->db->where("rkt.kode_iku_e1",$filiku);
		}
		//$this->db->from('tbl_kke2b_e1');
		//$this->db->select("select sasaran.deskripsi as sasaran_srategis, iku.deskripsi as indikator_kinerja, rkt.target",false);
			$this->db->from('tbl_iku_eselon1 iku left join tbl_sasaran_eselon1 sasaran on sasaran.kode_sasaran_e1 = iku.kode_sasaran_e1 and sasaran.tahun=iku.tahun', false);
		
		return $this->db->count_all_results();
		$this->db->free_result();
	}
	
	public function getIndex($field,$tahun,$kode_sasaran,$kode_iku){
		$this->db->flush_cache();
		$this->db->select($field.' as index',false);
		$this->db->from('tbl_kke2b_e1');
		$this->db->where('kode_iku_e1', $kode_iku);
		$this->db->where('kode_sasaran_e1', $kode_sasaran);
		$this->db->where('tahun', $tahun);
		$query = $this->db->get();
		if ($query->num_rows()>0)
			return $query->row()->index;
		else return 0;
		
	}
	
	public function getSatuan($id){
		$this->db->flush_cache();
		$this->db->select('satuan');
		$this->db->from('tbl_iku');
		$this->db->where('kode_iku_e1', $id);
		$query = $this->db->get();
		
		return $query->row()->satuan;
		
	}
	
}
?>
