<?php

// Include the temando.php class
require_once('temando.php');

// create an instance of class TemandoWebServices
$obj_tem = new TemandoWebServices;

// Enter details for Quotes
$Weight = 5000;
$length = 5;
$Width = 3;
$height = 4;
$quantity = 2;

// API username and Password
$username = 'TEMANDOTEST';
$password = 'temandopass1';
$endpoint = 'http://api-demo.temando.com/schema/2009_06/server.wsdl';

//create an array based on the XSD for input to the getQuotes function
$request = array ( 'anythings' => array ( 'anything' => array ( 0 => array ('class' => 'General Goods', 
                                                         'subclass' => 'Household Goods',
                                                         'packaging' => 'Box',
                                                         'qualifierFreightGeneralFragile' => 'N',
                                                         'weight' => $Weight,
                                                         'length' => $length,
                                                         'width' => $Width,
                                                         'height' => $height,
                                                         'distanceMeasurementType' => 'Centimetres',
                                                         'weightMeasurementType' => 'Grams',
                                                         'quantity' => $quantity, ), ), ),
               'anywhere' => array (  'itemNature' => 'Domestic',
                                 'itemMethod' => 'Door to Door',
                                 'originCountry' => 'AU',
                                 'originCode' => '4069',
                                 'originSuburb' => 'KENMORE', 
                                 'originIs' => 'Business', 
                                 'originBusDock' => 'N', 
                                 'originBusUnattended' => 'N', 
                                 'originBusForklift' => 'N', 
                                 'originBusLoadingFacilities' => 'N', 
                                 'originBusInside' => 'N', 
                                 'originBusNotifyBefore' => 'N',
                                 'originBusLimitedAccess' => 'N', 
                                 'originBusHeavyLift' => 'N', 
                                 'originBusContainerSwingLifter' => 'N', 
                                 'originBusTailgateLifter' => 'N', 
                                 'destinationCountry' => 'AU', 
                                 'destinationCode' => '4000', 
                                 'destinationSuburb' => 'BRISBANE', 
                                 'destinationIs' => 'Business', 
                                 'destinationBusDock' => 'N', 
                                 'destinationBusPostalBox' => 'N', 
                                 'destinationBusUnattended' => 'N', 
                                 'destinationBusForklift' => 'N', 
                                 'destinationBusLoadingFacilities' => 'N', 
                                 'destinationBusInside' => 'N', 
                                 'destinationBusNotifyBefore' => 'N', 
                                 'destinationBusLimitedAccess' => 'N', 
                                 'destinationBusHeavyLift' => 'N', 
                                 'destinationBusContainerSwingLifter' => 'N', 
                                 'destinationBusTailgateLifter' => 'N', ), 
                  'anytime' => array ('readyDate' => '2014-11-20', 
                                 'readyTime' => 'PM', ),
                  'clientId' => '20420',
                  'promotionCode' => 'A0001', 
                  'general' => array ( 'goodsValue' => 5,
                                  'goodsCurrency' => 'AUD', ), );

//make a Quote call with the request array,API username,password and Server endpoint
$response = $obj_tem->getQuotesByRequest($request,$username,$password,$endpoint);

//echo '<PRE>';
//print_r($response);
//echo sizeof($response);
//echo " Name of 1st carrier is " .$response['quote'][1]['carrier']['companyName'];


// for each entry in quote array , print out the total price,base price , tax,currency,company name
for ($i=0;$i<sizeof($response['quote']);$i++)
{
    echo "***************************************************"."\n";
    echo "Total Price " . $response['quote'][$i]['totalPrice']."\n";
    //creates an array with tot price , Carrier name and Carrier ID
    $tprice[] = array($response['quote'][$i]['totalPrice'],$response['quote'][$i]['carrier']['companyName'],$response['quote'][$i]['carrier']['id']);
    echo "Base Price " .$response['quote'][$i]['basePrice']."\n";
    echo "Tax " .$response['quote'][$i]['tax']."\n";
    echo "Currency ".$response['quote'][$i]['currency']."\n";
    echo "Company Name " .$response['quote'][$i]['carrier']['companyName'] . "\n";
    //$tcomp[] = $response['quote'][$i]['carrier']['companyName'];

}

echo "******************************************************"."\n";

print_r($tprice);

echo "The cheapest quote is " . cheapest($tprice);

function cheapest($tprice)
{

    return min($tprice);
}

?>
