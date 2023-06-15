<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller {


    function __construct() {
        parent::__construct();

        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }


    public function session_data() {
        // $this->load->model('requisition_model', 'rm');
        // $this->load->model('purchase_order_model', 'po');
        $this->load->library('session');
        // if (!$this->session->userdata('user_name')) {
        //     redirect("login");
        // }
    }


    public function index() {

        $this->load->library('session');
        if (!$this->session->userdata('user_name')) {
            redirect("login");
        } else {

            $this->load->view('user/index');
        }
    }

    public function add_institute() {
        $this->session_data();
        $this->load->model('add_institute_model', 'aim');
        $this->aim->create_institute();

        $this->load->view('user/add_institute');
       
    }

	
	public function step_trainee() {
		$this->session_data();
		
		$sessiondata = array(
			'nid' => $this->input->post('nid'),
		);
	
		$this->session->set_userdata($sessiondata);



		$this->load->view('user/step_trainee',$sessiondata);      
	}

	public function nid_chack(){

		$this->session_data();
		$inputNumber = $this->input->post('nid');
		// Query the database for matching numbers
		$this->db->select('trainee_nid');
		$this->db->from('trainee');
		$this->db->where('trainee_nid', $inputNumber);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			// Matching number found
			$this->db->where('trainee_nid', $inputNumber);
			$histry = $this->db->get('trainee');
			$result['data'] =  $histry->result();
			$result['dataa'] =  $histry->row();

		 $this->load->view('user/trainee_history', $result);
		} else {
			$post_nid['nid'] = $inputNumber;
			// echo "<pre>";
			// print_r($ff);
		 	// echo "</pre>";
			$this->load->view('user/trainee_info', ['post_nid' => $post_nid]);
		}
	}

	public function save_trainee() {
		$this->session_data();
		$this->load->model('add_trainee_model', 'atm');
		$this->atm->create_trainee();
		redirect('user/step_trainee');
	}

	public function add_another_course($nid) {
		$this->session_data();
		$this->load->model('add_trainee_model', 'atm');
		$data['data'] = $this->atm->get_trainee_nid('trainee',$nid);
		$this->load->view('user/add_another_course',$data);
	}

	public function save_another_course() {
		$this->session_data();
		$this->load->model('add_trainee_model', 'atm');
		$this->atm->create_another_trainee();
		redirect('user/step_trainee');
	}
	// public function save_another_course($id) {
	// 	$this->session_data();
	// 	$this->load->model('add_trainee_model', 'atm');
	// 	$data['data'] = $this->atm->get_trainee_id('trainee',$id);
	// 	$this->load->view('user/edit_trainee', $data);
	// }
	
	public function trainee_list() {
		$this->session_data();
		$this->load->model('add_trainee_model', 'atm');
		$this->atm->get_trainee();
		$this->load->view('user/trainee_list');
	}

    public function trainee_details($id) {
        $this->session_data();
        $this->load->model('add_trainee_model', 'atm');
        $data['data'] = $this->atm->get_trainee_details('trainee',$id);
        $this->load->view('user/trainee_details', $data);
    }


    public function edit_trainee($id) {
		$this->session_data();
		$this->load->model('add_trainee_model', 'atm');
		$data['data'] = $this->atm->get_trainee_id('trainee',$id);
		$this->load->view('user/edit_trainee', $data);
	}

	public function update_trainee() {
		$this->session_data();
		$this->load->model('add_trainee_model', 'atm');
		$this->atm->update_trainee();
		// redirect("user/trainee_list","refresh");
	}

	function trainee_delete($trainee_id) {
		$this->session_data();
		$trainee_id  = $this->uri->segment(3);
		$this->db->where('trainee_id', $trainee_id);
		$this->db->delete('trainee');
		redirect("user/trainee_list");
	}

	


    
 
}

