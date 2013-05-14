<?
session_start();

$dbh=mysql_connect ("localhost", "noffutt", "beaver12")
or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db("hmi_site")or die( mysql_error());

$error = 0;


if ( $_POST['username'] ){
	
	$username = $_POST['username'];
	$password = $_POST['password'];

	$id= mysql_query("SELECT id FROM user WHERE username = '".$username."' AND password = '".$password."'");
	$name = mysql_query("SELECT name FROM user WHERE username = '".$username."' AND password = '".$password."'");
	$email = mysql_query("SELECT email FROM user WHERE username = '".$username."' AND password = '".$password."'");
	
	$row = mysql_fetch_row($id);
	$row2 = mysql_fetch_row($name);
	$row3 = mysql_fetch_row($email);
	
	if(!$row){ 
		session_destroy();
		$error = 1;
		
	}
	else{
		$_SESSION['user_id'] = $row[0];
		$_SESSION['user_name'] = $row2[0];
		$_SESSION['user_email'] = $row3[0];
		header("location:index.php");
	}
}
?>


<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign in &middot; Twitter Bootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/login.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->

  </head>

  <body>

    <div class="container">

      <form method="POST" class="form-signin" action="login.php">
        <h2 class="form-signin-heading">HMI Login</h2>
		
<?
		if ( $error == 1 ){
?>
		<div class="alert alert-error">
              <strong>Oops!</strong> It appears your login credentials are incorrect. Please try again.
        </div>
<?	
		}
?>
        <input name="username" type="text" class="input-block-level" placeholder="Username">
        <input name="password" type="password" class="input-block-level" placeholder="Password">
        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>

  </body>
</html>
