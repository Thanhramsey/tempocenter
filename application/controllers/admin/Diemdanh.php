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
		$this->load->model('backend/Mdiemdanh');
		
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
		$query = $this->db->query("
				SELECT
					hv.id AS hocvien_id,
					hv.name AS hocvien_name,
					ch.name  AS cahoc_name,
					IF(diemdanh_hocvien.trang_thai IS NOT NULL, diemdanh_hocvien.trang_thai, FALSE) AS trangthai_diemdanh,
					IF(diemdanh_hocvien.id IS NOT NULL, diemdanh_hocvien.id, FALSE) AS diemdanh_hocvien_id,
					IF(diemdanh_hocvien.ishocbu IS NOT NULL, diemdanh_hocvien.ishocbu, FALSE) AS ishocbu
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
		
		$queryhocbu = $this->db->query("
		SELECT 
			hv.id AS hocvien_id,
			hv.name AS hocvien_name,
			ch.name AS cahoc_name,
			IF(dd.trang_thai IS NOT NULL, dd.trang_thai, FALSE) AS trangthai_diemdanh,
			IF(dd.id IS NOT NULL, dd.id, FALSE) AS diemdanh_hocvien_id,
			IF(dd.ishocbu IS NOT NULL, dd.ishocbu, FALSE) AS ishocbu
		FROM
			db_hocvien AS hv
		JOIN
			db_diemdanh_hocvien AS dd ON hv.id = dd.hocvien_id
		JOIN
			db_cahoc AS ch ON dd.cahoc_id = ch.id
		WHERE
			dd.ngaydiemdanh = '$ngaydiemdanh'
			AND dd.cahoc_id = $cahoc
			AND dd.ishocbu = 1 ;");
		$resulthocbu = $queryhocbu->result_array();

		foreach ($resulthocbu as $item) {
			array_push($result, $item);
		}
		// print_r($resulthocbu);
		// print_r($result);
		$listCals=$this->Mcahoc->cahoc_list();
		$listhv = $this->Mhocvien->hocvien_list();
		$this->data['list']=  $result;
		$this->data['ngaydiemdanh']=  $ngaydiemdanh;
		$this->data['cahoc']=  $cahoc;
		$this->data['listCals']=  $listCals;
		$this->data['listhv']=  $listhv;
		$this->data['view']='index';
		$this->data['title']='Điểm danh';
		$this->load->view('backend/layout', $this->data);
	}


	public function themDiemDanh(){
		$arrData = $_POST['arrData'];
		$ngay = $_POST['ngay'];
		$ca = $_POST['ca'];
		foreach ($arrData as $r) {

			if($r['diemdanhId'] == 0){
				$mydata= array(
					'hocvien_id' => $r['id'],
					'cahoc_id' => $ca,
					'ngaydiemdanh' =>$ngay,
					'trang_thai'=> $r['trangthai']
				);
				$this->Mdiemdanh->diemdanh_insert($mydata);
			}else{
				$mydata= array(
					'hocvien_id' => $r['id'],
					'cahoc_id' => $ca,
					'ngaydiemdanh' =>$ngay,
					'trang_thai'=> $r['trangthai']
				);
				$this->Mdiemdanh->diemdanh_update($mydata,$r['diemdanhId']);
			}
			
		}
		print json_encode(array("status"=>"success","message"=> "Thêm thành công"));
	}

	public function diemDanhBu(){
		$arrData = $_POST['arrData'];
		$ngaydiemdanh = $_POST['ngay'];
		$cahocid = $_POST['ca'];

		foreach ($arrData as $hocvien_id) {
            $data = array(
                'hocvien_id' => $hocvien_id,
                'cahoc_id' => $cahocid,
                'ngaydiemdanh' => $ngaydiemdanh,
                'trang_thai' => 1,
				'ishocbu' => 1
            );

            // Kiểm tra xem dữ liệu đã tồn tại trong bảng diemdanh hay chưa
            $this->db->where('hocvien_id', $hocvien_id);
            $this->db->where('cahoc_id', $cahocid);
            $this->db->where('ngaydiemdanh', $ngaydiemdanh);
            $query = $this->db->get('db_diemdanh_hocvien');

            if ($query->num_rows() > 0) {
                // Nếu dữ liệu đã tồn tại thì update trạng thái
                $this->db->where('hocvien_id', $hocvien_id);
                $this->db->where('cahoc_id', $cahocid);
                $this->db->where('ngaydiemdanh', $ngaydiemdanh);
                $this->db->update('db_diemdanh_hocvien', $data);
            } else {
                // Nếu dữ liệu chưa tồn tại thì insert dữ liệu mới
                $this->db->insert('db_diemdanh_hocvien', $data);
            }
        }
        $response = array('message' => 'Đã cập nhật điểm danh thành công');
        echo json_encode($response);
	} 

	public function listCaHoc($monId)
	{
		$cahoc_list=$this->Mcahoc->cahoc_theomon($monId);
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

	public function cahocList()
	{
		$cahoc_list=$this->Mcahoc->cahoc_list();
		print json_encode($cahoc_list);
	}

	public function hocvienList()
	{
		$cahoc_list=$this->Mcahoc->cahoc_list();
		print json_encode(array("status"=>"success","cahoc_list"=> $cahoc_list,"hocvien_list"=> $option_hocvienid ));
	}


	public function updateTrangthai(){
		if($_POST['isupdate'] == 0){
			$mydata= array(
				'hocvien_id' => $_POST['hocvienId'],
				'cahoc_id' => $_POST['ca'],
				'ngaydiemdanh' =>$_POST['ngay'],
				'trang_thai'=> $_POST['trangthai']
			);
			$this->Mdiemdanh->diemdanh_insert($mydata);
		}else{
			$status=($_POST['trangthai']==1)?0:1;
			$mydata= array(
				'trang_thai'=> $status
			);
			$this->Mdiemdanh->diemdanh_update($mydata,$_POST['diemdanhId']);
		}
		print json_encode(array("status"=>"success","message"=> "Done"));
	}



}