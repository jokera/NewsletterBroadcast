<?php

class Members extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->is_logged();
    }

    function index() {



        $this->home();
    }

    function home() {
        $data['main_view'] = 'members/members_area';
        $this->load->view('include/template', $data);
    }

    function is_logged() {
        $is_logged = $this->session->userdata('is_logged');
        if (!$is_logged || $is_logged != TRUE) {
            echo 'You don\'t have permission to see this page <a href="login">Login</a>';

            die();
        }
    }

}
