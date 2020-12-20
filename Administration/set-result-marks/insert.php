<?php  
 //database connection
include('../include/db2.php');
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $Sno = mysqli_real_escape_string($con, $_POST["sno"]);
      $ca1 = mysqli_real_escape_string($con, $_POST["ca1"]); 
      $ca2 = mysqli_real_escape_string($con, $_POST["ca2"]);  
      $ca3 = mysqli_real_escape_string($con, $_POST["ca3"]);  
      $exam = mysqli_real_escape_string($con, $_POST["exam"]);   
      $school = mysqli_real_escape_string($con, $_POST["school"]);   
      $error="";



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




      $check_row_query = $con->query("SELECT School, session, term FROM result_marks WHERE School='$school' AND session='$current_session' AND term='$current_term' ");
      
      
      
      
      
      
         
        ?>

<?php
$all_total=$ca1+$ca2+$ca3+$exam;
      if($Sno != '')  
      {  
           
          $sql="UPDATE result_marks SET CA1 =?, CA2 = ?, CA3 = ?, Exam = ? WHERE Sno =?";
          $updateQuery = $con->prepare($sql); 
           
           
          
       
         
           $updateQuery->bind_param("iiiii", $ca1, $ca2, $ca3, $exam, $Sno); 
          
           if($all_total == 100){
           $updateQuery->execute();
           $message = 'Updated'; 
          
           }
           else if($all_total > 100){

            $error="<span class='text-danger'>Total Scores can not be greater than 100</span>";
          }
          else if($all_total < 100){

               $error="<span class='text-danger'>Total Scores can not be lesser than 100</span>";
             }

           
      }  
      else  
      {  
       
          $sql = "  
        INSERT INTO result_marks(Sno,School, session, term, CA1, CA2, CA3, Exam)  
        VALUES(NULL, '$school','$current_session','$current_term','$ca1', '$ca2', '$ca3', '$exam')
        ";  
        $insertQuery = $con->prepare($sql); 

        //$insertQuery->bind_param("iiiiiiii", NULL, $school,$current_session,$current_term,$ca1, $ca2, $ca3, $exam);

        if(mysqli_num_rows($check_row_query) < 1){
          if($all_total == 100){

        $insertQuery->execute();
        $message = 'Added Record Successfully'; 
          }
           else if($all_total > 100){

            $error="<span class='text-danger'>Total Scores can not be greater than 100</span>";
          }
          else if($all_total < 100){

               $error="<span class='text-danger'>Total Scores can not be lesser than 100</span>";
             }

        }
     }
        





      if($sql)  
      {  
        $output .= '<label class="text-success">' . $message . '</label>';  

                            
       
       


        
         
           $output .= ' <table class="table table-bordered  table-striped" id="sampleTable" style="width:60%; margin-left:18%">
                
           <thead>
             <tr>
              
               <th></th>
               <th>CA 1</th>
               <th>CA 2</th>
               <th>CA 3</th>
               <th>Exam</th>
               <th></th>
               
             </tr>
           </thead>
           <tbody>'
           ;
          
               $results =$con->prepare("SELECT Sno, School, CA1, CA2, CA3, Exam FROM result_marks 
               WHERE 
               session='$current_session' 
               AND term='$current_term'
              
              

              
             ");
        $results->execute();                           
        $results->Store_result();                      
        $results->bind_result($sno, $schoolx, $ca1x, $ca2x, $ca3x, $examx);
       while($results->fetch()) {
            $output .= '  
            <tr>  
                 <td>' . $schoolx . '</td>  
                 <td>' . $ca1x . '</td>  
                 <td>' . $ca2x . '</td>  
                 <td>' . $ca3x . '</td>  
                 <td>' . $examx . '</td>  
                 <td><input type="button" name="edit" value="Edit" id="'.$sno .'" class="btn btn-primary btn-xs edit_data" /></td>  
                 
            </tr>  
            </tbody>
       ';  
  }  
  $output .= '</table>';  
}  
echo $output;
echo $error;  

}  
 ?>
 