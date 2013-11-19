<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Lkepusat_model extends CI_Model
{	
	/**
	* constructor
	*/
	public function __construct()
    {
        parent::__construct();
		//$this->CI =& get_instance();
    }
	
	public function easyGrid($filtahun=null,$file1=null){
		
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;  
		
		$count = $this->GetRecordCount($filtahun,$file1);
	
		$response = new stdClass();
		$response->total = $count;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tahun';  
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tbl_lke_pusat.tahun';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';  
		$offset = ($page-1)*$limit;  
		
		if ($count>0){
			//filter
			if($filtahun != '' && $filtahun != '-1' && $filtahun != null) {
				$this->db->where("tbl_lke_pusat.tahun",$filtahun);
			}
			if($file1 != '' && $file1 != '-1' && $file1 != null) {
				$this->db->where("tbl_lke_pusat.kode_e1",$file1);
			}
			$this->db->order_by($sort." ".$order );
			$this->db->limit($limit,$offset);
			//$this->db->select("*, tbl_lke_pusat.kode_e1 as pk_kode_e1",false);
			$this->db->select("tbl_lke_pusat.*",false);
			$this->db->from('tbl_lke_pusat');			
			$query = $this->db->get();
			
			$i=0;
			foreach ($query->result() as $row)
			{
				$response->rows[$i]['lkepusat_id']=$row->lkepusat_id;
				$response->rows[$i]['tahun']=$row->tahun;				
				$response->rows[$i]['persen']=$this->utility->cekNumericFmt($row->persen);				
				$i++;
			} 
			
			$query->free_result();
		}else {
				$response->rows[$count]['lkepusat_id']='';
				$response->rows[$count]['tahun']='';
				$response->rows[$count]['persen']='';				
		}
		
		return json_encode($response);
		
	}
	
	public function getListTahun($objectId){
		
		$this->db->flush_cache();
		$this->db->select('distinct tahun',false);
		$this->db->from('tbl_lke_pusat');
		//$e2 = $this->session->userdata('unit_kerja_e2');
		/* if (($e2!="-1")&&($e2!=null)){
			$this->db->where('kode_e2',$e2);
			//$value = $e1;
		} */
		$this->db->order_by('tahun');		
		$que = $this->db->get();		
		$out = '<select name="filter_tahun'.$objectId.'" id="filter_tahun'.$objectId.'">';	
		foreach($que->result() as $r){
			$out .= '<option value="'.$r->tahun.'">'.$r->tahun.'</option>';
		}
				
		//chan
		if ($que->num_rows()==0){
			$out .= '<option value="'.date('Y').'">'.date('Y').'</option>';
		}		
		$out .= '</select>';		
		echo $out;
	}
	
	public function loadTree($parentId=null){
		$response = new stdClass();	
			/* if($file1 != '' && $file1 != '-1' && $file1 != null) {
				$this->db->where("tbl_lke_pusat.kode_e1",$file1);
			} */
			$id = isset($_POST['id']) ? intval($_POST['id']) : null;  
			$this->db->where("induk",$id);
			$this->db->order_by("komponen_id");
			//$this->db->limit($limit,$offset);
			//$this->db->select("*, tbl_lke_pusat.kode_e1 as pk_kode_e1",false);
			$this->db->select("tbl_lke_pusat.*,tbl_komponen_lke.nama_komponen,tbl_komponen_lke.id_komponen as komponen_id",false);
			$this->db->from('tbl_komponen_lke');			
			//$this->db->join('tbl_lke_pusat_detail',"tbl_komponen_lke.id_komponen=tbl_lke_pusat_detail.id_komponen","left");			
			$this->db->join('tbl_lke_pusat',"tbl_komponen_lke.id_komponen = tbl_lke_pusat.id_komponen","left");			
			$query = $this->db->get();
			$result = array();
			$i=0;
			foreach ($query->result() as $row)
			{
				$hasChild = $this->treeHasChild($row->komponen_id);
				$response->rows[$i]['id']=(int)$row->komponen_id;
				$response->rows[$i]['state']=$hasChild? 'closed' : 'open';
				$response->rows[$i]['lkepusat_id']=($row->lkepusat_id==null?"":$row->lkepusat_id);
				$response->rows[$i]['komponen_id']=($row->komponen_id==null?"":$row->komponen_id);
				$response->rows[$i]['tahun']=($row->tahun==null?"":$row->tahun);				
				$response->rows[$i]['nama_komponen']=$row->nama_komponen;				
				$response->rows[$i]['index_mutu']=$row->index_mutu;				
				$response->rows[$i]['ref']=$row->ref;				
				$response->rows[$i]['has_child']=$hasChild;				
				$response->rows[$i]['nilai']=$this->utility->cekNumericFmt(($row->nilai==null?"0":$row->nilai),2);				
				array_push($result,$response->rows[$i]);
				$i++;
			} 
			echo json_encode($result);
			//$query->free_result();
	}
	
	public function loadTreeUp($id=null,& $result="",$level=0){
	
			/* if($file1 != '' && $file1 != '-1' && $file1 != null) {
				$this->db->where("tbl_lke_pusat.kode_e1",$file1);
			} */
			//$id = isset($_POST['id']) ? intval($_POST['id']) : null;  
			$this->db->where("id_komponen",$id);
			$this->db->order_by("id_komponen");
			//$this->db->limit($limit,$offset);
			//$this->db->select("*, tbl_lke_pusat.kode_e1 as pk_kode_e1",false);
			$this->db->select("tbl_komponen_lke.*",false);
			$this->db->from('tbl_komponen_lke');			
			//$this->db->join('tbl_lke_pusat_detail',"tbl_komponen_lke.id_komponen=tbl_lke_pusat_detail.id_komponen","left");			
			//$this->db->join('tbl_lke_pusat',"tbl_lke_pusat.lkepusat_id=tbl_lke_pusat_detail.lkepusat_id","left");			
			$query = $this->db->get();
			
			$i=0;
			foreach ($query->result() as $row)
			{
				$hasParent = $this->treeHasParent($row->induk);
				$result = $row->nama_komponen."<br> >> ".$result;	
				$level++;
				if ($hasParent)	{
					
					$this->loadTreeUp($row->induk,$result,$level);
				}
				else {
					$result =substr($result,0,strlen($result)-3);
					return $result;
				}
				//$result .= $row->nama_komponen.">>".$result;
				
			} 
			//return ($result);
			//$query->free_result();
	}
	
	function getTab($level){
		$result ='';
		for ($i=0;$i<$level;$i++){
			$result .='&emsp;';
		}
		return $result;
	}
	
	public function InsertOnDb($data,& $error) {
		//query insert data		
		$this->db->set('lkepusat_id',$data['lkepusat_id']);
		$this->db->set('tahun',$data['tahun']);
		$this->db->set('id_komponen',$data['id_komponen']);
		$this->db->set('index_mutu',$data['index_mutu']);
		$this->db->set('nilai',$data['nilai']);	
		$this->db->set('ref',$data['ref']);	
		$this->db->set('log_insert', 		$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
		
		$result = $this->db->insert('tbl_lke_pusat');
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
		
		$this->db->where('lkepusat_id',$kode);
		
		$this->db->set('tahun',$data['tahun']);
		
		$this->db->set('id_komponen',$data['id_komponen']);
		$this->db->set('index_mutu',$data['index_mutu']);
		$this->db->set('nilai',$data['nilai']);	
		$this->db->set('ref',$data['ref']);	
		$this->db->set('log_update', 		$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
		
		$result=$this->db->update('tbl_lke_pusat');
		
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
	
	public function isExistNilai($tahun,$id_komponen){	
		//if ($kode!=null)//utk update
		$this->db->where('tahun',$tahun); //buat validasi
		$this->db->where('id_komponen',$id_komponen); //buat validasi
		
		$this->db->select('*');
		$this->db->from('tbl_lke_pusat');
						
		$query = $this->db->get();
		$rs = $query->num_rows() ;		
		$query->free_result();
		return ($rs>0);
	}
	
	private function treeHasChild($id){
		$this->db->from('tbl_komponen_lke');
		$this->db->where('induk',$id);
		//$this->db->join('tbl_lke_pusat_detail', 'tbl_lke_pusat_detail.kode_iku_e1 = tbl_lke_pusat.kode_iku_e1 and tbl_lke_pusat_detail.tahun = tbl_lke_pusat.tahun','left');
		//$this->db->join('tbl_sasaran_eselon1', 'tbl_sasaran_eselon1.kode_sasaran_e1 = tbl_lke_pusat.kode_sasaran_e1 and tbl_sasaran_eselon1.tahun = tbl_lke_pusat.tahun','left');
		return $this->db->count_all_results()>0;
	}
	
	private function treeHasParent($parentId){
		$this->db->from('tbl_komponen_lke');
		$this->db->where('id_komponen',$parentId);
		//$this->db->join('tbl_lke_pusat_detail', 'tbl_lke_pusat_detail.kode_iku_e1 = tbl_lke_pusat.kode_iku_e1 and tbl_lke_pusat_detail.tahun = tbl_lke_pusat.tahun','left');
		//$this->db->join('tbl_sasaran_eselon1', 'tbl_sasaran_eselon1.kode_sasaran_e1 = tbl_lke_pusat.kode_sasaran_e1 and tbl_sasaran_eselon1.tahun = tbl_lke_pusat.tahun','left');
		return $this->db->count_all_results()>0;
	}
	
	public function easyGridDetail($id_pk){
		
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;  
		
		//$count = $this->GetRecordCount($filtahun);
		$response = new stdClass();
	//	$response->total = $count;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'periode';  
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tbl_lke_pusat.tahun';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';  
		$offset = ($page-1)*$limit;  
		$count = 0;
		//if ($count>0){
			//filter
			
				$this->db->where("d.lkepusat_id",$id_pk);
			
			
			//$this->db->order_by($sort." ".$order );
		//	$this->db->limit($limit,$offset);
			$this->db->select("distinct d.*,k.nama_komponen",false);
			$this->db->from('tbl_lke_pusat_detail d');
			$this->db->join('tbl_komponen_lke k','d.id_komponen=k.id_komponen');
			
			$this->db->order_by("tbl_lke_pusat_detail.id_komponen");
			$query = $this->db->get();
			
			$i=0;
			foreach ($query->result() as $row)
			{
				$response->rows[$i]['lkepusat_id']=$row->lkepusat_id;				
				$response->rows[$i]['nama_komponen']=$row->nama_komponen;				
				$response->rows[$i]['persen']=$this->utility->cekNumericFmt($row->persen);
				$i++;
			} 
			$query->free_result();
		 if ($i==0) {
				$response->rows[$count]['lkepusat_id']='';
				$response->rows[$count]['nama_komponen']='';
				$response->rows[$count]['persen']='';
		}
		
		return json_encode($response);
	}
	
	public function GetRecordCount($filtahun=null,$file1){
		if($filtahun != '' && $filtahun != '-1' && $filtahun != null) {
			$this->db->where("tbl_lke_pusat.tahun",$filtahun);
		}	
		if($file1 != '' && $file1 != '-1' && $file1 != null) {
			$this->db->where("tbl_lke_pusat.kode_e1",$file1);
		}		
		
		$this->db->from('tbl_lke_pusat');
		//$this->db->join('tbl_lke_pusat_detail', 'tbl_lke_pusat_detail.kode_iku_e1 = tbl_lke_pusat.kode_iku_e1 and tbl_lke_pusat_detail.tahun = tbl_lke_pusat.tahun','left');
		//$this->db->join('tbl_sasaran_eselon1', 'tbl_sasaran_eselon1.kode_sasaran_e1 = tbl_lke_pusat.kode_sasaran_e1 and tbl_sasaran_eselon1.tahun = tbl_lke_pusat.tahun','left');
			
		
	
		return $this->db->count_all_results();
		$this->db->free_result();
	}
	
			
	
	//hapus data
	public function DeleteOnDb($id){
		
		# insert to log
		$this->db->flush_cache();
		$this->db->select("*");
		$this->db->from("tbl_lke_pusat");
		$this->db->where('lkepusat_id', $id);
		$qt = $this->db->get();
		
		$this->db->flush_cache();
		$this->db->set('tahun',				$qt->row()->tahun);
		$this->db->set('kode_e1',			$qt->row()->kode_e1);
		$this->db->set('kode_sasaran_e1',	$qt->row()->kode_sasaran_e1);
		$this->db->set('kode_iku_e1',		$qt->row()->kode_iku_e1);
		$this->db->set('persen',			$qt->row()->persen);
		$this->db->set('penetapan',			$qt->row()->penetapan);
		$this->db->set('log',				'DELETE;'.$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
		$result = $this->db->insert('tbl_lke_pusat_log');
		
		// update status tabel RKT
				$this->db->flush_cache();
				$this->db->set('status', '0');
				$this->db->where('tahun', $qt->row()->tahun);
				$this->db->where('kode_e1', $qt->row()->kode_e1);
				$this->db->where('kode_sasaran_e1', $qt->row()->kode_sasaran_e1);
				$this->db->where('kode_iku_e1', $qt->row()->kode_iku_e1);
				$this->db->update('tbl_rkt_eselon1');
				
		$this->db->flush_cache();
		$this->db->where('lkepusat_id', $id);
		$result = $this->db->delete('tbl_lke_pusat'); 
		
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
	
	public function getSatuan($id){
		$this->db->flush_cache();
		$this->db->select('satuan');
		$this->db->from('tbl_lke_pusat_detail');
		$this->db->where('kode_iku_e1', $id);
		$query = $this->db->get();
		
		return $query->row()->satuan;
		
	}
	
	
	
	
	
}
?>
