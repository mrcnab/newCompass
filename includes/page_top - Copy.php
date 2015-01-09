<? ob_start();	
$getTeamDetails	=	$helperClass->get_team_details();
?>
<div id="header-cont">
    <div class="head-cont"> <h1>WELCOME!</h1><h2><?=SITE_NAME?> Administrator</h2> </div>
        <div class="log-cont">
        <table width="100%" border="0" cellspacing="0">
        <tr>
            <td class="tp-mnu"><!--<a href="#">HELP</a>-->
                <a href="index.php?action=logout">LOGOUT</a>
                <a href="index.php?module_name=profile_settings">PROFILE</a>
                <a href="index.php?tab=home">HOME</a>
            </td>
        </tr>
        </table>
        </div>
        <br class="spacer" />
<!--Start Btm Header-->
    <div class="btm-header">
        <ul>
           <li><a href="index.php?module_name=employee_management&file_name=manage_employees&tab=employee" <? echo ((isset($_REQUEST['tab']) && $_REQUEST['tab'] == "employee") )?"class='topmenu_act'":""; ?>>EMPLOYEES</a></li>
           <li><span><img src="images/mnu-sep1.gif" alt="sep" /></span></li>
           <li><a href="index.php?module_name=tour_management&file_name=manage_tours&tab=tour" <? echo ((isset($_REQUEST['tab']) && $_REQUEST['tab'] == "tour") )?"class='topmenu_act'":""; ?>>TOURS</a></li>  
           <?	if( $_SESSION['admin_user_type'] == "1" ){?>
           <li><span><img src="images/mnu-sep1.gif" alt="sep" /></span></li>
           <li><a href="index.php?module_name=team_management&file_name=manage_teams&tab=team" <? echo ((isset($_REQUEST['tab']) && $_REQUEST['tab'] == "team") )?"class='topmenu_act'":""; ?>>TEAMS</a></li>         
             
           <li><span><img src="images/mnu-sep1.gif" alt="sep" /></span></li>
           <li><a href="index.php?module_name=checklist_management&file_name=manage_checklists&tab=checklist" <? echo ((isset($_REQUEST['tab']) && $_REQUEST['tab'] == "checklist") )?"class='topmenu_act'":""; ?>>TOUR CHECK LIST</a></li>  
           <? } ?>     
            <?	if( $_SESSION['admin_user_type'] == "2" ){?>       
             <li><span><img src="images/mnu-sep1.gif" alt="sep" /></span></li>     
           <li><a href="#" <? echo ((isset($_REQUEST['tab']) && $_REQUEST['tab'] == "checklistdetail")) ? "class='topmenu_act'" : ""; ?>>UPDATE TOUR CHECK LISTS</a>         	
           <ul>
           <? 
		   		$tourInfo	=	$helperClass->get_tour_info_by_tour_id($getTeamDetails['tour_id']);
		   ?>
           		<li><a href="index.php?module_name=tour_management&file_name=manage_tours&tab=tour"><?=$tourInfo['tour_name']?></a>
                <? $tourCheckListDetails	=	$helperClass->get_check_list_type($tourInfo['tour_id']); 
					if($tourCheckListDetails){
				?>
                	<ul>
                    	<? foreach($tourCheckListDetails as $checklist){
							$randNumber	=	$helperClass->generateAutoString();
							?>
                    	<li><a href="index.php?module_name=checklist_management&amp;file_name=manage_updatechecks&amp;tab=checklistdetail&checklistID=<?=$randNumber?>-<?=$checklist['checklist_id']?>"><?=$checklist['checklist_title']?></a></li>
                        <? } ?>
                    </ul>
                <? } ?>                
                </li>           
           </ul>  
           </li>           
            <? } ?>
             <?	if( $_SESSION['admin_user_type'] == "1" ){?>       
             <li><span><img src="images/mnu-sep1.gif" alt="sep" /></span></li>     
           <li><a href="#" <? echo ((isset($_REQUEST['tab']) && $_REQUEST['tab'] == "checklistdetail")) ? "class='topmenu_act'" : ""; ?>>VIEW TOUR CHECK LISTS</a>         	
           <ul>
           <? 
		    		$tourInfo	=	$helperClass->get_all_tours($get_all_tours);
		   			if($tourInfo);
					foreach($tourInfo as $tours){ 
		   ?>
           		<li><a href="index.php?module_name=tour_management&file_name=manage_tours&tab=tour"><?=$tours['tour_name']?></a>
                <? $tourCheckListDetails	=	$helperClass->get_check_list_type_for_admin($tours['tour_id']); 
					if($tourCheckListDetails){
				?>
                	<ul>
                    	<? foreach($tourCheckListDetails as $checklist){
							$randNumber	=	$helperClass->generateAutoString();
							?>
                    	<li><a href="index.php?module_name=checklist_management&amp;file_name=manage_updatechecks&amp;tab=checklistdetail&checklistID=<?=$randNumber?>-<?=$checklist['checklist_id']?>"><?=$checklist['checklist_title']?></a></li>
                        <? } ?>
                    </ul>
                <? } ?>                
                </li>    
                
           <? } ?>            
           </ul>  
           </li>           
            <? } ?>
            
                   
             <li><span><img src="images/mnu-sep1.gif" alt="sep" /></span></li>     
           <li><a href="index.php?module_name=pdf_management&amp;file_name=manage_pdf&amp;tab=pdfs" <? echo ((isset($_REQUEST['tab']) && $_REQUEST['tab'] == "pdfs")) ? "class='topmenu_act'" : ""; ?>>DOWNLOAD</a></li> 
           <?	if( $_SESSION['admin_user_type'] == "1" ){?>           
            <li><span><img src="images/mnu-sep1.gif" alt="sep" /></span></li> 
            <li><a href="index.php?module_name=manage_modules&amp;tab=settings" <? echo ((isset($_REQUEST['tab']) && $_REQUEST['tab'] == "settings")) ? "class='topmenu_act'" : ""; ?>>SETTINGS</a></li>
		<?	}	?>			
        </ul>
        <div class="btm-header2">
        <?
		switch ( $_REQUEST['tab'] )
		{
			case "employee":
		?>
            <ul>        
                <li><a href="index.php?module_name=department_management&file_name=manage_departments&tab=employee">Manage Departments</a></li>
      
                <li><a href="index.php?module_name=employee_management&file_name=manage_employees&tab=employee">Manage Employees</a></li>
            </ul>          
		<?
			break;
			case "tour":
		?>
        	<ul>
             <?	if( $_SESSION['admin_user_type'] == "1" ){?>
                <li>
                    <a href="index.php?module_name=tour_management&amp;file_name=add_tour&amp;tab=tour">Add Tour(s)</a> 
                </li>
                <li><span><img src="images/mnu-sep2.gif" alt="sep2" /></span></li>
             <? } ?>   
                <li>
                    <a href="index.php?module_name=tour_management&amp;file_name=manage_tours&amp;tab=tour">Manage Tours</a>
                </li>
            </ul>	
      <?
			break;
			case "team":
		?>
        	<ul>
             <?	if( $_SESSION['admin_user_type'] == "1" ){?>
                <li>
                    <a href="index.php?module_name=team_management&amp;file_name=add_team&amp;tab=team">Add Team</a> 
                </li>
                <li><span><img src="images/mnu-sep2.gif" alt="sep2" /></span></li>
            <? } ?>
                <li>
                    <a href="index.php?module_name=team_management&amp;file_name=manage_teams&amp;tab=team">Manage Teams</a>
                </li>
            </ul>
           <?
			break;
			case "checklist":
		?>
        	<ul>
            <?	if( $_SESSION['admin_user_type'] == "1" ){?>
            <!--
                <li>
                    <a href="index.php?module_name=checklist_management&amp;file_name=add_checklist&amp;tab=checklist">Start A New Tour Check Lists</a> 
                </li>
                <li><span><img src="images/mnu-sep2.gif" alt="sep2" /></span></li>
            -->
                <li>
                    <a href="index.php?module_name=checklist_management&amp;file_name=manage_checklists&amp;tab=checklist">Manage Check List Type</a>
                </li>
                <li><span><img src="images/mnu-sep2.gif" alt="sep2" /></span></li>
                <li>
                    <a href="index.php?module_name=checktype_management&amp;file_name=manage_checktypes&amp;tab=checklist">Manage Check List Category/Group</a>
                </li>
                <li><span><img src="images/mnu-sep2.gif" alt="sep2" /></span></li>
                  <li>
                    <a href="index.php?module_name=crewpretourchecklist_management&amp;file_name=manage_crewpretourchecklists&amp;tab=checklist">Manage Tour Checklist</a>
                </li>
                <? } ?> 
            </ul>    
            
        	<?
			break;
			case "pdfs":
		?>
            <ul>
             <?	if( $_SESSION['admin_user_type'] == "1" ){?>
                <li>
                    <a href="index.php?module_name=pdf_management&amp;file_name=add_pdf&amp;tab=pdfs">Add Download File</a> 
                </li>
                <li><span><img src="images/mnu-sep2.gif" alt="sep2" /></span></li>
             <? } ?>   
                <li>
                    <a href="index.php?module_name=pdf_management&amp;file_name=manage_pdf&amp;tab=pdfs">Manage Downloads</a>
                </li>
                <li><span><img src="images/mnu-sep2.gif" alt="sep2" /></span></li>
            </ul>    	
			 <?
			break;
			
			case "settings";
		?>
        	<ul>
                <li>
                   <a href="index.php?module_name=manage_modules&amp;tab=settings">Manage Modules</a>
                </li>
                <li><span><img src="images/mnu-sep2.gif" alt="sep2" /></span></li>
            </ul>
		<?
			break;
	 	}	//	End of switch ( $_REQUEST['tab'] ) ?>
        </div>
    
    </div>
<!--End Btm Header-->

</div>