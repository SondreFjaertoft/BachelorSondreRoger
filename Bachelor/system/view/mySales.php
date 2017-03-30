<?php require("view/header.php");?>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<div class="container">
    <div class="col-sm-3 col-sm-offset-1 col-md-10 col-md-offset-1 form-group">
        
        <form id="searchForSale" class="form-inline" action="?page=getMySales" method="post">
            <div class="form-group">
                <div class="col-md-9">
                    <input class="form-control" form="searchForSale" type="text" name="givenProductSearchWord" value="" placeholder="Søk etter salg.." autocomplete="off">  
                    <input class="form-control" form="searchForSale" type="submit" value="Søk">
                    
                    <button onclick="UpdateSalesTable()" class="btn btn-default " type="button">Alle Salg</button>
                </div>
                
            </div> 
        </form>
        
        <br>
        
    
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title text-center"><b>Mine Salg</b></h3> 
            </div>
         <table class="table table-bordered table-striped table-responsive"> 
            
            <tbody id="mySalesContainer">

                <!-- HER KOMMER INNHOLDET FRA HANDLEBARS  -->

            </tbody>
        </table> 
        </div>
    </div>    
</div>    

<script id="mySalesTemplate" type="text/x-handlebars-template">        
<tr>
    <th>kundeNr</th>        
    <th>Produkt</th>
    <th>Lager</th>     
    <th>Antall</th>
    <th>Kommentar</th>
    <th>dato</th>    
</tr>        
{{#each mySales}}  
<tr>
    <td>{{customerNr}}</td>        
    <td>{{productName}}</td>
    <td>{{storageName}}</td>
    <td>{{quantity}}</td>    
    <td>{{comment}}</td>    
    <td>{{date}}</td>    
<tr>
{{/each}}
</script>  

<script>        
    $(function () {
        
        $.ajax({
            type: 'GET',
            url: '?page=getMySales',
            dataType: 'json',
            success: function (data) {
                mySalesTemplate(data);
            }
        });
    });     
    
</script>

<!-- Update sales information -->
<script>
    function UpdateSalesTable() {
        $(function () {
            $.ajax({
                type: 'GET',
                url: '?page=getMySales',
                dataType: 'json',
                success: function (data) {
                    mySalesTemplate(data);
                }
            });
        });
    }
</script>



<script>
    function mySalesTemplate(data) {
        var rawTemplate = document.getElementById("mySalesTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var mySalesnGeneratedHTML = compiledTemplate(data);

        var mySalesContainer = document.getElementById("mySalesContainer");
        mySalesContainer.innerHTML = mySalesnGeneratedHTML;

    }
</script>


<!-- SEARCH FOR SALES -->

<script>
    $(function POSTsearchForSale() {

        $('#searchForSale').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function (data) {
                    $("#searchForSale")[0].reset();
                    mySalesTemplate(data);
                }
            });
            return false;
        });
    });

</script>
