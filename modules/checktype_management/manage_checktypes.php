<?
	$pg_obj = new paging();
	$checktypes_obj = new checktypes(); 

	$pageno = isset( $_GET['pageno'] ) ? $_GET['pageno'] : 1;
	$page_action = isset( $_GET['action'] ) ? $_GET['action'] : "";
	$checklist_type_category_id = isset( $_GET['checklist_type_category_id'] ) ? $_GET['checklist_type_category_id'] : 1;	
	$page_link = "index.php?module_name=checktype_management&amp;file_name=manage_checktypes&amp;tab=checklist";
	$page_link .= $pageno > 0 ? "&amp;pageno=".$pageno : "";
	
	if( $page_action == "delete" )
	{
		$is_deleted = $checktypes_obj -> delete_checklist( $checklist_type_category_id );
		$msg = $is_deleted ? '<span class="good-msg">'.RECORD_DELETE.'</span>' : '<span class="bad-msg">'.RECORD_DELETE_ERROR.'</span>';
	}	
	if( $page_action == "change_status" )
	{
		$is_changed = $checktypes_obj -> set_status( $checklist_type_category_id );
		$msg = $is_changed ? "<span class='good-msg'>".STATUS_UPDATED."</span>" : "<span class='bad-msg'>".STATUS_UPDATED_ERROR."</span>";
	}
	
	$q = "SELECT * FROM tbl_checklist_type_category ORDER BY checklist_id ASC";
	$q1 = "SELECT count( * ) as total FROM tbl_checklist_type_category";
	$get_all_checklist_pages = $pg_obj -> getPaging( $q, RECORDS_PER_PAGE, $pageno );
	$get_all_checklists = $checktypes_obj -> display_checklists_listing( $get_all_checklist_pages, $page_link, $pageno );
	if( $get_all_checklist_pages != false )
		{
			$get_total_records = $db -> getSingleRecord( $q1 );
			$total_records = $get_total_records['total'];
			$total_pages = ceil( $total_records / RECORDS_PER_PAGE );
		}
	
	
?>
<h1>Manage Check List Category/Group</h1>
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
    <a href="index.php?module_name=checktype_management&amp;file_name=add_checktype&amp;tab=checklist">Add Check List Category/Group</a>    
    </td>
</tr>
<?	} ?>
</table>
<table id="Listing" width="100%" border="0" cellpadding="0" cellspacing="1" style="color:#686868;">
<tr style="height:3px;"><td style="height:3px;" colspan="7"></td></tr>
<tr class="header">
    <td class="Sr">Sr.</td>
    <td class="Title">Check List Title</td>
    <td class="Title">Category/Group Name</td>
    <td class="Status">Status</td>
    <?
	if( $_SESSION['admin_user_type'] == "1" )
	{
	?>    
    <td class="Edit">Edit</td>
    <td class="Status">Delete</td>
    <? 	} ?> 
</tr>
<?=$get_all_checklists?>
<?
if( $total_pages > 1 )
{
	echo '<tr><td colspan="7" id="paging">'.$pg_obj -> display_paging( $total_pages, $pageno, $page_link, NUMBERS_PER_PAGE ).'</td></tr>';
}
?>
<tr style="height:3px;"><td style="height:3px;" colspan="7"></td></tr>
</table>
