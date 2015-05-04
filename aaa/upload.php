<?php

    $postdata=file_get_contents("php://input");
    $m = new MongoClient();
    $db = $m->admin;
    $collection=$db->recipes;
    $rdata = json_decode($postdata);
    //echo "<script type='text/javascript'>alert('123');</script>";
    //foreach($rdata as $id => $item){
      //  $collection->insert($item);
    //}
    $document = array( 
      "title" => "MongoDB", 
      "description" => "database", 
      "likes" => 100,
      "url" => "http://www.tutorialspoint.com/mongodb/",
      "by", "tutorials point"
   );
   $collection->insert($document);

?>