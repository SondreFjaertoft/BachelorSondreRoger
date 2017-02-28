
<?php
$storageInfo =  $GLOBALS["storageInfo"];
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <br><br><br><br><br>
    <div class="col-sm-3 col-sm-offset-1 col-md-6 col-md-offset-2 form-group">
    
    <p> Velg Lager å overføre fra </p>
         <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Velg lager   
                <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <table>
                    <form id="choosenStorage" action="" method="post">        </form>
                <?php foreach ($storageInfo as $fromStorage) : ?>
                    <tr>
                        <td><button form="choosenStorage" name="fromStorage" type="submit" value="<?php echo $fromStorage['storageID'];?>"><?php echo $fromStorage['storageName'];?></button> </td>
                    </tr>
                    <?php endforeach;?>
                    
                </table>
               
            </ul>
        </div>
    
    
    <br><br>
    
    
        <p> Velg Lager å overføre til </p>
                 <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Velg Lager
                <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <table>
                <?php foreach ($storageInfo as $toStorage) : ?>
                    <tr>
                        <td><button value="<?php echo $toStorage['storageID'];?>"><?php echo $toStorage['storageName'];?></button> </td>
                    </tr>
                    <?php endforeach;?>
                    
                </table>
               
            </ul>
        </div>
        
        
        <?php if (isset($_POST["fromStorage"])) {
            $choosenStorage = $_POST['fromStorage'];
            echo $choosenStorage;
                   
        } ?>
        
    </div>
</div>    


