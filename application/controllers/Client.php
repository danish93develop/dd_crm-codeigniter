<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('Campaign_Model');
		$this->load->model('Client_Model');
	}

	public function index()
	{
		$data['company'] = $this->Campaign_Model->fetch_companies();
		$this->load->view('common/header');
		$this->load->view('client/index', $data);
	}

	public function saveClientData()
	{
		if(isset($_POST['clientSubmit'])){			
			$data = array(
				'company_id' => $this->input->post('company'),
				'clientName' => $this->input->post('clientName'),
				'gstNumber' => $this->input->post('gstNumber'),
				'address' => $this->input->post('address'),
				'contactNumber' => $this->input->post('contactNumber'),				
				'emailAddress' => $this->input->post('emailAddress'),
				'created' => date('Y-m-d'),				
			);
			$result = $this->Client_Model->insert('clients', $data);
			if ($result) {
				$this->session->set_flashdata('message', 'Data Inserted Successfully!');
				$this->session->set_flashdata('type', 'success');
				redirect('client/index');
			}else {
				$this->session->set_flashdata('message', 'Error!');
				$this->session->set_flashdata('type', 'danger');				
			}
		}
	}

	public function listClients()
	{
		$data['rowData'] = $this->Client_Model->get('clients');
		$this->load->view('common/header');		
		$this->load->view('client/view_clients', $data);
	}

	public function editClient($id)
	{		
		$this->client = $this->Client_Model->getWhere('clients', array('id'=>$id));
		$this->company = $this->Campaign_Model->fetch_companies();
		$this->data = array(			
			'client' => $this->client,			
			'company' => $this->company			
		);

		if(isset($_POST['clientUpdate'])){
			$data = array(
				'company_id' => $this->input->post('company'),
				'clientName' => $this->input->post('clientName'),
				'gstNumber' => $this->input->post('gstNumber'),
				'address' => $this->input->post('address'),
				'contactNumber' => $this->input->post('contactNumber'),				
				'emailAddress' => $this->input->post('emailAddress'),
				'created' => date('Y-m-d'),				
			);
			$result = $this->Client_Model->update('clients', $data, $id);
			$this->session->set_flashdata('message', 'Data Updated Successfully!');
			$this->session->set_flashdata('type', 'success');

			$this->client = $this->Client_Model->getWhere('clients', array('id'=>$id));
			$this->company = $this->Campaign_Model->fetch_companies();
			$this->data = array(			
				'client' => $this->client,			
				'company' => $this->company			
			);
		}

		$this->load->view('common/header');
		$this->load->view('client/edit_client', $this->data);
	}

	public function delete($id){
		$this->Client_Model->delete('clients', $id);
		$this->session->set_flashdata('message', 'Deleted  successfully!');
		$this->session->set_flashdata('type', 'success');
		redirect('client/view');
	}
}