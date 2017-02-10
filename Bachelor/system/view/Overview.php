   
<?php
$results = $GLOBALS["dummyInfo"];
?>

<div id="main-wrapper">
    
    <?php foreach ($results as $results): ?>   
    
        <?php echo "ID: " . $results['ID'] . ",  Brukernavn: " . $results['brukernavn'] . ",  Info: " . $results['tekst']; ?><br>


    <?php endforeach; ?>


    <br> <br>
    
    
    <b>Opprett ny brukerting</b>

    <form action="?page=dummyAdd" method="post">
        ID:<br>
        <input type="int" name="givenID" value=""><br>
        Brukernavn:<br>
        <input type="text" name="givenUser" value=""><br>
        Info:<br>
        <input type="text" name="givenTekst" value=""><br><br>
        <input type="submit" value="Submit">
    </form>
</div>


    <form action="?page=addUserEngine" method="post">
        Name:<br>
        <input type="text" name="givenName" value=""><br>
        Brukernavn:<br>
        <input type="text" name="givenUsername" value=""><br>
        Password:<br>
        <input type="text" name="givenPassword" value=""><br>
        UserLevel:<br>
        <input type="text" name="givenUserLevel" value=""><br>
        Email:<br>
        <input type="text" name="givenEmail" value=""><br>
        <br>
        <input type="submit" value="Submit">
    </form>