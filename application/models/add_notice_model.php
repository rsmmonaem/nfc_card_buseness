<?php
ob_start();
class add_notice_model  extends CI_Model {

// Create Notice
    function create_notice() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("not_title", "not_title", "xss_clean");
        $this->form_validation->set_rules("not_category", "not_category", "xss_clean");
        $this->form_validation->set_rules("not_description", "not_description", "xss_clean");
        $this->form_validation->set_rules("not_thumbnail", "not_thumbnail", "xss_clean");

        if ($this->form_validation->run() == FALSE) {
            // $this->load->view('super_admin/company_list/error');
                   
                   
        } else {

            $not_thumbnail = $_FILES['not_thumbnail']['name'];
            if ($not_thumbnail != "") {
                $not_thumbnail = random_string('alnum', 10) . '.jpg';
                
                //insert image
                $config['file_name'] = $not_thumbnail;
                $config['upload_path'] = 'uploads/notice';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']         = '100000';
                $config['encrypt_name']     = false;
                $config['image_library'] = 'gd2';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('not_thumbnail');

                $file_data = $this->upload->data();
            } else {
                $not_thumbnail = "default.png";
            }



            //insert data to database

            $data = array(
                'not_title'             => $this->input->post('not_title'),
                'not_category'                 => $this->input->post('not_category'),
                'not_description'                 => $this->input->post('not_description'),
                'not_thumbnail'                 => $not_thumbnail,
                               
            );

            $this->db->insert('notice', $data);
            //$id = $this->db->insert_id();
            $this->session->set_flashdata('message', '<div class="alert alert-success">Record has been Created successfully.</div>');
        }
    }

// Display Notice
    function get_notice() {
        $this->db->order_by("not_id", "DESC");
        $query = $this->db->get("notice");
        return $query->result();
    }
// Display Notice By Id As A row
      function get_notice_id($table, $id)
    {
        $result = $this->db->get_where($table, ['not_id' => $id])->row();
        return $result;
    }
// Update Notice
    function update_notice() {


        $this->load->library("form_validation");
        $this->form_validation->set_rules("not_title", "not_title", "xss_clean");
        $this->form_validation->set_rules("not_category", "not_category", "xss_clean");
        $this->form_validation->set_rules("not_description", "not_description", "xss_clean");
        $this->form_validation->set_rules("not_thumbnail", "not_thumbnail", "xss_clean");


        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
            //$this->load->view('super_admin/company_list/error');
        } else {

            $not_thumbnail = $_FILES['not_thumbnail']['name'];
            
            //OLD IMAGE
            $prev_thumbnail = $this->input->post('old_thumbnail');

            if ($not_thumbnail != "") {
                $not_thumbnail = random_string('alnum', 10) . '.jpg';
                //insert image
                $config['file_name'] = $not_thumbnail;
                $config['upload_path'] = 'uploads/notice';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']         = '100000';
                $config['encrypt_name']     = false;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('not_thumbnail');

                $file_data = $this->upload->data();
            } else {
                
                // $not_thumbnail = $this->input->post('not_thumbnail');
                $not_thumbnail = $prev_thumbnail;
            } 


            $not_id = $this->uri->segment(3);


            //insert data to database

            $data = array(

                'not_title'             => $this->input->post('not_title'),
                'not_category'                 => $this->input->post('not_category'),
                'not_description'                 => $this->input->post('not_description'),
                'not_thumbnail'                 => $not_thumbnail,
            );

            $this->session->set_flashdata('message', '<div class="alert alert-success">Record has been Updated successfully.</div>');

            $this->db->where('not_id', $not_id);
            $this->db->update('notice', $data);


        }
    }

}
