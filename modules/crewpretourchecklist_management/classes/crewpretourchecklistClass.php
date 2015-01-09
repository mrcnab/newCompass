<?
class crewpretourchecklist
{
	var $db = "";
	function crewpretourchecklist()
	{
		$this -> db = new DBAccess();
	}	//	End of function checklist()
	
	function get_checklist_info( $crew_pre_tour_checklist_id)
	{
		$q = "SELECT * FROM tbl_crew_pre_tour_checklist WHERE crew_pre_tour_checklist_id = ".$crew_pre_tour_checklist_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_checklist_info( $crew_pre_tour_checklist_id, $status = 0 )
	

	function get_checklist_info_by_checklist_id( $checklist_id)
	{
		$q = "SELECT * FROM tbl_tour_form_checklists_manager WHERE checklist_id = ".$checklist_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_checklist_info( $crew_pre_tour_checklist_id, $status = 0 )
	
	function get_checktype_info( $checklist_type_category_id)
	{
		$q = "SELECT * FROM tbl_checklist_type_category WHERE checklist_type_category_id = ".$checklist_type_category_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	
	
	function get_all_checklists()
	{
		$q = "SELECT * FROM tbl_tour_form_checklists_manager";
		$r = $this -> db -> getMultipleRecords( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_checklist_info( $crew_pre_tour_checklist_id, $status = 0 )
	

	function update_checklist( $checklist_id,  $crew_pre_tour_type,  $crew_pre_tour_text, $crew_pre_tour_status, $crew_pre_tour_checklist_id )
	{
		$q = "UPDATE tbl_crew_pre_tour_checklist SET `checklist_id` = '".$checklist_id."', `crew_pre_tour_type` = '".$crew_pre_tour_type."',  `crew_pre_tour_text` = '".$crew_pre_tour_text."' ,  `crew_pre_tour_status` = '".$crew_pre_tour_status."' WHERE crew_pre_tour_checklist_id = ".$crew_pre_tour_checklist_id;
		$r = $this -> db -> updateRecord( $q );
		if( $r != false )
			return true;
		else
			return false;
	}	//	End of function  update_checklist( $parent_id, $checklist_title, $checklist_text, $meta_title, $meta_description, $meta_keywords, $sef_link, $checklist_status, $crew_pre_tour_checklist_id )
	
	function add_record( $checklist_id, $crew_pre_tour_type, $crew_pre_tour_text, $crew_pre_tour_status)
	{
		$q = "INSERT INTO tbl_crew_pre_tour_checklist(`checklist_id`, `crew_pre_tour_type`, `crew_pre_tour_text`, `crew_pre_tour_status`,`addeddate`)
		 VALUES('".$checklist_id."', '".$crew_pre_tour_type."', '".$crew_pre_tour_text."',  '".$crew_pre_tour_status."',  '".date('Y-m-d H:i:s')."')";
		$r = $this -> db -> insertRecord( $q );
		if( $r != false )
			return true;
		else
			return false;		
	}	//	End of function add_checklist()

	function delete_checklist( $crew_pre_tour_checklist_id )
	{
		$q = "DELETE FROM tbl_crew_pre_tour_checklist WHERE crew_pre_tour_checklist_id = ".$crew_pre_tour_checklist_id;
		$r = $this -> db -> deleteRecord( $q );
		if( $r )
			return true;
		else
			return false;			
	}	//	End of function delete_checklist( $crew_pre_tour_checklist_id )
	
	function fill_tour_checklists_combo( $form_name, $checklist_id )
	{
		$q = "SELECT * FROM tbl_tour_form_checklists_manager WHERE checklist_status != 5";
		$r = $this -> db -> getMultipleRecords( $q );
		$combo = '<select class="txareacombow" name="checklist_id" id="checklist_id" >
					<option value="">---Select Tour Check List---</option>';
		if( $r != false )
		{
			for( $i = 0; $i < count( $r ); $i++ )
			{
				$selected = $checklist_id == $r[$i]['checklist_id'] ? "selected" : "";
				$combo .= '<option '.$selected.' value="'.$r[$i]['checklist_id'].'">'.$r[$i]['checklist_title'].'</option>';
			}	//	End of for Looooooop
		}	//	End of if( $r != false )
		$combo .= '</select>';
		
		return $combo;
	}	//	End of function fill_checklist_combo( )
	
	function fill_checklist_type_combo( $form_name, $checklist_type_category_id )
	{
		$q = "SELECT * FROM tbl_checklist_type_category WHERE checktype_status = 1";
		$r = $this -> db -> getMultipleRecords( $q );
		$combo = '<select class="txareacombow" name="crew_pre_tour_type" id="crew_pre_tour_type" >
					<option value="">---Select Check List Category/Group---</option>';
		if( $r != false )
		{
			for( $i = 0; $i < count( $r ); $i++ )
			{
				$selected = $checklist_type_category_id == $r[$i]['checklist_type_category_id'] ? "selected" : "";
				$combo .= '<option '.$selected.' value="'.$r[$i]['checklist_type_category_id'].'">'.$r[$i]['tour_type_category'].'</option>';
			}	//	End of for Looooooop
		}	//	End of if( $r != false )
		$combo .= '</select>';
		
		return $combo;
	}	//	End of function fill_checklist_combo( )
	
	function get_status( $crew_pre_tour_checklist_id )
	{
		$q = "SELECT crew_pre_tour_status FROM tbl_crew_pre_tour_checklist WHERE crew_pre_tour_checklist_id = ".$crew_pre_tour_checklist_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r['crew_pre_tour_status'];
		else
			return false;
	}	//	End of function get_dept_status( $dept_id )
	
	function set_status( $crew_pre_tour_checklist_id )
	{
		$status = $this -> get_status( $crew_pre_tour_checklist_id );
		$status = $status == 1 ? 0 : 1;
		$q = "UPDATE tbl_crew_pre_tour_checklist SET crew_pre_tour_status = ".$status." WHERE crew_pre_tour_checklist_id = ".$crew_pre_tour_checklist_id;
		$r = $this -> db -> updateRecord( $q );
		if( $r != false )
			return true;
		else
			return false;
	}	//	End of function set_dept_status( $status, $dept_id )
	
	
	function display_checklists_listing( $title_dev_checklist_listing_records, $page_link, $pageno )
	{
		if( $title_dev_checklist_listing_records != false )
		{
			$sr = ($pageno * RECORDS_PER_PAGE) - RECORDS_PER_PAGE +1;
			for( $i = 0; $i < count( $title_dev_checklist_listing_records ); $i++ )
			{
				$crew_pre_tour_checklist_id = $title_dev_checklist_listing_records[$i]['crew_pre_tour_checklist_id'];
				$crew_pre_tour_type = $title_dev_checklist_listing_records[$i]['crew_pre_tour_type'];
				$crew_pre_tour_text = $title_dev_checklist_listing_records[$i]['crew_pre_tour_text'];
				$checklistDetails	=	$this->get_checklist_info_by_checklist_id($title_dev_checklist_listing_records[$i]['checklist_id']);
				$checkTypeDetails	=	$this->get_checktype_info($crew_pre_tour_type);
				
				
				
				$edit_link = "<a class='mislink' href='index.php?module_name=crewpretourchecklist_management&amp;file_name=add_crewpretourchecklist&amp;crew_pre_tour_checklist_id=".$crew_pre_tour_checklist_id."&amp;tab=checklist' title='Edit'><img src='images/edit.png' alt='Edit' border='0'></a>";
				
				$delete_link = "<a class='mislink' title='Delete' href='javascript:void(0);' onclick='javascript: if( confirm(\"Are you sure to delete?\") ) { window.location= \"".$page_link."&amp;action=delete&amp;tab=checklist&amp;crew_pre_tour_checklist_id=".$crew_pre_tour_checklist_id."\"; }'><img src='images/delete.png' alt='Edit' border='0'></a>";	
				
				$status = $title_dev_checklist_listing_records[$i]['crew_pre_tour_status'] == 1 ? "<a href='".$page_link."&amp;crew_pre_tour_checklist_id=".$crew_pre_tour_checklist_id."&amp;action=change_status&amp;tab=checklist'  title='In Active'><span class='active'><img src='images/active.png' alt='Active' border='0'></span></a>" : "<a class='inactive' href='".$page_link."&amp;crew_pre_tour_checklist_id=".$crew_pre_tour_checklist_id."&amp;action=change_status&amp;tab=checklist' title='Active'><span class='inactive'><img src='images/inactive.png' alt='Inactive' border='0'></span></a>";
			
				$class = $i % 2 == 0 ? "class='even_row'" : "class='odd_row'";
				$title_dev_checklist_listing .= '<tr '.$class.'>
									<td>'.$sr.'</td>
									<td>'.$checklistDetails['checklist_title'].'</td>
									<td>'.$checkTypeDetails['tour_type_category'].'</td>
									<td>'.$crew_pre_tour_text.'</td>';
						if( $_SESSION['admin_user_type'] == "1" ){					
				$title_dev_checklist_listing .= '<td align="center">'.$status.'</td>
												<td align="center">'.$edit_link.'</td>									
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