<?
class checktypes
{
	var $db = "";
	function checktypes()
	{
		$this -> db = new DBAccess();
	}	//	End of function checklist()
	
	function get_checklist_info( $checklist_type_category_id)
	{
		$q = "SELECT * FROM tbl_checklist_type_category WHERE checklist_type_category_id = ".$checklist_type_category_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_checklist_info( $checklist_type_category_id, $status = 0 )
	
	function get_checktype_info( $checklist_id)
	{
		$q = "SELECT * FROM tbl_tour_form_checklists_manager WHERE checklist_id = ".$checklist_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_checklist_info( $checklist_type_category_id, $status = 0 )

	function update_tour_checklists($checklist_type_category_id, $updatecheckboxes)
	{
		$q1 =  " UPDATE tbl_crew_pre_tour_checklist SET `checklist_checked_status` = '' WHERE checklist_type_category_id = ".$checklist_type_category_id;
		$r1 = $this -> db -> updateRecord( $q1 );	

		for($i=0; $i < count($updatecheckboxes); $i++){
			$listDetails	=	$this->get_pre_tour_result_by_crew_pre_tour_checklist_type_category_id($updatecheckboxes[$i]);
			$q =  " UPDATE tbl_crew_pre_tour_checklist SET `checklist_checked_status` = 'on' , `modifieddate` = '".date('Y-m-d H:i:s')."' WHERE crew_pre_tour_checklist_type_category_id = ".$updatecheckboxes[$i];
			$r = $this -> db -> updateRecord( $q );
		}		
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function  update_checklist( )
	
	
	
	function update_checklist( $checklist_id,  $tour_type_category,  $checktype_status, $checklist_type_category_id )
	{
		$q = "UPDATE tbl_checklist_type_category SET `checklist_id` = '".$checklist_id."',   `tour_type_category` = '".$tour_type_category."',
			`checktype_status` = '".$checktype_status."', `modifieddate` = '".date('Y-m-d H:i:s')."' WHERE checklist_type_category_id = ".$checklist_type_category_id;
		$r = $this -> db -> updateRecord( $q );
		if( $r != false )
			return true;
		else
			return false;
	}	//	End of function  update_checklist( )
	
	function add_checklist( $checklist_id, $tour_type_category, $checktype_status)
	{
			$q = "INSERT INTO tbl_checklist_type_category(`checklist_id`, `tour_type_category`, `checktype_status`, `addeddate`)
			 VALUES('".$checklist_id."', '".$tour_type_category."', '".$checktype_status."', '".date('Y-m-d H:i:s')."')";
			$r = $this -> db -> insertRecord( $q );
			if( $r != false )
				return true;
			else
				return false;
		
	}	//	End of function add_checklist( $parent_id, $tour_type_category, $checklist_text, $meta_title, $meta_description, $meta_keywords, $sef_link, $checktype_status )

	function delete_checklist( $checklist_type_category_id )
	{
		$q = "DELETE FROM tbl_checklist_type_category WHERE checklist_type_category_id = ".$checklist_type_category_id;
		$r = $this -> db -> deleteRecord( $q );
		if( $r )
			return true;
		else
			return false;			
	}	//	End of function delete_checklist( $checklist_type_category_id )
	
	function fill_checklist_combo( $form_name, $checklist_id )
	{
		$q = "SELECT * FROM tbl_tour_form_checklists_manager";
		$r = $this -> db -> getMultipleRecords( $q );
		$combo = '<select class="txareacombow" name="checklist_id" id="checklist_id" >
					<option value="">---Select Check List---</option>';
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
	

	
	function display_checklists_listing( $title_dev_checklist_listing_records, $page_link, $pageno )
	{
		if( $title_dev_checklist_listing_records != false )
		{
			$sr = ($pageno * RECORDS_PER_PAGE) - RECORDS_PER_PAGE +1;
			for( $i = 0; $i < count( $title_dev_checklist_listing_records ); $i++ )
			{
				$checklist_type_category_id = $title_dev_checklist_listing_records[$i]['checklist_type_category_id'];
				
				$checkListDetail	=	$this->get_checktype_info($title_dev_checklist_listing_records[$i]['checklist_id']);
				$checktype_status = $title_dev_checklist_listing_records[$i]['checktype_status'];
				
				$edit_link = "<a class='mislink' href='index.php?module_name=checktype_management&amp;file_name=add_checktype&amp;checklist_type_category_id=".$checklist_type_category_id."&amp;tab=checklist' title='Edit'><img src='images/edit.png' alt='Edit' border='0'></a>";
				
				$delete_link = "<a class='mislink' title='Delete' href='javascript:void(0);' onclick='javascript: if( confirm(\"Are you sure to delete?\") ) { window.location= \"".$page_link."&amp;action=delete&amp;tab=checklist&amp;checklist_type_category_id=".$checklist_type_category_id."\"; }'><img src='images/delete.png' alt='Edit' border='0'></a>";	
				
				$status = $checktype_status == 1 ? "<a href='".$page_link."&amp;checklist_type_category_id=".$checklist_type_category_id."&amp;action=change_status&amp;tab=checklist'  title='In Active'><span class='active'><img src='images/active.png' alt='Active' border='0'></span></a>" : "<a class='inactive' href='".$page_link."&amp;checklist_type_category_id=".$checklist_type_category_id."&amp;action=change_status&amp;tab=checklist' title='Active'><span class='inactive'><img src='images/inactive.png' alt='Inactive' border='0'></span></a>";
				
				
				$class = $i % 2 == 0 ? "class='even_row'" : "class='odd_row'";
				$title_dev_checklist_listing .= '<tr '.$class.'>
									<td>'.$sr.'</td>
									<td>'.$checkListDetail['checklist_title'].'</td>
									<td>'.$title_dev_checklist_listing_records[$i]['tour_type_category'].'</td>
									<td align="center">'.$status.'</td>
									<td align="center">'.$edit_link.'</td>									
									<td align="center">'.$delete_link.'</td>';
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

	function get_status( $checklist_type_category_id )
	{
		$q = "SELECT checktype_status FROM tbl_checklist_type_category WHERE checklist_type_category_id = ".$checklist_type_category_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r['checktype_status'];
		else
			return false;
	}	//	End of function get_dept_status( $dept_id )
	
	function set_status( $checklist_type_category_id )
	{
		$status = $this -> get_status( $checklist_type_category_id );
		$status = $status == 1 ? 0 : 1;
		$q = "UPDATE tbl_checklist_type_category SET checktype_status = ".$status." WHERE checklist_type_category_id = ".$checklist_type_category_id;
		$r = $this -> db -> updateRecord( $q );
		if( $r != false )
			return true;
		else
			return false;
	}	//	End of function set_dept_status( $status, $dept_id )
		
}	//	End of class checklist
?>