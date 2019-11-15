<?php


function userBookings($userID, $conn){

    $sql = "SELECT * FROM Booking WHERE UserID = '" . $userID . "' ORDER BY `Dates_Booked` DESC LIMIT 5 OFFSET " . $_SESSION["resultPage"] . ";";
    $result = mysqli_query($conn, $sql);


    if($result->num_rows > 0){

      $ind = 1;
      while($row = $result->fetch_assoc()) {
        echo '<tr>
                <th scope="row">' . $ind . '</th>
                <td>' . $row["BookingID"] . '</td>
                <td>' . $row["Dates_Booked"] . '</td>
                <td>' . $row["Parking_Start"] . '</td>
                <td>' . $row["Parking_End"] . '</td>
                <td>' . $row["carType"] . '</td>
                <td>' . $row["Payment"] . '</td>
              </tr>';
        $ind = $ind +1;
        }

    } else{
        echo '<script language="javascript">';
        echo 'alert("User doesnt exists")';
        echo '</script>';
    }
}

function getNumberResutls($userID,$conn){

    $sql = "SELECT * FROM Booking WHERE UserID = '" . $userID . "';";
    $result = mysqli_query($conn,$sql);

    return round($result->num_rows / 5);
}

?>
