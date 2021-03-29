<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register_model extends MY_Model
{

    protected $table = 'user';

    public function getDefaultValues()
    {
        return [
            'name'      => '',
            'email'     => '',
            'token'     => '',
            'password'  => '',
            'role'      => '',
            'image'     => '',
            'is_active' => 0
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|required',
            ],
            [
                'field'     => 'email',
                'label'     => 'Email',
                'rules'     => 'trim|required|is_unique[user.email]',
                'errors'    => [
                    'is_unique' => 'This %s already exists.'
                ]
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[8]', //|min_length[8]
            ],
            [
                'field' => 'password_confirmation',
                'label' => 'Confirm Password',
                'rules' => 'required|matches[password]',
            ],
        ];

        return $validationRules;
    }

    public function run($input)
    {
        $this->load->helper('string');
        $token = random_string('alnum', 20);
        $data           = [
            'name'      => $input->name,
            'email'     => strtolower($input->email),
            'token'     => $token,
            'password'  => hashEncrypt($input->password),
            'role'      => 'member'
        ];

        $user          = $this->create($data);

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

        $id   = $user;
        $email  = $data['email'];
        $nama   = $data['name'];
        $userToken = $data['token'];

        $this->email->from('no-reply@omidhealthstyle.com');
        $this->email->to($email);
        $this->email->subject('Sign up Verification - Omid Health Style');
        $this->email->message('
                        <div style="text-align: center; max-width: 450px; margin: 24px auto; border: solid 1px #dde2e5; border-radius: 10px; padding: 24px">
                            <div style="width: 100%;">
                                <div style="text-align: left;">
                                    <a href="https://omidhealthstyle.com/" style="margin-bottom: 24px;">
                                        <img src="https://omidhealthstyle.com/assets/img/OmidLogo.png" height="68">
                                    </a>
                                    <div style="color: #212429 !important;">
                                        <h3 style="font-weight: light; margin-top: 24px;">Hai <strong>' . $nama .',</strong></h3>
                                        <h2 style="color: #06a954;">Thank you for signing up and become a member in our website.</h2>
                                        <hr style="margin: 24px 0;">
                                        <p style="margin: 32px 0">Click the button below to Activate your account.</p>

                                        <a href="' . base_url("/register/activate/$id/$userToken") . '" style="width: 100%; text-decoration: none; font-weight: bold; letter-spacing: 2px; color: #fff;"><button style="background-color: #06a954; color: #fff; width: 100%; border: none; border-radius: 10px; font-size: 1rem; padding: 16px;">Activate my account</button></a>
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

        $sess_data      = [
            'id'        => $user,
            'name'      => $data['name'],
            'email'     => $data['email'],
            'role'      => $data['role'],
            'image'     => $data['image'],
            'is_login'  => false
        ];

        $this->session->set_userdata($sess_data);
        return true;
    }
}

/* End of file Register_model.php */
