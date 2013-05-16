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
	<link href="/css/facebox.css" media="screen" rel="stylesheet" type="text/css"/>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">

          <a class="brand" href="/">Historical Military Impressions</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="/">Home</a></li>
              <li><a href="/pages/application.php">Membership Application</a></li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown">Members <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="/pages/ladies.php">Ladies of HMI</a></li>
                  <li class="active"><a href="/pages/merit-award.php">HMI Merit Award Winners</a></li>
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
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>



    <div class="container">

		<div class="row" style="margin-top:50px;">
            <div class="span4">
              <img class="lady-image" src="/images/ladies/AL__DIANE williamsburg.jpg" width="200px">
              <h2>Diane Lingsch</h2>
            </div>
        	<div class="span4">
              <img class="lady-image" src="/images/ladies/AlanaPennyVillageInn.jpg" width="200px">
              <h2>Penny & Alana  Otte</h2>
            </div>
        	<div class="span4">
              <img class="lady-image" src="/images/ladies/Alexis profile bw.jpg" width="200px">
              <h2>Alexis Lingenfelter</h2>
            </div>
      	</div>
        <hr class='featurette-divider' style='margin:30px 0px 30px 0px;'>
        <div class="row">
            <div class="span4">
              <img class="lady-image" src="/images/ladies/Barbara.jpg" width="200px">
              <h2>Barbara Lang</h2>
            </div>
        	<div class="span4">
              <img class="lady-image" src="/images/ladies/Donna 3.jpg" width="200px">
              <h2>Donna Moore</h2>
            </div>
        	<div class="span4">
              <img class="lady-image" src="/images/ladies/DSC01678.JPG" width="200px">
              <h2>Natalie & Virginia  Tanner</h2>
            </div>
      	</div>
        <hr class='featurette-divider' style='margin:30px 0px 30px 0px;'>
        <div class="row">
            <div class="span4">
              <img class="lady-image" src="/images/ladies/Joann_Bur.JPG" width="200px">
              <h2>Joann Kinter</h2>
            </div>
        	<div class="span4">
              <img class="lady-image" src="/images/ladies/Linda_Szathmary.jpg" width="200px">
              <h2>Linda Szathmary</h2>
            </div>
        	<div class="span4">
              <img class="lady-image" src="/images/ladies/Michele.jpg" width="200px">
              <h2>Michele Fuller</h2>
            </div>
      	</div>
        <hr class='featurette-divider' style='margin:30px 0px 30px 0px;'>
        <div class="row">
            <div class="span4">
              <img class="lady-image" src="/images/ladies/Sabrina.jpg" width="200px">
              <h2>Sabrina Chrzanowski</h2>
            </div>
        	<div class="span4">
              <img class="lady-image" src="/images/ladies/Stacy BTL.jpg" width="200px">
              <h2>Stacy Roth Niemeic</h2>
            </div>
        	<div class="span4">
              <img class="lady-image" src="/images/ladies/Wp_11.jpg" width="200px">
              <h2>Jennifer Bradley</h2>
            </div>
      	</div>
        <hr class='featurette-divider' style='margin:30px 0px 30px 0px;'>
        <div class="row">
        	<div class="span4">
              <img class="lady-image" src="/images/ladies/Ashley.jpg" width="200px">
              <h2>Ashley Fuller</h2>
            </div>
            <div class="span4">
              <img class="lady-image" src="/images/ladies/FIG 2012 CAO Niemic Pic.jpg" width="200px">
              <h2>Chris Offutt</h2>
            </div>
            <div class="span4">
              <img class="lady-image" src="/images/ladies/Olga CB 2005.jpg" width="200px">
              <h2>Olga Leake</h2>
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
</body>
</html>
