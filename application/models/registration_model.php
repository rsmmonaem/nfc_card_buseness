<?php
ob_start();
class Registration_model  extends CI_Model {

    function insert_registration() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("full_name", "full_name", "xss_clean");
        $this->form_validation->set_rules("father_name", "father_name", "xss_clean");
        $this->form_validation->set_rules("mother_name", "mother_name", "xss_clean");
        $this->form_validation->set_rules("db_day", "db_day", "xss_clean");
        $this->form_validation->set_rules("db_month", "db_month", "xss_clean");
        $this->form_validation->set_rules("db_year", "db_year", "xss_clean");
        $this->form_validation->set_rules("ssc_year", "ssc_year", "xss_clean");
        $this->form_validation->set_rules("ocopation", "adverect Description", "xss_clean");
        $this->form_validation->set_rules("ocopation_details", "ocopation_details", "xss_clean");
        $this->form_validation->set_rules("mobile_no", "mobile", "xss_clean");
        $this->form_validation->set_rules("email", "email", "xss_clean");
        $this->form_validation->set_rules("present_add", "present_add", "xss_clean");
        $this->form_validation->set_rules("permanent_add", "permanent_add", "xss_clean");
        $this->form_validation->set_rules("pay_mobile", "pay_mobile", "xss_clean");
        $this->form_validation->set_rules("tranx_id", "tranx_id", "xss_clean");

        $this->form_validation->set_rules("image", "image", "xss_clean");


        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
            $this->load->view('site/registration');
        } else {
            $image = $_FILES['image']['name'];
            if ($image != "") {
                $image = random_string('alnum', 10) . '.jpg';
                //insert image
                $config['file_name'] = $image;
                $config['upload_path'] = 'uploads/photos';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']         = '100000';
                $config['encrypt_name']     = false;
                $config['image_library'] = 'gd2';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('image');

                $file_data = $this->upload->data();
            } else {
                $image = "default.png";
            }

            //insert data to database

            $data = array(

                'full_name'         => $this->input->post('full_name'),
                'name_bng'             => $this->input->post('name_bng'),
                'blood_group'         => $this->input->post('blood_group'),
                'created_date'         => date('Y-m-d H:i:s'),
                'update_date'         => date('Y-m-d H:i:s'),
                'father_name'        => $this->input->post('father_name'),
                'mother_name'        => $this->input->post('mother_name'),
                'mobile_no'         => $this->input->post('mobile_no'),
                'email'             => $this->input->post('email'),

                'db_day'             => $this->input->post('db_day'),
                'db_month'             => $this->input->post('db_month'),
                'db_year'             => $this->input->post('db_year'),
                'ssc_year'             => $this->input->post('ssc_year'),
                'ocopation'         => $this->input->post('ocopation'),
                'ocopation_details' => $this->input->post('ocopation_details'),
                'present_add'         => $this->input->post('present_add'),
                'permanent_add'     => $this->input->post('permanent_add'),
                'gender'             => $this->input->post('gender'),
                'tshirt'             => $this->input->post('tshirt'),
                'payment'             => $this->input->post('payment'),
                'pay_mobile'         => $this->input->post('pay_mobile'),
                'tranx_id'             => $this->input->post('tranx_id'),
                'status'             => "pending",
                'serial'             => $this->input->post('serial'),
                'image'             => $image



            );
            //print_r($data);
            $this->db->insert('registration', $data);
            $id = $this->db->insert_id();
            //echo "Insert Success";
            //$this->load->view('admin/notice',$data);
            redirect("site/success/$id");
        }
    }

    function getData() {
        $this->db->order_by("id", "DESC");
        $query = $this->db->get("registration");
        return $query->result();
    }

    function getonerow() {
        $reg_id = $this->uri->segment(3);
        $this->db->where('id', $reg_id);
        $query = $this->db->get("registration");
        return $query->result();
    }

    function reject_list() {
        $this->db->where('status', "reject");
        $query = $this->db->get("registration");
        return $query->result();
    }

    function pending_list() {
        $this->db->where('status', "pending");
        $query = $this->db->get("registration");
        return $query->result();
    }

    function approved_list() {
        $this->db->where('status', "approved");
        $query = $this->db->get("registration");
        return $query->result();
    }


    function update_registration() {


        $reg_id = $this->input->post('id');


        $this->load->library("form_validation");
        $this->load->library("form_validation");
        $this->form_validation->set_rules("full_name", "full_name", "xss_clean");
        $this->form_validation->set_rules("father_name", "father_name", "xss_clean");
        $this->form_validation->set_rules("mother_name", "mother_name", "xss_clean");
        $this->form_validation->set_rules("db_day", "db_day", "xss_clean");
        $this->form_validation->set_rules("db_month", "db_month", "xss_clean");
        $this->form_validation->set_rules("db_year", "db_year", "xss_clean");
        $this->form_validation->set_rules("ssc_year", "ssc_year", "xss_clean");
        $this->form_validation->set_rules("ocopation", "adverect Description", "xss_clean");
        $this->form_validation->set_rules("ocopation_details", "ocopation_details", "xss_clean");
        $this->form_validation->set_rules("mobile_no", "mobile", "xss_clean");
        $this->form_validation->set_rules("email", "email", "xss_clean");
        $this->form_validation->set_rules("present_add", "present_add", "xss_clean");
        $this->form_validation->set_rules("permanent_add", "permanent_add", "xss_clean");
        $this->form_validation->set_rules("pay_mobile", "pay_mobile", "xss_clean");
        $this->form_validation->set_rules("tranx_id", "tranx_id", "xss_clean");

        $this->form_validation->set_rules("image", "image", "xss_clean");


        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
            $this->load->view('super_admin/includes/new_adverect');
        } else {
            $image = $_FILES['image']['name'];
            if ($image != "") {
                $image = random_string('alnum', 10) . '.jpg';
                //insert image
                $config['file_name'] = $image;
                $config['upload_path'] = 'uploads/photos';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']         = '100000';
                $config['encrypt_name']     = false;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('image');

                $file_data = $this->upload->data();
            } else {
                $image = $this->input->post('image');
            }

            //insert data to database

            $data = array(

                'full_name'         => $this->input->post('full_name'),
                'name_bng'             => $this->input->post('name_bng'),
                'blood_group'         => $this->input->post('blood_group'),
                'update_date'         => date('Y-m-d H:i:s'),
                'father_name'        => $this->input->post('father_name'),
                'mother_name'        => $this->input->post('mother_name'),
                'mobile_no'         => $this->input->post('mobile_no'),
                'email'             => $this->input->post('email'),
                'db_day'             => $this->input->post('db_day'),
                'db_month'             => $this->input->post('db_month'),
                'db_year'             => $this->input->post('db_year'),
                'ssc_year'             => $this->input->post('ssc_year'),
                'ocopation'         => $this->input->post('ocopation'),
                'ocopation_details' => $this->input->post('ocopation_details'),
                'present_add'         => $this->input->post('present_add'),
                'permanent_add'     => $this->input->post('permanent_add'),
                'gender'             => $this->input->post('gender'),
                'tshirt'             => $this->input->post('tshirt'),
                'payment'             => $this->input->post('payment'),
                'pay_mobile'         => $this->input->post('pay_mobile'),
                'tranx_id'             => $this->input->post('tranx_id'),
                'status'             => $this->input->post('status'),
                'image'             => $image



            );

            $this->db->where('id', $reg_id);
            $this->db->update('registration', $data);
            redirect("admin/all_registerd");
        }
    }
}
