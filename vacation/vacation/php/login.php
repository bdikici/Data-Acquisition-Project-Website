<?php


function insertData($username, $password, $conn){

    $sql = "SELECT * FROM Users WHERE Username = '" . $username . "';";
    $result = mysqli_query($conn, $sql);


    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        echo $row["Password"];
        echo "entered: " . ($password == $row["Password"]);
        echo password_verify($password, $row["Password"]);

        if($password == $row["Password"]){
            $_SESSION['Username'] = $row;
            header( 'Location: index.php' );
        } else {
            echo '<script language="javascript">';
            echo 'alert("Doenst work")';
            echo '</script>';
        }

    } else{
        echo '<script language="javascript">';
        echo 'alert("User doesnt exists")';
        echo '</script>';
    }
}

# isset() prüft obt eine Variable existiert
# - in diesem Falle prüfen wir ob $_Get
function logingIn($conn){

    if(isset($_GET['login'])) {

        $username = $_POST['inputUsername'];
        $password = $_POST['inputPassword'];
        
        insertData($username, $password,$conn);
    }
}

?>