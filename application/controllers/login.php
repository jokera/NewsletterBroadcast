<?php

class Login extends CI_Controller {

    function index() {
        $this->do_login();
    }

    function do_login() {

        $data['main_view'] = 'login/login_form';
        $this->load->view('include/template', $data);
    }

    function validate() {
        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('username', 'Username', 'trim|required|min_length[3]');
        $val->set_rules('password', 'Password', 'trim|required|min_length[4]');
        if ($val->run()) {
            $this->load->model('users_model');
            if ($this->users_model->validate_login()) {
                if ($this->users_model->is_active() == FALSE) {
                    redirect('login');
                } else {
                    $data = array(
                        'is_logged' => true,
                        'username' => $this->input->post('username')
                    );
                    $this->session->set_userdata($data);
                    redirect('members');
                }
            } else {

//flash data-set value into user session only for the next request for the server

                $this->session->set_flashdata('errmsg', 'Invalid username or password');
                redirect('login/index', 'refresh');
            }
        } else {
            $this->index();
        }
    }

    function register() {
        $data['main_view'] = 'login/register_form';
        $this->load->view('include/template', $data);
    }

    function validate_register() {

        $this->load->library('form_validation');
        $val = $this->form_validation;

        $val->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[3]|max_length[30]');
        $val->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[30]');
        $val->set_rules('password2', 'Password confirmation', 'trim|required|min_length[6]|max_length[30]|matches[password]');
        $val->set_rules('email', 'E-mail', 'trim|required|max_length[50]|valid_email');
        $val->set_rules('fname', 'First Name', 'trim|required|min_length[3]|max_length[30]');
        $val->set_rules('lname', 'Last Name', 'trim|required|min_length[3]|max_length[30]');

        $val->set_error_delimiters('<p class ="validation_err">', '</p>');
        if ($val->run()) {

            $this->load->model('users_model');
            if ($this->users_model->_check_username()) {
                if ($this->users_model->_check_email()) {
                    $activation_code = $this->_gen_pass(32);
                    if ($this->_send_email($activation_code)) {

                        if ($this->users_model->insert_user($activation_code)) {
                            echo 'Registration is succesful.Check your email';
                        } else {
                            echo 'error db insert';
                        }
                    } else {
                        echo 'arr with send email';
                    }
                } else {
                    echo 'This email already exists';
                }
            } else {
                echo 'This username already exists';
            }
        } else {
            $this->register();
        }
    }

    function activate() {
        $username = $this->uri->segment(3);
        $activation_code = $this->uri->segment(4);

        if ($username != NULL && $activation_code != NULL) {
            $this->load->model('users_model');
            if ($this->users_model->activate_account($username, $activation_code)) {
                echo 'Account activated <a href="' . site_url('login') . '">Login</a>';
            } else {
                echo 'Wrong name or code';
            }
        }
    }

    function _send_email($activation_code) {

        $code = $activation_code;
        $username = $this->input->post('username');
        $email_to = $this->input->post('email');
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'hristo.stoyanov9@gmail.com',
            'smtp_pass' => 'j_o_k_e_r_a_90',
            'charset' => 'utf-8',
            'mailtype' => "html"
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('hristo.stoyanov9@gmail.com', 'Sys Admin');
        $this->email->to($email_to);
        $this->email->subject('Activate Your Account');
        $message = 'Hello, ' . $username .
                'Your Registration is almost compleate.Click on the link below to activate your account: '
                . site_url('login/activate') . '/' . $username . '/' . $code . '';
        $this->email->message($message);
        if ($this->email->send()) {
            return TRUE;
        } else {
            show_error($this->email->print_debugger());
        }
    }

    function _gen_pass($len) {
        $pol = '123456789abcdefhijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = '';
        for ($i = 0; $i < $len; $i++) {
            $str .= substr($pol, mt_rand(0, strlen($pol) - 1), 1);
        }
        return $str;
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

}
