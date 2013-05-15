<?
session_start();
$ERA_ID = 5;

//GET ALL TEH INFORMATION FROM DATABASE BASED ON ERA GIVEN ABOVE AND GET ARRAYS AND SUCH FOR EVENTS



$dbh=mysql_connect ("localhost", "noffutt", "beaver12")
or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db("hmi_site")or die( mysql_error());

$now = getdate();

$get_commander = mysql_query("SELECT commander_id FROM era WHERE id = ".$ERA_ID);
$get = mysql_fetch_row($get_commander);
$COMMANDER_ID = $get[0];

?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Historic Military Impressions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/css/bootstrap.css" rel="stylesheet">
	<link href="/css/era-page.css" rel="stylesheet">
    <link href="/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="/css/jquery-ui-1.8.21.custom.css" />
	<link href="/css/fcal.css" rel="stylesheet">
	<link href="/css/facebox.css" media="screen" rel="stylesheet" type="text/css"/>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

  <body>

  	<div id="eventModal" class="modal hide fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="top: 40%;"></div>

    <div id="photoModal" class="modal hide fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="top: 30%;"></div>




  <div id="addPics" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="top: 30%;">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h3 id="myModalLabel">Upload Photos</h3>
	  </div>
	  <div class="modal-body" style="max-height:2000px;">
		<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">x</button>
			<p>Multiple files can be chosen at once. Please consider the content of your images when adding them to HMIsite.com</p>
		</div>

		<div class="form-horizontal">

		  <div class="control-group">
			<label class="control-label" for="inputEmail">Title</label>
			<div class="controls">
			<form name="pics_to_get" method="post" id="pics_to_get" action="/pages/process_pics.php" enctype="multipart/form-data">
				<select id="event_select" name="event_select">
			  <?
			  $all_events2 = mysql_query("SELECT id,start_date,end_date,name,description,all_day FROM event WHERE era_id = ".$ERA_ID);


			  while ($i = mysql_fetch_array($all_events2, MYSQL_ASSOC)) { ?>
					<option value="<? echo $i['id']; ?>"><? echo $i['name']; ?></option>
			  <? } ?>
				</select>
			</div>
		  </div>

		  <div class="control-group">
			<label class="control-label" for="inputPassword">Photos</label>
			<div class="controls">
			  <input type="file" name="file[]" multiple />
			  <input type="hidden" name="era_id" value="<?=$ERA_ID?>">
			  <input type="hidden" name="previous_url" value="<?=$_SERVER["PHP_SELF"]?>">
			</div>
		  </div>
		  <input type="hidden" value="<?=$ERA_ID?>" id="new_event_era" />
		  <input type="hidden" value="<?=$COMMANDER_ID?>" id="new_event_creator" />
		  <div class="control-group">
			<div class="controls">
			  <input type="submit" class="btn btn-primary" value="Submit" /></form>
			</div>
		  </div>
		</div>


	  </div>
	  <div class="modal-footer">
		<button id="close-creator" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	  </div>
	</div>






	<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="top: 30%;">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h3 id="myModalLabel">Enter Event Information</h3>
	  </div>
	  <div class="modal-body" style="max-height:2000px;">
		<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">x</button>
			<p>Enter as much or little of the information about the event as you see fit. Furhter information can be entered by clicking on the event in the calander.</p>
			<p>The event may not show up right after submitting, please refresh the page and navigate to the calendar to see changes.</p>
		</div>

		<div class="form-horizontal">

		  <div class="control-group">
			<label class="control-label" for="inputEmail">Title</label>
			<div class="controls">
			  <input type="text" style="height:30px;" id="new_event_name" placeholder="Title">
			</div>
		  </div>

		  <div class="control-group">
			<label class="control-label" for="inputPassword">Start Date</label>
			<div class="controls">
			  <input type="text" style="height:30px;" id="new_event_start_date" placeholder="mm/dd/yyyy hh:mm">
			</div>
		  </div>

		  <div class="control-group">
			<label class="control-label" for="inputPassword">End Date</label>
			<div class="controls">
			  <input type="text" style="height:30px;" id="new_event_end_date" placeholder="mm/dd/yyyy hh:mm">
			</div>
		  </div>

		  <div class="control-group">
			<label class="control-label" for="inputPassword">Address</label>
			<div class="controls">
			  <input type="text" style="height:30px;" id="new_event_location" placeholder="# Street Town, State Zip">
			</div>
		  </div>

		  <div class="control-group">
			<label class="control-label" for="inputPassword">Event Description / Information</label>
			<div class="controls">
			  <textarea rows="4" style="height:180px;width:300px;" id="new_event_description"></textarea>
			</div>
		  </div>
		  <input type="hidden" value="<?=$ERA_ID?>" id="new_event_era" />
		  <input type="hidden" value="<?=$COMMANDER_ID?>" id="new_event_creator" />
		  <div class="control-group">
			<div class="controls">
			  <div type="submit" class="btn btn-primary" id="submit-new-event">Submit</div>
			</div>
		  </div>
		</div>


	  </div>
	  <div class="modal-footer">
		<button id="close-creator" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	  </div>
	</div>




    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">

          <a class="brand" href="/">Historical Military Impressions</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="/">Home</a></li>
              <li><a href="/pages/ladies.php">Ladies of HMI</a></li>
              <li><a href="/pages/application.php">Membership Application</a></li>
			  <li><a href="/pages/newsletter.php">Newsletter</a></li>
			  <li><a href="/pages/directory.php">Directory</a></li>
              <!-- Read about Bootstrap dropdowns at http://twitter.github.com/bootstrap/javascript.html#dropdowns -->
              <li class="active dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Impressions <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="/pages/era/wwii.php">World War Two</a></li>
                  <li><a href="/pages/era/wwi.php">World War One</a></li>
                  <li><a href="/pages/era/civilwar.php">Civil War</a></li>
                  <!--<li class="divider"></li>
                  <li class="nav-header">Nav header</li>-->
                  <li><a href="/pages/era/1812.php">War of 1812</a></li>
                  <li><a href="/pages/era/revwar.php">Rev War</a></li>
				  <li><a href="/pages/era/french&indian.php">French and Indian War</a></li>
                </ul>
              </li>
			  <? if ( $_SESSION['user_name'] ){ ?>
			  <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$_SESSION['user_name']?><b class="caret"></b></a>
                <ul class="dropdown-menu">

				<? if ( $_SESSION['user_id'] == $COMMANDER_ID ){ ?>
					<li><a href="#myModal" role="button" id="submit-info" data-toggle="modal">Add Event</a></li>
					<li><a href="#addPics" role="button" id="submit-info2" data-toggle="modal">Upload Photos</a></li>
				<? } ?>

                  <li><a href="/logout.php">Sign Out</a></li>
                </ul>
              </li>
			  <? } else { ?>
			  <li><a href='/login.php'>Sign In</a></li>
			  <? } ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>



    <div class="container">
		<div class="hero-unit" style="background-image: linear-gradient(bottom, rgb(173,137,64) 11%, rgb(204,175,116) 82%);
background-image: -o-linear-gradient(bottom, rgb(173,137,64) 11%, rgb(204,175,116) 82%);
background-image: -moz-linear-gradient(bottom, rgb(173,137,64) 11%, rgb(204,175,116) 82%);
background-image: -webkit-linear-gradient(bottom, rgb(173,137,64) 11%, rgb(204,175,116) 82%);
background-image: -ms-linear-gradient(bottom, rgb(173,137,64) 11%, rgb(204,175,116) 82%);

background-image: -webkit-gradient(
	linear,
	left bottom,
	left top,
	color-stop(0.11, rgb(173,137,64)),
	color-stop(0.82, rgb(204,175,116))
);-webkit-box-shadow: inset 1px 1px 8px 0px rgba(1, 1, 1, 0.6);

        box-shadow: inset 1px 1px 8px 0px rgba(1, 1, 1, 0.6);">
			<div class="row">
				<div class="span8">
					<h1 style="text-shadow: 1px 2px 3px #242424;
        filter: dropshadow(color=#242424, offx=1, offy=2);">109th Infantry, 28th Div. Company "M"</h1>
					<h2 style="text-shadow: 1px 2px 3px #242424;
        filter: dropshadow(color=#242424, offx=1, offy=2);">"The Bloody Bucket"</h2>
				</div>

				<div class="span2"><img src="/images/resources/28th.png" /></div>
			</div>
		</div>

		<ul class="nav nav-tabs" id="myTab">
			<li class="active"><a href="#welcome" data-toggle="tab">Welcome</a></li>
			<li><a id="cal-tab" href="#cal" data-toggle="tab">Calendar</a></li>
			<li><a href="#photos" data-toggle="tab">Photos</a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="welcome">
				<div class="row">
					<div class="span7 well">
						<p class="lead">About Us</p>
						<p>The 109th was formed from the 1st Penn. Infantry and the 13th Penn. Infantry. Co. M was commanded by Capt. George Wagner. The Regiment left NYC on May 2nd for England.  At the battle of Marne Co's M and L were left holding the center of the line after French Troops retired in panic.  After heavy fighting only 150 officers and men remained out of 500.</p>

                        <p>Please contact Jim Gibson if you are interested in doing this impression. Jim will take the time to answer any of your question and help you get started. his e-mail is <a href="jimallwars@email.msn.com">jimallwars@email.msn.com</a></p>
					</div>
					<div class="span4">
						<img src="/pages/era/page_images/Jim_WWI.jpg" />
					</div>
				</div>
			</div>
			<div class="tab-pane" id="cal">

				<div class="well" id='calendar'></div>
			</div>
			<div class="tab-pane" id="photos">
            	<div class="well">
				<? include("get-images.php"); ?>
                </div>
			</div>

		</div>


    </div> <!-- /container -->

	<footer class="footer">
		<div class="container">
			<p class="pull-right"><a href="#">Back to top</a></p>
			<p>&copy; 2012 Historic Military Impressions. &middot;</p>
		</div>
    </footer>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/jquery.js"></script>
	<script src="/js/jquery.maskedinput-1.3.min.js"></script>
	<script src="/js/facebox.js"></script>
    <script src="/js/bootstrap.js"></script>
	<script type="text/javascript" src="/js/jquery-ui-1.8.21.custom.min.js"></script>
	<script type="text/javascript" src="/js/date-time.js"></script>
	<script type="text/javascript" src="/js/cal.js"></script>
    <script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyBQnCHbDIwTqbI8ypbraOtMLiAFjrXfi4U&sensor=false" type="text/javascript"></script>



	<script type='text/javascript'>

		$("#new_event_start_date").mask("99/99/9999 99:99",{placeholder:"_"});
		$("#new_event_end_date").mask("99/99/9999 99:99",{placeholder:"_"});


	<?

	include("get-events.php");

	?>

		$('.image-tile').live('click',function(){
			var photo_parts = $(this).attr('id').split('-');
			var photo_id = photo_parts[1];

			$.post('set-photo-modal.php',{ id : photo_id }, function(data){
                $('#photoModal').html(data);
                $('#photoModal').modal('show');
            });


		});

		$('#submit-new-event').click(function(){
			var creator = $('#new_event_creator').val();
			var era = $('#new_event_era').val();
			var title = $('#new_event_name').val();
			var start = $('#new_event_start_date').val();
			var end = $('#new_event_end_date').val();
			var address = $('#new_event_location').val();
			var details = $('#new_event_description').val();

			data = {
				mod_person_id	: creator,
				era_id		: era,
				name		: title,
				start_date	: start,
				end_date	: end,
				location	: address,
				description	: details
			}

			if ( title == "" || start == ""){
				alert ( "Atleast a Title and a Start Date must be entered to declare an event" );
			}
			else{
				$.post('save-new-event.php', data, function(req){
					if ( req == 'success' ){
						$('#close-creator').trigger('click');
					}
					else{
						alert( "There was an error entering your event. Please check the form for invalid characters. If the problem continues, please email no480695@gmail.com with an error report" );
					}

				});
			}

		});

	</script>

  </body>
</html>
