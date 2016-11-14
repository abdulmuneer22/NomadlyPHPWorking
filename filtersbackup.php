<?php
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

?>