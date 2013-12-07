<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Kke1_3_model extends CI_Model
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
	public function easyGrid($filtahun=null,$file1=null,$filsasaran=null,$filiku=null,$purpose=1,$pageNumber=null,$pageSize=null){
		$lastNo = isset($_POST['lastNo']) ? intval($_POST['lastNo']) : 0;  
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;  
		
		$count = $this->GetRecordCount($filtahun,$file1,$filsasaran,$filiku);
		$response = new stdClass();
		$response->total = $count;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'sasaran_strategis';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;  
		$pdfdata = array();
		$rataCatatan = 0;
		$rataMasyarakat = 0;
		$rataInstansi= 0;
		$rataTransparansi = 0;
		$rataPenghargaan = 0;
		$sumCatatan = 0;
		$sumMasyarakat = 0;
		$sumInstansi= 0;
		$sumTransparansi = 0;
		$sumPenghargaan = 0;
		if ($count>0){
			//filter
			if($filtahun != '' && $filtahun != '-1' && $filtahun != null) {
				$this->db->where("rkt.tahun",$filtahun);
			}		
			/* if($file1 != '' && $file1 != '-1' && $file1 != null) {
						$this->db->where("kke.kode_e1",$file1);
			} */
			if($filsasaran != '' && $filsasaran != '-1' && $filsasaran != null) {
					$this->db->where("rkt.kode_sasaran_e1",$filsasaran);
			}
			if($filiku != '' && $filiku != '-1' && $filiku != null) {
					$this->db->where("rkt.kode_iku_e1",$filiku);
			}
			
			//$this->db->order_by($sort." ".$order );
			$this->db->order_by("rkt.kode_sasaran_e1,iku.kode_iku_e1,rkt.tahun");
			if ($purpose==1) $this->db->limit($limit,$offset);
			$this->db->select("rkt.kode_sasaran_e1,sasaran_strategis.deskripsi as sasaran_strategis, iku.deskripsi as indikator_kinerja,rkt.tahun,rkt.kode_iku_e1,lke.catatan_keuangan,lke.catatan_keuangan_nilai, lke.masyarakat,lke.masyarakat_nilai, lke.instansi_lainnya, lke.instansi_lainnya_nilai, lke.transparansi,lke.transparansi_nilai, lke.penghargaan, lke.penghargaan_nilai,lke.kke13_e1_id",false);
			$this->db->from('tbl_rkt_eselon1 rkt inner join tbl_iku_eselon1 iku on iku.kode_iku_e1 = rkt.kode_iku_e1 and rkt.tahun = iku.tahun
inner join tbl_sasaran_eselon1 sasaran_strategis on sasaran_strategis.kode_sasaran_e1 = rkt.kode_sasaran_e1 and sasaran_strategis.tahun=rkt.tahun left join tbl_kke1_3_e1 lke on rkt.kode_sasaran_e1=lke.kode_sasaran_e1 and rkt.tahun=lke.tahun and rkt.kode_iku_e1=lke.kode_iku_e1', false);
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
				
				$response->rows[$i]['kke13_e1_id']=$row->kke13_e1_id;
				$response->rows[$i]['kode_sasaran_e1']=$row->kode_sasaran_e1;
				$response->rows[$i]['tahun']=$row->tahun;
				$response->rows[$i]['kode_iku_e1']=$row->kode_iku_e1;
				
				$response->rows[$i]['catatan_keuangan']=$row->catatan_keuangan;
				$response->rows[$i]['catatan_keuangan_nilai']=$this->utility->cekNumericFmt($row->catatan_keuangan_nilai,2);
				$response->rows[$i]['masyarakat']=$row->masyarakat;
				$response->rows[$i]['masyarakat_nilai']=$this->utility->cekNumericFmt($row->masyarakat_nilai,2);
				$response->rows[$i]['instansi_lainnya']=$row->instansi_lainnya;
				$response->rows[$i]['instansi_lainnya_nilai']=$this->utility->cekNumericFmt($row->instansi_lainnya_nilai,2);
				$response->rows[$i]['transparansi']=$row->transparansi;				
				$response->rows[$i]['transparansi_nilai']=$this->utility->cekNumericFmt($row->transparansi_nilai,2);				
				$response->rows[$i]['penghargaan']=$row->penghargaan;
				$response->rows[$i]['penghargaan_nilai']=$this->utility->cekNumericFmt($row->penghargaan_nilai,2);
				//$this->getIndex('instansi_lainnya',$row->tahun,$row->kode_sasaran_e1,$row->kode_iku_e1);//$this->utility->cekNumericFmt($row->target);
				
				
				
				$sumCatatan += $row->catatan_keuangan_nilai;
				$sumMasyarakat+= $row->masyarakat_nilai;
				$sumInstansi += $row->instansi_lainnya_nilai;
				$sumTransparansi += $row->transparansi_nilai;
				$sumPenghargaan += $row->penghargaan_nilai;
//utk kepentingan export excel ==========================
				//$row->program = $program[0].", ".$program[1];
			//============================================================
			
			
			//utk kepentingan export pdf===================
				$pdfdata[] = array($no,$response->rows[$i]['sasaran_strategis'],$response->rows[$i]['no_indikator'],$response->rows[$i]['indikator_kinerja'],$response->rows[$i]['catatan_keuangan'],$response->rows[$i]['catatan_keuangan_nilai'],$response->rows[$i]['masyarakat'],$response->rows[$i]['masyarakat_nilai'],$response->rows[$i]['instansi_lainnya'],$response->rows[$i]['instansi_lainnya_nilai'],$response->rows[$i]['transparansi'],$response->rows[$i]['transparansi_nilai'],$response->rows[$i]['penghargaan'],$response->rows[$i]['penghargaan_nilai']);
			//============================================================
				
				$i++;
			} 
			$response->lastNo = $no;
			$rataCatatan = $sumCatatan / $i;
			$rataMasyarakat = $sumMasyarakat / $i;
			$rataInstansi = $sumInstansi / $i;
			$rataTransparansi = $sumTransparansi / $i;
			$rataPenghargaan = $sumPenghargaan / $i;
			
		//	$query->free_result();
		}else {
				//$response->rows[$count]['id_rkt_kl']=$row->id_rkt_kl;
				$response->rows[$count]['no']= "";
				$response->rows[$count]['no_indikator']= "";
				$response->rows[$count]['indikator_kinerja']='';
				$response->rows[$count]['sasaran_strategis']='';
				$response->rows[$count]['catatan_keuangan']='';
				$response->rows[$count]['catatan_keuangan_nilai']='';
				$response->rows[$count]['masyarakat']='';
				$response->rows[$count]['masyarakat_nilai']='';
				$response->rows[$count]['instansi_lainnya']='';
				$response->rows[$count]['instansi_lainnya_nilai']='';
				$response->rows[$count]['transparansi']='';
				$response->rows[$count]['transparansi_nilai']='';
				$response->rows[$count]['penghargaan']='';
				$response->rows[$count]['penghargaan_nilai']='';				
				$response->lastNo = 0;
				
		}
		
		$response->footer[0]['indikator_kinerja']='<b>Persentase pemenuhan kriteria</b>';
		$response->footer[0]['no']='';
		$response->footer[0]['pejabat']='';		
		$response->footer[0]['no_indikator']='';
		$response->footer[0]['catatan_keuangan_nilai']='<b>'.$this->utility->cekNumericFmt($rataCatatan*100,2).' %</b>';
		$response->footer[0]['masyarakat_nilai']='<b>'.$this->utility->cekNumericFmt($rataMasyarakat*100,2).' %</b>';
		$response->footer[0]['instansi_lainnya_nilai']='<b>'.$this->utility->cekNumericFmt($rataInstansi*100,2).' %</b>';
		$response->footer[0]['transparansi_nilai']='<b>'.$this->utility->cekNumericFmt($rataTransparansi*100,2).' %</b>';
		$response->footer[0]['penghargaan_nilai']='<b>'.$this->utility->cekNumericFmt($rataPenghargaan*100,2).' %</b>';
		
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
	
	public function InsertOnDb($data,& $error) {
		//query insert data		
		$this->db->set('tahun',$data['tahun']);
		$this->db->set('kode_e1',$data['kode_e1']);
		$this->db->set('kode_sasaran_e1',$data['kode_sasaran_e1']);
		$this->db->set('kode_iku_e1',$data['kode_iku_e1']);
		
		$this->db->set('catatan_keuangan',$data['catatan_keuangan']);
		$this->db->set('catatan_keuangan_nilai',$data['catatan_keuangan_nilai']);
		$this->db->set('masyarakat',$data['masyarakat']);
		$this->db->set('masyarakat_nilai',$data['masyarakat_nilai']);
		$this->db->set('instansi_lainnya',$data['instansi_lainnya']);	
		$this->db->set('instansi_lainnya_nilai',$data['instansi_lainnya_nilai']);	
		$this->db->set('transparansi',$data['transparansi']);	
		$this->db->set('transparansi_nilai',$data['transparansi_nilai']);	
		$this->db->set('penghargaan',$data['penghargaan']);	
		$this->db->set('penghargaan_nilai',$data['penghargaan_nilai']);	
		$this->db->set('log_insert', 		$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
		
		$result = $this->db->insert('tbl_kke1_3_e1');
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
		
		$this->db->where('kke13_e1_id',$kode);
		
		$this->db->set('tahun',$data['tahun']);
		$this->db->set('kode_e1',$data['kode_e1']);
		$this->db->set('kode_sasaran_e1',$data['kode_sasaran_e1']);
		$this->db->set('kode_iku_e1',$data['kode_iku_e1']);
		
		$this->db->set('catatan_keuangan',$data['catatan_keuangan']);
		$this->db->set('catatan_keuangan_nilai',$data['catatan_keuangan_nilai']);
		$this->db->set('masyarakat',$data['masyarakat']);
		$this->db->set('masyarakat_nilai',$data['masyarakat_nilai']);
		$this->db->set('instansi_lainnya',$data['instansi_lainnya']);	
		$this->db->set('instansi_lainnya_nilai',$data['instansi_lainnya_nilai']);	
		$this->db->set('transparansi',$data['transparansi']);	
		$this->db->set('transparansi_nilai',$data['transparansi_nilai']);	
		$this->db->set('penghargaan',$data['penghargaan']);	
		$this->db->set('penghargaan_nilai',$data['penghargaan_nilai']);	
		$this->db->set('log_update', 		$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
		
		$result=$this->db->update('tbl_kke1_3_e1');
		
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
		$this->db->from('tbl_kke1_3_e1');
		/* $e1 = $this->session->userdata('unit_kerja_e1');
		if (($e1!="-1")&&($e1!=null)){
			$this->db->where('kode_e1',$e1);
			//$value = $e1;
		} */
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
	
	
	
	public function GetRecordCount($filtahun=null,$file1=null,$filsasaran=null,$filiku=null){
		if($filtahun != '' && $filtahun != '-1' && $filtahun != null) {
			$this->db->where("rkt.tahun",$filtahun);
		}		
		/* if($file1 != '' && $file1 != '-1' && $file1 != null) {
					$this->db->where("rkt.kode_e1",$file1);
		} */
		if($filsasaran != '' && $filsasaran != '-1' && $filsasaran != null) {
				$this->db->where("rkt.kode_sasaran_e1",$filsasaran);
		}
		if($filiku != '' && $filiku != '-1' && $filiku != null) {
				$this->db->where("rkt.kode_iku_e1",$filiku);
		}
		//$this->db->from('tbl_kke1_3_e1');
		//$this->db->select("select sasaran.deskripsi as sasaran_srategis, iku.deskripsi as indikator_kinerja, rkt.target",false);
	//	$this->db->from('tbl_kke1_3_e1 kke inner join tbl_iku_eselon1 iku on kke.kode_iku_e1 = iku.kode_iku_e1 and kke.tahun=iku.tahun inner join tbl_sasaran_eselon1 sasaran on sasaran.kode_sasaran_e1 = iku.kode_sasaran_e1 and sasaran.tahun=iku.tahun', false);
		$this->db->from('tbl_rkt_eselon1 rkt inner join tbl_iku_eselon1 iku on iku.kode_iku_e1 = rkt.kode_iku_e1 and rkt.tahun = iku.tahun
inner join tbl_sasaran_eselon1 sasaran on sasaran.kode_sasaran_e1 = rkt.kode_sasaran_e1 and sasaran.tahun=rkt.tahun left join tbl_kke1_3_e1 lke on rkt.kode_sasaran_e1=lke.kode_sasaran_e1 and rkt.tahun=lke.tahun and rkt.kode_iku_e1=lke.kode_iku_e1', false);
		return $this->db->count_all_results();
		$this->db->free_result();
	}
	
	public function getIndex($field,$tahun,$kode_sasaran,$kode_iku){
		$this->db->flush_cache();
		$this->db->select($field.' as index',false);
		$this->db->from('tbl_kke1_3_e1');
		$this->db->where('kode_iku_e1', $kode_iku);
		$this->db->where('kode_sasaran_e1', $kode_sasaran);
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
		$this->db->where('kode_iku_e1', $id);
		$query = $this->db->get();
		
		return $query->row()->satuan;
		
	}
	
}
?>
