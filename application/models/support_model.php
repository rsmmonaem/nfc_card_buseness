<?php
ob_start();
class Support_model  extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function create_client_support() {

        $this->load->library("form_validation");
        $this->form_validation->set_rules("msg_to", "Message To", "required|xss_clean");
        $this->form_validation->set_rules("msg_subject", "Subject", "required|xss_clean");
        $this->form_validation->set_rules("priority", "Priority", "required|xss_clean");

        $this->form_validation->set_rules("support_msg", "Email", "required|xss_clean");


        if ($this->form_validation->run() == false) {
            redirect("client_panel/support_write/error");
        } else {

            $client_id = $this->session->userdata('cl_id');

            //insert data to database 

            $data = array(

                'msg_to'                     => $this->input->post('msg_to'),
                'msg_from'                     => $client_id,
                'client_id'                 => $client_id,

                'msg_subject'                 => $this->input->post('msg_subject'),
                'priority'                     => $this->input->post('priority'),
                'support_msg'                 => $this->input->post('support_msg'),
                'msg_type'                     => 'c2a',


                'read_status'                 => 'UNREAD',
                'create_date'             => date('Y-m-d H:i:s')


            );
            print_r($data);
            $this->db->insert('support_sent', $data);

            echo "Insert Success";

            redirect("client_panel/sent_list");
        }
    }

    function create_admin_support() {

        $this->load->library("form_validation");
        $this->form_validation->set_rules("msg_to", "Message To", "required|xss_clean");
        $this->form_validation->set_rules("msg_subject", "Subject", "required|xss_clean");
        $this->form_validation->set_rules("priority", "Priority", "required|xss_clean");

        $this->form_validation->set_rules("support_msg", "Email", "required|xss_clean");


        if ($this->form_validation->run() == false) {
            redirect("client_panel/support_write/error");
        } else {

            //$client_id=$this->session->userdata('cl_id');

            //insert data to database 

            $data = array(

                'msg_to'                     => $this->input->post('msg_to'),
                'msg_from'                     => 'Admin',
                'client_id'                 => $this->input->post('msg_to'),

                'msg_subject'                 => $this->input->post('msg_subject'),
                'priority'                     => $this->input->post('priority'),
                'support_msg'                 => $this->input->post('support_msg'),
                'msg_type'                     => 'a2c',


                'read_status'                 => 'UNREAD',
                'create_date'             => date('Y-m-d H:i:s')


            );
            print_r($data);
            $this->db->insert('support_sent', $data);

            echo "Insert Success";

            redirect("super_admin/sent_list");
        }
    }

    function admin_reply() {

        $this->load->library("form_validation");
        $this->form_validation->set_rules("msg_to", "Message To", "required|xss_clean");
        $this->form_validation->set_rules("msg_subject", "Subject", "required|xss_clean");
        $this->form_validation->set_rules("priority", "Priority", "required|xss_clean");

        $this->form_validation->set_rules("reply_msg", "Email", "required|xss_clean");


        if ($this->form_validation->run() == false) {
            redirect("client_panel/support_reply/error");
        } else {

            //$client_id=$this->session->userdata('cl_id');

            //insert data to database 

            $data = array(

                'msg_to'                     => $this->input->post('msg_to'),
                'msg_from'                     => 'Admin',
                'client_id'                 => $this->input->post('msg_to'),

                'msg_subject'                 => $this->input->post('msg_subject'),
                'priority'                     => $this->input->post('priority'),
                'support_msg'                 => $this->input->post('reply_msg'),
                'msg_type'                     => 'admin_reply',


                'read_status'                 => 'UNREAD',
                'create_date'             => date('Y-m-d H:i:s')


            );
            print_r($data);
            $this->db->insert('support_sent', $data);

            echo "Insert Success";

            redirect("super_admin/sent_list");
        }
    }

    function support_reply() {
        $ss_id = $this->uri->segment(3);
        $this->db->where('ss_id', $ss_id);
        $query = $this->db->get("support_sent");
        return $query->result();
    }

    function sent_list() {
        $cl_id = $this->session->userdata('cl_id');

        $this->db->where('client_id', $cl_id);
        $query = $this->db->get("support_sent");

        return $query->result();
    }


    function sent_list_admin() {
        $where = '(msg_type="a2c" or msg_type = "admin_reply")';

        $this->db->where($where);
        //$this->db->where('msg_type','a2c');
        $this->db->order_by("ss_id", "DESC");
        $query = $this->db->get("support_sent");

        return $query->result();
    }

    function inbox_list_admin() {
        $this->db->where('msg_type', 'c2a');
        $this->db->order_by("ss_id", "DESC");
        $query = $this->db->get("support_sent");

        return $query->result();
    }



    function order_list() {
        $cl_id = $this->session->userdata('cl_id');
        $this->db->order_by("or_id", "DESC");
        $this->db->where('client_id', $cl_id);
        $query = $this->db->get("orders");

        return $query->result();
    }



    function update_client() {

        $cl_id = $this->uri->segment(3);
        $this->load->library("form_validation");
        $this->form_validation->set_rules("first_name", "First Name", "required|xss_clean");
        $this->form_validation->set_rules("last_name", "Last Name", "required|xss_clean");
        $this->form_validation->set_rules("phone", "Phone", "required|xss_clean");
        $this->form_validation->set_rules("email", "Email", "required|xss_clean");
        $this->form_validation->set_rules("password", "Password", "required|xss_clean");
        $this->form_validation->set_rules("country", "Country", "required|xss_clean");
        //$this->form_validation->set_rules("acceptation","Acceptation","required|xss_clean");

        if ($this->form_validation->run() == false) {

            redirect("site/register_error");
        } else {

            //Update data to database
            $data = array(

                'first_name'             => $this->input->post('first_name'),
                'last_name'             => $this->input->post('last_name'),
                'phone'                 => $this->input->post('phone'),
                'email'                 => $this->input->post('email'),
                'password'                 => $this->input->post('password'),
                'country'                 => $this->input->post('country'),
                'update_date'             => date('Y-m-d H:i:s')

            );

            //print_r($data);
            $cl_id = $this->uri->segment(3);
            $this->db->where('cl_id', $cl_id);
            $this->db->update('clients', $data);
            //echo "Update Success";
            redirect("super_admin/client_list");
        }
    }

    function update_profile() {


        $this->load->library("form_validation");
        $this->form_validation->set_rules("first_name", "First Name", "xss_clean");
        $this->form_validation->set_rules("last_name", "Last Name", "xss_clean");
        $this->form_validation->set_rules("phone", "Phone", "xss_clean");
        $this->form_validation->set_rules("email", "Email", "xss_clean");
        $this->form_validation->set_rules("password", "Password", "xss_clean");
        $this->form_validation->set_rules("country", "Country", "xss_clean");
        $this->form_validation->set_rules("about", "Country", "xss_clean");
        //$this->form_validation->set_rules("acceptation","Acceptation","required|xss_clean");

        if ($this->form_validation->run() == false) {

            redirect("client_panel/profile/error");
        } else {

            //Update data to database
            $data = array(

                'first_name'             => $this->input->post('first_name'),
                'last_name'             => $this->input->post('last_name'),
                'phone'                 => $this->input->post('phone'),
                'password'                 => $this->input->post('password'),
                'country'                 => $this->input->post('country'),
                'about'                 => $this->input->post('about'),
                'gender'                 => $this->input->post('gender'),
                'web'                     => $this->input->post('web'),



                'update_date'             => date('Y-m-d H:i:s')

            );

            //print_r($data);
            $cl_id = $this->session->userdata('cl_id');
            $this->db->where('cl_id', $cl_id);
            $this->db->update('clients', $data);
            //echo "Update Success";
            redirect("client_panel/profile");
        }
    }

    function delete_client() {
        //delete data to database

        echo $cl_id = $this->uri->segment(3);
        $this->db->where('cl_id', $cl_id);
        echo  $this->db->delete('clients');

        echo "Delete Success";
        redirect("super_admin/client_list");
    }

    function check_username() {
        $email = $this->uri->segment(3);
        //$select = "SELECT * from clients where email = '$email'";

        $this->db->where('email', $email);
        $query = $this->db->get("clients");
        $numRow = $query->num_rows();

        if ($numRow == 0) {
            echo "<img src='" . base_url() . "assets/site/images/available.png' align= 'absmiddle'> <font color='Green'> Available </font>";
        } else {
            echo "<img src='" . base_url() . "assets/site/images/not-available.png'  align=absmiddle'> <font color='red'>Not Available </font>";
        }
    }

    function sendMail() {

        $first_name = $this->input->post('first_name');
        $last_name  = $this->input->post('last_name');
        $name         = $first_name . ' ' . $last_name;
        $email        = $this->input->post('email');

        $html_email = $this->load->view('email_template/client_verification_mail', $name, true);

        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->from('admin@bestliveforexsignals.com'); // change it to yours
        $this->email->to($email); // change it to yours
        $this->email->subject('Verification Message');
        $this->email->message($html_email);

        if ($this->email->send()) {
            echo 'Email sent.';
        } else {
            show_error($this->email->print_debugger());
        }
    }


    public function email_confirm($active_code, $email) {
        $qry = "SELECT count(*) as cnt from clients where active_code= ?";
        $res = $this->db->query($qry, array($active_code))->result();
        if ($res[0]->cnt > 0) {
            $data = array(

                'status'             => 'EMAIL_VERIFIED',
                'update_date'         => date('Y-m-d H:i:s')

            );
            $this->db->where('active_code', $active_code);
            $this->db->update('clients', $data);
            $this->db->where('email', $email);
            $this->load->view('email_confirm');
        } else {
            echo 'ERROR';
        }
    }
}
