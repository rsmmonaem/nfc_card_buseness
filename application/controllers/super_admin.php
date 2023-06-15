<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Super_admin extends CI_Controller {


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
		 if (!$this->session->userdata('user_name')) {
			 redirect("login");
		 }
	 }


	 public function index() {

		 $this->load->library('session');
		 if (!$this->session->userdata('user_name')) {
			 redirect("login");
		 } else {
			 $this->load->view('super_admin/index');
		 }
	 }


	
    //Start Add user
    public function add_user(){
        $this->session_data();
        $this->load->model('add_user_model', 'aum');
        $this->aum->create_user();
        $this->load->view('super_admin/add_user');
    }


    public function user_list() {
        $this->session_data();
        $this->load->model('add_user_model', 'aum');
		$data['data'] = $this->aum->get_user();
	// 	echo "<pre>";
	// 	print_r($data);
	//  echo "</pre>";
        $this->load->view('super_admin/user_list');
    }


	public function edit_user() {
		$this->session_data();
		$this->load->model('add_user_model', 'aum');
		$data['data'] = $this->aum->get_user_row();
	// 	echo "<pre>";
	// 	print_r($data);
	//  echo "</pre>";
		$this->load->view('super_admin/edit_user', $data);

}
   public function update_user() {
       $this->session_data();
       $this->load->model('add_user_model', 'aum');
       $this->aum->update_user();
        redirect("super_admin/user_list","refresh");
   }

   public function user_details() {
	
	$this->session_data();
	$this->load->model('add_user_model', 'aum');
	$data['data'] = $this->aum->get_user_row();
	//print_r($data);
	$this->load->view('super_admin/user_info', $data);
}
	function user_delete($inst_user_id) {
		$this->session_data();
		$inst_user_id = $this->uri->segment(3);
		$this->db->where('user_id', $inst_user_id);
		$this->db->delete('admin_user');
		$this->db->where('inst_user_id', $inst_user_id);
		$this->db->delete('user');

		// $this->db->delete('admin_user');
		redirect("super_admin/user_list");
	}
    //End user

}




