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
        }
    }

    private function productAdmPage() {
        $productInfo = $GLOBALS["productModel"];

        if (isset($_POST['givenProductSearchWord'])) {
            $givenProductSearchWord = "%{$_REQUEST["givenProductSearchWord"]}%";
            $productModel = $productInfo->getSearchResult($givenProductSearchWord);
        } else {
            $givenProductSearchWord = "%%";
            $productModel = $productInfo->getSearchResult($givenProductSearchWord);
        }

        $data = array("productResult" => $productModel);

        return $this->render("productAdm", $data);
    }

    private function addProductEngine() {
        $givenProductName = $_REQUEST["givenProductName"];
        $givenBuyPrice = $_REQUEST["givenBuyPrice"];
        $givenSalePrice = $_REQUEST["givenSalePrice"];
        $givenCategoryID = $_REQUEST["givenCategoryID"];
        $givenMediaID = $_REQUEST["givenMediaID"];
        $givenProductNumber = $_REQUEST["givenProductNumber"];
        $givenProductDate = "2017-02-21 00:00:00";

        $productCreationInfo = $GLOBALS["productModel"];
        $productCreationInfo->addProduct($givenProductName, $givenBuyPrice, $givenSalePrice, $givenCategoryID, $givenMediaID, $givenProductNumber, $givenProductDate);

        header("Location:index.php?page=productAdm");
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

        header("Location:index.php?page=productAdm");
    }

    private function deleteProductEngine() {
        $removeProductID = $_REQUEST["deleteProductID"];

        $removeProduct = $GLOBALS["productModel"];
        $removeProduct->removeProduct($removeProductID);
        
        header("Location:index.php?page=productAdm");
    }

}
