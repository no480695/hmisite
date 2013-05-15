<? if ( $_SESSION['user_id'] ){
			$movable = "true";
		}
		else {
			$movable = "false";
		}
	?>
		$(function(){
			$('#calendar').fullCalendar({
            	 eventClick: function(calEvent, jsEvent, view) {
                    id = calEvent.id;

                    $.post('fetch-event.php',{ id : id }, function(data){
                    	$('#eventModal').html(data);
                        $('#eventModal').modal('show');
                    });
                },
				header: {
					left: 'prev,next today',
					center: 'title',
					right: ''
				},
				editable: <?=$movable?>,
				events: [
	<?
		function encode_base64($sData){
			$sBase64 = base64_encode($sData);
			return substr(strtr($sBase64, '+/', '-_'), 0, -2);
		}

		$all_events = mysql_query("SELECT id,start_date,end_date,name,description,all_day FROM event WHERE era_id = ".$ERA_ID);

		$x = 0;
		while ($i = mysql_fetch_array($all_events, MYSQL_ASSOC)) {

			echo "what";

      $date_time = explode(" ",$i['start_date']);
      $date = $date_time[0];
      $time = $date_time[1];
      $date_break = explode("/",$date);
      $time_break = explode(":",$time);
      $year = $date_break[2];
      $month = ($date_break[0])-1;
      $day = $date_break[1];
      $hour = $time_break[0];
      $minute = $time_break[1];

      $date_time2 = explode(" ",$i['end_date']);
      $date2 = $date_time2[0];
      $time2 = $date_time2[1];
      $date_break2 = explode("/",$date2);
      $time_break2 = explode(":",$time2);
      $year2 = $date_break2[2];
      $month2 = ($date_break2[0])-1;
      $day2 = $date_break2[1];
      $hour2 = $time_break2[0];
      $minute2 = $time_break2[1];
      if($hour2 == ""){
        $hour2 = $hour;
      }
      if($minute2 == ""){
        $minute2 = $minute;
      }

      if($i['name'] == 1){
        $allDay = "true";
      }
      else{
        $allDay = "false";
      }
      if($now[year] <= $year2){
        if($now['mon'] == $month2+1){
          if($now['mday'] <= $day2){
            if($x > 0){
              echo ",";
            }
            echo "{";
            echo   "title: '".$i['name']."',";
            echo  "start: new Date(".$year.",".$month.",".$day.",".$hour.",".$minute."),";
            echo  "end: new Date(".$year2.",".$month2.",".$day2.",".$hour2.",".$minute2."),";
            echo  "allDay: ".$allDay.",";
            echo  "className: 'hmi_event',";
            echo  "id: ".$i['id'];
            echo "}";
            $x++;
          }
          else{
            $deactivate_events = "UPDATE event SET active = 0 WHERE id = ".$i['id'];
            $update = mysql_query($deactivate_events);
            if($x > 0){
              echo ",";
            }
            echo "{";
            echo   "title: '".$i['name']."',";
            echo  "start: new Date(".$year.",".$month.",".$day.",".$hour.",".$minute."),";
            echo  "end: new Date(".$year2.",".$month2.",".$day2.",".$hour2.",".$minute2."),";
            echo  "allDay: ".$allDay.",";
            echo  "className: 'hmi_event',";
            echo  "id: ".$i['id'];
            echo "}";
            $x++;
          }
        }
        else if($now['mon'] < $month2+1){
          if($x > 0){
            echo ",";
          }
          echo "{";
          echo   "title: '".$i['name']."',";
          echo  "start: new Date(".$year.",".$month.",".$day.",".$hour.",".$minute."),";
          echo  "end: new Date(".$year2.",".$month2.",".$day2.",".$hour2.",".$minute2."),";
          echo  "allDay: ".$allDay.",";
          echo  "className: 'hmi_event',";
          echo  "id: ".$i['id'];
          echo "}";
          $x++;
        }
        else{
          $deactivate_events = "UPDATE event SET active = 0 WHERE id = ".$i['id'];
          $update = mysql_query($deactivate_events);
          if($x > 0){
            echo ",";
          }
          echo "{";
          echo   "title: '".$i['name']."',";
          echo  "start: new Date(".$year.",".$month.",".$day.",".$hour.",".$minute."),";
          echo  "end: new Date(".$year2.",".$month2.",".$day2.",".$hour2.",".$minute2."),";
          echo  "allDay: ".$allDay.",";
          echo  "className: 'hmi_event',";
          echo  "id: ".$i['id'];
          echo "}";
          $x++;
        }
      }
      else{ //DEACTIVATE
        $deactivate_events = "UPDATE event SET active = 0 WHERE id = ".$i['id'];
        $update = mysql_query($deactivate_events);
        if($x > 0){
          echo ",";
        }
        echo "{";
        echo   "title: '".$i['name']."',";
        echo  "start: new Date(".$year.",".$month.",".$day.",".$hour.",".$minute."),";
        echo  "end: new Date(".$year2.",".$month2.",".$day2.",".$hour2.",".$minute2."),";
        echo  "allDay: ".$allDay.",";
        echo  "className: 'hmi_event',";
        echo  "id: ".$i['id'];
        echo "}";
        $x++;
      }

		}


	?>


				]
			});

			$('#cal-tab').click(function (e) {
				e.preventDefault();
				$(this).tab('show');
				$('#calendar').fullCalendar('render');
			});

		});