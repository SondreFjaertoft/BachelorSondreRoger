
<?php
$searchResult = $GLOBALS["storageResult"];
$storageInfo = $GLOBALS["storageResult"];
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <br><br><br><br>

    <div class="col-sm-3 col-md-4 form-group">


        <form action="?page=addStorageEngine" method="post">
            Navn på lager:<br>
            <input type="text" name="givenStorageName" value=""><br>

            <br>
            <input type="submit" value="Submit">
        </form>       



        <!-- HER KOMMER INNHOLDET>   --> 



        <table class="table table-bordered table-striped"> 


            <br><br>

            <!-- SØK ETTER LAGER -->

            <form class="form-inline" action="" method="post">
                <div class="form-group">

                    <input class="form-control" type="text" name="givenStorageSearchWord" value="" placeholder="Søk etter bruker..">  
                    <input class="form-control" type="submit" value="Søk">
                    <a href="?page=storageAdm" class="btn btn-default">Vis alle lagrer</a>

                </div> 
            </form>




            <h4> Brukeroversikt </h4> 
            <thead>
                <tr>
                    <th>Navn</th>
                    <th>Handlinger</th>
                </tr>
            </thead>


            <tbody>
                <?php foreach ($searchResult as $searchResult): ?>  
                    <tr>
                        <td><?php echo $searchResult['storageName']; ?></td>




                        <!-- Oppretter et form som knappene blir linket til  --> 



                        <td class="text-center">
                            <form id="storageRedForm" action="" method="post">
                            </form>



                            <!-- Knapp som aktiverer Model for lagerredigering  --> 

                            <button form="storageRedForm" type="submit" name="editStorage" data-toggle="tooltip" title="Rediger lager" value="<?php echo $searchResult['storageID']; ?>" 
                                    style="appearance: none;
                                    -webkit-appearance: none;
                                    -moz-appearance: none;
                                    outline: none;
                                    border: 0;
                                    background: transparent;
                                    display: inline;">
                                <span class="glyphicon glyphicon-edit" style="color: green"></span>
                            </button>



                            <!-- Knapp som aktiverer Model for å vise lagerinformasjon  --> 

                            <button form="storageRedForm" type="submit" name="showStorageInfo" data-toggle="tooltip" title="Mer informasjon" value="<?php echo $searchResult['storageID']; ?>" 
                                    style="appearance: none;
                                    -webkit-appearance: none;
                                    -moz-appearance: none;
                                    outline: none;
                                    border: 0;
                                    background: transparent;
                                    display: inline;">
                                <span class="glyphicon glyphicon-menu-hamburger" style="color: #003366" ></span></button>


                            <!-- Knapp som aktiverer Model for sletting av lager  --> 


                            <button form="storageRedForm" name="deleteStorage" data-toggle="tooltip" title="Slett lager" value="<?php echo $searchResult['storageID']; ?>" 
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
                                        <input type="text" name="editName" value="<?php echo $storageInfo['storageName']; ?>"><br>
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
                                    //                foreach ($restrictionResults as $restrictionResults):
                                    //                    if ($restrictionResults['userID'] == $givenUserID) {
                                    //                        echo $restrictionResults["storageName"];
                                    //                        ?> <br>
                                                            <?php
                                    //                    }
                                    //                endforeach;
                                                    ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <th>Utstyr i lageret: </th>
                                                
                                                <td><?php
                                    //                foreach ($restrictionResults as $restrictionResults):
                                    //                    if ($restrictionResults['userID'] == $givenUserID) {
                                    //                        echo $restrictionResults["storageName"];
                                    //                       ?> <br>
                                                             <?php
                                    //                    }
                                    //                endforeach;
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

            if (isset($_POST['deleteStorage'])) {
                $givenStorageID = $_REQUEST["deleteStorage"];

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
                                    <h4 class="modal-title">Lager informasjon</h4>
                                </div>
                                <div class="modal-body">

                                    <p> Er du sikker på at du vil slette  <P>
                                        <?php
                                        echo "Lagernavn: " . $storageInfo['storageName'];
                                        ?>

                                    <form action="?page=deleteStorageEngine" method="post" id="formS">
                                        <input type="hidden" name="deleteStorageID" value="<?php echo $storageInfo['storageID'] ?>"><br>

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


