<?php
ob_start();
class add_purohit_model  extends CI_Model
{

// Create Notice
    function create_purohit()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("purohit_name", "purohit_name", "xss_clean");
        $this->form_validation->set_rules("purohit_division", "purohit_division", "xss_clean");
        $this->form_validation->set_rules("purohit_district", "purohit_district", "xss_clean");
        $this->form_validation->set_rules("purohit_thana", "purohit_thana", "xss_clean");
        $this->form_validation->set_rules("purohit_union", "purohit_union", "xss_clean");
        $this->form_validation->set_rules("purohit_village", "purohit_village", "xss_clean");
        $this->form_validation->set_rules("purohit_address", "purohit_address", "xss_clean");
        $this->form_validation->set_rules("purohit_mobile", "purohit_mobile", "xss_clean");
        $this->form_validation->set_rules("purohit_nid", "purohit_nid", "xss_clean");
        $this->form_validation->set_rules("purohit_date_of_birth", "purohit_date_of_birth", "xss_clean");
        $this->form_validation->set_rules("purohit_father_name", "purohit_father_name", "xss_clean");
        $this->form_validation->set_rules("purohit_image", "purohit_image", "xss_clean");



        if ($this->form_validation->run() == FALSE) {
            // $this->load->view('super_admin/company_list/error');


        } else {

            $purohit_image = $_FILES['purohit_image']['name'];
            if ($purohit_image != "") {
                $purohit_image = random_string('alnum', 10) . '.jpg';

                //insert image
                $config['file_name'] = $purohit_image;
                $config['upload_path'] = 'uploads/purohit';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '100000';
                $config['encrypt_name'] = false;
                $config['image_library'] = 'gd2';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('purohit_image');

                $file_data = $this->upload->data();
            } else {
                $purohit_image = "default.png";
            }


            //insert data to database

            $data = array(
                'purohit_name' => $this->input->post('purohit_name'),
                'purohit_division' => $this->input->post('purohit_division'),
                'purohit_district' => $this->input->post('purohit_district'),
                'purohit_thana' => $this->input->post('purohit_thana'),
                'purohit_union' => $this->input->post('purohit_union'),
                'purohit_village' => $this->input->post('purohit_village'),
                'purohit_address' => $this->input->post('purohit_address'),
                'purohit_mobile' => $this->input->post('purohit_mobile'),
                'purohit_date_of_birth' => $this->input->post('purohit_date_of_birth'),
                'purohit_father_name' => $this->input->post('purohit_father_name'),
                'purohit_nid' => $this->input->post('purohit_nid'),
                'purohit_image' => $purohit_image,
				'purohit_username' 		=> $this->input->post('purohit_username'),
                'purohit_password' 		=> $this->input->post('purohit_password'),

            );

            $this->db->insert('purohit', $data);


			$data2 = array(
				'full_name'             => $this->input->post('purohit_name'),
				'user_name' 		=> $this->input->post('purohit_username'),
                'pass_word' 		=> $this->input->post('purohit_password'),
				'user_type' 		=> 'purohit_admin',  
				'status' 		=> 'ENABLE', 
				            
            );           
			$this->db->insert('admin_user', $data2);
            //$id = $this->db->insert_id();
            $this->session->set_flashdata('message', '<div class="alert alert-success">Record has been Created successfully.</div>');
            redirect("super_admin/add_purohit");
        }
    }

    function get_purohit() {
        $this->db->order_by("purohit_id", "DESC");
        $query = $this->db->get("purohit");
        return $query->result();
    }

    function purohit_delete($purohit_id) {
        $this->session_data();
        $news_id = $this->uri->segment(3);
        $this->db->where('purohit_id', $purohit_id);
        $this->db->delete('purohit');
        redirect("super_admin/purohit_list");
    }

    function get_purohit_id($table, $id)
    {
        $result = $this->db->get_where($table, ['purohit_id' => $id])->row();
        return $result;
    }

    function update_purohit() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("purohit_name", "purohit_name", "xss_clean");
        $this->form_validation->set_rules("purohit_division", "purohit_division", "xss_clean");
        $this->form_validation->set_rules("purohit_district", "purohit_district", "xss_clean");
        $this->form_validation->set_rules("purohit_thana", "purohit_thana", "xss_clean");
        $this->form_validation->set_rules("purohit_union", "purohit_union", "xss_clean");
        $this->form_validation->set_rules("purohit_village", "purohit_village", "xss_clean");
        $this->form_validation->set_rules("purohit_address", "purohit_address", "xss_clean");
        $this->form_validation->set_rules("purohit_mobile", "purohit_mobile", "xss_clean");
        $this->form_validation->set_rules("purohit_nid", "purohit_nid", "xss_clean");
        $this->form_validation->set_rules("purohit_date_of_birth", "purohit_date_of_birth", "xss_clean");
        $this->form_validation->set_rules("purohit_father_name", "purohit_father_name", "xss_clean");
        $this->form_validation->set_rules("purohit_image", "purohit_image", "xss_clean");


        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
            //$this->load->view('super_admin/company_list/error');
        } else {

            $purohit_image = $_FILES['purohit_image']['name'];

            //OLD IMAGE
            $prev_image = $this->input->post('old_image');


            if ($purohit_image != "") {
                $purohit_image = random_string('alnum', 10) . '.jpg';
                //insert image
                $config['file_name'] = $purohit_image;
                $config['upload_path'] = 'uploads/purohit';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']         = '100000';
                $config['encrypt_name']     = false;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('purohit_image');

                $file_data = $this->upload->data();
            } else {
                $purohit_image = $prev_image;
            }

            $purohit_id = $this->uri->segment(3);

            //zone change

            // echo $company_code = $this->input->post('company_code');


            //insert data to database

            $data = array(
                'purohit_name' => $this->input->post('purohit_name'),
                'purohit_division' => $this->input->post('purohit_division'),
                'purohit_district' => $this->input->post('purohit_district'),
                'purohit_thana' => $this->input->post('purohit_thana'),
                'purohit_union' => $this->input->post('purohit_union'),
                'purohit_village' => $this->input->post('purohit_village'),
                'purohit_address' => $this->input->post('purohit_address'),
                'purohit_mobile' => $this->input->post('purohit_mobile'),
                'purohit_date_of_birth' => $this->input->post('purohit_date_of_birth'),
                'purohit_father_name' => $this->input->post('purohit_father_name'),
                'purohit_nid' => $this->input->post('purohit_nid'),
                'purohit_image' => $purohit_image,


            );


            $this->db->where('purohit_id', $purohit_id);
            $this->db->update('purohit', $data);
        }
    }


}
