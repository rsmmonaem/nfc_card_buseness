<?php
ob_start();
class User_registration_model  extends CI_Model {


    //start ZONAL MANAGER Functions

    function create_zonal_manager() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("status", "status", "xss_clean");
        $this->form_validation->set_rules("zone_name", "zone_name", "xss_clean");
        $this->form_validation->set_rules("zone_code", "zone_code", "xss_clean");
        $this->form_validation->set_rules("zonal_manager", "zonal_manager", "xss_clean");
        $this->form_validation->set_rules("zm_id_no", "zm_id_no", "xss_clean");
        $this->form_validation->set_rules("designation", "designation", "xss_clean");
        $this->form_validation->set_rules("cont_num", "cont_num", "xss_clean");
        $this->form_validation->set_rules("email", "email", "xss_clean");
        $this->form_validation->set_rules("image", "zm_image", "xss_clean");
        $this->form_validation->set_rules("user_name", "user_name", "xss_clean");
        $this->form_validation->set_rules("pass_word", "pass_word", "xss_clean");

        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
            $this->load->view('super_admin/create_zonal_manager/error');
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

            $zm_cv = $_FILES['zm_cv']['name'];
            if ($zm_cv != "") {
                $zm_cv = random_string('alnum', 10) . '.pdf';
                //insert image
                $config['file_name'] = $zm_cv;
                $config['upload_path'] = 'uploads/cv';
                $config['allowed_types'] = 'pdf|doc';
                $config['max_size']         = '500000';
                $config['encrypt_name']     = false;
                //$config['image_library'] = 'gd2';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('zm_cv');

                $file_data = $this->upload->data();
            } else {
                $zm_cv = "cv_not_found.jpg";
            }

            //zonal name select

            $zonal_code = $this->input->post('zonal_code');

            $this->db->where('zonal_code', $zonal_code);
            $query = $this->db->get("zonal_office")->result();
            foreach ($query as $row) {
                $zonal_office = $row->zonal_office;
                $district = $row->district;
                $division = $row->division;
            }

            //insert data to database

            $data = array(
                'status'             => $this->input->post('status'),
                'zonal_office'         => $zonal_office,
                'zonal_code'         => $this->input->post('zonal_code'),
                'zonal_manager'     => $this->input->post('zonal_manager'),
                'zm_id_no'             => $this->input->post('zm_id_no'),
                'user_id'             => $this->input->post('zm_id_no'),
                'created_date'         => date('Y-m-d H:i:s'),
                'update_date'         => date('Y-m-d H:i:s'),
                'designation'        => 'zonal_manager',
                'cont_num'            => $this->input->post('cont_num'),
                'email'             => $this->input->post('email'),
                'zm_image'             => $image,
                'zm_cv'             => $zm_cv,
                'user_name'         => $this->input->post('user_name'),
                'pass_word'         => $this->input->post('pass_word')
            );

            $data2 = array(
                'status'             => $this->input->post('status'),
                'user_name'         => $this->input->post('user_name'),
                'user_id'             => $this->input->post('zm_id_no'),
                'pass_word'         => $this->input->post('pass_word'),
                'user_type'         => "zonal_manager",
                'full_name'         => $this->input->post('zonal_manager'),
                'update_date'         => date('Y-m-d H:i:s')
            );
            print_r($data);
            $this->db->insert('zonal_manager', $data);
            $this->db->insert('admin_user', $data2);

            //$id = $this->db->insert_id();

            redirect("super_admin/zonal_manager_list/");
        }
    }


    function getzonal_manager() {
        $this->db->order_by("zm_id", "DESC");
        $query = $this->db->get("zonal_manager");
        return $query->result();
    }

    function getonerow_zonal_manager() {
        $user_id = $this->uri->segment(3);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get("zonal_manager");
        return $query->result();
    }

    function update_zonal_manager() {

        $this->load->library("form_validation");
        $this->form_validation->set_rules("status", "status", "xss_clean");
        $this->form_validation->set_rules("zone_name", "zone_name", "xss_clean");
        $this->form_validation->set_rules("zone_code", "zone_code", "xss_clean");
        $this->form_validation->set_rules("zonal_manager", "zonal_manager", "xss_clean");
        $this->form_validation->set_rules("zm_id_no", "zm_id_no", "xss_clean");
        $this->form_validation->set_rules("designation", "designation", "xss_clean");
        $this->form_validation->set_rules("cont_num", "cont_num", "xss_clean");
        $this->form_validation->set_rules("email", "email", "xss_clean");
        $this->form_validation->set_rules("image", "zm_image", "xss_clean");
        $this->form_validation->set_rules("user_name", "user_name", "xss_clean");
        $this->form_validation->set_rules("pass_word", "pass_word", "xss_clean");


        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
            $this->load->view('super_admin/zonal_manager_list/error');
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

            $zm_cv = $_FILES['zm_cv']['name'];
            if ($zm_cv != "") {
                $zm_cv = random_string('alnum', 10) . '.pdf';
                //insert image
                $config['file_name'] = $zm_cv;
                $config['upload_path'] = 'uploads/cv';
                $config['allowed_types'] = 'pdf|doc';
                $config['max_size']         = '500000';
                $config['encrypt_name']     = false;
                //$config['image_library'] = 'gd2';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('zm_cv');

                $file_data = $this->upload->data();
            } else {
                $zm_cv = $this->input->post('zm_cv');
            }
            $page_name = $this->uri->segment(1);
            $user_id = $this->input->post('user_id');
            $user_name = $this->input->post('user_name');
            $new_user_name = $this->input->post('new_user_name');
            $new_pass_word = $this->input->post('new_pass_word');

            // find out user name
            if ($user_name != $new_user_name) {

                if (preg_match('/\s/', $new_user_name)) {
                    if ($page_name == "zonal_manager") {
                        redirect("zonal_manager/edit_zonal_manager/" . $user_id . "/username_invalid");
                    }
                    redirect("super_admin/edit_zonal_manager/" . $user_id . "/username_invalid");
                }
                $qry = "SELECT count(*) as cnt from admin_user where user_name= '$new_user_name'";
                $res = $this->db->query($qry, array($new_user_name))->result();

                if ($res[0]->cnt >= 1) {
                    if ($page_name == "zonal_manager") {
                        redirect("zonal_manager/edit_zonal_manager/" . $user_id . "/username_invalid");
                    }
                    if ($page_name == "super_admin") {
                        redirect("super_admin/edit_zonal_manager/" . $user_id . "/username_error");
                    }
                }
            }


            $zonal_code = $this->input->post('zonal_code');

            $this->db->where('zonal_code', $zonal_code);
            $query = $this->db->get("zonal_office")->result();
            foreach ($query as $row) {
                $zonal_office = $row->zonal_office;
                $district = $row->district;
                $division = $row->division;
            }

            //insert data to database

            $data = array(
                'status'             => $this->input->post('status'),
                'zonal_office'         => $zonal_office,
                'zonal_code'         => $zonal_code,
                'zonal_manager'     => $this->input->post('zonal_manager'),
                //'fao_id_no' 		=>$this->input->post('fao_id_no'),
                //'user_id' 			=>$this->input->post('fao_id_no'),
                'update_date'         => date('Y-m-d H:i:s'),
                'cont_num'            => $this->input->post('cont_num'),
                'email'             => $this->input->post('email'),
                'zm_image'             => $image,
                'zm_cv'             => $zm_cv,


                'user_name'         => $this->input->post('new_user_name'),
                'pass_word'         => $this->input->post('new_pass_word')



            );

            $data2 = array(
                //'user_id' 			=>$this->input->post('fao_id_no'),
                'user_name'         => $this->input->post('new_user_name'),
                'status'             => $this->input->post('status'),
                'pass_word'         => $this->input->post('new_pass_word')

            );

            $this->db->where('user_id', $user_id);
            $this->db->update('zonal_manager', $data);
            $this->db->where('user_id', $user_id);
            $this->db->update('admin_user', $data2);

            if ($page_name == "zonal_manager") {
                redirect("approval_officer/edit_zonal_manager");
            }
            redirect("super_admin/zonal_manager_list");
        }
    }

    function search_zonal_manager() {

        $user_id = $this->input->post('user_id');

        redirect("super_admin/zonal_manager_list_search/" . $user_id);
        //redirect(base_url()."super_admin/fao_list_search/");

    }

    function search_zonal_manager_result() {
        $user_id = $this->uri->segment(3);

        $this->db->where('user_id', $user_id);
        $query = $this->db->get("zonal_manager");
        return $query->result();
    }


    // end of zonal manager Functions

    //start BRANCH MANAGER Functions

    function create_branch_manager() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("status", "status", "xss_clean");
        $this->form_validation->set_rules("zonal_office", "zonal_office", "xss_clean");
        $this->form_validation->set_rules("zonal_code", "zonal_code", "xss_clean");
        $this->form_validation->set_rules("branch_office", "branch_office", "xss_clean");
        $this->form_validation->set_rules("branch_code", "branch_code", "xss_clean");

        $this->form_validation->set_rules("branch_manager", "branch_manager", "xss_clean");
        $this->form_validation->set_rules("bm_id_no", "bm_id_no", "xss_clean");
        $this->form_validation->set_rules("designation", "designation", "xss_clean");
        $this->form_validation->set_rules("cont_num", "cont_num", "xss_clean");
        $this->form_validation->set_rules("email", "email", "xss_clean");
        $this->form_validation->set_rules("image", "zm_image", "xss_clean");
        $this->form_validation->set_rules("user_name", "user_name", "xss_clean");
        $this->form_validation->set_rules("pass_word", "pass_word", "xss_clean");

        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
            $this->load->view('super_admin/create_branch_manager/error');
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

            $bm_cv = $_FILES['bm_cv']['name'];
            if ($bm_cv != "") {
                $bm_cv = random_string('alnum', 10) . '.pdf';
                //insert image
                $config['file_name'] = $bm_cv;
                $config['upload_path'] = 'uploads/cv';
                $config['allowed_types'] = 'pdf|doc';
                $config['max_size']         = '500000';
                $config['encrypt_name']     = false;
                //$config['image_library'] = 'gd2';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('bm_cv');

                $file_data = $this->upload->data();
            } else {
                $bm_cv = "cv_not_found.jpg";
            }

            //branch name select

            $branch_code = $this->input->post('branch_code');

            $this->db->where('branch_code', $branch_code);
            $query = $this->db->get("branch_office")->result();
            foreach ($query as $row) {
                $zonal_office = $row->zonal_office;
                $zonal_code = $row->zonal_code;
                $branch_office = $row->branch_office;
                $district = $row->district;
                $division = $row->division;
            }

            //insert data to database

            $data = array(
                'status'             => $this->input->post('status'),
                'zonal_office'         => $zonal_office,
                'zonal_code'         => $zonal_code,
                'branch_office'         => $branch_office,
                'branch_code'         => $this->input->post('branch_code'),
                'branch_manager'     => $this->input->post('branch_manager'),
                'bm_id_no'             => $this->input->post('bm_id_no'),
                'user_id'             => $this->input->post('bm_id_no'),
                'created_date'         => date('Y-m-d H:i:s'),
                'update_date'         => date('Y-m-d H:i:s'),
                'designation'        => 'branch_manager',
                'cont_num'            => $this->input->post('cont_num'),
                'email'             => $this->input->post('email'),
                'bm_image'             => $image,
                'bm_cv'             => $bm_cv,
                'user_name'         => $this->input->post('user_name'),
                'pass_word'         => $this->input->post('pass_word')
            );

            $data2 = array(
                'status'             => $this->input->post('status'),
                'user_name'         => $this->input->post('user_name'),
                'user_id'             => $this->input->post('bm_id_no'),
                'pass_word'         => $this->input->post('pass_word'),
                'user_type'         => "branch_manager",
                'full_name'         => $this->input->post('branch_manager'),
                'update_date'         => date('Y-m-d H:i:s')
            );
            print_r($data);
            $this->db->insert('branch_manager', $data);
            $this->db->insert('admin_user', $data2);

            //$id = $this->db->insert_id();

            redirect("super_admin/branch_manager_list/");
        }
    }


    function getbranch_manager() {
        $this->db->order_by("bm_id", "DESC");
        $query = $this->db->get("branch_manager");
        return $query->result();
    }

    function getonerow_branch_manager() {
        $user_id = $this->uri->segment(3);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get("branch_manager");
        return $query->result();
    }

    function update_branch_manager() {

        $this->load->library("form_validation");
        $this->form_validation->set_rules("status", "status", "xss_clean");
        $this->form_validation->set_rules("zonal_office", "zonal_office", "xss_clean");
        $this->form_validation->set_rules("zone_code", "zonal_code", "xss_clean");

        $this->form_validation->set_rules("branch_office", "branch_office", "xss_clean");
        $this->form_validation->set_rules("branch_code", "branch_code", "xss_clean");

        $this->form_validation->set_rules("branch_manager", "branch_manager", "xss_clean");
        $this->form_validation->set_rules("bm_id_no", "bm_id_no", "xss_clean");
        $this->form_validation->set_rules("designation", "designation", "xss_clean");
        $this->form_validation->set_rules("cont_num", "cont_num", "xss_clean");
        $this->form_validation->set_rules("email", "email", "xss_clean");
        $this->form_validation->set_rules("image", "bm_image", "xss_clean");
        $this->form_validation->set_rules("user_name", "user_name", "xss_clean");
        $this->form_validation->set_rules("pass_word", "pass_word", "xss_clean");


        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
            $this->load->view('super_admin/branch_manager_list/error');
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

            $bm_cv = $_FILES['bm_cv']['name'];
            if ($bm_cv != "") {
                $zm_cv = random_string('alnum', 10) . '.pdf';
                //insert image
                $config['file_name'] = $zm_cv;
                $config['upload_path'] = 'uploads/cv';
                $config['allowed_types'] = 'pdf|doc';
                $config['max_size']         = '500000';
                $config['encrypt_name']     = false;
                //$config['image_library'] = 'gd2';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('zm_cv');

                $file_data = $this->upload->data();
            } else {
                $bm_cv = $this->input->post('bm_cv');
            }
            $page_name = $this->uri->segment(1);
            $user_id = $this->input->post('user_id');
            $user_name = $this->input->post('user_name');
            $new_user_name = $this->input->post('new_user_name');
            $new_pass_word = $this->input->post('new_pass_word');

            // find out user name
            if ($user_name != $new_user_name) {

                if (preg_match('/\s/', $new_user_name)) {
                    if ($page_name == "branch_manager") {
                        redirect("branch_manager/edit_branch_manager/" . $user_id . "/username_invalid");
                    }
                    redirect("super_admin/edit_branch_manager/" . $user_id . "/username_invalid");
                }
                $qry = "SELECT count(*) as cnt from admin_user where user_name= '$new_user_name'";
                $res = $this->db->query($qry, array($new_user_name))->result();

                if ($res[0]->cnt >= 1) {
                    if ($page_name == "branch_manager") {
                        redirect("branch_manager/edit_branch_manager/" . $user_id . "/username_invalid");
                    }
                    if ($page_name == "super_admin") {
                        redirect("super_admin/edit_branch_manager/" . $user_id . "/username_error");
                    }
                }
            }


            $branch_code = $this->input->post('branch_code');

            $this->db->where('branch_code', $branch_code);
            $query = $this->db->get("branch_office")->result();
            foreach ($query as $row) {
                $zonal_office = $row->zonal_office;
                $zonal_code = $row->zonal_code;
                $branch_office = $row->branch_office;
                $district = $row->district;
                $division = $row->division;
            }

            //insert data to database

            $data = array(
                'status'             => $this->input->post('status'),
                'branch_office'     => $branch_office,
                'branch_code'         => $branch_code,
                'zonal_office'         => $zonal_office,
                'zonal_code'         => $zonal_code,

                'branch_manager'     => $this->input->post('branch_manager'),
                //'fao_id_no' 		=>$this->input->post('fao_id_no'),
                //'user_id' 			=>$this->input->post('fao_id_no'),
                'update_date'         => date('Y-m-d H:i:s'),
                'cont_num'            => $this->input->post('cont_num'),
                'email'             => $this->input->post('email'),
                'bm_image'             => $image,
                'bm_cv'             => $bm_cv,


                'user_name'         => $this->input->post('new_user_name'),
                'pass_word'         => $this->input->post('new_pass_word')



            );

            $data2 = array(
                //'user_id' 			=>$this->input->post('fao_id_no'),
                'user_name'         => $this->input->post('new_user_name'),
                'status'             => $this->input->post('status'),
                'pass_word'         => $this->input->post('new_pass_word')

            );

            $this->db->where('user_id', $user_id);
            $this->db->update('branch_manager', $data);
            $this->db->where('user_id', $user_id);
            $this->db->update('admin_user', $data2);

            if ($page_name == "branch_manager") {
                redirect("approval_officer/edit_branch_manager");
            }
            redirect("super_admin/branch_manager_list");
        }
    }

    function search_branch_manager() {

        $user_id = $this->input->post('user_id');

        redirect("super_admin/branch_manager_list_search/" . $user_id);
        //redirect(base_url()."super_admin/fao_list_search/");

    }

    function search_branch_manager_result() {
        $user_id = $this->uri->segment(3);

        $this->db->where('user_id', $user_id);
        $query = $this->db->get("branch_manager");
        return $query->result();
    }


    // end of branch manager Functions


    //start FIELD WORKER Functions

    function create_field_worker() {

        $this->load->library("form_validation");
        $this->form_validation->set_rules("branch_code", "branch_code", "xss_clean");
        $this->form_validation->set_rules("pickpoint_code", "pickpoint_code", "xss_clean");
        $this->form_validation->set_rules("field_worker", "field_worker", "xss_clean");
        $this->form_validation->set_rules("fw_id_no", "fw_id_no", "xss_clean");
        $this->form_validation->set_rules("cont_num", "cont_num", "xss_clean");
        $this->form_validation->set_rules("email", "email", "xss_clean");
        $this->form_validation->set_rules("image", "fw_image", "xss_clean");
        $this->form_validation->set_rules("fw_cv", "fw_cv", "xss_clean");
        $this->form_validation->set_rules("target", "target", "xss_clean");
        $this->form_validation->set_rules("user_name", "user_name", "xss_clean");
        $this->form_validation->set_rules("pass_word", "pass_word", "xss_clean");
        $this->form_validation->set_rules("status", "status", "xss_clean");

        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
            $this->load->view('super_admin/create_field_worker/error');
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

            $fw_cv = $_FILES['fw_cv']['name'];
            if ($fw_cv != "") {
                $fw_cv = random_string('alnum', 10) . '.pdf';
                //insert image
                $config['file_name'] = $fw_cv;
                $config['upload_path'] = 'uploads/cv';
                $config['allowed_types'] = 'pdf|doc';
                $config['max_size']         = '500000';
                $config['encrypt_name']     = false;
                //$config['image_library'] = 'gd2';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('fw_cv');

                $file_data = $this->upload->data();
            } else {
                $fw_cv = "cv_not_found.jpg";
            }

            //pickpoint code select
            $pickpoint_code = $this->input->post('pickpoint_code');

            $this->db->where('pickpoint_code', $pickpoint_code);
            $query = $this->db->get("pickpoint_office")->result();
            foreach ($query as $row) {
                // $zonal_office = $row->zonal_office;
                // $zonal_code = $row->zonal_code;
                $branch_office = $row->branch_office;
                $branch_code = $row->branch_code;
                $pickpoint_office = $row->pickpoint_office;
            }

            //insert data to database
            $data = array(
                'user_id'             => $this->input->post('fw_id_no'),
                'status'             => $this->input->post('status'),
                'zonal_office'         => '',
                'zonal_code'         => '',
                'branch_office'     => $branch_office,
                'branch_code'         => $branch_code,
                'pickpoint_code'         => $this->input->post('pickpoint_code'),
                'pickpoint_office'         => $pickpoint_office,
                'field_worker'         => $this->input->post('field_worker'),
                'fw_id_no'             => $this->input->post('fw_id_no'),
                'designation'        => 'field_worker',
                'cont_num'            => $this->input->post('cont_num'),
                'email'             => $this->input->post('email'),
                'fw_image'             => $image,
                'fw_cv'             => $fw_cv,
                'target'             => $this->input->post('target'),
                'achieve'             => '0',
                'user_name'         => $this->input->post('user_name'),
                'pass_word'         => $this->input->post('pass_word'),
                'created_date'         => date('Y-m-d H:i:s'),
                'update_date'         => date('Y-m-d H:i:s')
            );

            $data2 = array(
                'status'             => $this->input->post('status'),
                'user_name'         => $this->input->post('user_name'),
                'user_id'             => $this->input->post('fw_id_no'),
                'pass_word'         => $this->input->post('pass_word'),
                'user_type'         => "field_worker",
                'full_name'         => $this->input->post('field_worker'),
                'update_date'         => date('Y-m-d H:i:s')
            );

            // print_r($data);
            $this->db->insert('field_worker', $data);
            $this->db->insert('admin_user', $data2);

            //$id = $this->db->insert_id();
            redirect("super_admin/field_worker_list/");
        }
    }


    function getfield_worker() {
        $this->db->order_by("fw_id", "DESC");
        $query = $this->db->get("field_worker");
        return $query->result();
    }

    function getonerow_field_worker() {
        $user_id = $this->uri->segment(3);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get("field_worker");
        return $query->result();
    }

    function update_field_worker() {

        $this->load->library("form_validation");
        $this->form_validation->set_rules("branch_code", "branch_code", "xss_clean");
        $this->form_validation->set_rules("pickpoint_code", "pickpoint_code", "xss_clean");
        $this->form_validation->set_rules("field_worker", "field_worker", "xss_clean");
        $this->form_validation->set_rules("fw_id_no", "fw_id_no", "xss_clean");
        $this->form_validation->set_rules("cont_num", "cont_num", "xss_clean");
        $this->form_validation->set_rules("email", "email", "xss_clean");
        $this->form_validation->set_rules("image", "fw_image", "xss_clean");
        $this->form_validation->set_rules("target", "target", "xss_clean");
        $this->form_validation->set_rules("user_name", "user_name", "xss_clean");
        $this->form_validation->set_rules("pass_word", "pass_word", "xss_clean");
        $this->form_validation->set_rules("status", "status", "xss_clean");


        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
            $this->load->view('super_admin/field_worker_list/error');
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

            // $fw_cv = $_FILES['fw_cv']['name'];
            // if ($fw_cv != "") {
            //     $fw_cv = random_string('alnum', 10) . '.pdf';
            //     //insert image
            //     $config['file_name'] = $fw_cv;
            //     $config['upload_path'] = 'uploads/cv';
            //     $config['allowed_types'] = 'pdf|doc';
            //     $config['max_size']         = '500000';
            //     $config['encrypt_name']     = false;
            //     //$config['image_library'] = 'gd2';
            //     $this->load->library('upload', $config);
            //     $this->upload->initialize($config);
            //     $this->upload->do_upload('zm_cv');

            //     $file_data = $this->upload->data();
            // } else {
            //     $fw_cv = $this->input->post('fw_cv');
            // }

            $page_name = $this->uri->segment(1);

            $user_id = $this->input->post('user_id');
            $user_name = $this->input->post('user_name');
            $new_user_name = $this->input->post('new_user_name');

            // $new_pass_word = $this->input->post('new_pass_word');

            // find out user name
            if ($user_name != $new_user_name) {

                if (preg_match('/\s/', $new_user_name)) {
                    if ($page_name == "field_worker") {
                        redirect("field_worker/edit_field_worker/" . $user_id . "/username_invalid");
                    }
                    redirect("super_admin/edit_field_worker/" . $user_id . "/username_invalid");
                }
                $qry = "SELECT count(*) as cnt from admin_user where user_name= '$new_user_name'";
                $res = $this->db->query($qry, array($new_user_name))->result();

                if ($res[0]->cnt >= 1) {
                    if ($page_name == "field_worker") {
                        redirect("field_worker/edit_field_worker/" . $user_id . "/username_invalid");
                    }
                    if ($page_name == "super_admin") {
                        redirect("super_admin/edit_field_worker/" . $user_id . "/username_error");
                    }
                }
            }


            //pickpoint code select
            $pickpoint_code = $this->input->post('pickpoint_code');

            $this->db->where('pickpoint_code', $pickpoint_code);
            $query = $this->db->get("pickpoint_office")->result();
            foreach ($query as $row) {
                // $zonal_office = $row->zonal_office;
                // $zonal_code = $row->zonal_code;
                $branch_office = $row->branch_office;
                $branch_code = $row->branch_code;
                $pickpoint_office = $row->pickpoint_office;
            }

            //insert data to database
            $data = array(
                'status'             => $this->input->post('status'),
                'branch_office'     => $branch_office,
                'branch_code'         => $branch_code,
                'pickpoint_code'         => $this->input->post('pickpoint_code'),
                'pickpoint_office'         => $pickpoint_office,
                'field_worker'         => $this->input->post('field_worker'),
                'cont_num'            => $this->input->post('cont_num'),
                'email'             => $this->input->post('email'),
                'fw_image'             => $image,
                'target'             => $this->input->post('target'),
                'user_name'         => $this->input->post('new_user_name'),
                'pass_word'         => $this->input->post('new_pass_word'),
                'update_date'         => date('Y-m-d H:i:s')
            );


            $data2 = array(
                'user_name'         => $this->input->post('new_user_name'),
                'status'             => $this->input->post('status'),
                'pass_word'         => $this->input->post('new_pass_word')
            );

            $this->db->where('user_id', $user_id);
            $this->db->update('field_worker', $data);

            $this->db->where('user_id', $user_id);
            $this->db->update('admin_user', $data2);

            if ($page_name == "field_worker") {
                redirect("field_worker/edit_field_worker");
            }
            redirect("super_admin/field_worker_list");
        }
    }

    function search_field_worker() {

        $user_id = $this->input->post('user_id');

        redirect("super_admin/field_worker_list_search/" . $user_id);
        //redirect(base_url()."super_admin/fao_list_search/");

    }

    function search_field_worker_result() {
        $user_id = $this->uri->segment(3);

        $this->db->where('user_id', $user_id);
        $query = $this->db->get("field_worker");
        return $query->result();
    }

    function get_disabled_field_worker() {
        $this->db->where('status', 'DISABLE');
        $query = $this->db->get("field_worker");
        return $query->result();
    }



    // end of field worker Functions


    //start CUSTOMER Functions

    function create_customer() {

        $this->load->library("form_validation");
        $this->form_validation->set_rules("fw_id_no", "fw_id_no", "xss_clean");
        $this->form_validation->set_rules("customer", "customer", "xss_clean");
        $this->form_validation->set_rules("father_name", "father_name", "xss_clean");
        $this->form_validation->set_rules("mother_name", "mother_name", "xss_clean");
        $this->form_validation->set_rules("cm_dob", "cm_dob", "xss_clean");
        $this->form_validation->set_rules("cm_nid_no", "cm_nid_no", "xss_clean");
        $this->form_validation->set_rules("cm_present_add", "cm_present_add", "xss_clean");
        $this->form_validation->set_rules("cm_permanent_add", "cm_permanent_add", "xss_clean");
        $this->form_validation->set_rules("cm_id_no", "cm_id_no", "xss_clean");
        $this->form_validation->set_rules("cont_num", "cont_num", "xss_clean");
        $this->form_validation->set_rules("email", "email", "xss_clean");
        $this->form_validation->set_rules("cm_image", "cm_image", "xss_clean");
        $this->form_validation->set_rules("cm_nid_front", "cm_nid_front", "xss_clean");
        $this->form_validation->set_rules("cm_nid_back", "cm_nid_back", "xss_clean");
        $this->form_validation->set_rules("granter_name", "granter_name", "xss_clean");
        $this->form_validation->set_rules("granter_cont", "granter_cont", "xss_clean");
        $this->form_validation->set_rules("granter_add", "granter_add", "xss_clean");


        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
            $this->load->view('super_admin/create_customer/error');
        } else {
            $cm_image = $_FILES['cm_image']['name'];
            if ($cm_image != "") {
                $cm_image = random_string('alnum', 10) . '.jpg';
                //insert image
                $config['file_name'] = $cm_image;
                $config['upload_path'] = 'uploads/photos';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']         = '100000';
                $config['encrypt_name']     = false;
                $config['image_library'] = 'gd2';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('cm_image');

                $file_data = $this->upload->data();
            } else {
                $cm_image = "default.png";
            }

            $cm_nid_front = $_FILES['cm_nid_front']['name'];
            if ($cm_nid_front != "") {
                $cm_nid_front = random_string('alnum', 10) . '.jpg';
                //insert image
                $config['file_name'] = $cm_nid_front;
                $config['upload_path'] = 'uploads/photos';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']         = '100000';
                $config['encrypt_name']     = false;
                $config['image_library'] = 'gd2';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('cm_nid_front');

                $file_data = $this->upload->data();
            } else {
                $cm_nid_front = "default.png";
            }


            $cm_nid_back = $_FILES['cm_nid_back']['name'];
            if ($cm_nid_back != "") {
                $cm_nid_back = random_string('alnum', 10) . '.jpg';
                //insert image
                $config['file_name'] = $cm_nid_back;
                $config['upload_path'] = 'uploads/photos';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']         = '100000';
                $config['encrypt_name']     = false;
                $config['image_library'] = 'gd2';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('cm_nid_back');

                $file_data = $this->upload->data();
            } else {
                $cm_nid_back = "default.png";
            }

            //field worker select
            $fw_id_no = $this->input->post('fw_id_no');

            $this->db->where('fw_id_no', $fw_id_no);
            $query = $this->db->get("field_worker")->result();
            foreach ($query as $row) {
                // $zonal_office = $row->zonal_office;
                // $zonal_code = $row->zonal_code;
                $branch_office = $row->branch_office;
                $branch_code = $row->branch_code;
                $pickpoint_office = $row->pickpoint_office;
                $pickpoint_code = $row->pickpoint_code;
            }

            //insert data to database
            $data = array(
                'user_id'             => $this->input->post('cm_id_no'),
                'status'             => 'ENABLE',
                'fw_id_no'             => $fw_id_no,
                'zonal_office'         => '',
                'zonal_code'         => '',
                'branch_office'     => $branch_office,
                'branch_code'         => $branch_code,
                'pickpoint_office'     => $pickpoint_office,
                'pickpoint_code'         => $pickpoint_code,
                'customer'             => $this->input->post('customer'),
                'father_name'         => $this->input->post('father_name'),
                'mother_name'         => $this->input->post('mother_name'),
                'cm_dob'             => $this->input->post('cm_dob'),
                'cm_nid_no'         => $this->input->post('cm_nid_no'),
                'cm_present_add'     => $this->input->post('cm_present_add'),
                'cm_permanent_add'     => $this->input->post('cm_permanent_add'),
                'granter_name'         => $this->input->post('granter_name'),
                'granter_cont'         => $this->input->post('granter_cont'),
                'granter_add'         => $this->input->post('granter_add'),
                'cm_id_no'             => $this->input->post('cm_id_no'),
                'designation'        => 'customer',
                'cont_num'            => $this->input->post('cont_num'),
                'email'             => $this->input->post('email'),
                'cm_image'             => $cm_image,
                'cm_nid_front'         => $cm_nid_front,
                'cm_nid_back'         => $cm_nid_back,
                'created_date'         => date('Y-m-d H:i:s'),
                'update_date'         => date('Y-m-d H:i:s'),
            );

            $this->db->insert('customer', $data);
            $page_name = $this->uri->segment(1);
            if ($page_name == "field_worker") {
                redirect("field_worker/customer_list/");
            }
            redirect("super_admin/customer_list/");
        }
    }


    function getcustomer() {
        $this->db->order_by("cm_id", "DESC");
        $query = $this->db->get("customer");
        return $query->result();
    }

    function get_customer_by_fieldworker_id() {
        $fw_id_no = $this->session->userdata('user_id');

        $this->db->order_by("cm_id", "DESC");
        $this->db->where('fw_id_no', $fw_id_no);
        $query = $this->db->get("customer");
        return $query->result();
    }

    function getonerow_customer() {
        $user_id = $this->uri->segment(3);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get("customer");
        return $query->result();
    }

    function update_customer() {

        $this->load->library("form_validation");
        $this->form_validation->set_rules("fw_id_no", "fw_id_no", "xss_clean");
        $this->form_validation->set_rules("customer", "customer", "xss_clean");
        $this->form_validation->set_rules("father_name", "father_name", "xss_clean");
        $this->form_validation->set_rules("mother_name", "mother_name", "xss_clean");
        $this->form_validation->set_rules("cm_dob", "cm_dob", "xss_clean");
        $this->form_validation->set_rules("cm_nid_no", "cm_nid_no", "xss_clean");
        $this->form_validation->set_rules("cm_present_add", "cm_present_add", "xss_clean");
        $this->form_validation->set_rules("cm_permanent_add", "cm_permanent_add", "xss_clean");
        $this->form_validation->set_rules("cm_id_no", "cm_id_no", "xss_clean");
        $this->form_validation->set_rules("cont_num", "cont_num", "xss_clean");
        $this->form_validation->set_rules("email", "email", "xss_clean");
        $this->form_validation->set_rules("cm_image", "cm_image", "xss_clean");
        $this->form_validation->set_rules("cm_nid_front", "cm_nid_front", "xss_clean");
        $this->form_validation->set_rules("cm_nid_back", "cm_nid_back", "xss_clean");
        $this->form_validation->set_rules("granter_name", "granter_name", "xss_clean");
        $this->form_validation->set_rules("granter_cont", "granter_cont", "xss_clean");
        $this->form_validation->set_rules("granter_add", "granter_add", "xss_clean");

        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
            $this->load->view('super_admin/customer_list/error');
        } else {
            $cm_image = $_FILES['cm_image']['name'];
            $prev_cm_image = $this->input->post('prev_cm_image');
            if ($cm_image != "") {
                $cm_image = random_string('alnum', 10) . '.jpg';
                //insert image
                $config['file_name'] = $cm_image;
                $config['upload_path'] = 'uploads/photos';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']         = '100000';
                $config['encrypt_name']     = false;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('cm_image');

                $file_data = $this->upload->data();
            } else {
                $cm_image = $prev_cm_image;
            }

            $cm_nid_front = $_FILES['cm_nid_front']['name'];
            $prev_cm_nid_front = $this->input->post('prev_cm_nid_front');
            if ($cm_nid_front != "") {
                $cm_nid_front = random_string('alnum', 10) . '.jpg';
                //insert image
                $config['file_name'] = $cm_nid_front;
                $config['upload_path'] = 'uploads/photos';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']         = '100000';
                $config['encrypt_name']     = false;
                $config['image_library'] = 'gd2';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('cm_nid_front');

                $file_data = $this->upload->data();
            } else {
                $cm_nid_front = $prev_cm_nid_front;
            }


            $cm_nid_back = $_FILES['cm_nid_back']['name'];
            $prev_cm_nid_back = $this->input->post('prev_cm_nid_back');
            if ($cm_nid_back != "") {
                $cm_nid_back = random_string('alnum', 10) . '.jpg';
                //insert image
                $config['file_name'] = $cm_nid_back;
                $config['upload_path'] = 'uploads/photos';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']         = '100000';
                $config['encrypt_name']     = false;
                $config['image_library'] = 'gd2';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('cm_nid_back');

                $file_data = $this->upload->data();
            } else {
                $cm_nid_back = $prev_cm_nid_back;
            }

            $page_name = $this->uri->segment(1);

            //field worker select 
            $fw_id_no = $this->input->post('fw_id_no');

            $this->db->where('fw_id_no', $fw_id_no);
            $query = $this->db->get("field_worker")->result();
            foreach ($query as $row) {
                // $zonal_office = $row->zonal_office;
                // $zonal_code = $row->zonal_code;
                $branch_office = $row->branch_office;
                $branch_code = $row->branch_code;
                $pickpoint_office = $row->pickpoint_office;
                $pickpoint_code = $row->pickpoint_code;
            }

            //insert data to database
            $data = array(
                'fw_id_no'             => $fw_id_no,
                'branch_office'     => $branch_office,
                'branch_code'         => $branch_code,
                'pickpoint_office'     => $pickpoint_office,
                'pickpoint_code'         => $pickpoint_code,
                'customer'             => $this->input->post('customer'),
                'father_name'         => $this->input->post('father_name'),
                'mother_name'         => $this->input->post('mother_name'),
                'cm_dob'             => $this->input->post('cm_dob'),
                'cm_nid_no'         => $this->input->post('cm_nid_no'),
                'cm_present_add'     => $this->input->post('cm_present_add'),
                'cm_permanent_add'     => $this->input->post('cm_permanent_add'),
                'granter_name'         => $this->input->post('granter_name'),
                'granter_cont'         => $this->input->post('granter_cont'),
                'granter_add'         => $this->input->post('granter_add'),
                'cont_num'            => $this->input->post('cont_num'),
                'email'             => $this->input->post('email'),
                'cm_image'             => $cm_image,
                'cm_nid_front'         => $cm_nid_front,
                'cm_nid_back'         => $cm_nid_back,
                'update_date'         => date('Y-m-d H:i:s'),
            );

            $user_id = $this->input->post('user_id');
            $this->db->where('user_id', $user_id);
            $this->db->update('customer', $data);

            $page_name = $this->uri->segment(1);
            if ($page_name == "field_worker") {
                redirect("field_worker/customer_list/");
            }

            redirect("super_admin/customer_list");
        }
    }

    function search_customer() {

        $user_id = $this->input->post('user_id');

        redirect("super_admin/customer_list_search/" . $user_id);
        //redirect(base_url()."super_admin/fao_list_search/");

    }

    function search_customer_result() {
        $user_id = $this->uri->segment(3);

        $this->db->where('user_id', $user_id);
        $query = $this->db->get("customer");
        return $query->result();
    }



    function customer_purchase() {

        $this->load->library("form_validation");
        $this->form_validation->set_rules("pro_id", "pro_id", "xss_clean");
        $this->form_validation->set_rules("pro_instock", "pro_instock", "xss_clean");
        $this->form_validation->set_rules("pro_price", "pro_price", "xss_clean");
        $this->form_validation->set_rules("purchase_qty", "purchase_qty", "xss_clean");
        $this->form_validation->set_rules("purchase_total", "purchase_total", "xss_clean");
        $this->form_validation->set_rules("down_payment", "down_payment", "xss_clean");
        $this->form_validation->set_rules("pay_due", "pay_due", "xss_clean");
        $this->form_validation->set_rules("installment_plan", "installment_plan", "xss_clean");
        $this->form_validation->set_rules("per_installment", "per_installment", "xss_clean");
        $this->form_validation->set_rules("next_pay", "next_pay", "xss_clean");
        $this->form_validation->set_rules("fw_id_no", "fw_id_no", "xss_clean");
        $this->form_validation->set_rules("cm_id_no", "cm_id_no", "xss_clean");

        $cm_id_no = $this->input->post('cm_id_no');

        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
            $this->load->view('super_admin/customer_profile/'.$cm_id_no.'/error');
        } else {

            // Find product price
            $pro_id = $this->input->post('pro_id');
            $down_payment = $this->input->post('down_payment');
            $purchase_qty = $this->input->post('purchase_qty');
            $installment_plan = $this->input->post('installment_plan');

            $user_type = $this->session->userdata('user_type');
            
            // 7 day ahead from today
            $next_pay_date = date('Y-m-d', strtotime("+7 day", strtotime(date('Y-m-d'))));
            
            // $next_pay_date = $this->input->post('next_pay_date');

            $this->db->where('pro_id', $pro_id);
            $query = $this->db->get("product_name")->result();
            foreach ($query as $row) {
                $pro_name = $row->pro_name;
                $latest_price = $row->latest_price;
                $sell_price = $row->sell_price;
                $instock = $row->instock;
                $all_time_sell = $row->all_time_sell;
            }

            $purchase_total = $sell_price * $purchase_qty;
            $pay_due = $purchase_total - $down_payment;
            $instl_given = 0;

            if($pay_due == 0){
                $installment_plan = 0;
                $per_installment = 0;
                $next_pay_date = '';
                $pay_status = "COMPLETED";
            }else{
                $per_installment = round($pay_due / $installment_plan);
                $instl_given = 1;
                $pay_status = "RUNNING";
            }

            $next_level = "ADMIN";
            $status = "PENDING";

            if($user_type == "super_admin"){
                $next_level = "N/A";
                $status = "APPROVED";
            }

            $cp_no = mt_rand(100000, 999999);

            $fw_id_no = $this->input->post('fw_id_no');
            $this->db->where('fw_id_no', $fw_id_no);
            $branch_code = $this->db->get("field_worker")->row("branch_code");


            //insert data to database
            $data = array(
                'cp_no'         => $cp_no,
                'pro_id'         => $pro_id,
                'pro_name'         => $pro_name,
                'latest_price'     => $latest_price,
                'sell_price'     => $sell_price,
                'purchase_qty'     => $purchase_qty,
                'purchase_total'     => $purchase_total,
                'down_payment'     => $down_payment,
                'pay_due'     => $pay_due,
                'installment_plan'     => $installment_plan,
                'per_installment'     => $per_installment,
                'instl_given'     => $instl_given,
                'next_pay_date'     => $next_pay_date,
                'cm_id_no'        => $cm_id_no,
                'fw_id_no'        => $fw_id_no,
                'branch_code'     => $branch_code,
                'status'        => $status,
                'next_level'    => $next_level,
                'pay_status'    => $pay_status,
                'created_date'         => date('Y-m-d H:i:s'),
                'updated_date'         => date('Y-m-d H:i:s')
            );

            $data2 = array(
                'cp_no'         => $cp_no,
                'instl_no'         => 'INSTL-1',
                'instl_pay'         => $down_payment,
                'pro_id'         => $pro_id,
                'pro_name'         => $pro_name,
                'sell_price'     => $sell_price,
                'purchase_qty'    => $purchase_qty,
                'purchase_total'     => $purchase_total,
                'down_payment'     => $down_payment,
                'pay_due'     => $pay_due,
                'installment_plan'     => $installment_plan,
                'instl_given'     => $instl_given,
                'cm_id_no'        => $cm_id_no,
                'fw_id_no'        => $fw_id_no,
                'payment_date'    => date('Y-m-d H:i:s')
            );

            $this->db->insert('customer_purchase', $data);
            $this->db->insert('cp_history', $data2);

            // Update Stock In Product_Name Table
            $data3 = array(
                'instock'     => $instock - $purchase_qty,
                'all_time_sell'     => $all_time_sell + $purchase_qty,
                'update_date'     => date('Y-m-d H:i:s')
            );

            $this->db->where('pro_id', $pro_id);
            $this->db->update('product_name', $data3);

            //$id = $this->db->insert_id();

            $page_name = $this->uri->segment(1);
            if ($page_name == "field_worker") {
                redirect("field_worker/customer_profile/" . $cm_id_no);
            }
            redirect("super_admin/customer_profile/" . $cm_id_no);

        }
    }

    function getonerow_purchase() {
        $cm_id_no = $this->uri->segment(3);
        $this->db->order_by("created_date", "DESC");
        $this->db->where('cm_id_no', $cm_id_no);
        $query = $this->db->get("customer_purchase");
        return $query->result();
    }

    function get_pending_customer_purchase() {
        $query = $this->db->query("SELECT * FROM customer_purchase WHERE status = 'PENDING' ORDER BY created_date DESC");
        return $query->result();
    }

    function get_customer_purchase_by_fieldworker() {
        $fw_id_no = $this->session->userdata("user_id");
        $query = $this->db->query("SELECT * FROM customer_purchase WHERE fw_id_no = '$fw_id_no' ORDER BY created_date DESC");
        return $query->result();
    }
    
    function get_installment_collection_by_date() {
        $fw_id_no = $this->session->userdata("user_id");
        $date = date('Y-m-d');

        $query = $this->db->query("SELECT * FROM customer_purchase WHERE fw_id_no = '$fw_id_no' AND next_pay_date = '$date' ORDER BY created_date DESC");
        $number_of_rows = $query->num_rows();
        
        if($number_of_rows > 0){
            return $query->result();
        }
        else{
            return "NOT_FOUND";
        }
    }

    function get_installment_upcoming_collection_by_date() {
        $fw_id_no = $this->session->userdata("user_id");
        $date = date('Y-m-d');

        $query = $this->db->query("SELECT * FROM customer_purchase WHERE fw_id_no = '$fw_id_no' AND next_pay_date > '$date' ORDER BY created_date DESC");
        $number_of_rows = $query->num_rows();
        
        if($number_of_rows > 0){
            return $query->result();
        }
        else{
            return "NO_COLLECTION_FOUND";
        }
    }

    function get_installment_collection_by_fieldworker() {
        $fw_id_no = $this->session->userdata("user_id");
        $date = date('Y-m-d');

        $query = $this->db->query("SELECT * FROM customer_purchase WHERE fw_id_no = '$fw_id_no' AND pay_status = 'RUNNING' ORDER BY created_date");
        $number_of_rows = $query->num_rows();
        
        if($number_of_rows > 0){
            return $query->result();
        }
        else{
            return "NO_RECORD_FOUND";
        }
    }

    function get_purchase_due_payment() {
        $cm_id_no = $this->uri->segment(3);
        $query = $this->db->query("SELECT * FROM customer_purchase WHERE cm_id_no = '$cm_id_no' AND pay_due != 0  AND status='APPROVED' ORDER BY created_date DESC");
        return $query->result();
    }

    function getonerow_cp_no() {
        $cp_no = $this->uri->segment(3);
        $this->db->where('cp_no', $cp_no);
        $query = $this->db->get("customer_purchase");
        return $query->result();
    }

    function getonerow_cp_history() {
        $cm_id_no = $this->uri->segment(3);
        $this->db->order_by("payment_date", "DESC");
        $this->db->where('cm_id_no', $cm_id_no);
        $query = $this->db->get("cp_history");
        return $query->result();
    }

    function get_purchase_installment_history() {
        $cp_no = $this->uri->segment(3);
        $this->db->where('cp_no', $cp_no);
        $query = $this->db->get("cp_history");
        return $query->result();
    }

    function purchase_order_approved_admin() {

        $cp_no = $this->input->post('cp_no');
        // $status = $this->input->post('status');
        $data = array(
            'status'         => 'APPROVED',
            'next_level'     => 'N/A',
            'updated_date'     => date('Y-m-d H:i:s')
        );

        $this->db->where('cp_no', $cp_no);
        $this->db->update('customer_purchase', $data);

        redirect("super_admin/customer_purchase_view/" . $cp_no);
    }


    function cp_payment() {

        $this->load->library("form_validation");
        $this->form_validation->set_rules("cp_no", "cp_no", "xss_clean");
        $this->form_validation->set_rules("fw_id_no", "fw_id_no", "xss_clean");
        $this->form_validation->set_rules("cm_id_no", "cm_id_no", "xss_clean");
        $this->form_validation->set_rules("pay_installment", "pay_installment", "xss_clean");
        $this->form_validation->set_rules("next_payment_date", "next_payment_date", "xss_clean");

        $cm_id_no = $this->input->post('cm_id_no');

        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
            $this->load->view('super_admin/customer_profile/'.$cm_id_no.'/error');
        } else {

            // Installment inputs
            $pay_installment = floatval($this->input->post('pay_installment'));

            // $next_payment_date = $this->input->post('next_payment_date');
            // 7 day ahead from today
            $next_payment_date = date('Y-m-d', strtotime("+7 day", strtotime(date('Y-m-d'))));

            // Find product price
            $cp_no = $this->input->post('cp_no');

            $this->db->where('cp_no', $cp_no);
            $query = $this->db->get("customer_purchase")->result();
            foreach ($query as $row) {
                $pro_id = $row->pro_id;
                $pro_name = $row->pro_name;
                $sell_price = $row->sell_price;
                $purchase_qty = $row->purchase_qty;
                $purchase_total = $row->purchase_total;
                $down_payment = $row->down_payment;
                $pay_due = $row->pay_due;
                $installment_plan = $row->installment_plan;
                $instl_given = $row->instl_given;
                $cm_id_no = $row->cm_id_no;
                $fw_id_no = $row->fw_id_no;
                $pay_status = $row->pay_status;
            }

            $calc_pay_due = $pay_due - $pay_installment;
            $calc_down_payment = $down_payment + $pay_installment;

            // Update installment number
            $instl_given = $instl_given + 1;

            if($calc_pay_due <= 0){
                $pay_status = "COMPLETED";
            }

            //insert data to database
            $data = array(
                'down_payment'      => $calc_down_payment,
                'pay_due'           => $calc_pay_due,
                'instl_given'       => $instl_given,
                'next_pay_date'     => $next_payment_date,
                'pay_status'        => $pay_status,
                'updated_date'      => date('Y-m-d H:i:s')
            );

            $instl_no = "INSTL-$instl_given";
            $data2 = array(
                'cp_no'                 => $cp_no,
                'instl_no'              => $instl_no,
                'instl_pay'             => $pay_installment,
                'pro_id'                => $pro_id,
                'pro_name'              => $pro_name,
                'sell_price'            => $sell_price,
                'purchase_qty'          => $purchase_qty,
                'purchase_total'        => $purchase_total,
                'down_payment'          => $calc_down_payment,
                'pay_due'               => $calc_pay_due,
                'installment_plan'      => $installment_plan,
                'instl_given'           => $instl_given,
                'cm_id_no'              => $cm_id_no,
                'fw_id_no'              => $fw_id_no,
                'payment_date'          => date('Y-m-d H:i:s')
            );

            $this->db->where('cp_no', $cp_no);
            $this->db->update('customer_purchase', $data);
            
            $this->db->where('cp_no', $cp_no);
            $this->db->insert('cp_history', $data2);

            //$id = $this->db->insert_id();
            $page_name = $this->uri->segment(1);
            if ($page_name == "field_worker") {
                redirect("field_worker/customer_profile/" . $cm_id_no);
            }
            redirect("super_admin/customer_profile/" . $cm_id_no);
        }
    }
    // end of customer Functions

    function getadmin() {
        $this->db->order_by("u_id", "DESC");
        $this->db->where('user_id', "admin");
        $query = $this->db->get("admin_user");
        return $query->result();
    }

    function update_admin() {

        $this->load->library("form_validation");
        $this->form_validation->set_rules("full_name", "full_name", "xss_clean");
        $this->form_validation->set_rules("new_user_name", "user_name", "xss_clean");
        $this->form_validation->set_rules("new_pass_word", "pass_word", "xss_clean");

        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
            $this->load->view('super_admin/update_profile/error');
        } else {

            $user_id = "admin";
            $user_name = $this->input->post('user_name');
            $new_user_name = $this->input->post('new_user_name');

            // find out user name
            if ($user_name != $new_user_name) {
                // find out user name
                if (preg_match('/\s/', $new_user_name)) {
                    redirect("super_admin/update_profile/username_invalid");
                }
                $qry = "SELECT count(*) as cnt from admin_user where user_name= '$new_user_name'";
                $res = $this->db->query($qry, array($new_user_name))->result();

                if ($res[0]->cnt >= 1) {
                    redirect("super_admin/update_profile/username_error");
                }
            }

            //insert data to database
            $data2 = array(
                'full_name'         => $this->input->post('full_name'),
                'user_name'         => $this->input->post('new_user_name'),
                'pass_word'         => $this->input->post('new_pass_word')
            );

            $this->db->where('user_id', $user_id);
            $this->db->update('admin_user', $data2);

            $this->session->unset_userdata("user_name");
            $this->session->unset_userdata("user_type");
            $this->session->unset_userdata("user_id");
            $this->session->unset_userdata("status");

            $this->session->sess_destroy();
            $this->session->set_flashdata('logout_notification', 'logged_out');
            redirect("super_admin");
        }
    }

    function getfield_worker_panel() {
        $user_id = $this->session->userdata('user_id');
        //$this->db->order_by("u_id", "DESC");
        $this->db->where('user_id', $user_id);
        $query = $this->db->get("admin_user");
        return $query->result();
    }


    function update_field_worker_panel() {

        $this->load->library("form_validation");
        $this->form_validation->set_rules("full_name", "full_name", "xss_clean");
        $this->form_validation->set_rules("new_user_name", "user_name", "xss_clean");
        $this->form_validation->set_rules("new_pass_word", "pass_word", "xss_clean");

        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
            $this->load->view('field_worker/update_profile/error');
        } else {

            $user_id = $this->session->userdata('user_id');
            $user_name = $this->input->post('user_name');
            $new_user_name = $this->input->post('new_user_name');
            $new_pass_word = $this->input->post('new_pass_word');

            // find out user name
            if ($user_name != $new_user_name) {
                // find out user name
                if (preg_match('/\s/', $new_user_name)) {
                    redirect("field_worker/update_profile/username_invalid");
                }
                $qry = "SELECT count(*) as cnt from admin_user where user_name= '$new_user_name'";
                $res = $this->db->query($qry, array($new_user_name))->result();

                if ($res[0]->cnt >= 1) {
                    redirect("field_worker/update_profile/username_error");
                }
            }

            //insert data to database
            $data2 = array(
                'full_name'         => $this->input->post('full_name'),
                'user_name'         => $this->input->post('new_user_name'),
                'pass_word'         => $this->input->post('new_pass_word')
            );

            $this->db->where('user_id', $user_id);
            $this->db->update('admin_user', $data2);
            //redirect("super_admin/update_profile/success");
            
            // $this->session->unset_userdata();
            $this->session->unset_userdata("user_name");
            $this->session->unset_userdata("user_type");
            $this->session->unset_userdata("user_id");
            $this->session->unset_userdata("status");

            $this->session->sess_destroy();
            $this->session->set_flashdata('logout_notification', 'logged_out');
            redirect("login");
        }
    }
}
