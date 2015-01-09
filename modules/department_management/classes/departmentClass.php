<?
class department
{
	var $db = "";
	function department()
	{
		$this -> db = new DBAccess();
	}	//	End of function employee()
	
	function get_department_info( $dept_id, $status = 0 )
	{
		$criteria = $status == 1 ? "dept_status = 1 AND " : "";
		$q = "SELECT * FROM tbl_department WHERE ".$criteria." dept_id = ".$dept_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_content_info( $dept_id, $status = 0 )
	
	function get_dept_status( $dept_id )
	{
		$q = "SELECT dept_status FROM tbl_department WHERE dept_id = ".$dept_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r['dept_status'];
		else
			return false;
	}	//	End of function get_dept_status( $dept_id )
	
	function set_dept_status( $dept_id )
	{
		$status = $this -> get_dept_status( $dept_id );
		$status = $status == 1 ? 0 : 1;
		$q = "UPDATE tbl_department SET dept_status = ".$status." WHERE dept_id = ".$dept_id;
		$r = $this -> db -> updateRecord( $q );
		if( $r != false )
			return true;
		else
			return false;
	}	//	End of function set_dept_status( $status, $dept_id )
	
	function update_department( $dept_name, $dept_status, $dept_id )
	{
		$q = "UPDATE tbl_department SET `dept_name` = '".$dept_name."', `dept_status` = '".$dept_status."', modifieddate = '".date('Y-m-d H:i:s')."' WHERE dept_id = ".$dept_id;
		$r = $this -> db -> updateRecord( $q );
		if( $r != false )
			return true;
		else
			return false;
	}	//	End of function  update_content()
	
	function add_department( $dept_name, $dept_status )
	{
			$q = "INSERT INTO tbl_department(`dept_name`, `dept_status`, `addeddate`)
			 VALUES('".$dept_name."', '".$dept_status."', '".date('Y-m-d H:i:s')."')";
			$r = $this -> db -> insertRecord( $q );
			if( $r != false )
				return true;
			else
				return false;
	}	//	End of function add_department( )

	function delete_department( $dept_id )
	{
		$q = "DELETE FROM tbl_department WHERE dept_id = ".$dept_id;
		$r = $this -> db -> deleteRecord( $q );
		if( $r )
			return true;
		else
			return false;	
	}	//	End of function delete_content( $dept_id )
	
	function display_departments_listing( $title_dev_employee_listing_records, $page_link, $pageno )
	{
		if( $title_dev_employee_listing_records != false )
		{
			$sr = ($pageno * RECORDS_PER_PAGE) - RECORDS_PER_PAGE +1;
			for( $i = 0; $i < count( $title_dev_employee_listing_records ); $i++ )
			{
				$dept_id = $title_dev_employee_listing_records[$i]['dept_id'];
				$dept_name = $title_dev_employee_listing_records[$i]['dept_name'];
				
				$status = $title_dev_employee_listing_records[$i]['dept_status'] == 1 ? "<a href='".$page_link."&amp;dept_id=".$dept_id."&amp;action=change_status&amp;tab=employee'  title='In Active'><span class='active'><img src='images/active.png' alt='Active' border='0'></span></a>" : "<a class='inactive' href='".$page_link."&amp;dept_id=".$dept_id."&amp;action=change_status&amp;tab=employee' title='Active'><span class='inactive'><img src='images/inactive.png' alt='Inactive' border='0'></span></a>";
				
				$edit_link = "<a class='mislink' href='index.php?module_name=department_management&amp;file_name=add_department&amp;tab=employee&amp;dept_id=".$dept_id."' title='Edit'><img src='images/edit.png' alt='Edit' border='0'></a>";
				
				$delete_link = "<a class='mislink' title='Delete' href='javascript:void(0);' onclick='javascript: if( confirm(\"Are you sure to delete?\") ) { window.location= \"".$page_link."&amp;action=delete&amp;tab=employee&amp;dept_id=".$dept_id."\"; }'><img src='images/delete.png' alt='Edit' border='0'></a>";
				
				$class = $i % 2 == 0 ? "class='even_row'" : "class='odd_row'";
				$title_dev_employee_listing .= '<tr '.$class.'>
									<td>'.$sr.'</td>
									<td>'.$dept_name.'</td>';
				if( $_SESSION['admin_user_type'] == "1" ){						
$title_dev_employee_listing .= '<td align="center">'.$status.'</td>
								<td align="center">'.$edit_link.'</td>
								<td align="center">'.$delete_link.'</td>';
				}		
				$title_dev_employee_listing .= '</tr>';
				$sr++;
			}	//	End of For Loooooooooop
		}	//	End of if( $title_dev_employee_listing_records != false )
		else
		{
			$title_dev_employee_listing = '<tr>
									<td colspan="5" class="Bad-msg" align="center">'.NO_RECORD_FOUND.'</td>
								</tr>';
		}
		return $title_dev_employee_listing;
	}	//	End of function display_employee_listing_admin( $title_dev_employee_listing )
	
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
}	//	End of class employee
?>