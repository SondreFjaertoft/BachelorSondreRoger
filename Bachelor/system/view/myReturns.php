<?php require("view/header.php"); ?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

    <br><br><br><br>

    <div class="col-sm-3 col-sm-offset-1 col-md-6 col-md-offset-2 form-group"> 
        
         <table class="table table-bordered table-striped table-responsive"> 
            <h4> Mine Returer </h4> 
            <tbody id="myReturnsContainer">

                <!-- HER KOMMER INNHOLDET FRA HANDLEBARS  -->

            </tbody>
        </table> 
        
<script id="myReturnsTemplate" type="text/x-handlebars-template">        
<tr>
    <th>Produkt</th>
    <th>Lager</th> 
    <th>kundeNr</th>
    <th>Antall</th>
    <th>Kommentar</th>
</tr>        
{{#each myReturns}}  
<tr>
    <td>{{productID}}</td>
    <td>{{storageID}}</td>
    <td>{{customerNr}}</td>
    <td>{{quantity}}</td>    
    <td>{{comment}}</td>    
<tr>
{{/each}}
</script>  
<script>        
    $(function () {
        
        $.ajax({
            type: 'GET',
            url: '?page=getMyReturns',
            dataType: 'json',
            success: function (data) {
                myReturnsTemplate(data);
            }
        });
    });     
    
</script>

<script>
    function myReturnsTemplate(data) {
        var rawTemplate = document.getElementById("myReturnsTemplate").innerHTML;
        var compiledTemplate = Handlebars.compile(rawTemplate);
        var mySalesnGeneratedHTML = compiledTemplate(data);

        var myReturnsContainer = document.getElementById("myReturnsContainer");
        myReturnsContainer.innerHTML = mySalesnGeneratedHTML;

    }
</script>