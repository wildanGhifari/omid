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

        $this->checkout->table  = 'user';
        $data['user']   = $this->checkout->select([
            'user.id', 'address'
        ])->where('user.id', $this->id)->get();
        
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
            'weight'       => $this->input->post('total-berat'),
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

            // $this->db->delete('cart', ['id_user' => $this->id]);

            $this->session->set_flashdata('success', 'Data successfully saved.');

            $this->checkout->table = 'user';
            $data['user'] = $this->checkout->select([
                'user.id', 'user.email'
            ]) ->where('user.email', $this->id)->get();

            if (isset($_POST['submit_email'])) {
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
                    'weight'       => $this->input->post('total-berat'),
                    'package'       => $service . '-' . $ongkir,
                    'phone'         => $input->phone,
                    'status'        => 'waiting'
                ];

                if (!empty($data)) {
                    
                    // Konfigurasi to email proccess

                    $config = [
                        'mailtype' => 'html',
                        'charset' => 'iso-8859-1',
                        'protocol' => 'smtp',
                        'smtp_host' => 'ssl://smtp.googlemail.com',
                        'smtp_user' => 'omidhealth.kelapagading@gmail.com',
                        'smtp_pass' => 'Nutsarehealthy123',
                        'smtp_port' => 465,
                        'newline' => "\r\n"
                    ];

                    $this->load->library('email', $config);
                    $this->email->initialize($config);

                    $this->checkout->table = 'user';
                    $data['user'] = $this->checkout->select([
                        'user.id', 'user.name', 'user.email', ''
                    ]) ->where('user.id', $this->id)->get();
                    $emailUser = $data['user'][0]->email;


                    // ambil detail data pesanan
                    $nama       = $data['name'];
                    $provinsi   = $data['province'];
                    $distrik    = $data['district'];
                    $subdistrik = $data['subdistrict'];
                    $paket      = $data['package'];
                    $hp         = $data['phone'];
                    $invoice    = $data['invoice'];
                    $total      = $data['total'];
                    $tanggal    = $data['date'];
                    $kurir      = $data['courier'];
                    $alamat     = $data['address'];


                    $this->checkout->table  = 'orders';
                    $data['order']          = $this->checkout->select([
                        'orders.id', 'orders.id_user'
                    ])  ->where('orders.id_user', $this->id)->get();
                    $order = $data['order'][0]->id;


                    $this->checkout->table  = 'cart';
                    $data['cartUser']    = $this->checkout->select([
                        'cart.id', 'cart.qty', 'cart.subtotal',
                        'product.title', 'product.image', 'product.price', 'product.weight'
                    ]) ->join('product')->where('cart.id_user', $this->id)->get();
                    $cartUsers = $data['cartUser'];

                    $cartQT = '';

                    foreach ($cartUsers as $cartUser) {
                        $cartQT .= '<div style="display: flex; align-items: center; justify-content: space-between;">
                                        <p style="margin: 6px 0; flex: 50%; width: 50%;">' . $cartUser->qty . 'x ' . $cartUser->title . '</p>
                                        <p style="margin: 6px 0; flex: 50%; width: 50%; text-align: right; font-weight: bold;">Rp. ' . number_format($cartUser->subtotal, 0, ',', '.') . '</p>
                                    </div>';
                    }
                    
                    $this->email->from('no-reply@omidhealthstyle.com');
                    $this->email->to('pt.omidhealthstyle@gmail.com');
                    $this->email->subject('New Order!, Ada pesanan baru dari ' .$nama . ' ' . ' pada ' . $tanggal);
                    $this->email->message('
                    <div style="text-align: center; max-width: 450px; margin: 24px auto; border: solid 1px #dde2e5; border-radius: 10px; padding: 24px">
                        <div style="width: 100%;">
                            <div style="text-align: left;">
                                <a href="https://omidhealthstyle.com/" style="margin-bottom: 24px;">
                                    <img src="https://omidhealthstyle.com/assets/img/OmidLogo.png" alt="Logo Omid Health Style" height="68">
                                </a>
                                <div style="color: #212429 !important;">
                                    <h3 style="font-weight: light;">Hai <strong>Omid Health Style,</strong></h3>
                                    <h2 style="color: #06a954;">Ada pesanan baru sebesar Rp. ' . number_format($total, 0, ',', '.') . '</h2>
                                    <hr style="margin: 24px 0;">
                                    <p>No. Invoice: <strong><a style="color: #06a954;" href="' . base_url("/order/detail/$order") . '">' . $invoice . '</a></strong></p>
                                    <p>Tanggal Pemesanan: ' . $tanggal . '</p>
                                    <p>Kurir: ' . $kurir . '-' . $paket . '</p>
                                    <p>Tujuan Pengiriman: <br> <strong>' . $nama .' (' . $hp . ')</strong><br>' .$alamat . ' ' . $provinsi .' ' .$distrik . ' ' . $subdistrik .'</p>
                                </div>
                            </div>
                        </div>
                        <a href="' . base_url("/order/detail/$order") . '" style="width: 100%; text-decoration: none; font-weight: bold; letter-spacing: 2px; color: #fff;"><button style="background-color: #06a954; color: #fff; width: 100%; border: none; border-radius: 10px; margin-top: 32px; font-size: 1rem; padding: 16px;">Lihat Detail Pesanan</button></a>
                    </div>
                    ');

                    if ($this->email->send()) {
                        $this->session->set_flashdata('success', 'Data successfully saved.');
                    } else {
                        echo "Gagal";
                        show_error($this->email->print_debugger());
                    }

                    $this->email->from('no-reply@omidhealthstyle.com');
                    $this->email->to($emailUser);
                    $this->email->subject('Menunggu pembayaran untuk ' . $invoice .' ' . ' pada ' . $tanggal);
                    $this->email->message('
                    <div style="text-align: center; max-width: 450px; margin: 24px auto; border: solid 1px #dde2e5; border-radius: 10px; padding: 24px">
                        <div style="width: 100%;">
                            <div style="text-align: left;">
                                <a href="https://omidhealthstyle.com/" style="margin-bottom: 24px;">
                                    <img src="https://omidhealthstyle.com/assets/img/OmidLogo.png" alt="Logo Omid Health Style" height="68">
                                </a>
                                <div style="color: #212429 !important;">
                                    <h3 style="font-weight: light;">Halo <strong style="font-bold: light;">' . $nama . ',</strong></h3>
                                    <h2 style="color: #06a954;">Segera lakukan pembayaran untuk pesananmu dengan detail sebagai berikut: </h2>
                                    <hr style="margin: 24px 0;">
                                    <div style="background-color: #dde2e5; padding: 24px; border-radius: 8px;">
                                        <table style="width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 130px;">Total Bayar</td>
                                                    <td style="width: 20px;">:</td>
                                                    <td style="width: 300px;">Rp. '. number_format($total, 0, ',', '.') .'</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 130px;">No. Rekening</td>
                                                    <td style="width: 20px;">:</td>
                                                    <td style="width: 300px;">BCA <strong>2867770000</strong> a/n PT. Omid Health Style.</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 130px;">Atas Nama</td>
                                                    <td style="width: 20px;">:</td>
                                                    <td style="width: 300px;">PT. Omid Health Style.</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <p style="margin-top: 24px;">Jika sudah melakukan pembayaran segera lakukan konfirmasi dan kirim bukti transfer di halaman konfirmasi atau bisa klik tombol di bawah:</p>
                                    <a href="' . base_url("/myorder/confirm/$invoice") .'" style="width: 100%; text-decoration: none; font-weight: bold; letter-spacing: 2px; color: #fff;"><button style="background-color: #06a954; color: #fff; width: 100%; border: none; border-radius: 10px; margin-top: 32px; font-size: 1rem; padding: 16px;">Konfirmasi Pembayaran</button></a>
                                    <hr style="margin: 24px 0;">
                                    <h2>Rincian Pesanan</h2>
                                    ' . $cartQT . '
                                    <div style="display: flex; align-items: center; justify-content: space-between;">
                                        <p style="margin: 6px 0; flex: 50%; width: 50%;">Ongkos Kirim</p>
                                        <p style="margin: 6px 0; flex: 50%; width: 50%; text-align: right; font-weight: bold;">'. $kurir . '-' . $paket . '</p>
                                    </div>
                                    <div style="display: flex; align-items: center; justify-content: space-between; border-top: solid 1px #dde2e5;">
                                        <p style="margin: 6px 0; flex: 50%; width: 50%;">Total Belanja</p>
                                        <p style="margin: 6px 0; flex: 50%; width: 50%; text-align: right; font-weight: bold;">Rp. ' . number_format($total, 0, ',', '.') . '</p>
                                    </div>
                                    <hr style="margin: 24px 0;">
                                    <p>E-mail ini dibuat otomatis, mohon tidak membalas. Jika butuh bantuan, silakan hubungi <a href="https://api.whatsapp.com/send?phone=62895331759916&text=Hai%2C%20nama%20saya%20*isi%20nama%20Anda*.%0ASaya%20ingin%20bertanya%20mengenai%20produk%20*isi%20nama%20produk*%20yang%20saya%20lihat%20di%20website.">Omid Customer Service</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    ');
                    

                    if ($this->email->send()) {
                        $this->session->set_flashdata('success', 'Data successfully saved.');
                    } else {
                        echo "Gagal";
                        show_error($this->email->print_debugger());
                    }
                }
            }

            $this->db->delete('cart', ['id_user' => $this->id]);

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
