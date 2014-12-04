<?php
//var_dump($_POST);
//die();
require_once('temando.php');
require_once('getQuotes.php');

$obj_tem = new TemandoWebServices;
//$obj_tem = new getQuotesClass;

/*$Weight = $_POST['weight'];
$length = $_POST['length'];
$Width = $_POST['width'];
$height = $_POST['height'];
$quantity = 2;
$readyDate =$_POST['readyDate'];*/
$quantity = 2;

$username = 'TEMANDOTEST';
$password = 'temandopass1';
$endpoint = 'http://api-demo.temando.com/schema/2009_06/server.wsdl';

$request = array ( 'anythings' => array ( 'anything' => array ( 0 => array ('class' => 'General Goods',
    'subclass' => 'Household Goods',
    'packaging' => 'Box',
    'qualifierFreightGeneralFragile' => 'N',
    'weight' => 1000,
    'length' => 10,
    'width' => 10,
    'height' => 10,
    'distanceMeasurementType' => 'Centimetres',
    'weightMeasurementType' => 'Grams',
    'quantity' => $quantity, ), ), ),
    'anywhere' => array ( 	'itemNature' => 'Domestic',
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
    'anytime' => array ('readyDate' => '2014-12-05',
        'readyTime' => 'PM', ),
    'clientId' => '20420',
    'promotionCode' => 'A0001',
    'general' => array ( 'goodsValue' => 5,
        'goodsCurrency' => 'AUD', ), );

//$response = $obj_tem->getQuotes($request,$username,$password,$endpoint);

$response = $obj_tem->getQuotesByRequest($request,$username,$password,$endpoint);

if(!is_array($response) && !empty($response))
{
    echo "No Response Array found\n";
    print_r($response); // Error Response array
    die();
}

//echo sizeof($response);
//echo " Name of 1st carrier is " .$response['quote'][1]['carrier']['companyName'];
//echo "The carrier's listed for the quote are  " .$quote['']

//echo count($response['quote']);


for ($i=0;$i<sizeof($response['quote']);$i++)
{
    //echo "Total Price " . $response['quote'][$i]['totalPrice']."\n";
    //Store only the totalPrice from all the carriers
    $tprice[] = array($response['quote'][$i]['totalPrice']);
    //Store extra details with the totalPrice
    $tpriceall[]= array($response['quote'][$i]['totalPrice'],$response['quote'][$i]['carrier']['companyName'],$response['quote'][$i]['carrier']['id']);
    //echo "Base Price " .$response['quote'][$i]['basePrice']."\n";
    //echo "Tax " .$response['quote'][$i]['tax']."\n";
    //echo "Currency ".$response['quote'][$i]['currency']."\n";
    //echo "Company Name " .$response['quote'][$i]['carrier']['companyName'] . "\n";
    //echo "***************************************************"."\n";
}

//Print ONLY the TotalPrice from all carriers
//print_r($tprice);
//Store ONLY the most cheapest price amongst the carriers
$min = min($tprice);

//print_r($tpriceall);
//Print the cheapest price amongst the carriers
//print_r($min);

//$result = array_intersect($tpriceall,$min);

//Sorts the array in ascending order , i.e the cheapest - expensive
array_multisort($tpriceall);

//echo "The order of quotes from Cheapest to Expensive are as below "."\n";
var_dump($tpriceall);

//***************************************************************************




?>
