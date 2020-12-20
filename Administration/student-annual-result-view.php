<?php session_start();?>
<?php

function get_position($data, $score){
  $score_ends = array(1 => "st", 2 => "nd", 3 => "rd", 4 => "th");
  $data = explode(',', $data);
  arsort($data);
  $student_position = array_search($score, array_values($data))+1;
  if($student_position < 4){
      echo $student_position.$score_ends[$student_position];
  }else{
      echo $student_position.$score_ends[4];
  }
}








if( $_SESSION['Adminusername'] == "")
{
header("Location: index.php" );
exit;
}

if($_SESSION['annualResultSession'] == "")
{
header("Location: dashboard.php" );
exit;
}


//database connection
include('include/db.php');


$student_score=mysqli_query($con, "SELECT SUM(Average) AS Average, StudentID FROM `results` where class ='$_SESSION[annualResultClass]' and school_session = '$_SESSION[annualResultSession]'  AND Publish='Yes' GROUP BY StudentID ");
foreach ($student_score as $key => $value) {
    $student_data[]= round($value['Average']);
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

if($resultManagement!="YES")
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

	
	
$studentDetailQuery = "SELECT * FROM students where student_id= '".$_SESSION['annualResultStudentID']."'";
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
 //teacher's remark


if(isset($_POST["t_remark_button"])) {


 

           
            $ck_row=mysqli_query($con, "SELECT  name, session, term, class, StudentID FROM  remark WHERE name ='Teacher' AND session ='$_SESSION[annualResultSession]' AND class='$_SESSION[annualResultClass]' AND term='Annual' AND StudentID='".$student_id."'  ");
            
            if(mysqli_num_rows($ck_row) < 1){
                      mysqli_query($con, "INSERT INTO `remark`( `name`, `remark`, `session`,`class`, `term`,`StudentID` ) VALUES ('Teacher','".$_POST['t_remark']."','$_SESSION[annualResultSession]','$_SESSION[annualResultClass]', 'Annual','".$student_id."') ");
            }
            
            

            if(mysqli_num_rows($ck_row) == 1) {

              mysqli_query($con, "UPDATE remark set  remark='" . $_POST["t_remark"] . "' WHERE name ='Teacher' AND session ='$_SESSION[annualResultSession]' AND StudentID='".$student_id."' AND class='$_SESSION[annualResultClass]' AND term='Annual'");


            }





header("Location:student-annual-result-view.php");
exit;


}




	

	
$t_remarkQuery = "SELECT * FROM remark WHERE name ='Teacher' AND session ='$_SESSION[annualResultSession]' AND class='$_SESSION[annualResultClass]' AND term='Annual' AND StudentID='".$student_id."'";
$t_remarkResult = mysqli_query($con, $t_remarkQuery);

$t_remarkRow = mysqli_fetch_array($t_remarkResult);

$teacherCustomRemark = $t_remarkRow['remark'];










?>


<?php

//total average


        $Query = "SELECT StudentReg, SUM(Average) AS totalaverage FROM results WHERE Class ='$_SESSION[annualResultClass]' AND school_session ='$_SESSION[annualResultSession]'  AND StudentReg ='".$regNum."' AND Publish='Yes'
        GROUP BY StudentReg   ORDER BY totalaverage DESC";
        $Result = mysqli_query($con, $Query);
          $Row = mysqli_fetch_array($Result); 

        round($Row['totalaverage'])
  



      

        
        
?>




<?php

//summation of term total
        $firstTermTotalQuery = "SELECT StudentReg, SUM(Total) AS firstTermTotalSummation FROM results where Class ='$_SESSION[annualResultClass]' And school_session ='$_SESSION[annualResultSession]' AND Term ='First' AND StudentReg ='".$regNum."'
        AND Publish ='Yes'
        GROUP BY StudentReg   ORDER BY firstTermTotalSummation DESC";
        $firstTermTotalResult = mysqli_query($con, $firstTermTotalQuery);
        $firstTermTotalRow = mysqli_fetch_array($firstTermTotalResult); 
        $firstTermTotalRow['firstTermTotalSummation'];
  


        $secondTermTotalQuery = "SELECT StudentReg, SUM(Total) AS secondTermTotalSummation FROM results where Class ='$_SESSION[annualResultClass]' And school_session ='$_SESSION[annualResultSession]' AND Term ='Second' AND StudentReg ='".$regNum."'
        AND Publish ='Yes'
        GROUP BY StudentReg   ORDER BY secondTermTotalSummation DESC";
        $secondTermTotalResult = mysqli_query($con, $secondTermTotalQuery);
        $secondTermTotalRow = mysqli_fetch_array($secondTermTotalResult); 
        $secondTermTotalRow['secondTermTotalSummation'];


        $thirdTermTotalQuery = "SELECT StudentReg, SUM(Total) AS thirdTermTotalSummation FROM results where Class ='$_SESSION[annualResultClass]' And school_session ='$_SESSION[annualResultSession]' AND Term ='Third' AND StudentReg ='".$regNum."'
        AND Publish ='Yes'
        GROUP BY StudentReg   ORDER BY thirdTermTotalSummation DESC";
        $thirdTermTotalResult = mysqli_query($con, $thirdTermTotalQuery);
        $thirdTermTotalRow = mysqli_fetch_array($thirdTermTotalResult); 
        $thirdTermTotalRow['thirdTermTotalSummation'];




        //summation of total average

        $termTotalSummation = $firstTermTotalRow['firstTermTotalSummation'] + $secondTermTotalRow['secondTermTotalSummation'] + $thirdTermTotalRow['thirdTermTotalSummation'];
        $totalAverageSummation = $termTotalSummation/3;
  
        
        
?>

<?php 

$sql="SELECT COUNT(countable.StudentReg) as totalClass FROM (SELECT DISTINCT StudentReg FROM `results` WHERE class ='$_SESSION[annualResultClass]' and school_session = '$_SESSION[annualResultSession]') as countable";
$countresult = mysqli_query($con, $sql) or die ("Query error!");

while ($erow = mysqli_fetch_array($countresult)) {

  $var = $erow['totalClass'];

  $classNumber=$var;

}


?>

<?php 


$formTeacherUsernameQuery = "SELECT * FROM classes WHERE className ='$_SESSION[annualResultClass]'";
$formTeacherUsernameResult = mysqli_query($con, $formTeacherUsernameQuery);

$formTeacherUsernameRow = mysqli_fetch_array($formTeacherUsernameResult);

$formTeacherUsername = $formTeacherUsernameRow['FormTeacher'];


$formTeacherQuery = "SELECT * FROM administration WHERE Username ='".$formTeacherUsername."'";
$formTeacherResult = mysqli_query($con, $formTeacherQuery);

$formTeacherRow = mysqli_fetch_array($formTeacherResult);

$formTeacher = $formTeacherRow['First_Name'].' '.$formTeacherRow['Last_Name'];



$principalQuery = "SELECT * FROM administration WHERE privileged_Status	 ='Principal'";
$principalResult = mysqli_query($con, $principalQuery);

$principalRow = mysqli_fetch_array($principalResult);

$principal = $principalRow['First_Name'].' '.$principalRow['Last_Name'];

?>


<?php 


$classPromotionQuery = "SELECT * FROM class_promotion WHERE Promote_From= '$_SESSION[annualResultClass]'";
$classPromotionResult = mysqli_query($con, $classPromotionQuery);

$classPromotionrow = mysqli_fetch_array($classPromotionResult);




$promote_from = $classPromotionrow['Promote_From'];
$promote_to = $classPromotionrow['Promote_To'];






	

	
$promotionQuery = "SELECT Promotion_Status FROM results where Class ='$_SESSION[annualResultClass]' And school_session ='$_SESSION[annualResultSession]' AND StudentReg ='$regNum'
AND Publish ='Yes'
GROUP BY StudentReg ";
$promotionResult = mysqli_query($con, $promotionQuery);
$promotionRow = mysqli_fetch_array($promotionResult); 
$principal_promotion_comment = $promotionRow['Promotion_Status'];


if($principal_promotion_comment=="Promoted")
{


  $principal_promotion_comment="<span class='text-success font-weight-bold'>Promoted To $promote_to</span>";

}

else if($principal_promotion_comment!="Promoted")
{


  $principal_promotion_comment="<span class='text-danger font-weight-bold'>No Promotion</span>";

}

?>


<?php

$current_class = substr($_SESSION['annualResultClass'], 0, 5);





if($current_class =="SSS 1"){

  $School="Senior Secondary School 1";
      
      
      }
else{
    
    $current_class = substr($_SESSION['annualResultClass'], 0, 3);
    
    if($current_class =="JSS")
    {
     $School="Junior Secondary School";
    
    }
    
    else if ($current_class =="SSS"){
    
    $School="Senior Secondary School";
    
    }

    else{
      header("Location: select-student-annual-result-category.php?studentID=$student_id");
      exit;
    }
  }   
?>


<?php include('include/annual-results-grading.php');?>









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
    <title>Annual Result: <?php echo strtoupper($fname);?>  <?php echo strtoupper($lname);?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--begin::Global Theme Styles(used by all pages)-->
    
		<link href="other.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->



    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Main CSS-->











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
        <h1><i class="fa fa-th-list"></i> Annual Results For:  <?php echo $_SESSION['annualResultSession'];?>--<?php echo $_SESSION['annualResultClass'];?></h3>
        <p><strong><?php echo strtoupper($fname);?> <?php echo strtoupper($mName);?> <?php echo strtoupper($lname);?> (<?php echo $regNum;?>)</strong></p>
        <p>Total Average: <strong><?php echo $Row['totalaverage'];?></strong></p>
          <p>Annual Result: <strong><?php echo round($totalAverageSummation, 2);?></strong></p>
          <p>Annual Position in Class: <strong><?php 
 if($Row['totalaverage']!=""){

echo get_position(implode(",",$student_data), round($Row['totalaverage'])); 

$resultNotReady="";
 }

 else{
    echo'No Published Result';
  

 }
?></strong></p>
          <p>Number in Class: <strong><?php echo $classNumber;?></strong></p>
          <p>Form Teacher's Comment (<?php echo $formTeacher;?>): <strong><?php echo $teacherComment;?></strong><strong><?php echo $teacherCustomRemark;?></strong></p>
          <p>Principal's Comment (<?php echo $principal?>): <?php echo $principal_promotion_comment;?></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <!--<li class="breadcrumb-item"></li>-->
          <li class="breadcrumb-item active"><a href="select-student-annual-result-category.php?studentID=<?php echo $student_id;?>" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Back</a></li>
         <!-- <li class="breadcrumb-item active"><a href="uploadresult.php" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Upload Results</a></li>-->
        </ul>
      </div>
      <div class="row" style="width:120%">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">

             

                  

                   


                  


                   

                   
                   


                   
                   <div class="row">
                   <div class="col-xl-6">
                  
                    </div>
                   </div>
                   
                   </div>

                  



            
                <table class="table table-hover table-bordered table-striped" id="sampleTable">
                <thead>
                  <tr class="row100 head">
                    <th class="column100 column2" data-column="column1" rowspan="2">Subjects</th>
                    <th class="column100 column2" data-column="column2" colspan="5">First Term</th>
								    <th class="column100 column2" data-column="column2" colspan="5">Second Term</th>
                    <th class="column100 column3" data-column="column3" colspan="5">Third Term</th>
                    <th class="column100 column3" data-column="column3" rowspan="2">Annual Result</th>
                    <th class="column100 column3" data-column="column3"  rowspan="2">Subject Position</th>
                    <th class="column100 column3" data-column="column3" rowspan="2">Grade</th>
                    <th class="column100 column3" data-column="column3" rowspan="2">Remark</th>

                  </tr>


                  <tr>
                  <th class="column100 column2" data-column="column2">CA1</th>
                  <th class="column100 column2" data-column="column2">CA2</th>
                  <th class="column100 column2" data-column="column2">CA3</th>
                  <th class="column100 column2" data-column="column2">Exam</th>
                  <th class="column100 column2" data-column="column2">Total</th>

                  <th class="column100 column2" data-column="column2">CA1</th>
                  <th class="column100 column2" data-column="column2">CA2</th>
                  <th class="column100 column2" data-column="column2">CA3</th>
                  <th class="column100 column2" data-column="column2">Exam</th>
                  <th class="column100 column2" data-column="column2">Total</th>

                  <th class="column100 column2" data-column="column2">CA1</th>
                  <th class="column100 column2" data-column="column2">CA2</th>
                  <th class="column100 column2" data-column="column2">CA3</th>
                  <th class="column100 column2" data-column="column2">Exam</th>
                  <th class="column100 column2" data-column="column2">Total</th>
      
        
                </tr>

                  </thead>
                  <tbody>

                  <?php 
        

        $list_subjects = $con->query("SELECT * FROM `registered_subjects` WHERE School='$School' AND StudentReg ='$regNum' Group By subjectID Order By subjectID ASC");
        while($row_subjects = $list_subjects->fetch_array()){
        $result = mysqli_query($con, "SELECT *,
        MAX(CASE WHEN results.Term = 'First' THEN results.CA1 END) 'FirstTermCA1',
        MAX(CASE WHEN results.Term = 'First' THEN results.CA2 END) 'FirstTermCA2',
        MAX(CASE WHEN results.Term = 'First' THEN results.CA3 END) 'FirstTermCA3',
        MAX(CASE WHEN results.Term = 'First' THEN results.Exam END) 'FirstTermExam',
        MAX(CASE WHEN results.Term = 'First' THEN results.Total END) 'FirstTermTotal',
       
        MAX(CASE WHEN results.Term = 'Second' THEN results.CA1 END) 'SecondTermCA1',
        MAX(CASE WHEN results.Term = 'Second' THEN results.CA2 END) 'SecondTermCA2',
        MAX(CASE WHEN results.Term = 'Second' THEN results.CA3 END) 'SecondTermCA3',
        MAX(CASE WHEN results.Term = 'Second' THEN results.Exam END) 'SecondTermExam',
        MAX(CASE WHEN results.Term = 'Second' THEN results.Total END) 'SecondTermTotal',

        MAX(CASE WHEN results.Term = 'Third' THEN results.CA1 END) 'ThirdTermCA1',
        MAX(CASE WHEN results.Term = 'Third' THEN results.CA2 END) 'ThirdTermCA2',
        MAX(CASE WHEN results.Term = 'Third' THEN results.CA3 END) 'ThirdTermCA3',
        MAX(CASE WHEN results.Term = 'Third' THEN results.Exam END) 'ThirdTermExam',
        MAX(CASE WHEN results.Term = 'Third' THEN results.Total END) 'ThirdTermTotal',
        SUM(results.Total) AS allTermScoreTotal
        
        FROM results WHERE school_session='$_SESSION[annualResultSession]'  AND class='$_SESSION[annualResultClass]' AND  subjectID='$row_subjects[subjectID]'AND StudentReg ='$regNum'
       
        ORDER BY  results.StudentID DESC");
        $row_results = $result->fetch_array();
        $allTotalScoreAverage=$row_results['allTermScoreTotal']/3;



          ?>




                   <?php
                  
                   //output all from students table
                   $subject =$row_subjects['subjectName']; 
                   $sno =$row_results['Sno']; 
                    $student_id =$row_results['StudentID'];
                    $RegNum =$row_results['StudentReg']; 
                   

                  
                  
                   

                   
                   
                   
                   
                   
            
                   
                   			
                   
                     ?>
                    <tr>
                   
                    <td class="column100 column1" data-column="column1"><b><?php echo $row_subjects['subjectName'];?></b></td>
                   
                


                   <td class="column100 column2" data-column="column2"><?php echo  $row_results['FirstTermCA1'];?></td>
                   <td class="column100 column2" data-column="column2"><?php echo  $row_results['FirstTermCA2'];?></td>
                   <td class="column100 column2" data-column="column2"><?php echo  $row_results['FirstTermCA3'];?></td>
                   <td class="column100 column2" data-column="column2"><?php echo  $row_results['FirstTermExam'];?></td>
                   <td class="column100 column2" data-column="column2"><strong><?php echo  $row_results['FirstTermTotal'];?></strong></td>
                  
                    
   
   
   
                   
                   <td class="column100 column2" data-column="column2"><?php echo  $row_results['SecondTermCA1'];?></td>
                   <td class="column100 column2" data-column="column2"><?php echo  $row_results['SecondTermCA2'];?></td>
                   <td class="column100 column2" data-column="column2"><?php echo  $row_results['SecondTermCA3'];?></td>
                   <td class="column100 column2" data-column="column2"><?php echo  $row_results['SecondTermExam'];?></td>
                   <td class="column100 column2" data-column="column2"><strong><?php echo  $row_results['SecondTermTotal'];?></strong></td>
                  
                   
   
   
                   
                   <td class="column100 column2" data-column="column2"><?php echo  $row_results['ThirdTermCA1'];?></td>
                   <td class="column100 column2" data-column="column2"><?php echo  $row_results['ThirdTermCA2'];?></td>
                   <td class="column100 column2" data-column="column2"><?php echo  $row_results['ThirdTermCA3'];?></td>
                   <td class="column100 column2" data-column="column2"><?php echo  $row_results['ThirdTermExam'];?></td>
                   <td class="column100 column2" data-column="column2"><strong><?php echo  $row_results['ThirdTermTotal'];?></strong></td>
   
   
   
                   <?php 






if($School=="Junior Secondary School")
{

  $sch_grade=annual_grade_jss($allTotalScoreAverage);

}

else if ($School=="Senior Secondary School"){


  $sch_grade=annual_grade_sss($allTotalScoreAverage);

}

else if ($School=="Senior Secondary School 1"){


  $sch_grade=annual_grade_sss($allTotalScoreAverage);

}




?>
             
                   
   
   
   
                    <td class="column100 column3" data-column="column3"><?php echo  round($allTotalScoreAverage, 2);?></td>
                    <td class="column100 column3" data-column="column3"> <?php 
                  $check_res = $con->query("SELECT *, SUM(Average) AS Sum_Average FROM `results` WHERE school_session='$_SESSION[annualResultSession]' AND class='$_SESSION[annualResultClass]' AND  subjectID='$row_subjects[subjectID]' AND Publish ='YES'  GROUP BY StudentReg ORDER BY  Sum_Average DESC ");
                
                  $counter = 1; // init absolute counter
                  $rank = 1; // init rank counter
                 
                  // initial "previous" score:
                  $prevScore = 0;
                  
                foreach( $check_res as $value){
                      // get "current" score
                      $score = $value['Sum_Average'];
                  
                      if ($prevScore != $score) // if previous & current scores differ
                          $rank = $counter;
                          include('include/end.php');
                      // else //same // do nothing

                      if($RegNum == $value['StudentReg']){
                     
                      echo $rank.$end;
                     
                  }
                      $counter ++; // always increment absolute counter
                      
                      //current score becomes previous score for next loop iteration
                      $prevScore = $score;
                  
                }
                  ?></td>
                    <td class="column100 column3" data-column="column3"><?php echo $sch_grade['grade'];?></td>
                    <td class="column100 column3" data-column="column3"><?php echo $sch_grade['remark'];?></td>
                      
                    </tr>
                   <?php }?>

                   

                    
                    
                  </tbody>
                   
                </table>


               

                   
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
											<div class="card-body">
												<table class="table table-striped">
                        <div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label">Form Teacher's Custom Remark Here:</label>
																		<div class="col-lg-6 col-xl-6">
																			<div class="input-group input-group-lg input-group-solid">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="la la-at"></i>
																					</span>
																				</div>
                                               <textarea class="form-control form-control-lg form-control-solid" name="t_remark"><?php echo $teacherCustomRemark;?></textarea> 
                                               
                                                                                
                                                                              
                                                                            
                            
                                                                            </div>
                                                                            <span class="form-text text-muted"></span>
																		</div>
																	</div>
                                                
                                               



                                  <div>
															
															<div>
																<input type="submit" name="t_remark_button" class="btn btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-left:25%; width:50%" value="Submit"/>
																
															</div>
														</div>   


                            </form>





                    
												 
											</div>
										</div>
										<!--end::Card-->



              

              
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
  </body>
</html>


