<?php

    $postdata=file_get_contents("php://input");
    $m = new MongoClient();
    $db = $m->admin;
    $collection=$db->recipes;
    $rdata = json_decode($postdata);
    $cursor = $collection->find()->sort(array('_id'=>-1))->limit(1);
    foreach ($cursor as $document) {
        $cid = $document["_id"];
    }
    $collection->update(array("_id"=>$cid),array('$push'=>$rdata));
   // $collection->insert($rdata);

?>