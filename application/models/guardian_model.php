<?php
ob_start();
class guardian_model  extends CI_Model
{
    //Guardian List

    function get_guardian() {
        $this->db->order_by("guardian_id", "DESC");
        $query = $this->db->get("guardian_info");
        return $query->result();
    }

    function get_guardian_id($table, $id)
    {
        $result = $this->db->get_where($table, ['guardian_id' => $id])->row();
        return $result;
    }


//    function update_kazi() {
//        $this->load->library("form_validation");
//        $this->form_validation->set_rules("kazi_name", "kazi_name", "xss_clean");
//        $this->form_validation->set_rules("kazi_division", "kazi_division", "xss_clean");
//        $this->form_validation->set_rules("kazi_district", "kazi_district", "xss_clean");
//        $this->form_validation->set_rules("kazi_thana", "kazi_thana", "xss_clean");
//        $this->form_validation->set_rules("kazi_union", "kazi_union", "xss_clean");
//        $this->form_validation->set_rules("kazi_village", "kazi_village", "xss_clean");
//        $this->form_validation->set_rules("kazi_address", "kazi_address", "xss_clean");
//        $this->form_validation->set_rules("kazi_mobile", "kazi_mobile", "xss_clean");
//        $this->form_validation->set_rules("kazi_nid", "kazi_nid", "xss_clean");
//        $this->form_validation->set_rules("kazi_date_of_birth", "kazi_date_of_birth", "xss_clean");
//        $this->form_validation->set_rules("kazi_father_name", "kazi_father_name", "xss_clean");
//        $this->form_validation->set_rules("kazi_image", "kazi_image", "xss_clean");
//        $this->form_validation->set_rules("kazi_username", "kazi_username", "xss_clean");
//        $this->form_validation->set_rules("kazi_password", "kazi_password", "xss_clean");
//
//
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
//
//            $kazi_id = $this->uri->segment(3);
//
//            //zone change
//
//            // echo $company_code = $this->input->post('company_code');
//
//
//            //insert data to database
//
//            $data = array(
//                'kazi_name' => $this->input->post('kazi_name'),
//                'kazi_division' => $this->input->post('kazi_division'),
//                'kazi_district' => $this->input->post('kazi_district'),
//                'kazi_thana' => $this->input->post('kazi_thana'),
//                'kazi_union' => $this->input->post('kazi_union'),
//                'kazi_village' => $this->input->post('kazi_village'),
//                'kazi_address' => $this->input->post('kazi_address'),
//                'kazi_mobile' => $this->input->post('kazi_mobile'),
//                'kazi_date_of_birth' => $this->input->post('kazi_date_of_birth'),
//                'kazi_father_name' => $this->input->post('kazi_father_name'),
//                'kazi_nid' => $this->input->post('kazi_nid'),
//                'kazi_username' => $this->input->post('kazi_username'),
//                'kazi_password' => $this->input->post('kazi_password'),
//                'kazi_image' => $kazi_image,
//
//
//            );
//
//
//            $this->db->where('kazi_id', $kazi_id);
//            $this->db->update('kazi', $data);
//        }
//    }





}
