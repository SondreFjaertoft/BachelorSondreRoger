
<?php
$restrictionInfo = $GLOBALS["restrictionInfo"];

?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <br><br><br><br><br>
    <div class="col-sm-3 col-sm-offset-1 col-md-6 col-md-offset-2 form-group">

 
        <form action="" id="foo" method="post">

            <p>Velg et lager og overføre fra</p>
            <select name="fromStorage" id="fraLager" class="update">
                <option value="">Velg et lager</option>
                <?php foreach ($restrictionInfo as $fromStorage) : ?>
                    
                    <tr>
                    <option value="<?php echo $fromStorage['storageName']; ?>" onclick="$.fromStorage(this);"><?php echo $fromStorage['storageName']; ?></option>
                    </tr>
                <?php endforeach; ?>

            </select>

            <br><br>

            <p>Velg et lager og overføre til</p>
            <select name="toStorage" id="tilLager" class="update">
                <option value="">Velg et lager</option>
                <?php foreach ($restrictionInfo as $toStorage) : ?>
                    <tr>
                    <option value="<?php echo $toStorage['storageName']; ?>" onclick="$.toStorage(this);"><?php echo $toStorage['storageName']; ?></option>
                    </tr>
                <?php endforeach; ?>

            </select>

        </form>

        <div id="output-fromstorage">
            <!-- Viser Lagernavn som er valgt i FRA lager -->
            
           
        </div>

        <div id="output-tostorage">
            <!-- Viser Lagernavn som er valgt i TIL lager -->
            
        </div>

        <script>
            $.fromStorage = function (query) {
                $("#output-fromstorage").html("you have choosen to transfer from: "+this.value);
            }
            $('select[name=fromStorage]').on('change', $.fromStorage);
        </script>

        <script>
            $.toStorage = function (query) {
                $("#output-tostorage").html("you have choosen to transfer to: "+this.value);
            }
            $('select[name=toStorage]').on('change', $.toStorage);
        </script>








    </div>
</div>    


