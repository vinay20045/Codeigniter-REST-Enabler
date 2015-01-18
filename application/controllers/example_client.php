<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Example_client extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('rest_enabler');
    }

   	public function index(){
   		echo $this->rest_enabler->request(
   			'http://google.com/', //$url
   			'GET', //$method
   			array(), //$data
   			False //$authenticate
   		);
   	}
}