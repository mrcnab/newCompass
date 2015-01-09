<?
class maintabs
{
	var $db = "";
	function maintabs()
	{
		$this -> db = new DBAccess();
	}	//	End of function maintab()
	
	function get_team_info_by_tour_id( $tour_id)
	{
		$q = "SELECT * FROM tbl_teams WHERE tour_id = ".$tour_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_maintab_info( $maintab_id, $status = 0 )
	
	
	function get_vehicle_document_info( $tour_id, $team_id)
	{
		$q = "SELECT * FROM tbl_vehicle_document WHERE tour_id = ".$tour_id." AND  team_id = ".$team_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_maintab_info( $maintab_id, $status = 0 )
	

	function get_pre_tour_paper_work_info( $tour_id, $team_id)
	{
		$q = "SELECT * FROM tbl_pre_tour_paper_work WHERE tour_id = ".$tour_id." AND  team_id = ".$team_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_maintab_info( $maintab_id, $status = 0 )
	
	
	function get_vehicle_maintenance_info( $tour_id, $team_id)
	{
		$q = "SELECT * FROM tbl_vehicle_maintenance WHERE tour_id = ".$tour_id." AND  team_id = ".$team_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_maintab_info( $maintab_id, $status = 0 )
	
	function get_post_tour_info( $tour_id, $team_id)
	{
		$q = "SELECT * FROM tbl_post_tour WHERE tour_id = ".$tour_id." AND  team_id = ".$team_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_maintab_info( $maintab_id, $status = 0 )
	
	
	function get_all_vehicle_circulation_papers($vehicle_document_id)
	{
		$q = "SELECT * FROM tbl_all_vehicle_circulation_papers 
				WHERE vehicle_document_id	=	$vehicle_document_id
		ORDER BY vehicle_circulation_papers_id ASC";
		$r = $this -> db -> getMultipleRecords( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}

	function get_all_vehicle_insurance_papers($vehicle_document_id)
	{
		$q = "SELECT * FROM tbl_all_vehicle_insurance_papers 
				WHERE vehicle_document_id	=	$vehicle_document_id
		ORDER BY vehicle_insurance_papers_id ASC";
		$r = $this -> db -> getMultipleRecords( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	

	
	function update_tour_maintabs($maintab_id, $updatecheckboxes)
	{
		$q1 =  " UPDATE tbl_crew_pre_tour_maintab SET `maintab_checked_status` = '' WHERE maintab_id = ".$maintab_id;
		$r1 = $this -> db -> updateRecord( $q1 );	

		for($i=0; $i < count($updatecheckboxes); $i++){
			$listDetails	=	$this->get_pre_tour_result_by_crew_pre_tour_maintab_id($updatecheckboxes[$i]);
			$q =  " UPDATE tbl_crew_pre_tour_maintab SET `maintab_checked_status` = 'on' , `modifieddate` = '".date('Y-m-d H:i:s')."' WHERE crew_pre_tour_maintab_id = ".$updatecheckboxes[$i];
			$r = $this -> db -> updateRecord( $q );
		}		
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function  update_maintab( )
	
	


	function add_vehicle_circulation_paper_detail( $vehicle_document_id, $vehicle_name_circulation_paper, $registration_circulation_paper, 
													$expiry_date_circulation_paper)
	{
	
			for($i=0; $i < count($vehicle_name_circulation_paper); $i++){		
				$q = "INSERT INTO tbl_all_vehicle_circulation_papers
						(`vehicle_document_id`, `vehicle_name`, `registration_detail`, `expiry_date` , `addeddate`)
					 VALUES
					 ('".$vehicle_document_id."', '".$vehicle_name_circulation_paper[$i]."', '".$registration_circulation_paper[$i]."',
					  '".$expiry_date_circulation_paper[$i]."', '".date('Y-m-d H:i:s')."')";
				$r = $this -> db -> insertRecord( $q );		
			}
			if( $r )
				return true;
			else
				return false;		
	}	//	End of function add_vehicle_document( )

	function add_vehicle_insurance_paper_detail( $vehicle_document_id, $vehicle_name_insurance_paper, $registration_insurance_paper, 
													$expiry_date_insurance_paper)
	{
			for($i=0; $i < count($vehicle_name_insurance_paper); $i++){	
				$q = "INSERT INTO tbl_all_vehicle_insurance_papers
						(`vehicle_document_id`, `vehicle_name`, `registration_detail`, `expiry_date` , `addeddate`)
					 VALUES
					 ('".$vehicle_document_id."', '".$vehicle_name_insurance_paper[$i]."', '".$registration_insurance_paper[$i]."',
					  '".$expiry_date_insurance_paper[$i]."', '".date('Y-m-d H:i:s')."')";
				$r = $this -> db -> insertRecord( $q );			
			}
			if( $r )
				return true;
			else
				return false;		
	}	//	End of function add_vehicle_document( )	
	
	function add_vehicle_document( $tour_id, $team_id, $do_you_have_all_vehicle_titles, $do_you_have_all_vehicle_authorisation_papers, 
									$do_you_have_all_vehicle_circulation_papers, $vehicle_name_circulation_paper, 
									$registration_circulation_paper, $expiry_date_circulation_paper, 
									$do_you_have_all_vehicle_insurance_papers, $vehicle_name_insurance_paper, 
									$registration_insurance_paper, $expiry_date_insurance_paper )
	{
			$q = "INSERT INTO tbl_vehicle_document
					(`tour_id`, `team_id`, `do_you_have_all_vehicle_titles`, `do_you_have_all_vehicle_authorisation_papers`,
					`do_you_have_all_vehicle_circulation_papers`, `do_you_have_vehicle_insurance_papers`, `addeddate`)
				 VALUES
				 ('".$tour_id."', '".$team_id."', '".$do_you_have_all_vehicle_titles."', '".$do_you_have_all_vehicle_authorisation_papers."',
				 '".$do_you_have_all_vehicle_circulation_papers."', '".$do_you_have_all_vehicle_insurance_papers."',  '".date('Y-m-d H:i:s')."')";

			$r = $this -> db -> insertRecord( $q );
						
			$lastInsertedId 	= $this -> db ->getNewId();
			$vehicleCirculationPapers	=	$this->add_vehicle_circulation_paper_detail($lastInsertedId,$vehicle_name_circulation_paper,
			$registration_circulation_paper,$expiry_date_circulation_paper);	
			
			$vehicleInsurancePapers	=	$this->add_vehicle_insurance_paper_detail($lastInsertedId,$vehicle_name_insurance_paper,
			$registration_insurance_paper,$expiry_date_insurance_paper);	
			
			if( $vehicleInsurancePapers == true )
				return true;
			else
				return false;
		
	}	//	End of function add_vehicle_document( )
	
	
		
	function update_vehicle_document( $do_you_have_all_vehicle_titles, $do_you_have_all_vehicle_authorisation_papers, 
									$do_you_have_all_vehicle_circulation_papers, $vehicle_name_circulation_paper, 
									$registration_circulation_paper, $expiry_date_circulation_paper, 
									$do_you_have_all_vehicle_insurance_papers, $vehicle_name_insurance_paper, 
									$registration_insurance_paper, $expiry_date_insurance_paper, $vehicle_document_id )
	{
		$q = "UPDATE tbl_vehicle_document SET 
			`do_you_have_all_vehicle_titles` = '".$do_you_have_all_vehicle_titles."',
			`do_you_have_all_vehicle_authorisation_papers` = '".$do_you_have_all_vehicle_authorisation_papers."',
			`do_you_have_all_vehicle_circulation_papers` = '".$do_you_have_all_vehicle_circulation_papers."',
			`do_you_have_vehicle_insurance_papers` = '".$do_you_have_all_vehicle_insurance_papers."', 
			`modifieddate` = '".date('Y-m-d H:i:s')."'
			WHERE vehicle_document_id = ".$vehicle_document_id;
		$r = $this -> db -> updateRecord( $q );
		
		$delCirPaperDetails	=	$this->delete_all_vehicle_circulation_paper_detail($vehicle_document_id);	
		if($delCirPaperDetails){
		$vehicleCirculationPapers	=	$this->add_vehicle_circulation_paper_detail($vehicle_document_id,$vehicle_name_circulation_paper,
			$registration_circulation_paper,$expiry_date_circulation_paper);	
		}
		
		$delCirPaperDetails	=	$this->delete_all_vehicle_insurance_paper_detail($vehicle_document_id);
		if($delCirPaperDetails){
		$vehicleInsurancePapers	=	$this->add_vehicle_insurance_paper_detail($vehicle_document_id,$vehicle_name_insurance_paper,
			$registration_insurance_paper,$expiry_date_insurance_paper);	
		}
		if( $vehicleInsurancePapers == true )
				return true;
			else
				return false;
	}	//	End of function  update_maintab( )
	

	function delete_all_vehicle_circulation_paper_detail( $vehicle_document_id )
	{
		$q = "DELETE FROM tbl_all_vehicle_circulation_papers WHERE vehicle_document_id = ".$vehicle_document_id;
		$r = $this -> db -> deleteRecord( $q );
		if( $r )
			return true;
		else
			return false;			
	}	//	End of function delete_maintab( $maintab_id )
	
	
	
	function add_pre_tour_paper_work( $tour_id, $team_id, $do_you_have_tour_manifest, $do_you_have_client_manifest, 
									$do_you_have_itinerary_manifest, $do_you_have_passenger_manifest, 
									$do_you_have_welcome_letter_prepared, $do_you_have_hotel_list_prepared, 
									$do_you_have_tour_dossier_printed, $do_you_have_pre_departure_meeting_checklist, 
									$do_you_have_bike_briefing_checklist, $do_you_have_all_city_sheets_for_tour_printed,
									$do_you_have_enough_tshirts_ordered, $do_you_have_tour_maps_and_route_notes,
									$have_you_read_the_crew_training_manual)
	{
			$q = "INSERT INTO tbl_pre_tour_paper_work
					(`tour_id`, `team_id`, `do_you_have_tour_manifest`, `do_you_have_client_manifest`,
					`do_you_have_itinerary_manifest`, `do_you_have_passenger_manifest`,
					`do_you_have_welcome_letter_prepared`, `do_you_have_hotel_list_prepared`,
					`do_you_have_tour_dossier_printed`, `do_you_have_pre_departure_meeting_checklist`,
					`do_you_have_bike_briefing_checklist`, `do_you_have_all_city_sheets_for_tour_printed`,
					`do_you_have_enough_tshirts_ordered`, `do_you_have_tour_maps_and_route_notes`,
					`have_you_read_the_crew_training_manual`, `addeddate`)
				 VALUES
				 ('".$tour_id."', '".$team_id."', '".$do_you_have_tour_manifest."', '".$do_you_have_client_manifest."',
				 '".$do_you_have_itinerary_manifest."', '".$do_you_have_passenger_manifest."',  
				 '".$do_you_have_welcome_letter_prepared."', '".$do_you_have_hotel_list_prepared."',  
				 '".$do_you_have_tour_dossier_printed."', '".$do_you_have_pre_departure_meeting_checklist."',  
				 '".$do_you_have_bike_briefing_checklist."', '".$do_you_have_all_city_sheets_for_tour_printed."',  
				 '".$do_you_have_enough_tshirts_ordered."', '".$do_you_have_tour_maps_and_route_notes."',  
				 '".$have_you_read_the_crew_training_manual."', '".date('Y-m-d H:i:s')."')";

			$r = $this -> db -> insertRecord( $q );
			if($r )
				return true;
			else
				return false;
		
	}	//	End of function add_vehicle_document( )
	
	
	function update_pre_tour_paper_work( $do_you_have_tour_manifest, $do_you_have_client_manifest, 
									$do_you_have_itinerary_manifest, $do_you_have_passenger_manifest, 
									$do_you_have_welcome_letter_prepared, $do_you_have_hotel_list_prepared, 
									$do_you_have_tour_dossier_printed, $do_you_have_pre_departure_meeting_checklist, 
									$do_you_have_bike_briefing_checklist, $do_you_have_all_city_sheets_for_tour_printed,
									$do_you_have_enough_tshirts_ordered, $do_you_have_tour_maps_and_route_notes,
									$have_you_read_the_crew_training_manual, $pre_tour_paper_work_id )
	{
		$q = "UPDATE tbl_pre_tour_paper_work SET 
			`do_you_have_tour_manifest` = '".$do_you_have_tour_manifest."',
			`do_you_have_client_manifest` = '".$do_you_have_client_manifest."',
			`do_you_have_itinerary_manifest` = '".$do_you_have_itinerary_manifest."',
			`do_you_have_passenger_manifest` = '".$do_you_have_passenger_manifest."',
			`do_you_have_welcome_letter_prepared` = '".$do_you_have_welcome_letter_prepared."', 
			
			`do_you_have_hotel_list_prepared` = '".$do_you_have_hotel_list_prepared."',
			`do_you_have_tour_dossier_printed` = '".$do_you_have_tour_dossier_printed."',
			`do_you_have_pre_departure_meeting_checklist` = '".$do_you_have_pre_departure_meeting_checklist."',
			`do_you_have_bike_briefing_checklist` = '".$do_you_have_bike_briefing_checklist."', 
			
			`do_you_have_all_city_sheets_for_tour_printed` = '".$do_you_have_all_city_sheets_for_tour_printed."',
			`do_you_have_enough_tshirts_ordered` = '".$do_you_have_enough_tshirts_ordered."',
			`do_you_have_tour_maps_and_route_notes` = '".$do_you_have_tour_maps_and_route_notes."',
			`have_you_read_the_crew_training_manual` = '".$have_you_read_the_crew_training_manual."', 
			`modifieddate` = '".date('Y-m-d H:i:s')."'
			WHERE pre_tour_paper_work_id = ".$pre_tour_paper_work_id;
		$r = $this -> db -> updateRecord( $q );
		if( $r)
				return true;
			else
				return false;
	}	//	End of function  update_maintab( )
	
	
	function add_vehicle_maintenacnce( $tour_id, $team_id, $has_all_pre_tour_maintenance_as_per_schedule_been_performed, 
									$have_vehicle_logbooks_been_updated_in_db, $when_were_the_logbooks_last_updated, 
									$has_inventory_list_been_updated_in_db, $when_was_the_inventory_list_updated, 
									$have_any_required_spare_parts_been_updated, $when_were_required_spare_parts_updated)
	{
		$q = "INSERT INTO tbl_vehicle_maintenance
					(`tour_id`, `team_id`, `has_all_pre_tour_maintenance_as_per_schedule_been_performed`,
					`have_vehicle_logbooks_been_updated_in_db`, `when_were_the_logbooks_last_updated`,
					`has_inventory_list_been_updated_in_db`, `when_was_the_inventory_list_updated`,
					`have_any_required_spare_parts_been_updated`, `when_were_required_spare_parts_updated`, `addeddate`)
				 VALUES
				 ('".$tour_id."', '".$team_id."', '".$has_all_pre_tour_maintenance_as_per_schedule_been_performed."',
				 '".$have_vehicle_logbooks_been_updated_in_db."', '".$when_were_the_logbooks_last_updated."',  
				 '".$has_inventory_list_been_updated_in_db."', '".$when_was_the_inventory_list_updated."',  
				 '".$have_any_required_spare_parts_been_updated."', '".$when_were_required_spare_parts_updated."', '".date('Y-m-d H:i:s')."')";

			$r = $this -> db -> insertRecord( $q );
			if($r )
				return true;
			else
				return false;
		
	}	//	End of function add_vehicle_document( )
	
	
	function update_vehicle_maintenacnce(  $has_all_pre_tour_maintenance_as_per_schedule_been_performed, 
									$have_vehicle_logbooks_been_updated_in_db, $when_were_the_logbooks_last_updated, 
									$has_inventory_list_been_updated_in_db, $when_was_the_inventory_list_updated, 
									$have_any_required_spare_parts_been_updated, $when_were_required_spare_parts_updated, $vehicle_maintenance_id )
	{
		$q = "UPDATE tbl_vehicle_maintenance SET 
			`has_all_pre_tour_maintenance_as_per_schedule_been_performed` = '".$has_all_pre_tour_maintenance_as_per_schedule_been_performed."',
			`have_vehicle_logbooks_been_updated_in_db` = '".$have_vehicle_logbooks_been_updated_in_db."',
			`when_were_the_logbooks_last_updated` = '".$when_were_the_logbooks_last_updated."',
			`has_inventory_list_been_updated_in_db` = '".$has_inventory_list_been_updated_in_db."',
			`when_was_the_inventory_list_updated` = '".$when_was_the_inventory_list_updated."',			
			`have_any_required_spare_parts_been_updated` = '".$have_any_required_spare_parts_been_updated."',
			`when_were_required_spare_parts_updated` = '".$when_were_required_spare_parts_updated."',
			`modifieddate` = '".date('Y-m-d H:i:s')."'
			WHERE vehicle_maintenance_id = ".$vehicle_maintenance_id;
		$r = $this -> db -> updateRecord( $q );
		if( $r)
				return true;
			else
				return false;
	}	//	End of function  update_maintab( )
	
	function add_post_tour( $tour_id, $team_id, $have_you_completed_your_accounts, 
									$have_you_collected_questionnaires, $have_you_emailed_wages_sheet, 
									$have_you_uploaded_waypoints_into_db, $when_were_the_waypoints_updated, 
									$have_you_updated_the_tour_manual)
	{
		$q = "INSERT INTO tbl_post_tour
					(`tour_id`, `team_id`, `have_you_completed_your_accounts`,
					`have_you_collected_questionnaires`, `have_you_emailed_wages_sheet`,
					`have_you_uploaded_waypoints_into_db`, `when_were_the_waypoints_updated`,
					`have_you_updated_the_tour_manual`, `addeddate`)
				 VALUES
				 ('".$tour_id."', '".$team_id."', '".$have_you_completed_your_accounts."',
				 '".$have_you_collected_questionnaires."', '".$have_you_emailed_wages_sheet."',  
				 '".$have_you_uploaded_waypoints_into_db."', '".$when_were_the_waypoints_updated."',  
				 '".$have_you_updated_the_tour_manual."', '".date('Y-m-d H:i:s')."')";

			$r = $this -> db -> insertRecord( $q );
			if($r )
				return true;
			else
				return false;
		
	}	//	End of function add_vehicle_document( )

	
	function update_post_tour(   $have_you_completed_your_accounts, 
									$have_you_collected_questionnaires, $have_you_emailed_wages_sheet, 
									$have_you_uploaded_waypoints_into_db, $when_were_the_waypoints_updated, 
									$have_you_updated_the_tour_manual, $post_tour_id )
	{
		$q = "UPDATE tbl_post_tour SET 
			`have_you_completed_your_accounts` = '".$have_you_completed_your_accounts."',
			`have_you_collected_questionnaires` = '".$have_you_collected_questionnaires."',
			`have_you_emailed_wages_sheet` = '".$have_you_emailed_wages_sheet."',
			`have_you_uploaded_waypoints_into_db` = '".$have_you_uploaded_waypoints_into_db."',
			`when_were_the_waypoints_updated` = '".$when_were_the_waypoints_updated."',			
			`have_you_updated_the_tour_manual` = '".$have_you_updated_the_tour_manual."'
			WHERE post_tour_id = ".$post_tour_id;
		$r = $this -> db -> updateRecord( $q );
		if( $r)
				return true;
			else
				return false;
	}	//	End of function  update_maintab( )
	
	function delete_all_vehicle_insurance_paper_detail( $vehicle_document_id )
	{
		$q = "DELETE FROM tbl_all_vehicle_insurance_papers WHERE vehicle_document_id = ".$vehicle_document_id;
		$r = $this -> db -> deleteRecord( $q );
		if( $r )
			return true;
		else
			return false;			
	}	//	End of function delete_maintab( $maintab_id )
	
	function fill_tour_combo( $form_name, $tour_id )
	{
		$q = "SELECT * FROM tbl_tours";
		$r = $this -> db -> getMultipleRecords( $q );
		$combo = '<select class="txareacombow" name="tour_id" id="tour_id" >
					<option value="">---Select Tour---</option>';
		if( $r != false )
		{
			for( $i = 0; $i < count( $r ); $i++ )
			{
				$selected = $tour_id == $r[$i]['tour_id'] ? "selected" : "";
				$combo .= '<option '.$selected.' value="'.$r[$i]['tour_id'].'">'.$r[$i]['tour_name'].'</option>';
			}	//	End of for Looooooop
		}	//	End of if( $r != false )
		$combo .= '</select>';
		
		return $combo;
	}	//	End of function fill_maintab_combo( )
	

	
	function display_maintabs_listing( $title_dev_maintab_listing_records, $page_link, $pageno )
	{
		if( $title_dev_maintab_listing_records != false )
		{
			$sr = ($pageno * RECORDS_PER_PAGE) - RECORDS_PER_PAGE +1;
			for( $i = 0; $i < count( $title_dev_maintab_listing_records ); $i++ )
			{
				$maintab_id = $title_dev_maintab_listing_records[$i]['maintab_id'];
				$maintab_status = $title_dev_maintab_listing_records[$i]['maintab_status'];
				$teamDetails	=	$this->get_team_by_tour_id($title_dev_maintab_listing_records[$i]['tour_id']);
				$tourDetails	=	$this->get_tour_info($title_dev_maintab_listing_records[$i]['tour_id']);
				$edit_link = "<a class='mislink' href='index.php?module_name=maintab_management&amp;file_name=add_maintab&amp;maintab_id=".$maintab_id."&amp;tab=maintab' title='Edit'><img src='images/edit.png' alt='Edit' border='0'></a>";
				
				$delete_link = "<a class='mislink' title='Delete' href='javascript:void(0);' onclick='javascript: if( confirm(\"Are you sure to delete?\") ) { window.location= \"".$page_link."&amp;action=delete&amp;tab=maintab&amp;maintab_id=".$maintab_id."\"; }'><img src='images/delete.png' alt='Edit' border='0'></a>";	
				
				if($maintab_status == 1){
					$status	=	"Started";
				}else if($maintab_status == 2){
					$status	=	"In Process";
				}else if($maintab_status == 3){
					$status	=	"Departured";
				}else if($maintab_status == 4){
					$status	=	"Returned";
				}else{
					$status	=	"Finished";
				}
				$startDate	=	strtotime($title_dev_maintab_listing_records[$i]['starteddate']);
				
				$class = $i % 2 == 0 ? "class='even_row'" : "class='odd_row'";
				$title_dev_maintab_listing .= '<tr '.$class.'>
									<td>'.$sr.'</td>
									<td>'.$title_dev_maintab_listing_records[$i]['maintab_title'].'</td>
									<td>'.$tourDetails['tour_name'].'</td>
									<td>'.$teamDetails['team_name'].'</td>
									<td align="center">'.$status.'</td>
									<td align="center">'.date("j-F-Y",$startDate).'</td>';
						if( $_SESSION['admin_user_type'] == "1" ){					
						$title_dev_maintab_listing .= '<td align="center">'.$edit_link.'</td>									
														<td align="center">'.$delete_link.'</td>';
						}		
				$title_dev_maintab_listing .= '</tr>';
				$sr++;
			}	//	End of For Loooooooooop
		}	//	End of if( $title_dev_maintab_listing_records != false )
		else
		{
			$title_dev_maintab_listing = '<tr>
									<td colspan="5" class="Bad-msg" align="center">'.NO_RECORD_FOUND.'</td>
								</tr>';
		}
		return $title_dev_maintab_listing;
	}	//	End of function display_maintab_listing_admin( $title_dev_maintab_listing )

	
	function generateAutoString($length = 49)
	{
	  $autoString = "";
	  $possible = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
	  $i = 0; 
	  while ($i < $length) { 
	
		$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
			
		if (!strstr($autoString, $char)) { 
		  $autoString .= $char;
		  $i++;
		}
	  }
	  
	  return $autoString;
	}
	

	public function resize($filename, $width, $height) {
		
	if (!file_exists(DIR_IMAGE . $filename) || !is_file(DIR_IMAGE . $filename)) {
			return;
		} 
	
		$info = pathinfo($filename);
		$extension = $info['extension'];

		$old_image = $filename;
		$new_image = 'cache/' . substr($filename, 0, strrpos($filename, '.')) . '-' . $width . 'x' . $height . '.' . $extension;

		if (!file_exists(DIR_IMAGE . $new_image) || (filemtime(DIR_IMAGE . $old_image) > filemtime(DIR_IMAGE . $new_image))) {
			$path = '';

			$directories = explode('/', dirname(str_replace('../', '', $new_image)));
			
			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;
				
				if (!file_exists(DIR_IMAGE . $path)) {
					@mkdir(DIR_IMAGE . $path, 0777);
				}		
			}
			
			$image = new Image(DIR_IMAGE . $old_image);
			$image->resize($width, $height);
			$image->save(DIR_IMAGE . $new_image);
		}
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			return HTTPS_IMAGE . $new_image;
		} else {
			return HTTP_IMAGE . $new_image;
		}	
	}	
	
}	//	End of class maintab
?>