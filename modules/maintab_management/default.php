<?
$getTeamDetails	=	$helperClass->get_team_details();
$tourInfo	=	$helperClass->get_tour_info_by_tour_id($getTeamDetails['tour_id']);
?>
<div class="maintabs">
<?	if( $_SESSION['admin_user_type'] == "2" ){?>  
<span><a href="index.php?module_name=maintab_management&amp;file_name=vehicle_documents&amp;tab=maintab" class="btn-btn">Vehicle documents</a> </span>
<span><a href="index.php?module_name=maintab_management&amp;file_name=pre_toure_paperwork&amp;tab=maintab" class="btn-btn">Pre tour paperwork</a> </span>
<span><a href="index.php?module_name=maintab_management&amp;file_name=vehicle_maintenance&amp;tab=maintab" class="btn-btn">Vehicle maintenance</a> </span>
<span><a href="index.php?module_name=maintab_management&amp;file_name=post_tour&amp;tab=maintab" class="btn-btn">Post Tour</a> </span>
<span><a href="index.php?module_name=pdf_management&file_name=manage_pdf&tab=pdfs" class="btn-btn">Resources</a> </span>
<? }else{ ?>
<span><a href="index.php?module_name=maintab_management&amp;file_name=vehicle_documents&amp;tab=maintab&tour_id=<?=$_REQUEST['tour_id']?>" class="btn-btn">Vehicle documents</a> </span>
<span><a href="index.php?module_name=maintab_management&amp;file_name=pre_toure_paperwork&amp;tab=maintab&tour_id=<?=$_REQUEST['tour_id']?>" class="btn-btn">Pre tour paperwork</a> </span>
<span><a href="index.php?module_name=maintab_management&amp;file_name=vehicle_maintenance&amp;tab=maintab&tour_id=<?=$_REQUEST['tour_id']?>" class="btn-btn">Vehicle maintenance</a> </span>
<span><a href="index.php?module_name=maintab_management&amp;file_name=post_tour&amp;tab=maintab&tour_id=<?=$_REQUEST['tour_id']?>" class="btn-btn">Post Tour</a> </span>
<span><a href="index.php?module_name=pdf_management&file_name=manage_pdf&tab=pdfs" class="btn-btn">Resources</a> </span>
<? } ?>
</div>
<?	if( $_SESSION['admin_user_type'] == "2" ){?>    
<h1 style="font-size:18px;">WELCOME <font style="text-decoration:underline; font-weight:bold;"><?=$getTeamDetails['team_name']?></font> For <font style="text-decoration:underline; font-weight:bold;"><?=$tourInfo['tour_name']?></font></h1>
<? } else{ ?>
<h1>WELCOME</h1>
<? } ?>

<p style="font-size:14px;">The documents and checklist are here to help crew prepare for the tour, it is a condition of employment and payment of wages that ALL questions are answered completely &amp; honestly and information uploaded into DB as per required timeframes.</p>
<br />
<p style="font-size:14px;">All pre tour questions must be completed at the latest 2 days prior to tour start date
All post tour questions and uploads must be completed within 2 weeks of completion of tour. 
</p>
