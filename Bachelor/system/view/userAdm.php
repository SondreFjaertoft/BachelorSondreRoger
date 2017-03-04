<?php require("view/header.php"); ?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <br><br><br><br>


    <!-- DIV som holder på all informasjon til venstre på skjermen  -->


    <div class="col-sm-3 col-sm-offset-1 col-md-6 col-md-offset-2 form-group">

        <!-- SØK ETTER BRUKER  -->
        <form class="form-inline" id="searchForUser" action="?page=getUserInfo" method="post">
            <div class="form-group">
                <div class="col-md-9">
                    <input class="form-control" form="searchForUser" type="text" name="givenUserSearchWord" value="" placeholder="Søk etter bruker..">  
                    <input class="form-control" form="searchForUser" type="submit" value="Søk">
                    </form>            
                    <button onclick="AllUsers()" class="btn btn-default " type="button">Alle brukere</button
                </div>    

                
                <div class="col-md-1 col-md-offset-2">
                    <button class="btn btn-default " type="button" data-toggle="modal" data-target="#opprettbruker">Opprett bruker</button>
                </div>
            </div> 





            <!-- OPPRETT BRUKER  -->
            <div class="modal fade" id="opprettbruker" role="dialog">
                <div class="modal-dialog">
                    <!-- Innholdet til Modalen -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Opprett bruker</h4>
                        </div>
                        <div class="modal-body">
                            <div style="text-align: center">
                                <form action="?page=addUserEngine" method="post" id="createUser">
                                    <p style="font-weight: bold ">Name:</p>
                                    <input type="text" name="givenName" value=""><br>
                                    <p style="font-weight: bold ">Brukernavn:</p>
                                    <input type="text" name="givenUsername" value=""><br>
                                    <p style="font-weight: bold ">Passord:</p>
                                    <input type="text" name="givenPassword" value=""><br>
                                    <p style="font-weight: bold ">UserLevel:</p>
                                    <input type="text" name="givenUserLevel" value=""><br>
                                    <p style="font-weight: bold ">Email:</p>
                                    <input type="text" name="givenEmail" value=""><br>
                                    <br>
                                </form> 
                            </div>
                        </div>
                        <div class="modal-footer">

                            <input class="btn btn-default" form="createUser" type="submit" value="Opprett bruker">


                            <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>

                        </div>

                    </div>
                </div>
            </div> 

            <br>

            <?php
            $userResults = $GLOBALS["userInfo"];
            $userResults1 = $GLOBALS["userInfo"];
            $userResults2 = $GLOBALS["userInfo"];
            $restrictionResults = $GLOBALS["restrictionInfo"];
            $dropdownMeny = $GLOBALS["storageInfo"];
            ?>

            <!-- drop down meny -->

            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Velg Lager
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <table>
                        <?php foreach ($dropdownMeny as $dropdownMeny) : ?>
                            <tr>
                                <td><?php echo $dropdownMeny['storageName']; ?> </td>

                                <td><input form="restriction" id="<?php echo $dropdownMeny['storageID']; ?>" value="<?php echo $dropdownMeny['storageID']; ?>"  name="storageRestrictions[]" type="checkbox"></td>
                            </tr>
                        <?php endforeach; ?>

                    </table>
                    <button form="restriction" type="submit">Velg lagertilgang</button> 
                </ul>
            </div>





            <!-- TESTING AJAX DISPLAY USERS     --->       
            <br>
            <table class="table table-bordered table-striped table-responsive">

                <tbody id="userTable">

                </tbody>    

            </table>
            <!-- SLUTT PÅ TESTDIV --->









            <?php
            if (isset($_POST['userRestrictions']) && isset($_POST['storageRestrictions'])) {
                $userRes = $_REQUEST['userRestrictions'];
                $storageRes = $_REQUEST['storageRestrictions'];

                foreach ($userRes as $users) :


                    foreach ($storageRes as $storages):
                        echo "   brukerID: " . $users;
                        echo ",   Lager: " . $storages;
                    endforeach;
                endforeach;
            }
            ?>


            <!-- DIV som holder på all informasjon i midten av skjermen  -->




            <div class="col-sm-3 col-md-4">


                <?php
                foreach ($userResults1 as $userResults1):

                    if (isset($_POST['editUser'])) {
                        $givenUserID = $_REQUEST["editUser"];

                        if ($userResults1['userID'] == $givenUserID) {
                            ?>
                            <script>
                                $(function () {
                                    $('#brukerModal').modal('show');
                                });
                            </script>


                            <div class="modal fade" id="brukerModal" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Innholdet til Modalen -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Bruker informasjon</h4>
                                        </div>
                                        <div class="modal-body">

                                            <form action="?page=editUserEngine" method="post" id="formM">
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

                                            </form>

                                        </div>
                                        <div class="modal-footer">
                                            <input class="btn btn-default" type="submit" value="Lagre" form="formM">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <?php
                        }
                    }

// Vis Informasjon

                    if (isset($_POST['showInfo'])) {
                        $givenUserID = $_REQUEST["showInfo"];

                        if ($userResults1['userID'] == $givenUserID) {
                            ?>
                            <script>
                                $(function () {
                                    $('#brukerModal').modal('show');
                                });
                            </script>


                            <div class="modal fade" id="brukerModal" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Innholdet til Modalen -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Bruker informasjon</h4>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <th>UserID: </th>
                                                        <td><?php echo $userResults1['userID']; ?></td>
                                                    </tr>


                                                    <tr>
                                                        <th>Brukernavn: </th>
                                                        <td><?php echo $userResults1['username']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Brukernivå: </th>
                                                        <td><?php echo $userResults1['userLevel']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>E-post: </th>
                                                        <td><?php echo $userResults1['email']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Sist inlogget: </th>
                                                        <td><?php echo $userResults1['lastLogin']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Lagertilgang: </th>
                                                        <td><?php
                                                            foreach ($restrictionResults as $restrictionResults):
                                                                if ($restrictionResults['userID'] == $givenUserID) {
                                                                    echo $restrictionResults["storageName"];
                                                                    ?> <br>
                                                                    <?php
                                                                }
                                                            endforeach;
                                                            ?></td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <?php
                        }
                    }



                    // Slett bruker

                    if (isset($_POST['deleteUser'])) {
                        $givenUserID = $_REQUEST["deleteUser"];

                        if ($userResults1['userID'] == $givenUserID) {
                            ?>
                            <script>
                                $(function () {
                                    $('#brukerModal').modal('show');
                                });
                            </script>


                            <div class="modal fade" id="brukerModal" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Innholdet til Modalen -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Bruker informasjon</h4>
                                        </div>
                                        <div class="modal-body">

                                            <p> Er du sikker på at du vil slette  <P>
                                                <?php
                                                echo "Brukernavn: " . $userResults1['username'];
                                                ?>

                                            <form action="?page=deleteUserEngine" method="post" id="formS">
                                                <input type="hidden" name="deleteUserID" value="<?php echo $userResults1['userID'] ?>"><br>

                                            </form>


                                        </div>
                                        <div class="modal-footer">
                                            <input class="btn btn-default" type="submit" value="Slett" form="formS">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>
                                        </div>
                                    </div>
                                </div>
                            </div>               





                            <?php
                        }
                    }

                endforeach;
                ?>





            </div>





    </div>
</div>


<!-- HANDLEBARS TEMPLATES-->

<script id="displayUserTemplate" type="text/x-handlebars-template">
    
        {{#each users}}
            <tr>
                <td class="text-center"> 
                            
                    <form id="brukerRedForm" action="" method="post">
                    </form>

        <!-- Knapp som aktiverer Model for brukerredigering  --> 

                    <button form="brukerRedForm" type="submit" name="editUser" data-toggle="tooltip" title="Rediger bruker" value="{{userID}}" 
                        style="appearance: none;
                        -webkit-appearance: none;
                        -moz-appearance: none;
                        outline: none;
                        border: 0;
                        background: transparent;
                        display: inline;">
                         <span class="glyphicon glyphicon-edit" style="color: green"></span>
                    </button>
                     
                     
        <!-- Knapp som aktiverer Model for å vise brukerinformasjon  --> 

                    <button form="brukerRedForm" type="submit" name="showInfo" data-toggle="tooltip" title="Mer informasjon" value="{{userID}}" 
                        style="appearance: none;
                        -webkit-appearance: none;
                        -moz-appearance: none;
                        outline: none;
                        border: 0;
                        background: transparent;
                        display: inline;">
                        <span class="glyphicon glyphicon-menu-hamburger" style="color: #003366" ></span>
                    </button>
                     
        
        <!-- Knapp som aktiverer Model for sletting av bruker  --> 


                    <button form="brukerRedForm" name="deleteUser" data-toggle="tooltip" title="Slett bruker" value="{{userID}}" 
                        style="appearance: none;
                        -webkit-appearance: none;
                        -moz-appearance: none;
                        outline: none;
                        border: 0;
                        background: transparent;
                        display: inline;">
                        <span class="glyphicon glyphicon-remove" style="color: red"></span>
                    </button>

                </td>
                     
        <!-- Printer ut navn og brukernavn inn i tabellen -->
        
                <th>Navn: </th>
                <td>{{name}}</td>
                <th>Brukernavn: </th>
                <td>{{username}}</td>
                    
                     
        <!-- Legger inn chackbox for fler valg (ved lagertilganggiving -->


                <form action="?page=addRestriction" id="restriction" method="post">        </form>
                <td> <input form="restriction" id="{{userID}}" value="{{userID}}"  name="userRestrictions[]" type="checkbox"></td>

   
    

    {{/each}}
    </tr>
          

</script>


<!-- SCRIPT FOR OPPRETTELSE AV BRUKER (POST createUser Form) -->
<script>
    $(function POSTuserInfo() {

        $('#createUser').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function () {
                    $("#createUser")[0].reset();
                    $('#opprettbruker').modal('hide');
                    displayAddedUser();
                }
            });
            return false;
        });
    });

</script>

<!-- SEARCH FOR USERS -->
<script>
    $(function POSTsearchForUser() {

        $('#searchForUser').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function (data) {
                    $("#searchForUser")[0].reset();
                    usersTable(data);
                }
            });
            return false;
        });
    });

</script>


<script>
    function AllUsers() {
      displayAddedUser();
      }  
    

</script>


<!-- Rerun the GET fuc -->
<script>
    function displayAddedUser() {
        $(function () {
            $.ajax({
                type: 'GET',
                url: '?page=getUserInfo',
                dataType: 'json',
                success: function (data) {
                    usersTable(data);
                }
            });
        });
    }
</script>



<!-- SCRIPT FOR Å HENTE BRUKERINFORMASJON -->

<script>
    $(function () {
        $.ajax({
            type: 'GET',
            url: '?page=getUserInfo',
            dataType: 'json',
            success: function (data) {
                usersTable(data);
            }
        });
    });
</script>


<!-- TESTING HANDLEBARSS -->
<script>
    function usersTable(data) {

        var rawTemplate = document.getElementById("displayUserTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var UserTableGeneratedHTML = compiledTemplate(data);

        var userContainer = document.getElementById("userTable");
        userContainer.innerHTML = UserTableGeneratedHTML;

    }
</script>








