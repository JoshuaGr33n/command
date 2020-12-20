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


$pageActiveTag4="site manager";
$currentPageTag="Update-school-details";



if($pageActiveTag4="site manager"){

  
  $studentsExpand="";
   $ExpandAdmin="";
   $ExpandResults="";
   $ExpandSiteManager="is-expanded";
   $ExpandPinManager="";


}








if($currentPageTag="Update-school-details"){
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
  $addnewStudentsCurrentPageTag="";
  $promoteStudentsCurrentPageTag="";
  $classPositionCurrentPageTag="";
  $updateSchoolDetailsCurrentPageTag="active";
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



<?php if($siteManagement!="YES")
{
    header("Location: index.php" );
exit;
}
?>










<?php

//output all from admin table
        $allAdminQuery = "SELECT * FROM administration";
        $allAdminResult = mysqli_query($con,  $allAdminQuery);
?>

















<?php

//output all from school_session table
        $allSessionQuery = "SELECT * FROM school_session";
        $allSessionResult = mysqli_query($con, $allSessionQuery);
	
?>




<?php
 


if(isset($_POST["submitbutton"])) {


  if($_POST["session"]!=""){
        
            
            

            

              mysqli_query($con, "UPDATE school_session set  Status=' ' WHERE Status ='Current'");

              mysqli_query($con, "UPDATE school_session set  Status='Current' WHERE sessionName ='" . $_POST["session"] . "'  ");

              mysqli_query($con, "UPDATE students set  session='" . $_POST["session"] . "' where Class not in ('GRADUATED STUDENT')");


            



                     }




                     if($_POST["term"]!=""){
        
            
            

            

                        mysqli_query($con, "UPDATE term set  Status=' ' WHERE Status ='Current'");
          
                        mysqli_query($con, "UPDATE term set  Status='Current' WHERE Term ='" . $_POST["term"] . "'  ");
          
                        mysqli_query($con, "UPDATE students set  Term='" . $_POST["term"] . "' where Class not in ('GRADUATED STUDENT')");
                          }
          
                      
          
          
          
                        










header("Location:update-school-details.php");
exit;


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
    <title>Update New School Year and Term</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
		

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Main CSS-->



<!--edit and delete form script-->

<script language="javascript" src="formjs/student-result-view.js" type="text/javascript"></script>
<!--edit and delete form script-->




<!--checkbox select all-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    
		<SCRIPT language="javascript">

    $(function () {

        // add multiple select / deselect functionality

        $("#selectall").click(function () {

            $('.name').attr('checked', this.checked);

        });

 

        // if all checkbox are selected, then check the select all checkbox

        // and viceversa

        $(".name").click(function () {

 

            if ($(".name").length == $(".name:checked").length) {

                $("#selectall").attr("checked", "checked");

            } else {

                $("#selectall").removeAttr("checked");

            }

 

        });

    });

</SCRIPT>
  <!--checkbox select all-->  


    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini">
    

          <?php 
// side bar and header
           include('include/nav_header.php');


        ?>


    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"> Update Schoool Term and Year</i>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <!--<li class="breadcrumb-item"></li>-->
          <li class="breadcrumb-item active"></li>
         <!-- <li class="breadcrumb-item active"><a href="uploadresult.php" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Upload Results</a></li>-->
        </ul>
      </div>
     

           <!--begin::Card-->
           <div class="card card-custom gutter-b example example-compact"  style="width:70%; margin-left:15%">
											<div class="card-header">
												<h3 class="card-title"> </h3>
												<div class="card-toolbar">
													<div class="example-tools justify-content-center">
                                                   
                                                    
													</div>
												</div>
											</div>

                      <form method="post">
                      <div class="form-group row" style=" margin-top:5%; margin-bottom:5%">
																		<label class="col-xl-3 col-lg-3 col-form-label" style="margin-left:2%;">Term</label>
																		<div class="col-lg-6 col-xl-6">
                                                                            <select class="form-control form-control-lg form-control-solid" name="term" value="">
                                                                            <option value="<?php echo $term;?>"><?php echo $term;?> Term</option>

                                                                            <option value="">---Select---</option>
                                                                            
                                                                            <option value="First">First Term</option>
                                                                            <option value="Second">Second Term</option>
                                                                            <option value="Third">Third Term</option>
                                                                            <span class="form-text text-muted" style="color:red;"></span>
                                                                            
                                                                            
                                                                            </select>
                                                                            
																		</div>

                                                                      
																	</div>

                                                                  
                                                            
                                                                    



                                                                    <div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label" style="margin-left:2%;">Session</label>
																		<div class="col-lg-6 col-xl-6">
                                                                        <select class="form-control form-control-lg form-control-solid" name="session">
                                                                        <option value="<?php echo $showSession;?>"><?php echo $showSession;?></option>
                                                                        <option value="">---Select---</option>
                                                            <?php  while ($allSessionRow = mysqli_fetch_array($allSessionResult))
                                                             {
                                                                //output all from school_session table
                                                                 $school_Session_id =$allSessionRow['sessionID']; 
                                             
                                                                $school_SessionName = $allSessionRow['sessionName'];
                                                                
                                                                ?>

                                                                <option value="<?php echo $school_SessionName;?>"><?php echo $school_SessionName ;?></option>
                                                                <?php }?>
                                                        </select>
                                                                            
																		</div>
																	</div>


                                                                    <div>
															
															<div>
																<input type="submit" name="submitbutton"    class="btn btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-left:27%; margin-bottom:5%;width:50%" value="Update"/>
																
															</div>
														</div>

                            </form>
                                               
                                               
                                                 

                                                

                                               
                                                
                                                 

                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                               </table>
												 
											</div>
										</div>
										<!--end::Card-->
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
    <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
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
  </body>
</html>


