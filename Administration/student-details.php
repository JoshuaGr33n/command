<?php session_start();?>

<?php
if($_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}


if($_GET['studentID'] =="")
{
header("Location: dashboard.php" );
exit;
}




//database connection
include('include/db.php');


//check for wrong url input

$check = "SELECT * FROM students where student_id = '".$_GET['studentID']."'";
$rs = mysqli_query($con, $check);
//$data = mysqli_fetch_array($rs, MYSQLI_NUM);
$num_rows =mysqli_num_rows($rs);
$data=mysqli_fetch_array($rs);




if($_GET['studentID'] != $data['student_id'])
   {
	 

	 header("Location: dashboard.php" );
    exit;


   }



?>



<?php

	
	
		$studentDetailQuery = "SELECT * FROM students where student_id= '".$_GET['studentID']."'";
        $studentDetailResult = mysqli_query($con, $studentDetailQuery);
	
	
	
	
	// Loop through each row, outputting the login and password
while ($studentDetailrow = mysqli_fetch_array($studentDetailResult))
{
$student_id = $studentDetailrow['student_id'];
$fname = $studentDetailrow['FirstName'];
$mName = $studentDetailrow['MiddleName'];
$lname = $studentDetailrow['LastName'];
$email = $studentDetailrow['Email'];
$dob = $studentDetailrow['DOB'];
$fone = $studentDetailrow['Phone'];
$term = $studentDetailrow['Term'];
$session = $studentDetailrow['session'];
$class = $studentDetailrow['Class'];
$sportHouse = $studentDetailrow['SportHouse'];
$state = $studentDetailrow['State_Of_Origin'];
$lga = $studentDetailrow['LGA'];
$address = $studentDetailrow['Address'];
$profilePic = $studentDetailrow['ProfilePic'];
$regNum = $studentDetailrow['RegNum'];
$gender = $studentDetailrow['Gender'];
$status = $studentDetailrow['status'];




}			
	
	
	

$_SESSION['delete_Student_id'] = $student_id;
	?>


<?php 
$setResultMarkCurrentPageTag="";

$studentsExpand="";
$ExpandAdmin="";
$ExpandResults="";
$ExpandSiteManager="";
$ExpandPinManager="";




 $pinGeneratorCurrentPageTag="";
  $allPinCurrentPageTag="";
  $resultPageManagerCurrentPageTag="";
  $frontPageManagerCurrentPageTag="";
  $downloadResultClassCurrentPageTag="";
  $importResultClassCurrentPageTag="";
  $searchResultClassCurrentPageTag="";
  $allStudentResultClassCurrentPageTag="";
  $searchResultByClassCurrentPageTag="";
  $addNewAdminsCurrentPageTag="";
  $allAdminsCurrentPageTag="";
  $addnewStudentsCurrentPageTag="";
  $promoteStudentsCurrentPageTag="";
  $classPositionCurrentPageTag="";
  $updateSchoolDetailsCurrentPageTag="";
  $importRegSubjectCurrentPageTag="";
  $allSubjectCurrentPageTag="";
  $allSessionCurrentPageTag="";
  $sportHouseCurrentPageTag="";
  $allClassesCurrentPageTag="";
  $studentsActiveTag="";
  $dashboardActiveTag="";
?>

<?php 
// side bar and header
           include('include/privilege-restrictions.php');


?>





<?php 

if($studentManagement!="YES")
{
    header("Location: index.php" );
exit;
}

$editStudentlink1="";
$editStudentlink2="";
$deactivateLink="";
$activateLink="";
$deleteLink="";
$registerSubjectLink="";
$viewStudentResultLink="";
$viewStudentAnnualResultLink="";

if($addEditStudentM =="YES")
{
	$editStudentlink1='<a href="edit-student-info.php?edit='.$student_id.'" class="btn btn-sm btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1" style="color:#fff;margin-right:10px;">Edit Student Info</a>';

	$editStudentlink2='<div class="navi-item mb-2">
	<a href="edit-student-info.php?edit='.$student_id.'" class="navi-link py-4">
		<span class="navi-icon mr-2">
			<span class="svg-icon">
				<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Code/Compiling.svg-->
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<rect x="0" y="0" width="24" height="24" />
						<path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />
						<path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />
					</g>
				</svg>
				<!--end::Svg Icon-->
			</span>
		</span>
		<span class="navi-text font-size-lg">Edit Student Info</span>
	</a>
</div>';


	
	$deactivateLink='<button name="deactivate" class="btn btn-sm btn-primary font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">Deactivate</button>';
	$activateLink='<button name="activate" class="btn btn-sm btn-success font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">Reactivate</button>';
	$deleteLink='<button name="delete" onClick="setDeleteAction();" class="btn btn-sm btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1">Delete</button>';


	$registerSubjectLink=' <div class="navi-item mb-2">
	<a href="register-subjects.php?studentID='.$student_id.'" class="navi-link py-4">
		<span class="navi-icon mr-2">
			<span class="svg-icon">
				<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Mail-opened.svg-->
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<rect x="0" y="0" width="24" height="24" />
						<path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" fill="#000000" opacity="0.3" />
						<path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000" />
					</g>
				</svg>
				<!--end::Svg Icon-->
			</span>
		</span>
		<span class="navi-text font-size-lg">Register Subjects</span>
	</a>
	</div>';

}

if($resultManagement=="YES")
{



$viewStudentResultLink='<div class="navi-item mb-2">
<a href="select-student-result-category.php?studentID='.$student_id.'" class="navi-link py-4" data-toggle="tooltip"><!--title="Coming soon..." data-placement="right"-->
	<span class="navi-icon mr-2">
		<span class="svg-icon">
			<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-top-panel-6.svg-->
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<rect x="0" y="0" width="24" height="24" />
					<rect fill="#000000" x="2" y="5" width="19" height="4" rx="1" />
					<rect fill="#000000" opacity="0.3" x="2" y="11" width="19" height="10" rx="1" />
				</g>
			</svg>
			<!--end::Svg Icon-->
		</span>
	</span>
	<span class="navi-text font-size-lg">View Student Result</span>
</a>
</div>';



$viewStudentAnnualResultLink='<div class="navi-item mb-2">
<a href="select-student-annual-result-category.php?studentID='.$student_id.'" class="navi-link py-4">
	<span class="navi-icon mr-2">
		<span class="svg-icon">
			<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Shield-user.svg-->
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<rect x="0" y="0" width="24" height="24" />
					<path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3" />
					<path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" fill="#000000" opacity="0.3" />
					<path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.3" />
				</g>
			</svg>
			<!--end::Svg Icon-->
		</span>
	</span>
	<span class="navi-text font-size-lg">View Student Annual Result</span>
	
</a>
</div>';




}

?>









<?php

//output all from students table
        $allStudentQuery = "SELECT * FROM students";
        $allStudentResult = mysqli_query($con, $allStudentQuery);
	
	




?>







<?php
$sucUpdate="";
$errorUpdate="";

$editDQuery="";

if(isset($_POST['deactivate']))
{
        

        

    //update administration table
   $editDQuery = "Update students set status = 'Deactivated'
     
    Where  student_id = '". $student_id ."'";

	$editDResult ="";
    
    if($editDQuery)
    
    
    {
    
      $editDResult = mysqli_query($con, $editDQuery);
    }
    
    
    
    
    
    if($editDResult)
    {
    
        header("Location: student-details.php?studentID=$student_id");
    
    }
    
    
    

        


  }
?>


<?php
$sucUpdate="";
$errorUpdate="";

$editAQuery="";

if(isset($_POST['activate']))
{
        

        

    //update administration table
   $editAQuery = "Update students set status = 'Activated'
     
	Where  student_id = '". $student_id ."'";
	



	if($editAQuery)
    
    
    {
    
      $editAResult = mysqli_query($con, $editAQuery);
    }
    
    
    
    
    
    if($editAResult)
    {
    
        header("Location: student-details.php?studentID=$student_id");
    
    }


    

        


  }





  $allStudentcountSql = "select COUNT(student_id) RegNum from students  where Class='".$class."'";
$allStudentcountResult = mysqli_query($con, $allStudentcountSql) or die ("Error!");

while ($cRow = mysqli_fetch_array($allStudentcountResult)) {

  $var = $cRow['RegNum'];

  $allStudentNumber=$var;

}
?>













<!DOCTYPE html>
<html lang="en">
  <head>
  <meta name="description" content="">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="">
    <meta property="twitter:site" content="">
    <meta property="twitter:creator" content="">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="">
    <meta property="og:title" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:description" content="">
    <title>Student Profile: <?php echo $fname;?> <?php echo $lname;?> </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  





  <!--begin::Global Theme Styles(used by all pages)-->
       <link href="external/plugins/global/plugins.bundle526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<link href="external/plugins/custom/prismjs/prismjs.bundle526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<link href="external/css/style.bundle526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<link href="external/css/themes/layout/header/base/light526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<link href="external/css/themes/layout/header/menu/light526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<link href="external/css/themes/layout/brand/dark526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<link href="external/css/themes/layout/aside/dark526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<!--end::Layout Themes-->
  
  



<!--edit and delete form script-->

<script language="javascript" src="formjs/delete-students.js" type="text/javascript"></script>
<!--edit and delete form script-->

  
  </head>
  <body class="app sidebar-mini">



  <?php 
// side bar and header
           include('include/nav_header.php');


        ?>





    <main class="app-content">
      <div class="row user">
        <div class="col-md-12">
          <div class="profile">
            
            <!--<div class="cover-image"></div>-->
            
        





            

            <!--begin::Entry-->
						<div class="d-flex flex-column-fluid"  style="margin-top:20px;">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Profile Personal Information-->
								<div class="d-flex flex-row">


									<!--begin::Aside-->
									<div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
										<!--begin::Profile Card-->
										<div class="card card-custom card-stretch">
											<!--begin::Body-->
											<div class="card-body pt-4">
												
												<!--begin::User-->
												<div class="d-flex align-items-center">
													<div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
														<div class="symbol-label" style="background-image:url('images/student-passport/<?php echo $profilePic;?>')"></div>
														<i class="symbol-badge bg-success"></i>
													</div>
													<div>
														<a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary"><?php echo $fname;?> <?php echo $lname;?></a>
														<div class="text-muted"><?php echo $class;?></div>
														<div class="mt-2">
															<form method="post" name="frmUser" action="">
														<?php 
														
														if($status=="Activated")
														{
														echo $deactivateLink;

														}

														else{


															echo $activateLink;
														}




														
														?>
														
														
														
														
														
														
									
														





                           

														 <?php echo $deleteLink;?>

														 </form>
                                                             
														</div>
													</div>
												</div>
												<!--end::User-->
												<!--begin::Contact-->
												<div class="py-9">
													<div class="d-flex align-items-center justify-content-between mb-2">
														<span class="font-weight-bold mr-2">Reg. Number:</span>
														<a href="#" class="text-muted text-hover-primary"><b><?php echo $regNum;?></b></a>
													</div>
													<div class="d-flex align-items-center justify-content-between mb-2">
														<span class="font-weight-bold mr-2">Class:</span>
														<span class="text-muted"><b><?php echo $class;?></b></span>
													</div>
													<div class="d-flex align-items-center justify-content-between">
														<span class="font-weight-bold mr-2">House:</span>
														<span class="text-muted"><b><?php echo $sportHouse;?></b></span>
													</div>
												</div>
												<!--end::Contact-->
												<!--begin::Nav-->
												<div class="navi navi-bold navi-hover navi-active navi-link-rounded">
													<div class="navi-item mb-2">
													
															<span class="navi-icon mr-2">
																<span class="svg-icon">
																
																</span>
															</span>

															<?php

															if($status=="Deactivated"){

																echo'<button  class="btn btn-sm btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-left:15%">Student Deactivated</button>';




															}

															?>



															
														
													</div>
													<div class="navi-item mb-2">
														<a href="#" class="navi-link py-4 active">
															<span class="navi-icon mr-2">
																<span class="svg-icon">
																	<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/User.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<polygon points="0 0 24 0 24 24 0 24" />
																			<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																			<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
															</span>
															<span class="navi-text font-size-lg">Student Information</span>
														</a>
													</div>


													<?php echo $editStudentlink2;?>



													<div class="navi-item mb-2">
														<a href="classmates.php?classmate=<?php echo $class;?>" class="navi-link py-4">
															<span class="navi-icon mr-2">
																<span class="svg-icon">
																	<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Shield-user.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3" />
																			<path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" fill="#000000" opacity="0.3" />
																			<path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.3" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
															</span>
															<span class="navi-text font-size-lg">Classmates</span>
															<span class="navi-label">
																<span class="label label-light-success label-rounded font-weight-bold"><?php echo $allStudentNumber;?></span>
															</span>
														</a>
													</div>
                          
                                                  <?php echo $registerSubjectLink;?>
                          
												
                          <div class="navi-item mb-2">
														<a href="registered-subjects.php?studentID=<?php echo $student_id;?>" class="navi-link py-4" data-toggle="tooltip"> <!--title="Coming soon..." data-placement="right"-->
															<span class="navi-icon mr-2">
																<span class="svg-icon">
																	<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Text/Article.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5" />
																			<path d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L12.5,10 C13.3284271,10 14,10.6715729 14,11.5 C14,12.3284271 13.3284271,13 12.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z" fill="#000000" opacity="0.3" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
															</span>
															<span class="navi-text">Registered Subjects</span>
														</a>
													</div>

													<?php echo $viewStudentResultLink;?>

													<?php echo $viewStudentAnnualResultLink;?>
													
													
												</div>
												<!--end::Nav-->
											</div>
											<!--end::Body-->
										</div>
										<!--end::Profile Card-->
									</div>
                  <!--end::Aside-->
                  
                  
									<!--begin::Content-->
									<div class="flex-row-fluid ml-lg-8">
										<!--begin::Card-->
										<div class="card card-custom card-stretch">
											<!--begin::Header-->
											<div class="card-header py-3">
												<div class="card-title align-items-start flex-column">
													<h3 class="card-label font-weight-bolder text-dark"><?php echo $fname;?> <?php echo $lname;?></h3>
													<span class="text-muted font-weight-bold font-size-sm mt-1">Personal Information</span>
												</div>
												<div class="card-toolbar">
                          
                         
						  <a href="select-student-result-category.php?studentID=<?php echo $student_id;?>" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">View Results</a>
						  <a href="classmates.php?classmate=<?php echo $class;?>" class="btn btn-sm btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1" style="color:#fff; margin-right:5px;">Classmates</a>
                                                    
                                                    
                            <?php echo $editStudentlink1;?>
                                                    
                          
                          <!--<button type="reset" class="btn btn-success mr-2"><a href="" style="color:white;">Make Changes</a></button>-->
													<a class="btn btn-secondary font-weight-bold py-2 px-3 px-xxl-5 my-1" href="all-students.php">All Students</a>
												</div>
											</div>
											<!--end::Header-->
											<!--begin::Form-->
											<form class="form">
												<!--begin::Body-->
												<div class="card-body">
													<div class="row">
														<label class="col-xl-3"></label>
														<div class="col-lg-9 col-xl-6">
															<h5 class="font-weight-bold mb-6">Student Info</h5>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Student Passport</label>
														<div class="col-lg-9 col-xl-6">
															<div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url(external/media/users/blank.png)">
																<div class="image-input-wrapper" style="background-image: url(images/student-passport/<?php echo $profilePic;?>)"></div>
																<label  data-action="change">
																	
																	
																	
																</label>
																
															</div>
															
														</div>
                          </div>
                          
                          
                          
                          
                          <!--info sub headings-->
                          <div class="row">
														<label class="col-xl-3"></label>
														<div class="col-lg-9 col-xl-6">
															<h5 class="font-weight-bold mt-10 mb-6">Personal Info</h5>
														</div>
                          </div>
                          <!---->
                          



													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">First Name</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $fname;?>" disabled />
														</div>
                          </div>
                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Middle Name</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $mName;?>"  disabled/>
														</div>
													</div>

													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $lname;?>" disabled/>
														</div>
                          </div>
                          

                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Gender</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $gender;?>" disabled/>
														</div>
													</div>


                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Date Of Birth</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $dob;?>" disabled/>
														</div>
                          </div>


                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Address</label>
														<div class="col-lg-9 col-xl-6">
															<textarea class="form-control form-control-lg form-control-solid" disabled><?php echo $address;?></textarea>
														</div>
                          </div>

                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">State Of Origin</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $state;?>" disabled />
															<!--<span class="form-text text-muted"></span>-->
                            </div>
                          </div>  

                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">LGA</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $lga;?>" disabled />
															<!--<span class="form-text text-muted"></span>-->
                            </div>
                          </div>  




                          




                          
                           <!--info sub headings--> 
                          <div class="row">
														<label class="col-xl-3"></label>
														<div class="col-lg-9 col-xl-6">
															<h5 class="font-weight-bold mt-10 mb-6">School Info</h5>
														</div>
                          </div>
                          <!---->




                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Registration Number</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $regNum;?>" disabled />
															<!--<span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>-->
                            </div>
                          </div>  

													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Class</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $class;?>" disabled />
															<!--<span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>-->
                            </div>
                          </div>  
                            
                          

                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Session</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $session;?>" disabled />
															
                            </div>
                            
                          </div>
                          

                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Term</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $term;?> Term" disabled />
															
                            </div>
                            
                          </div>


                




                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">House</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $sportHouse;?>" disabled />
															
                            </div>
                            
                          </div>
                          



                          
                          






													 <!--info sub headings-->
                          <div class="row">
														<label class="col-xl-3"></label>
														<div class="col-lg-9 col-xl-6">
															<h5 class="font-weight-bold mt-10 mb-6">Contact Info</h5>
														</div>
                          </div>
                          <!---->
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Contact Phone</label>
														<div class="col-lg-9 col-xl-6">
															<div class="input-group input-group-lg input-group-solid">
																<div class="input-group-prepend">
																	<span class="input-group-text">
																		<i class="la la-phone"></i>
																	</span>
																</div>
																<input type="text" class="form-control form-control-lg form-control-solid" value="<?php echo $fone;?>" placeholder="None" disabled />
															</div>
															<!--<span class="form-text text-muted">We'll never share your email with anyone else.</span>-->
														</div>
													</div>
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
														<div class="col-lg-9 col-xl-6">
															<div class="input-group input-group-lg input-group-solid">
																<div class="input-group-prepend">
																	<span class="input-group-text">
																		<i class="la la-at"></i>
																	</span>
																</div>
																<input type="text" class="form-control form-control-lg form-control-solid" value="<?php echo $email;?>" placeholder="None" disabled />
															</div>
														</div>
													</div>
													
												</div>
												<!--end::Body-->
											</form>
											<!--end::Form-->
										</div>
									</div>
									<!--end::Content-->
								</div>
								<!--end::Profile Personal Information-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->

            








          </div>
        </div>
        
        
      </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>




<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="external/plugins.bundle526f.js?v=7.0.8"></script>
		<script src="external/plugins/custom/prismjs/prismjs.bundle526f.js?v=7.0.8"></script>
		<script src="external/js/scripts.bundle526f.js?v=7.0.8"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="external/js/pages/widgets526f.js?v=7.0.8"></script>
		<script src="external/js/pages/custom/profile/profile526f.js?v=7.0.8"></script>
		<!--end::Page Scripts-->




  </body>
</html>