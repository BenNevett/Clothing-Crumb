<?php
  require 'config.php';

  function getCategory($id) {
    if (is_numeric($id)) {
      $conn = new mysqli(
        DB_HOST,
        DB_USER,
        DB_PASS,
        DB_NAME
      );
    
      if ($conn->connect_error) {
        sendError('Connection Error');
      } else {
        $stmt = $conn->prepare("SELECT * FROM Categories_Clothes WHERE id = ? LIMIT 1");
        if ($stmt !== FALSE) {
          $stmt->bind_param("i", $id);
          $stmt->execute();
          $result = $stmt->get_result()->fetch_assoc();
          
          if ($result) {
            return $result;
          }
      } 
    }
  }
}
?>