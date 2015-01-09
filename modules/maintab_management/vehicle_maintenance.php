<?
	$maintab_obj = new maintabs();
	$form_action = "index.php?module_name=maintab_management&amp;tab=maintab&amp;file_name=".$file_name;
	$vehicle_maintenance_id = isset( $_GET['vehicle_maintenance_id'] ) ? $_GET['vehicle_maintenance_id'] : 0;
	$vehicle_maintenance_id = isset( $_POST['vehicle_maintenance_id'] ) ? $_POST['vehicle_maintenance_id'] : $vehicle_document_id;
	if( isset( $_POST['Save'] ) ){
		$is_saved = $vehicle_maintenance_id > 0 ? $maintab_obj -> update_vehicle_maintenacnce(
		$_POST['has_all_pre_tour_maintenance_as_per_schedule_been_performed'],$_POST['have_vehicle_logbooks_been_updated_in_db'],
		$_POST['when_were_the_logbooks_last_updated'], $_POST['has_inventory_list_been_updated_in_db'], 
		$_POST['when_was_the_inventory_list_updated'], $_POST['have_any_required_spare_parts_been_updated'] , $_POST['when_were_required_spare_parts_updated']
		, $vehicle_maintenance_id ) :
		
		$maintab_obj -> add_vehicle_maintenacnce( $_POST['tour_id'],$_POST['team_id'],
		$_POST['has_all_pre_tour_maintenance_as_per_schedule_been_performed'],$_POST['have_vehicle_logbooks_been_updated_in_db'],
		$_POST['when_were_the_logbooks_last_updated'], $_POST['has_inventory_list_been_updated_in_db'], 
		$_POST['when_was_the_inventory_list_updated'], $_POST['have_any_required_spare_parts_been_updated'] , $_POST['when_were_required_spare_parts_updated']
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
	
	$r = $maintab_obj -> get_vehicle_maintenance_info( $tourID,$teamID);
		$has_all_pre_tour_maintenance_as_per_schedule_been_performed = $r['has_all_pre_tour_maintenance_as_per_schedule_been_performed'];
		$have_vehicle_logbooks_been_updated_in_db = $r['have_vehicle_logbooks_been_updated_in_db']; 
		 $when_were_the_logbooks_last_updated = $r['when_were_the_logbooks_last_updated']; 
		 $has_inventory_list_been_updated_in_db = $r['has_inventory_list_been_updated_in_db']; 
		 $when_was_the_inventory_list_updated = $r['when_was_the_inventory_list_updated']; 
		 $have_any_required_spare_parts_been_updated = $r['have_any_required_spare_parts_been_updated']; 
		 $when_were_required_spare_parts_updated = $r['when_were_required_spare_parts_updated']; 
		 $vehicle_maintenance_id = $r['vehicle_maintenance_id'];
		 
		 $allVehicleCirculationPapers	=	$maintab_obj->get_all_vehicle_circulation_papers($vehicle_document_id);
		 $allVehicleInsurancePapers	=	$maintab_obj->get_all_vehicle_insurance_papers($vehicle_document_id);
?>
<!--Start Right Section -->
<? include("includes/tabs_side.php"); ?>
<!--End Right Section -->
<!--Start Left Sec -->
<div class="left-sec">
<h1 style="padding-bottom:0px;">Vehicle Maintenance</h1>
<h3 style="padding:0px;">Tour Name: <?=$tourInfo['tour_name']?></h3>
<h3 style="padding-top:0px;">Team Name: <?=$getTeamDetails['team_name']?></h3>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#686868; font-weight:bold;">
<tr>
    <td style="text-align:center; width:100%"></td>
<tr>
<tr>
    <td style="text-align:center; width:100%"><?=$msg?></td>
<tr>
</table>

<form name="vehicle_documents_form" id="vehicle_documents_form" action="<?=$form_action?>" method="post"  enctype="multipart/form-data">
<input type="hidden" name="vehicle_maintenance_id" value="<?=$vehicle_maintenance_id?>" />
<input type="hidden" name="tour_id" value="<?=$tourInfo['tour_id']?>" />
<input type="hidden" name="team_id" value="<?=$getTeamDetails['team_id']?>" />
<table id="Forms" width="98%" align="center" cellpadding="0" cellspacing="0" border="0" class="tableClass">
<tr>
    <td>
    	1.	Has all pre tour maintenance as per schedule been performed    
    <br />
    <div style="padding:10px;"> <input type="radio"  name="has_all_pre_tour_maintenance_as_per_schedule_been_performed" value="Yes" <? if($has_all_pre_tour_maintenance_as_per_schedule_been_performed == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="has_all_pre_tour_maintenance_as_per_schedule_been_performed" value="No" <? if($has_all_pre_tour_maintenance_as_per_schedule_been_performed == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr>
    <td>
    	2.	Have vehicle logbooks been updated	in DB	
    <br />
    <div style="padding:10px;"> <input type="radio"  name="have_vehicle_logbooks_been_updated_in_db" value="Yes" <? if($have_vehicle_logbooks_been_updated_in_db == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="have_vehicle_logbooks_been_updated_in_db" value="No" <? if($have_vehicle_logbooks_been_updated_in_db == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr>
    <td>
    	3.	When were the logbooks last updated {Format : dd/mm/yyyy}
    <br />
    <div style="padding:10px;"> <input type="text"  name="when_were_the_logbooks_last_updated"  class="txarea1" value="<?=$when_were_the_logbooks_last_updated?>"/></div>
    
    </td>
</tr>
<tr>
    <td>
    	4.	Has inventory list been updated in DB
    <br />
    <div style="padding:10px;"> <input type="radio"  name="has_inventory_list_been_updated_in_db" value="Yes" <? if($has_inventory_list_been_updated_in_db == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="has_inventory_list_been_updated_in_db" value="No" <? if($has_inventory_list_been_updated_in_db == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr>
    <td>
    	5.	When was the inventory list updated {Format : dd/mm/yyyy}
    <br />
    <div style="padding:10px;"><input type="text"  name="when_was_the_inventory_list_updated"  class="txarea1" 
    value="<?=$when_was_the_inventory_list_updated?>"/></div>
    
    </td>
</tr>

<tr>
    <td>
    	6.	Have any required spare parts been updated
    <br />
    <div style="padding:10px;"> <input type="radio"  name="have_any_required_spare_parts_been_updated" value="Yes" <? if($have_any_required_spare_parts_been_updated == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="have_any_required_spare_parts_been_updated" value="No" <? if($have_any_required_spare_parts_been_updated == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr>
    <td>
    	7.	When were required spare parts updated {Format : dd/mm/yyyy}
    <br />
    <div style="padding:10px;"><input type="text"  name="when_were_required_spare_parts_updated"  class="txarea1" value="<?=$when_were_required_spare_parts_updated?>"/></div>
    
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

