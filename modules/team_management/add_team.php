<?
	$team_obj = new teams();
	$form_action = "index.php?module_name=team_management&amp;tab=team&amp;file_name=".$file_name;
	$team_id = isset( $_GET['team_id'] ) ? $_GET['team_id'] : 0;
	$team_id = isset( $_POST['team_id'] ) ? $_POST['team_id'] : $team_id;

	if( isset( $_POST['Save'] ) )
	{
		$team_name	=	$_POST['team_name'];
		$tour_id	=	$_POST['tour_id'];	
		$member_to_teamArray	=	$_POST['member_to_team'];	
		$user_name	=	$_POST['user_name'];	
		$user_password	=	$_POST['user_password'];	
		$is_saved = $team_id > 0 ? $team_obj -> update_team(  $team_name, $tour_id, $member_to_teamArray, $user_name, $user_password , $team_id ) 
		: $team_obj -> add_team(  $team_name, $tour_id, $member_to_teamArray, $user_name, $user_password );
		$msg = $is_saved ? "<span class='good-msg'>".RECORD_ADDED."</span>" : "<span class='bad-msg'>".RECORD_ERROR."</span>";
	}	//	End of if( isset( $_POST['Save'] ) )
	
	if( $team_id > 0 )
	{
		$r = $team_obj -> get_team_info( $team_id, 0 );
		$team_name = $r['team_name']; $tour_id = $r['tour_id'];$member_to_teamArray = $r['member_to_teamArray'];
		$loginDetails	=	$team_obj->get_user_login_details($team_id);
		$user_name = $loginDetails['user_name']; $user_password = $loginDetails['user_password']; 
		$teamMembers	=	$team_obj->get_team_employees($team_id);
	}else{
		$team_name = $tour_id = $member_to_teamArray = $user_name = $user_password = ""; 
	}	
	$activeMembers 	=	$team_obj->get_available_employees();
?>
<script language="javascript" type="text/javascript">
	$(document).ready(function(){ $("#team_manage_form").validate(); });
</script>
<!--Start Left Sec -->
<div class="left-sec">
<h1>Add team</h1>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#686868; font-weight:bold;">
<tr>
    <td style="text-align:center; width:100%"><?=$msg?></td>
<tr>
</tr>
    <td align="right" class="td-cls"><a href="index.php?module_name=team_management&amp;file_name=manage_teams&amp;tab=team">Manage teams</a></td>
</tr>
</table>
<form name="team_manage_form" id="team_manage_form" action="<?=$form_action?>" method="post" autocomplete="off">
<input type="hidden" name="team_id" value="<?=$team_id?>" />
<table id="Forms" width="98%" align="center" cellpadding="0" cellspacing="0" border="0"  class="tableClass">
<tr>
    <td>
    	<span class="star">* </span>Team Title: <br />
    	<input class="txarea1 required" type="text" name="team_name" id="team_name" value="<?=$team_name?>" />
    </td>
</tr>
<tr>
    <td>
    	<span class="star">* </span>Select Tour: <br />
    	<?=$team_obj -> fill_tour_combo( 'team_manage_form', $tour_id );?>
    </td>
</tr>
<tr>
    <td>
    	<span class="star">* </span>Add Employees: <br />
        <select multiple class="scrollbox" name="member_to_team[]"> 
		<?	foreach ($activeMembers as $members){ 
			$checkMember	=	$team_obj->checkTeamMember($members['employee_id'],$team_id);
		?>	
          <option value="<?=$members['employee_id']?>" <? if($checkMember['employee_id'] == $members['employee_id']) { ?> selected="selected" <? } ?>>
			<?=$members['employee_full_name']?>
          </option>
		
		<? } ?>
        </select>
    </td>
</tr>
<tr>
    <td>
    	<span class="star">* </span>Team Login User Name: <br />
    	<input class="txarea1 required" type="text" name="user_name" id="user_name" value="<?=$user_name?>" />
    </td>
</tr>
<tr>
    <td>
    	<span class="star">* </span>Team Login Password: <strong><?=$user_password?></strong><br />
    	<input class="txarea1 required" type="password" name="user_password" id="user_password" value="<?=$user_password?>" />
    </td>
</tr>
<tr>
    <td>
        <div class="form-btm"><input style="float:right;" class="btn" type="submit" name="Save" id="Save" value="Save" /></div>
    </td>
</tr>
</table>
</form><br clear="all" />
</div>
<!--End Left Sec -->

<!--Start Right Section -->
<? include("includes/help.php"); ?>
<!--End Right Section -->