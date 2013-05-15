<?

$era_id 		= $_POST['era_id'];
$start_date 	= "'".convertDate($_POST['start_date'])."'";
$end_date 		= "'".convertDate($_POST['end_date'])."'";

if ( $end_date == "''" ){ $end_date = $start_date; }

$name 			= "'".str_replace("'","`",$_POST['name'])."'";
$location 		= "'".str_replace("'","`",$_POST['location'])."'";
$description 	= "'".str_replace("'","`",$_POST['description'])."'";
$mod_person_id 	= $_POST['mod_person_id'];



$dbh=mysql_connect ("localhost", "noffutt", "beaver12")
or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db("hmi_site")or die( mysql_error());

if ( mysql_query("INSERT INTO event (era_id,start_date,end_date,name,location,description,mod_person_id) VALUES (".$era_id.",".$start_date.",".$end_date.",".$name.",".$location.",".$description.",".$mod_person_id.")") ) {
	exit ('success');
}
else {
	exit ("INSERT INTO event (era_id,start_date,end_date,name,location,description,mod_person_id) VALUES (".$era_id.",".$start_date.",".$end_date.",".$name.",".$location.",".$description.",".$mod_person_id.")");
}


function convertDate($input_date){

	//08/12/2013 12:00
	//YYYY-MM-DD HH:mm:SS
	$parts = explode(" ",$input_date);
	$date_parts  = explode("/",$parts[0]);
	$time_parts = explode(":",$parts[1]);

	$output_date = $date_parts[2]."-".$date_parts[0]."-".$date_parts[1]." ".$time_parts[0].":".$time_parts[1];

 return $output_date;
}

?>