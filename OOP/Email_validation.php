<?php

class SignupValidator {
    private $email;
    private $password;

    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
    }
    private function validateEmail() {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    private function validatePassword() {
        $passwordRegex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\!\~\@\#\$\%\&\-\_])[A-Za-z\d\!\~\@\#\$\%\&\-\_]{8,}$/';
        return preg_match($passwordRegex, $this->password);
    }

    private function redirectWithAlert($message) {
        echo "<script>alert('$message')</script>";
        echo "<script>window.location.replace('signup.php');</script>";
    }
    public function validate() {
        if ($this->validateEmail()) {
            $ebool=1;
        }else{
            $ebool=0;
        }
        $bool = $this->validatePassword();
        $boolArray=array($ebool,$bool);
        // if ($ebool===1 && $bool===1) {
        //     header('Location: verification.php');
        // } else
        
        if (empty($this->password)) {
            $this->redirectWithAlert("Please Enter A Valid Password !!");
        } elseif (strlen($this->password) < 8) {
            $this->redirectWithAlert("Minimum Size of the Password is 8 !!");
        } elseif (!$ebool) {
            $this->redirectWithAlert("Enter a Valid Email Id !!");
        } elseif (!$bool) {
            $this->redirectWithAlert("Your password must contain an Uppercase, a number, and a special character !!");
        }
        return $boolArray;
    }
  
}

if (isset($_POST['submit'])) {
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : "";

    $validator = new SignupValidator($email, $password);
    $validator->validate();
}
?>