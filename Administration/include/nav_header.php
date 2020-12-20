<?php  




//fetch details from privileges table
$myDetailQuery = "SELECT * FROM administration where Sno = '".$_SESSION['AdministratorSno']."'";
$myDetailResult = mysqli_query($con, $myDetailQuery);

// Loop through each row, outputting the login and password


while ($myDetailRow = @mysqli_fetch_assoc($myDetailResult))
{
  $myfirstName = $myDetailRow['First_Name'];
  $mylastName = $myDetailRow['Last_Name'];
  $myStatus = $myDetailRow['Status'];
  $adminProfilePic = $myDetailRow['ProfilePic'];




}


?>
<style type="text/css">

.app-header {
  
  background-color: #f0ad4e;
 
}
.app-header__logo {
  background-color: #f0ad4e;
}
.app-sidebar__toggle:focus, .app-sidebar__toggle:hover {
  background-color: #dc3545;
}


.btn-primary {
  color: #fff;
  background-color:#009688; /*#6c757d*/
  border-color: #009688;
}
.btn-primary:hover {
  color: #fff;
  background-color: #009688;
  border-color: #009688;
}



a {
  color: #009688;
 
}

.page-link {
  color: #f0ad4e;
}
.page-item.active .page-link {
  z-index: 1;
  color: #000;
  background-color:#f0ad4e;
  border-color: #f0ad4e;
}


</style>
<!-- Navbar-->



<header class="app-header"><a class="app-header__logo" href="dashboard.php">Administration</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        

        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="edit-my-profile.php"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
            <li><a class="dropdown-item" href="my-profile.php"><i class="fa fa-user fa-lg"></i> My Profile</a></li>
            <li><a class="dropdown-item" href="logout.php?logout=1"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="images/profile-pics/<?php echo $adminProfilePic;?>" alt="Profile Pic" width="40" height="40">
        <div>
          <p class="app-sidebar__user-name"><?php echo $myfirstName;?> <?php echo $mylastName;?></p>
          <p class="app-sidebar__user-designation"><?php echo $myStatus;?></p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item <?php echo $dashboardActiveTag;?>" href="dashboard.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        


        
           <!--manage students-->
        <?php echo $manageStudentLink;?>
          <ul class="treeview-menu">
            <li><a class="treeview-item <?php echo $studentsActiveTag;?>" href="all-students.php"><i class="icon fa fa-circle-o"></i>All Students</a></li>
            <li><a class="treeview-item <?php echo $allClassesCurrentPageTag;?>" href="allclasses.php"  rel="noopener"><i class="icon fa fa-circle-o"></i>Classes</a></li>
            
            <li><a class="treeview-item <?php echo $allSessionCurrentPageTag;?>" href="all-session.php"><i class="icon fa fa-circle-o"></i>Sessions</a></li>
            <li><a class="treeview-item <?php echo $sportHouseCurrentPageTag;?>" href="all-sport-house.php"><i class="icon fa fa-circle-o"></i>Sport Houses</a></li>
            <li><a class="treeview-item <?php echo $allSubjectCurrentPageTag;?>" href="all-subjects.php"><i class="icon fa fa-circle-o"></i> Subjects</a></li>
            <?php echo  $importRegSubjectsLink;?>
           
            <li><a class="treeview-item <?php echo $classPositionCurrentPageTag;?>" href="class-position.php"><i class="icon fa fa-circle-o"></i>Class Positions</a></li>
            <li><a class="treeview-item <?php echo $promoteStudentsCurrentPageTag;?>" href="select-promote-student-category.php"><i class="icon fa fa-circle-o"></i>Promote Students</a></li>
            <?php echo $AddNewStudentLink;?>
         </ul>
        </li>
         <!--manage students-->
         

        <!--<li><a class="app-menu__item" href="charts.html"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Charts</span></a></li>-->
        
        
        
        <!--manage admins-->
        <?php echo $manageAdminLink;?>
          <ul class="treeview-menu">
            <li><a class="treeview-item <?php echo $allAdminsCurrentPageTag;?>" href="all-admins.php"><i class="icon fa fa-circle-o"></i> All Admins</a></li>
            <li><a class="treeview-item <?php echo $addNewAdminsCurrentPageTag;?>" href="add-new-admin.php"><i class="icon fa fa-circle-o"></i>Create New Admin</a></li>
          </ul>
        </li>
        <!--manage admins-->

        <!--manage result-->
        <?php echo $manageResultLink;?>
          <ul class="treeview-menu">
            <li><a class="treeview-item <?php echo $searchResultByClassCurrentPageTag;?>" href="select-result-class-category.php"><i class="icon fa fa-circle-o"></i> Search Results by Class</a></li>
            <li><a class="treeview-item <?php echo  $allStudentResultClassCurrentPageTag;?>" href="view-results.php"><i class="icon fa fa-circle-o"></i> All Students Results</a></li>
            <li><a class="treeview-item <?php echo $searchResultClassCurrentPageTag;?>" href="search-results.php"><i class="icon fa fa-circle-o"></i>Search Results By Subject</a></li>
            <li><a class="treeview-item <?php echo $importResultClassCurrentPageTag;?>" href="uploadresult.php"><i class="icon fa fa-circle-o"></i>Import Results</a></li>
            <li><a class="treeview-item <?php echo $downloadResultClassCurrentPageTag;?>" href="download-result.php"><i class="icon fa fa-circle-o"></i>Download Results Template</a></li>
          </ul>
        </li>
        <!--manage result-->


        <!--manage site-->
         <?php echo $manageSiteLink;?>
          <ul class="treeview-menu">
            <li><a class="treeview-item <?php echo $frontPageManagerCurrentPageTag;?>" href="front-page-manager.php"><i class="icon fa fa-circle-o"></i>Front Page Manager</a></li>
            <li><a class="treeview-item <?php echo  $resultPageManagerCurrentPageTag;?>" href="results-page-manager.php"><i class="icon fa fa-circle-o"></i>Results Page Manager</a></li>
            <li><a class="treeview-item <?php echo $updateSchoolDetailsCurrentPageTag;?>" href="update-school-details.php"><i class="icon fa fa-circle-o"></i>Update School Details</a></li>
          </ul>
        </li>
        <!--manage site-->
     
     
        <!--manage pin-->
        
        <?php echo $managePinLink;?>
          <ul class="treeview-menu">
            <li><a class="treeview-item <?php echo $pinGeneratorCurrentPageTag;?>" href="pin-generator.php"><i class="icon fa fa-circle-o"></i>Pin Generator</a></li>
            <li><a class="treeview-item <?php echo $allPinCurrentPageTag;?>" href="all-pins.php"><i class="icon fa fa-circle-o"></i>View all Pins</a></li>
            
          </ul>
        </li>
        <!--manage pin-->
          <!--settings-->
        
          <?php echo $settingsLink;?>
          <!--<ul class="treeview-menu">
            <li><a class="treeview-item <?php //echo $setResultMarkCurrentPageTag;?>" href="set-result-marks.php"><i class="icon fa fa-circle-o"></i>Set Result Marks</a></li>
            
            
          </ul>-->
        </li>
        <!--settings-->






       
      </ul>
    </aside>