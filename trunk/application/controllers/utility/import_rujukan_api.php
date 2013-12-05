<?php

class Import_rujukan_api extends CI_Controller {
	var $objectId="importRujukanApi";
	function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('logged_in') != TRUE) redirect('security/login');		
		$this->load->model('/security/sys_menu_model');		
		$this->load->model('/utility/import_model');		
		$this->load->library("utility");	
		$this->load->helper('form');
	}
	
	function index(){
		$data['title'] = 'Import Data Rujukan';	
		$data['objectId'] = $this->objectId;
		$this->load->view('utility/import_api_v',$data);
	}
	
	function loadMenu(){
		echo $this->sys_menu_model->loadMenu($this->session->userdata('app_type'),1);
	}
	
	function doImport($menuTitle){
		
		$data['objectId'] = $this->objectId;
		switch (urldecode($menuTitle)){
			case "Kementerian":$this->load->view('utility/import_kl_v',$data);break;			
			case "Eselon I":$this->load->view('utility/import_eselon1_v',$data);break;			
			case "Eselon II":$this->load->view('utility/import_eselon2_v',$data);break;
		}
		
	}
}
?>