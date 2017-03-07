<?php require("view/header.php"); ?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <br><br><br><br>


    <!-- DIV som holder på all informasjon til venstre på skjermen  -->


    <div class="col-sm-3 col-sm-offset-1 col-md-6 col-md-offset-2 form-group">
        
        
        <div class="col-sm-3 col-md-4">
            <label>Uttak fra:</label>
            <select name="fromStorageID" form="withdrawProducts" id="withdrawrRestrictionContainer" class="form-control">
                
                <!-- Her kommer Handlebars Template-->

            </select>
        </div>
        
        
        <br><br><br><br>

        <div id="withdrawProductContainer">
            
            
            <!-- Viser Product som er valgt i FRA lager -->


        </div>        
        
        <br><br><br>
        
        <div>
            <table class="table table-bordered table-striped table-responsive" id="withdrawQuantityContainer">

            <!-- Lar deg velge antall enheter -->
            
            </table>
            
            
            <form id="withdrawProducts" action="?page=withdrawProduct" method="post"></form>
            <button form="withdrawProducts" type="submit" class="btn btn-default" id="withdrawButton">Overfør</button>
            <p id="errorMessage"></p>
        </div>    

        
        
        
    </div>  
</div>    

<script id="withdrawQuantityTemplate" type="text/x-handlebars-template">
    
{{#each product}}   
    <tr class="selectQuantity">
        <th>Produkt:   </th>
        <td>{{productName}}</td>
        <input name="withdrawProductID[]" form="withdrawProducts" type="hidden" value="{{productID}}"/>
        <th>Antall:</th>
        <td><input name="withdrawQuantity[]" form="withdrawProducts" type="int" value="" autocomplete="off"/></td> 
        <th>Tilgjengelig:</th>
        <td>{{quantity}} stk</td>    
    </tr>
{{/each}}
     
</script>

<!-- Display storages in drop down meny Template -->
<script id="withdrawRestrictionTemplate" type="text/x-handlebars-template">
<option data-id="0" value="0" class="withdrawStorage">Velg et lager</option>
{{#each transferRestriction}}    
<tr>
    <option data-id="{{storageID}}" value="{{storageID}}" class="withdrawStorage">{{storageName}}</option>
</tr>   
{{/each}} 
</script>  


<script id="withdrawProductTemplate" type="text/x-handlebars-template">
<br>
{{#each storageProduct}}    
 <button data-id="{{productID}}" class="btn btn-default product">{{productName}}</button>
{{/each}} 
</script>

<!-- Get storage information with user restriction -->
<script> 
$('#withdrawButton').hide(); // hides transferbutton                    
$(function () {
    $.ajax({
        type: 'GET',
        url: '?page=getTransferRestriction',
        dataType: 'json',
        success: function (data) {
            withdrawRestrictionTemplate(data);
            } 
        });
    });
</script>

<!-- Display storages in drop down meny Template -->
<script>
    function withdrawRestrictionTemplate(data) {
        var rawTemplate = document.getElementById("withdrawRestrictionTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var transferRestrictionGeneratedHTML = compiledTemplate(data);

        var transferContainer = document.getElementById("withdrawrRestrictionContainer");
        transferContainer.innerHTML = transferRestrictionGeneratedHTML;

    }
</script>


<!-- Get the selected storage, and POST this to retrive inventory-->
<script>
    $(function POSTfromStorageModal() {

        $('#withdrawrRestrictionContainer').on('change', function () {
            var givenStorageID = $(this).find("option:selected").data('id');
            
            if(givenStorageID > 0){
                $.ajax({
                    type: 'POST',
                    url: '?page=getStorageProduct',
                    data: {givenStorageID: givenStorageID},
                    dataType: 'json',
                    success: function (data) {
                    withdrawProductTemplate(data);
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
    function withdrawProductTemplate(data) {
        var rawTemplate = document.getElementById("withdrawProductTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var transferProductGeneratedHTML = compiledTemplate(data);

        var transferContainer = document.getElementById("withdrawProductContainer");
        transferContainer.innerHTML = transferProductGeneratedHTML;
    }
</script>

<!-- Get productID from selected ID -->
<script>
    $(function POSTselectedProduct() {
        
        $('#withdrawProductContainer').delegate('.product', 'click', function () {
            if($(this).data('clicked')) { 
                return false;
            }    
             
            $(this).data('clicked', true);
            
            var givenProductID = $(this).attr('data-id');
            
            
            $.ajax({
                type: 'POST',
                url: '?page=getProductByID',
                data: {givenProductID: givenProductID},
                dataType: 'json',
                success: function (data) {
                    
                    withdrawQuantityTemplate(data);
                     $('#withdrawButton').show();        
                }
            });
            return false;
            
            
        });
    });
</script> 


<script>
    function withdrawQuantityTemplate(data) {
        var rawTemplate = document.getElementById("withdrawQuantityTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var transferProductGeneratedHTML = compiledTemplate(data);

        var transferContainer = document.getElementById("withdrawQuantityContainer");
        transferContainer.innerHTML += transferProductGeneratedHTML;
    }
</script>


<script>
    $(function POSTtransferProducts() {

        $('#withdrawProducts').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();
 
                $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                error: function() {         
                    var $displayUsers = $('#errorMessage');
                    $displayUsers.empty().append("Kunne ikke overføre");
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


