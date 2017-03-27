<?php require("view/header.php"); ?>




<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div id="snarveidiv">
    <?php if ($_SESSION["userLevel"] == "Administrator") {?>
       <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-bookmark"></span> Snarveier</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6 col-md-8 text-center">
                            <button class="btn btn-success btn-lg" type="button" data-toggle="modal" data-target="#createUserModal"><span class="glyphicon glyphicon-user"></span> <br/>Opprett bruker</button>
                          <button class="btn btn-warning btn-lg" type="button" data-toggle="modal" data-target="#createProductModal"><span class="glyphicon glyphicon-shopping-cart"></span> <br/>Opprett produkt</button>
                          <button class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#createStorageModal"><span class="glyphicon glyphicon-home"></span> <br/>Opprett lager</button>
                          <button class="btn btn-info btn-lg" role="button"><span class="glyphicon glyphicon-folder-open"></span> <br/>Oprett kategori</button>
                          <button class="btn btn-info btn-lg" type="button" data-toggle="modal" data-target="#uploadImageModal"><span class="glyphicon glyphicon-picture"></span> <br/>Last opp bilde</button>
                          
                        </div>
                        <div class="col-xs-6 col-md-offset-1 col-md-3 text-center">
                          <a href="#" class="btn btn-success btn-lg" role="button"><span class="glyphicon glyphicon-user"></span> <br/>Rediger Profil</a>
                          <a href="../" class="btn btn-danger btn-lg" role="button"><span class="glyphicon glyphicon-log-out"></span> <br/>Logg ut</a>
                          </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
       <?php }else {?>
       
       <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-bookmark"></span> Snarveier</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6 col-md-7 text-center">
                          <a href="#" class="btn btn-danger btn-lg" role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/>Bæsjj</a>
                          <a href="#" class="btn btn-warning btn-lg" role="button"><span class="glyphicon glyphicon-bookmark"></span> <br/>Registrer Retur</a>
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-signal"></span> <br/>Overføring</a>
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-comment"></span> <br/>Dine Salg</a>
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-signal"></span> <br/>Dine Returer</a>
                          
                        </div>
                        <div class="col-xs-6 col-md-offset-2 col-md-3 text-center">
                          <a href="#" class="btn btn-success btn-lg" role="button"><span class="glyphicon glyphicon-user"></span> <br/>Rediger Profil</a>
                          <a href="../" class="btn btn-danger btn-lg" role="button"><span class="glyphicon glyphicon-log-out"></span> <br/>Logg ut</a>
                          </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <?php }?>
        
    </div>
   <div class="container">

       
       



    <div class="col-sm-3 col-md-4" style="border: solid black 1px">
        <h3 class="col-md-6"> LAGERSTATUS</h3>   
        <p style="margin-top: 22px">-- (Dropdown her med velg lager?)</p>
        <script>
            document.write('<p>Klokka di rågær: <span id="date-time">', new Date().toLocaleString(), '<\/span>.<\/p>');
            if (document.getElementById)
                onload = function () {
                    setInterval("document.getElementById ('date-time').firstChild.data = new Date().toLocaleString()", 50);
                };
        </script>

        <canvas id="lagerstatus"></canvas>
        <script>
            var ctx = document.getElementById('lagerstatus').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["FMG", "Dekoder", "Roger", "Sondre", "Ole", "Tafjord", "DØØMEEE"],
                    datasets: [
                        {
                            label: "Antall produkter i lageret",
                            backgroundColor: [
                                'rgba(0, 46, 96, 0.7)',
                                'rgba(255, 211, 0, 0.7)',
                                'rgba(0, 46, 96, 0.7)',
                                'rgba(255, 211, 0, 0.7)',
                                'rgba(0, 46, 96, 0.7)',
                                'rgba(255, 211, 0, 0.7)',
                                'rgba(0, 46, 96, 0.7)'

                            ],
                            borderColor: [
                                'rgba(0, 46, 96, 1)',
                                'rgba(255, 211, 0, 1)',
                                'rgba(0, 46, 96, 1)',
                                'rgba(255, 211, 0, 1)',
                                'rgba(0, 46, 96, 1)',
                                'rgba(255, 211, 0, 1)',
                                'rgba(0, 46, 96, 1)'
                            ],
                            borderWidth: 1,
                            data: [65, 59, 80, 81, 56, 55, 0]
                        }
                    ]
                },
                options: {
                    legend: {
                        display: false
                    }
                }

            });
        </script>
    </div>
    <div class="col-sm-3 col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title text-center"><b>MEST SOLGTE PRODUKTER</b></h3>
            </div>
         
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produkt</th>
                    <th>Lager</th>
                    <th>Antall</th>

                </tr>
            </thead>
            <tbody>

                <!-- HER KOMMER TABELL INNHOLDET>   -->  

            </tbody>
        </table>
        </div>
    </div>
    <div class="col-sm-3 col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title text-center"><b>SISTE SALG</b></h3>
            </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produkt</th>
                    <th>Lager</th>
                    <th>Antall</th>
                </tr>
            </thead>
            <tbody>

                <!-- HER KOMMER TABELL INNHOLDET>   -->  

            </tbody>
        </table>
        </div>


    </div>

    <!-- HER KOMMER INNHOLDET>   -->                

    
    <!-- Opprett bruker modal -->
    
    
    <div class="modal fade" id="createUserModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Innholdet til Modalen -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Opprett bruker</h4>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <table class="table">
                                <form action="?page=addUserEngine" method="post" id="createUser">
                                    <tr>
                                        <th style="border: none">Name:</th>
                                        <td style="border: none"><input class="form-control" type="text" name="givenName" required="required" value="" autocomplete="off"></td>
                                    </tr>
                                    <tr>
                                        <th>Brukernavn:</th>
                                        <td><input class="form-control" type="text" name="givenUsername" required="required" value="" autocomplete="off"></td>
                                    </tr>
                                    <tr>
                                        <th>Passord:</th>
                                        <td><input class="form-control" type="text" name="givenPassword" required="required" value="" autocomplete="off"></td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td><input class="form-control" type="text" name="givenEmail" required="required" value="" autocomplete="off"></td>
                                    </tr>
                                    <tr>
                                        <th>UserLevel:</th>                                       
                                        <td><div>
                                                <select name="givenUserLevel" required="required" class="form-control" autocomplete="off">
                                                    <option></option>
                                                    <option value="User">User</option>
                                                    <option value="Administrator">Administrator</option>
                                                </select>  
                                            </div>
                                            </td>
                                    </tr>
                                    
                                   
                                </form>
                                    </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <p id="errorMessage"></p>
                            <input class="btn btn-default" form="createUser" type="submit" value="Opprett bruker">


                            <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>

                        </div>

                    </div>
                </div>
            </div>
    
</div>
    
    <!-- CREATE PRODUCT MODAL -->


    <div class="modal fade" id="createProductModal" role="dialog">
        <div class="modal-dialog">
            <!-- Innholdet til Modalen -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Opprett Produkt</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <table class="table table-bordered table-striped table-responsive">
                        <form action="?page=addProductEngine" method="post" id="createProduct">
                            <tr>
                                <th>Produktnavn:</th>
                                <td><input type="text" required="required" name="givenProductName" value="" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <th>Kjøpspris:</th>
                                <td><input type="int" required="required" name="givenBuyPrice" value="" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <th>Salgspris:</th>
                                <td><input type="int" required="required" name="givenSalePrice" value="" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <th>Kategori:</th>
                                <td><input type="int" required="required" name="givenCategoryID" value="" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <th>Media:</th>
                                <td><input type="int" required="required" name="givenMediaID" value="" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <th>Produktnummer:</th>
                                <td><input type="text" required="required" name="givenProductNumber" value="" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <th>MacAdresse:</th>
                                <td><input type="checkbox" id="TRUE" name="givenMacAdresse" value="TRUE"></td>
                            </tr>
                            
                            
                        </form>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">

                    <input class="btn btn-default" form="createProduct" type="submit" value="Opprett Produkt">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>

                </div>

            </div>
        </div>
    </div>
    
    
    <!-- CREATE STORAGE MODAL -->


<div class="modal fade" id="createStorageModal" role="dialog">
    <div class="modal-dialog">
        <!-- Innholdet til Modalen -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Opprett bruker</h4>
            </div>
            <div class="modal-body">
                <div style="text-align: center">
                    <table class="table table-bordered table-striped table-responsive">
                    <form action="?page=addStorageEngine" method="post" id="createStorage">
                        <tr>
                            <th>Lagernavn:</th>
                            <td><input type="text" required="required" name="givenStorageName" value=""></td>
                        </tr>
                    </form> 
                    </table>
                </div>
            </div>
            <div class="modal-footer">

                <input class="btn btn-default" form="createStorage" type="submit" value="Opprett Lager" href="?page=storageAdm">


                <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>

            </div>

        </div>
    </div>
</div> 
    
    <!-- UPLOAD IMAGE MODAL -->


<div class="modal fade" id="uploadImageModal" role="dialog">
    <div class="modal-dialog">
        <!-- Innholdet til Modalen -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Last opp bilde</h4>
            </div>
            <div class="modal-body">
                <div style="text-align: center">

                    <form action="?page=uploadImageShortcut" id="uploadImage" method="post" enctype="multipart/form-data">
                        <p>Velg bilde for å laste opp:</p>
                        <input type="file" name="fileToUpload" required="required" id="fileToUpload"><br>
                        velg en katerogi:
                        <input type="text" name="givenCaterogy" required="required"><br>
                        

                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <input form="uploadImage" type="submit" value="Upload Image" name="submit" href="?page=uploadImage">
                <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>

            </div>

        </div>
    </div>
</div> 
    
<!-- Create product -->
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
                error: function() {         
                    var $displayError = $('#errorMessage');
                    $displayError.empty().append("Brukernavn trolig i bruk");
                },
                success: function () {
                    $("#createUser")[0].reset();
                    $('#createUserModal').modal('hide');
                    $('#errorMessage').remove();
                    
                }
            });
            return false;
        });
    });

</script>

<!-- CREATE PRODUCT -->

<script>
    $(function POSTproductInfo() {

        $('#createProduct').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function () {
                    $("#createProduct")[0].reset();
                    $('#createProductModal').modal('hide');
                    UpdateProductTable();
                }
            });
            return false;
        });
    });

</script>

<!-- CREATE STORAGE -->


<script>
    $(function POSTstorageInfo() {

        $('#createStorage').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function () {
                    $("#createStorage")[0].reset();
                    $('#createStorageModal').modal('hide');
                    UpdateStorageTable();
                }
            });
            return false;
        });
    });

</script>

