<?php require("view/header.php"); ?>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

    <div class="container"> 

        <div class="col-sm-3 col-sm-offset-1 col-md-10 col-md-offset-1 form-group"> 
       
            <div class="jumbotron">
                    <h3>Media Oversikt</h3>
            </div>        
                
            <div class="col-md-10 col-md-offset-1">
                <button class="btn btn-default" type="button" data-toggle="modal" data-target="#uploadImageModal">Last opp bilde</button>
            </div>
            
            <br><br><br><br>
                    <div id="displayMediaContainer">

                        <!-- HER KOMMER INNHOLDET FRA HANDLEBARS  -->

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
                        <p>Velg bilde for å laste opp:</p>
                        <input type="file" name="fileToUpload" required="required" id="fileToUpload"><br>
                        velg en katerogi:
                        <input type="text" name="givenCaterogy" required="required"><br>
                        <input type="submit" value="Upload Image" name="submit">

                    </form>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>

            </div>

        </div>
    </div>
</div> 

<script id="displayMediaTemplate" type="text/x-handlebars-template">
{{#each mediaInfo}}
<<<<<<< HEAD
<div class="col-md-3">
<div class="panel panel-default text-center">
<div class="panel-heading"><b>Filnavn: {{mediaName}}</b>
</div>
=======
<div class="col-md-2">
>>>>>>> 858b3dbdcb4c76d321bae0fbf1aa0fd72b349873

<div class="img-border">
<div class="caption">
<b>{{mediaName}}</b>
</div>
<img class="img-thumbnail"  src="image/{{mediaName}}" alt="Home">
<div class="caption">

    <button data-id="{{mediaID}}" class="edit" data-toggle="tooltip" title="Rediger bilde"
    style="appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    outline: none;
    border: 0;
    background: transparent;
    display: inline;">
    <span class="glyphicon glyphicon-edit" style="color: green"></span>
    </button>
    
    <button data-id="{{mediaID}}" class="delete" data-toggle="tooltip" title="Slett bilde"
    style="appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    outline: none;
    border: 0;
    background: transparent;
    display: inline;">
    <span class="glyphicon glyphicon-remove" style="color: red"></span>
    </button>

</div>
</div>
</div>
{{/each}}
    
</script>    


<script>
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