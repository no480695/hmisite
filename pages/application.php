<?
session_start();
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
	
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

  <body>
  
	<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h3 id="myModalLabel">Thank you for your application!</h3>
	  </div>
	  <div class="modal-body">
		<p>Your information has been sent to the organization directly and we will be getting back to you as soon as possible. We look forward to having you be a part of HMI</p>
	  </div>
	  <div class="modal-footer">
		<button id="submit-form" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
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
              <li class="active"><a href="/pages/application.php">Membership Application</a></li>
			  <li><a href="/pages/newsletter.php">Newsletter</a></li>
			  <li><a href="/pages/directory.php">Directory</a></li>
              <!-- Read about Bootstrap dropdowns at http://twitter.github.com/bootstrap/javascript.html#dropdowns -->
              <li class="dropdown">
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
		<div id="application">	
			<form class="form-horizontal" id="application-form">
				<fieldset>
					<legend>Application for Membership</legend>
                    <div class="row">
                    <div class="span2">
                    <small><span style="color:#993333;font-weight:700;">*</span> indicates required field.</small>
                    </div>
                    <div class="span8">
					  <div class="control-group">
						<label class="control-label" for="full_name">Full Name <span style="color:#993333;font-weight:700;">*</span></label>
						<div class="controls">
						  <input class="span4 required" type="text" style="height:30px;" id="full_name" name="full_name" placeholder="First and Last">
						</div>
					  </div>
					  
					  <div class="control-group">
						<label class="control-label" for="address">Address <span style="color:#993333;font-weight:700;">*</span></label>
						<div class="controls">
						  <input class="span4 required" type="text" style="height:30px;" id="address" name="address" placeholder="Address Line 1">
						</div>
					  </div>
					  
					  <div class="control-group">
						<div class="controls">
						  <input class="span4" type="text" style="height:30px;" id="address2" name="address2" placeholder="Address Line 2">
						</div>
					  </div>
					  
					  <div class="control-group">
						<div class="controls controls-row">
						  <input class="span2 required" type="text" style="height:30px;" id="city" name="city" placeholder="City">
						  <select class="span2 required" style="height:30px;" id="state" name="state">
							<option value="">State</option>
							<option value="AL">Alabama</option> 
							<option value="AK">Alaska</option> 
							<option value="AZ">Arizona</option> 
							<option value="AR">Arkansas</option> 
							<option value="CA">California</option> 
							<option value="CO">Colorado</option> 
							<option value="CT">Connecticut</option> 
							<option value="DE">Delaware</option> 
							<option value="DC">District Of Columbia</option> 
							<option value="FL">Florida</option> 
							<option value="GA">Georgia</option> 
							<option value="HI">Hawaii</option> 
							<option value="ID">Idaho</option> 
							<option value="IL">Illinois</option> 
							<option value="IN">Indiana</option> 
							<option value="IA">Iowa</option> 
							<option value="KS">Kansas</option> 
							<option value="KY">Kentucky</option> 
							<option value="LA">Louisiana</option> 
							<option value="ME">Maine</option> 
							<option value="MD">Maryland</option> 
							<option value="MA">Massachusetts</option> 
							<option value="MI">Michigan</option> 
							<option value="MN">Minnesota</option> 
							<option value="MS">Mississippi</option> 
							<option value="MO">Missouri</option> 
							<option value="MT">Montana</option> 
							<option value="NE">Nebraska</option> 
							<option value="NV">Nevada</option> 
							<option value="NH">New Hampshire</option> 
							<option value="NJ">New Jersey</option> 
							<option value="NM">New Mexico</option> 
							<option value="NY">New York</option> 
							<option value="NC">North Carolina</option> 
							<option value="ND">North Dakota</option> 
							<option value="OH">Ohio</option> 
							<option value="OK">Oklahoma</option> 
							<option value="OR">Oregon</option> 
							<option value="PA">Pennsylvania</option> 
							<option value="RI">Rhode Island</option> 
							<option value="SC">South Carolina</option> 
							<option value="SD">South Dakota</option> 
							<option value="TN">Tennessee</option> 
							<option value="TX">Texas</option> 
							<option value="UT">Utah</option> 
							<option value="VT">Vermont</option> 
							<option value="VA">Virginia</option> 
							<option value="WA">Washington</option> 
							<option value="WV">West Virginia</option> 
							<option value="WI">Wisconsin</option> 
							<option value="WY">Wyoming</option>
						  </select>
						  <input class="span1 required" type="text" style="height:30px;" id="zip" name="zip" placeholder="Zip">
						</div>
					  </div>
					  
					  <div class="control-group">
						<label class="control-label" for="phone">Phone <span style="color:#993333;font-weight:700;">*</span></label>
						<div class="controls">
						  <input class="span3 required" type="text" style="height:30px;" id="phone" name="phone" placeholder="(xxx) xxx-xxxx">
						</div>
					  </div>
					  
					  <div class="control-group">
						<label class="control-label" for="birth">Date of Birth <span style="color:#993333;font-weight:700;">*</span></label>
						<div class="controls">
						  <input class="span3 required" type="text" style="height:30px;" id="birth" name="birth" placeholder="MM/DD/YYYY">
						</div>
					  </div>
					  
					  <div class="control-group">
						<label class="control-label" for="email">Email <span style="color:#993333;font-weight:700;">*</span></label>
						<div class="controls">
						  <input class="span3 required" type="text" style="height:30px;" id="email" name="email" placeholder="Email Address">
						</div>
					  </div>
					  
					  <div class="control-group">
						<div class="controls">
						  Please check off the time period(s) you are interested in doing.
						</div>
					  </div>
					  
					  <div class="control-group">
						<div class="controls">
						  <label class="checkbox">
							<input type="checkbox" id="fandi" name="fandi"> French & Indian
						  </label>
						  
						  <label class="checkbox">
							<input type="checkbox" id="rev" name="rev"> Revolutionary War
						  </label>
						  
						  <label class="checkbox">
							<input type="checkbox" id="1812" name="1812"> War of 1812
						  </label>
						  
						  <label class="checkbox">
							<input type="checkbox" id="civ" name="civ"> Civil War
						  </label>
						  
						  <label class="checkbox">
							<input type="checkbox" id="wwi" name="wwi"> World War I
						  </label>
						  
						  <label class="checkbox">
							<input type="checkbox" id="wwii" name="wwii"> World War II
						  </label>
						</div>
					  </div>
					  
					  <div class="control-group">
					  <label class="control-label" for="spouse">Will your spouse participate?</label>
						<div class="controls controls-row">
						  <select class="span2" style="height:30px;" id="spouse" name="spouse">
							<option value="">---</option>
							<option value="yes">Yes</option> 
							<option value="no">No</option> 
						  </select>
						</div>
					  </div>
					  
					  <div class="control-group">
					  <label class="control-label" for="acquinated">Are you acquainted with anyone from HMI?</label>
						<div class="controls controls-row">
						  <input class="span3" type="text" style="height:30px;" id="acquainted" name="acquainted" placeholder="Yes ( Full Name ) / No">
						</div>
					  </div>
					  
					<h5>Dues are $25 a year, please send your check made out to Historical Military Impression to:</h5>
					<address style="padding-left:40px;">
					  <strong>Wayne Fuller</strong><br>
					  3 Meadow Lane<br>
					  Mt. Holly, NJ 08060<br>
					  Make checks payable to HMI<br>
					</address>
					<h5>Please mail your check to the address above.</h5>
                    </div>
					</div>
				</fieldset>
			</form>
			
					<div class="form-actions" style="padding-left:200px;">
					<a href="#myModal" role="button" class="btn btn-primary" id="submit-info" data-toggle="modal">Submit Information</a>
					  <button type="button" class="btn">Cancel</button>
					</div>
		
		</div>
		<div class="well" id="thanks-message" style="margin:0 auto;width:300px;display:none;margin-top:100px;">
			<a href="" class="btn btn-large btn-block btn-primary" type="button">Proceed to Home Page</a>
			<a href="/pages/application.php" class="btn btn-large btn-block" type="button">Reload Application</a>
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
    <script src="/js/bootstrap.js"></script>
	<script type="text/javascript" src="/js/jquery-ui-1.8.21.custom.min.js"></script>
	<script type="text/javascript" src="/js/date-time.js"></script>
	<script type="text/javascript" src="/js/cal.js"></script>
	<script type="text/javascript">
		$(function(){
			$('#submit-form2').live('click',function(){
				$('#application').fadeOut('fast',function(){
					$('#thanks-message').fadeIn('fast');
				});
			});
			
			$('#submit-info').click(function(){
				
				var all_filled = 0;
				
				$('.required').each(function(){
					
					if ($(this).val() == "" ){
						all_filled = 1;
						$(this).css('background-color','#E6D8D8');
					}
					else{
						$(this).css('background-color','#fff');
					}
				});
				
				if ( all_filled == 1 ){
					$('#myModal').html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button><h3 id="myModalLabel">Application Error</h3></div><div class="modal-body"><p>Please fill in all required fields amd try again.</p></div><div class="modal-footer"><button id="submit-form" class="btn" data-dismiss="modal" aria-hidden="true">Close</button></div>');
				}
				else{
					data = $('#application-form').serializeArray();
					$.post('send-application.php',data);
					$('#myModal').html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button><h3 id="myModalLabel">Thank you for your application!</h3></div><div class="modal-body"><p>Your information has been sent to the organization directly and we will be getting back to you as soon as possible. We look forward to having you be a part of HMI</p></div><div class="modal-footer"><button id="submit-form2" class="btn" data-dismiss="modal" aria-hidden="true">Close</button></div>');
				}
				
			});
		});
	</script>
  </body>
</html>
