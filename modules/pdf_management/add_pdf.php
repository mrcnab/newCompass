<?
	ob_start();
	ini_set("memory_limit","256M");
	ini_get("memory_limit");
	
	$pg_obj = new paging();
	$pdf_obj = new pdfs();
	$form_action = "index.php?module_name=pdf_management&amp;tab=pdfs&amp;file_name=".$file_name;
	$pdf_id = isset( $_GET['pdf_id'] ) ? $_GET['pdf_id'] : 0;
	$pdf_id = isset( $_POST['pdf_id'] ) ? $_POST['pdf_id'] : $pdf_id;
	$randNumber	=	$pdf_obj->generateAutoString();
	if( isset( $_POST['Save'] ) )
	{
			if( $_FILES['photo']['name'] != "" )
			{
				$uploaddir = "modules/".$module_name."/files/";
				if( !is_dir( $uploaddir ) )
					mkdir( $uploaddir, 0777 );
	
				$photo = $uploaddir . $randNumber.str_replace(" ", "", $_FILES['photo']['name']);
				$photoName =  $randNumber.str_replace(" ", "", $_FILES['photo']['name']);
				if( move_uploaded_file( $_FILES['photo']['tmp_name'], $photo ) ){
					$msg = "<span class='bad-msg'>".UPLOADING_ERROR.".</span>";					
				}				
			}	//	End of if( $_FILES['photo']['name'] != "" )
			
			$status = $_POST['status'] == "Active" ? 1 : 0;
			$is_saved = $pdf_id > 0 ? $pdf_obj -> update_pdf( $_POST['pdf_name'], $_POST['pdf_description'], $photoName, $status, $pdf_id ) : $pdf_obj -> add_pdf( $_POST['pdf_name'], $_POST['pdf_description'],  $photoName,  $status );
			$msg = $is_saved ? "<span class='good-msg'>".RECORD_ADDED."</span>" : "<span class='bad-msg'>".RECORD_ERROR."</span>";
	}	//	End of if( isset( $_POST['Save'] ) )

	if( $pdf_id > 0 )
	{
		$r = $pdf_obj -> get_pdf_info( $pdf_id, 0 );
		$pdf_name = $r['pdf_name'];
		$pdf_description = $r['pdf_description'];
		$status = $r['status']; 
		$pdf_file = $r['pdf_file']; 
	}
	else
	{
		$pdf_name = $pdf_description =  $status = "";
		$pdf_file =  "";
	}
?>
<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.validate.js"></script>
<script language="javascript" type="text/javascript" src="js/cmxforms.js"></script>
<style type="text/css">
label { width: 30em; z-index:0; float:left; /*border:#FF0000 1px solid;*/ }
label.error { float: left; color: red; padding-left: .5em; vertical-align: top; margin-top:-45px; margin-left:130px; font-weight:normal; }
p { clear: both; }
.submit { margin-left: 12em; }
em { font-weight: bold; padding-right: 1em; vertical-align: top; }
</style>
<script language="javascript" type="text/javascript">
	$(document).ready(function(){ $("#add_pdf_form").validate(); });
</script>
<!--Start Left Sec -->
<div class="left-sec">

<h1>Add/Edit Download Pdf(s)</h1>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#686868; font-weight:bold;">
<tr>
    <td style="text-align:left; width:80%; padding-left:7px; text-align:center;"><?=$msg?></td>  
	<td width="22%" align="left" class="td-cls"><a href="index.php?module_name=pdf_management&amp;file_name=manage_pdf&amp;tab=pdfs">Manage Download Files</a></td>
  
</tr>
</table>
<form name="add_pdf_form" id="add_pdf_form" action="<?=$form_action?>" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#686868; font-weight:bold;"   class="tableClass">
<tr>
    <td>
    	<span class="star">*</span> Download File Name:<br />
    	<input class="txarea2 required" type="text" name="pdf_name" id="pdf_name" value="<?=$pdf_name?>" />
    </td>
</tr>
<tr>
    <td>
    	Download File Description:<br />
<em>		<textarea class="txarea1" name="pdf_description" id="pdf_description" rows="15" cols="80"><?=$pdf_description?></textarea></em>
    </td>
</tr>
<tr>
	<td valign="middle">File:</td>
</tr>
<tr>
    <td><input style="width:666px;" class="txarea1" type="file" name="photo" id="photo" value="" /></td>
</tr>
<tr>
    <td>Status:<br />
    	<select class="txarea2" name="status" id="status">
        	<option <? if( $status == 1 ) echo "selected"; ?> value="Active">Active</option>
            <option <? if( $status == 0 ) echo "selected"; ?> value="Inactive">Inactive</option>
        </select>
    </td>
</tr>
<tr>
    <td>
    <div class="form-btm">
        <input style="float:right;" class="btn" type="submit" name="Save" id="Save" value="Save" />
        <input type="hidden" name="pdf_id" id="pdf_id" value="<?=$pdf_id?>" />
    </div>
    </td>
</tr>
</table>
</form><br clear="all" />
</div>
<!--End Left Sec -->

<!--Start Right Section -->
<? include("includes/help.php"); ?>
<!--End Right Section -->