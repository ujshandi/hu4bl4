<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Monitoring_e2_model extends CI_Model
{	
	/**
	* constructor
	*/
	
	var $dataPie = array();
	public function __construct()
    {
        parent::__construct();
		//$this->CI =& get_instance();
    }
	
	// purpose : 1=buat grid, 2=buat pdf, 3=buat excel
	public function easyGrid($filtahun=null,$filperiode=null,$purpose=1){
		$lastNo = isset($_POST['lastNo']) ? intval($_POST['lastNo']) : 0;  
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;  
		
		//jika utk pdf & excel maka paging ambil dari parameter
		if (($purpose==2)||($purpose==3)){
			$page = isset($pageNumber) ? intval($pageNumber) : 1;  
			$limit = isset($pageSize) ? intval($pageSize) : 10;  
			//var_dump($pageNumber);
		//	var_dump($pageSize);
		}
		
		$count = $this->GetRecordCount($filtahun);
		$response = new stdClass();
		$response->total = $count;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'iku.kode_ikk';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;  
		$pdfdata = array();
		$this->dataPie = array();
		if ($count>0){
		 	if($filtahun != '' && $filtahun != '0' && $filtahun != '-1' && $filtahun != null) {
				//$this->db->where("tbl_checkpoint_e2.tahun",$filtahun);
			}		
		 	
			
			
			//$this->db->order_by($sort." ".$order );
			$this->db->order_by("tbl_pk_eselon2.kode_e2");
			//$this->db->order_by("iku.deskripsi");
			
			//hanya utk grid saja
			//if ($purpose==1) $this->db->limit($limit,$offset);
			
			$this->db->select("distinct tbl_pk_eselon2.kode_e2, tbl_eselon2.nama_e2,0 as jml_iku,
0 as seratus,0 as seratus_lebih,0 as seratus_kurang",false);
			
			$this->db->from('tbl_checkpoint_e2 right join tbl_pk_eselon2 on tbl_checkpoint_e2.id_pk_e2=tbl_pk_eselon2.id_pk_e2 inner join tbl_eselon2 on tbl_pk_eselon2.kode_e2 = tbl_eselon2.kode_e2 ',false);
			//$this->db->group_by('tbl_pk_eselon2.tahun,tbl_pk_eselon2.kode_e2, nama_e2',false);
			$query = $this->db->get();
			
			$i=0;
			
			//$no = ($page-1)*$limit;//$lastNo;
			//var_dump();
			//$noIndikator =0;
			$jumlah =0;
			$response->pies['tercapai'] = array();
			$response->pies['tdk_tercapai'] = array();
			foreach ($query->result() as $row){
				//$no++;			
				
				$response->rows[$i]['tahun']=$filtahun;//$row->tahun;				
				$response->rows[$i]['kode_e2']=$row->kode_e2;				
				$response->rows[$i]['nama_e2']=$row->nama_e2;	
				$row->jml_iku =  $this->getJmlIku($filtahun,$row->kode_e2);			
				$response->rows[$i]['jml_iku']=$row->jml_iku;				
				$row->sangat_puas = $this->getPersen($filtahun,$row->kode_e2,'sangat_puas',$filperiode);
				$response->rows[$i]['sangat_puas']= $row->sangat_puas;
				$row->puas = $this->getPersen($filtahun,$row->kode_e2,'puas',$filperiode);
				$response->rows[$i]['puas']= $row->puas;
				$row->kurang_puas = $this->getPersen($filtahun,$row->kode_e2,'kurang_puas',$filperiode);
				$response->rows[$i]['kurang_puas']= $row->kurang_puas;
				$row->kecewa = $this->getPersen($filtahun,$row->kode_e2,'kecewa',$filperiode);
				$response->rows[$i]['kecewa']= $row->kecewa;
/*
				$row->seratus = $this->getPersen($filtahun,$row->kode_e2,100,$filperiode);
				$response->rows[$i]['seratus']= $row->seratus;
				$row->seratus_lebih = $this->getPersen($filtahun,$row->kode_e2,101,$filperiode);
				$response->rows[$i]['seratus_lebih']= $row->seratus_lebih;
				$row->seratus_kurang = $this->getPersen($filtahun,$row->kode_e2,99,$filperiode);
				$response->rows[$i]['seratus_kurang']= $row->seratus_kurang;
*/
				//$this->utility->cekNumericFmt($row->target);								
				//$this->dataPie = array("100%"=>(int)$row->seratus,">100%"=>(int)$row->seratus_lebih,"<100%"=>(int)$row->seratus_kurang);
					$this->dataPie = array("Sangat Memuaskan"=>(int)$row->sangat_puas,"Memuaskan"=>(int)$row->puas,"Kurang Memuaskan"=>(int)$row->kurang_puas,"Mengecewakan"=>(int)$row->kecewa);
				$response->pies = $this->dataPie;
			//	$response->pies['tercapai'] = array_merge($response->pies['tercapai'], array($row->nama_e2=>$row->tercapai));
				//$response->pies['tdk_tercapai'] =array_merge($response->pies['tdk_tercapai'], array($row->nama_e2=>$row->tdk_tercapai));
			//utk kepentingan export excel ==========================
/*
				$row->target = $response->rows[$i]['target'];
				
				$row->realiasi=$response->rows[$i]['realisasi'];
				$row->persen=$response->rows[$i]['persen'];
				unset($row->kode_ikk);
				unset($row->realisasi);
*/
			//============================================================
			//utk kepentingan export pdf===================
				//$pdfdata[] = array($no,$response->rows[$i]['indikator_kinerja'],$response->rows[$i]['satuan'],$response->rows[$i]['target'],$response->rows[$i]['bulan1'],$response->rows[$i]['bulan2'],$response->rows[$i]['bulan3'],$response->rows[$i]['bulan4'],$response->rows[$i]['bulan5'],$response->rows[$i]['bulan6'],$response->rows[$i]['bulan7'],$response->rows[$i]['bulan8'],$response->rows[$i]['bulan9'],$response->rows[$i]['bulan10'],$response->rows[$i]['bulan11'],$response->rows[$i]['bulan12'],$response->rows[$i]['persen']);
			//============================================================
			
				$i++;
			} 
			//$response->lastNo = $no;
			//$query->free_result();
		}else {
				
				$response->rows[$count]['tahun']= "";
				$response->rows[$count]['kode_e2']= "";
				$response->rows[$count]['nama_e2']='';
				$response->rows[$count]['jml_iku']='';
				$response->rows[$count]['seratus']='';
				$response->rows[$count]['seratus_lebih']='';
				$response->rows[$count]['seratus_kurang']='';
				

		}
		
		if ($purpose==1) //grid normal
			return json_encode($response);
		else if($purpose==2){//pdf
			return $pdfdata;
		}
		else if($purpose==3){//to excel
			//tambahkan header kolom
			$colHeaders = array("Indikator Kinerja Utama","Satuan","Target","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktorber","November","Desember","Realisasi Persen");		
			to_excel($query,"CapaianKinerjaKl",$colHeaders);
		}
		
	}
	
	public function GetRecordCount($filtahun=null,$filperiode=null){
		$where = '';
		 if($filtahun != '' && $filtahun != '0' && $filtahun != '-1' && $filtahun != null) {
			 
			 //$this->db->where("tbl_checkpoint_e2.tahun",$filtahun);
		 }		
			
			if($filperiode != '' && $filperiode != '0' && $filperiode != '-1' && $filperiode != null) {
				//$this->db->where("tbl_checkpoint_e2.periode",$filperiode);
			}
		$this->db->select("distinct tbl_pk_eselon2.kode_e2, tbl_eselon2.nama_e2",false);
			
			$this->db->from('tbl_checkpoint_e2 right join tbl_pk_eselon2 on tbl_checkpoint_e2.id_pk_e2=tbl_pk_eselon2.id_pk_e2 inner join tbl_eselon2 on tbl_pk_eselon2.kode_e2 = tbl_eselon2.kode_e2 ',false);
			//$this->db->group_by('tahun,kode_e2, nama_e2',false);
		$q = $this->db->get();
		//return $q->row()->num_rows; 
		return $this->db->count_all_results();
		//$this->db->free_result();
	}
	
	public function getListTahun($objectId){
		
		$this->db->flush_cache();
		$this->db->select('distinct tahun',false);
		$this->db->from('tbl_pk_eselon2');
		
		$this->db->order_by('tahun');
		
		$que = $this->db->get();
		
		$out = '<select name="filter_tahun'.$objectId.'" id="filter_tahun'.$objectId.'">';
	//	$out .= '<option value="-1">Semua</option>';
		foreach($que->result() as $r){
			$out .= '<option value="'.$r->tahun.'">'.$r->tahun.'</option>';
		}
		
		$out .= '</select>';
		//chan
		if ($que->num_rows()==0){
			$out = "Data Kinerja belum tersedia.";
		}
		echo $out;
	}
	
	public function getJmlIku($tahun,$kode_e2){
		$this->db->flush_cache();
		$this->db->select('count(tbl_pk_eselon2.kode_ikk) as jumlah',false);
			$this->db->from('tbl_checkpoint_e2 inner join tbl_pk_eselon2 on tbl_checkpoint_e2.id_pk_e2=tbl_pk_eselon2.id_pk_e2',false);
		//$this->db->where('persen '.($isTercapai?">=":"<"), 100);
		$this->db->where('tbl_pk_eselon2.tahun', $tahun);
		$this->db->where('tbl_pk_eselon2.kode_e2', $kode_e2);
		$query = $this->db->get();
		if ($query->num_rows()>0)
			return $query->row()->jumlah;
		else return 0;
		
	}
	
	public function getPersen($tahun,$kode_e2,$capaian,$periode){
		$this->db->flush_cache();
		$this->db->select('count(*) as jumlah',false);
		$this->db->from('tbl_checkpoint_e2 inner join tbl_pk_eselon2 on tbl_checkpoint_e2.id_pk_e2=tbl_pk_eselon2.id_pk_e2',false);
/*
		if ($capaian==100) $this->db->where("tbl_checkpoint_e2.target = tbl_checkpoint_e2.capaian");
		if ($capaian==101) $this->db->where("tbl_checkpoint_e2.capaian > tbl_checkpoint_e2.target");
		if ($capaian==99) $this->db->where("tbl_checkpoint_e2.capaian < tbl_checkpoint_e2.target");
*/
		switch ($capaian) {
			case 'sangat_puas' : $this->db->where("((tbl_checkpoint_e2.capaian/tbl_checkpoint_e2.target)*100)>100");break;
			case 'puas' : $this->db->where("((tbl_checkpoint_e2.capaian/tbl_checkpoint_e2.target)*100) between 76 and 100");break;
			case 'kurang_puas' : $this->db->where("((tbl_checkpoint_e2.capaian/tbl_checkpoint_e2.target)*100) between 50 and 75");break;
			case 'kecewa' : $this->db->where("((tbl_checkpoint_e2.capaian/tbl_checkpoint_e2.target)*100)<50");break;
		}
		$this->db->where('tahun', $tahun);
		$this->db->where('kode_e2', $kode_e2);
		$this->db->where('tbl_checkpoint_e2.periode', $periode);
		$query = $this->db->get();
		if ($query->num_rows()>0)
			return $query->row()->jumlah;
		else return 0;
		
	}
}
?>
