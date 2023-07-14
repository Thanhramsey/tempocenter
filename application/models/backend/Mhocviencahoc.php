<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mhocviencahoc extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('hocvien_cahoc');
	}
	
	//Cập nhật
	public function hocvien_update($id, $cahocId)
	{
		$this->db->where('hocvien_id', $id)
				->delete('hocvien_cahoc');
		foreach ($cahocId as $cahocId) {
			$data = [
				'hocvien_id' => $id,
				'cahoc_id' => $cahocId
			];
		
			$this->db->insert('hocvien_cahoc', $data);
		}
	}

	public function hocvien_cahoc_insert($id, $cahocId)
	{
		foreach ($cahocId as $cahocid) {
		$data = array(
			'hocvien_id' => $id,
			'cahoc_id' => $cahocid
		 );
	  
		 $this->db->insert('hocvien_cahoc', $data);
		}
	}

	public function hocvien_cahoc_delete($id)
	{
		$this->db->where('hocvien_id',$id);
		$this->db->delete($this->table);
	}
	
	
}