<?php

class Subscribe_model extends CI_Model {

    function get_num_rows() {
        $q = $this->db->get('subscribers');

        return $q->num_rows();
    }

    function search($sort_by, $sort_order, $per_page, $offset) {
        $this->db->order_by($sort_by, $sort_order);
        $q = $this->db->get('subscribers', $per_page, $offset);

        return $q->result();
    }

}
