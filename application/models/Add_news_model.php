<?php
ob_start();
class Add_news_model extends CI_Model {


    function create_news() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("news_title", "news_title", "xss_clean");
        $this->form_validation->set_rules("news_category", "news_category", "xss_clean");
        $this->form_validation->set_rules("news_sub_category", "news_sub_category", "xss_clean");
        $this->form_validation->set_rules("news_description", "news_description", "xss_clean");
        $this->form_validation->set_rules("news_image", "news_image", "xss_clean");

        if ($this->form_validation->run() == FALSE) {
            // $this->load->view('super_admin/company_list/error');
                   
                   
        } else {

            $news_image = $_FILES['news_image']['name'];
            if ($news_image != "") {
                $news_image = random_string('alnum', 10) . '.jpg';
                
                //insert image
                $config['file_name'] = $news_image;
                $config['upload_path'] = 'uploads/news';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']         = '100000';
                $config['encrypt_name']     = false;
                $config['image_library'] = 'gd2';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('news_image');

                $file_data = $this->upload->data();
            } else {
                $news_image = "default.png";
            }

            //insert data to database

            $data = array(
                'news_title'             => $this->input->post('news_title'),
                'news_category'                 => $this->input->post('news_category'),
                'news_sub_category'                 => $this->input->post('news_sub_category'),
                'news_description'             => $this->input->post('news_description'),
                'news_image'             => $news_image,
              
                               
            );

            $this->db->insert('news', $data);
            //$id = $this->db->insert_id();
          
        }
    }


    function get_news() {
        $this->db->order_by("news_id", "DESC");
        $query = $this->db->get("news");
        return $query->result();
    }

      function get_news_id($table, $id)
    {
        $result = $this->db->get_where($table, ['news_id' => $id])->row();
        return $result;
    }

    function update_news() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("news_title", "news_title", "xss_clean");
        $this->form_validation->set_rules("news_category", "news_category", "xss_clean");
        $this->form_validation->set_rules("news_sub_category", "news_sub_category", "xss_clean");
        $this->form_validation->set_rules("news_description", "news_description", "xss_clean");
        $this->form_validation->set_rules("news_image", "news_image", "xss_clean");


        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
            //$this->load->view('super_admin/company_list/error');
        } else {

           $news_image = $_FILES['news_image']['name'];
            if ($news_image != "") {
                $news_image = random_string('alnum', 10) . '.jpg';
                //insert image
                $config['file_name'] = $news_image;
                $config['upload_path'] = 'uploads/news';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']         = '100000';
                $config['encrypt_name']     = false;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('news_image');

                $file_data = $this->upload->data();
            } else {
                $news_image = $this->input->post('news_image');
            }

            $news_id = $this->uri->segment(3);

            //zone change

            // echo $company_code = $this->input->post('company_code');


            //insert data to database

            $data = array(

                'news_title'             => $this->input->post('news_title'),
                'news_category'                 => $this->input->post('news_category'),
                'news_sub_category'                 => $this->input->post('news_sub_category'),
                'news_description'             => $this->input->post('news_description'),
                'news_image'             => $news_image,


            );


            $this->db->where('news_id', $news_id);
            $this->db->update('news', $data);
        }
    }
}







  