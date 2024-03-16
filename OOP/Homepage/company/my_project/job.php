<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="job.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Add this script section to the head of your HTML document -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    var deleteIcons = document.querySelectorAll('.delete-icon');

    deleteIcons.forEach(function (icon) {
      icon.addEventListener('click', function () {
        // Call a function to handle the delete operation
        handleDelete(icon);
      });
    });

    function handleDelete(icon) {
      // Get the row element that contains the clicked icon
      var row = icon.closest('.table-row');

      // Extract data from the row (adjust these selectors based on your actual HTML structure)
      var companyName = row.querySelector('.table-row__name').textContent.trim();
      var projectName = row.querySelector('.table-row__policy').textContent.trim();

      // Use AJAX to send a request to your server to delete the data
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'delete_record.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      
      // Send the data to the server
      xhr.send('companyName=' + encodeURIComponent(companyName) + '&projectName=' + encodeURIComponent(projectName));

      // Remove the row from the table after successful deletion
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          row.remove();
        }
      };
    }
  });
</script>



  </head>
<body>
    <div class="container">
      
          
        </div>
        <div class="row row--top-20">
          <div class="col-md-12">
            <div class="table-container">
              <table class="table">
                <thead class="table__thead">
                  <tr>
                    <th class="table__th"><input id="selectAll" type="checkbox" class="table__select-row"></th>
                    <th class="table__th">Company Name</th>
                    <th class="table__th">Work</th>
                    <th class="table__th">Posted Date</th>
                    <th class="table__th">Dedline Date</th>
                    <th class="table__th">Status</th>

                    <th class="table__th">Action</th>
                  </tr>
                </thead>


                
                <?php
                @include 'config.php';
                session_start();

                           
                $mail = $_SESSION['user_email'];
                $query = "SELECT cp.Company_Name,jp.Project_Name, DATE_FORMAT(jp.dt, '%d/%m/%Y') AS Date,jp.deadline,jp.status from company_profile_table cp 
                INNER JOIN job_post_table jp ON cp.Company_Name = jp.Company_Name AND cp.username = jp.username WHERE email= '$mail' ";
                $result = $connection->query($query);
            
                while($row = $result->fetch_assoc()) {
                echo '<tbody class="table__tbody">';
                echo '<tr class="table-row table-row--chris">';
                echo '<td class="table-row__td">';
                echo '<input id="" type="checkbox" class="table__select-row">
                    </td>';
                echo '<td class="table-row__td">';
                echo '<div class="table-row__img"></div>';
                echo "<div class='table-row__info'><center><p class='table-row__name'>{$row['Company_Name']}</p></center></div>";
                echo '</td>
                    <td data-column="Work name" class="table-row__td">
                      <div class="">';
                echo "<center><p class='table-row__policy'>{$row['Project_Name']}</p></center>
                      </div>                
                    </td>
                    <td data-column='posted date' class='table-row__td'>
                      <p class='table-row__p-status '><center>{$row['Date']}</center></p>
                    </td>
                    <td data-column='Dedline Date' class='table-row__td'>
                    <center>{$row['deadline']}</center>
                    </td>
                    <td  data-column='Status' class='table-row__td'>
                      <center><p class='table-row__status'>{$row['status']}</p></center>
                    </td>";
              echo '<td class="table-row__td">
            
           <i class="fa-solid fa-trash delete-icon" style="color: #fe1616; margin-left: 20px; font-size: 20px;"></i>
            
                    </td>
                  </tr>
                
                  
                </tbody>';
              }
                ?>

            <!-- <i class="fa-solid fa-lock" style="color: #4098eb; padding-left: 50px;  font-size: 20px;"></i> -->
              </table>
            </div>
          </div>
        </div>
      
      
      </div>
      
</body>
</html>
