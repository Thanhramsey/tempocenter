<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mslider extends CI_Model {

	public function __construct()
    {
            parent::__construct();
            $this->table = $this->db->dbprefix('slider');
    }
    public function list_img_banner()
    {
            $this->db->where('status', 1);
            $this->db->where('trash', 1);
            $this->db->where('type', 1);
            $query = $this->db->get($this->table);
            return $query->result_array();
    }

    public function list_img_class()
    {
            $this->db->where('status', 1);
            $this->db->where('trash', 1);
            $this->db->where('type', 2);
            $query = $this->db->get($this->table);
            return $query->result_array();
    }

    
    public function list_img_class_1($limit,$first)
    {
        $this->db->where('status', 1);
        $this->db->where('trash', 1);
        $this->db->where('type', 2);
        $query = $this->db->get($this->table, $limit,$first);
        return $query->result_array();
    }

    public function list_img_class_count()
    {
        $this->db->where('status', 1);
        $this->db->where('trash', 1);
        $this->db->where('type', 2);
        $query = $this->db->get($this->table);
        return count($query->result_array());
    }
}