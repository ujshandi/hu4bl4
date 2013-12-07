<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Kke3b_e2_model extends CI_Model
{	
	/**
	* constructor
	*/
	public function __construct()
    {
        parent::__construct();
		//$this->CI =& get_instance();
    }
	// purpose : 1=buat grid, 2=buat pdf, 3=buat excel
	public function easyGrid($filtahun=null,$file2=null,$filsasaran=null,$filiku=null,$purpose=1,$pageNumber=null,$pageSize=null){
		$lastNo = isset($_POST['lastNo']) ? intval($_POST['lastNo']) : 0;  
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;  
		
		$count = $this->GetRecordCount($filtahun,$file2,$filsasaran,$filiku);
		$response = new stdClass();
		$response->total = $count;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'sasaran_strategis';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;  
		$pdfdata = array();
		if ($count>0){
			//filter
			if($filtahun != '' && $filtahun != '-1' && $filtahun != null) {
				$this->db->where("rkt.tahun",$filtahun);
			}		
			 if($file2 != '' && $file2 != '-1' && $file2 != null) {
						$this->db->where("rkt.kode_e2",$file2);
			} 
			if($filsasaran != '' && $filsasaran != '-1' && $filsasaran != null) {
					$this->db->where("rkt.kode_sasaran_e2",$filsasaran);
			}
			if($filiku != '' && $filiku != '-1' && $filiku != null) {
					$this->db->where("rkt.kode_ikk",$filiku);
			}
			
			//$this->db->order_by($sort." ".$order );
			$this->db->order_by("rkt.kode_sasaran_e2,iku.kode_ikk,rkt.tahun");
			if ($purpose==1) $this->db->limit($limit,$offset);
			$this->db->select("rkt.kode_sasaran_e2,sasaran_strategis.deskripsi as sasaran_strategis, iku.deskripsi as indikator_kinerja,rkt.tahun,rkt.kode_ikk,lke.kke3b_e2_id,lke.renstra_a,lke.renstra_a_nilai, lke.rkt_a,lke.rkt_a_nilai, lke.pk_a, lke.pk_a_nilai, lke.iku_measurable_a,lke.iku_measurable_a_nilai, lke.iku_hasil_a, lke.iku_hasil_a_nilai,lke.iku_relevan_a, lke.iku_relevan_a_nilai,lke.iku_diukur_a, lke.iku_diukur_a_nilai,lke.kriteria_measurable_a, lke.kriteria_measurable_a_nilai,lke.kriteria_hasil_a, lke.kriteria_hasil_a_nilai, lke.kriteria_relevan_a, lke.kriteria_relevan_a_nilai, lke.kriteria_diukur_a, lke.kriteria_diukur_a_nilai, lke.pengukuran_a, lke.pengukuran_a_nilai,lke.renstra_b,lke.renstra_b_nilai, lke.rkt_b,lke.rkt_b_nilai, lke.pk_b, lke.pk_b_nilai, lke.iku_measurable_b,lke.iku_measurable_b_nilai, lke.iku_hasil_b, lke.iku_hasil_b_nilai,lke.iku_relevan_b, lke.iku_relevan_b_nilai,lke.iku_diukur_b, lke.iku_diukur_b_nilai,lke.kriteria_measurable_b, lke.kriteria_measurable_b_nilai,lke.kriteria_hasil_b, lke.kriteria_hasil_b_nilai, lke.kriteria_relevan_b, lke.kriteria_relevan_b_nilai, lke.kriteria_diukur_b, lke.kriteria_diukur_b_nilai, lke.pengukuran_b, lke.pengukuran_b_nilai,rkt.kode_e2,e2.nama_e2",false);
			$this->db->from('tbl_rkt_eselon2 rkt inner join tbl_ikk iku on iku.kode_ikk = rkt.kode_ikk and rkt.tahun = iku.tahun
inner join tbl_sasaran_eselon2 sasaran_strategis on sasaran_strategis.kode_sasaran_e2 = rkt.kode_sasaran_e2 and sasaran_strategis.tahun=rkt.tahun left join tbl_kke3b_e2 lke on rkt.kode_sasaran_e2=lke.kode_sasaran_e2 and rkt.tahun=lke.tahun and rkt.kode_ikk=lke.kode_ikk inner join tbl_eselon2 e2 on rkt.kode_e2=e2.kode_e2', false);
			$query = $this->db->get();
			
			$i=0;
			$sasaran_strategis ="";
			$indikator_kinerja ="";
			$no =($page-1)*$limit;//$lastNo;
			$noIndikator =0;
			foreach ($query->result() as $row)
			{
				//$response->rows[$i]['id_rkt_kl']=$row->id_rkt_kl;
				if ($sasaran_strategis!=$row->sasaran_strategis){
					$no++;
					$noIndikator =0;
					$response->rows[$i]['no']= $no;
					
					$response->rows[$i]['sasaran_strategis']=$row->sasaran_strategis;
					$sasaran_strategis=$row->sasaran_strategis;
				}
				else{
					$response->rows[$i]['sasaran_strategis']=$row->sasaran_strategis;//"";
					$response->rows[$i]['no']= "";
				}
				
				if ($indikator_kinerja!=$row->indikator_kinerja){	
					$noIndikator++;
					$response->rows[$i]['no_indikator']= $no.".".$noIndikator;
					$response->rows[$i]['indikator_kinerja']=$row->indikator_kinerja;
					$indikator_kinerja=$row->indikator_kinerja;
				}else {	
					$response->rows[$i]['indikator_kinerja']="";
					$response->rows[$i]['no_indikator']="";
				}
				
				$response->rows[$i]['kke3b_e2_id']=$row->kke3b_e2_id;
				$response->rows[$i]['kode_sasaran_e2']=$row->kode_sasaran_e2;
				$response->rows[$i]['tahun']=$row->tahun;
				$response->rows[$i]['kode_e2']=$row->kode_e2;
				$response->rows[$i]['nama_e2']=$row->nama_e2;
				$response->rows[$i]['kode_ikk']=$row->kode_ikk;
				
				$response->rows[$i]['renstra_a']=$row->renstra_a;
				$response->rows[$i]['renstra_a_nilai']=$this->utility->cekNumericFmt($row->renstra_a_nilai,2);
				$response->rows[$i]['rkt_a']=$row->rkt_a;
				$response->rows[$i]['rkt_a_nilai']=$this->utility->cekNumericFmt($row->rkt_a_nilai,2);
				$response->rows[$i]['pk_a']=$row->pk_a;
				$response->rows[$i]['pk_a_nilai']=$this->utility->cekNumericFmt($row->pk_a_nilai,2);
				$response->rows[$i]['iku_measurable_a']=$row->iku_measurable_a;				
				$response->rows[$i]['iku_measurable_a_nilai']=$this->utility->cekNumericFmt($row->iku_measurable_a_nilai,2);
				$response->rows[$i]['iku_hasil_a']=$row->iku_hasil_a;				
				$response->rows[$i]['iku_hasil_a_nilai']=$this->utility->cekNumericFmt($row->iku_hasil_a_nilai,2);
				$response->rows[$i]['iku_relevan_a']=$row->iku_relevan_a;				
				$response->rows[$i]['iku_relevan_a_nilai']=$this->utility->cekNumericFmt($row->iku_relevan_a_nilai,2);
				$response->rows[$i]['iku_diukur_a']=$row->iku_diukur_a;				
				$response->rows[$i]['iku_diukur_a_nilai']=$this->utility->cekNumericFmt($row->iku_diukur_a_nilai,2);				
				$response->rows[$i]['kriteria_measurable_a']=$row->kriteria_measurable_a;				
				$response->rows[$i]['kriteria_measurable_a_nilai']=$this->utility->cekNumericFmt($row->kriteria_measurable_a_nilai,2);
				$response->rows[$i]['kriteria_hasil_a']=$row->kriteria_hasil_a;				
				$response->rows[$i]['kriteria_hasil_a_nilai']=$this->utility->cekNumericFmt($row->kriteria_hasil_a_nilai,2);
				$response->rows[$i]['kriteria_relevan_a']=$row->kriteria_relevan_a;				
				$response->rows[$i]['kriteria_relevan_a_nilai']=$this->utility->cekNumericFmt($row->kriteria_relevan_a_nilai,2);
				$response->rows[$i]['kriteria_diukur_a']=$row->kriteria_diukur_a;				
				$response->rows[$i]['kriteria_diukur_a_nilai']=$this->utility->cekNumericFmt($row->kriteria_diukur_a_nilai,2);
				$response->rows[$i]['pengukuran_a']=$row->pengukuran_a;				
				$response->rows[$i]['pengukuran_a_nilai']=$this->utility->cekNumericFmt($row->pengukuran_a_nilai,2);
				
				$response->rows[$i]['renstra_b']=$row->renstra_b;
				$response->rows[$i]['renstra_b_nilai']=$this->utility->cekNumericFmt($row->renstra_b_nilai,2);
				$response->rows[$i]['rkt_b']=$row->rkt_b;
				$response->rows[$i]['rkt_b_nilai']=$this->utility->cekNumericFmt($row->rkt_b_nilai,2);
				$response->rows[$i]['pk_b']=$row->pk_b;
				$response->rows[$i]['pk_b_nilai']=$this->utility->cekNumericFmt($row->pk_b_nilai,2);
				$response->rows[$i]['iku_measurable_b']=$row->iku_measurable_b;				
				$response->rows[$i]['iku_measurable_b_nilai']=$this->utility->cekNumericFmt($row->iku_measurable_b_nilai,2);
				$response->rows[$i]['iku_hasil_b']=$row->iku_hasil_b;				
				$response->rows[$i]['iku_hasil_b_nilai']=$this->utility->cekNumericFmt($row->iku_hasil_b_nilai,2);
				$response->rows[$i]['iku_relevan_b']=$row->iku_relevan_b;				
				$response->rows[$i]['iku_relevan_b_nilai']=$this->utility->cekNumericFmt($row->iku_relevan_b_nilai,2);
				$response->rows[$i]['iku_diukur_b']=$row->iku_diukur_b;				
				$response->rows[$i]['iku_diukur_b_nilai']=$this->utility->cekNumericFmt($row->iku_diukur_b_nilai,2);				
				$response->rows[$i]['kriteria_measurable_b']=$row->kriteria_measurable_b;				
				$response->rows[$i]['kriteria_measurable_b_nilai']=$this->utility->cekNumericFmt($row->kriteria_measurable_b_nilai,2);
				$response->rows[$i]['kriteria_hasil_b']=$row->kriteria_hasil_b;				
				$response->rows[$i]['kriteria_hasil_b_nilai']=$this->utility->cekNumericFmt($row->kriteria_hasil_b_nilai,2);
				$response->rows[$i]['kriteria_relevan_b']=$row->kriteria_relevan_b;				
				$response->rows[$i]['kriteria_relevan_b_nilai']=$this->utility->cekNumericFmt($row->kriteria_relevan_b_nilai,2);
				$response->rows[$i]['kriteria_diukur_b']=$row->kriteria_diukur_b;				
				$response->rows[$i]['kriteria_diukur_b_nilai']=$this->utility->cekNumericFmt($row->kriteria_diukur_b_nilai,2);
				$response->rows[$i]['pengukuran_b']=$row->pengukuran_b;				
				$response->rows[$i]['pengukuran_b_nilai']=$this->utility->cekNumericFmt($row->pengukuran_b_nilai,2);
				
				//$this->getIndex('pk_a',$row->tahun,$row->kode_sasaran_e2,$row->kode_ikk);//$this->utility->cekNumericFmt($row->target);
				
//utk kepentingan export excel ==========================
				//$row->program = $program[0].", ".$program[1];
			//============================================================
			//utk kepentingan export pdf===================
				$pdfdata[] = array($no,$response->rows[$i]['sasaran_strategis'],$response->rows[$i]['no_indikator'],$response->rows[$i]['indikator_kinerja'],$response->rows[$i]['pk_a'],$response->rows[$i]['iku_measurable_a'],$response->rows[$i]['iku_hasil_a']);
			//============================================================

				$i++;
			} 
			$response->lastNo = $no;
		//	$query->free_result();
		}else {
				//$response->rows[$count]['id_rkt_kl']=$row->id_rkt_kl;
				$response->rows[$count]['no']= "";
				$response->rows[$count]['no_indikator']= "";
				$response->rows[$count]['indikator_kinerja']='';
				$response->rows[$count]['sasaran_strategis']='';
				$response->rows[$count]['kode_e2']='';
				$response->rows[$count]['nama_e2']='';
				$response->rows[$count]['pk_a']='';
				$response->rows[$count]['iku_measurable_a']='';
				$response->rows[$count]['iku_hasil_a']='';
				$response->rows[$count]['satuan']='';
				$response->rows[$count]['target']='';
				$response->lastNo = 0;
				
		}
		
		if ($purpose==1) //grid normal
			return json_encode($response);
		else if($purpose==2){//pdf
			return $pdfdata;
		}
		else if($purpose==3){//to excel
			//tambahkan header kolom
			$colHeaders = array("Sasaran Strategis","Deskripsi Indikator","Target Tercapai","Kinerja Terbaik","Data Andal");		
			to_excel($query,"KKE1-2-E1",$colHeaders);
		}
		
	}
	
		public function GetRecordCount($filtahun=null,$file2=null,$filsasaran=null,$filiku=null){
		if($filtahun != '' && $filtahun != '-1' && $filtahun != null) {
			$this->db->where("rkt.tahun",$filtahun);
		}		
		 if($file2 != '' && $file2 != '-1' && $file2 != null) {
					$this->db->where("rkt.kode_e2",$file2);
		} 
		if($filsasaran != '' && $filsasaran != '-1' && $filsasaran != null) {
				$this->db->where("rkt.kode_sasaran_e2",$filsasaran);
		}
		if($filiku != '' && $filiku != '-1' && $filiku != null) {
				$this->db->where("rkt.kode_ikk",$filiku);
		}
		//$this->db->from('tbl_kke3b_e2');
		//$this->db->select("select sasaran.deskripsi as sasaran_srategis, iku.deskripsi as indikator_kinerja, rkt.target",false);
	//	$this->db->from('tbl_kke3b_e2 kke inner join tbl_ikk iku on kke.kode_ikk = iku.kode_ikk and kke.tahun=iku.tahun inner join tbl_sasaran_eselon2 sasaran on sasaran.kode_sasaran_e2 = iku.kode_sasaran_e2 and sasaran.tahun=iku.tahun', false);
		$this->db->from('tbl_rkt_eselon2 rkt inner join tbl_ikk iku on iku.kode_ikk = rkt.kode_ikk and rkt.tahun = iku.tahun
inner join tbl_sasaran_eselon2 sasaran on sasaran.kode_sasaran_e2 = rkt.kode_sasaran_e2 and sasaran.tahun=rkt.tahun left join tbl_kke3b_e2 lke on rkt.kode_sasaran_e2=lke.kode_sasaran_e2 and rkt.tahun=lke.tahun and rkt.kode_ikk=lke.kode_ikk', false);
		return $this->db->count_all_results();
		$this->db->free_result();
	}
	
	public function InsertOnDb($data,& $error) {
		//query insert data		
		$this->db->set('tahun',$data['tahun']);
		$this->db->set('kode_e2',$data['kode_e2']);
		$this->db->set('kode_sasaran_e2',$data['kode_sasaran_e2']);
		$this->db->set('kode_ikk',$data['kode_ikk']);
		
		$this->db->set('renstra_a',$data['renstra_a']);
		$this->db->set('renstra_a_nilai',$data['renstra_a_nilai']);
		$this->db->set('rkt_a',$data['rkt_a']);
		$this->db->set('rkt_a_nilai',$data['rkt_a_nilai']);
		$this->db->set('pk_a',$data['pk_a']);	
		$this->db->set('pk_a_nilai',$data['pk_a_nilai']);	
		$this->db->set('iku_measurable_a',$data['iku_measurable_a']);	
		$this->db->set('iku_measurable_a_nilai',$data['iku_measurable_a_nilai']);	
		$this->db->set('iku_hasil_a',$data['iku_hasil_a']);	
		$this->db->set('iku_hasil_a_nilai',$data['iku_hasil_a_nilai']);	
		$this->db->set('iku_relevan_a',$data['iku_relevan_a']);	
		$this->db->set('iku_relevan_a_nilai',$data['iku_relevan_a_nilai']);	
		$this->db->set('iku_diukur_a',$data['iku_diukur_a']);	
		$this->db->set('iku_diukur_a_nilai',$data['iku_diukur_a_nilai']);			
		$this->db->set('kriteria_measurable_a',$data['kriteria_measurable_a']);	
		$this->db->set('kriteria_measurable_a_nilai',$data['kriteria_measurable_a_nilai']);	
		$this->db->set('kriteria_hasil_a',$data['kriteria_hasil_a']);	
		$this->db->set('kriteria_hasil_a_nilai',$data['kriteria_hasil_a_nilai']);	
		$this->db->set('kriteria_relevan_a',$data['kriteria_relevan_a']);	
		$this->db->set('kriteria_relevan_a_nilai',$data['kriteria_relevan_a_nilai']);	
		$this->db->set('kriteria_diukur_a',$data['kriteria_diukur_a']);	
		$this->db->set('kriteria_diukur_a_nilai',$data['kriteria_diukur_a_nilai']);	
		$this->db->set('pengukuran_a',$data['pengukuran_a']);	
		$this->db->set('pengukuran_a_nilai',$data['pengukuran_a_nilai']);	
		
		
		$this->db->set('renstra_b',$data['renstra_b']);
		$this->db->set('renstra_b_nilai',$data['renstra_b_nilai']);
		$this->db->set('rkt_b',$data['rkt_b']);
		$this->db->set('rkt_b_nilai',$data['rkt_b_nilai']);
		$this->db->set('pk_b',$data['pk_b']);	
		$this->db->set('pk_b_nilai',$data['pk_b_nilai']);	
		$this->db->set('iku_measurable_b',$data['iku_measurable_b']);	
		$this->db->set('iku_measurable_b_nilai',$data['iku_measurable_b_nilai']);	
		$this->db->set('iku_hasil_b',$data['iku_hasil_b']);	
		$this->db->set('iku_hasil_b_nilai',$data['iku_hasil_b_nilai']);	
		$this->db->set('iku_relevan_b',$data['iku_relevan_b']);	
		$this->db->set('iku_relevan_b_nilai',$data['iku_relevan_b_nilai']);	
		$this->db->set('iku_diukur_b',$data['iku_diukur_b']);	
		$this->db->set('iku_diukur_b_nilai',$data['iku_diukur_b_nilai']);			
		$this->db->set('kriteria_measurable_b',$data['kriteria_measurable_b']);	
		$this->db->set('kriteria_measurable_b_nilai',$data['kriteria_measurable_b_nilai']);	
		$this->db->set('kriteria_hasil_b',$data['kriteria_hasil_b']);	
		$this->db->set('kriteria_hasil_b_nilai',$data['kriteria_hasil_b_nilai']);	
		$this->db->set('kriteria_relevan_b',$data['kriteria_relevan_b']);	
		$this->db->set('kriteria_relevan_b_nilai',$data['kriteria_relevan_b_nilai']);	
		$this->db->set('kriteria_diukur_b',$data['kriteria_diukur_b']);	
		$this->db->set('kriteria_diukur_b_nilai',$data['kriteria_diukur_b_nilai']);	
		$this->db->set('pengukuran_b',$data['pengukuran_b']);	
		$this->db->set('pengukuran_b_nilai',$data['pengukuran_b_nilai']);	
		
		$this->db->set('log_insert', 		$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
		
		$result = $this->db->insert('tbl_kke3b_e2');
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
		
		$this->db->where('kke3b_e2_id',$kode);
		
		$this->db->set('tahun',$data['tahun']);
		$this->db->set('kode_e2',$data['kode_e2']);
		$this->db->set('kode_sasaran_e2',$data['kode_sasaran_e2']);
		$this->db->set('kode_ikk',$data['kode_ikk']);
		
		$this->db->set('renstra_a',$data['renstra_a']);
		$this->db->set('renstra_a_nilai',$data['renstra_a_nilai']);
		$this->db->set('rkt_a',$data['rkt_a']);
		$this->db->set('rkt_a_nilai',$data['rkt_a_nilai']);
		$this->db->set('pk_a',$data['pk_a']);	
		$this->db->set('pk_a_nilai',$data['pk_a_nilai']);	
		$this->db->set('iku_measurable_a',$data['iku_measurable_a']);	
		$this->db->set('iku_measurable_a_nilai',$data['iku_measurable_a_nilai']);	
		$this->db->set('iku_hasil_a',$data['iku_hasil_a']);	
		$this->db->set('iku_hasil_a_nilai',$data['iku_hasil_a_nilai']);	
		$this->db->set('iku_relevan_a',$data['iku_relevan_a']);	
		$this->db->set('iku_relevan_a_nilai',$data['iku_relevan_a_nilai']);	
		$this->db->set('iku_diukur_a',$data['iku_diukur_a']);	
		$this->db->set('iku_diukur_a_nilai',$data['iku_diukur_a_nilai']);			
		$this->db->set('kriteria_measurable_a',$data['kriteria_measurable_a']);	
		$this->db->set('kriteria_measurable_a_nilai',$data['kriteria_measurable_a_nilai']);	
		$this->db->set('kriteria_hasil_a',$data['kriteria_hasil_a']);	
		$this->db->set('kriteria_hasil_a_nilai',$data['kriteria_hasil_a_nilai']);	
		$this->db->set('kriteria_relevan_a',$data['kriteria_relevan_a']);	
		$this->db->set('kriteria_relevan_a_nilai',$data['kriteria_relevan_a_nilai']);	
		$this->db->set('kriteria_diukur_a',$data['kriteria_diukur_a']);	
		$this->db->set('kriteria_diukur_a_nilai',$data['kriteria_diukur_a_nilai']);	
		$this->db->set('pengukuran_a',$data['pengukuran_a']);	
		$this->db->set('pengukuran_a_nilai',$data['pengukuran_a_nilai']);	
		
		$this->db->set('renstra_b',$data['renstra_b']);
		$this->db->set('renstra_b_nilai',$data['renstra_b_nilai']);
		$this->db->set('rkt_b',$data['rkt_b']);
		$this->db->set('rkt_b_nilai',$data['rkt_b_nilai']);
		$this->db->set('pk_b',$data['pk_b']);	
		$this->db->set('pk_b_nilai',$data['pk_b_nilai']);	
		$this->db->set('iku_measurable_b',$data['iku_measurable_b']);	
		$this->db->set('iku_measurable_b_nilai',$data['iku_measurable_b_nilai']);	
		$this->db->set('iku_hasil_b',$data['iku_hasil_b']);	
		$this->db->set('iku_hasil_b_nilai',$data['iku_hasil_b_nilai']);	
		$this->db->set('iku_relevan_b',$data['iku_relevan_b']);	
		$this->db->set('iku_relevan_b_nilai',$data['iku_relevan_b_nilai']);	
		$this->db->set('iku_diukur_b',$data['iku_diukur_b']);	
		$this->db->set('iku_diukur_b_nilai',$data['iku_diukur_b_nilai']);			
		$this->db->set('kriteria_measurable_b',$data['kriteria_measurable_b']);	
		$this->db->set('kriteria_measurable_b_nilai',$data['kriteria_measurable_b_nilai']);	
		$this->db->set('kriteria_hasil_b',$data['kriteria_hasil_b']);	
		$this->db->set('kriteria_hasil_b_nilai',$data['kriteria_hasil_b_nilai']);	
		$this->db->set('kriteria_relevan_b',$data['kriteria_relevan_b']);	
		$this->db->set('kriteria_relevan_b_nilai',$data['kriteria_relevan_b_nilai']);	
		$this->db->set('kriteria_diukur_b',$data['kriteria_diukur_b']);	
		$this->db->set('kriteria_diukur_b_nilai',$data['kriteria_diukur_b_nilai']);	
		$this->db->set('pengukuran_b',$data['pengukuran_b']);	
		$this->db->set('pengukuran_b_nilai',$data['pengukuran_b_nilai']);	
		
		$this->db->set('log_update', 		$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
		
		$result=$this->db->update('tbl_kke3b_e2');
		
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
	
	
	public function getListTahun($objectId){
		
		$this->db->flush_cache();
		$this->db->select('distinct tahun',false);
		$this->db->from('tbl_kke3b_e2');
		$e1 = $this->session->userdata('unit_kerja_e1');
		if (($e1!="-1")&&($e1!=null)){
			$this->db->where('kode_e2',$e1);
			//$value = $e1;
		}
		$this->db->order_by('tahun');
		
		$que = $this->db->get();
		
		$out = '<select name="filter_tahun'.$objectId.'" id="filter_tahun'.$objectId.'">';
		//$out .= '<option value="">Semua</option>';
		foreach($que->result() as $r){
			$out .= '<option value="'.$r->tahun.'">'.$r->tahun.'</option>';
		}
		
		$out .= '</select>';
		//chan
		if ($que->num_rows()==0){
			$out = "Data RKT belum tersedia.";
		}
		
		echo $out;
	}
	
	
	

	
	public function getIndex($field,$tahun,$kode_sasaran,$kode_iku){
		$this->db->flush_cache();
		$this->db->select($field.' as index',false);
		$this->db->from('tbl_kke3b_e2');
		$this->db->where('kode_ikk', $kode_iku);
		$this->db->where('kode_sasaran_e2', $kode_sasaran);
		$this->db->where('tahun', $tahun);
		$query = $this->db->get();
		if ($query->num_rows()>0)
			return $query->row()->index;
		else return 0;
		
	}
	
	public function getSatuan($id){
		$this->db->flush_cache();
		$this->db->select('satuan');
		$this->db->from('tbl_iku');
		$this->db->where('kode_ikk', $id);
		$query = $this->db->get();
		
		return $query->row()->satuan;
		
	}
	
}
?>
