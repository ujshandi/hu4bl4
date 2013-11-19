<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Lke_konversi_model extends CI_Model
{	
	/**
	* constructor
	*/
	public function __construct()
    {
        parent::__construct();
		//$this->CI =& get_instance();
    }
		
	public function getKonversi($jenislke,$index,$unitkerja){
		$this->db->flush_cache();
		$this->db->select('konversi',false);
		$this->db->from('tbl_lke_konversi');
		$this->db->where('jenis_lke', $jenislke);
		$this->db->where('index_mutu', $index);
		$this->db->where('unit_kerja', $unitkerja);
		$query = $this->db->get();
		if ($query->num_rows()>0)
			return $query->row()->konversi;
		else return 0;
		
	}
	
	
	public function getListIndex($objectId="", $data="",$required="true",$name="index_mutu"){
		
		$jenis_lke = isset($data['jenis_lke'])?$data['jenis_lke']:'-1';
		$unit_kerja = isset($data['unit_kerja'])?$data['unit_kerja']:'e1';
		$value = isset($data['value'])?$data['value']:'0';
		
		$this->db->flush_cache();
		$this->db->select('index_mutu');
		$this->db->from('tbl_lke_konversi');
		
		if (($jenis_lke!= "-1")||($jenis_lke!= "")){
			$this->db->where('jenis_lke',$jenis_lke);
		}
		if (($unit_kerja!= "-1")||($unit_kerja!= "")){
			$this->db->where('unit_kerja',$unit_kerja);
		}
		
		
		$que = $this->db->get();
		
		//$out = '<select name="index_mutu" id="index_mutu'.$objectId.'" class="easyui-validatebox" required="'.$required.'">';
		$out='';
		foreach($que->result() as $r){
			if($value == $r->index_mutu){
				$out .= '<input type="radio" name="'.$name.'" id="'.$name.$objectId.'" value="'.$r->index_mutu.'" Selected="selected">&nbsp;'.$r->index_mutu.'&nbsp;&nbsp;';
			}else{
				$out .= '<input type="radio" name="'.$name.'" id="'.$name.$objectId.'" value="'.$r->index_mutu.'">&nbsp;'.$r->index_mutu.'&nbsp;&nbsp;';
			}
			$out .= "&nbsp;";
			/* if($value == $r->index_mutu){
				$out .= '<option value="'.$r->index_mutu.'" Selected="selected">'.$r->index_mutu.'</option>';
			}else{
				$out .= '<option value="'.$r->index_mutu.'">'.$r->index_mutu.'</option>';
			} */
		}
		
		//$out .= '</select>';
		
		return $out;
	}
	
	
	
}
?>
