<?php

class Model_data_petugas extends CI_Model {

	var $table = 'v_petugas';
	var $column_order = array(null, 'nama_petugas', 'username', 'jenis_kelamin', 'tgl_lahir', 'alamat', 'email', 'telp');
	var $column_search = array('nama_petugas', 'username', 'jenis_kelamin', 'tgl_lahir', 'alamat', 'email', 'telp');
	var $order = array('id' => 'asc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);
                                $this->db->order_by('id', 'DESC');

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
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
        $this->db->where('id',$id);
        $query = $this->db->get();

        return $query->row();
    }
    
    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('petugas');
    }
    
    public function get_rows()
    {
        $this->db->from($this->table);
        $this->db->order_by('nama_petugas', 'ASC');
        $query = $this->db->get();
        
        return $query->result();
    }
}
