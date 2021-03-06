<?php include '../includes/db.php'; ?>
<?php include 'functions.php'; ?>
<?php ob_start(); ?>
<?php session_start(); ?>


<?php 

if (!isset($_SESSION['user_role'])) {
        ?>
        <script>
            window.top.location = "../index.php";
        </script>
        <?php
        // header("Location: ../index.php");

}


 if (!is_admin($_SESSION['username'])) {
                    ?>
    <script>
       
        window.top.location = "../index.php";
    </script>
    <?php
    // header("Location: index.php");
    } 
    
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>OPAS Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/style.css" rel='stylesheet' type='text/css' />

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- for admin charts -->
    <script type="text/javascript" src="gstatic/loader.js"></script>
    <!-- for input editor -->
    <!-- another part (function) on js/scripts.js -->
    <script src="nicedit/nicEdit.js" type="text/javascript"></script>
    
<!--     <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script> -->
<!-- <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script> -->
        
         <!-- jQuery -->         
        <script src="js/jquery.js"></script>       
</head>

<body>
