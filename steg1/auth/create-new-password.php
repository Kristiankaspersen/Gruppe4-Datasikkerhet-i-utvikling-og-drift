<?php
    session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>

    <nav>
        <ul>
            <?php 
            $selector = $_GET["selector"];
            $validator = $_GET["validator"];
             
            if(empty($selector) || empty($validator)) {
                echo "Could not validate your request!"; 
            }else {
                if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
                    ?>
                    <form action="includes/reset-password.inc.php" method="post">
                        <input type="hidden" name="selector" value= "<?php echo $selector ?>">


                    <?php




                }
            }

            ?>