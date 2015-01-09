<?
	$crewpretourchecklist_obj = new crewpretourchecklist();
	$form_action = "index.php?module_name=crewpretourchecklist_management&amp;tab=checklist&amp;file_name=".$file_name;
	$crew_pre_tour_checklist_id = isset( $_GET['crew_pre_tour_checklist_id'] ) ? $_GET['crew_pre_tour_checklist_id'] : 0;
	$crew_pre_tour_checklist_id = isset( $_POST['crew_pre_tour_checklist_id'] ) ? $_POST['crew_pre_tour_checklist_id'] : $crew_pre_tour_checklist_id;
	if( isset( $_POST['Save'] ) ){
		if( $_POST['checklist_id'] != "" )
		{
		$is_saved = $crew_pre_tour_checklist_id > 0 ? $crewpretourchecklist_obj -> update_checklist( $_POST['checklist_id'],
		$_POST['crew_pre_tour_type'], $_POST['crew_pre_tour_text'], $_POST['crew_pre_tour_status'], $crew_pre_tour_checklist_id ) 
		: $crewpretourchecklist_obj -> add_record( $_POST['checklist_id'],
		$_POST['crew_pre_tour_type'], $_POST['crew_pre_tour_text'], $_POST['crew_pre_tour_status']);		
		$msg = $is_saved ? "<span class='good-msg'>".RECORD_ADDED."</span>" : "<span class='bad-msg'>".RECORD_ERROR."</span>";
		}    //    End of if (move_uploaded_file($_FILES['photo']['tmp_name'][$i], $photo))
		else
		{
			$msg = "<span class='bad-msg'>Please Select Check List </span>";
		}
		
	}	//	End of if( isset( $_POST['Save'] ) )
	
	if( $crew_pre_tour_checklist_id > 0 ){
		$r = $crewpretourchecklist_obj -> get_checklist_info( $crew_pre_tour_checklist_id );
		$checklist_id = $r['checklist_id'];$checklist_type_category_id = $r['checklist_type_category_id'];
		$crew_pre_tour_text = $r['crew_pre_tour_text'];  $crew_pre_tour_status = $r['crew_pre_tour_status'];  
	}else{
		$checklist_id = $checklist_type_category_id =  $crew_pre_tour_text =  $crew_pre_tour_status = ""; 
	}	
?>
<script language="javascript" type="text/javascript">
	$(document).ready(function(){ $("#crew_pre_tour_checklist_manage_form").validate(); });
</script>
<!--Start Left Sec -->
<div class="left-sec">
<h1>Tour Check List</h1>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#686868; font-weight:bold;">
<tr>
    <td style="text-align:center; width:100%"><?=$msg?></td>
<tr>
</tr>
    <td align="right" class="td-cls"><a href="index.php?module_name=crewpretourchecklist_management&amp;file_name=manage_crewpretourchecklists&amp;tab=checklist">Manage Tour Check Lists</a></td>
</tr>
</table>
<form name="crew_pre_tour_checklist_manage_form" id="crew_pre_tour_checklist_manage_form" action="<?=$form_action?>" method="post"  enctype="multipart/form-data">
<input type="hidden" name="crew_pre_tour_checklist_id" value="<?=$crew_pre_tour_checklist_id?>" />
<table id="Forms" width="98%" align="center" cellpadding="0" cellspacing="0" border="0">
<tr>
    <td>
    	<span class="star">* </span> Check List Title: <br />
    	<?=$crewpretourchecklist_obj -> fill_tour_checklists_combo( 'crew_pre_tour_checklist_manage_form', $checklist_id );?>
    </td>
</tr>
<tr>
	<td valign="middle">&nbsp;</td>
</tr>
<tr>
    <td>
    	Check List Category Type: <br />
    	<?=$crewpretourchecklist_obj -> fill_checklist_type_combo( 'crew_pre_tour_checklist_manage_form', $checklist_type_category_id );?>
    </td>
</tr>

<!--
<tr>
	<td valign="middle">Check List Category Type:</td>
</tr>
<tr>
    <td><select class="txareacombow" name="crew_pre_tour_type" id="crew_pre_tour_type">
    		<option <? if( $checklist_status == 1 ) echo "selected"; ?> value="1">Bikes</option>
            <option <? if( $checklist_status == 2 ) echo "selected"; ?> value="2">Admin</option>                 
        </select></td>
</tr>
-->
<tr>
	<td valign="middle">&nbsp;</td>
</tr>
<tr>
	<td valign="middle"><span class="star">* </span>Check List Text:</td>
</tr>
<tr>
    <td><textarea class="txarea123 required" name="crew_pre_tour_text" id="crew_pre_tour_text" rows="10" cols="40"><?=$crew_pre_tour_text?></textarea></td>
</tr>


<tr>
	<td valign="middle">Status:</td>
</tr>
<tr>
    <td><select class="txareacombow" name="crew_pre_tour_status" id="crew_pre_tour_status">
        	<option <? if( $crew_pre_tour_status == 1 ) echo "selected"; ?> value="1">Active</option>
            <option <? if( $crew_pre_tour_status == 0 ) echo "selected"; ?> value="0">Inactive</option>
        </select></td>
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