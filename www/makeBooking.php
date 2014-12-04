<?php
/**
 * Created by PhpStorm.
 * User: rajdeep.hazarika
 * Date: 28/11/2014
 * Time: 5:08 PM
 */
// Make booking function
//$quoteFilter = array ('quoteFilter' => array ('preference' => 'Carriers Only',
//                                            'carriers' => array ('carrier' => array('carrierId' => $tpriceall[0][2]))));

$bRequest = array ( 'anythings' => array ( 'anything' => array ( 0 => array ('class' => 'General Goods',
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
    'anytime' => array ('readyDate' => '2014-11-28','readyTime' => 'PM', ),
    'origin' => array ('street' => 'test Origin Street','suburb' => 'KENMORE','code' => '4069','contactName' => 'Testperson' , 'companyName' => 'TestCompany' , 'country' => 'AU' , 'phone1' => '01010101' , 'email' => 'test@email.com'),
    'destination' => array ('street' => 'test destination street', 'suburb' => 'BRISBANE' , 'code' => '4000','contactName' => 'Testperson' , 'companyName' => 'TestCompany' , 'country' => 'AU' , 'phone1' => '01010101' , 'email' => 'test@email.com'),
    'payment' => array ('paymentType' => 'Account'),
    'clientId' => '20420',
    'promotionCode' => 'A0001',
    'general' => array ( 'goodsValue' => 5, 'goodsCurrency' => 'AUD', ),
    'quoteFilter' => array ('preference' => 'Carriers Only', 'carriers' => array ('carrier' => array('carrierId' => $tpriceall[0][2]))));

print_r($bRequest);
//print_r($quoteFilter);
//array_push($request,$quoteFilter);


$bresponse = $obj_tem->makeBookingByRequest($bRequest,$username,$password,$endpoint);

print_r($bresponse);

//print_r($request);