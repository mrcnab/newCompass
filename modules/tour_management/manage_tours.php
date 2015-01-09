<?
	$pg_obj = new paging();
	$tour_obj = new tours(); 
	$pageno = isset( $_GET['pageno'] ) ? $_GET['pageno'] : 1;
	$page_action = isset( $_GET['action'] ) ? $_GET['action'] : "";
	$tour_id = isset( $_GET['tour_id'] ) ? $_GET['tour_id'] : 1;

	$page_link = "index.php?module_name=tour_management&amp;file_name=manage_tours&amp;tab=tour";
	$page_link .= $pageno > 0 ? "&amp;pageno=".$pageno : "";
	
	if( $page_action == "delete" )
	{
		$is_deleted = $tour_obj -> delete_tour( $tour_id );
		$msg = $is_deleted ? '<span class="good-msg">'.RECORD_DELETE.'</span>' : '<span class="bad-msg">'.RECORD_DELETE_ERROR.'</span>';
	}	
	if( $page_action == "change_status" )
	{
		$is_changed = $tour_obj -> set_tour_status( $tour_id );
		$msg = $is_changed ? "<span class='good-msg'>".STATUS_UPDATED."</span>" : "<span class='bad-msg'>".STATUS_UPDATED_ERROR."</span>";
	}	

	$q = "SELECT * FROM tbl_tours";
	$q1 = "SELECT count( * ) as total FROM tbl_tours";
	$get_all_tour_pages = $pg_obj -> getPaging( $q, RECORDS_PER_PAGE, $pageno );
	$get_all_tours = $tour_obj -> display_tours_listing( $get_all_tour_pages, $page_link, $pageno );
	if( $get_all_tour_pages != false )
		{
			$get_total_records = $db -> getSingleRecord( $q1 );
			$total_records = $get_total_records['total'];
			$total_pages = ceil( $total_records / RECORDS_PER_PAGE );
		}
	
	
?>
<h1>Manage Tours</h1>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#686868; font-weight:bold; margin-bottom:5px;">
<tr>
    <td style="text-align:center; width:100%"><?=$msg?></td>
<tr>
    <?
	if( $_SESSION['admin_user_type'] == "1" )
	{			
	?>
<tr>
    <td style="padding-right:7px;" class="td-cls" align="right">

    <a href="index.php?module_name=tour_management&amp;file_name=add_tour&amp;tab=tour">Add Tour</a>
    
    </td>
</tr>
<?	} ?>
</table>
<table id="Listing" width="100%" border="0" cellpadding="0" cellspacing="1" style="color:#686868;">
<tr style="height:3px;"><td style="height:3px;" colspan="7"></td></tr>
<tr class="header">
    <td class="Sr">Sr.</td>
    <td class="Title">Tour Name</td>
    <td>Tour Description</td>
    <td class="Title">Tour Location</td>
    <td class="Title">Tour Start Date</td>
    <td class="Title">Tour End Date</td>
    <?
	if( $_SESSION['admin_user_type'] == "1" )
	{
	?>
    <td class="Status">Status</td>
    <td class="Edit">Edit</td>
    <td class="Status">Delete</td>
    <? 	} ?> 
</tr>
<?=$get_all_tours?>
<?
if( $total_pages > 1 )
{
	echo '<tr><td colspan="7" id="paging">'.$pg_obj -> display_paging( $total_pages, $pageno, $page_link, NUMBERS_PER_PAGE ).'</td></tr>';
}
?>
<tr style="height:3px;"><td style="height:3px;" colspan="7"></td></tr>
</table>
