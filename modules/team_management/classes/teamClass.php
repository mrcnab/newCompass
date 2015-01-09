<?
class teams
{
	var $db = "";
	function teams()
	{
		$this -> db = new DBAccess();
	}	//	End of function team()
	
	function get_team_info( $team_id, $status = 0 )
	{
		$criteria = $status == 1 ? "team_status = 1 AND " : "";
		$q = "SELECT * FROM tbl_teams WHERE ".$criteria." team_id = ".$team_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_team_info( $team_id, $status = 0 )
	
	function get_employee_info( $employee_id, $status = 0 )
	{
		$criteria = $status == 1 ? "employee_status = 1 AND " : "";
		$q = "SELECT * FROM tbl_employees WHERE ".$criteria." employee_id = ".$employee_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_employee_info( $employee_id, $status = 0 )
	
	
	function get_tour_info( $tour_id, $status = 0 )
	{
		$criteria = $status == 1 ? "tour_status = 1 AND " : "";
		$q = "SELECT * FROM tbl_tours WHERE ".$criteria." tour_id = ".$tour_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_tour_info( $tour_id, $status = 0 )
	
	function get_user_login_details( $team_id)
	{
		$q = "SELECT * FROM users WHERE team_id = ".$team_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_team_info( $team_id, $status = 0 )
	
	function checkTeamMember($employee_id, $team_id)
	{
		$q = "SELECT * FROM tbl_employe_to_team WHERE employee_id = ".$employee_id." AND team_id = ".$team_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_tour_info( $tour_id, $status = 0 )
		
	function get_team_employees($team_id)
	{
		$q = "SELECT * FROM tbl_employe_to_team WHERE team_id = ".$team_id;
		$r = $this -> db -> getMultipleRecords( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_tour_info( $tour_id, $status = 0 )
	
	function get_available_employees()
	{
		$q = "SELECT * FROM tbl_employees WHERE employee_status = 1 AND available = 1";
		$r = $this -> db -> getMultipleRecords( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_team_info( $team_id, $status = 0 )
	
	function get_team_status( $team_id )
	{
		$q = "SELECT team_status FROM tbl_teams WHERE team_id = ".$team_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r['team_status'];
		else
			return false;
	}	//	End of function get_team_status( $team_id )
	
	function send_team_email( $team_id )
	{


		$teamLoginDetails = $this -> get_user_login_details( $team_id );
		$loginUsername	=	$teamLoginDetails['user_name'];
		$loginPassword	=	$teamLoginDetails['user_password'];



		$getTeamDetails	=	$this->get_team_info($team_id);
		$teamTitle	= $getTeamDetails['team_name'];		
		$getAllEmployeesID	=	$this->get_team_employees($team_id);
		$getTourDetails	=	$this->get_tour_info($getTeamDetails['tour_id']);
		$tourName	=	$getTourDetails['tour_name'];
		
		$email_content = $this ->select_email();
		$admin_email =	$email_content['user_email'];

	
		foreach($getAllEmployeesID as $employeesID){
			$employeId	=	$employeesID['employee_id'];
			$getEmployeDetail	=	$this->get_employee_info($employeId);
			$employeeFullName	=	$getEmployeDetail['employee_full_name'];
			$employeeEmail	=	$getEmployeDetail['employee_email'];
		
			$emailBody	=	"<table width='765' border='0' align='center' cellpadding='0' cellspacing='0' style='border:0px solid #41ad49;'>
				  <tr>
					<td>
					<table width='100%' border='0' align='center'>
				   <tr>
					<td style=' font-family: Verdana, Arial, Helvetica, sans-serif;text-align:center;
				font-style: normal;text-decoration: none;background-color: #DBEAF9;vertical-align:middle;color:#000000;font-size:20px;font-weight: bold; height:40px;'>Compass CRM</td>
				  </tr>
				  <tr>
					<td style='font-family: Verdana, Arial, Helvetica, sans-serif;
				font-style: normal;text-decoration: none;background-color: #EFEFEF; overflow:scroll; vertical-align:middle;height:40px;color:#666666;font-size:15px;font-weight: bold;'>&nbsp;&nbsp;Login detail for ".$teamTitle." Team</td>
				  </tr>
				  
				  <tr>
					<td align='center'><table width='95%' border='0' align='center' cellpadding='0' cellspacing='0' bgcolor='#ffffff' style='color:#666666'>
					  <tr font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 11px;font-style: normal;color:#90b9c0;text-decoration: none;background-color: #ffffff;vertical-align:middle;text-align:left;height:20px;text-indent:10px;>
						<td colspan='2'>Hi ".$employeeFullName.",<br />
						Admin assign you ".$teamTitle." Team for the tour ".$tourName."<br />
						Below are Login Detail For your team.
						</td>
					  </tr> 
				
				
				
					  <tr font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 11px;font-style: normal;color:#90b9c0;text-decoration: none;background-color: #ffffff;vertical-align:middle;text-align:left;height:20px;text-indent:10px;>
						<td width='70'  style='font-weight:bold;' height='25'>Username:</td>
						<td width='556' align='left' style='font-weight:bold;'>".$loginUsername."</td>
					  </tr>
					  <tr font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 11px;font-style: normal;color:#90b9c0;text-decoration: none;background-color: #ffffff;vertical-align:middle;text-align:left;height:20px;text-indent:10px;>
						<td style='font-weight:bold;' height='25'>Password:</td>
						<td align='left' style='font-weight:bold;'>".$loginPassword."</td>
					  </tr> 
					
                    <tr font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 11px;font-style: normal;color:#90b9c0;text-decoration: none;background-color: #ffffff;vertical-align:middle;text-align:left;height:20px;text-indent:10px;>
						<td colspan='2'>Click on this link to sign in &nbsp; <a href='http://wmedesigns.com.au/compass/'>Compass CRM</a>
						</td>
					  </tr> 
                      <tr font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 11px;font-style: normal;color:#90b9c0;text-decoration: none;background-color: #ffffff;vertical-align:middle;text-align:left;height:20px;text-indent:10px;>
						<td colspan='2'>&nbsp;</a>
						</td>
					  </tr> 
					  </table>
					</td>
				  </tr>
				</table></td>
				  </tr>				  
				  <tr>
					<td><table width='100%' align='center' border='0' cellspacing='0' cellpadding='0'>
				  <tr>
						<td colspan='2' nowrap='nowrap' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 11px;font-style: normal;color: #999999;text-decoration: none;background-color: #DBEAF9;vertical-align:middle;text-align:center;height:30px;'>&nbsp;&nbsp;&nbsp;All rights reserved to <span  style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;font-weight: bold;color:#ffffff;text-decoration: none; ' ><a href='#' style='font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;font-weight: bold;color:#000000;text-decoration: none; ' target='_blank' >Compass CRM</a></span></td>
				  </tr>
					 </table>
					</td>
				  </tr>
				</table>";
			
			$mail = new PHPMailer();
			$mail->AddReplyTo($admin_email,"Compass CRM Admin");
			$mail->WordWrap = 50;                              // set word wrap
			$mail->IsHTML(true);                               // send as HTML
			$mail->From     = $admin_email;
			$mail->FromName = "Compass CRM Admin";
			$mail->Subject  = $teamTitle." Login Detail";
			$mail->Body = $emailBody;
			$mail->AddAddress($employeeEmail, $employeeFullName);
			$mail->Send();	
		
		}


	}	//	End of function set_team_status( $status, $team_id )
	function select_email()
	{
		$qry = "SELECT * FROM users WHERE user_type = 1";
		return $this -> db -> getSingleRecord($qry);
	}	
	function set_team_status( $team_id )
	{
		$status = $this -> get_team_status( $team_id );
		$status = $status == 1 ? 0 : 1;
		$q = "UPDATE tbl_teams SET team_status = ".$status." WHERE team_id = ".$team_id;
		$r = $this -> db -> updateRecord( $q );
		if( $r != false )
			return true;
		else
			return false;
	}	//	End of function set_team_status( $status, $team_id )
	
	function addEmployeerToTeam( $userId,$lastInsertedTeamId){
	$q = "INSERT INTO tbl_employe_to_team (`employee_id`, `team_id`, `addeddate`)		
			 VALUES('".$userId."', '".$lastInsertedTeamId."',  '".date('Y-m-d H:i:s')."')";		
			$r = $this -> db ->insertRecord( $q );					
			if( $r )
				return true;
			else
				return false;				
	}
	
	function addTeamLoginDetails( $user_name,$user_password,$lastInsertedTeamId){
		$getTeamDetails	=	$this->get_team_info($lastInsertedTeamId);
	$q = "INSERT INTO users (`user_type`,`team_id`, `user_name`, `user_password`, `first_name`,  `user_status`, `addeddate`)		
			 VALUES('2', '".$lastInsertedTeamId."', '".$user_name."', '".$user_password."', '".$getTeamDetails['team_name']."', '1', '".date('Y-m-d H:i:s')."')";		
			$r = $this -> db ->insertRecord( $q );					
			if( $r )
				return true;
			else
				return false;				
	}
	function updateTeamLoginDetails( $user_name,$user_password,$team_id){
		$q =  $q = "UPDATE users SET `user_name` = '".$user_name."', `user_password` = '".$user_password."', `modifieddate` = '".date('Y-m-d H:i:s')."'
	 				WHERE team_id = ".$team_id;	
	$r = $this -> db ->insertRecord( $q );					
			if( $r )
				return true;
			else
				return false;				
	}
	
	
	function add_team($team_name, $tour_id, $member_to_teamArray, $user_name, $user_password)
	{
			$q = "INSERT INTO tbl_teams(`team_name`, `tour_id`, `addeddate`)  VALUES('".$team_name."', '".$tour_id."', '".date('Y-m-d H:i:s')."')";
			$r = $this -> db -> insertRecord( $q );
			$lastInsertedTeamId 	= $this -> db ->getNewId();
			foreach($member_to_teamArray as $members){
				$userId	=	$members;
				$addEmployerTeamRecord	=	$this->addEmployeerToTeam($userId,$lastInsertedTeamId);	
			}
			$saveTeamLoginDetails	=	$this->addTeamLoginDetails($user_name,$user_password, $lastInsertedTeamId);			
			if( $r != false )
				return true;
			else
				return false;
		
	}	//	End of function add_team()

	
	function update_team( $team_name, $tour_id, $member_to_teamArray, $user_name, $user_password, $team_id )
	{	
		$q = "UPDATE tbl_teams SET `team_name` = '".$team_name."', `tour_id` = '".$tour_id."',`modifieddate` = '".date('Y-m-d H:i:s')."' WHERE team_id = ".$team_id;
		$delPreviousEntriesEmployees	=	$this->delete_members_in_team($team_id);
		foreach($member_to_teamArray as $members){
				$userId	=	$members;
				$addEmployerTeamRecord	=	$this->addEmployeerToTeam($userId,$team_id);	
		}
		$saveTeamLoginDetails	=	$this->updateTeamLoginDetails($user_name,$user_password, $team_id);
		
		$r = $this -> db -> updateRecord( $q );
		if( $r != false )
			return true;
		else
			return false;
	}	//	End of function  update_team( )
	
	function delete_members_in_team( $team_id )
	{
		$q = "DELETE FROM tbl_employe_to_team WHERE team_id = ".$team_id;
		$r = $this -> db -> deleteRecord( $q );
		if( $r )
			return true;
		else
			return false;			
	}	//	End of function delete_team( $team_id )
	
	function delete_team( $team_id )
	{
		$q = "DELETE FROM tbl_teams WHERE team_id = ".$team_id;
		$r = $this -> db -> deleteRecord( $q );
		if( $r )
			return true;
		else
			return false;			
	}	//	End of function delete_team( $team_id )
	
	function display_teams_listing( $title_dev_team_listing_records, $page_link, $pageno )
	{
		if( $title_dev_team_listing_records != false )
		{
			$sr = ($pageno * RECORDS_PER_PAGE) - RECORDS_PER_PAGE +1;
			for( $i = 0; $i < count( $title_dev_team_listing_records ); $i++ )
			{
				$team_id = $title_dev_team_listing_records[$i]['team_id'];
				$tourDetails	=	$this->get_tour_info($title_dev_team_listing_records[$i]['tour_id']);	
			
				$status = $title_dev_team_listing_records[$i]['team_status'] == 1 ? "<a href='".$page_link."&amp;team_id=".$team_id."&amp;action=change_status&amp;tab=team'  title='In Active'><span class='active'><img src='images/active.png' alt='Active' border='0'></span></a>" : "<a class='inactive' href='".$page_link."&amp;team_id=".$team_id."&amp;action=change_status&amp;tab=team' title='Active'><span class='inactive'><img src='images/inactive.png' alt='Inactive' border='0'></span></a>";
				
				$edit_link = "<a class='mislink' href='index.php?module_name=team_management&amp;file_name=add_team&amp;team_id=".$team_id."&amp;tab=team' title='Edit'><img src='images/edit.png' alt='Edit' border='0'></a>";
				
				$delete_link = "<a class='mislink' title='Delete' href='javascript:void(0);' onclick='javascript: if( confirm(\"Are you sure to delete?\") ) { window.location= \"".$page_link."&amp;action=delete&amp;tab=team&amp;team_id=".$team_id."\"; }'><img src='images/delete.png' alt='Edit' border='0'></a>";
				
				$membersIdDetails	=	$this->get_team_employees($team_id);
				$employeeName	=	'';
				if($membersIdDetails)
				foreach($membersIdDetails as $employee){
					$singleEmployeDetail	=	$this->get_employee_info($employee['employee_id']);
					$employeeName	.=	$singleEmployeDetail['employee_full_name']."&nbsp;(".$singleEmployeDetail['employee_email'].")<br /><br />";
				}
				
				$emailSend = "<a href='".$page_link."&amp;team_id=".$team_id."&amp;action=send_email&amp;tab=team'  title='Send Email'><span class='active'><img src='images/small_mail.png' alt='Send Email' border='0'></span></a>";
			
				
				$loginDetails	=	$this->get_user_login_details($team_id);
				$class = $i % 2 == 0 ? "class='even_row'" : "class='odd_row'";
				$title_dev_team_listing .= '<tr '.$class.'>
									<td>'.$sr.'</td>
			
									<td>'.$title_dev_team_listing_records[$i]['team_name'].'</td>
									<td>'.$tourDetails['tour_name'].'</td>
									<td>'.$employeeName.'</td>
									<td>'.$loginDetails['user_name'].'</td>
									<td>'.$loginDetails['user_password'].'</td>
									<td align="center">'.$emailSend.'</td>
									<td align="center">'.$status.'</td>
									<td align="center">'.$edit_link.'</td>';
									if( $_SESSION['admin_user_type'] == "1" ){		
				$title_dev_team_listing .= '<td align="center">'.$delete_link.'</td>';
									}		
				$title_dev_team_listing .= '</tr>';
				$sr++;
			}	//	End of For Loooooooooop
		}	//	End of if( $title_dev_team_listing_records != false )
		else
		{
			$title_dev_team_listing = '<tr>
									<td colspan="5" class="Bad-msg" align="center">'.NO_RECORD_FOUND.'</td>
								</tr>';
		}
		return $title_dev_team_listing;
	}	//	End of function display_team_listing_admin( $title_dev_team_listing )


	function fill_tour_combo( $form_name, $tour_id )
	{
		$q = "SELECT * FROM tbl_tours";
		$r = $this -> db -> getMultipleRecords( $q );
		$combo = '<select class="txareacombow" name="tour_id" id="tour_id" >
					<option value="">---Select Tour---</option>';
		if( $r != false )
		{
			for( $i = 0; $i < count( $r ); $i++ )
			{
				$selected = $tour_id == $r[$i]['tour_id'] ? "selected" : "";
				$combo .= '<option '.$selected.' value="'.$r[$i]['tour_id'].'">'.$r[$i]['tour_name'].'</option>';
			}	//	End of for Looooooop
		}	//	End of if( $r != false )
		$combo .= '</select>';
		
		return $combo;
	}	//	End of function fill_employee_combo( )
	


	function remove_html_tags( $document )
	{
		// $document should contain an HTML document.
		// This will remove HTML tags, javascript sections
		// and white space. It will also convert some
		// common HTML entities to their text equivalent.
		$search = array ('@<script[^>]*?>.*?</script>@si', // Strip out javascript
						 '@<[\/\!]*?[^<>]*?>@si',          // Strip out HTML tags
						 '@([\r\n])[\s]+@',                // Strip out white space
						 '@&(quot|#34);@i',                // Replace HTML entities
						 '@&(amp|#38);@i',
						 '@&(lt|#60);@i',
						 '@&(gt|#62);@i',
						 '@&(nbsp|#160);@i',
						 '@&(iexcl|#161);@i',
						 '@&(cent|#162);@i',
						 '@&(pound|#163);@i',
						 '@&(copy|#169);@i',
						 '@&#(\d+);@e');                    // evaluate as php
		
		$replace = array ('',
						  '',
						  '\1',
						  '"',
						  '&',
						  '<',
						  '>',
						  ' ',
						  chr(161),
						  chr(162),
						  chr(163),
						  chr(169),
						  'chr(\1)');
		
		$text = preg_replace($search, $replace, $document);
		return $text;
	}	//	End of function remove_html_tags( $document )
	
}	//	End of class team
?>