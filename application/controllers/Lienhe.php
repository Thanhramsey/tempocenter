<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lienhe extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->data['com']='lienhe';
		$this->load->model('frontend/Mcategory');
		$this->load->model('frontend/Mproduct');
		$this->load->model('frontend/Mcontact');
		$this->load->model('frontend/Mproducer');
		$this->load->model('backend/Muser');
		$this->load->model('backend/Mmonhoc');
		$this->load->model('backend/Mcahoc');
		$this->load->model('frontend/Mslider');
	}

	public function index()
	{
		$d=getdate();
		$today=$d['year']."/".$d['mon']."/".$d['mday'];
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fullname', 'Họ và tên','required' );
		$this->form_validation->set_rules('phone', 'Số điện thoại','required' );
		$this->form_validation->set_rules('content', 'nội dụng','required' );
		if($this->form_validation->run()==TRUE){
			if(empty($_POST['title'])){
				$_POST['title'] = "Đăng kí học thử";
			}
			$mydata=array(
				'fullname'=>$_POST['fullname'],
				'email'=>$_POST['email'],
				'phone'=>$_POST['phone'],
				'title'=>$_POST['title'],
				'content'=>$_POST['content'],
				'created_at'=> $today
			);
			$this->Mcontact->contact_insert($mydata);
			$this->session->set_flashdata('success', 'Chúng tôi sẽ liên hệ với bạn sớm nhất !');
		}
		$this->data['title']="TEMPO  - Liên hệ";
		$this->data['view']='index';
		$this->load->view('frontend/layout',$this->data);
	}


	public function questions()
	{
		$this->data['title']="TEMPO  - Liên hệ";
		$this->data['view']='questions';
		$this->load->view('frontend/layout',$this->data);
	}
	public function dieukhoanthamgia()
	{
		$this->data['title']="TEMPO  - Liên hệ";
		$this->data['view']='dieukhoanthamgia';
		$this->load->view('frontend/layout',$this->data);
	}
	public function chinhsachbaomat()
	{
		$this->data['title']="TEMPO  - Liên hệ";
		$this->data['view']='chinhsachbaomat';
		$this->load->view('frontend/layout',$this->data);
	}
	public function coban()
	{
		$this->data['title']="TEMPO  - Liên hệ";
		$this->data['view']='coban';
		$this->load->view('frontend/layout',$this->data);
	}
	public function nangcao()
	{
		$this->data['title']="TEMPO  - Liên hệ";
		$this->data['view']='nangcao';
		$this->load->view('frontend/layout',$this->data);
	}
	public function demhat()
	{
		$this->data['title']="TEMPO  - Liên hệ";
		$this->data['view']='demhat';
		$this->load->view('frontend/layout',$this->data);
	}
	public function doctau()
	{
		$this->data['title']="TEMPO  - Liên hệ";
		$this->data['view']='doctau';
		$this->load->view('frontend/layout',$this->data);
	}

	public function thuvien()
	{
		$this->load->library('phantrang');
        $limit=12;
        $current=$this->phantrang->PageCurrent();
        $first=$this->phantrang->PageFirst($limit, $current);
        $total=$this->Mslider->list_img_class_count("","");
        $this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='thuvien');
        $this->data['list']=$this->Mslider->list_img_class_1($limit,$first);

		$this->data['title']="TEMPO  - Liên hệ";
		$this->data['view']='thuvien';
		$this->load->view('frontend/layout',$this->data);
	}

	public function insertLienHe(){
		$d=getdate();
		$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
		if(empty($_POST['title'])){
			$_POST['title'] = "Đăng kí học thử";
		}
		$mydata= array(
				'fullname'=>$_POST['fullname'],
				'email'=>$_POST['email'],
				'phone'=>$_POST['phone'],
				'cahoc'=>$_POST['cahoc'],
				'title'=>$_POST['title'],
				'content'=>$_POST['content'],
				'created_at'=> $today
				);
		$this->Mcontact->contact_insert($mydata);
		echo json_encode( $mydata );
	}
}