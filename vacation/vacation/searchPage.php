<?php
include "php/connectDb.php";

session_start();



if(!isset($_SESSION["Username"])){
  $_SESSION["errorMessage"] = "Login Please!";
  header("Location: index.php");
}else{

  unset($_SESSION["errorMessage"]);
  unset($_SESSION["registerBooking"]);
  unset($_SESSION["payment"]);


  $parking_slot = 0;
  $date = $_POST["searchDate"];
  $start = $_POST["searchStart"];
  $end = $_POST["searchEnd"];
  $carType = $_POST["searchCarType"];
  $epsilon = $carType == "Bike" ? 0 : ($carType == "Car" ? 0.25 : 0.50);
  #exit("ENTERED HEHERE: " . date('d/m/Y'));
  // check for conditions
  // 1) can't book less than an hour
  if(!$end || !$start){
    $_SESSION["errorMessage"] = "Enter the time!";
    exit($_SESSION["errorMessage"]);
    header("Location: index.php");
  }else if(($end - $start) < 0 || $start == $end){

    $_SESSION["errorMessage"] = "Reenter the time!";
    header("Location: index.php");
  }

  // check if date is correct
  $currentDateTime = date('d-m-Y');
  $timestamp = date("d-m-Y",strtotime($date));

  $subday =  date('d', strtotime($currentDateTime)) -  date('d', strtotime($timestamp));
  $submonth =  date('m', strtotime($currentDateTime)) -  date('m', strtotime($timestamp));
  $subyear =  date('Y', strtotime($currentDateTime)) -  date('Y', strtotime($timestamp));


  # checking if date is valid >= todays date
  if($subyear > 0){
    $_SESSION["errorMessage"] = "Reselect the date!";
    header("Location: index.php");
  }else if($submonth > 0 && $date_testing > 0){
    $_SESSION["errorMessage"] = "Reselect the date!";
    header("Location: index.php");
  }else if($subday > 0 && $submonth >= 0){
    $_SESSION["errorMessage"] = "Reselect the date!";
    header("Location: index.php");
  }

  #echo $subday . $data_testing;
  #exit();

  $conn = OpenCon();

  $newdate = date("Y-m-d", strtotime($date));
  $sql = "SELECT * FROM Booking WHERE Dates_Booked = '" . $newdate . "';";
  $result = mysqli_query($conn, $sql);

  # check whether the time exists
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
    $_SESSION["errorMessage"] = "Time Not Available";
      header("Location: index.php");
  }else{
    # calculate revenue/payment
    $parking_duration = $end - $start;
    $payment = round(pow($parking_duration,0.9),1) + $epsilon;
    $_SESSION["payment"] = $payment;
    # insert data into database
    $insert = "INSERT INTO `Booking` (`BookingID`, `carType`, `Dates_Booked`, `Parking_Start`, `Parking_End`, `Payment` , `UserID`) VALUES ('" . mt_rand() . "','" . $carType . "','"
    . $newdate . "','" . $start . "','" . $end . "','" . $payment . "','" . $_SESSION["Username"]["UserID"] . "');"; 
    
    # if query was successful define variable "$registerBooking" and set it to TRUE for UI
    if($conn->query($insert) === TRUE){
      $_SESSION["registerBooking"] = True;
      header("Location: index.php");
    }else{
      echo $insert;

      echo $conn->error;
    }
  }

}




?>