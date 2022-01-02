<?php

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'model_laporan_surat_masuk',
            'model_laporan_surat_keluar',
            'model_laporan_disposisi_surat_masuk'
        ));
    }

    public function view($page)
    {

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('/', 'refresh');
        }

        $data['title'] = 'Laporan';
        $user = $this->ion_auth->user()->row();

        if (!file_exists(APPPATH . 'views/pages/laporan/' . $page . '.php')) {
            show_404();
        }

        $data['nama_lengkap'] = $user->nama_petugas;
        $data['user_id'] = $user->id;
        $this->load->view('includes/header', $data);
        $this->load->view('includes/sidebar', $data);

        switch ($page) {
            case 'surat_masuk':
                $this->load->view('pages/laporan/surat_masuk', $data);
                break;
            case 'surat_keluar':
                $this->load->view('pages/laporan/surat_keluar', $data);
                break;
            case 'disposisi_surat_masuk':
                $this->load->view('pages/laporan/disposisi_surat_masuk', $data);
                break;
        }
    }

    public function surat_masuk()
    {
        $list = $this->model_laporan_surat_masuk->get_datatables();
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
            $row[] = $field->jenis_surat;
            $row[] = $field->deskripsi;
            $row[] = $field->username;
            if ($field->berkas_surat) {
                $row[] = '<a href="' . base_url('uploads/' . $field->berkas_surat) . '" target="_blank"><i>' . $field->berkas_surat . '</i></a>';
            } else {
                $row[] = '(No file)';
            }

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_laporan_surat_masuk->count_all(),
            "recordsFiltered" => $this->model_laporan_surat_masuk->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function surat_keluar()
    {
        $list = $this->model_laporan_surat_keluar->get_datatables();
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
            "recordsTotal" => $this->model_laporan_surat_keluar->count_all(),
            "recordsFiltered" => $this->model_laporan_surat_keluar->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function disposisi_surat_masuk()
    {
        $list = $this->model_laporan_disposisi_surat_masuk->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->no_surat;
            $row[] = $field->tgl_surat;
            $row[] = $field->tgl_disposisi;
            $row[] = $field->kepada;
            $row[] = $field->keterangan;
            $row[] = $field->username;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_laporan_disposisi_surat_masuk->count_all(),
            "recordsFiltered" => $this->model_laporan_disposisi_surat_masuk->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function print_pdf($no)
    {
        $this->load->library(array('PDF', 'table'));
        $template = array(
            'table_open' => '<table border="1" cellpadding="5">',
            'heading_row_start'     => '<tr>',
            'heading_cell_start' => '<th style="background-color: orange;">',
            'heading_cell_end' => '</th>',
        );
        $this->table->set_template($template);

        $start = $this->input->get('start');
        $end = $this->input->get('end');

        $s_disposisi = $this->input->get('status_disposisi');
        switch ($no) {
            case 1:
                $this->table->set_heading(array(
                    'No',
                    'Nomor Surat',
                    'Tanggal Surat',
                    'Asal Surat',
                    'Perihal',
                    // 'Kepada',
                    'Keterangan'
                ));


                $n = 1;
                foreach ($this->model_laporan_surat_masuk->surat_masuk($start, $end, $s_disposisi) as $row) {
                    $this->table->add_row(
                        $n++,
                        $row->no_surat,
                        $row->tgl_surat,
                        $row->pengirim,
                        $row->perihal,
                        // $row->ditujukan,
                        $row->deskripsi
                    );
                }
                $data['title'] = 'Laporan Surat Masuk';
                $data['table'] = $this->table->generate();
                break;
            case 2:
                // print_r($this->model_laporan_surat_keluar->surat_keluar($start, $end));
                // die;
                $this->table->set_heading(array(
                    'No',
                    'Nomor Surat',
                    'Tanggal Surat',
                    'Dari',
                    'Kepada',
                    'Perihal',
                    // 'Jenis Surat',
                    'Keterangan'
                ));

                $n = 1;
                foreach ($this->model_laporan_surat_keluar->surat_keluar($start, $end) as $row) {
                    $this->table->add_row(
                        $n++,
                        $row->no_surat,
                        $row->tgl_surat,
                        $row->pengirim,
                        $row->kepada,
                        $row->perihal,
                        // $row->jenis_surat,
                        $row->deskripsi
                    );
                }
                $data['title'] = 'Laporan Surat Keluar';
                $data['table'] = $this->table->generate();
                break;
            case 3:
                $this->table->set_heading(array(
                    'No',
                    'Nomor Surat',
                    'Tanggal Surat',
                    'Dari',
                    'Kepada',
                    'Keterangan'
                ));

                $n = 1;
                foreach ($this->model_laporan_disposisi_surat_masuk->disposisi_surat_masuk($start, $end) as $row) {
                    $this->table->add_row(
                        $n++,
                        $row->no_surat,
                        $row->tgl_surat,
                        $row->dari,
                        $row->kepada,
                        $row->keterangan
                    );
                }
                $data['title'] = 'Laporan Disposisi Surat Masuk';
                $data['table'] = $this->table->generate();
                break;
        }

        $this->load->view('laporan/laporan1', $data);
    }
}
