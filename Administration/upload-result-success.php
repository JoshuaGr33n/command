<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}


include('include/db.php');






?>
<?php
$setResultMarkCurrentPageTag="";
//If a link in the nav bar is active


$pageActiveTag3="Results";
$currentPageTag="import result";


if($pageActiveTag3="Results"){

  $studentsExpand="";
  $ExpandAdmin="";
  $ExpandResults="is-expanded";
  $ExpandSiteManager="";
  $ExpandPinManager="";

    


}

if($currentPageTag="import result"){
  $allPinCurrentPageTag="";
  $pinGeneratorCurrentPageTag="";
  $resultPageManagerCurrentPageTag="";
  $frontPageManagerCurrentPageTag="";
  $downloadResultClassCurrentPageTag="";
  $importResultClassCurrentPageTag="active";
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

include('include/grading.php');
?>



<?php 

if($resultManagement!="YES")
{
  header("Location: index.php" );
  exit;
}
?>





<?php

if(empty($_FILES['import']['name'])){

  header("Location: uploadresult.php" );
  exit;
}

$err="";
$err2="";
$success="";
$wrongformat="";
$updateAlert="";
if (isset($_POST['import_result'])) {
    
    $publish = $_POST['publish'];
    $uploaded_by = $_POST['uploadedby'];
    //$subjectID = $_POST['subjectID'];


    


    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if(!empty($_FILES['import']['name']) && in_array($_FILES['import']['type'],$file_mimes)){
        if(is_uploaded_file($_FILES['import']['tmp_name'])){   
            $csv_file = fopen($_FILES['import']['tmp_name'], 'r'); 
            $rows=1;

            



            while(($getData = fgetcsv($csv_file)) !== FALSE){

              
              
               if (empty($getData[0]))
               {
           
           
                 header("Location: uploadresult.php");
                             exit;
           
           
           
               }
               if (empty($getData[1]))
               {
           
           
                 header("Location: uploadresult.php");
                             exit;
           
           
           
               }

              


              if($rows++ !=1){

                $get_students=mysqli_query($con, "SELECT * FROM `students`  WHERE RegNum='$getData[0]' ");
                $row_student=mysqli_fetch_array($get_students);

                $RegNumUpperCase=strtoupper($getData[0]);
               

                $column_class = substr($getData[2], 0, 3);
               
                
                
                
                if($column_class=="JSS")
                {
                 $School="Junior Secondary School";
                
                
                }
                
                else if ($column_class=="SSS"){
                
                $School="Senior Secondary School";
                
                
                }
                
                else{
                  header("Location: uploadresult.php");
                  exit;
                }


                  $query= $con->prepare("SELECT School, CA1, CA2, CA3, Exam FROM result_marks  WHERE School = '$School' AND session ='$getData[5]' AND term='$getData[6]'");
                   //$query->bind_param("i", $School); // Bind search values to parameters ("iiii" : one "i" for each variable, set's data type to "int")
                   $query->execute();                            // Run the query
                    $query->Store_result();                       // Store the result set
                    $query->bind_result($School, $ca1_score, $ca2_score, $ca3_score, $exam_score);  
                    $query->fetch();
                    $query->close();


                    


                 









                $ck_row=mysqli_query($con, "SELECT StudentID, StudentReg, subject, subjectID, school_session, class, Term FROM  `results` WHERE StudentID='$row_student[student_id]' AND StudentReg='$RegNumUpperCase'AND subject='$getData[3]' AND subjectID='$getData[4]' AND school_session='$getData[5]' AND Term='$getData[6]' AND class='$getData[2]' ");



    if(mysqli_num_rows($ck_row) < 1){

    if ($getData[7]=="")
    {


      $getData[7]=0;



    }

    if ($getData[8]=="")
    {


      $getData[8]=0;



    }

    if ($getData[9]=="")
    {


      $getData[9]=0;



    }

    if ($getData[10]=="")
    {


      $getData[10]=0;



    }



    if (! is_numeric($getData[4]))
    {


      header("Location: uploadresult.php");
                  exit;



    }


    if($ca1_score == 0){

      $getData[7]=0;
    } 
    if($ca2_score == 0){

      $getData[8]=0;
    } 
    if($ca3_score == 0){

      $getData[9]=0;
    } 



   






                  $total = ($getData[7]+$getData[8]+$getData[9]+$getData[10]);

                  if($ca1_score == 0 && $ca2_score == 0 && $ca3_score == 0 && $exam_score > 0 ){

                  $average= $total/1;
                  }
                  
                 else if($ca1_score == 0 && $ca2_score == 0 && $ca3_score > 0 && $exam_score > 0 ){

                    $average= $total/2;
                 }
                 else if($ca1_score == 0 && $ca3_score == 0 && $ca2_score > 0 && $exam_score > 0 ){

                  $average= $total/2;
                 }
                 else if($ca2_score == 0 && $ca3_score == 0 && $ca1_score > 0 && $exam_score > 0 ){

                  $average= $total/2;
                 }
                 else if($ca1_score == 0  && $ca2_score > 0 && $ca3_score > 0 && $exam_score > 0 ){

                  $average= $total/3;
                 }
                 else if($ca2_score == 0 && $ca1_score > 0 && $ca3_score > 0 && $exam_score > 0 ){

                  $average= $total/3;
                 }
                 else if($ca3_score == 0 && $ca2_score > 0 && $ca1_score > 0 && $exam_score > 0 ){

                  $average= $total/3;
                 
                 }
                 else if($ca1_score > 0 && $ca2_score > 0 && $ca3_score > 0 && $exam_score > 0 ){
                  $average= $total/4;
                 }
                 else if($exam_score == 0){
                  header("Location: uploadresult.php");
                  exit;

                 }
                 

                   



                  $average=number_format($average, 2);



                 
                 
                
                
                
                  if($School=="Junior Secondary School")
                  {
                  
                   $sch_grade=get_grade_jss($total);
                  
                  }
                  
                  else if ($School=="Senior Secondary School"){
                  
                 
                  $sch_grade = get_grade_sss($total);
                  
                  }
                  
                  



                

                  
                  if($getData[7]<=$ca1_score && $getData[8]<=$ca2_score && $getData[9]<=$ca3_score && $getData[10]<=$exam_score){

                  mysqli_query($con, "INSERT INTO `results`(`Sno`, `StudentID`, `StudentReg`, `subject`, `subjectID`, `school_session`, `Term`, `class`, `CA1`, `CA2`, `CA3`, `Exam`, `Total`, `Average`, `Grade`, `Remark`, `Teacher`, `Publish`, `Promotion_Status` ) VALUES (NULL, '$row_student[student_id]','$RegNumUpperCase','$getData[3]','$getData[4]','$getData[5]','$getData[6]','$getData[2]','$getData[7]','$getData[8]','$getData[9]','$getData[10]','$total','$average','$sch_grade[grade]','$sch_grade[remark]','$uploaded_by','$publish',' ') ");
                  $success= ' <button  class="btn btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1">Result Imported Successfully!!</button>';

                  $uploadsuccessResult = mysqli_query($con, "SELECT * FROM  `results` WHERE subject='$getData[3]' AND subjectID='$getData[4]' AND school_session='$getData[5]' AND Term='$getData[6]' AND class='$getData[2]'");
                 
                }

                else  {

                  $err2=' <button  class="btn btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1"> Some results were not imported because they exceed the requirements for '.$School.': CA1 must not be greater than '.$ca1_score.' marks, CA2 must not be greater than '.$ca2_score.' marks, CA 3 must not be greater than '.$ca3_score.' marks and Exam score must not be greater than '.$exam_score.' marks</button>';
                  $uploadsuccessResult = mysqli_query($con, "SELECT * FROM  `results` WHERE subject='$getData[3]' AND subjectID='$getData[4]' AND school_session='$getData[5]' AND Term='$getData[6]' AND class='$getData[2]'");
                   }




              }







       //if row already exist, update the row. start here

                
            else{




    if ($getData[7]=="")
    {


      $getData[7]=0;



    }

    if ($getData[8]=="")
    {


      $getData[8]=0;



    }

    if ($getData[9]=="")
    {


      $getData[9]=0;



    }

    if ($getData[10]=="")
    {


      $getData[10]=0;



    }



    if (! is_numeric($getData[4]))
    {


      header("Location: uploadresult.php");
                  exit;



    }

if($ca1_score == 0){

      $getData[7]=0;
    } 
    if($ca2_score == 0){

      $getData[8]=0;
    } 
    if($ca3_score == 0){

      $getData[9]=0;
    } 





                    $total = ($getData[7]+$getData[8]+$getData[9]+$getData[10]);




                    if($ca1_score == 0 && $ca2_score == 0 && $ca3_score == 0 && $exam_score > 0 ){

                      $average= $total/1;
                      }
                      
                     else if($ca1_score == 0 && $ca2_score == 0 && $ca3_score > 0 && $exam_score > 0 ){
    
                        $average= $total/2;
                     }
                     else if($ca1_score == 0 && $ca3_score == 0 && $ca2_score > 0 && $exam_score > 0 ){
    
                      $average= $total/2;
                     }
                     else if($ca2_score == 0 && $ca3_score == 0 && $ca1_score > 0 && $exam_score > 0 ){
    
                      $average= $total/2;
                     }
                     else if($ca1_score == 0  && $ca2_score > 0 && $ca3_score > 0 && $exam_score > 0 ){
    
                      $average= $total/3;
                     }
                     else if($ca2_score == 0 && $ca1_score > 0 && $ca3_score > 0 && $exam_score > 0 ){
    
                      $average= $total/3;
                     }
                     else if($ca3_score == 0 && $ca2_score > 0 && $ca1_score > 0 && $exam_score > 0 ){
    
                      $average= $total/3;
                     }
                     else if($ca1_score > 0 && $ca2_score > 0 && $ca3_score > 0 && $exam_score > 0 ){
                      $average= $total/4;
                     }
                     else if($exam_score == 0){
                      header("Location: uploadresult.php");
                      exit;
    
                     }
                     
                    


                    $average=number_format($average, 2);



                    if($School=="Junior Secondary School")
                    {
                    
                     $sch_grade=get_grade_jss($total);
                    
                    }
                    
                    else if ($School=="Senior Secondary School"){
                    
                   
                    $sch_grade=get_grade_sss($total);
                    
                    }



                    if($getData[7]<=$ca1_score && $getData[8]<=$ca2_score && $getData[9]<=$ca3_score && $getData[10]<=$exam_score){

                  mysqli_query($con, "Update results set CA1 = '$getData[7]', CA2 = '$getData[8]', CA3 = '$getData[9]', Exam = '$getData[10]', Total = '$total', Average = '$average', Grade = '$sch_grade[grade]',Remark = '$sch_grade[remark]', Teacher = '$uploaded_by', Publish = '$publish'
                                      WHERE StudentID='$row_student[student_id]' AND StudentReg='$RegNumUpperCase' AND subject='$getData[3]' AND subjectID='$getData[4]' AND school_session='$getData[5]' AND Term='$getData[6]' AND class='$getData[2]'"); 


                  $updateAlert=' <button  class="btn btn-warning font-weight-bold py-2 px-3 px-xxl-5 my-1"> Some scores were updated</button>';
                  $uploadsuccessResult = mysqli_query($con, "SELECT * FROM  `results` WHERE subject='$getData[3]' AND subjectID='$getData[4]' AND school_session='$getData[5]' AND Term='$getData[6]' AND class='$getData[2]'");
                    }

                    else  {

                      $err2=' <button  class="btn btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1"> Some results were not imported because they exceed the requirements for '.$School.': CA1 must not be greater than '.$ca1_score.' marks, CA2 must not be greater than '.$ca2_score.' marks, CA 3 must not be greater than '.$ca3_score.' marks and Exam score must not be greater than '.$exam_score.' marks</button>';
                      $uploadsuccessResult = mysqli_query($con, "SELECT * FROM  `results` WHERE subject='$getData[3]' AND subjectID='$getData[4]' AND school_session='$getData[5]' AND Term='$getData[6]' AND class='$getData[2]'");
                       }




                  
                }

                 //if row already exist, update the row. Ends here





              }
            }
            fclose($csv_file);
          
        }
    }
    else{
      
      header('Location: uploadresult.php?wrongformat=<button  class="btn btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1">Wrong Format, Upload as CSV</button>');
      exit;
    }
 
       
            

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
    <title>Import Results</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
       <!--begin::Global Theme Styles(used by all pages)-->
       <link href="external/plugins/global/plugins.bundle526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
		
        <link href="external/css/style.bundle526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
        
		<!--end::Global Theme Styles-->



    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Main CSS-->


    
		
    


    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    div#response.display-block {
	display: block;
}
</style>



<!--edit and delete form script-->

<script language="javascript" src="formjs/upload-result-success.js" type="text/javascript"></script>
<!--edit and delete form script-->


<!--check all boxes script-->

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
  </head>
  <body class="app sidebar-mini">
    

          <?php 
// side bar and header
           include('include/nav_header.php');


        ?>


    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Import Results </h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <!--<li class="breadcrumb-item"></li>-->
          <li><a href="uploadresult.php" class="btn btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Back</a></li>

         
          <li><a href="search-results.php" class="btn btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Edit</a></li>
         
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">


             
               


                <?php echo  $updateAlert;?>
                   <?php echo  $success;?>
                  
                   <?php echo  $err2;?>






                   <table class="table table-bordered  table-striped" id="sampleTable">
                
                <thead>
                  <tr>
                  <!--<th><input type="checkbox" id="selectall"/> Select all</th>-->
                    <th>Student ID</th>
                    <th>Registration Number</th>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Subject ID</th>
                    <th>Session</th>
                    <th>Term</th>
                    <th>Class</th>
                    <th>CA 1</th>
                    <th>CA 2</th>
                    <th>CA 3</th>
                    <th>Exam</th>
                    <th>Total</th>
                    <th>Average</th>
                    <th>Grade</th>
                    <th>Remark</th>
                    <th>Subject Position</th>
                    <th>Teacher</th>
                    <th>Publish</th>
                  </tr>
                </thead>
                <tbody>
                 <?php
                 while ($uploadsuccessRow = mysqli_fetch_array($uploadsuccessResult))
                 {

                  $studentDetailQuery = "SELECT * FROM students where student_id= '".$uploadsuccessRow['StudentID']."'";
                  $studentDetailResult = mysqli_query($con, $studentDetailQuery);
                  
                  $studentDetailrow = mysqli_fetch_array($studentDetailResult);
                 
                  $fname = $studentDetailrow['FirstName'];
                  $mName = $studentDetailrow['MiddleName'];
                  $lname = $studentDetailrow['LastName'];
                  $RegNum = $studentDetailrow['RegNum'];
               
                 
                 
                 
          
                 
                       
                 
                   ?>
                  <tr>
                   <!-- <td><input type="checkbox" name="sno[]" value="<?php echo $uploadsuccessRow['Sno']; ?>" class="name" /></td>-->
                   <td><?php echo $uploadsuccessRow['StudentID'];?></td>
                    <td><a href="student-details.php?studentID=<?php echo $uploadsuccessRow['StudentID']; ?>"> <?php echo $uploadsuccessRow['StudentReg'];?></a></td>
                    <td><?php echo strtoupper($fname);?> <?php echo strtoupper($lname);?></td>
                    
                   
                    <td><?php echo $uploadsuccessRow['subject'];?></td>
                    <td><?php echo $uploadsuccessRow['subjectID'];?></td>
                    <td><?php echo $uploadsuccessRow['school_session'];?></td>
                    <td><?php echo $uploadsuccessRow['Term'];?></td>
                    <td><?php echo $uploadsuccessRow['class'];?></td>
                    <td><?php echo $uploadsuccessRow['CA1'];?></td>
                    <td><?php echo $uploadsuccessRow['CA2'];?></td>
                    <td><?php echo $uploadsuccessRow['CA3'];?></td>
                    <td><?php echo $uploadsuccessRow['Exam'];?></td>
                    <td><?php echo $uploadsuccessRow['Total'];?></td>
                    <td><?php echo $uploadsuccessRow['Average'];?></td>
                    <td><?php echo $uploadsuccessRow['Grade'];?></td>
                    <td><?php echo $uploadsuccessRow['Remark'];?></td>

                    <td>
                      <?php 
                  $check_res = $con->query("SELECT * FROM `results` WHERE school_session='$uploadsuccessRow[school_session]' AND Term='$uploadsuccessRow[Term]' AND class='$uploadsuccessRow[class]' AND  subjectID='$uploadsuccessRow[subjectID]' ORDER BY Average DESC ");
                  $score_ends = array(1 => "st", 2 => "nd", 3 => "rd", 4 => "th");
                  $counter = 1; // init absolute counter
                  $rank = 1; // init rank counter
                  $score_ends = array(1 => "st", 2 => "nd", 3 => "rd", 4 => "th");
                  // initial "previous" score:
                  $prevScore = 0;
                  
                foreach( $check_res as $value){
                      // get "current" score
                      $score = $value['Average'];
                  
                      if ($prevScore != $score) // if previous & current scores differ
                          $rank = $counter;
                      // else //same // do nothing

                      if($RegNum == $value['StudentReg']){
                      if($rank < 4){
                      echo $rank.$score_ends[$rank];
                      }

                         
                    else{
                      echo $rank.$score_ends[4];
                     
                    }
                  }
                      $counter ++; // always increment absolute counter
                      
                      //current score becomes previous score for next loop iteration
                      $prevScore = $score;
                  
                }
                  ?></td>


                    <td><?php echo $uploadsuccessRow['Teacher'];?></td>
                    <td><?php echo $uploadsuccessRow['Publish'];?></td>

                    
                   
                  </tr>
                 <?php  }?>

                  
                  
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
		<script src="external/js/form-controlsForUploadResult526f.js"></script>
        <!--end::Page Scripts-->
        
        <!--begin::Page Scripts(used by this page) For input-masks(Date of Birth field)-->
        <script src="external/js/pages/crud/forms/widgets/input-mask526f.js?v=7.0.8"></script>
        <!--begin::Page Scripts(used by this page) For input-masks-->
        
        <!--script for state and LGA drop down list-->
        <script src="jsForStateDropList/lga.min.js"></script>
       <!--script for state and LGA drop down list-->

  </body>
</html>


