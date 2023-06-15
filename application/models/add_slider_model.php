<?php
ob_start();
class add_slider_model  extends CI_Model
{

// Create Notice
    function create_slider()
    {
        $this->load->library("form_validation");
        $this->load->library('session');
        $this->form_validation->set_rules("slider_title", "slider_title", "xss_clean");
        $this->form_validation->set_rules("slider_image", "slider_image", "xss_clean");
        $this->form_validation->set_rules("slider_description", "slider_description", "xss_clean");
        $this->form_validation->set_rules("slider_category", "slider_category", "xss_clean");

        if ($this->form_validation->run() == FALSE) {


        } else {

            $slider_image = $_FILES['slider_image']['name'];
            if ($slider_image != "") {
                $slider_image = random_string('alnum', 10) . '.jpg';

                //insert image
                $config['file_name'] = $slider_image;
                $config['upload_path'] = 'uploads/slider';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '100000';
                $config['encrypt_name'] = false;
                $config['image_library'] = 'gd2';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('slider_image');

                $file_data = $this->upload->data();
            } else {
                $slider_image = "default.png";
            }


            //insert data to database

            $data = array(
                'slider_title' => $this->input->post('slider_title'),
                'slider_category' => $this->input->post('slider_category'),
                'slider_description' => $this->input->post('slider_description'),
                'slider_image' => $slider_image,

            );

            $this->db->insert('slider', $data);
            //$id = $this->db->insert_id();
            $this->session->set_flashdata('message', '<div class="alert alert-success">Record has been Created successfully.</div>');


        }
    }

    function get_slider() {
        $this->db->order_by("slider_id", "DESC");
        $query = $this->db->get("slider");
        return $query->result();
    }

    function slider_delete($slider_id) {
        $this->session_data();
        $slider_id = $this->uri->segment(3);
        $this->db->where('slider_id', $slider_id);
        $this->db->delete('slider');
    }

    function get_slider_id($table, $id)
    {
        $result = $this->db->get_where($table, ['slider_id' => $id])->row();
        return $result;
    }


    function update_slider() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("slider_title", "slider_title", "xss_clean");
        $this->form_validation->set_rules("slider_image", "slider_image", "xss_clean");
        $this->form_validation->set_rules("slider_description", "slider_description", "xss_clean");
        $this->form_validation->set_rules("slider_category", "slider_category", "xss_clean");


        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
        } else {

            $slider_image = $_FILES['slider_image']['name'];

            //OLD IMAGE
            $prev_image = $this->input->post('old_image');


            if ($slider_image != "") {
                $slider_image = random_string('alnum', 10) . '.jpg';
                //insert image
                $config['file_name'] = $slider_image;
                $config['upload_path'] = 'uploads/slider';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']         = '100000';
                $config['encrypt_name']     = false;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('slider_image');

                $file_data = $this->upload->data();
            } else {
                $slider_image = $prev_image;
            }

            $slider_id = $this->uri->segment(3);

            //zone change

            // echo $company_code = $this->input->post('company_code');


            //insert data to database
            $data = array(
                'slider_title' => $this->input->post('slider_title'),
                'slider_category' => $this->input->post('slider_category'),
                'slider_description' => $this->input->post('slider_description'),
                'slider_image' => $slider_image,
            );


            $this->db->where('slider_id', $slider_id);
            $this->db->update('slider', $data);
        }
    }


}
