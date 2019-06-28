<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuser extends CI_Controller {


	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('User_model');
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
		
		$data['list'] = $this->User_model->show($nama, $limit, $per_page);
		$total_rows = $this->User_model->total_rows($nama);
		
		$config['page_query_string'] 	= TRUE;
		$config['base_url'] 			= base_url().'User/?nama='.$nama;
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

		$this->load->view('User/usertampil', $data);


	}

	public function create() {

		$this->load->view('User/usertambah', $data);
	}

	public function store() {
		$data['nama'] = $this->input->post('nama');
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		
		$this->form_validation->set_rules('nama', 'Nama User', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run()) {
			$this->User_model->create($data);	
			redirect(base_url('Cuser'));
		}
		else {
			$data['role'] = $this->User_model->role();
			$this->load->view('User/usertampil');
		}
	}
	public function show() {
		$id = $this->uri->segment(3);
		$data['row'] = $this->User_model->first($id);
		$data['role'] = $this->User_model->role();
		$this->load->view('User/useredit', $data);
	}

	public function edit() {
		$data['id'] = $this->uri->segment(3);
		$data['nama'] = $this->input->post('nama');
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		
		$this->form_validation->set_rules('id', 'ID User', 'required');
		$this->form_validation->set_rules('nama', 'Nama User', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run()) {
			$this->User_model->edit($data);	
			redirect(base_url('Cuser'));
		}
		else {
			$data['row'] = FALSE;
			$this->load->view('User/useredit', $data);
		}
	}
	
	public function destroy() {
		$id = $this->uri->segment(3);
		$this->User_model->destroy($id);
		redirect(base_url('Cuser'));
	}
		
}