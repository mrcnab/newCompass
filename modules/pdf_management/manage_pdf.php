<?
	$pg_obj = new paging();
	$pdf_obj = new pdfs(); 

	$pageno = isset( $_GET['pageno'] ) ? $_GET['pageno'] : 1;
	$page_action = isset( $_GET['action'] ) ? $_GET['action'] : "";
	$pdf_id = isset( $_GET['pdf_id'] ) ? $_GET['pdf_id'] : 1;
	$page_link = "index.php?module_name=pdf_management&amp;file_name=manage_pdf&amp;tab=pdfs";
	
	if( $page_action == "delete" && $pdf_id != "" )
	{
		$is_deleted = $pdf_obj -> delete_pdf( $pdf_id );
		$msg = $is_deleted ? "<span class='good-msg'>".RECORD_DELETE."</span>" : "<span class='bad-msg'>".RECORD_DELETE_ERROR."</span>";
	}	//	End of if( $page_action == "delete" && $pdf_id != "" )
	
	if( $page_action == "change_status" )
	{
		$is_changed = $pdf_obj -> set_status( $pdf_id );
		$msg = $is_changed ? "<span class='good-msg'>".STATUS_UPDATED."</span>" : "<span class='bad-msg'>".STATUS_UPDATED_ERROR."</span>";
	}
	
	$q = "SELECT * FROM tbl_downloads order by pdf_id desc";
	$q1 = "SELECT count( * ) as total FROM tbl_downloads";
	$get_all_pdf_pages = $pg_obj -> getPaging( $q, RECORDS_PER_PAGE, $pageno );
	$get_all_pdfs = $pdf_obj -> display_pdf_listing( $get_all_pdf_pages, $page_link, $pageno );
	if( $get_all_pdf_pages != false )
	{
		$get_total_records = $db -> getSingleRecord( $q1 );
		$total_records = $get_total_records['total'];
		$total_pages = ceil($total_records / RECORDS_PER_PAGE);
	}
	
?>
<h1>Manage Downloads</h1>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#686868; font-weight:bold; margin-bottom:5px;">
<tr>
    <td style="text-align:center; width:80%"><?=$msg?></td>  
     <?	if( $_SESSION['admin_user_type'] == "1" ){?>
		<td width="22%" align="right" class="td-cls"><a href="index.php?module_name=pdf_management&amp;file_name=add_pdf&amp;tab=pdfs">Add Download File</a></td>  
        <? } ?>
</tr>
</table>
<table id="Listing" width="100%" border="0" cellpadding="0" cellspacing="1" style="color:#686868;">
<tr style="height:3px;"><td style="height:3px;" colspan="7"></td></tr>
<tr class="header">
    <td class="Sr">Sr.</td>
    <td class="Title">File Title</td>
	<td>File Description</td>
    <td  align="center" class="Title">File</td>
     <?	if( $_SESSION['admin_user_type'] == "1" ){?>
    <td  align="center" class="Status">Status</td>
    <td  align="center" class="Edit">Edit</td>
    <td  align="center" class="Edit">Delete</td>
    <? } ?>
</tr>
<?=$get_all_pdfs?>
<?
if( $total_pages > 1 )
{
	echo '<tr><td colspan="6" id="paging">'.$pg_obj -> display_paging( $total_pages, $pageno, $page_link, NUMBERS_PER_PAGE ).'</td></tr>';
}
?>

<tr style="height:3px;"><td style="height:3px;" colspan="7"></td></tr>
</table>

