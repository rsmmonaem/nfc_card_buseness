<?php
ob_start();
class add_temple_model extends CI_Model
{

// Create Notice
    function create_temple()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("temple_name", "temple_name", "xss_clean");
        $this->form_validation->set_rules("temple_division", "temple_division", "xss_clean");
        $this->form_validation->set_rules("temple_district", "temple_district", "xss_clean");
        $this->form_validation->set_rules("temple_thana", "temple_thana", "xss_clean");
        $this->form_validation->set_rules("temple_union", "temple_union", "xss_clean");
        $this->form_validation->set_rules("temple_village", "temple_village", "xss_clean");
        $this->form_validation->set_rules("temple_address", "temple_address", "xss_clean");
        $this->form_validation->set_rules("temple_contact_number", "temple_contact_number", "xss_clean");
        $this->form_validation->set_rules("temple_found_date", "temple_found_date", "xss_clean");
        $this->form_validation->set_rules("temple_com_name", "temple_com_name", "xss_clean");
        $this->form_validation->set_rules("temple_com_division", "temple_com_division", "xss_clean");
        $this->form_validation->set_rules("temple_com_district", "temple_com_district", "xss_clean");
        $this->form_validation->set_rules("temple_com_thana", "temple_com_thana", "xss_clean");
        $this->form_validation->set_rules("temple_com_village", "temple_com_village", "xss_clean");
        $this->form_validation->set_rules("temple_com_union", "temple_com_union", "xss_clean");
        $this->form_validation->set_rules("temple_com_address", "temple_com_address", "xss_clean");
        $this->form_validation->set_rules("temple_com_mobile", "temple_com_mobile", "xss_clean");
        $this->form_validation->set_rules("temple_com_reg_no", "temple_com_reg_no", "xss_clean");
        $this->form_validation->set_rules("temple_com_nid", "temple_com_nid", "xss_clean");
        $this->form_validation->set_rules("temple_com_image", "temple_com_image", "xss_clean");
        $this->form_validation->set_rules("temple_com_fathers_name", "temple_com_fathers_name", "xss_clean");
        $this->form_validation->set_rules("temple_com_mothers_name", "temple_com_mothers_name", "xss_clean");
        $this->form_validation->set_rules("temple_username", "temple_username", "xss_clean");
        $this->form_validation->set_rules("temple_password", "temple_password", "xss_clean");



        if ($this->form_validation->run() == FALSE) {
            // $this->load->view('super_admin/company_list/error');


        } else {

            $temple_image = $_FILES['temple_com_image']['name'];
            if ($temple_image != "") {
                $temple_image = random_string('alnum', 10) . '.jpg';

                //insert image
                $config['file_name'] = $temple_image;
                $config['upload_path'] = 'uploads/temple';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '100000';
                $config['encrypt_name'] = false;
                $config['image_library'] = 'gd2';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('temple_com_image');

                $file_data = $this->upload->data();
            } else {
                $temple_image = "default.png";
            }


            //insert data to database

            $data = array(
                'temple_name' => $this->input->post('temple_name'),
                'temple_found_date' => $this->input->post('temple_found_date'),
                'temple_contact_number' => $this->input->post('temple_contact_number'),
                'temple_division' => $this->input->post('temple_division'),
                'temple_district' => $this->input->post('temple_district'),
                'temple_village' => $this->input->post('temple_village'),
                'temple_union' => $this->input->post('temple_union'),
                'temple_address' => $this->input->post('temple_address'),
                'temple_com_name' => $this->input->post('temple_com_name'),
                'temple_com_district' => $this->input->post('temple_com_district'),
                'temple_com_thana' => $this->input->post('temple_com_thana'),
                'temple_com_union' => $this->input->post('temple_com_union'),
                'temple_com_village' => $this->input->post('temple_com_village'),
                'temple_com_division' => $this->input->post('temple_com_division'),
                'temple_com_address' => $this->input->post('temple_com_address'),
                'temple_com_mobile' => $this->input->post('temple_com_mobile'),
                'temple_com_reg_no' => $this->input->post('temple_com_reg_no'),
                'temple_com_nid' => $this->input->post('temple_com_nid'),
                'temple_com_date_of_birth' => $this->input->post('temple_com_date_of_birth'),
                'temple_com_fathers_name' => $this->input->post('temple_com_fathers_name'),
                'temple_com_mothers_name' => $this->input->post('temple_com_mothers_name'),
                'temple_username' => $this->input->post('temple_username'),
                'temple_password' => $this->input->post('temple_password'),
                'temple_com_image' => $temple_image,

            );
		

            $this->db->insert('temple', $data);

			
			// Admin Insert

			$data2 = array(
				'full_name'             => $this->input->post('temple_name'),
				'user_name' 		=> $this->input->post('temple_username'),
                'pass_word' 		=> $this->input->post('temple_password'),
				'user_type' 		=> 'temple_admin',  
				'status' 		=> 'ENABLE', 
				            
            );           
			$this->db->insert('admin_user', $data2);
            //$id = $this->db->insert_id();
            $this->session->set_flashdata('message', '<div class="alert alert-success">Record has been Created successfully.</div>');
            redirect("super_admin/add_temple");
        }
    }

    function get_temple() {
        $this->db->order_by("temple_id", "DESC");
        $query = $this->db->get("temple");
        return $query->result();
    }

    function temple_delete($temple_id) {
        $this->session_data();
        $temple_id = $this->uri->segment(3);
        $this->db->where('temple_id', $temple_id);
        $this->db->delete('temple');
        redirect("super_admin/temple_list");
    }

    function get_temple_id($table, $id)
    {
        $result = $this->db->get_where($table, ['temple_id' => $id])->row();
        return $result;
    }


    function update_temple() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("temple_name", "temple_name", "xss_clean");
        $this->form_validation->set_rules("temple_division", "temple_division", "xss_clean");
        $this->form_validation->set_rules("temple_district", "temple_district", "xss_clean");
        $this->form_validation->set_rules("temple_thana", "temple_thana", "xss_clean");
        $this->form_validation->set_rules("temple_union", "temple_union", "xss_clean");
        $this->form_validation->set_rules("temple_village", "temple_village", "xss_clean");
        $this->form_validation->set_rules("temple_address", "temple_address", "xss_clean");
        $this->form_validation->set_rules("temple_contact_number", "temple_contact_number", "xss_clean");
        $this->form_validation->set_rules("temple_found_date", "temple_found_date", "xss_clean");
        $this->form_validation->set_rules("temple_com_name", "temple_com_name", "xss_clean");
        $this->form_validation->set_rules("temple_com_division", "temple_com_division", "xss_clean");
        $this->form_validation->set_rules("temple_com_district", "temple_com_district", "xss_clean");
        $this->form_validation->set_rules("temple_com_thana", "temple_com_thana", "xss_clean");
        $this->form_validation->set_rules("temple_com_village", "temple_com_village", "xss_clean");
        $this->form_validation->set_rules("temple_com_union", "temple_com_union", "xss_clean");
        $this->form_validation->set_rules("temple_com_address", "temple_com_address", "xss_clean");
        $this->form_validation->set_rules("temple_com_mobile", "temple_com_mobile", "xss_clean");
        $this->form_validation->set_rules("temple_com_reg_no", "temple_com_reg_no", "xss_clean");
        $this->form_validation->set_rules("temple_com_nid", "temple_com_nid", "xss_clean");
        $this->form_validation->set_rules("temple_com_image", "temple_com_image", "xss_clean");
        $this->form_validation->set_rules("temple_com_fathers_name", "temple_com_fathers_name", "xss_clean");
        $this->form_validation->set_rules("temple_com_mothers_name", "temple_com_mothers_name", "xss_clean");
        $this->form_validation->set_rules("temple_username", "temple_username", "xss_clean");
        $this->form_validation->set_rules("temple_password", "temple_password", "xss_clean");



        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
            //$this->load->view('super_admin/company_list/error');
        } else {

            $temple_image = $_FILES['temple_com_image']['name'];

            //OLD IMAGE
            $prev_image = $this->input->post('old_image');


            if ($temple_image != "") {
                $temple_image = random_string('alnum', 10) . '.jpg';
                //insert image
                $config['file_name'] = $temple_image;
                $config['upload_path'] = 'uploads/temple';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']         = '100000';
                $config['encrypt_name']     = false;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('temple_com_image');

                $file_data = $this->upload->data();
            } else {
                $temple_image = $prev_image;
            }

            $temple_id = $this->uri->segment(3);

            //zone change

            // echo $company_code = $this->input->post('company_code');


            //insert data to database

            $data = array(
                'temple_name' => $this->input->post('temple_name'),
                'temple_found_date' => $this->input->post('temple_found_date'),
                'temple_contact_number' => $this->input->post('temple_contact_number'),
                'temple_division' => $this->input->post('temple_division'),
                'temple_district' => $this->input->post('temple_district'),
                'temple_village' => $this->input->post('temple_village'),
                'temple_union' => $this->input->post('temple_union'),
                'temple_address' => $this->input->post('temple_address'),
                'temple_com_name' => $this->input->post('temple_com_name'),
                'temple_com_district' => $this->input->post('temple_com_district'),
                'temple_com_division' => $this->input->post('temple_com_division'),
                'temple_com_thana' => $this->input->post('temple_com_thana'),
                'temple_com_union' => $this->input->post('temple_com_union'),
                'temple_com_village' => $this->input->post('temple_com_village'),
                'temple_com_address' => $this->input->post('temple_com_address'),
                'temple_com_mobile' => $this->input->post('temple_com_mobile'),
                'temple_com_reg_no' => $this->input->post('temple_com_reg_no'),
                'temple_com_nid' => $this->input->post('temple_com_nid'),
                'temple_com_date_of_birth' => $this->input->post('temple_com_date_of_birth'),
                'temple_com_fathers_name' => $this->input->post('temple_com_fathers_name'),
                'temple_com_mothers_name' => $this->input->post('temple_com_mothers_name'),
                'temple_username' => $this->input->post('temple_username'),
                'temple_password' => $this->input->post('temple_password'),
                'temple_com_image' => $temple_image,


            );


            $this->db->where('temple_id', $temple_id);
            $this->db->update('temple', $data);
        }
    }


}
