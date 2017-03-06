<?php require("view/header.php");?>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <br><br><br><br><br>
    <div class="col-sm-3 col-sm-offset-1 col-md-6 col-md-offset-2 form-group">


        
        <div class="col-sm-3 col-md-4">
            <p>Velg et lager og overføre fra</p>
            <select  id="fromTransferRestrictionContainer">
                
                <!-- Her kommer Handlebars Template-->

            </select>
        </div>
      

        <div class="col-sm-3 col-md-4">   
            <p>Velg et lager og overføre til</p>
            <select name="toStorage" id="toTransferRestrictionContainer" class="selectpicker" class="update">

                <!-- Her kommer Handlebars Template-->
                
            </select>
        </div>     
    
        <br><br><br><br>

        <div id="transferProductContainer">
            
            <!-- Viser Product som er valgt i FRA lager -->


        </div>
            
            <br><br><br>
            
        <div>
            <table class="table table-bordered table-striped table-responsive" id="transferQuantityContainer">

            <!-- Viser Product som er valgt i FRA lager -->
            </table>

        </div>    

        <div id="output-tostorage">
            <!-- Viser Lagernavn som er valgt i TIL lager -->

        </div>

  
        



    </div>
</div>  

<script id="transferQuantityTemplate" type="text/x-handlebars-template">
{{#each product}}   
    <tr class="selectQuantity">
        <th>Produkt:   </th>
        <td>{{productName}}</td>
        <input type="hidden" value="{{productID}}"/>
        <th>Antall:</th>
        <td><input type="int" value=""/></td> 
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
<option value="">Velg et lager</option>
{{#each transferRestriction}}    
<tr>
    <option data-id="{{storageID}}" class="transferStorage">{{storageName}}</option>
</tr>   
{{/each}} 
</script>    

<!-- Get storage information with user restriction -->
<script>  
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
    $(function POSTfromTransferModal() {

        $('#fromTransferRestrictionContainer').on('change', function () {
            var givenStorageID = $(this).find("option:selected").data('id');

            $.ajax({
                type: 'POST',
                url: '?page=getStorageProduct',
                data: {givenStorageID: givenStorageID},
                dataType: 'json',
                success: function (data) {
                transferProductTemplate(data);
                $('.selectQuantity').remove();
                
                }
            });
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
                return;
            }    
             
            $(this).data('clicked', true);
             
            var givenProductID = $(this).attr('data-id');
            
            $.ajax({
                type: 'POST',
                url: '?page=getProductByID',
                data: {givenProductID: givenProductID},
                dataType: 'json',
                success: function (data) {
                    
                    transferQuantityTemplate(data);
                    $(this).data('clicked', true);
            
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
    $(function POSTtoTransferModal() {

        $('#toTransferRestrictionContainer').on('change', function () {
            var givenStorageID = $(this).find("option:selected").data('id');

            alert(givenStorageID);
        });
    });
</script>

        