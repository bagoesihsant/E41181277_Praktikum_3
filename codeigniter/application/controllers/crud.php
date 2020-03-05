<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('status') != "login"){
			return false;
        }
        
    }

	public function index()
	{
        $data['user'] = $this->m_data->tampil_data()->result();
		$this->load->view('v_user',$data);
    }

    public function login()
    {
        $this->load->view('v_login');
    }

    public function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
			);
		$cek = $this->m_data->cek_login("admin",$where)->num_rows();
		if($cek > 0){
 
			$data_session = array(
				'nama' => $username,
				'status' => "login"
				);
 
			$this->session->set_userdata($data_session);
 
			redirect(base_url("crud"));
 
		}else{
			echo "Username dan password salah !";
		}
    }
    
    public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('crud/login'));
	}
    
    public function tambah()
    {
        $this->load->view('v_input');
    }

    public function tambah_aksi(){
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$pekerjaan = $this->input->post('pekerjaan');
 
		$data = array(
			'nama' => $nama,
			'alamat' => $alamat,
			'pekerjaan' => $pekerjaan
			);
		$this->m_data->input_data($data,'user');
		redirect('crud/index');
    }
    
    public 	function hapus($id){
		$where = array('id' => $id);
		$this->m_data->hapus_data($where,'user');
		redirect('crud/index');
    }
    
    public function edit($id){
        $where = array('id' => $id);
        $data['user'] = $this->m_data->edit_data($where,'user')->result();
        $this->load->view('v_update',$data);
    }

    public function update(){
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $pekerjaan = $this->input->post('pekerjaan');
    
        $data = array(
            'nama' => $nama,
            'alamat' => $alamat,
            'pekerjaan' => $pekerjaan
        );
    
        $where = array(
            'id' => $id
        );
    
        $this->m_data->update_data($where,$data,'user');
        redirect('crud/index');
    }

}
