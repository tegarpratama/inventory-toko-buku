<?php
include_once('Database.php');

class Auth extends Database{

   public function login()
   {
      $username = $_POST['username'];
      $password = $_POST['password'];

      $checkUsername = $this->connection->query("SELECT * FROM users WHERE username = '$username'");
      $checkPassword = $this->connection->query("SELECT * FROM users WHERE password = '$password'");

      // Check Username in Database
      if($checkUsername->num_rows > 0) {
         
         $rows = [];
         while ($row = $checkUsername->fetch_assoc()) {
            $rows[] = $row;
         }

         // Check Password in Database
         if(password_verify($password, $rows[0]['password'])){
            
            // Check is Admin
            if($this->_isAdmin($rows[0]['id']) == true){
               session_start();
               $_SESSION['login'] = true;
               header('Location: index.php');
            }
         }else{
            Flasher::setFlash('Username atau Password Salah !', 'danger');
         }
         
      }else {
         Flasher::setFlash('Username atau Password Salah !', 'danger');
      }
   }

   private function _isAdmin($id)
   {
      $checkAdmin = $this->connection->query("SELECT * FROM users_groups WHERE id_user = '$id'");
      
      if($checkAdmin->num_rows > 0){
         $rows = [];
         while ($row = $checkAdmin->fetch_assoc()) {
            $rows[] = $row;
         }

         if($rows[0]['id_group'] == 1){
            return true;
         }else{
            return false;
         }
      }else{
         return false;
      }
   }

}