<?php session_start();?>
<?php










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







?>
<?php
$setResultMarkCurrentPageTag="";
//If a link in the nav bar is active


$pageActiveTag3="Results";
$currentPageTag="all student result";


if($pageActiveTag3="Results"){

  $studentsExpand="";
  $ExpandAdmin="";
  $ExpandResults="is-expanded";
  $ExpandSiteManager="";
  $ExpandPinManager="";

    


}

if($currentPageTag="all student result"){
  $allPinCurrentPageTag="";
  $pinGeneratorCurrentPageTag="";
  $resultPageManagerCurrentPageTag="";
  $frontPageManagerCurrentPageTag="";
  $downloadResultClassCurrentPageTag="";
  $importResultClassCurrentPageTag="";
  $searchResultClassCurrentPageTag="";
  $allStudentResultClassCurrentPageTag="active";
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
// side bar and header
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
      header("Location: select-annual-result-category.php?studentID=$student_id");
      exit;
    }
  }   
?>





<?php 
$totalAverageSummation="";
$teacherCustomRemark="";

include('include/annual-results-grading.php');


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
    <title>Annual Result:: <?php echo $regNum;?></title>
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
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <!--<li class="breadcrumb-item"></li>-->
          <li><a href="select-annual-result-category.php?studentID=<?php echo $student_id;?>" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Back</a></li>
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
        

        $list_subjects = $con->query("SELECT * FROM `registered_subjects` WHERE  School='$School' AND StudentReg ='$regNum' Group By subjectID Order By subjectID ASC");
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
                  $check_res = $con->query("SELECT *, SUM(Average) AS Sum_Average FROM `results` WHERE school_session='$_SESSION[annualResultSession]' AND class='$_SESSION[annualResultClass]' AND  subjectID='$row_subjects[subjectID]'   GROUP BY StudentReg ORDER BY  Sum_Average DESC ");
                  $counter = 1; 
                  $rank = 1; 
                 
                  
                  $prevScore = 0;
                  
                foreach( $check_res as $value){
                      
                      $score = $value['Sum_Average'];
                      
                  
                      if ($prevScore != $score)
                          $rank = $counter;
                         

                      if($RegNum == $value['StudentReg']){
                        include('include/end.php');
                     
                      echo $rank.$end;
                    
                  }
                      $counter ++; 
                      
                     
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


