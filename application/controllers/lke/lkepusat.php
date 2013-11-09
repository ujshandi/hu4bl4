<?php

class Lkepusat extends CI_Controller {
	var $objectId = 'lkepusat';
	
	function __construct()
	{
		parent::__construct();			
		
		//$this->output->enable_profiler(true);
		
		//$userdata = array ('logged_in' => TRUE);
				//
		//$this->session->set_userdata($userdata);
				
		//if ($this->session->userdata('logged_in') != TRUE) redirect('security/login');					
		$this->load->model('/security/sys_menu_model');
		$this->load->model('/lke/lkepusat_model');
		$this->load->model('/rujukan/kl_model');
		$this->load->model('/pengaturan/sasaran_kl_model');
		$this->load->model('/rencana/rktkl_model');
		$this->load->library("utility");
		
	}
	
	function index(){
		$data['title'] = 'Kertas Kerja Evaluasi Akuntabilitas Kinerja Instansi Pemerintah Pusat';	
		$data['objectId'] = $this->objectId;
		$this->load->view('lke/lkepusats_v',$data);
	}
	
	public function add(){
		$data['title'] = 'Add Evaluasi Akuntabilitas';	
		$data['objectId'] = $this->objectId;		
	  	$this->load->view('lke/lkepusat_v',$data);
	}
	
	public function edit($id, $editmode='true'){
		$editmode = ($editmode=='true'?TRUE:FALSE);	
		$data['editmode'] = $editmode;
		$data['title'] = ($editmode==TRUE?'Edit':'View').' Penetapan Kinerja Kementerian';	
		$data['objectId'] = $this->objectId;
		$data['editMode'] = $editmode;
		
		$data['result'] = $this->lkepusat_model->getDataEdit($id);
		
	  	$this->load->view('lke/lkepusat_v_edit',$data);
	}
	
	function grid($filtahun=null){
		echo $this->lkepusat_model->easyGrid($filtahun);
	}
	
	function tree($filtahun=null){
		echo $this->lkepusat_model->loadTree(null);
	}
	
	
	private function get_form_values() {
		$dt['tahun'] = $this->input->post("tahun".$this->objectId, TRUE); 
		$dt['kode_kl'] = $this->input->post("kode_kl", TRUE); 
		$dt['kode_sasaran_kl'] = $this->input->post("kode_sasaran_kl", TRUE); 
		$dt['detail'] = $this->input->post("detail", TRUE); 
		
		return $dt;
    }
	
	function save(){
		$this->load->library('form_validation');
		$data = $this->get_form_values();
		$return_id = 0;
		$result = "";
		$data['pesan_error'] = '';
		$pesan = '';
		
		// validation
		# rules
		$this->form_validation->set_rules("tahun".$this->objectId, 'Tahun', 'trim|required|numeric|exact_length[4]|xss_clean');
		$this->form_validation->set_rules("kode_kl", 'Kementerian', 'trim|required|xss_clean');
		$this->form_validation->set_rules("kode_sasaran_kl", 'Sasaran Kementerian', 'trim|required|xss_clean');
		
		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');
		$this->form_validation->set_message('numeric', 'Isi field %s dengan angka');
		$this->form_validation->set_message('exact_length', 'Isi field %s dengan 4 karakter angka');
		
		if ($this->form_validation->run() == FALSE){ // jika tidak valid
			$data['pesan_error'].=(trim(form_error('tahun'.$this->objectId,' ',' '))==''?'':form_error('tahun'.$this->objectId,' ','<br>'));
			$data['pesan_error'].=(trim(form_error('kode_kl',' ',' '))==''?'':form_error('kode_kl',' ','<br>'));
			$data['pesan_error'].=(trim(form_error('kode_sasaran_kl',' ',' '))==''?'':form_error('kode_sasaran_kl',' ','<br>'));
			
		}else{
			// validasi detail
			if($this->check_detail($data, $pesan)){
				$result = $this->lkepusat_model->InsertOnDb($data);
			}else{
				$data['pesan_error'].= $pesan;
			}
		}
		
		if ($result){
			echo json_encode(array('success'=>true, 'status'=>$return_id));
		} else {
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}
	
	function check_detail($data, & $pesan){
		$i=1;
		foreach($data['detail'] as $r){
			if($r['penetapan'] == ''){ // nilai target null
				$pesan = 'Penetapan pada no. '.$i.' harus diisi.';
				return FALSE;
			}
			$i++;
		}
		
		return TRUE;
	}
	
	function save_edit(){
		$this->load->library('form_validation');
		$return_id = 0;
		$result = "";
		
		$data['id_pk_kl'] = $this->input->post('id_pk_kl');
		$data['penetapan'] = $this->input->post('penetapan');
		
		// validation
		
		$result = $this->lkepusat_model->UpdateOnDb($data);
		
		if ($result){
			echo json_encode(array('success'=>true, 'tindakan_rwj_id'=>$return_id));
		} else {
			echo json_encode(array('msg'=>'Some errors occured uy.', 'data'=> ''));
		}
	}
	
	function delete($id=''){
		if($id != ''){
			$result = $this->lkepusat_model->DeleteOnDb($id);
			if ($result){
				echo json_encode(array('success'=>true, 'haha'=>''));
			} else {
				echo json_encode(array('msg'=>'Some errors occured uy.', 'data'=> ''));
			}
		}
	}
	
	function griddetail($id_pk){
		echo $this->lkepusat_model->easyGridDetail($id_pk);
	}
	
	public function getDetail($tahun="", $kode_kl="", $kode_sasaran_kl=""){
		echo $this->lkepusat_model->getDetail($tahun, $kode_kl, $kode_sasaran_kl);
	}
	
}
?>
