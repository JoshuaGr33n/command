<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}


if( $_GET['edit'] =="")
{
header("Location: dashboard.php" );
exit;
}


//database connection
include('include/db.php');




//check for wrong url input

$check = "SELECT * FROM students where student_id = '".$_GET['edit']."'";
$rs = mysqli_query($con, $check);
//$data = mysqli_fetch_array($rs, MYSQLI_NUM);
$num_rows =mysqli_num_rows($rs);
$data=mysqli_fetch_array($rs);




if($_GET['edit'] != $data['student_id'])
   {
	 

	 header("Location: dashboard.php" );
    exit;


   }






?>


<?php 
$setResultMarkCurrentPageTag="";

$studentsExpand="";
$ExpandAdmin="";
$ExpandResults="";
$ExpandSiteManager="";
$ExpandPinManager="";




$pinGeneratorCurrentPageTag="active";
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

if($addEditStudentM!="YES")
{
    header("Location: index.php" );
exit;
}


?>


<?php

//output all from students table
        $allStudentQuery = "SELECT * FROM students";
        $allStudentResult = mysqli_query($con, $allStudentQuery);
	
	




?>





<?php

	
	
		$studentDetailQuery = "SELECT * FROM students where student_id= '".$_GET['edit']."'";
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




}			
	
	
	
	?>


<?php
//update student info

$errFname="";
$errLname="";
$errGender="";
$errDOB="";
$errAddress="";
$errState="";
$errLGA="";
$errClass="";
$errSession="";
$errTerm="";
$errHouse="";
$errRegNum= "";
$errRegExists="";

$sucUpdate="";
$errorUpdate="";

$updateQuery="";
$updatePassportQuery = "";



if(isset($_POST['updatePassport']))
{
	$dir="images/student-passport/";
    $image=$_FILES['profile-pic']['name'];
    $temp_name=$_FILES['profile-pic']['tmp_name'];
 
    if($image!="")
    {
        if(file_exists($dir.$image))
        {
            $image= time().'_'.$image;
        }
 
        $fdir= $dir.$image;
        move_uploaded_file($temp_name, $fdir);
	}
	

	if( $_FILES['profile-pic']['size']>5000)
   {
   

   $updatePassportQuery = "update students set ProfilePic='".$image."'
	 where student_id='".$student_id."'";
   
   }  


   $updatePassportResult ="";
   
   if($updatePassportQuery)
   
   
   {
   
	$updatePassportResult = mysqli_query($con, $updatePassportQuery);
   }
   
   
   
   
   
   if($updatePassportResult)
   {
   
   header("Location: edit-student-info.php?edit=$student_id");
   exit;
  
   }
   
   
   
   
   
   else if (!$updatePassportResult)
   
   
   {
   
	   $errorUpdate= "Error";
   }



 



					

					


   




}


if(isset($_POST['update']))
{
    
    
    $updateFname = $_POST['fname'];
    $updateMname = $_POST['mname'];
    $updateLname = $_POST['lname'];
    $updateGender = $_POST['gender'];
    $updateDOB = $_POST['dob'];
    $updateAddress = $_POST['address'];
    $updateState = $_POST['state'];
    $updateLGA = $_POST['lga'];
	  $updateClass = $_POST['class'];
    $updateSession = $_POST['session'];
    $updateTerm = $_POST['term'];
    $updateHouse = $_POST['house'];
    $updatePhone = $_POST['phone'];
  $updateEmail = $_POST['email'];
  
  $updateFname = strtoupper($updateFname);
  $updateMname = strtoupper($updateMname);
  $updateLname = strtoupper($updateLname);
	





	
	









    //checking if any field is empty
    if($updateFname ==""){
             
  $errFname= "First Name must not be empty";


            }

  if($updateLname ==""){

  $errLname= "Last Name must not be empty";


              }

  if($updateGender ==""){

  $errGender= "Gender field must not be empty";
  }
  if($updateDOB ==""){

    $errDOB= "Date Of Birth field must not be empty";
  }

  

  
  if($updateClass ==""){

    $errClass= "You MUST select your current class";
  }

  

  if($updateSession ==""){

    $errSession= "You MUST select your current session";
  }


  

  if($updateTerm ==""){

    $errTerm= "You MUST select your current term";
  }

  

  


            




  


  if($updateFname !="" && $updateLname !="" && $updateGender!="" && $updateDOB !="" 
     && $updateClass !="" && $updateSession !="" && $updateTerm !="")
    {
    

    $updateQuery = "UPDATE students SET FirstName='".$updateFname."', MiddleName='".$updateMname."', LastName='".$updateLname."', Class='".$updateClass."'
    , session='".$updateSession."', Term='".$updateTerm."' , SportHouse='".$updateHouse."', Gender='".$updateGender."', DOB='".$updateDOB."', 
       State_Of_Origin='".$updateState."', LGA='".$updateLGA."', Phone='".$updatePhone."', Email='".$updateEmail."', Address='".$updateAddress."'
      WHERE student_id='".$student_id."'";


     
        mysqli_query($con, "UPDATE registered_subjects SET current_class='".$updateClass."'
        WHERE StudentID='".$student_id."'");

    }  


    $updateResult ="";
    
    if($updateQuery)
    
    
    {
    
        $updateResult = mysqli_query($con, $updateQuery);
    }
    
    
    
    
    
    if($updateResult)
    {
    
    header("Location: edit-student-info.php?edit=$student_id");
    exit;
    $sucUpdate="<span class='saved'>Changes Saved!</span>";
    }
    
    
    
    
    
    else if (!$updateResult)
    
    
    {
    
        $errorUpdate= "Error";
    }



  



                     

                     


    

}

?>

<?php


$updateRegNumQuery ="";
if(isset($_POST['updateReg']))
{
    
    
    
  $updateRegNum = $_POST['regNumber'];
  $updateRegNum = strtoupper($updateRegNum);

  

  $ck_row=mysqli_query($con, "SELECT  RegNum FROM  students WHERE   RegNum = '".$updateRegNum."'");

  if(!mysqli_num_rows($ck_row) < 1 && $updateRegNum!=$regNum)
  {

    $errRegExists="The Registration Number Inputed already belongs to another student";


  }




  if($updateRegNum !="" && mysqli_num_rows($ck_row) < 1)
 {
 

  $updateRegNumQuery  = "update students set RegNum='".strtoupper($updateRegNum)."'
 
   where student_id='".$student_id."'";
 
 }  


 $updateRegNumResult ="";
 
 if($updateRegNumQuery)
 
 
 {
 
  $updateRegNumResult = mysqli_query($con, $updateRegNumQuery );
 }
 
 
 
 
 
 if( $updateRegNumResult)
 {
 
 header("Location: edit-student-info.php?edit=$student_id");
 exit;

 }
 
 
 
 
 
 else if (! $updateRegNumResult)
 
 
 {
 
     $errorUpdate= "Error";
 }




}   
	

?>

<?php

//output all from class table
        $allClassQuery = "SELECT * FROM classes";
        $allClassResult = mysqli_query($con, $allClassQuery);
	
?>


<?php

//output all from school_session table
        $allSessionQuery = "SELECT * FROM school_session";
        $allSessionResult = mysqli_query($con, $allSessionQuery);
	
?>

<?php

//output all from sport_house table
        $allSportHouseQuery = "SELECT * FROM sportHouse";
        $allSportHouseResult = mysqli_query($con, $allSportHouseQuery);
	
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
    <title>Edit Student Profile </title>
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


                                
                                    
                                
                                
                                
                                
                                
                                










            

           <!--begin::Content-->
									<div class="flex-row-fluid ml-lg-8">
										<!--begin::Card-->
										<div class="card card-custom card-stretch"  style="padding-left:5%;"> 
											<!--begin::Header-->
											<div class="card-header py-3">
												<div class="card-title align-items-start flex-column">
													<h3 class="card-label font-weight-bolder text-dark"><?php echo $fname;?> <?php echo $lname;?></h3>
													<span class="text-muted font-weight-bold font-size-sm mt-1"><b>Update Student Info</b></span>
												</div>
												<div class="card-toolbar">
                          
                         <!-- <a href="#" class="btn btn-sm btn-primary font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">View Result</a>-->
                         <!-- <a href="#" class="btn btn-sm btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Classmates</a>-->
                         <!--<a href="#" class="btn btn-sm btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Update Info</a>-->
                          
                          <!--<button type="reset" class="btn btn-success mr-2"><a href="" style="color:white;">Make Changes</a></button>-->
													<a class="btn btn-secondary" href="student-details.php?studentID=<?php echo $student_id;?>">Back</a>
												</div>
											</div>
											<!--end::Header-->
											<!--begin::Form-->

											<!--Update Passport-->
											<form class="form" method="post" enctype="multipart/form-data">
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
														<div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url(images/profile-pics/blank.png)">
															<div class="image-input-wrapper" style="background-image: url(images/student-passport/<?php echo $profilePic ;?>)"></div>
																<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Image">
																	<i class="fa fa-pen icon-sm text-muted"></i>
																	<input type="file" name="profile-pic" accept=".png, .jpg, .jpeg" />
																	<input type="hidden" name="profile_avatar_remove" />
																</label>
																<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
																	<i class="ki ki-bold-close icon-xs text-muted"></i>
																</span>
																<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
																	<i class="ki ki-bold-close icon-xs text-muted"></i>
																</span> 
															</div>
															<span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
														</div>
                                                    </div>
											  </div>    
											  

											  <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label"></label>
														<div class="col-lg-9 col-xl-6">
                             <input class="btn btn-success mr-2" type="submit" value="Update Passport" name="updatePassport" />
                                                           
                                                            <span class="form-text" style="color:red;"></span>
														</div>

                          

													
														
							</div>

							</form>
								<!--Update Passport-->



                	<!--Update Reg Number-->

                  <form method="post">



                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Registration Number</label>
														<div class="col-lg-6 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $regNum;?>" name="regNumber"/>
															<span  style="color:red;"><?php echo  $errRegExists;?></span>

                              <input class="btn btn-success mr-2" type="submit" value="Update" name="updateReg"  style="margin-top:5%; width:100%"/>
                                                        </div>

                                                       
                          </div>

                          </form>
                    <!--Update Reg Number-->

                          
                



									<!--Other Updates-->
							<form class="form" method="post">
                          
                          
                          
                          
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
                                                            <input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $fname;?>" name="fname" />
                                                            <span class="form-text" style="color:red;"><?php echo $errFname;?></span>
														</div>
                            </div>
                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Middle Name</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $mName;?>" name="mname" />
														</div>
													</div>

													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
														<div class="col-lg-9 col-xl-6">
                                                            <input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $lname;?>" name="lname"/>
                                                            <span class="form-text" style="color:red;"><?php echo $errLname;?></span>
														</div>
                          </div>
                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Gender</label>
														<div class="col-lg-9 col-xl-6">
                                                            <select class="form-control form-control-lg form-control-solid" name="gender">
                                                                <option value="<?php echo $gender;?>"><?php echo $gender;?></option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                              


                                                            </select>
                                                            
                                                            <span class="form-text" style="color:red;"><?php echo $errGender;?></span>
															
                                                        </div>
                            
                          </div>

                         


                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Date Of Birth</label>
														<div class="col-lg-9 col-xl-6">
                                                            <input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $dob;?>" name="dob"  id="kt_inputmask_2"/>
                                                            <span class="form-text" style="color:red;"><?php echo $errDOB;?> <code>mm/dd/yyyy</code></span>
														</div>
                          </div>

                          







                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Address</label>
														<div class="col-lg-9 col-xl-6">
                                                            <textarea class="form-control form-control-lg form-control-solid" name="address"><?php echo $address;?></textarea>
                                                            <span class="form-text" style="color:red;"><?php echo $errAddress;?></span>
														</div>
                          </div>


            <!--dyamic drop down begins-->

            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">State of Origin</label>
                <select
                  onchange="toggleLGA(this);"
                  name="state"
                  id="state"
                  class="form-control form-control-lg form-control-solid" 
                  style="width:48%; margin-left:10px;"
                >
                  <option value="<?php echo $state;?>"><?php echo $state;?> </option>
                  <option value="Abia">Abia</option>
                  <option value="Adamawa">Adamawa</option>
                  <option value="AkwaIbom">AkwaIbom</option>
                  <option value="Anambra">Anambra</option>
                  <option value="Bauchi">Bauchi</option>
                  <option value="Bayelsa">Bayelsa</option>
                  <option value="Benue">Benue</option>
                  <option value="Borno">Borno</option>
                  <option value="Cross River">Cross River</option>
                  <option value="Delta">Delta</option>
                  <option value="Ebonyi">Ebonyi</option>
                  <option value="Edo">Edo</option>
                  <option value="Ekiti">Ekiti</option>
                  <option value="Enugu">Enugu</option>
                  <option value="FCT">FCT</option>
                  <option value="Gombe">Gombe</option>
                  <option value="Imo">Imo</option>
                  <option value="Jigawa">Jigawa</option>
                  <option value="Kaduna">Kaduna</option>
                  <option value="Kano">Kano</option>
                  <option value="Katsina">Katsina</option>
                  <option value="Kebbi">Kebbi</option>
                  <option value="Kogi">Kogi</option>
                  <option value="Kwara">Kwara</option>
                  <option value="Lagos">Lagos</option>
                  <option value="Nasarawa">Nasarawa</option>
                  <option value="Niger">Niger</option>
                  <option value="Ogun">Ogun</option>
                  <option value="Ondo">Ondo</option>
                  <option value="Osun">Osun</option>
                  <option value="Oyo">Oyo</option>
                  <option value="Plateau">Plateau</option>
                  <option value="Rivers">Rivers</option>
                  <option value="Sokoto">Sokoto</option>
                  <option value="Taraba">Taraba</option>
                  <option value="Yobe">Yobe</option>
                  <option value="Zamfara">Zamafara</option>
                </select>
                <span class="form-text" style="color:red;"><?php echo $errState;?></span>
            </div>

              <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">LGA of Origin</label>
                <select
                  name="lga"
                  id="lga"
                  class="form-control form-control-lg form-control-solid select-lga"
                  required
                  style="width:48%; margin-left:10px;"
                >
                <option value="<?php echo $lga;?>"></option>
                </select>
                <span class="form-text" style="color:red;"><?php echo $errLGA;?></span>
               
            </div>
            <!--dyamic drop down ends-->




                          





                          
                           <!--info sub headings--> 
                          <div class="row">
														<label class="col-xl-3"></label>
														<div class="col-lg-9 col-xl-6">
															<h5 class="font-weight-bold mt-10 mb-6">School Info</h5>
														</div>
                          </div>
                          <!---->




                        

                        

													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Class</label>
														<div class="col-lg-9 col-xl-6">
                                                        
                                                        <select class="form-control form-control-lg form-control-solid" name="class">
                                                            <option value="<?php echo $class;?>"><?php echo $class;?></option>

                                                            <?php  while ($allClassRow = mysqli_fetch_array($allClassResult))
                                                             {
                                                                //output all from classes table
                                                                 $class_id =$allClassRow['classID']; 
                                             
                                                                $ClassName = $allClassRow['className'];
                                                                
                                                                ?>

                                                                <option value="<?php echo $ClassName ;?>"><?php echo $ClassName ;?></option>
                                                                <?php }?>
                                                        </select>
                                                        <span class="form-text" style="color:red;"><?php echo $errClass;?></span>
                                                       </div>
                                                    </div>  

                  
                                                                
                
                                                                
                   
                                                                
													
															
                                                  
                            
                          

                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Session</label>
														<div class="col-lg-9 col-xl-6">
                                                        <select class="form-control form-control-lg form-control-solid" name="session">
                                                            <option value="<?php echo $session;?>"><?php echo $session;?></option>

                                                            <?php  while ($allSessionRow = mysqli_fetch_array($allSessionResult))
                                                             {
                                                                //output all from school_session table
                                                                 $school_Session_id =$allSessionRow['sessionID']; 
                                             
                                                                $school_SessionName = $allSessionRow['sessionName'];
                                                                
                                                                ?>

                                                                <option value="<?php echo $school_SessionName;?>"><?php echo $school_SessionName ;?></option>
                                                                <?php }?>
                                                        </select>


                                                            
                                                            <span class="form-text" style="color:red;"><?php echo $errSession;?></span>
															
                                                         </div>
                            
                          </div>
                          

                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Term</label>
														<div class="col-lg-9 col-xl-6">
                                                            <select class="form-control form-control-lg form-control-solid" name="term">
                                                                <option value="<?php echo $term;?>"><?php echo $term;?> Term</option>
                                                                <option value="First">First Term</option>
                                                                <option value="Second">Second Term</option>
                                                                <option value="Third">Third Term</option>


                                                            </select>
                                                            
                                                            <span class="form-text" style="color:red;"><?php echo $errTerm;?></span>
															
                                                        </div>
                            
                          </div>


                




                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">House</label>
													<div class="col-lg-9 col-xl-6">
                                                        <select class="form-control form-control-lg form-control-solid" name="house">
                                                            <option value="<?php echo $sportHouse;?>"><?php echo $sportHouse;?></option>

                                                            <?php  while ($allSportHouseRow = mysqli_fetch_array($allSportHouseResult))
                                                             {
                                                                //output all from school_session table
                                                                 $house_id =$allSportHouseRow['houseID']; 
                                             
                                                                $houseName = $allSportHouseRow['houseName'];
                                                                
                                                                ?>

                                                                <option value="<?php echo $houseName;?>"><?php echo $houseName;?></option>
                                                                <?php }?>
                                                        </select>


                                                            
                                                            <span class="form-text" style="color:red;"><?php echo $errHouse;?></span>
															
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
																<input type="text" class="form-control form-control-lg form-control-solid" value="<?php echo $fone;?>" placeholder="None" name="phone"/>
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
																<input type="text" class="form-control form-control-lg form-control-solid" value="<?php echo $email;?>" placeholder="None" name="email"/>
															</div>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label"></label>
														<div class="col-lg-9 col-xl-6">
															<div class="">
																<input type="submit" class="btn btn-success mr-2"  style="width:100%; margin-right:5%;" value="Update" name="update"  />
																<!--<div class="input-group-append">
																	<span class="input-group-text">.com</span>
																</div>-->
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
        </div>
        
        
      </div>
    </main>

     <!--handle conflict-->
     <script src='js/jquery-3.3.1.min.js'></script>
<script>
var jq132 = jQuery.noConflict();
</script>
<script src='external/plugins/global/plugins.bundle526f.js?v=7.0.8'></script>
<script>
var jq142 = jQuery.noConflict();
</script>
<!--handle conflict-->
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
		<script src="external/plugins/global/plugins.bundle526f.js?v=7.0.8"></script>
		<script src="external/plugins/custom/prismjs/prismjs.bundle526f.js?v=7.0.8"></script>
		<script src="external/js/scripts.bundle526f.js?v=7.0.8"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="external/js/pages/widgets526f.js?v=7.0.8"></script>
		<script src="external/js/pages/custom/profile/profile526f.js?v=7.0.8"></script>
		<!--end::Page Scripts-->
       
        <!--script for state and LGA drop down list-->
        <script src="jsForStateDropList/lga.min.js"></script>
       <!--script for state and LGA drop down list-->


       <!--begin::Page Scripts(used by this page) For input-masks-->
		<script src="external/js/pages/crud/forms/widgets/input-mask526f.js?v=7.0.8"></script>


  </body>
</html>