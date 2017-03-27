<?php require("view/header.php"); ?>

<div class="col-sm-9 col-sm-offset-3 col-md-8 col-md-offset-2 main">

    <div class="container">

    <div class="col-sm-3 col-sm-offset-1 col-md-10 col-md-offset-1 form-group"> 
        
               <div class="col-sm-3 col-md-4">
            <label>Returner til:</label>
            <select name="toStorageID" form="returnProducts" id="returnRestrictionContainer" class="form-control">

                <!-- Her kommer Handlebars Template-->

            </select>
        </div>
        
        
                <br><br><br><br>
        
        <div id="returnProductContainer">
            

            <!-- Viser Product som er valgt i FRA lager -->


        </div>  
                
        
        <br><br><br>

        <div>
            <table class="table table-bordered table-striped table-responsive" id="commentContainer">

                <tr>
                    <th>Kundenr:   </th> 
                    <td><input name="customerNumber" required="required" form="returnProducts" type="int" value=""/></td> 
                </tr>  
                <tr>
                    <th>kommentar:  </th>
                    <td><input name="returnComment" required="required" form="returnProducts" type="text" value=""/></td>
                </tr>

            </table>
        </div>   
        
        <div>
            <table class="table table-bordered table-striped table-responsive" id="returnQuantityContainer">
            
                <!-- Lar deg velge antall enheter -->

            </table>

            <form id="returnProducts" action="?page=returnProduct" method="post"></form>
            <input form="returnProducts" type="hidden" id="date" name="date">
            
            <button form="returnProducts" type="submit" class="btn btn-default" id="returnButton">Overfør</button>
            <p id="errorMessage"></p>
        </div>          
        
        
        
        
    </div>
</div>
</div>

<script id="returnQuantityTemplate" type="text/x-handlebars-template">
{{#each product}} 
    <tr class="selectQuantity">
        <th>Produkt:   </th>
        <td>{{productName}}</td>
        <input name="returnProductID[]" form="returnProducts" type="hidden" value="{{productID}}"/>
        <th>Antall:</th>
        <td><input name="returnQuantity[]" form="returnProducts" required="required" type="number" min="1" max="1000" value="" autocomplete="off"/></td>  
        
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

<script id="returnProductTemplate" type="text/x-handlebars-template">
    <br>  
    {{#each storageProduct}} 
    <button data-id="{{productID}}" class="btn btn-default product">{{productName}}</button>
    {{/each}} 
</script>

<!-- Display storages in drop down meny Template -->
<script id="returnRestrictionTemplate" type="text/x-handlebars-template">
<option data-id="0" value="0" class="returnStorage">Velg et lager</option>
{{#each transferRestriction}}    
<tr>
    <option data-id="{{storageID}}" value="{{storageID}}" class="returnStorage">{{storageName}}</option>
</tr>   
{{/each}}
        
</script>  


<!-- Get storage information with user restriction -->
<script>
    $('#returnButton').hide(); // hides transferbutton  
    $('#commentContainer').hide();
    $(function () {
        $.ajax({
            type: 'GET',
            url: '?page=getTransferRestriction',
            dataType: 'json',
            success: function (data) {
                returnRestrictionTemplate(data);
            }
        });
    });
</script>


<!-- Display storages in drop down meny Template -->
<script>
    function returnRestrictionTemplate(data) {
        var rawTemplate = document.getElementById("returnRestrictionTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var transferRestrictionGeneratedHTML = compiledTemplate(data);

        var transferContainer = document.getElementById("returnRestrictionContainer");
        transferContainer.innerHTML = transferRestrictionGeneratedHTML;

    }
</script>


<!-- Get the selected storage, and POST this to retrive inventory-->
<script>
 
    $(function POSTfromStorageModal() {
        
        $('#returnRestrictionContainer').on('change', function () {
            givenStorageID = $(this).find("option:selected").data('id');

            if (givenStorageID > 0) {
                $.ajax({
                    type: 'POST',
                    url: '?page=getStorageProduct',
                    data: {givenStorageID: givenStorageID},
                    dataType: 'json',
                    success: function (data) {
                        returnProductTemplate(data);
                        $('#transferButton').hide();
                        $('#commentContainer').hide();
                
                    }
                });
            } else {
                $('.product').remove();
            }

            return false;

        });
    });
</script>

<!-- Display products in storage Template -->
<script>
    function returnProductTemplate(data) {
        var rawTemplate = document.getElementById("returnProductTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var transferProductGeneratedHTML = compiledTemplate(data);

        var productContainer = document.getElementById("returnProductContainer");
        productContainer.innerHTML = transferProductGeneratedHTML;
    }
</script>

<!-- Get productID from selected ID -->
<script>
                            
    $(function POSTselectedProduct() {

        $('#returnProductContainer').delegate('.product', 'click', function () {
            if ($(this).data('clicked')) {
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

                    returnQuantityTemplate(data);
                    $('#commentContainer').show();
                    $('#returnButton').show();
                }
            });
            return false;


        });
    });
</script> 

<script>
    function returnQuantityTemplate(data) {
        var rawTemplate = document.getElementById("returnQuantityTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var transferProductGeneratedHTML = compiledTemplate(data);

        var transferContainer = document.getElementById("returnQuantityContainer");
        transferContainer.innerHTML += transferProductGeneratedHTML;
        
    }
</script>

<script>
    $(function POSTtransferProducts() {

        $('#returnProducts').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                error: function () {
                    var $displayUsers = $('#errorMessage');
                    $displayUsers.empty().append("Kunne ikke overføre");
                },
                success: function (data) {
                    $('.product').remove();
                    $('.selectQuantity').remove();
                    $('#errorMessage').remove();
                    updateReturn();
                }
            });
            return false;
        });
    });
</script>

<script> 
function updateReturn() {                            
$('#returnButton').hide();// hides transferbutton 
$('#commentContainer').hide();
$(function () {
    $.ajax({
        type: 'GET',
        url: '?page=getTransferRestriction',
        dataType: 'json',
        success: function (data) {
            returnRestrictionTemplate(data);
            }  
        });
    });
}
</script>

<script>
Date.prototype.yyyymmdd = function() {
   var yyyy = this.getFullYear();
   var mm = this.getMonth() < 9 ? "0" + (this.getMonth() + 1) : (this.getMonth() + 1); // getMonth() is zero-based
   var dd  = this.getDate() < 10 ? "0" + this.getDate() : this.getDate();
   return "".concat(yyyy).concat(mm).concat(dd);
  };

var d = new Date();
document.getElementById("date").value  = d.yyyymmdd();

</script>

<!-- remove product modal -->
<script>
    $(function POSTdeleteStorageModal() {

        $('#returnQuantityContainer').delegate('.remove', 'click', function () {
           var $tr = $(this).closest('tr');        
          
           $tr.fadeOut(150, function() {
            $(this).remove();
           });       
        });
    });
</script>  