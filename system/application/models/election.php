<?php

class Election extends Model {

	function Election()
	{
		parent::Model();
	}

	function insert($election)
	{
		return $this->db->insert('elections', $election);
	}

	function update($election, $id)
	{
		return $this->db->update('elections', $election, compact('id'));
	}

	function delete($id)
	{
		$this->db->where(compact('id'));
		return $this->db->delete('elections');
	}

	function select($id)
	{
		$this->db->from('elections');
		$this->db->where(compact('id'));
		$query = $this->db->get();
		return $query->row_array();
	}

	function select_all()
	{
		$this->db->from('elections');
		$query = $this->db->get();
		return $query->result_array();
	}

	function select_all_by_level()
	{
		$this->db->from('elections');
		$this->db->where('parent_id', '0');
		$this->db->order_by('id', 'asc');
		$query = $this->db->get();
		$parents = $query->result_array();
		$return = array();
		foreach ($parents as $parent)
		{
			$return[] = $parent;
			$this->db->from('elections');
			$this->db->where('parent_id', $parent['id']);
			$this->db->order_by('id', 'asc');
			$query = $this->db->get();
			$return = array_merge($return, $query->result_array());
		}
		return $return;
	}

	function select_all_children_by_parent_id($id)
	{
		$this->db->from('elections');
		$this->db->where('parent_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	function select_all_parents()
	{
		$this->db->from('elections');
		$this->db->where('parent_id', '0');
		$query = $this->db->get();
		return $query->result_array();
	}

}

?>