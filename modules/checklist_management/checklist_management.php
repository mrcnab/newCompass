<? 
	$q = "SELECT * FROM modules WHERE module_status = 1 AND module_name = '".$module_name."'";
	$r = $db -> getSingleRecord( $q );
	
	if( $r != false )
	{
		require_once("classes/checklistClass.php");
		$file_name = isset( $_GET['file_name'] ) ? $_GET['file_name'] : "default";
	
		switch ( $file_name )
		{
			case "add_checklist":
				require_once("add_checklist.php");
			break;
			
			case "manage_checklists":
				require_once("manage_checklists.php");
			break;
			
			case "manage_updatechecks":
				require_once("manage_updatechecks.php");
			break;
			
			default:
				require_once("manage_checklists.php");
			break;
		}	//	End of switch ( $file_name )
	}
	else
	{
		echo "<p class='bad-msg' align='center'>Invalid Module</p>";
	}
?>
