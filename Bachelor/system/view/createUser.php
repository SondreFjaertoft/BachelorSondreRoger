
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<<<<<<< HEAD
=======
    <br><br><br><br>

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
  

 
>>>>>>> origin/master

    <div class="col-sm-3 col-md-4">
        <br><br><br><br>

        <?php
        $userResults = $GLOBALS["userInfo"];
        ?>

        <table class="table table-striped"> 
            <h4> Brukeroversikt </h4> 
            <thead>
                    <tr>
                        <th>Navn</th>
                        <th>Brukernavn</th>
                    </tr>
                </thead>
            
            
            <tbody>
                <?php foreach ($userResults as $userResults): ?>  
                    <tr class="clickable-row" data-href="?page=createUser">
                        <td><?php echo $userResults['name']; ?></td>
                        <td><?php echo $userResults['username']; ?></td>
                    </tr>
                <?php endforeach; ?> 
            </tbody>

        </table>
    </div>
 <div class="col-sm-3 col-md-4">
     
     <!-- HER KOMMER INNHOLDET>   --> 

 </div>

    <div class="col-sm-3 col-md-4">  
        <br><br><br><br>

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
        <!-- HER KOMMER INNHOLDET>   --> 
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
    });
});

</script>

