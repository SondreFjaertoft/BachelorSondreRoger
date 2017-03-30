<?php require("view/header.php"); ?>




<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div id="snarveidiv">
        <?php if ($_SESSION["userLevel"] == "Administrator") { ?>
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
                                    <button class="btn btn-warning btn-lg" onclick="createProductInfo();" type="button" data-toggle="modal" data-target="#createProductModal"><span class="glyphicon glyphicon-shopping-cart"></span> <br/>Opprett produkt</button>
                                    <button class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#createStorageModal"><span class="glyphicon glyphicon-home"></span> <br/>Opprett lager</button>
                                    <button class="btn btn-info btn-lg" role="button" data-toggle="modal" data-target="#createCategoryModal"><span class="glyphicon glyphicon-folder-open"></span> <br/>Oprett kategori</button>
                                    <button class="btn btn-info btn-lg" onclick="getCategoryInfo()" type="button" data-toggle="modal" data-target="#uploadImageModal"><span class="glyphicon glyphicon-picture"></span> <br/>Last opp bilde</button>

                                </div>
                                <div class="col-xs-6 col-md-offset-1 col-md-3 text-center">
                                    <a href="?page=editUser" class="btn btn-success btn-lg" role="button"><span class="glyphicon glyphicon-user"></span> <br/>Rediger Profil</a>
                                    <a href="../" class="btn btn-danger btn-lg" role="button"><span class="glyphicon glyphicon-log-out"></span> <br/>Logg ut</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>

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
        <?php } ?>

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
                    <h3 class="panel-title text-center"><b>Lite ting og tang on the lager</b></h3>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Produkt</th>
                            <th>Lager</th>
                            <th>Antall</th>
                        </tr>
                        <tr class="bg-info">
                            <td>FMG</td>
                            <td>Hovedlager</td>
                            <td>7</td>
                        </tr>
                        <tr class="bg-warning">
                            <td>Roger</td>
                            <td>Hovedlager</td>
                            <td>5</td>
                        </tr>
                        <tr class="bg-danger">
                            <td>Sondre</td>
                            <td>KS-lager</td>
                            <td>3</td>
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
                    <h3 class="panel-title text-center"><b>Siste hendelser</b></h3>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Aktivitet</th>
                            <th>Bruker</th>
                            <th>Info</th>
                        </tr>
                        <tr>
                            <td>Salg</td>
                            <td>Roger</td>
                            <td>Fmg 4</td>
                        </tr>
                        <tr>
                            <td>Retur</td>
                            <td>Sondre</td>
                            <td>Dekoder 2</td>
                        </tr>
                        <tr>
                            <td>Sparken</td>
                            <td>Ole</td>
                            <td>Beeing a retard</td>
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



                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p id="errorMessage"></p>
                        <input class="btn btn-success" form="createUser" type="submit" value="Opprett bruker">


                        <button type="button" class="btn btn-danger" data-dismiss="modal">Avslutt</button>

                    </div>
                    </form>

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
                        <table class="table">
                        <form action="?page=addProductEngine" method="post" id="createProduct">
                            <tr>
                                <th id="bordernone">Produktnavn:</th>
                                <td id="bordernone"><input class="form-control" type="text" required="required" name="givenProductName" value="" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <th>Pris:</th>
                                <td><input class="form-control" type="int" required="required" name="givenPrice" value="" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <th>Kategori:</th>
                                <td>
                                    <select name="givenCategoryID" id="selectCategoryID" required="required" class="form-control" autocomplete="off">
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Media:</th>
                                <td>
                                    <select name="givenMediaID" id="selectMediaID" required="required" class="form-control" autocomplete="off">
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>MacAdresse:</th>
                                <td><input type="checkbox" id="TRUE" name="givenMacAdresse" value="TRUE"></td>
                            </tr>
                            
                            <input form="createProduct" type="hidden" id="date" name="date">
                        
                        </table>
                    </div>
                </div>
                <div class="modal-footer">

                    <input class="btn btn-success" form="createProduct" type="submit" value="Opprett Produkt">
                    
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Avslutt</button>

                </div>
                </form>
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
                    <form action="?page=addStorageEngine" method="post" id="createStorage">
                        <div style="text-align: center">
                            <table class="table">                   
                                <tr>
                                    <th id="bordernone">Lagernavn:</th>
                                    <td id="bordernone"><input class="form-control" type="text" required="required" name="givenStorageName" value=""></td>
                                </tr>

                            </table>
                        </div>
                </div>
                <div class="modal-footer">

                    <input class="btn btn-success" form="createStorage" type="submit" value="Opprett Lager" href="?page=storageAdm">


                    <button type="button" class="btn btn-danger" data-dismiss="modal">Avslutt</button>

                </div>
                </form>
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

                        <form action="?page=uploadImage" id="uploadImage" method="post" enctype="multipart/form-data">
                            <h4 class="text-center">Velg bilde for å laste opp</h4>
                        <table class="table">
                            <tr>
                                <th class="col-sm-4 col-md-4" id="bordernone">Velg en fil:</th>
                                <th class="col-sm-4 col-md-4" id="bordernone"></th>
                                <th class="col-sm-4 col-md-4" id="bordernone">Velg en katerogi:</th>
                            </tr>
                        
                            
                            <tr>                           
                                <td id="bordernone">
                                    <label class="btn btn-primary" for="fileToUpload">
                                        Legg til bilde
                                        <input type="file" name="fileToUpload" required="required" id="fileToUpload" style="display: none;" onchange="$('#upload-file-info').html($(this).val());"></td>
                                    </label>
                                <td id="bordernone"><span class="label label-default" id="upload-file-info"></span></td>
                                <td id="bordernone">
                                    <select name="givenCategoryID" id="selectCategoryID" required="required" class="form-control" autocomplete="off">
                                    </select>
                                </td>
                            </tr>
                        </table>
                        
                    </div>
                </div>
                <div class="modal-footer">
                <input class="btn btn-success" form="uploadImage" type="submit" value="Upload Image" name="submit" href="?page=uploadImage">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Avslutt</button>
                </div>
                </form>
            </div>
        </div>
    </div> 


    <!-- CREATE CATEGORY MODAL -->


    <div class="modal fade" id="createCategoryModal" role="dialog">
        <div class="modal-dialog">
            <!-- Innholdet til Modalen -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Opprett bruker</h4>
                </div>
                <div class="modal-body">
                    <form action="?page=addCategoryEngine" method="post" id="createCategory">
                        <div style="text-align: center">
                            <table class="table">                   
                                <tr>
                                    <th id="bordernone">Kateroginavn:</th>
                                    <td id="bordernone"><input class="form-control" type="text" required="required" name="givenCategoryName" value=""></td>
                                </tr>

                            </table>
                        </div>
                </div>
                <div class="modal-footer">

                    <input class="btn btn-success" form="createCategory" type="submit" value="Opprett Kategori">


                    <button type="button" class="btn btn-danger" data-dismiss="modal">Avslutt</button>

                </div>
                </form>
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
                    error: function () {
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
                    }
                });
                return false;
            });
        });

    </script>

    <script>
        $(function POSTstorageInfo() {

            $('#createCategory').submit(function () {
                var url = $(this).attr('action');
                var data = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    dataType: 'json',
                    success: function () {
                        $("#createCategory")[0].reset();
                        $('#createCategoryModal').modal('hide');
                    }
                });
                return false;
            });
        });

    </script>

    <script>
        function getCategoryInfo() {
            var $displayCategoryInformation = $('#selectCategoryID');
            $displayCategoryInformation.empty();
            $(function () {
                $.ajax({
                    type: 'GET',
                    url: '?page=getAllCategoryInfo',
                    dataType: 'json',
                    success: function (data) {

                        $.each(data.categoryInfo, function (i, item) {


                            $displayCategoryInformation.append('<option value="' + item.categoryID + '">' + item.categoryName + '</option>');

                        });


                    }
                });
            });
        }
    </script>
    
    <script>
function createProductInfo(){
    getMediaInfo();
    getCategoryInfo();
}                    
</script>
<script>
 function getMediaInfo() {
    var $displayMediaInformation = $('#selectMediaID');
    $displayMediaInformation.empty();
    $(function () {
        $.ajax({
            type: 'GET',
            url: '?page=getAllMediaInfo',
            dataType: 'json',
            success: function (data) {
                
                $.each(data.mediaInfo, function(i, item) {

                
                $displayMediaInformation.append('<option value="'+item.mediaID+'">'+item.mediaName+'</option>');
                    
                });                
                
                
            }
        });
    });
 }
</script>

<script>
 function getCategoryInfo() {
    var $displayCategoryInformation = $('#selectCategoryID');
    $displayCategoryInformation.empty();
    $(function () {
        $.ajax({
            type: 'GET',
            url: '?page=getAllCategoryInfo',
            dataType: 'json',
            success: function (data) {
                
                $.each(data.categoryInfo, function(i, item) {

                
                $displayCategoryInformation.append('<option value="'+item.categoryID+'">'+item.categoryName+'</option>');
                    
                });                
                
                
            }
        });
    });
 }
</script>
    
    
    
    
    
    
    