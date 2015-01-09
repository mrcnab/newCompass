<?
	$employee_obj = new employees();
	$form_action = "index.php?module_name=employee_management&amp;tab=employee&amp;file_name=".$file_name;
	$employee_id = isset( $_GET['employee_id'] ) ? $_GET['employee_id'] : 0;
	$employee_id = isset( $_POST['employee_id'] ) ? $_POST['employee_id'] : $employee_id;
	$randNumber	=	$employee_obj->generateAutoString();

	if( isset( $_POST['Save'] ) )
	{

		if( $_POST['dept_id'] != "" )
		{
		 if($_FILES['photo']['name'] != ''){	
			$uploaddir = "image/data/";
			$photo = $uploaddir . str_replace(" ", "", $randNumber.$_FILES['photo']['name']);
			$photo1 = "data/". str_replace(" ", "", $randNumber.$_FILES['photo']['name']);		
			move_uploaded_file($_FILES['photo']['tmp_name'], $photo) ;
		}
		$employee_status = $_POST['employee_status'] == "Active" ? 1 : 0;		
		$is_saved = $employee_id > 0 ? $employee_obj -> update_employee(  $_POST['employee_title'],  $_POST['employee_email'],
		$_POST['dept_id'], $photo1,  $employee_status , $employee_id ) : $employee_obj -> add_employee( $_POST['employee_title'],  $_POST['employee_email'], $_POST['dept_id'], $photo1, $employee_status  );
		
		$msg = $is_saved ? "<span class='good-msg'>".RECORD_ADDED."</span>" : "<span class='bad-msg'>".RECORD_ERROR."</span>";
			}    //    End of if (move_uploaded_file($_FILES['photo']['tmp_name'][$i], $photo))
		else
		{
			$msg = "<span class='bad-msg'>Please select department</span>";
		}
		
	}	//	End of if( isset( $_POST['Save'] ) )
	
	if( $employee_id > 0 )
	{
		$r = $employee_obj -> get_employee_info( $employee_id, 0 );
		$employee_full_name = $r['employee_full_name'];$employee_email = $r['employee_email'];  $dept_id = $r['dept_id']; 
		$employee_image = $r['employee_image']; $employee_status = $r['employee_status']; 
	}
	else
	{
		$employee_full_name = $employee_email =  $dept_id = $employee_image = $employee_status= ""; 
	}
	
?>

<script language="javascript" type="text/javascript">
	$(document).ready(function(){ $("#employee_manage_form").validate(); });
</script>

<!--Start Left Sec -->
<div class="left-sec">
<h1>Add Employee</h1>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#686868; font-weight:bold;">
<tr>
    <td style="text-align:center; width:100%"><?=$msg?></td>
<tr>
</tr>
    <td align="right" class="td-cls"><a href="index.php?module_name=employee_management&amp;file_name=manage_employees&amp;tab=employee">Manage Employees</a></td>
</tr>
</table>
<form name="employee_manage_form" id="employee_manage_form" action="<?=$form_action?>" method="post"  enctype="multipart/form-data">
<input type="hidden" name="employee_id" value="<?=$employee_id?>" />
<table id="Forms" width="98%" align="center" cellpadding="0" cellspacing="0" border="0"  class="tableClass">
<tr>
    <td>
    	<span class="star">* </span>Employee Full Name: <br />
    	<input class="txarea1 required" type="text" name="employee_title" id="employee_title" value="<?=$employee_full_name?>" />
    </td>
</tr>
<tr>
    <td>
    	<span class="star">* </span>Employee Email Address: <br />
    	<input class="txarea1 required" type="text" name="employee_email" id="employee_email" value="<?=$employee_email?>" />
    </td>
</tr>
<tr>
    <td>
    	<span class="star">* </span>Department: <br />
    	<?=$employee_obj -> fill_dept_combo( 'employee_manage_form', $dept_id );?>
    </td>
</tr>
<? 
if(file_exists("image/".$employee_image)) {
$imageThumb	=	$employee_obj->resize($employee_image,LISTING_THUMB_WIDTH,LISTING_THUMB_HEIGH);
}else{					
$imageThumb	=	$employee_obj->resize(NO_IMAGE_PATH,LISTING_THUMB_WIDTH,LISTING_THUMB_HEIGH);					
}
?>

<tr>
    <td><img src="<?=$imageThumb?>" border="0" /><br />
    	Picture: <br />
    	 <input class="txarea1" type="file" name="photo" id="photo" />
    </td>
</tr>
<tr>
    <td>Status: <br /><select class="txareacombow" name="employee_status" id="employee_status">
        	<option <? if( $employee_status == 1 ) echo "selected"; ?> value="Active">Active</option>
            <option <? if( $employee_status == 0 ) echo "selected"; ?> value="Inactive">Inactive</option>
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