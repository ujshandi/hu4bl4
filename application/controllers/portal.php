<?php

class Portal extends CI_Controller {

	var $data;
	var $tahunDashboard = '2012';

	function __construct()
	{
		parent::__construct();	
		//if ($this->session->userdata('logged_in') != TRUE) redirect('security/login');		
		$this->load->helper('ckeditor');			
		$this->load->model('/security/sys_menu_model');		
		$this->load->model('portal_model');		
		$this->load->model('/dashboard/dsb_kl_model');
		$this->load->model('/dashboard/dsb_e1_model');
		$this->load->model('/rujukan/eselon1_model');
		$this->load->library("utility");
		$this->data = array(
				
			'title_page'=>'Sistem Aplikasi Pengukuran Kinerja Kementerian Perhubungan',
			'sess_fullname'=>$this->session->userdata('full_name'),
			'sess_apptype'=>$this->session->userdata('app_type'),
			'js'=>array('js/easyui/jquery-1.6.min.js','js/jquery-easyui-1.3.3/jquery.easyui.min.js','js/easyui/plugins/datagrid-detailview.js','js/uri_encode_decode.js','js/json2.js','js/jquery.autogrow.js','js/jquery.formatCurrency-1.4.0.min.js','js/formwizard.js','js/jquery.jqURL.js','js/ckeditor/ckeditor.js','js/portal/jquery.flexslider-min.js','js/portal/jquery.vticker.js'),
			'css'=>array('css/portal/style.css'),
			'links'=>$this->portal_model->getMuchContent(8)
		);
	}
	
	function index()
	{
		//$this->tahunDashboard = 
		if($this->portal_model->contentExist(2)){
			$this->data['latest_news']=$this->portal_model->getLastNews(3);
		}else{
			$this->data['latest_news'] = '';
		}
		
		$this->data['filterTahunDashboard'] = $this->tahunDashboard;
		$this->data['dataDashboadKl'] = $this->getDataDashboardKl();
		$this->data['listEselon1'] = $this->getDataE1();
		//var_dump($this->data['listEselon1']['data']);die;
		for ($i=0;$i<count($this->data['listEselon1']['data']);$i++){
			$this->data['listEselon1']['data'][$i]['detail'] = $this->getDataDashboardE1($this->data['listEselon1']['data'][$i][7]);
			$this->data['listEselon1']['pies'][$i] = $this->data['listEselon1']['pies'][$i];
			
		}
		$this->loadView('portal/home_vw',$this->data);
	}

	function page($page){
		switch ($page) {
			case 'about':
				if($this->portal_model->contentExist(3)){
					$this->data['about']=$this->portal_model->getSingleContent($this->portal_model->getContentID(3));
				}else{
					$this->data['about'] = '';
				}
				$this->loadView('portal/about_vw',$this->data);
				break;
			case 'akip':
				$this->load->library('pagination');

				$config['base_url'] = base_url().'portal/page/akip/';
				$config['total_rows'] = $this->portal_model->countContent(4);
				$config['per_page'] = 5; 
				$config['uri_segment'] = 4;

				$this->pagination->initialize($config); 

				$off = ($this->uri->segment(4)=='')?0:$this->uri->segment(4);
				$limit = 5;
				$offset = $off;
				if($this->portal_model->contentExist(4)){
					$this->data['akips']=$this->portal_model->getMuchContent(4,$limit,$offset);
				}else{
					$this->data['akips'] = '';
				}
				$this->loadView('portal/akip_vw',$this->data);
				break;
			case 'akip_det':
				$content_id = $this->uri->segment(4);
				if($this->portal_model->singleContentExist($content_id)){
					$this->data['akip']=$this->portal_model->getSingleContent($content_id);
				}else{
					$this->data['akip'] = '';
				}
				$this->loadView('portal/akip_detail_vw',$this->data);
				break;
			case 'regulasi':
				$this->load->library('pagination');

				$config['base_url'] = base_url().'portal/page/regulasi/';
				$config['total_rows'] = $this->portal_model->countContent(5);
				$config['per_page'] = 5; 
				$config['uri_segment'] = 4;

				$this->pagination->initialize($config); 

				$off = ($this->uri->segment(4)=='')?0:$this->uri->segment(4);
				$limit = 5;
				$this->data['offset'] = $off;
				if($this->portal_model->contentExist(5)){
					$this->data['regulasi']=$this->portal_model->getMuchContent(5,$limit,$off);
				}else{
					$this->data['regulasi'] = '';
				}
				$this->loadView('portal/regulasi_vw',$this->data);
				break;
			case 'contact':
				if($this->portal_model->contentExist(7)){
					$this->data['contact']=$this->portal_model->getSingleContent($this->portal_model->getContentID(7));
				}else{
					$this->data['contact'] = '';
				}
				$this->loadView('portal/contact_vw',$this->data);
				break;
			case 'news':
				$this->load->library('pagination');

				$config['base_url'] = base_url().'portal/page/news/';
				$config['total_rows'] = $this->portal_model->countContent(4);
				$config['per_page'] = 5; 
				$config['uri_segment'] = 4;

				$this->pagination->initialize($config); 

				$off = ($this->uri->segment(4)=='')?0:$this->uri->segment(4);
				$limit = 5;
				$offset = $off;
				if($this->portal_model->contentExist(2)){
					$this->data['newss']=$this->portal_model->getMuchContent(2,$limit,$offset);
				}else{
					$this->data['newss'] = '';
				}
				$this->loadView('portal/news_vw',$this->data);
			break;
			case 'news_det':
				$content_id = $this->uri->segment(4);
				//var_dump($content_id);die;
				if($this->portal_model->singleContentExist($content_id)){
					$this->data['news']=$this->portal_model->getSingleContent($content_id);
				}else{
					$this->data['news'] = '';
				}
				$this->loadView('portal/news_detail_vw',$this->data); 
				break;
			case 'faq':
				if($this->portal_model->contentExist(6)){
					$this->data['faqs']=$this->portal_model->getMuchContent(6);
				}else{
					$this->data['faqs'] = '';
				}
				$this->loadView('portal/faq_vw',$this->data);
				break;
			default:
				redirect('portal/index');
				break;
		}
	}

	function initCKEditor($id){
		return array(
		
			//ID of the textarea that will be replaced
			'id' 	=> 	$id,
			'path'	=>	'public/js/ckeditor',
		
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"100%",	//Setting a custom width
				'height' 	=> 	'100px',	//Setting a custom height
			   	'filebrowserBrowseUrl' => base_url().'/public/js/kcfinder/browse.php?type=files',
			   	'filebrowserImageBrowseUrl' => base_url().'/public/js/kcfinder/browse.php?type=images',
			   	'filebrowserFlashBrowseUrl' => base_url().'/public/js/kcfinder/browse.php?type=flash',
			   	'filebrowserUploadUrl' => base_url().'/public/js/kcfinder/upload.php?type=files',
			   	'filebrowserImageUploadUrl' => base_url().'/public/js/kcfinder/upload.php?type=images',
			   	'filebrowserFlashUploadUrl' => base_url().'/public/js/kcfinder/upload.php?type=flash'
			),
		
		);
	}

	function content($menu){
		switch ($menu) {
			case 1:
				$this->data['title'] = 'Beranda Portal';
				$this->data['objectId'] = 'portalhome';
				$this->data['ckeditor'] = $this->initCKEditor('content'.$this->data['objectId']);
				if($this->portal_model->contentExist(1)){
					$this->data['home'] = $this->portal_model->getSingleContent($this->portal_model->getContentID(1));
				}	
				else {
					$this->data['home'] = '';
				}
				$this->load->view('portal/backend/home_v',$this->data);
				break;
			case 2:
				$data['title'] = 'Berita Kinerja Kemenhub';
				$data['objectId'] = 'portalnews';
				$data['ckeditor1'] = $this->initCKEditor('content'.$data['objectId']);
				$data['ckeditor2'] = $this->initCKEditor('summary'.$data['objectId']);
				$this->load->view('portal/backend/news_v', $data);
				break;
			case 3:
				$data['title'] = 'Profil Portal';
				$data['objectId'] = 'portalabout';
				$data['ckeditor'] = $this->initCKEditor('content'.$data['objectId']);
				if($this->portal_model->contentExist(3)){
					$data['about'] = $this->portal_model->getSingleContent($this->portal_model->getContentID(3));
				}
				else{
					$data['about'] = '';
				}
				$this->load->view('portal/backend/about_v', $data);
				break;
			case 4:
				$data['title'] = 'AKIP Portal';
				$data['objectId'] = 'portalakip';
				$data['ckeditor1'] = $this->initCKEditor('content'.$data['objectId']);
				$data['ckeditor2'] = $this->initCKEditor('summary'.$data['objectId']);
				$this->load->view('portal/backend/akip_v', $data);
				break;
			case 5:
				$data['title'] = 'Regulasi Portal';
				$data['objectId'] = 'portalreg';
				$data['ckeditor'] = $this->initCKEditor('content'.$data['objectId']);
				$this->load->view('portal/backend/regulasi_v', $data);
				break;
			case 6:
				$data['title'] = 'FAQ Portal';
				$data['objectId'] = 'portalfaq';
				$data['ckeditor1'] = $this->initCKEditor('content'.$data['objectId']);
				$data['ckeditor2'] = $this->initCKEditor('summary'.$data['objectId']);
				$this->load->view('portal/backend/faq_v', $data);
				break;
			case 7:
				$data['title'] = 'Kontak Portal';
				$data['objectId'] = 'portalcontact';
				$data['ckeditor'] = $this->initCKEditor('content'.$data['objectId']);
				if($this->portal_model->contentExist(7)){
					$data['contact'] = $this->portal_model->getSingleContent($this->portal_model->getContentID(7));
				}
				else{
					$data['contact'] = '';
				}
				$this->load->view('portal/backend/kontak_v', $data);
				break;
			case 8:
				$data['title'] = 'Link Portal';
				$data['objectId'] = 'portallink';
				$this->load->view('portal/backend/link_v', $data);
				break;
			default:
				# code...
				break;
		}
	}
	
	// -------------- WHOLE NEWS FUNCTION --------------

	function grid($category_id=1){
		echo $this->portal_model->easyGrid($category_id);
	}

	function saveContent($category_id){
		$data = $this->getFormValues($category_id);
		if($this->portal_model->contentExist($category_id)){
			$this->save($category_id,'edit',$this->portal_model->getContentID($category_id),$data);
		}
		else{
			$this->save($category_id,'add','',$data);
		}
	}

	private function getFormValues($category_id=1) {
		// XXS Filtering enforced for user input
		$data['category_id'] = $category_id;
		//jika categori 1 - home
		if ($category_id==1)
			$data['content_title'] = $this->input->post("filter_tahunportalhome", TRUE);
		else	
			$data['content_title'] = $this->input->post("content_title", TRUE);
		$data['content'] = $this->input->post("content", TRUE); 
		$data['summary'] = $this->input->post("summary", TRUE);		
		$data['url'] = $this->input->post("url", TRUE);
		$data['date_post'] = null;
		$data['published'] = $this->input->post("published", TRUE);
		
		//$data["insert_log"] = $this->session->userdata("userLogin").",".$this->utility->getFullSystemDate();
		//$data["update_log"] = $this->session->userdata("userLogin").",".$this->utility->getFullSystemDate();
		return $data;
    }

    private function validateRules($category_id=1){
    	switch ($category_id) {	
			case 1:
				$this->form_validation->set_rules("filter_tahunportalhome", 'Filter Tahun Dashboard', 'trim|required|xss_clean');
				//$this->form_validation->set_rules("content_title", 'Judul Halaman', 'trim|required|xss_clean');
				//$this->form_validation->set_rules("content", 'Isi Halaman', 'trim|required|xss_clean');
				break;
			case 2:
				$this->form_validation->set_rules("content_title", 'Judul Berita', 'trim|required|xss_clean');
				$this->form_validation->set_rules("content", 'Isi Berita', 'trim|required|xss_clean');
				$this->form_validation->set_rules("summary", 'Ringkas Berita', 'trim|required|xss_clean');
				break;
			case 3:
				$this->form_validation->set_rules("content_title", 'Judul Profil', 'trim|required|xss_clean');
				$this->form_validation->set_rules("content", 'Isi Profil', 'trim|required|xss_clean');
				break;
			case 4:
				$this->form_validation->set_rules("content_title", 'Judul AKIP', 'trim|required|xss_clean');
				$this->form_validation->set_rules("content", 'Isi AKIP', 'trim|required|xss_clean');
				$this->form_validation->set_rules("summary", 'Ringkas AKIP', 'trim|required|xss_clean');
				break;
			case 5:
				$this->form_validation->set_rules("content_title", 'Nomor Regulasi', 'trim|required|xss_clean');
				$this->form_validation->set_rules("content", 'Deskripsi Regulasi', 'trim|required|xss_clean');
				//$this->form_validation->set_rules("url", 'Link Download', 'trim|required|xss_clean');
				break;
			case 6:
				$this->form_validation->set_rules("content_title", 'Judul FAQ', 'trim|required|xss_clean');
				$this->form_validation->set_rules("content", 'Pertanyaan', 'trim|required|xss_clean');
				$this->form_validation->set_rules("summary", 'Jawaban', 'trim|required|xss_clean');
				break;
			case 7:
				$this->form_validation->set_rules("content_title", 'Judul Halaman', 'trim|required|xss_clean');
				$this->form_validation->set_rules("content", 'Isi Halaman', 'trim|required|xss_clean');
				break;
			case 8:
				$this->form_validation->set_rules("content_title", 'Judul Tautan', 'trim|required|xss_clean');
				$this->form_validation->set_rules("url", 'Tautan', 'trim|required|xss_clean');
				break;
			default:
				# code...
				break;
    	}
    }

	function save($category_id=1, $aksi="", $kode="", $data=""){
		$this->load->library('form_validation');
		if($data==""){$data=$this->getFormValues($category_id);}
		$status = "";
		$result = false;
	    
		$data['pesan_error'] = '';
		
		# validasi rules
		$this->validateRules($category_id);

		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');
		
		if ($this->form_validation->run() == FALSE){
			//jika data tidak valid kembali ke view
			if ($category_id!=1){
				$data["pesan_error"].=(trim(form_error("content_title"," "," "))==""?"":form_error("content_title"," "," ")."<br>");
				$data["pesan_error"].=(trim(form_error("content"," "," "))==""?"":form_error("content"," "," ")."<br>");
				$data["pesan_error"].=(trim(form_error("summary"," "," "))==""?"":form_error("summary"," "," ")."<br>");
				$data["pesan_error"].=(trim(form_error("url"," "," "))==""?"":form_error("url"," "," ")."<br>");
			}
			else {
				$data["pesan_error"].=(trim(form_error("filter_tahunportalhome"," "," "))==""?"":form_error("filter_tahunportalhome"," "," ")."<br>");
			} 
			
			$status = $data["pesan_error"];
			
		}else {
			if($aksi=="add"){ // add
				$result = $this->portal_model->InsertOnDb($data,$status);
			}else { // edit
				$result = $this->portal_model->UpdateOnDb($data,$kode);
			}
			//$data['pesan_error'] .= $status;	
		}
		
		if ($result){
			echo json_encode(array('success'=>true, 'kode'=>$kode));
		} else {
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
		
	}
		
	function delete($category_id, $kode){
		# cek keberadaan di RKT
		// jika ada di RKT
		$result = $this->portal_model->DeleteOnDb($kode);
		if ($result){
			echo json_encode(array('success'=>true, 'haha'=>''));
		} else {
			echo json_encode(array('msg'=>'Some errors occured uy.', 'data'=> ''));
		}
		
	}
	
	function getLoginStatus(){
		echo $this->session->userdata('logged_in');
	}

	function loadView($view='', $data=''){
		$this->load->view('portal/top_vw',$data);
		$this->load->view($view,$data);
		$this->load->view('portal/bottom_vw',$data);
	}
	
	
	//buat dashboard
	function getDataDashboardKl(){
		
		return $this->dsb_kl_model->easyGrid($this->tahunDashboard,2);//purpose return array sama seperti utk pdf
	}
	
	function getDataE1(){
		
		return $this->dsb_e1_model->easyGridE1($this->tahunDashboard,2);//purpose return array sama seperti utk pdf
	}
	
	function getDataDashboardE1($e1){
		
		return $this->dsb_e1_model->easyGrid($this->tahunDashboard,$e1,2);//purpose return array sama seperti utk pdf
	}
	
}
?>
