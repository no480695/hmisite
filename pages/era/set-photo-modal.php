<?

$photo_id = $_POST['id'];


$dbh=mysql_connect ("localhost", "hmisite", "beaver12")
or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db("hmisite_main")or die( mysql_error());

$get_photo = mysql_query("SELECT name,description,src FROM media WHERE id = ".$photo_id);

$get = mysql_fetch_row($get_photo);


$name = $get[0];
$description = $get[1];
$src = $get[2];
$file = explode("/",$src);
$end = explode(".",$file[6]);
$toreturn = "/".$file[4]."/".$file[5]."/".$file[6];

?>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
	<h3 id="myModalLabel"><?=$name?></h3>
</div>
<div class="modal-body" style="max-height:2000px;">
   <img src="http://hmisite.com<?=$toreturn?>"  /><br />
   <p><?=$description?>
</div>
<div class="modal-footer">
	<button id="close-creator" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
</div>
