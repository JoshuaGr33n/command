<?php
function get_grade_sss($total){


     if($total >= 75){
        return array("grade" => "A1", "remark" => "Excellent");
    }else if($total >= 70){
        return array("grade" => "B2", "remark" => "Very Good");
    }else if($total >= 65){
        return array("grade" => "B3", "remark" => "Good");
    }else if($total >= 60){
        return array("grade" => "C4", "remark" => "Credit");
    }else if($total >= 55){
        return array("grade" => "C5", "remark" => "Credit");
    }else if($total >= 50){
        return array("grade" => "C6", "remark" => "Credit");
    }else if($total >= 45){
        return array("grade" => "D7", "remark" => "Pass");
    }else if($total >= 40){
      return array("grade" => "E8", "remark" => "Pass");
    }else if($total < 40){
      return array("grade" => "F9", "remark" => "Fail");
    }
   
}


function get_grade_jss($total){


   

       
            if($total >= 75){
                return array("grade" => "A", "remark" => "Excellent");
            }else if($total >= 69){
                return array("grade" => "B", "remark" => "Very Good");
            }else if($total >= 50){
                return array("grade" => "C", "remark" => "Good");
            }else if($total >= 40){
                return array("grade" => "D", "remark" => "Pass");
            }else if($total < 40){
              return array("grade" => "F", "remark" => "Fail");
            }
          
          

    


   
} 
?>