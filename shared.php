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

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://rawgit.com/LeshikJanz/libraries/master/Bootstrap/baguetteBox.min.css">
  
    <title>IMAGE FILES</title>
    <style>
        body {
            background-color: #434c50;
            min-height: 100vh;
            font: normal 16px sans-serif;
            padding: 40px 0;
        }
        
        .container.gallery-container {
            background-color: #fff;
            color: #35373a;
            min-height: 100vh;
            padding: 30px 50px;
        }
        
        .gallery-container h1 {
            text-align: center;
            margin-top: 50px;
            font-family: 'Droid Sans', sans-serif;
            font-weight: bold;
        }
        
        .gallery-container p.page-description {
            text-align: center;
            margin: 25px auto;
            font-size: 18px;
            color: #999;
        }
        
        .tz-gallery {
            padding: 40px;
        }
        
        /* Override bootstrap column paddings */
        .tz-gallery .row > div {
            padding: 2px;
        }
        
        .tz-gallery .lightbox img {
            width: 100%;
            border-radius: 0;
            position: relative;
        }
        
        .tz-gallery .lightbox:before {
            position: absolute;
            top: 50%;
            left: 50%;
            margin-top: -13px;
            margin-left: -13px;
            opacity: 0;
            color: #fff;
            font-size: 26px;
            font-family: 'Glyphicons Halflings';
            content: '\e003';
            pointer-events: none;
            z-index: 9000;
            transition: 0.4s;
        }
        
        
        .tz-gallery .lightbox:after {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            background-color: rgba(46, 132, 206, 0.7);
            content: '';
            transition: 0.4s;
        }
        
        .tz-gallery .lightbox:hover:after,
        .tz-gallery .lightbox:hover:before {
            opacity: 1;
        }
        
        .baguetteBox-button {
            background-color: transparent !important;
        }
        
        @media(max-width: 768px) {
            body {
                padding: 0;
            }
        }
    </style>
</head>
<body>

<div class="container gallery-container">

    <h1>PDF TO JPG FILES</h1>

    <p class="page-description text-center">View all images smoothly</p>
    
    <div class="tz-gallery">

        <div class="row">
            <?php
                $srl = 1;
                foreach($files as $key => $file) {
                    if ($key == '0' || $key == '1'){
                        continue;
                    }
            ?>
            <div class="col-sm-12 col-md-4">
                <a class="lightbox" href="<?php echo $dir.'/'.$file; ?>">
                    <img src="<?php echo $dir.'/'.$file; ?>" alt="image">
                </a>
            </div>
            <?php }
                if($srl == 1) {
            ?>
             <div class="col-sm-12 col-md-4">
                <p>Oops! This folder does not exist anymore!</p>
            </div>
            <?php } ?>

        </div>

    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script>
    baguetteBox.run('.tz-gallery');
</script>
</body>
</html>


</body>
</html>


