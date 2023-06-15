<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('api_model');
    }

    public function index_get($not_id = NULL) {
        if ($not_id === NULL) {
            $data = $this->api_model->get_all();
        } else {
            $data = $this->api_model->get($not_id);
        }

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(NULL, 404);
        }
    }

    public function index_post() {
        $data = array(
            'not_title' => $this->post('not_title'),
            'not_category' => $this->post('not_category'),
            'not_description' => $this->post('not_description'),
			'not_thumbnail' => $this->post('not_thumbnail'),

        );

        $insert = $this->api_model->insert($data);
        if ($insert) {
            $this->response($data, 201);
        } else {
            $this->response(NULL, 400);
        }
    }

    public function index_put($not_id) {
        $data = array(
            'not_title' => $this->put('not_title'),
            'not_category' => $this->put('not_category'),
            'not_description' => $this->put('not_description'),
			'not_thumbnail' => $this->put('not_thumbnail'),

        );

        $update = $this->api_model->update($not_id, $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(NULL, 400);
        }
    }

    public function index_delete($not_id) {
        $delete = $this->api_model->delete($not_id);
        if ($delete) {
            $this->response(array('status' => 'success'), 200);
        } else {
            $this->response(NULL, 400);
        }
    }

}
