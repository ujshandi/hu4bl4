<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Post_e2_model extends CI_Model
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
	public function easyGrid($filtahun=null,$file2=null,$purpose=1){
		$lastNo = isset($_POST['lastNo']) ? intval($_POST['lastNo']) : 0;  
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$limit = isset($_POST['rows']) ? intval($_POST['rows']) : 10;  
		
		$count = $this->GetRecordCount($filtahun,$file2);
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
		 	if($file2 != '' && $file2 != '-1' && $file2 != null) {
				$this->db->where("a.kode_e2",$file2);
			} 
			
			if($purpose==1){$this->db->limit($limit,$offset);}
			$this->db->select('distinct a.poste2_id, a.tahun, a.kode_ikk, a.kode_e2 as rkt_kode_e2, a.kode_sasaran_e2 AS kode_sasaran_e2, b.deskripsi,a.anggaran, a.jumlah,k.kode_kegiatan,k.nama_kegiatan,subkl.kode_subkegiatan, subkl.nama_subkegiatan',false);
			$this->db->select("c.deskripsi as deskripsi_sasaran_e1, b.deskripsi AS deskripsi_iku_e1, d.nama_e2");
			$this->db->from('tbl_post_e2 a');
			$this->db->join('tbl_ikk b', 'b.kode_ikk = a.kode_ikk and b.tahun = a.tahun');
			$this->db->join('tbl_sasaran_eselon2 c', 'c.kode_sasaran_e2 = a.kode_sasaran_e2 and c.tahun = a.tahun');
			$this->db->join('tbl_eselon2 d', 'd.kode_e2 = a.kode_e2');
			$this->db->join('tbl_subkegiatan_kl subkl', 'subkl.kode_subkegiatan = a.kode_subkegiatan and a.tahun=subkl.tahun','left');
			$this->db->join('tbl_kegiatan_kl k', 'k.kode_kegiatan = a.kode_kegiatan and a.tahun=k.tahun','left');
			$this->db->order_by("a.tahun DESC, a.kode_kegiatan ASC");
			$query = $this->db->get();
			
			$i=0;
			$no =$lastNo;
			$sumKegiatan=0;
			$sumAnggaran=0;
			$oldKegiatan="";
			$oldTahun = 0;
			foreach ($query->result() as $row)
			{
				if (($oldKegiatan!=$row->kode_kegiatan)||($oldTahun!=$row->tahun)){
					$oldKegiatan=$row->kode_kegiatan;
					$oldTahun=$row->tahun;
					$sumKegiatan=0;
					$sumAnggaran=0;
				}
				$no++;
				$response->rows[$i]['no']= $no;
				$response->rows[$i]['poste2_id']=$row->poste2_id;
				$response->rows[$i]['tahun']=$row->tahun;
				$response->rows[$i]['kode_e2']=$row->rkt_kode_e2;
				$response->rows[$i]['nama_e2']=$row->nama_e2;
				$response->rows[$i]['kode_sasaran_e2']=$row->kode_sasaran_e2;
				$response->rows[$i]['deskripsi_sasaran_e1']=$row->deskripsi_sasaran_e1;
				$response->rows[$i]['deskripsi']=$row->deskripsi;
				$response->rows[$i]['kode_ikk']=$row->kode_ikk;
				$response->rows[$i]['deskripsi_ikk']=$row->deskripsi;
				$response->rows[$i]['kode_kegiatan']=$row->kode_kegiatan;
				$response->rows[$i]['nama_kegiatan']=$row->nama_kegiatan;
				$response->rows[$i]['kode_subkegiatan']=($row->kode_subkegiatan!=""?$row->kode_subkegiatan:$row->kode_kegiatan);
				$response->rows[$i]['nama_subkegiatan']=($row->nama_subkegiatan!=""?$row->nama_subkegiatan:$row->nama_kegiatan);
				$response->rows[$i]['anggaran']=$this->utility->cekNumericFmt($row->anggaran);
				$response->rows[$i]['jumlah']=$this->utility->cekNumericFmt($row->jumlah);
				
				$response->rows[$i]['kode_kegiatan_tahun']=$row->tahun.'-'.$row->kode_kegiatan;
				$sumKegiatan += $row->jumlah;
				$sumAnggaran += $row->anggaran;
				$response->rows[$i]['jumlah_kegiatan']=$this->utility->cekNumericFmt($sumKegiatan);
				$response->rows[$i]['jumlah_anggaran']=$this->utility->cekNumericFmt($sumAnggaran);
				//utk kepentingan export excel ==========================
				
				//if($file1 == '-1'){unset($row->rkt_kode_sasaran_e2);}
				unset($row->poste2_id);
				unset($row->tahun);
				//unset($row->status);
				unset($row->kode_ikk);
				//============================================================
					
				//utk kepentingan export pdf===================
				/* if($file1 != '' && $file1 != '-1' && $file1 != null)
					$pdfdata[] = array($no,$response->rows[$i]['kode_sasaran_e2'],$response->rows[$i]['deskripsi'],$response->rows[$i]['jumlah']);
				else
					$pdfdata[] = array($no,$response->rows[$i]['kode_sasaran_e2'],$response->rows[$i]['kode_sasaran_e2'],$response->rows[$i]['deskripsi'],$response->rows[$i]['jumlah']); */
				//============================================================
				$i++;
			} 
			
			$response->lastNo = $no;
			// $query->free_result();
		}else {
				$response->rows[$count]['no']= "";
				$response->rows[$count]['id_rkt_kl']='';
				$response->rows[$count]['tahun']='';
				$response->rows[$count]['kode_sasaran_e2']='';
				$response->rows[$count]['nama_e2']='';
				$response->rows[$count]['kode_sasaran_e2']='';
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
			/* if($file1 != '' && $file1 != '-1' && $file1 != null)
				$colHeaders = array("Kode Sasaran","Indikator Kinerja Utama","jumlah");
			else
				$colHeaders = array("Kode Eselon I","Kode Sasaran","Indikator Kinerja Utama","jumlah");	
			//	var_dump($query->result());die;
			to_excel($query,"SasaranEselon1",$colHeaders); */
		}
	}
	
	public function GetRecordCount($filtahun=null,$file2){
		if($filtahun != '' && $filtahun != '-1' && $filtahun != null) {
			$this->db->where("a.tahun",$filtahun);
		}	
		 if($file2 != '' && $file2 != '-1' && $file2 != null) {
			$this->db->where("a.kode_e2",$file2);
		} 
		$this->db->from('tbl_post_e2 a');
		$this->db->join('tbl_ikk b', 'b.kode_ikk = a.kode_ikk and b.tahun = a.tahun');
		$this->db->join('tbl_sasaran_eselon2 c', 'c.kode_sasaran_e2 = a.kode_sasaran_e2 and c.tahun = a.tahun');
		$this->db->join('tbl_eselon2 d', 'd.kode_e2 = a.kode_e2');
		$this->db->join('tbl_subkegiatan_kl subkl', 'subkl.kode_subkegiatan = a.kode_subkegiatan and a.tahun=subkl.tahun','left');
		$this->db->join('tbl_kegiatan_kl k', 'k.kode_kegiatan = a.kode_kegiatan and a.tahun=k.tahun','left');
		$this->db->order_by("a.tahun DESC, a.kode_sasaran_e2 ASC, a.kode_ikk ASC");
			
		return $this->db->count_all_results();
		$this->db->free_result();
	}
	
	public function getDataEdit($id){
		$this->db->flush_cache();
		$this->db->select('*, b.deskripsi as sasaran, c.deskripsi as ikk,e.nama_e1, d.nama_e2');
		$this->db->from('tbl_post_e2 a');
		$this->db->join('tbl_sasaran_eselon2 b', 'b.kode_sasaran_e2 = a.kode_sasaran_e2 and b.tahun=a.tahun');
		$this->db->join('tbl_ikk c', 'c.kode_ikk = a.kode_ikk and c.tahun = a.tahun');
		$this->db->join('tbl_eselon2 d', 'd.kode_e2 = a.kode_e2');
		$this->db->join('tbl_eselon1 e', 'e.kode_e1 = d.kode_e1');
		$this->db->where('a.poste2_id', $id);
		
		return $this->db->get()->row();
	}
	
	public function InsertOnDB($data) {
		$this->db->trans_start();
		
		foreach($data['detail'] as $dt){
			 if(!isset($dt['chk'])){
				if (!isset($dt['chksub'])) continue;
			}
			$this->db->set('tahun',				$data['tahun']);
			$this->db->set('kode_e2',			$data['kode_e2']);
			$this->db->set('kode_sasaran_e2',	$data['kode_sasaran_e2']);
			$this->db->set('kode_ikk',	$data['kode_ikk']);
			$this->db->set('kode_kegiatan',		(isset($dt['kode_kegiatan'])?$dt['kode_kegiatan']:''));
			$this->db->set('kode_subkegiatan',		(isset($dt['kode_subkegiatan'])?$dt['kode_subkegiatan']:''));
			$this->db->set('jumlah',			$this->utility->ourDeFormatNumber2($dt['jumlah']));
			$this->db->set('anggaran',			$this->utility->ourDeFormatNumber2($dt['anggaran']));
			//$this->db->set('satuan',			$dt['satuan']);
			//$this->db->set('status',			'0');
			$this->db->set('log_insert', 		$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
			
			$this->db->insert('tbl_post_e2');
			
			# insert to log
			/* $this->db->flush_cache();
			$this->db->set('tahun',				$data['tahun']);
			$this->db->set('kode_sasaran_e2',			$data['kode_sasaran_e2']);
			$this->db->set('kode_sasaran_e2',	$data['kode_sasaran_e2']);
			$this->db->set('kode_ikk',		$dt['kode_ikk']);
			$this->db->set('jumlah',			$dt['jumlah']);
			//$this->db->set('status',			'0');
			$this->db->set('log',				'INSERT;'.$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
			$this->db->insert('tbl_post_e2_log'); */
			
		}
		/*
		//query insert data		
		$this->db->set('tahun',$data['tahun']);
		$this->db->set('kode_sasaran_e2',$data['kode_sasaran_e2']);
		$this->db->set('kode_sasaran_e2',$data['kode_sasaran_e2']);
		$this->db->set('kode_ikk',$data['kode_iku']);
		$this->db->set('jumlah',$data['jumlah']);
		try {
			$result = $this->db->insert('tbl_post_e2');
		}
		catch(Exception $e){
			$errNo   = $this->db->_error_number();
			$errMess = $e->getMessage();//$this->db->_error_message();
			$error = $errMess;
			log_message("error", "Problem Inserting to : ".$errMess." (".$errNo.")"); 
		}
		
		//var_dump();die;
		//$result = $this->db->insert('tbl_sasaran_eselon2');
		
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
		$this->db->select('kode_ikk,deskripsi');
		$this->db->from('tbl_ikk');
		$this->db->where('tahun', $tahun);
		$this->db->order_by('kode_ikk');
		// jika data berdasarkan Eselon 1
		if(isset($data['kode_sasaran_e2'])){
			$this->db->where('kode_sasaran_e2', $data['kode_sasaran_e2']);
		}
		
		$que = $this->db->get();
		
		if($que->num_rows() > 0){
			$out = '<select id="'.$id.'" name="'.$name.'" onclick="'.$onclick.'" style=width:100%;>';
			$out .= '<option value="0">-- Pilih --</option>';
			foreach($que->result() as $r){
				if($r->kode_ikk == $kode_iku){
					$out .= '<option value="'.$r->kode_ikk.'" selected="selected">'.$r->deskripsi.'</option>';
				}else{
					$out .= '<option value="'.$r->kode_ikk.'">'.$r->deskripsi.'</option>';
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
		$data['kode_sasaran_e2'] = $kode;
		$data['tahun'] = $tahun;
		$data['id'] = '1';
		$data['name'] = 'detail[1][kode_iku]';
		$data['onclick'] = 'javascript:getSatuan'.$objectId.'(this.value, this.id)';
		$data['name'] = 'detail[1][kode_ikk]';
		
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
	
	public function getPendukung($tahun,$triwulan, $kode_e2,$kode_sasaran_e2="", $kode_ikk=""){
		$out2 = '';
		$i = 1;
		$response = new stdClass();
		$this->db->flush_cache();
		$this->db->select('c.kode_ikk, c.deskripsi as deskripsi_ikk,d.target,a.realisasi',false);
		$this->db->from('tbl_kinerja_eselon2 a');
		$this->db->join('tbl_sasaran_eselon2 b', 'b.kode_sasaran_e2 = a.kode_sasaran_e2 and b.tahun = a.tahun');
		$this->db->join('tbl_ikk c', 'c.kode_ikk = a.kode_ikk and c.tahun = a.tahun');
		$this->db->join('tbl_rkt_eselon2 d', 'd.kode_ikk = a.kode_ikk and d.tahun = a.tahun');
		$this->db->join('tbl_eselon2 e', 'e.kode_e2 = a.kode_e2');
		$this->db->where('b.kode_sasaran_e2', $kode_sasaran_e2);
		$this->db->where('c.kode_ikk', $kode_ikk);
		$this->db->where('c.kode_e2', $kode_e2);
		$this->db->where('c.tahun', $tahun);
		$this->db->where('a.triwulan', $triwulan);
		
		$query = $this->db->get();
		$i=0;
		if ($query->num_rows>0){
			foreach($query->result() as $r){
				$response->rows[$i]['kode_ikk']=$r->kode_ikk;
				$response->rows[$i]['deskripsi_ikk']=$r->deskripsi;
				$response->rows[$i]['target']=$this->utility->cekNumericFmt($r->penetapan);
				$response->rows[$i]['realisasi']=$this->utility->cekNumericFmt($r->realisasi);
				$response->rows[$i]['nama_e2']=$row->nama_e2;
				
				$i++;
			}
		}else {
				$count=0;
				$response->rows[$count]['kode_ikk']='';
				$response->rows[$count]['deskripsi_ikk']='';
				$response->rows[$count]['target']='';
				$response->rows[$count]['realisasi']='';
				$response->rows[$count]['nama_e2']='';		
		}
		
		return json_encode($response);
		
	}
	
	public function getKegiatan_e2($objectId, $kode, $tahun,$exclude=false,$kodesasaran="",$kodeikk=""){
		$out = '';
		$this->db->flush_cache();
		/* $this->db->select('k.*,pre.jumlah, pre.predefinitif_e2_id,0 as anggaran',false);
		$this->db->from('tbl_kegiatan_kl k',false);
		$this->db->join('tbl_pre_definitif_e2 pre','k.kode_kegiatan=pre.kode_kegiatan and k.tahun=pre.tahun and pre.kode_e2=k.kode_e2','left');
		$this->db->order_by('id_kegiatan_kl');
		$this->db->where('k.tahun',$tahun);
		$this->db->where('k.kode_e2',$kode); */
		//if($e2!=''){$this->db->where('kode_e2',$e2);}
		$this->db->select('*,0 as anggaran',false);	
		$this->db->from('tbl_kegiatan_kl');
		$this->db->order_by('id_kegiatan_kl');
		$this->db->where('tahun',$tahun);
		$this->db->where('kode_e2',$kode);
		$que = $this->db->get();
		$i=0;
		foreach($que->result() as $r){
			$idxKegiatan = $i;
			
			$this->db->flush_cache();
			$this->db->select('s.*,pre.ongoinge2_id,pre.jumlah, 0 as anggaran',false);
			$this->db->from('tbl_subkegiatan_kl s',false);
			$this->db->join('tbl_ongoing_e2 pre','s.kode_subkegiatan=pre.kode_subkegiatan and s.tahun=pre.tahun','left');
			$this->db->order_by('id_subkegiatan_kl');
			$this->db->where('s.kode_kegiatan',$r->kode_kegiatan);
			$this->db->where('s.tahun',$r->tahun);
			if ($exclude){
				$this->db->where("s.kode_subkegiatan not in (select kode_subkegiatan from tbl_post_e2 where tahun = $r->tahun) ");
			}
			//if($e2!=''){$this->db->where('kode_e2',$e2);}
			$queSub = $this->db->get();
			$jumlah = $this->getJumlahSubkegiatan('tbl_ongoing_e2',$r->tahun,$r->kode_kegiatan,'tbl_post_e2');
			$max_sub_idx = 0;
			if ($queSub!=null)
				$max_sub_idx=$queSub->num_rows;		
		//	$checked = ((int)$r->predefinitif_e2_id>0?"checked":"");	
		//<input type="checkbox" name="detail['.$i.'][chk]" value="chk" '.$checked.'/>
		$out .= '<tr>
					<td>'.($i+1).'</td>
					<td><input type="hidden" name="detail['.$i.'][tipe]" value="kegiatan"/></td>					
					<td><input type="hidden" name="detail['.$i.'][kode_kegiatan]" value="'.$r->kode_kegiatan.'"/>'.$r->kode_kegiatan.'</td>
					<td>'.$r->nama_kegiatan.'</td>
					<td align="right"><input class="money" readonly id="anggaran_'.$i.'" name="detail['.$i.'][anggaran]" style="text-align:right" value="'.$r->anggaran.'" size="20" type="hidden" /></td>					
					<td align="right"><input class="money" readonly id="jumlah_'.$i.'" name="detail['.$i.'][jumlah]" style="text-align:right" value="'.$jumlah.'" size="20" /><input type="hidden" id="max_sub_idx_'.$i.'" value="'.$max_sub_idx.'"/></td>					
				</tr>';
				
			
				$j=0;
				$i++;
				foreach($queSub->result() as $z){
				//	var_dump((int)$z->preusulan1_e2_id);
					$checked = ((int)$z->ongoinge2_id>0?"checked":"");
					$out .= '<tr>
					<td>'.($i+1).'</td>
					<td><input type="hidden" name="detail['.$i.'][tipe]" value="subkegiatan"/><input type="checkbox" name="detail['.$i.'][chksub]" value="chksub" '.$checked.'/></td>					
					<td><input type="hidden" name="detail['.$i.'][kode_kegiatan]" value="'.$r->kode_kegiatan.'"/><input type="hidden" name="detail['.$i.'][kode_subkegiatan]" value="'.$z->kode_subkegiatan.'"/>'.$z->kode_subkegiatan.'</td>
					<td>&nbsp;&nbsp;&nbsp;>> '.$z->nama_subkegiatan.'</td>
					<td align="right"><input class="money" name="detail['.$i.'][anggaran]" style="text-align:right" size="20" id="anggaran_'.$i.'"  value="'.$z->anggaran.'" /></td>					
					<td align="right"><input class="money" name="detail['.$i.'][jumlah]" style="text-align:right" size="20" id="jumlah_'.$i.'"  value="'.$z->jumlah.'" onchange="calculateKegiatan'.$objectId.'('.$idxKegiatan.','.$max_sub_idx.')"/></td>					
					</tr>';
					$i++;
				
				}
				
		}
		return $out;
	}
	
	public function UpdateOnDb($data){
		$this->db->flush_cache();
		$this->db->where('poste2_id', $data['poste2_id']);
		
	//	$this->db->set('kode_ikk', $data['kode_ikk']);
		$this->db->set('anggaran',$this->utility->ourDeFormatNumber2($data['anggaran']));
		$this->db->set('jumlah',$this->utility->ourDeFormatNumber2($data['jumlah']));
		$this->db->set('log_update', 		$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
		
		$result = $this->db->update('tbl_post_e2');
		
		/* # insert to log
		$this->db->flush_cache();
		$this->db->select("*");
		$this->db->from("tbl_post_e2");
		$this->db->where('poste2_id', $data['poste2_id']);
		$qt = $this->db->get();
		
		$this->db->flush_cache();
		$this->db->set('tahun',				$qt->row()->tahun);
		$this->db->set('kode_sasaran_e2',			$qt->row()->kode_sasaran_e2);
		$this->db->set('kode_sasaran_e2',	$qt->row()->kode_sasaran_e2);
		$this->db->set('kode_ikk',		$qt->row()->kode_ikk);
		$this->db->set('jumlah',			$qt->row()->jumlah);
		$this->db->set('log',				'UPDATE;'.$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
		$this->db->insert('tbl_post_e2_log'); */
		
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
		/* $this->db->flush_cache();
		$this->db->select("*");
		$this->db->from("tbl_post_e2");
		$this->db->where('poste2_id', $id);
		$qt = $this->db->get();
		
		$this->db->flush_cache();
		$this->db->set('tahun',				$qt->row()->tahun);
		$this->db->set('kode_sasaran_e2',			$qt->row()->kode_sasaran_e2);
		$this->db->set('kode_sasaran_e2',	$qt->row()->kode_sasaran_e2);
		$this->db->set('kode_ikk',		$qt->row()->kode_ikk);
		$this->db->set('jumlah',			$qt->row()->jumlah);
		$this->db->set('log',				'DELETE;'.$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
		$this->db->insert('tbl_post_e2_log');
		 */
		$this->db->flush_cache();
		$this->db->where('poste2_id', $id);
		$result = $this->db->delete('tbl_post_e2'); 
		
		
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
			$this->db->where('kode_sasaran_e2',$e1);
			//$value = $e1;
		}
		$this->db->from('tbl_post_e2');
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
		$this->db->from('tbl_post_e2');
		$e1 = $this->session->userdata('unit_kerja_e1');
		if (($e1!="-1")&&($e1!=null)){
			$this->db->where('kode_sasaran_e2',$e1);
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
	
	public function getJumlahSubkegiatan($tableName,$tahun,$kodekegiatan,$tableExclude=''){
		$this->db->flush_cache();
		$this->db->select('sum(jumlah) as jumlah',false);
		$this->db->from($tableName);
		$this->db->where('kode_kegiatan', $kodekegiatan);
		$this->db->where('tahun', $tahun);
		if ($tableExclude!=""){
			$this->db->where("kode_subkegiatan not in (select kode_subkegiatan from $tableExclude where tahun = $tahun) ");
		}
		$query = $this->db->get();
		
		return $query->row()->jumlah;
		
	}
	public function getSatuan($id){
		$this->db->flush_cache();
		$this->db->select('satuan');
		$this->db->from('tbl_ikk');
		$this->db->where('kode_ikk', $id);
		$query = $this->db->get();
		
		return $query->row()->satuan;
		
	}
	
	public function data_exist($tahun, $kode_sasaran_e2, $kode_sasaran_e2, $kode_ikk){
		$this->db->flush_cache();
		$this->db->select('*');
		$this->db->from('tbl_post_e2');
		$this->db->where('tahun', $tahun);
		$this->db->where('kode_sasaran_e2', $kode_sasaran_e2);
		$this->db->where('kode_sasaran_e2', $kode_sasaran_e2);
		$this->db->where('kode_ikk', $kode_ikk);
		
		$que = $this->db->get();
		
		if ($que->num_rows()>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
}

	
?>
