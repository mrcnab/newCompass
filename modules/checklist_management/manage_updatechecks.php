<?
	$checklist_obj = new checklists();
	$form_action = "index.php?module_name=checklist_management&amp;tab=checklist&amp;file_name=".$file_name;
	
	if(isset($_REQUEST['checklistID'])){
		$checkListArray	=	explode('-',$_REQUEST['checklistID']);
		$checklist_id = $checkListArray[1];
		if($checklist_id == ''){
			header("Location: index.php");	
		}
	}
	if(isset($_POST['checklist_id'])){
		$checklist_id = $_POST['checklist_id'];	
	}
	if( isset( $_POST['Save'] ) ){
		$is_saved =	$checklist_obj -> update_tour_checklists($_POST['checklist_id'], $_POST['updatecheckboxes']);		
		$msg = $is_saved ? "<span class='good-msg'>".RECORD_ADDED."</span>" : "<span class='good-msg'>".RECORD_ADDED."</span>";
	}	//	End of if( isset( $_POST['Save'] ) )	
	
	$checkListDetail = $checklist_obj-> get_checklist_info( $checklist_id );
	$tourDetail = $checklist_obj->get_tour_info($checkListDetail['tour_id']);
	$teamDetail = $checklist_obj->get_team_by_tour_id($checkListDetail['tour_id']);
	
	$allCheckTypes	=	$checklist_obj->get_all_tour_check_types($checklist_id);
	$allBikesCheckLists	=	$checklist_obj->get_all_bikes_tour_check_lists($checklist_id);
	$allAdminsCheckLists	=	$checklist_obj->get_all_admin_tour_check_lists($checklist_id);
?>
<div style="font-size:13px; font-weight:bold;">Tour Name: <?=$tourDetail['tour_name']?></div><br />
<div style="font-size:13px; font-weight:bold;">Team Name: <?=$teamDetail['team_name']?></div><br />
<div style="font-size:13px; font-weight:bold;"><?=$checkListDetail['checklist_title']?></div><br />
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#686868; font-weight:bold;">
<tr>
    <td style="text-align:center; width:100%"><?=$msg?></td>
<tr>
</table>
<form name="updatechecklist_manage_form" id="updatechecklist_manage_form" action="<?=$form_action?>" method="post"  enctype="multipart/form-data">
<input type="hidden" name="checklist_id" value="<?=$checklist_id?>" />
<table id="Forms" width="98%" align="center" cellpadding="0" cellspacing="0" border="0">
<tr>
    <td>&nbsp;</td>
</tr>
<? if($allCheckTypes)
foreach($allCheckTypes as $types){
$allCheckLists	=	$checklist_obj->get_all_tour_check_lists($checklist_id,$types['checklist_type_category_id']);
?>
<tr>
    <td>&nbsp;</td>
</tr>
<? if($allCheckLists){ ?>
<tr>
    <td>
    	<strong><?=$types['tour_type_category']?>:</strong> <br />
        <? foreach($allCheckLists as $lists){?>
            <div style="padding-left:15px; padding-top:10px;">
    	        <input type="checkbox"  name="updatecheckboxes[]" value="<?=$lists['crew_pre_tour_checklist_id']?>" 
                 <? if($lists['checklist_checked_status'] == 'on'){ ?>checked="checked" <? } ?> /> &nbsp;<?=$lists['crew_pre_tour_text']?>
            </div>
        <? } ?>
    	
    </td>
</tr>
<?  }  } ?>
<tr>
    <td>&nbsp;</td>
</tr>
 <?	if( $_SESSION['admin_user_type'] == "2" ){?>  
<tr>
    <td>
        <div class="form-btm"><input style="float:right;" class="btn" type="submit" name="Save" id="Save" value="Save" /></div>
    </td>
</tr>
<? } ?>
</table>
</form>
<br clear="all" />