<?php
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
    
    /*
    $data["messages"][0]["attachment"]["payload"]["elements"][1]= array(
                    "title" => "Some T-Shirt",
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
    */
    //print_r($data["messages"][0]["attachment"]["payload"]["elements"][0]);
    //print_r($data);
    echo json_encode($data);
    
?>
