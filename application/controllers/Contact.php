<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends MY_Controller
{

    public function index()
    {
        $data['title']  = 'Contact Us | Omid Health Style';

        if(isset($_POST['contact_form'])) {
            $data = [
                'fullname'      => $this->input->post('fullname'),
                'email'         => $this->input->post('email'),
                'message'       => $this->input->post('message')
            ];


            if(!empty($data)) {
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
    
                $nama   = $data['fullname'];
                $email  = $data['email'];
                $pesan  = $data['message'];
    
                $this->email->from('no-reply@omidhealthstyle.com');
                $this->email->to('pt.omidhealthstyle@gmail.com');
                $this->email->subject('New Message from '. $nama .' - omidhealthstyle.com contact form');
                $this->email->message('
                        <div style="text-align: center; max-width: 450px; margin: 24px auto; border: solid 1px #dde2e5; border-radius: 10px; padding: 24px">
                            <div style="width: 100%;">
                                <div style="text-align: left;">
                                    <a href="https://omidhealthstyle.com/" style="margin-bottom: 24px;">
                                        <img src="https://omidhealthstyle.com/assets/img/OmidLogo.png" height="68">
                                    </a>
                                    <div style="color: #212429 !important;">
                                        <h3 style="font-weight: light;">Hai <strong>Omid Health Style,</strong></h3>
                                        <h2 style="color: #06a954;">Ada pesan baru dari ' . $nama .'</h2>
                                        <hr style="margin: 24px 0;">
                                        <div style="background-color: #dde2e5; padding: 24px; border-radius: 8px;">
                                            <table style="width: 100%;">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 130px;">Email</td>
                                                        <td style="width: 20px;">:</td>
                                                        <td style="width: 300px;">'. $email .'</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 130px;">Message</td>
                                                        <td style="width: 20px;">:</td>
                                                        <td style="width: 300px;">'. $pesan . '</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <p style="margin: 32px 0">Pesan ini diterima melalui Contact Form website <a style="color: #06a954" href="https://omidhealthstyle.com/">omidhealthstyle.com</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                ');
    
                if ($this->email->send()) {
                    $this->session->set_flashdata('success', 'Your message has been sent.');
                } else {
                    echo "Gagal";
                    show_error($this->email->print_debugger());
                }
            }
        }
        
        $data['page']   = 'pages/contact/index';


        $this->view($data);
    }
}

/* End of file Contact.php */
