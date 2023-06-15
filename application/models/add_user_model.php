<?php
ob_start();
class add_user_model  extends CI_Model {


    function create_user() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("inst_name", "inst_name", "xss_clean");
        //$this->form_validation->set_rules("inst_eiin", "inst_eiin", "xss_clean");
		$this->form_validation->set_rules("inst_username", "inst_username", "xss_clean");
        $this->form_validation->set_rules("inst_password", "inst_password", "xss_clean");
       // $this->form_validation->set_rules("inst_founded", "inst_founded", "xss_clean");
        //$this->form_validation->set_rules("inst_board", "inst_board", "xss_clean");
        $this->form_validation->set_rules("inst_contact", "inst_contact", "xss_clean");
        $this->form_validation->set_rules("inst_logo", "inst_logo", "xss_clean");
        $this->form_validation->set_rules("user_id", "user_id", "xss_clean");

		
		
		$this->form_validation->set_rules("email", "email", "xss_clean");
		$this->form_validation->set_rules("map_address", "map_address", "xss_clean");
		$this->form_validation->set_rules("facebook", "facebook", "xss_clean");

		$this->form_validation->set_rules("instagram", "instagram", "xss_clean");
		$this->form_validation->set_rules("linkedin", "linkedin", "xss_clean");
		$this->form_validation->set_rules("github", "github", "xss_clean");
		$this->form_validation->set_rules("facebook_page", "facebook_page", "xss_clean");
		$this->form_validation->set_rules("whatsapp", "whatsapp", "xss_clean");
		$this->form_validation->set_rules("bio", "bio", "xss_clean");
		$this->form_validation->set_rules("education", "education", "xss_clean");


        if ($this->form_validation->run() == FALSE) {
                   
                   
        } else {

            $inst_logo = $_FILES['inst_logo']['name'];
            if ($inst_logo != "") {
                $inst_logo = random_string('alnum', 10) . '.jpg';
                
                //insert image
                $config['file_name'] = $inst_logo;
                $config['upload_path'] = 'uploads/institute';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']         = '100000';
                $config['encrypt_name']     = false;
                $config['image_library'] = 'gd2';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('inst_logo');

                $file_data = $this->upload->data();
            } else {
                $inst_logo = "default.png";
            }


            //insert data to database

            $data = array(
                'inst_name'             => $this->input->post('inst_name'),
                //'inst_eiin'             => $this->input->post('inst_eiin'),
               // 'inst_founded'          => $this->input->post('inst_founded'),
                //'inst_board'            => $this->input->post('inst_board'),
                'inst_contact'          => $this->input->post('inst_contact'),
                'inst_logo'             => $inst_logo,

                'inst_user_id'              => $this->input->post('user_id'), 
                
				'email' 				=> $this->input->post('email'),    
				'map_address' 				=> $this->input->post('map_address'), 
				'facebook' 				=> $this->input->post('facebook'), 
				'instagram' 				=> $this->input->post('instagram'), 
				'linkedin' 				=> $this->input->post('linkedin'), 
				'github' 				=> $this->input->post('github'), 
				'facebook_page' 				=> $this->input->post('facebook_page'), 
				'whatsapp' 				=> $this->input->post('whatsapp'), 
				'bio' 				=> $this->input->post('bio'), 
				'education' 				=> $this->input->post('education'), 

            );

            $this->db->insert('user', $data);

			$data2 = array(
				'full_name'         => $this->input->post('inst_name'),
				'user_name' 		=> $this->input->post('inst_username'),
                'pass_word' 		=> $this->input->post('inst_password'),
				'user_type' 		=> 'institute_admin',  
				'status' 		=> 'ENABLE', 
				'user_id' 		=> $this->input->post('user_id'),     				            
            );
           
			$this->db->insert('admin_user', $data2);
            //$id = $this->db->insert_id();
           
        }
    }


    function get_user() {
        $this->db->order_by("inst_id", "DESC");
        $query = $this->db->get("user");
        return $query->result();
    }


	

    //   function get_user_id($table, $id)
    // {
	// 	$result = $this->db->get_where($table, ['inst_id' => $id])->row();
		
    //     return $result;
    // }
	// function get_admin_id($table, $id)
    // {	
		
	// 	$result = $this->db->get_where($table, $id)->row();
    //     return $result;
    // }
	// function get_user_details($table, $id)
	// {
	// 	$this->uri->segment(3);
	// 	$result = $this->db->get_where($table, $id)->row();
	// 	return $result;
	// }
	public function get_user_row() {
		$inst_user_id = $this->uri->segment(3);

		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('admin_user', 'admin_user.user_id = user.inst_user_id');
		$this->db->where('user_id', $inst_user_id);

		$query = $this->db->get();
        $result = $query->row();
        return $result;
	}

    function update_user() {

		$this->load->library("form_validation");
        $this->form_validation->set_rules("inst_name", "inst_name", "xss_clean");
        //$this->form_validation->set_rules("inst_eiin", "inst_eiin", "xss_clean");
       // $this->form_validation->set_rules("inst_founded", "inst_founded", "xss_clean");
       // $this->form_validation->set_rules("inst_board", "inst_board", "xss_clean");
        $this->form_validation->set_rules("inst_contact", "inst_contact", "xss_clean");
        $this->form_validation->set_rules("inst_logo", "inst_logo", "xss_clean");
        $this->form_validation->set_rules("inst_username", "inst_username", "xss_clean");
        $this->form_validation->set_rules("inst_password", "inst_password", "xss_clean");
		$this->form_validation->set_rules("user_id", "user_id", "xss_clean");
		$this->form_validation->set_rules("inst_id", "inst_id", "xss_clean");

		$this->form_validation->set_rules("email", "email", "xss_clean");
		$this->form_validation->set_rules("map_address", "map_address", "xss_clean");
		$this->form_validation->set_rules("facebook", "facebook", "xss_clean");
		$this->form_validation->set_rules("instagram", "instagram", "xss_clean");
		$this->form_validation->set_rules("linkedin", "linkedin", "xss_clean");
		$this->form_validation->set_rules("github", "github", "xss_clean");
		$this->form_validation->set_rules("facebook_page", "facebook_page", "xss_clean");
		$this->form_validation->set_rules("whatsapp", "whatsapp", "xss_clean");
		$this->form_validation->set_rules("bio", "bio", "xss_clean");
		$this->form_validation->set_rules("education", "education", "xss_clean");
		

        if ($this->form_validation->run() == FALSE) {
            echo  $this->upload->display_errors();
        } else {

            $inst_logo = $_FILES['inst_logo']['name'];

            //OLD IMAGE
            $prev_logo = $this->input->post('old_logo');
			
            if ($inst_logo != "") {
                $inst_logo = random_string('alnum', 10) . '.jpg';
                //insert image
                $config['file_name'] = $inst_logo;
                $config['upload_path'] = 'uploads/institute';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']         = '100000';
                $config['encrypt_name']     = false;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('inst_logo');

                $file_data = $this->upload->data();
            } else {
                 $inst_logo = $prev_logo;
            }
            

			$inst_user_id = $this->input->post('user_id');
			$user_id = $inst_user_id;
            //insert data to database
            $data = array(
                'inst_name'             => $this->input->post('inst_name'),
                'inst_eiin'                 => $this->input->post('inst_eiin'),
                'inst_founded'                 => $this->input->post('inst_founded'),
                'inst_board'                   => $this->input->post('inst_board'),
                'inst_contact'                 => $this->input->post('inst_contact'),
                'inst_logo'                 => $inst_logo,

				'email' 				=> $this->input->post('email'),    
				'map_address' 				=> $this->input->post('map_address'), 
				'facebook' 				=> $this->input->post('facebook'), 
				'instagram' 				=> $this->input->post('instagram'), 
				'linkedin' 				=> $this->input->post('linkedin'), 
				'github' 				=> $this->input->post('github'), 
				'facebook_page' 				=> $this->input->post('facebook_page'), 
				'whatsapp' 				=> $this->input->post('whatsapp'), 
				'bio' 				=> $this->input->post('bio'), 
				'education' 				=> $this->input->post('education'),
            );
            $this->db->where('inst_user_id', $inst_user_id);
            $this->db->update('user', $data);

			

            $datauser = array(
                'full_name'                 =>  $this->input->post('inst_name'),
                'user_name'                 =>  $this->input->post('inst_username'),
                'pass_word'                 =>  $this->input->post('inst_password'),
            );

            $this->db->where('user_id', $user_id);
            $this->db->update('admin_user', $datauser);
        }
    }

}
