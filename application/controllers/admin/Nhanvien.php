<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nhanvien extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('backend/Mnhanvien');
        $this->load->model('backend/Muser');
        $this->load->model('backend/Morders');
		$this->load->model('backend/Mmonhoc');
		$this->load->model('backend/Mcahoc');
		$this->load->model('backend/Mnhanvien');
		$this->load->model('backend/Mchamcong');
		if(!$this->session->userdata('sessionadmin'))
		{
			redirect('admin/user/login','refresh');
		}
		$this->data['user']=$this->session->userdata('sessionadmin');
		$this->data['com']='nhanvien';
	}

	public function index()
	{
		$this->load->library('phantrang');
		$this->load->library('alias');
		$this->load->library('table');
		$limit=15;
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$total=$this->Mnhanvien->nhanvien_count();
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/nhanvien');
		$this->data['list'] = $this->Mnhanvien->nhanvien_list();
		$this->data['view']='index';
		$this->data['title']='Học viên';
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
		$this->form_validation->set_rules('name', 'Nhân viên', 'required|is_unique[db_nhanvien.name]|max_length[25]');
		if ($this->form_validation->run() == TRUE)
		{
			$mydata= array(
				'name' =>$_POST['name'],
				'ngaysinh' =>$_POST['ngaysinh'],
				'gioitinh' =>$_POST['gioitinh'],
				'calamid' => json_encode($_POST['calamid']),
				'phone' =>$_POST['phone'],
				'diachi' =>$_POST['diachi'],
				'status' =>$_POST['status'],
				'created_at' =>$today,
				'trash'=>1
			);
			$this->Mnhanvien->nhanvien_insert($mydata);
			$this->session->set_flashdata('success', 'Thêm danh mục thành công');
			redirect('admin/nhanvien','refresh');
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
		$this->data['row']=$this->Mnhanvien->nhanvien_detail($id);
		$d=getdate();
		$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
		$this->load->library('alias');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Học viên', 'required');
		if ($this->form_validation->run() == TRUE)
		{
			$mydata= array(
				'name' =>$_POST['name'],
				'ngaysinh' =>$_POST['ngaysinh'],
				'gioitinh' =>$_POST['gioitinh'],
				'calamid' => json_encode($_POST['calamid']),
				'phone' =>$_POST['phone'],
				'diachi' =>$_POST['diachi'],
				'status' =>$_POST['status'],
				'updated_at' =>$today,
				'trash'=>1
			);
			$this->Mnhanvien->nhanvien_update($mydata, $id);	
			$this->session->set_flashdata('success', 'Cập nhật danh mục thành công');
			redirect('admin/nhanvien','refresh');
		}
		$this->data['row']=$this->Mnhanvien->nhanvien_detail($id);
		$this->data['view']='update';
		$this->data['title']='Cập nhật danh mục';
		$this->load->view('backend/layout', $this->data);
	}

	public function status($id)
	{
		$row=$this->Mnhanvien->nhanvien_detail($id);
		$status=($row['status']==1)?0:1;
		$mydata= array('status' => $status);
		$this->Mnhanvien->nhanvien_update($mydata, $id);
		$this->session->set_flashdata('success', 'Cập nhật Học viên thành công');
		redirect('admin/nhanvien','refresh');
	}

	public function trash($id)
	{
		$mydata= array('trash' => 0);
		$this->Mnhanvien->nhanvien_update($mydata, $id);
		$this->session->set_flashdata('success', 'Xóa Học viên vào thùng rác thành công');
		redirect('admin/nhanvien','refresh');
	}

	public function recyclebin()
	{
		$this->load->library('phantrang');
		$limit=10;
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$total=$this->Mnhanvien->nhanvien_trash_count();
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/nhanvien/recyclebin');
		$this->data['list']=$this->Mnhanvien->nhanvien_trash($limit, $first);
		$this->data['view']='recyclebin';
		$this->data['title']='Thùng rác Học viên';
		$this->load->view('backend/layout', $this->data);
	}
	public function restore($id)
	{
		$this->Mnhanvien->nhanvien_restore($id);
		$this->session->set_flashdata('success', 'Khôi phục Học viên thành công');
		redirect('admin/nhanvien/recyclebin','refresh');
	}

	public function delete($id)
	{
		$this->Mnhanvien->nhanvien_delete($id);
		$this->session->set_flashdata('success', 'Xóa Học viên thành công');
		redirect('admin/nhanvien/recyclebin','refresh');
	}

	public function chamconginsert()
	{
		$mydata = array(
			"nhanvien_id" => $_POST['nhanvien_id'],
			"ngaydiemdanh" =>  $_POST['ngaydiemdanh'],
			"giolam" => $_POST['giolam'],
			"calamid" =>  json_encode($_POST['calamid'])				
		);
		$this->Mchamcong->chamcong_insert($mydata);
		print json_encode(array("status"=>"success","message"=> "Thêm thành công"));					
	}

	public function chamcongupdate()
	{		
		$mydata= array(
			"giolam" => $_POST['giolam'],
			"calamid" =>  json_encode($_POST['calamid'])				
		);
		$this->Mchamcong->chamcong_update($mydata,$_POST['nhanvien_id'],$_POST['ngaydiemdanh']);
		print json_encode(array("status"=>"success","message"=> "Sửa thành công"));			
	}


	public function getdulieuchamcong()
	{
		$nhanvienid = $_POST['nhanvienid'];
		$ngaychamcong = $_POST['ngaychamcong'];
		$result = $this->Mchamcong->getdulieuchamcong($nhanvienid, $ngaychamcong);
		print json_encode(array("status"=>"success","message"=> $result));
	}


	public function listNhanVien()
	{
		$nhanvien_list=$this->Mnhanvien->nhanvien_list();
		$option_parentid = "";
		$counter = 0;
		$selectNV = "";
		foreach ($nhanvien_list as $r) {
			$counter++;
			if ($counter == 1) {
				$option_parentid .= "<option value='" . $r['id'] . "' selected>" . $r['name'] . "</option>";
				$selectNV =  $r;
			}else{
				$option_parentid .= "<option value='" . $r['id'] . "'>" . $r['name'] . "</option>";
			}
		}
		print json_encode(array("status"=>"success","message"=> $option_parentid,"select"=>$selectNV));
	}

	public function LschamCongNhanVien()
	{
		$nhanvienid = $_POST['nhanvienid'];
		$tuNgay = $_POST['tuNgay'];
		$denNgay = $_POST['denNgay'];

		$this->db->select('nhanvien.name, chamcong_nhanvien.calamid, chamcong_nhanvien.nhanvien_id, chamcong_nhanvien.giolam, chamcong_nhanvien.ngaydiemdanh, nhanvien.congtheogio, (db_chamcong_nhanvien.giolam * db_nhanvien.congtheogio) as sotien');
		$this->db->from('nhanvien');
		$this->db->join('chamcong_nhanvien', 'nhanvien.id = chamcong_nhanvien.nhanvien_id');
		$this->db->where('nhanvien_id', $nhanvienid);
		$this->db->where('ngaydiemdanh >=', $tuNgay);
		$this->db->where('ngaydiemdanh <=', $denNgay);
		$this->db->order_by('ngaydiemdanh', 'asc');
		$query = $this->db->get();
		print json_encode(array("status"=>"success","message"=> $query->result()));
	}
}