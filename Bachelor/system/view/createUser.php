
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
                            <form id="brukerRedForm" action="" method="post">
                            </form>
                            <span data-toggle="modal" data-target="#brukerModal" type="submit">
                                <button form="brukerRedForm" type="button" name="editUser" data-toggle="tooltip" title="Rediger bruker" value="<?php echo $userResults['userID']; ?>" 
                                        style="appearance: none;
                                        -webkit-appearance: none;
                                        -moz-appearance: none;
                                        outline: none;
                                        border: 0;
                                        background: transparent;
                                        display: inline;">
                                    <span class="glyphicon glyphicon-edit" style="color: green"></span></button>
                            </span>

                            <button form="brukerRedForm" name="showInfo" data-toggle="tooltip" title="Mer informasjon" value="<?php echo $userResults['userID']; ?>" 
                                    style="appearance: none;
                                    -webkit-appearance: none;
                                    -moz-appearance: none;
                                    outline: none;
                                    border: 0;
                                    background: transparent;
                                    display: inline;">
                                <span class="glyphicon glyphicon-menu-hamburger" style="color: #003366" ></span></button>

                            <button form="brukerRedForm" name="delete" data-toggle="tooltip" title="Slett bruker" value="<?php echo $userResults['userID']; ?>" 
                                    style="appearance: none;
                                    -webkit-appearance: none;
                                    -moz-appearance: none;
                                    outline: none;
                                    border: 0;
                                    background: transparent;
                                    display: inline;">
                                <span class="glyphicon glyphicon-remove" style="color: red"></span></button>


                        </td>
                    </tr>   
                <?php endforeach; ?> 
            </tbody>

        </table>
    </div>



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
                            echo"test";
                            foreach ($userResults1 as $userResults1):

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



