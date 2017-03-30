<?php require("view/header.php"); ?>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

   <div class="container"> 

    <div class="col-sm-3 col-sm-offset-1 col-md-10 col-md-offset-1 form-group"> 
        
        <form id="searchForReturns" class="form-inline" action="?page=getMyReturns" method="post">
            <div class="form-group">
                <div class="col-md-9">
                    <input class="form-control" form="searchForReturns" type="text" name="givenProductSearchWord" value="" placeholder="Søk etter returer.." autocomplete="off">  
                    <input class="form-control" form="searchForReturns" type="submit" value="Søk">
                    
                    <button onclick="UpdateReturnsTable()" class="btn btn-default " type="button">Alle Returer</button>
                </div>
                
            </div> 
        </form>
        
        <br>
        
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title text-center"><b>Mine Returer</b></h3>
            </div>
         <table class="table table-bordered table-striped table-responsive"> 
            
            <tbody id="myReturnsContainer">

                <!-- HER KOMMER INNHOLDET FRA HANDLEBARS  -->

            </tbody>
        </table> 
            </div>
        
        </div>
   </div>
</div>  
    
   
<script id="myReturnsTemplate" type="text/x-handlebars-template">        
<tr>
    <th>kundeNr</th>        
    <th>Produkt</th>
    <th>Lager</th>     
    <th>Antall</th>
    <th>Kommentar</th>
    <th>dato</th>   
</tr>        
{{#each myReturns}}  
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
            url: '?page=getMyReturns',
            dataType: 'json',
            success: function (data) {
                myReturnsTemplate(data);
            }
        });
    });     
    
</script>

<!-- Update return information -->
<script>
    function UpdateReturnsTable() {
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
    }
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

<!-- SEARCH FOR RETURNS -->

<script>
    $(function POSTsearchForReturn() {

        $('#searchForReturns').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function (data) {
                    $("#searchForReturns")[0].reset();
                    myReturnsTemplate(data);
                }
            });
            return false;
        });
    });

</script>