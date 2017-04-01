<?php require("view/header.php"); ?>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

    <div class="container">
        <div class="col-sm-3 col-sm-offset-1 col-md-10 col-md-offset-1 form-group">
            <form id="withdrawProducts" action="?page=withdrawProduct" method="post">
                <div class="col-sm-3 col-md-4">
                    <label>Uttak fra: </label><div id="withdrawrRestrictionContainer"></div>
                </div>

                <br><br><br><br>

                <div id="withdrawProductContainer">


                    <!-- Viser Product som er valgt i FRA lager -->


                </div> 
                
                <br><br>

                <div>
                    <table class="table table-bordered table-striped table-responsive" id="commentContainer" hidden>

                        <tr>
                            <th>Kundenr:   </th> 
                            <td><input name="customerNumber" required="required" form="withdrawProducts" type="int" value=""/></td> 
                        </tr>  
                        <tr>
                            <th>kommentar:  </th>
                            <td><input name="withdrawComment" required="required" form="withdrawProducts" type="text" value=""/></td>
                        </tr>

                    </table>
                </div>

                <br>

                <div>
                    <table class="table table-bordered table-striped table-responsive" id="withdrawQuantityContainer">

                        <!-- Lar deg velge antall enheter -->

                    </table>


                    <input form="withdrawProducts" type="hidden" id="date" name="date">

                    <button form="withdrawProducts" type="submit" class="btn btn-default" id="withdrawButton" hidden>Overfør</button>
                    <p id="errorMessage"></p>
                </div>
            </form>     
        </div>
    </div>        

</div> 


<!-- Display storages in drop down meny Template -->
<script id="withdrawRestrictionTemplate" type="text/x-handlebars-template">
{{#each transferRestriction}}    
    {{storageName}}
   <input type="hidden" name="fromStorageID" form="withdrawProducts" value="{{storageID}}">
{{/each}}
        
</script>

<script id="withdrawProductTemplate" type="text/x-handlebars-template">
    <br>  
    {{#each storageProduct}} 
    <button data-id="{{productID}}" class="btn btn-default product">{{productName}}</button>
    {{/each}} 
</script>

<script id="withdrawQuantityTemplate" type="text/x-handlebars-template">
    {{#each prodInfo}} 
    <tr class="selectQuantity">
    <th>Produkt:   </th>
    <td>{{productName}}</td>
    <input name="withdrawProductID[]" id="{{productID}}" form="withdrawProducts" type="hidden" value="{{productID}}"/>
    <th>Antall:</th>
    <td><input name="withdrawQuantity[]" form="withdrawProducts" required="required" type="number" min="1" max="{{quantity}}" value="" autocomplete="off"/></td> 
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


<!-- Get storage information with user restriction -->
<script>

    $('#withdrawButton').hide();
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

    $(function () {
        $.ajax({
            type: 'GET',
            url: '?page=getStorageProduct',
            dataType: 'json',
            success: function (data) {
                withdrawProductTemplate(data);
            }
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

            var givenProductID = $(this).attr('data-id');
            if ($('#' + givenProductID).length)
            {
                return false;
            } else {

                $.ajax({
                    type: 'POST',
                    url: '?page=getProdQuantity',
                    data: {givenProductID: givenProductID},
                    dataType: 'json',
                    success: function (data) {

                        withdrawQuantityTemplate(data);
                        $('#commentContainer').show();
                        $('#withdrawButton').show();
                    }
                });
                return false;

            }
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
                error: function () {
                    var $displayUsers = $('#errorMessage');
                    $displayUsers.empty().append("Kunne ikke overføre");
                },
                success: function (data) {
                    $('.product').remove();
                    $('.selectQuantity').remove();
                    $('#errorMessage').remove();
                    updateSale();
                }
            });
            return false;
        });
    });
</script>

<script>
    function updateSale() {
        $('#withdrawButton').hide();// hides transferbutton 
        $('#commentContainer').hide();
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
    }
</script>

<script>
    Date.prototype.yyyymmdd = function () {
        var yyyy = this.getFullYear();
        var mm = this.getMonth() < 9 ? "0" + (this.getMonth() + 1) : (this.getMonth() + 1); // getMonth() is zero-based
        var dd = this.getDate() < 10 ? "0" + this.getDate() : this.getDate();
        return "".concat(yyyy).concat(mm).concat(dd);
    };

    var d = new Date();
    document.getElementById("date").value = d.yyyymmdd();

</script>

<script>
    $(function removeSelectedProductModal() {

        $('#withdrawQuantityContainer').delegate('.remove', 'click', function () {
            var $tr = $(this).closest('tr');

            $tr.fadeOut(150, function () {
                $(this).remove();
            });

        });
    });
</script>  
