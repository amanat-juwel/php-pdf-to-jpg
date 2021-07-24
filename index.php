<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pdf to Jpg Converter</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
      .form {
        border: 2px dashed;
        border-radius: 5px;
        padding: 20px;
        margin-top: 20px;
        background-color: beige; 
      }
      
      .file-upload {
         background-color: #e6f5f3;
      }
  </style>
</head>
<body>

<div class="container">
  <center>
      <img src="pdf-to-jpg.jpg">
  </center>
  
  <form class="form" method="post" enctype="multipart/form-data">
      Select pdf files to upload:
      <input class="form-control file-upload" type="file" name="fileToUpload[]" id="fileToUpload" multiple="multiple" required>
      <input type="hidden" value="Upload Image" name="submit">
      <br>
      <button type="submit" class="btn btn-success btn-sm" >Submit</button>
  </form>
  
</div>


</body>
</html>

<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_file_uploads', '50');
error_reporting(E_ALL);
    
if(isset($_POST["submit"])) {
    $total = count($_FILES['fileToUpload']['name']);
   
    $created_directory = date('ymdhis');
    for( $i=0 ; $i < $total ; $i++ ) {
        
        $target_dir = "uploads/";
        $upload_file_name = basename($_FILES["fileToUpload"]["name"][$i]);
        $target_file = $target_dir . $upload_file_name;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
      
        if($imageFileType != "pdf") {
          echo "Sorry, only PDF files are allowed.";
          exit;
        }
        
        // Check file size
        // if ($_FILES["fileToUpload"]["size"] > 5000000) {
        //   echo "Sorry, your file is too large.";
        //   $uploadOk = 0;
        // }
    
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file);
        
        $file_path = $target_dir.$upload_file_name;
        
        $high_quality = false;
        
        if ($high_quality) {
            $imagick = new Imagick();
            $imagick->setResolution(300, 300);
            $imagick->readImage($file_path);
            $imagick->setImageFormat('jpeg');
            $imagick->setImageCompression(imagick::COMPRESSION_JPEG); 
            $imagick->setImageCompressionQuality(100);
            $upload_file_name = str_replace(".pdf","", $upload_file_name);
            if (!is_dir('converted'))
                mkdir('converted');
            $created_dir = "converted/".$created_directory.'/';
            if (!is_dir($created_dir))
                mkdir($created_dir);
            $imagick->writeImages($created_dir.$upload_file_name.".jpeg", true);
        } else {
            $imagick = new Imagick();
            $imagick->readImage($file_path);
            $upload_file_name = str_replace(".pdf","", $upload_file_name);
            if (!is_dir('converted'))
                mkdir('converted');
            $created_dir = "converted/".$created_directory.'/';
            if (!is_dir($created_dir))
                mkdir($created_dir);
            $imagick->writeImages($created_dir.$upload_file_name.".jpg", true);
        }
    }
    
    $file_lists = scandir($target_dir);
    foreach($file_lists as $single_file){ // iterate files
      if(is_file($target_dir.$single_file)) {
        unlink($target_dir.$single_file); // delete file
      }
    }


    header('Location: http://service.e-cloudsoftware.com/files.php?dir='.$created_dir);
}

exit;

?>
