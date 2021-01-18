<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends MY_Controller
{
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


    public function city()
    {
        $this->load->library('rajaongkir');
        $provinceId = $this->input->post('province_id');
        $cities     = json_decode($this->rajaongkir->city($provinceId));
        $select = "<select name='city' class='form-control' id='city' onChange='load_subdistrict()'>";
        foreach ($cities->rajaongkir->results as $city) {
            $select .="<option value='".$city->city_id.'-'.$city->city_name."'>".$city->city_name."</option>";
        }
        $select .= "</select>";
        echo $select;
    }

    public function subdistrict()
    {
        $this->load->library('rajaongkir');
        $cityId         = $this->input->post('city_id');
        $subdistricts   = json_decode($this->rajaongkir->subdistrict($cityId));
        $select = "<select name='subdistrict' class='form-control' id='subdistrict' onChange='count_cost()'>";
        foreach ($subdistricts->rajaongkir->results as $subdistrict) {
            $select .="<option value='".$subdistrict->subdistrict_id.'-'.$subdistrict->subdistrict_name."'>".$subdistrict->subdistrict_name."</option>";
        }
        $select .= "</select>";
        echo $select;
    }

    public function cost()
    {
        $this->load->library('rajaongkir');
        $origin         = "501";
        $subdistrict    = $this->input->post('subdistrict_id');
        $courier        = $this->input->post('courier');
        $weight         = $this->input->post('weight');
        $cost           = json_decode($this->rajaongkir->cost($origin, $subdistrict, $weight, $courier));
        $select         = "<select name='service' class='form-control' id='service' onChange='getTotal()'>";
        foreach ($cost->rajaongkir->results[0]->costs as $service) {
            $select .="<option value='".$service->cost[0]->value.'-'.$service->service."'>".$service->service.'-'.$service->cost[0]->value."</option>";
        }
        $select .= "</select>";
        echo $select;
    }

    public function total()
    {
        $ongkir = (int) $this->input->post('ongkir');
        $sql = "select sum(c.qty*p.price) as subtotal from cart as c
        left JOIN product as p on p.id=c.id_product where c.id_user=".$this->id;
        $cart = $this->db->query($sql)->result_array();
        $subtotal = $cart[0]['subtotal']??0;
        echo number_format($subtotal+$ongkir, 0, ',', '.');
    }
}

/* End of file Ajax.php */
