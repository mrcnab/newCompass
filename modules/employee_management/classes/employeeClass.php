<?
class employees
{
	var $db = "";
	function employees()
	{
		$this -> db = new DBAccess();
	}	//	End of function employee()
	
	function get_employee_info( $employee_id, $status = 0 )
	{
		$criteria = $status == 1 ? "employee_status = 1 AND " : "";
		$q = "SELECT * FROM tbl_employees WHERE ".$criteria." employee_id = ".$employee_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_employee_info( $employee_id, $status = 0 )
	
	function getDepartmentNameByDeptId( $dept_id )
	{
		$q = "SELECT  * FROM tbl_department WHERE dept_id = ".$dept_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_employee_status( $employee_id )
	
	function get_employee_status( $employee_id )
	{
		$q = "SELECT employee_status FROM tbl_employees WHERE employee_id = ".$employee_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != false )
			return $r['employee_status'];
		else
			return false;
	}	//	End of function get_employee_status( $employee_id )
	
	function set_employee_status( $employee_id )
	{
		$status = $this -> get_employee_status( $employee_id );
		$status = $status == 1 ? 0 : 1;
		$q = "UPDATE tbl_employees SET employee_status = ".$status." WHERE employee_id = ".$employee_id;
		$r = $this -> db -> updateRecord( $q );
		if( $r != false )
			return true;
		else
			return false;
	}	//	End of function set_employee_status( $status, $employee_id )
	
	
	function get_image( $employee_id )
	{
		$q = "SELECT employee_image FROM tbl_employees WHERE employee_id = ".$employee_id;
		$full_image = $this -> db -> getSingleRecord( $q );
		if( $full_image != "" )
			return $full_image['employee_image'];
		else
			return false;
	}	//	End of function get_full_image( $testimonial_id )
	
	
	
	function update_employee( $employee_title,  $employee_email,  $dept_id, $employee_image, $employee_status, $employee_id )
	{
		if( $employee_image != "" )
		{
			$image_pre = $this -> get_image( $employee_id );
			if( is_file( $image_pre ) )
			{
				unlink( $image_pre );
			}
		}	//	End of if( $image_image != "
		
		if($employee_image != "" )
		{
			$image_qry = ", `employee_image`	= '".$employee_image."' ";
		}	
		
		$q = "UPDATE tbl_employees SET `employee_full_name` = '".$employee_title."', `employee_email` = '".$employee_email."',  dept_id = '".$dept_id."' ".$image_qry.",    `employee_status` = '".$employee_status."', `modifieddate` = '".date('Y-m-d H:i:s')."' WHERE employee_id = ".$employee_id;
		$r = $this -> db -> updateRecord( $q );
		if( $r != false )
			return true;
		else
			return false;
	}	//	End of function  update_employee( $parent_id, $employee_title, $employee_text, $meta_title, $meta_description, $meta_keywords, $sef_link, $employee_status, $employee_id )
	
	function add_employee( $employee_title, $employee_email, $dept_id, $photo1, $employee_status )
	{
			$q = "INSERT INTO tbl_employees(`employee_full_name`, `employee_email`, `dept_id`, `employee_image`, `employee_status`, `addeddate`)
			 VALUES('".$employee_title."', '".$employee_email."', '".$dept_id."', '".$photo1."', '".$employee_status."', '".date('Y-m-d H:i:s')."')";
			$r = $this -> db -> insertRecord( $q );
			if( $r != false )
				return true;
			else
				return false;
		
	}	//	End of function add_employee( $parent_id, $employee_title, $employee_text, $meta_title, $meta_description, $meta_keywords, $sef_link, $employee_status )

	function delete_employee( $employee_id )
	{
		$q = "DELETE FROM tbl_employees WHERE employee_id = ".$employee_id;
		$r = $this -> db -> deleteRecord( $q );
		if( $r )
			return true;
		else
			return false;			
	}	//	End of function delete_employee( $employee_id )
	
	function fill_dept_combo( $form_name, $dept_id )
	{
		$q = "SELECT * FROM tbl_department";
		$r = $this -> db -> getMultipleRecords( $q );
		$combo = '<select class="txareacombow" name="dept_id" id="dept_id" >
					<option value="">---Select Department---</option>';
		if( $r != false )
		{
			for( $i = 0; $i < count( $r ); $i++ )
			{
				$selected = $dept_id == $r[$i]['dept_id'] ? "selected" : "";
				$combo .= '<option '.$selected.' value="'.$r[$i]['dept_id'].'">'.$r[$i]['dept_name'].'</option>';
			}	//	End of for Looooooop
		}	//	End of if( $r != false )
		$combo .= '</select>';
		
		return $combo;
	}	//	End of function fill_employee_combo( )
	

	
	function display_employees_listing( $title_dev_employee_listing_records, $page_link, $pageno )
	{
		if( $title_dev_employee_listing_records != false )
		{
			$sr = ($pageno * RECORDS_PER_PAGE) - RECORDS_PER_PAGE +1;
			for( $i = 0; $i < count( $title_dev_employee_listing_records ); $i++ )
			{
				$employee_id = $title_dev_employee_listing_records[$i]['employee_id'];
				$departInfo	=	$this->getDepartmentNameByDeptId($title_dev_employee_listing_records[$i]['dept_id']);
				
				if($title_dev_employee_listing_records[$i]['employee_image'] != '') {
					$imageThumb	=	$this->resize($title_dev_employee_listing_records[$i]['employee_image'],LISTING_THUMB_WIDTH,LISTING_THUMB_HEIGH);
					
				}else{					
					$imageThumb	=	$this->resize(NO_IMAGE_MEMBER_PATH,LISTING_THUMB_WIDTH,LISTING_THUMB_HEIGH);					
				}
				
				$status = $title_dev_employee_listing_records[$i]['employee_status'] == 1 ? "<a href='".$page_link."&amp;employee_id=".$employee_id."&amp;action=change_status&amp;tab=employee'  title='In Active'><span class='active'><img src='images/active.png' alt='Active' border='0'></span></a>" : "<a class='inactive' href='".$page_link."&amp;employee_id=".$employee_id."&amp;action=change_status&amp;tab=employee' title='Active'><span class='inactive'><img src='images/inactive.png' alt='Inactive' border='0'></span></a>";
				
				$edit_link = "<a class='mislink' href='index.php?module_name=employee_management&amp;file_name=add_employee&amp;employee_id=".$employee_id."&amp;tab=employee' title='Edit'><img src='images/edit.png' alt='Edit' border='0'></a>";
				
				$delete_link = "<a class='mislink' title='Delete' href='javascript:void(0);' onclick='javascript: if( confirm(\"Are you sure to delete?\") ) { window.location= \"".$page_link."&amp;action=delete&amp;tab=employee&amp;employee_id=".$employee_id."\"; }'><img src='images/delete.png' alt='Edit' border='0'></a>";
				

				$class = $i % 2 == 0 ? "class='even_row'" : "class='odd_row'";
				$title_dev_employee_listing .= '<tr '.$class.'>
									<td>'.$sr.'</td>
									<td><img src="'.$imageThumb.'" alt="'.$title_dev_employee_listing_records[$i]['employee_full_name'].'" /></td>
									<td>'.$title_dev_employee_listing_records[$i]['employee_full_name'].'<br /><br />'.$title_dev_employee_listing_records[$i]['employee_email'].'</td>
									<td>'.$departInfo['dept_name'].'</td>';
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
	
}	//	End of class employee
?>