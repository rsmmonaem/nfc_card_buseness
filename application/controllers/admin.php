<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {


    function __construct() {
        parent::__construct();

        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }


    public function login() {

        $this->load->view('admin/login');
    }


    /*public function login_process() {
        $user_name      = $_POST["user_name"];
        $pass_word      = $_POST["pass_word"];
        $qry = "SELECT count(*) as cnt from admin_user where user_name= '$user_name'";
        $res = $this->db->query($qry, array($user_name))->result();

        if ($res[0]->cnt == 0) {
            echo "<script>alert('Wrong User Name!') 
            window.location.href='login';</script>";
        } else {
            $qry2 = "SELECT count(*) as cnt from admin_user where pass_word= '$pass_word' AND user_name='$user_name'";
            $res2 = $this->db->query($qry2, array($pass_word))->result();
            if ($res2[0]->cnt == 0) {
                echo "<script>alert('Wrong PassWord!') 
                window.location.href='login';</script>";
            } else {

                $this->session->set_userdata('user_name', $user_name);
                redirect("admin");
            }
        }
    }*/

    /*******LOGOUT FUNCTION *******/
    function logout() {
        $this->session->unset_userdata();
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect("admin");
    }



    public function layout() {

        $this->load->library('session');
        if (!$this->session->userdata('user_name')) {
            redirect("admin/login");
        } else {

            $this->load->view('admin/includes/header_links');

            $this->load->view('admin/includes/left_menu');
            $this->load->view('admin/includes/top_bar');
            //$this->load->view('admin/includes/page_title');
            //$this->load->view('admin/includes/indicator');
        }
    }


    public function footer() {

        $this->load->view('admin/includes/footer');
        //$this->load->view('admin/includes/footer_js');

    }



    public function index() {
        $this->load->model('registration_model', 'rm');
        $this->layout();
        //$this->load->view('admin/includes/indicator');
        $this->load->view('admin/allregistered');
        $this->footer();
    }

    public function all_registerd() {
        $this->load->model('registration_model', 'rm');
        $this->layout();
        //$this->load->view('admin/includes/indicator');
        $this->load->view('admin/allregistered');
        $this->footer();
    }

    public function approved_list() {
        $this->load->model('registration_model', 'rm');
        $this->layout();
        //$this->load->view('admin/includes/indicator');
        $this->load->view('admin/approved_list');
        $this->footer();
    }

    public function pending_list() {
        $this->load->model('registration_model', 'rm');
        $this->layout();
        //$this->load->view('admin/includes/indicator');
        $this->load->view('admin/pending_list');
        $this->footer();
    }

    public function reject_list() {
        $this->load->model('registration_model', 'rm');
        $this->layout();
        //$this->load->view('admin/includes/indicator');
        $this->load->view('admin/reject_list');
        $this->footer();
    }

    public function update_registration() {

        $this->load->model('registration_model', 'rm');
        $this->rm->update_registration();
    }


    function delete_member($mem_id, $path) {
        $mem_id = $this->uri->segment(3);
        $path = $this->uri->segment(4);
        $this->db->where('id', $mem_id);
        $this->db->delete('registration');
        unlink(FCPATH . 'uploads/photos/' . $path);
        redirect("admin/all_registerd");
    }


    public function profile() {
        $this->load->model('registration_model', 'rm');
        $this->layout();
        //$this->load->view('admin/includes/indicator');
        $this->load->view('admin/profile');
        $this->footer();
    }

    /*End of Member Functions*/


    /*Home Content Functions*/

    public function new_home_content() {

        $this->layout();
        $this->load->view('admin/includes/new_home_content');

        $this->footer();
    }

    public function creat_home_content() {

        $this->load->model('home_content_model', 'hm');
        $this->hm->insert_home_content();
    }

    public function home_content_list() {
        $this->load->model('home_content_model', 'hm');
        $this->layout();
        $this->load->view('admin/includes/home_content_list');

        $this->footer();
    }

    public function about_us() {
        $this->load->model('home_content_model', 'am');
        $this->layout();
        $this->load->view('admin/includes/aboutus_content');

        $this->footer();
    }

    public function update_about() {
        $this->load->model('home_content_model', 'hm');
        $this->hm->update_about();
    }

    public function contact_us() {
        $this->load->model('home_content_model', 'cm');
        $this->layout();
        $this->load->view('admin/includes/contact_us_content');

        $this->footer();
    }

    public function update_contuct_us() {
        $this->load->model('home_content_model', 'cm');
        $this->cm->update_contact_us();
    }


    public function user_setting() {
        $this->load->model('home_content_model', 'um');
        $this->layout();
        $this->load->view('admin/includes/user_setting');

        $this->footer();
    }


    public function update_user_setting() {
        $this->load->model('home_content_model', 'um');
        $this->um->update_user_setting();
    }



    public function edit_home_content() {
        $this->load->model('home_content_model', 'hm');
        $this->layout();
        $this->load->view('admin/includes/edit_home_content');

        $this->footer();
    }

    public function update_home_content() {
        $this->load->model('home_content_model', 'hm');
        $this->hm->update_home_content();
    }

    function delete_home_content($hc_id) {
        $hc_id = $this->uri->segment(3);
        $this->db->where('hc_id', $hc_id);
        $this->db->delete('home_contents');
        redirect("admin/home_content_list");
    }

    /*End of Content Functions*/


    /*supporting*/


    public function support() {
        $this->load->model('home_content_model', 'um');
        $this->layout();
        $this->load->view('admin/includes/support');

        $this->footer();
    }



    public function support_write() {
        $this->layout();
        $this->load->model("client_model", "cm");
        //echo "Hello view_pages";

        $this->load->view('admin/includes/support_write');
        $this->footer();
    }

    public function support_reply() {
        $this->layout();
        $this->load->model("client_model", "cm");
        $this->load->model("support_model", "sm");
        //echo "Hello view_pages";

        $this->load->view('admin/includes/support_reply');
        $this->footer();
    }


    public function creat_support() {
        $this->layout();
        $this->load->model("support_model", "sm");
        $this->sm->create_admin_support();
        //echo "Hello view_pages";


    }

    public function admin_reply() {
        $this->layout();
        $this->load->model("support_model", "sm");
        $this->sm->admin_reply();
        //echo "Hello view_pages";


    }

    public function sent_list() {
        $this->layout();
        $this->load->model("support_model", "sm");
        //echo "Hello view_pages";

        $this->load->view('admin/includes/sent_list');
        $this->footer();
    }

    public function inbox_list() {
        $this->layout();
        $this->load->model("support_model", "sm");
        //echo "Hello view_pages";

        $this->load->view('admin/includes/inbox_list');
        $this->footer();
    }
    /*End of Supporting*/
}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */