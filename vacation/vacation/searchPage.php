<?php
include "php/connectDb.php";


if(isset($_GET["query"]) && !isset($_SESSION["Username"])){
  echo "ENTERED";
  echo "searchPage: ". $_SESSION["Username"];
  $errorMessage = "Login Please!";
  return -1;
}

if(isset($_GET["query"])){

  $parking_slot = 0;
  $date = $_POST["searchDate"];
  $start = $_POST["searchStart"];
  $end = $_POST["searchEnd"];
  $carType = $_POST["searchCarType"];

  // check for conditions
  // 1) can't book less than an hour
  if(!$end || !$start){
    $errorMessage = "Enter the time!";
  }else if(($end - $start) < 0){
    $errorMessage = "Reenter the time!";
  }

  // check if date is correct
  $currentDateTime = strtotime(date('d/m/Y'));
  $timestamp = strtotime($date);

  $subday =  date('d', $currentDateTime) -  date('d', $timestamp);
  $submonth =  date('m', $currentDateTime) -  date('m', $timestamp);
  $subyear =  date('Y', $currentDateTime) -  date('Y', $timestamp);

  if($subyear > 0){
    $errorMessage = "Reselect the date!";
  }else if($submonth > 0){
    $errorMessage = "Reselect the date!";
  }else if($subday > 0){
    $errorMessage = "Reselect the date!";
  }

  $conn = OpenCon();
 
  $newdate = date("Y-m-d", strtotime($date));
  $sql = "SELECT * FROM Booking WHERE Dates_Booked = '" . $newdate . "';";
  $result = mysqli_query($conn, $sql);


  if($result){
    while($row = $result->fetch_assoc()){
      if($row["Parking_Start"] <=  $start && $start < $row["Parking_End"]){
        $parking_slot = $parking_slot + 1;
      }else if($row["Parking_Start"] <=  $end && $end < $row["Parking_End"]){
        $parking_slot = $parking_slot + 1;
      }
    }
  }

  if($parking_slot >= 2){
    $errorMessage = "Time Not Available";
  }else{
    
    $insert = "INSERT INTO `Booking` (`BookingID`, `carType`, `Dates_Booked`, `Parking_Start`, `Parking_End`, `UserID`) VALUES ('" . mt_rand() . "','" . $carType . "','"
    . $newdate . "','" . $start . "','" . $end . "','" . $_SESSION["Username"]["UserID"] . "');"; 
    
    if($conn->query($insert) === TRUE){
      $registerBooking = True;
    }else{
      echo $insert;

      echo $conn->error;
    }
  }

}



?>