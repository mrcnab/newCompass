<?
class pdfs
{
	var $db = "";
	function pdfs()
	{
		$this -> db =  new DBAccess();
	}	//	End of function pdfs()
	
	function get_pdf_info( $pdf_id, $status = 0 )
	{
		$criteria = $status == 1 ? "status = 1 AND " : "";
		$q = "SELECT * FROM tbl_downloads WHERE ".$criteria." pdf_id = ".$pdf_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r )
			return $r;
		else
			return false;
	}	//	End of function get_pdf_info( $pdf_id )
	
	function display_pdf_listing( $title_dev_pdf_listing_records, $page_link, $page_no )
	{
		if( $title_dev_pdf_listing_records != false )
		{
			
			$start = $page_no * RECORDS_PER_PAGE - RECORDS_PER_PAGE + 1;
			for( $i = 0; $i < count( $title_dev_pdf_listing_records ); $i++ )
			{
				$pdf_id = $title_dev_pdf_listing_records[$i]['pdf_id'];
				$pdf_name	=	$title_dev_pdf_listing_records[$i]['pdf_name'] ;
				$dir      = "modules/pdf_management/files/";
				$pdf_file = $title_dev_pdf_listing_records[$i]['pdf_file'];
				
				if( $pdf_file != "" && file_exists($dir.$pdf_file) )
				{				 
				$pdf_download = "<a href='download.php?pdf_file=".$pdf_file."'><img src='images/download.png' alt='".$pdf_name."' title='".$pdf_name."' border=0></a>";
				}	
				$status = $title_dev_pdf_listing_records[$i]['status'] == 1 ? "<a href='".$page_link."&amp;pdf_id=".$pdf_id."&amp;action=change_status'><span class='active'>Active</span></a>" : "<a class='inactive' href='".$page_link."&amp;pdf_id=".$pdf_id."&amp;action=change_status'><span class='inactive'>Inactive</span></a>";			
				
				
				$edit_link = "<a class='mislink' href='index.php?module_name=pdf_management&amp;file_name=add_pdf&amp;tab=pdfs&amp;pdf_id=".$pdf_id."'>Edit</a>";
				
				$delete_link = "<a class='mislink' href='javascript:void(0);' onclick='javascript: if( confirm(\"Are you sure to delete this file?\") ) { window.location= \"".$page_link."&amp;action=delete&amp;pdf_id=".$pdf_id."\";}'>Delete</a>";
				
				
				$pdf_description = $this -> remove_html_tags( $title_dev_pdf_listing_records[$i]['pdf_description'] );
				$class = $i % 2 == 0 ? "class='even_row'" : "class='odd_row'";
				$title_dev_pdf_listing .= '<tr '.$class.'>
									<td>'.$start.'</td>
									<td>'.$pdf_name.'</td>
									<td>'.$pdf_description.'</td>
									<td align="center">'.$pdf_download.'</td>';
				if($_SESSION['admin_user_type'] == "1" ){
				$title_dev_pdf_listing .= '<td align="center">'.$status.'</td>
											<td align="center">'.$edit_link.'</td>
											<td align="center">'.$delete_link.'</td>';
				}
				$title_dev_pdf_listing .= '</tr>';
				$start++;
			}	//	End of For Loooooooooop
		}	//	End of if( $title_dev_pdf_listing_records != false )
		else
		{
			$title_dev_pdf_listing = '<tr>
									<td colspan="7" class="bad-msg" align="center">'.NO_RECORD_FOUND.'</td>
								</tr>';
		}
		return $title_dev_pdf_listing;
	}	//	End of function display_pdf_listing( $title_dev_pdf_listing_records, $page_link )
	
	
	function get_pdf_file( $pdf_id )
	{
		$q = "SELECT pdf_file FROM tbl_downloads WHERE pdf_id = ".$pdf_id;
		$t = $this -> db -> getSingleRecord( $q );
		if( $t != false )
			return $t['pdf_file'];
		else
			return false;
	}	//	End of function get_pdf_file( $pdf_id )
	
	function get_pdf_small_image( $pdf_id )
	{
		$q = "SELECT pdf_small_image FROM tbl_downloads WHERE pdf_id = ".$pdf_id;
		$t = $this -> db -> getSingleRecord( $q );
		if( $t != false )
			return $t['pdf_small_image'];
		else
			return false;
	}	//	End of function get_pdf_small_image( $pdf_id )
	
	function get_status( $pdf_id )
	{
		$q = "SELECT status FROM tbl_downloads WHERE pdf_id = ".$pdf_id;
		$r = $this -> db -> getSingleRecord( $q );
		if( $r != "" )
			return $r['status'];
		else
			return false;
	}	//	End of function get_status( $pdf_id )

	function set_status( $pdf_id )
	{
		$status = $this -> get_status( $pdf_id );
		$status = $status == 1 ? 0 : 1;
		$q = "UPDATE tbl_downloads SET status = ".$status." WHERE pdf_id = ".$pdf_id;
		$r = $this -> db -> updateRecord( $q );
		if( $r )
			return true;
		else
			return false;
	}	//	End of function set_status( $pdf_id )
	
	function add_pdf( $pdf_name, $pdf_description, $pdf_file, $status )
	{
		$q = "INSERT INTO tbl_downloads(`pdf_name`, `pdf_description`,  `pdf_file`,
					 `status`, `addeddate`, `modifieddate`)
					 
			 VALUES('".$pdf_name."', '".$pdf_description."', '".$pdf_file."',  '".$status."', 
			 			'".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."')";
						
		$r = $this -> db -> insertRecord( $q );
		if( $r )
			return true;
		else
			return false;
	}	//	End of function add_pdf( $pdf_name, $company_name, $pdf, $pdf_file, $pdf_small_image, $status )
	function update_pdf( $pdf_name, $pdf_description, $pdf_file, $status, $pdf_id  )
	{//echo $entertainment_full_image;
		if( $pdf_file != "" )
		{
			$pdf_file_pre = $this -> get_pdf_file( $pdf_id );
			if( is_file( $pdf_file_pre ) )
			{
				unlink( $pdf_file_pre );
			}
		}	//	End of if( $image_image != "" )
		
		if($pdf_file != "")
		{
			$pdf_qry = ", `pdf_file`	= '".$pdf_file."' ";
		}

	$q = "UPDATE tbl_downloads SET
				`pdf_name`	= '".$pdf_name."',
				`pdf_description`	= '".$pdf_description."'".$pdf_qry.", 
				`status`		= '".$status."',
				`modifieddate`		= '".date('Y-m-d H:i:s')."'
				WHERE pdf_id		= ".$pdf_id;
		
		$r = $this -> db -> updateRecord( $q );
		if( $r )
			return true;
		else
			return false;
	}	//	End of function update_entertainment( $entertainment_title, $entertainment_full_image, $entertainment_small_image, $image_id )
	
	function delete_pdf( $pdf_id )
	{
		$pdf_file = $this -> get_pdf_file( $pdf_id );
		if( $pdf_file != "" )
		{
			// $entertainment_full_image = $image_path.$entertainment_full_image;
			if( is_file( $pdf_file ) )
			{
				unlink( $pdf_file );
			}
		}	//	End of if( $image_image != "" )
		
	
		$q = "DELETE FROM tbl_downloads WHERE pdf_id = ".$pdf_id;
		$r = $this -> db -> deleteRecord( $q );
		if( $r )
			return true;
		else
			return false;
	}	//	End of function delete_pdf( $pdf_id )	
	
	function generateAutoString($length = 49){
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
}	//	End of class pdfs
?>