<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mchamcong extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('chamcong_nhanvien');
	}	
	//Thêm
	public function chamcong_insert($mydata)
	{
		$this->db->insert($this->table, $mydata);
	}

	public function getdulieuchamcong($nhanvienid, $ngaychamcong)
	{
		$this->db->where('nhanvien_id',$nhanvienid);
		$this->db->where('ngaydiemdanh',$ngaychamcong);
		$query = $this->db->get($this->table);
        return $query->result_array();
	}

}