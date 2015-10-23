<?php
include_once 'db.php';

$images = mysqli_query($conn, "SELECT * FROM slide_tb WHERE slideValidity=1");

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/jquery-1.10.2.js"></script>
    <link rel="stylesheet" type="text/css" href="css/slideshow_style.css">

    <script src="js/slideshow.js"></script>
    <title>Slideshow</title>
  </head>
  <body>


    <div class="container">


      <div class="alert alert-success alert-dismissible" role="alert" id="successAddingImage" style="display:none;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Success!</strong> Added image to slideshow!
      </div>

      <div class="alert alert-danger alert-dismissible" role="alert" id="failedAddingImage" style="display:none;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Error!</strong> Failed to add image to slideshow!
      </div>

      <div class="alert alert-success alert-dismissible" role="alert" id="successDeletingImage" style="display:none;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Success!</strong> Deleted image from slideshow!
      </div>

      <div class="alert alert-danger alert-dismissible" role="alert" id="failedDeletingImage" style="display:none;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Error!</strong> Failed to delete image from slideshow!
      </div>


      <div id="addImageToSlideShow">
        <form id="slideShowForm" method="post" enctype="multipart/form-data">
          <table style="width: 400px;">
            <tr>
              <td>
                <label>Select Image</label>
                <input type="file" name="file" id="file"/>
              </td>
              <td style="float: right;"><div id="imagePreview"></div></td>
            </tr>
          </table>
          <input type="submit" id="submitImage" class="btn btn-success">
        </form>

      </div>

      <div id="savedImages" class="container">
        <table id="slidesTable" class="table">
          <tbody>
            <?php
            if(mysqli_num_rows($images) > 0){
              while($row = mysqli_fetch_assoc($images)){
                $img = $row['slideFileName'];
                $id = $row['slideId'];
             ?>
            <tr>
              <td><div style="background: url('<?php echo $img;?>') no-repeat; background-size:cover; height:50px; width:50px;" ></div></td>
              <td valign="bottom"><div class="deleteImageFromSlideShow" id="deleteImage-<?php echo $id ;?>"><span id="trash" style="font-size: 20px;" class="glyphicon glyphicon-trash glyphicon-lg"></span></div></td>
            </tr>
            <?php
            }
          }
           ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="" id="deleteImageDialog" title="Delete Image?" style="display: none;">
      <label>Are you sure you want to remove this image from the dialog?</label>
    </div>
  </body>
</html>
