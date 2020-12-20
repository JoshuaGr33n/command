<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}

if( $_SESSION['regSubject'] =="")
{
header("Location: download-result.php" );
exit;
}


//database connection
include('include/db.php');







?>
<?php
$setResultMarkCurrentPageTag="";
//If a link in the nav bar is active


$pageActiveTag3="Results";
$currentPageTag="download result";


if($pageActiveTag3="Results"){

    $studentsExpand="";
    $ExpandAdmin="";
    $ExpandResults="is-expanded";
    $ExpandSiteManager="";
    $ExpandPinManager="";

    


}

if($currentPageTag="download result"){
  $allPinCurrentPageTag="";
  $pinGeneratorCurrentPageTag="";
  $resultPageManagerCurrentPageTag="";
  $frontPageManagerCurrentPageTag="";
  $downloadResultClassCurrentPageTag="active";
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



}






?>
<?php 

include('include/privilege-restrictions.php');


?>



<?php 

if($resultManagement!="YES")
{
  header("Location: index.php" );
  exit;
}
?>


<?php

$current_class = substr($_SESSION['regClass'], 0, 5);





if($current_class =="SSS 1"){

  $School="Senior Secondary School 1";
      
      
      }
else{
    
    $current_class = substr($_SESSION['regClass'], 0, 3);
    
    if($current_class =="JSS")
    {
     $School="Junior Secondary School";
    
    }
    
    else if ($current_class =="SSS"){
    
    $School="Senior Secondary School";
    
    }

    else{
      header("Location: download-result.php");
      exit;
    }
  }   
?>







  <?php



$current_term_query= $con->prepare("SELECT Term FROM term WHERE Status= 'Current' ");
$current_term_query->execute();                          
$current_term_query->Store_result();                      
$current_term_query->bind_result($current_term);  
$current_term_query->fetch();
$current_term_query->close();




   

$current_session_query= $con->prepare("SELECT sessionName FROM school_session WHERE Status= 'Current' ");
$current_session_query->execute();                          
$current_session_query->Store_result();                      
$current_session_query->bind_result($current_session);  
$current_session_query->fetch();
$current_session_query->close();






?>
<?php
//school for ONLY result marks
$results_marks_class = substr($_SESSION['regClass'], 0, 3);

if($results_marks_class=="JSS")
   {
    $results_marks_School="Junior Secondary School";

   }

else if ($results_marks_class=="SSS"){

  $results_marks_School="Senior Secondary School";

      }

 else{
  $results_marks_School = "";
  }
  ?>
  <?php

$results_marks_School_query = $con->prepare("SELECT  CA1, CA2, CA3, Exam FROM result_marks  WHERE School = '$results_marks_School' AND session ='$current_session' AND term='$current_term'");
//$query->bind_param("i", $School); // Bind search values to parameters ("iiii" : one "i" for each variable, set's data type to "int")
$results_marks_School_query->execute();                            // Run the query
$results_marks_School_query->Store_result();                       // Store the result set
$results_marks_School_query->bind_result($ca1_score, $ca2_score, $ca3_score, $exam_score);  
$results_marks_School_query->fetch();
$results_marks_School_query->close();
  




if($exam_score == 0){
  header("Location: download-result.php");
  exit;

 }
  ?>
	


  <?php


if(isset($_POST["save"]))  
{  

 $uploaded_by = $_POST["uploadedby"];
 $sql="UPDATE results SET Teacher = '$uploaded_by' WHERE school_session='$current_session' AND Term='$current_term' AND class='$_SESSION[regClass]' AND  subject ='$_SESSION[regSubject]'";
 $updateQuery = $con->prepare($sql); 
  
  
 


   
  $updateQuery->execute();   
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
    <title>Download Result Template</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
       
		



		





    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
   
 <!-- Main CSS-->

<!--responsive-->
 <style type="text/css">
    #sampleTable2 {
  border-top: 2px solid #dee2e6;
}


@media only screen and (max-width: 800px) {
  .off {display: none;}
  .teacher_form{width:50%; margin-left:150px}
  .teacher_button{width:100%; padding-left:1500%}
  .mobile-header{font-size:20px}
  
}
 
@media only screen and (max-width: 640px) {
	
	 .off {display: none;}
   .teacher_form{width:50%; margin-left:150px}
   .teacher_button{width:100%; padding-left:1500%}
   .mobile-header{font-size:20px}
  
}

.result_id_off{display: none;}
    </style>
<!--responsive-->




<!-- inline-table-edit-->
<link rel="stylesheet" href="inline_edit_table/bootstrap.min.css" />  
<!-- inline-table-edit-->
 








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
          <h1><i class="fa fa-th-list"></i> <span class="mobile-header"><?php echo $current_session;?>-<?php echo $_SESSION['regClass'];?>-<?php echo $current_term;?> Term-<?php echo $_SESSION['regSubject'];?></span> </h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
         

         
          <li>
          <form method="post" action="exports/download-result-export.php">
          <button name="export" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Export to Excel</button>
          </form>
          </li>
          <li> <a href="download-result.php" class="btn btn-sm btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Back</a></li>
        </ul>
      </div>


      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">




              <?php 
              $queryTeacher= $con->prepare("SELECT Teacher FROM `results` WHERE school_session='$current_session' AND Term='$current_term' AND class='$_SESSION[regClass]' AND  subject ='$_SESSION[regSubject]'");
              // $queryTeacher->bind_param("iiii", $sess, $term, $class, $sub_id);
              $queryTeacher->execute();                           
              $queryTeacher->Store_result();                      
              $queryTeacher->bind_result($teacher);  
              $queryTeacher->fetch();
              $queryTeacher->close();
              ?>


              <?php
              $query= $con->prepare("SELECT First_Name, Last_Name FROM administration");

              $query->execute();                           
               $query->Store_result();                      
               $query->bind_result($first_name, $last_name);  
               ?>
               <form name="frmUser" method="post" action="">
              <div class="row">
              <div class="col-xl-6">
              <div class="form-group row">
								<label class="col-xl-3 col-lg-3 col-form-label"></label>
										<div class="col-lg-9 col-xl-9 teacher_form">
                       <select class="form-control form-control-lg form-control-solid" name="uploadedby">
                            <option value="<?php echo $teacher; ?>"><?php echo $teacher; ?> </option>
                            <?php   while ($query->fetch())
                                        {
                                          ?>
                            <option value="<?php echo  $first_name;?> <?php echo  $last_name;?>"><?php echo  $first_name;?> <?php echo  $last_name;?></option>
                               <?php }?>
                               </select>
                               </div>
                               </div>
                                </div>
                                  <div class="row">
                                 <div class="col-xl-6">
                                   <div class="form-group row teacher_button">
                                             <input type="submit" name="save" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-" style="margin-left:20%"  value="Save"/>
                                                                                      
                                                  </div>
                                               </div>
                                             </div>
                                                                         
                                          </div>
                                        </form>
                                        <form method="post">
                                        <input type="submit"  class="btn btn-sm btn-warning font-weight-bold py-2 px-3 px-xxl-5 my-" style=" margin-left:30%; width:300px"  value="Apply"/>
                                        </form>

                                                                           
                                                                     
                                          
                                                                   
                                                     
                                                
                                          
                     
                           










              
                      
                   
                                                                            
                                                                            
                   

                  

                   


                  


                   

                   
                   


                   
                  

                  

                <table class="table table-hover table-bordered table-striped" id="sampleTable2">
                
                  <thead>
                    <tr>
                      
                      <th class="off">Student Reg Number</th>
                      <th>Name</th>
                     
                      <th class="off">Subject</th>
                      <th class="off">Subject Code</th>
                     
                     


                      <th class="off result_id_off">Result ID</th>
                      <th>CA 1</th>
                      <th>CA 2</th>
                      <th>CA 3</th>
                      <th>Exam</th>
                      <th class="off">Total</th>
                      <th class="off">Average</th>
                      <th class="off">Grade</th>
                      <th class="off">Remark</th>
                      <th>Teacher</th>
                      <th class="off">Publish</th>
                     

                      
                    </tr>
                  </thead>
                  <tbody>

                  <?php

$list_sub = $con->prepare("SELECT StudentID, StudentReg, student_name, subjectID, subjectName, current_class FROM registered_subjects  WHERE  School='$School' AND subjectName ='$_SESSION[regSubject]' AND current_class ='$_SESSION[regClass]'");


$list_sub->execute();                           
$list_sub->Store_result();                      
$list_sub->bind_result($reg_subjects_studentID, $reg_subjects_studentReg, $reg_subjects_student_name, $reg_subjects_subjectID, $reg_subjects_subjectName, $reg_subjects_current_class);  
while($list_sub->fetch()){

  

      $results = $con->prepare("SELECT Sno, StudentID, class,CA1,CA2,CA3,Exam,Total,Average,Grade,Remark,Teacher,Publish
             FROM `results` WHERE school_session='$current_session' 
             AND Term='$current_term' AND StudentID='$reg_subjects_studentID' 
             AND class='$reg_subjects_current_class' 
             AND  subjectID='$reg_subjects_subjectID' 
             GROUP BY StudentID
            
             Order By subjectID ASC ");
      $results->execute();                           
      $results->Store_result();                      
      $results->bind_result($results_sno, $results_student_id, $results_class,$results_ca1, $results_ca2, $results_ca3, $results_exam, $results_total,$results_average,$results_grade,$results_remark,$results_teacher, $results_publish);
      $results->fetch();
      $results->close();


                    ?>
                    <?php
                    
                    if($ca3_score == 0){

                      $results_ca3=0;
                    } 
                    if($ca2_score == 0){

                      $results_ca2=0;
                    } 
                    if($ca1_score == 0){

                      $results_ca1=0;
                    } 
                    ?>
                   



                   
                    <tr>
                   
                      
                      <td class="off"><?php echo $reg_subjects_studentReg;?></td>
                      <td><?php echo $reg_subjects_student_name;?></td>
                     
                      <td class="off"><?php echo $reg_subjects_subjectName;?></td>
                      <td class="off"><?php echo $reg_subjects_subjectID;?></td>
                     

                     <td class="off  result_id_off"><?php if($reg_subjects_studentID==$results_student_id){ echo  $results_sno;}?></td>
                      <td><?php if($reg_subjects_studentID==$results_student_id){ echo $results_ca1;}?></td>
                      <td><?php if($reg_subjects_studentID==$results_student_id){ echo $results_ca2;}?></td>
                      <td><?php if($reg_subjects_studentID==$results_student_id){ echo $results_ca3;}?></td>
                      <td><?php if($reg_subjects_studentID==$results_student_id){ echo $results_exam;}?></td>
                      <td class="off"><?php if($reg_subjects_studentID==$results_student_id){echo $results_total;}?></td>
                      <td class="off"><?php if($reg_subjects_studentID==$results_student_id){ echo $results_average;}?></td>
                      <td class="off"><?php if($reg_subjects_studentID==$results_student_id){echo $results_grade;}?></td>
                      <td class="off"><?php if($reg_subjects_studentID==$results_student_id){echo $results_remark;}?></td>
                      <td><?php if($reg_subjects_studentID==$results_student_id){echo $results_teacher;}?></td>
                      <td class="off"><?php if($reg_subjects_studentID==$results_student_id){echo $results_publish;}?></td>
                      
                     
                      
                    </tr>
                   <?php }?>

                   

                    
                    
                  </tbody>
                   
                </table>
              </div>
            </div>
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

    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="external/plugins/global/plugins.bundle526f.js?v=7.0.8"></script>
       
       <script src="external/plugins/custom/prismjs/prismjs.bundle526f.js?v=7.0.8"></script>
       <script src="external/js/scripts.bundle526f.js?v=7.0.8"></script>
       
       <!--end::Global Theme Bundle-->
       



<!--begin::Page Vendors(used by this page)-->
<script src="external/plugins/custom/datatables/datatables.bundle526f.js?v=7.0.8"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="external/js/pages/crud/datatables/extensions/buttons526f.js?v=7.0.8"></script>
<!--end::Page Scripts-->




<!-- inline-table-edit-->
<script src="inline_edit_table/jquery.min.js"></script>
    
		

    
<script src="inline_edit_table/jquery.tabledit.min.js"></script>
<!-- inline-table-edit-->
<script>  
$(document).ready(function(){  
     $('#sampleTable2').Tabledit({
      url:'inline_edit_table/action.php',
      columns:{
       identifier:[4, "id"],
       editable:[[0, "reg"],[5, 'ca1'], [6, 'ca2'], [7, 'ca3'], [8, 'exam']]
      },
      restoreButton:false,
      onSuccess:function(data, textStatus, jqXHR)
      {
       if(data.action == 'delete')
       {
        $('#'+data.id).remove();
       }
      }
     });
 
});  
 </script>
  </body>
</html>


