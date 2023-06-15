<?php
ob_start();
class add_department_model  extends CI_Model
{

// Create Objection
    function create_department()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("dept_name", "dept_name", "xss_clean");
        $this->form_validation->set_rules("dept_code", "dept_code", "xss_clean");
        $this->form_validation->set_rules("dept_image", "dept_image", "xss_clean");
        $this->form_validation->set_rules("dept_info", "dept_info", "xss_clean");




        if ($this->form_validation->run() == FALSE) {


        } else {

            $dept_image = $_FILES['dept_image']['name'];
            if ($dept_image != "") {
                $dept_image = random_string('alnum', 10) . '.jpg';

                //insert image
                $config['file_name'] = $dept_image;
                $config['upload_path'] = 'uploads/departments';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '100000';
                $config['encrypt_name'] = false;
                $config['image_library'] = 'gd2';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('dept_image');

                $file_data = $this->upload->data();
            } else {
                $dept_image = "default.png";
            }


            //insert data to database

            $data = array(
                'dept_name' => $this->input->post('dept_name'),
                'dept_code' => $this->input->post('dept_code'),
                'dept_info' => $this->input->post('dept_info'),
                'dept_image' => $dept_image,

            );

            $this->db->insert('department', $data);

            //$id = $this->db->insert_id();
            $this->session->set_flashdata('message', '<div class="alert alert-success">Record has been Created successfully.</div>');

        }
    }

    function get_department() {
        $this->db->order_by("dept_id", "DESC");
        $query = $this->db->get("department");
        return $query->result();
    }

    function department_delete($dept_id) {
        $this->session_data();
        $dept_id = $this->uri->segment(3);
        $this->db->where('dept_id', $dept_id);
        $this->db->delete('department');
    }

    function get_department_id($table, $id)
    {
        $result = $this->db->get_where($table, ['dept_id' => $id])->row();
        return $result;
    }




    function update_department() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("dept_name", "dept_name", "xss_clean");
        $this->form_validation->set_rules("dept_code", "dept_code", "xss_clean");
        $this->form_validation->set_rules("dept_image", "dept_image", "xss_clean");
        $this->form_validation->set_rules("dept_info", "dept_info", "xss_clean");


        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
        } else {

            $dept_image = $_FILES['dept_image']['name'];

            //OLD IMAGE
            $prev_image = $this->input->post('old_image');


            if ($dept_image != "") {
                $dept_image = random_string('alnum', 10) . '.jpg';
                //insert image
                $config['file_name'] = $dept_image;
                $config['upload_path']      = 'uploads/departments';
                $config['allowed_types']    = 'gif|jpg|jpeg|png';
                $config['max_size']         = '100000';
                $config['encrypt_name']     = false;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('dept_image');

                $file_data = $this->upload->data();
            } else {
                $dept_image = $prev_image;
            }

            $obj_id = $this->uri->segment(3);

            //zone change

            // echo $company_code = $this->input->post('company_code');


            //insert data to database

            $data = array(
                'dept_name' => $this->input->post('dept_name'),
                'dept_code' => $this->input->post('dept_code'),
                'dept_info' => $this->input->post('dept_info'),
                'dept_image' => $dept_image,


            );


            $this->db->where('dept_id', $obj_id);
            $this->db->update('department', $data);
        }
    }


}
