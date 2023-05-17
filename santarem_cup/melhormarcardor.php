<?php

$name6 = $_POST["name6"];  
$name7= $_POST["name7"];
$priority1 = $_POST["priority1"];
$name8= $_POST["name8"];




$host = "localhost";
$dbname = "cup1";
$username = "root";
$password = "";
        
$conn = mysqli_connect(hostname: $host,
                       username: $username,
                       password: $password,
                       database: $dbname);
        
if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}           
        
$sql = "INSERT INTO melhormarcador (equipa, nºcamisola, escalao,golos)
        VALUES (?,?,?,?)";

$stmt = mysqli_stmt_init($conn);

if ( ! mysqli_stmt_prepare($stmt, $sql)) {
 
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "sisi",
                       $name6,
                       $name7,
                       $priority1,
                       $name8
);


mysqli_stmt_execute($stmt);

echo "Record saved.";

header("Location: menu.html");
exit();

?>