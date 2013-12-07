<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Kke3a_model extends CI_Model
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
			/* if($file1 != '' && $file1 != '-1' && $file1 != null) {
						$this->db->where("kke.kode_e1",$file1);
			} */
			if($filsasaran != '' && $filsasaran != '-1' && $filsasaran != null) {
					$this->db->where("rkt.kode_sasaran_e1",$filsasaran);
			}
			if($filiku != '' && $filiku != '-1' && $filiku != null) {
					$this->db->where("rkt.kode_iku_e1",$filiku);
			}
			
			//$this->db->order_by($sort." ".$order );
			$this->db->order_by("rkt.kode_sasaran_e1,iku.kode_iku_e1,rkt.tahun");
			if ($purpose==1) $this->db->limit($limit,$offset);
			$this->db->select("rkt.kode_sasaran_e1,sasaran_strategis.deskripsi as sasaran_strategis, iku.deskripsi as indikator_kinerja,rkt.tahun,rkt.kode_iku_e1,lke.kke3a_e1_id,lke.renstra_ip,lke.renstra_ip_nilai, lke.rkt_ip,lke.rkt_ip_nilai, lke.pk_ip, lke.pk_ip_nilai, lke.iku_measurable,lke.iku_measurable_nilai, lke.iku_hasil, lke.iku_hasil_nilai,lke.iku_relevan, lke.iku_relevan_nilai,lke.iku_diukur, lke.iku_diukur_nilai,lke.kriteria_measurable, lke.kriteria_measurable_nilai,lke.kriteria_hasil, lke.kriteria_hasil_nilai, lke.kriteria_relevan, lke.kriteria_relevan_nilai, lke.kriteria_diukur, lke.kriteria_diukur_nilai, lke.pengukuran, lke.pengukuran_nilai",false);
			$this->db->from('tbl_rkt_eselon1 rkt inner join tbl_iku_eselon1 iku on iku.kode_iku_e1 = rkt.kode_iku_e1 and rkt.tahun = iku.tahun
inner join tbl_sasaran_eselon1 sasaran_strategis on sasaran_strategis.kode_sasaran_e1 = rkt.kode_sasaran_e1 and sasaran_strategis.tahun=rkt.tahun left join tbl_kke3a_e1 lke on rkt.kode_sasaran_e1=lke.kode_sasaran_e1 and rkt.tahun=lke.tahun and rkt.kode_iku_e1=lke.kode_iku_e1', false);
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
				
				$response->rows[$i]['kke3a_e1_id']=$row->kke3a_e1_id;
				$response->rows[$i]['kode_sasaran_e1']=$row->kode_sasaran_e1;
				$response->rows[$i]['tahun']=$row->tahun;
				$response->rows[$i]['kode_iku_e1']=$row->kode_iku_e1;
				
				$response->rows[$i]['renstra_ip']=$row->renstra_ip;
				$response->rows[$i]['renstra_ip_nilai']=$this->utility->cekNumericFmt($row->renstra_ip_nilai,2);
				$response->rows[$i]['rkt_ip']=$row->rkt_ip;
				$response->rows[$i]['rkt_ip_nilai']=$this->utility->cekNumericFmt($row->rkt_ip_nilai,2);
				$response->rows[$i]['pk_ip']=$row->pk_ip;
				$response->rows[$i]['pk_ip_nilai']=$this->utility->cekNumericFmt($row->pk_ip_nilai,2);
				$response->rows[$i]['iku_measurable']=$row->iku_measurable;				
				$response->rows[$i]['iku_measurable_nilai']=$this->utility->cekNumericFmt($row->iku_measurable_nilai,2);
				$response->rows[$i]['iku_hasil']=$row->iku_hasil;				
				$response->rows[$i]['iku_hasil_nilai']=$this->utility->cekNumericFmt($row->iku_hasil_nilai,2);
				$response->rows[$i]['iku_relevan']=$row->iku_relevan;				
				$response->rows[$i]['iku_relevan_nilai']=$this->utility->cekNumericFmt($row->iku_relevan_nilai,2);
				$response->rows[$i]['iku_diukur']=$row->iku_diukur;				
				$response->rows[$i]['iku_diukur_nilai']=$this->utility->cekNumericFmt($row->iku_diukur_nilai,2);				
				$response->rows[$i]['kriteria_measurable']=$row->kriteria_measurable;				
				$response->rows[$i]['kriteria_measurable_nilai']=$this->utility->cekNumericFmt($row->kriteria_measurable_nilai,2);
				$response->rows[$i]['kriteria_hasil']=$row->kriteria_hasil;				
				$response->rows[$i]['kriteria_hasil_nilai']=$this->utility->cekNumericFmt($row->kriteria_hasil_nilai,2);
				$response->rows[$i]['kriteria_relevan']=$row->kriteria_relevan;				
				$response->rows[$i]['kriteria_relevan_nilai']=$this->utility->cekNumericFmt($row->kriteria_relevan_nilai,2);
				$response->rows[$i]['kriteria_diukur']=$row->kriteria_diukur;				
				$response->rows[$i]['kriteria_diukur_nilai']=$this->utility->cekNumericFmt($row->kriteria_diukur_nilai,2);
				$response->rows[$i]['pengukuran']=$row->pengukuran;				
				$response->rows[$i]['pengukuran_nilai']=$this->utility->cekNumericFmt($row->pengukuran_nilai,2);
				
				//$this->getIndex('pk_ip',$row->tahun,$row->kode_sasaran_e1,$row->kode_iku_e1);//$this->utility->cekNumericFmt($row->target);
				
//utk kepentingan export excel ==========================
				//$row->program = $program[0].", ".$program[1];
			//============================================================
			//utk kepentingan export pdf===================
				$pdfdata[] = array($no,$response->rows[$i]['sasaran_strategis'],$response->rows[$i]['no_indikator'],$response->rows[$i]['indikator_kinerja'],$response->rows[$i]['pk_ip'],$response->rows[$i]['iku_measurable'],$response->rows[$i]['iku_hasil']);
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
				$response->rows[$count]['pk_ip']='';
				$response->rows[$count]['iku_measurable']='';
				$response->rows[$count]['iku_hasil']='';
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
	
		public function GetRecordCount($filtahun=null,$file1=null,$filsasaran=null,$filiku=null){
		if($filtahun != '' && $filtahun != '-1' && $filtahun != null) {
			$this->db->where("rkt.tahun",$filtahun);
		}		
		/* if($file1 != '' && $file1 != '-1' && $file1 != null) {
					$this->db->where("rkt.kode_e1",$file1);
		} */
		if($filsasaran != '' && $filsasaran != '-1' && $filsasaran != null) {
				$this->db->where("rkt.kode_sasaran_e1",$filsasaran);
		}
		if($filiku != '' && $filiku != '-1' && $filiku != null) {
				$this->db->where("rkt.kode_iku_e1",$filiku);
		}
		//$this->db->from('tbl_kke3a_e1');
		//$this->db->select("select sasaran.deskripsi as sasaran_srategis, iku.deskripsi as indikator_kinerja, rkt.target",false);
	//	$this->db->from('tbl_kke3a_e1 kke inner join tbl_iku_eselon1 iku on kke.kode_iku_e1 = iku.kode_iku_e1 and kke.tahun=iku.tahun inner join tbl_sasaran_eselon1 sasaran on sasaran.kode_sasaran_e1 = iku.kode_sasaran_e1 and sasaran.tahun=iku.tahun', false);
		$this->db->from('tbl_rkt_eselon1 rkt inner join tbl_iku_eselon1 iku on iku.kode_iku_e1 = rkt.kode_iku_e1 and rkt.tahun = iku.tahun
inner join tbl_sasaran_eselon1 sasaran on sasaran.kode_sasaran_e1 = rkt.kode_sasaran_e1 and sasaran.tahun=rkt.tahun left join tbl_kke3a_e1 lke on rkt.kode_sasaran_e1=lke.kode_sasaran_e1 and rkt.tahun=lke.tahun and rkt.kode_iku_e1=lke.kode_iku_e1', false);
		return $this->db->count_all_results();
		$this->db->free_result();
	}
	
	public function InsertOnDb($data,& $error) {
		//query insert data		
		$this->db->set('tahun',$data['tahun']);
		$this->db->set('kode_e1',$data['kode_e1']);
		$this->db->set('kode_sasaran_e1',$data['kode_sasaran_e1']);
		$this->db->set('kode_iku_e1',$data['kode_iku_e1']);
		
		$this->db->set('renstra_ip',$data['renstra_ip']);
		$this->db->set('renstra_ip_nilai',$data['renstra_ip_nilai']);
		$this->db->set('rkt_ip',$data['rkt_ip']);
		$this->db->set('rkt_ip_nilai',$data['rkt_ip_nilai']);
		$this->db->set('pk_ip',$data['pk_ip']);	
		$this->db->set('pk_ip_nilai',$data['pk_ip_nilai']);	
		$this->db->set('iku_measurable',$data['iku_measurable']);	
		$this->db->set('iku_measurable_nilai',$data['iku_measurable_nilai']);	
		$this->db->set('iku_hasil',$data['iku_hasil']);	
		$this->db->set('iku_hasil_nilai',$data['iku_hasil_nilai']);	
		$this->db->set('iku_relevan',$data['iku_relevan']);	
		$this->db->set('iku_relevan_nilai',$data['iku_relevan_nilai']);	
		$this->db->set('iku_diukur',$data['iku_diukur']);	
		$this->db->set('iku_diukur_nilai',$data['iku_diukur_nilai']);	
		
		$this->db->set('kriteria_measurable',$data['kriteria_measurable']);	
		$this->db->set('kriteria_measurable_nilai',$data['kriteria_measurable_nilai']);	
		$this->db->set('kriteria_hasil',$data['kriteria_hasil']);	
		$this->db->set('kriteria_hasil_nilai',$data['kriteria_hasil_nilai']);	
		$this->db->set('kriteria_relevan',$data['kriteria_relevan']);	
		$this->db->set('kriteria_relevan_nilai',$data['kriteria_relevan_nilai']);	
		$this->db->set('kriteria_diukur',$data['kriteria_diukur']);	
		$this->db->set('kriteria_diukur_nilai',$data['kriteria_diukur_nilai']);	
		$this->db->set('pengukuran',$data['pengukuran']);	
		$this->db->set('pengukuran_nilai',$data['pengukuran_nilai']);	
		
		$this->db->set('log_insert', 		$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
		
		$result = $this->db->insert('tbl_kke3a_e1');
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
		
		$this->db->where('kke3a_e1_id',$kode);
		
		$this->db->set('tahun',$data['tahun']);
		$this->db->set('kode_e1',$data['kode_e1']);
		$this->db->set('kode_sasaran_e1',$data['kode_sasaran_e1']);
		$this->db->set('kode_iku_e1',$data['kode_iku_e1']);
		
		$this->db->set('renstra_ip',$data['renstra_ip']);
		$this->db->set('renstra_ip_nilai',$data['renstra_ip_nilai']);
		$this->db->set('rkt_ip',$data['rkt_ip']);
		$this->db->set('rkt_ip_nilai',$data['rkt_ip_nilai']);
		$this->db->set('pk_ip',$data['pk_ip']);	
		$this->db->set('pk_ip_nilai',$data['pk_ip_nilai']);	
		$this->db->set('iku_measurable',$data['iku_measurable']);	
		$this->db->set('iku_measurable_nilai',$data['iku_measurable_nilai']);	
		$this->db->set('iku_hasil',$data['iku_hasil']);	
		$this->db->set('iku_hasil_nilai',$data['iku_hasil_nilai']);	
		$this->db->set('iku_relevan',$data['iku_relevan']);	
		$this->db->set('iku_relevan_nilai',$data['iku_relevan_nilai']);	
		$this->db->set('iku_diukur',$data['iku_diukur']);	
		$this->db->set('iku_diukur_nilai',$data['iku_diukur_nilai']);	
		
		$this->db->set('kriteria_measurable',$data['kriteria_measurable']);	
		$this->db->set('kriteria_measurable_nilai',$data['kriteria_measurable_nilai']);	
		$this->db->set('kriteria_hasil',$data['kriteria_hasil']);	
		$this->db->set('kriteria_hasil_nilai',$data['kriteria_hasil_nilai']);	
		$this->db->set('kriteria_relevan',$data['kriteria_relevan']);	
		$this->db->set('kriteria_relevan_nilai',$data['kriteria_relevan_nilai']);	
		$this->db->set('kriteria_diukur',$data['kriteria_diukur']);	
		$this->db->set('kriteria_diukur_nilai',$data['kriteria_diukur_nilai']);	
		$this->db->set('pengukuran',$data['pengukuran']);	
		$this->db->set('pengukuran_nilai',$data['pengukuran_nilai']);	
		$this->db->set('log_update', 		$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
		
		$result=$this->db->update('tbl_kke3a_e1');
		
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
		$this->db->from('tbl_kke3a_e1');
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
	
	
	

	
	public function getIndex($field,$tahun,$kode_sasaran,$kode_iku){
		$this->db->flush_cache();
		$this->db->select($field.' as index',false);
		$this->db->from('tbl_kke3a_e1');
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
