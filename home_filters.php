<?php
header('Content-type: application/json');
require_once 'unirest-php/src/Unirest.php';
#Get Data From Nomadlist
//http://104.131.188.15/api/home_nofilter.php?OriginCity={{Origin}}&Climate={{cityClimate}}&Budget={{maxBudget}}
function getUrlParams(){
    //filter nomadlist ; given to getCityListFromNomadList
    
    $OriginCity = $_GET['OriginCity'];
    $Climate = $_GET['Climate'];
    $Budget = $_GET['Budget'];

    $Internet = $_GET['Internet'];
    $Safety = $_GET['Safety'];
    $Nightlife = $_GET['Nightlife'];
    $Region = $_GET['Region'];
    $Surfing = $_GET['Surfing'];
    //$CityType = $_GET['CityType'];
    $Peaceful = $_GET['Peaceful'];
    $Wifi = $_GET['Wifi'];
    

    

    $url = null;
    //return $OriginCity.$Climate.$Budget;
    
    $filtercount = 0;
    $baseurl = "https://nomadlist.com/api/v2/filter/city?c=";
    $tail = "&s=nomad_score&o=desc";

    //echo $Climate;
    switch($Climate){
    case 'COLD':
    $filtercount = $filtercount + 1;
    //echo $filtercount;
    $temperateFilter = "&f".$filtercount."_target=temperatureC&f".$filtercount."_type=lt&f".$filtercount."_max=20";
    //echo($baseurl.$filtercount.$temperateFilter);
    $url = $baseurl.$filtercount.$temperateFilter;
    break;

    case 'HOT':
    $filtercount = $filtercount + 1;
    //echo $filtercount;    
    $temperateFilter = "&f".$filtercount."_target=temperatureC&f".$filtercount."_type=gt&f".$filtercount."_min=30";
    //echo($baseurl.$filtercount.$temperateFilter.$tail);
    $url = $baseurl.$filtercount.$temperateFilter.$tail;
    break;

    case 'MILD':
    $filtercount = $filtercount + 1;
    //echo $filtercount;    
    $temperateFilter = "&f".$filtercount."_target=temperatureC&f".$filtercount."_type=bt&f".$filtercount."_min=16&f".$filtercount."_max=25";
    //echo($baseurl.$filtercount.$temperateFilter.$tail);
    $url = $baseurl.$filtercount.$temperateFilter.$tail;
    break;

    case 'WARM':
    $filtercount = $filtercount + 1;
    //echo $filtercount;    
    $temperateFilter = "&f".$filtercount."_target=temperatureC&f".$filtercount."_type=gt&f".$filtercount."_min=21";
    //echo($baseurl.$filtercount.$temperateFilter.$tail);
    $url = $baseurl.$filtercount.$temperateFilter.$tail;
    break;
    
    }


    //Get Other filters
    //Internet
    $Internet = $_GET['Internet'];
    if($Internet == "internet"){
        $filtercount = $filtercount + 1;
        $InternetFilter = "&f".$filtercount."_target=internet_speed&f".$filtercount."_type=gt&f".$filtercount."_min=15";
        $url = $baseurl.$filtercount.$temperateFilter.$InternetFilter.$tail;
    
    }else{
        $InternetFilter = "";
        $url = $baseurl.$filtercount.$temperateFilter.$InternetFilter.$tail;
        

    }


    //Safety
    $Safety = $_GET["Safety"];
    if($Safety == "Safety"){
        $filtercount = $filtercount + 1;
        $Safetyfilter = "&f".$filtercount."_target=safety_level&f".$filtercount."_type=gt&f".$filtercount."_min=3";
        $url = $baseurl.$filtercount.$temperateFilter.$InternetFilter.$Safetyfilter.$tail;
    
    }else{
        $Safetyfilter = "";
        $url = $baseurl.$filtercount.$temperateFilter.$InternetFilter.$Safetyfilter.$tail;
        

    }

    //Nightlife
    $Nightlife = $_GET["Nightlife"];
    if($Nightlife == "Nightlife"){
        $filtercount = $filtercount + 1;
        $Nightlifefilter = "&f".$filtercount."_target=nightlife&f".$filtercount."_type=gt&f".$filtercount."_min=3";
        $url = $baseurl.$filtercount.$temperateFilter.$InternetFilter.$Safetyfilter.$Nightlifefilter.$tail;
    
    }else{
        $Nightlifefilter = "";
        $url = $baseurl.$filtercount.$temperateFilter.$InternetFilter.$Safetyfilter.$Nightlifefilter.$tail;
        

    }

    //Region
    //$Region = $_GET["Region"];
    switch($_GET["Region"]){
        case 'Africa':
        $filtercount = $filtercount + 1;
        $Regionfilter = "&f".$filtercount."_target=region&f".$filtercount."_type=em&f".$filtercount."_value=Africa";
        $url = $baseurl.$filtercount.$temperateFilter.$InternetFilter.$Safetyfilter.$Nightlifefilter.$Regionfilter.$tail;
        break;

        case 'Asia':
        $filtercount = $filtercount + 1;
        $Regionfilter = "&f".$filtercount."_target=region&f".$filtercount."_type=em&f".$filtercount."_value=Asia";
        $url = $baseurl.$filtercount.$temperateFilter.$InternetFilter.$Safetyfilter.$Nightlifefilter.$Regionfilter.$tail;
        break;

        case 'Europe':
        $filtercount = $filtercount + 1;
        $Regionfilter = "&f".$filtercount."_target=region&f".$filtercount."_type=em&f".$filtercount."_value=Europe";
        $url = $baseurl.$filtercount.$temperateFilter.$InternetFilter.$Safetyfilter.$Nightlifefilter.$Regionfilter.$tail;
        break;

        case 'Middle+East':
        $filtercount = $filtercount + 1;
        $Regionfilter = "&f".$filtercount."_target=region&f".$filtercount."_type=em&f".$filtercount."_value=Middle+East";
        $url = $baseurl.$filtercount.$temperateFilter.$InternetFilter.$Safetyfilter.$Nightlifefilter.$Regionfilter.$tail;
        break;

        case 'North+America':
        $filtercount = $filtercount + 1;
        $Regionfilter = "&f".$filtercount."_target=region&f".$filtercount."_type=em&f".$filtercount."_value=North+America";
        $url = $baseurl.$filtercount.$temperateFilter.$InternetFilter.$Safetyfilter.$Nightlifefilter.$Regionfilter.$tail;
        break;

        default:
        $Regionfilter = "";
        $url = $baseurl.$filtercount.$temperateFilter.$InternetFilter.$Safetyfilter.$Nightlifefilter.$Regionfilter.$tail;
    }
    

    //Surfing

    $Surfing = $_GET["Surfing"];
    
    if($Surfing == "Surfing"){
        $filtercount = $filtercount + 1;
        $SurfingFilter = "&f".$filtercount."_target=tags&f".$filtercount."_type=pm&f".$filtercount."_value=surfing";
        $url = $baseurl.$filtercount.$temperateFilter.$InternetFilter.$Safetyfilter.$Nightlifefilter.$Regionfilter.$SurfingFilter.$tail;
    
    }else{
        $SurfingFilter = "";
        $url = $baseurl.$filtercount.$temperateFilter.$InternetFilter.$Safetyfilter.$Nightlifefilter.$Regionfilter.$SurfingFilter.$tail;
        

    }

    $Peaceful = $_GET["Peaceful"];

    if($Peaceful == "Peaceful"){
        $filtercount = $filtercount + 1;
        $PeacefulFilter = "&f".$filtercount."_target=fragile_states_index&f".$filtercount."_type=lt&f".$filtercount."_max=60";
        $url = $baseurl.$filtercount.$temperateFilter.$InternetFilter.$Safetyfilter.$Nightlifefilter.$Regionfilter.$SurfingFilter.$PeacefulFilter.$tail;
    
    }else{
        $PeacefulFilter = "";
        $url = $baseurl.$filtercount.$temperateFilter.$InternetFilter.$Safetyfilter.$Nightlifefilter.$Regionfilter.$SurfingFilter.$PeacefulFilter.$tail;
        

    }
    
    

    //Wifi
    $Wifi = $_GET["Wifi"];

    if($Wifi == "Wifi"){
        $filtercount = $filtercount + 1;
        $WifiFilter = "&f".$filtercount."_target=wifi_availability&f".$filtercount."_type=gt&f1_min=3";
        $url = $baseurl.$filtercount.$temperateFilter.$InternetFilter.$Safetyfilter.$Nightlifefilter.$Regionfilter.$SurfingFilter.$PeacefulFilter.$WifiFilter.$tail;
    
    }else{
        $WifiFilter = "";
        $url = $baseurl.$filtercount.$temperateFilter.$InternetFilter.$Safetyfilter.$Nightlifefilter.$Regionfilter.$SurfingFilter.$PeacefulFilter.$WifiFilter.$tail;
        

    }

    //echo $Region;
    //echo $url;
    return $url;
    //url for chatfuel => http://localhost/server/cd

    //APPLY Next Filter ? Budget => Pass to next function call

}


function getCityListFromNomadList($url){
$headers = array('Accept' => 'application/json');
$response = Unirest\Request::post($url, $headers);
// return first 15 results



if(sizeof($response->body->slugs) > 15){
    $limit = 15;
}else{
    $limit = sizeof($response->body->slugs);
}

$nomadlist = array ();

for ($i=0;$i < $limit ;$i++){

    array_push($nomadlist,$response->body->slugs[$i]);
}

if(sizeof($response->body->slugs) < 1){
    header('Content-type: application/json');
    $data = array("messages"=>array(
        array("text"=>"Sorry Could Not Find What You Are Looking For"),
        array("text"=>"Please Try Again !")
        )
    );

    echo json_encode($data);
}else{
    return $nomadlist;
}


//return $nomadlist;

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
    //$pollurl = "http://partners.api.skyscanner.net/apiservices/pricing/sg1/v1.0/bac9941a62dd48ac9b7d2d8a52998bbc_ecilpojl_EC1A4DBFD317BAC81DA0762C925A9B0A";
    //$pollurl = $pollurl.$apikey;
    //print_r($Budget);
    $totalpushed = 0;
    $calculatedprice = array();
    $limit = sizeof($PollingURLWithCityCodes);
    //$limit = 2;
    for ($i=0;$i< $limit ;$i++){
        $pollurl = $PollingURLWithCityCodes[$i]["PollingURL"]; 
        $pollurl = $pollurl.$apikey;
        //print_r($pollurl);
        //print_r($PollingURLWithCityCodes[$i]["nomadimageurl"]);


        $response = Unirest\Request::get($pollurl);
        $DeeplinkUrl = $response->body->Itineraries[0]->PricingOptions[0]->DeeplinkUrl;
        $price = $response->body->Itineraries[0]->PricingOptions[0]->Price;
        $cityname = $PollingURLWithCityCodes[$i]["DestinationName"];
        
        $response = array(
            'CityName' => $cityname , 
            "Price" => $price ,
            "DeeplinkUrl" => $DeeplinkUrl,
            "nomadimageurl" => $PollingURLWithCityCodes[$i]["nomadimageurl"] );

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
//print_r($pricecalculated[0]["nomadimageurl"]);
//print_r($pricecalculated[0]);    
header('Content-type: application/json');
    $data = array("messages" => array(
        array("text"=>"tesing"),
        array("text"=>"testing again"),
        
        ));

    $data = array("messages"=>array(
        array(
        "attachment"=>array(
         "type"=>"template",
         "payload"=>array(
             "template_type" => "generic" , 
             "elements"=> array(
                 
                 array(
                    "title" => "Classic White T-Shirt",
                    "image_url" => "http://petersapparel.parseapp.com/img/item100-thumb.png",
                    "subtitle" => "Soft white cotton t-shirt is back in style",
                    "buttons" => array(
                        array(
                            "type" => "web_url",
                            "url" => "https://petersapparel.parseapp.com/view_item?item_id=100",
                            "title" => "View Item"
                        ),
                        array(
                            "type" => "web_url",
                            "url" => "https://petersapparel.parseapp.com/buy_item?item_id=100",
                            "title" =>"Buy Item"
                            )
                        )
                    )
                 
                 )
                 
                 )
        )
    )
        
        
        )
    );

    
    for($i=0;$i<4;$i++){
        //echo intval($pricecalculated[$i]["Price"])."-------";
        $price = intval($pricecalculated[$i]["Price"])." $";

        $data["messages"][0]["attachment"]["payload"]["elements"][$i] = array(
                    "title" => $pricecalculated[$i]["CityName"],
                    "image_url" => $pricecalculated[$i]["nomadimageurl"],
                    "subtitle" => "A Great Place To Visit",
                    "buttons" => array(
                        array(
                            "type" => "web_url",
                            "url" => $pricecalculated[$i]["DeeplinkUrl"],
                            "title" => $price
                        ),
                        array(
                            "type" => "web_url",
                            "url" => $pricecalculated[$i]["DeeplinkUrl"],
                            "title" =>"Book Now"
                            )
                        )
                    );
    }

    echo json_encode($data);
}

function init($url){

$nomadlist = getCityListFromNomadList($url);

$skycode = getSKYCODE($nomadlist);

//get Skycode for Origin City
//echo $_GET['OriginCity'];
$OriginCity = getSKYCODE($_GET['OriginCity']);
//print_r($OriginCity[0]["CityCode"]);
$OriginCity = $OriginCity[0]["CityCode"];

$PollingURLWithCityCodes = setPollingURL($skycode,$OriginCity);
//print_r($PollingURLWithCityCodes);


$Budget = $_GET['Budget'];
$pricecalculated = CalculatePrice($Budget,$PollingURLWithCityCodes);
//print_r($pricecalculated);

formatOutput($pricecalculated);


}



function test(){
    header('Content-type: application/json');
    $data = array("messages" => array(
        array("text"=>"tesing"),
        array("text"=>"testing again"),
        
        ));

    $data = array("messages"=>array(
        array(
        "attachment"=>array(
         "type"=>"template",
         "payload"=>array(
             "template_type" => "generic" , 
             "elements"=> array(
                 
                 array(
                    "title" => "Classic White T-Shirt",
                    "image_url" => "http://petersapparel.parseapp.com/img/item100-thumb.png",
                    "subtitle" => "Soft white cotton t-shirt is back in style",
                    "buttons" => array(
                        array(
                            "type" => "web_url",
                            "url" => "https://petersapparel.parseapp.com/view_item?item_id=100",
                            "title" => "View Item"
                        ),
                        array(
                            "type" => "web_url",
                            "url" => "https://petersapparel.parseapp.com/buy_item?item_id=100",
                            "title" =>"Buy Item"
                            )
                        )
                    )
                 
                 )
                 
                 )
        )
    )
        
        
        )
    );

    for($i=0;$i<10;$i++){
        $data["messages"][0]["attachment"]["payload"]["elements"][$i] = array(
                    "title" => "Some T-Shirt".$i,
                    "image_url" => "http://petersapparel.parseapp.com/img/item100-thumb.png",
                    "subtitle" => "Soft white cotton t-shirt is back in style",
                    "buttons" => array(
                        array(
                            "type" => "web_url",
                            "url" => "https://petersapparel.parseapp.com/view_item?item_id=100",
                            "title" => "View Item"
                        ),
                        array(
                            "type" => "web_url",
                            "url" => "https://petersapparel.parseapp.com/buy_item?item_id=100",
                            "title" =>"Buy Item"
                            )
                        )
                    );
    }

    echo json_encode($data);
    
}











//test();
$url = getUrlParams();
init($url);

?>
