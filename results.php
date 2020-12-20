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

if($_SESSION['studentID'] =="")
{
header("Location: index.php" );
exit;
}
?>
<?php
if($_SESSION['status'] =="Deactivated")
{
header("Location: index.php" );
exit;
}

if($_SESSION['annualResult']=="Annual Result")
{
header("Location: index.php" );
exit;
}



?>
<?php 



include('Administration/include/db.php');

//class position query

$student_score=mysqli_query($con, "SELECT SUM(Average) AS Average, StudentID FROM `results` where class ='".$_SESSION['class']."' and school_session = '".$_SESSION['school_session']."' and Term = '".$_SESSION['term']."' GROUP BY StudentID ");
foreach ($student_score as $key => $value) {
    $student_data[]= round($value['Average']);


    


}
?>














<?php 

   $pin_number_of_times_query= $con->prepare("SELECT content_for_integer FROM sitemanager  WHERE tag = 'pin_number_of_times'");
  
   $pin_number_of_times_query->execute();                            
   $pin_number_of_times_query->Store_result();                       
   $pin_number_of_times_query->bind_result($pin_number_of_times);  
   $pin_number_of_times_query->fetch();
   $pin_number_of_times_query->close();
?>
<?php

//check if number of logins exceeds 3 times
if($_SESSION['count'] >= $pin_number_of_times)
{
    session_destroy();
    header("Location: index.php?message=This Pin Is no longer valid");
}
?>








<?php

//summation of average


        $Query = "SELECT StudentReg, SUM(Total) AS TotalTotal, SUM(Average) AS totalaverage FROM results where Class ='".$_SESSION['class']."' And school_session ='".$_SESSION['school_session']."' AND Term ='".$_SESSION['term']."' AND StudentReg ='".$_SESSION['RegNum']."'
        AND Publish ='Yes'
        GROUP BY StudentReg   ORDER BY totalaverage DESC";
        $Result = mysqli_query($con, $Query);
          $Row = mysqli_fetch_array($Result); 
          $totalAverage=$Row['TotalTotal']/4;
  
        
        
?>

<?php

//summation of  total


        $totalQuery = "SELECT StudentReg, SUM(Total) AS totalsummation FROM results where Class ='".$_SESSION['class']."' And school_session ='".$_SESSION['school_session']."' AND Term ='".$_SESSION['term']."' AND StudentReg ='".$_SESSION['RegNum']."'
        AND Publish ='Yes'
        GROUP BY StudentReg   ORDER BY totalsummation DESC";
        $totalResult = mysqli_query($con, $totalQuery);

        $totalRow = mysqli_fetch_array($totalResult); 
  
        
        
?>


<?php 
//display number of login sessions
$LoginCountQuery = "SELECT * FROM pinlogin where PinCode = '".$_SESSION['pinCode']."'  ";
$LoginCountResult = mysqli_query($con, $LoginCountQuery);


while ($LoginCountRow = @mysqli_fetch_assoc($LoginCountResult))
{
$LoginCount = $LoginCountRow['LoginCount'];





}			




//$sql = "select COUNT(StudentID) class from results where class ='".$_SESSION['class']."' and school_session = '".$_SESSION['school_session']."' and Term = '".$_SESSION['term']."'
//GROUP BY  subjectID";
$sql="SELECT COUNT(countable.StudentReg) as totalClass FROM (SELECT DISTINCT StudentReg FROM `results` WHERE class ='".$_SESSION['class']."' and school_session = '".$_SESSION['school_session']."' and Term = '".$_SESSION['term']."') as countable";
$countresult = mysqli_query($con, $sql) or die ("Query error!");

while ($erow = mysqli_fetch_array($countresult)) {

  $var = $erow['totalClass'];

  $classNumber=$var;

}








$allStudentcountSql = "select COUNT(student_id) RegNum from students";
$allStudentcountResult = mysqli_query($con, $allStudentcountSql) or die ("Query error!");

while ($cRow = mysqli_fetch_array($allStudentcountResult)) {

  $var = $cRow['RegNum'];

  $allStudentNumber=$var;

}


?>



<?php 



	

	
$studentDetailQuery = "SELECT * FROM students where student_id= '".$_SESSION['studentID']."'";
$studentDetailResult = mysqli_query($con, $studentDetailQuery);

$studentDetailrow = mysqli_fetch_array($studentDetailResult);

$passport = $studentDetailrow['ProfilePic'];






if($passport=="")
{

  $passport="blank.png";
}




?>







<?php
  



 $resultpageQuery = "SELECT * FROM sitemanager where tag='school_logo'";
 $resultpageResult = mysqli_query($con, $resultpageQuery);

$row = mysqli_fetch_array($resultpageResult);
$school_logo = $row['Content'];
?>




<?php
  



 $resultpageQuery = "SELECT * FROM sitemanager where tag='school_stamp'";
 $resultpageResult = mysqli_query($con, $resultpageQuery);

$row = mysqli_fetch_array($resultpageResult);
$school_stamp = $row['Content'];
?>








<?php

$resumptionDateQuery = "SELECT * FROM resumption_date WHERE term='$_SESSION[term]' AND session='$_SESSION[school_session]'";
$resumptionDateResult = mysqli_query($con, $resumptionDateQuery);

$resumptionDaterow = mysqli_fetch_array($resumptionDateResult);
$r_date = $resumptionDaterow['date'];
?>



<?php 



	

	
$teacherUsernameQuery = "SELECT FormTeacher FROM classes where className ='".$_SESSION['class']."'";
$teacherUsernameResult = mysqli_query($con, $teacherUsernameQuery);

$teacherUsernameRow = mysqli_fetch_array($teacherUsernameResult);

$teacherUsername = $teacherUsernameRow['FormTeacher'];





$teacherQuery = "SELECT * FROM administration where Username ='".$teacherUsername."'";
$teacherResult = mysqli_query($con, $teacherQuery);

$teacherRow = mysqli_fetch_array($teacherResult);

$teacher = $teacherRow['First_Name'].' '.$teacherRow['Last_Name'];
$signature = $teacherRow['Signature'];









?>


<?php
  



 $principalnameQuery = "SELECT * FROM administration where privileged_Status ='Principal'";
 $principalnameResult = mysqli_query($con, $principalnameQuery);

 $principalnameRow = mysqli_fetch_array($principalnameResult);
$principalname = $principalnameRow['First_Name'] .' ' .$principalnameRow['Last_Name'] ;
?>


<?php 



	

	
$t_remarkQuery = "SELECT * FROM remark WHERE name ='Teacher' AND session ='".$_SESSION['school_session']."' AND class='".$_SESSION['class']."' AND term='".$_SESSION['term']."' AND StudentID='".$_SESSION['studentID'] ."'";
$t_remarkResult = mysqli_query($con, $t_remarkQuery);

$t_remarkRow = mysqli_fetch_array($t_remarkResult);

$teacherCustomRemark = $t_remarkRow['remark'];



$p_remarkQuery = "SELECT * FROM remark WHERE name ='Principal' AND session ='".$_SESSION['school_session']."' AND class='".$_SESSION['class']."' AND term='".$_SESSION['term']."' AND StudentID='".$_SESSION['studentID'] ."'";
$p_remarkResult = mysqli_query($con, $p_remarkQuery);


$p_remarkRow = mysqli_fetch_array($p_remarkResult);

$principalCustomRemark = $p_remarkRow['remark'];









?>


<?php

$current_result_class = substr($_SESSION['class'], 0, 5);

if($current_result_class =="SSS 1"){

  $School="Senior Secondary School 1";
      
      
    }
else{   
    $current_result_class = substr($_SESSION['class'], 0, 3);

    if($current_result_class=="JSS")
       {
         $School="Junior Secondary School";

       }

    else if ($current_result_class=="SSS"){

      $School="Senior Secondary School";

          }

     else{
       $School="";
      }
}    
?>





<?php include('Administration/include/term-results-grading.php');?>



<?php
//school for ONLY result marks
$results_marks_class = substr($_SESSION['class'], 0, 3);

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

     $result_marks_query= $con->prepare("SELECT CA1,CA2,CA3,Exam FROM result_marks WHERE School='$results_marks_School' AND session ='$_SESSION[school_session]' AND term='$_SESSION[term]' ");
     $result_marks_query->execute();                          
     $result_marks_query->Store_result();                      
     $result_marks_query->bind_result($result_marks_ca1,$result_marks_ca2,$result_marks_ca3,$result_marks_exam);  
     $result_marks_query->fetch();
     



?>





<!DOCTYPE html>
<html lang="en">

<head>
	<title>Results:: <?php echo  $_SESSION['FName'];?> <?php echo $_SESSION['LName'] ;?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	


<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="external/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="external/external/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="external/external/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="external/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="external/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->

	<link rel="stylesheet" type="text/css" href="external/css/main.css">
<!--===============================================================================================-->


<link rel="icon" type="image/png" href="images/<?php echo $favicon;?>" sizes="16x16">


<style type="text/css">
@media print {




 .logo{font-family: Impact, Charcoal, sans-serif; font-size:135%; margin-left:12%; }
 .logo2{font-family: Impact, Charcoal, sans-serif;  display:block;font-size:80%; margin-left:40% }

 
 .print{width:10%; padding-left:20%; }
 
 .carduse{padding-left:20px; font-size:10px}
 .text-justify{padding-left:20px; font-size:140%; padding-top:5px}
 .appear {display:none; }
 .head{color:#000;}
 .printText{color:#000; font-size:10px}

 .table{
       
        width:100%;
       
        margin-top:30px;
        border:solid 2px;

    }
   
    th:first-child{width:15%; }
    .table  th{width:15%;background-color:#000; color:#fff; font-size:10px }
    .table  td{padding:5px 5px 9px 10px }

    .bottomTable th{width:5%;background-color:#000; color:#fff; }



  #container{
  margin:auto;
   width:100%;
  }


   .bottomTable{
       
    width:100%;
    margin-top:30px;
      
     }
   .keyGrades{
   width:100%;}
   .printText3{font-size:10px;}

   .nameTable{font-size:10px}
}
@media screen {


 .logo{font-family: Impact, Charcoal, sans-serif; font-size:300%; margin-left:10%;}
 .text-justify{padding-left:60px;font-size:13px;}
 .logo2{font-family: Impact, Charcoal, sans-serif;  display:block;font-size:120%; margin-left:30% }




 .table{
        
        width:100%;
        margin-top:30px;
        border:solid 5px;

    }
    th:first-child{width:15%; }
    th{width:5%;background-color:#000; color:#fff}



#container{
  margin:auto;
   width:80%;
}
.keyGrades{ 
   width:100%;margin-top:200px;}


.bottomTable{
       
        width:100%;
       margin-top:30px;
      
}
.bottomTable th:first-child{width:5%;}

}




  

@media only screen and (max-width: 800px) {
  .logo{font-family: Impact, Charcoal, sans-serif; font-size:25px; margin-left:30%; display:block }
.logo2{font-family: Impact, Charcoal, sans-serif; font-size:10px; margin-left:40%; display:block }
.printbutton{margin-left:20px}
.carduse{margin-left:20px}


  
}
 
@media only screen and (max-width: 640px) {
	
  .logo{font-family: Impact, Charcoal, sans-serif; font-size:25px; margin-left:30%; display:block }
.logo2{font-family: Impact, Charcoal, sans-serif; font-size:10px; margin-left:30%; display:block }
.printbutton{margin-left:20px}
.carduse{margin-left:20px}

  
}


</style>



</head>
<body>

<table  style="border-bottom:2px solid #000; font-family: Times New Roman, Times, serif; font-size:13px; height:20px">



  <tr> 
  
  <td rowspan="2" style="width:20%"><img src="images/<?php echo $school_logo; ?>" height="100" width="100" style="margin-left:50%; margin-bottom:3%"/></td>
  <td><span class="logo">COMMAND SECONDARY SCHOOL, ABAKALIKI </span><br/><span class="logo2"><i>...DISCIPLINE AND KNOWLEGE</i></span></td>
    <td  rowspan="2"><img src="Administration/images/student-passport/<?php echo $passport;?>" height="60" width="60" style="margin-left:20%;border:2px solid #000" class="rounded"/></td>
    <td class="carduse"><li class="breadcrumb-item active"><button onclick="window.print()" class="btn btn-sm btn-success appear printbutton">Print</button></li></td>
   
  </tr>
  <tr>
    <td style="width:50%"></td>
   
    <td class="carduse"><span class="carduse">Card Use: <strong><?php echo $LoginCount;?>/<?php echo $pin_number_of_times;?></strong></span><br/><span class="carduse"> Resumption Date: </span><span class="carduse"><strong><?php echo $r_date;?></strong><br/> <a class="text-danger appear" href="logout.php?logout=1" style="margin-left:60%;"> <strong>Logout</strong></a></span></td>
    
  </tr>
</table>

<table  height="100" style="border-bottom:2px solid #000; font-family: Times New Roman, Times, serif; font-size:13px; padding-left:200px">

<tr>
<td>
<div style="padding-left:20px"><span class="nameTable"> <b>Reg Number: </b> <?php echo $_SESSION['RegNum'];?></span></div>
</td>
<td><span class="nameTable"> <b>Session: </b> <?php echo $_SESSION['school_session'];?></span></td>
<td><span class="nameTable"> <b>Sport House: </b> <?php echo $_SESSION['sHouse'];?></span></td>
<td><span class="nameTable"> <b>Position in Class:</b> 
<?php 
 if($Row['totalaverage']!=""){

echo get_position(implode(",",$student_data), round($Row['totalaverage'])); 

$resultNotReady="";
 }

 else{
    echo'No Results Yet';
    $resultNotReady="Results Not Yet Ready. Contact School Admin";

 }
?>
</span></td>





</tr>
<tr>
    <td><div style="padding-left:20px"><span class="nameTable"> <b>Student's Name: </b> <?php echo  $_SESSION['FName'];?> <?php echo  $_SESSION['MName'];?> <?php echo $_SESSION['LName'] ;?></span></div></td>
    <td><span class="nameTable"> <b>Term: </b> <?php echo $_SESSION['term'];?> Term</span></td>
    <td><span class="nameTable"> <b>Date of Birth: </b><?php echo $_SESSION['DOB'] ;?>  </span></td>
    <td><span class="nameTable"><b>Number in Class: </b> <?php echo  $classNumber;?></span></td>
    
    
    
    
    </tr>
    <tr>
        <td><div style="padding-left:20px"><span class="nameTable"> <b>Gender: </b> <?php echo $_SESSION['gender'];?></span></div></td>
        <td><span class="nameTable"> <b>Class:</b> <?php echo $_SESSION['class'];?></span></td>
        <td><span class="nameTable"> <b>All Students: </b><?php echo $allStudentNumber;?></span></td>
        <td><span class="nameTable"> <b>Total Average:</b>  <?php echo round($totalAverage, 2); ?></span></td>


        </tr>




        
            
</table>


                  
                   
                  

      

                   
         











<div id="container">
      
<?php



$ca3_totalrow='<td></td>';



if($result_marks_ca3 == 0){
  
  
  $ca3_totalrow="";
}

?>


					<table class="print table table-hover  table-striped table-bordered">
						<thead>
							<tr>
								<th><span class="printText">Subjects</span></th>
								
                <?php 
                 $ca1_th='<th><span class="printText">CA 1</span></th>';
                 
                 if($result_marks_ca1 == 0){
                  $ca1_th="";
                  
                  
                }
                else if($result_marks_ca1 > 0){
                  echo $ca1_th;
                 }
                 ?>

                 
                 <?php 
                 $ca2_th='<th><span class="printText">CA 2</span></th>';
                 
                 if($result_marks_ca2 == 0){
                  $ca2_th="";
                  
                  
                }
                else if($result_marks_ca2 > 0){
                  echo $ca2_th;
                 }
                 ?>
							


                 <?php 
                 $ca3_th='<th><span class="printText">CA 3</span></th>';
                 
                 if($result_marks_ca3 == 0){
                  $ca3_th="";
                  
                  
                }
                else if($result_marks_ca3 > 0){
                  echo $ca3_th;
                 }
                 ?>
								<th><span class="printText">Exam</span></th>
								<th><span class="printText">Total</span></th>
								<th><span class="printText">Average</span></th>
                <th><span class="printText">Grade</span></th>
                <th><span class="printText">Remark</span></th>
                <th><span class="printText">Subject Position</span></th>
								<th><span class="printText">Teacher</span></th>
							</tr>
						</thead>
						<tbody>
							


             

        <?php 
        

        $list_sub = $con->query("SELECT * FROM `registered_subjects` WHERE  School='$School' AND StudentReg ='$_SESSION[RegNum]' Order By subjectID ASC");
        while($row_subjects = $list_sub->fetch_array()){

         


 

        $result = mysqli_query($con, "SELECT * FROM `results` WHERE school_session='$_SESSION[school_session]' AND Term='$_SESSION[term]' AND class='$_SESSION[class]' AND  subjectID='$row_subjects[subjectID]' AND StudentReg ='$_SESSION[RegNum]' AND Publish ='Yes' ");
        $row_results = $result->fetch_array();


       



        include('Administration/include/comments.php');





        
       

          //$ave=$row_results['Total']/4;
      
        ?>
<tr class="row100">






								<td><b><span class="printText"><?php echo $row_subjects['subjectName'];?></span></b></td>

                <?php 
                   $ca1_td='<td><span class="printText"> '.$row_results['CA1'].'</span></td>';
                
                  if($result_marks_ca1 == 0){
                   
                    $ca1_td="";
                    
                  }
                  else if($result_marks_ca1 > 0){
                    echo $ca1_td;
                   }
                ?>
							


							
                <?php 
                   $ca2_td='<td><span class="printText"> '.$row_results['CA2'].'</span></td>';
                
                  if($result_marks_ca2 == 0){
                   
                    $ca2_td="";
                    
                  }
                  else if($result_marks_ca2 > 0){
                    echo $ca2_td;
                   }
                ?>



                <?php 
                   $ca3_td='<td><span class="printText"> '.$row_results['CA3'].'</span></td>';
                
                  if($result_marks_ca3 == 0){
                   
                    $ca3_td="";
                    
                  }
                  else if($result_marks_ca3 > 0){
                    echo $ca3_td;
                   }
                ?>

								<td><span class="printText"><?php echo  $row_results['Exam'];?></span></td>
								<td><span class="printText"><?php echo  $row_results['Total'];?></span></td>
								<td><span class="printText"><?php echo  $row_results['Average'];?></span></td>
                <td><span class="printText"><?php echo  $row_results['Grade'];?></span></td>
                <td><span class="printText"><?php echo  $row_results['Remark'];?></span></td>
                <td><span class="printText"><?php 
                  $check_res = $con->query("SELECT * FROM `results` WHERE school_session='$_SESSION[school_session]' AND Term='$_SESSION[term]' AND class='$_SESSION[class]' AND  subjectID='$row_subjects[subjectID]' AND Publish ='Yes' ORDER BY Average DESC ");
                 
                  $counter = 1; 
                  $rank = 1; 
                  
                
                  $prevScore = 0;
                  
                foreach( $check_res as $value){
                     
                      $score = $value['Average'];
                  
                      if ($prevScore != $score) 
                          $rank = $counter;
                          include('Administration/include/end.php');
                          
                     

                      if($_SESSION['RegNum'] == $value['StudentReg']){
                     
                      echo $rank.$end;
                      

                         
                   
                  }
                      $counter ++;
                      
                      
                      $prevScore = $score;
                  
                }
                  ?></span>
                </td>
                <td><span class="printText"><?php echo  $row_results['Teacher'];?></span></td>
              </tr>



             
              
              <?php
            
               



         }

       echo $resultNotReady;
    ?>
							


              <tr class="row100">




<td><strong><span class="printText">Total</strong></span></td>
<?php




$ca1_totalrow ='<td></td>';



if($result_marks_ca1 == 0){
  
  
  $ca1_totalrow ="";
}

else if($result_marks_ca1 > 0){
 echo $ca1_totalrow;
}
?>

<?php




$ca2_totalrow ='<td></td>';



if($result_marks_ca2 == 0){
  
  
  $ca2_totalrow ="";
}

else if($result_marks_ca2 > 0){
 echo $ca2_totalrow;
}
?>


<?php




$ca3_totalrow ='<td></td>';



if($result_marks_ca3 == 0){
  
  
  $ca3_totalrow ="";
}

else if($result_marks_ca3 > 0){
 echo $ca3_totalrow;
}
?>
<td></td>
<td><strong><span class="printText"><?php echo $totalRow['totalsummation'];?></span></strong></td>
<td><strong><span class="printText"><?php echo round($totalAverage, 2)?></span></strong></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
              
              
            </tbody>
            

          
          </table>
          


         
      
        
  <table class="keyGrades" style="border-top:1px solid #000; font-family: Times New Roman, Times, serif; font-size:5px; margin-top:20px;" class="rounded">

<tr>
<td class="text-justify">
  <b>Key to grades: </b>
  <?php echo $key_To_Grades;?>

</td>
</table>




  <table height="100" class="bottomTable" style="border:2px solid #000; font-family: Times New Roman, Times, serif; font-size:15px; padding-bottom:20px; ">

<tr>
  <th  style="padding-left:20px;"><span class="printText"> Form Teacher's Remark</span></th>
  <th><span class="printText">Form Teacher's Signature:</span></th>

  <th><span class="printText">Commandant's Comment:</span></th>

  <th><span class="printText">Stamp:</span></th>

</tr>
<tr>
    <td  style="padding-left:20px;"><span class="font-weight-bold printText3"> Name: <?php echo $teacher;?></span></td>
    <td><img src="Administration/images/signatures/<?php echo $signature; ?>" height="70" width="70" style=" margin-bottom:3%; margin-top:1%" class="rounded"/></td>
    <td><span class="font-weight-bold printText3">Name:  <?php echo $principalname;?>  </span> </td>
    <td><img src="images/<?php echo $school_stamp; ?>" height="70" width="70" style=" margin-bottom:3%" class="rounded"/></td>
    
    
    
    
    </tr>
    <tr>
        <td  style="padding-left:20px;"><span class="font-weight-bold printText3">Comments: <?php echo $teacherComment;?><?php echo $teacherCustomRemark;?></span></td>
        <td></td>
        <td><span class="font-weight-bold printText3">Comments: <?php echo  $commandantsComment;?> <?php //echo  $principalCustomRemark;?>  </span></td>
        <td><span class="font-weight-bold printText3">Date: <b><?php echo date("l-Y-m-d");?></b></span> </td>
        
        
        
        
        
        </tr>




        
            
    </table>
        
    
  </div>
  

  


	

<!--===============================================================================================-->	
	<script src="external/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="external/vendor/bootstrap/js/popper.js"></script>
	<script src="external/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="external/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="external/js/main.js"></script>

</body>
</html>

<?php unset($_SESSION['studentLoginstudentID']);?>