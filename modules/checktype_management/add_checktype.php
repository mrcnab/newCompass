<?
	$checktypes_obj = new checktypes();
	$form_action = "index.php?module_name=checktype_management&amp;tab=checklist&amp;file_name=".$file_name;
	$checklist_type_category_id = isset( $_GET['checklist_type_category_id'] ) ? $_GET['checklist_type_category_id'] : 0;
	$checklist_type_category_id = isset( $_POST['checklist_type_category_id'] ) ? $_POST['checklist_type_category_id'] : $checklist_type_category_id;
	if( isset( $_POST['Save'] ) ){

		if( $_POST['checklist_id'] != "" )
		{
		$is_saved = $checklist_type_category_id > 0 ? $checktypes_obj -> update_checklist(  $_POST['checklist_id'],  $_POST['tour_type_category'],
		$_POST['checktype_status'], $checklist_type_category_id ) : $checktypes_obj -> add_checklist( $_POST['checklist_id'],
		$_POST['tour_type_category'], $_POST['checktype_status']);
		
		$msg = $is_saved ? "<span class='good-msg'>".RECORD_ADDED."</span>" : "<span class='bad-msg'>".RECORD_ERROR."</span>";
		}    //    End of if (move_uploaded_file($_FILES['photo']['tmp_name'][$i], $photo))
		else
		{
			$msg = "<span class='bad-msg'>Please select Check List</span>";
		}
		
	}	//	End of if( isset( $_POST['Save'] ) )
	
	if( $checklist_type_category_id > 0 ){
		$r = $checktypes_obj -> get_checklist_info( $checklist_type_category_id );
		$tour_type_category = $r['tour_type_category'];$checklist_id = $r['checklist_id'];  $checktype_status = $r['checktype_status']; 
	}else{
		$tour_type_category = $checklist_id =  $checktype_status = ""; 
	}
	
?>

<script language="javascript" type="text/javascript">
	$(document).ready(function(){ $("#checklist_manage_form").validate(); });
</script>

<!--Start Left Sec -->
<div class="left-sec">
<h1>Add Check List Category/Group</h1>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#686868; font-weight:bold;">
<tr>
    <td style="text-align:center; width:100%"><?=$msg?></td>
<tr>
</tr>
    <td align="right" class="td-cls"><a href="index.php?module_name=checktype_management&amp;file_name=manage_checklists&amp;tab=checklist">Manage Check Lists</a></td>
</tr>
</table>
<form name="checklist_manage_form" id="checklist_manage_form" action="<?=$form_action?>" method="post"  enctype="multipart/form-data">
<input type="hidden" name="checklist_type_category_id" value="<?=$checklist_type_category_id?>" />
<table id="Forms" width="98%" align="center" cellpadding="0" cellspacing="0" border="0">
<tr>
    <td>
    	<span class="star">* </span>Check List Doc: <br />
    	<?=$checktypes_obj -> fill_checklist_combo( 'checklist_manage_form', $checklist_id );?>
    </td>
</tr>
<tr>
	<td valign="middle">&nbsp;</td>
</tr>
<tr>
    <td>
    	<span class="star">* </span>Check List Category/Group Name: <br />
    	<input class="txarea1 required" type="text" name="tour_type_category" id="tour_type_category" value="<?=$tour_type_category?>" />
    </td>
</tr>
<tr>
	<td valign="middle">Status:</td>
</tr>
<tr>
    <td><select class="txareacombow" name="checktype_status" id="checktype_status">
    		<option <? if( $checktype_status == 1 ) echo "selected"; ?> value="1">Active</option>
            <option <? if( $checktype_status == 2 ) echo "selected"; ?> value="2">In Active</option>
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