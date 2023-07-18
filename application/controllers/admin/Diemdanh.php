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
		// $this->db->select('hv.id AS hocvien_id, hv.name AS hocvien_name,ch.name AS cahoc_name');
        // $this->db->from('hocvien hv');
        // $this->db->join('hocvien_cahoc hc', 'hv.id = hc.hocvien_id');
		// $this->db->join('cahoc ch', 'hc.cahoc_id = ch.id', 'left');
        // $this->db->where('hc.cahoc_id', $cahoc);
		// $query = $this->db->get();

		$query = $this->db->query("
				SELECT
					hv.id AS hocvien_id,
					hv.name AS hocvien_name,
					ch.name  AS cahoc_name,
					IF(diemdanh_hocvien.trang_thai IS NOT NULL, TRUE, FALSE) AS trangthai_diemdanh
				FROM
					db_hocvien AS hv
				JOIN
					db_hocvien_cahoc AS hvc ON hv.id = hvc.hocvien_id
				JOIN
					db_cahoc AS ch ON hvc.cahoc_id = ch.id
				LEFT JOIN
					db_diemdanh_hocvien AS diemdanh_hocvien ON hv.id = diemdanh_hocvien.hocvien_id AND ch.id = diemdanh_hocvien.cahoc_id AND diemdanh_hocvien.ngaydiemdanh = '$ngaydiemdanh'
				WHERE
					ch.id = $cahoc;
			");
		$result = $query->result_array();
		print_r($result);
		$this->data['list']=  $query->result_array();
		$this->data['ngaydiemdanh']=  $ngaydiemdanh;
		$this->data['cahoc']=  $cahoc;
		$this->data['view']='index';
		$this->data['title']='Điểm danh';
		$this->load->view('backend/layout', $this->data);
	}


	public function themDiemDanh(){
		$arrData = $_POST['arrData'];
		$ngay = $_POST['ngay'];
		foreach ($arrData as $r) {
			
		}
		print json_encode(array("status"=>"success","message"=> $arrData));
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