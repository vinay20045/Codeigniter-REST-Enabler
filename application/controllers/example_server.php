<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Example_server extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('rest_enabler');
        // Ensure only those users defined in application/config/api.ini are accessing your APIs
        // You can remove this section if your APIs are public. 
        if(!$this->rest_enabler->authenticate()){
            $this->rest_enabler->respond();
            exit();
        }

        // This is where the verb routing mojo happens.
        // To-do: Abstract this out to the library
        switch($this->rest_enabler->request_type()){
            case 'POST':
                $this->post();
            case 'GET':
                $this->get();
        }
        exit();
    }

    public function post(){
        //You can access the payload sent using...
        //$this->input->post() etc.
        $this->rest_enabler->respond(array(
                "status"=>"200",
                "response"=>"Your request is a post request"
        ));
    }

    public function get(){
        $this->rest_enabler->respond(array(
                "status"=>"200",
                "response"=>"Your request is a get request"
        ));
    }
}