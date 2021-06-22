<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_front_model extends CI_Model
{
    public function filter_category($category){
        $this->db->distinct();
        $this->db->select($category);
        $this->db->from('product');
        $this->db->join('category', 'product.category_id = category.id', 'left');
        $this->db->where('product.deleted_at', null);
        $this->db->where('product.status_post', 'published');
        return $this->db->get();
    }

    public function get_keyword($keyword){
        // print_r($keyword);
        $this->db->select('product.*, category.category_name');
        $this->db->from('product');
        $this->db->join('category', 'product.category_id = category.id', 'left');
        $this->db->where('product.deleted_at', null);
        $this->db->where('product.status_post', 'published');
        $this->db->where("name LIKE '".$keyword."' OR barcode LIKE '".$keyword."$' OR price LIKE '".$keyword."$'");
        // $this->db->like('name',$keyword);
        // $this->db->or_like('barcode',$keyword);
        // $this->db->or_like('category_name',$keyword);
        // $this->db->or_like('price',$keyword);
        return $this->db->get()->result();
    }

    public function make_query($minimum_price, $maximum_price, $category){
        $query = "
        SELECT product.*, product.id as id_product, category.category_name
        FROM product
        LEFT JOIN category ON product.category_id = category.id
       
        WHERE product.status_post = 'published' and product.deleted_at is null
        ";
        if(isset($minimum_price, $maximum_price) && !empty($minimum_price)
        && !empty($maximum_price)){
            $query .= "
            AND price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
            ";
        }

        if(isset($category)){
            $category_filter = implode("','", $category);
            $query .= "
                AND category_name IN('".$category_filter."')
            ";
        }
        return $query;
    }
    public function count_all($minimum_price, $maximum_price, $category){
       $query = $this->make_query($minimum_price, $maximum_price, $category);
       $data = $this->db->query($query);
       return $data->num_rows(); 
    }

    public function fetch_data($limit, $start, $minimum_price, $maximum_price, $category){
        $query = $this->make_query($minimum_price, $maximum_price, $category);
        $query .= ' LIMIT '.$start.', ' . $limit;
        $data = $this->db->query($query);
        $output = '';
        if($data->num_rows() > 0){
            foreach($data->result_array() as $row){
                $output .= '
                <div class="col-lg-4 col-md-6 col-12">
                            <div class="single-product">
                            <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white product-img" data-dots="true" data-arrows="true">
                                    <a href="'.base_url('front/productfront/detail/'.$row['id'].'').'">
                                        <img src="'.base_url().'uploads'."/".$row['thumbnail'].'" class="img-fluid" style="height:250px; width:300px; margin:auto;"/>
                                        <input type="hidden" value="'.$row['id'].'">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h3><a href="'.base_url('front/productfront/detail/'.$row['id'].'').'">'.$row['name'].'</a></h3>
                                    <div class="product-price">
                                        <span>'.indo_currency($row['price']).'</span>
                                        
                                        <a href="'.base_url('front/productfront/cart/'.$row['id'].'').'" class="btn-sm btn-primary">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                ';
            }
        } else {
            $output = '<h3>No data found</h3>';
        }
        return $output;
    }
}
