<?php

class Lke_e1 extends CI_Controller {
	var $objectId = 'lke_e1';
	
	function __construct()
	{
		parent::__construct();			
		
		//$this->output->enable_profiler(true);
		
		//$userdata = array ('logged_in' => TRUE);
				//
		//$this->session->set_userdata($userdata);
				
		//if ($this->session->userdata('logged_in') != TRUE) redirect('security/login');					
		$this->load->model('/security/sys_menu_model');
		$this->load->model('/lke/lke_e1_model');
		$this->load->model('/lke/lke_konversi_model');
		$this->load->model('/rujukan/kl_model');
		$this->load->model('/rujukan/eselon1_model');
		$this->load->model('/pengaturan/sasaran_kl_model');
		$this->load->model('/rencana/rktkl_model');
		$this->load->library("utility");
		
	}
	
	function index(){
		$data['title'] = 'Kertas Kerja Evaluasi Akuntabilitas Kinerja Instansi Pemerintah Pusat';	
		$data['objectId'] = $this->objectId;
		$data['indexmutu'] = $this->lke_konversi_model->getListIndex($this->objectId,array('jenis_lke'=>'lke_pusat','unit_kerja'=>'e1'),true);
		$data['listIndex'] = $this->lke_konversi_model->getCountIndex(array('jenis_lke'=>'lke_pusat','unit_kerja'=>'e1'),true);
		$this->load->view('lke/lke_e1_v',$data);
	}
	
	public function loadtreeup($komponenId){
		$result = '';
		$this->lke_e1_model->loadTreeUp($komponenId,$result);
		echo $result;
	}
	
	public function add(){
		$data['title'] = 'Add Evaluasi Akuntabilitas';	
		$data['objectId'] = $this->objectId;		
		
	  	$this->load->view('lke/lke_e1_v',$data);
	}
	
	public function edit($id, $editmode='true'){
		$editmode = ($editmode=='true'?TRUE:FALSE);	
		$data['editmode'] = $editmode;
		$data['title'] = ($editmode==TRUE?'Edit':'View').' Penetapan Kinerja Kementerian';	
		$data['objectId'] = $this->objectId;
		$data['editMode'] = $editmode;
		
		$data['result'] = $this->lke_e1_model->getDataEdit($id);
		
	  	$this->load->view('lke/lke_e1_v_edit',$data);
	}
	
	function grid($filtahun=null){
		echo $this->lke_e1_model->easyGrid($filtahun);
	}
	
	function tree($filtahun=null,$file1=null){
		echo $this->lke_e1_model->loadTree($filtahun,$file1);
	}
	
	
	private function get_form_values() {
		$dt['tahun'] = $this->input->post("tahun", TRUE); 
		$dt['kode_e1'] = $this->input->post("kode_e1", TRUE); 
		$dt['lke_e1_id'] = $this->input->post("lke_e1_id", TRUE); 
		$dt['id_komponen'] = $this->input->post("id_komponen", TRUE); 
		$dt['index_mutu'] = $this->input->post("index_mutu", TRUE); 
		$dt['ref'] = $this->input->post("ref", TRUE); 
		
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
		$this->form_validation->set_rules("tahun", 'Tahun', 'trim|required|numeric|exact_length[4]|xss_clean');
		$this->form_validation->set_rules("id_komponen", 'Komponen/Subkomponen', 'trim|required|xss_clean');
		$this->form_validation->set_rules("kode_e1", 'Eselon I', 'trim|required|xss_clean');
		$this->form_validation->set_rules("index_mutu", 'Index Mutu', 'trim|required|xss_clean');
		
		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');
		$this->form_validation->set_message('numeric', 'Isi field %s dengan angka');
		$this->form_validation->set_message('exact_length', 'Isi field %s dengan 4 karakter angka');
		
		if ($this->form_validation->run() == FALSE){ // jika tidak valid
			$data['pesan_error'].=(trim(form_error('tahun',' ',' '))==''?'':form_error('tahun',' ','<br>'));
			$data['pesan_error'].=(trim(form_error('kode_e1',' ',' '))==''?'':form_error('kode_e1',' ','<br>'));
			$data['pesan_error'].=(trim(form_error('id_komponen',' ',' '))==''?'':form_error('id_komponen',' ','<br>'));
			$data['pesan_error'].=(trim(form_error('index_mutu',' ',' '))==''?'':form_error('index_mutu',' ','<br>'));
			
		}else{
			// validasi detail
				$data['nilai'] = $this->lke_konversi_model->getKonversi('lke_pusat',$data['index_mutu'],'e1');
				//if (!$this->lke_e1_model->isExistNilai($data['tahun'],$data['kode_e1'],$data['id_komponen'])){
				if ($data['lke_e1_id']==""){
					$result = $this->lke_e1_model->InsertOnDb($data,$data['pesan_error']);
				}
				else {
					//$data['pesan_error'] .= 'Komponen ini untuk tahun '.$data['tahun'].' sudah diinput.';
					$result = $this->lke_e1_model->UpdateOnDb($data,$data['lke_e1_id']);
				}
		}
		
		if ($result){
			echo json_encode(array('success'=>true, 'status'=>$return_id,'data'=>$data));
		} else {
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}
	
	
	
	function save_edit(){
		$this->load->library('form_validation');
		$return_id = 0;
		$result = "";
		
		$data['id_pk_kl'] = $this->input->post('id_pk_kl');
		$data['penetapan'] = $this->input->post('penetapan');
		
		// validation
		
		$result = $this->lke_e1_model->UpdateOnDb($data);
		
		if ($result){
			echo json_encode(array('success'=>true, 'tindakan_rwj_id'=>$return_id));
		} else {
			echo json_encode(array('msg'=>'Some errors occured uy.', 'data'=> ''));
		}
	}
	
	function delete($id=''){
		if($id != ''){
			$result = $this->lke_e1_model->DeleteOnDb($id);
			if ($result){
				echo json_encode(array('success'=>true, 'haha'=>''));
			} else {
				echo json_encode(array('msg'=>'Some errors occured uy.', 'data'=> ''));
			}
		}
	}
	
	function griddetail($id_pk){
		echo $this->lke_e1_model->easyGridDetail($id_pk);
	}
	
	public function getDetail($tahun="", $kode_kl="", $kode_sasaran_kl=""){
		echo $this->lke_e1_model->getDetail($tahun, $kode_kl, $kode_sasaran_kl);
	}
	
}
?>
