<?php
$dir = $_GET['dir'];


if(isset($_GET['delete_all_files'])) {
    $file_lists = scandir($dir);
    foreach($file_lists as $single_file){ // iterate files
      if(is_file($dir.$single_file)) {
        unlink($dir.$single_file); // delete file
      }
    }
    header('Location: http://service.e-cloudsoftware.com');
}

$files = scandir($dir);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>JPG FILES</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="container">
  <div class="alert alert-success" style="margin-top: 30px;">
    <strong>Success!</strong> You files has been converted to JPG successfully.
  </div>
  <a href="https://service.e-cloudsoftware.com/" class="btn btn-primary btn-sm"><i class="fa fa-upload"></i> Convert new file</a>
  <?php
    if(count($files) > 2) {
  ?>
    <a href="https://service.e-cloudsoftware.com/files.php?delete_all_files=true&dir=<?php echo $dir; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Clear all files</a>
  <?php } ?>
  <br>
  <br>
  
  <p style="border: 1px dashed; padding: 4px; background-color: antiquewhite">Shareable Link: <strong>https://service.e-cloudsoftware.com/shared.php?dir=<?php echo $dir; ?></strong></p>
  
  <?php
    $folder_name = str_replace('converted/', '', $dir);
    $folder_name = str_replace('/', '', $folder_name);
  ?>
  
  <p style="border: 1px dashed; padding: 4px; background-color: chocolate"><strong><a style="color: white;" href="https://service.e-cloudsoftware.com/zip/index.php?dir=<?php echo $folder_name; ?>" target="_blank"><i class="fa fa-download"></i> Download Zip </a></strong></p>
  
  <br><br>
  <input class="form-control" id="myInput" type="text" placeholder="Search..">
  <br>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th style="text-align:center;">#</th>
        <th>Filename</th>
        <th>Image</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="myTable">
    <?php
        $srl = 1;
        foreach($files as $key => $file) {
            if ($key == '0' || $key == '1'){
                continue;
            }
    ?>
      <tr>
        <td style="text-align:center;"><?php echo $srl++; ?></td>
        <td><?php echo $file; ?></td>
        <td><a title="click here to view this image" target="_blank" href="<?php echo $dir.$file; ?>"><img src="<?php echo $dir.$file; ?>" height="100" weight="100" /></a></td>
        <td><a href="<?php echo $dir.$file; ?>" download class="btn btn-success btn-xs"><i class="fa fa-download"></i> Download</a> </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  
 

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

</body>
</html>


