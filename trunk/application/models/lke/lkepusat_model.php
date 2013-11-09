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
			$this->db->select("tbl_lke_pusat.*,tbl_lke_pusat_detail.*,tbl_komponen_lke.nama_komponen,tbl_komponen_lke.id_komponen as komponen_id",false);
			$this->db->from('tbl_komponen_lke');			
			$this->db->join('tbl_lke_pusat_detail',"tbl_komponen_lke.id_komponen=tbl_lke_pusat_detail.id_komponen","left");			
			$this->db->join('tbl_lke_pusat',"tbl_lke_pusat.lkepusat_id=tbl_lke_pusat_detail.lkepusat_id","left");			
			$query = $this->db->get();
			$result = array();
			$i=0;
			foreach ($query->result() as $row)
			{
				$response->rows[$i]['id']=(int)$row->komponen_id;
				$response->rows[$i]['state']=$this->treeHasChild($row->komponen_id)? 'closed' : 'open';
				$response->rows[$i]['lkepusat_id']=($row->lkepusat_id==null?"":$row->lkepusat_id);
				$response->rows[$i]['komponen_id']=($row->komponen_id==null?"":$row->komponen_id);
				$response->rows[$i]['tahun']=($row->tahun==null?"":$row->tahun);				
				$response->rows[$i]['nama_komponen']=$row->nama_komponen;				
				$response->rows[$i]['persen']=$this->utility->cekNumericFmt(($row->persen==null?"0":$row->persen));				
				array_push($result,$response->rows[$i]);
				$i++;
			} 
			echo json_encode($result);
			//$query->free_result();
	}
	
	private function treeHasChild($id){
		$this->db->from('tbl_komponen_lke');
		$this->db->where('induk',$id);
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
			//if($filtahun != '' && $filtahun != '-1' && $filtahun != null) {
				$this->db->where("d.lkepusat_id",$id_pk);
			//}	
			
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
	
	public function getDataEdit($id){
		$this->db->flush_cache();
		$this->db->select('*, b.deskripsi as sasaran, c.deskripsi as iku_e1, d.nama_e1 as namae1');
		$this->db->from('tbl_lke_pusat a');
		$this->db->join('tbl_sasaran_eselon1 b', 'b.kode_sasaran_e1 = a.kode_sasaran_e1');
		$this->db->join('tbl_lke_pusat_detail c', 'c.kode_iku_e1 = a.kode_iku_e1 and c.tahun = a.tahun');
		$this->db->join('tbl_komponen_lke d', 'd.kode_e1 = a.kode_e1');
		$this->db->where('a.lkepusat_id', $id);
		
		return $this->db->get()->row();
	}

	public function getDetail($tahun, $kode_e1, $kode_sasaran_e1){
		$out = '';
		$i = 1;
		
		# header table
		$header = '	<tr>
						<th bgcolor="#F4F4F4" width="10px">No.</th>
						<th width="100%" bgcolor="#F4F4F4">Komponen/SubKomponen</th>
						<th bgcolor="#F4F4F4" width="100">persen (RKT)</th>						
						<th bgcolor="#F4F4F4">Satuan</th>
					</tr>';
		
		# Ambil Data dari PK
		# -------------------------------------------------------------------------------------
		$this->db->flush_cache();
		$this->db->select('*');
		$this->db->from('tbl_lke_pusat a');
		$this->db->join('tbl_lke_pusat_detail b','a.lkepusat_id = b.lkepusat_id');
		$this->db->join('tbl_komponen_lke','k.id_komponen = b.id_komponen');
		$this->db->where('a.tahun', $tahun);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$out .= '<tr>';
					$out .= '<td>'.$i.'<input type="hidden" name="detail['.$i.'][lkepusat_id]" value="'.$row->lkepusat_id.'"></td>';
					$out .= '<td>';
					//	$out .= '<input type="hidden" name="detail['.$i.'][kode_iku_e1]" value="'.$row->kode_iku_e1.'" >';
						$out .= $row->nama_komponen;
					$out .= '</td>';
				
					$out .= '<td>';
						$out .= '<input name="detail['.$i.'][persen]" value="'.$row->persen.'" readonly="readonly" size="15">';
					$out .= '</td>';			
					
					
				$out .= '</tr>';
				
				$i++;
			} // end foreach
		}
		
		# End Ambil Data dari PK
		# -------------------------------------------------------------------------------------
		
		
		# Ambil data dari RKT
	
		
		//chan 
		if ($out=="")
			return $out .= 'Data RKT Eselon 1 belum tersedia.';
		
		return $header.$out;
	}
		
	public function InsertOnDB($data) {
		$this->db->trans_start();
		
		foreach($data['detail'] as $dt){
			
			# jika lkepusat_id != 0 maka update
			if($dt['lkepusat_id'] != '0'){
				// update persen penetapan di tabel PK
				$this->db->flush_cache();
				$this->db->set('penetapan', $dt['penetapan']);
				$this->db->set('log_update', 	$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
				$this->db->where('lkepusat_id', $dt['lkepusat_id']);
				$this->db->update('tbl_lke_pusat');
				
			}else{
				//query insert data ke PK
				$this->db->flush_cache();
				$this->db->set('tahun',$data['tahun']);
				$this->db->set('kode_e1',$data['kode_e1']);
				$this->db->set('kode_sasaran_e1',$data['kode_sasaran_e1']);
				$this->db->set('kode_iku_e1',$dt['kode_iku_e1']);
				$this->db->set('persen',$dt['persen']);
				$this->db->set('penetapan',$dt['penetapan']);
				$this->db->set('status','0');
				$this->db->set('log_insert', 	$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
				$result = $this->db->insert('tbl_lke_pusat');
				
				// update status tabel RKT
				$this->db->flush_cache();
				$this->db->set('status', '1');
				$this->db->where('tahun', $data['tahun']);
				$this->db->where('kode_e1', $data['kode_e1']);
				$this->db->where('kode_sasaran_e1', $data['kode_sasaran_e1']);
				$this->db->where('kode_iku_e1', $dt['kode_iku_e1']);
				$this->db->update('tbl_rkt_eselon1');
				
				# insert to log
				$this->db->flush_cache();
				$this->db->set('tahun',$data['tahun']);
				$this->db->set('kode_e1',$data['kode_e1']);
				$this->db->set('kode_sasaran_e1',$data['kode_sasaran_e1']);
				$this->db->set('kode_iku_e1',$dt['kode_iku_e1']);
				$this->db->set('persen',$dt['persen']);
				$this->db->set('penetapan',$dt['penetapan']);
				$this->db->set('status','0');
				$this->db->set('log',				'INSERT;'.$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
				$result = $this->db->insert('tbl_lke_pusat_log');
				
			}
			
		}
		
		
		$this->db->trans_complete();
	    return $this->db->trans_status();
	}
	
	public function UpdateOnDb($data){
		$this->db->flush_cache();
		$this->db->where('lkepusat_id', $data['lkepusat_id']);
		$this->db->set('penetapan', $data['penetapan']);
		$result = $this->db->update('tbl_lke_pusat', $data); 
		
		# insert to log
		$this->db->flush_cache();
		$this->db->select("*");
		$this->db->from("tbl_lke_pusat");
		$this->db->where('lkepusat_id', $data['lkepusat_id']);
		$qt = $this->db->get();
		
		$this->db->flush_cache();
		$this->db->set('tahun',				$qt->row()->tahun);
		$this->db->set('kode_e1',			$qt->row()->kode_e1);
		$this->db->set('kode_sasaran_e1',	$qt->row()->kode_sasaran_e1);
		$this->db->set('kode_iku_e1',		$qt->row()->kode_iku_e1);
		$this->db->set('persen',			$qt->row()->persen);
		$this->db->set('penetapan',			$qt->row()->penetapan);
		$this->db->set('log',				'UPDATE;'.$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
		$result = $this->db->insert('tbl_lke_pusat_log');
		
		
		
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
	
	public function getListFilterTahun($objectId){
		
		$this->db->flush_cache();
		$this->db->select('distinct tahun',false);
		$this->db->from('tbl_lke_pusat');
		$e1 = $this->session->userdata('unit_kerja_e1');
		if (($e1!="-1")&&($e1!=null)){
			$this->db->where('kode_e1',$e1);
			//$value = $e1;
		}
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
	
	
	public function getListTahun($objectId=''){
		
		$this->db->flush_cache();
		$this->db->select('tahun');
		$this->db->from('tbl_lke_pusat');
		$e1 = $this->session->userdata('unit_kerja_e1');
		if (($e1!="-1")&&($e1!=null)){
			$this->db->where('kode_e1',$e1);
			//$value = $e1;
		}
		$this->db->group_by('tahun');
		
		$que = $this->db->get();
		
		$out = '<select id="tahun'.$objectId.'" name="tahun'.$objectId.'" class="easyui-validatebox" required="true">';
		
		foreach($que->result() as $r){
			$out .= '<option value="'.$r->tahun.'">'.$r->tahun.'</option>';
		}
		
		//chan
		if ($que->num_rows()==0){
			$out = "Data Program PK belum tersedia.";
		}
		
		$out .= '</select>';
		
		echo $out;
	}
}
?>
