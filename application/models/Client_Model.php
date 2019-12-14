<?php
	class Client_Model extends CI_Model
		{

		function insert($table, $data)
	    {
	        $this->db->insert($table, $data);
	        return $this->db->insert_id();
	    }

	    function get($table) {
			$this->db->order_by('id', 'desc');
			$query = $this->db->get($table);
			return $query->result();
		}

	    function getWhere($table, $array) {
	        $query = $this->db->get_where($table, $array);
	        return $query->row();
	    }

	    function update($table, $update, $id) {
	        $this->db->where('id', $id);
	        $this->db->update($table, $update);
	    }

	    function delete($table, $id) {
            $this->db->delete($table, array('id' => $id));
        }
	    

	}

?>
