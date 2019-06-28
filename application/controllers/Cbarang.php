<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cbarang extends CI_Controller {


	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Barang_model');
		$this->load->library(array('form_validation', 'pagination'));
		
		if ($this->session->userdata('username') == FALSE) {
			$this->session->set_flashdata('message', 'Anda harus login');
			redirect(base_url());
		}
	}
	

	public function index()
	{
		$per_page = abs($this->input->get('per_page'));
		$nama = $this->input->get('nama');
		$limit = 10;
		$data['no'] = $per_page + 1;
		
		$data['list'] = $this->Barang_model->show($nama, $limit, $per_page);
		$total_rows = $this->Barang_model->total_rows($nama);
		
		$config['page_query_string'] 	= TRUE;
		$config['base_url'] 			= base_url().'Santri/?nama='.$nama;
		$config['total_rows'] 			= $total_rows;
		$config['per_page'] 			= $limit;
		$config['num_links']			= 10;
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="next page">';
		$config['first_tag_close'] = '</li>';
		
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="prev page">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = 'Prev';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config);

		$this->load->view('Santri/santritampil', $data);

	}

	
	public function create() {

		$this->load->view('Barang/barangtambah', $data);
	}

	public function store() {
		$data['nis'] = $this->input->post('nis');
		$data['nama'] = $this->input->post('nama');
		$data['alamat'] = $this->input->post('alamat');
		$data['asrama'] = $this->input->post('asrama');
		$data['total'] = $this->input->post('total');
		
		$this->form_validation->set_rules('nis', 'NIS', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('asrama', 'Asrama', 'required');
		$this->form_validation->set_rules('total', 'Total Buku yang Diterima', 'required');
		
		if ($this->form_validation->run()) {
			$this->Barang_model->create($data);	
			redirect(base_url('Cbarang'));
		}
		else {
			$this->load->view('Barang/barangtampil');
		}
	}

	public function show() {
		$id = $this->uri->segment(3);
		$data['row'] = $this->Barang_model->first($id);
		$this->load->view('Barang/barangedit', $data);
	}

	public function edit() {
		$data['id'] = $this->uri->segment(3);
		$data['nama_barang'] = $this->input->post('nama');
		$data['harga_barang'] = $this->input->post('harga');
		$data['jumlah_barang'] = $this->input->post('jumlah');
		
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
		$this->form_validation->set_rules('harga_barang', 'Harga Barang', 'required');
		$this->form_validation->set_rules('jumlah_barang', 'Jumlah Barang', 'required');
		
		if ($this->form_validation->run()) {
			$this->Barang_model->edit($data);	
			redirect(base_url('Cbarang'));
		}
		else {
			$data['row'] = FALSE;
			$this->load->view('Barang/barangedit', $data);
		}
	}
	
	public function destroy() {
		$id = $this->uri->segment(3);
		$this->Barang_model->destroy($id);
		redirect(base_url('Cbarang'));
	}
	
}
