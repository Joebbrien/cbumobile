<?php

  include_once"cbumobileConnection.php";
  $eventId=$_GET['newsId'];

  $eventid=filter_var($eventId,FILTER_SANITIZE_NUMBER_INT);

  $stm= mysqli_prepare($connection,"DELETE FROM events WHERE EventId=?");

if(isset($stm)){
    
   mysqli_stmt_bind_param($stm,"d",$eventid);
   mysqli_stmt_execute($stm);
    
  if(mysqli_affected_rows($connection) > 0){
        mysqli_stmt_close($stm);
        $status="Success";
        $message="Selected news has been deleted";
        sendinformation($status,$message);
       
      }else{
        $status="Fail";
        $message="No news is deleted";
        sendinformation($status,$message);
    
    }

}else{
 mysqli_stmt_close($stm);
 $status="Fail";
 $message="Problem with preparing a statement.";
 sendinformation($status,$message);

}
function sendinformation($status, $message){

   $fail['Status']=$status;
   $fail['Message']=$message;
   $failure[]=$fail; 
   print(json_encode($failure)); 

}
  







?>
