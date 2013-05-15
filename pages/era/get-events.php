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

		$x = 0;
		while ($i = mysql_fetch_array($all_events, MYSQL_ASSOC)) {

			echo "what";

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