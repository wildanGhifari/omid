<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends MY_Controller
{
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


    public function index($input = null)
    {
        $this->load->library('rajaongkir');
        $data['provinces'] = json_decode($this->rajaongkir->province());

        // Kode kurir: jne, pos, tiki, rpx, pandu, wahana, sicepat, jnt, pahala, sap, jet, indah, dse, slis, first, ncs, star, ninja, lion, idl, rex, ide, sentral.
        $data['couriers'] = [
            ['id' => 'jne', 'name' => 'JNE'],
            ['id' => 'jnt', 'name' => 'JNT'],
            ['id' => 'pos', 'name' => 'Pos Indonesia'],
            ['id' => 'tiki', 'name' => 'TIKI'],
            ['id' => 'rpx', 'name' => 'RPX'],
            ['id' => 'sicepat', 'name' => 'SICEPAT'],
            ['id' => 'ninja', 'name' => 'NINJA EXPRESS'],
            ['id' => 'wahana', 'name' => 'WAHANA'],
        ];
        $this->checkout->table  = 'cart';
        $data['cart']    = $this->checkout->select([
            'cart.id', 'cart.qty', 'cart.subtotal',
            'product.title', 'product.image', 'product.price', 'product.weight'
        ])
            ->join('product')
            ->where('cart.id_user', $this->id)
            ->get();

        if (!$data['cart']) {
            $this->session->set_flashdata('warning', 'Your cart is empty.');
            redirect(base_url('cart'));
        }

        $data['totalWeight'] = $this->checkout->getSum();

        $data['input']  = $input ? $input : (object) $this->checkout->getDefaultValues();
        $data['title']  = 'Checkout';
        $data['page']   = 'pages/checkout/index';

        $this->view($data);
    }


    public function create()
    {
        if (!$_POST) {
            redirect(base_url('checkout'));
        } else {
            $input  = (object) $this->input->post(null, true);
        }

        if (!$this->checkout->validate()) {
            return $this->index($input);
        }

        $total  = $this->db->select_sum('subtotal')
            ->where('id_user', $this->id)
            ->get('cart')
            ->row()
            ->subtotal;


        // parameter untuk membaca inputan ====================
        $province       = explode('-', $this->input->post('nama-provinsi'))[1];
        $city           = explode('-', $this->input->post('city'))[1];
        $subdistrict    = explode('-', $this->input->post('subdistrict'))[1];
        $service        = explode('-', $this->input->post('service'))[1];
        $ongkir         = explode('-', $this->input->post('service'))[0];


        $data = [
            'id_user'       => $this->id,
            'date'          => date('Y-m-d'),
            'invoice'       => $this->id . date('YmdHis'),
            'total'         => str_replace(".", "", $this->input->post('total')),
            'name'          => $input->name,
            'address'       => $input->address,
            'province'      => $province,
            'district'      => $city,
            'subdistrict'   => $subdistrict,
            'courier'       => $this->input->post('nama-ekspedisi'),
            'package'       => $service . '-' . $ongkir,
            'phone'         => $input->phone,
            'status'        => 'waiting'
        ];

        if ($order = $this->checkout->create($data)) {
            $cart = $this->db->where('id_user', $this->id)
                ->get('cart')->result_array();
            foreach ($cart as $row) {
                $row['id_orders']    = $order;
                unset($row['id'], $row['id_user']);
                $this->db->insert('orders_detail', $row);
            }

            $this->db->delete('cart', ['id_user' => $this->id]);

            $this->session->set_flashdata('success', 'Data successfully saved.');

            $data['title']        = 'Checkout Success';
            $data['content']    = (object) $data;
            $data['page']        = 'pages/checkout/success';

            $this->view($data);
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong.');
            return $this->index($input);
        }
    }
}

/* End of file Checkout.php */
