<div id="">
<div class="maintabs-side">
<?	if( $_SESSION['admin_user_type'] == "2" ){?>  
<span  <? echo ((isset($_REQUEST['file_name']) && $_REQUEST['file_name'] == "vehicle_documents")) ? "class='active'" : ""; ?>><a href="index.php?module_name=maintab_management&amp;file_name=vehicle_documents&amp;tab=maintab" class="btn-btn">Vehicle Documents</a></span>
<span <? echo ((isset($_REQUEST['file_name']) && $_REQUEST['file_name'] == "pre_toure_paperwork")) ? "class='active'" : ""; ?>><a href="index.php?module_name=maintab_management&amp;file_name=pre_toure_paperwork&amp;tab=maintab" class="btn-btn">Pre tour paperwork</a></span>
<span <? echo ((isset($_REQUEST['file_name']) && $_REQUEST['file_name'] == "vehicle_maintenance")) ? "class='active'" : ""; ?>><a href="index.php?module_name=maintab_management&amp;file_name=vehicle_maintenance&amp;tab=maintab" class="btn-btn">Vehicle maintenance</a></span>
<span <? echo ((isset($_REQUEST['file_name']) && $_REQUEST['file_name'] == "post_tour")) ? "class='active'" : ""; ?>><a href="index.php?module_name=maintab_management&amp;file_name=post_tour&amp;tab=maintab" class="btn-btn">Post Tour</a></span>
<span <? echo ((isset($_REQUEST['file_name']) && $_REQUEST['file_name'] == "manage_pdf")) ? "class='active'" : ""; ?>><a href="index.php?module_name=pdf_management&file_name=manage_pdf&tab=pdfs" class="btn-btn">Resources</a></span> 
<? }else{?>

<span <? echo ((isset($_REQUEST['file_name']) && $_REQUEST['file_name'] == "vehicle_documents")) ? "class='active'" : ""; ?>><a href="index.php?module_name=maintab_management&amp;file_name=vehicle_documents&amp;tab=maintab&tour_id=<?=$_REQUEST['tour_id']?>" class="btn-btn">Vehicle Documents</a></span>
<span <? echo ((isset($_REQUEST['file_name']) && $_REQUEST['file_name'] == "pre_toure_paperwork")) ? "class='active'" : ""; ?>><a href="index.php?module_name=maintab_management&amp;file_name=pre_toure_paperwork&amp;tab=maintab&tour_id=<?=$_REQUEST['tour_id']?>" class="btn-btn">Pre tour paperwork</a></span>
<span <? echo ((isset($_REQUEST['file_name']) && $_REQUEST['file_name'] == "vehicle_maintenance")) ? "class='active'" : ""; ?>><a href="index.php?module_name=maintab_management&amp;file_name=vehicle_maintenance&amp;tab=maintab&tour_id=<?=$_REQUEST['tour_id']?>" class="btn-btn">Vehicle maintenance</a></span>
<span <? echo ((isset($_REQUEST['file_name']) && $_REQUEST['file_name'] == "post_tour")) ? "class='active'" : ""; ?>><a href="index.php?module_name=maintab_management&amp;file_name=post_tour&amp;tab=maintab&tour_id=<?=$_REQUEST['tour_id']?>" class="btn-btn">Post Tour</a></span>
<span <? echo ((isset($_REQUEST['file_name']) && $_REQUEST['file_name'] == "manage_pdf")) ? "class='active'" : ""; ?>><a href="index.php?module_name=pdf_management&file_name=manage_pdf&tab=pdfs" class="btn-btn">Resources</a></span> 
<? } ?>

</div>
</div>