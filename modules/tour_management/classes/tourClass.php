<?
class tours
{
	var $db = "";
	function tours()
	{
		$this -> db = new DBAccess();
	}	//	End of function tour()
	
	function get_tour_info( $tour_id, $status = 0 )
	{
		$criteria = $status == 1 ? "tour_status = 1 AND " : "";
		$q = "SELECT * FROM tbl_tours WHERE ".$criteria." tour_id = ".$tour_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_tour_info( $tour_id, $status = 0 )
	
	function get_tour_status( $tour_id )
	{
		$q = "SELECT tour_status FROM tbl_tours WHERE tour_id = ".$tour_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r['tour_status'];
		else
			return false;
	}	//	End of function get_tour_status( $tour_id )
	
	function set_tour_status( $tour_id )
	{
		$status = $this -> get_tour_status( $tour_id );
		$status = $status == 1 ? 0 : 1;
		$q = "UPDATE tbl_tours SET tour_status = ".$status." WHERE tour_id = ".$tour_id;
		$r = $this -> db -> updateRecord( $q );
		if( $r != false )
			return true;
		else
			return false;
	}	//	End of function set_tour_status( $status, $tour_id )
	
	
	
	function update_tour( $tour_name, $tour_description, $tour_location,  $tour_start_date,  $tour_end_date, $tour_status , $tour_id )
	{	
		$q = "UPDATE tbl_tours SET `tour_name` = '".$tour_name."', `tour_description` = '".$tour_description."',  `tour_location` = '".$tour_location."', 
		 `tour_start_date` = '".$tour_start_date."',  `tour_end_date` = '".$tour_end_date."', `tour_status` = '".$tour_status."', `modifieddate` = '".date('Y-m-d H:i:s')."' WHERE tour_id = ".$tour_id;
		$r = $this -> db -> updateRecord( $q );
		if( $r != false )
			return true;
		else
			return false;
	}	//	End of function  update_tour( $parent_id, $tour_name, $tour_text, $meta_title, $meta_description, $meta_keywords, $sef_link, $tour_status, $tour_id )
	
	function add_tour( $tour_name, $tour_description, $tour_location,  $tour_start_date,  $tour_end_date, $tour_status )
	{
			$q = "INSERT INTO tbl_tours(`tour_name`, `tour_description`, `tour_location`, `tour_start_date`, `tour_end_date`,  `tour_status`, `addeddate`)
			 VALUES('".$tour_name."', '".$tour_description."', '".$tour_location."', '".$tour_start_date."',  '".$tour_end_date."',  '".$tour_status."', '".date('Y-m-d H:i:s')."')";
			$r = $this -> db -> insertRecord( $q );
			if( $r != false )
				return true;
			else
				return false;
		
	}	//	End of function add_tour()

	function delete_tour( $tour_id )
	{
		$q = "DELETE FROM tbl_tours WHERE tour_id = ".$tour_id;
		$r = $this -> db -> deleteRecord( $q );
		if( $r )
			return true;
		else
			return false;			
	}	//	End of function delete_tour( $tour_id )
	


	
	function display_tours_listing( $title_dev_tour_listing_records, $page_link, $pageno )
	{
		if( $title_dev_tour_listing_records != false )
		{
			$sr = ($pageno * RECORDS_PER_PAGE) - RECORDS_PER_PAGE +1;
			for( $i = 0; $i < count( $title_dev_tour_listing_records ); $i++ )
			{
				$tour_id = $title_dev_tour_listing_records[$i]['tour_id'];
				
				$status = $title_dev_tour_listing_records[$i]['tour_status'] == 1 ? "<a href='".$page_link."&amp;tour_id=".$tour_id."&amp;action=change_status&amp;tab=tour'  title='In Active'><span class='active'><img src='images/active.png' alt='Active' border='0'></span></a>" : "<a class='inactive' href='".$page_link."&amp;tour_id=".$tour_id."&amp;action=change_status&amp;tab=tour' title='Active'><span class='inactive'><img src='images/inactive.png' alt='Inactive' border='0'></span></a>";
				
				$edit_link = "<a class='mislink' href='index.php?module_name=tour_management&amp;file_name=add_tour&amp;tour_id=".$tour_id."&amp;tab=tour' title='Edit'><img src='images/edit.png' alt='Edit' border='0'></a>";
				
				$delete_link = "<a class='mislink' title='Delete' href='javascript:void(0);' onclick='javascript: if( confirm(\"Are you sure to delete?\") ) { window.location= \"".$page_link."&amp;action=delete&amp;tab=tour&amp;tour_id=".$tour_id."\"; }'><img src='images/delete.png' alt='Edit' border='0'></a>";
				
				$tour_description = $this -> remove_html_tags( $title_dev_tour_listing_records[$i]['tour_description'] );
				$tour_description = strlen( $tour_description ) > 160 ? substr( $tour_description, 0, 160)."..." : $tour_description;
				
				$class = $i % 2 == 0 ? "class='even_row'" : "class='odd_row'";
				$title_dev_tour_listing .= '<tr '.$class.'>
									<td>'.$sr.'</td>
			
									<td>'.$title_dev_tour_listing_records[$i]['tour_name'].'</td>
									<td>'.$tour_description.'</td>
									<td>'.$title_dev_tour_listing_records[$i]['tour_location'].'</td>
									<td>'.$title_dev_tour_listing_records[$i]['tour_start_date'].'</td>
									<td>'.$title_dev_tour_listing_records[$i]['tour_end_date'].'</td>';
				if( $_SESSION['admin_user_type'] == "1" ){							
				$title_dev_tour_listing .= '<td align="center">'.$status.'</td>
											<td align="center">'.$edit_link.'</td>	
											<td align="center">'.$delete_link.'</td>';
				}		
				$title_dev_tour_listing .= '</tr>';
				$sr++;
			}	//	End of For Loooooooooop
		}	//	End of if( $title_dev_tour_listing_records != false )
		else
		{
			$title_dev_tour_listing = '<tr>
									<td colspan="5" class="Bad-msg" align="center">'.NO_RECORD_FOUND.'</td>
								</tr>';
		}
		return $title_dev_tour_listing;
	}	//	End of function display_tour_listing_admin( $title_dev_tour_listing )


	function remove_html_tags( $document )
	{
		// $document should contain an HTML document.
		// This will remove HTML tags, javascript sections
		// and white space. It will also convert some
		// common HTML entities to their text equivalent.
		$search = array ('@<script[^>]*?>.*?</script>@si', // Strip out javascript
						 '@<[\/\!]*?[^<>]*?>@si',          // Strip out HTML tags
						 '@([\r\n])[\s]+@',                // Strip out white space
						 '@&(quot|#34);@i',                // Replace HTML entities
						 '@&(amp|#38);@i',
						 '@&(lt|#60);@i',
						 '@&(gt|#62);@i',
						 '@&(nbsp|#160);@i',
						 '@&(iexcl|#161);@i',
						 '@&(cent|#162);@i',
						 '@&(pound|#163);@i',
						 '@&(copy|#169);@i',
						 '@&#(\d+);@e');                    // evaluate as php
		
		$replace = array ('',
						  '',
						  '\1',
						  '"',
						  '&',
						  '<',
						  '>',
						  ' ',
						  chr(161),
						  chr(162),
						  chr(163),
						  chr(169),
						  'chr(\1)');
		
		$text = preg_replace($search, $replace, $document);
		return $text;
	}	//	End of function remove_html_tags( $document )
	
}	//	End of class tour
?>