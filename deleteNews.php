<?php

  include_once"cbumobileConnection.php";
  $newsId=$_GET['newsId'];

  $newsid=filter_var($newsId,FILTER_SANITIZE_NUMBER_INT);

  $stm= mysqli_prepare($connection,"DELETE FROM news WHERE NewsId=?");

if(isset($stm)){
    
   mysqli_stmt_bind_param($stm,"d",$newsid);
   mysqli_stmt_execute($stm);
    
  if(mysqli_affected_rows($connection) > 0){
        mysqli_stmt_close($_GLOBALS['$stm']);
        $status="Success";
        $message="Selected news has been deleted";
        sendinformation($status,$message);
       
      }else{
        $status="Fail";
        $message="No news is deleted";
        sendinformation($status,$message);
    
    }

}else{
 mysqli_stmt_close($_GLOBALS['$stm']);
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