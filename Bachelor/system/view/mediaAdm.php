<?php require("view/header.php"); ?>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

    <div class="container"> 

        <div class="col-sm-3 col-sm-offset-1 col-md-10 col-md-offset-1 form-group"> 

            <div class="col-md-1 col-md-offset-15">
                <button class="btn btn-default" type="button" data-toggle="modal" data-target="#uploadImageModal">Last opp bilde</button>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"><b>Media Oversikt</b></h3>
                </div>
                <table class="table table-bordered table-striped table-responsive"> 

                    <tbody id="displayMediaContainer">

                        <!-- HER KOMMER INNHOLDET FRA HANDLEBARS  -->

                    </tbody>

                </table>

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
<p>filnavn: {{mediaName}}</p>
<img width="100" height="100" src="image/{{mediaName}}" alt="Home">
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