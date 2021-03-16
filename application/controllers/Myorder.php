<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Myorder extends My_Controller
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


    public function index()
    {
        $data['title']      = 'My Order List';
        $data['content']    = $this->myorder->where('id_user', $this->id)
            ->orderby('date', 'DESC')->get();

        $data['page']       = 'pages/myorder/index';

        $this->view($data);
    }


    public function detail($invoice)
    {
        $data['order'] = $this->myorder->where('invoice', $invoice)->first();
        if (!$data['order']) {
            $this->session->set_flashdata('warning', 'Data cannnot be found.');
            redirect(base_url('/myorder'));
        }

        $this->myorder->table   = 'orders_detail';
        $data['order_detail']   = $this->myorder->select([
            'orders_detail.id_orders', 'orders_detail.id_product', 'orders_detail.qty',
            'orders_detail.subtotal', 'product.title', 'product.image', 'product.price', 'product.weight'
        ])
            ->join('product')->where('orders_detail.id_orders', $data['order']->id)->get();

        if ($data['order']->status != 'waiting') {
            $this->myorder->table = 'orders_confirm';
            $data['order_confirm'] = $this->myorder->where('id_orders', $data['order']->id)->first();
        }

        $data['page']           = 'pages/myorder/detail';

        $this->view($data);
    }


    public function confirm($invoice)
    {
        $data['order']    = $this->myorder->where('invoice', $invoice)->first();
        if (!$data['order']) {
            $this->session->set_flashdata('warning', 'Data cannnot be found');
            redirect(base_url('/myorder'));
        }

        $this->myorder->table   = 'orders_detail';
        $data['order_detail']   = $this->myorder->select([
            'orders_detail.id_orders', 'orders_detail.id_product', 'orders_detail.qty',
            'orders_detail.subtotal', 'product.title', 'product.image', 'product.price', 'product.weight'
        ])
            ->join('product')->where('orders_detail.id_orders', $data['order']->id)->get();

        if ($data['order']->status !== 'waiting') {
            $this->session->set_flashdata('warning', 'Proof of transfer has been sent');
            redirect(base_url("myorder/detail/$invoice"));
        }

        if (!$_POST) {
            $data['input']    = (object) $this->myorder->getDefaultValues();
        } else {
            $data['input']    = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName    = url_title($invoice, '-', true) . '-' . date('YmdHis');
            $upload        = $this->myorder->uploadImage('image', $imageName);
            if ($upload) {
                $data['input']->image    = $upload['file_name'];
            } else {
                redirect(base_url("myorder/confirm/$invoice"));
            }
        }

        if (!$this->myorder->validate()) {
            $data['title']            = 'Konfirmasi Order';
            $data['form_action']    = base_url("myorder/confirm/$invoice");
            $data['page']            = 'pages/myorder/confirm';

            $this->view($data);
            return;
        }

        $this->myorder->table = 'orders_confirm';

        if ($this->myorder->create($data['input'])) {
            $this->myorder->table = 'orders';
            $this->myorder->where('id', $data['input']->id_orders)->update(['status' => 'paid']);

            if (isset($_POST)) {
                $data = [
                    'invoice'           => $this->input->post('invoice'),
                    'account_name'      => $this->input->post('account_name'),
                    'account_number'    => $this->input->post('account_number'),
                    'nominal'           => $this->input->post('nominal'),
                    'note'              => $this->input->post('note'),
                    'image'             => $this->input->post('image')
                ];


                if (!empty($data)) {
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

                    $acc_name  = $data['account_name'];
                    $acc_num  = $data['account_number'];
                    $nominal  = $data['nominal'];
                    $note  = $data['note'];

                    $this->myorder->table = 'orders';

                    if (!$_POST) {
                        $data['input']    = (object) $this->myorder->getDefaultValues();
                    } else {
                        $data['input']    = (object) $this->input->post(null, true);
                    }

                    $this->myorder->table = 'orders';
                    $data['order'] = $this->myorder->select([
                        'orders.id', 'orders.id_user', 'orders.invoice', 'orders.name'
                    ]) ->where('id', $data['input']->id_orders)->get();
                    $ords = $data['order'];
                    $ordr = '';

                    foreach ($ords as $ord) {
                        $ordr = $ord;
                    }

                    $this->myorder->table = 'user';
                    $data['user'] = $this->myorder->select([
                        'user.id', 'user.name', 'user.email', ''
                    ])->where('user.id', $this->id)->get();
                    $emailUser = $data['user'][0]->email;
                    $namaUser = $data['user'][0]->name;

                    $this->email->from('no-reply@omidhealthstyle.com');
                    $this->email->to('pt.omidhealthstyle@gmail.com');
                    $this->email->subject($ordr->name . ' telah melakukan pembayaran untuk pesanan #' . $ordr->invoice);
                    $this->email->message('
                    <div style="text-align: center; max-width: 450px; margin: 24px auto; border: solid 1px #dde2e5; border-radius: 10px; padding: 24px">
                        <div style="width: 100%;">
                            <div style="text-align: left;">
                                <a href="https://omidhealthstyle.com/" style="margin-bottom: 24px;">
                                    <img src="https://omidhealthstyle.com/assets/img/OmidLogo.png" height="68">
                                </a>
                                <div style="color: #212429 !important;">
                                    <h3 style="font-weight: light;">Hai <strong>Omid Health Style,</strong></h3>
                                    <h2 style="color: #06a954;">' . $ordr->name . 'telah melakukan pembayaran untuk pesanan #' . $ordr->invoice . '. Segera proses pesanannya.</h2>
                                    <hr style="margin: 24px 0;">
                                    <div style="background-color: #dde2e5; padding: 24px; border-radius: 8px;">
                                        <table style="width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 130px;">Atas Nama</td>
                                                    <td style="width: 20px;">:</td>
                                                    <td style="width: 300px;">' . $acc_name . '</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 130px;">No. Rekening</td>
                                                    <td style="width: 20px;">:</td>
                                                    <td style="width: 300px;">' . $acc_num . '</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 130px;">Nominal</td>
                                                    <td style="width: 20px;">:</td>
                                                    <td style="width: 300px;">' . $nominal . '</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 130px;">Catatan</td>
                                                    <td style="width: 20px;">:</td>
                                                    <td style="width: 300px;">' . $note . '</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="' . base_url("/order/detail/$ordr->id") . '" style="width: 100%; text-decoration: none; font-weight: bold; letter-spacing: 2px; color: #fff;"><button style="background-color: #06a954; color: #fff; width: 100%; border: none; border-radius: 10px; margin-top: 32px; font-size: 1rem; padding: 16px;">Lihat Detail Pesanan</button></a>
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
                    $this->email->subject('Terima kasih telah melakukan pembayaran untuk pesanan #' . $ordr->invoice);
                    $this->email->message('
                    <div style="text-align: center; max-width: 450px; margin: 24px auto; border: solid 1px #dde2e5; border-radius: 10px; padding: 24px">
                        <div style="width: 100%;">
                            <div style="text-align: left;">
                                <a href="https://omidhealthstyle.com/" style="margin-bottom: 24px;">
                                    <img src="https://omidhealthstyle.com/assets/img/OmidLogo.png" height="68">
                                </a>
                                <div style="color: #212429 !important;">
                                    <h3 style="font-weight: light;">Hai <strong>'. $namaUser .',</strong></h3>
                                    <h2 style="color: #06a954;">Terima kasih telah melakukan pembayaran untuk pesanan #' . $ordr->invoice . '. Berikut ini adalah detail pembayaran Anda.</h2>
                                    <hr style="margin: 24px 0;">
                                    <div style="background-color: #dde2e5; padding: 24px; border-radius: 8px;">
                                        <table style="width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 130px;">Atas Nama</td>
                                                    <td style="width: 20px;">:</td>
                                                    <td style="width: 300px;">' . $acc_name . '</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 130px;">No. Rekening</td>
                                                    <td style="width: 20px;">:</td>
                                                    <td style="width: 300px;">' . $acc_num . '</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 130px;">Nominal</td>
                                                    <td style="width: 20px;">:</td>
                                                    <td style="width: 300px;">' . $nominal . '</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 130px;">Catatan</td>
                                                    <td style="width: 20px;">:</td>
                                                    <td style="width: 300px;">' . $note . '</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="' . base_url("/myorder/detail/$ordr->invoice") . '" style="width: 100%; text-decoration: none; font-weight: bold; letter-spacing: 2px; color: #fff;"><button style="background-color: #06a954; color: #fff; width: 100%; border: none; border-radius: 10px; margin-top: 32px; font-size: 1rem; padding: 16px;">Lihat Detail Pesanan</button></a>
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

            $this->session->set_flashdata('success', 'Data successfully saved');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong');
        }

        redirect(base_url("myorder/detail/$invoice"));
    }


    public function cancel($id)
    {
        if (!$_POST) {
            $this->session->set_flashdata('error', 'Oops! something wnet wrong');
            redirect(base_url("myorder/detail/$id"));
        }

        if ($this->myorder->where('id', $id)->update(['status' => 'cancel'])) {
            $this->session->set_flashdata('success', 'Your order has been cancelled');
        } else {
            $this->session->set_flashdata('error', 'Oops! something wnet wrong');
        }

        redirect(base_url("myorder/index"));
    }


    public function image_required()
    {
        if (empty($_FILES) || $_FILES['image']['name'] === '') {
            $this->session->set_flashdata('image_error', 'Proof of transfer cannot be empty. Please enter proof of transfer.');
            return false;
        }
        return true;
    }

    public function pdf($invoice)
    {
        $this->load->library('dompdf_gen');

        $data['order']    = $this->myorder->where('invoice', $invoice)->first();
        if (!$data['order']) {
            $this->session->set_flashdata('warning', 'Data cannnot be found.');
            redirect(base_url('/myorder'));
        }
        $this->myorder->table = 'orders_confirm';
        $data['order_confirm'] = $this->myorder->where('id_orders', $data['order']->id)->first();

        $this->myorder->table   = 'orders_detail';
        $data['order_detail']   = $this->myorder->select([
            'orders_detail.id_orders', 'orders_detail.id_product', 'orders_detail.qty',
            'orders_detail.subtotal', 'product.title', 'product.image', 'product.price', 'product.weight'
        ])
            ->join('product')->where('orders_detail.id_orders', $data['order']->id)->get();

        $data['title']  = "Detail_invoice_" . $data['order']->invoice . ".pdf";

        $this->load->view('invoice_pdf', $data);

        $paper_size = 'A4';
        $orientation = 'potrait';

        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        ob_end_clean();
        $this->dompdf->stream("Detail_invoice_" . $data['order']->invoice . ".pdf", array('Attachment' => 0));
    }
}

/* End of file Myorder.php */
