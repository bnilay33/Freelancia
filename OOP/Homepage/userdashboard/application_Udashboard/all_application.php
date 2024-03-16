<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="all_application.css">
</head>

<body>
    <?php
    session_start();
    @include_once 'config.php';
    class ApplyTable{
        private $conn;
        public function __construct($conn) {
            $this->conn =$conn->getConnection();
        }
        public function UsernameProcess($sql){
            $result1=$this->conn->query($sql);
            if($result1){
                $row6=$result1->fetch_assoc();
            }
            return $row6;
        }
        public function queryProcess($sql){
            $result2=$this->conn->query($sql);
            $projects=array();
            if($result2){
                while($row6=$result2->fetch_assoc()){
                    $projects[]=$row6;
                }
            }
            return $projects;
        }
    }
    ?>
    <!--Table-->
    <div class="container" style="margin-top: 50px;">
        <main class="table">
            <section class="table__header">
                <h1>Applied Projects</h1>
            </section>
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th> Company Name <i class="fa-regular fa-building fa-fade"></i> </th>
                            <th> Project Name <i class="fa-solid fa-briefcase fa-fade"></i></th>
                            <th> Apply Date <i class="fa-regular fa-calendar-days fa-beat"></i></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           $applytable=new ApplyTable($db);
                           $email=$_SESSION['email'];
                           $sql19="SELECT `username` FROM `signup_table` WHERE `email`='$email';";
                           $result19=$applytable->UsernameProcess($sql19);
                           $Username=$result19['username'];
                           $sql16="SELECT `Company_Name` FROM `application_table` WHERE `username`='$Username';";
                           $sql17="SELECT `Project_Name` FROM `application_table` WHERE `username`='$Username';";
                           $sql18="SELECT `dt` FROM `application_table` WHERE `username`='$Username';";
                           $result16=$applytable->queryProcess($sql16);
                           $result17=$applytable->queryProcess($sql17);
                           $result18=$applytable->queryProcess($sql18);
                            //date formation
                            foreach (array_map(null,$result16,$result17,$result18) as [$item1,$item2,$item3]){
                                $date=new DateTime($item3['dt']);
                            $formatedate=$date->format('d M Y');
                                echo '<tr>
                           <td> <img src="dark-blue-product-background.jpg" alt="">'. $item1['Company_Name'] .'</td>
                           <td>'. $item2['Project_Name'] .'</td>
                           <td>'. $formatedate .'</td>
                           
                       </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>

</body>

</html>