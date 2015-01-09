<?
	$department_obj = new department();
	$form_action = "index.php?module_name=department_management&amp;tab=employee&amp;file_name=".$file_name;
	$dept_id = isset( $_GET['dept_id'] ) ? $_GET['dept_id'] : 0;
	$dept_id = isset( $_POST['dept_id'] ) ? $_POST['dept_id'] : $dept_id;
	if( isset( $_POST['Save'] ) )
	{
			$dept_status = $_POST['dept_status'] == "Active" ? 1 : 0;
			$is_saved = $dept_id > 0 ? $department_obj -> update_department( $_POST['dept_name'], $dept_status, $dept_id ) : $department_obj -> add_department(  $_POST['dept_name'], $dept_status );
			$msg = $is_saved ? "<span class='good-msg'>".RECORD_ADDED."</span>" : "<span class='bad-msg'>".RECORD_ERROR."</span>";
		
	}	//	End of if( isset( $_POST['Save'] ) )
	
	if( $dept_id > 0 )
	{
		$r = $department_obj -> get_department_info( $dept_id, 0 );
		$dept_name = $r['dept_name']; $dept_status = $r['dept_status']; 
	}
	else
	{
		$dept_name = $dept_status = "";
	}
?>

<script language="javascript" type="text/javascript" src="../employe_management/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../employe_management/js/jquery.validate.js"></script>
<script language="javascript" type="text/javascript" src="../employe_management/js/cmxforms.js"></script>
<style type="text/css">
label { width: 10em; z-index:11110; }
label.error { 
 width: 212px;  
    height: 75px;  
    display: none;  
    position: absolute;  
    background: transparent url(../employe_management/images/tipTop.png) no-repeat top;
		text-indent:15px;
		padding-top:8px;
		color: #8b0000;
		margin-top:-30px;
		margin-bottom:10px;
/*clear:both; float:none; color: red; padding-left:.5em;*/}
p { clear: both; }
.submit { margin-left: 12em; }
em { font-weight: bold; padding-right: 1em; vertical-align: top; }
</style>
<script language="javascript" type="text/javascript">
	$(document).ready(function(){ $("#department_manage_form").validate(); });
</script>

<!--Start Left Sec -->
<div class="left-sec">
<h1>Add Department</h1>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#686868; font-weight:bold;">
<tr>
    <td style="text-align:center; width:100%"><?=$msg?></td>
<tr>
</tr>
    <td align="right" class="td-cls"><a href="index.php?module_name=department_management&amp;file_name=manage_departments&amp;tab=employee">Manage Departments</a></td>
</tr>
</table>
<form name="department_manage_form" id="department_manage_form" action="<?=$form_action?>" method="post">
<input type="hidden" name="dept_id" id="dept_id" value="<?=$dept_id?>" />
<table id="Forms" width="98%" align="center" cellpadding="0" cellspacing="0" border="0" class="tableClass">
<tr>
    <td>
    	<span class="star">* </span>Title: <br />
    	<input class="txarea1 required" type="text" name="dept_name" id="dept_name" value="<?=$dept_name?>" />
    </td>
</tr>

<tr>
    <td>Status: <br />
		<select class="txareacombow" name="dept_status" id="dept_status">
        	<option <? if( $dept_status == 1 ) echo "selected"; ?> value="Active">Active</option>
            <option <? if( $dept_status == 0 ) echo "selected"; ?> value="Inactive">Inactive</option>
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
