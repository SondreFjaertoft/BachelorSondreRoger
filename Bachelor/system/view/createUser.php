
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

    <div class="col-sm-3 col-md-4">
        <br><br><br><br>

        <?php
        $userResults = $GLOBALS["userInfo"];
        $userResults1 = $GLOBALS["userInfo"];
        ?>

        <table class="table table-bordered table-striped"> 
            <h4> Brukeroversikt </h4> 
            <thead>
                <tr>
                    <th>Navn</th>
                    <th>Brukernavn</th>
                    <th>Handlinger</th>
                </tr>
            </thead>


            <tbody>
                <?php foreach ($userResults as $userResults): ?>  
                    <tr>
                        <td><?php echo $userResults['name']; ?></td>
                        <td><?php echo $userResults['username']; ?></td>

                        <td class="text-center">
                            <form  action="" method="post">
                                <button  name="editUser" data-toggle="tooltip" value="<?php echo $userResults['userID']; ?>"><span class="glyphicon glyphicon-edit" style="color: green"></span> &nbsp;</button>
                            </form>

                            <form  action="" method="post">
                                <button name="showInfo" data-toggle="tooltip" value="<?php echo $userResults['userID']; ?>"><span class="glyphicon glyphicon-menu-hamburger"></span> &nbsp;</button>
                            </form>

                            <form  action="" method="post">
                                <button  name="delete" data-toggle="tooltip" value="<?php echo $userResults['userID']; ?>"><span class="glyphicon glyphicon-remove" style="color: red"></span></button>
                            </form>

                        </td>
                    </tr>   
                <?php endforeach; ?> 
            </tbody>

        </table>
    </div>
    <div class="col-sm-3 col-md-4">
        <br><br><br><br>






        <!-- DET SOM SKAL INN I PLUPPOPP RUTA  --> 

        <?php
        foreach ($userResults1 as $userResults1):
            
            
            
            // Rediger Bruker

            if (isset($_POST['editUser'])) {
                $givenUserID = $_REQUEST["editUser"];

                if ($userResults1['userID'] == $givenUserID) {
                    ?>

                    <form action="?page=editUserEngine" method="post">
                        <input type="hidden" name="editUserID" value=="<?php echo $userResults1['userID']; ?>"><br>
                        Navn: <br>
                        <input type="text" name="editName" value="<?php echo $userResults1['name']; ?>"><br>
                        Brukernavn: <br>
                        <input type="text" name="editUsername" value="<?php echo $userResults1['username']; ?>"><br>
                        Passord: <br>
                        <input type="text" name="editPassword" value="<?php echo $userResults1['password']; ?>"><br>
                        Brukernivå: <br>
                        <input type="text" name="editUserLevel" value="<?php echo $userResults1['userLevel']; ?>"><br>
                        Epost: <br>
                        <input type="text" name="editEmail" value="<?php echo $userResults1['email']; ?>"><br>
                        <br>
                        <input type="submit" value="Lagre">
                    </form>


                    <?php
                }
            }

            
            // Vis Informasjon
            
            if (isset($_POST['showInfo'])) {
                $givenUserID = $_REQUEST["showInfo"];

                if ($userResults1['userID'] == $givenUserID) {
                    echo "userID: " . $userResults1['userID'];
                }
            }

            
            
            // Slett bruker

            if (isset($_POST['delete'])) {
                $givenUserID = $_REQUEST["delete"];

                if ($userResults1['userID'] == $givenUserID) {
                    ?>
                    <p> Er du sikker på at du vil slette  <P>
                        <?php
                        echo "Brukernavn: " . $userResults1['username'];
                        ?>

                    <form action="?page=deleteUserEngine" method="post">
                        <input type="hidden" name="deleteUser" value="<?php $userResults1['userID'] ?>"><br>
                        <input type="submit" value="Slett">
                    </form>

                    <?php
                }
            }

        endforeach;
        
        ?>



        <!-- SLUTTEN AV PLOPPOPPRUTA   --> 






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



