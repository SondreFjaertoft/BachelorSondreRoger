<?php require("view/header.php"); ?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <br><br><br><br>


    <!-- DIV som holder på all informasjon til venstre på skjermen  -->


    <div class="col-sm-3 col-sm-offset-1 col-md-6 col-md-offset-2 form-group">

        <!-- SØK ETTER BRUKER  -->
        <form class="form-inline" id="searchForUser" action="?page=getUserInfo" method="post">
            <div class="form-group">
                <div class="col-md-9">
                    <input class="form-control" form="searchForUser" type="text" name="givenUserSearchWord" value="" placeholder="Søk etter bruker..">  
                    <input class="form-control" form="searchForUser" type="submit" value="Søk">
        </form>                           
                    <button onclick="UpdateUsersTable()" class="btn btn-default " type="button">Alle brukere</button
                </div>    
            </div> 
            
            <div class="col-md-1 col-md-offset-15">
                <button class="btn btn-default " type="button" data-toggle="modal" data-target="#opprettbruker">Opprett bruker</button>
            </div>

   




            <!-- OPPRETT BRUKER  -->
            <div class="modal fade" id="opprettbruker" role="dialog">
                <div class="modal-dialog">
                    <!-- Innholdet til Modalen -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Opprett bruker</h4>
                        </div>
                        <div class="modal-body">
                            <div style="text-align: center">
                                <form action="?page=addUserEngine" method="post" id="createUser">
                                    <p style="font-weight: bold ">Name:</p>
                                    <input type="text" name="givenName" value=""><br>
                                    <p style="font-weight: bold ">Brukernavn:</p>
                                    <input type="text" name="givenUsername" value=""><br>
                                    <p style="font-weight: bold ">Passord:</p>
                                    <input type="text" name="givenPassword" value=""><br>
                                    <p style="font-weight: bold ">UserLevel:</p>
                                    <input type="text" name="givenUserLevel" value=""><br>
                                    <p style="font-weight: bold ">Email:</p>
                                    <input type="text" name="givenEmail" value=""><br>
                                    <br>
                                </form> 
                            </div>
                        </div>
                        <div class="modal-footer">

                            <input class="btn btn-default" form="createUser" type="submit" value="Opprett bruker">


                            <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>

                        </div>

                    </div>
                </div>
            </div> 
            </div>
 
            <br>

            <?php
            $dropdownMeny = $GLOBALS["storageInfo"];
            ?>




            <!-- DISPLAY USER CONTAINER    --->       
            <br>
            <table class="table table-bordered table-striped table-responsive">
                <tbody id="displayUserContainer">
                    
                    <!-- HER KOMMER INNHOLDET FRA HANDLEBARS  -->
                    
                </tbody>    
            </table>
          
            
            
                        <!-- drop down meny -->
            <br><br>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" id="setRestriction" type="button" data-toggle="dropdown">Velg Lager
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <table>
                        <?php foreach ($dropdownMeny as $dropdownMeny) : ?>
                            <tr>
                                <td><?php echo $dropdownMeny['storageName']; ?> </td>

                                <td><input form="restriction" id="<?php echo $dropdownMeny['storageID']; ?>" value="<?php echo $dropdownMeny['storageID']; ?>"  name="storageRestrictions[]" type="checkbox"></td>
                            </tr>
                        <?php endforeach; ?>

                    </table>
                    <button form="restriction" type="submit">Velg lagertilgang</button> 
                </ul>
            </div>



            <!-- DELETE USER MODAL -->
            
<div class="modal fade" id="deleteUserModal" role="dialog">
    <div class="modal-dialog">
                    <!-- Innholdet til Modalen -->
        <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Bruker informasjon</h4>
            </div>
                <form action="?page=deleteUserEngine" method="post" id="deleteUser"></form>
                <div class="modal-body" id="deleteUserContainer">
                    
                    <!-- Innhold fra Handlebars Template-->
                    
                </div>
            <div class="modal-footer">
                <input form="deleteUser" class="btn btn-default" type="submit" value="Slett">
                <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>
            </div>
        </div>
    </div>
</div>  
            
            
            
            
            <!-- SHOW USER INFORMATION MODAL-->     
            
<div class="modal fade" id="showUserInformationModal" role="dialog">
    <div class="modal-dialog">
                                    <!-- Innholdet til Modalen -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Bruker informasjon</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered">
                    <tbody id="userInformationContainer">
                       
                                 <!-- Innhold fra Handlebars Template-->
               
                     </tbody>   
                </table> 
                <table class="table table-striped table-bordered">   
                    <tbody > 
                        <tr> 
                            <th>Lagertilgang:</th>
                            <td id="userRestriotionContainer">
                                
                                <!-- Innhold fra Handlebars Template-->
                                
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


            <!-- SHOW EDIT USER MODAL -->
            
            
<div class="modal fade" id="editUserModal" role="dialog">
    <div class="modal-dialog">
        <!-- Innholdet til Modalen -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Bruker informasjon</h4>
            </div>
            <form action="?page=editUserEngine" method="post" id="editUser"></form>
            <div class="modal-body" id="editUserContainer">

                   <!-- Innhold fra Handlebars Template--> 

            </div>
            <div class="modal-footer">
                <input class="btn btn-default" type="submit" value="Lagre" form="editUser">
                <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>
            </div>
        </div>
    </div>
</div>             
            
            

    </div>
</div>


<!-- HANDLEBARS TEMPLATES-->

<!-- edit user template-->
<script id="editUserTemplate" type="text/x-handlebars-template">
    
{{#each user}}    
        <input form="editUser" type="hidden" name="editUserID" value="{{userID}}"><br>
        Navn: <br>
        <input form="editUser" type="text" name="editName" value="{{name}}"><br>
        Brukernavn: <br>
        <input form="editUser" type="text" name="editUsername" value="{{username}}"><br>
        Passord: <br>
        <input form="editUser" type="text" name="editPassword" value="{{password}}"><br>
        Brukernivå: <br>
        <input form="editUser" type="text" name="editUserLevel" value="{{userLevel}}"><br>
        Epost: <br>
        <input form="editUser" type="text" name="editEmail" value="{{email}}"><br>
        <br>    
{{/each}}
</script>   


<!-- show user restriction template-->
<script id="userRestrictionTemplate" type="text/x-handlebars-template">
{{#each restriction}}
{{storageName}} <br>
{{/each}}      
</script>

<!-- Show user information template -->
<script id="userInformationTemplate" type="text/x-handlebars-template">
{{#each user}} 
    <tr>
        <th>Navn</th>
        <td>{{name}}</td>            
    </tr> 
    <tr>
        <th>UserID:</th> 
        <td>{{userID}}</td>
    </tr>
    <tr>
        <th>Brukernavn:</th>
        <td>{{username}}</td>
    </tr>
    <tr>
        <th>Brukernivå:</th>
        <td>{{userLevel}}</td>
    </tr>
    <tr>
        <th>E-post:</th>
        <td>{{email}}</td>
    </tr>
    <tr>
        <th>Sist inlogget: </th>
        <td>{{lastLogin}}</td>
    </tr> 
{{/each}}     
</script>    


<!-- delete user template -->

<script id="deleteUserTemplate" type="text/x-handlebars-template">
<p> Er du sikker på at du vil slette:  <P>
{{#each user}}           
    {{name}}  
    <input form="deleteUser" type="hidden" name="deleteUserID" value="{{userID}}"><br>
{{/each}}    
</script>    

<!-- display all users template -->
<script id="displayUserTemplate" type="text/x-handlebars-template">

    {{#each users}} 
    <tr>
    <td class="text-center">  

    <form id="brukerRedForm" action="" method="post">
    </form>
    
    
    
    <!-- Knapp som aktiverer Model for brukerredigering  --> 

    <button data-id="{{userID}}" class="edit" data-toggle="tooltip"
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

    <button data-id="{{userID}}" class="information" data-toggle="tooltip" 
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

     
   
    <button data-id="{{userID}}" class="delete" data-toggle="tooltip" 
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

    <th>Navn: </th>
    <td>{{name}}</td>
    <th>Brukernavn: </th>
    <td>{{username}}</td>


    <!-- Legger inn chackbox for fler valg (ved lagertilganggiving -->

 
    <form action="?page=addRestriction" id="restriction" method="post">        </form>
    <td> <input form="restriction" class="selectRestriction" id="{{userID}}" value="{{userID}}"  name="userRestrictions[]" type="checkbox"></td>

 

    {{/each}}
    </tr>


</script>



<!-- SET RESTRICTION -->

<script>
$('#setRestriction').hide();
$('#displayUserContainer').delegate('.selectRestriction','click', function(){   
    if($(".selectRestriction").is(":checked") === true){
         $('#setRestriction').show();
    } else {
         $('#setRestriction').hide(); 
    }
});
</script>

<!-- CREATE USER -->
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
                success: function () {
                    $("#createUser")[0].reset();
                    $('#opprettbruker').modal('hide');
                    UpdateUsersTable();
                }
            });
            return false;
        });
    });

</script>


<!-- SEARCH FOR USERS -->
<script>
    $(function POSTsearchForUser() {

        $('#searchForUser').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function (data) {
                    $("#searchForUser")[0].reset();
                    usersTableTemplate(data);
                }
            });
            return false;
        });
    });

</script>



<!-- UPDATE USER INFOMARTION -->
<script>
    function UpdateUsersTable() {
        $(function () {
            $.ajax({
                type: 'GET',
                url: '?page=getUserInfo',
                dataType: 'json',
                success: function (data) {
                    usersTableTemplate(data);
                }
            });
        });
    }
</script>



<!-- GET USER INFOROMATION -->

<script>
    $(function () {
        $.ajax({
            type: 'GET',
            url: '?page=getUserInfo',
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




<!--    SHOW USER INFORMATION      -->

<script>
 $(function POSTuserInformationModal() {
     
    $('#displayUserContainer').delegate('.information','click', function(){ 
        
        var givenUserID = $(this).attr('data-id');
        POSTuserRestriction(givenUserID);
        $.ajax({
                type: 'POST',
                url: '?page=getUserByID',
                data: {givenUserID: givenUserID},
                dataType: 'json',
                success: function (data) {
                    $('#showUserInformationModal').modal('show');
                    userInformationTemplate(data);
                    
                }
            });
            return false;

        });
    });                     
</script>

<script>
    function POSTuserRestriction(data){
        var givenUserID = data;
      $(function () {
            $.ajax({
                type: 'POST',
                url: '?page=getUserRestriction',
                data: {givenUserID: givenUserID},
                dataType: 'json',
                success: function (data) {
                   userRestrictionTemplate(data); 
                }
            });
        });  
    }
</script>

<script>
   function userRestrictionTemplate(data) {
       var rawTemplate = document.getElementById("userRestrictionTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var UserRestrictionGeneratedHTML = compiledTemplate(data);

        var userContainer = document.getElementById("userRestriotionContainer");
        userContainer.innerHTML = UserRestrictionGeneratedHTML;
   }
</script>

<script>
   function userInformationTemplate(data) {
       var rawTemplate = document.getElementById("userInformationTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var UserInformationGeneratedHTML = compiledTemplate(data);

        var userContainer = document.getElementById("userInformationContainer");
        userContainer.innerHTML = UserInformationGeneratedHTML;
   }
</script>




<!--    DELETE USER     -->


<!-- DELETE USER MODAL -->
<script>
 $(function POSTdeleteUserModal() {
     
    $('#displayUserContainer').delegate('.delete','click', function(){ 
        var givenUserID = $(this).attr('data-id');
        
        $.ajax({
                type: 'POST',
                url: '?page=getUserByID',
                data: {givenUserID: givenUserID},
                dataType: 'json',
                success: function (data) {
                    deleteUserTemplate(data);
                    $('#deleteUserModal').modal('show');
                }
            });
            return false;

        });
    });  
</script>   

<!-- DELETE USER TEMPLATE-->         
<script>
   function deleteUserTemplate(data) {
       var rawTemplate = document.getElementById("deleteUserTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var UserTableGeneratedHTML = compiledTemplate(data);

        var userContainer = document.getElementById("deleteUserContainer");
        userContainer.innerHTML = UserTableGeneratedHTML;
   }
</script>

<script>
    $(function deleteUserByID() {

        $('#deleteUser').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();
           
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function (data) {
                   
                    UpdateUsersTable();
                    $('#deleteUserModal').modal('hide');
                    
                }
            });
            return false;
        });
    });

</script>


<!-- EDIT USER -->

<script>
 $(function POSTeditUserModal() {
     
    $('#displayUserContainer').delegate('.edit','click', function(){ 
        var givenUserID = $(this).attr('data-id');
        
        $.ajax({
                type: 'POST',
                url: '?page=getUserByID',
                data: {givenUserID: givenUserID},
                dataType: 'json',
                success: function (data) {
                    editUserTemplate(data);
                    $('#editUserModal').modal('show');
                }
            });
            return false;

        });
    });  
</script> 


<!-- EDIT USER TEMPLATE-->         
<script>
   function editUserTemplate(data) {
       var rawTemplate = document.getElementById("editUserTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var editUserGeneratedHTML = compiledTemplate(data);

        var userContainer = document.getElementById("editUserContainer");
        userContainer.innerHTML = editUserGeneratedHTML;
   }
</script>

<script>
    $(function POSTeditUserInfo() {

        $('#editUser').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function () {
                    $('#editUserModal').modal('hide');
                    UpdateUsersTable();
                }
            });
            return false;
        });
    });

</script>



