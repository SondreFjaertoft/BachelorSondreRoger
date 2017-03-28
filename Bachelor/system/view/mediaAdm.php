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

    <script id="displayMediaTemplate" type="text/x-handlebars-template">
{{#each mediaInfo}}
<div class="col-md-2">

<div class="img-border">
<div class="caption">
{{mediaName}}
</div>
<a href="#">
<img class="img-thumbnail"  onclick=alert("masseinfo"); id="{{mediaID}}" src="image/{{mediaName}}" alt="Home">
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