<?php require("view/header.php"); ?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

    <br><br><br><br>

    <div class="col-sm-3 col-sm-offset-1 col-md-6 col-md-offset-2 form-group">     

        <!-- HER KOMMER INNHOLDET>   --> 


        <!-- SØK ETTER LAGER -->

        <form class="form-inline" id="searchForStorage" action="?page=getAllStorageInfo" method="post">
            <div class="form-group">
                <div class="col-md-9">
                    <input class="form-control" type="text" name="givenStorageSearchWord" value="" placeholder="Søk etter Lager..">  
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
        <table class="table table-bordered table-striped table-responsive"> 
            <h4> Lageroversikt </h4> 
            <tbody id="displayStorageContainer">

                <!-- HER KOMMER INNHOLDET FRA HANDLEBARS  -->

            </tbody>

        </table>

    </div>
</div>











<!-- DIV som holder på all informasjon til høgre på skjermen  -->


<!-- OPPRETT Lager  -->


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
                    <form action="?page=addStorageEngine" method="post" id="createStorage">
                        Navn på lager:<br>
                        <input type="text" name="givenStorageName" value=""><br>

                        <br>

                    </form> 
                </div>
            </div>
            <div class="modal-footer">

                <input class="btn btn-default" form="createStorage" type="submit" value="Opprett Lager" href="?page=storageAdm">


                <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>

            </div>

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
                <h4 class="modal-title">Bruker informasjon</h4>
            </div>
            <form action="?page=editStorageEngine" method="post" id="editStorage"></form>
            <div class="modal-body" id="editStorageContainer">

                <!-- Innhold fra Handlebars Template -->

            </div>
            <div class="modal-footer">
                <input class="btn btn-default" type="submit" value="Lagre" form="editStorage">
                <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>
            </div>
        </div>
    </div>
</div> 




<!-- GET STORAGE INFORMATION MODAL-->

<div class="modal fade" id="showStorageInformationModal" role="dialog">
    <div class="modal-dialog">
        <!-- Innholdet til Modalen -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Lager Informasjon</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered">
                    <tbody id="storageInformationContainer">

                        <!-- Her kommer handlebars Template -->

                    </tbody>
                </table>
                <table class="table table-striped table-bordered">
                    <tbody>
                        <tr>
                            <th>Personer med tilgang: </th>
                            <td id="storageRestrictionContainer">

                                <!-- Her kommer handlebars Template -->

                            </td>
                        </tr>                      
                    </tbody>    
                </table> 
                <table class="table table-striped table-bordered">
                    <tbody>
                        <tr>
                            <th>Utstyr i lageret: </th>
                            <td id="storageProductContainer">

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




<!-- DELETE STORAGE MODAL -->


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

<!-- Display editStorage-->                    
<script id="editStorageTemplate" type="text/x-handlebars-template">
{{#each storage}}     
    <input form="editStorage" type="hidden" name="editStorageID" value="{{storageID}}"><br>
    Lagernavn: <br> 
    <input form="editStorage" type="text" name="editStorageName" value="{{storageName}}"><br> 
{{/each}}            
</script>  


<!-- Display StorageInformation-->
<script id="storageInformationTemplate" type="text/x-handlebars-template">
{{#each storage}}    
    <tr> 
        <th>LagerID: </th>
        <td>{{storageID}}</td> 
    </tr>
    <tr>
        <th>lagernavn: </th>
        <td>{{storageName}}</td>
    </tr>
{{/each}}                
</script>   

<!-- Display StorageRetricton-->
<script id="storageRestrictionTemplate" type="text/x-handlebars-template">
    {{#each storageRestriction}}    
    {{name}}<br>
    {{/each}}       
</script>

<!-- Display StorageProduct-->
<script id="storageProductTemplate" type="text/x-handlebars-template">
    {{#each storageProduct}}         
    {{productName}} , Antall: {{quantity}}<br>   
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



<!-- DISPLAY STORAGE MAIN TABLE -->

<!-- GET storageInformation -->

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





<!--    DELETE USER     -->


<!-- Delete user modal -->
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




<!-- SHOW STORAGE INFORMATION -->

<!-- get information from selected storage-->
<script>
    $(function POSTstorageInformationModal() {

        $('#displayStorageContainer').delegate('.information', 'click', function () {

            var givenStorageID = $(this).attr('data-id');
            POSTstorageRestriction(givenStorageID);
            POSTstorageProduct(givenStorageID);
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
    function POSTstorageRestriction(data) {
        var givenStorageID = data;
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
    function POSTstorageProduct(data) {
        var givenStorageID = data;
        $(function () {
            $.ajax({
                type: 'POST',
                url: '?page=getStorageProduct',
                data: {givenStorageID: givenStorageID},
                dataType: 'json',
                success: function (data) {
                    storageProductTemplate(data);
                }
            });
        });
    }
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
    $(function POSTuserInfo() {

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
    $(function POSTsearchForUser() {

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