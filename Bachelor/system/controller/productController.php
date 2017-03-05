<?php

require_once("Controller.php");

// Represents home page
class ProductController extends Controller {

    // Render "Overview" view

    public function show($page) {
        if ($page == "productAdm") {
            $this->productAdmPage();
        } else if ($page == "addProductEngine") {
            $this->addProductEngine();
        } else if ($page == "editProductEngine") {
            $this->editProductEngine();
        } else if ($page == "deleteProductEngine") {
            $this->deleteProductEngine();
        } else if ($page == "getAllProductInfo"){
            $this->getAllProductInfo();
        } else if ($page == "getProductByID"){
            $this->getProductByID();
        } else if ($page == "getProductLocation") {
            $this->getProductLocation();
        }
    }
    

    private function productAdmPage() {
        return $this->render("productAdm");
    }

    private function addProductEngine() {
        $givenProductName = $_REQUEST["givenProductName"];
        $givenBuyPrice = $_REQUEST["givenBuyPrice"];
        $givenSalePrice = $_REQUEST["givenSalePrice"];
        $givenCategoryID = $_REQUEST["givenCategoryID"];
        $givenMediaID = $_REQUEST["givenMediaID"];
        $givenProductNumber = $_REQUEST["givenProductNumber"];
        $givenProductDate = "2017-02-21 00:00:00";
        if (isset($_POST['givenMacAdresse'])) {
        $givenMacAdresse = $_REQUEST["givenMacAdresse"];
        } else {
        $givenMacAdresse = "FALSE";    
        }
        
        $productCreationInfo = $GLOBALS["productModel"];
        $productCreationInfo->addProduct($givenProductName, $givenBuyPrice, $givenSalePrice, $givenCategoryID, $givenMediaID, $givenProductNumber, $givenProductDate, $givenMacAdresse);

        echo json_encode("success");
    }

    private function editProductEngine() {
        $editProductName = $_REQUEST["editProductName"];
        $editBuyPrice = $_REQUEST["editBuyPrice"];
        $editSalePrice = $_REQUEST["editSalePrice"];
        $editCategoryID = $_REQUEST["editCategoryID"];
        $editMediaID = $_REQUEST["editMediaID"];
        $editProductNumber = $_REQUEST["editProductNumber"];
        $editProductID = $_REQUEST["editProductID"];

        $productEditInfo = $GLOBALS["productModel"];
        $productEditInfo->editProduct($editProductName, $editBuyPrice, $editSalePrice, $editCategoryID, $editMediaID, $editProductNumber, $editProductID);

        echo json_encode("success");
    }

    private function deleteProductEngine() {
        $removeProductID = $_REQUEST["deleteProductID"];

        $removeProduct = $GLOBALS["productModel"];
        $removeProduct->removeProduct($removeProductID);
        
        echo json_encode("success");
    }
    
    private function getAllProductInfo() {
        $productInfo = $GLOBALS["productModel"];

        if (isset($_POST['givenProductSearchWord'])) {
            $givenProductSearchWord = "%{$_REQUEST["givenProductSearchWord"]}%";
            $productModel = $productInfo->getSearchResult($givenProductSearchWord);
        } else {
            $givenProductSearchWord = "%%";
            $productModel = $productInfo->getSearchResult($givenProductSearchWord);
        }
        
        $data = json_encode(array("productInfo" => $productModel));

        echo $data;
    }
    
    private function getProductByID(){
        $givenProductID = $_REQUEST["givenProductID"];

        $productInfo = $GLOBALS["productModel"];
        $productModel = $productInfo->getAllProductInfoFromID($givenProductID);

        $data = json_encode(array("product" => $productModel));
        echo $data;
    }
    
    private function getProductLocation(){
        $givenProductID = $_REQUEST['givenProductID'];

        $inventoryInfo = $GLOBALS["inventoryModel"];
        $inventoryModel = $inventoryInfo->getAllProductLocationByProductID($givenProductID);

        $data = json_encode(array("productLocation" => $inventoryModel));
        echo $data; 
    }

}
