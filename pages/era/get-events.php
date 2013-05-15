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

      $date = $i['start_date'];
      $date_break = explode("-",$date);
      $year = $date_break[0];
      $month = ($date_break[1])-1;
      $day = $date_break[2];

      $date2 = $i['end_date'];
      $date_break2 = explode("-",$date2);
      $year2 = $date_break2[0];
      $month2 = ($date_break2[1])-1;
      $day2 = $date_break2[2];

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
            echo  "start: new Date(".$year.",".$month.",".$day."),";
            echo  "end: new Date(".$year2.",".$month2.",".$day2."),";
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
            echo  "start: new Date(".$year.",".$month.",".$day."),";
            echo  "end: new Date(".$year2.",".$month2.",".$day2."),";
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
          echo  "start: new Date(".$year.",".$month.",".$day."),";
            echo  "end: new Date(".$year2.",".$month2.",".$day2."),";
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
          echo  "start: new Date(".$year.",".$month.",".$day."),";
          echo  "end: new Date(".$year2.",".$month2.",".$day2."),";
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
        echo  "start: new Date(".$year.",".$month.",".$day."),";
        echo  "end: new Date(".$year2.",".$month2.",".$day2."),";
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