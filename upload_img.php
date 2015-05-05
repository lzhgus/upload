<?php
//echo nl2br(print_r($_FILES,1));
$m = new MongoClient();
$db=$m->admin;

date_default_timeZone_set("America/New_York");
$nrid=-1;
$collection=$db->counters;
$query=array("id"=>"rid");
$cursor=$collection->find($query);
foreach($cursor as $doc)
{
	//echo $doc['seq'];
	$nrid=$doc['seq']+1;
}

$retval = $collection->findAndModify(
		array("id"=>"rid"),
		array('$set'=> array("seq"=>$nrid)),
		null,
		array("new"=>true)
);



$collection=$db->recipes;
/*$tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
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
echo $json;*/

$gridfs = $db->getGridFS();
$picture_tmp = $_FILES['file']['tmp_name'];
$picture_name = $_FILES['file']['name'];
$picture_type = $_FILES['file']['type'];

$id=$gridfs->storeUpload('file');
$files=$db->fs->files;
$files->update(array("filename"=>$picture_name),
	array('$set'=>array("contentType"=>$picture_type)));

$imageFile = $gridfs->findOne(array("_id" => $id))->getBytes();

$time=date("m/d/Y H:i");

$newinsert = array(
	"picurl" => $id,
    "rid"=> $nrid,
    "time" => $time
);

$collection->insert($newinsert);



?>
