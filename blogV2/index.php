<html>
<head>
    <link rel="stylesheet" href="design/css/main.css">
    <link href="src/css/lightbox.css" rel="stylesheet" />
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script src="src/js/adminCheck.js"></script>
</head>
<body>
<?php
    require_once("components/menu.php");
    $files = scandir("pages/");
    echo('<div class="flex-container">');
    if(isset($_GET["s"])){
        foreach ($files as $file)
        {
            if($file == $_GET["s"].".php")
            {
                require("pages/".$_GET["s"].".php");
            }
        }
    }else
    {
        require("pages/blog.php");
    }
    echo('</div>');
?>
<script src="src/js/jquery-3.4.1.min.js"></script>
<script src="src/js/lightbox.js"></script>
</body>
</html>
