<?php  
 if(isset($_POST["sno"]))  
 {  
      $output = '';  
      $con = mysqli_connect("localhost", "root", "", "command_school"); 
      $query  = "SELECT * FROM result_marks WHERE Sno = '" . $_POST["sno"] . "'";
      $result = mysqli_query($con, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-striped">';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '  
                <tr>  
                     <td width="30%"><label>Name</label></td>  
                     <td width="70%">' . $row["CA1"] . '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Address</label></td>  
                     <td width="70%">' . $row["CA2"] . '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Gender</label></td>  
                     <td width="70%">' . $row["CA3"] . '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Designation</label></td>  
                     <td width="70%">' . $row["Exam"] . '</td>  
                </tr>  
                
           ';
    }
    $output .= '  
           </table>  
      </div>  
      ';
    echo $output;
}
 ?>