<?php
class Campaign_Model extends CI_Model
{
    function fetch_companies()
    {
        $this->db->order_by("name", "ASC");
        $query = $this->db->get("companies");
        return $query->result();
    }

    function getClients()
    {
        $this->db->order_by("clientName", "ASC");
        $query = $this->db->get("clients");
        return $query->result();
    }

    function get($table)
    {
        $this->db->order_by("id", "DESC");
        return $this->db->get($table)->row();
    }

    function fetch_clients($company_id)
    {
        $this->db->where('company_id', $company_id);
        $this->db->order_by('clientName', 'ASC');
        $query = $this->db->get('clients');
        $output = '<option value="">Select Client</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->clientName . '</option>';
        }
        return $output;
    }

    function fetch_compaign($compID, $clientID)
    {
        $this->db->where("(company_id=$compID AND client_id=$clientID)", NULL, FALSE);
        //$this->db->order_by('clientName', 'ASC');
        $query = $this->db->get('campaign');
        $output = '<option value="">Select Campaign</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->campaignName . '</option>';
        }
        return $output;
    }

    function getInfluencerList($influencer_id){
      return $this->db->get_where('influencer_list', array("listID"=>$influencer_id))->result();
    }

    function getCampaignData($campaignID){        
        return $this->db->get_where('campaign',array("id"=>$campaignID))->row();        
    }

    function getCampaignDataArray(){  
        $this->db->select('campaign.*, companies.name, clients.clientName');
        $this->db->from('campaign');
        $this->db->join('companies', 'companies.id = campaign.company_id');
        $this->db->join('clients', 'clients.id = campaign.client_id');                
        $query = $this->db->get();        
        return $query->result();     
        
    }

    function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function getWhere($table, $array) {
        $query = $this->db->get_where($table, $array);
        return $query->row();
    }

    function update($table, $update, $id) {
            $this->db->where('id', $id);
            $this->db->update($table, $update);
        }

    function imageUpload($img, $name, $path){
            $this->load->library('image_lib');
            $config['upload_path'] = './assets/images/'.$path;
            $config['allowed_types'] = 'jpg|png|jpeg';            
            $config['file_name'] = $name;
            
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload($img)){
                $error = array('error' => $this->upload->display_errors());
                } else {
                $file = $this->upload->data();
                $files = glob($config['upload_path'].'/*');
                
                $config = array(
                'source_image'      => $file['full_path'],
                'new_image'         => './assets/images/'.$path,
                'maintain_ratio'    => false,
                );
                $this->image_lib->initialize($config);
                
                $data = array('upload_data' => $this->upload->data());
                return array($file['file_name'],'');
            }
        }

        function delete($table, $id) {
            $this->db->delete($table, array('id' => $id));
        }
}
