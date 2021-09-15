<?php

class Disposisi_surat_masuk extends CI_Controller{
    
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
        $this->load->view('petugas/disposisi_surat_masuk', $data);
    }
    
    public function laporan()
    {
        $user = $this->ion_auth->user()->row();
        $data['title'] = 'Laporan';
        $data['nama_lengkap'] = $user->nama_petugas;
        $data['user_id'] = $user->id;
        $this->load->view('includes/header', $data);
        $this->load->view('petugas/laporan_disposisi_surat_masuk', $data);
    }
    
    public function select()
    {
        $list = $this->model_disposisi_surat_masuk->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = '<input type="checkbox" class="data-check" value="'.$field->id.'" onclick="enableDeleteBtn()"/>';
            $row[] = $field->no_surat;
            $row[] = $field->tgl_surat;
            $row[] = $field->tgl_disposisi;
            $row[] = $field->dari;
            $row[] = $field->kepada;
            $row[] = $field->keterangan;
            $row[] = $field->username;
            $row[] = timespan($field->dibuat_pada, time(), 1);
            $row[] = anchor('petugas/disposisi_surat_masuk/lembar_disposisi/'.$field->id, 'Print', 'target="_blank" class="btn btn-default"');

            $data[] = $row;
		}

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_disposisi_surat_masuk->count_all(),
            "recordsFiltered" => $this->model_disposisi_surat_masuk->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    
     public function hapus_disposisi()
     {
         $list_id = $this->input->post('id');
         foreach ($list_id as $id) {
             $this->model_disposisi_surat_masuk->delete_by_id($id);
         }
         echo json_encode(array("status" => TRUE));
     }
    
    public function lembar_disposisi($id)
    {
        
        $this->load->library(array('PDF_1', 'table'));
        
        $data['today'] = mdate('%Y-%m-%d', time());
        
        $this->db->from('v_disposisi_surat_masuk');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $data['disposisi_surat_masuk'] = $query->row();
        
        $this->load->view('laporan/lembar_disposisi', $data);
    }
    
}
