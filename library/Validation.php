<?php

class Validation {

   public function isEmpty($data)
   {
      if(empty($data) || !isset($data) || $data == null) {
         return false;
      }else{
         return $data;
      }
   }

   public function isNumber($data)
   {
      if(is_numeric($data) && !empty($data)){
         return $data;
      }else{
         return false;
      }
   }

   public function checkInput($data)
   {
      if($this->isEmpty($data) != false){
         $result = trim($data);
         $result = htmlspecialchars($result);
         $result = stripslashes($result);
         return $result;
      }else{
         return false; 
      }
   }


}