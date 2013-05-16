<?
session_start();
$ERA_ID = 6;

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
	<div id="photoModal" class="modal hide fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:800px;top: 40%;"></div>

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
              <li><a href="/pages/application.php">Membership Application</a></li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Members <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="/pages/ladies.php">Ladies of HMI</a></li>
                  <li><a href="/pages/merit-award.php">HMI Merit Award Winners</a></li>
                  <li><a href="/pages/newsletter.php">Newsletter</a></li>
                  <li><a href="/pages/directory.php">Directory</a></li>
                </ul>
              </li>

              <li class="dropdown active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Impressions <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li class="active"><a href="/pages/era/wwii.php">World War Two</a></li>
                  <li><a href="/pages/era/wwi.php">World War One</a></li>
                  <li><a href="/pages/era/civilwar.php">Civil War</a></li>
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
		<div class="hero-unit" style="background-image: linear-gradient(bottom, rgb(156,152,81) 30%, rgb(184,178,107) 68%);
background-image: -o-linear-gradient(bottom, rgb(156,152,81) 30%, rgb(184,178,107) 68%);
background-image: -moz-linear-gradient(bottom, rgb(156,152,81) 30%, rgb(184,178,107) 68%);
background-image: -webkit-linear-gradient(bottom, rgb(156,152,81) 30%, rgb(184,178,107) 68%);
background-image: -ms-linear-gradient(bottom, rgb(156,152,81) 30%, rgb(184,178,107) 68%);

background-image: -webkit-gradient(
	linear,
	left bottom,
	left top,
	color-stop(0.3, rgb(156,152,81)),
	color-stop(0.68, rgb(184,178,107))
);-webkit-box-shadow: inset 1px 1px 8px 0px rgba(1, 1, 1, 0.6);

        box-shadow: inset 1px 1px 8px 0px rgba(1, 1, 1, 0.6);">
			<div class="row">
				<div class="span8">
					<h1 style="text-shadow: 1px 2px 3px #242424;
        filter: dropshadow(color=#242424, offx=1, offy=2);">Co. L  109th Infantry 28th Div.</h1>
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

			<li><a href="#clothing" data-toggle="tab">Required Clothing</a></li>
			<li><a href="#books" data-toggle="tab">Recommended Books</a></li>
			<li><a href="#links" data-toggle="tab">Useful Links</a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="welcome">
				<div class="row">
					<div class="span7 well">
						<p class="lead">About Us</p>
						<p>The 28th Division arrived in France in July 1944 and fought its way to Germany. The Division, whose divisional patch is the red keystone, paid a heavy price in the Huertgen Forest or " Green Hell" during November of 1944.  The Division earned the nick name " The Bloody Bucket" by the Germans who had faced the fury of the Division's attacks during this campaign.  In the Ardennes campaign, commonly known as the Battle of the Bulge, the Division bore the brunt of the German counter offensive.  The Division fought in five campaigns and suffered over 16,000 in killed or wounded in action.  Along with the soldiers, the women of HMI  portray members of the Women's Army Auxiliary Corps (WAACS) .  The unit also demonstrates life back home during the war through the " Home Front" display, where everything from clothing to ration stamps can be seen.  The spirit of the fighting men and women of our country has not been forgotten, and is preserved by the members of HMI though living history demonstrations and battle re-enactments.  Members of the unit are very helpful to new recruits by guiding them during the time that they are putting together their impression.</p>
					</div>
					<div class="span4">
						<img src="/pages/era/page_images/fook_in_paris.jpg" />
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
			<div class="tab-pane" id="clothing">
				<div class="row">
					<div class="span11 well">
                        <h2>Required Clothing</h2>
                        Shirt, wool, M1937 OD, light shade (mustard), enlisted pattern with the Keystone patch.  When looking for Keystone patches, look for the white thread on the back, the more white thread the better.
                        <br><br>
                        Trousers, wool serge, M1937 OD, Light shade (mustard), enlisted pattern.  Be aware that the M1945 trousers are close in color but have a pocket flap for the rear pocket.  These trousers should not be worn.
                        <br><br>
                        Belt, trousers, light OD or khaki with open square frame buckle.
                        <br><br>
                        Boots, rough out. (Black boots or lug soled boots are NOT acceptable) The low quarter service boots are preferred as they can be worn for both early and late war events.  Also acceptable are the M1943 Combat boots with the double buckles at the top.  We recommend purchasing authentic reproductions.
                        <br><br>
                        Leggings, M1938 dismounted, light OD.  These are required if the low quarter rough out boots are worn.
                        <br><br>
                        Jacket, Field M1941 or M1943.  Original M1941 jackets are expensive and hard to find in good condition, we recommend purchasing an authentic reproduction.
                        <br><br>
                        Cap, Garrison (a.k.a. Overseas cap), plain or with light blue piping.
                        <br><br>
                        Neck tie, khaki.  This is required for parades and use in a garrison setting such as events at Fort Indiantown Gap.
                        <br><br>
                        Eyeglasses : Round gold or silver metal frames are required.  Incorrect eyeware is the fastest way to destroy an authentic impression
                        <hr>
                        <h2>Items to Get Later</h2>

                        Knit cap, M1941 (Jeep cap).  Original M1941 caps are expensive and very hard to find in good condition, we recommend purchasing an authentic reproduction.  Stay away from the current issue green caps, the WWII versions were more brown in color.   This cap will only be worn underneath of the helmet and not as replacement for the Garrison cap (overseas cap).
                        <br><br>
                        Under shirts &amp; Under shorts, light OD, correct reproductions now exist so either they or original could be worn.  The shirt is to be the "tank top" version.  The current brown issue shirts shall not be worn unless they are totally covered up.
                        <br><br>
                        Socks, light OD wool/cotton cushion sole.
                        <br><br>
                        M1938 4 Pocket blouse (must have correct collar disc &amp; keystone patch).  The M1944 (a.k.a. Ike jacket) was not issued to the enlisted men until very late in the war.
                        <br><br>
                        "Class A" uniforms shall be void of all valor medals, achievement awards, and discharge patches (CIB, bronze stars, good conduct, etc).  The ETO ribbon may be worn as the Regiment was authorized to wear it in 1943.  As we portray the Regiment during the winter of 44 – 45, there shall be no more than two (2) campaign stars worn on the ETO ribbon.   As for overseas service stripes (Hershey Bars), no more than two shall be worn as each is for 6 months of overseas service and the Regiment did not arrive in Wales until October 1943.
                        <br><br>
                        If you have earned valor and/or achievement awards with service to our current military, then the WWII version may be worn.
                        <br><br>
                        Low Quarter Russet Service boot, Russet color to be worn with the Class A uniform.  A correct period Oxford type shoe may also be worn.
                        <br><br>
                        M1929 / M1942 Wool overcoat.  The M1939 will have brass buttons and the M1942 coat will have plastic buttons.
                        <br><br>
                        Sweater,  OD, 5 button, "V" neck, crew neck or vest.  Correct reproductions now exist for these or you can wear an original.  The modern issue sweater is not correct for our impression.
                        <br><br>
                         Scarf, OD knit wool.  In lieu of an actual scarf you could cut up an old worn out army blanket into long strips.
                        <br><br>
                        Gloves.  May either be the leather palmed wool gloves, which are being reproduced, or an OD wool knit type.
                        <br><br>
                        <hr>
                        <h2>Equipment</h2>

                        Helmet, M1 and liner, w/light OD web straps. Helmet must be dark OD in color and have the seam in the front with either fixed or swivel bales.  The webbing inside the liner will not be stitched together as this is post-war, the internal loops will be tied together with a cord.  Division insignia may be painted on the helmet.  However not many would have been seen as the war progressed as there were many replacements that entered the Division.  The chinstraps of the helmet must be SEWN and not clamped onto the metal loops of the shell.
                        <br><br>
                        M1 Garand, with reproduction M1907 leather sling or web sling with the FLAT keeper.  The keepers with the bump were post-war.  The M1 Carbine will be used by the officer only, unless prior arrangements have been made.
                        <br><br>
                        Bayonet,  (M1942, both the 10" and the cut down are acceptable).
                        <br><br>
                        Cartridge Belt,  M1910 or M1923, light OD or khaki.
                        <br><br>
                        Canteen, M1910 or M1942 with light OD cover and cup.
                        <br><br>
                        Pouch, First Aid, M1910 or M1942, light OD with Carlisle packet.
                        <br><br>
                        Haversack, M1910 or M1928 with meat can carrier, light OD.
                        <br><br>
                        Meat Can, M1910 or M1926 with M1926 utensils.
                        <br><br>
                        Entrenching tool, M1910  (T-handle shovel) with M1910 carrier, or a war dated M1943.
                        <br><br>
                        Shelter half,  Light OD single ended bell,  with pole, pins &amp; rope.  The single ended tent is preferred, however a War dated double bell half is also acceptable.  Snaps did not appear on the tents until after the Korean War.
                        <br><br>
                        M6 Army Lightweight service gas mask bag.  This good to carry rations and other small items with when in the field.
                        <br><br>
                        Blanket, wool light OD.  Do not get the dark green blankets.  For garrison events you will need two of them to make the bunk properly.
                        <br><br>
                        2 Bandoleers, light OD.  Must have the neat stitching not the zig-zag stitch of the post war version
                        <br><br>
                        The M1936 suspenders and mussette bag shall be worn by the officer only, unless prior arrangements have been made.  The cartridge belt may be either worn by itself or with the Haversack, both methods are proven through period photographs and accounts.
                        <br><br>
                        The bayonet and entrenching tool will be worn, either on the cartridge belt or on the haversack.  They carried them so we shall carry them.
                        <br><br>
                        As we portray a National Guard unit, World War One issue web equipment is also acceptable.
                        <br><br>
                        When purchasing equipment it is better to look for gear from the early part of the war, pre-1943.  These items will be more khaki in color, which is correct for our impression.  The dark OD green colored items were issued later in the war and should be avoided for our impression.
                        <br><br>
                        M1944 and M1945 field gear will not be worn.
                        <br><br>
                        <hr>
                        <h2>Other Approved Items</h2>
                        Dog Tags,  notched.
                        <br><br>
                        Watch, GI or civilian, correct style of the period.
                        <br><br>
                        Ditty Bag, OD.  Correct style of the period for carrying personal items.
                        <br><br>
                        Helmet net, with small holes.
                        <br><br>
                        Winter Combat (Tanker) Jacket.
                        <br><br>
                        M1938 Raincoat.
                        <br><br>
                        M1943 wool sleeping bag.
                        <br><br>
                        Mackinaw, any one of the three patterns
                        <br><br>
                        Duffel bag, single strap.  The double strap version is a modern issue.
                        <br><br>
                        Foot Locker, for garrison events to store items and a place to sit.
                        <br><br>
                        Herringbone Twill, Jacket, Trousers, and Hat.  These are good to have for the summer events.
                        <br><br>
            		</div>
                </div>

			</div>
			<div class="tab-pane" id="books">
				<div class="row">
					<div class="span11 well">
                         <center><h3>Reference Books</h3></center><br>
                         <h4 style="margin-bottom:0px;">Government Issue Collector's Guide   "U.S. Army European Theater of Operations"</h4>
                         <span style="float:right;margin-right:15px;"><p>by Henri-Paul Enjames</p></span>
                         <br>
                         <h4 style="margin-bottom:0px;">Doughboy to GI, US Army Clothing and Equipment 1900-1945</h4>
                         <span style="float:right;margin-right:15px;"><p>by Kenneth Lewis</p></span>
                         <br>
                         <h4 style="margin-bottom:0px;">The World War II GI, US Army Uniforms 1941-1945 in Color Photos</h4>
                         <span style="float:right;margin-right:15px;"><p>by Richard Windrow &amp; Tim Hawkins</p></span>
                         <br>

                         <h4 style="margin-bottom:0px;">US Infantry Weapons of World War II</h4>
                         <span style="float:right;margin-right:15px;"><p>by Bruce N. Canfield</p></span>
                         <br>

                         <h4 style="margin-bottom:0px;">US Army Handbook 1939-1945</h4>
                         <span style="float:right;margin-right:15px;"><p>by George Stanton</p></span>
                         <br>

                         <h4 style="margin-bottom:0px;">US Army Uniforms of World War II </h4>
                         <span style="float:right;margin-right:15px;"><p>by Shelby Stanton</p></span>
                         <br>

                         <h4 style="margin-bottom:0px;">Uniforms, Weapons of World War II GI </h4>
                         <span style="float:right;margin-right:15px;"><p>by Stephen Sylvia &amp; Michael O'Donnell</p></span>
                         <br><hr>
                         <center><h3>Personal Accounts</h3></center><br>
                         <h4 style="margin-bottom:0px;">G Company's War </h4>
                         <span style="float:right;margin-right:15px;"><p>by Bruce Egger &amp; Lee MacMillian Otts</p></span>
                         <br>
                         <h4 style="margin-bottom:0px;">There's a War to be won, The United States Army in World War II </h4>
                         <span style="float:right;margin-right:15px;"><p> by Geoffrey Perret</p></span>
                         <br>
                         <h4 style="margin-bottom:0px;">GI, the American Soldier in World War II </h4>
                         <span style="float:right;margin-right:15px;"><p>by Lee Kennett</p></span>
                         <br>
                         <h4 style="margin-bottom:0px;">Roll Me Over, an Infantryman's World War II </h4>
                         <span style="float:right;margin-right:15px;"><p>by Raymond Gantter</p></span>
                         <br>
                         <h4 style="margin-bottom:0px;">If You Survive</h4>
                         <span style="float:right;margin-right:15px;"><p>by George Wilson</p></span>
                         <br>
                         <h4 style="margin-bottom:0px;">Enemy North, South, East, West  </h4>
                         <span style="float:right;margin-right:15px;"><p> by Robert Weiss</p></span>
                         <br>
                         <h4 style="margin-bottom:0px;">The World Within War</h4>
                         <span style="float:right;margin-right:15px;"><p>by Gerald F, Linderman</p></span>
                         <br>
                         <h4 style="margin-bottom:0px;">Before Their Time</h4>
                         <span style="float:right;margin-right:15px;"><p>by Robert Kotlowitz</p></span>
                         <br>
                         <h4 style="margin-bottom:0px;">Company Commander, The classic Infantry Memoir of World War II</h4>
                         <span style="float:right;margin-right:15px;"><p>by Charles B. MacDonald</p></span>
                         <br>
                         <h4 style="margin-bottom:0px;">Closing with the Enemy, How GI's fought the War in Europe, 1941-1945</h4>
                         <span style="float:right;margin-right:15px;"><p>by Michael Doubler</p></span>
                         <br>
                         <h4 style="margin-bottom:0px;">The GI's War, American Soldier in Europe during World War II</h4>
                         <span style="float:right;margin-right:15px;"><p>by Edwin P. Hoyt</p></span>
                         <br>
                         <h4 style="margin-bottom:0px;">Overpaid, Oversexed, &amp; Over Her, The American GI in World War II Britian</h4>
                         <span style="float:right;margin-right:15px;"><p>by Juliet Gardiner</p></span>
                         <br>
                         <h4 style="margin-bottom:0px;">The Regiment, Let The Citizens Bear Arms</h4>
                         <span style="float:right;margin-right:15px;"><p>by Harry M. Kemp</p></span>
                         <br>
                         <h4 style="margin-bottom:0px;">To Save Bastonge </h4>
                         <span style="float:right;margin-right:15px;"><p>by Robert F. Phillips</p></span>
                         <br>
                         <h4 style="margin-bottom:0px;">The Deadly Brotherhood "The American Combat Soldier in World War II"</h4>
                         <span style="float:right;margin-right:15px;"><p>by John C. McManus</p></span>
                         <br>
                         <h4 style="margin-bottom:0px;">Infantry Soldier "Holding the line at the Battle Of the Bulge"</h4>
                         <span style="float:right;margin-right:15px;"><p>by George W. Neil</p></span>
                         <br>
                    </div>

            </div>
			</div>
			<div class="tab-pane" id="links">
				<div class="row">
					<div class="span11 well">
						<center><h2>Web Sites</h2></center>
							<hr />
							<center><p class="lead">WWII Impressions - Top quality reproduction American uniforms and footwear</p></center>
							<center><p><a target="_blank" href="http://www.wgn.net/~ww2imp">http://www.wgn.net/~ww2imp</a></p></center>

							<center><p class="lead">Military Marketplace - Specializes in WWI and WWII US items</p></center>
							<center><p><a target="_blank" href="http://www.militarymarketplace.com">http://www.militarymarketplace.com</a></p></center>

							<center><p class="lead">At The Front - Original and repro GI items</p></center>
							<center><p><a target="_blank" href="http://www.atthefront.com">http://www.atthefront.com</a></p></center>

							<center><p class="lead">The Battle of the Bulge site</p></center>
							<center><p><a target="_blank" href="http://www.wwiifederation.org">http://www.wwiifederation.org</a></p></center>

							<center><p class="lead">Prairie Flower Leather co.  "A good source for Kelly Helmet liners"</p></center>
							<center><p><a target="_blank" href="http://www.cornhusker.net/~pflc/">http://www.cornhusker.net/~pflc/</a></p></center>

							<center><p class="lead">Bayonet, Inc.   "Good Reproductions of US gear"</p></center>
							<center><p><a target="_blank" href="http://www.bayonetinc.com/">http://www.bayonetinc.com/</a></p></center>

							<center><p class="lead">World War 2 Ration Technologies  </p></center>
							<center><p><a target="_blank" href="http://www.ww2rationtechnologies.com/">http://www.ww2rationtechnologies.com/</a></p></center>

                            <center><p class="lead">WW2 Reproduction Paperwork</p></center>
							<center><p><a target="_blank" href="http://members.tripod.com/thirtieth_infantry/Repro/repropaperwork.html ">http://members.tripod.com/thirtieth_infantry/Repro/repropaperwork.html </a></p></center>

                            <center><p class="lead">M1940 Dog Tag Chain Reproductions</p></center>
							<center><p><a target="_blank" href="http://www.geocities.com/mambi66/m1940dogtagchainhome.html">http://www.geocities.com/mambi66/m1940dogtagchainhome.html</a></p></center>

                            <center><p class="lead">Good quality WWI and WWII US gear and clothing</p></center>
							<center><p><a target="_blank" href="http://aefsupply.com/">http://aefsupply.com/</a></p></center>

                            <center><p class="lead">What Price Glory - Original and Repro items</p></center>
							<center><p><a target="_blank" href="http://www.whatpriceglory.com/usunif.htm">http://www.whatpriceglory.com/usunif.htm</a></p></center>

                            <center><p class="lead">Stahlhelms Military Collectables</p></center>
							<center><p><a target="_blank" href="www.stahlhelms.com">www.stahlhelms.com</a></p></center>

                            <center><p class="lead">National Museum of Military History - Diekirch, Luxembourg</p></center>
							<center><p><a target="_blank" href="http://www.nat-military-museum.lu/">http://www.nat-military-museum.lu/</a></p></center>

                     	<hr /><center><h2>Allied Units</h2></center>

							<center><p class="lead">33rd Signal Construction Battalion</p></center>
							<center><p><a target="_blank" href="http://members.tripod.com/33rdscb/">http://members.tripod.com/33rdscb/</a></p></center>

                            <center><p class="lead">29th Division</p></center>
							<center><p><a target="_blank" href="http://www.29thdivision.com/">http://www.29thdivision.com/</a></p></center>

                            <center><p class="lead">26th Infantry Division</p></center>
							<center><p><a target="_blank" href="http://pages.cthome.net/yd104/">http://pages.cthome.net/yd104/</a></p></center>

                            <center><p class="lead">4th Infantry Division MP Platoon</p></center>
							<center><p><a target="_blank" href="http://ivydiv_mp.tripod.com/">http://ivydiv_mp.tripod.com/</a></p></center>

                            <center><p class="lead">45th Division - Pennsylvania</p></center>
							<center><p><a target="_blank" href="http://www.45thdivision.org/">http://www.45thdivision.org/</a></p></center>

                            <center><p class="lead">28th Division 110th</p></center>
							<center><p><a target="_blank" href="http://www.bloodybucket.com">http://www.bloodybucket.com</a></p></center>


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
		alert('made it');
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
