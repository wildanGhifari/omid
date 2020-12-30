<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Checkout_model extends MY_Model
{

    public $table = 'orders';
    private $id;

    public function __construct()
    {
        parent::__construct();
        $is_login   = $this->session->userdata('is_login');
        $this->id   = $this->session->userdata('id');

        if (!$is_login) {
            redirect(base_url());
            return;
        }
    }

    public function getDefaultValues()
    {
        return [
            'name'      => '',
            'address'   => '',
            'phone'     => '',
            'status'    => ''
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'name',
                'label' => 'Nama',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'address',
                'label' => 'Alamat',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'phone',
                'label' => 'Telepon',
                'rules' => 'trim|required|max_length[15]'
            ],
        ];

        return $validationRules;
    }

    public function getSum()
    {
        $totalWeight = "SELECT `id_user`, sum(weight) as weight FROM cart WHERE id_user = $this->id GROUP BY id_user";
        $result = $this->db->query($totalWeight, array($this->id));
        return $result->row()->weight;

        print_r($result);
    }
}

/* End of file Checkout_model.php */
