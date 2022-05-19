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
            'packed' => $this->order_model->packed(),
            'delivered' => $this->order_model->delivered(),
            'completed' => $this->order_model->completed(), 
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
    public function add_cod(){
        
        $data = array(
            'code' => $this->input->post('code'),
            'order_date' => date('Y-m-d'),
            'customer_firstname' => $this->input->post('first_name'),
            'customer_lastname' => $this->input->post('last_name'),
            'customer_postcode' => $this->input->post('postcode'),
            'customer_address' => $this->input->post('address'),
            'customer_phone' => $this->input->post('phone'),
            'customer_email' => $this->input->post('email'),
            'weight' => $this->input->post('weight'),
            'grand_total' =>$this->input->post('grand_total'),
            'total_price' => $this->input->post('grand_total'),
            'note' => $this->input->post('note'),
            'status' => 'created_cod',
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

        // $i = 1;
        // foreach($this->cart->contents() as $item){
        // $data_shipment = array(
        //     'order_id' => $order_id,
        //     'qty' => $this->input->post('qty'.$i++),
        //     'weight' => $item['weight'],
        //     'name' => $item['name'],
        //     'first_name' => $this->input->post('first_name'),
        //     'last_name' => $this->input->post('last_name'),
        //     'address' => $this->input->post('address'),
        //     'phone' => $this->input->post('phone'),
        //     'email' => $this->input->post('email'),
        //     'city' => $this->input->post('kota'),
        //     'province' => $this->input->post('provinsi'),
        //     'postcode' => $this->input->post('postcode'),
        //     'user_id' => decode_id($this->session->userdata('id')),

        //     );
        // $this->order_model->save_shipment($data_shipment);
        // }

        $this->session->set_flashdata('pesan','sukses');
        $this->cart->destroy();
        redirect('front/order/');
    }

    public function del($id){

        $this->order_model->del($id);
        if($this->db->affected_rows()>0){
			$this->session->set_flashdata('success','Data berhasil disimpan');
	
		}
		redirect('front/order');
            // echo $data;
            

    }
    public function pay_cod($id){
        // $id = $this->input->post('id');
        // $grossamount = $this->input->post('grossamount');
        $this->db->select('total_price');
        $this->db->from('orders');
        $this->db->where('user_id',decode_id($this->session->userdata('id')));
        $this->db->where('id',$id);
        $this->db->where('deleted_at', null);
        $grossamount = $this->db->get()->row()->total_price;
        $data = array(
            'order_id' => $id,
			'gross_amount' => $grossamount,
			'payment_type' => 'cod',
			// 'vendor_name' => $vendor_name,
			// 'va_number' => $va_number, 
			// 'biller_code' => $biller_code,
			'status' => 'settlement',
			'payment_time' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('payments',$data);
        $data_update = array(
            'status' => 'cod',
            'payment_status' => 'settlement'
        );
        $where = [
            'id' =>$id
        ];
        $this->db->update('orders',$data_update,$where);
        redirect('front/order');
    }

    public function detail($id){
        $this->db->select('*');
        $this->db->from('shipments');
        // $this->db->join('inventories', 'inventories.product_id = order_items.product_id', 'left');
        // $this->db->join('orders', 'orders.id = order_items.order_id', 'left');
        $this->db->where('order_id', $id);
        // $this->db->where('orders.id', $id);
        $shipment =  $this->db->get()->result();
        $data = array(
            'title' => 'My Order',
            'shipment' => $shipment,
            'cartItems' => $this->cart->contents(),
        );

        $this->template->content_frontend('front/order/detail/detail', $data);
    }
    public function detail_refund($id){
        $this->db->select('order_items.*,orders.*');
        $this->db->from('order_items');
        // $this->db->join('inventories', 'inventories.product_id = order_items.product_id', 'left');
        $this->db->join('orders', 'orders.id = order_items.order_id', 'left');
        $this->db->where('order_items.order_id', $id);
        // $this->db->where('orders.id', $id);
        $shipment =  $this->db->get()->result();
        $data = array(
            'title' => 'My Order',
            'shipment' => $shipment,
            'cartItems' => $this->cart->contents(),
        );

        $this->template->content_frontend('front/order/detail_refund/detail', $data);
    }
    public function refund_form($id){
        $this->db->select('*');
        $this->db->from('payments');
        // $this->db->join('inventories', 'inventories.product_id = order_items.product_id', 'left');
        // $this->db->join('orders', 'orders.id = payments.order_id', 'left');
        $this->db->where('order_id', $id);
        // $this->db->where('orders.id', $id);
        $shipment =  $this->db->get()->result();
        $data = array(
            'title' => 'My Order',
            'pay' => $shipment,
            'cartItems' => $this->cart->contents(),
        );

        $this->template->content_frontend('front/order/refund_form/form', $data);
    }
    public function add_refund(){
        $data = array(
            'no_rekening' => $this->input->post('no_rekening'),
            'amount_refund' =>$this->input->post('amount_refund'),
        );
        $where = [
            'id' =>$this->input->post('order_id')
        ];

        $this->order_model->update_refund($data, $where);
        redirect('front/order/');
    }
    public function complete($id){

        $this->order_model->complete($id);
        if($this->db->affected_rows()>0){
			$this->session->set_flashdata('success','Data berhasil disimpan');
	
		}
		redirect('front/order');
            // echo $data;
            

    }

    public function track($id){
        $this->db->select('shipments.*,orders.shipping_courier');
        $this->db->from('shipments');
        $this->db->join('orders','orders.id = shipments.order_id','left');
        $this->db->where('orders.id',$id);
        // $this->db->order_by('id','desc');
        $track_number =  $this->db->get()->row()->track_number;

            $this->db->select('shipments.*,orders.shipping_courier');
        $this->db->from('shipments');
        $this->db->join('orders','orders.id = shipments.order_id','left');
        $this->db->where('orders.id',$id);
        $shipping_courier =  $this->db->get()->row()->shipping_courier;
                    
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://api.binderbyte.com/v1/track?api_key=079f7ef284acdf18f6affe5ac4a68954348e4595d750fadbfe486ca504ceb202&courier='.$shipping_courier.'&awb='.$track_number.'',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);
            // echo $response;
            $array_response = json_decode($response,true);
        
        $data_track = $array_response['data'];
        $count_ray = count($array_response['data']['history']);
        $data = array(
			'hasil' => $data_track,
            'countnya' => $count_ray,
			'cartItems' => $this->cart->contents(),
		);
		$this->template->content_frontend('front/order/track/track', $data);
       

    }

}