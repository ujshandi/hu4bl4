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
				$this->db->where("sasaran.tahun",$filtahun);
			}		
			/* if($file1 != '' && $file1 != '-1' && $file1 != null) {
						$this->db->where("rkt.kode_e1",$file1);
			} */
			if($filsasaran != '' && $filsasaran != '-1' && $filsasaran != null) {
					$this->db->where("sasaran.kode_sasaran_e1",$filsasaran);
			}
			/* if($filiku != '' && $filiku != '-1' && $filiku != null) {
					$this->db->where("rkt.kode_iku_e1",$filiku);
			}
			 */
			//$this->db->order_by($sort." ".$order );
			$this->db->order_by("sasaran.kode_sasaran_e1,sasaran.tahun");
			if ($purpose==1) $this->db->limit($limit,$offset);
			$this->db->select("sasaran.deskripsi as sasaran_strategis,sasaran.tahun, sasaran.kode_sasaran_e1,lke.kke2b_e1_id,lke.renstra_a,lke.renstra_a_nilai,lke.rkt_a, lke.rkt_a_nilai, lke.pk_a, lke.pk_a_nilai,lke.renstra_b,lke.renstra_b_nilai,lke.rkt_b, lke.rkt_b_nilai, lke.pk_b, lke.pk_b_nilai",false);
			$this->db->from('tbl_sasaran_eselon1 sasaran left join tbl_kke2b_e1 lke on sasaran.kode_sasaran_e1 = lke.kode_sasaran_e1 and sasaran.tahun=lke.tahun', false);
			$query = $this->db->get();
			
			$i=0;
			$sasaran_strategis ="";
			$indikator_kinerja ="";
			$no =$lastNo;//($page-1)*$limit;//$lastNo;
			$noIndikator =0;
			foreach ($query->result() as $row)
			{
				$no++;
				$response->rows[$i]['no']= $no;
				$response->rows[$i]['sasaran_strategis']=$row->sasaran_strategis;
				$response->rows[$i]['kke2b_e1_id']=$row->kke2b_e1_id;
				$response->rows[$i]['tahun']=$row->tahun;
				$response->rows[$i]['kode_sasaran_e1']=$row->kode_sasaran_e1;
				$response->rows[$i]['renstra_a']=$row->renstra_a;
				$response->rows[$i]['renstra_a_nilai']=$this->utility->cekNumericFmt($row->renstra_a_nilai,2);
				$response->rows[$i]['renstra_b']=$row->renstra_b;
				$response->rows[$i]['renstra_b_nilai']=$this->utility->cekNumericFmt($row->renstra_b_nilai,2);
				$response->rows[$i]['rkt_a']=$row->rkt_a;
				$response->rows[$i]['rkt_a_nilai']=$this->utility->cekNumericFmt($row->rkt_a_nilai,2);
				$response->rows[$i]['rkt_b']=$row->rkt_b;
				$response->rows[$i]['rkt_b_nilai']=$this->utility->cekNumericFmt($row->rkt_b_nilai,2);
				$response->rows[$i]['pk_a']=$row->pk_a;
				$response->rows[$i]['pk_a_nilai']=$this->utility->cekNumericFmt($row->pk_a_nilai,2);
				$response->rows[$i]['pk_b']=$row->pk_b;
				$response->rows[$i]['pk_b_nilai']=$this->utility->cekNumericFmt($row->pk_b_nilai,2);
//utk kepentingan export excel ==========================
				//$row->program = $program[0].", ".$program[1];
			//============================================================
			//utk kepentingan export pdf===================
				$pdfdata[] = array($no,$response->rows[$i]['sasaran_strategis'],$response->rows[$i]['renstra_a'],$response->rows[$i]['renstra_a_nilai']);
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
				$response->rows[$count]['pk_a']='';
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
	
	public function InsertOnDb($data,& $error) {
		//query insert data		
		$this->db->set('tahun',$data['tahun']);
		$this->db->set('kode_sasaran_e1',$data['kode_sasaran_e1']);
		
		
		$this->db->set('renstra_a',$data['renstra_a']);
		$this->db->set('renstra_a_nilai',$data['renstra_a_nilai']);
		$this->db->set('rkt_a',$data['rkt_a']);
		$this->db->set('rkt_a_nilai',$data['rkt_a_nilai']);
		$this->db->set('pk_a',$data['pk_a']);	
		$this->db->set('pk_a_nilai',$data['pk_a_nilai']);			
		$this->db->set('renstra_b',$data['renstra_b']);
		$this->db->set('renstra_b_nilai',$data['renstra_b_nilai']);
		$this->db->set('rkt_b',$data['rkt_b']);
		$this->db->set('rkt_b_nilai',$data['rkt_b_nilai']);
		$this->db->set('pk_b',$data['pk_b']);	
		$this->db->set('pk_b_nilai',$data['pk_b_nilai']);	
		
		$this->db->set('log_insert', 		$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
		
		$result = $this->db->insert('tbl_kke2b_e1');
		$errNo   = $this->db->_error_number();
	    $errMess = $this->db->_error_message();
		$error = $errMess;
		//var_dump($errMess);die;
	    log_message("error", "Problem Inserting to : ".$errMess." (".$errNo.")"); 
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}

	//update data
	public function UpdateOnDb($data, $kode) {
		
		$this->db->where('kke2b_e1_id',$kode);
		
		$this->db->set('tahun',$data['tahun']);
		$this->db->set('kode_sasaran_e1',$data['kode_sasaran_e1']);		
		
		$this->db->set('renstra_a',$data['renstra_a']);
		$this->db->set('renstra_a_nilai',$data['renstra_a_nilai']);
		$this->db->set('rkt_a',$data['rkt_a']);
		$this->db->set('rkt_a_nilai',$data['rkt_a_nilai']);
		$this->db->set('pk_a',$data['pk_a']);	
		$this->db->set('pk_a_nilai',$data['pk_a_nilai']);	
		
		$this->db->set('renstra_b',$data['renstra_b']);
		$this->db->set('renstra_b_nilai',$data['renstra_b_nilai']);
		$this->db->set('rkt_b',$data['rkt_b']);
		$this->db->set('rkt_b_nilai',$data['rkt_b_nilai']);
		$this->db->set('pk_b',$data['pk_b']);	
		$this->db->set('pk_b_nilai',$data['pk_b_nilai']);	
		
		$this->db->set('log_update', 		$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
		
		$result=$this->db->update('tbl_kke2b_e1');
		
		$errNo   = $this->db->_error_number();
	    $errMess = $this->db->_error_message();
		//var_dump($errMess);die;
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
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
			$this->db->where("sasaran.tahun",$filtahun);
		}		
		if($file1 != '' && $file1 != '-1' && $file1 != null) {
					$this->db->where("sasaran.kode_e1",$file1);
		}
		if($filsasaran != '' && $filsasaran != '-1' && $filsasaran != null) {
				$this->db->where("sasaran.kode_sasaran_e1",$filsasaran);
		}
		if($filiku != '' && $filiku != '-1' && $filiku != null) {
				$this->db->where("sasaran.kode_iku_e1",$filiku);
		}
		//$this->db->from('tbl_kke2b_e1');
		//$this->db->select("select sasaran.deskripsi as sasaran_srategis, iku.deskripsi as indikator_kinerja, rkt.target",false);
			$this->db->from('tbl_sasaran_eselon1 sasaran left join tbl_kke2b_e1 lke on sasaran.kode_sasaran_e1 = lke.kode_sasaran_e1 and sasaran.tahun=lke.tahun', false);
		
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
