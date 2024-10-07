<?php

defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class Email_Controller extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->helper('url');
        $this->call->library('email');
        $this->call->library('session');
        $this->call->library('form_validation');
        $this->call->model('Email_Model');
    }

    public function sendEmail($toEmail, $subject, $body, $attach)
    {
        $fromEmail = $this->session->userdata('userEmail');
        $fromName = $this->session->userdata('userName');

        $this->email->sender($fromEmail, $fromName);
        $this->email->recipient($toEmail);
        $this->email->subject($subject);
        $this->email->email_content($body, 'text');
        $this->email->attachment($attach);
        $this->email->send();

        $this->Email_Model->saveEmail(
            $fromEmail,
            $toEmail,
            $subject,
            $body,
            $attach,
            'sent'
        );
    }
    public function upload()
    {
        $toEmail = $this->io->post('toEmail');
        $subject = $this->io->post('subject');
        $body = $this->io->post('body');

        if (isset($_FILES['attach']) && !empty($_FILES['attach']['tmp_name']) && !empty($_FILES['attach']['name'])) {
            $this->call->library('upload', $_FILES['attach']);

            $this->upload
                ->set_dir('public')
                ->allowed_extensions(array('jpg', 'pdf', 'doc', 'docx', 'png'))
                ->allowed_mimes(array('image/jpeg', 'application/pdf', 'application/msword'))
                ->encrypt_name();

            if ($this->upload->do_upload()) {
                $data['filename'] = $this->upload->get_filename();
                $data['toEmail'] = $toEmail;
                $attach = 'public/' . $this->upload->get_filename();
                $this->sendEmail($toEmail, $subject, $body, $attach);
                $this->call->view('success', $data);
            } 
        }
    }
}
