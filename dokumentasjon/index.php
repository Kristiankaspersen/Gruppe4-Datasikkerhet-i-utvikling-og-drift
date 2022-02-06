<?php
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=s, initial-scale=1.0">
    <title>Dokumentasjon Gruppe4</title>
</head>
<body>
<h1> Dokumentasjon </h1>
<p>
    Velkommen til dokumentasjonen til steg 1. Vi er gruppe 4.
</p>

<h2> Gruppe 4 </h2>
<p>Kristian Kaspersen, kristkas@hiof.no </p>
<p>Vetle Wiedswang Jahr, vetlewj@hiof.no</p>
<p>Katrine Høyem, katrinhh@hiof.no </p>
<p>Kim Kopreitan Torgersen, kimkt@hiof.no</p>
<p>Martin Arthur Andersen, martiaan@hiof.no</p>
<p>Magnus Fagerli Antonsen, magnufa@hiof.no </p>
<p>Jonas Stock, jonassto@hiof.no </p>


<h2>
    Brukertyper
</h2>
<p> Vår løsning har tre ulike typer brukere med ulike rettigheter: student, foreleser og gjest </p>

<p><b>
    Student
</b></p>

<p>
    <ul>
        <li>
            Registrere seg med navn, epost, brukernavn, studieretning og passord.
        </li>
        <br><img src="img/student_signup.png"/>
        <li>
            Logger inn med med brukernavn/epost og passord.
        </li>
        <li>
            Sende anonyme melding om emne/fag.
        </li>
        <li>
            Bytte passord.
        </li>
        <li>
            Utføre glemt passord.
        </li>
    </ul>
</p>


<p><b>
    Foreleser
</b></p>

<p>
    <ul>
        <li>
            Registrere seg med navn, epost, brukernavn, emne og passord.
            <br><img src="img/lecture_signup.png"/>
        </li>
        
        <li>
            Logger inn med med brukernavn/epost og passord.
            <br><img src="img/login.png"/>
        </li>
        <li>
            Se alle meldinger og svar for et valgt emne.
        </li>
        <li>
            Bytte passord.
        </li>
        <li>
            Utføre glemt passord.
        </li>
        <li>
            Se alle meldinger og svar for et valgt emne.
        </li>

    </ul>
</p>


<p><b>
    Gjest
</b></p>
<p>
    <ul>
        <li>
            Logger inn med pinkode.
        </li>
        <li>
            Se alle meldinger og svar for et valgt emne.
        </li>
        <li>
            Krever forhåndskonfigurerte bruker-tilganger med tilganger
        </li>
    </ul>
</p>

<h2>
    API
</h2>
<p>
    Her er det beskrevet hvilke funksjoner vårt API har. API-kallene blir kjørt når man fyller ut skjemaet på /auth for student/foreleser
</p>
<p><b>
    Legge til bruker
</b></p>

<p>
    <ul>
        <li>
            liste
        </li>

    </ul>
</p>

<p><b>
    Slette bruker
</b></p>

<p>
    <ul>
        <li>
            liste
        </li>

    </ul>
</p>

<p><b>
    Oppdatere bruker
</b></p>

<p>
    <ul>
        <li>
            liste
        </li>

    </ul>
</p>

<p><b>
    Lese brukerdata
</b></p>

<p>
    <ul>
        <li>
            liste
        </li>

    </ul>
</p>

<h2> Meldinger og kommentarer </h2>
<p>
    <ul>
        <li>
            Gjestebrukere kan kommentere
        </li>
        <li>
            Studenter kan sende anonyme meldinger
        </li>

    </ul>
</p>

</body>
</html>

