<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Ongoing_e1_model extends CI_Model
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
	public function easyGrid($filtahun=null,$file1=null,$purpose=1){
		$lastNo = isset($_POST['lastNo']) ? intval($_POST['lastNo']) : 0;  
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;  
		
		$count = $this->GetRecordCount($filtahun,$file1);
		$response = new stdClass();
		$response->total = $count;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.tahun';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
		$offset = ($page-1)*$limit;  
		
		if ($count>0){
			//filter
			if($filtahun != '' && $filtahun != '-1' && $filtahun != null) {
				$this->db->where("a.tahun",$filtahun);
			}	
			if($file1 != '' && $file1 != '-1' && $file1 != null) {
				$this->db->where("a.kode_e1",$file1);
			}
			$this->db->order_by($sort." ".$order );
			if($purpose==1){$this->db->limit($limit,$offset);}
			$this->db->select('a.predefinitif_e1_id, a.tahun, a.kode_iku_e1, a.kode_e1 as rkt_kode_e1, a.kode_sasaran_e1 AS kode_sasaran_e12, b.deskripsi, a.jumlah,k.kode_kegiatan,k.nama_kegiatan');
			$this->db->select("c.deskripsi as deskripsi_sasaran_e1, b.deskripsi AS deskripsi_iku_e1, d.nama_e1");
			$this->db->from('tbl_pre_definitif_e1 a');
			$this->db->join('tbl_iku_eselon1 b', 'b.kode_iku_e1 = a.kode_iku_e1 and b.tahun = a.tahun');
			$this->db->join('tbl_sasaran_eselon1 c', 'c.kode_sasaran_e1 = a.kode_sasaran_e1 and c.tahun = a.tahun');
			$this->db->join('tbl_eselon1 d', 'd.kode_e1 = a.kode_e1');
			$this->db->join('tbl_kegiatan_kl k', 'k.kode_kegiatan = a.kode_kegiatan');
			$this->db->order_by("a.tahun DESC, a.kode_sasaran_e1 ASC, a.kode_iku_e1 ASC");
			$query = $this->db->get();
			
			$i=0;
			$no =$lastNo;
			foreach ($query->result() as $row)
			{
				$no++;
				$response->rows[$i]['no']= $no;
				$response->rows[$i]['preusulan1_e1_id']=$row->preusulan1_e1_id;
				$response->rows[$i]['tahun']=$row->tahun;
				$response->rows[$i]['kode_e1']=$row->rkt_kode_e1;
				$response->rows[$i]['nama_e1']=$row->nama_e1;
				$response->rows[$i]['kode_sasaran_e1']=$row->kode_sasaran_e1;
				$response->rows[$i]['deskripsi_sasaran_e1']=$row->deskripsi_sasaran_e1;
				$response->rows[$i]['deskripsi']=$row->deskripsi;
				$response->rows[$i]['kode_iku']=$row->kode_iku_e1;
				$response->rows[$i]['deskripsi_iku_e1']=$row->deskripsi_iku_e1;
				$response->rows[$i]['kode_kegiatan']=$row->kode_kegiatan;
				$response->rows[$i]['nama_kegiatan']=$row->nama_kegiatan;
				$response->rows[$i]['jumlah']=$this->utility->cekNumericFmt($row->jumlah);
				///$response->rows[$i]['satuan']=$row->satuan;
				//$response->rows[$i]['status']= $row->status;
				
				//utk kepentingan export excel ==========================
				// $row->keterangan = str_replace("<br>",", ",$response->rows[$i]['pejabat']);
				// $row->indikator_kinerja=$response->rows[$i]['indikator_kinerja'];
				if($file1 == '-1'){unset($row->rkt_kode_e1);}
				unset($row->preusulan1_e1_id);
				unset($row->tahun);
				//unset($row->status);
				unset($row->kode_iku_e1);
				//============================================================
					
				//utk kepentingan export pdf===================
				if($file1 != '' && $file1 != '-1' && $file1 != null)
					$pdfdata[] = array($no,$response->rows[$i]['kode_sasaran_e1'],$response->rows[$i]['deskripsi'],$response->rows[$i]['jumlah']);
				else
					$pdfdata[] = array($no,$response->rows[$i]['kode_e1'],$response->rows[$i]['kode_sasaran_e1'],$response->rows[$i]['deskripsi'],$response->rows[$i]['jumlah']);
				//============================================================
				$i++;
			} 
			
			$response->lastNo = $no;
			// $query->free_result();
		}else {
				$response->rows[$count]['no']= "";
				$response->rows[$count]['id_rkt_kl']='';
				$response->rows[$count]['tahun']='';
				$response->rows[$count]['kode_e1']='';
				$response->rows[$count]['nama_e1']='';
				$response->rows[$count]['kode_sasaran_e1']='';
				$response->rows[$count]['deskripsi_sasaran_e1']='';
				$response->rows[$count]['kode_iku']='';
				$response->rows[$count]['deskripsi_iku_e1']='';
				$response->rows[$count]['kode_kegiatan']='';
				$response->rows[$count]['nama_kegiatan']='';
				$response->rows[$count]['jumlah']='';
				//$response->rows[$count]['satuan']='';
				$response->lastNo = 0;
		}
		
		if ($purpose==1) //grid normal
			return json_encode($response);
		else if($purpose==2){//pdf
			return $pdfdata;
		}
		else if($purpose==3){//to excel
			//tambahkan header kolom
			if($file1 != '' && $file1 != '-1' && $file1 != null)
				$colHeaders = array("Kode Sasaran","Indikator Kinerja Utama","jumlah");
			else
				$colHeaders = array("Kode Eselon I","Kode Sasaran","Indikator Kinerja Utama","jumlah");	
			//	var_dump($query->result());die;
			to_excel($query,"SasaranEselon1",$colHeaders);
		}
	}
	
	public function easySubGrid($filtahun=null,$filkegiatan=null){
		$lastNo = isset($_POST['lastNo']) ? intval($_POST['lastNo']) : 0;  
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;  
		
		$count = $this->GetRecordCountSubgrid($filtahun,$filkegiatan);
		$response = new stdClass();
		$response->total = $count;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.kode_subkegiatan';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
		$offset = ($page-1)*$limit;  
		
		if ($count>0){
			//filter
			if($filtahun != '' && $filtahun != '-1' && $filtahun != null) {
				$this->db->where("a.tahun",$filtahun);
			}	
			if($filkegiatan != '' && $filkegiatan != '-1' && $filkegiatan != null) {
				$this->db->where("k.kode_kegiatan",$filkegiatan);
			}
			$this->db->order_by($sort." ".$order );
			//if($purpose==1){$this->db->limit($limit,$offset);}
			$this->db->select('a.ongoinge2_id, a.tahun, a.kode_ikk, a.kode_e2 as rkt_kode_e2, a.kode_sasaran_e2 AS kode_sasaran_e2, b.deskripsi,a.anggaran, a.jumlah,skk.kode_subkegiatan,skk.nama_subkegiatan');
			$this->db->select("c.deskripsi as deskripsi_sasaran_e2, b.deskripsi AS deskripsi_iku_e2, d.nama_e2");
			$this->db->from('tbl_ongoing_e2 a');
			$this->db->join('tbl_ikk b', 'b.kode_ikk = a.kode_ikk and b.tahun = a.tahun');
			$this->db->join('tbl_sasaran_eselon2 c', 'c.kode_sasaran_e2 = a.kode_sasaran_e2 and c.tahun = a.tahun');
			$this->db->join('tbl_eselon2 d', 'd.kode_e2 = a.kode_e2');
			$this->db->join('tbl_subkegiatan_kl skk', 'skk.kode_subkegiatan = a.kode_subkegiatan and skk.tahun=a.tahun');
			$this->db->join('tbl_kegiatan_kl k', 'k.kode_kegiatan = skk.kode_kegiatan and k.tahun=skk.tahun');
			$this->db->order_by("a.tahun DESC, a.kode_subkegiatan ASC");
			$query = $this->db->get();
			
			$i=0;
			$no =$lastNo;
			foreach ($query->result() as $row)
			{
				$no++;
				$response->rows[$i]['no']= $no;
				$response->rows[$i]['preusulan1_e1_id']=$row->ongoinge2_id;
				$response->rows[$i]['tahun']=$row->tahun;
				$response->rows[$i]['kode_e1']=$row->rkt_kode_e2;
				$response->rows[$i]['nama_e1']=$row->nama_e2;
				$response->rows[$i]['kode_sasaran_e1']=$row->kode_sasaran_e2;
				$response->rows[$i]['deskripsi_sasaran_e1']=$row->deskripsi_sasaran_e2;
				$response->rows[$i]['deskripsi']=$row->deskripsi;
				$response->rows[$i]['kode_iku']=$row->kode_ikk;
				$response->rows[$i]['deskripsi_iku_e1']=$row->deskripsi_iku_e2;
				$response->rows[$i]['kode_subkegiatan']=$row->kode_subkegiatan;
				$response->rows[$i]['nama_subkegiatan']=$row->nama_subkegiatan;

				$response->rows[$i]['jumlah']=$this->utility->cekNumericFmt($row->jumlah);
				$response->rows[$i]['anggaran']=$this->utility->cekNumericFmt($row->anggaran);
				///$response->rows[$i]['satuan']=$row->satuan;
				//$response->rows[$i]['status']= $row->status;
				
				//utk kepentingan export excel ==========================
				// $row->keterangan = str_replace("<br>",", ",$response->rows[$i]['pejabat']);
				// $row->indikator_kinerja=$response->rows[$i]['indikator_kinerja'];

				unset($row->ongoinge2_id);
				unset($row->tahun);
				//unset($row->status);
				unset($row->kode_iku_e1);
				//============================================================
					
				//utk kepentingan export pdf===================
			/* 	if($file1 != '' && $file1 != '-1' && $file1 != null)
					$pdfdata[] = array($no,$response->rows[$i]['kode_sasaran_e1'],$response->rows[$i]['deskripsi'],$response->rows[$i]['jumlah']);
				else
					$pdfdata[] = array($no,$response->rows[$i]['kode_e1'],$response->rows[$i]['kode_sasaran_e1'],$response->rows[$i]['deskripsi'],$response->rows[$i]['jumlah']); */
				//============================================================
				$i++;
			} 
			
			$response->lastNo = $no;
			// $query->free_result();
		}else {
				$response->rows[$count]['no']= "";
				$response->rows[$count]['id_rkt_kl']='';
				$response->rows[$count]['tahun']='';
				$response->rows[$count]['kode_e2']='';
				$response->rows[$count]['nama_e2']='';
				$response->rows[$count]['kode_sasaran_e2']='';
				$response->rows[$count]['deskripsi_sasaran_e2']='';
				$response->rows[$count]['kode_ikk']='';
				$response->rows[$count]['deskripsi_iku_e2']='';
				$response->rows[$count]['kode_subkegiatan']='';
				$response->rows[$count]['nama_subkegiatan']='';
				$response->rows[$count]['jumlah']='';
				//$response->rows[$count]['satuan']='';
				$response->lastNo = 0;
		}
		
		
			return json_encode($response);
		
	}
	
	public function GetRecordCount($filtahun=null,$file1){
		if($filtahun != '' && $filtahun != '-1' && $filtahun != null) {
			$this->db->where("a.tahun",$filtahun);
		}	
		if($file1 != '' && $file1 != '-1' && $file1 != null) {
			$this->db->where("a.kode_e1",$file1);
		}		
		$this->db->from('tbl_pre_usulan1_e1 a');
		$this->db->join('tbl_iku_eselon1 b', 'b.kode_iku_e1 = a.kode_iku_e1 and b.tahun = a.tahun');
		$this->db->join('tbl_sasaran_eselon1 c', 'c.kode_sasaran_e1 = a.kode_sasaran_e1');
		$this->db->join('tbl_eselon1 d', 'd.kode_e1 = a.kode_e1');
		$this->db->join('tbl_kegiatan_kl k', 'k.kode_kegiatan = a.kode_kegiatan');
		$this->db->order_by("a.tahun DESC, a.kode_sasaran_e1 ASC, a.kode_iku_e1 ASC");
			
		return $this->db->count_all_results();
		$this->db->free_result();
	}
	
	public function GetRecordCountSubGrid($filtahun=null,$filkegiatan){
		if($filtahun != '' && $filtahun != '-1' && $filtahun != null) {
			$this->db->where("a.tahun",$filtahun);
		}	
		if($filkegiatan != '' && $filkegiatan != '-1' && $filkegiatan != null) {
			$this->db->where("k.kode_kegiatan",$filkegiatan);
		}		
		$this->db->from('tbl_ongoing_e2 a');
		$this->db->join('tbl_ikk b', 'b.kode_ikk = a.kode_ikk and b.tahun = a.tahun');
		$this->db->join('tbl_sasaran_eselon2 c', 'c.kode_sasaran_e2 = a.kode_sasaran_e2 and c.tahun=a.tahun');
		$this->db->join('tbl_eselon2 d', 'd.kode_e2 = a.kode_e2');
		$this->db->join('tbl_subkegiatan_kl skk', 'skk.kode_subkegiatan = a.kode_subkegiatan and skk.tahun=a.tahun');
		$this->db->join('tbl_kegiatan_kl k', 'k.kode_kegiatan = skk.kode_kegiatan and k.tahun=skk.tahun');
		$this->db->order_by("a.tahun DESC, a.kode_subkegiatan ASC");
			
		return $this->db->count_all_results();
		$this->db->free_result();
	}
	
	public function getDataEdit($id){
		$this->db->flush_cache();
		$this->db->select('*, b.deskripsi as sasaran, c.deskripsi as iku_e1');
		$this->db->from('tbl_pre_usulan1_e1 a');
		$this->db->join('tbl_sasaran_eselon1 b', 'b.kode_sasaran_e1 = a.kode_sasaran_e1');
		$this->db->join('tbl_iku_eselon1 c', 'c.kode_iku_e1 = a.kode_iku_e1 and c.tahun = a.tahun');
		$this->db->join('tbl_eselon1 d', 'd.kode_e1 = a.kode_e1');
		$this->db->where('a.preusulan1_e1_id', $id);
		
		return $this->db->get()->row();
	}
	
	public function InsertOnDB($data) {
		$this->db->trans_start();
		
		foreach($data['detail'] as $dt){
			 if(!isset($dt['chk'])) continue;
			$this->db->set('tahun',				$data['tahun']);
			$this->db->set('kode_e1',			$data['kode_e1']);
			$this->db->set('kode_sasaran_e1',	$data['kode_sasaran_e1']);
			$this->db->set('kode_iku_e1',	$data['kode_iku_e1']);
			$this->db->set('kode_kegiatan',		$dt['kode_kegiatan']);
			$this->db->set('jumlah',			$this->utility->ourDeFormatNumber2($dt['jumlah']));
			//$this->db->set('satuan',			$dt['satuan']);
			//$this->db->set('status',			'0');
			$this->db->set('log_insert', 		$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
			
			$this->db->insert('tbl_pre_usulan1_e1');
			
			# insert to log
			/* $this->db->flush_cache();
			$this->db->set('tahun',				$data['tahun']);
			$this->db->set('kode_e1',			$data['kode_e1']);
			$this->db->set('kode_sasaran_e1',	$data['kode_sasaran_e1']);
			$this->db->set('kode_iku_e1',		$dt['kode_iku_e1']);
			$this->db->set('jumlah',			$dt['jumlah']);
			//$this->db->set('status',			'0');
			$this->db->set('log',				'INSERT;'.$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
			$this->db->insert('tbl_pre_usulan1_e1_log'); */
			
		}
		/*
		//query insert data		
		$this->db->set('tahun',$data['tahun']);
		$this->db->set('kode_e1',$data['kode_e1']);
		$this->db->set('kode_sasaran_e1',$data['kode_sasaran_e1']);
		$this->db->set('kode_iku_e1',$data['kode_iku']);
		$this->db->set('jumlah',$data['jumlah']);
		try {
			$result = $this->db->insert('tbl_pre_usulan1_e1');
		}
		catch(Exception $e){
			$errNo   = $this->db->_error_number();
			$errMess = $e->getMessage();//$this->db->_error_message();
			$error = $errMess;
			log_message("error", "Problem Inserting to : ".$errMess." (".$errNo.")"); 
		}
		
		//var_dump();die;
		//$result = $this->db->insert('tbl_sasaran_eselon1');
		
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
		*/
		
		$this->db->trans_complete();
	    return $this->db->trans_status();
	}
	

	
	public function getListIKU_E1($objectId="", $data=""){
		// id dari tabel
		$kode_iku = isset($data['kode_iku'])?$data['kode_iku']:'0';
		$tahun = isset($data['tahun'])?$data['tahun']:'2012';
		
		$id = isset($data['id'])?$data['id']:'1';
		$name = isset($data['name'])?$data['name']:'';
		$onclick = isset($data['onclick'])?$data['onclick']:'';
		
		
		$this->db->flush_cache();
		$this->db->select('kode_iku_e1,deskripsi');
		$this->db->from('tbl_iku_eselon1');
		$this->db->where('tahun', $tahun);
		$this->db->order_by('kode_iku_e1');
		// jika data berdasarkan Eselon 1
		if(isset($data['kode_e1'])){
			$this->db->where('kode_e1', $data['kode_e1']);
		}
		
		$que = $this->db->get();
		
		if($que->num_rows() > 0){
			$out = '<select id="'.$id.'" name="'.$name.'" onclick="'.$onclick.'" style=width:100%;>';
			$out .= '<option value="0">-- Pilih --</option>';
			foreach($que->result() as $r){
				if($r->kode_iku_e1 == $kode_iku){
					$out .= '<option value="'.$r->kode_iku_e1.'" selected="selected">'.$r->deskripsi.'</option>';
				}else{
					$out .= '<option value="'.$r->kode_iku_e1.'">'.$r->deskripsi.'</option>';
				}
			}
			$out .= '</select>';
		}else{
			$out = 'Tidak terdapat IKU pada tahun '.$tahun;
		}
		
		return $out;
	}
	
	public function getIKU_e1($objectId, $kode, $tahun){
		$out = '';
		$data['kode_e1'] = $kode;
		$data['tahun'] = $tahun;
		$data['id'] = '1';
		$data['name'] = 'detail[1][kode_iku]';
		$data['onclick'] = 'javascript:getSatuan'.$objectId.'(this.value, this.id)';
		$data['name'] = 'detail[1][kode_iku_e1]';
		
		$out = '<tr>
					<td><input type="checkbox" name="chk'.$objectId.'[]"/></td>
					<td>1</td>
					<td>'.
						$this->getListIKU_E1($objectId, $data)
					.'</td>
					<td>
						<input name="detail[1][jumlah]" size="5" />
					</td>
					<td>
						<input name="detail[1][satuan]" id="satuan1'.$objectId.'" type="text" value="" readonly="true" />
					</td>
				</tr>
			';
		
		return $out;
	}
	
	public function getKegiatan_e1($objectId, $kode, $tahun){
		$out = '';
		/* $data['kode_e1'] = $kode;
		$data['tahun'] = $tahun;
		$data['id'] = '1';
		$data['name'] = 'detail[1][kode_kegiatan]';
		$data['onclick'] = 'javascript:getSatuan'.$objectId.'(this.value, this.id)';
		$data['name'] = 'detail[1][kode_iku_e1]'; */
		$this->db->flush_cache();
		$this->db->select('*');
		$this->db->from('tbl_kegiatan_kl');
		$this->db->order_by('id_kegiatan_kl');
		$this->db->where('kode_e2 in (select kode_e2 from tbl_eselon2 where kode_e1 = '.$kode.')',null,false);
		//if($e2!=''){$this->db->where('kode_e2',$e2);}
		$que = $this->db->get();
		$i=0;
		foreach($que->result() as $r){
			$out .= '<tr>
					<td>'.($i+1).'</td>
					<td><input type="checkbox" name="detail['.$i.'][chk]" value="chk"/></td>					
					<td><input type="hidden" name="detail['.$i.'][kode_kegiatan]" value="'.$r->kode_kegiatan.'"/>'.$r->kode_kegiatan.'</td>
					<td>'.$r->nama_kegiatan.'</td>
					<td align="right"><input class="money" name="detail['.$i.'][jumlah]" style="text-align:right" size="20" /></td>					
				</tr>';
				$i++;
		}
		return $out;
	}
	
	public function UpdateOnDb($data){
		$this->db->flush_cache();
		$this->db->where('preusulan1_e1_id', $data['preusulan1_e1_id']);
		
		$this->db->set('kode_iku_e1', $data['kode_iku_e1']);
		$this->db->set('jumlah',$this->utility->ourDeFormatNumber2($dt['jumlah']));
		$this->db->set('log_update', 		$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
		
		$result = $this->db->update('tbl_pre_usulan1_e1');
		
		# insert to log
		$this->db->flush_cache();
		$this->db->select("*");
		$this->db->from("tbl_pre_usulan1_e1");
		$this->db->where('preusulan1_e1_id', $data['preusulan1_e1_id']);
		$qt = $this->db->get();
		
		$this->db->flush_cache();
		$this->db->set('tahun',				$qt->row()->tahun);
		$this->db->set('kode_e1',			$qt->row()->kode_e1);
		$this->db->set('kode_sasaran_e1',	$qt->row()->kode_sasaran_e1);
		$this->db->set('kode_iku_e1',		$qt->row()->kode_iku_e1);
		$this->db->set('jumlah',			$qt->row()->jumlah);
		$this->db->set('log',				'UPDATE;'.$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
		$this->db->insert('tbl_pre_usulan1_e1_log');
		
		$errNo   = $this->db->_error_number();
	    $errMess = $this->db->_error_message();
		$error = $errMess;
		//var_dump($errMess);die;
	    log_message("error", "Problem Update to : ".$errMess." (".$errNo.")"); 
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}
	
	//hapus data
	public function DeleteOnDb($id){
		
		# insert to log
		$this->db->flush_cache();
		$this->db->select("*");
		$this->db->from("tbl_pre_usulan1_e1");
		$this->db->where('preusulan1_e1_id', $id);
		$qt = $this->db->get();
		
		$this->db->flush_cache();
		$this->db->set('tahun',				$qt->row()->tahun);
		$this->db->set('kode_e1',			$qt->row()->kode_e1);
		$this->db->set('kode_sasaran_e1',	$qt->row()->kode_sasaran_e1);
		$this->db->set('kode_iku_e1',		$qt->row()->kode_iku_e1);
		$this->db->set('jumlah',			$qt->row()->jumlah);
		$this->db->set('log',				'DELETE;'.$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
		$this->db->insert('tbl_pre_usulan1_e1_log');
		
		$this->db->flush_cache();
		$this->db->where('preusulan1_e1_id', $id);
		$result = $this->db->delete('tbl_pre_usulan1_e1'); 
		
		
		$errNo   = $this->db->_error_number();
	    $errMess = $this->db->_error_message();
		$error = $errMess;
		//var_dump($errMess);die;
	    log_message("error", "Problem Update to : ".$errMess." (".$errNo.")"); 
		//return
		
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}
	
	
	public function getListTahun($objectId){
		
		$this->db->flush_cache();
		$this->db->select('tahun');
		$e1 = $this->session->userdata('unit_kerja_e1');
		if (($e1!="-1")&&($e1!=null)){
			$this->db->where('kode_e1',$e1);
			//$value = $e1;
		}
		$this->db->from('tbl_pre_usulan1_e1');
		$this->db->group_by('tahun');
		
		$que = $this->db->get();
		
		$out = '<select id="tahun'.$objectId.'" name="tahun" class="easyui-validatebox" required="true">';
		
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
	
	public function getListFilterTahun($objectId,$withAll=true){
		
		$this->db->flush_cache();
		$this->db->select('distinct tahun',false);
		$this->db->from('tbl_pre_usulan1_e1');
		$e1 = $this->session->userdata('unit_kerja_e1');
		if (($e1!="-1")&&($e1!=null)){
			$this->db->where('kode_e1',$e1);
			//$value = $e1;
		}
		$this->db->order_by('tahun');
		
		$que = $this->db->get();
		
		$out = '<select name="filter_tahun'.$objectId.'" id="filter_tahun'.$objectId.'">';
		if ($withAll)
			$out .= '<option value="-1">Semua</option>';
		foreach($que->result() as $r){
			$out .= '<option value="'.$r->tahun.'">'.$r->tahun.'</option>';
		}
		
		$out .= '</select>';
		
		echo $out;
	}
	
	public function getSatuan($id){
		$this->db->flush_cache();
		$this->db->select('satuan');
		$this->db->from('tbl_iku_eselon1');
		$this->db->where('kode_iku_e1', $id);
		$query = $this->db->get();
		
		return $query->row()->satuan;
		
	}
	
	public function data_exist($tahun, $kode_e1, $kode_sasaran_e1, $kode_iku_e1){
		$this->db->flush_cache();
		$this->db->select('*');
		$this->db->from('tbl_pre_usulan1_e1');
		$this->db->where('tahun', $tahun);
		$this->db->where('kode_e1', $kode_e1);
		$this->db->where('kode_sasaran_e1', $kode_sasaran_e1);
		$this->db->where('kode_iku_e1', $kode_iku_e1);
		
		$que = $this->db->get();
		
		if ($que->num_rows()>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
}

	
?>
