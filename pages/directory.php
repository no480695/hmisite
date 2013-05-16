<?
session_start();

if ( !$_SESSION['user_name'] ){
	header("Location: http://hmisite.com/login.php");
}

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
              <li><a href="/pages/application.php">Membership Application</a></li>

              <li class="dropdown active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Members <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="/pages/ladies.php">Ladies of HMI</a></li>
                  <li><a href="/pages/merit-award.php">HMI Merit Award Winners</a></li>
                  <li><a href="/pages/newsletter.php">Newsletter</a></li>
                  <li class="active"><a href="/pages/directory.php">Directory</a></li>
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
			<h2>Membership Directory</h2>
			<?

				include("process.php");

			?>

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
			$('#submit-form').click(function(){
				$('#application').fadeOut('fast',function(){
					$('#thanks-message').fadeIn('fast');
				});
			});

			$('#submit-info').click(function(){
				alert('now send to ajax call');
			});
		});
	</script>
  </body>
</html>
