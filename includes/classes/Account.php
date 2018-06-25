<?php
  class Account{

    private $conn;
    private $errorArray;

    public function __construct($conn){
        $this->conn = $conn;
        $this->errorArray = array();
    }

    public function login($un, $pw){

      $pw = md5($pw);

      $query = mysqli_query($this->conn, "SELECT * FROM users WHERE username = '$un' AND password = '$pw'");

      if (mysqli_num_rows($query) == 1) {
        return true;
      }else {
        array_push($this->errorArray, Constants::$loginFailed);
        return false;
      }

    }

    public function register($user,$fn,$ln,$em,$em2,$pw,$pw2){
        $this->validateUsername($user);
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateEmails($em,$em2);
        $this->validatePasswords($pw, $pw2);

        if (empty($this->errorArray)) {
          // Insert into db
          return $this->insertUserDetails($user, $fn, $ln , $em , $pw);
        }
        else{
          return false;
        }
    }

    public function getError($error){
      if (!in_array($error, $this->errorArray)) {
        $error ="";
      }
      return "<span class='errorMessage'>$error</span>";
    }

    private function insertUserDetails($user, $fn, $ln , $em , $pw){
      $encryptedPw = md5($pw);
      $profilePic = "assets/images/profile-pics/head_emerald.png";
      $date = date("Y-m-d");

      $result = mysqli_query($this->conn, "INSERT INTO users VALUES ('0','$user', '$fn', '$ln', '$em', '$encryptedPw', '$date','$profilePic')");

      return $result;
    }


    private function validateUsername($user){

      if (strlen($user) > 25 or strlen($user) < 5) {
        array_push($this->errorArray, Constants::$usernameSize);
        return;
      }

      $checkUsernameQuery = mysqli_query($this->conn, "SELECT username FROM users WHERE username = '$user'");
      if (mysqli_num_rows($checkUsernameQuery) !=0) {
        array_push($this->errorArray, Constants::$usernameTaken);
        return;
      }

    }

    private function validateFirstName($fn){
      if (strlen($fn) > 25 or strlen($fn) < 2) {
        array_push($this->errorArray, Constants::$firstnameSize);
        return;
      }
    }

    private function validateLastName($ln){
      if (strlen($ln) > 25 or strlen($ln) < 2) {
        array_push($this->errorArray, Constants::$lastnameSize);
        return;
      }
    }

    private function validateEmails($em, $em2){
      if ($em != $em2) {
        array_push($this->errorArray, Constants::$emailDoNotMatch);
        return;
      }

      if (!filter_var($em,FILTER_VALIDATE_EMAIL)) {
        array_push($this->errorArray, Constants::$emailInvalid);
        return;
      }
      $checkEmailQuery = mysqli_query($this->conn, "SELECT username FROM users WHERE email = '$em'");
      if (mysqli_num_rows($checkEmailQuery) !=0) {
        array_push($this->errorArray, Constants::$emailTaken);
        return;
      }

    }
    private function validatePasswords($pw, $pw2){

        if ($pw != $pw2) {
            array_push($this->errorArray, Constants::$passwordsDoNotMatch);
        }

        if (preg_match('/[^A-Za-z0-9]/', $pw)) {
            array_push($this->errorArray, Constants::$passwordsNotAlpha);
        }

        if (strlen($pw) > 30 or strlen($pw) < 6) {
          array_push($this->errorArray, Constants::$passwordCharacters);
          return;
        }
    }

  }


 ?>
