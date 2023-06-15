<?php
ob_start();
class add_mosque_model extends CI_Model
{

// Create Notice
    function create_mosque()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("mosque_name", "mosque_name", "xss_clean");
        $this->form_validation->set_rules("mosque_division", "mosque_division", "xss_clean");
        $this->form_validation->set_rules("mosque_district", "mosque_district", "xss_clean");
        $this->form_validation->set_rules("mosque_thana", "mosque_thana", "xss_clean");
        $this->form_validation->set_rules("mosque_union", "mosque_union", "xss_clean");
        $this->form_validation->set_rules("mosque_village", "mosque_village", "xss_clean");
        $this->form_validation->set_rules("mosque_address", "mosque_address", "xss_clean");
        $this->form_validation->set_rules("mosque_contact_number", "mosque_contact_number", "xss_clean");
        $this->form_validation->set_rules("mosque_found_date", "mosque_found_date", "xss_clean");
        $this->form_validation->set_rules("mosque_com_name", "mosque_com_name", "xss_clean");
        $this->form_validation->set_rules("mosque_com_division", "mosque_com_division", "xss_clean");
        $this->form_validation->set_rules("mosque_com_district", "mosque_com_district", "xss_clean");
        $this->form_validation->set_rules("mosque_com_thana", "mosque_com_thana", "xss_clean");
        $this->form_validation->set_rules("mosque_com_village", "mosque_com_village", "xss_clean");
        $this->form_validation->set_rules("mosque_com_union", "mosque_com_union", "xss_clean");
        $this->form_validation->set_rules("mosque_com_address", "mosque_com_address", "xss_clean");
        $this->form_validation->set_rules("mosque_com_mobile", "mosque_com_mobile", "xss_clean");
        $this->form_validation->set_rules("mosque_com_reg_no", "mosque_com_reg_no", "xss_clean");
        $this->form_validation->set_rules("mosque_com_nid", "mosque_com_nid", "xss_clean");
        $this->form_validation->set_rules("mosque_com_image", "mosque_com_image", "xss_clean");
        $this->form_validation->set_rules("mosque_com_fathers_name", "mosque_com_fathers_name", "xss_clean");
        $this->form_validation->set_rules("mosque_com_mothers_name", "mosque_com_mothers_name", "xss_clean");
        $this->form_validation->set_rules("mosque_username", "mosque_username", "xss_clean");
        $this->form_validation->set_rules("mosque_password", "mosque_password", "xss_clean");



        if ($this->form_validation->run() == FALSE) {
          
			


        } else {

            $mosque_image = $_FILES['mosque_com_image']['name'];
            if ($mosque_image != "") {
                $mosque_image = random_string('alnum', 10) . '.jpg';

                //insert image
                $config['file_name'] = $mosque_image;
                $config['upload_path'] = 'uploads/mosque';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '100000';
                $config['encrypt_name'] = false;
                $config['image_library'] = 'gd2';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('mosque_com_image');

                $file_data = $this->upload->data();
            } else {
                $mosque_image = "default.png";
            }


            //insert data to database

            $data = array(
                'mosque_name' => $this->input->post('mosque_name'),
                'mosque_found_date' => $this->input->post('mosque_found_date'),
                'mosque_contact_number' => $this->input->post('mosque_contact_number'),
                'mosque_division' => $this->input->post('mosque_division'),
                'mosque_district' => $this->input->post('mosque_district'),
                'mosque_village' => $this->input->post('mosque_village'),
                'mosque_union' => $this->input->post('mosque_union'),
                'mosque_address' => $this->input->post('mosque_address'),
                'mosque_com_name' => $this->input->post('mosque_com_name'),
                'mosque_com_district' => $this->input->post('mosque_com_district'),
                'mosque_com_thana' => $this->input->post('mosque_com_thana'),
                'mosque_com_union' => $this->input->post('mosque_com_union'),
                'mosque_com_village' => $this->input->post('mosque_com_village'),
                'mosque_com_division' => $this->input->post('mosque_com_division'),
                'mosque_com_address' => $this->input->post('mosque_com_address'),
                'mosque_com_mobile' => $this->input->post('mosque_com_mobile'),
                'mosque_com_reg_no' => $this->input->post('mosque_com_reg_no'),
                'mosque_com_nid' => $this->input->post('mosque_com_nid'),
                'mosque_com_date_of_birth' => $this->input->post('mosque_com_date_of_birth'),
                'mosque_com_fathers_name' => $this->input->post('mosque_com_fathers_name'),
                'mosque_com_mothers_name' => $this->input->post('mosque_com_mothers_name'),
                'mosque_username' => $this->input->post('mosque_username'),
                'mosque_password' => $this->input->post('mosque_password'),
                'mosque_com_image' => $mosque_image,

            );
			$this->db->insert('mosque', $data);





			// Admin Insert

			$data2 = array(
				'full_name'             => $this->input->post('mosque_name'),
				'user_name' 		=> $this->input->post('mosque_username'),
                'pass_word' 		=> $this->input->post('mosque_password'),
				'user_type' 		=> 'mosque_admin',  
				'status' 		=> 'ENABLE', 
				            
            );           
			$this->db->insert('admin_user', $data2);

            $this->session->set_flashdata('message', '<div class="alert alert-success">Record has been Created successfully.</div>');  
        }
    }

    function get_mosque() {
        $this->db->order_by("mosque_id", "DESC");
        $query = $this->db->get("mosque");
        return $query->result();
    }

    function mosque_delete($mosque_id) {
        $this->session_data();
        $mosque_id = $this->uri->segment(3);
        $this->db->where('mosque_id', $mosque_id);
        $this->db->delete('mosque');
       
    }

    function get_mosque_id($table, $id)
    {
        $result = $this->db->get_where($table, ['mosque_id' => $id])->row();
        return $result;
    }


    function update_mosque() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("mosque_name", "mosque_name", "xss_clean");
        $this->form_validation->set_rules("mosque_division", "mosque_division", "xss_clean");
        $this->form_validation->set_rules("mosque_district", "mosque_district", "xss_clean");
        $this->form_validation->set_rules("mosque_thana", "mosque_thana", "xss_clean");
        $this->form_validation->set_rules("mosque_union", "mosque_union", "xss_clean");
        $this->form_validation->set_rules("mosque_village", "mosque_village", "xss_clean");
        $this->form_validation->set_rules("mosque_address", "mosque_address", "xss_clean");
        $this->form_validation->set_rules("mosque_contact_number", "mosque_contact_number", "xss_clean");
        $this->form_validation->set_rules("mosque_found_date", "mosque_found_date", "xss_clean");
        $this->form_validation->set_rules("mosque_com_name", "mosque_com_name", "xss_clean");
        $this->form_validation->set_rules("mosque_com_division", "mosque_com_division", "xss_clean");
        $this->form_validation->set_rules("mosque_com_district", "mosque_com_district", "xss_clean");
        $this->form_validation->set_rules("mosque_com_thana", "mosque_com_thana", "xss_clean");
        $this->form_validation->set_rules("mosque_com_village", "mosque_com_village", "xss_clean");
        $this->form_validation->set_rules("mosque_com_union", "mosque_com_union", "xss_clean");
        $this->form_validation->set_rules("mosque_com_address", "mosque_com_address", "xss_clean");
        $this->form_validation->set_rules("mosque_com_mobile", "mosque_com_mobile", "xss_clean");
        $this->form_validation->set_rules("mosque_com_reg_no", "mosque_com_reg_no", "xss_clean");
        $this->form_validation->set_rules("mosque_com_nid", "mosque_com_nid", "xss_clean");
        $this->form_validation->set_rules("mosque_com_image", "mosque_com_image", "xss_clean");
        $this->form_validation->set_rules("mosque_com_fathers_name", "mosque_com_fathers_name", "xss_clean");
        $this->form_validation->set_rules("mosque_com_mothers_name", "mosque_com_mothers_name", "xss_clean");
        $this->form_validation->set_rules("mosque_username", "mosque_username", "xss_clean");
        $this->form_validation->set_rules("mosque_password", "mosque_password", "xss_clean");



        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
            
        } else {

            $mosque_image = $_FILES['mosque_image']['name'];

            //OLD IMAGE
            $prev_image = $this->input->post('old_image');


            if ($mosque_image != "") {
                $mosque_image = random_string('alnum', 10) . '.jpg';
                //insert image
                $config['file_name'] = $mosque_image;
                $config['upload_path'] = 'uploads/mosque';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']         = '100000';
                $config['encrypt_name']     = false;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('kazi_image');

                $file_data = $this->upload->data();
            } else {
                $mosque_image = $prev_image;
            }

            $mosque_id = $this->uri->segment(3);

            //zone change

            // echo $company_code = $this->input->post('company_code');


            //insert data to database

            $data = array(
                'mosque_name' => $this->input->post('mosque_name'),
                'mosque_found_date' => $this->input->post('mosque_found_date'),
                'mosque_contact_number' => $this->input->post('mosque_contact_number'),
                'mosque_division' => $this->input->post('mosque_division'),
                'mosque_district' => $this->input->post('mosque_district'),
                'mosque_village' => $this->input->post('mosque_village'),
                'mosque_union' => $this->input->post('mosque_union'),
                'mosque_address' => $this->input->post('mosque_address'),
                'mosque_com_name' => $this->input->post('mosque_com_name'),
                'mosque_com_district' => $this->input->post('mosque_com_district'),
                'mosque_com_division' => $this->input->post('mosque_com_division'),
                'mosque_com_thana' => $this->input->post('mosque_com_thana'),
                'mosque_com_union' => $this->input->post('mosque_com_union'),
                'mosque_com_village' => $this->input->post('mosque_com_village'),
                'mosque_com_address' => $this->input->post('mosque_com_address'),
                'mosque_com_mobile' => $this->input->post('mosque_com_mobile'),
                'mosque_com_reg_no' => $this->input->post('mosque_com_reg_no'),
                'mosque_com_nid' => $this->input->post('mosque_com_nid'),
                'mosque_com_date_of_birth' => $this->input->post('mosque_com_date_of_birth'),
                'mosque_com_fathers_name' => $this->input->post('mosque_com_fathers_name'),
                'mosque_com_mothers_name' => $this->input->post('mosque_com_mothers_name'),
                'mosque_username' => $this->input->post('mosque_username'),
                'mosque_password' => $this->input->post('mosque_password'),
                'mosque_com_image' => $mosque_image,
            );



            $this->db->where('mosque_id', $mosque_id);
            $this->db->update('mosque', $data);
        }
    }


}
