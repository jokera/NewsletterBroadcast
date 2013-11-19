<?php

class Subscribers extends CI_Controller {

    function display($sort_by = 'first_name', $sort_order = 'asc') {
        $this->load->library('pagination');
        $this->load->model('Subscribe_model');
        $total_rows = $this->Subscribe_model->get_num_rows();


        $config['base_url'] = 'http://localhost/ci/subscribers/display/' . $sort_by . '/' . $sort_order . '/page/';
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 3;
        $config['uri_segment'] = 6;
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['rows'] = $this->Subscribe_model->search($sort_by, $sort_order, $config['per_page'], $this->uri->segment($config['uri_segment']));
        $data['sort_by'] = $sort_by;
        $data['sort_order'] = $sort_order;
        $data['total_rows'] = $total_rows;
        $this->load->view('subscribers_view', $data);
    }

}
