<?
$id = $_POST['id'];

$dbh=mysql_connect ("localhost", "hmisite", "beaver12")
or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db("hmisite_main")or die( mysql_error());

$get_event = mysql_query("SELECT start_date,end_date,name,description,location FROM event WHERE id = ".$id);

$get = mysql_fetch_row($get_event);

$start_date = $get[0];
$end_date = $get[1];
$name = $get[2];
$description = $get[3];
$location = $get[4];
?>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
	<h2 id="myModalLabel"><?=$name?></h2>
</div>
<div class="modal-body" style="max-height:2000px;">
	<h3>When: <small> <?=$start_date?> - <?=$end_date?></small></h3><hr />
    <h3>Where: <small> <? if ( $location == "" ){ echo "Contact Unit Leader"; } else{ echo $location; } ?></small></h3><hr />
    <h3>Description: </h3><br />
	<p><?=$description?></p>
</div>
<div class="modal-footer">
	<button id="close-creator" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
</div>

