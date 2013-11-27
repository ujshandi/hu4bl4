<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Kke1_2_model extends CI_Model
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
		$rataSasaran=0;
		$sumSasaran=0;
		$rataIk=0;
		$sumIk=0;
		$rataTarget=0;
		$sumTarget=0;
		$rataKinerja=0;
		$sumKinerja=0;
		$rataAndal=0;
		$sumAndal=0;
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
			$this->db->select("rkt.kode_sasaran_e1,sasaran_strategis.deskripsi as sasaran_strategis, iku.deskripsi as indikator_kinerja,rkt.tahun,rkt.kode_iku_e1,lke.sasaran_tepat,lke.sasaran_tepat_nilai, lke.ik_tepat,lke.ik_tepat_nilai, lke.target_tercapai, lke.target_tercapai_nilai, lke.kinerja_baik,lke.kinerja_baik_nilai, lke.data_andal, lke.data_andal_nilai,lke.kke12_e1_id",false);
			$this->db->from('tbl_rkt_eselon1 rkt inner join tbl_iku_eselon1 iku on iku.kode_iku_e1 = rkt.kode_iku_e1 and rkt.tahun = iku.tahun
inner join tbl_sasaran_eselon1 sasaran_strategis on sasaran_strategis.kode_sasaran_e1 = rkt.kode_sasaran_e1 and sasaran_strategis.tahun=rkt.tahun left join tbl_kke1_2_e1 lke on rkt.kode_sasaran_e1=lke.kode_sasaran_e1 and rkt.tahun=lke.tahun and rkt.kode_iku_e1=lke.kode_iku_e1', false);
			$query = $this->db->get();
			
			$i=0;
			$sasaran_strategis ="";
			$indikator_kinerja ="";
			$targetPersen=0; $kinerjaPersen=0; $andalPersen=0;
			$targetSum=0; $kinerjaSum=0; $andalSum=0;
			$no =$lastNo;  //($page-1)*$limit;
			$noIndikator =0;
			$rowIdxPersen=0;
			foreach ($query->result() as $row)
			{
				//$response->rows[$i]['id_rkt_kl']=$row->id_rkt_kl;
					
					$targetSum +=$row->target_tercapai_nilai; 
					$kinerjaSum +=$row->kinerja_baik_nilai; 
					$andalSum += $row->data_andal_nilai;
					
					
				if ($sasaran_strategis!=$row->sasaran_strategis){
					$no++;
					
					
					
					$response->rows[$i]['no']= $no;					
					$response->rows[$i]['sasaran_strategis']=$row->sasaran_strategis;
					$sasaran_strategis=$row->sasaran_strategis;
					
					if ($i>0){
						$targetPersen=$targetSum/($noIndikator); 
						$kinerjaPersen=$kinerjaSum/($noIndikator); 
						$andalPersen=$andalSum/($noIndikator);
						$response->rows[$rowIdxPersen]['target_tercapai_persen']=$this->utility->cekNumericFmt($targetPersen*100,2);
						$response->rows[$rowIdxPersen]['kinerja_baik_persen']=$this->utility->cekNumericFmt($kinerjaPersen*100,2);
						$response->rows[$rowIdxPersen]['data_andal_persen']=$this->utility->cekNumericFmt($andalPersen*100,2);
						$targetPersen=0; $kinerjaPersen=0; $andalPersen=0;
					$targetSum=0; $kinerjaSum=0; $andalSum=0;
					}
					$noIndikator =0;
					$rowIdxPersen=$i;
					
					//if(
					/* $targetPersen=0; $kinerjaPersen=0; $andalPersen=0;
					$targetSum =0; $kinerjaSum=0; $andalSum=0; */
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
				
					
				
				$response->rows[$i]['kke12_e1_id']=$row->kke12_e1_id;
				$response->rows[$i]['kode_sasaran_e1']=$row->kode_sasaran_e1;
				$response->rows[$i]['tahun']=$row->tahun;
				$response->rows[$i]['kode_iku_e1']=$row->kode_iku_e1;
				
				$response->rows[$i]['sasaran_tepat']=$row->sasaran_tepat;
				$response->rows[$i]['sasaran_tepat_nilai']=$this->utility->cekNumericFmt($row->sasaran_tepat_nilai,2);
				$response->rows[$i]['ik_tepat']=$row->ik_tepat;
				$response->rows[$i]['ik_tepat_nilai']=$this->utility->cekNumericFmt($row->ik_tepat_nilai,2);
				$response->rows[$i]['target_tercapai']=$row->target_tercapai;
				$response->rows[$i]['target_tercapai_nilai']=$this->utility->cekNumericFmt($row->target_tercapai_nilai,2);
				$response->rows[$i]['kinerja_baik']=$row->kinerja_baik;				
				$response->rows[$i]['kinerja_baik_nilai']=$this->utility->cekNumericFmt($row->kinerja_baik_nilai,2);
				$response->rows[$i]['data_andal']=$row->data_andal;
				$response->rows[$i]['data_andal_nilai']=$this->utility->cekNumericFmt($row->data_andal_nilai,2);
				//$this->getIndex('target_tercapai',$row->tahun,$row->kode_sasaran_e1,$row->kode_iku_e1);//$this->utility->cekNumericFmt($row->target);
				
				$sumSasaran += $row->sasaran_tepat_nilai;	
				$sumIk += $row->ik_tepat_nilai;	
				$sumTarget += $row->target_tercapai_nilai;	
				$sumKinerja+= $row->kinerja_baik_nilai;	
				$sumAndal += $row->data_andal_nilai;	
				
//utk kepentingan export excel ==========================
				//$row->program = $program[0].", ".$program[1];
			//============================================================
			//utk kepentingan export pdf===================
				$pdfdata[] = array($no,$response->rows[$i]['sasaran_strategis'],$response->rows[$i]['no_indikator'],$response->rows[$i]['indikator_kinerja'],$response->rows[$i]['sasaran_tepat'],$response->rows[$i]['sasaran_tepat_nilai'],$response->rows[$i]['ik_tepat'],$response->rows[$i]['ik_tepat_nilai'],$response->rows[$i]['target_tercapai'],$response->rows[$i]['target_tercapai_nilai'],$response->rows[$i]['kinerja_baik'],$response->rows[$i]['kinerja_baik_nilai'],$response->rows[$i]['data_andal'],$response->rows[$i]['data_andal_nilai']);
			//============================================================
	
				$i++;
			} 
			
			//utk baris terakhir ga ke print makanya taro diluar looping 
			$response->rows[$rowIdxPersen]['target_tercapai_persen']=$this->utility->cekNumericFmt($targetPersen*100,2);
			$response->rows[$rowIdxPersen]['kinerja_baik_persen']=$this->utility->cekNumericFmt($kinerjaPersen*100,2);
			$response->rows[$rowIdxPersen]['data_andal_persen']=$this->utility->cekNumericFmt($andalPersen*100,2);
			
			$response->lastNo = $no;
			$rataSasaran=$sumSasaran/$i;
			$rataIk=$sumIk/$i;
			$rataTarget=$sumTarget/$i;
			$rataKinerja=$sumKinerja/$i;
			$rataAndal=$sumAndal/$i;
		//	$query->free_result();
		}else {
				//$response->rows[$count]['id_rkt_kl']=$row->id_rkt_kl;
				$response->rows[$count]['no']= "";
				$response->rows[$count]['no_indikator']= "";
				$response->rows[$count]['indikator_kinerja']='';
				$response->rows[$count]['sasaran_strategis']='';
				$response->rows[$count]['sasaran_tepat']='';
				$response->rows[$count]['sasaran_tepat_nilai']='';
				$response->rows[$count]['ik_tepat']='';
				$response->rows[$count]['ik_tepat_nilai']='';
				$response->rows[$count]['target_tercapai']='';
				$response->rows[$count]['target_tercapai_nilai']='';
				$response->rows[$count]['kinerja_baik']='';
				$response->rows[$count]['kinerja_baik_nilai']='';
				$response->rows[$count]['data_andal']='';
				$response->rows[$count]['data_andal_nilai']='';				
				$response->lastNo = 0;
				
		}

		$response->footer[0]['indikator_kinerja']='<b>Persentase pemenuhan kriteria</b>';
		$response->footer[0]['no']='';
		$response->footer[0]['pejabat']='';		
		$response->footer[0]['no_indikator']='';
		//$response->footer[0]['sasaran_tepat_nilai']='<b>'.$this->utility->cekNumericFmt($rataSasaran,2).' %</b>';
		//$response->footer[0]['ik_tepat_nilai']='<b>'.$this->utility->cekNumericFmt($rataIk,2).' %</b>';
		$response->footer[0]['target_tercapai_persen']='<b>'.$this->utility->cekNumericFmt($rataTarget*100,2).' %</b>';
		$response->footer[0]['kinerja_baik_persen']='<b>'.$this->utility->cekNumericFmt($rataKinerja*100,2).' %</b>';
		$response->footer[0]['data_andal_persen']='<b>'.$this->utility->cekNumericFmt($rataAndal*100,2).' %</b>';

		
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
		//$this->db->from('tbl_kke1_2_e1');
		//$this->db->select("select sasaran.deskripsi as sasaran_srategis, iku.deskripsi as indikator_kinerja, rkt.target",false);
	//	$this->db->from('tbl_kke1_2_e1 kke inner join tbl_iku_eselon1 iku on kke.kode_iku_e1 = iku.kode_iku_e1 and kke.tahun=iku.tahun inner join tbl_sasaran_eselon1 sasaran on sasaran.kode_sasaran_e1 = iku.kode_sasaran_e1 and sasaran.tahun=iku.tahun', false);
		$this->db->from('tbl_rkt_eselon1 rkt inner join tbl_iku_eselon1 iku on iku.kode_iku_e1 = rkt.kode_iku_e1 and rkt.tahun = iku.tahun
inner join tbl_sasaran_eselon1 sasaran on sasaran.kode_sasaran_e1 = rkt.kode_sasaran_e1 and sasaran.tahun=rkt.tahun left join tbl_kke1_2_e1 lke on rkt.kode_sasaran_e1=lke.kode_sasaran_e1 and rkt.tahun=lke.tahun and rkt.kode_iku_e1=lke.kode_iku_e1', false);
		return $this->db->count_all_results();
		$this->db->free_result();
	}
	
	public function InsertOnDb($data,& $error) {
		//query insert data		
		$this->db->set('tahun',$data['tahun']);
		$this->db->set('kode_sasaran_e1',$data['kode_sasaran_e1']);
		$this->db->set('kode_iku_e1',$data['kode_iku_e1']);
		
		$this->db->set('sasaran_tepat',$data['sasaran_tepat']);
		$this->db->set('sasaran_tepat_nilai',$data['sasaran_tepat_nilai']);
		$this->db->set('ik_tepat',$data['ik_tepat']);
		$this->db->set('ik_tepat_nilai',$data['ik_tepat_nilai']);
		$this->db->set('target_tercapai',$data['target_tercapai']);	
		$this->db->set('target_tercapai_nilai',$data['target_tercapai_nilai']);	
		$this->db->set('kinerja_baik',$data['kinerja_baik']);	
		$this->db->set('kinerja_baik_nilai',$data['kinerja_baik_nilai']);	
		$this->db->set('data_andal',$data['data_andal']);	
		$this->db->set('data_andal_nilai',$data['data_andal_nilai']);	
		$this->db->set('log_insert', 		$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
		
		$result = $this->db->insert('tbl_kke1_2_e1');
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
		
		$this->db->where('kke12_e1_id',$kode);
		
		$this->db->set('tahun',$data['tahun']);
		$this->db->set('kode_sasaran_e1',$data['kode_sasaran_e1']);
		$this->db->set('kode_iku_e1',$data['kode_iku_e1']);
		
		$this->db->set('sasaran_tepat',$data['sasaran_tepat']);
		$this->db->set('sasaran_tepat_nilai',$data['sasaran_tepat_nilai']);
		$this->db->set('ik_tepat',$data['ik_tepat']);
		$this->db->set('ik_tepat_nilai',$data['ik_tepat_nilai']);
		$this->db->set('target_tercapai',$data['target_tercapai']);	
		$this->db->set('target_tercapai_nilai',$data['target_tercapai_nilai']);	
		$this->db->set('kinerja_baik',$data['kinerja_baik']);	
		$this->db->set('kinerja_baik_nilai',$data['kinerja_baik_nilai']);	
		$this->db->set('data_andal',$data['data_andal']);	
		$this->db->set('data_andal_nilai',$data['data_andal_nilai']);	
		$this->db->set('log_update', 		$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
		
		$result=$this->db->update('tbl_kke1_2_e1');
		
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
		$this->db->from('tbl_kke1_2_e1');
		//$e2 = $this->session->userdata('unit_kerja_e2');
		/* if (($e2!="-1")&&($e2!=null)){
			$this->db->where('kode_e2',$e2);
			//$value = $e1;
		} */
		$this->db->order_by('tahun');		
		$que = $this->db->get();		
		$out = '<select name="filter_tahun'.$objectId.'" id="filter_tahun'.$objectId.'">';	
		foreach($que->result() as $r){
			$out .= '<option value="'.$r->tahun.'">'.$r->tahun.'</option>';
		}
				
		//chan
		if ($que->num_rows()==0){
			$out .= '<option value="'.date('Y').'">'.date('Y').'</option>';
		}		
		$out .= '</select>';		
		echo $out;
	}
	
	
	

	
	public function getIndex($field,$tahun,$kode_sasaran,$kode_iku){
		$this->db->flush_cache();
		$this->db->select($field.' as idx',false);
		$this->db->from('tbl_kke1_2_e1');
		$this->db->where('kode_iku_e1', $kode_iku);
		$this->db->where('kode_sasaran_e1', $kode_sasaran);
		$this->db->where('tahun', $tahun);
		$query = $this->db->get();
		if ($query->num_rows()>0)
			return $query->row()->idx;
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
