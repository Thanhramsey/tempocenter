<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdiemdanh extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('diemdanh_hocvien');
	}
	// Lấy lên danh sách danh mục
	public function getLietDiemDanh($limit,$first,$ca,$ngay)
	{
		$this->db->where('trash',1);
		if($loaisp != ""){
			$this->db->where('monId', $loaisp);
		}
		$this->db->order_by('id', 'asc');
		$query = $this->db->get($this->table,$limit,$first);
        return $query->result_array();
	}

	public function cahoc_theomon($monhoc)
	{
		$this->db->where('trash',1);
		if($monhoc != ""){
			$this->db->where('monId', $monhoc);
		}
		$this->db->order_by('id', 'asc');
		$query = $this->db->get($this->table);
        return $query->result_array();
	}
	public function cahoc_theothu($thu)
	{
		$this->db->where('trash',1);
		if($thu != ""){
			$this->db->where('thu', $thu);
		}
		$this->db->order_by('id', 'asc');
		$query = $this->db->get($this->table);
        return $query->result_array();
	}
	// Đếm phân trang
	public function cahoc_count($loaisp)
	{
		$this->db->where('status', 1);
        $this->db->where('trash', 1);
		if($loaisp != ""){
			$this->db->where('monId', $loaisp);
		}
        $query = $this->db->get($this->table);
        return count($query->result_array());
	}
	//Thêm
	public function diemdanh_insert($mydata)
	{
		$this->db->insert($this->table, $mydata);
	}

	//Cập nhật
	public function diemdanh_update($mydata, $id)
	{
		$this->db->where('id',$id);
		$this->db->update($this->table, $mydata);
	}
	// Lấy lên danh sách danh mục
	public function cahoc_list()
	{
		$this->db->where('trash',1);
		$this->db->order_by('id', 'asc');
		$this->db->order_by('updated_at', 'desc');
		$query = $this->db->get($this->table);
        return $query->result_array();
	}
	//Lấy lên thông tin danh mục đó lv
	public function cahoc_detail($id)
	{
		$this->db->where('trash',1);
		$this->db->where('id',$id);
		$this->db->order_by('id', 'asc');
		$query = $this->db->get($this->table);
        return $query->row_array();
	}
	// Xóa vinh viễn
	public function cahoc_delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete($this->table);
	}
	// Danh sách danh mục đã xóa
	public function cahoc_trash($limit, $first)
	{
		$this->db->where('trash',0);
		$query = $this->db->get($this->table, $limit, $first);
        return $query->result_array();
	}

	public function cahoc_trash_count()
	{
        $this->db->where('trash', 0);
        $query = $this->db->get($this->table);
        return count($query->result_array());
	}
	//Cập nhật
	public function cahoc_restore($id)
	{
		$data=array('trash'=>1);
		$this->db->where('id',$id);
		$this->db->update($this->table, $data);
	}
	public function cahoc_name($id)
    {
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $this->db->where('trash', 1);
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row['name'];
    }
	public function diemdanh_detail($id)
	{
		$this->db->where('trash',1);
		$this->db->where('id',$id);
		$this->db->order_by('id', 'asc');
		$query = $this->db->get($this->table);
        return $query->row_array();
	}

	public function status($id)
	{
		$row=$this->Mdiemdanh->diemdanh_detail($id);
		$status=($row['trangthai']==1)?0:1;
		$mydata= array('status' => $status);
		$this->Mdiemdanh->diemdanh_update($mydata, $id);
		$this->session->set_flashdata('success', 'Cập nhật thành công');
		redirect('admin/diemdanh','refresh');
	}
}