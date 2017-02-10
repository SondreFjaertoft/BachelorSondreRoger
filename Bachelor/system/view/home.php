

<?php
$InvResults = $GLOBALS["inventoryMacInfo"];
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
                            <td><?php echo $InvResults['productName']; ?></td>
                            <td><?php echo $InvResults['storageName']; ?></td>
                            <td><?php echo $InvResults['macAdresse']; ?></td>
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

                <?php
                $InvResult2 = $GLOBALS["inventoryInfo"];
                ?>             
                <?php foreach ($InvResult2 as $InvResult2): ?>  
                    <tr>
                        <td><?php echo $InvResult2['productName']; ?></td>
                        <td><?php echo $InvResult2['storageName']; ?></td>
                        <td><?php echo $InvResult2['quantity']; ?></td>
                    </tr>
                <?php endforeach; ?>

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

                <?php
                $InvResult3 = $GLOBALS["inventoryInfo"];
                ?>               

                <?php foreach ($InvResult3 as $InvResult3): ?>  
                    <tr>
                        <td><?php echo $InvResult3['productName']; ?></td>
                        <td><?php echo $InvResult3['storageName']; ?></td>
                        <td><?php echo $InvResult3['quantity']; ?></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
        

    </div>







    <!-- HER KOMMER INNHOLDET>   -->                

</div>
