<?php

class Main_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_single_record($table,$where,$select){
    	$this->db->select($select);
    	$query = $this->db->get_where($table,$where);
    	$row = $query->row_array();
    	return $row;
    }

    public function get_records($table,$where,$select){
    	$this->db->select($select);
    	$query = $this->db->get_where($table,$where);
    	$row = $query->result_array();
    	return $row;
    }

    public function insert($table,$data){
    	$this->db->insert($table,$data);
    	return $this->db->insert_id();

    }

    public function update($table,$where,$data){
    	 $this->db->where($where);
    	 return $this->db->update($table,$data);

    }

    public function delete($table,$where){
        $this->db->where($where);
        return $this->db->delete($table);

    }

    public function get_limit_records($table,$where,$select,$limit,$offset){
        $this->db->select($select);
        $this->db->where($where);
        $this->db->limit($limit,$offset);
        $query = $this->db->get($table);
        $row = $query->result_array();
        return $row;

    }

    public function get_count($where,$table){
        $this->db->select('count(id) as ids');
        $this->db->where($where);
        $query = $this->db->get($table);
        $row = $query->row_array();
        return $row['ids'];

    }

    public function get_count_mode($table,$where){
        $this->db->select('count(mode) as mode,user_id');
        $query = $this->db->get_where($table,$where);
        $row = $query->result_array();
        return $row;

    }

    public function get_last_id($table,$where){
        $this->db->select('*');
        $this->db->order_by('id','DESC');
        $query = $this->db->get_where($table,$where);
        $row = $query->row_array();
        return $row;
    }


}
