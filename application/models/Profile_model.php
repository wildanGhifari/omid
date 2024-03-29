<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile_model extends MY_Model
{

    public $table = 'user';
    protected $perPage  = 8;

    public function getDefaultValues()
    {
        return [
            'name'          => '',
            'email'         => '',
            'address'       => '',
            'social_media'  => '',
            'image'         => ''
        ];
    }


    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|callback_unique_email'
            ],
            [
                'field' => 'address',
                'label' => 'Address',
                'rules' => 'trim'
            ],
            [
                'field' => 'social_media',
                'label' => 'Social Media',
                'rules' => 'trim'
            ]
        ];

        return $validationRules;
    }


    public function uploadImage($fieldName, $fileName)
    {
        $config = [
            'upload_path'       => './images/user',
            'file_name'         => $fileName,
            'allowed_types'     => 'jpg|gif|png|jpeg|JPG|PNG',
            'max_size'          => 5242,
            'max_width'         => 0,
            'max_height'        => 0,
            'overwrite'         => true,
            'file_ext_tolower'  => true
        ];

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($fieldName)) {
            return $this->upload->data();
        } else {
            $this->session->set_flashdata('image_error', $this->upload->display_errors('', ''));
            return false;
        }
    }

    public function deleteImage($fileName)
    {
        if (file_exists("./image/user/$fileName")) {
            unlink("./image/user/$fileName");
        }
    }
}

/* End of file Profile_model.php */
