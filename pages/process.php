<?

$dbh=mysql_connect ("localhost", "hmisite", "beaver12")
or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db("hmisite_main")or die( mysql_error());

echo "<table class='table table-striped table-bordered'>
				<tr>
					<th>Name</th>
					<th>Address</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Periods</th>
				</tr>";

$get_users = mysql_query("SELECT name,phone,email,address,eras FROM user ORDER by name");
while($row = mysql_fetch_array($get_users)){

	echo 	"<tr>";
	echo		"<td>".$row['name']."</td>";
	echo		"<td>".$row['address']."</td>";	
	echo		"<td>".$row['email']."</td>";
	echo		"<td>".$row['phone']."</td>";
	echo		"<td>".$row['eras']."</td>";
	echo	"</tr>";
	
}

echo "</table>";
?>