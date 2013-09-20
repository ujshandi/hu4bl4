<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Dsb_kl_model extends CI_Model
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
	public function easyGrid($filtahun=null,$purpose=1){
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
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'iku.kode_iku_kl';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;  
		$pdfdata = array();
		$this->dataPie = array();
		if ($count>0){
		 	if($filtahun != '' && $filtahun != '0' && $filtahun != '-1' && $filtahun != null) {
				$this->db->where("tbl_pengukuran_kl.tahun",$filtahun);
			}		
		 	
			
			
			//$this->db->order_by($sort." ".$order );
			$this->db->order_by("tbl_pengukuran_kl.tahun");
			//$this->db->order_by("iku.deskripsi");
			
			//hanya utk grid saja
			if ($purpose==1) $this->db->limit($limit,$offset);
			//$this->db->distinct();
			/*select tbl_pengukuran_kl.tahun,tbl_pengukuran_kl.kode_kl, tbl_kl.nama_kl,count(tbl_pengukuran_kl.kode_iku_kl) as jml_iku,
0 as tercapai,0 as tdk_tercapai
from tbl_pengukuran_kl inner join tbl_kl
group by tahun,kode_kl, nama_kl*/
			//$this->db->select("iku.deskripsi as indikator_kinerja,iku.satuan,rkt.realisasi,pk.target,case  when rkt.triwulan  =1 then rkt.realisasi else 0 end  as triwulan1,case  when rkt.triwulan  =2 then rkt.realisasi else 0 end  as triwulan2,case  when rkt.triwulan  =3 then rkt.realisasi else 0 end  as triwulan3,case  when rkt.triwulan  =4 then rkt.realisasi else 0 end  as triwulan4",false);
			$this->db->select("tbl_iku_kl.deskripsi,tbl_iku_kl.satuan,tbl_pengukuran_kl.persen,tbl_pengukuran_kl.kode_kl",false);
			
			$this->db->from('tbl_pengukuran_kl inner join tbl_kl on tbl_pengukuran_kl.kode_kl = tbl_kl.kode_kl inner join tbl_iku_kl on tbl_iku_kl.kode_iku_kl=tbl_pengukuran_kl.kode_iku_kl and tbl_pengukuran_kl.tahun=tbl_iku_kl.tahun',false);
			//$this->db->group_by('tahun,kode_kl, nama_kl',false);
			$query = $this->db->get();
			
			$i=0;
			
			//$no = ($page-1)*$limit;//$lastNo;
			//var_dump();
			//$noIndikator =0;
			$jumlah =0;
			$memenuhi = 0;$tdkmemenuhi=0;
			$old_kodekl = '';
			foreach ($query->result() as $row){
				//$no++;			
				
				
				
				
				$response->rows[$i]['deskripsi']=$row->deskripsi;				
				$response->rows[$i]['satuan']=$row->satuan;				
				$response->rows[$i]['persen']=$this->utility->cekNumericFmt($row->persen);				
				$response->rows[$i]['status']=$row->persen;				
				//$row->tercapai = $this->getPersen($filtahun,$row->kode_kl,true);
				if ($old_kodekl!=$row->kode_kl){
					$old_kodekl = $row->kode_kl;
					$memenuhi += $this->getPersen($filtahun,$old_kodekl,true);
					$tdkmemenuhi += $this->getPersen($filtahun,$old_kodekl,false);
				}
				//$response->rows[$i]['tercapai']= $row->tercapai;
				//$row->tdk_tercapai = $this->getPersen($filtahun,$row->kode_kl,false);
				
				//$response->rows[$i]['tdk_tercapai']= $row->tdk_tercapai;
				
/*
				if ((int)$row->persen>=100)
					$memenuhi++;
				else 
				    $tdkmemenuhi++;
*/
				
				
			//utk kepentingan export excel ==========================
/*
				$row->target = $response->rows[$i]['target'];
				
				$row->realiasi=$response->rows[$i]['realisasi'];
				$row->persen=$response->rows[$i]['persen'];
				unset($row->kode_iku_kl);
				unset($row->realisasi);
*/
			//============================================================
			//utk kepentingan export pdf===================
			$this->dataPie = array("Jumlah Memenuhi"=>$memenuhi,"Jumlah Tidak Memenuhi"=>$tdkmemenuhi);
				$response->pies = $this->dataPie;
			if ($purpose==2)
				$pdfdata['data'][] = array($response->rows[$i]['deskripsi'],$response->rows[$i]['satuan'],$response->rows[$i]['persen'],$response->rows[$i]['status']);
			//============================================================
			
				$i++;
			} 
			$pdfdata['pies'] = $this->dataPie;
			
		//	var_dump($this->dataPie);die;
			//$response->lastNo = $no;
			//$query->free_result();
		}else {
				
				$response->rows[$count]['deskripsi']= "";
				$response->rows[$count]['capaian']= "";
				$response->rows[$count]['persen']='';
				$response->rows[$count]['status']='';
				$response->rows[$count]['no']='';
				$response->rows[$count]['satuan']='';
				

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
	
	public function GetRecordCount($filtahun=null){
		$where = '';
		 if($filtahun != '' && $filtahun != '0' && $filtahun != '-1' && $filtahun != null) {
			 
			 $this->db->where("tbl_pengukuran_kl.tahun",$filtahun);
		 }		
			
		
		$this->db->select("tbl_iku_kl.deskripsi,tbl_iku_kl.satuan,tbl_pengukuran_kl.persen",false);
			
			$this->db->from('tbl_pengukuran_kl inner join tbl_kl on tbl_pengukuran_kl.kode_kl = tbl_kl.kode_kl inner join tbl_iku_kl on tbl_iku_kl.kode_iku_kl=tbl_pengukuran_kl.kode_iku_kl and tbl_pengukuran_kl.tahun=tbl_iku_kl.tahun',false);
			//$this->db->group_by('tahun,kode_kl, nama_kl',false);
		$q = $this->db->get();
		return $q->num_rows(); 
		//return $this->db->count_all_results();
		//$this->db->free_result();
	}
	
	public function getListTahun($objectId,$filtahun=null){
		
		$this->db->flush_cache();
		$this->db->select('distinct tahun',false);
		$this->db->from('tbl_kinerja_kl');
		
		$this->db->order_by('tahun');
		
		$que = $this->db->get();
		
		$out = '<select name="filter_tahun'.$objectId.'" id="filter_tahun'.$objectId.'">';
	//	$out .= '<option value="-1">Semua</option>';
		$selected ="";
		
		foreach($que->result() as $r){
			if ($filtahun!=null) 
				$selected = ($filtahun==$r->tahun?"selected='selected'":"");
			
			$out .= '<option value="'.$r->tahun.'" '.$selected.'>'.$r->tahun.'</option>';
		}
		
		$out .= '</select>';
		//chan
		if ($que->num_rows()==0){
			$out = "Data Kinerja belum tersedia.";
		}
		echo $out;
	}
	
	
	
	public function getPersen($tahun,$kode_kl,$isTercapai){
		$this->db->flush_cache();
		$this->db->select('count(*) as jumlah',false);
		$this->db->from('tbl_pengukuran_kl');
		$this->db->where('persen '.($isTercapai?">=":"<"), 100);
		$this->db->where('tahun', $tahun);
		$this->db->where('kode_kl', $kode_kl);
		$query = $this->db->get();
		if ($query->num_rows()>0)
			return $query->row()->jumlah;
		else return 0;
		
	}
}
?>
