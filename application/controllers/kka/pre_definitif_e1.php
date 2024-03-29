<?php

class Pre_definitif_e1 extends CI_Controller {
	
	var $objectId = 'predefinitife1';
	
	function __construct()
	{
		parent::__construct();			
		
		//$this->output->enable_profiler(true);
		
		//$userdata = array ('logged_in' => TRUE);
				//
		//$this->session->set_userdata($userdata);
				
		//if ($this->session->userdata('logged_in') != TRUE) redirect('security/login');					
		$this->load->model('/security/sys_menu_model');
		$this->load->model('/kka/pre_definitif_e1_model');
		
		$this->load->model('/rujukan/eselon1_model');
		$this->load->model('/rujukan/kegiatankl_model');
		$this->load->model('/pengaturan/sasaran_eselon1_model');
		$this->load->model('/pengaturan/iku_e1_model');
		$this->load->library("utility");
		
	}
	
	function index(){
		$data['title'] = 'Rencana Kinerja Tahunan Eselon I';	
		$data['objectId'] = $this->objectId;
		//$data['formLookupTarif'] = $this->tarif_model->lookup('#winLookTarif'.$data['objectId'],"#medrek_id".$data['objectId']);
	  	$this->load->view('kka/pre_definitif_e1s_v',$data);
	}
	
	public function add(){
		$data['title'] = 'Add Data Pra Monev Eselon I Pagu Usulan';	
		$data['objectId'] = $this->objectId;
		//$data['formLookupTarif'] = $this->tarif_model->lookup('#winLookTarif'.$data['objectId'],"#medrek_id".$data['objectId']);
	  	$this->load->view('kka/pre_usulan1_e1_v',$data);
	}
	
	public function edit($id, $editmode='true'){
		$editmode = ($editmode=='true'?TRUE:FALSE);	
		$data['editmode'] = $editmode;
		$data['title'] = ($editmode==TRUE?'Edit':'View').' Data Pra Monev Eselon I Pagu Usulan';
		$data['objectId'] = $this->objectId;
		
		$data['result'] = $this->pre_definitif_e1_model->getDataEdit($id);
		
	  	$this->load->view('kka/pre_usulan1_e1_v_edit',$data);
	}
	
	function grid($filtahun=null,$file1=null){
		if (($file1==null)&&($this->session->userdata('unit_kerja_e1'))!=-1)
			$file1= $this->session->userdata('unit_kerja_e1');
		echo $this->pre_definitif_e1_model->easyGrid($filtahun,$file1);
	}
	
	function gridMonev($filtahun=null,$kodekegiatan=null){
		
		echo $this->pre_definitif_e1_model->easySubGrid($filtahun,$kodekegiatan);
	}
	
	function gridKegiatan($filtahun=null,$file1=null,$file2=null){
		if (($file1==null)&&($this->session->userdata('unit_kerja_e1'))!=-1)
			$file1= $this->session->userdata('unit_kerja_e1');
		if (($file2==null)&&($this->session->userdata('unit_kerja_e2'))!=-1)
			$file2= $this->session->userdata('unit_kerja_e2');
		echo $this->kegiatankl_model->easyGrid($file1,$file2,$filtahun,1,'definitif');
	}
	
	
	private function get_form_values() {
		$dt['tahun'] = $this->input->post("tahun", TRUE); 
		if ($this->session->userdata('unit_kerja_e1')=='-1')
			$dt['kode_e1'] = $this->input->post("kode_e1", TRUE); //id
		else 
			$dt['kode_e1'] = $this->session->userdata('unit_kerja_e1');
		$dt['kode_sasaran_e1'] = $this->input->post("kode_sasaran_e1", TRUE); 
		$dt['kode_iku_e1'] = $this->input->post("kode_iku_e1", TRUE); 
		$dt['detail'] = $this->input->post("detail", TRUE); 
		
		return $dt;
    }
	
	//chan
	function getListSasaranE1($objectId,$kode="",$tahun=""){
		$data['tahun'] = $tahun;
		$data['kode'] = $kode;
		$data['deskripsi'] = ($kode=='')?'':$this->sasaran_eselon1_model->getDeskripsiSasaranE1($kode, $tahun);
		echo $this->sasaran_eselon1_model->getListSasaranE1($objectId, $kode, $data);
	}
	
	//chan
	function getListIkuE1($objectId,$kode="",$tahun=""){
		$data['tahun'] = $tahun;
		$data['kode'] = $kode;
	//	$data['deskripsi'] = ($kode=='')?'':$this->sasaran_eselon1_model->getDeskripsiSasaranE1($kode, $tahun);
		echo $this->iku_e1_model->getListIKU_E1($objectId, $kode, $tahun,'dropIku');
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
		$this->form_validation->set_rules("kode_e1", 'Eselon 1', 'trim|required|xss_clean');
		$this->form_validation->set_rules("kode_sasaran_e1", 'Sasaran Eselon 1', 'trim|required|xss_clean');
		$this->form_validation->set_rules("kode_iku_e1", 'IKU Eselon 1', 'trim|required|xss_clean');
		
		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');
		$this->form_validation->set_message('numeric', 'Isi field %s dengan angka');
		$this->form_validation->set_message('exact_length', 'Isi field %s dengan 4 karakter angka');
		
		if ($this->form_validation->run() == FALSE){ // jika tidak valid
			$data['pesan_error'].=(trim(form_error('tahun',' ',' '))==''?'':form_error('tahun',' ','<br>'));
			$data['pesan_error'].=(trim(form_error('kode_e1',' ',' '))==''?'':form_error('kode_e1',' ','<br>'));
			$data['pesan_error'].=(trim(form_error('kode_sasaran_e1',' ',' '))==''?'':form_error('kode_sasaran_e1',' ','<br>'));
			$data['pesan_error'].=(trim(form_error('kode_iku_e1',' ',' '))==''?'':form_error('kode_iku_e1',' ','<br>'));
			
		}else{
			// validasi detail
			$result =false;
			if ($data['kode_sasaran_e1']=='0') {
				$data['pesan_error'].= 'Data Sasaran belum dipilih!';
			} else if ($data['kode_iku_e1']=='0') {
				$data['pesan_error'].= 'Data IKU belum dipilih!';
			}
			else {
			
				if($this->check_detail($data, $pesan)){
					$result = $this->pre_definitif_e1_model->InsertOnDb($data);
				}else{
					$data['pesan_error'].= $pesan;
				}
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
		//var_dump($data['detail']);die;
		$terpilih = 0;
		foreach($data['detail'] as $r){
			
		    if(!isset($r['chk'])) continue;
			$terpilih++;
			if($r['kode_kegiatan'] == '0'){ // cek kode iku
				$pesan = 'Kode Kegiatan pada no. '.$i.' harus diisi.';
				return FALSE;
			}
			
			if($r['jumlah'] == ''){ // nilai target null
				$pesan = 'Jumlah pada no. '.$i.' harus diisi.';
				return FALSE;
			}
			
		/* 	// cek ke database
			if($this->pre_definitif_e1_model->data_exist($data['tahun'], $data['kode_e1'], $data['kode_sasaran_e1'], $r['kode_iku_e1'])){ 
				$pesan = 'Kode IKU pada no. '.$i.' sudah terdapat di dalam database.';
				//$pesan = 'Kode IKU '.$r['kode_iku_kl'].' sudah terdapat di database';
				return FALSE;
			} */
			
			$i++;
		}
		 if ($terpilih==0) {
			$pesan = 'Kegiatan belum ada yang dipilih!';
			return false;
		 }
		
		// cek kode iku di list (takut kalau ada yang sama ^-^)
		/* for($x=0, $n=count($data['detail'])-1; $x<$n; $x++){
			for($y=$x+1; $y<=$n; $y++){
				if($data['detail'][$x+1]['kode_iku_e1'] == $data['detail'][$y+1]['kode_iku_e1']){
					$pesan = 'Kode IKU pada list tidak tidak boleh sama <br> Kode yang sama terdapat pada baris '.($x+1).' dan '.($y+1);
					return FALSE;
				}
			}
		} */
		
		return TRUE;
	}
	
	function save_edit(){
		$this->load->library('form_validation');
		$return_id = 0;
		$result = "";
		$error = '';
		
		$data['id_rkt_e1'] 			= $this->input->post('id_rkt_e1');
		$data['tahun'] 				= $this->input->post('tahun');
		$data['kode_e1']			= $this->input->post('kode_e1');
		$data['kode_sasaran_e1'] 	= $this->input->post('kode_sasaran_e1');
		$data['kode_iku_e1'] 		= $this->input->post('kode_iku_e1');
		$data['old_kode_iku_e1'] 	= $this->input->post('old_kode_iku_e1');
		$data['target'] 			= $this->input->post('target');
		
		// validation
		if($data['target'] == '' || $data['target'] == null){
			$result = false;
			$error = 'Isi target dengan benar.';
		}else{
			if($data['old_kode_iku_e1'] != $data['kode_iku_e1']){ // jika ada perubahan kode iku
				if(!$this->pre_definitif_e1_model->data_exist($data['tahun'], $data['kode_e1'], $data['kode_sasaran_e1'], $data['kode_iku_e1'])){
					$result = $this->pre_definitif_e1_model->UpdateOnDb($data);
				}else{
					$result = false;
					$error = 'IKU sudah digunakan, ganti dengan yang lain';
				}
			}else{
				$result = $this->pre_definitif_e1_model->UpdateOnDb($data);
			}
		}
		
		if ($result){
			echo json_encode(array('success'=>true, 'target'=>$data['target']));
		} else {
			echo json_encode(array('msg'=>$error));
		}
	}
	
	function delete($id=''){
		if($id != ''){
			$result = $this->pre_definitif_e1_model->DeleteOnDb($id);
			if ($result){
				echo json_encode(array('success'=>true, 'haha'=>''));
			} else {
				echo json_encode(array('msg'=>'Some errors occured uy.', 'data'=> ''));
			}
		}
	}
	
	function getSatuan($id){
		if($id != '0'){
			echo $this->pre_definitif_e1_model->getSatuan($id);
		}
	}
	
	function getIKU_e1($kode, $tahun=""){
		if($kode != '0' && $tahun != ""){
			echo $this->pre_definitif_e1_model->getIKU_e1($this->objectId, $kode, $tahun);
		}
	}
	
	function getKegiatan_e1($kode, $tahun=""){
		if($kode != '0' && $tahun != ""){
			echo $this->pre_definitif_e1_model->getKegiatan_e1($this->objectId, $kode, $tahun);
		}
	}
	
	public function getDeskripsiSasaran($kode_sasaran_e1){
		$deskripsi = $this->sasaran_eselon2_model->getDeskripsiSasaran($kode_sasaran_e1);
		echo $deskripsi;
	}
	
	public function pdf($file1=null){
		$this->load->library('cezpdf');	
		$pdfdata = $this->pre_definitif_e1_model->easyGrid($file1,2);
		
		//$pdfdata = $pdfdata->rows;
		if (($file1 != null)&&($file1 != "-1"))
			$pdfhead = array('No.','Kode Sasaran','Indikator Kinerja Utama','Target','Satuan');
		else
			$pdfhead = array('No.','Kode Unit Kerja','Kode Sasaran','Indikator Kinerja Utama','Target','Satuan');
			
		$pdf = new $this->cezpdf($paper='A4',$orientation='potrait');
		$pdf->ezSetCmMargins(1,1,1,1);
		$pdf->selectFont( APPPATH."libraries/fonts/Helvetica.afm" );
	//	$pdf->ezText('Biroren Kemenhub',8,array('left'=>'1'));
	//	if (($filtahun != null)&&($filtahun != "-1"))
		$title = "Tingkat Eselon I";
		if (($file1 != null)&&($file1 != "-1"))
			$title=$this->eselon1_model->getNamaE1($file1);
		$pdf->ezText('Rencana Kerja Tahunan '.$title,16,array('left'=>'1'));
		$pdf->ezText('Tahun 2012',12,array('left'=>'1'));
		$pdf->ezText('');
		//halaman 
		$pdf->ezStartPageNumbers(550,10,12,'right','',1);
		
		
		if (($file1 != null)&&($file1 != "-1")){
			$cols = array(
				 0=>array('justification'=>'center','width'=>25),
				 1=>array('width'=>75),
				 2=>array('width'=>245),
				 3=>array('width'=>75),
				 4=>array('width'=>100));
		}
		else{
			$cols = array(
				 0=>array('justification'=>'center','width'=>25),
				 1=>array('width'=>75),
				 2=>array('width'=>75),
				 3=>array('width'=>170),
				 4=>array('width'=>75),
				 5=>array('width'=>100));
		}
		
		$options = array(
			'showLines' => 2,
			'showHeadings' => 1,
			'fontSize' => 8,
			'rowGap' => 1,
			'shaded' => 0,
			'colGap' => 5,
			'xPos' => 40,
			'xOrientation' => 'right',
				'cols'=>$cols,
			'width'=>'520'
		);
		$pdf->ezTable( $pdfdata, $pdfhead, NULL, $options );
		$opt['Content-Disposition'] = "RKTEselon1.pdf";
		$pdf->ezStream($opt);
	}
	
	public function excel($file1=null){
		echo  $this->pre_definitif_e1_model->easyGrid($file1,3);
	}
}
?>