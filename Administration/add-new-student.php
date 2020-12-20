<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}





//database connection
include('include/db.php');









?>
<?php
$setResultMarkCurrentPageTag="";

//If a link in the nav bar is active


$pageActiveTag="All Students";
$currentPageTag="add-new-students";



if($pageActiveTag="All Students"){

  
  $studentsExpand="is-expanded";
   $ExpandAdmin="";
   $ExpandResults="";
   $ExpandSiteManager="";
   $ExpandPinManager="";
  


}








if($currentPageTag="add-new-students"){
  $allPinCurrentPageTag="";
  $pinGeneratorCurrentPageTag="";
  $resultPageManagerCurrentPageTag="";
  $frontPageManagerCurrentPageTag="";
  $downloadResultClassCurrentPageTag="";
  $importResultClassCurrentPageTag="";
  $searchResultClassCurrentPageTag="";
  $allStudentResultClassCurrentPageTag="";
  $searchResultByClassCurrentPageTag="";
  $addNewAdminsCurrentPageTag="";
  $allAdminsCurrentPageTag="";
  $addnewStudentsCurrentPageTag="active";
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



}







?>
<?php 
// side bar and header
           include('include/privilege-restrictions.php');


?>



<?php 

if($studentManagement!="YES" && $addEditStudentM !="YES")
{
    header("Location: index.php" );
exit;
}
?>

















<?php

//output all from class table
        $allClassQuery = "SELECT * FROM classes where className not in ('Graduated Student')";
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


<?php 



//insert student info

$errFirstname="";
$errLastname="";
$errGender="";
$errDOB="";
$errAddress="";
$errState="";
$errLGA="";
$errClass="";
$errSession="";
$errTerm="";


$sucInsert="";
$errorInsert="";

$insertQuery="";
$errReg="";


 
 $_SESSION['insertFirstname'] = "";
    $_SESSION['insertMidname'] = "";
    $_SESSION['insertLastname'] = "";
    $_SESSION['insertGender'] = "";
    $_SESSION['insertDOB'] = "";
    $_SESSION['insertAddress'] = "";
    $_SESSION['insertState'] = "";
    $_SESSION['insertLGA'] = "";
    $_SESSION['insertClass'] = "";
    $_SESSION['insertSession'] = "";
    $_SESSION['insertTerm'] = "";
    $_SESSION['insertHouse'] = "";
    $_SESSION['regNumber'] = "";
    $_SESSION['insertPhone'] = "";
    $_SESSION['insertEmail'] = "";

 



if(isset($_POST['submitButton']))
{
    

    //$sql = "insert into privileges (AdminUsername, StudentManagement, AdminManagement, siteManagement, PinManagement) VALUES ('GOOD','GOOD','GOOD','GOOD','')";
    //if (mysqli_query($con, $sql)) {
      //  echo "File uploaded successfully";
   // }
 //else {
  //  echo "Failed to upload file.";
       //}
    
    $_SESSION['insertFirstname'] = $_POST['firstname'];
    $_SESSION['insertMidname'] = $_POST['midname'];
    $_SESSION['insertLastname'] = $_POST['lastname'];
    $_SESSION['insertGender'] = $_POST['gender'];
    $_SESSION['insertDOB'] = $_POST['dob'];
    $_SESSION['insertAddress'] = $_POST['address'];
    $_SESSION['insertState'] = $_POST['state'];
   // $_SESSION['insertLGA'] = $_POST['lga'];
    $_SESSION['insertClass'] = $_POST['class'];
    $_SESSION['insertSession'] = $_POST['session'];
    $_SESSION['insertTerm'] = $_POST['term'];
    $_SESSION['insertHouse'] = $_POST['sportshouse'];
    $_SESSION['regNumber'] = $_POST['regNumber'];
    $_SESSION['insertPhone'] = $_POST['phone'];
    $_SESSION['insertEmail'] = $_POST['email'];

    $insertFirstname = strtoupper($_SESSION['insertFirstname']);
    $insertMidname = strtoupper($_SESSION['insertMidname']);
    $insertLastname = strtoupper($_SESSION['insertLastname']);
    $RegNumUpperCase=strtoupper($_SESSION['regNumber']);


    


    





    //checking if any field is empty
    if($insertFirstname ==""){
             
         $errFirstname= "First Name must not be empty";


            }

  if($insertLastname ==""){

     $errLastname= "Last Name must not be empty";


              }

  if($_SESSION['insertGender'] ==""){

     $errGender= "Gender field must not be empty";
  }
  if($_SESSION['insertDOB'] ==""){

   $errDOB= "Date Of Birth field must not be empty";
  }

  if($_SESSION['insertAddress'] ==""){

     $errAddress= "Address field must not be empty";
  }

  if($_SESSION['insertState'] ==""){

     $errState= "Select Student's State";
  }

  

  if($_SESSION['insertClass'] ==""){

     $errClass= "You MUST select Student's current class";
  }

  if($_SESSION['insertSession'] ==""){

    $errSession= "You MUST select Student's current session";
  }

  if($_SESSION['insertTerm'] ==""){

   $errTerm= "You MUST select Student's current term";
  }

  if($RegNumUpperCase ==""){

     $errReg= "Input Student's Registration Number";



     
   }
   $ck_row=mysqli_query($con, "SELECT  RegNum FROM  students WHERE   RegNum = '".$_SESSION['regNumber']."'");

  if  (mysqli_num_rows($ck_row) >= 1){

    $errReg="Registration Number already belongs to another student";






  }
  

  


  if($insertFirstname !="" && $insertLastname !="" && $_SESSION['insertGender'] !=""&& $_SESSION['insertDOB'] !="" && $_SESSION['insertAddress'] !="" && $_SESSION['insertState'] !=""
     && $_SESSION['insertClass'] !="" && $_SESSION['insertSession'] !="" && $_SESSION['insertTerm'] !="" && $RegNumUpperCase !=""  && mysqli_num_rows($ck_row) < 1)
    {
    

    $insertQuery = "INSERT INTO students (FirstName, MiddleName, LastName, Class, session, Term, SportHouse,ProfilePic,Gender,DOB, RegNum, State_Of_Origin, LGA, Phone, Email, Address, status) VALUES
    ('".$insertFirstname."','".$insertMidname."', '".$insertLastname."','".$_SESSION['insertClass']."','".$_SESSION['insertSession']."','".$_SESSION['insertTerm']."','".$_SESSION['insertHouse']."',' ','".$_SESSION['insertGender']."','".$_SESSION['insertDOB']."','".$RegNumUpperCase."',
    '".$_SESSION['insertState']."','".$_POST['lga']."','".$_SESSION['insertPhone']."', '".$_SESSION['insertEmail']."','".$_SESSION['insertAddress']."','Activated'
    )";
    
      
    //$insertQuery = "Insert into students FirstName ='".$insertFirstname."', MiddleName='".$insertMidname."', LastName='".$insertLastname."', Class='".$insertClass."', session='".$insertSession."', Term='".$insertTerm."' , SportHouse='".$insertHouse."', Gender='".$insertGender."', DOB='".$insertDOB."', 
    //   State_Of_Origin ='".$insertState."', LGA='".$insertLGA."', Phone='".$insertPhone."', Email='".$insertEmail."', Address='".$insertAddress."'";
   }



    
   $insertResult ="";
    
   if($insertQuery)
   
   
   {
   
       $insertResult = mysqli_query($con, $insertQuery);
   }
   
   
   
   
   
   if($insertResult)
   {
   
    header("Location:add-new-student-suc.php" );
    exit;

   }
   
   
   
   
   
   else if (!$insertResult)
   
   
   {
   
       $errorInsert= "Error";
   }


    

  



                     

                     


    

}

?>




<?php
 


 



	

	
 $termQuery = "SELECT * FROM term where Status= 'Current'";
 $termResult = mysqli_query($con, $termQuery);
 
 $termRow = mysqli_fetch_array($termResult);
 
 $term = $termRow['Term'];







 $sessionQuery = "SELECT * FROM school_session where Status= 'Current'";
 $sessionResult = mysqli_query($con, $sessionQuery);
 
 $sessionRow = mysqli_fetch_array($sessionResult);
 
 $showSession = $sessionRow['sessionName'];
 
 
 
 
 
 
 
 
 
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
    <title>Add New Student</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  



  <!--begin::Page Custom Styles(used by this page)-->
  <link href="external/css/pages/wizard/wizard-1526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
   <!--end::Page Custom Styles-->

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

            <!--begin::Content-->
			<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
            
        





            

            <!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container" style="margin-top:10px;">
								<!--begin::Card-->
								<div class="card card-custom gutter-b">
									<!--begin::Body-->
									<div class="card-body p-0">
										<!--begin::Wizard-->
										<div class="wizard wizard-1" id="kt_contact_add" data-wizard-state="step-first" data-wizard-clickable="true">
											<div class="kt-grid__item">
												<!--begin::Wizard Nav-->
												<div class="wizard-nav border-bottom">
													<div class="wizard-steps p-8 p-lg-10">
                                                      <a class="btn btn-secondary" style="margin-left:80%" href="all-students.php"> Back</a>
													</div>
												</div>
												<!--end::Wizard Nav-->
											</div>
											<div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">
												<div class="col-xl-12 col-xxl-7">
													<!--begin::Form Wizard Form-->
													<form class="form" id="kt_form_1" method="post">
														<!--begin::Form Wizard Step 1-->
														<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
															<h3 class="mb-10 font-weight-bold text-dark">Personal Details:<span class="text-danger"> <?php echo $errorInsert?></span></h3>
															<div class="row">
																<div class="col-xl-12">
																
																	<div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label">First Name</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-lg form-control-solid" name="firstname" type="text" value="<?php echo $_SESSION['insertFirstname'];?>" />
																		</div>
                                                                    </div>




                                                                    




                                                                 
                                  
                                    
                                    
                                      <div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label">Middle Name</label>
																		<div class="col-lg-9 col-xl-9">
                                        <input class="form-control form-control-lg form-control-solid" name="midname" type="text" value="<?php echo $_SESSION['insertMidname'];?>" />
                                         <span class="form-text text-muted">This Field can be left blank if student doesnt have a middle name</span>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-lg form-control-solid" name="lastname" type="text" value="<?php echo $_SESSION['insertLastname'];?>" />
																		</div>
                                                                    </div>
                                                                    
                                    <div class="form-group row align-items-center">
																		<label class="col-xl-3 col-lg-3 col-form-label">Gender</label>
																		<div class="col-lg-9 col-xl-6">
																			<div class="checkbox-inline">
																				<label class="checkbox">
																				<input name="gender" type="radio"  value="Male"/>
																				<span></span>Male</label>
																				<label class="checkbox">
																				<input name="gender" type="radio" value="Female" />
																				<span></span>Female</label>
																			
																			</div>
																		</div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label">Date of Birth</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-lg form-control-solid" name="dob" type="text" value="<?php echo $_SESSION['insertDOB'];?>" id="kt_inputmask_2"/>
																			<!--<span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>-->
																		</div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label">Address</label>
																		<div class="col-lg-9 col-xl-9">
																			<textarea class="form-control form-control-lg form-control-solid" name="address" type="text"><?php echo $_SESSION['insertAddress'];?></textarea>
																			
																		</div>
                                                                    </div>

                                                                    
                                                                    
            <!--dyamic drop down begins-->
            <div class="row">
			 <div class="col-xl-6">

            <div class="form-group">
                <label>State of Origin</label>
                
                <select
                  onchange="toggleLGA(this);"
                  name="state"
                  id="state"
                  class="form-control form-control-lg form-control-solid" 
                  
                >
                  <option value="<?php echo $_SESSION['insertState'];?>"><?php echo $_SESSION['insertState'];?> </option>
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
                
                <span class="form-text" style="color:red;"></span>
            </div>
            </div>
            <div class="col-xl-6">
              <div class="form-group">
                <label>LGA of Origin</label>
                
                <select
                  name="lga"
                  id="lga"
                  class="form-control form-control-lg form-control-solid select-lga"
                  required
                  
                >
                
                </select>
                
                <span class="form-text" style="color:red;"></span>
               
               </div>
           </div>   
        </div>  
            <!--dyamic drop down ends-->

            <div class="row">
																<div class="col-xl-12">
																	<div class="form-group row">
																		<div class="col-lg-9 col-xl-6">
																			<h3 class="mb-10 font-weight-bold text-dark">School Details</h3>
																		</div>
                    </div>

                    
                                                                    
                                 <div class="row">
																<div class="col-xl-6">
																	<div class="form-group">
																		<label>Class</label>
																		<select class="form-control form-control-lg form-control-solid" name="class" placeholder="Class">
                                                                          <option value="<?php echo $_SESSION['insertClass'];?>"><?php echo $_SESSION['insertClass'];?></option>

                                                            <?php  while ($allClassRow = mysqli_fetch_array($allClassResult))
                                                             {
                                                                //output all from classes table
                                                                 $class_id =$allClassRow['classID']; 
                                             
                                                                $ClassName = $allClassRow['className'];
                                                                
                                                                ?>

                                                                <option value="<?php echo $ClassName ;?>"><?php echo $ClassName ;?></option>
                                                                <?php }?>  
                                                                        <select>
																		<span class="form-text text-muted">Please select student's current class.</span>
																	</div>
																</div>
																<div class="col-xl-6">
																	<div class="form-group">
																		<label>Session</label>
																		<select class="form-control form-control-lg form-control-solid" name="session" placeholder="School Year">
                                                                            <option value="<?php echo $showSession;?>"><?php echo $showSession;?></option>

                                                            <?php  while ($allSessionRow = mysqli_fetch_array($allSessionResult))
                                                             {
                                                                //output all from school_session table
                                                                 $school_Session_id =$allSessionRow['sessionID']; 
                                             
                                                                $school_SessionName = $allSessionRow['sessionName'];
                                                                
                                                                ?>

                                                                <option value="<?php echo $school_SessionName;?>"><?php echo $school_SessionName ;?></option>
                                                                <?php }?>
                                                                            <select>
																		<span class="form-text text-muted">Current school year.</span>
																	</div>
																</div>
                                                            </div>



                                     

																	
                                        
                                      
                           








                                                            
                                                            <div class="row">
																<div class="col-xl-6">
																	<div class="form-group">
																		<label>Term</label>
																		<select class="form-control form-control-lg form-control-solid" name="term" placeholder="Term" value="" >
                                                                            <option value="<?php echo $term;?>"><?php echo $term;?> Term</option>
                                                                            <option value="First">First Term</option>
                                                                            <option Value="Second">Second Term</option>
                                                                            <option value="Third">Third Term</option>
                                                                         </select>
																		<span class="form-text text-muted">Current Term</span>
																	</div>
																</div>
																<div class="col-xl-6">
																	<div class="form-group">
																		<label>Sports House</label>
																		<select class="form-control form-control-lg form-control-solid" name="sportshouse" placeholder="Sports House">
                                                                            <option value="<?php echo $_SESSION['insertHouse'];?>"><?php echo  $_SESSION['insertHouse'];?></option>

                                                            <?php  while ($allSportHouseRow = mysqli_fetch_array($allSportHouseResult))
                                                             {
                                                                //output all from school_session table
                                                                 $house_id =$allSportHouseRow['houseID']; 
                                             
                                                                $houseName = $allSportHouseRow['houseName'];
                                                                
                                                                ?>

                                                                <option value="<?php echo $houseName;?>"><?php echo $houseName;?></option>
                                                                <?php }?>

                                                                        
                                                                            <select>
																		<span class="form-text text-muted">Assign a sport house for the student. This field can be left blank if this cant be inputed at the moment</span>
																	</div>
																</div>
                              </div>
                              
                             
																
                                </div>
                                
                              </div>
                              

                              
																<div class="col-xl-12">
																	<div class="form-group">
																		<label>Registration Number</label>
																		<input type="text" class="form-control form-control-lg form-control-solid" name="regNumber" placeholder="Registration Number" value="<?php echo  $_SESSION['regNumber'] ;?>" />
                                                                           
																		<span class="form-text text-danger" ><?php echo $errReg;?></span>
																	</div>
																</div>
															
                                
															
                                      
                              

                                      
                              


                                                            <h3 class="mb-10 font-weight-bold text-dark">Contact Details</h3>
															
																	<div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label">Contact Phone</label>
																		<div class="col-lg-9 col-xl-9">
																			<div class="input-group input-group-lg input-group-solid">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="la la-phone"></i>
																					</span>
																				</div>
																				<input type="text" class="form-control form-control-lg form-control-solid" name="phone" value="<?php echo  $_SESSION['insertPhone'] ;?>" placeholder="Phone" />
																			</div>
																			<span class="form-text text-muted">This is Optional. Proceed if this information is unavailable at the moment</span>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
																		<div class="col-lg-9 col-xl-9">
																			<div class="input-group input-group-lg input-group-solid">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="la la-at"></i>
																					</span>
																				</div>
                                                                                <input type="text" class="form-control form-control-lg form-control-solid" name="email" value="<?php echo  $_SESSION['insertEmail'] ;?>" placeholder="Email" />
                            
                                                                            </div>
                                                                            <span class="form-text text-muted">This is Optional. Proceed if this information is unavailable at the moment</span>
																		</div>
																	</div>
															



																
																</div>
															</div>
														</div>
														<!--end::Form Wizard Step 1-->
														
														<!--begin::Wizard Actions-->
														<div>
															
															<div>
																<input type="submit" name="submitButton" class="btn btn-success font-weight-bold text-uppercase px-9 py-4" style="margin-left:25%; width:50%" value="Submit"/>
																
															</div>
														</div>
														<!--end::Wizard Actions-->
													</form>
													<!--end::Form Wizard Form-->
												</div>
											</div>
										</div>
										<!--end::Wizard-->
									</div>
									<!--end::Body-->
								</div>
								<!--end::Card-->
							</div>
							<!--end::Container-->
						</div>
                        <!--end::Entry-->
                        
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

        <!--begin::Page Scripts(used by this page)-->
		<!--<script src="external/js/pages/custom/contacts/add-contact526f.js"></script>-->
        <!--end::Page Scripts-->
        

        <!--begin::Page Scripts(used by this page) for all form validation-->
		<script src="external/js/pages/crud/forms/validation/form-controls526f.js?v=7.0.8"></script>
        <!--end::Page Scripts-->
        
        <!--begin::Page Scripts(used by this page) For input-masks(Date of Birth field)-->
        <script src="external/js/pages/crud/forms/widgets/input-mask526f.js?v=7.0.8"></script>
        <!--begin::Page Scripts(used by this page) For input-masks-->
        
        <!--script for state and LGA drop down list-->
        <script src="jsForStateDropList/lga.min.js"></script>
       <!--script for state and LGA drop down list-->




  </body>
</html>


