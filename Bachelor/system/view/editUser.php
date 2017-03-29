<?php require("view/header.php"); ?>




<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    
    <div id="displayUserContainer">
        
    </div>
    
</div>    


<script id="displayUserTemplate" type="text/x-handlebars-template">

    {{#each user}}
    {{name}}
    {{/each}}
    
</script>    

<script>
    $(function () {
        $.ajax({
            type: 'GET',
            url: '?page=getUserByID',
            dataType: 'json',
            success: function (data) {
                usersTableTemplate(data);
            }
        });
    });
</script>

<!-- DISPLAY USER TEMPLATE -->
<script>
    function usersTableTemplate(data) {

        var rawTemplate = document.getElementById("displayUserTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var UserTableGeneratedHTML = compiledTemplate(data);

        var userContainer = document.getElementById("displayUserContainer");
        userContainer.innerHTML = UserTableGeneratedHTML;
    }
</script>