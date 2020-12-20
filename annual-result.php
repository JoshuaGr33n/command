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


if($_SESSION['term'] !="Third" && $_SESSION['annualResult']!="Annual Result")
{
header("Location: index.php" );
exit;
}



?>










<?php 



include('Administration/include/db.php');



$student_score=mysqli_query($con, "SELECT SUM(Average) AS Average, StudentID FROM `results` where class ='".$_SESSION['class']."' and school_session = '".$_SESSION['school_session']."'  GROUP BY StudentID ");
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

//check if number of logins exceeds the allowed time
if($_SESSION['count'] >= $pin_number_of_times)
{
 session_destroy();
 header("Location: index.php?message=This Pin Is no longer valid");
}
?>














<?php

//total average


        $Query = "SELECT StudentReg, SUM(Total) AS TotalTotal, SUM(Average) AS totalaverage FROM results where Class ='".$_SESSION['class']."' AND school_session ='".$_SESSION['school_session']."'  AND StudentReg ='".$_SESSION['RegNum']."' AND Publish='Yes'
        GROUP BY StudentReg   ORDER BY totalaverage DESC";
        $Result = mysqli_query($con, $Query);
        $Row = mysqli_fetch_array($Result);
        $totalAverage=$Row['TotalTotal']/4;
	
?>



<?php

//summation of term total
        $firstTermTotalQuery = "SELECT StudentReg, SUM(Total) AS firstTermTotalSummation FROM results where Class ='".$_SESSION['class']."' And school_session ='".$_SESSION['school_session']."' AND Term ='First' AND StudentReg ='".$_SESSION['RegNum']."'
        AND Publish ='Yes'
        GROUP BY StudentReg   ORDER BY firstTermTotalSummation DESC";
        $firstTermTotalResult = mysqli_query($con, $firstTermTotalQuery);
        $firstTermTotalRow = mysqli_fetch_array($firstTermTotalResult); 
        $firstTermTotalRow['firstTermTotalSummation'];
  


        $secondTermTotalQuery = "SELECT StudentReg, SUM(Total) AS secondTermTotalSummation FROM results where Class ='".$_SESSION['class']."' And school_session ='".$_SESSION['school_session']."' AND Term ='Second' AND StudentReg ='".$_SESSION['RegNum']."'
        AND Publish ='Yes'
        GROUP BY StudentReg   ORDER BY secondTermTotalSummation DESC";
        $secondTermTotalResult = mysqli_query($con, $secondTermTotalQuery);
        $secondTermTotalRow = mysqli_fetch_array($secondTermTotalResult); 
        $secondTermTotalRow['secondTermTotalSummation'];


        $thirdTermTotalQuery = "SELECT StudentReg, SUM(Total) AS thirdTermTotalSummation FROM results where Class ='".$_SESSION['class']."' And school_session ='".$_SESSION['school_session']."' AND Term ='Third' AND StudentReg ='".$_SESSION['RegNum']."'
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
//display number of login sessions
$LoginCountQuery = "SELECT * FROM pinlogin where PinCode = '".$_SESSION['pinCode']."'  ";
$LoginCountResult = mysqli_query($con, $LoginCountQuery);

// Loop through each row, outputting the login and password
//while ($test = @mysqli_fetch_array($result, MYSQL_ASSOC)) PHP 5

while ($LoginCountRow = @mysqli_fetch_assoc($LoginCountResult))
{
$LoginCount = $LoginCountRow['LoginCount'];





}			




//$sql = "select COUNT(StudentID) class from results where class ='".$_SESSION['class']."' and school_session = '".$_SESSION['school_session']."' and Term = '".$_SESSION['term']."'
//GROUP BY  subjectID";
$sql="SELECT COUNT(countable.StudentReg) as totalClass FROM (SELECT DISTINCT StudentReg FROM `results` WHERE class ='".$_SESSION['class']."' and school_session = '".$_SESSION['school_session']."') as countable";
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

$resumptionDateQuery = "SELECT * FROM resumption_date WHERE term='Third' AND session='$_SESSION[school_session]'";
$resumptionDateResult = mysqli_query($con, $resumptionDateQuery);

$resumptionDaterow = mysqli_fetch_array($resumptionDateResult);
$r_date = $resumptionDaterow['date'];
?>



<?php 



	

	
$teacherQuery = "SELECT FormTeacher FROM classes where className ='".$_SESSION['class']."'";
$teacherResult = mysqli_query($con, $teacherQuery);

$teacherRow = mysqli_fetch_array($teacherResult);

$teacher = $teacherRow['FormTeacher'];









?>


<?php
  



 $principalnameQuery = "SELECT * FROM administration where privileged_Status ='Principal'";
 $principalnameResult = mysqli_query($con, $principalnameQuery);

 $principalnameRow = mysqli_fetch_array($principalnameResult);
$principalname = $principalnameRow['First_Name'] .' ' .$principalnameRow['Last_Name'] ;
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



	

	
$t_remarkQuery = "SELECT * FROM remark WHERE name ='Teacher' AND session ='".$_SESSION['school_session']."' AND class='".$_SESSION['class']."' AND term='Annual' AND StudentID='".$_SESSION['studentID'] ."'";
$t_remarkResult = mysqli_query($con, $t_remarkQuery);

$t_remarkRow = mysqli_fetch_array($t_remarkResult);

$teacherCustomRemark = $t_remarkRow['remark'];













?>

<?php 


$classPromotionQuery = "SELECT * FROM class_promotion WHERE Promote_From= '".$_SESSION['class']."'";
$classPromotionResult = mysqli_query($con, $classPromotionQuery);

$classPromotionrow = mysqli_fetch_array($classPromotionResult);




$promote_from = $classPromotionrow['Promote_From'];
$promote_to = $classPromotionrow['Promote_To'];






	

	
$promotionQuery = "SELECT Promotion_Status FROM results where Class ='".$_SESSION['class']."' And school_session ='".$_SESSION['school_session']."' AND StudentReg ='".$_SESSION['RegNum']."'
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
//first term
     $result_marks_first_query= $con->prepare("SELECT CA1,CA2,CA3,Exam FROM result_marks WHERE School='$results_marks_School' AND session ='$_SESSION[school_session]' AND term='First' ");
     $result_marks_first_query->execute();                          
     $result_marks_first_query->Store_result();                      
     $result_marks_first_query->bind_result($result_marks_first_ca1,$result_marks_first_ca2,$result_marks_first_ca3,$result_marks_first_exam);  
     $result_marks_first_query->fetch();

//second term
     $result_marks_second_query= $con->prepare("SELECT CA1,CA2,CA3,Exam FROM result_marks WHERE School='$results_marks_School' AND session ='$_SESSION[school_session]' AND term='Second' ");
     $result_marks_second_query->execute();                          
     $result_marks_second_query->Store_result();                      
     $result_marks_second_query->bind_result($result_marks_second_ca1,$result_marks_second_ca2,$result_marks_second_ca3,$result_marks_second_exam);  
     $result_marks_second_query->fetch();

//third term
     $result_marks_third_query= $con->prepare("SELECT CA1,CA2,CA3,Exam FROM result_marks WHERE School='$results_marks_School' AND session ='$_SESSION[school_session]' AND term='Third' ");
     $result_marks_third_query->execute();                          
     $result_marks_third_query->Store_result();                      
     $result_marks_third_query->bind_result($result_marks_third_ca1,$result_marks_third_ca2,$result_marks_third_ca3,$result_marks_third_exam);  
     $result_marks_third_query->fetch();
     
?>









<?php include('Administration/include/annual-results-grading.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Annual Result <?php echo $_SESSION['school_session'];?>:: <?php echo  $_SESSION['FName'];?> <?php echo $_SESSION['LName'] ;?></title>
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




.logo{font-family: Impact, Charcoal, sans-serif; font-size:235%; margin-left:5%; }
.logo2{font-family: Impact, Charcoal, sans-serif;  display:block;font-size:120%; margin-left:10% }
.print{font-family: Impact, Charcoal, sans-serif; width:20%; padding-left:20%; }
 
 .column100 {font-family: Impact, Charcoal, sans-serif; width:10%; padding:7px; color:#000}
 .row100 {font-family: Impact, Charcoal, sans-serif; width:10%; padding:50%; }
 .appear {display:none; }
 .commentTable{border:2px solid #000; font-family: Times New Roman, Times, serif; }
 .commentTable2{border-top:1px solid #000; font-family: Times New Roman, Times, serif;}
 .printText{color:#000;}
 .printText2{color:#000;  font-size:100%;}


 #container{
  
   width:100%;
   margin-top:30px;
  
}
 .table{
        
        width:100%;
        
      
       

    }

}
@media screen {


 .logo{font-family: Impact, Charcoal, sans-serif; font-size:300%; margin-left:10%;}
 .logo2{font-family: Impact, Charcoal, sans-serif;  display:block;font-size:120%; margin-left:25% }
 .commentTable{border:2px solid #000; font-family: Times New Roman, Times, serif; font-size:15px; padding-bottom:20px; margin-top:10px}
 .commentTable2{border-top:1px solid #000; font-family: Times New Roman, Times, serif; font-size:5px; margin-top:10px}


 .table{
        
        width:100%;
        margin-top:30px;
        border:solid 5px #232228;

    }
  
    th{width:5%;background-color:#232228; color:#fff}

    #container{
  margin:auto;
   width:90%;
}


}

@media only screen and (max-width: 800px) {
  .logo{font-family: Impact, Charcoal, sans-serif; font-size:25px; margin-left:30%; display:block }
.logo2{font-family: Impact, Charcoal, sans-serif; font-size:10px; margin-left:30%; display:block }
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
  <td><span class="logo">COMMAND SECONDARY SCHOOL, ABAKALIKI</span><br/><span style="font-size:120%; margin-left:36%"  class="logo2"><i>...DISCIPLINE AND KNOWLEGE</i></span></td>
    <td  rowspan="2"><img src="Administration/images/student-passport/<?php echo $passport;?>" height="60" width="60" style="margin-left:20%;border:2px solid #000" class="rounded"/></td>
    <td><li class="breadcrumb-item active"><button onclick="window.print()" class="btn btn-sm btn-success appear printbutton">Print</button></li></td>
   
  </tr>

  <tr>
    <td style="width:50%"></td>
   
    <td><span class="carduse">Card Use: <strong><?php echo $LoginCount;?>/<?php echo $pin_number_of_times;?></strong></span><br/> <span class="carduse">Resumption Date: </span><span class="carduse"> <strong><?php echo $r_date;?></strong><br/> <a class="text-danger appear" href="logout.php?logout=1" style="margin-left:60%;"> <strong>Logout</strong></a></span></td>
    
  </tr>
</table>

<table height="100" style="border-bottom:2px solid #000; font-family: Times New Roman, Times, serif; font-size:13px">

<tr>
<td>
<div style="padding-left:20px"><b>Reg Number: </b> <?php echo $_SESSION['RegNum'];?></div>
</td>
<td><b>Session: </b> <?php echo $_SESSION['school_session'];?></td>
<td><b>Sport House: </b> <?php echo $_SESSION['sHouse'];?></td>
<td><b>Annual Position in Class:</b> <?php if($Row['totalaverage']!=""){

echo get_position(implode(",",$student_data), round($Row['totalaverage'])); 

$resultNotReady="";
 }

 else{
    echo'No Results Yet';
    $resultNotReady="Results Not Yet Ready. Contact School Admin";

 }
  ?></td>





</tr>
<tr>
    <td><div style="padding-left:20px"><b>Student's Name: </b> <?php echo  $_SESSION['FName'];?> <?php echo  $_SESSION['MName'];?> <?php echo $_SESSION['LName'] ;?></div></td>
    <td><b>Annual Result for: </b>  <strong><?php echo $_SESSION['school_session'];?></strong></td>
    <td><b>Date of Birth: </b><?php echo $_SESSION['DOB'] ;?>  </td>
    <td><b>Number in Class: </b> <?php echo  $classNumber;?></td>
    
    
    
    
    </tr>
    <tr>
        <td><div style="padding-left:20px"><b>Gender: </b> <?php echo $_SESSION['gender'];?></div></td>
        <td><b>Class:</b> <?php echo $_SESSION['class'];?></td>
        <td><b>All Students: </b><?php echo $allStudentNumber;?></td>
        <td><b>Total Average:</b> <?php echo round($Row['totalaverage'], 2); 

                     

                      
                      
                      
                      ?>
                      
                      

                      
                      
                    
                   </td>
        
        
        
        
        
        </tr>




        
            
    </table>










<div id = "container">
                <?php
                //first term
                 if($result_marks_first_ca1 == 0 && $result_marks_first_ca2 == 0 && $result_marks_first_ca3 == 0 ){
                  $row_number_first_term = 2;
                 }
                  
                  
                
                else if($result_marks_first_ca1 > 0 && $result_marks_first_ca2 > 0 && $result_marks_first_ca3 > 0 ){
                  $row_number_first_term = 5;
                }
                  
                  
                
                else  if($result_marks_first_ca1 == 0 && $result_marks_first_ca2 == 0) {
                  $row_number_first_term = 3;
                 }

                 else  if($result_marks_first_ca1 == 0 && $result_marks_first_ca3 == 0) {
                  $row_number_first_term = 3;
                 }

                 else  if($result_marks_first_ca2 == 0 && $result_marks_first_ca3 == 0) {
                  $row_number_first_term = 3;
                 }

                 else  if($result_marks_first_ca1 == 0) {
                  $row_number_first_term = 4;
                 }
                 else  if($result_marks_first_ca2 == 0) {
                  $row_number_first_term = 4;
                 }
                 else  if($result_marks_first_ca3 == 0) {
                  $row_number_first_term = 4;
                 }
                ?>






                 <?php
                 //second term
                 if($result_marks_second_ca1 == 0 && $result_marks_second_ca2 == 0 && $result_marks_second_ca3 == 0 ){
                  $row_number_second_term = 2;
                 }
                  
                  
                
                else if($result_marks_second_ca1 > 0 && $result_marks_second_ca2 > 0 && $result_marks_second_ca3 > 0 ){
                  $row_number_second_term = 5;
                }
                  
                  
                
                else  if($result_marks_second_ca1 == 0 && $result_marks_second_ca2 == 0) {
                  $row_number_second_term = 3;
                 }

                 else  if($result_marks_second_ca1 == 0 && $result_marks_second_ca3 == 0) {
                  $row_number_second_term = 3;
                 }

                 else  if($result_marks_second_ca2 == 0 && $result_marks_second_ca3 == 0) {
                  $row_number_second_term = 3;
                 }

                 else  if($result_marks_second_ca1 == 0) {
                  $row_number_second_term = 4;
                 }
                 else  if($result_marks_second_ca2 == 0) {
                  $row_number_second_term = 4;
                 }
                 else  if($result_marks_second_ca3 == 0) {
                  $row_number_second_term = 4;
                 }
                ?>





                 <?php
                 //third term
                 if($result_marks_third_ca1 == 0 && $result_marks_third_ca2 == 0 && $result_marks_third_ca3 == 0 ){
                  $row_number_third_term = 2;
                 }
                  
                  
                
                else if($result_marks_third_ca1 > 0 && $result_marks_third_ca2 > 0 && $result_marks_third_ca3 > 0 ){
                  $row_number_third_term = 5;
                }
                  
                  
                
                else  if($result_marks_third_ca1 == 0 && $result_marks_third_ca2 == 0) {
                  $row_number_third_term = 3;
                 }

                 else  if($result_marks_third_ca1 == 0 && $result_marks_third_ca3 == 0) {
                  $row_number_third_term = 3;
                 }

                 else  if($result_marks_third_ca2 == 0 && $result_marks_third_ca3 == 0) {
                  $row_number_third_term = 3;
                 }

                 else  if($result_marks_third_ca1 == 0) {
                  $row_number_third_term = 4;
                 }
                 else  if($result_marks_third_ca2 == 0) {
                  $row_number_third_term = 4;
                 }
                 else  if($result_marks_third_ca3 == 0) {
                  $row_number_third_term = 4;
                 }
                ?>



      


					<table  class="print table table-hover  table-striped table-bordered">
						<thead>
							<tr>
								<th rowspan="2"><span class="printText2">Subjects</span></th>
                 <th  colspan="<?php echo $row_number_first_term;?>"><span class="printText2">First Term</span></th>
								<th  colspan="<?php echo $row_number_second_term;?>"><span class="printText2">Second Term</span></th>
                 <th  colspan="<?php echo $row_number_third_term;?>"><span class="printText2">Third Term</span></th>
                <th  rowspan="2"><span class="printText2">Annual Result</span></th>
                <th   rowspan="2"><span class="printText2">Subject Position</span></th>
                <th  rowspan="2"><span class="printText2">Grade</span></th>
                <th  rowspan="2"><span class="printText2">Remark</span></th>

              </tr>

								
                <tr>
                <?php 
                 $ca1_th='<th><span class="printText2">CA1</span></th>';
                 $ca2_th='<th><span class="printText2">CA2</span></th>';
                 $ca3_th='<th><span class="printText2">CA3</span></th>';
                 ?>
                 <?php
                 //first term
                 
                 if($result_marks_first_ca1 == 0){
                  $ca1_th="";
                  
                  
                }
                else {
                  echo $ca1_th;
                 }
                 
                
                 
                 if($result_marks_first_ca2 == 0){
                  $ca2_th="";
                  
                  
                }
                else {
                  echo $ca2_th;
                 }
                
                 
                 
                 if($result_marks_first_ca3 == 0){
                  $ca3_th="";
                  
                  
                }
                else {
                  echo $ca3_th;
                 }
                 ?>
                  <th><span class="printText2">Exam</span></th>
                  <th><span class="printText2">Total</span></th>




                  <?php
                  //second term
                 
                  if($result_marks_second_ca1 == 0){
                    $ca1_th="";
                    
                    
                  }
                  else {
                    echo $ca1_th;
                   }
                   
                  
                   
                   if($result_marks_second_ca2 == 0){
                    $ca2_th="";
                    
                    
                  }
                  else {
                    echo $ca2_th;
                   }
                  
                   
                   
                   if($result_marks_second_ca3 == 0){
                    $ca3_th="";
                    
                    
                  }
                  else {
                    echo $ca3_th;
                   }
                 ?>
                  <th><span class="printText2">Exam</span></th>
                  <th><span class="printText2">Total</span></th>
                 
                  



                 <?php
                  //third term
                 
                  if($result_marks_third_ca1 == 0){
                    $ca1_th="";
                    
                    
                  }
                  else {
                    echo $ca1_th;
                   }
                   
                  
                   
                   if($result_marks_third_ca2 == 0){
                    $ca2_th="";
                    
                    
                  }
                  else {
                    echo $ca2_th;
                   }
                  
                   
                   
                   if($result_marks_third_ca3 == 0){
                    $ca3_th="";
                    
                    
                  }
                  else {
                    echo $ca3_th;
                   }
                 ?>

                 
                  <th><span class="printText2">Exam</span></th>
                  <th><span class="printText2">Total</span></th>
      
        
                </tr>
							
						</thead>
						<tbody>
							

               
             

        <?php 
        

        $list_sub = $con->query("SELECT * FROM `registered_subjects` WHERE School='$School' AND StudentReg ='$_SESSION[RegNum]' Group By subjectID Order By subjectID ASC");
        while($row_subjects = $list_sub->fetch_array()){
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
        
        
        FROM results WHERE school_session='$_SESSION[school_session]'  AND class='$_SESSION[class]' AND  subjectID='$row_subjects[subjectID]'AND StudentReg ='$_SESSION[RegNum]' AND Publish='Yes'
       
        ORDER BY results.Sno, results.StudentID DESC");
        $row_results = $result->fetch_array();
        $allTotalScoreAverage=$row_results['allTermScoreTotal']/3;


       



          ?>
<tr>




                <td><b><?php echo $row_subjects['subjectName'];?></b></td>



                
                <?php 
                //first term
                   $ca1_first_td='<td><span class="printText"> '.$row_results['FirstTermCA1'].'</span></td>';
                
                  if($result_marks_first_ca1 == 0){
                   
                    $ca1_first_td="";
                    
                  }
                  else if($result_marks_first_ca1 > 0){
                    echo $ca1_first_td;
                   }
                ?>
                 <?php 
                   $ca2_first_td='<td><span class="printText"> '.$row_results['FirstTermCA2'].'</span></td>';
                
                  if($result_marks_first_ca2 == 0){
                   
                    $ca2_first_td="";
                    
                  }
                  else if($result_marks_first_ca2 > 0){
                    echo $ca2_first_td;
                   }
                ?>
                 <?php 
                   $ca3_first_td='<td><span class="printText"> '.$row_results['FirstTermCA3'].'</span></td>';
                
                  if($result_marks_first_ca3 == 0){
                   
                    $ca3_first_td ="";
                    
                  }
                  else if($result_marks_first_ca3 > 0){
                    echo $ca3_first_td;
                   }
                ?>

							
							

                 
                 <td><span class="printText"><?php echo  $row_results['FirstTermExam'];?></span></td>
                 <td><strong><?php echo  $row_results['FirstTermTotal'];?></strong></td>
               
                 



                










                 <?php 
                 //second term
                   $ca1_second_td='<td><span class="printText2"> '.$row_results['SecondTermCA1'].'</span></td>';
                
                  if($result_marks_second_ca1 == 0){
                   
                    $ca1_second_td="";
                    
                  }
                  else if($result_marks_second_ca1 > 0){
                    echo  $ca1_second_td;
                   }
                ?>
                 <?php 
                   $ca2_second_td='<td><span class="printText2"> '.$row_results['SecondTermCA2'].'</span></td>';
                
                  if($result_marks_second_ca2 == 0){
                   
                    $ca2_second_td="";
                    
                  }
                  else if($result_marks_second_ca2 > 0){
                    echo $ca2_second_td;
                   }
                ?>
                 <?php 
                   $ca3_second_td='<td><span class="printText2"> '.$row_results['SecondTermCA3'].'</span></td>';
                
                  if($result_marks_second_ca3 == 0){
                   
                    $ca3_second_td ="";
                    
                  }
                  else if($result_marks_second_ca3 > 0){
                    echo $ca3_second_td;
                   }
                ?>

                 
                 <td><span class="printText2"><?php echo  $row_results['SecondTermExam'];?></span></td>
                 <td><strong><?php echo  $row_results['SecondTermTotal'];?></strong></td>
               
                






                 
                 
                 
                 
                 
                 <?php 
                 //third term
                   $ca1_third_td='<td><span class="printText"> '.$row_results['ThirdTermCA1'].'</span></td>';
                
                  if($result_marks_third_ca1 == 0){
                   
                    $ca1_third_td="";
                    
                  }
                  else if($result_marks_third_ca1 > 0){
                    echo  $ca1_third_td;
                   }
                ?>
                 <?php 
                   $ca2_third_td='<td><span class="printText"> '.$row_results['ThirdTermCA2'].'</span></td>';
                
                  if($result_marks_third_ca2 == 0){
                   
                    $ca2_third_td="";
                    
                  }
                  else if($result_marks_third_ca2 > 0){
                    echo $ca2_third_td;
                   }
                ?>
                 <?php 
                   $ca3_third_td='<td><span class="printText"> '. $row_results['ThirdTermCA3'].'</span></td>';
                
                  if($result_marks_third_ca3 == 0){
                   
                    $ca3_third_td ="";
                    
                  }
                  else if($result_marks_third_ca3 > 0){
                    echo $ca3_third_td;
                   }
                ?>







                
                
                 <td><span class="printText"><?php echo  $row_results['ThirdTermExam'];?></span></td>
                 <td><strong><?php echo  $row_results['ThirdTermTotal'];?></strong></td>



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
          
                



                  <td><span class="printText"><?php echo  number_format($allTotalScoreAverage, 2);?></span></td>
                  <td><span class="printText"> <?php 
                  $check_res = $con->query("SELECT *, SUM(Average) AS Sum_Average FROM `results` WHERE school_session='$_SESSION[school_session]' AND class='$_SESSION[class]' AND  subjectID='$row_subjects[subjectID]' AND Publish ='YES'  GROUP BY StudentReg ORDER BY  Sum_Average DESC ");
               
                  $counter = 1; 
                  $rank = 1;
                  
                  
                  $prevScore = 0;
                  
                foreach( $check_res as $value){
                      
                      $score = $value['Sum_Average'];
                  
                      if ($prevScore != $score) 
                          $rank = $counter;
                          include('Administration/include/end.php');
                      

                      if($_SESSION['RegNum'] == $value['StudentReg']){
                    
                      echo $rank.$end;
                     
                  }
                      $counter ++; 
                      
                     
                      $prevScore = $score;
                  
                }
                  ?></span></td>
                 <td><?php echo $sch_grade['grade'];?></td>
                 <td><?php echo $sch_grade['remark'];?></td>




		</tr>
              
              <?php
            
        }

        echo $resultNotReady;

        

    ?>
						

            <tr>




<td><b>Total</b></td>
                 <?php
                $ca1_first_totalrow='<td></td>';
                
                if($result_marks_first_ca1 == 0){
                 
                  $ca1_first_totalrow ="";
                  
                }
                else if($result_marks_first_ca1 > 0){
                  echo $ca1_first_totalrow;
                 }
                  ?>


                 <?php
                $ca2_first_totalrow='<td></td>';
                
                if($result_marks_first_ca2 == 0){
                 
                  $ca2_first_totalrow ="";
                  
                }
                else if($result_marks_first_ca1 > 0){
                  echo $ca2_first_totalrow;
                 }
                  ?>


                  <?php
                $ca3_first_totalrow='<td></td>';
                
                if($result_marks_first_ca3 == 0){
                 
                  $ca3_first_totalrow ="";
                  
                }
                else if($result_marks_first_ca3 > 0){
                  echo $ca3_first_totalrow;
                 }
                  ?>
                  <td></td>
 
 
 <td><strong><?php echo $firstTermTotalRow['firstTermTotalSummation'];?></strong></td>

 




             <?php
                $ca1_second_totalrow='<td></td>';
                
                if($result_marks_second_ca1 == 0){
                 
                  $ca1_second_totalrow ="";
                  
                }
                else if($result_marks_second_ca1 > 0){
                  echo $ca1_second_totalrow;
                 }
                  ?>


                 <?php
                $ca2_second_totalrow='<td></td>';
                
                if($result_marks_second_ca2 == 0){
                 
                  $ca2_second_totalrow ="";
                  
                }
                else if($result_marks_second_ca1 > 0){
                  echo $ca2_second_totalrow;
                 }
                  ?>


                  <?php
                $ca3_second_totalrow='<td></td>';
                
                if($result_marks_second_ca3 == 0){
                 
                  $ca3_second_totalrow ="";
                  
                }
                else if($result_marks_second_ca3 > 0){
                  echo $ca3_second_totalrow;
                 }
                  ?>
                  <td></td>
 
 <td><strong><?php echo $secondTermTotalRow['secondTermTotalSummation'];?></strong></td>





                 <?php
                $ca1_third_totalrow='<td></td>';
                
                if($result_marks_third_ca1 == 0){
                 
                  $ca1_third_totalrow ="";
                  
                }
                else if($result_marks_third_ca1 > 0){
                  echo $ca1_third_totalrow;
                 }
                  ?>


                 <?php
                $ca2_third_totalrow='<td></td>';
                
                if($result_marks_third_ca2 == 0){
                 
                  $ca2_third_totalrow ="";
                  
                }
                else if($result_marks_third_ca2 > 0){
                  echo $ca2_third_totalrow;
                 }
                  ?>


                  <?php
                $ca3_third_totalrow='<td></td>';
                
                if($result_marks_third_ca3 == 0){
                 
                  $ca3_third_totalrow ="";
                  
                }
                else if($result_marks_third_ca3 > 0){
                  echo $ca3_third_totalrow;
                 }
                  ?>
                  <td></td>
                 
 <td><strong><?php echo $thirdTermTotalRow['thirdTermTotalSummation'];?></strong></td>






 

  <td><strong><?php echo round($totalAverageSummation, 2);?></strong></td>
  <td></td>
  <td></td>
  <td></td>
  
  




</tr>
              
            </tbody>
            

          
          </table>
          


         
       
        
        <table height=""  class="commentTable2 rounded">

<tr>
<td style="padding-left:120px;font-size:12px;" class="text-justify">
  <b>Key to grades: </b>
  <?php echo $key_To_Grades;?>

</td>
</table>




  <table height="100" class="commentTable">

  <tr>
  <th  style="padding-left:20px;"> <span class="printText2">Form Teacher's Remark:</span></th>
  <th><span class="printText2">Form Teacher's Signature:</span></th>

  <th><span class="printText2">Principal's Comment:</span></th>

  <th><span class="printText2">Stamp:</span></th>

</tr>
<tr>
    <td  style="padding-left:20px;"><span class="font-weight-bold printText2"><b> Name:</b> <?php echo $teacher;?></span></td>
    <td><img src="Administration/images/signatures/<?php echo $signature; ?>" height="70" width="70" style=" margin-bottom:3%; margin-top:1%" class="rounded"/></td>
    <td><span class="font-weight-bold printText2"> <b>Name: </b><?php echo $principalname;?>  </span> </td>
    <td><img src="images/<?php echo $school_stamp; ?>" height="70" width="70" style=" margin-bottom:3%" class="rounded"/></td>
    
    
    
    
    </tr>
    <tr>
        <td  style="padding-left:20px;"><span class="font-weight-bold printText2"><b>Comments:</b> <strong><?php echo $teacherComment;?></strong><strong><?php echo $teacherCustomRemark;?></strong></span></td>
        <td></td>
        <td><span class="font-weight-bold printText2"><b>Comments: </b><?php echo  $principal_promotion_comment;?> <?php //echo  $principalCustomRemark;?>  </span></td>
        <td><span class="font-weight-bold printText2">Date: <b><?php echo date("l-Y-m-d");?></b> </span></td>
        
        
        
        
        
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

