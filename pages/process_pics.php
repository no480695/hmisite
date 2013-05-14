<?
session_start();

	$dbh=mysql_connect ("localhost", "hmisite", "beaver12")
or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db("hmisite_main")or die( mysql_error());

		$bad = array_merge( array_map('chr', range(0,31)),array("<", ">", ":", '"', "/", "\\", "|", "?", "*", " ", ".", "-"));
		$x = time();

		include('SimpleImage.php');
		
		$event_id = $_POST['event_select'];
		$previous_url = $_POST['previous_url'];
		
		$target = '/home/hmisite/public_html/images/photos/';
            $count=0;
            foreach ($_FILES['file']['name'] as $filename) 
            {
                $temp=$target;
                $tmp=$_FILES['file']['tmp_name'][$count];
                $count=$count + 1;
				
				$part = str_replace($bad, "", $filename);
				
                $temp=$temp.$part;
				
				
				if (!preg_match("/.(gif|jpg|png)$/i", $filename)) {
					//DO NOT DO ANYTHING
				}
				else{
				
					move_uploaded_file($tmp,$temp);
					
					$filename2 = $temp;
					list($width, $height) = getimagesize($filename2);
					$newwidth = 200;
					$newheight = ($newwidth/$width) * $height;
					$thumb = imagecreatetruecolor($newwidth, $newheight);
					$source = imagecreatefromjpeg($filename2);
					imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					$name_parts = explode(".",$temp);
					$for_thumb = $name_parts[0]."_thumb".".".$name_parts[1];
					imagejpeg($thumb, $for_thumb, 85);
					imagedestroy($thumb);
					
					$filename3 = $temp;
					list($width2, $height2) = getimagesize($filename3);
					$newwidth2 = 1200;
					$newheight2 = ($newwidth2/$width2) * $height2;
					$thumb2 = imagecreatetruecolor($newwidth2, $newheight2);
					$source2 = imagecreatefromjpeg($filename3);
					imagecopyresampled($thumb2, $source2, 0, 0, 0, 0, $newwidth2, $newheight2, $width2, $height2);
					imagejpeg($thumb2, $temp, 90);
					imagedestroy($thumb2);
					
					mysql_query("INSERT INTO media (name, event_id, src, era_id) VALUES ('".$temp."',".$event_id.",'".$temp."',".$_POST['era_id'].")");
					
					
				}
                $temp='';
                $tmp='';
            }

    header("location:".$previous_url);




?>