<?php

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="style.css" />
        <title>API description</title>
    </head>
    <body>
        
        <h1>API beskrivelse</h1>
        <p> Det er 6 forskjellige tabeller hvor man kan create, read, update and delete (CRUD) på. </p>

        <p> comments, courses, lecturers, messages, replies, og students.  </p>

        <p>Hvordan man skriver, leser oppdaterer og sletter, gjøres slik i disse lenkene: </p>

        <ul>
           <li>api/&lt;hvor man vil sende data til&gt;/create.php</li>
           <li> api/&lt;hvor man vil lese data&gt;/read.php</li>
           <li>api/&lt;hvor man vil oppdatere data&gt;/update.php</li>
            <li> api/&lt;hvor man vil slette data&gt;/delete.php </li> 
        </ul>

        <h3>comments</h3>

        <ul>
            <li><a href="158.39.188.204/steg1/api/comments/create.php">api/comments/create.php</a></li>
            <li><a href="158.39.188.204/steg1/api/comments/read.php"> api/comments/read.php</a></li>
            <li><a href="158.39.188.204/steg1/api/comments/update.php">api/comments/update.php</a></li>
            <li><a href="158.39.188.204/steg1/api/comments/delete.php"> api/comments/delete.php</a> </li> 
         </ul>

         <h4>create sample data:</h4>
         <figure>
            <figcaption> comments/create.php </figcaption> 
            <pre class="codechunk">
                <code class="code"> 

     {
         "message_id": "1",  
         "comment_text": "Your comment"
     }

                </code>
            </pre>
        </figure>
         <h4>update sample data:</h4>
         <figure>
            <figcaption> comments/update.php </figcaption> 
            <pre class="codechunk">
                <code class="code"> 

     {
         "comment_id": "1",  
         "comment_text": "Your comment"
     }

                </code>
            </pre>
        </figure>
         
         <h4>delete sample data:</h4>
         <figure>
            <figcaption> comments/delete.php </figcaption> 
            <pre class="codechunk">
                <code class="code"> 

     {
         "comment_id": "1"  
     }

                </code>
            </pre>
        </figure>

         <h3>courses</h3>

        <ul>
            <li><a href="158.39.188.204/steg1/api/courses/create.php">api/courses/create.php</a></li>
            <li><a href="158.39.188.204/steg1/api/courses/read.php"> api/courses/read.php</a></li>
            <li><a href="158.39.188.204/steg1/api/courses/update.php">api/courses/update.php</a></li>
            <li><a href="158.39.188.204/steg1/api/courses/delete.php"> api/courses/delete.php</a> </li> 
         </ul>

         <h4>create sample data:</h4>
         <figure>
            <figcaption> course/create.php </figcaption> 
            <pre class="codechunk">
                <code class="code"> 
         {
            "course_id": "ITM30618",
            "course_name": "Innføring i innføring",
            "pin_code": "1234"
        }
                </code>
            </pre>
        </figure>
         <h4>update sample data:</h4>
         <figure>
            <figcaption> course/update.php </figcaption> 
            <pre class="codechunk">
                <code class="code"> 
         {
            "course_id": "ITM30618",
            "course_name": "new course name",
            "pin_code": "4321"
        }
                </code>
            </pre>
        </figure>
         <h4>delete sample data:</h4>
         <p>Om faget er knyttet til en lærer må du oppdatere faget læreren underviser i før man kan slette faget</p>
        <figure>
            <figcaption> course/delete.php </figcaption> 
            <pre class="codechunk">
                <code class="code"> 
        {
            "course_id": "ITM30618"
        }
                </code>
            </pre>
        </figure>

         <h3>lecturers</h3>

        <ul>
            <li><a href="158.39.188.204/steg1/api/lecturers/create.php">api/lecturers/create.php</a></li>
            <li><a href="158.39.188.204/steg1/api/lecturers/read.php"> api/lecturers/read.php</a></li>
            <li><a href="158.39.188.204/steg1/api/lecturers/update.php">api/lecturers/update.php</a></li>
            <li><a href="158.39.188.204/steg1/api/lecturers/delete.php"> api/lecturers/delete.php</a> </li> 
         </ul>

         <h4>create sample data:</h4>
         


         <h4>update sample data:</h4>
         <h4>delete sample data:</h4>

         <h3>messages</h3>

        <ul>
            <li><a href="158.39.188.204/steg1/api/messages/create.php">api/messages/create.php</a></li>
            <li><a href="158.39.188.204/steg1/api/messages/read.php"> api/messages/read.php</a></li>
            <li><a href="158.39.188.204/steg1/api/messages/update.php">api/messages/update.php</a></li>
            <li><a href="158.39.188.204/steg1/api/messages/delete.php"> api/messages/delete.php</a> </li> 
         </ul>

         <h4>create sample data:</h4>
         <h4>update sample data:</h4>
         <h4>delete sample data:</h4>

         <h3>replies</h3>

        <ul>
            <li><a href="158.39.188.204/steg1/api/replies/create.php">api/replies/create.php</a></li>
            <li><a href="158.39.188.204/steg1/api/replies/read.php"> api/replies/read.php</a></li>
            <li><a href="158.39.188.204/steg1/api/replies/update.php">api/replies/update.php</a></li>
            <li><a href="158.39.188.204/steg1/api/replies/delete.php"> api/replies/delete.php</a> </li> 
         </ul>

         <h4>create sample data:</h4>
         <h4>update sample data:</h4>
         <h4>delete sample data:</h4>

         <h3>students</h3>

        <ul>
            <li><a href="158.39.188.204/steg1/api/students/create.php">api/students/create.php</a></li>
            <li><a href="158.39.188.204/steg1/api/students/read.php"> api/students/read.php</a></li>
            <li><a href="158.39.188.204/steg1/api/students/update.php">api/students/update.php</a></li>
            <li><a href="158.39.188.204/steg1/api/students/delete.php"> api/students/delete.php</a> </li> 
         </ul>

         <h4>create sample data:</h4>
         <h4>update sample data:</h4>
         <h4>delete sample data:</h4>

    </body>
</html>
