<?php require("view/header.php"); ?>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

    <div class="container"> 

        <div class="col-sm-3 col-sm-offset-1 col-md-10 col-md-offset-1 form-group"> 
            
        <form id="searchForMedia" class="form-inline" action="?page=getAllMediaInfo" method="post">    
            <div class="form-group">
                <div class="col-md-9">
                    <input class="form-control" form="searchForMedia" type="text" name="givenMediaSearchWord" value="" placeholder="Søk etter media..">  
                    <input class="form-control" form="searchForMedia" type="submit" value="Søk">
                    
                    <button onclick="UpdateMediaTable()" class="btn btn-default " type="button">Alle producter</button>
                </div>
                <div class="col-md-1 col-md-offset-15">
                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#uploadImageModal">Last opp bilde</button>
                </div>
            </div>
        </form>  
            
              <br><br>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"><b>Mediaoversikt</b></h3>
                </div>       


                <div class="panel-body">
                    <div id="displayMediaContainer">

                        <!-- HER KOMMER INNHOLDET FRA HANDLEBARS  -->

                    </div>



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
                                <td id="bordernone"><input class="form-control" type="text" name="givenCaterogy" required="required"></td>
                            </tr>
                        </table>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                <input class="btn btn-success" form="uploadImage" type="submit" value="Upload Image" name="submit" href="?page=uploadImage">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Avslutt</button>

                </div>

            </div>
        </div>
    </div> 
    
    
    
    
    <!-- GET MEDIA INFORMATION MODAL -->

<div class="modal fade" id="showMediaInformationModal" role="dialog">
    <div class="modal-dialog">
        <!-- Innholdet til Modalen -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="mediaTitle"></h4>
            </div>
            <div class="modal-body">
                <div id="mediaInformationContainer">
                    
                <!-- Her kommer bilde Template -->
                
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Avslutt</button>
            </div>
        </div>
    </div>
</div> 
    
    
    <!-- EDIT MEDIA MODAL -->
    
<div class="modal fade" id="editMediaModal" role="dialog">
    <div class="modal-dialog">
        <!-- Innholdet til Modalen -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="mediaTitle">Rediger media</h4>
            </div>
            <div class="modal-body">
                <form action="?page=editMedia" method="post" id="editMedia"></form>
                <div id="editMediaContainer">
                    
                <!-- Her kommer bilde Template -->
                
                </div>
            </div>
            <div class="modal-footer">
                <input class="btn btn-success" type="submit" value="Lagre" form="editMedia">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Avslutt</button>
            </div>
        </div>
    </div>
</div>    
    
    
<div class="modal fade" id="deleteMediaModal" role="dialog">
    <div class="modal-dialog">
        <!-- Innholdet til Modalen -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Slett bilde?</h4>
            </div>
            <form action="?page=deleteMedia" method="post" id="deleteMedia"></form>
            <div class="modal-body" id="deleteMediaContainer">
                  
                <!-- Innhold fra Handlebars Template -->
            </div>    
            <div class="modal-footer">
                <input form="deleteMedia" class="btn btn-success" type="submit" value="Slett">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Avslutt</button>
            </div>
        </div>
    </div>
</div>      
    
    
    
<!-- Display what media you are deleting-->
<script id="deleteMediaTemplate" type="text/x-handlebars-template">
    <p> Er du sikker på at du vil slette:  <P>
    {{#each mediaInfo}}
    <b>{{mediaName}}</b>
    <input type="hidden" form="deleteMedia" name="deleteMediaID" value="{{mediaID}}">    
    <br><br>
    <img class="img-responsive" src="image/{{mediaName}}" alt="Home">            
    {{/each}} 
</script>       

<!-- Edit media -->
<script id="editMediaTemplate" type="text/x-handlebars-template">
{{#each mediaInfo}}    
    <input form="editMedia" type="hidden" name="editMediaID" value="{{mediaID}}">
    <tr>
    <th id="bordernone">Medianavn: </th> 
    <td id="bordernone"><input class="form-control" form="editMedia" required="required" type="text" name="editMediaName" value="{{mediaName}}" autocomplete="off"></td> 
    </tr>
    <tr>
    <th id="bordernone">Kategori: </th> 
    <td id="bordernone"><input class="form-control" form="editMedia" required="required" type="text" name="editCategory" value="{{category}}" autocomplete="off"></td> 
    </tr>
{{/each}} 

</script>
    
<!-- Display all images -->
<script id="displayMediaTemplate" type="text/x-handlebars-template">
{{#each mediaInfo}}
<div class="col-md-2">

<div class="img-border">
<div class="caption">
{{mediaName}}
</div>
<a href="#">
<img class="img-thumbnail"  onclick=showMedia({{mediaID}}); id="{{mediaID}}" src="image/{{mediaName}}" alt="Home">
</a>
<div class="caption">

    <button data-id="{{mediaID}}" id="redigerknapp" class="edit" data-toggle="tooltip" title="Rediger bilde">

    <span class="glyphicon glyphicon-edit" style="color: green"></span>
    </button>
    
    <button data-id="{{mediaID}}" id="redigerknapp" class="delete" data-toggle="tooltip" title="Slett bilde">
   
    <span class="glyphicon glyphicon-remove" style="color: red"></span>
    </button>

</div>
</div>
</div>
{{/each}}
    
</script>    


<script>
        $('#dropdown').show();
        $(function () {
            $.ajax({
                type: 'GET',
                url: '?page=getAllMediaInfo',
                dataType: 'json',
                success: function (data) {
                    mediaDisplayTemplate(data);
                }
            });
        });
    </script>
    
    <!-- Update storage information -->
<script>
    function UpdateMediaTable() {
        $(function () {
            $.ajax({
                type: 'GET',
                url: '?page=getAllMediaInfo',
                dataType: 'json',
                success: function (data) {
                    mediaDisplayTemplate(data);
                }
            });
        });
    }
</script>

    <!-- Display mdia template -->
    <script>
        function mediaDisplayTemplate(data) {

            var rawTemplate = document.getElementById("displayMediaTemplate").innerHTML;
            var compiledTemplate = Handlebars.compile(rawTemplate);
            var mediaDisplayGeneratedHTML = compiledTemplate(data);

            var mediaContainer = document.getElementById("displayMediaContainer");
            mediaContainer.innerHTML = mediaDisplayGeneratedHTML;
        }
    </script>
    
    
    <script>
    $(function POSTsearchForMedia() {

        $('#searchForMedia').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function (data) {
                    $("#searchForMedia")[0].reset();
                    mediaDisplayTemplate(data);
                }
            });
            return false;
        });
    });

</script>

<script>
function showMedia(givenMediaID) {
    $('#showMediaInformationModal').modal('show');
            $.ajax({
                type: 'POST',
                url: '?page=getMediaByID',
                data: {givenMediaID: givenMediaID},
                dataType: 'json',
                success: function (data) {
                    
                    $.each(data.mediaInfo, function(i, item) {
                        
                    var $mediaTitle = $('#mediaTitle');
                    $mediaTitle.empty().append(item.mediaName);

                    var $displayMediaInformation = $('#mediaInformationContainer');
                    $displayMediaInformation.empty().append('<img class="img-responsive" src="image/' + item.mediaName + '"alt="Home">');
                    
                     });
                }
            });
            return false;

        };
  
</script>

<!-- EDIT STORAGE -->

<script>
    $(function POSTeditMediaModal() {

        $('#displayMediaContainer').delegate('.edit', 'click', function () {
            var givenMediaID = $(this).attr('data-id');

            $.ajax({
                type: 'POST',
                url: '?page=getMediaByID',
                data: {givenMediaID: givenMediaID},
                dataType: 'json',
                success: function (data) {
                    $('#editMediaModal').modal('show');
                    editMediaTemplate(data); 
                }
            });
            return false;

        });
    });
</script>

<script>
    function editMediaTemplate(data) {
        var rawTemplate = document.getElementById("editMediaTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var editMediaGeneratedHTML = compiledTemplate(data);

        var editContainer = document.getElementById("editMediaContainer");
        editContainer.innerHTML = editMediaGeneratedHTML;
    }
</script>


<!-- POST results from editing, and updating the table-->
<script>
    $(function POSTeditMediaInfo() {
        
        $('#editMedia').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();
            
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function () {
                    $('#editMediaModal').modal('hide');
                    UpdateMediaTable();
                
                }
            });
            return false;
        });
    });

</script>


<!--    DELETE STORAGE     -->


<!-- Display what media to delete storage modal -->
<script>
    $(function POSTdeleteStorageModal() {

        $('#displayMediaContainer').delegate('.delete', 'click', function () {
            var givenMediaID = $(this).attr('data-id');
            $('#deleteMediaModal').modal('show');
            $.ajax({
                type: 'POST',
                url: '?page=getMediaByID',
                data: {givenMediaID: givenMediaID},
                dataType: 'json',
                success: function (data) {
                    deleteMediaTemplate(data);
                    $('#deleteMediaModal').modal('show');                   
                }
            });
            return false;

        });
    });
</script> 

<!-- Delete media template-->         
<script>
    function deleteMediaTemplate(data) {
        var rawTemplate = document.getElementById("deleteMediaTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var deleteMediaGeneratedHTML = compiledTemplate(data);

        var mediaContainer = document.getElementById("deleteMediaContainer");
        mediaContainer.innerHTML = deleteMediaGeneratedHTML;
    }
</script>

<!-- Delete the storage that is selected-->
<script>
    $(function deleteStorageByID() {

        $('#deleteMedia').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function (data) {

                    UpdateMediaTable();
                    $('#deleteMediaModal').modal('hide');

                }
            });
            return false;
        });
    });

</script>