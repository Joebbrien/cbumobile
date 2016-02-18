<?php

include_once"cbumobileConnection.php";

#Get events from  the application

$eventtitle=urldecode($_GET['eventTitle']);
$eventdescription=urldecode($_GET['eventDescription']);
$eventDate=urldecode($_GET['eventDate']);
$eventvenue=urldecode($_GET['eventVenue']);

$eventTitle=filter_var($eventtitle,FILTER_SANITIZE_STRING);
$eventDescription=filter_var($eventdescription, FILTER_SANITIZE_STRING);
$eventVenue=filter_var($eventvenue, FILTER_SANITIZE_STRING);

#sql insert query to insert event into the database

$setEvent="INSERT INTO  `cbumobile`.`events` (
             `EventId` ,
             `EventTitle` ,
             `EventDescription` ,
             `Date` ,
             `Venue`
               )
           VALUES (
NULL ,  '$eventTitle',  '$eventDescription',  '$eventDate',  '$eventVenue'
)";

if(isset($eventTitle) && isset($eventDescription) && isset($eventDate) && isset($eventVenue)){

    $sendevent=mysqli_query($connection,$setEvent);
    if(isset($sendevent)){
         $status="Success";
         $message="The event has been stored successfully";
         sendFeedBack($status,$message);

      }else{

          $status="Fail";
          $message="Failed to store the event, try again.";
        sendFeedback($status, $message);

     }#ends inner if statement
    
}else{
    
   $status="Fail";
   $message="Please complete information about the event.";
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
