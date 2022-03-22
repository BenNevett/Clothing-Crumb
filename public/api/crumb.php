<?php
  require 'getCategory.php';
  require 'sendError.php';
  
  if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $categoryData = getCategory($_GET['id']);
    $categoryCrumb = '';
    $topLevelFound = false;
    $hadError = false;
    do {
      if (isset($categoryData)) {
        if (isset($categoryData['name']) && isset($categoryData['parent_id']) && isset($categoryData['id'])) {
          $categoryCrumb = $categoryData['name'] . $categoryCrumb;
          
          if (intval($categoryData['parent_id']) == 0) {
            $topLevelFound = true;
          }
          else {
            if (isset($_GET['separator'])) {
              $categoryCrumb = ' ' . htmlspecialchars($_GET['separator'], ENT_QUOTES) . ' ' . $categoryCrumb;
            } else {
              $categoryCrumb = ' ' . $categoryCrumb;
            }
            
            $categoryData = getCategory($categoryData['parent_id']);
          }
        }
        else {
          $hadError = true;
          sendError('Incorrect data format');
        }
      } else {
        $hadError = true;
        sendError('No Data Found');
      } 
    } while (!$topLevelFound && !$hadError);
    
    if ($topLevelFound) {
      echo json_encode(array('crumb'=>$categoryCrumb));       
    }
  }
  else {
    sendError('No ID Found');
  }
?>