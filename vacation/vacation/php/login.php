<?php


function insertData($uname, $pw){
    $sql = "INSERT INTO Users (Username, Password) VALUES ('$uname','$pw');"

    if(mysqli_query($link, $sql)){
        echo "Records added successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
}

# isset() prüft obt eine Variable existiert
# - in diesem Falle prüfen wir ob $_Get
if(isset($_GET['login'])) {
    $username = $_POST['inputUsername'];
    $passwort = $_POST['inputPassword'];
    
    insertData($username, $passwort);
}else{
    $errorMessage = "E-Mail oder Passwort war ungültig<br>";
}
    

    """
    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();
        
    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['id'];
        die('Login erfolgreich. Weiter zu <a href="geheim.php">internen Bereich</a>');
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
    }"""
    
}

?>