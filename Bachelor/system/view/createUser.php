
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

    <div class="col-sm-3 col-md-4">
        <br><br><br><br>

        <?php
        $userResults = $GLOBALS["userInfo"];
        $userResults1 = $GLOBALS["userInfo"];
        $userResults2 = $GLOBALS["userInfo"];
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
                            <form id="brukerRedForm" action="" method="post">
                            </form>
                            <span data-toggle="modal" data-target="#brukerModal" type="submit">
                                <button form="brukerRedForm" type="button" name="editUsers" data-toggle="tooltip" title="Rediger bruker" value="<?php echo $userResults['userID']; ?>" 
                                        style="appearance: none;
                                        -webkit-appearance: none;
                                        -moz-appearance: none;
                                        outline: none;
                                        border: 0;
                                        background: transparent;
                                        display: inline;">
                                    <span class="glyphicon glyphicon-edit" style="color: green"></span></button>
                            </span>

                            <button form="brukerShowForm" name="showInfo" data-toggle="tooltip" title="Mer informasjon" value="<?php echo $userResults['userID']; ?>" 
                                    style="appearance: none;
                                    -webkit-appearance: none;
                                    -moz-appearance: none;
                                    outline: none;
                                    border: 0;
                                    background: transparent;
                                    display: inline;">
                                <span class="glyphicon glyphicon-menu-hamburger" style="color: #003366" ></span></button>

                            <button form="brukerDelForm" name="delete" data-toggle="tooltip" title="Slett bruker" value="<?php echo $userResults['userID']; ?>" 
                                    style="appearance: none;
                                    -webkit-appearance: none;
                                    -moz-appearance: none;
                                    outline: none;
                                    border: 0;
                                    background: transparent;
                                    display: inline;">
                                <span class="glyphicon glyphicon-remove" style="color: red"></span></button>


                             <form  action="" method="post">
                                <button  name="editUser"  value="<?php echo $userResults['userID']; ?>"></button>
                            </form>


                        </td>
                    </tr>   
                <?php endforeach; ?> 
            </tbody>

        </table>
    </div>



    <!-- DET SOM SKAL INN I PLUPPOPP RUTA  --> 

<?php
        foreach ($userResults2 as $userResults2):
            
            
            
            // Rediger Bruker

            if (isset($_POST['editUser'])) {
                $givenUserID = $_REQUEST["editUser"];

                if ($userResults2['userID'] == $givenUserID) {
                    ?>

                    <form action="?page=editUserEngine" method="post">
                        <input type="hidden" name="editUserID" value=="<?php echo $userResults2['userID']; ?>"><br>
                        Navn: <br>
                        <input type="text" name="editName" value="<?php echo $userResults2['name']; ?>"><br>
                        Brukernavn: <br>
                        <input type="text" name="editUsername" value="<?php echo $userResults2['username']; ?>"><br>
                        Passord: <br>
                        <input type="text" name="editPassword" value="<?php echo $userResults2['password']; ?>"><br>
                        Brukernivå: <br>
                        <input type="text" name="editUserLevel" value="<?php echo $userResults2['userLevel']; ?>"><br>
                        Epost: <br>
                        <input type="text" name="editEmail" value="<?php echo $userResults2['email']; ?>"><br>
                        <br>
                        <input type="submit" value="Lagre">
                    </form>


                    <?php
                }
            }

            
            // Vis Informasjon
            
            if (isset($_POST['showInfo'])) {
                $givenUserID = $_REQUEST["showInfo"];

                if ($userResults2['userID'] == $givenUserID) {
                    echo "userID: " . $userResults2['userID'];
                }
            }

            
            
            // Slett bruker

            if (isset($_POST['delete'])) {
                $givenUserID = $_REQUEST["delete"];

                if ($userResults2['userID'] == $givenUserID) {
                    ?>
                    <p> Er du sikker på at du vil slette  <P>
                        <?php
                        echo "Brukernavn: " . $userResults2['username'];
                        ?>

                    <form action="?page=deleteUserEngine" method="post">
                        <input type="hidden" name="deleteUser" value="<?php $userResults2['userID'] ?>"><br>
                        <input type="submit" value="Slett">
                    </form>

                    <?php
                }
            }

        endforeach;
        
        ?>

    <!-- SLUTTEN AV PLOPPOPPRUTA   --> 



    <div class="col-sm-3 col-md-4">


        <div class = "modal fade" id = "brukerModal" role = "dialog">
            <div class = "modal-dialog">
                <!--Innholdet til Modalen -->
                <div class = "modal-content">
                    <div class = "modal-header">
                        <button type = "button" class = "close" data-dismiss = "modal">&times;
                        </button>
                        <h4 class = "modal-title">Bruker informasjon</h4>
                    </div>
                    <div class = "modal-body">
                        <div>
                            <p>Ditte her e en p</p>
                            <?php
                            foreach ($userResults1 as $userResults1):

                                if (isset($_POST['editUser'])) {

                                    $givenUserID = $_REQUEST["editUser"];

                                    if ($userResults1['userID'] == $givenUserID) {
                                        ?>
                                        <form action="?page=editUserEngine" method="post">
                                            <input type="hidden" name="editUserID" value="<?php echo $userResults1['userID']; ?>"><br>
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
                            endforeach;
                            ?> 

                        </div>
                    </div>
                    <div class = "modal-footer">
                        <button type = "button" class = "btn btn-default" data-dismiss = "modal">Avslutt</button>
                    </div>
                </div>
            </div>
        </div>


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


