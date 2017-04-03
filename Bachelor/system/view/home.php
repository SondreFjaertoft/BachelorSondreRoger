<?php require("view/header.php"); ?>

<?php
if (isset($GLOBALS["errorMessage"])) {
    $test = $GLOBALS["errorMessage"];
}
?>



<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main row">
    <div id="message">
        <?php
        if (isset($GLOBALS["errorMessage"])) {
            echo $test;
        }
        ?>
    </div> 
    <div id="snarveidiv">

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="glyphicon glyphicon-bookmark"></span> Snarveier</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6 col-md-9 text-center">
                                <button class="btn btn-success btn-lg" type="button" data-toggle="modal" data-target="#createUserModal"><span class="glyphicon glyphicon-user"></span> <br/>Opprett bruker</button>
                                <button class="btn btn-warning btn-lg" onclick="createProductInfo();" type="button" data-toggle="modal" data-target="#createProductModal"><span class="glyphicon glyphicon-shopping-cart"></span> <br/>Opprett produkt</button>
                                <button class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#createStorageModal"><span class="glyphicon glyphicon-home"></span> <br/>Opprett lager</button>
                                <button class="btn btn-info btn-lg" role="button" data-toggle="modal" data-target="#createCategoryModal"><span class="glyphicon glyphicon-folder-open"></span> <br/>Oprett kategori</button>
                                <button class="btn btn-info btn-lg" onclick="getCategory()" type="button" data-toggle="modal" data-target="#uploadImageModal"><span class="glyphicon glyphicon-picture"></span> <br/>Last opp bilde</button>
                                <button class="btn btn-info btn-lg" onclick="getStorageInfo()" type="button" data-toggle="modal" data-target="#stockTakingModal"><span class="glyphicon glyphicon-picture"></span> <br/>Varetelling</button>
                                <button class="btn btn-info btn-lg" type="button" onclick="getStorageProduct()" data-toggle="modal" data-target="#stockDeliveryModal"><span class="glyphicon glyphicon-picture"></span> <br/>Varelevering</button>

                            </div>
                            <div class="col-xs-6 col-md-3 text-center">
                                <a href="?page=editUser" class="btn btn-success btn-lg" role="button"><span class="glyphicon glyphicon-user"></span> <br/>Rediger Profil</a>
                                <a href="../" class="btn btn-danger btn-lg" role="button"><span class="glyphicon glyphicon-log-out"></span> <br/>Logg ut</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="container">
        <div class="col-md-12">
            
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        
                        <select name="fromStorageID" id="chooseStorageContainer" class="form-control">

                                <!-- Her kommer Handlebars Template-->

                        </select>
                        
                    </div>
                

                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Produkt navn</th>
                            <th>Antall</th>
                        </tr>
                    </thead>
                    
                    <tbody id="chosenStorageContainer">
                        
                    <!-- Her kommer Handlebars Template-->
                    </tbody>
                </table>
            </div>
            </div>
            <div class="col-md-6">
                
                <canvas id="myChart"></canvas>
                
              
            </div>
            
        </div>



        <div class="col-md-12">
        <div class="col-sm-3 col-md-6">
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
        
        <div class="col-sm-3 col-md-6">
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

                                <form action="?page=uploadImageShortcut" id="uploadImage" method="post" enctype="multipart/form-data">
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
                                                <select name="givenCategoryID" id="selectCategory" required="required" class="form-control" autocomplete="off">
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

            <!-- Tom modal til Roger -->


            <div class="modal fade" id="stockTakingModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Innholdet til Modalen -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Varetelling</h4>
                        </div>
                        <form action="?page=stocktacking" method="post" id="stocktaking">

                            <div class="modal-body">
                                <select name="storageID" form="stocktaking" id="selectStorageContainer" class="form-control">

                                </select>
                                <br>
                                <table class="table" id="stockTakingContainer">

                                </table>

                            </div>
                            <div class="modal-footer">
                                <input form="stocktaking" class="btn btn-success" type="submit" value="Oppdater">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Avslutt</button>
                            </div>
                        </form>
                        </form>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="stockDeliveryModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Innholdet til Modalen -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Varelevering</h4>
                        </div>
                        <form action="?page=stockDelivery" method="post" id="stockDelivery">
                            <div class="modal-body">
                                <label>Velg produkt som inn på hovedlager</label>
                                <div id="stockDeliveryContainer">

                                </div>
                                <br><br>
                                <div>
                                    <table class="table table-bordered table-striped table-responsive" id="deliveryQuantityContainer">

                                        <!-- Lar deg velge antall enheter -->

                                    </table>

                                    
                                </div>                        


                            </div>
                            <div class="modal-footer">
                                <button form="stockDelivery" type="submit" class="btn btn-success" id="deliveryButton">Overfør</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Avslutt</button>
                            </div>
                        </form>
                        </form>

                    </div>
                </div>
            </div>        

            
<script id="deliveryQuantityTemplate" type="text/x-handlebars-template">
{{#each product}} 
    <tr class="selectQuantity">
        <th>Produkt:   </th>
        <td>{{productName}}</td>
        <input name="deliveryProductID[]" id="{{productID}}" form="stockDelivery" type="hidden" value="{{productID}}"/>
        <th>Antall:</th>
        <td><input name="deliveryQuantity[]" form="stockDelivery" required="required" type="number" min="1" max="1000" value="" autocomplete="off"/></td>  
        
        <td>
            <button id="redigerknapp" class="remove" data-toggle="tooltip" >
                <span class="glyphicon glyphicon-remove" style="color: red"></span>
            </button>
        </td>    
        
    </tr>
{{/each}}  
</script>

            <script id="stockTakingTemplate" type="text/x-handlebars-template">
            <input form="stocktaking" name="givenStorageID" type="hidden" value="{{storageProduct.0.storageID}}">
            {{#each storageProduct}}
    
                <tr>
                   <th id="bordernone">{{productName}}:</th>    
                       <input form="stocktaking" name="givenProductArray[]" type="hidden" value="{{productID}}">
                       <input form="stocktaking" name="oldQuantityArray[]" type="hidden" value="{{quantity}}">                       
                   <td id="bordernone"><input class="form-control" type="int" required="required" name="givenQuantityArray[]" value="{{quantity}}" autocomplete="off"></td>
                </tr>
    
    
              {{/each}} 
            </script>    

            <script id="stockDeliveryTemplate" type="text/x-handlebars-template">
                <br>  
                {{#each productInfo}} 
                <button data-id="{{productID}}" class="btn btn-default product">{{productName}}</button>
                {{/each}} 
            </script>

            <!-- Display storages in drop down meny Template -->
            <script id="selectStorageTemplate" type="text/x-handlebars-template">
            <option data-id="0" value="0" class="stockTaking">Velg et lager</option>
                {{#each storageInfo}}    
                    <tr>
                        <option data-id="{{storageID}}" value="{{storageID}}" class="stockTaking">{{storageName}}</option>
                    </tr>   
                {{/each}}
            </script>        

            <!-- Get the selected storage, and POST this to retrive inventory-->
            <script>

                function getStorageProduct() {
                    $.ajax({
                        type: 'GET',
                        url: '?page=getAllProductInfo',
                        dataType: 'json',
                        success: function (data) {
                            stockDeliveryTemplate(data);
                        }
                    });
                    return false;
                }
            </script>

            <!-- Display products in storage Template -->
            <script>
                function stockDeliveryTemplate(data) {
                    var rawTemplate = document.getElementById("stockDeliveryTemplate").innerHTML;
                    var compiledTemplate = Handlebars.compile(rawTemplate);
                    var deliverytGeneratedHTML = compiledTemplate(data);

                    var deliveryContainer = document.getElementById("stockDeliveryContainer");
                    deliveryContainer.innerHTML = deliverytGeneratedHTML;
                }
            </script>
            
            <!-- Get productInfo from selected ID -->
<script>
                            
    $(function POSTselectedProduct() {

        $('#stockDeliveryContainer').delegate('.product', 'click', function () {
            var givenProductID = $(this).attr('data-id');
              if( $('#'+givenProductID).length )   
            {
                return false;
            } else {
            
            
            $.ajax({
                type: 'POST',
                url: '?page=getProductByID',
                data: {givenProductID: givenProductID},
                dataType: 'json',
                success: function (data) {
                    deliveryQuantityTemplate(data);
                }
            });
            return false;

        }
        });
    });
</script> 

<script>
    function deliveryQuantityTemplate(data) {
        var rawTemplate = document.getElementById("deliveryQuantityTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var transferProductGeneratedHTML = compiledTemplate(data);

        var transferContainer = document.getElementById("deliveryQuantityContainer");
        transferContainer.innerHTML += transferProductGeneratedHTML;
        
    }
</script>

<script>
    $(function POSTtransferProducts() {

        $('#stockDelivery').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                error: function () {
                    var $displayUsers = $('#errorMessage');
                    $displayUsers.empty().append("Kunne ikke overføre");
                },
                success: function (data) {
                    $('#deliveryQuantityContainer').empty();
                    $('#stockDeliveryModal').modal('hide');
                }
            });
            return false;
        });
    });
</script>

<!-- remove product -->
<script>
    $(function POSTdeleteStorageModal() {

        $('#deliveryQuantityContainer').delegate('.remove', 'click', function () {
           var $tr = $(this).closest('tr');        
          
           $tr.fadeOut(150, function() {
            $(this).remove();
           });       
        });
    });
</script>  

            <!-- Get storage information  -->
            <script>
                function getStorageInfo() {
                    $.ajax({
                        type: 'GET',
                        url: '?page=getAllStorageInfo',
                        dataType: 'json',
                        success: function (data) {
                            selectStorageTemplate(data);
                        }
                    });
                }
            </script>

            <!-- Display storages in drop down meny Template -->
            <script>
                function selectStorageTemplate(data) {

                    var rawTemplate = document.getElementById("selectStorageTemplate").innerHTML;
                    var compiledTemplate = Handlebars.compile(rawTemplate);
                    var selectStorageGeneratedHTML = compiledTemplate(data);

                    var storageContainer = document.getElementById("selectStorageContainer");
                    storageContainer.innerHTML = selectStorageGeneratedHTML;


                }
            </script>

            <!-- Get the selected storage, and POST this to retrive inventory-->

            <script>
                var givenStorageID;
                $(function POSTfromStorageModal() {

                    $('#selectStorageContainer').on('change', function () {
                        givenStorageID = $(this).find("option:selected").data('id');

                        if (givenStorageID > 0) {
                            $.ajax({
                                type: 'POST',
                                url: '?page=getStorageProduct',
                                data: {givenStorageID: givenStorageID},
                                dataType: 'json',
                                success: function (data) {
                                    stockTakingTemplate(data);
                                }
                            });
                        }
                        return false;

                    });
                });
            </script>

            <!-- Display products in storage Template -->
            <script>
                function stockTakingTemplate(data) {
                    var rawTemplate = document.getElementById("stockTakingTemplate").innerHTML;
                    var compiledTemplate = Handlebars.compile(rawTemplate);
                    var stockTakingGeneratedHTML = compiledTemplate(data);

                    var stockTaking = document.getElementById("stockTakingContainer");
                    stockTaking.innerHTML = stockTakingGeneratedHTML;
                }
            </script>


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
                function createProductInfo() {
                    getMediaInfo();
                    getCategoryInfo();
                }
            </script>
            <script>
                function getCategory()
                {
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

                                $.each(data.mediaInfo, function (i, item) {


                                    $displayMediaInformation.append('<option value="' + item.mediaID + '">' + item.mediaName + '</option>');

                                });


                            }
                        });
                    });
                }
            </script>
            <script>
                function getCategoryInfo() {
                    var $displayCategoryInformation = $('#selectCategory');
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


            <!-- POST results from stocktaking, and updating the table-->
            <script>
                $(function POSTeditStorageInfo() {

                    $('#stocktaking').submit(function () {
                        var url = $(this).attr('action');
                        var data = $(this).serialize();
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: data,
                            dataType: 'json',
                            success: function () {
                                $('#stockTakingModal').modal('hide');
                            }
                        });
                        return false;
                    });
                });

            </script>

            <script>
$(document).ready(function()
{
    $('#stockDeliveryModal').on('hidden.bs.modal', function(e)
    { 
      $('#deliveryQuantityContainer').empty();
    }) ;
});
            </script>


            <!-- Get storage information with user restriction -->
<script>
 

    $(function () {
        $.ajax({
            type: 'GET',
            url: '?page=getTransferRestriction',
            dataType: 'json',
            success: function (data) {
                withdrawRestrictionTemplate(data);
            }
        });
    });
</script>

<!-- Display storages in drop down meny Template -->
<script>
    function withdrawRestrictionTemplate(data) {
        var rawTemplate = document.getElementById("chooseStorageTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var transferRestrictionGeneratedHTML = compiledTemplate(data);

        var transferContainer = document.getElementById("chooseStorageContainer");
        transferContainer.innerHTML = transferRestrictionGeneratedHTML;

    }
</script>

<!-- Display storages in drop down meny Template -->
<script id="chooseStorageTemplate" type="text/x-handlebars-template">
<option data-id="0" value="0" class="withdrawStorage">Velg et lager</option>
{{#each transferRestriction}}    
<tr>
    <option data-id="{{storageID}}" value="{{storageID}}" class="withdrawStorage">{{storageName}}</option>
</tr>   
{{/each}}
        
</script> 
<!-- Get the selected storage, and POST this to retrive inventory-->
<script>
    var givenStorageID;
    $(function POSTfromStorageModal() {
        
        $('#chooseStorageContainer').on('change', function () {
            givenStorageID = $(this).find("option:selected").data('id');
            
            chartTest(givenStorageID);

            if (givenStorageID > 0) {
                $.ajax({
                    type: 'POST',
                    url: '?page=getStorageProduct',
                    data: {givenStorageID: givenStorageID},
                    dataType: 'json',
                    success: function (data) {
                        chosenStorageTemplate(data);
                       
                    }
                });
            } 

            return false;

        });
    });
</script>

<script>
    function chosenStorageTemplate(data) {
        var rawTemplate = document.getElementById("chosenStorageTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var transferProductGeneratedHTML = compiledTemplate(data);

        var transferContainer = document.getElementById("chosenStorageContainer");
        transferContainer.innerHTML = transferProductGeneratedHTML;
    }
</script>

<script id="chosenStorageTemplate" type="text/x-handlebars-template">
     
    {{#each storageProduct}}
    <tr>
    <td>{{productName}}</td>
    <td>{{quantity}}</td>
    </tr>
    {{/each}} 
</script>

<!-- Get storageInventory from selected storage-->
<script>
    function chartTest(data) {
         
        var givenStorageID = data;
       
        $(function () {
          
            $.ajax({
                type: 'POST',
                url: '?page=chartProduct',
                data: {givenStorageID: givenStorageID},
                dataType: 'json',
                success: function (data) {

                    
                    drawChart(data);
                    
                }
            });
        });
    }
    
    var myObjBar;
    
    function drawChart(data)
    {
        if(myObjBar)
        {
            myObjBar.destroy();
        }
          var ctx = document.getElementById('myChart').getContext('2d');
          var product = [];
          var antall = [];
          var farge = [];
          


                        $.each(data, function(i, item){
                        product.push(item.productName);
                        antall.push(item.quantity);
                        });     
                        
                        var bars = antall;
                        for(i = 0; i < bars.length; i++){
                        //You can check for bars[i].value and put your conditions here
                        if(bars[i] <= 3)
                        {
                            farge.push("red");
                        }
                        else if(bars[i] < 5)
                        {
                            farge.push("yellow");
                        }
                        else if(bars[i] >= 10)
                        {
                            farge.push("green");
                        }
                        else
                        {
                            farge.push("yellow");
                        }
                        }
                            window.myObjBar = new Chart(ctx, {
                                
                            type: 'bar',
                            data: {
                                labels: product,
                                datasets: [
                                    {
                                        label: "Antall",
 
                                        borderColor: "black",
                                        backgroundColor: farge,
                                        borderWidth: 1,
                                        data: antall
                                      }
                            ]
                            },                    
                        
                            options: {
                                legend: {
                                    display: false
                                }
                            },
                            responsive : true

                        });
}
</script>


