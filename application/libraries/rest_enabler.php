<?php

class Rest_enabler{

    public $api_config = array();

    function __construct(){
        $this->api_config = parse_ini_file('application/config/api.ini', true);
    }

    /* This function is used to authenticate incoming api requests.
     * You need to worry about this function if your application is acting as a REST server.
     * This expects you to maintain allowed users list in application/config/api.ini
    */ 
    public function authenticate(){
        $user = $_SERVER['PHP_AUTH_USER'];
        $pass = $_SERVER['PHP_AUTH_PW'];

        if(!empty($user) && $this->api_config['allowed_users'][$user] === $pass){
            return True;
        }
        return False;
    }

    public function request_type(){
        return $_SERVER['REQUEST_METHOD'];
    }

    /* This function is used to make requests to APIs exposed elsewhere.
     * You need to worry about this function if your application is acting as a REST client.
    */
    public function request($url, $method = 'GET', $data = array(), $authenticate = True){
        $curl = curl_init();

        switch ($method)
        {
            // My application needed only these. Please feel free to add PUT/DELETE etc.
            // You can use CURLOPT_CUSTOMREQUEST if your server supports it.
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if($data){
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
            case "GET":
                curl_setopt($curl, CURLOPT_HTTPGET, 1);
                if($data){
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                }
                break;
        }

        if($authenticate){
            $auth_string = $this->api_config['my_identity']['user'].':'.$this->api_config['my_identity']['password'];
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_USERPWD, $auth_string);
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

    /*
     * This is the function you should use to respond to incoming requests.
     * You need to worry about this function if your application is acting as a REST server.
    */
    public function respond($response = array('Nothing to show'), $status = 200, $format = 'json'){
        // My application needed only JSON support. You can use $format and extend support for XML etc.
        header('Content-Type: application/json');
        $message_body = array(
            "status" => $status,
            "response" => $response
        );
        echo json_encode($message_body);
        // I'm specifically using this as I do not want control transferred back to application.
        exit(0);
    }
} 