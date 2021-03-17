<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Order extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');
        if ($role != 'admin') {
            redirect(base_url('/'));
            return;
        }
    }

    public function index($page = null)
    {
        $data['title']      = 'Admin: Order';
        $data['content']    = $this->order->orderBy('date', 'DESC')->paginate($page)->get();
        $data['total_rows'] = $this->order->count();
        $data['pagination'] = $this->order->makePagination(
            base_url('order'),
            2,
            $data['total_rows']
        );
        $data['page']       = 'pages/order/index';

        $this->view($data);
    }


    public function search($page = null)
    {
        if (isset($_POST['keyword'])) {
            $this->session->set_userdata('keyword', $this->input->post('keyword'));
        } else {
            redirect(base_url('order'));
        }

        $keyword            = $this->session->userdata('keyword');
        $data['title']      = 'Admin | Order';
        $data['content']    = $this->order->like('invoice', $keyword)
            ->orderBy('date', 'DESC')
            ->paginate($page)->get();
        $data['total_rows'] = $this->order->like('invoice', $keyword)->count();
        $data['pagination'] = $this->order->makePagination(
            base_url('order/search'),
            3,
            $data['total_rows']
        );
        $data['page']       = 'pages/order/index';

        $this->view($data);
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword');
        redirect(base_url('order'));
    }


    public function detail($id)
    {
        $data['order']       = $this->order->where('id', $id)->first();
        if (!$data['order']) {
            $this->session->set_flashdata('warning', 'Data cannot be found.');
            redirect(base_url('order'));
        }

        $this->order->table   = 'orders_detail';
        $data['order_detail']   = $this->order->select([
            'orders_detail.id_orders', 'orders_detail.id_product', 'orders_detail.qty',
            'orders_detail.subtotal', 'product.title', 'product.image', 'product.price'
        ])
            ->join('product')->where('orders_detail.id_orders', $id)->get();

        if ($data['order']->status != 'waiting') {
            $this->order->table = 'orders_confirm';
            $data['order_confirm'] = $this->order->where('id_orders', $id)->first();
        }

        if ($data['order']->status == 'delivered') {
            
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

            // $id_orders = $data['order']->id;
            $id_user = $data['order']->id_user;
            $invoice = $data['order']->invoice;
            $name = $data['order']->name;

            $this->order->table = 'user';
            $data['user'] = $this->order->select([
                'user.id', 'user.name', 'user.email', ''
            ])->where('user.id', $id_user)->get();
            $emailUser = $data['user'][0]->email;
            

            $this->email->from('no-reply@omidhealthstyle.com');
            $this->email->to($emailUser);
            $this->email->subject('Pesanan kamu #' . $invoice . 'sedang dalam perjalanan');
            $this->email->message('
                    <div style="text-align: center; max-width: 450px; margin: 24px auto; border: solid 1px #dde2e5; border-radius: 10px; padding: 24px">
                        <div style="width: 100%;">
                            <div style="text-align: left;">
                                <a href="https://omidhealthstyle.com/" style="margin-bottom: 24px;">
                                    <img src="https://omidhealthstyle.com/assets/img/OmidLogo.png" alt="Logo Omid Health Style" height="68">
                                </a>
                                <div style="color: #212429 !important;">

                                    <h3 style="font-weight: light;">Hai <strong>'. $name .',</strong></h3>

                                    <h2 style="color: #06a954;">Pesanan kamu #' . $invoice .' sedang dalam perjalan.</h2>

                                    <a href="' . base_url("/myorder/detail/$invoice") .'" style="width: 100%; text-decoration: none; font-weight: bold; letter-spacing: 2px; color: #06a954;"><button style="border: solid 1px #06a954; color: #06a954; width: 100%; border-radius: 10px; margin-top: 32px; font-size: 1rem; padding: 16px;">Lihat Detail Pesanan</button></a>

                                    <a href="' . base_url("shopping") . '" style="width: 100%; text-decoration: none; font-weight: bold; letter-spacing: 2px; color: #fff;"><button style="background-color: #06a954; color: #fff; width: 100%; border: none; border-radius: 10px; margin-top: 32px; font-size: 1rem; padding: 16px;">Lihat Produk Sehat Lainnya</button></a>
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

        $data['page']           = 'pages/order/detail';

        $this->view($data);
    }


    public function update($id)
    {
        if (!$_POST) {
            $this->session->set_flashdata('error', 'Oops! something wnet wrong');
            redirect(base_url("order/detail/$id"));
        }

        if ($this->order->where('id', $id)->update(['status' => $this->input->post('status')])) {
            $this->session->set_flashdata('success', 'Data successfully updated');
        } else {
            $this->session->set_flashdata('error', 'Oops! something wnet wrong');
        }

        redirect(base_url("order/detail/$id"));
    }
}

/* End of file Order.php */
