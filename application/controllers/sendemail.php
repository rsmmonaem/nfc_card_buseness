<?php
class Sendemail extends CI_Controller {

    function SendEmail() {
        parent::__construct();
        $this->load->library('email'); // load the library
    }

    function index() {
        $this->sendEmail();
    }

    public function mailsend() {
        // Email configuration
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.exdmania.com.bd',
            'smtp_port' => 465,
            'smtp_user' => 'admin@exdmania.com.bd', // change it to yours
            'smtp_pass' => 'mdrrana007', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->from('admin@exdmania.com.bd', "Exdmania");
        $this->email->to("mdrrana@gmail.com");
        $this->email->cc("softonrana@gmail.com");
        $this->email->subject("Exdmania Inquiry");
        $this->email->message("Mail sent test message...");

        $data['message'] = "Sorry Unable to send email...";
        if ($this->email->send()) {
            $data['message'] = "Mail sent...";
        }

        // forward to index page
        $this->load->view('index', $data);
    }
}
