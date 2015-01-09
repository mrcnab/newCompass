<?
class checklists
{
	var $db = "";
	function checklists()
	{
		$this -> db = new DBAccess();
	}	//	End of function checklist()
	
	function get_checklist_info( $checklist_id)
	{
		$q = "SELECT * FROM tbl_tour_form_checklists_manager WHERE checklist_id = ".$checklist_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_checklist_info( $checklist_id, $status = 0 )
	
	function get_team_by_tour_id( $tour_id)
	{
		$q = "SELECT * FROM tbl_teams WHERE tour_id = ".$tour_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_checklist_info( $checklist_id, $status = 0 )
	
	function get_tour_info( $tour_id)
	{
		$q = "SELECT * FROM tbl_tours WHERE tour_id = ".$tour_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_checklist_info( $checklist_id, $status = 0 )
	
	function get_all_tour_check_types($checklist_id)
	{
		$q = "SELECT * FROM `tbl_checklist_type_category` WHERE checktype_status = 1 AND `checklist_id` = ".$checklist_id;
		$r = $this -> db -> getMultipleRecords( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}
	
	function get_all_tour_check_lists($checklist_id,$crew_pre_tour_type)
	{
		$q = "SELECT * FROM tbl_crew_pre_tour_checklist 
				WHERE checklist_id	=	$checklist_id AND crew_pre_tour_type = $crew_pre_tour_type
		ORDER BY crew_pre_tour_checklist_id ASC";
		$r = $this -> db -> getMultipleRecords( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}
	
	function get_all_bikes_tour_check_lists( $checklist_id)
	{
		$q = "SELECT * FROM tbl_crew_pre_tour_checklist WHERE checklist_id = ".$checklist_id." AND crew_pre_tour_type = 1 ORDER BY crew_pre_tour_checklist_id ASC";
		$r = $this -> db -> getMultipleRecords( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}
	function get_all_admin_tour_check_lists( $checklist_id)
	{
		$q = "SELECT * FROM tbl_crew_pre_tour_checklist WHERE checklist_id = ".$checklist_id." AND crew_pre_tour_type = 2 ORDER BY crew_pre_tour_checklist_id ASC";
		$r = $this -> db -> getMultipleRecords( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_checklist_info( $crew_pre_tour_checklist_id, $status = 0 )
	
	function get_pre_tour_result_by_crew_pre_tour_checklist_id( $crew_pre_tour_checklist_id)
	{
		$q = "SELECT * FROM tbl_crew_pre_tour_checklist WHERE crew_pre_tour_checklist_id = ".$crew_pre_tour_checklist_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_checklist_info( $crew_pre_tour_checklist_id, $status = 0 )
	
	
	function update_tour_checklists($checklist_id, $updatecheckboxes)
	{
		$q1 =  " UPDATE tbl_crew_pre_tour_checklist SET `checklist_checked_status` = '' WHERE checklist_id = ".$checklist_id;
		$r1 = $this -> db -> updateRecord( $q1 );	

		for($i=0; $i < count($updatecheckboxes); $i++){
			$listDetails	=	$this->get_pre_tour_result_by_crew_pre_tour_checklist_id($updatecheckboxes[$i]);
			$q =  " UPDATE tbl_crew_pre_tour_checklist SET `checklist_checked_status` = 'on' , `modifieddate` = '".date('Y-m-d H:i:s')."' WHERE crew_pre_tour_checklist_id = ".$updatecheckboxes[$i];
			$r = $this -> db -> updateRecord( $q );
		}		
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function  update_checklist( )
	
	
	
	function update_checklist( $checklist_title,  $tour_id,  $checklist_status, $checklist_id )
	{
		$tourDetails	=	$this->get_team_by_tour_id($tour_id);
		$q = "UPDATE tbl_tour_form_checklists_manager SET `checklist_title` = '".$checklist_title."', `tour_id` = '".$tour_id."',  `team_id` = '".$tourDetails['team_id']."',    `checklist_status` = '".$checklist_status."', `modifieddate` = '".date('Y-m-d H:i:s')."' WHERE checklist_id = ".$checklist_id;
		$r = $this -> db -> updateRecord( $q );
		if( $r != false )
			return true;
		else
			return false;
	}	//	End of function  update_checklist( )
	
	function add_checklist( $checklist_title, $tour_id, $checklist_status)
	{
			$tourDetails	=	$this->get_team_by_tour_id($tour_id);
			$q = "INSERT INTO tbl_tour_form_checklists_manager(`checklist_title`, `tour_id`, `team_id`, `checklist_status`, `starteddate`)
			 VALUES('".$checklist_title."', '".$tour_id."', '".$tourDetails['team_id']."', '".$checklist_status."', '".date('Y-m-d H:i:s')."')";
			$r = $this -> db -> insertRecord( $q );
			if( $r != false )
				return true;
			else
				return false;
		
	}	//	End of function add_checklist( $parent_id, $checklist_title, $checklist_text, $meta_title, $meta_description, $meta_keywords, $sef_link, $checklist_status )

	function delete_checklist( $checklist_id )
	{
		$q = "DELETE FROM tbl_tour_form_checklists_manager WHERE checklist_id = ".$checklist_id;
		$r = $this -> db -> deleteRecord( $q );
		if( $r )
			return true;
		else
			return false;			
	}	//	End of function delete_checklist( $checklist_id )
	
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
	}	//	End of function fill_checklist_combo( )
	

	
	function display_checklists_listing( $title_dev_checklist_listing_records, $page_link, $pageno )
	{
		if( $title_dev_checklist_listing_records != false )
		{
			$sr = ($pageno * RECORDS_PER_PAGE) - RECORDS_PER_PAGE +1;
			for( $i = 0; $i < count( $title_dev_checklist_listing_records ); $i++ )
			{
				$checklist_id = $title_dev_checklist_listing_records[$i]['checklist_id'];
				$checklist_status = $title_dev_checklist_listing_records[$i]['checklist_status'];
				$teamDetails	=	$this->get_team_by_tour_id($title_dev_checklist_listing_records[$i]['tour_id']);
				$tourDetails	=	$this->get_tour_info($title_dev_checklist_listing_records[$i]['tour_id']);
				$edit_link = "<a class='mislink' href='index.php?module_name=checklist_management&amp;file_name=add_checklist&amp;checklist_id=".$checklist_id."&amp;tab=checklist' title='Edit'><img src='images/edit.png' alt='Edit' border='0'></a>";
				
				$delete_link = "<a class='mislink' title='Delete' href='javascript:void(0);' onclick='javascript: if( confirm(\"Are you sure to delete?\") ) { window.location= \"".$page_link."&amp;action=delete&amp;tab=checklist&amp;checklist_id=".$checklist_id."\"; }'><img src='images/delete.png' alt='Edit' border='0'></a>";	
				
				if($checklist_status == 1){
					$status	=	"Started";
				}else if($checklist_status == 2){
					$status	=	"In Process";
				}else if($checklist_status == 3){
					$status	=	"Departured";
				}else if($checklist_status == 4){
					$status	=	"Returned";
				}else{
					$status	=	"Finished";
				}
				$startDate	=	strtotime($title_dev_checklist_listing_records[$i]['starteddate']);
				
				$class = $i % 2 == 0 ? "class='even_row'" : "class='odd_row'";
				$title_dev_checklist_listing .= '<tr '.$class.'>
									<td>'.$sr.'</td>
									<td>'.$title_dev_checklist_listing_records[$i]['checklist_title'].'</td>
									<td>'.$tourDetails['tour_name'].'</td>
									<td>'.$teamDetails['team_name'].'</td>
									<td align="center">'.$status.'</td>
									<td align="center">'.date("j-F-Y",$startDate).'</td>';
						if( $_SESSION['admin_user_type'] == "1" ){					
						$title_dev_checklist_listing .= '<td align="center">'.$edit_link.'</td>									
														<td align="center">'.$delete_link.'</td>';
						}		
				$title_dev_checklist_listing .= '</tr>';
				$sr++;
			}	//	End of For Loooooooooop
		}	//	End of if( $title_dev_checklist_listing_records != false )
		else
		{
			$title_dev_checklist_listing = '<tr>
									<td colspan="5" class="Bad-msg" align="center">'.NO_RECORD_FOUND.'</td>
								</tr>';
		}
		return $title_dev_checklist_listing;
	}	//	End of function display_checklist_listing_admin( $title_dev_checklist_listing )

	
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
	
}	//	End of class checklist
?>