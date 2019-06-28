<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function login($username, $password)	{
		$q = $this->db->query('select * from tbl_user where username = "'. $username .'" and password = "'. $password .'"');
		$count = $q->num_rows();
		$r = $q->row();
		if ($count > 0) {
			return $r;
		} else {
			return false;
		}
	}
	
	public function username($id) {
		$q = $this->db->query('select * from tbl_user where username = "'. $id .'"');
		return $q;
	}

	//------------------------welcome-------------------------//

	public function total_rows($nama) {
		$q = $this->db->query('select * from tbl_user where nama like "%'. $nama .'%"');
		$num = $q->num_rows();
		return $num;
	}
	
	public function show($nama, $limit, $per_page) {
		$q = $this->db->query('select * from tbl_user where nama like "%'. $nama .'%" limit '.$limit.' offset '.$per_page);
		return $q;
	}
	
	public function first($id) {
		$q = $this->db->query('select * from tbl_user where id = "'. $id .'"');
		$r = $q->row();
		return $r;
	}

	public function show_user() {
		$q = $this->db->query('select * from tbl_user');
		return $q;
	}

	public function create($data) {
		$this->db->query('insert into tbl_user(id, nama, username, password)
			values( "", 
					"'. $data['nama'] .'", 
					"'. $data['username'] .'", 
					"'. $data['password'] .'")
		');
	}

	public function edit($data) {
		$this->db->query('update tbl_user set
		 	nama="'. $data['nama'] .'",
			username="'. $data['username'] .'",
			password="'. $data['password'] .'",

			where id="'. $data['id'] .'"
			');
	}

	public function destroy($id) {
		$this->db->query('delete from tbl_user where id = "'.$id.'"');
	}
	
		
}