<?php
session_start();

@include 'config.php';

class LoginSystem
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function handleLogin()
    {
        if (isset($_POST['login'])) {
            $time = time() - 30;
            $ip_address = $this->getIpAddr();
            $total_count = $this->getLoginAttemptsCount($time, $ip_address);

            if ($total_count === 3) {
                echo "<script>alert('Too many failed login attempts. Please login after 30 sec');</script>";
                ?>
                <script>
                    window.location.href = 'signup.php';
                </script>
                <?php
            } else {
                $email = mysqli_real_escape_string($this->connection, $_POST['email']);
                $pwd = $_POST['password'];
                $num = $this->getUserCount($email);

                if ($num === 1) {
                    $this->processUserLogin($email, $pwd, $ip_address);
                } else {
                    echo "<script>alert('Incorrect email or password!');</script>";
                    ?>
                 <script>
                    window.location.href = 'signup.php';
                </script>
                <?php
                }
            }
        }
    }

    private function getLoginAttemptsCount($time, $ip_address)
    {
        $query = mysqli_query($this->connection, "SELECT count(*) as total_count from loginlogs where TryTime > $time and IpAddress='$ip_address'");
        $check_login_row = mysqli_fetch_assoc($query);
        return $check_login_row['total_count'];
    }

    private function getUserCount($email)
    {
        $select = "SELECT * FROM signup_table WHERE email = '$email'";
        $result = mysqli_query($this->connection, $select);
        return mysqli_num_rows($result);
    }

    private function processUserLogin($email, $password, $ip_address)
    {
        $select = "SELECT * FROM signup_table WHERE email = '$email'";
        $result = mysqli_query($this->connection, $select);

        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['IS_LOGIN'] = 'yes';
                $_SESSION['user_email'] = $email;
                $_SESSION['username'] = $row['username'];
                // echo $_SESSION['username'];
                mysqli_query($this->connection, "DELETE from loginlogs where IpAddress='$ip_address'");
                header('location:Homepage/home.php');
            } else {
                $this->handleFailedLogin($ip_address);
            }
        }
    }

    private function handleFailedLogin($ip_address)
    {
        $total_count = $this->getLoginAttemptsCount(time() - 30, $ip_address);
        $remaining_attempts = 3 - $total_count;

        if ($remaining_attempts === 0) {
            echo "<script>alert('Too many failed login attempts. Please login after 30 sec');</script>";
            ?>
                <script>
                    window.location.href = 'signup.php';
                </script>
        <?php
        } else {
            echo "<script>alert('Please enter valid login details.$remaining_attempts attempts remaining');</script>";
            ?>
                <script>
                    window.location.href = 'signup.php';
                </script>
        <?php
        }

        $try_time = time();
        mysqli_query($this->connection, "INSERT into loginlogs(IpAddress, TryTime) values('$ip_address', '$try_time')");
    }

    private function getIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ipAddr = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipAddr = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ipAddr = $_SERVER['REMOTE_ADDR'];
        }
        return $ipAddr;
    }
}

// Usage
$loginSystem = new LoginSystem($connection);
$loginSystem->handleLogin();
?>
