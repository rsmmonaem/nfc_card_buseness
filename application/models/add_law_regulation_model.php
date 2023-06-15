<?php
ob_start();
class add_law_regulation_model  extends CI_Model {

	// Create Law/Regulation
	function create_law_regulation() {
		$this->load->library("form_validation");
		$this->form_validation->set_rules("law_regulation_no", "law_regulation_no", "xss_clean");
		$this->form_validation->set_rules("law_regulation_title", "law_regulation_title", "xss_clean");
		$this->form_validation->set_rules("law_regulation_description", "law_regulation_description", "xss_clean");



	//insert data to database

	$data = array(
		'law_regulation_no'             => $this->input->post('law_regulation_no'),
		'law_regulation_title'           => $this->input->post('law_regulation_title'),
		'law_regulation_description'     => $this->input->post('law_regulation_description'),
					   
	);

	$this->db->insert('law_regulation', $data);
	//$id = $this->db->insert_id();
	$this->session->set_flashdata('message', '<div class="alert alert-success">Record has been Created successfully.</div>');
	redirect("super_admin/add_law_regulation");
}

    

// Display law regulation
    function get_law_regulation() {
        $this->db->order_by("law_regulation_id", "DESC");
        $query = $this->db->get("law_regulation");
        return $query->result();
		
    }

	// Display law regulation By Id As A row
	function get_law_regulation_id($table, $id)
    {
        $result = $this->db->get_where($table, ['law_regulation_id' => $id])->row();
        return $result;
    }
// Update Display law regulation
    function update_law_regulation() {


        $this->load->library("form_validation");
        $this->form_validation->set_rules("law_regulation_no", "law_regulation_no", "xss_clean");
        $this->form_validation->set_rules("law_regulation_title", "law_regulation_title", "xss_clean");
        $this->form_validation->set_rules("law_regulation_description", "law_regulation_description", "xss_clean");

            //insert data to database

            $data = array(

                'law_regulation_no'             => $this->input->post('law_regulation_no'),
                'law_regulation_title'                 => $this->input->post('law_regulation_title'),
                'law_regulation_description'                 => $this->input->post('law_regulation_description'),
            );

            $this->db->where('law_regulation_id', $law_regulation_id);
            $this->db->update('law_regulation', $data);


        }

	}

