<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Dsb_e2_model extends CI_Model
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
	

public function easyGridE2($filtahun,$file1,$file2,$purpose=1){
		
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;  
		
		$count = $this->GetRecordCountE2($file1,$file2);
		$response = new stdClass();
		$response->total = $count;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'kode_e1';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;  
		$pdfdata = array();
		if ($count>0){
			$this->db->order_by($sort." ".$order );
			$this->db->limit($limit,$offset);
			$e1 = $this->session->userdata('unit_kerja_e1');
			if (($e1!=-1)&&($e1!=null)){
				$this->db->where('tbl_eselon2.kode_e1',$e1);
				//$value = $e1;
			}
			if (($file1!=-1)&&($file1!=null)){
				$this->db->where('tbl_eselon2.kode_e1',$file1);
			}
			if (($file2!=-1)&&($file2!=null)){
				$this->db->where('tbl_eselon2.kode_e2',$file2);
			}
			$this->db->select("kode_e2 as \"kode_e2\", tbl_eselon2.kode_e1 as \"kode_e1\", nama_e2 as \"nama_e2\", tbl_eselon2.singkatan as \"singkatan\", tbl_eselon2.nama_direktur as \"nama_dirjen\", tbl_eselon2.nip as \"nip\", tbl_eselon2.pangkat as \"pangkat\", tbl_eselon2.gol as \"gol\", tbl_eselon1.nama_e1",false);
			$this->db->from('tbl_eselon2');
			$this->db->join('tbl_eselon1', 'tbl_eselon1.kode_e1 = tbl_eselon2.kode_e1');
			$this->db->order_by("tbl_eselon2.kode_e2 ASC, tbl_eselon2.nama_e2 ASC");
			$query = $this->db->get();
			
			$i=0;
			foreach ($query->result() as $row)
			{
				$response->rows[$i]['kode_e2']=$row->kode_e2;
				$response->rows[$i]['kode_e1']=$row->kode_e1;
				$response->rows[$i]['nama_e1']=$row->nama_e1;
				$response->rows[$i]['nama_e2']=$row->nama_e2;
				$response->rows[$i]['singkatan']=$row->singkatan;
				$response->rows[$i]['nama_dirjen']=$row->nama_dirjen;
				$response->rows[$i]['nip']=$row->nip;
				$response->rows[$i]['pangkat']=$row->pangkat;
				$response->rows[$i]['gol']=$row->gol;
				$row->tercapai = $this->getPersen($filtahun,$row->kode_e2,true);
				$response->rows[$i]['tercapai']= $row->tercapai;
				$row->tdk_tercapai = $this->getPersen($filtahun,$row->kode_e2,false);
				$response->rows[$i]['tdk_tercapai']= $row->tdk_tercapai;
				//$this->utility->cekNumericFmt($row->target);								
				$this->dataPie[] = array("Tercapai"=>$row->tercapai,"Tidak Tercapai"=>$row->tdk_tercapai);
				$response->pies = $this->dataPie;

				//$pdfdata[] = array($i+1,$response->rows[$i]['kode_e1'],$response->rows[$i]['kode_kl'],$response->rows[$i]['nama_e1'],$response->rows[$i]['singkatan'],$response->rows[$i]['nama_dirjen'],$response->rows[$i]['nip'],$response->rows[$i]['pangkat'],$response->rows[$i]['gol']);
				if ($purpose==2){
					$pdfdata['data'][] = array($i+1,$response->rows[$i]['nama_e2'],$response->rows[$i]['singkatan'],$response->rows[$i]['nama_dirjen'],$response->rows[$i]['nip'],$response->rows[$i]['pangkat'],$response->rows[$i]['gol'],$response->rows[$i]['kode_e2']);
					$pdfdata['pies'][] = array("tercapai"=>(double)$row->tercapai,"tdk_tercapai"=>(double)$row->tdk_tercapai);
					unset($row->nama_e1);
					
				}
				
				$i++;
			} 
			
			//$query->free_result();
		}else {
				$response->rows[$count]['kode_e1']='';
				$response->rows[$count]['kode_e2']='';
				$response->rows[$count]['nama_e2']='';
				$response->rows[$count]['nama_e1']='';
				$response->rows[$count]['singkatan']='';
				$response->rows[$count]['nama_dirjen']='';
				$response->rows[$count]['nip']='';
				$response->rows[$count]['pangkat']='';
				$response->rows[$count]['gol']='';
		}
		
		if ($purpose==1) //grid normal
			return json_encode($response);
		else if($purpose==2){//pdf
			return $pdfdata;
		}
		else if($purpose==3){//to excel
			//tambahkan header kolom
			$colHeaders = array("Kode E2","Kode E1","Nama","Singkatan","Nama Pimpinan","NIP","Pangkat","Golongan");
		//	$query =$this->db->list_fields('tbl_eselon1');
			//$query->list_fields();
		//	var_dump($query);die;
			to_excel($query,"Eselon2",$colHeaders);
		}
	
	}
	
	//jumlah data record buat paging
	public function GetRecordCountE2($file1=null,$file2=null){
		$e1 = $this->session->userdata('unit_kerja_e1');
		if (($e1!=-1)&&($e1!=null)){
			$this->db->where('kode_e1',$e1);
			//$value = $e1;
		}
		if (($file1!=-1)&&($file1!=null)){
			$this->db->where('kode_e1',$file1);
		}
		if (($file2!=-1)&&($file2!=null)){
			$this->db->where('kode_e2',$file2);
		}
		$query=$this->db->from('tbl_eselon2');
		return $this->db->count_all_results();
		$this->db->free_result();
	}
	
	// purpose : 1=buat grid, 2=buat pdf, 3=buat excel
	public function easyGrid($filtahun=null,$file2=null,$purpose=1){
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
		
		$count = $this->GetRecordCount($filtahun,$file2);
		$response = new stdClass();
		$response->total = $count;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'iku.kode_ikk';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
		$offset = ($page-1)*$limit;  
		$pdfdata = array();
		$this->dataPie = array();
		if ($count>0){
		 	if($filtahun != '' && $filtahun != '0' && $filtahun != '-1' && $filtahun != null) {
				//$this->db->where("tbl_pengukuran_eselon2.tahun",$filtahun);
				
			}		
		 	$this->db->where("tbl_pengukuran_eselon2.kode_e2",$file2);
			
			
			//$this->db->order_by($sort." ".$order );
			$this->db->order_by("tbl_pengukuran_eselon2.tahun");
			//$this->db->order_by("iku.deskripsi");
			
			//hanya utk grid saja
			//if ($purpose==1) $this->db->limit($limit,$offset);
			
			$this->db->select("tbl_ikk.deskripsi,tbl_ikk.satuan,tbl_pengukuran_eselon2.persen,tbl_pengukuran_eselon2.kode_e2",false);
			
			$this->db->from('tbl_pengukuran_eselon2 inner join tbl_eselon2 on tbl_pengukuran_eselon2.kode_e2 = tbl_eselon2.kode_e2 inner join tbl_ikk on tbl_ikk.kode_ikk=tbl_pengukuran_eselon2.kode_ikk and tbl_pengukuran_eselon2.tahun=tbl_ikk.tahun',false);
			//$this->db->group_by('tahun,kode_e1, nama_e1',false);
			$query = $this->db->get();
			
			$i=0;
			
			//$no = ($page-1)*$limit;//$lastNo;
			//var_dump();
			//$noIndikator =0;
			$jumlah =0;
			$response->pies['tercapai'] = array();
			$response->pies['tdk_tercapai'] = array();
			$memenuhi = 0;$tdkmemenuhi=0;
			$old_kodee1 = '';
			foreach ($query->result() as $row){
				//$no++;			
				$response->rows[$i]['deskripsi']=$row->deskripsi;				
				$response->rows[$i]['satuan']=$row->satuan;				
				$response->rows[$i]['persen']=$this->utility->cekNumericFmt($row->persen);				
				$response->rows[$i]['status']=$row->persen;				
				//$row->tercapai = $this->getPersen($filtahun,$row->kode_kl,true);
/*
				if ($old_kodee1!=$row->kode_e1){
					$old_kodee1 = $row->kode_e1;
					$memenuhi += $this->getPersen($filtahun,$old_kodee1,true);
					$tdkmemenuhi += $this->getPersen($filtahun,$old_kodee1,false);
				}
*/
/*
				$response->rows[$i]['tahun']=$filtahun;//$row->tahun;				
				$response->rows[$i]['kode_e1']=$row->kode_e1;				
				$response->rows[$i]['nama_e1']=$row->nama_e1;	
				$row->jml_iku =  $this->getJmlIku($filtahun,$row->kode_e1);			
				$response->rows[$i]['jml_iku']=$row->jml_iku;				
				*/
				

			//	$response->pies['tercapai'] = array_merge($response->pies['tercapai'], array($row->nama_e1=>$row->tercapai));
				//$response->pies['tdk_tercapai'] =array_merge($response->pies['tdk_tercapai'], array($row->nama_e1=>$row->tdk_tercapai));
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
			if ($purpose==2)
				$pdfdata[] = array($response->rows[$i]['deskripsi'],$response->rows[$i]['satuan'],$response->rows[$i]['persen'],$response->rows[$i]['status']);
			//============================================================
			
				$i++;
			} 
/*
			$this->dataPie = array("tercapai"=>$memenuhi,"tdk_tercapai"=>$tdkmemenuhi);
				$response->pies = $this->dataPie;
*/
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
	
	public function GetRecordCount($filtahun=null,$file2=null){
		$where = '';
		 if($filtahun != '' && $filtahun != '0' && $filtahun != '-1' && $filtahun != null) {
			 
			 $this->db->where("tbl_pengukuran_eselon2.tahun",$filtahun);
		 }		
			$this->db->where("tbl_pengukuran_eselon2.kode_e2",$file2);
		
			$this->db->select("tbl_ikk.deskripsi,tbl_ikk.satuan,tbl_pengukuran_eselon2.persen,tbl_pengukuran_eselon2.kode_e2",false);
			
			$this->db->from('tbl_pengukuran_eselon2 inner join tbl_eselon2 on tbl_pengukuran_eselon2.kode_e2 = tbl_eselon2.kode_e2 inner join tbl_ikk on tbl_ikk.kode_ikk=tbl_pengukuran_eselon2.kode_ikk and tbl_pengukuran_eselon2.tahun=tbl_ikk.tahun',false);
		
//			$this->db->group_by('tahun,kode_e1, nama_e1',false);
		$q = $this->db->get();
		return $q->num_rows(); 
		//return $this->db->count_all_results();
		//$this->db->free_result();
	}
	
	public function getListTahun($objectId){
		
		$this->db->flush_cache();
		$this->db->select('distinct tahun',false);
		$this->db->from('tbl_kinerja_eselon2');
		
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
		$this->db->select('count(tbl_pengukuran_eselon2.kode_ikk) as jumlah',false);
		$this->db->from('tbl_pengukuran_eselon2');
		//$this->db->where('persen '.($isTercapai?">=":"<"), 100);
		$this->db->where('tahun', $tahun);
		$this->db->where('kode_e2', $kode_e2);
		$query = $this->db->get();
		if ($query->num_rows()>0)
			return $query->row()->jumlah;
		else return 0;
		
	}
	
	public function getPersen($tahun,$kode_e2,$isTercapai){
		$this->db->flush_cache();
		$this->db->select('count(*) as jumlah',false);
		$this->db->from('tbl_pengukuran_eselon2');
		$this->db->where('persen '.($isTercapai?">=":"<"), 100);
		$this->db->where('tahun', $tahun);
		$this->db->where('kode_e2', $kode_e2);
		$query = $this->db->get();
		if ($query->num_rows()>0)
			return $query->row()->jumlah;
		else return 0;
		
	}
}
?>
