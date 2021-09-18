<?php

class Model_data_nominatif extends CI_Model
{
	var $table = 'nominatif';
	var $column_order = array(null, null, 'no_surat', 'tgl_surat', 'perihal', 'pengirim', 'kepada', 'jenis_surat', 'sifat_surat', 'petugas', 'deskripsi', null);
	var $column_search = array('no_surat', 'tgl_surat', 'perihal', 'pengirim', 'kepada', 'jenis_surat', 'sifat_surat', 'petugas', 'deskripsi');
	var $order = array('id' => 'asc');

	public static $jenis = array(
		'kejahatan' => 'Kejahatan',
		'pelanggaran' => 'Pelanggaran'
	);

	public static $pelaku = array(
		'1' => 'TNI AD',
		'2' => 'TNI AL',
		'3' => 'TNI AU'
	);

	public static $bulan = array(
		1 => 'Januari',
		2 => 'Februari',
		3 => 'Maret',
		4 => 'April',
		5 => 'Mei',
		6 => 'Juni',
		7 => 'Juli',
		8 => 'Agustus',
		9 => 'September',
		10 => 'Oktober',
		11 => 'November',
		12 => 'Desember',
	);


	public function __construct()
	{
		parent::__construct();
	}

	private function _get_datatables_query()
	{

		$this->db->from($this->table);
		$this->db->order_by('id', 'DESC');

		$i = 0;

		foreach ($this->column_search as $item) // loop column 
		{
			if ($_POST['search']['value']) // if datatable send POST for search
			{

				if ($i === 0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}

		if (isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_surat_keluar', $id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id_surat_keluar', $id);
		$this->db->delete($this->table);
	}

	public function getStatistic($tahun){
		$this->db->where('tahun', $tahun);
		$this->db->from($this->table);

		$query = $this->db->get();

		return $query->result_array();
	}
	
	public function getLastYear($tahun){
		$tahun = $tahun - 1;

		$sql = "select jenis, pelaku, sum(jml_perkara_masuk) jml_perkara_masuk, sum(jml_perkara_putus) jml_perkara_putus
		 from nominatif
		 where tahun = '".$tahun."'
		 group by jenis, pelaku";

		 $query = $this->db->query($sql);

		 return $query->result_array();
	}
}
