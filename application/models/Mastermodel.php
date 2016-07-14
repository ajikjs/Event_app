<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mastermodel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /* Common function starts here */

    function get_post_values() {
        $data = array();
        foreach ($_POST as $key => $value) {
            if ($key != "submit") {
                $data[$key] = $this->input->post($key);
            }
        }
        return $data;
    }

    function get_num_rows($table, $field = '', $id = '') {
        if ($field != '')
            $this->db->where($field, $id);
        $Q = $this->db->get($table);
        return $Q->num_rows();
    }

    function get_single_field_value($table, $field, $condition, $value) {

        $data = $this->db->query("select " . $field . " from " . $table . " where " . $condition . "='" . $value . "'");
        $result = $data->row();
        if ($result) {
            return $result->$field;
        } else {
            return "";
        }
    }

    function getdatas($table, $sortfield = "") {
        $data = array();
        if (!empty($sortfield)) {
            $this->db->order_by($sortfield, "asc");
        }
        $Q = $this->db->get($table);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_data($table, $id, $field, $sortfield = "") {
        $data = array();
        $this->db->where($field, $id);
        if (!empty($sortfield)) {
            $this->db->order_by($sortfield, 'asc');
        }
        $Q = $this->db->get($table);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_data_srow($table, $id, $field, $isarray = FALSE) {
        $data = array();
        $this->db->where($field, $id);
        $Q = $this->db->get($table);
        if ($isarray)
            $row = $Q->row_array();
        else
            $row = $Q->row();
        return $row;
    }
	function get_data_array($table, $id, $field) {
        $data = array();
        $this->db->where($field, $id);
        $Q = $this->db->get($table);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function deletedata($table, $id, $field) {
        $data = array();
        $this->db->trans_begin();
        $this->db->delete($table, array($field => $id));
        $this->db->trans_status();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data['res'] = 0;
            $data['msg'] = 'Unable to delete record because of associated data';
        } else {
            $this->db->trans_commit();
            $data['res'] = 1;
            $data['msg'] = 'Data Deleted Successfully';
        }
        return $data;
	}
	function generateRandomString($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
	
               
}	
