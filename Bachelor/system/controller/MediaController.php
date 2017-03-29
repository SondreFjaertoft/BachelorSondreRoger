<?php

require_once("Controller.php");

class mediaController extends Controller {

    public function show($page) {
        if ($page == "mediaAdm") {
            $this->mediaPage();
        } else if($page == "uploadImage"){
            $this->uploadImage();
            $this->mediaPage();
        } else if ($page == "getAllMediaInfo"){
            $this->getAllMediaInfo();
        } else if ($page == "uploadImageShortcut"){
            $this->uploadImage();
            $this->homePage();
        } else if ($page == "getMediaByID"){
            $this->getMediaByID();
        } else if ($page == "editMedia"){
            $this->editMedia();
        } else if ($page == "deleteMedia"){
            $this->deleteMedia();
        }
    }

    private function mediaPage() {
    
        return $this->render("mediaAdm");
    }
    
    private function homePage(){
        return $this->render("home");
    }

    private function uploadImage() {
        $givenCaterogy = $_REQUEST["givenCaterogy"];
        $imageName = "";
        $target_dir = "image/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                $imageName = basename($_FILES["fileToUpload"]["name"]);
                $this->addMedia($imageName, $givenCaterogy);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }           
        }
        
        
    }
    
    private function addMedia($fileName, $givenCaterogy){
        $mediaModel = $GLOBALS["mediaModel"];
        $added = $mediaModel->addMedia($fileName, $givenCaterogy);
        
        if($added){
            echo "workiiiing!";
        }
    }
    
    private function getAllMediaInfo(){
        $mediaModel = $GLOBALS["mediaModel"];
        
        if (isset($_POST['givenMediaSearchWord'])) {
            $givenStorageSearchWord = "%{$_REQUEST["givenMediaSearchWord"]}%";
            $mediaInfo = $mediaModel->getAllMediaInfo($givenStorageSearchWord);
        } else {
            $givenStorageSearchWord = "%%";
            $mediaInfo = $mediaModel->getAllMediaInfo($givenStorageSearchWord);
        }
        
        $data = json_encode(array("mediaInfo" => $mediaInfo));

        echo $data;
    }
    
    private function getMediaByID(){
        $givenMediaID = $_REQUEST["givenMediaID"];
        
        $mediaModel = $GLOBALS["mediaModel"];
        $mediaInfo = $mediaModel->getMediaByID($givenMediaID);
        
        $data = json_encode(array("mediaInfo" => $mediaInfo));
        echo $data;   
    }
    
    private function editMedia(){
        $editMediaID = $_REQUEST["editMediaID"];
        $editMediaName = $_REQUEST["editMediaName"];
        $editCategory = $_REQUEST["editCategory"];
        
        $mediaModel = $GLOBALS["mediaModel"];
        $result = $mediaModel->getMediaByID($editMediaID);
        
        $oldName = $result[0]["mediaName"];
        rename("image/".$oldName."","image/".$editMediaName);
        
        $edited = $mediaModel->editMedia($editMediaID, $editMediaName, $editCategory);
        
        if($edited){
            echo json_encode("success");
        }
    }
    
    private function deleteMedia(){
        $deleteMediaID = $_REQUEST["deleteMediaID"];
        
        $mediaModel = $GLOBALS["mediaModel"];
        $result = $mediaModel->getMediaByID($deleteMediaID);
        
        $mediaName = $result[0]["mediaName"];
        $deleted = $mediaModel->deletetMediaByID($deleteMediaID);
        
        if($deleted){
            unlink("image/".$mediaName);
            echo json_encode("success");
        }
    }

}
