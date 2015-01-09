<?
	$maintab_obj = new maintabs();
	$form_action = "index.php?module_name=maintab_management&amp;tab=maintab&amp;file_name=".$file_name;
	$vehicle_document_id = isset( $_GET['vehicle_document_id'] ) ? $_GET['vehicle_document_id'] : 0;
	$vehicle_document_id = isset( $_POST['vehicle_document_id'] ) ? $_POST['vehicle_document_id'] : $vehicle_document_id;
	if( isset( $_POST['Save'] ) ){
		$is_saved = $vehicle_document_id > 0 ? $maintab_obj -> update_vehicle_document(
		$_POST['do_you_have_all_vehicle_titles'],$_POST['do_you_have_all_vehicle_authorisation_papers'],
		$_POST['do_you_have_all_vehicle_circulation_papers'], $_POST['vehicle_name_circulation_paper'], 
		$_POST['registration_circulation_paper'], $_POST['expiry_date_circulation_paper'] , $_POST['do_you_have_all_vehicle_insurance_papers']
		, $_POST['vehicle_name_insurance_paper'], $_POST['registration_insurance_paper'], $_POST['expiry_date_insurance_paper'], $vehicle_document_id ) :
		
		$maintab_obj -> add_vehicle_document( $_POST['tour_id'],$_POST['team_id'],
		$_POST['do_you_have_all_vehicle_titles'],$_POST['do_you_have_all_vehicle_authorisation_papers'],
		$_POST['do_you_have_all_vehicle_circulation_papers'], $_POST['vehicle_name_circulation_paper'], 
		$_POST['registration_circulation_paper'], $_POST['expiry_date_circulation_paper'] , $_POST['do_you_have_all_vehicle_insurance_papers']
		, $_POST['vehicle_name_insurance_paper'], $_POST['registration_insurance_paper'], $_POST['expiry_date_insurance_paper']);
		
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

	$r = $maintab_obj -> get_vehicle_document_info( $tourID,$teamID);
		$do_you_have_all_vehicle_titles = $r['do_you_have_all_vehicle_titles'];$do_you_have_all_vehicle_authorisation_papers = $r['do_you_have_all_vehicle_authorisation_papers'];  $do_you_have_all_vehicle_circulation_papers = $r['do_you_have_all_vehicle_circulation_papers']; 
		 $do_you_have_vehicle_insurance_papers = $r['do_you_have_vehicle_insurance_papers']; 
		 $vehicle_document_id = $r['vehicle_document_id'];
		 
		 $allVehicleCirculationPapers	=	$maintab_obj->get_all_vehicle_circulation_papers($vehicle_document_id);
		 $allVehicleInsurancePapers	=	$maintab_obj->get_all_vehicle_insurance_papers($vehicle_document_id);
?>
<!--Start Right Section -->
<? include("includes/tabs_side.php"); ?>
<!--End Right Section -->
<!--Start Left Sec -->
<div class="left-sec">
<h1 style="padding-bottom:0px;">Vehicle Documents</h1>
<h3 style="padding:0px;">Tour Name: <?=$tourInfo['tour_name']?></h3>
<h3 style="padding-top:0px;">Team Name: <?=$getTeamDetails['team_name']?></h3>

<table width="100%" border="0" cellpadding="0" cellspacing="0"  style="color:#686868; font-weight:bold;">
<tr>
    <td style="text-align:center; width:100%"><?=$msg?></td>
<tr>
</table>

<form name="vehicle_documents_form" id="vehicle_documents_form" action="<?=$form_action?>" method="post"  enctype="multipart/form-data">
<input type="hidden" name="vehicle_document_id" value="<?=$vehicle_document_id?>" />
<input type="hidden" name="tour_id" value="<?=$tourInfo['tour_id']?>" />
<input type="hidden" name="team_id" value="<?=$getTeamDetails['team_id']?>" />
<table id="Forms" width="98%" align="center" cellpadding="0" cellspacing="0" border="0" class="tableClass">
<tr>
    <td>
    	1.	Do you have all vehicle titles
    <br />
    <div style="padding:10px;"> <input type="radio"  name="do_you_have_all_vehicle_titles" value="Yes" <? if($do_you_have_all_vehicle_titles == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="do_you_have_all_vehicle_titles" value="No" <? if($do_you_have_all_vehicle_titles == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr>
    <td>
    	2.	Do you have all vehicle Authorisation papers
    <br />
    <div style="padding:10px;"> <input type="radio"  name="do_you_have_all_vehicle_authorisation_papers" value="Yes" 
	<? if($do_you_have_all_vehicle_authorisation_papers == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="do_you_have_all_vehicle_authorisation_papers" value="No" <? if($do_you_have_all_vehicle_authorisation_papers == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr>
    <td>
    	3.	Do you have all vehicle Circulation Papers
    <br />
    <div style="padding:10px;"> <input type="radio"  name="do_you_have_all_vehicle_circulation_papers" value="Yes" 
    <? if($do_you_have_all_vehicle_circulation_papers == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="do_you_have_all_vehicle_circulation_papers" value="No" <? if($do_you_have_all_vehicle_circulation_papers == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr>
    <td>
 <h3 style="padding-top:0px;">Enter registration details and expiry dates of Circulation papers</h3>    
    </td>
</tr>

<tr>
    <td>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableClass">
  <tr class="noborder">
    <td>Sr</td>
    <td>Vehicle Name</td>
    <td>Registration Detail</td>
    <td>Expiry Date {Format : dd/mm/yyyy}</td>
  </tr>
  <?php $counterOne	=	0;
  for($i=1; $i<16; $i++){ ?>	  
  <tr>
    <td><?=$i?></td>
    <td><input type="text"  name="vehicle_name_circulation_paper[]"  class="txarea1" value="<?=$allVehicleCirculationPapers[$counterOne]['vehicle_name']?>"/></td>
    <td><input type="text"  name="registration_circulation_paper[]"  class="txarea1" value="<?=$allVehicleCirculationPapers[$counterOne]['registration_detail']?>"/></td>
    <td><input type="text"  name="expiry_date_circulation_paper[]"  class="txarea1" value="<?=$allVehicleCirculationPapers[$counterOne]['expiry_date']?>"/></td>
  </tr>
  <? $counterOne++;
  } ?>
</table>    
    </td>
</tr>
<tr><td>&nbsp;</td></tr>

<tr>
    <td>
    	4.	Do you have vehicle insurance papers
    <br />
    <div style="padding:10px;"> <input type="radio"  name="do_you_have_all_vehicle_insurance_papers" value="Yes" 
     <? if($do_you_have_vehicle_insurance_papers == 'Yes'){?> checked="checked" <? } ?>/>&nbsp;Yes 	&nbsp;&nbsp;<input type="radio"  name="do_you_have_all_vehicle_insurance_papers" value="No" 
      <? if($do_you_have_vehicle_insurance_papers == 'No'){?> checked="checked" <? } ?>/>&nbsp;No    	</div>
    
    </td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
    <td>
 Enter registration details and expiry dates of insurance papers
    
    </td>
</tr>
<tr><td>&nbsp;</td></tr>

<tr>
    <td>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableClass">
  <tr>
    <td>Sr</td>
    <td>Vehicle Name</td>
    <td>Registration Detail</td>
    <td>Expiry Date {Format : dd/mm/yyyy}</td>
  </tr>
  <?php 
  $counterTwo	=	0;
  for($i=1; $i<16; $i++){ ?>	  
  <tr>
    <td><?=$i?></td>
    <td><input type="text"  name="vehicle_name_insurance_paper[]"  class="txarea1"  value="<?=$allVehicleInsurancePapers[$counterTwo]['vehicle_name']?>"/></td>
    <td><input type="text"  name="registration_insurance_paper[]"  class="txarea1" value="<?=$allVehicleInsurancePapers[$counterTwo]['registration_detail']?>"/></td>
    <td><input type="text"  name="expiry_date_insurance_paper[]"  class="txarea1" value="<?=$allVehicleInsurancePapers[$counterTwo]['expiry_date']?>"/></td>
  </tr>
  <? $counterTwo++;
  } ?>
</table>    
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

