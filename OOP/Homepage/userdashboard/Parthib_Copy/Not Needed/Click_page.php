<?php
// class Database {
//     private $conn;

//     public function __construct($dbHost, $dbUser, $dbPassword, $dbName) {
//         $this->conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

//         if (!$this->conn) {
//             die("Database connection failed: " . mysqli_connect_error());
//         }
//     }

//     public function executeQuery($sql) {
//         return mysqli_query($this->conn, $sql);
//     }

//     public function getError() {
//         return mysqli_error($this->conn);
//     }

//     public function closeConnection() {
//         mysqli_close($this->conn);
//     }
// }
@include 'config.php';
class ButtonHandler {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn->getConnection();
    }

    public function getButtons() {
        $buttons = [];

        $sql = "SELECT * FROM `testing_table`";
        $result = $this->conn->executeQuery($sql);

        if (!$result) {
            die("Query Failed: " . $this->conn->getError());
        }

        $numrows = mysqli_num_rows($result);

        for ($i = 0; $i < $numrows; $i++) {
            $x = $i + 1;
            $buttons[$x] = $x;
        }

        return $buttons;
    }

    public function handleButtonClick($button_number) {
        $buttons = $this->getButtons();

        if (isset($buttons[$button_number])) {
            $_SESSION['action'] = $buttons[$button_number];
            header("Location: viewpage.php");
        }
    }
}

// Usage
session_start();
$buttonHandler = new ButtonHandler($db);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["button_click"])) {
    $button_number = $_POST["button_click"];
    $buttonHandler->handleButtonClick($button_number);
}
?>
