<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	
	public function total_rows($nama) {
		$q = $this->db->query('select * from tbl_barang where nama_barang like "%'. $nama .'%"');
		$num = $q->num_rows();
		return $num;
	}
	
	public function show($nama, $limit, $per_page) {
		$q = $this->db->query('select * from tbl_barang where nama_barang like "%'. $nama .'%" limit '.$limit.' offset '.$per_page);
		return $q;
	}

	
	public function first($id) {
		$q = $this->db->query('select * from tbl_barang where id = "'. $id .'"');
		$r = $q->row();
		return $r;
	}

	// public function asrama() {
	// 	$q = $this->db->query('select * from dataasrama');
	// 	return $q;
	// }
	
	// public function show_santri() {
	// 	$q = $this->db->query('select * from tbl_barang');
	// 	return $q;
	// }

	public function create($data) {
		$this->db->query('insert into tbl_barang(id, nama_barang, harga_barang, jumlah_barang)
			values( "'. $data['id'] .'", 
					"'. $data['nama_barang'] .'", 
					"'. $data['harga_barang'] .'", 
					"'. $data['jumlah_barang'] .'")
		');
	}

	public function edit($data) {
		$this->db->query('update tbl_barang set
		 	nama_barang="'. $data['nama_barang'] .'",
			harga_barang="'. $data['harga_barang'] .'",
			jumlah_barang="'. $data['jumlah_barang'] .'",
			
			where id ="'. $data['id'] .'"
			');
	}

	public function destroy($id) {
		$this->db->query('delete from tbl_barang where id = "'.$id.'"');
	}

}