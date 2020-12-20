<?php 


    
  



//fetch details from privileges table
$myDetailQuery = "SELECT * FROM administration where Sno = '".$_SESSION['AdministratorSno']."'";
$myDetailResult = mysqli_query($con, $myDetailQuery);

// Loop through each row, outputting the login and password


while ($myDetailRow = @mysqli_fetch_assoc($myDetailResult))
{
    $adminRestriction= $myDetailRow['Restriction'];




}







if( $adminRestriction =="Deactivated")
{
header("Location: index.php" );
exit;
}



//fetch details from privileges table
$fetchPrivilegesQuery = "SELECT * FROM privileges where AdminUsername = '".$_SESSION['Adminusername']."'";
$fetchPrivilegesResult = mysqli_query($con, $fetchPrivilegesQuery);

// Loop through each row, outputting the login and password


while ($privilegesRow = @mysqli_fetch_assoc($fetchPrivilegesResult))
{
$studentManagement = $privilegesRow['StudentManagement'];
$addEditStudentM = $privilegesRow['AddEditStudents'];
$adminManagement = $privilegesRow['AdminManagement'];
$siteManagement = $privilegesRow['siteManagement'];
$resultManagement = $privilegesRow['ResultManagement'];
$pinManagement = $privilegesRow['PinManagement'];
$settings = $privilegesRow['Settings'];



}


$manageStudentLink="";
$manageAddEditLink="";
$manageAdminLink="";
$managePinLink="";
$manageResultLink="";
$manageSiteLink="";
$settingsLink="";
$AddNewStudentLink="";

$AddNewStudentLink2= "";
$importRegSubjectsLink= "";
$importRegSubjectsLink2= "";





    
    







if( $_SESSION['status'] =="Super Administrator")
{
    $manageStudentLink='<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Manage Students</span><i class="treeview-indicator fa fa-angle-right"></i></a>';
    $manageAdminLink='<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Manage Admins</span><i class="treeview-indicator fa fa-angle-right"></i></a>';
    $managePinLink='<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Pin Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>';
    $manageSiteLink='<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Site Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>';
    $manageResultLink='<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Results Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>';
    $manageClassesLink= ' <li><a class="treeview-item" href="allclasses.php" target="_blank" rel="noopener"><i class="icon fa fa-circle-o"></i>Classes</a></li>';
    $manageSubjectsLink= ' <li><a class="treeview-item" href="widgets.html"><i class="icon fa fa-circle-o"></i> Subjects</a></li>';
    $manageSessionsLink= '<li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>All Sessions</a></li>';
    $AddNewStudentLink= '<li><a class="treeview-item" href="add-new-student.php"><i class="icon fa fa-circle-o"></i> Add New Student</a></li>';
    $updateSchooldetailsLink= '<li><a class="treeview-item" href="update-school-details.php"><i class="icon fa fa-circle-o"></i>Update School Details</a></li>';
    $AddNewStudentLink2= '<li><a class="treeview-item" href="../add-new-student.php"><i class="icon fa fa-circle-o"></i> Add New Student</a></li>';
    $updateSchooldetailsLink2= '<li><a class="treeview-item" href="../update-school-details.php"><i class="icon fa fa-circle-o"></i>Update School Details</a></li>';
    $importRegSubjectsLink= ' <li><a class="treeview-item" href="upload-reg-subjects.php"><i class="icon fa fa-circle-o"></i>Import Student Registered Subjects</a></li>';
    $importRegSubjectsLink2= ' <li><a class="treeview-item" href="../upload-reg-subjects.php"><i class="icon fa fa-circle-o"></i>Import Student Registered Subjects</a></li>';


   // $studentManagement="";
    //$adminManagement="";
   // $pinManagement="";
    //$siteManagement="";
    //$resultManagement="";
    //$addEditStudentM="";
   
}






if($studentManagement=="YES")
{
    $manageStudentLink='<li class="treeview  '.$studentsExpand.'"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Student Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>';
}



if($adminManagement=="YES")
{
    $manageAdminLink='<li class="treeview '.$ExpandAdmin.'"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Admin Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>';
}


if($siteManagement=="YES")
{
    $manageSiteLink='<li class="treeview '.$ExpandSiteManager.'"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Site Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>';
}



if($pinManagement=="YES")
{
    $managePinLink= '<li class="treeview '.$ExpandPinManager.'"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Pin Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>';
}

if($resultManagement=="YES")
{
    $manageResultLink= '<li class="treeview '.$ExpandResults.'"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Results Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>';
}
if($settings=="YES")
{
    $settingsLink =  '<li><a class="app-menu__item '.$setResultMarkCurrentPageTag.'" href="set-result-marks.php"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Settings</span></a></li>';
    $settingsLink2 = '<li><a class="app-menu__item '.$setResultMarkCurrentPageTag.'" href="../set-result-marks.php"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Settings</span></a></li>';
}

if($addEditStudentM=="YES")
{
    
    $AddNewStudentLink= '<li><a class="treeview-item '.$addnewStudentsCurrentPageTag.'" href="add-new-student.php"><i class="icon fa fa-circle-o"></i> Add New Student</a></li>';
   
    $AddNewStudentLink2= '<li><a class="treeview-item" href="../add-new-student.php"><i class="icon fa fa-circle-o"></i> Add New Student</a></li>';
    
    $importRegSubjectsLink= ' <li><a class="treeview-item '.$importRegSubjectCurrentPageTag.'" href="upload-reg-subjects.php"><i class="icon fa fa-circle-o"></i>Import Student Registered Subjects</a></li>';
    $importRegSubjectsLink2= ' <li><a class="treeview-item" href="../upload-reg-subjects.php"><i class="icon fa fa-circle-o"></i>Import Student Registered Subjects</a></li>';
   
}












?>