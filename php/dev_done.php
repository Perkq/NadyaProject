<?php
if(isset($_POST["id"]))
{

    $conn = new mysqli("localhost", "root", "root", "devices_state");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
    }
    $userid = $conn->real_escape_string($_POST["id"]);

    $state = $_POST["moder"];
    
    if ($state == "progress") {
        $sql = "SELECT * FROM done WHERE id = '$userid'";
        $result = $conn->query($sql);
    
        foreach($result as $row)
        {
        $name = $row['Name'];
        $email = $row['EMail'];
        $date = $row['Date'];
        $comment = $row['Comment'];
        $photo = $row['Photo'];
    
        $sql2 = "INSERT INTO inprogress (`Name`, `EMail`, `Date`, `State`, `Comment`, `Photo`) VALUES ('$name', '$email', '$date', 'in progress', '$comment', '$photo')";
        
        $conn->query($sql2);
        
    }
     $sql3 = "DELETE FROM done WHERE id = '$userid'";   
     $conn->query($sql3);    
    }

    if ($state == "Denied") {
        $sql = "SELECT * FROM done WHERE id = '$userid'";
        $result = $conn->query($sql);
    
        foreach($result as $row)
        {
        $name = $row['Name'];
        $email = $row['EMail'];
        $date = $row['Date'];
        $comment = $row['Comment'];
        $photo = $row['Photo'];
    
        $sql2 = "INSERT INTO denied (`Name`, `EMail`, `Date`, `State`, `Comment`, `Photo`) VALUES ('$name', '$email', '$date', 'Denied', '$comment', '$photo')";
        $conn->query($sql2);
        
        }
        $sql3 = "DELETE FROM done WHERE id = '$userid'";   
        $conn->query($sql3);    
    }

    header("Location: admin_page.php");
    $conn->close();  
}
?>