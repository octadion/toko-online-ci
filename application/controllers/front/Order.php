<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends MY_Controller
{
    public function __construct()
	{
		parent::__construct();
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('unit_model');
        $this->load->model('front/order_model');
        $this->load->library('cart');
	}
    public function index()
    {
        $data = array(
            'title' => 'My Order',
            'unpaid' => $this->order_model->paid(),
            'cartItems' => $this->cart->contents(),
        );

        $this->template->content_frontend('front/order/index', $data);
    }
    public function pay($id){
        $data = array(
            'title' => 'My Order',
            'unpaid' => $this->order_model->unpaid($id),
            'item' => $this->order_model->getproduct($id),
            'cartItems' => $this->cart->contents(),
        );

        $this->template->content_frontend('front/order/pay', $data);
    }

    public function add(){
        
        $data = array(
            'code' => $this->input->post('code'),
            'order_date' => date('Y-m-d'),
            'customer_firstname' => $this->input->post('first_name'),
            'customer_lastname' => $this->input->post('last_name'),
            'customer_postcode' => $this->input->post('postcode'),
            'customer_address' => $this->input->post('address'),
            'customer_phone' => $this->input->post('phone'),
            'customer_email' => $this->input->post('email'),
            'customer_province' => $this->input->post('provinsi'),
            'customer_city' => $this->input->post('kota'),
            'shipping_courier' => $this->input->post('ekspedisi'),
            'shipping_service' => $this->input->post('paket'),
            'shipping_cost' => $this->input->post('shipping_cost'),
            'shipping_etd' => $this->input->post('shipping_etd'),
            'weight' => $this->input->post('weight'),
            'grand_total' =>$this->input->post('grand_total'),
            'total_price' => $this->input->post('total_price'),
            'note' => $this->input->post('note'),
            'status' => 'created',
            'user_id' => decode_id($this->session->userdata('id')),
            'payment_status' => 'pending',
        );

        $this->order_model->save_order($data);

        $i = 1;
        $order_id = $this->db->insert_id(); 
        foreach($this->cart->contents() as $item){
            $data_items = array(
                'order_id' => $order_id,
                'code' => $this->input->post('code'),
                'product_id' => $item['id'],
                'qty' => $this->input->post('qty'.$i++),
                'base_price' => $item['price'],
                'base_total' => $item['subtotal'],
                'sub_total' => $this->cart->total(),
                'barcode' => $item['barcode'],
                'name' => $item['name'],
                'weight' => $item['weight'],
               
 

            );
            $this->order_model->save_order_items($data_items);
        }

        $i = 1;
        // $order_id = $this->db->insert_id(); 
        foreach($this->cart->contents() as $item){
        $data_shipment = array(
            'order_id' => $order_id,
            'qty' => $this->input->post('qty'.$i++),
            'weight' => $item['weight'],
            'name' => $item['name'],
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'address' => $this->input->post('address'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
            'city' => $this->input->post('kota'),
            'province' => $this->input->post('provinsi'),
            'postcode' => $this->input->post('postcode'),
            'user_id' => decode_id($this->session->userdata('id')),

            );
        $this->order_model->save_shipment($data_shipment);
        }

        $this->session->set_flashdata('pesan','sukses');
        $this->cart->destroy();
        redirect('front/order/');
    }
}