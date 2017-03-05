<?php require("view/header.php");?>

<?php
$searchResult = $GLOBALS["storageResult"];
$storageInfo = $GLOBALS["storageResult"];
$storageAccess = $GLOBALS["storageAccess"];
$storageInventory = $GLOBALS["storageInventory"];

?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    
    <br><br><br><br>

    <div class="col-sm-3 col-sm-offset-1 col-md-6 col-md-offset-2 form-group">     

        <!-- HER KOMMER INNHOLDET>   --> 
        
        
            <!-- SØK ETTER LAGER -->

            <form class="form-inline" action="" method="post">
            <div class="form-group">
                <div class="col-md-9">
                    <input class="form-control" type="text" name="givenStorageSearchWord" value="" placeholder="Søk etter bruker..">  
                    <input class="form-control" type="submit" value="Søk">
                    <a href="?page=storageAdm" class="btn btn-default">Vis alle lagrer</a>
                </div>
                <div class="col-md-1 col-md-offset-2">
                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#opprettlager">Opprett Lager</button>
                </div>
            </div> 
        </form>


        <br>
            
        <!-- DISPLAY STORAGE CONTAINER -->
        <br>
        <table class="table table-bordered table-striped table-responsive"> 
            <h4> Lageroversikt </h4> 
            <tbody id="displayStorageContainer">
              
                <!-- HER KOMMER INNHOLDET FRA HANDLEBARS  -->
           
            </tbody>

        </table>

    </div>





    <!-- REDIGER LAGER -->


    <div class="col-sm-3 col-md-4">


        <?php
        foreach ($storageInfo as $storageInfo):

            if (isset($_POST['editStorage'])) {
                $givenStorageID = $_REQUEST["editStorage"];

                if ($storageInfo['storageID'] == $givenStorageID) {
                    ?>
                    <script>
                        $(function () {
                            $('#storageModal').modal('show');
                        });
                    </script>


                    <div class="modal fade" id="storageModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Innholdet til Modalen -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Bruker informasjon</h4>
                                </div>
                                <div class="modal-body">

                                    <form action="?page=editStorageEngine" method="post" id="formM">
                                        <input type="hidden" name="editStorageID" value="<?php echo $storageInfo['storageID']; ?>"><br>
                                        Lagernavn: <br>
                                        <input type="text" name="editStorageName" value="<?php echo $storageInfo['storageName']; ?>"><br>
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

// Vis Lager Informasjon

            if (isset($_POST['showStorageInfo'])) {
                $givenStorageID = $_REQUEST["showStorageInfo"];

                if ($storageInfo['storageID'] == $givenStorageID) {
                    ?>
                    <script>
                        $(function () {
                            $('#storageModal').modal('show');
                        });
                    </script>


                    <div class="modal fade" id="storageModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Innholdet til Modalen -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Lager Informasjon</h4>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>LagerID: </th>
                                                <td><?php echo $storageInfo['storageID']; ?></td>
                                            </tr>


                                            <tr>
                                                <th>lagernavn: </th>
                                                <td><?php echo $storageInfo['storageName']; ?></td>
                                            </tr>

                                            <tr>
                                                <th>Personer med tilgang: </th>

                                                <td><?php
                                                    foreach ($storageAccess as $storageAccess):
                                                        if ($storageAccess['storageID'] == $givenStorageID) {
                                                            echo $storageAccess["name"];
                                                            ?> <br>
                                                            <?php
                                                        }
                                                    endforeach;
                                                    ?></td>
                                            </tr>

                                            <tr>
                                                <th>Utstyr i lageret: </th>

                                                <td><?php
                                                    foreach ($storageInventory as $storageInventory):
                                                        if ($storageInventory['storageID'] == $givenStorageID) {
                                                            echo $storageInventory["productName"] . ", Antall: " . $storageInventory["quantity"];
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



    // Slett LAger

    if (isset($_POST['deleteStorage'])) {
        $givenStorageID = $_REQUEST["deleteStorage"];

        if ($storageInfo['storageID'] == $givenStorageID) {
            ?>



            





            <?php
        }
    }

endforeach;
?>


    </div>





    <div class="col-sm-3 col-md-4">  



        <!-- DIV som holder på all informasjon til høgre på skjermen  -->

        







        <!-- OPPRETT Lager  -->

        
        <div class="modal fade" id="opprettlager" role="dialog">
            <div class="modal-dialog">
                <!-- Innholdet til Modalen -->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Opprett bruker</h4>
                    </div>
                    <div class="modal-body">
                        <div style="text-align: center">
                            <form action="?page=addStorageEngine" method="post" id="form13">
                                Navn på lager:<br>
                                <input type="text" name="givenStorageName" value=""><br>

                                <br>

                            </form> 
                        </div>
                    </div>
                    <div class="modal-footer">

                        <input class="btn btn-default" form="form13" type="submit" value="Opprett Lager" href="?page=storageAdm">


                        <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>

                    </div>

                </div>
            </div>
        </div> 

    </div>

</div>


<div class="modal fade" id="deleteStorageModal" role="dialog">
    <div class="modal-dialog">
        <!-- Innholdet til Modalen -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Lager informasjon</h4>
            </div>
            <form action="?page=deleteStorageEngine" method="post" id="deleteStorage"></form>
            <div class="modal-body" id="deleteStorageContainer">

                <!-- Innhold fra Handlebars Template -->
                
            </div>
            <div class="modal-footer">
                <input form="deleteStorage" class="btn btn-default" type="submit" value="Slett">
                <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>
            </div>
        </div>
    </div>
</div>   

<script id="deleteStorageTemplate" type="text/x-handlebars-template">
    <p> Er du sikker på at du vil slette  <P>
    {{#each storage}}
        {{storageName}}
        <input type="hidden" form="deleteStorage" name="deleteStorageID" value="{{storageID}}">    
    {{/each}} 
</script>   
                


<!-- display all users template -->
<script id="displayStorageTemplate" type="text/x-handlebars-template">

    {{#each storageInfo}} 
    <tr>
    <td class="text-center">  

    <form id="brukerRedForm" action="" method="post">
    </form>
    
    
     
    <!-- Knapp som aktiverer Model for brukerredigering  --> 

    <button data-id="{{storageID}}" class="edit" data-toggle="tooltip"
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

    <button data-id="{{storageID}}" class="information" data-toggle="tooltip" 
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

     
   
    <button data-id="{{storageID}}" class="delete" data-toggle="tooltip" 
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

    <th>Lagernavn: </th>
    <td>{{storageName}}</td>

    {{/each}}
    </tr>


</script>



<!-- GET STORAGE INFOROMATION -->

<script>
    $(function () {
        $.ajax({
            type: 'GET',
            url: '?page=getAllStorageInfo',
            dataType: 'json',
            success: function (data) {
                storageTableTemplate(data);
            }
        });
    });
</script>

<!-- UPDATE USER INFOMARTION -->
<script>
    function UpdateStorageTable() {
        $(function () {
            $.ajax({
                type: 'GET',
                url: '?page=getAllStorageInfo',
                dataType: 'json',
                success: function (data) {
                    storageTableTemplate(data);
                }
            });
        });
    }
</script>

<!-- DISPLAY STORAGE TEMPLATE -->
<script>
    function storageTableTemplate(data) {

        var rawTemplate = document.getElementById("displayStorageTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var storageTableGeneratedHTML = compiledTemplate(data);

        var storageContainer = document.getElementById("displayStorageContainer");
        storageContainer.innerHTML = storageTableGeneratedHTML;
    }
</script>


<!--    DELETE USER     -->


<!-- DELETE USER MODAL -->
<script>
    $(function POSTdeleteUserModal() {

        $('#displayStorageContainer').delegate('.delete', 'click', function () {
            var givenStorageID = $(this).attr('data-id');
            
            $.ajax({
                type: 'POST',
                url: '?page=getStorageByID',
                data: {givenStorageID: givenStorageID},
                dataType: 'json',
                success: function (data) {
                    deleteStorageTemplate(data);
                    $('#deleteStorageModal').modal('show');
                }
            });
            return false;

        });
    });
</script>   

<!-- DELETE STORAGE TEMPLATE-->         
<script>
    function deleteStorageTemplate(data) {
        var rawTemplate = document.getElementById("deleteStorageTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var deleteStorageGeneratedHTML = compiledTemplate(data);

        var storageContainer = document.getElementById("deleteStorageContainer");
        storageContainer.innerHTML = deleteStorageGeneratedHTML;
    }
</script>

<script>
    $(function deleteStorageByID() {

        $('#deleteStorage').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function (data) {

                    UpdateStorageTable();
                    $('#deleteStorageModal').modal('hide');

                }
            });
            return false;
        });
    });

</script>