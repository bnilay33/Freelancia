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
            <a  name="search_button"><i class="fa fa-search icon-search" style="font-weight: bold;" onkeyup="search"></i></a>
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
    }
/*This line is for connection with database */
$testingTable = new TestingTable($db);
if(isset($_POST["search_button"])){
    $Project=$_POST["searching"];
    $sql4="SELECT `Project_Name` FROM `job_post_table` WHERE `Project_Name`= '$Project';";
    $sql5="SELECT `demo_project` FROM `job_post_table` WHERE `Project_Name`= '$Project';";
    $sql6="SELECT `Project_description` FROM `job_post_table` WHERE `Project_Name`='$Project';";
    $search_name=$testingTable->getProjectsName($sql4);
    $search_photo=$testingTable->getPhoto($sql5);
    $search_line=$testingTable->getlines($sql6);
    $j=1;
    $imageType='image/jpeg';
    foreach (array_map(null,$search_name,$search_photo,$search_line) as [$item1,$item2,$item3]){
        echo '<div class="box">
        <h2>' . $item1['Project_Name'] . '</h2>
        <a href="#"><img src="data:' . $imageType . ';base64,' . $item2 . '"/></a>
        <p>'
             . $item3 . '<a href="project_details.html"
                target="_blank" style="text-decoration: none;">Read more...</a>
        </p>
        </a>
    </div>';
    $j++;
    
        }
}
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