<?php
  include_once"cbumobileConnection.php";

$newstitle=$_GET['newsTitle'];
$newsdetails=$_GET['newsDetail'];
$newsDate=$_GET['newsDate'];

$newsImage="Blank";
$newsTitle=filter_var($newstitle, FILTER_SANITIZE_STRING);
$newsDetails=filter_var($newsdetails, FILTER_SANITIZE_STRING);
$setNews="INSERT INTO  `cbumobile`.`news` (
             `NewsId` ,
             `NewsTitle` ,
             `Details` ,
             `Date` ,
             `NewsImage`
               )
           VALUES (
NULL ,  '$newsTitle',  '$newsDetails',  '$newsDate',  'Nill'
)";

if(isset($newsTitle) && isset($newsDetails) && isset($newsDate) && isset($newsImage)){

    $sendnews=mysqli_query($connection,$setNews);

    if(isset($sendnews)){
        $status="Success";
        $message="News Has been stored successfully";
    
         sendFeedBack($status,$message);

      }else{

          $status="Fail";
          $message="Failed to store news, try again.";
        sendFeedback($status, $message);
     }#ends inner if statement
    
}else{
    
   $status="Fail";
   $message="Please complete the news.";
   sendFeedback($status, $message);
}#ends outer if statement   
    
mysqli_close($connection);

function sendFeedBack($status, $message){
    
    #returns the right feedback message
    #depending on what has happens
    
     $feedBack['Status']=$status;
     $feedBack['Message']=$message;
     $sendFeedBack[]=$feedBack;
    
     print(json_encode($sendFeedBack));
 
}


?>
