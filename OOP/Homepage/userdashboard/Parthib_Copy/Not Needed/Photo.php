<?php
@include 'config.php';
    class TestingTable{
        private $conn;
        public function __construct($conn) {
            $this->conn =$conn->getConnection();
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
$testingTable = new TestingTable($db);
$sql2 = "SELECT `Project_description` FROM `job_post_table`;";
$short_description = $testingTable->getlines($sql2);
foreach ($short_description as $item3){
    echo $item3;
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
}  
?>