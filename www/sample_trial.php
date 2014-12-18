<?php
//var_dump($_POST);
//die();
require_once('temando.php');
require_once('getQuotes.php');

//Create an instance from TemandoWebservices Class
$obj_tem = new TemandoWebServices;
//$obj_tem = new getQuotesClass;

/*$Weight = $_POST['weight'];
$length = $_POST['length'];
$Width = $_POST['width'];
$height = $_POST['height'];
$quantity = 2;
$readyDate =$_POST['readyDate'];*/
$quantity = 2;

//User credentials for API usage
$username = 'TEMANDOTEST';
$password = 'temandopass1';

//Temando Endpoint
$endpoint = 'http://api-demo.temando.com/schema/2009_06/server.wsdl';

//Create request array for Quotes
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
    'anytime' => array ('readyDate' => '2014-12-15',
        'readyTime' => 'PM', ),
    'clientId' => '20420',
    'promotionCode' => 'A0001',
    'general' => array ( 'goodsValue' => 5,
        'goodsCurrency' => 'AUD', ), );

//$response = $obj_tem->getQuotes($request,$username,$password,$endpoint);

//Call API for getQuotesByRequest function , capture Response (array ) from Quotes call
$response = $obj_tem->getQuotesByRequest($request,$username,$password,$endpoint);

//Check if the array is empty , throw an error
if(!is_array($response) && !empty($response))
{
    echo "No Response Array found "."\n";
    echo "Error Code " ."\n";
    print_r($response); // Error Response array
    die();
}


for ($i=0;$i<sizeof($response['quote']);$i++)
{
    //echo "Total Price " . $response['quote'][$i]['totalPrice']."\n";
    //Store only the totalPrice from all the carriers
    //$tprice[] = array($response['quote'][$i]['totalPrice']);
    //Store extra details with the totalPrice
    $carrierRatesAll[]= array($response['quote'][$i]['totalPrice'],$response['quote'][$i]['carrier']['companyName'],$response['quote'][$i]['carrier']['id']);
    //echo "Base Price " .$response['quote'][$i]['basePrice']."\n";
    //echo "Tax " .$response['quote'][$i]['tax']."\n";
    //echo "Currency ".$response['quote'][$i]['currency']."\n";
    //echo "Company Name " .$response['quote'][$i]['carrier']['companyName'] . "\n";
    //echo "***************************************************"."\n";
}


$min = min($tprice);

//Sorts the array in ascending order , i.e the cheapest - expensive
array_multisort($carrierRatesAll);

//echo "The order of quotes from Cheapest to Expensive are as below "."\n";
//var_dump($tpriceall);
?>

<!DOCTYPE html>
<html lang="en">
<html>
    <head>
        <title>QUOTES FOR CARRIERS</title>
        <link rel="stylesheet" href="bootstrap.css" media="screen">
        <link rel="stylesheet" href="bootswatch.min.css">
        <script type="text/javascript" async="" src="http://www.google-analytics.com/ga.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
             <h1>    QUOTES FOR ALL CARRIERS    </h1>
                <div class="list-group">
                 <div class="jumbotron">
                     <form id="selectBookingForm" name="bookForm" action="/" method="post">
                 <?php
                        for ($i=0;$i<sizeof($carrierRatesAll);$i++)
                        {
                             $carrierRates = $carrierRatesAll[$i];
                            echo '<div  class="list-group-item">';
                            echo "CARRIER  :  " . $carrierRates[1] ."<br>" ;
                            echo "RATE     :  " . $carrierRates[0] ."<br>"."<br/>";
                            //echo '<input type="button" name="submit_it" class="btn btn-primary" id="selectBookingForm" value="Book Now">';
                            echo '<button id="courier-item" class="btn btn-primary" type="button" form="bookForm" value="Submit">Book  <span class="badge">$' . $carrierRates[0] . '</span></button> ';
                            echo '</div>';
                
                         }
                 ?>
                     </form>
                </div>
                </div>
            </div>
         </div>
    </div>

    <script type="text/javascript">

        var courierSelected = $("#banner-courier");
        $("#courier-item").on("click", function (event) {
            courierSelected.show();
        });

    </script>
    </body>
</html>