<?php
    require_once "DatabaseConnection.php";
    include 'comments.inc.php';
?>


<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<h2> EMNE </h2>

<?php
 echo "<form method='POST' action='".setComments()."'>
        <input type='hidden' name='message_message_id' value='1'>
        <textarea name='comment_text'></textarea>
        <br>
        <button type='submit' name='commentSubmit'>Comment</button>
    </form> ";
?>
    </body>

</html>
