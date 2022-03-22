<?php
  function sendError($error) {
    // Didn't make a log DB - Just send back to user.
    echo json_encode(array('error'=>$error));   
  }
?>