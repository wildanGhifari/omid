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
            'id_courier'    => '',
            'name'          => '',
            'address'       => '',
            'province'      => '',
            'district'      => '',
            'shipping'      => '',
            'phone'         => '',
            'status'        => ''
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'courier',
                'label' => 'Courier',
                'rules' => 'required'
            ],
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
                'field' => 'province',
                'label' => 'Province',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'district',
                'label' => 'District',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'shipping',
                'label' => 'Shipping',
                'rules' => 'required'
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
    }

    public function dataprovinsi()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: cee127c76f3c96e79af0061cd32a3b5a"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            // dapatnya dalam bentuk JSON
            // Convert ke array
            $array_response = json_decode($response, true);
            $dataProvinsi = $array_response["rajaongkir"]["results"];

            return $dataProvinsi;

            // echo "<option value=''>Pilih Provinsi</option>";

            // foreach ($dataProvinsi as $provinsi) {
            //     echo "<option value='" . $provinsi["province_id"] . "' id_provinsi='" . $provinsi["province_id"] . "'>";
            //     echo $provinsi["province"];
            //     echo "</option>";
            // }
        }
    }

    public function datadistrik()
    {
        $id_provinsi_terpilih = $_POST["id_provinsi"];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $id_provinsi_terpilih,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: cee127c76f3c96e79af0061cd32a3b5a"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            // dapatnya dalam bentuk JSON
            // Convert ke array
            $array_response = json_decode($response, true);
            $dataDistrik = $array_response["rajaongkir"]["results"];

            echo "<option value=''>Pilih Distrik</option>";

            foreach ($dataDistrik as $distrik) {
                echo "<option value='" . $distrik["city_id"] . "' 
        id_distrik='" . $distrik["city_id"] . "'
        nama_provinsi='" . $distrik["province"] . "'
        nama_distrik='" . $distrik["city_name"] . "'
        tipe_distrik='" . $distrik["type"] . "'
        kodepos='" . $distrik["postal_code"] . "'
        >";
                echo $distrik["city_name"];
                echo "</option>";
            }
        }
    }

    public function dataongkir()
    {
        $ekspedisi = $_POST["ekspedisi"];
        $distrik = $_POST["distrik"];
        $berat = $_POST["berat"];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=152&destination=" . $distrik . "&weight=" . $berat . "&courier=" . $ekspedisi,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: cee127c76f3c96e79af0061cd32a3b5a"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            // dapatnya dalam bentuk JSON
            // Convert ke array
            $array_response = json_decode($response, true);
            $dataOngkir = $array_response["rajaongkir"]["results"]["0"]["costs"];

            echo "<option value=''>Paket Pengiriman</option>";

            foreach ($dataOngkir as $ongkir) {
                echo "<option
        paket='" . $ongkir["service"] . "'
        ongkir='" . $ongkir["cost"]["0"]["value"] . "'
        etd='" . $ongkir["cost"]["0"]["etd"] . "'
        >";
                echo $ongkir["service"] . " ";
                echo "Rp. " . number_format($ongkir["cost"]["0"]["value"], 0, ',', '.') . " ";
                echo $ongkir["cost"]["0"]["etd"];
                echo "</option>";
            }
        }
    }
}

/* End of file Checkout_model.php */
