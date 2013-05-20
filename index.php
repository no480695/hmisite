<?
session_start();
$ERA_ID = 6;

//GET ALL TEH INFORMATION FROM DATABASE BASED ON ERA GIVEN ABOVE AND GET ARRAYS AND SUCH FOR EVENTS

//Test of the git system

/*
 HERE IS AN IDEA MAYBE FIX YOUR DATABASE?

 Currently you can't connect to mysql with user hmisite and plain text? password beaver12
*/
$dbh=mysql_connect ("localhost", "noffutt", "beaver12")
or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db("hmi_site")or die( mysql_error());

?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Historical Military Impressions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/landing.css" rel="stylesheet">


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-39302959-1']);
  _gaq.push(['_setDomainName', 'hmisite.com']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
  </head>

  <body>



    <!-- NAVBAR
    ================================================== -->
    <!-- Wrap the .navbar in .container to center it on the page and provide easy way to target it with .navbar-wrapper. -->
    <div class="container navbar-wrapper">

      <div class="navbar navbar-inverse">
        <div class="navbar-inner">
          <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="/">Historical Military Impressions</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="/">Home</a></li>
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

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Impressions <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="/pages/era/wwii.php">World War Two</a></li>
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
                  <li><a href="/logout.php">Sign Out</a></li>
                </ul>
              </li>
			  <? } else { ?>
			  <li><a href='/login.php'>Sign In</a></li>
			  <? } ?>
            <li><a href='https://www.facebook.com/pages/Historical-Military-Impressions/175875785785507'><img src="/images/facebook-icon.gif" style="width:20px;" /></a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!-- /.navbar-inner -->
      </div><!-- /.navbar -->

    </div><!-- /.container -->



    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" style="width:1170px;height:377px;margin:0 auto;margin-top:80px;border-radius:8px">
      <div class="carousel-inner" style="width:1170px;height:377px;margin:0 auto;">
        <div class="item active">
          <img src="images/landing/SacketsHarbor0092.jpg" alt="" height="377px">
          <div class="container">
            <div class="carousel-caption" style="margin-bottom:335px;margin-left:40px">
              <h1>Welcome!</h1>
              <p class="lead">Please take the time and look at the different impressions listed below. We are ready to answer any of your questions and help you get started.</p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="images/landing/Barracks20092.jpg" alt="">
          <div class="container">
            <div class="carousel-caption" style="margin-bottom:410px;margin-left:300px;">
              <h1>Reenact in the Mid-Atlantic</h1>
              <p class="lead">Our members are located in Pa., NJ, MD, Va.</p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="images/landing/Takefive2.jpg" alt="">
          <div class="container">
            <div class="carousel-caption" style="margin-bottom:270px;margin-left:350px;">
              <h1>HMI has over 100 members.</h1>
              <p class="lead">We are a growing organization that is always looking for new and interested members to take part and help make our impressions even better.</p>
              <a class="btn btn-large btn-primary" href="pages/application.php">Apply Online</a>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div><!-- /.carousel -->



    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->
    <div class="container alert alert-success" style="margin: 20px auto;width: 1120px;">
  <div style="float:left">For the Paoli event registration, please follow the link to the right and read further instructions.</div><a href="/pages/paoli-registration.php" style="float:right;" class="btn btn-large">Paoli Registration Page</a>
</div>
    <div class="container marketing">

	  <div class="featurette" style="padding-top:20px;">
        <!--<img class="featurette-image pull-right" src="../assets/img/examples/browser-icon-chrome.png">-->
        <h2 class="featurette-heading">Historical Military Impressions <span class="muted">"Proud to be American"</span></h2>
        <p class="lead">HMI was founded in the fall of 1979.  We are charted through the state of Pa. as a non profit educational organization.  Our goal is to portray the life and times of the American men and women who served in the Armed Forces from Pre-Revolutionary times to the present.  Inside this site will give you some idea and a brief description of the units portrayed and re-enacted by HMI members. HMI has twice received the Valley Forge Freedoms Foundation Award for portrayal of the fighting men and women in the History of the United State.</p>
      </div>

      <hr class="featurette-divider" style="margin:30px 0px 30px 0px;">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="span4">
          <img class="img" src="images/landing/wwii_icon.png" width="200px">
          <h2>World War Two</h2>
          <p>Co. L  109th Infantry 28th Div.</p>
          <p><a class="btn" href="pages/era/wwii.php">View details &raquo;</a></p>
        </div><!-- /.span4 -->
        <div class="span4">
          <img class="img" src="images/landing/wwi_icon.png" width="200px">
          <h2>World War One</h2>
          <p>Co. M  109th Infantry 28th Div.</p>
          <p><a class="btn" href="pages/era/wwi.php">View details &raquo;</a></p>
        </div><!-- /.span4 -->
        <div class="span4">
          <img class="img" src="images/landing/civilwar_icon.png" width="200px">
          <h2>Civil War</h2>
          <p>110th Pa Volunteer Infantry</p>
          <p><a class="btn" href="pages/era/civilwar.php">View details &raquo;</a></p>
        </div><!-- /.span4 -->
      </div><!-- /.row -->

	  <div class="row" style="padding-top:30px;">
        <div class="span4">
          <img class="img" src="images/landing/1812_icon.png" width="100px">
          <h2>War of 1812</h2>
          <p>The Marines</p>
          <p><a class="btn" href="pages/era/1812.php">View details &raquo;</a></p>
        </div><!-- /.span4 -->
        <div class="span4">
          <img class="img" src="images/landing/revwar_icon.png" width="200px">
          <h2>Revolutionary War</h2>
          <p>3rd Pa. Light Infantry</p>
          <p><a class="btn" href="pages/era/revwar.php">View details &raquo;</a></p>
        </div><!-- /.span4 -->
        <div class="span4">
          <img class="img" src="images/landing/frech_cap.png" width="200px">
          <h2>French and Indian War</h2>
          <p>Robert Roger's Company of Rangers</p>
          <p><a class="btn" href="pages/era/french&indian.php">View details &raquo;</a></p>
        </div><!-- /.span4 -->
      </div><!-- /.row -->

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->


    </div><!-- /.container -->

	<footer class="footer">
		<div class="container">
			<p class="pull-right"><a href="#">Back to top</a></p>
			<p>&copy; 2012 Historic Military Impressions. &middot;</p>
		</div>
    </footer>



    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/landing.js"></script>
    <script>
      !function ($) {
        $(function(){
          // carousel demo
          $('#myCarousel').carousel()
        })
      }(window.jQuery)
    </script>
  </body>
</html>
