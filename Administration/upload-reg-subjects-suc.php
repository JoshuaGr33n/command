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


$pageActiveTag="All Students";
$currentPageTag="Import Subjects";



if($pageActiveTag="All Students"){

  
  $studentsExpand="is-expanded";
   $ExpandAdmin="";
   $ExpandResults="";
   $ExpandSiteManager="";
   $ExpandPinManager="";



}








if($currentPageTag="Import Subjects"){
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
  $updateSchoolDetailsCurrentPageTag="";
  $importRegSubjectCurrentPageTag="active";
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


if(empty($_FILES['import']['name'])){

  header("Location: upload-reg-subjects.php" );
  exit;
}






    if(isset($_POST['import_subjects'])){
        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if(!empty($_FILES['import']['name']) && in_array($_FILES['import']['type'],$file_mimes)){
            if(is_uploaded_file($_FILES['import']['tmp_name'])){   
                $csv_file = fopen($_FILES['import']['tmp_name'], 'r'); 
                $rows=1;
                while(($getData = fgetcsv($csv_file)) !== FALSE){
                  if(!empty($getData[0])){
                    if($rows++ !=1){
                                $get_students=mysqli_query($con, "SELECT * FROM `students`  WHERE RegNum='$getData[0]' ");
                                $row_student=mysqli_fetch_array($get_students);
                                $RegNumUpperCase=strtoupper($getData[0]);


                                if($getData[2]==""  )
                                {
                
                                  header("Location: upload-reg-subjects.php");
                                  exit;
                              
                              
                                 } 

                                

                                $subj1=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[2]' ");
                                $row_subj1=mysqli_fetch_array($subj1);
                                $subj2=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[3]' ");
                                $row_subj2=mysqli_fetch_array($subj2);
                                $subj3=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[4]' ");
                                $row_subj3=mysqli_fetch_array($subj3);
                                $subj4=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[5]' ");
                                $row_subj4=mysqli_fetch_array($subj4);
                                $subj5=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[6]' ");
                                $row_subj5=mysqli_fetch_array($subj5);
                                $subj6=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[7]' ");
                                $row_subj6=mysqli_fetch_array($subj6);
                                $subj7=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[8]' ");
                                $row_subj7=mysqli_fetch_array($subj7);
                                $subj8=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[9]' ");
                                $row_subj8=mysqli_fetch_array($subj8);
                                $subj9=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[10]' ");
                                $row_subj9=mysqli_fetch_array($subj9);


                                if($getData[2] !== $row_subj1['subjectName'])
                                {
                
                                  header("Location: upload-reg-subjects.php");
                                  exit;
                              
                              
                                 } 

                                
                                $subj10=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[11]' ");
                                $row_subj10=mysqli_fetch_array($subj10);
                                $subj11=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[12]' ");
                                $row_subj11=mysqli_fetch_array($subj11);
                                $subj12=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[13]' ");
                                $row_subj12=mysqli_fetch_array($subj12);
                                $subj13=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[14]' ");
                                $row_subj13=mysqli_fetch_array($subj13);
                                $subj14=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[15]' ");
                                $row_subj14=mysqli_fetch_array($subj14);
                                $subj15=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[16]' ");
                                $row_subj15=mysqli_fetch_array($subj15);
                                $subj16=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[17]' ");
                                $row_subj16=mysqli_fetch_array($subj16);
                                $subj17=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[18]' ");
                                $row_subj17=mysqli_fetch_array($subj17);
                                $subj18=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[19]' ");
                                $row_subj18=mysqli_fetch_array($subj18);

                                
                                $subj19=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[20]' ");
                                $row_subj19=mysqli_fetch_array($subj19);
                                $subj20=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[21]' ");
                                $row_subj20=mysqli_fetch_array($subj20);
                                $subj21=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[22]' ");
                                $row_subj21=mysqli_fetch_array($subj21);
                                $subj22=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[23]' ");
                                $row_subj22=mysqli_fetch_array($subj22);
                                $subj23=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[24]' ");
                                $row_subj23=mysqli_fetch_array($subj23);
                                $subj24=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[25]' ");
                                $row_subj24=mysqli_fetch_array($subj24);
                                $subj25=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[26]' ");
                                $row_subj25=mysqli_fetch_array($subj25);
                                $subj26=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[27]' ");
                                $row_subj26=mysqli_fetch_array($subj26);
                                $subj27=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectName='$getData[28]' ");
                                $row_subj27=mysqli_fetch_array($subj27);



                                
                                
                             $current_class = substr($row_student['Class'], 0, 5);
                                
                             if($current_class =="SSS 1"){

                              $School="Senior Secondary School 1";
                                  
                                  
                                  }
                            else{
                                
                                $current_class = substr($row_student['Class'], 0, 3);
                                
                                if($current_class =="JSS")
                                {
                                 $School="Junior Secondary School";
                                
                                }
                                
                                else if ($current_class =="SSS"){
                                
                                $School="Senior Secondary School";
                                
                                }

                                else{
                                  header("Location: upload-reg-subjects.php");
                                  exit;
                                }
                              }   
                             


                               




                          if ($row_student['RegNum']==$RegNumUpperCase){
                            $notexist="";


                                
                                $ck_row1=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj1[subjectName]' AND subjectID='$row_subj1[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row2=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj2[subjectName]' AND subjectID='$row_subj2[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row3=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj3[subjectName]' AND subjectID='$row_subj3[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row4=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj4[subjectName]' AND subjectID='$row_subj4[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row5=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj5[subjectName]' AND subjectID='$row_subj5[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row6=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj6[subjectName]' AND subjectID='$row_subj6[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row7=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj7[subjectName]' AND subjectID='$row_subj7[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row8=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj8[subjectName]' AND subjectID='$row_subj8[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row9=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj9[subjectName]' AND subjectID='$row_subj9[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");

                                $ck_row10=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj10[subjectName]' AND subjectID='$row_subj10[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row11=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj11[subjectName]' AND subjectID='$row_subj11[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row12=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj12[subjectName]' AND subjectID='$row_subj12[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row13=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj13[subjectName]' AND subjectID='$row_subj13[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row14=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj14[subjectName]' AND subjectID='$row_subj14[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row15=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj15[subjectName]' AND subjectID='$row_subj15[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row16=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj16[subjectName]' AND subjectID='$row_subj16[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row17=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj17[subjectName]' AND subjectID='$row_subj17[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row18=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj18[subjectName]' AND subjectID='$row_subj18[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");

                                $ck_row19=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj19[subjectName]' AND subjectID='$row_subj19[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row20=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj20[subjectName]' AND subjectID='$row_subj20[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row21=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj21[subjectName]' AND subjectID='$row_subj21[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row22=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj22[subjectName]' AND subjectID='$row_subj22[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row23=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj23[subjectName]' AND subjectID='$row_subj23[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row24=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj24[subjectName]' AND subjectID='$row_subj24[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row25=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj25[subjectName]' AND subjectID='$row_subj25[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row26=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj26[subjectName]' AND subjectID='$row_subj26[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                                $ck_row27=mysqli_query($con, "SELECT StudentID, StudentReg, subjectName, subjectID,School, current_class FROM  `registered_subjects` WHERE StudentID='$row_student[student_id]' AND StudentReg='$getData[0]'AND subjectName='$row_subj27[subjectName]' AND subjectID='$row_subj27[subjectID]' AND School='$School' AND current_class='$row_student[Class]' ");
                              

                                if(mysqli_num_rows($ck_row1) < 1 && mysqli_num_rows($ck_row2) < 1 && mysqli_num_rows($ck_row3) < 1 && mysqli_num_rows($ck_row4) < 1 && mysqli_num_rows($ck_row5) < 1 && mysqli_num_rows($ck_row6) < 1 && mysqli_num_rows($ck_row7) < 1 && mysqli_num_rows($ck_row8) < 1 && mysqli_num_rows($ck_row9) < 1 && mysqli_num_rows($ck_row10) < 1 && mysqli_num_rows($ck_row11) < 1&& mysqli_num_rows($ck_row12) < 1&& mysqli_num_rows($ck_row13) < 1&& mysqli_num_rows($ck_row14) < 1&& mysqli_num_rows($ck_row15) < 1&& mysqli_num_rows($ck_row16) < 1&& mysqli_num_rows($ck_row17) < 1&& mysqli_num_rows($ck_row18) < 1&& mysqli_num_rows($ck_row19) < 1&& mysqli_num_rows($ck_row20) < 1&& mysqli_num_rows($ck_row21) < 1&& mysqli_num_rows($ck_row22) < 1&& mysqli_num_rows($ck_row23) < 1 && mysqli_num_rows($ck_row24) < 1&& mysqli_num_rows($ck_row25) < 1&& mysqli_num_rows($ck_row26) < 1&& mysqli_num_rows($ck_row27) < 1)
                                {   

                                  


                              

                                if($getData[2] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj1[subjectName]','$row_subj1[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[3] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj2[subjectName]','$row_subj2[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[4] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj3[subjectName]','$row_subj3[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[5] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj4[subjectName]','$row_subj4[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[6] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj5[subjectName]','$row_subj5[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[7] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj6[subjectName]','$row_subj6[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[8] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj7[subjectName]','$row_subj7[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[9] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj8[subjectName]','$row_subj8[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[10] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj9[subjectName]','$row_subj9[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }




                                if($getData[11] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj10[subjectName]','$row_subj10[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[12] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj11[subjectName]','$row_subj11[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[13] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj12[subjectName]','$row_subj12[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[14] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj13[subjectName]','$row_subj13[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[15] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj14[subjectName]','$row_subj14[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[16] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj15[subjectName]','$row_subj15[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[17] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj16[subjectName]','$row_subj16[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[18] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj17[subjectName]','$row_subj17[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[19] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj18[subjectName]','$row_subj18[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }




                                if($getData[20] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj19[subjectName]','$row_subj19[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[21] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj20[subjectName]','$row_subj20[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[22] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj21[subjectName]','$row_subj21[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[23] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj22[subjectName]','$row_subj22[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[24] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj23[subjectName]','$row_subj23[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[25] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj24[subjectName]','$row_subj24[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[26] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj25[subjectName]','$row_subj25[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[27] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj26[subjectName]','$row_subj26[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }
                                if($getData[28] !="")
                                {
                                mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`, `StudentReg`, `student_name`, `School`, `current_class`) VALUES (NULL, '$row_subj27[subjectName]','$row_subj27[subjectID]','$row_student[student_id]','$RegNumUpperCase','$row_student[FirstName] $row_student[LastName]','$School','$row_student[Class]') ");
                                }






                                $success= ' <button  class="btn btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1">Imported Successfully!!</button>';


                                $uploadsuccessResult = mysqli_query($con, "SELECT * FROM  `registered_subjects` WHERE  School='$School' AND current_class='$row_student[Class]'");





                                $exist="";
                                }



                                







                                else{

                                  $success="";
                                  $exist='<button  class="btn btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1">Some files already exist</button>';

                                  $uploadsuccessResult = mysqli_query($con, "SELECT * FROM  `registered_subjects` WHERE School='$School' AND current_class='$row_student[Class]'");
                                }
                          }
                         else{
                           $notexist='<button  class="btn btn-warning font-weight-bold py-2 px-3 px-xxl-5 my-1">Some students subjects werent registered because their registration number doesnt exist. Cross check, correct and import them again</button>';

                          }

                           
                    }

                  } 
                   
                }

                
            fclose($csv_file);
            }
        } 
        else{
          
      
          header('Location: upload-reg-subjects.php?wrongformat=<button  class="btn btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1">Wrong Format, Upload as CSV</button>');
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
    <title>Import</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
      



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
  </head>
  <body class="app sidebar-mini">
    

          <?php 
// side bar and header
          include('include/nav_header.php');


        ?>


    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i>Registered Subjects</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <!--<li class="breadcrumb-item"></li>-->
          <li><a href="upload-reg-subjects.php" class="btn btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Back</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">


              <?php echo  $success;?>
              <?php echo  $exist;?>
              <?php echo $notexist;?>




              <table class="table table-bordered  table-striped" id="sampleTable">
                
                <thead>
                  <tr>
                  <!--<th><input type="checkbox" id="selectall"/> Select all</th>-->
                    <th>Registration Number</th>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Subject ID</th>
                    <th>School</th>
                    <th>Class</th>
                   
                  </tr>
                </thead>
                <tbody>
                 <?php
                 while ($uploadsuccessRow = mysqli_fetch_array($uploadsuccessResult))
                 {
               
                 
                 
                 
          
                 
                       
                 
                   ?>
                  <tr>
                   
                    <td><a href="student-details.php?studentID=<?php echo $uploadsuccessRow['StudentID']; ?>"> <?php echo $uploadsuccessRow['StudentReg'];?></a></td>
                    <td><?php echo $uploadsuccessRow['student_name'];?></td>
                    
                   
                    <td><?php echo $uploadsuccessRow['subjectName'];?></td>
                    <td><?php echo $uploadsuccessRow['subjectID'];?></td>
                    <td><?php echo $uploadsuccessRow['School'];?></td>
                    <td><?php echo $uploadsuccessRow['current_class'];?></td>
                   

                    
                   
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


