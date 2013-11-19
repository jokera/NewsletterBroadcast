<?php

class Users_model extends CI_Model {

    function validate_login() {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('members');
        if ($query->num_rows() == 1) {
            //exists
            return true;
        }
    }

    function _check_username() {
        $username = $this->input->post('username');
        $this->db->select('username');
        $this->db->where('username', $username);
        $query = $this->db->get('members');
        if ($query->num_rows() != 0) {
            return false;
        } else {
            return true;
        }
    }

    function _check_email() {

        $email = $this->input->post('email');
        $this->db->select('email');
        $this->db->where('email', $email);
        $query = $this->db->get('members');
        if ($query->num_rows() != 0) {
            return false;
        } else {
            return true;
        }
    }

    function insert_user($activation_code) {

        $user_data = array(
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'email' => $this->input->post('email'),
            'fname' => $this->input->post('fname'),
            'lname' => $this->input->post('lname'),
            'activation_code' => $activation_code
        );
        $query = $this->db->insert('members', $user_data);
        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function activate_account($username, $activation_code) {
        $this->db->select('username, activation_code');
        $this->db->where('username', $username);
        $this->db->where('activation_code', $activation_code);
        $query = $this->db->get('members');

        if ($query->num_rows == 1) {
            $update_data = array(
                'activation_code' => '',
                'active' => 1
            );
            $update_where = array(
                'activation_code' => $activation_code,
                'username' => $username
            );

            $this->db->update('members', $update_data, $update_where);
            if ($this->db->affected_rows() == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    function is_active() {
        $username = $this->input->post('username');

        $this->db->select('active,activation_code');
        $this->db->where('username', $username);
        $query = $this->db->get('members');
        if ($query->num_rows() == 1) {
            $row = $query->row();
            if ($row->active == 0 && $row->activation_code != '') {
                $this->session->set_flashdata('errmsg', 'Your Account is not activated yet. Please check your mail');
                return false;
            } else if ($row->active == 0 && $row->activation_code == '') {
                $this->session->set_flashdata('errmsg', 'Your Account has been disabled for some reason.Contact Billing team');
                return false;
            } else {
                return true;
            }
        }
    }

}
