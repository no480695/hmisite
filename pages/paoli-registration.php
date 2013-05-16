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
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
	<h3>Copy and paste the following into an email, and attach a copy of your unit's insurance form. Then email the form to hmisecretary@comcast.net</h3>
	<div class="well">
		<h4 style="font-size: 24px;color: rgb(130, 130, 130);">Unit Name:</h4>
		<h4 style="font-size: 24px;color: rgb(130, 130, 130);">Unit Description:</h4>
		<h4 style="font-size: 24px;color: rgb(130, 130, 130);">Time Period:</h4>
		<br />
		<h4 style="font-size: 24px;">Contact Information</h4><hr />
		<h4 style="color: rgb(130, 130, 130);">Name:</h4>
                <h4 style="color: rgb(130, 130, 130);">Address:</h4>
                <h4 style="color: rgb(130, 130, 130);">City, State, Zip:</h4>
		<h4 style="color: rgb(130, 130, 130);">Day Phone:</h4>
                <h4 style="color: rgb(130, 130, 130);">Cell Phone:</h4>
                <h4 style="color: rgb(130, 130, 130);">Email:</h4>
		<h4 style="color: rgb(130, 130, 130);">Website Address:</h4>
                <h4 style="color: rgb(130, 130, 130);">Number Attending (total):</h4>
                <h4 style="color: rgb(130, 130, 130);">Type of Presentation (cooking, payroll muster, cavalry, static display, etc.):</h4>
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
