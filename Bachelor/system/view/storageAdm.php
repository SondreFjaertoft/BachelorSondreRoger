<?php require("view/header.php"); ?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

    <div class="container">

    <div class="col-sm-3 col-sm-offset-1 col-md-10 col-md-offset-1 form-group">     


        <!-- SØK ETTER LAGER -->

        <form class="form-inline" id="searchForStorage" action="?page=getAllStorageInfo" method="post">
            <div class="form-group">
                <div class="col-md-9">
                    <input class="form-control" form="searchForStorage"type="text" name="givenStorageSearchWord" value="" placeholder="Søk etter Lager..">  
                    <input class="form-control" form="searchForStorage" type="submit" value="Søk">

                    <button onclick="UpdateStorageTable()" class="btn btn-default " type="button">Alle lagrer</button>
                </div>
                <div class="col-md-1 col-md-offset-15">
                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#createStorageModal">Opprett Lager</button>
                </div>
            </div> 
        </form>


        <br>

        <!-- DISPLAY STORAGE CONTAINER -->
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title text-center"><b>Lageroversikt</b></h3>
            </div>
        <table class="table table-bordered table-striped table-responsive"> 
             
            <tbody id="displayStorageContainer">

                <!-- HER KOMMER INNHOLDET FRA HANDLEBARS  -->

            </tbody>

        </table>
            
        </div>

    </div>
</div>




<!-- DIV som holder på all informasjon til høgre på skjermen  -->


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
                    <table class="table">
                    <form action="?page=addStorageEngine" method="post" id="createStorage">
                         
                        <tr>
                            <th id="bordernone">Lagernavn:</th>
                            <td id="bordernone"><input class="form-control" type="text" required="required" name="givenStorageName" value=""></td>
                            
                        </tr>
                    
                    </table>
                </div>
            </div>
            <div class="modal-footer">

                <input class="btn btn-success" form="createStorage" type="submit" value="Opprett Lager">

                <button type="button" class="btn btn-danger" data-dismiss="modal">Avslutt</button>

            </div>
            </form>
        </div>
    </div>
</div> 






<!-- EDIT STORAGE MODAL-->


<div class="modal fade" id="editStorageModal" role="dialog">
    <div class="modal-dialog">
        <!-- Innholdet til Modalen -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Lager informasjon</h4>
            </div>
            <form action="?page=editStorageEngine" method="post" id="editStorage"> 
            
            <div class="modal-body">
                <table class="table" id="editStorageContainer">
                    

                <!-- Innhold fra Handlebars Template -->
                    
                </table>
            </div>
            
            <div class="modal-footer">
                <input class="btn btn-success" form="editStorage" type="submit" value="Lagre" form="editStorage">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Avslutt</button>
            </div>
            </form>
        </div>
    </div>
</div> 




<!-- GET STORAGE INFORMATION MODAL-->

<div class="modal fade" id="showStorageInformationModal" role="dialog">
    <div class="modal-dialog" style="width: 70%">
        <!-- Innholdet til Modalen -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Lager Informasjon</h4>
            </div>
            <div class="modal-body row">
                <div class="col-sm-3 col-md-5">
                    <div class="col-md-12">
                    <table class="table">
                        <tbody id="storageInformationContainer">

                            <!-- Her kommer handlebars Template -->

                        </tbody>
                    </table>
                    </div>
                    <div class="col-md-6">
                    
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="panel-title text-center"><b>Brukere med tilgang</b></h2>
                            </div>
                    <table class="table">
                        
                        <tbody id="storageRestrictionContainer">
                            
                                
                                

                                    <!-- Her kommer handlebars Template -->

                                
                                                  
                        </tbody>    
                    </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="panel-title text-center"><b>Produkt i lager</b></h2>
                            </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Produkt</th>
                                <th>Antall</th>  
                            </tr>
                          </thead>  
                        <tbody id="storageProductContainer">
                            
                        </tbody>

                    </table>
                    </div>
                    </div>
                </div>
                <div class="col-sm-9 col-md-7">

                    <canvas id="myChart"></canvas>
                    
                </div>
                    
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-danger" data-dismiss="modal">Avslutt</button>

            </div>
        </div>
    </div>
</div> 




<!-- DELETE STORAGE MODAL -->


<div class="modal fade" id="deleteStorageModal" role="dialog">
    <div class="modal-dialog">
        <!-- Innholdet til Modalen -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Lager informasjon</h4>
            </div>
            <form action="?page=deleteStorageEngine" method="post" id="deleteStorage">
            <div class="modal-body" id="deleteStorageContainer">

                <!-- Innhold fra Handlebars Template -->

            </div>
                <p id="errorMessage">
                    
                </p>    
            <div class="modal-footer">
                <input form="deleteStorage" class="btn btn-success" type="submit" value="Slett">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Avslutt</button>
            </div>
            </form>    
        </div>
    </div>
</div>   



<!-- STOCKTAKING MODAL -->

<div class="modal fade" id="stocktakingModal" role="dialog">
    <div class="modal-dialog">
        <!-- Innholdet til Modalen -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Lagertelling</h4>
            </div>
            <form action="?page=stocktacking" method="post" id="stocktaking">
               
            <div class="modal-body" >
                <table class="table" id="stocktakingContainer">
                <!-- Innhold fra Handlebars Template -->
                </table>
                <table class="table" id="stocktakingResultContainer">
                <!-- Innhold fra Handlebars Template -->
                </table>
            </div>
                   
            <div class="modal-footer">
                <input form="stocktaking" class="btn btn-success" type="submit" value="Oppdater">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Avslutt</button>
            </div>
            </form>    
        </div>
    </div>
</div>   




</div>

<!-- TEMPLATES -->

<!-- Display stocktacing product-->
<script id="stocktakingResultTemplate" type="text/x-handlebars-template">
 <thead>
    <tr>
        <th>Produkt</th>
        <th>Gammel verdi</th>
        <th>Ny verdi</th>
        <th>differanse</th>    
    </tr>
</thead>
<tbody>
{{#each differanceArray}}
    <tr>
        <td>{{productName}}</td>
        <td>{{oldQuantity}}</td>
        <td>{{newQuantity}}</td>
        <td>{{differance}}</td>    
    </tr>

</tbody>
{{/each}} 
  
</script>


<!-- Display stocktacing product-->
<script id="stocktakingTemplate" type="text/x-handlebars-template">
<input form="stocktaking" name="givenStorageID" type="hidden" value="{{storageProduct.0.storageID}}">
{{#each storageProduct}}
    
    <tr>
       <th id="bordernone">{{productName}}:</th>    
           <input form="stocktaking" name="givenProductArray[]" type="hidden" value="{{productID}}">
           <input form="stocktaking" name="oldQuantityArray[]" type="hidden" value="{{quantity}}"> 
           <input form="stocktaking" name="givenProductNAmeArray[]" type="hidden" value="{{productName}}">            
       <td id="bordernone"><input class="form-control" type="int" required="required" name="givenQuantityArray[]" value="{{quantity}}" autocomplete="off"></td>
    </tr>
    
    
  {{/each}} 
  
</script>

<!-- Display editStorage-->                    
<script id="editStorageTemplate" type="text/x-handlebars-template">
    {{#each storage}}    
    <input form="editStorage" type="hidden" name="editStorageID" value="{{storageID}}">
    <tr>
    <th id="bordernone">Lagernavn: </th> 
    <td id="bordernone"><input class="form-control" form="editStorage" required="required" type="text" name="editStorageName" value="{{storageName}}" autocomplete="off"></td> 
    </tr>
    {{/each}}            
</script>  


<!-- Display StorageInformation-->
<script id="storageInformationTemplate" type="text/x-handlebars-template">
    {{#each storage}}    
    <tr>  
    <th id="bordernone" class="col-md-1">LagerID: </th>
    <td id="bordernone">{{storageID}}</td> 
    </tr>
    <tr>
    <th class="col-md-1">lagernavn: </th>
    <td>{{storageName}}</td>
    </tr>
    {{/each}}                
</script>   

<!-- Display StorageRetricton-->
<script id="storageRestrictionTemplate" type="text/x-handlebars-template">
    {{#each storageRestriction}}
    <tr>
        <td >
            <button id="redigerknapp" data-id="{{userID}}" class="deleteUserRestriction" data-toggle="tooltip" title="Fjern lagertilgang">
            <span class="glyphicon glyphicon-remove" style="color: red"></span>
            </button>
        </td>
    <td >{{name}}</td>    
    </tr>        
    {{/each}}       
</script>

<!-- Display StorageProduct-->
<script id="storageProductTemplate" type="text/x-handlebars-template">
    {{#each storageProduct}}
    <tr>
        <td >
        <button id="redigerknapp" data-id="{{productID}}" class="deleteStorageInventory" data-toggle="tooltip" title="Fjern lagertilgang">
            <span class="glyphicon glyphicon-remove" style="color: red"></span>
        </button>
        </td>
        <th>{{productName}}</th>
        <td class="quantityColor"> {{quantity}}</td>
     
    </tr>
    {{/each}}    
</script>


<!-- Display what storage you are deleting-->
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
    <td class="text-center col-md-2">  


    <!-- Knapp som aktiverer Model for lagerredigering  --> 

    <button id="redigerknapp" data-id="{{storageID}}" class="edit" data-toggle="tooltip" title="Rediger lager">
    <span class="glyphicon glyphicon-edit" style="color: green"></span>
    </button>


    <!-- Knapp som aktiverer Model for å vise lagerinformasjon  --> 

    <button id="redigerknapp" data-id="{{storageID}}" class="information" data-toggle="tooltip" title="Vis informasjon">
    <span class="glyphicon glyphicon-menu-hamburger" style="color: #003366" ></span>
    </button>


    <!-- Knapp som aktiverer Model for sletting av lager  --> 



    <button id="redigerknapp" data-id="{{storageID}}" class="delete" data-toggle="tooltip" title="Slett lager">
    <span class="glyphicon glyphicon-remove" style="color: red"></span>
    </button>

    <!-- Knapp som aktiverer Model for varetelling av lager  --> 

    <button id="redigerknapp" data-id="{{storageID}}" class="update" data-toggle="tooltip" title="Varetelling">
    <span class="glyphicon glyphicon-check" style="color: #002E5F"></span>
    </button>
    </td>

    <!-- Printer ut lagernavn inn i tabellen -->

    <th>Lagernavn: </th>
    <td>{{storageName}}</td>

    {{/each}}
    </tr>


</script>



<!-- DISPLAY STORAGE MAIN TABLE -->

<!-- GET storageInformation -->

<script>
    $('#dropdown').show();
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

<!-- Update storage information -->
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

<!-- Display storage template -->
<script>
    function storageTableTemplate(data) {

        var rawTemplate = document.getElementById("displayStorageTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var storageTableGeneratedHTML = compiledTemplate(data);

        var storageContainer = document.getElementById("displayStorageContainer");
        storageContainer.innerHTML = storageTableGeneratedHTML;
    }
</script>





<!--    DELETE STORAGE     -->


<!-- Delete storage modal -->
<script>
    $(function POSTdeleteStorageModal() {

        $('#displayStorageContainer').delegate('.delete', 'click', function () {  
            var givenStorageID = $(this).attr('data-id');
            var $displayUsers = $('#errorMessage');
            $displayUsers.empty();

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

<!-- Delete storage template-->         
<script>
    function deleteStorageTemplate(data) {
        var rawTemplate = document.getElementById("deleteStorageTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var deleteStorageGeneratedHTML = compiledTemplate(data);

        var storageContainer = document.getElementById("deleteStorageContainer");
        storageContainer.innerHTML = deleteStorageGeneratedHTML;
    }
</script>


<!-- Delete the storage that is selected-->
<script>
    $(function deleteStorageByID() {

        $('#deleteStorage').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();
            var $displayUsers = $('#errorMessage');
            $displayUsers.empty();
            
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                error: function() {         
                    $displayUsers.empty().append("Du kan ikke slette hovedlageret");
                },
                success: function (data) {

                    UpdateStorageTable();
                    $('#deleteStorageModal').modal('hide');

                }
            });
            return false;
        });
    });

</script>


<!-- STOCKTAKING OF STORAGE -->

<!-- stocktaking modal -->
<script>
    $(function POSTstocktakingModal() {

        $('#displayStorageContainer').delegate('.update', 'click', function () {  
            var givenStorageID = $(this).attr('data-id');

            $.ajax({
                type: 'POST',
                url: '?page=getStorageProduct',
                data: {givenStorageID: givenStorageID},
                dataType: 'json',
                success: function (data) {
                    $('#stocktakingModal').modal('show');
                    stocktakingTemplate(data);  
                }
            });
            return false;

        });
    });
</script>  

<!-- stocktaking storage template-->         
<script>
    function stocktakingTemplate(data) {
        var rawTemplate = document.getElementById("stocktakingTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var stocktakingStorageGeneratedHTML = compiledTemplate(data);

        var storageContainer = document.getElementById("stocktakingContainer");
        storageContainer.innerHTML = stocktakingStorageGeneratedHTML;
    }
</script>

<!-- POST results from stocktaking, and updating the table-->
<script>
    $(function POSTstocktakingResult() {

        $('#stocktaking').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function (data) {
                    
                var $displayUsers = $('#stocktakingContainer');
                $displayUsers.empty();
                
                stocktakingResultTemplate(data);
                    
                }
            });
            return false;
        });
    });

</script>

<!-- stocktaking storage template-->         
<script>
    function stocktakingResultTemplate(data) {
        var rawTemplate = document.getElementById("stocktakingResultTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var stocktakingStorageGeneratedHTML = compiledTemplate(data);

        var storageContainer = document.getElementById("stocktakingResultContainer");
        storageContainer.innerHTML = stocktakingStorageGeneratedHTML;
    }
</script>


<!-- SHOW STORAGE INFORMATION -->

<!-- get information from selected storage-->
<script>
    $(function POSTstorageInformationModal() {

        $('#displayStorageContainer').delegate('.information', 'click', function () {
            
            var givenStorageID = $(this).attr('data-id');
            POSTstorageRestriction(givenStorageID);
            POSTstorageProduct(givenStorageID);
            chartTest(givenStorageID);
            
            $.ajax({
                type: 'POST',
                url: '?page=getStorageByID',
                data: {givenStorageID: givenStorageID},
                dataType: 'json',
                success: function (data) {
                    $('#showStorageInformationModal').modal('show');
                    StorageInformationTemplate(data);
                 

                }
            });
            return false;

        });
    });
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
    var myChart;
    
    function drawChart(data)
    {
        if(myChart)
        {
            myChart.destroy();
        }
          var ctx = document.getElementById('myChart').getContext('2d');

                   
                    var ctx = document.getElementById('myChart').getContext('2d');

                    var product = [];
                    var antall = [];

                        $.each(data, function(i, item){
                        product.push(item.productName);
                        antall.push(item.quantity);
                        });

                            myChart = new Chart(ctx, {

                            type: 'bar',
                            data: {
                                labels: product,
                                datasets: [
                                    {
                                        label: product,
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
                                        data: antall
                                    }
                                ]
                            },
                            options: {
                                legend: {
                                    display: false
                                }
                            }

                        });
    }
</script>










<!-- Display storageInformation Template-->
<script>
    function StorageInformationTemplate(data) {
        var rawTemplate = document.getElementById("storageInformationTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var storageInformationGeneratedHTML = compiledTemplate(data);

        var storageContainer = document.getElementById("storageInformationContainer");
        storageContainer.innerHTML = storageInformationGeneratedHTML;
    }
</script>

<!-- Get restrictions from selected storage -->
<script>
         var givenStorageID;
    function POSTstorageRestriction(data) {
        givenStorageID = data;
        $(function () {
            $.ajax({
                type: 'POST',
                url: '?page=getStorageRestriction',
                data: {givenStorageID: givenStorageID},
                dataType: 'json',
                success: function (data) {
                    storageRestrictionTemplate(data);
                }
            });
        });
    }
</script>

<script>
    $(function deleteUserRestriction() {
        $('#storageRestrictionContainer').delegate('.deleteUserRestriction', 'click', function () {

            var givenUserID = $(this).attr('data-id');
            
            $.ajax({
                type: 'POST',
                url: '?page=deleteSingleRes',
                data: {givenUserID: givenUserID, givenStorageID: givenStorageID},
                dataType: 'json',
                success: function () {
                    POSTstorageRestriction(givenStorageID);

                }
            });
            return false;

        });
    });               
</script> 


<!-- Display restrictionInformation Template-->
<script>
    function storageRestrictionTemplate(data) {
        var rawTemplate = document.getElementById("storageRestrictionTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var storageRestrictionGeneratedHTML = compiledTemplate(data);

        var storageContainer = document.getElementById("storageRestrictionContainer");
        storageContainer.innerHTML = storageRestrictionGeneratedHTML;
    }
</script>

<!-- Get storageInventory from selected storage-->
<script>
    var givenStorageID;
    function POSTstorageProduct(data) {
        givenStorageID = data;
        $(function () {
            $.ajax({
                type: 'POST',
                url: '?page=getStorageProduct',
                data: {givenStorageID: givenStorageID},
                dataType: 'json',
                success: function (data) {
                    storageProductTemplate(data); 
                    rowColor();

                }
            });
        });
    }
</script>

<script>
    $(function deleteStorageInventory() {
        $('#storageProductContainer').delegate('.deleteStorageInventory', 'click', function () {

            var givenProductID = $(this).attr('data-id');
            
            $.ajax({
                type: 'POST',
                url: '?page=deleteSingleProd',
                data: {givenProductID: givenProductID, givenStorageID: givenStorageID},
                dataType: 'json',
                success: function () {
                    POSTstorageProduct(givenStorageID);

                }
            });
            return false;

        });
    });               
</script> 

<!-- Display productInformation Template -->
<script>
    function storageProductTemplate(data) {
        var rawTemplate = document.getElementById("storageProductTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var storageProductGeneratedHTML = compiledTemplate(data);

        var storageContainer = document.getElementById("storageProductContainer");
        storageContainer.innerHTML = storageProductGeneratedHTML;
    }
</script>

<script>
function rowColor(){
    
$('.quantityColor').filter(function(index){
    return parseInt(this.innerHTML) >= 10;
}).siblings().andSelf().attr('class', 'bg-success');

$('.quantityColor').filter(function(index){
    return parseInt(this.innerHTML) < 10 && parseInt(this.innerHTML) >= 5;
}).siblings().andSelf().attr('class', 'bg-warning');

$('.quantityColor').filter(function(index){
    return parseInt(this.innerHTML) < 5;
}).siblings().andSelf().attr('class', 'bg-danger');
}

</script>


<!-- EDIT STORAGE -->

<!-- Get the selected storage, and opens editStorage modal-->
<script>
    $(function POSTeditStorageModal() {

        $('#displayStorageContainer').delegate('.edit', 'click', function () {
            var givenStorageID = $(this).attr('data-id');

            $.ajax({
                type: 'POST',
                url: '?page=getStorageByID',
                data: {givenStorageID: givenStorageID},
                dataType: 'json',
                success: function (data) {
                    editStorageTemplate(data);
                    $('#editStorageModal').modal('show');
                }
            });
            return false;

        });
    });
</script>

<!-- Display edit storage Template -->
<script>
    function editStorageTemplate(data) {
        var rawTemplate = document.getElementById("editStorageTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var editStorageGeneratedHTML = compiledTemplate(data);

        var storageContainer = document.getElementById("editStorageContainer");
        storageContainer.innerHTML = editStorageGeneratedHTML;
    }
</script>

<!-- POST results from editing, and updating the table-->
<script>
    $(function POSTeditStorageInfo() {

        $('#editStorage').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function () {
                    $('#editStorageModal').modal('hide');
                    UpdateStorageTable();
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


<!-- SEARCH FOR STORAGE -->

<script>
    $(function POSTsearchForStorage() {

        $('#searchForStorage').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function (data) {
                    $("#searchForStorage")[0].reset();
                    storageTableTemplate(data);
                    
                }
            });
            return false;
        });
    });

</script>