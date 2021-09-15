<?php

class Petugastu extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array(
            'model_surat_masuk',
            'model_surat_keluar',
            'model_data_petugas',
            'model_jenis_surat',
            'model_disposisi_surat_masuk'
        ));
    }
    
    public function index()
    {
        $user = $this->ion_auth->user()->row();
        $data['title'] = 'Surat Masuk';
        $data['nama_lengkap'] = $user->nama_petugas;
        
        $this->load->view('includes/header', $data);
        $this->load->view('petugas/data_petugas', $data);
    }
    
    public function select()
    {
        $list = $this->model_data_petugas->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();

            $row[] = $no;
            $row[] = $field->nama_petugas;
            $row[] = $field->username;
            $row[] = $field->jenis_kelamin;
            $row[] = $field->tgl_lahir;
            $row[] = $field->alamat;
            $row[] = $field->email;
            $row[] = $field->telp;


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_data_petugas->count_all(),
            "recordsFiltered" => $this->model_data_petugas->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    
}
