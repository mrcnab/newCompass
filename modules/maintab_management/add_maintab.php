<?
	$maintab_obj = new maintabs();
	$form_action = "index.php?module_name=maintab_management&amp;tab=maintab&amp;file_name=".$file_name;
	$maintab_id = isset( $_GET['maintab_id'] ) ? $_GET['maintab_id'] : 0;
	$maintab_id = isset( $_POST['maintab_id'] ) ? $_POST['maintab_id'] : $maintab_id;
	if( isset( $_POST['Save'] ) ){

		if( $_POST['tour_id'] != "" )
		{
		$is_saved = $maintab_id > 0 ? $maintab_obj -> update_maintab(  $_POST['maintab_title'],  $_POST['tour_id'],
		$_POST['maintab_status'], $maintab_id ) : $maintab_obj -> add_maintab( $_POST['maintab_title'],
		$_POST['tour_id'], $_POST['maintab_status']);
		
		$msg = $is_saved ? "<span class='good-msg'>".RECORD_ADDED."</span>" : "<span class='bad-msg'>".RECORD_ERROR."</span>";
		}    //    End of if (move_uploaded_file($_FILES['photo']['tmp_name'][$i], $photo))
		else
		{
			$msg = "<span class='bad-msg'>Please select tour</span>";
		}
		
	}	//	End of if( isset( $_POST['Save'] ) )
	
	if( $maintab_id > 0 ){
		$r = $maintab_obj -> get_maintab_info( $maintab_id );
		$maintab_title = $r['maintab_title'];$tour_id = $r['tour_id'];  $maintab_status = $r['maintab_status']; 
	}else{
		$maintab_title = $tour_id =  $maintab_status = ""; 
	}
	
?>

<script language="javascript" type="text/javascript">
	$(document).ready(function(){ $("#maintab_manage_form").validate(); });
</script>

<!--Start Left Sec -->
<div class="left-sec">
<h1>Add maintab</h1>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#686868; font-weight:bold;">
<tr>
    <td style="text-align:center; width:100%"><?=$msg?></td>
<tr>
</tr>
    <td align="right" class="td-cls"><a href="index.php?module_name=maintab_management&amp;file_name=manage_maintabs&amp;tab=maintab">Manage Check Lists</a></td>
</tr>
</table>
<form name="maintab_manage_form" id="maintab_manage_form" action="<?=$form_action?>" method="post"  enctype="multipart/form-data">
<input type="hidden" name="maintab_id" value="<?=$maintab_id?>" />
<table id="Forms" width="98%" align="center" cellpadding="0" cellspacing="0" border="0">
<tr>
    <td>
    	<span class="star">* </span>Tour Check List Name: <br />
    	<input class="txarea1 required" type="text" name="maintab_title" id="maintab_title" value="<?=$maintab_title?>" />
    </td>
</tr>
<tr>
    <td>
    	<span class="star">* </span>Tour: <br />
    	<?=$maintab_obj -> fill_tour_combo( 'maintab_manage_form', $tour_id );?>
    </td>
</tr>
<tr>
	<td valign="middle">&nbsp;</td>
</tr>
<tr>
	<td valign="middle">Status:</td>
</tr>
<tr>
    <td><select class="txareacombow" name="maintab_status" id="maintab_status">
    		<option <? if( $maintab_status == 1 ) echo "selected"; ?> value="1">Started</option>
            <option <? if( $maintab_status == 2 ) echo "selected"; ?> value="2">In Process</option>
            <option <? if( $maintab_status == 3 ) echo "selected"; ?> value="3">Departured</option>
            <option <? if( $maintab_status == 4 ) echo "selected"; ?> value="4">Returned</option>
            <option <? if( $maintab_status == 5 ) echo "selected"; ?> value="5">Finished</option>
     
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