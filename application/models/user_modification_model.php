<?php
ob_start();
class user_modification_model  extends CI_Model
{


    function get_user() {
        $this->db->order_by("u_id", "DESC");
        $query = $this->db->get("admin_user");
        return $query->result();
    }

    function get_user_modification_id($table, $id)
    {
        $result = $this->db->get_where($table, ['u_id' => $id])->row();
        return $result;
    }





//    function kazi_delete($kazi_id) {
//        $this->session_data();
//        $news_id = $this->uri->segment(3);
//        $this->db->where('kazi_id', $kazi_id);
//        $this->db->delete('kazi');
//    }
//        if ($this->form_validation->run() == FALSE) {
//            echo  $this->upload->display_errors();
//        } else {
//
//            $kazi_image = $_FILES['kazi_image']['name'];
//
//            //OLD IMAGE
//            $prev_image = $this->input->post('old_image');
//
//
//            if ($kazi_image != "") {
//                $kazi_image = random_string('alnum', 10) . '.jpg';
//                //insert image
//                $config['file_name'] = $kazi_image;
//                $config['upload_path'] = 'uploads/kazi';
//                $config['allowed_types'] = 'gif|jpg|jpeg|png';
//                $config['max_size']         = '100000';
//                $config['encrypt_name']     = false;
//
//                $this->load->library('upload', $config);
//                $this->upload->initialize($config);
//                $this->upload->do_upload('kazi_image');
//
//                $file_data = $this->upload->data();
//            } else {
//                $kazi_image = $prev_image;
//            }



    function update_user_modification() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("full_name", "full_name", "xss_clean");
        $this->form_validation->set_rules("user_name", "user_name", "xss_clean");
        $this->form_validation->set_rules("pass_word", "pass_word", "xss_clean");
        $this->form_validation->set_rules("user_type", "user_type", "xss_clean");
        $this->form_validation->set_rules("status", "status", "xss_clean");



            $user_id = $this->uri->segment(3);

            //zone change

            // echo $company_code = $this->input->post('company_code');


            //insert data to database

            $data = array(
                'full_name' => $this->input->post('full_name'),
                'user_name' => $this->input->post('user_name'),
                'pass_word' => $this->input->post('pass_word'),
                'user_type' => $this->input->post('user_type'),
                'status' => $this->input->post('status'),
            );


            $this->db->where('u_id', $user_id);
            $this->db->update('admin_user', $data);
        }
    


}
