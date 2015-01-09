<?
	$maintab_obj = new maintabs();
	$form_action = "index.php?module_name=maintab_management&amp;tab=maintab&amp;file_name=".$file_name;
	$post_tour_id = isset( $_GET['post_tour_id'] ) ? $_GET['post_tour_id'] : 0;
	$post_tour_id = isset( $_POST['post_tour_id'] ) ? $_POST['post_tour_id'] : $post_tour_id;
	if( isset( $_POST['Save'] ) ){
		$is_saved = $post_tour_id > 0 ? $maintab_obj -> update_post_tour(
		$_POST['have_you_completed_your_accounts'],$_POST['have_you_collected_questionnaires'],
		$_POST['have_you_emailed_wages_sheet'], $_POST['have_you_uploaded_waypoints_into_db'], 
		$_POST['when_were_the_waypoints_updated'], $_POST['have_you_updated_the_tour_manual'], $post_tour_id ) :
		
		$maintab_obj -> add_post_tour( $_POST['tour_id'],$_POST['team_id'],
		$_POST['have_you_completed_your_accounts'],$_POST['have_you_collected_questionnaires'],
		$_POST['have_you_emailed_wages_sheet'], $_POST['have_you_uploaded_waypoints_into_db'], 
		$_POST['when_were_the_waypoints_updated'], $_POST['have_you_updated_the_tour_manual']
		);
		
		$msg = $is_saved ? "<span class='good-msg'>".RECORD_ADDED."</span>" : "<span class='bad-msg'>".RECORD_ERROR."</span>";
	}	//	End of if( isset( $_POST['Save'] ) )
	
	
	$getTeamDetails	=	$helperClass->get_team_details();
	

	if( $_SESSION['admin_user_type'] == "2" ){
		$tourInfo	=	$helperClass->get_tour_info_by_tour_id($getTeamDetails['tour_id']);
		$tourID	=	$tourInfo['tour_id'];
		$teamID	=	$getTeamDetails['team_id'];
		
	}else{
		$tourID	=	$_REQUEST['tour_id'];
		$tourInfo	=	$helperClass->get_tour_info_by_tour_id($tourID);
		$getTeamDetails	=	$maintab_obj->get_team_info_by_tour_id($tourID);
		$teamID	=	$getTeamDetails['team_id'];
	}	
	
	$r = $maintab_obj -> get_post_tour_info( $tourID,$teamID);
		$have_you_completed_your_accounts = $r['have_you_completed_your_accounts'];
		$have_you_collected_questionnaires = $r['have_you_collected_questionnaires']; 
		 $have_you_emailed_wages_sheet = $r['have_you_emailed_wages_sheet']; 
		 $have_you_uploaded_waypoints_into_db = $r['have_you_uploaded_waypoints_into_db']; 
		 $when_were_the_waypoints_updated = $r['when_were_the_waypoints_updated']; 
		 $have_you_updated_the_tour_manual = $r['have_you_updated_the_tour_manual']; 
		 $post_tour_id = $r['post_tour_id'];
?>
<!--Start Right Section -->
<? include("includes/tabs_side.php"); ?>
<!--End Right Section -->
<!--Start Left Sec -->
<div class="left-sec">
<h1 style="padding-bottom:0px;">Post Tour</h1>
<h3 style="padding:0px;">Tour Name: <?=$tourInfo['tour_name']?></h3>
<h3 style="padding-top:0px;">Team Name: <?=$getTeamDetails['team_name']?></h3>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#686868; font-weight:bold;">
<tr>
    <td style="text-align:center; width:100%"><?=$msg?></td>
<tr>
</table>

<form name="vehicle_documents_form" id="vehicle_documents_form" action="<?=$form_action?>" method="post"  enctype="multipart/form-data">
<input type="hidden" name="post_tour_id" value="<?=$post_tour_id?>" />
<input type="hidden" name="tour_id" value="<?=$tourInfo['tour_id']?>" />
<input type="hidden" name="team_id" value="<?=$getTeamDetails['team_id']?>" />
<table id="Forms" width="98%" align="center" cellpadding="0" cellspacing="0" border="0" class="tableClass">
<tr>
    <td>
    	1.	Have you completed your accounts  
    <br />
<div style="padding:10px;"> <input type="radio"  name="have_you_completed_your_accounts" value="Yes" <? if($have_you_completed_your_accounts == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="have_you_completed_your_accounts" value="No" <? if($have_you_completed_your_accounts == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
    <td>
    	2.	Have you collected Questionnaires		
    <br />
    <div style="padding:10px;"> <input type="radio"  name="have_you_collected_questionnaires" value="Yes" <? if($have_you_collected_questionnaires == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="have_you_collected_questionnaires" value="No" <? if($have_you_collected_questionnaires == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr>
    <td>
    	3.	Have you emailed wages sheet
    <br />
   <div style="padding:10px;"> <input type="radio"  name="have_you_emailed_wages_sheet" value="Yes" <? if($have_you_emailed_wages_sheet == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="have_you_emailed_wages_sheet" value="No" <? if($have_you_emailed_wages_sheet == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr>
    <td>
    	4.	Have you uploaded Waypoints into DB
    <br />
    <div style="padding:10px;"> <input type="radio"  name="have_you_uploaded_waypoints_into_db" value="Yes" <? if($have_you_uploaded_waypoints_into_db == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="have_you_uploaded_waypoints_into_db" value="No" <? if($have_you_uploaded_waypoints_into_db == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr>
    <td>
    	5.	When were the waypoints updated {Format : dd/mm/yyyy}
    <br />
    <div style="padding:10px;"><input type="text"  name="when_were_the_waypoints_updated" class="txarea1" value="<?=$when_were_the_waypoints_updated?>"/></div>
    
    </td>
</tr>
<tr>
    <td>
    	6.	Have you updated the Tour Manual
    <br />
   <div style="padding:10px;"> <input type="radio"  name="have_you_updated_the_tour_manual" value="Yes" <? if($have_you_updated_the_tour_manual == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="have_you_updated_the_tour_manual" value="No" <? if($have_you_updated_the_tour_manual == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
 <?	if( $_SESSION['admin_user_type'] == "2" ){?>  
<tr>
    <td>
        <div class="form-btm" style="width:100%;"><input style="float:right;" class="btn" type="submit" name="Save" id="Save" value="Save" /></div>
    </td>
</tr>
<? } ?>
</table>
</form><br clear="all" />
</div>
<!--End Left Sec -->

