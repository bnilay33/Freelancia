<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/shortlist.css">
</head>
<body>
    <?php
     session_start();
     @include_once 'config.php';
     class ShortList{
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
           $reviews=array();
           if($result2){
               while($row9=$result2->fetch_assoc()){
                   $reviews[]=$row9;
               }
           }
           return $reviews;
       }
       public function executeQuery($sql){
         return $this->conn->query($sql);
       }
     }
     $shortlist=new ShortList($db);
     $email=$_SESSION['email'];
     $sql22="SELECT `username` FROM `signup_table` WHERE `email`='$email';";
     $result22=$shortlist->UsernameProcess($sql22);
     $Username=$result22['username'];
     $projectQuery="SELECT `Project_Name` FROM `application_table` WHERE `username`='$Username' ORDER BY `dt` DESC;";
     $projectResult=$shortlist->queryProcess($projectQuery);
     $companyQuery="SELECT `Company_Name` FROM `application_table` WHERE `username`='$Username' ORDER BY `dt` DESC;";
     $companyResult=$shortlist->queryProcess($companyQuery);
     $Project_status="SELECT `Project_status` FROM `application_table` WHERE `username`='$Username' ORDER BY `dt` DESC;";
     $statusResult=$shortlist->queryProcess($Project_status);
     $dateQuery="SELECT DATE(`dt`) AS date_only FROM `application_table` WHERE `username`='$Username' ORDER BY `dt` DESC;";
     $dateResult=$shortlist->queryProcess($dateQuery);
     $bidQuery="SELECT `Estimated_Charge` FROM `application_table` WHERE `username`='$Username' ORDER BY `dt` DESC;";
     $bidResult=$shortlist->queryProcess($bidQuery);
    ?>
    <main class="table">
        <section class="table__header">
            <h1>Shortlisted Projects</h1>
            
            
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        
                        
                        <th> Company Name <i class="fa-regular fa-building fa-fade"></i> </th>
                        <th> Project Name <i class="fa-solid fa-briefcase fa-fade"></i></th>
                        <th> Apply Date <i class="fa-regular fa-calendar-days fa-beat"></i></th>
                        <th> Shortlist Status <i class="fa-solid fa-filter fa-shake"></i></th>
                        <th> Bid Amount <i class="fa-solid fa-dollar-sign fa-flip"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach (array_map(null,$companyResult,$projectResult,$dateResult,$statusResult,$bidResult) as [$item1,$item2,$item3,$item4,$item5]){
                        if($item4['Project_status']==""){
                            $status="Pending";
                            $css="pending";
                          }else if($item4['Project_status']=="Approved"){
                            $status="Approved";
                            $css="delivered";
                          }else{
                            $status="Rejected";
                            $css="cancelled";
                          }
                        echo '                    <tr>
                        
                    <td> '. $item1['Company_Name'] .'</td>
                    <td> '. $item2['Project_Name'] .' </td>
                    <td> '. $item3['date_only'] .' </td>
                    <td>
                        <p class="status '. $css .'">'. $status .'</p>
                    </td>
                    <td> <strong>$'. $item5['Estimated_Charge'] .'.00</strong></td>
                </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>