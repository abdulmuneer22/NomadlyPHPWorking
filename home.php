<?php
header('Content-type: application/json');
require_once 'unirest-php/src/Unirest.php';
#Get Data From Nomadlist

function getCityListFromNomadList(){
$headers = array('Accept' => 'application/json');
$response = Unirest\Request::post('https://nomadlist.com/api/v2/filter/city?c=1&f1_target=temperatureC&f1_type=lt&f1_max=20&s=nomad_score&o=desc', $headers);
// return first 15 results
$nomadlist = array ();
for ($i=0;$i < 5 ;$i++){

    array_push($nomadlist,$response->body->slugs[$i]);
}

//print_r($nomadlist);
return $nomadlist;

}


function getSKYCODE($nomadlist){
    
    $headers = array('Accept' => 'application/json');
    $skycode = array();
    //Get SKY Code For ALL NomadList , Including Origin
    $arraySize =  sizeof($nomadlist);
    for($i = 0 ; $i < $arraySize ;$i++){
        
        // Get City Code
        $url = "http://partners.api.skyscanner.net/apiservices/autosuggest/v1.0/UK/GBP/en?query=".$nomadlist[$i]."&apikey=prtl6749387986743898559646983194";
        $response = Unirest\Request::get($url);
        //print_r($response->body->Places[0]->PlaceName);
        
        $Code = array(
            "nomadimageurl" => "https://nomadlist.com/assets/img/cities/".$nomadlist[$i]."-500px.jpg",
            "CityName" => $response->body->Places[0]->PlaceName,
            "CityCode" => $response->body->Places[0]->PlaceId,
            "CountryCode" => $response->body->Places[0]->CountryId);
        array_push($skycode,$Code);

         
    }

    //print_r($skycode);
    return $skycode;
}

function setPollingURL($skycode,$OriginCity){
//Set Polling URL and return it
header('Content-type: application/json');
$PollingURLSkyEndPoint = "http://partners.api.skyscanner.net/apiservices/pricing/v1.0";
$headers = array('Accept' => 'application/json');

$PollingURLWithCityCodes = array();

for($i=0 ; $i < sizeof($skycode) ; $i++){
    //print_r ($skycode[$i]["nomadimageurl"]);
    $data = array(
    'apiKey' => 'prtl6749387986743898559646983194',
    'country' => $skycode[$i]["CountryCode"],
    'currency' => 'USD',
    'locale' => 'en-US',
    'originplace' => $OriginCity,
    'destinationplace' => $skycode[$i]["CityCode"],
    'outbounddate' => '2016-11-15',
    'adults' => '1'
    );

    $body = Unirest\Request\Body::form($data);
    $response = Unirest\Request::post($PollingURLSkyEndPoint, $headers, $body);
    $polling = array(
                "DestinationName" => $skycode[$i]["CityName"],
                "nomadimageurl" => $skycode[$i]["nomadimageurl"],
                "DestinationCityCode"=>$skycode[$i]["CityCode"],
                "DestinationCountryCode"=>$skycode[$i]["CountryCode"],
                "OriginCityCode" => $OriginCity,
                "PollingURL"=>$response->headers["Location"],
                
                );
    //print_r($response->headers["Location"]);
    //print_r($data);
    array_push($PollingURLWithCityCodes,$polling);
    //print_r($polling);



}

//print_r($PollingURLWithCityCodes);
return $PollingURLWithCityCodes;
}

function CalculatePrice($Budget,$PollingURLWithCityCodes){
    
    $apikey = "?apiKey=prtl6749387986743898559646983194";
    $pollurl = "http://partners.api.skyscanner.net/apiservices/pricing/sg1/v1.0/bac9941a62dd48ac9b7d2d8a52998bbc_ecilpojl_EC1A4DBFD317BAC81DA0762C925A9B0A";
    $pollurl = $pollurl.$apikey;
    //print_r($Budget);
    $totalpushed = 0;
    $calculatedprice = array();
    for ($i=0;$i<sizeof($PollingURLWithCityCodes);$i++){
        $pollurl = $PollingURLWithCityCodes[$i]["PollingURL"]; 
        $pollurl = $pollurl.$apikey;
        //print_r($pollurl);
        //print_r($PollingURLWithCityCodes[$i]["nomadimageurl"]);


        $response = Unirest\Request::get($pollurl);
        //print_r($response->body->Itineraries[0]->PricingOptions[0]->Price);
        $price = $response->body->Itineraries[0]->PricingOptions[0]->Price;
        $cityname = $PollingURLWithCityCodes[$i]["DestinationName"];
        
        $response = array('CityName' => $cityname , "Price" => $price ,"nomadimageurl" => $PollingURLWithCityCodes[$i]["nomadimageurl"] );

        if($price < $Budget){
            array_push($calculatedprice,$response);
        }

        
        
        

        //

    }

    //print_r($calculatedprice);
    return $calculatedprice;

    //$response = Unirest\Request::get($pollurl);
    //print_r($response->body->Itineraries[0]->PricingOptions[0]->Price);


}


function formatOutput($pricecalculated){
//print_r($pricecalculated);
header('Content-type: application/json');

//Final Output given here
$output = array("text"=>"Sample message");

//echo json_encode($output);

 
}

function init(){

$nomadlist = getCityListFromNomadList();

$skycode = getSKYCODE($nomadlist);

$PollingURLWithCityCodes = setPollingURL($skycode,"Lond-sky");

$pricecalculated = CalculatePrice("900",$PollingURLWithCityCodes);

formatOutput($pricecalculated);

//echo json_encode($PollingURLWithCityCodes);
}



function test(){
    header('Content-type: application/json');
    
    $output = array("messages" => array(
        "text" => "Hello"
        
    ));

    echo json_encode($output);
}










//init();
test();

?>
