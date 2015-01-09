<?
	$maintab_obj = new maintabs();
	$form_action = "index.php?module_name=maintab_management&amp;tab=maintab&amp;file_name=".$file_name;
	$pre_tour_paper_work_id = isset( $_GET['pre_tour_paper_work_id'] ) ? $_GET['pre_tour_paper_work_id'] : 0;
	$pre_tour_paper_work_id = isset( $_POST['pre_tour_paper_work_id'] ) ? $_POST['pre_tour_paper_work_id'] : $pre_tour_paper_work_id;

	if( isset( $_POST['Save'] ) ){
		$is_saved = $pre_tour_paper_work_id > 0 ? $maintab_obj -> update_pre_tour_paper_work( $_POST['do_you_have_tour_manifest'],
		$_POST['do_you_have_client_manifest'], $_POST['do_you_have_itinerary_manifest'],
		$_POST['do_you_have_passenger_manifest'],$_POST['do_you_have_welcome_letter_prepared'], $_POST['do_you_have_hotel_list_prepared'],
		$_POST['do_you_have_tour_dossier_printed'],$_POST['do_you_have_pre_departure_meeting_checklist'], $_POST['do_you_have_bike_briefing_checklist'],
		$_POST['do_you_have_all_city_sheets_for_tour_printed'],$_POST['do_you_have_enough_tshirts_ordered'], $_POST['do_you_have_tour_maps_and_route_notes'],
		$_POST['have_you_read_the_crew_training_manual'], $pre_tour_paper_work_id ) : 
		
		$maintab_obj -> add_pre_tour_paper_work( $_POST['tour_id'],$_POST['team_id'],
		$_POST['do_you_have_tour_manifest'],$_POST['do_you_have_client_manifest'], $_POST['do_you_have_itinerary_manifest'],
		$_POST['do_you_have_passenger_manifest'],$_POST['do_you_have_welcome_letter_prepared'], $_POST['do_you_have_hotel_list_prepared'],
		$_POST['do_you_have_tour_dossier_printed'],$_POST['do_you_have_pre_departure_meeting_checklist'], $_POST['do_you_have_bike_briefing_checklist'],
		$_POST['do_you_have_all_city_sheets_for_tour_printed'],$_POST['do_you_have_enough_tshirts_ordered'], $_POST['do_you_have_tour_maps_and_route_notes'],
		$_POST['have_you_read_the_crew_training_manual']);
		
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
		
		$r = $maintab_obj -> get_pre_tour_paper_work_info($tourID,$teamID);
		$do_you_have_tour_manifest = $r['do_you_have_tour_manifest'];$do_you_have_client_manifest = $r['do_you_have_client_manifest']; 
		$do_you_have_itinerary_manifest = $r['do_you_have_itinerary_manifest'];$do_you_have_passenger_manifest = $r['do_you_have_passenger_manifest']; 
		$do_you_have_welcome_letter_prepared = $r['do_you_have_welcome_letter_prepared'];
		$do_you_have_hotel_list_prepared = $r['do_you_have_hotel_list_prepared']; 
		$do_you_have_tour_dossier_printed = $r['do_you_have_tour_dossier_printed'];
		$do_you_have_pre_departure_meeting_checklist = $r['do_you_have_pre_departure_meeting_checklist']; 
		$do_you_have_bike_briefing_checklist = $r['do_you_have_bike_briefing_checklist'];
		$do_you_have_all_city_sheets_for_tour_printed = $r['do_you_have_all_city_sheets_for_tour_printed']; 
		$do_you_have_enough_tshirts_ordered = $r['do_you_have_enough_tshirts_ordered'];
		$do_you_have_tour_maps_and_route_notes = $r['do_you_have_tour_maps_and_route_notes']; 
		$have_you_read_the_crew_training_manual = $r['have_you_read_the_crew_training_manual'];
		$pre_tour_paper_work_id = $r['pre_tour_paper_work_id'];
		
		$allVehicleCirculationPapers	=	$maintab_obj->get_all_vehicle_circulation_papers($vehicle_document_id);
		$allVehicleInsurancePapers	=	$maintab_obj->get_all_vehicle_insurance_papers($vehicle_document_id);
?>
<!--Start Right Section -->
<? include("includes/tabs_side.php"); ?>
<!--End Right Section -->
<!--Start Left Sec -->
<div class="left-sec">
<h1 style="padding-bottom:0px;">Pre Tour Paper Work</h1>
<h3 style="padding:0px;">Tour Name: <?=$tourInfo['tour_name']?></h3>
<h3 style="padding-top:0px;">Team Name: <?=$getTeamDetails['team_name']?></h3>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#686868; font-weight:bold;">
<tr>
    <td style="text-align:center; width:100%"><?=$msg?></td>
<tr>
</table>

<form name="pre_tour_paperwork_form" id="pre_tour_paperwork_form" action="<?=$form_action?>" method="post"  enctype="multipart/form-data">
<input type="hidden" name="pre_tour_paper_work_id" value="<?=$pre_tour_paper_work_id?>" />
<input type="hidden" name="tour_id" value="<?=$tourInfo['tour_id']?>" />
<input type="hidden" name="team_id" value="<?=$getTeamDetails['team_id']?>" />
<table id="Forms" width="98%" align="center" cellpadding="0" cellspacing="0" border="0" class="tableClass">
<tr>
    <td>
    	1.	Do you have tour manifest
    <br />
    <div style="padding:10px;"> <input type="radio"  name="do_you_have_tour_manifest" value="Yes" <? if($do_you_have_tour_manifest == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="do_you_have_tour_manifest" value="No" <? if($do_you_have_tour_manifest == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr>
    <td>
    	2.	Do you have Client manifest	
    <br />
    <div style="padding:10px;"> <input type="radio"  name="do_you_have_client_manifest" value="Yes" <? if($do_you_have_client_manifest == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="do_you_have_client_manifest" value="No" <? if($do_you_have_client_manifest == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr>
    <td>
    	3.	Do you have Itinerary manifest
    <br />
    <div style="padding:10px;"> <input type="radio"  name="do_you_have_itinerary_manifest" value="Yes" <? if($do_you_have_itinerary_manifest == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="do_you_have_itinerary_manifest" value="No" <? if($do_you_have_itinerary_manifest == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr>
    <td>
    	4.	Do you have passenger manifest
    <br />
    <div style="padding:10px;"> <input type="radio"  name="do_you_have_passenger_manifest" value="Yes" <? if($do_you_have_passenger_manifest == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="do_you_have_passenger_manifest" value="No" <? if($do_you_have_passenger_manifest == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr>
    <td>
    	5.	Do you have Welcome Letter prepared
    <br />
    <div style="padding:10px;"> <input type="radio"  name="do_you_have_welcome_letter_prepared" value="Yes" <? if($do_you_have_welcome_letter_prepared == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="do_you_have_welcome_letter_prepared" value="No" <? if($do_you_have_welcome_letter_prepared == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr>
    <td>
    	6.	Do you have Hotel List prepared
    <br />
    <div style="padding:10px;"> <input type="radio"  name="do_you_have_hotel_list_prepared" value="Yes" <? if($do_you_have_hotel_list_prepared == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="do_you_have_hotel_list_prepared" value="No" <? if($do_you_have_hotel_list_prepared == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr>
    <td>
    	7.	Do you have Tour Dossier printed
    <br />
    <div style="padding:10px;"> <input type="radio"  name="do_you_have_tour_dossier_printed" value="Yes" <? if($do_you_have_tour_dossier_printed == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="do_you_have_tour_dossier_printed" value="No" <? if($do_you_have_tour_dossier_printed == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr>
    <td>
    	8.	Do you have pre departure meeting checklist	
    <br />
    <div style="padding:10px;"> <input type="radio"  name="do_you_have_pre_departure_meeting_checklist" value="Yes" <? if($do_you_have_pre_departure_meeting_checklist == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="do_you_have_pre_departure_meeting_checklist" value="No" <? if($do_you_have_pre_departure_meeting_checklist == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr>
    <td>
    	9.	Do you have bike briefing checklist	
    <br />
    <div style="padding:10px;"> <input type="radio"  name="do_you_have_bike_briefing_checklist" value="Yes" <? if($do_you_have_bike_briefing_checklist == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="do_you_have_bike_briefing_checklist" value="No" <? if($do_you_have_bike_briefing_checklist == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr>
    <td>
    	10.	Do you have all City Sheets for tour printed	
    <br />
    <div style="padding:10px;"> <input type="radio"  name="do_you_have_all_city_sheets_for_tour_printed" value="Yes" <? if($do_you_have_all_city_sheets_for_tour_printed == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="do_you_have_all_city_sheets_for_tour_printed" value="No" <? if($do_you_have_all_city_sheets_for_tour_printed == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr>
    <td>
    	11.	Do you have enough T-shirts ordered
    <br />
    <div style="padding:10px;"> <input type="radio"  name="do_you_have_enough_tshirts_ordered" value="Yes" <? if($do_you_have_enough_tshirts_ordered == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="do_you_have_enough_tshirts_ordered" value="No" <? if($do_you_have_enough_tshirts_ordered == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr>
    <td>
    	12.	Do you have tour maps and route notes
    <br />
    <div style="padding:10px;"> <input type="radio"  name="do_you_have_tour_maps_and_route_notes" value="Yes" <? if($do_you_have_tour_maps_and_route_notes == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="do_you_have_tour_maps_and_route_notes" value="No" <? if($do_you_have_tour_maps_and_route_notes == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr>
    <td>
    	13.	Have you read the Crew Training Manual	
    <br />
    <div style="padding:10px;"> <input type="radio"  name="have_you_read_the_crew_training_manual" value="Yes" <? if($have_you_read_the_crew_training_manual == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="have_you_read_the_crew_training_manual" value="No" <? if($have_you_read_the_crew_training_manual == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
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

