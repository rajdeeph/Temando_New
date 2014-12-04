<?php
/**
 * Created by PhpStorm.
 * User: rajdeep.hazarika
 * Date: 1/12/2014
 * Time: 11:38 AM
 */


class getQuotesClass {

    public $clients;

    function getQuotes($requestParameter,$uname,$password,$wsdl)
    {
        //Create a SOAP client from a WSDL .

            $clients = new SoapClient("$wsdl",array('trace' => 1));

            // Prepare SOAP Header authentication
            $auth = array(
                'Username' => $uname,
                'Password' => $password
            );

            $headers = new SoapHeader('http://schemas.xmlsoap.org/ws/2003/06/secext','Security',$auth,false);
           // call the SOAP header function
            $clients->__setSoapHeaders($headers);


        try{

            $response = $clients->__soapCall('getQuotes',array($requestParameter));
            echo $clients->__getLastRequest();
            echo "testing\n";
            if( !isset($response) && empty($response) ){
                throw new exception("Unable to Connect to the Temando Services. For Further Details Contact Admin");
            } else {
                return obj2array($response);
            }

        } catch( exception $e){
            echo $clients->__getLastRequest();
            $error_msg = $e->getmessage();
            return obj2array($error_msg);
        }

        }

    function obj2array($obj) {
        $out = array();
        if(!is_object($obj) && !is_array($obj)){ return $obj; }
        foreach ($obj as $key => $val) {
            switch(true) {
                case is_object($val):
                    $out[$key] = obj2array($val);
                    break;
                case is_array($val):
                    $out[$key] = obj2array($val);
                    break;
                default:
                    $out[$key] = $val;

            }


            if (is_object($val)) {
                $out[$key] = obj2array($val);
            } else if (is_array($val)) {
                $out[$key] = obj2array($val);
            } else {
                $out[$key] = $val;
            }

        }
        return $out;
    }
}