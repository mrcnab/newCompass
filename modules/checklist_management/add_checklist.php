<?
	$checklist_obj = new checklists();
	$form_action = "index.php?module_name=checklist_management&amp;tab=checklist&amp;file_name=".$file_name;
	$checklist_id = isset( $_GET['checklist_id'] ) ? $_GET['checklist_id'] : 0;
	$checklist_id = isset( $_POST['checklist_id'] ) ? $_POST['checklist_id'] : $checklist_id;
	if( isset( $_POST['Save'] ) ){

		if( $_POST['tour_id'] != "" )
		{
		$is_saved = $checklist_id > 0 ? $checklist_obj -> update_checklist(  $_POST['checklist_title'],  $_POST['tour_id'],
		$_POST['checklist_status'], $checklist_id ) : $checklist_obj -> add_checklist( $_POST['checklist_title'],
		$_POST['tour_id'], $_POST['checklist_status']);
		
		$msg = $is_saved ? "<span class='good-msg'>".RECORD_ADDED."</span>" : "<span class='bad-msg'>".RECORD_ERROR."</span>";
		}    //    End of if (move_uploaded_file($_FILES['photo']['tmp_name'][$i], $photo))
		else
		{
			$msg = "<span class='bad-msg'>Please select tour</span>";
		}
		
	}	//	End of if( isset( $_POST['Save'] ) )
	
	if( $checklist_id > 0 ){
		$r = $checklist_obj -> get_checklist_info( $checklist_id );
		$checklist_title = $r['checklist_title'];$tour_id = $r['tour_id'];  $checklist_status = $r['checklist_status']; 
	}else{
		$checklist_title = $tour_id =  $checklist_status = ""; 
	}
	
?>

<script language="javascript" type="text/javascript">
	$(document).ready(function(){ $("#checklist_manage_form").validate(); });
</script>

<!--Start Left Sec -->
<div class="left-sec">
<h1>Add checklist</h1>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#686868; font-weight:bold;">
<tr>
    <td style="text-align:center; width:100%"><?=$msg?></td>
<tr>
</tr>
    <td align="right" class="td-cls"><a href="index.php?module_name=checklist_management&amp;file_name=manage_checklists&amp;tab=checklist">Manage Check Lists</a></td>
</tr>
</table>
<form name="checklist_manage_form" id="checklist_manage_form" action="<?=$form_action?>" method="post"  enctype="multipart/form-data">
<input type="hidden" name="checklist_id" value="<?=$checklist_id?>" />
<table id="Forms" width="98%" align="center" cellpadding="0" cellspacing="0" border="0">
<tr>
    <td>
    	<span class="star">* </span>Tour Check List Name: <br />
    	<input class="txarea1 required" type="text" name="checklist_title" id="checklist_title" value="<?=$checklist_title?>" />
    </td>
</tr>
<tr>
    <td>
    	<span class="star">* </span>Tour: <br />
    	<?=$checklist_obj -> fill_tour_combo( 'checklist_manage_form', $tour_id );?>
    </td>
</tr>
<tr>
	<td valign="middle">&nbsp;</td>
</tr>
<tr>
	<td valign="middle">Status:</td>
</tr>
<tr>
    <td><select class="txareacombow" name="checklist_status" id="checklist_status">
    		<option <? if( $checklist_status == 1 ) echo "selected"; ?> value="1">Started</option>
            <option <? if( $checklist_status == 2 ) echo "selected"; ?> value="2">In Process</option>
            <option <? if( $checklist_status == 3 ) echo "selected"; ?> value="3">Departured</option>
            <option <? if( $checklist_status == 4 ) echo "selected"; ?> value="4">Returned</option>
            <option <? if( $checklist_status == 5 ) echo "selected"; ?> value="5">Finished</option>
     
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