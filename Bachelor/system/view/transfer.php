<?php require("view/header.php");?>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="container">
    <div class="col-sm-3 col-sm-offset-1 col-md-10 col-md-offset-1 form-group">


    <form id="transferProducts" action="?page=transferProduct" method="post">    
        <div class="col-sm-3 col-md-4">
            <label>Overfør Fra:</label>
            <select name="fromStorageID" form="transferProducts" id="fromTransferRestrictionContainer" class="form-control">
                
                <!-- Her kommer Handlebars Template-->

            </select>
        </div>
      

        <div class="col-sm-3 col-md-4">   
            <label>Overfør Til:</label>
            <select name="toStorageID" form="transferProducts" id="toTransferRestrictionContainer" class="form-control update">

                <!-- Her kommer Handlebars Template-->
                
            </select>
            <p id="errorMessage"></p>
        </div>     
    
        <br><br><br><br>

        <div id="transferProductContainer">
            
            
            <!-- Viser Product som er valgt i FRA lager -->


        </div>
            
            <br><br><br>
            
        <div>
            <table class="table table-bordered table-striped table-responsive" id="transferQuantityContainer">

            <!-- Lar deg velge antall enheter -->
            
            </table>
            
            
            
            <button form="transferProducts" type="submit" class="btn btn-default" id="transferButton">Overfør</button>

        </div>    
    </form>
            
   
 

  
        



    </div>
</div>  
    </div>  


<script id="transferQuantityTemplate" type="text/x-handlebars-template">
    
{{#each prodInfo}}   
    <tr class="selectQuantity">
        <th>Produkt:   </th>
        <td>{{productName}}</td>
        <input name="transferProductID[]" form="transferProducts" type="hidden" value="{{productID}}"/>
        <th>Antall:</th>
        <td><input name="transferQuantity[]" form="transferProducts" required="required" type="number" min="1" max="{{quantity}}" value="" autocomplete="off"/></td> 
        <th>Tilgjengelig:</th>
        <td>{{quantity}} stk</td>    
        
        <td>
            <button class="remove" data-toggle="tooltip" 
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

    </tr>
{{/each}}
     
</script>

<script id="transferProductTemplate" type="text/x-handlebars-template">
<br>
{{#each storageProduct}}    
 <button data-id="{{productID}}" class="btn btn-default product">{{productName}}</button>
{{/each}} 
</script>

<script id="transferRestrictionTemplate" type="text/x-handlebars-template">
<option data-id="0" value="0" class="transferStorage">Velg et lager</option>
{{#each transferRestriction}}     
<tr>
    <option data-id="{{storageID}}" value="{{storageID}}" class="transferStorage">{{storageName}}</option>
</tr>   
{{/each}} 
</script>    

<!-- Get storage information with user restriction -->
<script> 
$('#transferButton').hide(); // hides transferbutton                    
$(function () {
    $.ajax({
        type: 'GET',
        url: '?page=getTransferRestriction',
        dataType: 'json',
        success: function (data) {
            transferRestrictionTemplate(data);
            } 
        });
    });
</script>

<!-- Display storages in drop down meny Template -->
<script>
    function transferRestrictionTemplate(data) {
        var rawTemplate = document.getElementById("transferRestrictionTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var transferRestrictionGeneratedHTML = compiledTemplate(data);

        var transferContainer = document.getElementById("fromTransferRestrictionContainer");
        transferContainer.innerHTML = transferRestrictionGeneratedHTML;
        
        var transferContainer = document.getElementById("toTransferRestrictionContainer");
        transferContainer.innerHTML = transferRestrictionGeneratedHTML;
    }
</script>


<!-- Get the selected storage, and POST this to retrive inventory-->
<script>
    var givenStorageID;
    $(function POSTfromTransferModal() {

        $('#fromTransferRestrictionContainer').on('change', function () {
            givenStorageID = $(this).find("option:selected").data('id');
            
            if(givenStorageID > 0){
                $.ajax({
                    type: 'POST',
                    url: '?page=getStorageProduct',
                    data: {givenStorageID: givenStorageID},
                    dataType: 'json',
                    success: function (data) {
                    transferProductTemplate(data);
                    $('.selectQuantity').remove();
                    $('#transferButton').hide();
                
                    }
                });
            } else  {
                $('.product').remove();
                $('.selectQuantity').remove();
            }
            
        return false;

        });
    });
</script>

<!-- Display products in storage Template -->
<script>
    function transferProductTemplate(data) {
        var rawTemplate = document.getElementById("transferProductTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var transferProductGeneratedHTML = compiledTemplate(data);

        var transferContainer = document.getElementById("transferProductContainer");
        transferContainer.innerHTML = transferProductGeneratedHTML;
    }
</script>

<!-- Get productID from selected ID -->
<script>
    $(function POSTeditUserModal() {
        
        $('#transferProductContainer').delegate('.product', 'click', function () {
            if($(this).data('clicked')) { 
                return false;
            }    
             
            $(this).data('clicked', true);
            
            var givenProductID = $(this).attr('data-id');
            
            
            $.ajax({
                type: 'POST',
                url: '?page=getProdQuantity',
                data: {givenProductID: givenProductID, givenStorageID: givenStorageID},
                dataType: 'json',
                success: function (data) {
                    
                    transferQuantityTemplate(data);
                     $('#transferButton').show();        
                }
            });
            return false;
            
            
        });
    });
</script> 

<script>
    function transferQuantityTemplate(data) {
        var rawTemplate = document.getElementById("transferQuantityTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var transferProductGeneratedHTML = compiledTemplate(data);

        var transferContainer = document.getElementById("transferQuantityContainer");
        transferContainer.innerHTML += transferProductGeneratedHTML;
    }
</script>



<script>
    $(function POSTtransferProducts() {

        $('#transferProducts').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();
 
                $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                error: function() {         
                    var $displayUsers = $('#errorMessage');
                    $displayUsers.empty().append("Du må velge et TIL lager");
                },
                success: function (data) {
                   $('.product').remove();
                   $('.selectQuantity').remove();
                   $('#errorMessage').remove();
                   updateTransfer();
                }
            });
            return false;
        });
     });    
</script>

<script> 
function updateTransfer() {                            
$('#transferButton').hide(); // hides transferbutton                    
$(function () {
    $.ajax({
        type: 'GET',
        url: '?page=getTransferRestriction',
        dataType: 'json',
        success: function (data) {
            transferRestrictionTemplate(data);
            }  
        });
    });
}
</script>

<!-- remove product modal -->
<script>
    $(function POSTdeleteStorageModal() {

        $('#transferQuantityContainer').delegate('.remove', 'click', function () {
           var $tr = $(this).closest('tr');
           
           $tr.fadeOut(150, function() {
            $(this).remove();
           });
           
        });
    });
</script>  