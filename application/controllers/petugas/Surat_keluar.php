<?php

class Surat_keluar extends CI_Controller{
    
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
        
        $this->load->view('includes/header', $data);
        $this->load->view('petugas/surat_keluar', $data);
    }
    
    public function laporan()
    {
        $user = $this->ion_auth->user()->row();
        $data['title'] = 'Laporan';
        $data['nama_lengkap'] = $user->nama_petugas;
        $data['user_id'] = $user->id;
        $this->load->view('includes/header', $data);
        $this->load->view('petugas/laporan_surat_keluar', $data);
    }
    
    public function select()
    {
        $list = $this->model_surat_keluar->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = '<input type="checkbox" class="data-check" value="'.$field->id.'" onclick="enableDeleteBtn()"/>';
            $row[] = $no;
            $row[] = $field->no_surat;
            $row[] = $field->tgl_surat;
            $row[] = $field->perihal;
            $row[] = $field->pengirim;
            $row[] = $field->kepada;
            $row[] = $field->jenis_surat;
            $row[] = $field->sifat_surat;
            $row[] = $field->petugas;
            $row[] = $field->deskripsi;
            $row[] = form_button('ajaxUpdateBtn', 'Update', 'class="btn btn-default" onclick="editSuratKeluar('.$field->id.')"');

            $data[] = $row;
		}

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_surat_keluar->count_all(),
            "recordsFiltered" => $this->model_surat_keluar->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    
    public function tabel_surat_keluar()
    {
        $list = $this->model_surat_keluar->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->no_surat;
            $row[] = $field->tgl_surat;
            $row[] = $field->perihal;
            $row[] = $field->pengirim;
            $row[] = $field->kepada;
            $row[] = $field->jenis_surat;
            $row[] = $field->sifat_surat;
            $row[] = $field->petugas;
            $row[] = $field->deskripsi;
            

            $data[] = $row;
		}

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_surat_keluar->count_all(),
            "recordsFiltered" => $this->model_surat_keluar->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    
    public function save()
    {
        
        $user = $this->ion_auth->user()->row();
        $data = array(
            'no_surat' => $this->input->post('no_surat'),
            'tgl_surat' => $this->input->post('tgl_surat'),
            'perihal' => $this->input->post('perihal'),
            'id_jenis_surat' => $this->input->post('jenis_surat'),
            'pengirim' => $this->input->post('pengirim'),
            'kepada' => $this->input->post('ditujukan'),
            'deskripsi' => $this->input->post('deskripsi'),
            'id_petugas' => $user->id,
            'sifat_surat' => $this->input->post('sifat_surat'),
            'dibuat_pada' => time(),
        );

        $this->model_surat_keluar->save($data);
        echo json_encode(array("status" => TRUE));
    }
    
    public function select_by_id($id)
    {
        $data = $this->model_surat_keluar->get_by_id($id);
        echo json_encode($data);
    }
    
    public function update()
    {
        $data = array(
            'no_surat' => $this->input->post('no_surat'),
            'tgl_surat' => $this->input->post('tgl_surat'),
            'perihal' => $this->input->post('perihal'),
            'id_jenis_surat' => $this->input->post('jenis_surat'),
            'pengirim' => $this->input->post('pengirim'),
            'kepada' => $this->input->post('ditujukan'),
            'deskripsi' => $this->input->post('deskripsi'),
            'id_petugas' => $this->ion_auth->user()->row()->id,
            'sifat_surat' => $this->input->post('sifat_surat'),
        );
       
        $this->model_surat_keluar->update(array('id_surat_keluar' => $this->input->post('id_surat_keluar')),$data);
        echo json_encode(array("status" => TRUE));
    }
    
    public function delete()
     {
         $list_id = $this->input->post('id');
         foreach ($list_id as $id) {
             $this->model_surat_keluar->delete_by_id($id);
         }
         echo json_encode(array("status" => TRUE));
     }
    
}
