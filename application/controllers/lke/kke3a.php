<?php

class kke3a extends CI_Controller {
	var $objectId = 'kke3a';
	function __construct()
	{
		parent::__construct();			

		//$userdata = array ('logged_in' => TRUE);
				//
		//$this->session->set_userdata($userdata);
				
		//if ($this->session->userdata('logged_in') != TRUE) redirect('security/login');					
		$this->load->model('/security/sys_menu_model');
		$this->load->model('/lke/kke3a_model');
		$this->load->model('/rujukan/eselon1_model');
		$this->load->model('/pengaturan/iku_e1_model');
		$this->load->model('/lke/lke_konversi_model');
		$this->load->library("utility");
		
	}
	
	function index(){
		$data['title'] = 'Kertas Kerja Evaluasi 3A IK';	
		$data['objectId'] = $this->objectId;
		
		$data['renstra_ip_radio'] = $this->lke_konversi_model->getListIndex($this->objectId,array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true,"renstra_ip");
		$data['rkt_ip_radio'] = $this->lke_konversi_model->getListIndex($this->objectId,array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true,"rkt_ip");
		$data['pk_ip_radio'] = $this->lke_konversi_model->getListIndex($this->objectId,array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true,"pk_ip");
		$data['iku_measurable_radio'] = $this->lke_konversi_model->getListIndex($this->objectId,array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true,"iku_measurable");
		$data['iku_hasil_radio'] = $this->lke_konversi_model->getListIndex($this->objectId,array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true,"iku_hasil");
		$data['iku_relevan_radio'] = $this->lke_konversi_model->getListIndex($this->objectId,array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true,"iku_relevan");
		$data['iku_diukur_radio'] = $this->lke_konversi_model->getListIndex($this->objectId,array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true,"iku_diukur");
		$data['kriteria_measurable_radio'] = $this->lke_konversi_model->getListIndex($this->objectId,array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true,"kriteria_measurable");
		$data['kriteria_hasil_radio'] = $this->lke_konversi_model->getListIndex($this->objectId,array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true,"kriteria_hasil");
		$data['kriteria_relevan_radio'] = $this->lke_konversi_model->getListIndex($this->objectId,array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true,"kriteria_relevan");
		$data['kriteria_diukur_radio'] = $this->lke_konversi_model->getListIndex($this->objectId,array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true,"kriteria_diukur");
		$data['pengukuran_radio'] = $this->lke_konversi_model->getListIndex($this->objectId,array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true,"pengukuran");
		
		$data['listIndex_renstra_ip'] = $this->lke_konversi_model->getCountIndex(array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true);
		$data['listIndex_rkt_ip'] = $this->lke_konversi_model->getCountIndex(array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true);
		$data['listIndex_pk_ip'] = $this->lke_konversi_model->getCountIndex(array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true);
		$data['listIndex_iku_measurable'] = $this->lke_konversi_model->getCountIndex(array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true);
		$data['listIndex_iku_hasil'] = $this->lke_konversi_model->getCountIndex(array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true);
		$data['listIndex_iku_relevan'] = $this->lke_konversi_model->getCountIndex(array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true);
		$data['listIndex_iku_diukur'] = $this->lke_konversi_model->getCountIndex(array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true);
		$data['listIndex_kriteria_measurable'] = $this->lke_konversi_model->getCountIndex(array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true);
		$data['listIndex_kriteria_hasil'] = $this->lke_konversi_model->getCountIndex(array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true);
		$data['listIndex_kriteria_relevan'] = $this->lke_konversi_model->getCountIndex(array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true);
		$data['listIndex_kriteria_diukur'] = $this->lke_konversi_model->getCountIndex(array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true);
		$data['listIndex_pengukuran'] = $this->lke_konversi_model->getCountIndex(array('jenis_lke'=>'kke3a','unit_kerja'=>'e1'),true);
	  	$this->load->view('lke/kke3a_v',$data);
	}
	
	private function get_form_values() {
		$dt['tahun'] = $this->input->post("tahun", TRUE); 
		$dt['kke3a_e1_id'] = $this->input->post("kke3a_e1_id", TRUE); 
		$dt['kode_e1'] = $this->input->post("kode_e1", TRUE); 
		$dt['kode_sasaran_e1'] = $this->input->post("kode_sasaran_e1", TRUE); 
		$dt['kode_iku_e1'] = $this->input->post("kode_iku_e1", TRUE); 
		$dt['renstra_ip'] = $this->input->post("renstra_ip", TRUE); 
		$dt['renstra_ip_nilai'] = $this->lke_konversi_model->getKonversi('kke3a',$dt['renstra_ip'],'e1');
		$dt['rkt_ip'] = $this->input->post("rkt_ip", TRUE); 
		$dt['rkt_ip_nilai'] = $this->lke_konversi_model->getKonversi('kke3a',$dt['rkt_ip'],'e1');
		$dt['pk_ip'] = $this->input->post("pk_ip", TRUE); 
		$dt['pk_ip_nilai'] = $this->lke_konversi_model->getKonversi('kke3a',$dt['pk_ip'],'e1');
		$dt['iku_measurable'] = $this->input->post("iku_measurable", TRUE); 
		$dt['iku_measurable_nilai'] = $this->lke_konversi_model->getKonversi('kke3a',$dt['iku_measurable'],'e1');
		$dt['iku_hasil'] = $this->input->post("iku_hasil", TRUE); 
		$dt['iku_hasil_nilai'] = $this->lke_konversi_model->getKonversi('kke3a',$dt['iku_hasil'],'e1');
		$dt['iku_relevan'] = $this->input->post("iku_relevan", TRUE); 
		$dt['iku_relevan_nilai'] = $this->lke_konversi_model->getKonversi('kke3a',$dt['iku_relevan'],'e1');
		$dt['iku_diukur'] = $this->input->post("iku_diukur", TRUE); 
		$dt['iku_diukur_nilai'] = $this->lke_konversi_model->getKonversi('kke3a',$dt['iku_diukur'],'e1');
		$dt['kriteria_measurable'] = $this->input->post("kriteria_measurable", TRUE); 
		$dt['kriteria_measurable_nilai'] = $this->lke_konversi_model->getKonversi('kke3a',$dt['kriteria_measurable'],'e1');
		$dt['kriteria_hasil'] = $this->input->post("kriteria_hasil", TRUE); 
		$dt['kriteria_hasil_nilai'] = $this->lke_konversi_model->getKonversi('kke3a',$dt['kriteria_hasil'],'e1');
		$dt['kriteria_relevan'] = $this->input->post("kriteria_relevan", TRUE); 
		$dt['kriteria_relevan_nilai'] = $this->lke_konversi_model->getKonversi('kke3a',$dt['kriteria_relevan'],'e1');
		$dt['kriteria_diukur'] = $this->input->post("kriteria_diukur", TRUE); 
		$dt['kriteria_diukur_nilai'] = $this->lke_konversi_model->getKonversi('kke3a',$dt['kriteria_diukur'],'e1');
		$pengukuran = 'T';
		$nilaipengukuran = $dt['kriteria_measurable_nilai']+$dt['kriteria_hasil_nilai']+$dt['kriteria_relevan_nilai']+$dt['kriteria_diukur_nilai'];
		if ($nilaipengukuran==4) $pengukuran = 'Y';
		
		$dt['pengukuran'] = $pengukuran; 
		$dt['pengukuran_nilai'] = $this->lke_konversi_model->getKonversi('kke3a',$dt['pengukuran'],'e1');
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
		$this->form_validation->set_rules("kode_e1", 'Unit Kerja Eselon I', 'trim|required|xss_clean');
	//	$this->form_validation->set_rules("index_mutu", 'Index Mutu', 'trim|required|xss_clean');
		
		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');
		$this->form_validation->set_message('numeric', 'Isi field %s dengan angka');
		$this->form_validation->set_message('exact_length', 'Isi field %s dengan 4 karakter angka');
		
		if ($this->form_validation->run() == FALSE){ // jika tidak valid
			$data['pesan_error'].=(trim(form_error('tahun',' ',' '))==''?'':form_error('tahun',' ','<br>'));
			$data['pesan_error'].=(trim(form_error('kode_e1',' ',' '))==''?'':form_error('kode_e1',' ','<br>'));
			//$data['pesan_error'].=(trim(form_error('index_mutu',' ',' '))==''?'':form_error('index_mutu',' ','<br>'));
			
		}else{
			// validasi detail
				
			
				if ($data['kke3a_e1_id']==''){	
					$result = $this->kke3a_model->InsertOnDb($data,$data['pesan_error']);
				}
				else {
					$result = $this->kke3a_model->UpdateOnDb($data,$data['kke3a_e1_id']);
				}
				
					//$data['pesan_error'] .= 'Komponen ini untuk tahun '.$data['tahun'].' sudah diinput.';
		}
		
		if ($result){
			echo json_encode(array('success'=>true, 'status'=>$return_id));
		} else {
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}
	
	
	function grid($filtahun=null,$file1=null,$filsasaran=null,$filiku=null){
		if ($file1==null)
			$file1 = $this->session->userdata('unit_kerja_e1');
		echo $this->kke3a_model->easyGrid($filtahun,$file1,$filsasaran,$filiku);
	}
	
	public function excel($filtahun=null,$file1=null,$filsasaran=null,$filiku=null,$page=null,$rows=null){
		echo  $this->kke3a_model->easyGrid($filtahun,$file1,$filsasaran,$filiku,3,$page,$rows);
	}
	
	public function pdf($filtahun=null,$file1=null,$filsasaran=null,$filiku=null,$page=null,$rows=null){
		$this->load->library('our_pdf','our_pdf');
		$this->our_pdf->FPDF('L', 'mm', 'A4');             
		$pdfdata = $this->kke3a_model->easyGrid($filtahun,$file1,$filsasaran,$filiku,2,$page,$rows);
		define('FPDF_FONTPATH',APPPATH."libraries/fpdf/font/");
		$this->our_pdf->Open();
		$this->our_pdf->addPage();
	//	$this->our_pdf->setAutoPageBreak(true,10);
		//var_dump($_REQUEST['page']);
		
		//========= setting judul ============
		
		$this->our_pdf->setFont('arial','',12);
		//$this->fpdf->setXY(100,350);
		//$this->fpdf->SetY(5);
		//$this->fpdf->Line(10, 5, 280, 5);
		$posY = 11;
		$posX = 10;
		$e1='';
		if (($file1 != null)&&($file1 != "-1"))
			$e1=$this->eselon1_model->getNamaE1($file1);
		 $this->our_pdf->text($posX,$posY,'Rencana Kinerja '.($e1!=""?$e1:"Eselon I "));
		//$this->fpdf->Line(10, 12, 280, 12);
		if (($filtahun != null)&&($filtahun != "-1")){
			$posY += 5;
			$this->our_pdf->setXY($posX,$posY);
			$this->our_pdf->text($posX,$posY,'Tahun '.$filtahun);
		}
		
					
		$this->our_pdf->setFont('Arial','B',8);
		 $posY += 6;
		$this->our_pdf->setXY($posX,$posY);
		$this->our_pdf->setFillColor(255,255,255);
		$this->our_pdf->CELL(8,12,'No',1,0,'C',1);
		$this->our_pdf->CELL(100,12,'Sasaran Strategis',1,0,'C',1);

		$this->our_pdf->CELL(110,6,'Indikator Kinerja',1,0,'C',1);
		$this->our_pdf->CELL(30,12,'Satuan',1,0,'C',1);
		$this->our_pdf->CELL(25,12,'Target',1,0,'C',1);
		
		
		
		
		$posY += 6;
		$posX += 108;
		$this->our_pdf->setXY($posX,$posY);
		$this->our_pdf->CELL(8,6,'No',1,0,'C',1);
		$posX += 8;
		$this->our_pdf->setXY($posX,$posY);
		$this->our_pdf->CELL(102,6,'Deskripsi',1,0,'C',1);
		
	
		
			
		//$yi = 18;
		$posY = 34;//44;
		$posX = 10;
		$row = 0;
		
		//$posY = $yi + $row;
		$max = 31;
		$row = 6; 

		
		//================ setting isi ===========
		
	//	 $this->our_pdf->SetWidths(array(8,90,8,82,30,30,30));
		// $this->our_pdf->SetAligns(array("C","L","C","L","R","L","L"));
		//srand(microtime()*1000000);
		$this->our_pdf->setFillColor(255,255,255);
		$this->our_pdf->setFont('arial','',8);	
		$this->our_pdf->setXY($posX,$posY);
			$sasaran_strategis ="";
			$program ="";
			$no=0;
	//	$this->our_pdf->addLineFormat( $cols);
		$pageNo=1;
		//var_dump(count($pdfdata));
		for ($i=0;$i<count($pdfdata);$i++){
			//utk footer
			if ($i==count($pdfdata)-1)	$this->our_pdf->setFont('arial','B',8);	
			
				
		
		//var_dump($sasaran_strategis);
			
			$this->our_pdf->setFillColor(255,255,255);
			$this->our_pdf->setFont('arial','',8);	
			//$this->our_pdf->setXY($posX,$posY);
			$newHeight = $this->our_pdf->getWrapRowHeight(102,$pdfdata[$i][3]);
			$this->our_pdf->CheckPageBreakChan($newHeight,108);
			$isNewPage = $pageNo != $this->our_pdf->PageNo();
			if ($isNewPage) $pageNo = $this->our_pdf->PageNo();
			if ($sasaran_strategis!=$pdfdata[$i][1]){
				$txt= $pdfdata[$i][1];
					$no++;
			
				$sisa = substr($txt,90,90); 
				//$txt = substr($txt,0,90);
				$rowMerge = $this->rowMerge($pdfdata[$i][1],$pdfdata)-1;
				$sasaran_strategis=$pdfdata[$i][1];
				$border = '';
				if($this->our_pdf->GetY()+$newHeight>$this->our_pdf->PageBreakTrigger){
					$border = 'LTR';
					
				}
				else if ($i==count($pdfdata)-1)
					$border = "LTBR";
				else if (($i==count($pdfdata)-1)||($isNewPage))
					$border = "LTR";					
				else $border = 'LTR';
				$xLeftNumber = $this->our_pdf->GetX();
				$yLeftNumber = $this->our_pdf->GetY();
				$this->our_pdf->cell(8,$newHeight,$pdfdata[$i][0] ,$border,0,'C',1);
					
				$h= 5*$rowMerge;
				$x=$this->our_pdf->GetX();
				$y=$this->our_pdf->GetY();
				
			//((($i==count($pdfdata)-1)||($isNewPage))?1:"LTR")
				$this->our_pdf->Wrap(100, 5, trim($txt),$border , 0, 'LT', false, '', 100,  $newHeightSasaran);
				
				$numpuk = (($newHeight*$rowMerge)<($y-$newHeightSasaran));
				if ($numpuk){
					
					$newHeight2 =ceil(($y-$newHeightSasaran)/$rowMerge);
					//var_dump($newHeight2.'='.($newHeight*$rowMerge));
					$newHeight=$newHeight2+(($newHeight2%($newHeight*$rowMerge))==0?0:5);
					//$this->our_pdf->Line($xLeftNumber,$yLeftNumber,$xLeftNumber,$yLeftNumber+$newHeight);
					$this->our_pdf->SetXY($xLeftNumber,$yLeftNumber);
					$this->our_pdf->cell(8,$newHeight,$pdfdata[$i][0] ,$border,0,'C',1);
				}
				
				if ($i==count($pdfdata)-1)
					$this->our_pdf->SetXY($x+100,$y);
				else
					$this->our_pdf->SetXY($x+100,$y);
				
			
			}
			else{
				$x=$this->our_pdf->GetX();
				$y=$this->our_pdf->GetY();
				$border = 'LR';
				if ($i==count($pdfdata)-1){
					$border = "LBR";
					$this->our_pdf->Line($x,$y+$newHeight,$x+108,$y+$newHeight);
				}
				
				if ($isNewPage) 
					$this->our_pdf->Line($x,$y,$y+108,$y);
				$this->our_pdf->cell(8,$newHeight,"",$border,0,'C',1);
				$this->our_pdf->SetXY($x+108,$y);
			}
			//var_dump($this->our_pdf->GetY()+$newHeight."=".$this->our_pdf->PageBreakTrigger);
			//if(($this->our_pdf->PageBreakTrigger-($this->our_pdf->GetY()+$newHeight))<5);
				//$this->our_pdf->Line($x,$y+$newHeight,$x+108,$y+$newHeight);
					
			$this->our_pdf->cell(8,$newHeight,$pdfdata[$i][2],1,0,'L',1);
			
			  	$h= $newHeight;
				$x=$this->our_pdf->GetX();
				$y=$this->our_pdf->GetY();
				$this->our_pdf->Wrap(102, ($numpuk?$newHeight:5), trim($pdfdata[$i][3]), 1, 0, 'LM', false, '', 102,  $newHeight2);
				$this->our_pdf->SetXY($x+102,$y); 
			$this->our_pdf->cell(30,$newHeight,$pdfdata[$i][5],1,0,'L',1);	
			$this->our_pdf->cell(25,$newHeight,$pdfdata[$i][4],1,0,'R',1);
			
			$this->our_pdf->Ln($newHeight);
			$posY = $posY+$newHeight;
		}  
	
		$this->our_pdf->AliasNbPages();
		$this->our_pdf->Output("LaporanRKTEselon1.pdf","I");
	}
	//element 1= sasaran, 6 program
	private function rowMerge($val,$data,$element=1){
		//hitung beraa row merge dari data tertentu
		$row = 1;
		 for ($i=0;$i<count($data);$i++){
			if ($data[$i][$element]==$val)
				$row++;
		 }
		 return $row;
	}
	
	
	function getSatuan($id){
		echo $this->kke3a_model->getSatuan($id);
	}
	
}
?>
