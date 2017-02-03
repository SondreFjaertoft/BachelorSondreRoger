   
<?php
$results = $GLOBALS["dummy"];
?>

<div id="main-wrapper">
    <?php foreach ($results as $results): ?>        
        <?php echo "ID: " . $results['ID'] . ",  Brukernavn: " . $results['brukernavn'] . ",  Info: " . $results['tekst']; ?><br>


    <?php endforeach; ?>


    <br> <br>
    
    <?php
    $display = new Dummy();
    $getRow = $display->getAll();
    var_dump($getRow);
    ?>
    
    <b>Opprett ny brukerting</b>

    <form action="?page=addDummy" method="post">
        ID:<br>
        <input type="int" name="ID" value=""><br>
        Brukernavn:<br>
        <input type="text" name="brukernavn" value=""><br>
        Info:<br>
        <input type="text" name="tekst" value=""><br><br>
        <input type="submit" value="Submit">
    </form>
</div>
