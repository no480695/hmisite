<?

$photo_id = $_POST['id'];


$dbh=mysql_connect ("localhost", "noffutt", "beaver12")
or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db("hmi_site")or die( mysql_error());

$get_photo = mysql_query("SELECT name,description,src FROM media WHERE id = ".$photo_id);

$get = mysql_fetch_row($get_photo);


$name = $get[0];
$description = $get[1];
$src = $get[2];

?>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
	<h3 id="myModalLabel"><?=$name?></h3>
</div>
<div class="modal-body" style="max-height:516px;height:516px;">
   <img src="<?=$src?>" style="max-height:506px;" /><br />
   <p><?=$description?>
</div>
<div class="modal-footer">
	<button id="close-creator" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
</div>
