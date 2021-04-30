<?php
class Template{
    protected $_ci;
    
    function __construct(){
        //$this->_ci = &get_instance();
        $this->_ci = get_instance();
    }
    function content_frontend($content, $data = NULL){
        //$data['_menu']         = $this->_ci->load->view('fronend/_layouts/menu-frontend', $data, TRUE);
        $include['_header']    = $this->_ci->load->view('front/_layouts/header', $data, TRUE);
        $include['_content']   = $this->_ci->load->view($content, $data, TRUE);
        $include['_footer']    = $this->_ci->load->view('front/_layouts/footer', $data, TRUE);
        
        $this->_ci->load->view('front/_layouts/index', $include); 
    } 
}