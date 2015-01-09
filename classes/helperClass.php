<?
class helper
{
	var $db = "";
	function helper()
	{
		$this -> db = new DBAccess();
	}	//	End of function users()	
	function get_team_details(){
		$q = "SELECT * FROM tbl_teams WHERE team_status = 1 AND team_id = ".$_SESSION['admin_team_id'];
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_user_info( $user_id, $status = 0 )
	
	
	function get_all_tours( ){
		$q = "SELECT * FROM tbl_tours WHERE tour_status = 1";
		$r = $this -> db -> getMultipleRecords( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_user_id_by_user_name( $user_name )
	
	
	function get_tour_info_by_tour_id( $tour_id ){
		$q = "SELECT * FROM tbl_tours WHERE tour_id = '".$tour_id."'";
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_user_id_by_user_name( $user_name )
	
	function get_check_list_type($tour_id){
		$q = "SELECT * FROM tbl_tour_form_checklists_manager WHERE checklist_status != '5' AND tour_id = ".$tour_id." AND team_id =".$_SESSION['admin_team_id'];
		$r = $this -> db -> getMultipleRecords( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_user_info( $user_id, $status = 0 )
	
		
	function get_check_list_type_for_admin($tour_id){
		$q = "SELECT * FROM tbl_tour_form_checklists_manager WHERE checklist_status != '5' AND tour_id = ".$tour_id;
		$r = $this -> db -> getMultipleRecords( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_user_info( $user_id, $status = 0 )

	function generateAutoString($length = 49)
	{
	  $autoString = "";
	  $possible = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
	  $i = 0; 
	  while ($i < $length) { 
	
		$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
			
		if (!strstr($autoString, $char)) { 
		  $autoString .= $char;
		  $i++;
		}
	  }
	  
	  return $autoString;
	}
		
}	//	End of class users
?>