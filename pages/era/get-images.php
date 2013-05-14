<? 
$get_events = mysql_query("SELECT id,name FROM event WHERE era_id = ".$ERA_ID." ORDER by start_date DESC");
$fnal = "";

while($row = mysql_fetch_array($get_events)){
	$event_title = "";
	$after = "";
	
	$event_id = $row['id'];
	$event_name = $row['name'];
	
	//PURELY CHECK THAT THERE ARE RESULTS AND TEHN SHOW TITLE
	$get_media2 = mysql_query("SELECT name,description,src FROM media WHERE event_id = ".$event_id);
	while($media2 = mysql_fetch_array($get_media2)){
		$event_title = "<h2>".$event_name."</h2>";
		$after = "<hr class='featurette-divider' style='margin:30px 0px 30px 0px;'>";
	}
	
	echo $event_title;
	
	$get_media = mysql_query("SELECT id,name,description,src FROM media WHERE event_id = ".$event_id);
	while($media = mysql_fetch_array($get_media)){
		$image_id			= $media['id'];
		$image_name			= $media['name'];
		$image_desciption	= $media['description'];
		$image_src			= $media['src'];
		$file = explode("/",$image_src);
		$end = explode(".",$file[6]);
		$toreturn = "/".$file[4]."/".$file[5]."/".$end[0]."_thumb".".".$end[1];
		echo "<img src='http://hmisite.com".$toreturn."' class='image-tile' id='image-".$image_id."' />";
	}
	
	echo $after;
	
	$fnal .= $after;
	
}
if ( $fnal == "" ){
		echo "There are currently no photos available, please check back soon!";
}
?>