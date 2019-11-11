<?php

include 'connectDb.php';
include 'userBookings.php';
include 'login.php';

session_start();

# connecting to database
$conn = OpenCon();


$num_result = ($_POST['new_num_result'] - 1) * 5;

$sql = "SELECT * FROM Booking WHERE UserID = '" . $_SESSION["Username"]["UserID"] . "' ORDER BY `Dates_Booked` DESC LIMIT 5 OFFSET " . $num_result . ";";
$result = mysqli_query($conn, $sql);


if($result->num_rows > 0){

  $ind = ($_POST['new_num_result'] - 1) * 5 == 0 ? 1 : ($_POST['new_num_result'] - 1) * 5 +1;
  
  while($row = $result->fetch_assoc()) {
    echo '<tr>
            <th scope="row">' . $ind . '</th>
            <td>' . $row["BookingID"] . '</td>
            <td>' . $row["Dates_Booked"] . '</td>
            <td>' . $row["Parking_Start"] . '</td>
            <td>' . $row["Parking_End"] . '</td>
            <td>' . $row["carType"] . '</td>
          </tr>';
    $ind = $ind +1;
  }

} else{
    echo '<script language="javascript">';
    echo 'alert("User doesnt exists")';
    echo '</script>';
}


?>
