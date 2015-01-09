<?
	$pg_obj = new paging();
	$crewpretourchecklist_obj = new crewpretourchecklist(); 

	$pageno = isset( $_GET['pageno'] ) ? $_GET['pageno'] : 1;
	$page_action = isset( $_GET['action'] ) ? $_GET['action'] : "";
	$crew_pre_tour_checklist_id = isset( $_GET['crew_pre_tour_checklist_id'] ) ? $_GET['crew_pre_tour_checklist_id'] : 1;
	
	$page_link = "index.php?module_name=crewpretourchecklist_management&amp;file_name=manage_crewpretourchecklists&amp;tab=checklist";
	$page_link .= $pageno > 0 ? "&amp;pageno=".$pageno : "";

	if($_POST['checklist_id'] != 0){
		$checklist_id	=	$_POST['checklist_id'];
		$criteria	=	"WHERE checklist_id =".$checklist_id;	
	}else{
		$criteria	= "";
	}
	
	if( $page_action == "delete" )
	{
		$is_deleted = $crewpretourchecklist_obj -> delete_checklist( $crew_pre_tour_checklist_id );
		$msg = $is_deleted ? '<span class="good-msg">'.RECORD_DELETE.'</span>' : '<span class="bad-msg">'.RECORD_DELETE_ERROR.'</span>';
	}	
	
	if( $page_action == "change_status" )
	{
		$is_changed = $crewpretourchecklist_obj -> set_status( $crew_pre_tour_checklist_id );
		$msg = $is_changed ? "<span class='good-msg'>".STATUS_UPDATED."</span>" : "<span class='bad-msg'>".STATUS_UPDATED_ERROR."</span>";
	}
	
	$q = "SELECT * FROM tbl_crew_pre_tour_checklist ".$criteria." ORDER BY checklist_id,crew_pre_tour_type";
	$q1 = "SELECT count( * ) as total FROM tbl_crew_pre_tour_checklist ".$criteria;
	$get_all_checklist_pages = $pg_obj -> getPaging( $q, RECORDS_PER_PAGE, $pageno );
	$get_all_checklists = $crewpretourchecklist_obj -> display_checklists_listing( $get_all_checklist_pages, $page_link, $pageno );
	if( $get_all_checklist_pages != false )
		{
			$get_total_records = $db -> getSingleRecord( $q1 );
			$total_records = $get_total_records['total'];
			$total_pages = ceil( $total_records / RECORDS_PER_PAGE );
		}
	$allCheckLists	=	$crewpretourchecklist_obj->get_all_checklists();
?>
<h1>Manage Tour Check Lists</h1>
<span style="float:left; padding-right:10px;">Select Check List Type To View Its Check List Options:</span> 
<form action="<?=$page_link?>" method="post" name="getCheckLists" id="getCheckLists" style="float:left;">
<select onchange="this.form.submit()" name="checklist_id">
	<option value="0">---Show All---</option>
	<? foreach($allCheckLists as $list){?>
	<option value="<?=$list['checklist_id']?>" <? if($checklist_id == $list['checklist_id']){ ?> selected="selected" <? } ?>><?=$list['checklist_title']?></option>
    <? } ?>
</select>
</form>
<br clear="all" /><br clear="all" />
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#686868; font-weight:bold; margin-bottom:5px; margin-top:5px;">
<tr>
    <td style="text-align:center; width:100%"><?=$msg?></td>
<tr>
    <?
	if( $_SESSION['admin_user_type'] == "1" )
	{			
	?>
<tr>
    <td style="padding-right:7px;" class="td-cls" align="right">
    <a href="index.php?module_name=crewpretourchecklist_management&amp;file_name=add_crewpretourchecklist&amp;tab=checklist">Add Tour Check List</a>    
    </td>
</tr>
<?	} ?>
</table>
<table id="Listing" width="100%" border="0" cellpadding="0" cellspacing="1" style="color:#686868;">
<tr style="height:3px;"><td style="height:3px;" colspan="7"></td></tr>
<tr class="header">
    <td class="Sr">Sr.</td>
    <td class="Title">Tour Check List Title</td>
    <td>Type</td>
    <td>Checklist Text</td>
    <?
	if( $_SESSION['admin_user_type'] == "1" )
	{
	?>    
    <td class="Status">Status</td>
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
