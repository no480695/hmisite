<?
session_start();
$ERA_ID = 2;

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
			<p>Enter as much or little of the information about the event as you see fit. Further information can be entered by clicking on the event in the calander.</p>
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
		<div class="hero-unit" style="background-image: linear-gradient(bottom, rgb(150,85,85) 11%, rgb(196,139,139) 74%);
background-image: -o-linear-gradient(bottom, rgb(150,85,85) 11%, rgb(196,139,139) 74%);
background-image: -moz-linear-gradient(bottom, rgb(150,85,85) 11%, rgb(196,139,139) 74%);
background-image: -webkit-linear-gradient(bottom, rgb(150,85,85) 11%, rgb(196,139,139) 74%);
background-image: -ms-linear-gradient(bottom, rgb(150,85,85) 11%, rgb(196,139,139) 74%);

background-image: -webkit-gradient(
	linear,
	left bottom,
	left top,
	color-stop(0.11, rgb(150,85,85)),
	color-stop(0.74, rgb(196,139,139))
);-webkit-box-shadow: inset 1px 1px 8px 0px rgba(1, 1, 1, 0.6);

        box-shadow: inset 1px 1px 8px 0px rgba(1, 1, 1, 0.6);">
			<div class="row">
				<div class="span8">
					<h1 style="text-shadow: 1px 2px 3px #242424;
        filter: dropshadow(color=#242424, offx=1, offy=2);">3rd Pa. Light Infantry</h1>
					<h2 style="text-shadow: 1px 2px 3px #242424;
        filter: dropshadow(color=#242424, offx=1, offy=2);">American Revolutionary War</h2>
				</div>
				<div class="span2"><img style="border-radius:10px;" src="/pages/era/page_images/revwarlogo.jpg" /></div>
			</div>
		</div>

		<ul class="nav nav-tabs" id="myTab">
			<li class="active"><a href="#welcome" data-toggle="tab">Welcome</a></li>
			<li><a href="#history" data-toggle="tab">History</a></li>
			<li><a id="cal-tab" href="#cal" data-toggle="tab">Calendar</a></li>
			<li><a href="#photos" data-toggle="tab">Photos</a></li>
			<li><a href="#uniform" data-toggle="tab">Basic Uniform</a></li>
			<li><a href="#join" data-toggle="tab">How To Join</a></li>

		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="welcome">
				<div class="row">
					<div class="span7 well">
						<p class="lead">A Brief Introduction</p>
						<p>This is an 18th Century, Revolutionary War ( also called the AWI or American war of Independence) recreated re-enactment unit.  It is one of several units that comprise the parent organization, Historical Military Impression (HMI).  Each member pays a annual dues and maintains his or her own uniform and equipment.  Tents are provided by HMI for the troops that wish to stay in the field at events.</p>
						<p>Join the proud men and women who re-enact the History of our Revolution!

						<p>Throughout the year we go to historical sites and battlefields, and enter the 18th century. The lifestyles of the soldiers and campfollowers are re-enacted as accurately as possible. This includes camp life, food, uniforms, drill, weapons, tactics and of course, history.</p>

						<p>Annual battle re-enactments include Bound Brook, Brandywine, Monmouth, Germantown, Red Bank and Hope Lodge to name a few. We also travel to Williamsburg once a year.</p>
					</div>
					<div class="span4">
						<img style="border-radius:5px;-webkit-box-shadow: inset 2px 2px 8px 0px rgba(1, 1, 1, 0.4);

        box-shadow: inset 2px 2px 8px 0px rgba(1, 1, 1, 0.4);" src="/pages/era/page_images/troops.jpg" />
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
			<div class="tab-pane" id="history">
				<div class="span4">
							<img style="border-radius:5px;-webkit-box-shadow: inset 2px 2px 8px 0px rgba(1, 1, 1, 0.4);

			box-shadow: inset 2px 2px 8px 0px rgba(1, 1, 1, 0.4);" src="/pages/era/page_images/gw.jpg" />
				</div>
				<div class="span7 well">
					<p class="lead">History of the Regiment</p>
					<p>This is a brief history of the regiment as submitted for the Freedom Foundation Awards for Outstanding Achievements in bringing about a better understanding of the American way of life and the cause of freedom:</p>
					<p>"...despite the hardships the men reported (many) of them promptly reenlisted, joining the 3rd Pa. Reg't. which was then organized and recruited up to strength.  It joined the army in the New Jersey in 1777.  It was assigned to the brigade formerly commanded by Big. Gen Thomas Mifflin now under Brig.Gen . Thomas Conway.  In the spring and summer of 1777, the regiment took part in engagements at Bound Brook, April 12 and 13 as well as Short Hills, June 26."</p>
					<p>Other later engagements fought by the 3rd Pa. included Brandywine, Germantown, and Monmouth.  During the battle of Brandywine, Sept 11, 1777, the regiment was on the right flank and sustained the initial surprise attack of the main body of the British army.  Fighting steadfastly, the American defense crumbed and troops began to leave the field.  At this point, Capt. Thomas Butler performed exceptional service in rallying the fleeing troops to delay the onslaught of the British attack.  He later received a personal commendation from General Washington.</p>
					<p>After marching with Washington's army to Hartford, Conn. Sept. 21, 1780, the 3rd Pa. was removed to Tappan, New York on the 25th.  It became part of the force which was rushed to West Point to guard against a possible British thrust after Arnold's treachery there.  In December, it moved to Morristown, New Jersey where its men took part in the mutiny that began on January 1, 1781.</p>
					<p>The Pennsylvania line was then reorganized as a whole as the result of the mutiny.  There was a 3rd Pa, among the six regiments which were retained in the new structure.  Many of the original 3rd Pa. men were discharged or transferred upon re-enlistments to the three provisional battalions of Pa. Continentals and then redeployed to the southern theater of operations.</p>
				</div>
			</div>

			<div class="tab-pane" id="join">
				<div class="row">
					<div class="span7 well">
						<p class="lead">How to Join</p>
						<p>Contact one of the following persons for membership application and more specific information.  They can answer most of your questions as well</p>
						<br />
						<br />
						<br />
						<br />
						<br />
					</div>
					<div class="span4">
							<img style="border-radius:5px;-webkit-box-shadow: inset 2px 2px 8px 0px rgba(1, 1, 1, 0.4);

			box-shadow: inset 2px 2px 8px 0px rgba(1, 1, 1, 0.4);" src="/pages/era/page_images/join1.jpg" />
					</div>
				</div>

				<div class="row" style="margin-top:50px;">
					<div class="span3 well">
					  <img class="lady-image" style="border-radius:8px;" src="/pages/era/page_images/join2.jpg" width="200px">
					  <h2>Captain Dave Hospador</h2>
					  <p>dchospador@comcast.net</p>
					</div>
					<div class="span3 well">
					  <img class="lady-image" style="border-radius:8px;" src="/pages/era/page_images/join3.jpg" width="200px">
					  <h2>Lt. Charlie Lang</h2>
					  <p>cw1224@verizon.net</p>
					</div>
					<div class="span3 well">
					  <img class="lady-image" style="border-radius:8px;" src="/pages/era/page_images/join4.jpg" width="200px">
					  <h2>Sgt. Dave Clugh</h2>
					  <p>drclugh@verizon.net</p>
					</div>
				</div>
			</div>

			<div class="tab-pane" id="uniform">
				<div class="row">
					<div class="span7 well">
						<p class="lead">The Basic Essentials to the Uniform</p>
						<p>The basic uniform consists of the following items.  They are considered the basic kit for the 3rd Pa. Lights Infantry.  Please check with one of the persons listed on the " How to Join"  page before purchasing any article that you think is appropriate.  Often members purchase items from sources that are less than reliable as far as authenticity is concerned.   We try to be as period authentic as we can based upon research and experience of senior members of the unit.  Once you get started you will thirst for more knowledge about the period and want to read books and articles on the 18th Century. </p>
						<p>Much of the basic kit can be hand made by you if you are able to spend some time at it.  Several members of the 3rd Pa. Lights specialize in making various items as well.  You may save yourself several dollars by checking with them first before purchasing some things from a sulter.  A few items such as  cartridge box or musket  might be obtained second hand at reduced costs.  Clothing patterns are available to make all of the required articles on the list.   If you have access to a sewing machine, then this is the way to get started.  Certain items such as shoes, buckles, and buttons will have to be purchased.  Of course you will definitely want your own personal eating and drinking utensils.</p>
						<p><strong>Regimental Coat</strong> - Short tails, blue faced red wool with USA buttons.  A temporary substitute that is very useful is a hunting frock or shirt.  The Regimental Coat is probably the most expensive item in the kit other then the Musket.  Good regimental coats start at around $300 complete with buttons.  You can usually save a few dollars on your coat if you specify that you will sew on all the buttons. There are 40 buttons in all. </p>
						<p><strong>Overalls or Breeches</strong> - White linen or linen/cotton.  Overalls are standard for Light Infantry however, few suppliers are able to make good fitting overalls.  It would be best to make your own here.  Otherwise, go with a pair of breeches for starters and wear a pair of half gaiters (or "spatterdashers" ).</p>
					</div>
					<div class="span4">
							<img style="border-radius:5px;-webkit-box-shadow: inset 2px 2px 8px 0px rgba(1, 1, 1, 0.4);

			box-shadow: inset 2px 2px 8px 0px rgba(1, 1, 1, 0.4);" src="/pages/era/page_images/join2.jpg" />
					</div>
				</div>

				<div class="row">
					<div class="span11 well">
						<p><strong>18th Century black shoes</strong> - either rough or smooth side out. Either laced or buckled</p>
						<p><strong>Linen Shirt</strong> - White</p>
						<p><strong>Waist Coat</strong> - White linen or wool.</p>
						<p><strong>Neck Stock</strong> - Black linen, cotton duck or leather</p>
						<p><strong>Light Infantry Helmet</strong> - Contact Dave Clugh drclughs@verizon.net    An acceptable temporary substitute for this helmet is a cocked hat, knit cap.</p>
						<p><strong>Canteen</strong> - either tin, wooden, leather, or gourde.</p>
						<p><strong>Cartridge Box</strong> - should hold at least 24 rounds ( contact Carl Szathmary  cszathma@comcast.net  )</p>
						<p><strong>Shoulder Carriage with Double Frogg</strong> - White leather strap ( contact Carl Szathmary cszathma@comcast.net )</p>
						<p><strong>Waist Belt with waist box</strong> - this should hold additional 15 rounds.  ( contact Carl Szathmary)</p>
						<p><strong>Tomahawk and Bayonet</strong>  - to be carried in the shoulder Carriage.</p>
						<p><strong>Musket</strong> - either Charleyville cal. 69 or Brown Bess cal. 75 .</p>
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
