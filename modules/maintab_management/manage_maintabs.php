<?
	$pg_obj = new paging();
	$maintab_obj = new maintabs(); 

	$pageno = isset( $_GET['pageno'] ) ? $_GET['pageno'] : 1;
	$page_action = isset( $_GET['action'] ) ? $_GET['action'] : "";
	$maintab_id = isset( $_GET['maintab_id'] ) ? $_GET['maintab_id'] : 1;
	
	$page_link = "index.php?module_name=maintab_management&amp;file_name=manage_maintabs&amp;tab=maintab";
	$page_link .= $pageno > 0 ? "&amp;pageno=".$pageno : "";
	
	if( $page_action == "delete" )
	{
		$is_deleted = $maintab_obj -> delete_maintab( $maintab_id );
		$msg = $is_deleted ? '<span class="good-msg">'.RECORD_DELETE.'</span>' : '<span class="bad-msg">'.RECORD_DELETE_ERROR.'</span>';
	}	
	
	$q = "SELECT * FROM tbl_tour_form_maintabs_manager";
	$q1 = "SELECT count( * ) as total FROM tbl_tour_form_maintabs_manager";
	$get_all_maintab_pages = $pg_obj -> getPaging( $q, RECORDS_PER_PAGE, $pageno );
	$get_all_maintabs = $maintab_obj -> display_maintabs_listing( $get_all_maintab_pages, $page_link, $pageno );
	if( $get_all_maintab_pages != false )
		{
			$get_total_records = $db -> getSingleRecord( $q1 );
			$total_records = $get_total_records['total'];
			$total_pages = ceil( $total_records / RECORDS_PER_PAGE );
		}
	
	
?>
<h1>Manage Check Lists</h1>
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
    <a href="index.php?module_name=maintab_management&amp;file_name=add_maintab&amp;tab=maintab">Add Check Lists</a>    
    </td>
</tr>
<?	} ?>
</table>
<table id="Listing" width="100%" border="0" cellpadding="0" cellspacing="1" style="color:#686868;">
<tr style="height:3px;"><td style="height:3px;" colspan="7"></td></tr>
<tr class="header">
    <td class="Sr">Sr.</td>
    <td class="Title">Check List Title</td>
    <td class="Title">Tour Name</td>
    <td class="Title">Team name</td>
    <td class="Status">Status</td>
    <td class="Status">Started Date</td>
    <?
	if( $_SESSION['admin_user_type'] == "1" )
	{
	?>    
    <td class="Edit">Edit</td>
    <td class="Status">Delete</td>
    <? 	} ?> 
</tr>
<?=$get_all_maintabs?>
<?
if( $total_pages > 1 )
{
	echo '<tr><td colspan="7" id="paging">'.$pg_obj -> display_paging( $total_pages, $pageno, $page_link, NUMBERS_PER_PAGE ).'</td></tr>';
}
?>
<tr style="height:3px;"><td style="height:3px;" colspan="7"></td></tr>
</table>
