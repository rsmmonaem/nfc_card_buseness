<?php
ob_start();
class add_objection_model  extends CI_Model
{

// Create Objection
    function create_objection()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("obj_title", "obj_title", "xss_clean");
        $this->form_validation->set_rules("obj_category", "obj_category", "xss_clean");
        $this->form_validation->set_rules("obj_image", "obj_image", "xss_clean");
        $this->form_validation->set_rules("obj_description", "obj_description", "xss_clean");




        if ($this->form_validation->run() == FALSE) {


        } else {

            $obj_image = $_FILES['obj_image']['name'];
            if ($obj_image != "") {
                $obj_image = random_string('alnum', 10) . '.jpg';

                //insert image
                $config['file_name'] = $obj_image;
                $config['upload_path'] = 'uploads/objections';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '100000';
                $config['encrypt_name'] = false;
                $config['image_library'] = 'gd2';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('obj_image');

                $file_data = $this->upload->data();
            } else {
                $obj_image = "default.png";
            }


            //insert data to database

            $data = array(
                'obj_title' => $this->input->post('obj_title'),
                'obj_category' => $this->input->post('obj_category'),
                'obj_description' => $this->input->post('obj_description'),
                'obj_image' => $obj_image,

            );

            $this->db->insert('objections', $data);

            //$id = $this->db->insert_id();
            $this->session->set_flashdata('message', '<div class="alert alert-success">Record has been Created successfully.</div>');

        }
    }

    function get_objection() {
        $this->db->order_by("obj_id", "DESC");
        $query = $this->db->get("objections");
        return $query->result();
    }

    function objection_delete($objection_id) {
        $this->session_data();
        $news_id = $this->uri->segment(3);
        $this->db->where('obj_id', $objection_id);
        $this->db->delete('objections');
    }

    function get_objection_id($table, $id)
    {
        $result = $this->db->get_where($table, ['obj_id' => $id])->row();
        return $result;
    }


    function update_objection() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("obj_title", "obj_title", "xss_clean");
        $this->form_validation->set_rules("obj_category", "obj_category", "xss_clean");
        $this->form_validation->set_rules("obj_image", "obj_image", "xss_clean");
        $this->form_validation->set_rules("obj_description", "obj_description", "xss_clean");


        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
        } else {

            $obj_image = $_FILES['obj_image']['name'];

            //OLD IMAGE
            $prev_image = $this->input->post('old_image');


            if ($obj_image != "") {
                $obj_image = random_string('alnum', 10) . '.jpg';
                //insert image
                $config['file_name'] = $obj_image;
                $config['upload_path'] = 'uploads/objections';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']         = '100000';
                $config['encrypt_name']     = false;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('obj_image');

                $file_data = $this->upload->data();
            } else {
                $obj_image = $prev_image;
            }

            $obj_id = $this->uri->segment(3);

            //zone change

            // echo $company_code = $this->input->post('company_code');


            //insert data to database

            $data = array(
                'obj_title' => $this->input->post('obj_title'),
                'obj_category' => $this->input->post('obj_category'),
                'obj_description' => $this->input->post('obj_description'),
                'obj_image' => $obj_image,


            );


            $this->db->where('obj_id', $obj_id);
            $this->db->update('objections', $data);
        }
    }


}
