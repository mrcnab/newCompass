<?
	$pg_obj = new paging();
	$employee_obj = new employees(); 

	$pageno = isset( $_GET['pageno'] ) ? $_GET['pageno'] : 1;
	$page_action = isset( $_GET['action'] ) ? $_GET['action'] : "";
	$employee_id = isset( $_GET['employee_id'] ) ? $_GET['employee_id'] : 1;
	
	$page_link = "index.php?module_name=employee_management&amp;file_name=manage_employees&amp;tab=employee";
	$page_link .= $pageno > 0 ? "&amp;pageno=".$pageno : "";
	
	if( $page_action == "delete" )
	{
		$is_deleted = $employee_obj -> delete_employee( $employee_id );
		$msg = $is_deleted ? '<span class="good-msg">'.RECORD_DELETE.'</span>' : '<span class="bad-msg">'.RECORD_DELETE_ERROR.'</span>';
	}	
	if( $page_action == "change_status" )
	{
		$is_changed = $employee_obj -> set_employee_status( $employee_id );
		$msg = $is_changed ? "<span class='good-msg'>".STATUS_UPDATED."</span>" : "<span class='bad-msg'>".STATUS_UPDATED_ERROR."</span>";
	}	

	$q = "SELECT * FROM tbl_employees";
	$q1 = "SELECT count( * ) as total FROM tbl_employees";
	$get_all_employee_pages = $pg_obj -> getPaging( $q, RECORDS_PER_PAGE, $pageno );
	$get_all_employees = $employee_obj -> display_employees_listing( $get_all_employee_pages, $page_link, $pageno );
	if( $get_all_employee_pages != false )
		{
			$get_total_records = $db -> getSingleRecord( $q1 );
			$total_records = $get_total_records['total'];
			$total_pages = ceil( $total_records / RECORDS_PER_PAGE );
		}
	
	
?>
<h1>Manage Employees</h1>
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

    <a href="index.php?module_name=employee_management&amp;file_name=add_employee&amp;tab=employee">Add/Edit Employee</a>
    
    </td>
</tr>
<?	} ?>
</table>
<table id="Listing" width="100%" border="0" cellpadding="0" cellspacing="1" style="color:#686868;">
<tr style="height:3px;"><td style="height:3px;" colspan="7"></td></tr>
<tr class="header">
    <td class="Sr">Sr.</td>
    <td class="Title">&nbsp;</td>
    <td class="Title">Employee Details</td>
    <td class="Title">Department</td>
    <?
	if( $_SESSION['admin_user_type'] == "1" )
	{
	?>
    <td class="Status">Status</td>
    <td class="Edit">Edit</td>
    <td class="Status">Delete</td>
    <? 	} ?> 
</tr>
<?=$get_all_employees?>
<?
if( $total_pages > 1 )
{
	echo '<tr><td colspan="7" id="paging">'.$pg_obj -> display_paging( $total_pages, $pageno, $page_link, NUMBERS_PER_PAGE ).'</td></tr>';
}
?>
<tr style="height:3px;"><td style="height:3px;" colspan="7"></td></tr>
</table>
