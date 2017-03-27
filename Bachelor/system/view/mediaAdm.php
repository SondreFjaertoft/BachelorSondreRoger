<?php require("view/header.php"); ?>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

    <div class="container"> 

        <div class="col-sm-3 col-sm-offset-1 col-md-10 col-md-offset-1 form-group"> 

            <form action="?page=uploadImage" id="uploadImage" method="post" enctype="multipart/form-data">
                Velg bilde for å laste opp:<br>
                <input type="file" name="fileToUpload" id="fileToUpload"><br>
                <input type="submit" value="Upload Image" name="submit">
            </form>
            
        </div>
    </div>
</div>




