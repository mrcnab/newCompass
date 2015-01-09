<? 
	$q = "SELECT * FROM modules WHERE module_status = 1 AND module_name = '".$module_name."'";
	$r = $db -> getSingleRecord( $q );
	
	if( $r != false )
	{
		require_once("classes/crewpretourchecklistClass.php");
		$file_name = isset( $_GET['file_name'] ) ? $_GET['file_name'] : "default";
	
		switch ( $file_name )
		{
			case "add_crewpretourchecklist":
				require_once("add_crewpretourchecklist.php");
			break;
			
			case "manage_crewpretourchecklists":
				require_once("manage_crewpretourchecklists.php");
			break;
			
			default:
				require_once("manage_crewpretourchecklists.php");
			break;
		}	//	End of switch ( $file_name )
	}
	else
	{
		echo "<p class='bad-msg' align='center'>Invalid Module</p>";
	}
?>
