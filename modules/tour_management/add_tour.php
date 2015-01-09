<?
	$tour_obj = new tours();
	$form_action = "index.php?module_name=tour_management&amp;tab=tour&amp;file_name=".$file_name;
	$tour_id = isset( $_GET['tour_id'] ) ? $_GET['tour_id'] : 0;
	$tour_id = isset( $_POST['tour_id'] ) ? $_POST['tour_id'] : $tour_id;

	if( isset( $_POST['Save'] ) )
	{
		$tour_status = $_POST['tour_status'] == "Active" ? 1 : 0;		
		$is_saved = $tour_id > 0 ? $tour_obj -> update_tour(  $_POST['tour_name'], $_POST['tour_description'], $_POST['tour_location'], 
			$_POST['tour_start_date'], $_POST['tour_end_date'], $tour_status , $tour_id ) : $tour_obj -> add_tour( $_POST['tour_name'],
		$_POST['tour_description'], $_POST['tour_location'], $_POST['tour_start_date'], $_POST['tour_end_date'], $tour_status  );
		$msg = $is_saved ? "<span class='good-msg'>".RECORD_ADDED."</span>" : "<span class='bad-msg'>".RECORD_ERROR."</span>";
	}	//	End of if( isset( $_POST['Save'] ) )
	
	if( $tour_id > 0 )
	{
		$r = $tour_obj -> get_tour_info( $tour_id, 0 );
		$tour_name = $r['tour_name']; $tour_description = $r['tour_description'];$tour_location = $r['tour_location'];
		$tour_start_date = $r['tour_start_date']; $tour_end_date = $r['tour_end_date']; $tour_status = $r['tour_status']; 
	}
	else
	{
		$tour_name = $tour_description = $tour_location = $tour_start_date = $tour_end_date=  $tour_status= ""; 
	}	
?>
<!-- For Calander -->
<link rel="stylesheet" href="js/jquery_pack/jquery.ui.all.css">
<script src="js/jquery_pack/jquery-1.9.1.js"></script>
<script src="js/jquery_pack/jquery.ui.core.js"></script>
<script src="js/jquery_pack/jquery.ui.widget.js"></script>
<script src="js/jquery_pack/jquery.ui.datepicker.js"></script>
<link rel="stylesheet" href="js/jquery_pack/demos.css">
<!-- For Calander -->
<script language="javascript" type="text/javascript">
	$(function() {
		$( "#tour_start_date" ).datepicker();
		$( "#tour_end_date" ).datepicker();
	});
	$(document).ready(function(){ $("#tour_manage_form").validate(); });
</script>
<!--Start Left Sec -->
<div class="left-sec">
<h1>Add tour</h1>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#686868; font-weight:bold;">
<tr>
    <td style="text-align:center; width:100%"><?=$msg?></td>
<tr>
</tr>
    <td align="right" class="td-cls"><a href="index.php?module_name=tour_management&amp;file_name=manage_tours&amp;tab=tour">Manage tours</a></td>
</tr>
</table>
<form name="tour_manage_form" id="tour_manage_form" action="<?=$form_action?>" method="post">
<input type="hidden" name="tour_id" value="<?=$tour_id?>" />
<table id="Forms" width="98%" align="center" cellpadding="0" cellspacing="0" border="0"  class="tableClass">
<tr>
    <td>
    	<span class="star">* </span>Tour Name: <br />
    	<input class="txarea1 required" type="text" name="tour_name" id="tour_name" value="<?=$tour_name?>" />
    </td>
</tr>
<tr>
    <td>
    	Tour Description: <br />
    	<textarea class="txarea1" name="tour_description" id="tour_description" rows="15" cols="80"><?=$tour_description?></textarea>
    </td>
</tr>
<tr>
    <td>
    	<span class="star">* </span>Tour Location: <br />
    	<input class="txarea1 required" type="text" name="tour_location" id="tour_location" value="<?=$tour_location?>" />
    </td>
</tr>
<tr>
    <td>
    	Tour Starting Date: <br />
    	<input class="txarea1" type="text" name="tour_start_date" id="tour_start_date" value="<?=$tour_start_date?>" />
    </td>
</tr>
<tr>
    <td>
    	Tour Ending Date: <br />
    	<input class="txarea1" type="text" name="tour_end_date" id="tour_end_date" value="<?=$tour_end_date?>" />
    </td>
</tr>
<tr>
    <td>Status:<br />
		<select class="txareacombow" name="tour_status" id="tour_status">
        	<option <? if( $tour_status == 1 ) echo "selected"; ?> value="Active">Active</option>
            <option <? if( $tour_status == 0 ) echo "selected"; ?> value="Inactive">Inactive</option>
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