<?php

require_once("Controller.php");

// Represents home page
class transferController extends Controller {

    // Render "Overview" view

    public function show($page) {
        if ($page == "transfer") {
            $this->transferPage();
        } else if ($page == "getTransferRestriction") {
            $this->getTransferRestriction();
        } else if ($page == "transferProduct") {
            $this->transferProduct();
        }
    }

    private function transferPage() {
        $givenUserID = $_SESSION["userID"];
        $restrictionInfo = $GLOBALS["restrictionModel"];
        $restrictionModel = $restrictionInfo->getAllRestrictionInfoFromUserID($givenUserID);

        $data = array("restrictionInfo" => $restrictionModel);

        return $this->render("transfer", $data);
    }

    private function getTransferRestriction() {
        $givenUserID = $_SESSION["userID"];
        $restrictionInfo = $GLOBALS["restrictionModel"];
        $restrictionModel = $restrictionInfo->getAllRestrictionInfoFromUserID($givenUserID);

        $data = json_encode(array("transferRestriction" => $restrictionModel));
        echo $data;
    }

    private function transferProduct() {
        $fromStorageID = $_REQUEST["fromStorageID"];
        $transferProductIDArray = $_REQUEST["transferProductID"];
        $transferQuantityArray = $_REQUEST["transferQuantity"];
        $toStorageID = $_REQUEST["toStorageID"];

        if ($fromStorageID == 0 || $toStorageID == 0) {
            return false;
        } else {

            $inventoryInfo = $GLOBALS["inventoryModel"];

            for ($i = 0; $i < sizeof($transferProductIDArray); $i++) {
                $count = $inventoryInfo->doesProductExistInStorage($toStorageID, $transferProductIDArray[$i]);

                    if ($count[0]["COUNT(*)"] < 1) {


                        $inventoryInfo->addInventory($toStorageID, $transferProductIDArray[$i], $transferQuantityArray[$i]);
                        $inventoryInfo->transferFromStorage($fromStorageID, $transferProductIDArray[$i], $transferQuantityArray[$i]);
                    } else {

                        $inventoryInfo->transferFromStorage($fromStorageID, $transferProductIDArray[$i], $transferQuantityArray[$i]);
                        $inventoryInfo->transferToStorage($toStorageID, $transferProductIDArray[$i], $transferQuantityArray[$i]);
                    }

               
            }
        }
        $data = json_encode("success");
        echo $data;
    }

} 
