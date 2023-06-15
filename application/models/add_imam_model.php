<?php
ob_start();
class add_imam_model  extends CI_Model
{

// Create Notice
    function create_imam()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("imam_name", "imam_name", "xss_clean");
        $this->form_validation->set_rules("imam_division", "imam_division", "xss_clean");
        $this->form_validation->set_rules("imam_district", "imam_district", "xss_clean");
        $this->form_validation->set_rules("imam_thana", "imam_thana", "xss_clean");
        $this->form_validation->set_rules("imam_union", "imam_union", "xss_clean");
        $this->form_validation->set_rules("imam_village", "imam_village", "xss_clean");
        $this->form_validation->set_rules("imam_address", "imam_address", "xss_clean");
        $this->form_validation->set_rules("imam_mobile", "imam_mobile", "xss_clean");
        $this->form_validation->set_rules("imam_nid", "imam_nid", "xss_clean");
        $this->form_validation->set_rules("imam_date_of_birth", "imam_date_of_birth", "xss_clean");
        $this->form_validation->set_rules("imam_father_name", "imam_father_name", "xss_clean");
        $this->form_validation->set_rules("imam_image", "imam_image", "xss_clean");
        $this->form_validation->set_rules("imam_username", "imam_username", "xss_clean");
        $this->form_validation->set_rules("imam_password", "imam_password", "xss_clean");



        if ($this->form_validation->run() == FALSE) {


        } else {

            $imam_image = $_FILES['imam_image']['name'];
            if ($imam_image != "") {
                $imam_image = random_string('alnum', 10) . '.jpg';

                //insert image
                $config['file_name'] = $imam_image;
                $config['upload_path'] = 'uploads/imam';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '100000';
                $config['encrypt_name'] = false;
                $config['image_library'] = 'gd2';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('imam_image');

                $file_data = $this->upload->data();
            } else {
                $imam_image = "default.png";
            }


            //insert data to database

            $data = array(
                'imam_name' => $this->input->post('imam_name'),
                'imam_division' => $this->input->post('imam_division'),
                'imam_district' => $this->input->post('imam_district'),
                'imam_thana' => $this->input->post('imam_thana'),
                'imam_union' => $this->input->post('imam_union'),
                'imam_village' => $this->input->post('imam_village'),
                'imam_address' => $this->input->post('imam_address'),
                'imam_mobile' => $this->input->post('imam_mobile'),
                'imam_date_of_birth' => $this->input->post('imam_date_of_birth'),
                'imam_father_name' => $this->input->post('imam_father_name'),
                'imam_username' => $this->input->post('imam_username'),
                'imam_password' => $this->input->post('imam_password'),
                'imam_nid' => $this->input->post('imam_nid'),
                'imam_image' => $imam_image,

            );

            $this->db->insert('imam', $data);

			$data2 = array(
				'full_name'             => $this->input->post('imam_name'),
				'user_name' 		=> $this->input->post('imam_username'),
                'pass_word' 		=> $this->input->post('imam_password'),
				'user_type' 		=> 'imam_admin',  
				'status' 		=> 'ENABLE', 
				            
            );
           
			$this->db->insert('admin_user', $data2);
            //$id = $this->db->insert_id();
            $this->session->set_flashdata('message', '<div class="alert alert-success">Record has been Created successfully.</div>');
           
        }
    }

    function get_imam() {
        $this->db->order_by("imam_id", "DESC");
        $query = $this->db->get("imam");
        return $query->result();
    }

    function imam_delete($imam_id) {
        $this->session_data();
        $news_id = $this->uri->segment(3);
        $this->db->where('imam_id', $imam_id);
        $this->db->delete('imam');
    }

    function get_imam_id($table, $id)
    {
        $result = $this->db->get_where($table, ['imam_id' => $id])->row();
        return $result;
    }


    function update_imam() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("imam_name", "imam_name", "xss_clean");
        $this->form_validation->set_rules("imam_division", "imam_division", "xss_clean");
        $this->form_validation->set_rules("imam_district", "imam_district", "xss_clean");
        $this->form_validation->set_rules("imam_thana", "imam_thana", "xss_clean");
        $this->form_validation->set_rules("imam_union", "imam_union", "xss_clean");
        $this->form_validation->set_rules("imam_village", "imam_village", "xss_clean");
        $this->form_validation->set_rules("imam_address", "imam_address", "xss_clean");
        $this->form_validation->set_rules("imam_mobile", "imam_mobile", "xss_clean");
        $this->form_validation->set_rules("imam_nid", "imam_nid", "xss_clean");
        $this->form_validation->set_rules("imam_date_of_birth", "imam_date_of_birth", "xss_clean");
        $this->form_validation->set_rules("imam_father_name", "imam_father_name", "xss_clean");
        $this->form_validation->set_rules("imam_image", "imam_image", "xss_clean");
        $this->form_validation->set_rules("imam_username", "imam_username", "xss_clean");
        $this->form_validation->set_rules("imam_password", "imam_password", "xss_clean");


        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
        } else {

            $imam_image = $_FILES['imam_image']['name'];

            //OLD IMAGE
            $prev_image = $this->input->post('old_image');


            if ($imam_image != "") {
                $imam_image = random_string('alnum', 10) . '.jpg';
                //insert image
                $config['file_name'] = $imam_image;
                $config['upload_path'] = 'uploads/imam';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']         = '100000';
                $config['encrypt_name']     = false;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('imam_image');

                $file_data = $this->upload->data();
            } else {
                $imam_image = $prev_image;
            }

            $imam_id = $this->uri->segment(3);

            //zone change

            // echo $company_code = $this->input->post('company_code');


            //insert data to database

            $data = array(
                'imam_name' => $this->input->post('imam_name'),
                'imam_division' => $this->input->post('imam_division'),
                'imam_district' => $this->input->post('imam_district'),
                'imam_thana' => $this->input->post('imam_thana'),
                'imam_union' => $this->input->post('imam_union'),
                'imam_village' => $this->input->post('imam_village'),
                'imam_address' => $this->input->post('imam_address'),
                'imam_mobile' => $this->input->post('imam_mobile'),
                'imam_date_of_birth' => $this->input->post('imam_date_of_birth'),
                'imam_father_name' => $this->input->post('imam_father_name'),
                'imam_nid' => $this->input->post('imam_nid'),
                'imam_username' => $this->input->post('imam_username'),
                'imam_password' => $this->input->post('imam_password'),
                'imam_image' => $imam_image,


            );


            $this->db->where('imam_id', $imam_id);
            $this->db->update('imam', $data);
        }
    }


}
