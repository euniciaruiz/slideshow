<?php
include_once 'db.php';

  $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_JPG, IMAGETYPE_BMP, IMAGETYPE_ICO);
  $detectedType = exif_imagetype($_FILES['file']['tmp_name']);
  $error = !in_array($detectedType, $allowedTypes);


  if($error){
    echo json_encode("error");
  }else{
    if($_FILES['file']['error'] > 0){
      echo json_encode("error! file is not an image!");
    }
    else{
      if(file_exists("images/".$_FILES['file']['name'])){
        echo json_encode("error! file exists~");
      }else {
        $target = "images/".$_FILES['file']['name'];
        $path = "http://139.162.25.179/pepper/eunice/product_introduction/".$target;
        $move = move_uploaded_file($_FILES['file']['tmp_name'], $target);
        if($move){
          echo json_encode("moved");
          $now = date('Y-m-d H:i:s');
          $sql = "INSERT INTO `slide_tb`(`slideFileName`, `slideRecodeDate`, `slideValidity`) VALUES(?, '$now', 1)";
          if($secure = $conn->prepare($sql)){
            $secure->bind_param("s", $path);
            $secure->execute();
            echo json_encode("inserted");
          }else {
            echo json_encode("error in query");
          }
        }else {
          echo json_encode("error in moving");
        }
      }
    }
  }
// else {
  //     if(file_exists("images/".$_FILES['file']['name'])){
  //       echo json_encode("error! image already exists!");
  //     }else{
  //       $target = "images/".$_FILES['file']['name'];
  //       $path = "http://139.162.25.179/pepper/eunice/product_introduction/".$target;
  //       $move = move_uploaded_file($_FILES['file']['tmp_name'], $target);
  //       if($move){
  //         echo "moved!";
  //         $now = date('Y-m-d H:i:s');
  //         $sql = "INSERT INTO  `slide_tb`(`slideFileName`, `slideRecodeDate`, `slideValidity`) VALUES(?, '$now', 1)";
  //
  //         if($secure = $conn->prepare($sql)){
  //           $secure->bind_param("s", $path);
  //           $secure->execute();
  //           echo json_encode("inserted");
  //         }else {
  //           echo json_encode("error! image not inserted!");
  //         }
  //       }else {
  //         echo json_encode("error! image not moved!");
  //       }
  //     }
  //   }
  // }
 ?>
