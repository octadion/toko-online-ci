<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends MY_Controller
{
    public function __construct()
	{
		parent::__construct();
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('unit_model');
        $this->load->model('foto_model');
        $this->load->library('cart');
	}
    public function index()
    {
        $data = array();
        
        // Retrieve cart data from the session
        $data['cartItems'] = $this->cart->contents();
        
        // Load the cart view
        $this->template->content_frontend('front/product_front/cart/index', $data);
    }
    function updateItemQty(){
        $update = 0;
        
        // Get cart item info
        $id = $this->input->get('id');
        $product = $this->db->query("SELECT * FROM inventories where product_id = '".$id."' ")->row()->qty;
        $rowid = $this->input->get('rowid');
        $qty = $this->input->get('qty');
        
        // Update item in the cart
        if($qty < $product){
            $data = array(
                'rowid' => $rowid,
                'qty'   => $qty
            );
            $update = $this->cart->update($data);
        }
        
        // Return response
        echo $update?'ok':'err';
    }
    function removeItem($rowid){
        // Remove item from cart
        $remove = $this->cart->remove($rowid);
        
        // Redirect to the cart page
        redirect('front/cart/');
    }
}