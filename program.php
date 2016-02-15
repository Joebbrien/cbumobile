<?php

  include("cbumobileConnection.php");

  $schoolname=urldecode($_GET['schoolName']);
  $schoolName=filter_var($schoolname, FILTER_SANITIZE_STRING);

  $getSchoolId="SELECT SchoolCode
                 FROM school
                 WHERE SchoolName='$schoolName'
                 ";
  $getIdResponse=mysqli_query($connection, $getSchoolId);
  
  if(isset($getIdResponse)){
      
       while($row=mysqli_fetch_assoc($getIdResponse)){
            
           $schoolId=$row['SchoolCode'];
      
      }#while loop for getting school id
  
      if(isset($schoolId)){
          
             $getPrograms="SELECT ProgramName, Duration, Fees, Certificate 
                           FROM program 
                           WHERE SchoolId='$schoolId'
                 ";
          
          $response=mysqli_query($connection, $getPrograms);

          if(isset($response)){

                  while($row=mysqli_fetch_assoc($response)){
         
                         $program[]=$row;
                     }
              if(!empty($program)){
                    
                     echo json_encode($program);
                 
                   
              }else{
                   $status="Fail";
                   $message="programs for that for school of ".$schoolName." not yet included.";
 
                  printError($status,$message);

              }#checking if the array is empty or null
    
           }else{
                 $status="Fail";
                 $message="Unable to get programs.";
 
                  printError($status,$message);
 
           }#program get else statement  
            
   }#Schoolid set check if statement    
      
  }else{
  
       $status="Fail";
       $message="Unable to get school ID.";
 
       printError($status,$message);
 
  
  }#main if statements

   function printError($status,$message){
       
       $fail["Status"]=$status;
       $fail["Message"]=$message;
       
       $failure[]=$fail;
       
       echo json_encode($failure);
  
   }
   
     mysqli_close($connection);

?>
