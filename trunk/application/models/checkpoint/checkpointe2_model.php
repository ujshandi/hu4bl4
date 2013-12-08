<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/
  
class Checkpointe2_model extends CI_Model
{	
	/**
	* constructor
	*/
	public function __construct()
    {
        parent::__construct();
		//$this->CI =& get_instance();
    }
	
	public function easyGrid($filtahun=null,$file2=null){
		
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;  
		
		$count = $this->GetRecordCount($filtahun,$file2);
		$response = new stdClass();
		$response->total = $count;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tahun';  
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tbl_pk_eselon2.tahun';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';  
		$offset = ($page-1)*$limit;  
		
		if ($count>0){
			//filter
			if($filtahun != '' && $filtahun != '-1' && $filtahun != null) {
				$this->db->where("tbl_pk_eselon2.tahun",$filtahun);
			}	
			
			if($file2 != '' && $file2 != '-1' && $file2 != null) {
				$this->db->where("tbl_pk_eselon2.kode_e2",$file2);
			}
			
			$this->db->order_by($sort." ".$order );
			$this->db->limit($limit,$offset);
			$this->db->select("distinct tbl_pk_eselon2.*,tbl_ikk.deskripsi as deskripsi_iku_e2,tbl_ikk.satuan,tbl_sasaran_eselon2.deskripsi as deskripsi_sasaran_e2, tbl_eselon2.nama_e2",false);
			$this->db->from('tbl_pk_eselon2 ');
			$this->db->join('tbl_ikk','tbl_ikk.kode_ikk = tbl_pk_eselon2.kode_ikk and tbl_ikk.tahun = tbl_pk_eselon2.tahun');
			$this->db->join('tbl_sasaran_eselon2','tbl_sasaran_eselon2.kode_sasaran_e2 = tbl_pk_eselon2.kode_sasaran_e2');
			$this->db->join('tbl_eselon2', 'tbl_eselon2.kode_e2 = tbl_pk_eselon2.kode_e2');
			$this->db->order_by("tbl_pk_eselon2.tahun DESC, kode_sasaran_e2 ASC, tbl_pk_eselon2.kode_ikk ASC");
			$query = $this->db->get();
			
			$i=0;
			foreach ($query->result() as $row)
			{
				$response->rows[$i]['id_pk_e2']=$row->id_pk_e2;
				$response->rows[$i]['tahun']=$row->tahun;
				$response->rows[$i]['kode_e2']=$row->kode_e2;
				$response->rows[$i]['nama_e2']=$row->nama_e2;
				$response->rows[$i]['kode_sasaran_e2']=$row->kode_sasaran_e2;
				$response->rows[$i]['kode_ikk']=$row->kode_ikk;
				$response->rows[$i]['deskripsi_iku_e2']=$row->deskripsi_iku_e2;
				$response->rows[$i]['deskripsi_sasaran_e2']=$row->deskripsi_sasaran_e2;
/*
				if(is_numeric($row->target)){
					if(strpos($row->target, '.') || strpos($row->target, ',')){
						$response->rows[$i]['target'] = number_format($row->target, 4, ',', '.');
					}else{
						$response->rows[$i]['target'] = number_format($row->target, 0, ',', '.');
					}
				}else{
					$response->rows[$i]['target'] = $row->target;
				}
*/
				$response->rows[$i]['target']=$this->utility->cekNumericFmt($row->target);
/*
				if(is_numeric($row->penetapan)){
					if(strpos($row->penetapan, '.') || strpos($row->penetapan, ',')){
						$response->rows[$i]['penetapan'] = number_format($row->penetapan, 4, ',', '.');
					}else{
						$response->rows[$i]['penetapan'] = number_format($row->penetapan, 0, ',', '.');
					}
				}else{
					$response->rows[$i]['penetapan'] = $row->penetapan;
				}
*/
				$response->rows[$i]['penetapan']=$this->utility->cekNumericFmt($row->penetapan);
				$response->rows[$i]['satuan']=$row->satuan;
				$i++;
			} 
			$query->free_result();
		}else {
				$response->rows[$count]['id_pk_e2']='';
				$response->rows[$count]['tahun']='';
				$response->rows[$count]['kode_e2']='';
				$response->rows[$count]['kode_sasaran_e2']='';
				$response->rows[$count]['kode_ikk']='';
				$response->rows[$count]['target']='';
				$response->rows[$count]['satuan']='';
				$response->rows[$count]['penetapan']='';
				$response->rows[$count]['nama_e2']='';
				$response->rows[$count]['deskripsi_iku_e2']='';
				$response->rows[$count]['deskripsi_sasaran_e2']='';
		}
		
		return json_encode($response);
	}
	
	public function easyGridDetail($id_pk){
		
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;  
		
		//$count = $this->GetRecordCount($filtahun);
		$response = new stdClass();
	//	$response->total = $count;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'periode';  
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tbl_pk_eselon2.tahun';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';  
		$offset = ($page-1)*$limit;  
		$count = 0;
		//if ($count>0){
			//filter
			//if($filtahun != '' && $filtahun != '-1' && $filtahun != null) {
				$this->db->where("tbl_checkpoint_e2.id_pk_e2",$id_pk);
			//}	
			
			//$this->db->order_by($sort." ".$order );
		//	$this->db->limit($limit,$offset);
			$this->db->select("distinct tbl_checkpoint_e2.*",false);
			$this->db->from('tbl_checkpoint_e2 ');
			
			$this->db->order_by("tbl_checkpoint_e2.periode DESC");
			$query = $this->db->get();
			
			$i=0;
			foreach ($query->result() as $row)
			{
				$response->rows[$i]['id_pk_e2']=$row->id_pk_e2;
				$response->rows[$i]['id_checkpoint_e2']=$row->id_checkpoint_e2;
				$response->rows[$i]['unit_kerja']=$row->unit_kerja;
				$response->rows[$i]['keterangan']=$row->keterangan;
				$response->rows[$i]['periode']=$row->periode;
				$response->rows[$i]['kriteria']=$row->kriteria;
				$response->rows[$i]['ukuran']=$row->ukuran;
				$response->rows[$i]['target']=$this->utility->cekNumericFmt($row->target);
				$response->rows[$i]['capaian']=$this->utility->cekNumericFmt($row->capaian);
				


				$i++;
			} 
			$query->free_result();
		 if ($i==0) {
				$response->rows[$count]['id_pk_e2']='';
				$response->rows[$count]['id_checkpoint_e2']='';
				$response->rows[$count]['periode']='';
				$response->rows[$count]['kriteria']='';
				$response->rows[$count]['ukuran']='';
				$response->rows[$count]['target']='';
				$response->rows[$count]['capaian']='';
				$response->rows[$count]['keterangan']='';
				
		}
		
		return json_encode($response);
	}
	
	
	public function GetRecordCount($filtahun=null,$file2=null){
		if($filtahun != '' && $filtahun != '-1' && $filtahun != null) {
			$this->db->where("tbl_pk_eselon2.tahun",$filtahun);
		}
		if($file2 != '' && $file2 != '-1' && $file2 != null) {
				$this->db->where("tbl_pk_eselon2.kode_e2",$file2);
			}
		
		$this->db->select("distinct tbl_pk_eselon2.*,tbl_ikk.deskripsi as deskripsi_iku_e2,tbl_ikk.satuan,tbl_sasaran_eselon2.deskripsi as deskripsi_sasaran_e2, tbl_eselon2.nama_e2",false);
		$this->db->from('tbl_pk_eselon2 ');
		$this->db->join('tbl_ikk','tbl_ikk.kode_ikk = tbl_pk_eselon2.kode_ikk and tbl_ikk.tahun = tbl_pk_eselon2.tahun');
		$this->db->join('tbl_sasaran_eselon2','tbl_sasaran_eselon2.kode_sasaran_e2 = tbl_pk_eselon2.kode_sasaran_e2');
		$this->db->join('tbl_eselon2', 'tbl_eselon2.kode_e2 = tbl_pk_eselon2.kode_e2');
		
		return $this->db->count_all_results();
		$this->db->free_result();
	}
	
	public function isExist($id_pk_e2,$periode){	
		
			$this->db->where('id_pk_e2',$id_pk_e2); //buat validasi
		
			$this->db->where('periode',$periode); //buat validasi
			
		$this->db->select('*');
		$this->db->from('tbl_checkpoint_e2');
						
		$query = $this->db->get();
		$rs = $query->num_rows() ;		
		$query->free_result();
		return ($rs>0);
	}
	
	public function getDataEdit($id){
		$this->db->flush_cache();
		$this->db->select('tbl_pk_eselon2.*,tbl_checkpoint_e2.*,tbl_ikk.deskripsi as deskripsi_iku_e2,tbl_ikk.satuan,tbl_sasaran_eselon2.deskripsi as deskripsi_sasaran_e2, tbl_eselon2.nama_e2');
		$this->db->from('tbl_pk_eselon2 ');
			$this->db->join('tbl_ikk','tbl_ikk.kode_ikk = tbl_pk_eselon2.kode_ikk and tbl_ikk.tahun = tbl_pk_eselon2.tahun');
			$this->db->join('tbl_sasaran_eselon2','tbl_sasaran_eselon2.kode_sasaran_e2 = tbl_pk_eselon2.kode_sasaran_e2');
			$this->db->join('tbl_eselon2', 'tbl_eselon2.kode_e2 = tbl_pk_eselon2.kode_e2');
			$this->db->join('tbl_checkpoint_e2', 'tbl_checkpoint_e2.id_pk_e2 = tbl_pk_eselon2.id_pk_e2');
		$this->db->where('tbl_checkpoint_e2.id_checkpoint_e2', $id);
		return json_encode($this->db->get()->row());
	}
	
	public function InsertOnDB($data) {
		$this->db->trans_start();
		
		//foreach($data['detail'] as $dt){
			
			# jika id_pk_e2 != 0 maka update
/*
			if($dt['id_pk_e2'] != '0'){
				// update target penetapan di tabel PK
				$this->db->flush_cache();
				$this->db->set('penetapan', 	$dt['penetapan']);
				$this->db->set('log_update', 	$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
				$this->db->where('id_pk_e2', 	$dt['id_pk_e2']);
				$this->db->update('tbl_pk_eselon2');
				
			}else{
*/
				//query insert data ke checkpoint				$this->db->flush_cache();
				$this->db->set('id_pk_e2',$data['id_pk_e2']);
				$this->db->set('unit_kerja',$data['unit_kerja']);
				$this->db->set('periode',$data['periode']);
				$this->db->set('kriteria',$data['kriteria']);
				$this->db->set('ukuran',$data['ukuran']);
				$this->db->set('target',$data['target']);
				$this->db->set('keterangan',$data['keterangan']);
				
				if ($data['purpose']=='Capaian'){
					$this->db->set('capaian',$data['capaian']);
					$this->db->set('nama_folder_pendukung',$data['nama_folder_pendukung']);
				}
				$this->db->set('log_insert', 	$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
				$result = $this->db->insert('tbl_checkpoint_e2');
				
/*
				// update status tabel RKT
				$this->db->flush_cache();
				$this->db->set('status', '1');
				$this->db->where('tahun', $data['tahun']);
				$this->db->where('kode_e2', $data['kode_e2']);
				$this->db->where('kode_sasaran_e2', $data['kode_sasaran_e2']);
				$this->db->where('kode_ikk', $dt['kode_ikk']);
				$this->db->update('tbl_rkt_kl');
				
				# insert to log
				$this->db->flush_cache();
				$this->db->set('tahun',$data['tahun']);
				$this->db->set('kode_e2',$data['kode_e2']);
				$this->db->set('kode_sasaran_e2',$data['kode_sasaran_e2']);
				$this->db->set('kode_ikk',$dt['kode_ikk']);
				$this->db->set('target',$dt['target']);
				$this->db->set('penetapan',$dt['penetapan']);
				$this->db->set('status','0');
				$this->db->set('log',				'INSERT;'.$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
				$result = $this->db->insert('tbl_pk_eselon2_log');
*/
				
			//}
			
		//}
	
		$this->db->trans_complete();
			//print_r($this->db);die;
	    return $this->db->trans_status();
	}
	
	public function UpdateOnDb($data){
		$this->db->flush_cache();
		$this->db->where('id_checkpoint_e2', $data['id_checkpoint_e2']);
		
			//$this->db->set('id_pk_e2',$data['id_pk_e2']);
				$this->db->set('unit_kerja',$data['unit_kerja']);
				//if ($data['purpose']=='Rencana')
					//$this->db->set('periode',$data['periode']);  ga bisa edit
				$this->db->set('kriteria',$data['kriteria']);
				$this->db->set('ukuran',$data['ukuran']);
				$this->db->set('target',$data['target']);
				$this->db->set('keterangan',$data['keterangan']);
				
				if ($data['purpose']=='Capaian'){
					$this->db->set('capaian',$data['capaian']);
					$this->db->set('nama_folder_pendukung',$data['nama_folder_pendukung']);
				}
				$this->db->set('log_update', 	$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
			$result = $this->db->update('tbl_checkpoint_e2');	
		$errNo   = $this->db->_error_number();
	    $errMess = $this->db->_error_message();
		$error = $errMess;
		//var_dump($errMess);die;
	    log_message("error", "Problem Update to : ".$errMess." (".$errNo.")"); 
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}
	
	//hapus data
	public function DeleteOnDb($id){
	
			$this->db->flush_cache();
		$this->db->where('id_checkpoint_e2', $id);
		$result = $this->db->delete('tbl_checkpoint_e2');
		
		
		$errNo   = $this->db->_error_number();
	    $errMess = $this->db->_error_message();
		$error = $errMess;
		//var_dump($errMess);die;
	    log_message("error", "Problem Update to : ".$errMess." (".$errNo.")"); 
		//return
		
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}
	
	public function getListFilterTahun($objectId){
		
		$this->db->flush_cache();
		$this->db->select('distinct tahun',false);
		$this->db->from('tbl_pk_eselon2');
		
		$this->db->order_by('tahun');
		
		$que = $this->db->get();
		
		$out = '<select name="filter_tahun'.$objectId.'" id="filter_tahun'.$objectId.'">';
		$out .= '<option value="-1">Semua</option>';
		foreach($que->result() as $r){
			$out .= '<option value="'.$r->tahun.'">'.$r->tahun.'</option>';
		}
		
		$out .= '</select>';
		
		echo $out;
	}
	
	public function getListTahun($objectId=""){
		
		$this->db->flush_cache();
		$this->db->select('tahun');
		$this->db->from('tbl_pk_eselon2');
		$this->db->group_by('tahun');
		
		$que = $this->db->get();
		
		$out = '<select id="tahun'.$objectId.'" name="tahun'.$objectId.'" class="easyui-validatebox" required="true">';
		
		foreach($que->result() as $r){
			$out .= '<option value="'.$r->tahun.'">'.$r->tahun.'</option>';
		}
		$out .= '</select>';
		
		//chan
		if ($que->num_rows()==0){
			$out = "Data Program PK belum tersedia.";
		}
		
		
		echo $out;
	}
}
?>
