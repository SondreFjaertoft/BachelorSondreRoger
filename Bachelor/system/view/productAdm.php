
<?php require("view/header.php");?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

    <br><br><br><br>
    <div class="col-sm-3 col-sm-offset-1 col-md-6 col-md-offset-2 form-group">

        
        <!-- SØK ETTER PRODUKT-->
        
        <form id="searchForProduct" class="form-inline" action="?page=getAllProductInfo" method="post">
            <div class="form-group">
                <div class="col-md-9">
                    <input class="form-control" form="searchForProduct" type="text" name="givenProductSearchWord" value="" placeholder="Søk etter produkt..">  
                    <input class="form-control" form="searchForProduct" type="submit" value="Søk">
                    
                    <button onclick="UpdateProductTable()" class="btn btn-default " type="button">Alle producter</button>
                </div>
                <div class="col-md-1 col-md-offset-15">
                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#createProductModal">Opprett Produkt</button>
                </div>
            </div> 
        </form>


        
        <br>

         
        <!-- DISPLAY PRODUCT CONTAINER -->
        <br>
        <table class="table table-bordered table-striped table-responsive"> 
            <h4> Lageroversikt </h4> 
            <tbody id="displayProductContainer">

                <!-- HER KOMMER INNHOLDET FRA HANDLEBARS  -->

            </tbody>
        </table>   
           
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
                    <div style="text-align: center">
                        <form action="?page=addProductEngine" method="post" id="createProduct">
                            <p style="font-weight: bold ">Produktnavn:</p>
                            <input type="text" name="givenProductName" value=""><br>
                            <p style="font-weight: bold ">Kjøpspris:</p>
                            <input type="int" name="givenBuyPrice" value=""><br>
                            <p style="font-weight: bold ">Salgspris:</p>
                            <input type="int" name="givenSalePrice" value=""><br>
                            <p style="font-weight: bold ">Kategori:</p>
                            <input type="int" name="givenCategoryID" value=""><br>
                            <p style="font-weight: bold ">Media:</p>
                            <input type="int" name="givenMediaID" value=""><br>
                            <p style="font-weight: bold ">Produktnummer:</p>
                            <input type="text" name="givenProductNumber" value=""><br>
                            <p style="font-weight: bold ">MacAdresse:</p>
                            <input type="checkbox" id="TRUE" name="givenMacAdresse" value="TRUE"><br>
                            <br>
                            
                        </form> 
                    </div>
                </div>
                <div class="modal-footer">

                    <input class="btn btn-default" form="createProduct" type="submit" value="Opprett Produkt">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>

                </div>

            </div>
        </div>
    </div>



<!-- GET EDIT PRODUCT MODAL-->

<div class="modal fade" id="editProductModal" role="dialog">
    <div class="modal-dialog">
        <!-- Innholdet til Modalen -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Produkt informasjon</h4>
            </div>
            <form action="?page=editProductEngine" method="post" id="editProduct"></form>
            <div class="modal-body" id="editProductContainer">

                <!-- Innhold fra Handlebars Template-->

            </div>
            <div class="modal-footer">
                <input class="btn btn-default" type="submit" value="Lagre" form="editProduct">
                <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>
            </div>
        </div>
    </div>
</div> 




<!-- GET PRODUCT INFORMATION MODAL -->

<div class="modal fade" id="showProductInformationModal" role="dialog">
    <div class="modal-dialog">
        <!-- Innholdet til Modalen -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product informasjon</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered">
                    <tbody id="productInformationContainer">

                        <!-- Her kommer handlebars Template -->

                    </tbody>
                </table>
                <table class="table table-striped table-bordered">
                    <tbody>
                        <tr> 
                            <th>Lager med dette produktet: </th>
                            <td id="productLocationContainer"> 
                              
                                <!-- Her kommer handlebars Template -->
                                
                            </td>
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




<!-- DELETE PRODUCT MODAL-->

<div class="modal fade" id="deleteProductModal" role="dialog">
    <div class="modal-dialog">
        <!-- Innholdet til Modalen -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product informasjon</h4>
            </div>
            <form action="?page=deleteProductEngine" method="post" id="deleteProduct"></form>
            <div class="modal-body" id="deleteProductContainer">
                
                <!-- Innhold fra Handlebars Template -->

            </div>
            <div class="modal-footer">
                <input class="btn btn-default" type="submit" value="Slett" form="deleteProduct">
                <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>
            </div>
        </div>
    </div>
</div>




<!-- TEMPLATES-->

<script id="editProductTemplate" type="text/x-handlebars-template">
{{#each product}}    
    <input form="editProduct" type="hidden" name="editProductID" value="{{productID}}"><br>
    Produktnavn: <br>
    <input form="editProduct" type="text" name="editProductName" value="{{productName}}" autocomplete="off"><br>
    Kjøpspris: <br>
    <input form="editProduct" type="int" name="editBuyPrice" value="{{buyPrice}}" autocomplete="off"><br>
    Salgspris: <br>
    <input form="editProduct" type="int" name="editSalePrice" value="{{salePrice}}" autocomplete="off"><br>
    Kategori: <br>
    <input form="editProduct" type="int" name="editCategoryID" value="{{categoryID}}" autocomplete="off"><br>
    Media: <br>
    <input form="editProduct" type="int" name="editMediaID" value="{{mediaID}}" autocomplete="off"><br>
    Produktnummer: <br>
    <input form="editProduct" type="text" name="editProductNumber" value="{{productNumber}}" autocomplete="off"><br>
{{/each}} 
</script>  

<!-- Display productInformation-->
<script id="productInformationTemplate" type="text/x-handlebars-template">
{{#each product}}
<tr>
    <th>ProduktID: </th>
    <td>{{productID}}</td>
</tr>
<tr>
    <th>Produktnavn: </th>
    <td>{{productName}}</td>
</tr>
<tr>
    <th>Kjøpspris: </th>
    <td>{{buyPrice}}</td>
</tr>
<tr>
    <th>Salgspris: </th>
    <td>{{salePrice}}</td>
</tr>
<tr>
    <th>Kategori: </th>
    <td>{{categoryID}}</td>
</tr>
<tr>
    <th>Media: </th>
    <td>{{mediaID}}</td>
</tr>
<tr>
    <th>Produktnummer: </th>
    <td>{{productNumber}}</td>
</tr>    
{{/each}}                                                  
</script>

<!-- Display location of product, and quantity-->
<script id="productLocationTemplate" type="text/x-handlebars-template">
{{#each productLocation}}            
    {{storageName}},   Antall:  {{quantity}}<br>
{{/each}}      
</script>

<!-- Display what product you are deleting-->
<script id="deleteProductTemplate" type="text/x-handlebars-template">
    <p> Er du sikker på at du vil slette  <P>
{{#each product}}
    {{productName}}
    <input type="hidden" form="deleteProduct" name="deleteProductID" value="{{productID}}">    
{{/each}} 
</script>  

<!-- display all product template -->
<script id="displayProductTemplate" type="text/x-handlebars-template">

    {{#each productInfo}} 
    <tr> 
    <td class="text-center col-md-2">  


    <!-- Knapp som aktiverer Model for produktredigering  --> 

    <button data-id="{{productID}}" class="edit" data-toggle="tooltip"
    style="appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    outline: none;
    border: 0;
    background: transparent;
    display: inline;">
    <span class="glyphicon glyphicon-edit" style="color: green"></span>
    </button>


    <!-- Knapp som aktiverer Model for å vise productinformasjon  --> 

    <button data-id="{{productID}}" class="information" data-toggle="tooltip" 
    style="appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    outline: none;
    border: 0;
    background: transparent;
    display: inline;">
    <span class="glyphicon glyphicon-menu-hamburger" style="color: #003366" ></span>
    </button>


    <!-- Knapp som aktiverer Model for sletting av produkt  --> 



    <button data-id="{{productID}}" class="delete" data-toggle="tooltip" 
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

    <!-- Printer ut productnavn og katerogi inn i tabellen -->

    <th>Produktnavn: </th>
    <td>{{productName}}</td>
    <th>Katerogi: </th>
    <td>{{categoryID}}</td>    

    {{/each}}
    </tr>


</script>


<!-- DISPLAY PRODUCT MAIN TABLE -->

<!-- GET productInformation -->
<script>
    $(function () {
        $.ajax({
            type: 'GET',
            url: '?page=getAllProductInfo',
            dataType: 'json',
            success: function (data) {
                productTableTemplate(data);
            }
        });
    });
</script>

<!-- Update product information -->
<script>
    function UpdateProductTable() {
        $(function () {
            $.ajax({
                type: 'GET',
                url: '?page=getAllProductInfo',
                dataType: 'json',
                success: function (data) {
                    productTableTemplate(data);
                }
            });
        });
    }
</script>

<!-- Display storage template -->
<script>
    function productTableTemplate(data) {

        var rawTemplate = document.getElementById("displayProductTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var productTableGeneratedHTML = compiledTemplate(data);

        var productContainer = document.getElementById("displayProductContainer");
        productContainer.innerHTML = productTableGeneratedHTML;
    }
</script>



<!-- DELETE PRODUCT -->

<!-- Delete product modal -->
<script>
    $(function POSTdeleteProductModal() {

        $('#displayProductContainer').delegate('.delete', 'click', function () {
            var givenProductID = $(this).attr('data-id');

            $.ajax({
                type: 'POST',
                url: '?page=getProductByID',
                data: {givenProductID: givenProductID},
                dataType: 'json',
                success: function (data) {
                    deleteProductTemplate(data);
                    $('#deleteProductModal').modal('show');
                }
            });
            return false;

        });
    });
</script>  

<!-- Delete product template-->         
<script>
    function deleteProductTemplate(data) {
        var rawTemplate = document.getElementById("deleteProductTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var deleteProductGeneratedHTML = compiledTemplate(data);

        var productContainer = document.getElementById("deleteProductContainer");
        productContainer.innerHTML = deleteProductGeneratedHTML;
    }
</script>

<!-- Delete the product that is selected-->
<script>
    $(function deleteProductByID() {

        $('#deleteProduct').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function (data) {

                    UpdateProductTable();
                    $('#deleteProductModal').modal('hide');

                }
            });
            return false;
        });
    });

</script>



<!-- SHOW PRODUCT INFORMATION -->

<!-- get information from selected product-->
<script>
    $(function POSTproductInformationModal() {

        $('#displayProductContainer').delegate('.information', 'click', function () {
            var givenProductID = $(this).attr('data-id');
            POSTproductLocation(givenProductID);
            $.ajax({
                type: 'POST',
                url: '?page=getProductByID',
                data: {givenProductID: givenProductID},
                dataType: 'json',
                success: function (data) {
                    $('#showProductInformationModal').modal('show');
                    productInformationTemplate(data);

                }
            });
            return false;

        });
    });
</script>

<!-- Display storageInformation Template-->
<script>
    function productInformationTemplate(data) {
        var rawTemplate = document.getElementById("productInformationTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var productInformationGeneratedHTML = compiledTemplate(data);

        var productContainer = document.getElementById("productInformationContainer");
        productContainer.innerHTML = productInformationGeneratedHTML;
    }
</script>

<!-- Get productLocation from selected storage-->
<script>
    function POSTproductLocation(data) {
        var givenProductID = data;
        $(function () {
            $.ajax({
                type: 'POST',
                url: '?page=getProductLocation',
                data: {givenProductID: givenProductID},
                dataType: 'json',
                success: function (data) {
                    productLocationTemplate(data);
                }
            });
        });
    }
</script>

<!-- Display product location Template -->
<script>
    function productLocationTemplate(data) {
        var rawTemplate = document.getElementById("productLocationTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var storageProductGeneratedHTML = compiledTemplate(data);

        var storageContainer = document.getElementById("productLocationContainer");
        storageContainer.innerHTML = storageProductGeneratedHTML;
    }
</script>


<!-- EDIT PRODUCT -->

<!-- Get the selected product, and opens editProduct modal-->
<script>
    $(function POSTeditProductModal() {

        $('#displayProductContainer').delegate('.edit', 'click', function () {
            var givenProductID = $(this).attr('data-id');

            $.ajax({
                type: 'POST',
                url: '?page=getProductByID',
                data: {givenProductID: givenProductID},
                dataType: 'json',
                success: function (data) {
                    editProductTemplate(data);
                    $('#editProductModal').modal('show');
                }
            });
            return false;

        });
    });
</script>

<!-- Display edit product Template -->
<script>
    function editProductTemplate(data) {
        var rawTemplate = document.getElementById("editProductTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var editProductGeneratedHTML = compiledTemplate(data);

        var productContainer = document.getElementById("editProductContainer");
        productContainer.innerHTML = editProductGeneratedHTML;
    }
</script>

<!-- POST results from editing, and updating the table-->
<script>
    $(function POSTeditProductInfo() {

        $('#editProduct').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function () {
                    $('#editProductModal').modal('hide');
                    UpdateProductTable();
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


<!-- SEARCH FOR PRODUCT -->

<script>
    $(function POSTsearchForProduct() {

        $('#searchForProduct').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function (data) {
                    $("#searchForProduct")[0].reset();
                    productTableTemplate(data);
                }
            });
            return false;
        });
    });

</script>