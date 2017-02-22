
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

    <?php
    $productResults = $GLOBALS["productResult"];
    $productResults1 = $GLOBALS["productResult"];
    ?>
    <br><br><br><br>
    <div class="col-sm-3 col-sm-offset-1 col-md-6 col-md-offset-2 form-group">

        <form class="form-inline" action="" method="post">
            <div class="form-group">
                <div class="col-md-9">
                    <input class="form-control" type="text" name="givenProductSearchWord" value="" placeholder="Søk etter produkt..">  
                    <input class="form-control" type="submit" value="Søk">
                    <a href="?page=productAdm" class="btn btn-default">Vis alle</a>
                </div>
                <div class="col-md-1 col-md-offset-2">
                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#opprettProdukt">Opprett Produkt</button>
                </div>
            </div> 
        </form>



        <table class="table table-bordered table-striped"> 


            <h4> Productoversikt </h4> 
            <thead>
                <tr>
                    <th>Produktnavn</th>
                    <th>Kategori</th>
                    <th>Handlinger</th>
                </tr>
            </thead>


            <tbody>
                <?php foreach ($productResults as $productResults): ?>  
                    <tr>
                        <td><?php echo $productResults['productName']; ?></td>
                        <td><?php echo $productResults['categoryID']; ?></td>



                        <!-- Oppretter et form som knappene blir linket til  --> 



                        <td class="text-center">
                            <form id="productRedForm" action="" method="post">
                            </form>



                            <!-- Knapp som aktiverer Model for produktredigering  --> 

                            <button form="productRedForm" type="submit" name="editProduct" data-toggle="tooltip" title="Rediger product" value="<?php echo $productResults['productID']; ?>" 
                                    style="appearance: none;
                                    -webkit-appearance: none;
                                    -moz-appearance: none;
                                    outline: none;
                                    border: 0;
                                    background: transparent;
                                    display: inline;">
                                <span class="glyphicon glyphicon-edit" style="color: green"></span>
                            </button>



                            <!-- Knapp som aktiverer Model for å vise productinformasjon  --> 

                            <button form="productRedForm" type="submit" name="showProductInfo" data-toggle="tooltip" title="Mer informasjon" value="<?php echo $productResults['productID']; ?>" 
                                    style="appearance: none;
                                    -webkit-appearance: none;
                                    -moz-appearance: none;
                                    outline: none;
                                    border: 0;
                                    background: transparent;
                                    display: inline;">
                                <span class="glyphicon glyphicon-menu-hamburger" style="color: #003366" ></span></button>


                            <!-- Knapp som aktiverer Model for sletting av product  --> 


                            <button form="productRedForm" name="deleteProduct" data-toggle="tooltip" title="Slett product" value="<?php echo $productResults['productID']; ?>" 
                                    style="appearance: none;
                                    -webkit-appearance: none;
                                    -moz-appearance: none;
                                    outline: none;
                                    border: 0;
                                    background: transparent;
                                    display: inline;">
                                <span class="glyphicon glyphicon-remove" style="color: red"></span></button>

                        </td>
                    </tr>   
                <?php endforeach; ?> 
            </tbody>

        </table>
    </div>


    <!-- DIV som holder på all informasjon i midten av skjermen  -->


    <!-- rediger bruker -->

    <div class="col-sm-3 col-md-4">


        <?php
        foreach ($productResults1 as $productResults1):

            if (isset($_POST['editProduct'])) {
                $givenProductID = $_REQUEST["editProduct"];

                if ($productResults1['productID'] == $givenProductID) {
                    ?>
                    <script>
                        $(function () {
                            $('#produktModal').modal('show');
                        });
                    </script>


                    <div class="modal fade" id="produktModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Innholdet til Modalen -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Bruker informasjon</h4>
                                </div>
                                <div class="modal-body">

                                    <form action="?page=editProductEngine" method="post" id="formM">
                                        <input type="hidden" name="editProductID" value="<?php echo $productResults1['productID']; ?>"><br>
                                        Produktnavn: <br>
                                        <input type="text" name="editProductName" value="<?php echo $productResults1['productName']; ?>"><br>
                                        Kjøpspris: <br>
                                        <input type="int" name="editBuyPrice" value="<?php echo $productResults1['buyPrice']; ?>"><br>
                                        Salgspris: <br>
                                        <input type="int" name="editSalePrice" value="<?php echo $productResults1['salePrice']; ?>"><br>
                                        Kategori: <br>
                                        <input type="int" name="editCategoryID" value="<?php echo $productResults1['categoryID']; ?>"><br>
                                        Media: <br>
                                        <input type="int" name="editMediaID" value="<?php echo $productResults1['mediaID']; ?>"><br>
                                        Produktnummer: <br>
                                        <input type="text" name="editProductNumber" value="<?php echo $productResults1['productNumber']; ?>"><br>

                                    </form>

                                </div>
                                <div class="modal-footer">
                                    <input class="btn btn-default" type="submit" value="Lagre" form="formM">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <?php
                }
            }

// Vis produktInformasjon

            if (isset($_POST['showProductInfo'])) {
                $givenProductID = $_REQUEST["showProductInfo"];

                if ($productResults1['productID'] == $givenProductID) {
                    ?>
                    <script>
                        $(function () {
                            $('#produktModal').modal('show');
                        });
                    </script>


                    <div class="modal fade" id="produktModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Innholdet til Modalen -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Bruker informasjon</h4>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Produktnavn: </th>
                                                <td><?php echo $productResults1['productName']; ?></td>
                                            </tr>


                                            <tr>
                                                <th>Kjøpspris: </th>
                                                <td><?php echo $productResults1['buyPrice']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Salgspris: </th>
                                                <td><?php echo $productResults1['salePrice']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Kategori: </th>
                                                <td><?php echo $productResults1['categoryID']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Media: </th>
                                                <td><?php echo $productResults1['mediaID']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Produktnummer: </th>
                                                <td><?php echo $productResults1['productNumber']; ?></td>
                                            </tr>



                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <?php
                }
            }



            // Slett produkt

            if (isset($_POST['deleteProduct'])) {
                $givenProductIDID = $_REQUEST["deleteProduct"];

                if ($productResults1['productID'] == $givenProductIDID) {
                    ?>
                    <script>
                        $(function () {
                            $('#produktModal').modal('show');
                        });
                    </script>


                    <div class="modal fade" id="produktModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Innholdet til Modalen -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Bruker informasjon</h4>
                                </div>
                                <div class="modal-body">

                                    <p> Er du sikker på at du vil slette  <P>
                                        <?php
                                        echo "Produkt: " . $productResults1['productName'];
                                        ?>

                                    <form action="?page=deleteProductEngine" method="post" id="formS">
                                        <input type="hidden" name="deleteProductID" value="<?php echo $productResults1['productID'] ?>"><br>

                                    </form>


                                </div>
                                <div class="modal-footer">
                                    <input class="btn btn-default" type="submit" value="Slett" form="formS">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>
                                </div>
                            </div>
                        </div>
                    </div>               





                    <?php
                }
            }

        endforeach;
        ?>




    </div>



    <!-- OPPRETT PRODUKT  -->


    <div class="modal fade" id="opprettProdukt" role="dialog">
        <div class="modal-dialog">
            <!-- Innholdet til Modalen -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Opprett Produkt</h4>
                </div>
                <div class="modal-body">
                    <div style="text-align: center">
                        <form action="?page=addProductEngine" method="post" id="form12">
                            <p style="font-weight: bold ">Produktnavn:</p>
                            <input type="text" name="givenProductName" value=""><br>
                            <p style="font-weight: bold ">Kjøpspris:</p>
                            <input type="int" name="givenBuyPrice" value=""><br>
                            <p style="font-weight: bold ">Salgspris:</p>
                            <input type="int" name="givenSalePrice" value=""><br>
                            <p style="font-weight: bold ">Kategori:</p>
                            <input type="int" name="givenCategoryID" value=""><br>
                            <p style="font-weight: bold ">Media:</p>
                            <input type="int" name="givenMediaID" value=""><br>
                            <p style="font-weight: bold ">Produktnummer:</p>
                            <input type="text" name="givenProductNumber" value=""><br>
                            <p style="font-weight: bold ">MacAdresse:</p>
                            <input type="checkbox" name="givenMacAdresse" value="TRUE"><br>
                            <br>
                            
                        </form> 
                    </div>
                </div>
                <div class="modal-footer">

                    <input class="btn btn-default" form="form12" type="submit" value="Opprett Produkt">


                    <button type="button" class="btn btn-default" data-dismiss="modal">Avslutt</button>

                </div>

            </div>
        </div>
    </div>








</div>