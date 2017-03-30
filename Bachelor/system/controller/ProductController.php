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
        } else if ($page == "getAllCategoryInfo"){
            $this->getAllCategoryInfo();
        }
    }
    

    private function productAdmPage() {
        return $this->render("productAdm");
    }

    private function addProductEngine() {
        $givenProductName = $_REQUEST["givenProductName"];
        $givenPrice = $_REQUEST["givenPrice"];
        $givenCategoryID = $_REQUEST["givenCategoryID"];
        $givenMediaID = $_REQUEST["givenMediaID"];
        $givenProductDate = $_REQUEST["date"];
        if (isset($_POST['givenMacAdresse'])) {
        $givenMacAdresse = $_REQUEST["givenMacAdresse"];
        } else {
        $givenMacAdresse = "FALSE";    
        }
        
        $productCreationInfo = $GLOBALS["productModel"];
        $productCreationInfo->addProduct($givenProductName, $givenPrice, $givenCategoryID, $givenMediaID, $givenProductDate, $givenMacAdresse);

        echo json_encode("success");
    }

    private function editProductEngine() {
        $editProductName = $_REQUEST["editProductName"];
        $editPrice = $_REQUEST["editPrice"];
        $editCategoryID = $_REQUEST["editCategoryID"];
        $editMediaID = $_REQUEST["editMediaID"];
        $editProductID = $_REQUEST["editProductID"];

        $productEditInfo = $GLOBALS["productModel"];
        $productEditInfo->editProduct($editProductName, $editProductID, $editPrice, $editCategoryID, $editMediaID);

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

        $mediaModel = $GLOBALS["mediaModel"];
        $mediaInfo = $mediaModel->getAllMediaInfo();
        
        $categoryModel = $GLOBALS["categoryModel"];
        $categoryInfo = $categoryModel->getAllCategoryInfo();
        
        $data = json_encode(array("product" => $productModel, "media" => $mediaInfo, "category" => $categoryInfo));
        echo $data;
    }
    
    private function getProductLocation(){
        $givenProductID = $_REQUEST['givenProductID'];

        $inventoryInfo = $GLOBALS["inventoryModel"];
        $inventoryModel = $inventoryInfo->getAllProductLocationByProductID($givenProductID);

        $data = json_encode(array("productLocation" => $inventoryModel));
        echo $data; 
    }
    
    private function getAllCategoryInfo(){
        $categoryModel = $GLOBALS["categoryModel"];
        $categoryInfo = $categoryModel->getAllCategoryInfo();
        
        $data = json_encode(array("categoryInfo" => $categoryInfo));
        echo $data;
    }

} 
