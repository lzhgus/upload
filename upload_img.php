<?php
//echo nl2br(print_r($_FILES,1));
$m = new MongoClient();
$db=$m->admin;
$collection=$db->recipes;
$tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
    $uploadPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];
    move_uploaded_file( $tempPath, $uploadPath );

$new_task = array("picurl" => $uploadPath);

//$cursor = $collection->find()->sort(array('_id'=>-1))->limit(1);
//foreach ($cursor as $document) {
//      $cid = $document["_id"];
//}
$collection->insert($new_task);
//$collection->update(array("_id"=>$cid),array('$set'=>array("picurl" => $uploadPath)));
//$answer = array( 'answer' => 'File transfer completed' );
    $json = json_encode( $answer );
echo $json;

?>
