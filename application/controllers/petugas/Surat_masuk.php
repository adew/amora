<?php

class Surat_masuk extends CI_Controller{
    
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
        $this->load->view('petugas/surat_masuk', $data);
    }
    
    public function laporan()
    {
        $user = $this->ion_auth->user()->row();
        $data['title'] = 'Laporan';
        $data['nama_lengkap'] = $user->nama_petugas;
        $data['user_id'] = $user->id;
        $this->load->view('includes/header', $data);
        $this->load->view('petugas/laporan_surat_masuk', $data);
    }
    
    public function select()
    {
        $list = $this->model_surat_masuk->get_datatables();
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
            $row[] = $field->jenis_surat;
            $row[] = $field->ditujukan;
            $row[] = $field->deskripsi;
            $row[] = $field->username;
            if($field->berkas_surat)
            {
                $row[] = '<a href="'. base_url('uploads/'.$field->berkas_surat).'" target="_blank">'.$field->berkas_surat.'</a>';
            }
            else
            {
                $row[] = '(No file)';
            }
            $row[] = $field->sifat_surat;
            $row[] = $field->status_disposisi;
            $row[] = form_button('ajaxUpdateBtn', 'Disposisi', 'class="btn btn-default" onclick="showModal('.$field->id.')"') .
                    form_button('ajaxUpdateBtn', 'Update', 'class="btn btn-default" onclick="editSuratMasuk('.$field->id.')"');

            $data[] = $row;
		}

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_surat_masuk->count_all(),
            "recordsFiltered" => $this->model_surat_masuk->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    
    public function tabel_surat_masuk()
    {
        $list = $this->model_surat_masuk->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->no_surat;
            $row[] = $field->tgl_surat;
            $row[] = $field->perihal;
            $row[] = $field->jenis_surat;
            $row[] = $field->ditujukan;
            $row[] = $field->deskripsi;
            $row[] = $field->username;
            if($field->berkas_surat)
            {
                $row[] = '<a href="'. base_url('uploads/'.$field->berkas_surat).'" target="_blank">'.$field->berkas_surat.'</a>';
            }
            else
            {
                $row[] = '(No file)';
            }
            $row[] = $field->sifat_surat;
            $row[] = $field->status_disposisi;

            $data[] = $row;
		}

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_surat_masuk->count_all(),
            "recordsFiltered" => $this->model_surat_masuk->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    
    public function create()
    {
        $this->_validate();
        
        $user = $this->ion_auth->user()->row();
        $data = array(
            'no_surat' => $this->input->post('no_surat'),
            'tgl_surat' => $this->input->post('tgl_surat'),
            'tgl_input_surat' => mdate('%Y/%m/%d', time()),
            'perihal' => $this->input->post('perihal'),
            'id_jenis_surat' => $this->input->post('jenis_surat'),
            'pengirim' => $this->input->post('pengirim'),
            'ditujukan' => $this->input->post('ditujukan'),
            'deskripsi' => $this->input->post('deskripsi'),
            'id_petugas' => $user->id,
            'sifat_surat' => $this->input->post('sifat_surat'),
            'status_disposisi' => $this->input->post('status_disposisi'),
            'dibuat_pada' => time(),
        );
        
        if (!empty($_FILES['berkas_surat']['name'])) {
            $upload = $this->_do_upload();
            $data['berkas_surat'] = $upload;
        }
       
        $this->model_surat_masuk->save($data);
        echo json_encode(array("status" => TRUE));
    }
    
    public function select_by_id($id)
    {
        $data = $this->model_surat_masuk->get_by_id($id);
        echo json_encode($data);
    }

    public function update()
    {
        $user = $this->ion_auth->user()->row();
        $data = array(
            'no_surat' => $this->input->post('no_surat'),
            'tgl_surat' => $this->input->post('tgl_surat'),
            'perihal' => $this->input->post('perihal'),
            'id_jenis_surat' => $this->input->post('jenis_surat'),
            'pengirim' => $this->input->post('pengirim'),
            'ditujukan' => $this->input->post('ditujukan'),
            'deskripsi' => $this->input->post('deskripsi'),
            'id_petugas' => $user->id,
            'sifat_surat' => $this->input->post('sifat_surat'),
            'status_disposisi' => $this->input->post('status_disposisi'),
        );
        
        if (!empty($_FILES['berkas_surat']['name'])) {
            $upload = $this->_do_upload();
            $data['berkas_surat'] = $upload;
        }
       
        $this->model_surat_masuk->update(array('id_surat_masuk' => $this->input->post('id_surat_masuk')),$data);
        echo json_encode(array("status" => TRUE));
    }
    
    public function delete()
     {
         $list_id = $this->input->post('id');
         foreach ($list_id as $id) {
             $this->model_surat_masuk->delete_by_id($id);
         }
         echo json_encode(array("status" => TRUE));
     }
     
     private function _do_upload()
     {
        $this->load->helper('string');
         
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'jpg|png|pdf|docx';
        $config['max_size'] = 80000; //set max size allowed in Kilobyte
        
        $config['file_name'] = random_string('numeric', 16);

        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('berkas_surat')) { //upload and validate
            $data['inputerror'][] = 'berkas_surat';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }

        return $this->upload->data('file_name');
    }



    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
    
     public function disposisi_surat_masuk($id)
     {
        $data = $this->model_disposisi_surat_masuk->get_by_id($id);
        echo json_encode($data); 
     }
    
    public function buat_disposisi()
    {
        $this->load->library(array('PDF_1', 'table'));
        $this->load->helper('date');
        $user = $this->ion_auth->user()->row();        
        $id_surat_masuk = $this->input->post('idSurat1');
        $data = array(
            'tgl_disposisi' => mdate('%Y-%m-%d', time()),
            'keterangan' => $this->input->post('ketDisposisi'),
            'id_surat_masuk' => $id_surat_masuk,
            'id_petugas' => $user->id,
            'dibuat_pada' => time()
        );
        $id = $this->model_disposisi_surat_masuk->save($data);
        
        $update = $this->model_surat_masuk->status_disposisi(array('id_surat_masuk' => $id_surat_masuk), array('status_disposisi' => 'Sudah Disposisi'));

        $data['today'] = mdate('%Y-%m-%d', time());
        
        $this->db->from('v_disposisi_surat_masuk');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $data['disposisi_surat_masuk'] = $query->row();
        
        $this->load->view('laporan/lembar_disposisi', $data);
    }

    
}
