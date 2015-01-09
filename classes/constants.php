<?
	error_reporting(0);
	$f = basename( $_SERVER['PHP_SELF'] );
	if( $f != "login.php" )
	{
		require_once("DBAccess.php");
		require_once("pagingClass.php");
		require_once("userAthentication.php");
		require_once("userClass.php");
		require_once("class.phpmailer.php");
		require_once("image.php");
		require_once("misc.php");
		require_once("helperClass.php");
	}	
	define("RECORDS_PER_PAGE", 20);
	define("NUMBERS_PER_PAGE", 20);
	
	define("COUNTIES_PER_PAGE", 30);
	define("COUNTIES_NUMBERS_PER_PAGE", 30);
	
	define("SITE_NAME", "Compass Tours CRM");
	define("SITE_HOME_URL", "http://localhost/compass/");
?>