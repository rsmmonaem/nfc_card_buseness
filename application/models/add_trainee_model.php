<?php
ob_start();
class add_trainee_model  extends CI_Model
{

// Create Objection
    function create_trainee()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("trainee_name", "trainee_name", "xss_clean");
        $this->form_validation->set_rules("trainee_name_eng", "trainee_name_eng", "xss_clean");
        $this->form_validation->set_rules("trainee_father_name", "trainee_father_name", "xss_clean");
        $this->form_validation->set_rules("trainee_father_name_eng", "trainee_father_name_eng", "xss_clean");
        $this->form_validation->set_rules("trainee_mother_name", "trainee_mother_name", "xss_clean");
        $this->form_validation->set_rules("trainee_mother_name_eng", "trainee_mother_name_eng", "xss_clean");
        $this->form_validation->set_rules("trainee_dob", "trainee_dob", "xss_clean");
        $this->form_validation->set_rules("trainee_nid", "trainee_nid", "xss_clean");
        $this->form_validation->set_rules("trainee_present_address", "trainee_present_address", "xss_clean");
        $this->form_validation->set_rules("trainee_permanent_address", "trainee_permanent_address", "xss_clean");
        $this->form_validation->set_rules("trainee_education", "trainee_education", "xss_clean");
        $this->form_validation->set_rules("trainee_religion", "trainee_religion", "xss_clean");
        $this->form_validation->set_rules("trainee_gender", "trainee_gender", "xss_clean");
        $this->form_validation->set_rules("trainee_phone", "trainee_phone", "xss_clean");
        $this->form_validation->set_rules("trainee_alternate_phone", "trainee_alternate_phone", "xss_clean");
        $this->form_validation->set_rules("trainee_past_training", "trainee_past_training", "xss_clean");
        $this->form_validation->set_rules("trainee_youth_member", "trainee_youth_member", "xss_clean");
        $this->form_validation->set_rules("trainee_training_reason", "trainee_training_reason", "xss_clean");
        $this->form_validation->set_rules("trainee_image", "trainee_image", "xss_clean");
		$this->form_validation->set_rules("trainee_course", "trainee_course", "xss_clean");
		$this->form_validation->set_rules("trainee_username", "trainee_username", "xss_clean");
		$this->form_validation->set_rules("trainee_password", "trainee_password", "xss_clean");





        if ($this->form_validation->run() == FALSE) {


        } else {

            $trainee_image = $_FILES['trainee_image']['name'];
            if ($trainee_image != "") {
                $trainee_image = random_string('alnum', 10) . '.jpg';

                //insert image
                $config['file_name'] = $trainee_image;
                $config['upload_path'] = 'uploads/trainees';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '100000';
                $config['encrypt_name'] = false;
                $config['image_library'] = 'gd2';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('trainee_image');

                $file_data = $this->upload->data();
            } else {
                $trainee_image = "default.png";
            }


            //insert data to database

            $data = array(
                'trainee_name' => $this->input->post('trainee_name'),
                'trainee_name_eng' => $this->input->post('trainee_name_eng'),
                'trainee_father_name' => $this->input->post('trainee_father_name'),
                'trainee_father_name_eng' => $this->input->post('trainee_father_name_eng'),
                'trainee_mother_name' => $this->input->post('trainee_mother_name'),
                'trainee_mother_name_eng' => $this->input->post('trainee_mother_name_eng'),
                'trainee_dob' => $this->input->post('trainee_dob'),
                'trainee_current_age' => $this->input->post('trainee_current_age'),
                'trainee_nid' => $this->input->post('trainee_nid'),
                'trainee_present_address' => $this->input->post('trainee_present_address'),
                'trainee_permanent_address' => $this->input->post('trainee_permanent_address'),
                'trainee_education' => $this->input->post('trainee_education'),
                'trainee_religion' => $this->input->post('trainee_religion'),
                'trainee_gender' => $this->input->post('trainee_gender'),
                'trainee_phone' => $this->input->post('trainee_phone'),
                'trainee_alternate_phone' => $this->input->post('trainee_alternate_phone'),
                'trainee_past_training' => $this->input->post('trainee_past_training'),
                'trainee_youth_member' => $this->input->post('trainee_youth_member'),
                'trainee_training_reason' => $this->input->post('trainee_training_reason'),
				'trainee_username' => $this->input->post('trainee_username'),
                'trainee_password' => $this->input->post('trainee_password'),
                'trainee_image' => $trainee_image,
				'trainee_status' => 'Active',
				'trainee_course' => 'trainee_course',
            );

            $this->db->insert('trainee', $data);



			// Insert Admin
			$data2 = array(
				'full_name'             => $this->input->post('trainee_name'),
				'user_name' 		=> $this->input->post('trainee_username'),
                'pass_word' 		=> $this->input->post('trainee_password'),
				'user_type' 		=> 'trainee',
				'status' 		=> 'ENABLE',

            );

			$this->db->insert('admin_user', $data2);

            //$id = $this->db->insert_id();
            $this->session->set_flashdata('message', '<div class="alert alert-success">Record has been Created successfully.</div>');

        }
    }

	function create_another_trainee()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("trainee_name", "trainee_name", "xss_clean");
        $this->form_validation->set_rules("trainee_name_eng", "trainee_name_eng", "xss_clean");
        $this->form_validation->set_rules("trainee_father_name", "trainee_father_name", "xss_clean");
        $this->form_validation->set_rules("trainee_father_name_eng", "trainee_father_name_eng", "xss_clean");
        $this->form_validation->set_rules("trainee_mother_name", "trainee_mother_name", "xss_clean");
        $this->form_validation->set_rules("trainee_mother_name_eng", "trainee_mother_name_eng", "xss_clean");
        $this->form_validation->set_rules("trainee_dob", "trainee_dob", "xss_clean");
        $this->form_validation->set_rules("trainee_nid", "trainee_nid", "xss_clean");
        $this->form_validation->set_rules("trainee_present_address", "trainee_present_address", "xss_clean");
        $this->form_validation->set_rules("trainee_permanent_address", "trainee_permanent_address", "xss_clean");
        $this->form_validation->set_rules("trainee_education", "trainee_education", "xss_clean");
        $this->form_validation->set_rules("trainee_religion", "trainee_religion", "xss_clean");
        $this->form_validation->set_rules("trainee_gender", "trainee_gender", "xss_clean");
        $this->form_validation->set_rules("trainee_phone", "trainee_phone", "xss_clean");
        $this->form_validation->set_rules("trainee_alternate_phone", "trainee_alternate_phone", "xss_clean");
        $this->form_validation->set_rules("trainee_past_training", "trainee_past_training", "xss_clean");
        $this->form_validation->set_rules("trainee_youth_member", "trainee_youth_member", "xss_clean");
        $this->form_validation->set_rules("trainee_training_reason", "trainee_training_reason", "xss_clean");
        $this->form_validation->set_rules("trainee_image", "trainee_image", "xss_clean");
		$this->form_validation->set_rules("trainee_course", "trainee_course", "xss_clean");
		$this->form_validation->set_rules("trainee_username", "trainee_username", "xss_clean");
		$this->form_validation->set_rules("trainee_password", "trainee_password", "xss_clean");


        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
        } else {

            $trainee_image = $_FILES['trainee_image']['name'];

            //OLD IMAGE
            $prev_image = $this->input->post('old_image');


            if ($trainee_image != "") {
                $trainee_image = random_string('alnum', 10) . '.jpg';
                //insert image
                $config['file_name'] = $trainee_image;
                $config['upload_path']      = 'uploads/trainees';
                $config['allowed_types']    = 'gif|jpg|jpeg|png';
                $config['max_size']         = '100000';
                $config['encrypt_name']     = false;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('trainee_image');

                $file_data = $this->upload->data();
            } else {
                $trainee_image = $prev_image;
            }

          //  $trainee_id = $this->uri->segment(3);


            //insert data to database

            $data = array(
                'trainee_name' => $this->input->post('trainee_name'),
                'trainee_name_eng' => $this->input->post('trainee_name_eng'),
                'trainee_father_name' => $this->input->post('trainee_father_name'),
                'trainee_father_name_eng' => $this->input->post('trainee_father_name_eng'),
                'trainee_mother_name' => $this->input->post('trainee_mother_name'),
                'trainee_mother_name_eng' => $this->input->post('trainee_mother_name_eng'),
                'trainee_dob' => $this->input->post('trainee_dob'),
                'trainee_current_age' => $this->input->post('trainee_current_age'),
                'trainee_nid' => $this->input->post('trainee_nid'),
                'trainee_present_address' => $this->input->post('trainee_present_address'),
                'trainee_permanent_address' => $this->input->post('trainee_permanent_address'),
                'trainee_education' => $this->input->post('trainee_education'),
                'trainee_religion' => $this->input->post('trainee_religion'),
                'trainee_gender' => $this->input->post('trainee_gender'),
                'trainee_phone' => $this->input->post('trainee_phone'),
                'trainee_alternate_phone' => $this->input->post('trainee_alternate_phone'),
                'trainee_past_training' => $this->input->post('trainee_past_training'),
                'trainee_youth_member' => $this->input->post('trainee_youth_member'),
                'trainee_training_reason' => $this->input->post('trainee_training_reason'),
                'trainee_image' => $trainee_image,
				'trainee_status' => 'Pending',
                'trainee_course' =>  $this->input->post('trainee_course'),
				'trainee_username' => $this->input->post('trainee_username'),
                'trainee_password' => $this->input->post('trainee_password'),


            );

            $this->db->insert('trainee', $data);

            //$id = $this->db->insert_id();
            $this->session->set_flashdata('message', '<div class="alert alert-success">Record has been Created successfully.</div>');

        }
    }

     function get_trainee() {
         $this->db->order_by("trainee_id", "DESC");
         $query = $this->db->get("trainee");
         return $query->result();
     }

    function get_pending_trainee() {
        $this->db->order_by("trainee_id", "DESC")->where("trainee_status", "Pending");
        $query = $this->db->get("trainee");
        return $query->result();
    }

    function approve_trainee() {
        $trainee_id = $this->uri->segment(3);

        $data = array(
            'trainee_status' => 'Active',
        );

        $this->db->where('trainee_id', $trainee_id);
        $this->db->update('trainee', $data);
    }


     function trainee_delete($trainee_id) {
         $this->session_data();
         $trainee_id = $this->uri->segment(3);
         $this->db->where('trainee_id', $trainee_id);
         $this->db->delete('trainee');
     }

     function get_trainee_id($table, $id)
     {
         $result = $this->db->get_where($table, ['trainee_id' => $id])->row();
         return $result;
     }

	 function get_trainee_nid($table, $nid)
     {
         $result = $this->db->get_where($table, ['trainee_nid' => $nid])->row();
         return $result;
     }

     function get_trainee_details($table, $id)
     {
         $result = $this->db->get_where($table, ['trainee_id' => $id])->row();
         return $result;
     }
     function get_trainee_certificate($table, $id)
     {
         $result = $this->db->get_where($table, ['trainee_id' => $id])->row();
         return $result;
     }


     function update_trainee() {
         $this->load->library("form_validation");
         $this->form_validation->set_rules("trainee_name", "trainee_name", "xss_clean");
         $this->form_validation->set_rules("trainee_name_eng", "trainee_name_eng", "xss_clean");
         $this->form_validation->set_rules("trainee_father_name", "trainee_father_name", "xss_clean");
         $this->form_validation->set_rules("trainee_father_name_eng", "trainee_father_name_eng", "xss_clean");
         $this->form_validation->set_rules("trainee_mother_name", "trainee_mother_name", "xss_clean");
         $this->form_validation->set_rules("trainee_mother_name_eng", "trainee_mother_name_eng", "xss_clean");
         $this->form_validation->set_rules("trainee_dob", "trainee_dob", "xss_clean");
         $this->form_validation->set_rules("trainee_nid", "trainee_nid", "xss_clean");
         $this->form_validation->set_rules("trainee_present_address", "trainee_present_address", "xss_clean");
         $this->form_validation->set_rules("trainee_permanent_address", "trainee_permanent_address", "xss_clean");
         $this->form_validation->set_rules("trainee_education", "trainee_education", "xss_clean");
         $this->form_validation->set_rules("trainee_religion", "trainee_religion", "xss_clean");
         $this->form_validation->set_rules("trainee_gender", "trainee_gender", "xss_clean");
         $this->form_validation->set_rules("trainee_phone", "trainee_phone", "xss_clean");
         $this->form_validation->set_rules("trainee_alternate_phone", "trainee_alternate_phone", "xss_clean");
         $this->form_validation->set_rules("trainee_past_training", "trainee_past_training", "xss_clean");
         $this->form_validation->set_rules("trainee_youth_member", "trainee_youth_member", "xss_clean");
         $this->form_validation->set_rules("trainee_training_reason", "trainee_training_reason", "xss_clean");
         $this->form_validation->set_rules("trainee_image", "trainee_image", "xss_clean");


         if ($this->form_validation->run() == FALSE) {
             echo  $this->upload->display_errors();
         } else {

             $trainee_image = $_FILES['trainee_image']['name'];

             //OLD IMAGE
             $prev_image = $this->input->post('old_image');


             if ($trainee_image != "") {
                 $trainee_image = random_string('alnum', 10) . '.jpg';
                 //insert image
                 $config['file_name'] = $trainee_image;
                 $config['upload_path']      = 'uploads/trainees';
                 $config['allowed_types']    = 'gif|jpg|jpeg|png';
                 $config['max_size']         = '100000';
                 $config['encrypt_name']     = false;

                 $this->load->library('upload', $config);
                 $this->upload->initialize($config);
                 $this->upload->do_upload('trainee_image');

                 $file_data = $this->upload->data();
             } else {
                 $trainee_image = $prev_image;
             }

             $trainee_id = $this->uri->segment(3);

             //zone change

             // echo $company_code = $this->input->post('company_code');


             //insert data to database

             $data = array(
                 'trainee_name' => $this->input->post('trainee_name'),
                 'trainee_name_eng' => $this->input->post('trainee_name_eng'),
                 'trainee_father_name' => $this->input->post('trainee_father_name'),
                 'trainee_father_name_eng' => $this->input->post('trainee_father_name_eng'),
                 'trainee_mother_name' => $this->input->post('trainee_mother_name'),
                 'trainee_mother_name_eng' => $this->input->post('trainee_mother_name_eng'),
                 'trainee_dob' => $this->input->post('trainee_dob'),
                 'trainee_current_age' => $this->input->post('trainee_current_age'),
                 'trainee_nid' => $this->input->post('trainee_nid'),
                 'trainee_present_address' => $this->input->post('trainee_present_address'),
                 'trainee_permanent_address' => $this->input->post('trainee_permanent_address'),
                 'trainee_education' => $this->input->post('trainee_education'),
                 'trainee_religion' => $this->input->post('trainee_religion'),
                 'trainee_gender' => $this->input->post('trainee_gender'),
                 'trainee_phone' => $this->input->post('trainee_phone'),
                 'trainee_alternate_phone' => $this->input->post('trainee_alternate_phone'),
                 'trainee_past_training' => $this->input->post('trainee_past_training'),
                 'trainee_youth_member' => $this->input->post('trainee_youth_member'),
                 'trainee_training_reason' => $this->input->post('trainee_training_reason'),
                 'trainee_image' => $trainee_image,


             );


             $this->db->where('trainee_id', $trainee_id);
             $this->db->update('trainee', $data);
         }
     }


}
