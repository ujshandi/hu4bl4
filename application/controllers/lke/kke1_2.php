<?php

class Kke1_2 extends CI_Controller {
	var $objectId = 'kke1_2';
	function __construct()
	{
		parent::__construct();			

		//$userdata = array ('logged_in' => TRUE);
				//
		//$this->session->set_userdata($userdata);
				
		//if ($this->session->userdata('logged_in') != TRUE) redirect('security/login');					
		$this->load->model('/security/sys_menu_model');
		$this->load->model('/lke/kke1_2_model');
		$this->load->model('/pengaturan/iku_e1_model');
		$this->load->model('/lke/lke_konversi_model');
		$this->load->model('/rujukan/eselon1_model');
		$this->load->library("utility");
		
	}
	
	function index(){
		$data['title'] = 'Kertas Kerja Evaluasi II';	
		$data['objectId'] = $this->objectId;		
		$data['sasarantepat_radio'] = $this->lke_konversi_model->getListIndex($this->objectId,array('jenis_lke'=>'kke1_2','unit_kerja'=>'e1'),true,"sasaran_tepat");
		$data['iktepat_radio'] = $this->lke_konversi_model->getListIndex($this->objectId,array('jenis_lke'=>'kke1_2','unit_kerja'=>'e1'),true,"ik_tepat");
		$data['targettercapai_radio'] = $this->lke_konversi_model->getListIndex($this->objectId,array('jenis_lke'=>'kke1_2','unit_kerja'=>'e1'),true,"target_tercapai");
		$data['kinerjabaik_radio'] = $this->lke_konversi_model->getListIndex($this->objectId,array('jenis_lke'=>'kke1_2','unit_kerja'=>'e1'),true,"kinerja_baik");
		$data['dataandal_radio'] = $this->lke_konversi_model->getListIndex($this->objectId,array('jenis_lke'=>'kke1_2','unit_kerja'=>'e1'),true,"data_andal");
	  	$this->load->view('lke/kke1_2_v',$data);
	}
	
	private function get_form_values() {
		$dt['tahun'] = $this->input->post("tahun", TRUE); 
		$dt['kke12_e1_id'] = $this->input->post("kke12_e1_id", TRUE); 
		$dt['kode_sasaran_e1'] = $this->input->post("kode_sasaran_e1", TRUE); 
		$dt['kode_iku_e1'] = $this->input->post("kode_iku_e1", TRUE); 
		$dt['sasaran_tepat'] = $this->input->post("sasaran_tepat", TRUE); 
		$dt['sasaran_tepat_nilai'] = $this->lke_konversi_model->getKonversi('kke1_2',$dt['sasaran_tepat'],'e1');
		$dt['ik_tepat'] = $this->input->post("ik_tepat", TRUE); 
		$dt['ik_tepat_nilai'] = $this->lke_konversi_model->getKonversi('kke1_2',$dt['ik_tepat'],'e1');
		$dt['target_tercapai'] = $this->input->post("target_tercapai", TRUE); 
		$dt['target_tercapai_nilai'] = $this->lke_konversi_model->getKonversi('kke1_2',$dt['target_tercapai'],'e1');
		$dt['kinerja_baik'] = $this->input->post("kinerja_baik", TRUE); 
		$dt['kinerja_baik_nilai'] = $this->lke_konversi_model->getKonversi('kke1_2',$dt['kinerja_baik'],'e1');
		$dt['data_andal'] = $this->input->post("data_andal", TRUE); 
		$dt['data_andal_nilai'] = $this->lke_konversi_model->getKonversi('kke1_2',$dt['data_andal'],'e1');
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
		//$this->form_validation->set_rules("id_komponen", 'Komponen/Subkomponen', 'trim|required|xss_clean');
	//	$this->form_validation->set_rules("index_mutu", 'Index Mutu', 'trim|required|xss_clean');
		
		# message rules
		$this->form_validation->set_message('required', 'Field %s harus diisi.');
		$this->form_validation->set_message('numeric', 'Isi field %s dengan angka');
		$this->form_validation->set_message('exact_length', 'Isi field %s dengan 4 karakter angka');
		
		if ($this->form_validation->run() == FALSE){ // jika tidak valid
			$data['pesan_error'].=(trim(form_error('tahun',' ',' '))==''?'':form_error('tahun',' ','<br>'));
			//$data['pesan_error'].=(trim(form_error('id_komponen',' ',' '))==''?'':form_error('id_komponen',' ','<br>'));
			//$data['pesan_error'].=(trim(form_error('index_mutu',' ',' '))==''?'':form_error('index_mutu',' ','<br>'));
			
		}else{
			// validasi detail
				
			
				if ($data['kke12_e1_id']==''){	
					$result = $this->kke1_2_model->InsertOnDb($data,$data['pesan_error']);
				}
				else {
					$result = $this->kke1_2_model->UpdateOnDb($data,$data['kke12_e1_id']);
				}
				
					//$data['pesan_error'] .= 'Komponen ini untuk tahun '.$data['tahun'].' sudah diinput.';
		}
		
		if ($result){
			echo json_encode(array('success'=>true, 'status'=>$return_id));
		} else {
			echo json_encode(array('msg'=>$data['pesan_error']));
		}
	}
	
	function delete($id=''){
		if($id != ''){
			$result = $this->kke1_2_model->DeleteOnDb($id);
			if ($result){
				echo json_encode(array('success'=>true, 'haha'=>''));
			} else {
				echo json_encode(array('msg'=>'Some errors occured uy.', 'data'=> ''));
			}
		}
	}
	
	function grid($filtahun=null,$file1=null,$filsasaran=null,$filiku=null){
		if ($file1==null)
			$file1 = $this->session->userdata('unit_kerja_e1');
		echo $this->kke1_2_model->easyGrid($filtahun,$file1,$filsasaran,$filiku);
	}
	
	public function excel($filtahun=null,$file1=null,$filsasaran=null,$filiku=null,$page=null,$rows=null){
		echo  $this->kke1_2_model->easyGrid($filtahun,$file1,$filsasaran,$filiku,3,$page,$rows);
	}
	
	public function pdf($filtahun=null,$file1=null,$filsasaran=null,$filiku=null,$page=null,$rows=null){
		$this->load->library('our_pdf','our_pdf');
		$this->our_pdf->FPDF('L', 'mm', 'A4');             
		$pdfdata = $this->kke1_2_model->easyGrid($filtahun,$file1,$filsasaran,$filiku,2,$page,$rows);
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
		echo $this->kke1_2_model->getSatuan($id);
	}
	
}
?>
