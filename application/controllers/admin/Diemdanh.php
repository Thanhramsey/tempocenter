<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diemdanh extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('backend/Mcahoc');
        $this->load->model('backend/Muser');
        $this->load->model('backend/Mproduct');
        $this->load->model('backend/Morders');
		$this->load->model('backend/Mmonhoc');
		$this->load->model('backend/Mhocvien');
		$this->load->model('backend/Mhocviencahoc');
		if(!$this->session->userdata('sessionadmin'))
		{
			redirect('admin/user/login','refresh');
		}
		$this->data['user']=$this->session->userdata('sessionadmin');
		$this->data['com']='diemdanh';
	}

	public function index()
	{
		$this->load->library('phantrang');
		$this->load->library('alias');
		$limit=15;
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$ngaydiemdanh = date("Y-m-d");;
		$cahoc = "";
		$loaisp = "";
		if(!empty($_POST['datepicker'])){
			$ngaydiemdanh = $_POST['datepicker'];
		}
		
		if(!empty($_POST['caId'])){
			$cahoc = $_POST['caId'];
		}else{
			$thu_so = date('N', strtotime($ngaydiemdanh));
			$ten_thu = ['Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];
			$thu = $ten_thu[$thu_so];
			$cahoc_list=$this->Mcahoc->cahoc_theothu($thu);
			$cahoc = $cahoc_list[0]['id'];
		}
		$total=$this->Mhocvien->hocvien_count("",$cahoc);
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/diemdanh');
		$this->db->select('hv.id AS hocvien_id, hv.name AS hocvien_name,ch.name AS cahoc_name');
        $this->db->from('hocvien hv');
        $this->db->join('hocvien_cahoc hc', 'hv.id = hc.hocvien_id');
		$this->db->join('cahoc ch', 'hc.cahoc_id = ch.id', 'left');
        $this->db->where('hc.cahoc_id', $cahoc);
		$query = $this->db->get();
		
		$this->data['list']=  $query->result_array();
		$this->data['ngaydiemdanh']=  $ngaydiemdanh;
		$this->data['cahoc']=  $cahoc;
		$this->data['view']='index';
		$this->data['title']='Điểm danh';
		$this->load->view('backend/layout', $this->data);
	}


	public function insert()
	{
		$user_role=$this->session->userdata('sessionadmin');
		if($user_role['role']==2){
			redirect('admin/E403/index','refresh');
		}
		$d=getdate();
		$this->load->library('alias');
		$this->load->library('form_validation');
		$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
		// $this->form_validation->set_rules('name', 'Ca học', 'required|is_unique[db_cahoc.name]|max_length[25]');
		$this->form_validation->set_rules('startTime', 'Thời gian', 'required');
		$this->form_validation->set_rules('thu', 'Thứ', 'required');
		$name = "";
		if ($this->form_validation->run() == TRUE)
		{
			if(!empty($_POST['name'])){
				$name =$_POST['name'];
			}else{
				$name = $_POST['thu'] . " - Ca " .$_POST['startTime']. "->".$_POST['endTime'];
			}
			$mydata= array(
				'name' =>$name,
				'monId' =>$_POST['monId'],
				'thu' =>$_POST['thu'],
				'startTime' =>$_POST['startTime'],
				'endTime' =>$_POST['endTime'],
				'status' =>$_POST['status'],
				'created_at' =>$today,
				'trash'=>1
			);
			$this->Mcahoc->cahoc_insert($mydata);
			if(!empty($_POST['hocvienId'])){
				$cahocId = $this->db->insert_id();
				$hocvienIds = $_POST['hocvienId'];
				$this->Mhocviencahoc->cahoc_hocvien_insert($cahocId, $hocvienIds);
			}
			$this->session->set_flashdata('success', 'Thêm danh mục thành công');
			redirect('admin/cahoc','refresh');
		}
		else
		{
			$this->data['view']='insert';
			$this->data['title']='Thêm danh mục mới';
			$this->load->view('backend/layout', $this->data);
		}
	}

	public function update($id)
	{
		$user_role=$this->session->userdata('sessionadmin');
		if($user_role['role']==2){
			redirect('admin/E403/index','refresh');
		}
		$this->data['row']=$this->Mcahoc->cahoc_detail($id);
		$d=getdate();
		$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
		$this->load->library('alias');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('startTime', 'Thời gian', 'required');
		$this->form_validation->set_rules('thu', 'Thứ', 'required');
		if ($this->form_validation->run() == TRUE)
		{
			if(!empty($_POST['name'])){
				$name =$_POST['name'];
			}else{
				$name = $_POST['thu'] . " - Ca " .$_POST['startTime']. "->".$_POST['endTime'];
			}
			$mydata= array(
				'name' =>$_POST['name'],
				'monId' =>$_POST['monId'],
				'thu' =>$_POST['thu'],
				'startTime' =>$_POST['startTime'],
				'endTime' =>$_POST['endTime'],
				'status' =>$_POST['status'],
				'updated_at' =>$today,
				'trash'=>1
			);
			$this->Mcahoc->cahoc_update($mydata, $id);
			$hocvienIds = $_POST['hocvienId'];
			$this->Mhocviencahoc->hocvien_update_byhv($id, $hocvienIds);

			$this->session->set_flashdata('success', 'Cập nhật danh mục thành công');
			redirect('admin/cahoc','refresh');
		}
		$query = $this->db->select('hocvien_id')
							->from('hocvien_cahoc')
							->where('cahoc_id', $id)
							->get();
	
			if ($query->num_rows() > 0) {
				$result = $query->result_array();
			} else {
				$result = [100];
			}
		$this->data['hocviench']= $result ;
		$this->data['view']='update';
		$this->data['title']='Cập nhật danh mục';
		$this->load->view('backend/layout', $this->data);
	}

	public function status($id)
	{
		$row=$this->Mcahoc->cahoc_detail($id);
		$status=($row['status']==1)?0:1;
		$mydata= array('status' => $status);
		$this->Mcahoc->cahoc_update($mydata, $id);
		$this->session->set_flashdata('success', 'Cập nhật Ca học thành công');
		redirect('admin/cahoc','refresh');
	}

	public function trash($id)
	{
		$mydata= array('trash' => 0);
		$this->Mcahoc->cahoc_update($mydata, $id);
		$this->session->set_flashdata('success', 'Xóa Ca học vào thùng rác thành công');
		redirect('admin/cahoc','refresh');
	}

	public function recyclebin()
	{
		$this->load->library('phantrang');
		$limit=10;
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$total=$this->Mcahoc->cahoc_trash_count();
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/cahoc/recyclebin');
		$this->data['list']=$this->Mcahoc->cahoc_trash($limit, $first);
		$this->data['view']='recyclebin';
		$this->data['title']='Thùng rác Ca học';
		$this->load->view('backend/layout', $this->data);
	}
	public function restore($id)
	{
		$this->Mcahoc->cahoc_restore($id);
		$this->session->set_flashdata('success', 'Khôi phục Ca học thành công');
		redirect('admin/cahoc/recyclebin','refresh');
	}

	public function delete($id)
	{
		$this->Mcahoc->cahoc_delete($id);
		$this->Mhocviencahoc->cahoc_hocvien_delete($id);
		$this->session->set_flashdata('success', 'Xóa Ca học thành công');
		redirect('admin/cahoc/recyclebin','refresh');
	}

	public function listCaHoc($monId)
	{
		$cahoc_list=$this->Mcahoc->cahoc_theomon($monId);
		// $option_parentid = "";
		// foreach ($cahoc_list as $r) {
		// 	$option_parentid .= "<option value='" . $r['id'] . "'>" . $r['name'] . "</option>";
		// }
		print json_encode(array("status"=>"success","message"=> $cahoc_list));
	}


	public function listDiemDanh($monId)
	{
		$cahoc_list=$this->Mcahoc->cahoc_theomon($monId);
		$option_parentid = "";
		foreach ($cahoc_list as $r) {
			$option_parentid .= "<option value='" . $r['id'] . "'>" . $r['name'] . "</option>";
		}
		print json_encode(array("status"=>"success","message"=> $option_parentid));
	}

}