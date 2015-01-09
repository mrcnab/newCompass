<?
	$pg_obj = new paging();
	$team_obj = new teams(); 
	$pageno = isset( $_GET['pageno'] ) ? $_GET['pageno'] : 1;
	$page_action = isset( $_GET['action'] ) ? $_GET['action'] : "";
	$team_id = isset( $_GET['team_id'] ) ? $_GET['team_id'] : 1;

	$page_link = "index.php?module_name=team_management&amp;file_name=manage_teams&amp;tab=team";
	$page_link .= $pageno > 0 ? "&amp;pageno=".$pageno : "";
	
	if( $page_action == "delete" )
	{
		$is_deleted = $team_obj -> delete_team( $team_id );
		$msg = $is_deleted ? '<span class="good-msg">'.RECORD_DELETE.'</span>' : '<span class="bad-msg">'.RECORD_DELETE_ERROR.'</span>';
	}	
	if( $page_action == "change_status" )
	{
		$is_changed = $team_obj -> set_team_status( $team_id );
		$msg = $is_changed ? "<span class='good-msg'>".STATUS_UPDATED."</span>" : "<span class='bad-msg'>".STATUS_UPDATED_ERROR."</span>";
	}	

	if( $page_action == "send_email" )
	{
		$is_send = $team_obj -> send_team_email( $team_id );
		$msg = $is_send ? "<span class='good-msg'>".EMAIL_SEND."</span>" : "<span class='good-msg'>".EMAIL_SEND."</span>";
	}	
	

	$q = "SELECT * FROM tbl_teams";
	$q1 = "SELECT count( * ) as total FROM tbl_teams";
	$get_all_team_pages = $pg_obj -> getPaging( $q, RECORDS_PER_PAGE, $pageno );
	$get_all_teams = $team_obj -> display_teams_listing( $get_all_team_pages, $page_link, $pageno );
	if( $get_all_team_pages != false )
		{
			$get_total_records = $db -> getSingleRecord( $q1 );
			$total_records = $get_total_records['total'];
			$total_pages = ceil( $total_records / RECORDS_PER_PAGE );
		}
	
	
?>
<h1>Manage teams</h1>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#686868; font-weight:bold; margin-bottom:5px;">
<tr>
    <td style="text-align:center; width:100%"><?=$msg?></td>
<tr>
    <?
	if( $_SESSION['admin_user_type'] == "1" )
	{			
	?>
<tr>
    <td style="padding-right:7px;" class="td-cls" align="right">

    <a href="index.php?module_name=team_management&amp;file_name=add_team&amp;tab=team">Add team</a>
    
    </td>
</tr>
<?	} ?>
</table>
<table id="Listing" width="100%" border="0" cellpadding="0" cellspacing="1" style="color:#686868;">
<tr style="height:3px;"><td style="height:3px;" colspan="7"></td></tr>
<tr class="header">
    <td class="Sr">Sr.</td>
    <td class="Title">Team Name</td>
    <td class="Title">Tour Name</td>
    <td>Employees</td>
    <td>User Name</td>
    <td>Password</td>
    <td class="Edit">Send Email</td>
    <td class="Edit">Status</td>
    <td class="Edit">Edit</td>
    <?
	if( $_SESSION['admin_user_type'] == "1" )
	{
	?>
    <td class="Status">Delete</td>
    <? 	} ?> 
</tr>
<?=$get_all_teams?>
<?
if( $total_pages > 1 )
{
	echo '<tr><td colspan="7" id="paging">'.$pg_obj -> display_paging( $total_pages, $pageno, $page_link, NUMBERS_PER_PAGE ).'</td></tr>';
}
?>
<tr style="height:3px;"><td style="height:3px;" colspan="7"></td></tr>
</table>
