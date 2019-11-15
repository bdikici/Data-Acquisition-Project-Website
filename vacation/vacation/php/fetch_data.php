<?php


function numUsers($conn){

    $sql = 'SELECT COUNT(*) AS NumUsers FROM Users;';
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    if($result->num_rows > 0){
        return $row["NumUsers"];
    }
}

function numBookings($conn){
    $todays_date = date("Y-m-d");

    $sql = 'SELECT COUNT(*) AS NumBookings FROM Booking WHERE Dates_Booked = "'. $todays_date . '";';
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    if($result->num_rows > 0){
        return $row["NumBookings"];
    }
}

function revenue($conn){

    $todays_date = date("Y-m-d");

    $sql = 'SELECT SUM(Payment) AS Revenue FROM Booking WHERE Dates_Booked = "'. $todays_date . '";';
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();

    if($result->num_rows > 0){
        return round($row["Revenue"],2);
    }
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
