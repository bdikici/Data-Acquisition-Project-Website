<?php

include 'connectDb.php';

$conn = OpenCon();

function numUsers(){
    global $conn;
    $sql = 'SELECT COUNT(*) AS NumUsers FROM Users;';
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    if($result->num_rows > 0){
        return $row["NumUsers"];
    }
}

function numBookings(){
    global $conn;
    $todays_date = date("Y-m-d");

    $sql = 'SELECT COUNT(*) AS NumBookings FROM Booking WHERE Dates_Booked = "'. $todays_date . '";';
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    if($result->num_rows > 0){
        return $row["NumBookings"];
    }
}

function revenue(){
    global $conn;
    $todays_date = date("Y-m-d");

    $sql = 'SELECT SUM(Payment) AS Revenue FROM Booking WHERE Dates_Booked = "'. $todays_date . '";';
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();

    if($result->num_rows > 0){
        return round($row["Revenue"],2);
    }
}

function booking_last20(){
    global $conn;
    $sql = 'SELECT `Dates_Booked`,COUNT(*) AS num FROM `Booking` GROUP BY `Dates_Booked` ORDER BY `Dates_Booked` ASC ;';
    $result = mysqli_query($conn, $sql);
    $rows = array(array(), array());
    // Fetch all
    while($r = $result->fetch_assoc()) {
        array_push($rows[0],$r["Dates_Booked"]);
        //OR
        array_push($rows[1],$r["num"]);
    }
    echo json_encode($rows);
}

if(isset($_POST['action']) && !empty($_POST['action'])) {
    booking_last20();
}
/*

$sql = "SELECT * FROM Booking WHERE UserID = '" . $userID . "' ORDER BY `Dates_Booked` DESC LIMIT 5 OFFSET " . $_SESSION["resultPage"] . ";";
$result = mysqli_query($conn, $sql);


if($result->num_rows > 0){

    echo json_encode($result);

} else{
    echo '<script language="javascript">';
    echo 'alert("User doesnt exists")';
    echo '</script>';
}
*/
?>
