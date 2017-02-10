

    <?php
    $InvResults = $GLOBALS["inventoryInfo"];
    
    ?>





<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <br> <br><br>        
    <div class="col-sm-3 col-md-4">


        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Produkt</th>
                        <th>Lager</th>
                        <th>Antall</th>
                    </tr>
                </thead>
                <tbody>
 <?php foreach ($InvResults as $InvResults): ?>  
                    <tr>
                        <td><?php  echo  $InvResults['storageID'];  ?></td>
                        <td><?php  echo  $InvResults['productID'];  ?></td>
                        <td><?php  echo  $InvResults['quantity'];  ?></td>
                    </tr>
  <?php endforeach; ?>

                </tbody>
            </table>

        </div>
    </div>
    <div class="col-sm-3 col-md-4">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th>Produkt</th>
                        <th>Lager</th>
                        <th>Antall</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Sondre</td>
                    <td>Fjærtoft</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Roger</td>
                    <td>Kolseth</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Ole</td>
                    <td>Lid aka Lidern</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-3 col-md-4">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th>Produkt</th>
                        <th>Lager</th>
                        <th>Antall</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Sondre</td>
                    <td>Fjærtoft</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Roger</td>
                    <td>Kolseth</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Ole</td>
                    <td>Lid aka Lidern</td>
                </tr>
            </tbody>
        </table>
    </div>



    
  
    

    <!-- HER KOMMER INNHOLDET>   -->                

</div>
