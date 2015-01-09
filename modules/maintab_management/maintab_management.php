<? 
	$q = "SELECT * FROM modules WHERE module_status = 1 AND module_name = '".$module_name."'";
	$r = $db -> getSingleRecord( $q );
	
	if( $r != false )
	{
		require_once("classes/maintabClass.php");
		$file_name = isset( $_GET['file_name'] ) ? $_GET['file_name'] : "default";
	
		switch ( $file_name )
		{
			case "add_maintab":
				require_once("add_maintab.php");
			break;
			
			case "manage_maintabs":
				require_once("manage_maintabs.php");
			break;			
			
			case "vehicle_documents":
				require_once("vehicle_documents.php");
			break;	
			
			case "pre_toure_paperwork":
				require_once("pre_toure_paperwork.php");
			break;		
			
			case "vehicle_maintenance":
				require_once("vehicle_maintenance.php");
			break;
			
			case "post_tour":
				require_once("post_tour.php");
			break;
						
			case "default":
				require_once("default.php");
			break;
			
			default:
				require_once("default.php");
			break;
		}	//	End of switch ( $file_name )
	}
	else
	{
		echo "<p class='bad-msg' align='center'>Invalid Module</p>";
	}
?>
