<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-Ibd04nKFjjMh8kNnmH-Nr-m0', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
		$this->load->model('front/order_model');	
    }

    public function index()
    {
    	$this->load->view('checkout_snap');
    }

    public function token()
    {
		$grossamount = $this->input->get('grossamount');
		$shipping_cost = $this->input->get('shipping_cost');
		$id = $this->input->get('id');
		$dataitem = $this->order_model->getproduct();
		// Required
		$transaction_details = array(
		  'order_id' => $id,
		  'gross_amount' => $grossamount,
		  'shipping_cost' => $shipping_cost, // no decimal allowed for creditcard
		);
		
		// $item_details = array();

		// foreach($dataitem as $item){
		// 	$item_details[] = array(
		// 		'id' => $item->id,
		// 		'price' => $item->base_price,
		// 		'quantity' => $item->qty,
		// 		'name' => $item->name
		// 	);
		// }
		// Optional
		// $item1_details = array(
		//   'id' => 'a1',
		//   'price' => 18000,
		//   'quantity' => 3,
		//   'name' => "Apple"
		// );

		// Optional
		// $item2_details = array(
		//   'id' => 'a2',
		//   'price' => 20000,
		//   'quantity' => 2,
		//   'name' => "Orange"
		// );

		// Optional
		// $item_details = array ($item1_details, $item2_details);

		// Optional
		$billing_address = array(
		  'first_name'    => $this->input->get('first_name'),
		  'last_name'     => $this->input->get('last_name'),
		  'address'       => $this->input->get('address'),
		  'city'          => $this->input->get('city'),
		  'postal_code'   => $this->input->get('postcode'),
		  'phone'         => $this->input->get('phone'),
		  'country_code'  => 'IDN'
		);

		// Optional
		$shipping_address = array(
		  'first_name'    => $this->input->get('first_name'),
		  'last_name'     => $this->input->get('last_name'),
		  'address'       => $this->input->get('address'),
		  'city'          => $this->input->get('city'),
		  'postal_code'   => $this->input->get('postcode'),
		  'phone'         => $this->input->get('phone'),
		  'country_code'  => 'IDN'
		);

		// Optional
		$customer_details = array(
		  'first_name'    => $this->input->get('first_name'),
		  'last_name'     => $this->input->get('last_name'),
		  'email'         => $this->input->get('email'),
		  'phone'         => $this->input->get('phone'),
		  'billing_address'  => $billing_address,
		  'shipping_address' => $shipping_address
		);

		// Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'minute', 
            'duration'  => 2
        );
        
        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            // 'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
    }

    public function finish()
    {
    	$result = json_decode($this->input->post('result_data'));
    	// echo 'RESULT <br><pre>';
    	// var_dump($result);
    	// echo '</pre>' ;
		
		if($result->payment_type == 'bank_transfer'){
			if($result->va_numbers){
				foreach($result->va_numbers as $row){
					$vendor_name = $row->bank;
					$va_number = $row->va_number;
					// if($va_number == ''){
					// 	$va_number == '';
					// }
					$biller_code = '';
				}
			}else{
				$vendor_name = 'permata';
				$va_number = $result->permata_va_number;
				$biller_code = '';
			}
		}elseif($result->payment_type == 'echannel'){
			$vendor_name = 'mandiri';
				$va_number = $result->bill_key;
				$biller_code = $result->biller_code;
		}else{
			$vendor_name = 'credit card';
			$va_number = '';
			$biller_code = '';
		}
		
		// $gross_amount = str_replace(search:'.00',replace:'',$result->gross_amount);
		$data_input = [
			'order_id' => $result->order_id,
			'gross_amount' => $result->gross_amount,
			'payment_type' => $result->payment_type,
			'vendor_name' => $vendor_name,
			'va_number' => $va_number, 
			'biller_code' => $biller_code,
			'status' => $result->transaction_status,
			'payment_time' => $result->transaction_time,
			// 'pdf_url' => $result->pdf_url


		];

		$this->db->insert('payments',$data_input);
		$data = array(
			'finish' => json_decode($this->input->post('result_data')),
			'cartItems' => $this->cart->contents(),
		);
		$this->template->content_frontend('front/snap/finish', $data);
	
    }
}
