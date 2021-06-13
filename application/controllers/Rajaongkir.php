<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Rajaongkir extends CI_Controller
{
    private $api_key = '5c6678853edcf7df965d2d077cbe3835';
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('setting_model');
       
    }

    public function province(){

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
            "key: $this->api_key"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        // echo $response;
        $array_response = json_decode($response, true);
        // echo '<pre>';
        // print_r($array_response['rajaongkir']['results']);
        // echo '</pre>';
        $data_province = $array_response['rajaongkir']['results'];
        echo "<option value=''>-- Pilih provinsi --</option>";
        foreach( $data_province as $key => $value){
                echo "<option value='".$value['province']."'id_provinsi='".$value['province_id']."'>
                ".$value['province']."</option>";
            }
        }
    }
    public function city(){
        $curl = curl_init();
        $id_provinsi_terpilih = $this->input->post('id_provinsi');
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$id_provinsi_terpilih,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: $this->api_key"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
            $array_response = json_decode($response, true);
            $data_city = $array_response['rajaongkir']['results'];
            echo "<option value=''>-- Pilih kota --</option>";
            foreach( $data_city as $key => $value){
                    echo "<option value='".$value['city_name']."' id_kota='".$value['city_id']."'>
                    ".$value['city_name']."</option>";
                }
        }
    }

    public function ekspedisi(){
        echo '<option value="">--Pilih ekspedisi--</option>';
        echo '<option value="jne">JNE</option>';
        echo '<option value="tiki">TIKI</option>';
        echo '<option value="pos">POS Indonesia</option>';
    }
    public function paket(){

        $kota_asal = $this->setting_model->data_setting()->location;
        $ekspedisi = $this->input->post('ekspedisi');
        $id_kota = $this->input->post('id_kota');
        $berat = $this->input->post('berat');
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
        CURLOPT_POSTFIELDS => "origin=".$kota_asal."&destination=".$id_kota."&weight=".$berat."&courier=".$ekspedisi,
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: $this->api_key"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
            $array_response = json_decode($response, true);
            // echo '<pre>';
            $data_paket = $array_response['rajaongkir']['results'][0]['costs'];
            // echo '</pre>';
            echo "<option value=''>--Pilih paket--</option>";
            foreach( $data_paket as $key => $value){
                    echo "<option value='".$value['service']."' ongkir='".$value['cost'][0]['value']."' shipping_etd='".$value['cost'][0]['etd']." Hari'>".$value['service']." | Rp. ".
                    $value['cost'][0]['value']." | Estimasi ".$value['cost'][0]['etd']. " Hari".
                    "</option>";
                }
        }
    }
}