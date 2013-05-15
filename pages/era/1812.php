<?
session_start();
$ERA_ID = 3;

//GET ALL TEH INFORMATION FROM DATABASE BASED ON ERA GIVEN ABOVE AND GET ARRAYS AND SUCH FOR EVENTS



$dbh=mysql_connect ("localhost:3036", "noffutt", "beaver12")
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
		<div class="hero-unit" style="background-image: linear-gradient(bottom, rgb(136,158,163) 0%, rgb(161,190,194) 50%, rgb(192,212,219) 81%);
background-image: -o-linear-gradient(bottom, rgb(136,158,163) 0%, rgb(161,190,194) 50%, rgb(192,212,219) 81%);
background-image: -moz-linear-gradient(bottom, rgb(136,158,163) 0%, rgb(161,190,194) 50%, rgb(192,212,219) 81%);
background-image: -webkit-linear-gradient(bottom, rgb(136,158,163) 0%, rgb(161,190,194) 50%, rgb(192,212,219) 81%);
background-image: -ms-linear-gradient(bottom, rgb(136,158,163) 0%, rgb(161,190,194) 50%, rgb(192,212,219) 81%);

background-image: -webkit-gradient(
	linear,
	left bottom,
	left top,
	color-stop(0, rgb(136,158,163)),
	color-stop(0.5, rgb(161,190,194)),
	color-stop(0.81, rgb(192,212,219))
);-webkit-box-shadow: inset 1px 1px 8px 0px rgba(1, 1, 1, 0.6);

        box-shadow: inset 1px 1px 8px 0px rgba(1, 1, 1, 0.6);">
			<div class="row">
				<div class="span8">
					<h1 style="text-shadow: 1px 2px 3px #242424;
        filter: dropshadow(color=#242424, offx=1, offy=2);">War of 1812</h1>
					<h2 style="text-shadow: 1px 2px 3px #242424;
        filter: dropshadow(color=#242424, offx=1, offy=2);">Marines</h2>
				</div>
				<div class="span2"><img style="border-radius:10px;" src="/pages/era/page_images/stars.gif" /></div>
			</div>
		</div>

		<ul class="nav nav-tabs" id="myTab">
			<li class="active"><a href="#welcome" data-toggle="tab">Welcome</a></li>
			<li><a id="cal-tab" href="#cal" data-toggle="tab">Calendar</a></li>
			<li><a href="#photos" data-toggle="tab">Photos</a></li>

			<li><a href="#uniform" data-toggle="tab">Uniform</a></li>
			<li><a href="#equipment" data-toggle="tab">Equipment</a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="welcome">
				<div class="row">
					<div class="span11 well">
						<p class="lead">A Brief History</p>

						<p>When war begin in 1812 the Marine Corps was only fifteen years old.  Marines had served during the American Revolution , but the units raised during that conflict had been disbanded in 1783.  During the troubled 1790s it had become necessary to organize a small frigate navy with a tiny marine corps to protect the growing merchant fleet of the United States.  These "soldiers of the sea" were under the Secretary of the Navy.  When serving as part of land forces, however, they came under the authority of the superior army officers.  Marines, then as now, considered themselves  the elite of American fighting men and sometimes had to be reminded that they should obey army and not navy officers in these circumstances.</p>
						<p>As with the rest of the regular forces, the authorized establishment of the marine corps far exceeded the actual numbers in service.  Fortunately, the figures for "active duty strength" are known for the War of 1812.</p>
						<p>June 30, 1812   Ten officers, 484 enlisted men.</p>
						<p>June 30, 1813  Twelve officers 579 enlisted men</p>
						<p>June 30, 1814  Eleven officers 579 enlisted men</p>
						<p>June 30, 1815 Eight officers 680 enlisted men</p>
						<p>Marines services was highly varied and as a rule, the corps was scattered in small detachments aboard naval vessels.  Other detachments, however were stationed in Louisiana, Washington, Philadelphia, and on the Great Lakes.  Small detachments participated in many minor actions.</p>
						<p>In the north, there were three officers and 121 marines on Lake Ontario, and detachments from this force participated in the capture of York, Upper Canada and Ft. George and the defense of Sackets Harbor. A detachment was attached to Scott's brigade on the Niagara in 1814. The Washington detachment, totaling a little over 100 men, fought gallantly at Bladensburg August 24, 1814.  A small marine detachment was present at the defense of Ft. McHenry on September 11-13,1814. In New Orleans, another detachment of marines under Major Daniel Carmick participated in the night action December 23, 1814 during the defense of that city against the British.</p>
						<p>In all the land actions in which they participated during the War of 1812, the Marine Corps fought hard and, at Bladensburg and New Orleans, with distinction.  Because of its small size, the Marine Corps did not play a major role in the war on land, but the regular army must have appreciated the existence of this reliable regular force.</p>
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
			<div class="tab-pane" id="uniform">
				<div class="well">
					<p class="lead">1812 Marine Uniform</p>
					<p>Marine Privates had a dark blue single-breasted coatee with red collar, cuff and turnbacks on the short skirts.  Buttons were brass, and the lace was yellow, ending in a point and set in a "V".  White cloth pantaloons with black cloth gaiters "to the knee" were worn in the winter and line overalls in the summer.  The felt Shako (cap) had a brass plate, red plush plume in the front, yellow cords, and tassels.  A black stock completed the uniform.</p>
					<p>Sergeants wore a red feather plume on the left side (instead of the front) of the their caps and had a brass-hilted straight sword but no sash.</p>
					<p>Drummers wore a "reversed" colors which gave them red coatees with blue collar, cuff and turnbacks.  An 1814 order for drums mentions eagles painted on canvas with a "Scrowl over the head or from its beak with the Motto,  "United States Marines" above.  The rest of the clothing was probably the same as for the privates.</p>
					<p>Summer dress as worn from the beginning of June until October.  This included white line pantaloons but apparently not a line jacket at the time of the war.</p>
				</div>
			</div>

			<div class="tab-pane" id="equipment">
				<div class="row">
					<div class="span7 well">
						<p class="lead">Arms and Accoutrements</p>
						<p>Non-commissioned officers and enlisted men carried a musket and bayonet.  The muskets might have been the French "light 1763", the U.S. Model 1795 or even the British India Pattern.  Cross belts were white, and there is no evidence that black belts were used by Marines during the War of 1812.  The oval belt plate were of brass.  Cartridge boxes (1808) were black leather, probably of the same pattern as for the army.</p>
					</div>
					<div class="span4">
							<img style="border-radius:5px;-webkit-box-shadow: inset 2px 2px 8px 0px rgba(1, 1, 1, 0.4);

			box-shadow: inset 2px 2px 8px 0px rgba(1, 1, 1, 0.4);" src="/pages/era/page_images/box.jpg" />
					</div>
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

		$("#new_event_start_date").mask("99/99/9999",{placeholder:"_"});
		$("#new_event_end_date").mask("99/99/9999",{placeholder:"_"});


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
				$.post('/pages/era/save-new-event.php', data, function(req){
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
