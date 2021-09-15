<?php

class Jenis_surat extends CI_Controller{
    
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
        $data['username'] = $user->username;
        $data['jenis_surat'] = $this->model_jenis_surat->get_rows();
        
        $data['id_jenis_surat'] = array(
            'type' => 'text',
            'name' => 'input1',
            'id' => 'inputIdJenisSurat',
            'class' => 'form-control',
        );
        
        $data['jenis_surat'] = array(
            'type' => 'text',
            'name' => 'input2',
            'id' => 'inputJenisSurat',
            'class' => 'form-control',
        );

        $this->load->view('includes/header', $data);
        $this->load->view('petugas/form_jenis_surat', $data);
    }
    
    public function select()
    {
        $list = $this->model_jenis_surat->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = '<input type="checkbox" class="data-check" value="'.$field->id_jenis_surat.'" onclick="enableDeleteBtn()"/>';
            $row[] = $no;
            $row[] = $field->id_jenis_surat;
            $row[] = $field->jenis_surat;
            $row[] = form_button('ajaxUpdateBtn', 'Update', 'class="btn btn-default" onclick="editJenisSurat('.$field->id_jenis_surat.')"');

            $data[] = $row;
		}

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_jenis_surat->count_all(),
            "recordsFiltered" => $this->model_jenis_surat->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    
    public function select_by_id($id)
    {
        $data = $this->model_jenis_surat->get_by_id($id);
        echo json_encode($data);
    }
    
}
