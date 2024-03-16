<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="css/user_find_job.css">
</head>

<body background="images/32993994_840843081452.jpg">
    <div class="container">
        <h1 class="logo" style="font-weight: bold;">FreeLancia</h1>
    <!-- Search Bar Operations -->
    <form method="post">
        <div class="searchbar">
            <input type="text" id="myinput" placeholder="Search Project..." name="searching">
            <button  name="search_button" id="search"><i class="fa fa-search icon-search" style="font-weight: bold;" onkeyup="search"></i></button>
        </div>
    </form>
    <!-- Sort List Operations -->
        <div class="listingHeader">
            <div class="dropdown">
                <div class="dd-a"><span> <i class="fa-solid fa-filter fa-bounce" style="color: #21fd16;"></i></span>
                </div>
                <input type="checkbox">
                <div class="dd-c">
                    <button class="accordion"><i class="fa-solid fa-check fa-fade"></i> All</button>
                    <button class="accordion"><i class="fa-solid fa-sort fa-beat"></i> Sort-by</button>
                    <button class="accordion"><i class="fa-regular fa-clock fa-spin"></i> Latest</button>
                    <button class="accordion"><i class="fa-solid fa-fire-flame-curved fa-fade"></i> Popular</button>

                    </input>
                </div>

            </div>
            <div class="boxs">
                <!-- Move to up button -->
                <div class="arrow" id="arrowtop">
                    <a href="#" title="Back to Top"><span class="fa-solid fa-arrow-up fa-beat"></span></a>
                </div>
<?php
    @include 'config.php';

    class TestingTable{
        private $conn;
        public function __construct($conn) {
            $this->conn =$conn->getConnection();
        }
        public function getProjectsName($sql) {
            $name=$this->conn->query($sql); 
            $companies = array();
            if($name){
            while ($row = $name->fetch_assoc()) {
                $companies[] = $row;
            }
            return $companies;
            }
        }
        public function getPhoto($sql){
            $photo=$this->conn->query($sql);
            $photos=array();
            if($photo){
                while ($row = $photo->fetch_assoc()) {
                    $imageData=base64_encode($row['demo_project']);
                    $photos[] = $imageData;
                }
                return $photos;
                }
        }
        public function getlines($sql){
            $line=$this->conn->query($sql);
            $lines=array();
            if($line){
                while ($row = $line->fetch_assoc()) {
                    $Firstlines=explode(".",$row['Project_description']);   // the explode needs two arguments, first one from which by indicating you want to split like dot(.),space( ),next line(\n) etc. next is which pharagh you want to slipt into lines.
                    $lines[] = $Firstlines[0];
                }
                return $lines;
                }
            }
        public function getId($sql){
            $Id_number=$this->conn->query($sql);
            $Id_numbers=array();
            if($Id_number){
                while ($row = $Id_number->fetch_assoc()) {
                    $Id_numbers[]=$row;
                }
                return $Id_numbers;
            }
        }
            public function getButtons() {
                $buttons = [];
                $sql = "SELECT * FROM `job_post_table`;";
                $result = $this->conn->query($sql);
                if (!$result) {
                    die("Query Failed: " . $this->conn->getError());
                }
                $numrows = mysqli_num_rows($result);
                for ($i = 0; $i < $numrows; $i++) {
                    $x = $i + 1;
                    $buttons[$x]=$x;
                }
                return $buttons;
            }
            // public function handleButtonClick($button_number) {
            //     $buttons = $this->getButtons();
        
            //     if (isset($buttons[$button_number])) {
            //         $_SESSION['action'] = $buttons[$button_number];
            //     }
            // }
    }
session_start();
/*This line is for connection with database */
$testingTable = new TestingTable($db);
/*For fatch Projects name */
$sql = "SELECT `Project_Name` FROM `job_post_table`;";
$project_name = $testingTable->getProjectsName($sql);



/*For fatch Images of demo projects */
$imageType='image/jpeg';
$sql1 = "SELECT `demo_project` FROM `job_post_table`;";
$demo_photo = $testingTable->getPhoto($sql1);


/*For first line fatch from database */
$sql2 = "SELECT `Project_description` FROM `job_post_table`;";
$short_description = $testingTable->getlines($sql2);

// Button fetching process
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['button_click'])) {
    $button_number = $_POST['button_click'];
    $buttons=$testingTable->getButtons();
    if (isset($buttons[$button_number])) {
        $_SESSION['action'] = $buttons[$button_number];
       // echo $_SESSION['action'];
    }
    header("Location:project_details.php");
}


/*For Search Results */
if(isset($_POST["search_button"])){
        $Project=$_POST["searching"];
        $sql4="SELECT `Project_Name` FROM `job_post_table` WHERE `Project_Name` LIKE '%$Project%';";
        $sql5="SELECT `demo_project` FROM `job_post_table` WHERE `Project_Name` LIKE '%$Project%';";
        $sql6="SELECT `Project_description` FROM `job_post_table` WHERE `Project_Name`LIKE '%$Project%';";
        $sql7="SELECT `Postid` FROM `job_post_table` WHERE `Project_Name`LIKE '%$Project%';";
        $search_name=$testingTable->getProjectsName($sql4);
        $search_photo=$testingTable->getPhoto($sql5);
        $search_line=$testingTable->getlines($sql6);
        $search_id=$testingTable->getId($sql7);
        // $j=1;
        $imageType='image/jpeg';
foreach (array_map(null,$search_name,$search_photo,$search_line,$search_id) as [$item1,$item2,$item3,$item4]){
    echo    '<div class="box">
    <h2>' . $item1['Project_Name'] . '</h2>
    <a href="#"><img src="data:' . $imageType . ';base64,' . $item2 . '"/></a>
    <p>' . $item3 . '<form method="post"><button name="button_click" value="' . $item4['Postid'] . '" id="invisible">Read more...</button></form>
    </p>

</div>';
// $j++;

    }
}else{
/*Main fatched area */
$i=1;
foreach (array_map(null,$project_name,$demo_photo,$short_description) as [$item1,$item2,$item3]){
    echo '<div class="box">
    <h2>' . $item1['Project_Name'] . '</h2>
    <a href="#"><img src="data:' . $imageType . ';base64,' . $item2 . '"/></a>
    <p>' . $item3 . '<form method="post"><button name="button_click" value="' . $i . '" id="invisible">Read more...</button></form>
    </p>

</div>';
$i++;
    }
}




// @include 'Click_page.php';
?>           
</div>
</div>

<!-- Scripting for Animation and up Arrow -->

<script>
const boxes = document.querySelectorAll('.box');
window.addEventListener('scroll',checkbox);
checkbox();
function checkbox(){
    const triggerBottom = window.innerHeight / 5 * 4;
    boxes.forEach(box => {
        const boxTop = box.getBoundingClientRect().top;
        if(boxTop < triggerBottom){
            box.classList.add('show');
        }else{
           box.classList.remove('show');
        }
    });
}  

window.onscroll = function() {
        ScrollFunction();
}

function ScrollFunction(){
    var arrow=document.getElementsById("arrowtop");
  if(document.body.scrollTop > 20 || document.documentElement.scrollTop > 20){
    arrow.style.display ="block";
  }else{
    arrow.style.display ="none";
  }
}
</script>
</html>