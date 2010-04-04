<?php

class Elections extends Controller {

	var $admin;
	var $settings;

	function Elections()
	{
		parent::Controller();
		$this->admin = $this->session->userdata('admin');
		if (!$this->admin)
		{
			$error[] = e('common_unauthorized');
			$this->session->set_flashdata('error', $error);
			redirect('gate/admin');
		}
		$this->settings = $this->config->item('halalan');
	}
	
	function index()
	{
		$data['elections'] = $this->Election->select_all_by_level();
		$admin['username'] = $this->admin['username'];
		$admin['title'] = e('admin_elections_title');
		$admin['body'] = $this->load->view('admin/elections', $data, TRUE);
		$this->load->view('admin', $admin);
	}

	function add()
	{
		$this->_election('add');
	}

	function edit($id)
	{
		$this->_election('edit', $id);
	}

	function delete($id) 
	{
		if (!$id)
			redirect('admin/elections');
		$election = $this->Election->select($id);
		if (!$election)
			redirect('admin/elections');
		if ($election['status'])
		{
			$this->session->set_flashdata('messages', array('negative', e('admin_delete_election_running')));
		}
		else
		{
			$this->Election->delete($id);
			$this->session->set_flashdata('messages', array('positive', e('admin_delete_election_success')));
		}
		redirect('admin/elections');
	}

	function options($case, $id)
	{
		if ($case == 'status' || $case == 'results')
		{
			$election = $this->Election->select($id);
			if ($election)
			{
				$data = array();
				if ($case == 'status')
				{
					if ($election['status'])
					{
						$data['status'] = FALSE;
					}
					else {
						$data['status'] = TRUE;
					}
				}
				else
				{
					if ($election['results'])
					{
						$data['results'] = FALSE;
					}
					else {
						$data['results'] = TRUE;
					}
				}
				if ($election['parent_id'] == 0)
				{
					$children = $this->Election->select_all_children_by_parent_id($id);
					foreach ($children as $child)
					{
						$this->Election->update($data, $child['id']);
					}
				}
				$this->Election->update($data, $id);
				$this->session->set_flashdata('messages', array('positive', e('admin_options_election_success')));
			}
		}
		redirect('admin/elections');
	}

	function _election($case, $id = null)
	{
		if ($case == 'add')
		{
			$data['election'] = array('election'=>'', 'parent_id'=>'');
			$this->session->unset_userdata('election'); // so callback rules know that the action is add
		}
		else if ($case == 'edit')
		{
			if (!$id)
				redirect('admin/elections');
			$data['election'] = $this->Election->select($id);
			if (!$data['election'])
				redirect('admin/elections');
			$this->session->set_flashdata('election', $data['election']); // used in callback rules
		}
		$this->form_validation->set_rules('election', e('admin_election_election'), 'required');
		$this->form_validation->set_rules('parent_id', e('admin_election_parent'));
		if ($this->form_validation->run())
		{
			$election['election'] = $this->input->post('election', TRUE);
			$election['parent_id'] = $this->input->post('parent_id', TRUE);
			if ($case == 'add')
			{
				$this->Election->insert($election);
				$this->session->set_flashdata('messages', array('positive', e('admin_add_election_success')));
				redirect('admin/elections/add');
			}
			else if ($case == 'edit')
			{
				$this->Election->update($election, $id);
				$this->session->set_flashdata('messages', array('positive', e('admin_edit_election_success')));
				redirect('admin/elections/edit/' . $id);
			}
		}
		$data['parents'] = $this->Election->select_all_parents();
		$data['action'] = $case;
		$admin['title'] = e('admin_' . $case . '_election_title');
		$admin['body'] = $this->load->view('admin/election', $data, TRUE);
		$admin['username'] = $this->admin['username'];
		$this->load->view('admin', $admin);
	}

}

/* End of file elections.php */
/* Location: ./system/application/controllers/admin/elections.php */