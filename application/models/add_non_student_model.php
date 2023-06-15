<?php
ob_start();
class add_non_student_model  extends CI_Model {

	


	public function create_non_student()
	{
		$non_st_photo = $_FILES['non_st_photo']['name'];
		if ($non_st_photo != "") {
			$non_st_photo = random_string('alnum', 10) . '.jpg';
			
			//insert image
			$config['file_name'] = $non_st_photo;
			$config['upload_path'] = 'uploads/non_student';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size']         = '100000';
			$config['encrypt_name']     = false;
			$config['image_library'] = 'gd2';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('non_st_photo');

			$file_data = $this->upload->data();
		} else {
			$non_st_photo = "default.png";
		}
		
     // Insert Data In Student Table 
       $non_student['non_st_name'] 					= $this->input->post('non_st_name');
	   $non_student['non_st_date_of_birth'] 		= $this->input->post('non_st_date_of_birth');
	   $non_student['non_st_gender'] 				= $this->input->post('non_st_gender');
	   $non_student['non_st_bg_group'] 				= $this->input->post('non_st_bg_group');
	   $non_student['non_st_religion'] 				= $this->input->post('non_st_religion');
	   $non_student['non_st_phone'] 				= $this->input->post('non_st_phone');
	   $non_student['non_st_nid_no'] 				= $this->input->post('non_st_nid_no');
	   $non_student['non_st_birth_certificate_id'] 	= $this->input->post('non_st_birth_certificate_id');
	   $non_student['non_st_health_condition'] 		= $this->input->post('non_st_health_condition');
	   $non_student['non_st_photo'] 				= $non_st_photo;
	   $non_student['non_st_present_address'] 		= $this->input->post('non_st_present_address');
	   $non_student['non_st_permanent_address'] 	= $this->input->post('non_st_permanent_address');

       $this->db->insert('non_student', $non_student);
       $uid = $this->db->insert_id();
	   



    // Insert Data In parents_info Table 
	   $non_student_parents_info['uid'] 				=$uid;
	   $non_student_parents_info['non_student_fathers_name'] 		= $this->input->post('non_student_fathers_name');
	   $non_student_parents_info['non_student_fathers_phone'] 		= $this->input->post('non_student_fathers_phone');
	   $non_student_parents_info['non_student_fathers_nid'] 		= $this->input->post('non_student_fathers_nid');
	   $non_student_parents_info['non_student_fathers_profession'] 	= $this->input->post('non_student_fathers_profession');
	   $non_student_parents_info['non_student_mothers_name'] 		= $this->input->post('non_student_mothers_name');
	   $non_student_parents_info['non_student_mothers_phone'] 		= $this->input->post('non_student_mothers_phone');
	   $non_student_parents_info['non_student_mothers_nid']			= $this->input->post('non_student_mothers_nid');
	   $non_student_parents_info['non_student_mothers_profession'] 	= $this->input->post('non_student_mothers_profession');

       $this->db->insert('non_student_parents_info',$non_student_parents_info);
       $id = $this->db->insert_id();
	

	   // Insert Data In guardian_info Table
       $non_student_guardian_info['uid'] = $uid;
       $non_student_guardian_info['non_student_guardian_info_type'] = $this->input->post('non_student_guardian_info_type');
       $non_student_guardian_info['non_student_guardian_info_name'] = $this->input->post('non_student_guardian_info_name');
       $non_student_guardian_info['non_student_guardian_info_phone'] = $this->input->post('non_student_guardian_info_phone');
       $non_student_guardian_info['non_student_guardian_info_rltn'] = $this->input->post('non_student_guardian_info_rltn');
       $non_student_guardian_info['non_student_guardian_info_nid'] = $this->input->post("non_student_guardian_info_nid");
	   $non_student_guardian_info['non_student_guardian_info_profession'] = $this->input->post("non_student_guardian_info_profession");
	   $non_student_guardian_info['non_student_guardian_info_date_of_birth'] = $this->input->post("non_student_guardian_info_date_of_birth");
	   $non_student_guardian_info['non_student_guardian_info_religion'] = $this->input->post("non_student_guardian_info_religion");
       $non_student_guardian_info['non_student_guardian_info_other'] = $this->input->post("non_student_guardian_info_other");
	   $non_student_guardian_info['non_student_guardian_info_present_address'] = $this->input->post("non_student_guardian_info_present_address");
	   $non_student_guardian_info['non_student_guardian_info_permanent_address'] = $this->input->post("non_student_guardian_info_permanent_address");
       
	   $this->db->insert('non_student_guardian_info', $non_student_guardian_info);
       $gid = $this->db->insert_id();
       
      // Insert Data In users
    
       
       // View
	   $this->session->set_flashdata('message', '<div class="alert alert-success">Record has been Created successfully.</div>');
	   redirect("super_admin/add_non_student");

	}
	// List non student
	function get_non_student() {
        $this->db->order_by("non_st_id", "DESC");
        $query = $this->db->get("non_student");
        return $query->result();
		}

    	// signle non student	
	public function get_non_student_row($id) {
        //$st_id = $this->uri->segment(3);
        //$this->db->where('st_id', $st_id);
		$this->db->select('*');
		$this->db->from('non_student');
		$this->db->join('non_student_guardian_info', 'non_student_guardian_info.uid = non_student.non_st_id');
		$this->db->join('non_student_parents_info', 'non_student_parents_info.uid = non_student.non_st_id');
		$query = $this->db->get();
        $result = $query->row();
        return $result;
	}


	public function update_non_student()
	{
		$non_st_id 				= $this->input->post('non_st_id');
		 $non_student_parents_info_id 	= $this->input->post('non_student_parents_info_id');
		 $non_student_guardian_id		= $this->input->post('non_student_guardian_id ');
			
		$non_st_photo = $_FILES['non_st_photo']['name'];

		 //OLD IMAGE
		 $prev_non_st_photo = $this->input->post('old_non_st_photo');

		if ($non_st_photo != "") {
			$non_st_photo = random_string('alnum', 10) . '.jpg';
			
			//insert image
			$config['file_name'] = $non_st_photo;
			$config['upload_path'] = 'uploads/non_student';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size']         = '100000';
			$config['encrypt_name']     = false;
			$config['image_library'] = 'gd2';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('non_st_photo');

			$file_data = $this->upload->data();
		} else {			 
			 $non_st_photo = $prev_non_st_photo;
			 
		}
		
		 // Insert Data In Student Table 
	    $non_student['non_st_name'] 					= $this->input->post('non_st_name');
	   $non_student['non_st_date_of_birth'] 		= $this->input->post('non_st_date_of_birth');
	   $non_student['non_st_gender'] 				= $this->input->post('non_st_gender');
	   $non_student['non_st_bg_group'] 				= $this->input->post('non_st_bg_group');
	   $non_student['non_st_religion'] 				= $this->input->post('non_st_religion');
	   $non_student['non_st_phone'] 				= $this->input->post('non_st_phone');
	   $non_student['non_st_nid_no'] 				= $this->input->post('non_st_nid_no');
	   $non_student['non_st_birth_certificate_id'] 	= $this->input->post('non_st_birth_certificate_id');
	   $non_student['non_st_health_condition'] 		= $this->input->post('non_st_health_condition');
	   $non_student['non_st_photo'] 				= $non_st_photo;
	   $non_student['non_st_present_address'] 		= $this->input->post('non_st_present_address');
	   $non_student['non_st_permanent_address'] 	= $this->input->post('non_st_permanent_address');

			 
		$this->db->where('non_st_id', $non_st_id);
		$this->db->update('non_student', $non_student);



		// Insert Data In parents_info Table 
		$non_student_parents_info['uid'] 				=$non_st_id;
		$non_student_parents_info['non_student_fathers_name'] 		= $this->input->post('non_student_fathers_name');
		$non_student_parents_info['non_student_fathers_phone'] 		= $this->input->post('non_student_fathers_phone');
		$non_student_parents_info['non_student_fathers_nid'] 		= $this->input->post('non_student_fathers_nid');
		$non_student_parents_info['non_student_fathers_profession'] 	= $this->input->post('non_student_fathers_profession');
		$non_student_parents_info['non_student_mothers_name'] 		= $this->input->post('non_student_mothers_name');
		$non_student_parents_info['non_student_mothers_phone'] 		= $this->input->post('non_student_mothers_phone');
		$non_student_parents_info['non_student_mothers_nid']			= $this->input->post('non_student_mothers_nid');
		$non_student_parents_info['non_student_mothers_profession'] 	= $this->input->post('non_student_mothers_profession');
 

		$this->db->where('non_student_parents_info_id ', $non_student_parents_info_id );
		$this->db->update('non_student_parents_info', $non_student_parents_info);



		$non_student_guardian_info['uid'] = $non_st_id;
       $non_student_guardian_info['non_student_guardian_info_type'] = $this->input->post('non_student_guardian_info_type');
       $non_student_guardian_info['non_student_guardian_info_name'] = $this->input->post('non_student_guardian_info_name');
       $non_student_guardian_info['non_student_guardian_info_phone'] = $this->input->post('non_student_guardian_info_phone');
       $non_student_guardian_info['non_student_guardian_info_rltn'] = $this->input->post('non_student_guardian_info_rltn');
       $non_student_guardian_info['non_student_guardian_info_nid'] = $this->input->post("non_student_guardian_info_nid");
	   $non_student_guardian_info['non_student_guardian_info_profession'] = $this->input->post("non_student_guardian_info_profession");
	   $non_student_guardian_info['non_student_guardian_info_date_of_birth'] = $this->input->post("non_student_guardian_info_date_of_birth");
	   $non_student_guardian_info['non_student_guardian_info_religion'] = $this->input->post("non_student_guardian_info_religion");
       $non_student_guardian_info['non_student_guardian_info_other'] = $this->input->post("non_student_guardian_info_other");
	   $non_student_guardian_info['non_student_guardian_info_present_address'] = $this->input->post("non_student_guardian_info_present_address");
	   $non_student_guardian_info['non_student_guardian_info_permanent_address'] = $this->input->post("non_student_guardian_info_permanent_address");
			 
		
		$this->db->where('non_student_guardian_id', $non_student_guardian_id );
		$this->db->update('non_student_guardian_info', $non_student_guardian_info);
		
					 

	}

}

