<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pembayaran extends CI_Model {

	public function getSelectedData($table,$data)
	{
		return $this->db->get_where($table, $data);
	}
	function deleteData($table,$data)
	{
		$this->db->delete($table,$data);
	}
	function updateData($table,$data,$field_key)
	{
		$this->db->update($table,$data,$field_key);
	}
	function view_bayar($id){
		return $this->db->where('id_pinjam',$id)->order_by('cicilan')->get('pinjaman_detail');
	}

}

/* End of file M_pembayaran.php */
/* Location: ./application/models/M_pembayaran.php */