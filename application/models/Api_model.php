<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

    public function get_all() {
        return $this->db->get('notice')->result();
    }

    public function get($not_id) {
        return $this->db->get_where('notice', array('not_id' => $not_id))->row();
    }

    public function insert($data) {
        return $this->db->insert('notice', $data);
    }

    public function update($not_id, $data) {
        $this->db->where('not_id', $not_id);
        return $this->db->update('notice', $data);
    }

    public function delete($not_id) {
        return $this->db->delete('notice', array('not_id' => $not_id));
    }
}
