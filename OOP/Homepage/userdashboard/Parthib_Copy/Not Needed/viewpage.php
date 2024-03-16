<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    // @include 'config.php';
    // session_start();
    // $Id=$_SESSION['action'];

    // $n="SELECT `username` FROM `testing_table` WHERE `id`=$Id;";
    // $d="SELECT `job_description` FROM `testing_table` WHERE `id`=$Id;";
    // $name=mysqli_query($conn,$n);
    // $description=mysqli_query($conn,$d);
    // if(!$name && !$description){
    //     die("Query Failed!!". mysqli_error($conn));
    // }
    // if((mysqli_num_rows($name)>0) && (mysqli_num_rows($description)>0)){
    //     $row1=mysqli_fetch_assoc($name);
    //     $row2=mysqli_fetch_assoc($description);
    //         echo $row1["username"];
    //         echo "<br>";
    //         echo $row2["job_description"];
        
    // }


// class DatabaseConnection {
//     private $conn;

//     public function __construct($hostname, $username, $password, $database) {
//         $this->conn = new mysqli($hostname, $username, $password, $database);

//         if ($this->conn->connect_error) {
//             die("Connection failed: " . $this->conn->connect_error);
//         }
//     }
@include 'config.php';
class viewpage{
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn->getConnection();
    }
    public function getData($id) {
        // $id = $this->conn->real_escape_string($id);

        $nameQuery = "SELECT `Project_Name` FROM `job_post_table` WHERE `Postid`=$id";
        $descriptionQuery = "SELECT `Project_description` FROM `job_post_table` WHERE `Postid`='$id'";

        $nameResult = $this->conn->query($nameQuery);
        $descriptionResult = $this->conn->query($descriptionQuery);

        if (!$nameResult || !$descriptionResult) {
            die("Query Failed: " . $this->conn->error);
        }

        if ($nameResult->num_rows > 0 && $descriptionResult->num_rows > 0) {
            $row1 = $nameResult->fetch_assoc();
            $row2 = $descriptionResult->fetch_assoc();

            echo $row1['Project_Name'];
            echo $row2['Project_description'];
        } else {
            return null;
        }
    }
}

session_start();
$dbConnection = new viewpage($db);

// Assuming you have the session variable set earlier
if(isset($_SESSION['action'])){
$Id = $_SESSION['action'];
}
$data = $dbConnection->getData($Id);

// if ($data) {
//     echo $data['username'] . "<br>";
//     echo $data['job_description'];
// } else {
//     echo "No data found for the given ID.";
// }
?>

</body>
</html>