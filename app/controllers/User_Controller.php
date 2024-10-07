<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class User_Controller extends Controller
{

    // model constructor
    public function __construct()
    {
        parent::__construct();
        $this->call->model('User_Model');
        $this->call->helper('url');
        $this->call->library('email');
        $this->call->library('session');
        $this->call->library('form_validation');
    }

    // login
    public function index()
    {
        $this->call->view('index');

        if ($this->form_validation->submitted()) {
            $email = $this->io->post('email');
            $password = $this->io->post('password');

            $user = $this->User_Model->loginCredentials($email, $password);

            if ($user) {
                $this->session->set_userdata('userId', $user['id']);
                $this->session->set_userdata('userName', $user['name']);
                $this->session->set_userdata('userEmail', $user['email']);

                redirect('/dashboard');
            } else {
                echo 'Invalid Credentials';
                redirect('/');
            }
        } else {
            $this->call->view(view_file: 'index');
        }
    }

    // logout
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }

    // register
    public function register()
    {

        if ($this->form_validation->submitted()) {
            $name = $this->io->post('name');
            $email = $this->io->post('email');
            $password = $this->io->post('password');
            $confPassword = $this->io->post('confPassword');

            if ($password !== $confPassword) {
                echo 'Passwords do not match';
                redirect('/register');
            } elseif ($this->User_Model->isEmailExists($email)) {
                echo 'Email already exists';
                redirect('/register');
            } else {
                $token = $this->User_Model->registerAccounts($name, $email, $password);

                if ($token) {
                    $this->sendVerificationEmail($email, $name, $token);

                    $data['verificationLink'] = site_url('/verify/' . $token);
                    $data['email'] = $email;
                    $this->call->view('verification', $data);

                    // echo "<script>alert('Registration successful! Please check your email for verification.');</script>";
                } else {
                    echo 'Failed to register account';
                    redirect('/register');
                }
            }
        }

        $this->call->view('register');
    }

    public function sendVerificationEmail($toEmail, $name, $token)
    {
        $verificationLink = site_url('/verify/' . $token);

        $subject = 'Verify Account';
        $message = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Verify Your Account</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        margin: 0;
                        padding: 0;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 20px;
                        background-color: #ffffff;
                        border: 1px solid #dddddd;
                        border-radius: 10px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    }
                    .button {
                        display: inline-block;
                        padding: 10px 20px;
                        background-color: #007bff;
                        color: #ffffff;
                        text-decoration: none;
                        border-radius: 5px;
                        margin-top: 20px;
                    }
                    .button:hover {
                        background-color: #0056b3;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <h2>Verify Your Account</h2>
                    <p>Hello <strong>' . htmlspecialchars($name) . '</strong>,</p>
                    <p>Thank you for registering with us! To complete your registration, please verify your email by clicking the link below:</p>
                    <a href="' . $verificationLink . '" class="button">Verify Your Account</a>
                    <p>If the button doesn\'t work, copy and paste the following URL into your browser:</p>
                    <p><a href="' . $verificationLink . '">' . $verificationLink . '</a></p>
                    <p>Thanks,<br>The LavaLust Team</p>
                </div>
            </body>
            </html>';

        $this->email->sender('lavalust@gmail.com', 'LavaLust');
        $this->email->recipient($toEmail);
        $this->email->subject($subject);
        $this->email->email_content($message, 'html');
        $this->email->send();
    }


    public function verify($token)
    {
        if ($this->User_Model->verifyAccounts($token)) {
            echo '<script>alert("Account verified successfully! You will now be redirected to the login page.");</script>';
            echo '<script>window.location.href = "' . site_url('/') . '";</script>';
        } else {
            echo 'Invalid or expired verification token.';
            redirect('/');
        }
    }


    public function dashboard()



    {
        if ($this->session->userdata('userId')) {

            $data['name'] = $this->session->userdata('userName');
            $this->call->view('dashboard', $data);
        } else {
            redirect('/');
        }
    }
}
