<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaign extends CI_Controller {

	function __construct() {
        parent::__construct();

        
        $this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->model('Campaign_Model');
    }

	public function index()
	{
		$data['company'] = $this->Campaign_Model->fetch_companies();
		$this->load->view('common/header');
		$this->load->view('campaign/index', $data);
	}
	
	public function fetch_clients()
	{
	  if($this->input->post('company_id'))
	  {
	   echo $this->Campaign_Model->fetch_clients($this->input->post('company_id'));
	  }
	}

	public function fetch_compaign()
	{
		$compID = $this->input->post('company_id');
		$clientID = $this->input->post('client_id');		
		if($compID && $clientID){
			echo $this->Campaign_Model->fetch_compaign($compID, $clientID);
		}		
	}

	public function fetch_budget()
	{
		$compID = $this->input->post('company_id');
		$clientID = $this->input->post('client_id');
		$campaignID = $this->input->post('campaign_id');
		$response = array();
		if($compID && $clientID && $campaignID){
			$response['campaign_data'] = $this->Campaign_Model->getCampaignData($campaignID);
			$influencer_list['listData'] = $this->Campaign_Model->getInfluencerList($response['campaign_data']->influencerList);			
			if(!empty($influencer_list)):
				$response['list_content'] = $this->load->view('campaign/influencer_list', $influencer_list, true );
			endif;
		}
		echo json_encode($response);
	}

	
	public function saveCampaignData()
	{
		if(isset($_POST['contactSubmit'])){
			//echo "<pre>"; print_r($_POST); 
			$listid = $this->Campaign_Model->get('list');			
			//die();
			$data = array(
				'company_id' => $this->input->post('company'),
				'client_id' => $this->input->post('client'),
				'campaignName' => $this->input->post('campaignName'),
				'totalBudget' => $this->input->post('totalBudget'),
				'advancePayment' => $this->input->post('advancePayment'),
				'deliveryDate' => date('Y-m-d h:i:s', strtotime(str_replace('/', '-', $this->input->post('deliveryDate')))),
				'platforms' => implode(',', $this->input->post('platforms')),
				'deliverables' => $this->input->post('deliverables'),
				//'influencerList' => $this->input->post('influencerList'),
				'influencerList' => $listid->id,
				'created' => date('Y-m-d H:i:s'),
			);
			$result = $this->Campaign_Model->insert('campaign', $data);
			if ($result) {
				$this->session->set_flashdata('message', 'Data Inserted Successfully!');
				$this->session->set_flashdata('type', 'success');
				redirect('campaign/index');
			}else {
				$this->session->set_flashdata('message', 'Error!');
				$this->session->set_flashdata('type', 'danger');				
			}
		}
	} 

	public function saveInfluencerData()
	{ 
		//print_r($_POST); 	
		$listname = $this->input->post('listName');
		$listData = array(
			'name' => $listname,
			'created' => date('Y-m-d'),
		);
		$result = $this->Campaign_Model->insert('list', $listData);
		$listID = $this->db->insert_id();

		if (!empty($_POST['userName']) && !empty($_POST['igLink']) && !empty($_POST['amount'])) {
		$i = 0;
			foreach ($_POST as $val) {
			    $userName = $_POST['userName'][$i];
			    $igLink = $_POST['igLink'][$i];
			    $amount = $_POST['amount'][$i];
			    $influencerData = array(
					'listID' => $listID,
					'userName' => $userName,
					'igLink' => $igLink,
					'amount' => $amount,
					'created' => date('Y-m-d'),
				);
			    $result = $this->Campaign_Model->insert('influencer_list', $influencerData);
			    $i++;
			  } 
		}		

		die();
	}

	public function saveInvoice()
	{	
     	 $uploadedImageNames = [];
     	 $data = [];   

	      for($i=0; $i<count($_FILES['screenshot']['name']); $i++){
			$imageName = time().'_'.$_FILES['screenshot']['name'][$i];
			array_push($uploadedImageNames, $imageName);

			$_FILES['file']['name'] = $_FILES['screenshot']['name'][$i];
			$_FILES['file']['type'] = $_FILES['screenshot']['type'][$i];
			$_FILES['file']['tmp_name'] = $_FILES['screenshot']['tmp_name'][$i];
			$_FILES['file']['error'] = $_FILES['screenshot']['error'][$i];
			$_FILES['file']['size'] = $_FILES['screenshot']['size'][$i];

			$config['upload_path'] = './assets/images/screenshot/'; 
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = '5000';
			$config['file_name'] = $_FILES['screenshot']['name'][$i];

			move_uploaded_file( $_FILES["screenshot"]["tmp_name"][$i], $config['upload_path'] .  $imageName);
			// if($this->upload->do_upload('file')){
			// 	$uploadData = $this->upload->data();
			// 	$filename = $uploadData['file_name'];

			// 	$data['totalFiles'][] = $filename;
			// 	array_push($uploadedImageNames, $filename);
			// 	echo $filename;
			// }
		 }
		$company = $this->input->post('company');
		$client = $this->input->post('client');
		$campaignName = $this->input->post('campaignName');
		$totalBudget = $this->input->post('totalBudget');
		$actualspent = $this->input->post('actualspent');
		$profit = $this->input->post('profit');		
		if (!empty($_POST['userName']) && !empty($_POST['amount']) && !empty($_POST['invoiceNumber']) && !empty($_POST['payment_status']) && !empty($_POST['payment_date'])) {

			for($i = 0; $i < count($_POST['userName']); $i++) {
				$data = array(
					'company_id' => $company,
					'client_id' => $client,
					'campaign_id' => $campaignName,
					'budget' => $totalBudget,
					'actual_spent' => $actualspent,
					'profit' => $profit,
					'userName' => $_POST['userName'][$i],
					'amount' => $_POST['amount'][$i],
					'invoiceNo' => $_POST['invoiceNumber'][$i],
					'payment_status' => $_POST['payment_status'][$i],
					'payment_date' => date('Y-m-d h:i:s', strtotime(str_replace('/', '-', $_POST['payment_date'][$i]))),
					'screenshot' => $uploadedImageNames[$i],
					'created' => date('Y-m-d'),
				);

				$result = $this->Campaign_Model->insert('payment', $data);
			}		
	   
	      }


		
		die();	
	}


	public function paymentInvoice() 
	{
		$data['company'] = $this->Campaign_Model->fetch_companies();
		$this->load->view('common/header');		
		$this->load->view('campaign/invoice', $data);		
	}

	public function viewCampaigns()
	{
		$data['campaignData'] = $this->Campaign_Model->getCampaignDataArray();
		$this->load->view('common/header');		
		$this->load->view('campaign/view_campaigns', $data);		
	}

	public function editCampaign($id)
	{
		$this->company = $this->Campaign_Model->fetch_companies();
		$this->client = $this->Campaign_Model->getClients();
		$this->campaign = $this->Campaign_Model->getWhere('campaign', array('id'=>$id));
		$this->data = array(
			'company' => $this->company,
			'client' => $this->client,
			'campaign' => $this->campaign
		);

		if(isset($_POST['updateCampaign'])){				
			$data = array(
				'company_id' => $this->input->post('company'),
				'client_id' => $this->input->post('client'),
				'campaignName' => $this->input->post('campaignName'),
				'totalBudget' => $this->input->post('totalBudget'),
				'advancePayment' => $this->input->post('advancePayment'),
				'deliveryDate' => date('Y-m-d h:i:s', strtotime(str_replace('/', '-', $this->input->post('deliveryDate')))),
				'platforms' => implode(',', $this->input->post('platforms')),
				'deliverables' => $this->input->post('deliverables'),
				//'influencerList' => $this->input->post('influencerList'),
				//'influencerList' => $listid->id,				
			);
			//echo '<pre>'; print_r($data); die; 
			$result = $this->Campaign_Model->update('campaign', $data, $id);
			$this->session->set_flashdata('message', 'Data Updated Successfully!');
			$this->session->set_flashdata('type', 'success');
			// 	//redirect('campaign/index');
			// }else {
			// 	$this->session->set_flashdata('message', 'Error!');
			// 	$this->session->set_flashdata('type', 'danger');				
			// }
			$this->campaign = $this->Campaign_Model->getWhere('campaign', array('id'=>$id));
			$this->data = array(
				'company' => $this->company,
				'client' => $this->client,
				'campaign' => $this->campaign
			);
		}
		$this->load->view('common/header');
		$this->load->view('campaign/edit_campaign', $this->data);
	}

	public function delete($id){
		$this->Campaign_Model->delete('campaign', $id);
		$this->session->set_flashdata('message', 'Deleted  successfully!');
		$this->session->set_flashdata('type', 'success');
		redirect('campaign/view');
	}


}
