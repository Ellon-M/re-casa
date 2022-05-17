<?php

namespace App\Processors;
use App\Models\DataHandle;
use App\Utils\Config;
use App\Utils\MyLogger;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class UserFunctions
{
    private $mLogger;
    private $dbConnect;
    private $dataHandle;

    /**
     * UserFunctions constructor.
     */
    public function __construct()
    {
        $this->mLogger = new MyLogger();
        $this->dbConnect = new DBConnect();
        $this->dataHandle = new DataHandle();
    }

    public function addProperty($propertyName,$propertyDescription, $propertyValue,$acreage,$location,$hideStatus,
                                $propertyZone, $ownershipType,$sellerID,$imagesTempName,$imagesFileName,$baseDir){


        $conn = $this->dbConnect->dbConnection();
        $query = "INSERT INTO property(propertyTitle,propertyDescription,propertyValue,acreage,location,hideStatus,propertyZone,
                    ownershipType,sellerID) VALUES(?,?,?,?,?,?,?,?,?)";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'ssississi',$paramPropertyTitle,$paramPropertyDescription,
                $paramPropertyValue, $paramAcreage,$paramLocation,$paramHideStatus,$paramPropertyZone,
                $paramOwnershipType,$paramSellerID);
            $paramPropertyTitle = $this->dataHandle->cleanData($propertyName);
            $paramPropertyDescription = $this->dataHandle->cleanText($propertyDescription);
            $paramPropertyValue = $this->dataHandle->cleanData($propertyValue);
            $paramAcreage = $this->dataHandle->cleanData($acreage);
            $paramLocation = $this->dataHandle->cleanText($location);
            $paramHideStatus = $this->dataHandle->cleanData($hideStatus);
            $paramPropertyZone = $this->dataHandle->cleanData($propertyZone);
            $paramOwnershipType = $this->dataHandle->cleanData($ownershipType);
            $paramSellerID = $this->dataHandle->cleanData($sellerID);

            if (mysqli_stmt_execute($stmt)){
                $propertyID = mysqli_stmt_insert_id($stmt);
                $output = array("error"=>"false","message"=>$propertyID);
            }else{
                $this->mLogger->logger()->error("Failed adding property ".mysqli_stmt_error($stmt)." ".
                    mysqli_error($conn));
                $output = array("error"=>"true","message"=>"Failed adding property");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Prepare failed ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"Failed adding property");
        }
        mysqli_close($conn);

        //uploading files
        if ($output["error"] == "false"){
            $uploadPath = $baseDir."/PropertyImages/";

            for ($i = 0; $i < sizeof($imagesFileName);$i++) {
                $finalImageNames = uniqid().$this->dataHandle->cleanData($imagesFileName[$i]);
                $imageFilePath = $uploadPath.$finalImageNames;
                $fileUrlDatabase = "/PropertyImages/".$finalImageNames;

                try {
                    if (move_uploaded_file($imagesTempName[$i],$imageFilePath)){
                        $uploadResponse = true;
                    }else{
                        $uploadResponse = false;
                        $this->mLogger->logger()->error("Failed uploading file");
                    }
                    $this->addPropertyImageToDatabase($propertyID,$fileUrlDatabase);
                }catch (\Exception $exception){
                    $this->mLogger->logger()->error("Failed uploading file");
                    $output=array("error"=>"true","message"=>"Failed uploading file");
                }
            }
        }else{
            return $output;
        }

        return $output;
    }

    public function addPropertyImageToDatabase($propertyID,$filePath){
        $conn = $this->dbConnect->dbConnection();
        $addImagesQuery = "INSERT INTO propertyImages(propertyID,imageUrl) VALUES(?,?)";

        if ($stmt = mysqli_prepare($conn,$addImagesQuery)){
            mysqli_stmt_bind_param($stmt,'is',$paramPropertyID,$paramImageUrl);
            $paramPropertyID = $this->dataHandle->cleanData($propertyID);
            $paramImageUrl = $this->dataHandle->cleanData($filePath);

            if (mysqli_stmt_execute($stmt)){
                $output = array("error"=>"false","message"=>"success");
            }else{
                $this->mLogger->logger()->error("Failed adding property image ".mysqli_error($conn)
                    .mysqli_stmt_error($stmt));
                $output = array("error"=>"true","message"=>"Failed adding property image");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Prepare failed ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"Failed adding property");
        }
        mysqli_close($conn);
    }

    public function editProperty($propertyID,$propertyName,$propertyDescription,$propertyValue,$acreage,$location,$hideStatus
    ,$propertyZone,$ownershipType){
        $conn = $this->dbConnect->dbConnection();
        $query = "UPDATE property SET propertyTitle = ?,propertyDescription = ?,propertyValue = ?,
                acreage = ?,location = ?,hideStatus = ?,propertyZone = ?,ownershipType = ? WHERE propertyID = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'ssiisissi',$paramPropertyTitle,$paramPropertyDescription,
                $paramPropertyValue,$paramAcreage,$paramLocation,$paramHideStatus,$paramPropertyZone,$paramOwnershipType,
                $paramPropertyID);

            $paramPropertyTitle = $this->dataHandle->cleanData($propertyName);
            $paramPropertyDescription = $this->dataHandle->cleanData($propertyDescription);
            $paramPropertyValue = $this->dataHandle->cleanData($propertyValue);
            $paramAcreage = $this->dataHandle->cleanData($acreage);
            $paramLocation = $this->dataHandle->cleanData($location);
            $paramHideStatus = $this->dataHandle->cleanData($hideStatus);
            $paramPropertyZone = $this->dataHandle->cleanData($propertyZone);
            $paramOwnershipType = $this->dataHandle->cleanData($ownershipType);
            $paramPropertyID = $this->dataHandle->cleanData($propertyID);

            if (mysqli_stmt_execute($stmt)){
                $output=array("error"=>"false","message"=>"success");
            }else{
                $this->mLogger->logger()->error("Failed editing property $propertyID");
                $output = array("error"=>"true","message"=>"Failed editing property");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed editing property $propertyID");
            $output = array("error"=>"true","message"=>"Failed editing property");
        }
        mysqli_close($conn);
        return $output;
    }

    public function deleteSinglePropertyImage($propertyID,$propertyImageUrl){
        if (!unlink($propertyImageUrl)){
            $output=array("error"=>"true","message"=>"failed deleting property image");
            $this->mLogger->logger()->error("Failed deleting property image for $propertyID");
            return $output;
        }

        $conn = $this->dbConnect->dbConnection();
        $query = "DELETE FROM propertyImages WHERE propertyID = ? AND imageUrl = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'is',$paramPropertyID,$paramImageUrl);
            $paramPropertyID = $this->dataHandle->cleanData($propertyID);
            $paramImageUrl = $this->dataHandle->cleanData($propertyImageUrl);

            if (mysqli_stmt_execute($stmt)){
                $output=array("error"=>"false","message"=>"success");
                $this->mLogger->logger()->info("Deleted property image $propertyImageUrl");
            }else{
                $this->mLogger->logger()->error("Failed deleting property image $propertyImageUrl ".
                mysqli_error($conn)." ".mysqli_stmt_error($stmt));
                $output=array("error"=>"true","message"=>"Failed deleting property image");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Prepare failed ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"Failed deleting property image");
        }
        mysqli_close($conn);
        return $output;
    }

    public function deleteAllPropertyImages($propertyID,$baseDir){
        $response = $this->fetchPropertyImages($propertyID);
        if ($response["error"] == "false"){
            foreach ($response["message"] as $imagePath){
                if (!unlink($baseDir.$imagePath["image_url"])){
                    $output=array("error"=>"true","message"=>"failed deleting property images");
                    $this->mLogger->logger()->error("Failed deleting property images for $propertyID");
                    return $output;
                }
            }
        }else{
            $this->mLogger->logger()->error("Failed deleting property image files for $propertyID");
            return $output=$response;
        }

        $conn = $this->dbConnect->dbConnection();
        $query = "DELETE FROM propertyImages WHERE propertyID = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'i',$paramPropertyID);
            $paramPropertyID = $this->dataHandle->cleanData($propertyID);

            if (mysqli_stmt_execute($stmt)){
                $output=array("error"=>"false","message"=>"success");
                $this->mLogger->logger()->info("Deleted property images for $propertyID");
            }else{
                $this->mLogger->logger()->error("Failed deleting property images for $propertyID ".
                    mysqli_error($conn)." ".mysqli_stmt_error($stmt));
                $output=array("error"=>"true","message"=>"Failed deleting property image");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Prepare failed ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"Failed deleting property image");
        }
        mysqli_close($conn);
        return $output;
    }

    public function fetchPropertyImages($propertyID){
        $conn = $this->dbConnect->dbConnection();
        $query = "SELECT imageUrl FROM propertyImages WHERE propertyID = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'i',$paramPropertyID);
            $paramPropertyID = $this->dataHandle->cleanData($propertyID);

            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$fetchedImageUrl);
                while (mysqli_stmt_fetch($stmt)){
                    $data[] = array("image_url"=>$fetchedImageUrl);
                }
                $output=array("error"=>"false","message"=>$data);
            }else{
                $this->mLogger->logger()->error("Failed fetching property images for $propertyID ".
                mysqli_error($conn)." ".mysqli_stmt_error($stmt));
                $output = array("error"=>"true","message"=>"Failed fetching property images");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed fetching property images for $propertyID".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"Failed fetching property images");
        }
        mysqli_close($conn);
        return $output;
    }

    public function deleteProperty($propertyID){
        $conn = $this->dbConnect->dbConnection();
        $query = "DELETE FROM property WHERE propertyID = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'i',$paramPropertyID);
            $paramPropertyID = $this->dataHandle->cleanData($propertyID);

            if (mysqli_stmt_execute($stmt)){
                $output=array("error"=>"false","message"=>"success");
                $this->mLogger->logger()->info("Deleted property $propertyID");
            }else{
                $this->mLogger->logger()->error("Failed deleting property $propertyID ".
                    mysqli_error($conn)." ".mysqli_stmt_error($stmt));
                $output=array("error"=>"true","message"=>"Failed deleting property");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Prepare failed ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"Failed deleting property");
        }
        mysqli_close($conn);
        return $output;
    }

    public function deleteSellerDetails($propertyID){
        $conn = $this->dbConnect->dbConnection();
        $query = "DELETE FROM seller WHERE propertyID = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'i',$paramPropertyID);
            $paramPropertyID = $this->dataHandle->cleanData($propertyID);


            if (mysqli_stmt_execute($stmt)){
                $output = array("error"=>"false","message"=>"success");
            }else{
                $this->mLogger->logger()->error("Failed deleting seller where property id is $propertyID ".
                    mysqli_stmt_error($stmt)." ".mysqli_error($conn));
                $output = array("error"=>"true","message"=>"Failed deleting seller property");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Prepare failed ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"Failed deleting seller property $propertyID");
        }
        mysqli_close($conn);

        return $output;
    }

    public function addConfirmedBuyer($userID,$isConfirmedID,$isConfirmedBankStatement){
        $conn = $this->dbConnect->dbConnection();
        $query = "INSERT INTO buyer(userID,isConfirmedID,isConfirmedBankStatement) VALUES(?,?,?)";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'iii',$paramUserID,$paramIsConfirmedID,$paramIsConfirmedBankStatement);
            $paramUserID = $this->dataHandle->cleanData($userID);
            $paramIsConfirmedBankStatement = $this->dataHandle->cleanData($isConfirmedBankStatement) ? 1 : 0;
            $paramIsConfirmedID = $this->dataHandle->cleanData($isConfirmedID) ? 1 : 0;

            if (mysqli_stmt_execute($stmt)){
                $output = array("error"=>"false","message"=>"success");
            }else{
                $this->mLogger->logger()->error("Failed adding confirmed buyer $userID ".
                mysqli_stmt_error($stmt)." ".mysqli_error($conn));
                $output = array("error"=>"true","message"=>"Failed adding confirmed buyer");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Prepare failed ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"Failed adding confirmed buyer");
        }
        mysqli_close($conn);
        return $output;
    }

    public function deleteConfirmedBuyer($userID){
        $conn = $this->dbConnect->dbConnection();
        $query = "DELETE FROM buyer WHERE userID = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'i',$paramUserID);
            $paramUserID = $this->dataHandle->cleanData($userID);

            if (mysqli_stmt_execute($stmt)){
                $output = array("error"=>"false","message"=>"success");
            }else{
                $this->mLogger->logger()->error("Failed deleting confirmed buyer $userID ".
                mysqli_error($conn)." ".mysqli_stmt_error($stmt));
                $output = array("error"=>"true","message"=>"Failed deleting buyer");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Prepare failed ".mysqli_error($conn));
            $output =array("error"=>"true","message"=>"Failed deleting buyer");
        }
        mysqli_close($conn);
        return $output;
    }

    public function uploadBuyerVerificationDocuments($userID,$baseDir,$idTempName,$idFileName,$bankStatementTempName,
    $bankStatementFileName){

        $idUploadPath = $baseDir."/admin/buyer/id/";
        $bankStatementUploadPath = $baseDir."/admin/buyer/statement/";

        $finalIDName = uniqid().$this->dataHandle->cleanData($idFileName);
        $idFilePath = $idUploadPath.$finalIDName;
        $idUrlDatabase = "/buyer/id/".$finalIDName;

        $finalBankStatementName = uniqid().$this->dataHandle->cleanData($bankStatementFileName);
        $bankStatementFilePath = $bankStatementUploadPath.$finalBankStatementName;
        $bankStatementUrlDatabase = "/buyer/statement/".$finalBankStatementName;

        $uploadResponse = true;

        try{
            if (!move_uploaded_file($idTempName,$idFilePath)){
                $uploadResponse = false;
                $this->mLogger->logger()->error("Failed uploading id for $userID");
            }

            if (!move_uploaded_file($bankStatementTempName,$bankStatementFilePath)){
                $uploadResponse = false;
                $this->mLogger->logger()->error("Failed uploading bank statement for $userID");
            }
        }catch (\Exception $exception){
            $this->mLogger->logger()->error("Failed uploading files ".$exception);
            $uploadResponse = false;
        }

        if ($uploadResponse == false){
            $output = array("error"=>"true","message"=>"Failed adding buyer documents");
        }else{
            $conn = $this->dbConnect->dbConnection();
            $query = "INSERT INTO tempBuyerDetails(userID,copyOfIDUrl,copyOfBankStatement) VALUES(?,?,?)";

            if ($stmt = mysqli_prepare($conn,$query)){
                mysqli_stmt_bind_param($stmt,'iss',$paramUserID,$paramCopyOfIDUrl,$paramCopyOfBankStatementUrl);
                $paramUserID = $this->dataHandle->cleanData($userID);
                $paramCopyOfIDUrl = $idUrlDatabase;
                $paramCopyOfBankStatementUrl = $bankStatementUrlDatabase;

                if (mysqli_stmt_execute($stmt)){
                    $output=array("error"=>"false","message"=>"success");
                }else{
                    $this->mLogger->logger()->error("Failed adding buyer $userID verification documents ".
                    mysqli_error($conn)." ".mysqli_stmt_error($stmt));
                    $output=array("error"=>"true","message"=>"Failed adding buyer documents");
                }
                mysqli_stmt_close($stmt);
            }else{
                $this->mLogger->logger()->error("Prepare failed ".mysqli_error($conn));
                $output = array("error"=>"true","message"=>"Failed adding buyer verification documents");
            }
            mysqli_close($conn);
        }

        return $output;
    }

    public function deleteBuyerVerificationDocuments($userID,$baseDir){
        $response = $this->getBuyerVerificationDocuments($userID);

        if ($response["error"] == "false"){
            if (!unlink($baseDir.$response["message"]["id_url"])){
                $output=array("error"=>"true","message"=>"failed deleting id");
                $this->mLogger->logger()->error("Failed deleting id of $userID");
                return $output;
            }
            if (!unlink($baseDir.$response["message"]["statement_url"])){
                $output=array("error"=>"true","message"=>"failed deleting title");
                $this->mLogger->logger()->error("Failed deleting title of $userID");
                return $output;
            }
        }else{
            return $response;
        }

        $conn = $this->dbConnect->dbConnection();
        $query = "DELETE FROM tempBuyerDetails WHERE userID = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'i',$paramUserID);
            $paramUserID = $this->dataHandle->cleanData($userID);

            if (mysqli_stmt_execute($stmt)){
                $output = array("error"=>"false","message"=>"success");
            }else{
                $this->mLogger->logger()->error("Failed deleting buyer $userID documents ".
                mysqli_error($conn)." ".mysqli_stmt_error($stmt));
                $output =array("error"=>"true","message"=>"failed deleting buyer documents");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Prepare failed ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"Failed deleting buyer documents");
        }
        mysqli_close($conn);
        return $output;
    }

    public function getBuyerVerificationDocuments($userID){
        $conn = $this->dbConnect->dbConnection();
        $query = "SELECT copyOfIDUrl, copyOfBankStatement FROM tempBuyerDetails WHERE userID = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'i',$paramUserID);
            $paramUserID = $this->dataHandle->cleanData($userID);

            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$fetchedIdUrl,$fetchedBankStatementUrl);
                while (mysqli_stmt_fetch($stmt)){
                    $data = array("id_url"=>$fetchedIdUrl,"statement_url"=>$fetchedBankStatementUrl);
                }
                $output = array("error"=>"false","message"=>$data);
            }else{
                $this->mLogger->logger()->error("Failed getting buyer $userID documents ".mysqli_error($conn).
                    " ".mysqli_stmt_error($stmt));
                $output = array("error"=>"true","message"=>"failed getting docs");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Prepare failed ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"failed getting docs");
        }
        mysqli_close($conn);
        return $output;
    }

    public function uploadSellerVerificationDocuments($userID,$baseDir,$idTempName,$idFileName,$titleTempName,
    $titleFileName,$propertyID,$transactionCode){
        $idUploadPath = $baseDir."/admin/seller/id/";
        $titleUploadPath = $baseDir."/admin/seller/title/";

        $finalIDName = uniqid().$this->dataHandle->cleanData($idFileName);
        $idFilePath = $idUploadPath.$finalIDName;
        $idUrlDatabase = "/seller/id/".$finalIDName;

        $finalTitleFileName = uniqid().$this->dataHandle->cleanData($titleFileName);
        $titleFilePath = $titleUploadPath.$finalTitleFileName;
        $titleUrlDatabase = "/seller/title/".$finalTitleFileName;

        $uploadResponse = true;

        try{
            if (!move_uploaded_file($idTempName,$idFilePath)){
                $uploadResponse = false;
                $this->mLogger->logger()->error("Failed uploading id for $userID");
            }

            if (!move_uploaded_file($titleTempName,$titleFilePath)){
                $uploadResponse = false;
                $this->mLogger->logger()->error("Failed uploading proof of title for $userID");
            }
        }catch (\Exception $exception){
            $this->mLogger->logger()->error("Failed uploading files ".$exception);
            $uploadResponse = false;
        }

        if ($uploadResponse == true){
            $conn = $this->dbConnect->dbConnection();
            $query = "INSERT INTO tempSeller(userID,copyOfIDUrl,proofOfTitleUrl,propertyID,transactionCode) VALUES(?,?,?,?,?)";

            if ($stmt = mysqli_prepare($conn,$query)){
                mysqli_stmt_bind_param($stmt,'issis',$paramUserID,$paramCopyOfIDUrl,
                    $paramProofOfTitleUrl,$paramPropertyID,$paramTransactionCode);
                $paramUserID = $this->dataHandle->cleanData($userID);
                $paramCopyOfIDUrl = $idUrlDatabase;
                $paramProofOfTitleUrl = $titleUrlDatabase;
                $paramPropertyID = $this->dataHandle->cleanData($propertyID);
                $paramTransactionCode = $this->dataHandle->cleanData($transactionCode);

                if (mysqli_stmt_execute($stmt)){
                    $output=array("error"=>"false","message"=>"success");
                }else{
                    $this->mLogger->logger()->error("Failed inserting seller document file paths ".
                        mysqli_error($conn)." ".mysqli_stmt_error($stmt));
                    $output=array("error"=>"true","message"=>"Failed uploading verification documents");
                }
                mysqli_stmt_close($stmt);
            }else{
                $this->mLogger->logger()->error("Failed uploading verification documents for $userID ".
                mysqli_error($conn));
                $output = array("error"=>"true","message"=>"Failed uploading verification documents");
            }
            mysqli_close($conn);
        }else{
            $output = array("error"=>"true","message"=>"failed uploading seller documents");
        }
        return $output;
    }

    public function deleteSellerVerificationDocuments($userID,$baseDir){
        $response = $this->getSellerDocuments($userID);
        if ($response["error"] == "false"){
            if (!unlink($baseDir.$response["message"]["id_url"])){
                $output=array("error"=>"true","message"=>"failed deleting id");
                $this->mLogger->logger()->error("Failed deleting id of $userID");
                return $output;
            }
            if (!unlink($baseDir.$response["message"]["title_url"])){
                $output=array("error"=>"true","message"=>"failed deleting title");
                $this->mLogger->logger()->error("Failed deleting title of $userID");
                return $output;
            }
        }else{
            return $response;
        }

        $conn = $this->dbConnect->dbConnection();
        $query = "DELETE FROM tempSeller WHERE userID = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'i',$paramUserID);
            $paramUserID = $this->dataHandle->cleanData($userID);

            if (mysqli_stmt_execute($stmt)){
                $output=array("error"=>"false","message"=>"success");
            }else{
                $this->mLogger->logger()->error("Failed deleting documents for seller $userID ".
                mysqli_error($conn)." ".mysqli_stmt_error($stmt));
                $output = array("error"=>"true","message"=>"failed deleting documents");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Prepare failed ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"failed deleting documents");
        }
        mysqli_close($conn);
        return $output;
    }

    public function addConfirmedSeller($userID,$isConfirmedID,$isConfirmedTitle,$propertyID){
        $conn = $this->dbConnect->dbConnection();
        $query = "INSERT INTO seller(userID,isConfirmedID,isConfirmedTitleDeed,propertyID) VALUES(?,?,?,?)";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'iiii',$paramUserID,$paramConfirmedID,
                $paramConfirmedTitleDeed,$paramPropertyID);
            $paramUserID = $this->dataHandle->cleanData($userID);
            $paramConfirmedID = $this->dataHandle->cleanData($isConfirmedID) ? 1 : 0;
            $paramConfirmedTitleDeed = $this->dataHandle->cleanData($isConfirmedTitle) ? 1 : 0;
            $paramPropertyID = $this->dataHandle->cleanData($propertyID);

            if (mysqli_stmt_execute($stmt)){
                $output=array("error"=>"false","message"=>"success");
            }else{
                $this->mLogger->logger()->error("Failed adding verified seller ".mysqli_error($conn).
                " ".mysqli_stmt_error($stmt));
                $output=array("error"=>"true","message"=>"failed adding verified seller details");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed adding adding verified seller details ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"failed adding verified seller details");
        }
        mysqli_close($conn);
        return $output;
    }

    public function deleteConfirmedSeller($userID){
        $conn = $this->dbConnect->dbConnection();
        $query = "DELETE FROM seller WHERE userID = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'i',$paramUserID);
            $paramUserID = $this->dataHandle->cleanData($userID);

            if (mysqli_stmt_execute($stmt)){
                $output=array("error"=>"false","message"=>"success");
            }else{
                $this->mLogger->logger()->error("Failed deleting confirmed seller $userID ".
                mysqli_error($conn)." ".mysqli_stmt_error($stmt));
                $output=array("error"=>"true","message"=>"failed deleting confirmed seller");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed deleting confirmed seller $userID ".
            mysqli_error($conn));
            $output =array("error"=>"true","message"=>"failed deleting confirmed seller");
        }
        mysqli_close($conn);
        return $output;
    }

    public function getSellerDocuments($userID){
        $conn = $this->dbConnect->dbConnection();
        $query = "SELECT copyOfIDUrl, proofOfTitleUrl FROM tempSeller WHERE userID = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'i',$paramUserID);
            $paramUserID = $this->dataHandle->cleanData($userID);

            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$fetchedIdUrl,$fetchedTitleUrl);
                while (mysqli_stmt_fetch($stmt)){
                    $data = array("id_url"=>$fetchedIdUrl,"title_url"=>$fetchedTitleUrl);
                }
                $output = array("error"=>"false","message"=>$data);
            }else{
                $this->mLogger->logger()->error("Failed getting seller $userID documents ".mysqli_error($conn).
                " ".mysqli_stmt_error($stmt));
                $output = array("error"=>"true","message"=>"failed getting docs");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Prepare failed ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"failed getting docs");
        }
        mysqli_close($conn);
        return $output;
    }

    public function registerUser($name,$email,$phoneNumber,$userPassword){
        if ($this->isEmailExisting($email)){
            $output = array("error"=>"true","message"=>"Email is already in use");
        }else{
            $conn = $this->dbConnect->dbConnection();
            $query = "INSERT INTO users(name,email,phoneNumber,userPassword) VALUES(?,?,?,?)";

            if ($stmt = mysqli_prepare($conn,$query)){
                mysqli_stmt_bind_param($stmt,'ssss',$paramName,$paramEmail,$paramPhoneNumber,
                    $paramPassword);
                $paramName = $this->dataHandle->cleanData($name);
                $paramEmail = $this->dataHandle->cleanData($email);
                $paramPassword = password_hash($this->dataHandle->cleanData($userPassword),PASSWORD_DEFAULT);
                $paramPhoneNumber = $this->dataHandle->cleanData($phoneNumber);

                if (mysqli_stmt_execute($stmt)){
                    $userID = mysqli_stmt_insert_id($stmt);
                    $output=array("error"=>"false","message"=>$userID);
                }else{
                    $this->mLogger->logger()->error("Failed registering user $name ".mysqli_error($conn));
                    $output= array("error"=>"true","message"=>"failed registering user");
                }
                mysqli_stmt_close($stmt);
            }else{
                $this->mLogger->logger()->error("Failed registering user ".mysqli_error($conn));
                $output= array("error"=>"true","message"=>"failed registering user");
            }
            mysqli_close($conn);
        }

        return $output;
    }

    public function isEmailExisting($email){
        $conn = $this->dbConnect->dbConnection();
        $query = "SELECT COUNT(email) FROM users WHERE email = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'s',$paramEmail);
            $paramEmail = $this->dataHandle->cleanData($email);

            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$fetchedEmailCount);
                while (mysqli_stmt_fetch($stmt)){
                    $data = $fetchedEmailCount;
                }
                if ($data == 0){
                    $output = false;
                }else{
                    $output = true;
                }
            }else{
                $this->mLogger->logger()->error("Failed checking if $email exist ".mysqli_error($conn)." "
                    .mysqli_stmt_error($stmt));
                $output= true;
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed checking if email exist ".mysqli_error($conn));
            $output= true;
        }
        mysqli_close($conn);
        return $output;
    }

    public function registerAdmin($name,$email,$userPassword){
        $conn = $this->dbConnect->dbConnection();
        $query = "INSERT INTO admin(name,email,userPassword) VALUES(?,?,?)";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'sss',$paramName,$paramEmail,$paramPassword);
            $paramName = $this->dataHandle->cleanData($name);
            $paramEmail = $this->dataHandle->cleanData($email);
            $paramPassword = password_hash($this->dataHandle->cleanData($userPassword),PASSWORD_DEFAULT);

            if (mysqli_stmt_execute($stmt)){
                $userID = mysqli_stmt_insert_id($stmt);
                $output=array("error"=>"false","message"=>$userID);
            }else{
                $this->mLogger->logger()->error("Failed registering user $name ".mysqli_error($conn));
                $output= array("error"=>"true","message"=>"failed registering user");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed registering user ".mysqli_error($conn));
            $output= array("error"=>"true","message"=>"failed registering user");
        }
        mysqli_close($conn);
        return $output;
    }

    public function mailSetup(){
        $mail = new PHPMailer(true);

        /**
         * Host: mail.penguinlabs.co.ke
        User: email address eg info@penguinlabs.co.ke
        Password: email password
        Port:587
        Ecnryption: TLS
         */
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;

        $mail->Host = Config::SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Port=Config::SMTP_PORT;
        $mail->Username = Config::SMTP_USERNAME;
        $mail->Password = Config::SMTP_PASSWORD;
        $mail->SMTPSecure = 'tls';

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        return $mail;
    }

    public function sendMail($fromName,$fromEmail,$toEmail,$emailSubject,$message){
        $headers = '';
        $headers .= 'From: ' . $fromName . ' <' . $fromEmail . '>' . "\r\n";
        $headers .= "Reply-To: " .  $fromEmail . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        return mail($toEmail, $emailSubject, $message, $headers);
    }
    public function sendEmailVerificationToUserEmail($userID){
        //input the email auth token in the database for the specific user
        //send confirmation url to user containing auth token to confirm email
        //fetch auth token in this instance for the user
        $bytes = random_bytes(20);
        $authToken = bin2hex($bytes);

        $this->addAuthTokenForUser($userID,$authToken);

        $userDetails = $this->fetchUserDetails($userID);

        $mail = $this->mailSetup();
        try {

            $mail->From = Config::MAIL_SENDER_ADDRESS;
            $mail->FromName = Config::MAIL_SENDER_NAME;
            $mail->addAddress($userDetails["message"]["email"], $userDetails["message"]["name"]);
            $mail->isHTML(true);
            $mail->Subject = "Account Email Verification";
            $mail->Body = "<p>Click the below link to confirm your email address</p>
                        <p>".Config::DOMAIN_ADDRESS.urlencode('/?email='. $authToken)."</p>";
            if (!$mail->send()){
                $this->mLogger->logger()->error("Failed sending mail to $userID for email verification");
            }
        }catch (Exception $exception){
            $this->mLogger->logger()->error("Failed sending mail ".$exception->getMessage());
        }
    }

    public function addAuthTokenForUser($userID,$authToken){
        $conn = $this->dbConnect->dbConnection();
        $query = "UPDATE users SET authToken = ? WHERE userID = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'si',$paramAuthToken,$paramUserID);
            $paramAuthToken = $this->dataHandle->cleanData($authToken);
            $paramUserID = $this->dataHandle->cleanData($userID);

            if (mysqli_stmt_execute($stmt)){
                $output=array("error"=>"false","message"=>"success");
            }else{
                $this->mLogger->logger()->error("Failed adding auth token for $userID ".
                mysqli_error($conn)." ".mysqli_stmt_error($stmt));
                $output=array("error"=>"true","message"=>"failed adding auth token");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Prepare failed ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"failed adding auth token");
        }
        mysqli_close($conn);
        return $output;
    }

    public function fetchUserAuthToken($userID){
        $conn = $this->dbConnect->dbConnection();
        $query = "SELECT authToken FROM users WHERE userID = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'i',$paramUserID);
            $paramUserID = $this->dataHandle->cleanData($userID);

            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$fetchedAuthToken);
                while (mysqli_stmt_fetch($stmt)){
                    $data=array("auth_token"=>$fetchedAuthToken);
                }
                $output=array("error"=>"false","message"=>$data);
            }else{
                $this->mLogger->logger()->error("Failed fetching user $userID auth token ".mysqli_error($conn).
                mysqli_stmt_error($stmt));
                $output=array("error"=>"true","message"=>"failed fetching user auth token");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed fetching user auth token ".mysqli_error($conn));
            $output =array("error"=>"true","message"=>"failed fetching user auth token");
        }
        mysqli_close($conn);
        return $output;
    }

    public function fetchUserDetails($userID){
        $conn = $this->dbConnect->dbConnection();
        $query = "SELECT userID,name,email,phoneNumber FROM users WHERE userID = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'i',$paramUserID);
            $paramUserID = $this->dataHandle->cleanData($userID);

            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$fetchedUserID,$fetchedName,$fetchedEmail,$fetchedPhoneNumber);
                while (mysqli_stmt_fetch($stmt)){
                    $data=array("user_id"=>$fetchedUserID,"name"=>$fetchedName,"email"=>$fetchedEmail,
                        "phone_number"=>$fetchedPhoneNumber);
                }
                $output=array("error"=>"false","message"=>$data);
            }else{
                $this->mLogger->logger()->error("Failed fetching user details for $userID ".
                mysqli_error($conn)." ".mysqli_stmt_error($stmt));
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Prepare failed ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"failed fetching user details");
        }
        mysqli_close($conn);
        return $output;
    }

    public function loginUser($email,$password){
        $conn = $this->dbConnect->dbConnection();
        $query= "SELECT userID,email,userPassword FROM users WHERE email = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'s',$paramEmail);
            $paramEmail = $this->dataHandle->cleanData($email);

            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$returnedUserID,$returnedUsername,$returnedPassword);
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) < 1 ){
                    $output = array("error"=>"true","message"=>"Account does not exist");
                    $this->mLogger->logger()->info("Failed login attempt for $email that does not exist");
                }elseif (mysqli_stmt_num_rows($stmt) >= 1){
                    while (mysqli_stmt_fetch($stmt)){
                        if (password_verify($this->dataHandle->cleanData($password),$returnedPassword)){
                            //login success
                            //redirect
                            //setting sessions
                            $this->mLogger->logger()->info("Login success for email $email");
                            $output = array("error"=>"false","message"=>$returnedUserID);
                        }else{
                            $this->mLogger->logger()->info("Login failed for user $email");
                            $output = array("error"=>"true","message"=>"Incorrect login credentials");
                        }
                    }
                }
                else{
                    $output=array("error"=>"true","message"=>"Account does not exist");
                }
            }else{
                $this->mLogger->logger()->error("Login failed ".mysqli_stmt_error($stmt).' '.mysqli_error($conn));
                $output=array("error"=>"true","message"=>"Oops! Something went wrong");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Prepare failed ".mysqli_error($conn));
            $output=array("error"=>"true","message"=>"Oops! Something went wrong");
        }
        mysqli_close($conn);
        return $output;
    }

    public function loginAdmin($email,$password){
        $conn = $this->dbConnect->dbConnection();
        $query= "SELECT userID,email,userPassword FROM admin WHERE email = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'s',$paramEmail);
            $paramEmail = $this->dataHandle->cleanData($email);

            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$returnedUserID,$returnedUsername,$returnedPassword);
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) < 1 ){
                    $output = array("error"=>"true","message"=>"Account does not exist");
                    $this->mLogger->logger()->info("Failed login attempt for $email that does not exist");
                }elseif (mysqli_stmt_num_rows($stmt) >= 1){
                    while (mysqli_stmt_fetch($stmt)){
                        if (password_verify($this->dataHandle->cleanData($password),$returnedPassword)){
                            //login success
                            //redirect
                            //setting sessions
                            $this->mLogger->logger()->info("Login success for email $email");
                            $output = array("error"=>"false","message"=>$returnedUserID);
                        }else{
                            $this->mLogger->logger()->info("Login failed for user $email");
                            $output = array("error"=>"true","message"=>"Incorrect login credentials");
                        }
                    }
                }
                else{
                    $output=array("error"=>"true","message"=>"Account does not exist");
                }
            }else{
                $this->mLogger->logger()->error("Login failed ".mysqli_stmt_error($stmt).' '.mysqli_error($conn));
                $output=array("error"=>"true","message"=>"Oops! Something went wrong");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Prepare failed ".mysqli_error($conn));
            $output=array("error"=>"true","message"=>"Oops! Something went wrong");
        }
        mysqli_close($conn);
        return $output;
    }

    public function editUserDetails($userID,$name,$phoneNumber){
        $conn = $this->dbConnect->dbConnection();
        $query = "UPDATE users SET name = ?, phoneNumber = ? WHERE userID = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'ssi',$paramName,$paramPhoneNumber,$paramUserID);
            $paramPhoneNumber = $this->dataHandle->cleanData($phoneNumber);
            $paramUserID = $this->dataHandle->cleanData($userID);
            $paramName = $this->dataHandle->cleanData($name);

            if (mysqli_stmt_execute($stmt)){
                $output=array("error"=>"false","message"=>"success");
            }else{
                $this->mLogger->logger()->error("Failed editing user details for $userID ".
                mysqli_error($conn)." ".mysqli_stmt_error($stmt));
                $output = array("error"=>"true","message"=>"failed editing user details");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed editing user details for $userID ".
            mysqli_error($conn)." ".mysqli_stmt_error($stmt));
            $output = array("error"=>"true","message"=>"failed editing user details");
        }
        mysqli_close($conn);
        return $output;
    }

    public function deleteUser($userID){
        $conn = $this->dbConnect->dbConnection();
        $query = "DELETE FROM users WHERE userID = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'i',$paramUserID);
            $paramUserID = $this->dataHandle->cleanData($userID);

            if (mysqli_stmt_execute($stmt)){
                $output=array("error"=>"false","message"=>"success");
            }else{
                $this->mLogger->logger()->error("Failed deleting user $userID ".mysqli_error($conn).
                " ".mysqli_stmt_error($stmt));
                $output = array("error"=>"true","message"=>"Failed deleting user");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed deleting user $userID ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"Failed deleting user");
        }
        mysqli_close($conn);
        return $output;
    }

    public function changePassword($userID,$oldPassword,$newPassword){
        $isMatchingPassword = $this->isMatchingOldPassword($userID,$oldPassword);

        $conn = $this->dbConnect->dbConnection();
        $query = "UPDATE users SET userPassword = ? WHERE userID = ?";

        if ($isMatchingPassword){
            if ($stmt = mysqli_prepare($conn,$query)){
                mysqli_stmt_bind_param($stmt,'si',$paramNewPassword,$paramUserID);
                $paramNewPassword = password_hash($this->dataHandle->cleanData($newPassword),PASSWORD_DEFAULT);
                $paramUserID = $this->dataHandle->cleanData($userID);

                if (mysqli_stmt_execute($stmt)){
                    $this->mLogger->logger()->info("Changed password for user $userID");
                    $output = array("error"=>"false","message"=>"success");
                }else{
                    $this->mLogger->logger()->error("Failed changing the password for $userID".mysqli_stmt_error($stmt)." ".mysqli_error($conn));
                    $output=array("error"=>"true","message"=>"Failed changing password for user $userID");
                }
                mysqli_stmt_close($stmt);
            }else{
                $this->mLogger->logger()->error("Prepare failed ".mysqli_error($conn));
                $output=array("error"=>"true","message"=>"Failed changing password for $userID");
            }
            mysqli_close($conn);
        }else{
            $output=array("error"=>"true","message"=>"Incorrect old password");
        }

        return $output;
    }

    public function isMatchingOldPassword($userID,$oldPassword){
        $conn = $this->dbConnect->dbConnection();
        $query = "SELECT userPassword FROM users WHERE userID = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,"i",$paramUserID);
            $paramUserID = $this->dataHandle->cleanData($userID);

            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$fetchedPassword);
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) < 1){
                    $output = false;
                }else{
                    while (mysqli_stmt_fetch($stmt)){
                        if (password_verify($this->dataHandle->cleanData($oldPassword),$fetchedPassword)){
                            $output = true;
                        }else{
                            $output = false;
                        }
                    }
                }
            }else{
                $this->mLogger->logger()->error("Failed checking for match in password ".mysqli_stmt_error($stmt)." ".mysqli_error($conn));
                $output=false;
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Prepare failed ".mysqli_error($conn));
            $output=false;
        }

        mysqli_close($conn);
        return $output;
    }

    public function forgotPassword($userEmail){
        $bytes = random_bytes(20);
        $authToken = bin2hex($bytes);

        $userDetails = $this->fetchUserDetailsUsingEmail($userEmail);

        $this->addAuthTokenForUser($userDetails["message"]["user_id"],$authToken);

        $mail = $this->mailSetup();
        try {

            $mail->From = Config::MAIL_SENDER_ADDRESS;
            $mail->FromName = Config::MAIL_SENDER_NAME;
            $mail->addAddress($userDetails["message"]["email"], $userDetails["message"]["name"]);
            $mail->isHTML(true);
            $mail->Subject = "Password reset";
            $mail->Body = "<p>Click the below link to reset password</p>
                        <p>".Config::DOMAIN_ADDRESS.urlencode('/?reset='. $authToken)."</p>";
            if (!$mail->send()){
                $this->mLogger->logger()->error("Failed sending mail to $userEmail for email verification");
            }
        }catch (Exception $exception){
            $this->mLogger->logger()->error("Failed sending mail ".$exception->getMessage());
        }
    }

    public function fetchUserDetailsUsingEmail($userEmail){
        $conn = $this->dbConnect->dbConnection();
        $query = "SELECT userID,name,email,phoneNumber FROM users WHERE email = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'i',$paramUserEmail);
            $paramUserEmail = $this->dataHandle->cleanData($userEmail);

            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$fetchedUserID,$fetchedName,$fetchedEmail,$fetchedPhoneNumber);
                while (mysqli_stmt_fetch($stmt)){
                    $data=array("user_id"=>$fetchedUserID,"name"=>$fetchedName,"email"=>$fetchedEmail,
                        "phone_number"=>$fetchedPhoneNumber);
                }
                $output=array("error"=>"false","message"=>$data);
            }else{
                $this->mLogger->logger()->error("Failed fetching user details for $userEmail ".
                    mysqli_error($conn)." ".mysqli_stmt_error($stmt));
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Prepare failed ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"failed fetching user details");
        }
        mysqli_close($conn);
        return $output;
    }

    public function contactUsEmail($fromAddress,$message,$subject,$issue){
        $fromAddress = $this->dataHandle->cleanText($fromAddress);
        $message = $this->dataHandle->cleanText($message);
        $subject = $this->dataHandle->cleanText($subject);
        $issue = $this->dataHandle->cleanText($issue);

        $mail = $this->mailSetup();

        try {
            $mail->From = Config::MAIL_SENDER_ADDRESS;
            $mail->addAddress(Config::MAIL_SENDER_ADDRESS);
            $mail->addReplyTo($fromAddress);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = "<p>".$message."</p>";
            $mail->AltBody = $issue."\n".$message;
            if (!$mail->send()){
                $this->mLogger->logger()->error("Failed sending contact-us message from $fromAddress ".
                    $mail->ErrorInfo);
                $output = array("error"=>"true","message"=>"failed");
            }else{
                $output = array("error"=>"false","message"=>"success");
            }
        }catch (Exception $exception){
            $this->mLogger->logger()->error("Failed sending contact-us message from $fromAddress ".
                $exception->getMessage());
            $output = array("error"=>"true","message"=>"failed");
        }

//        if ($this->sendMail(Config::MAIL_SENDER_NAME,$fromAddress,Config::MAIL_SENDER_ADDRESS,$subject,$message)){
//            $this->mLogger->logger()->error("Failed sending contact-us message from $fromAddress");
//            $output = array("error"=>"true","message"=>"failed");
//        }else{
//            $output = array("error"=>"false","message"=>"success");
//        }
        return $output;
    }

    public function sendEmail($userAddress,$message,$subject){
        $userAddress = $this->dataHandle->cleanText($userAddress);
        $message = $this->dataHandle->cleanText($message);
        $subject = $this->dataHandle->cleanText($subject);

        $mail = $this->mailSetup();

        try {
            $mail->From = Config::MAIL_SENDER_ADDRESS;
            $mail->addAddress($userAddress);
            $mail->addReplyTo(Config::MAIL_SENDER_ADDRESS);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = "<p>".$message."</p>";
            $mail->AltBody = "\n".$message;
            if (!$mail->send()){
                $this->mLogger->logger()->error("Failed sending message from $userAddress ".
                    $mail->ErrorInfo);
                $output = array("error"=>"true","message"=>"failed");
            }else{
                $output = array("error"=>"false","message"=>"success");
            }
        }catch (Exception $exception){
            $this->mLogger->logger()->error("Failed sending message from $userAddress ".
                $exception->getMessage());
            $output = array("error"=>"true","message"=>"failed");
        }

        return $output;
    }

    public function hideProperty($propertyID){
        $conn = $this->dbConnect->dbConnection();
        $query = "UPDATE property SET hideStatus = ? WHERE propertyID = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'ii',$paramHideStatus,$paramPropertyID);
            $paramPropertyID = $this->dataHandle->cleanData($propertyID);
            $paramHideStatus = 1;//1 = hide, 0 = make visible

            if (mysqli_stmt_execute($stmt)){
                $output=array("error"=>"false","message"=>"success");
            }else{
                $this->mLogger->logger()->error("Failed hiding property $propertyID ".
                mysqli_error($conn)." ".mysqli_stmt_error($stmt));
                $output =array("error"=>"true","message"=>"failed hiding property");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed hiding property $propertyID ".
            mysqli_error($conn));
            $output = array("error"=>"true","message"=>"failed hiding property");
        }
        mysqli_close($conn);
        return $output;
    }

    public function unhideProperty($propertyID){
        $conn = $this->dbConnect->dbConnection();
        $query = "UPDATE property SET hideStatus = ? WHERE propertyID = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'ii',$paramHideStatus,$paramPropertyID);
            $paramPropertyID = $this->dataHandle->cleanData($propertyID);
            $paramHideStatus = 0;//1 = hide, 0 = make visible

            if (mysqli_stmt_execute($stmt)){
                $output=array("error"=>"false","message"=>"success");
            }else{
                $this->mLogger->logger()->error("Success hide property $propertyID ".
                    mysqli_error($conn)." ".mysqli_stmt_error($stmt));
                $output =array("error"=>"true","message"=>"Success hide property");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Success hide property $propertyID ".
                mysqli_error($conn));
            $output = array("error"=>"true","message"=>"Success hide property");
        }
        mysqli_close($conn);
        return $output;
    }

    public function listAllUsers(){
        $conn = $this->dbConnect->dbConnection();
        $query = "SELECT userID,name,email,phoneNumber,dateJoined FROM users";

        if ($stmt = mysqli_prepare($conn,$query)){
            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$fetchedUserID,$fetchedName,$fetchedEmail,$fetchedPhoneNumber,
                $fetchedDateJoined);
                while (mysqli_stmt_fetch($stmt)){
                    $data[]=array("user_id"=>$fetchedUserID,"name"=>$fetchedName,"email"=>$fetchedEmail,
                        "phone_number"=>$fetchedPhoneNumber,"date"=>$fetchedDateJoined);
                }
                $output=array("error"=>"false","message"=>$data);
            }else{
                $this->mLogger->logger()->error("Failed listing all users ".mysqli_error($conn)." ".
                mysqli_stmt_error($stmt));
                $output=array("error"=>"true","message"=>"failed listing all users");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed listing all users ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"failed listing all users");
        }
        mysqli_close($conn);
        return $output;
    }

    public function listBuyers(){
        $conn = $this->dbConnect->dbConnection();
        $query = "SELECT b.userID, u.name,u.email,u.phoneNumber,b.isConfirmedID,b.isConfirmedBankStatement FROM 
                    buyer b INNER JOIN users u ON b.userID = u.userID";

        if ($stmt = mysqli_prepare($conn,$query)){
            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$fetchedUserID,$fetchedName,$fetchedEmail,$fetchedPhoneNumber,
                $fetchedIsConfirmedID,$fetchedIsConfirmedStatement);
                while (mysqli_stmt_fetch($stmt)){
                    $fetchedIsConfirmedID = 1 ? true:false;
                    $fetchedIsConfirmedStatement = 1 ? true:false;
                    $data[]=array("user_id"=>$fetchedUserID,"name"=>$fetchedName,"email"=>$fetchedEmail,
                        "phone_number"=>$fetchedPhoneNumber,"is_confirmed_id"=>$fetchedIsConfirmedID,
                        "is_confirmed_statement"=>$fetchedIsConfirmedStatement);
                }
                $output=array("error"=>"false","message"=>$data);
            }else{
                $this->mLogger->logger()->error("Failed listing buyers ".mysqli_error($conn).
                " ".mysqli_stmt_error($stmt));
                $output =array("error"=>"true","message"=>"failed listing buyers");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed listing buyers ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"failed listing buyers");
        }
        mysqli_close($conn);
        return $output;
    }

    public function listConfirmedBuyers(){
        $conn = $this->dbConnect->dbConnection();
        $query = "SELECT b.userID, u.name,u.email,u.phoneNumber,b.isConfirmedID,b.isConfirmedBankStatement FROM 
                    buyer b INNER JOIN users u ON b.userID = u.userID WHERE b.isConfirmedID = 1 AND 
                    b.isConfirmedBankStatement = 1";

        if ($stmt = mysqli_prepare($conn,$query)){
            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$fetchedUserID,$fetchedName,$fetchedEmail,$fetchedPhoneNumber,
                    $fetchedIsConfirmedID,$fetchedIsConfirmedStatement);
                while (mysqli_stmt_fetch($stmt)){
                    $fetchedIsConfirmedID = 1 ? true:false;
                    $fetchedIsConfirmedStatement = 1 ? true:false;
                    $data[]=array("user_id"=>$fetchedUserID,"name"=>$fetchedName,"email"=>$fetchedEmail,
                        "phone_number"=>$fetchedPhoneNumber,"is_confirmed_id"=>$fetchedIsConfirmedID,
                        "is_confirmed_statement"=>$fetchedIsConfirmedStatement);
                }
                $output=array("error"=>"false","message"=>$data);
            }else{
                $this->mLogger->logger()->error("Failed listing buyers ".mysqli_error($conn).
                    " ".mysqli_stmt_error($stmt));
                $output =array("error"=>"true","message"=>"failed listing buyers");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed listing buyers ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"failed listing buyers");
        }
        mysqli_close($conn);
        return $output;
    }

    public function listSellers(){
        $conn = $this->dbConnect->dbConnection();
        $query = "SELECT s.userID, u.name,u.email,u.phoneNumber,s.isConfirmedID,s.isConfirmedTitleDeed FROM 
                    seller s INNER JOIN users u ON s.userID = u.userID";

        if ($stmt = mysqli_prepare($conn,$query)){
            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$fetchedUserID,$fetchedName,$fetchedEmail,$fetchedPhoneNumber,
                    $fetchedIsConfirmedID,$fetchedIsConfirmedStatement);
                while (mysqli_stmt_fetch($stmt)){
                    $fetchedIsConfirmedID = 1 ? true:false;
                    $fetchedIsConfirmedStatement = 1 ? true:false;
                    $data[]=array("user_id"=>$fetchedUserID,"name"=>$fetchedName,"email"=>$fetchedEmail,
                        "phone_number"=>$fetchedPhoneNumber,"is_confirmed_id"=>$fetchedIsConfirmedID,
                        "is_confirmed_statement"=>$fetchedIsConfirmedStatement);
                }
                $output=array("error"=>"false","message"=>$data);
            }else{
                $this->mLogger->logger()->error("Failed listing sellers ".mysqli_error($conn).
                    " ".mysqli_stmt_error($stmt));
                $output =array("error"=>"true","message"=>"failed listing sellers");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed listing sellers ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"failed listing sellers");
        }
        mysqli_close($conn);
        return $output;
    }

    public function listConfirmedSellers(){
        $conn = $this->dbConnect->dbConnection();
        $query = "SELECT s.userID, u.name,u.email,u.phoneNumber,s.isConfirmedID,s.isConfirmedTitleDeed FROM 
                    seller s INNER JOIN users u ON s.userID = u.userID WHERE s.isConfirmedID = 1 AND 
                    s.isConfirmedTitleDeed = 1";

        if ($stmt = mysqli_prepare($conn,$query)){
            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$fetchedUserID,$fetchedName,$fetchedEmail,$fetchedPhoneNumber,
                    $fetchedIsConfirmedID,$fetchedIsConfirmedStatement);
                while (mysqli_stmt_fetch($stmt)){
                    $fetchedIsConfirmedID = 1 ? true:false;
                    $fetchedIsConfirmedStatement = 1 ? true:false;
                    $data[]=array("user_id"=>$fetchedUserID,"name"=>$fetchedName,"email"=>$fetchedEmail,
                        "phone_number"=>$fetchedPhoneNumber,"is_confirmed_id"=>$fetchedIsConfirmedID,
                        "is_confirmed_statement"=>$fetchedIsConfirmedStatement);
                }
                $output=array("error"=>"false","message"=>$data);
            }else{
                $this->mLogger->logger()->error("Failed listing sellers ".mysqli_error($conn).
                    " ".mysqli_stmt_error($stmt));
                $output =array("error"=>"true","message"=>"failed listing sellers");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed listing sellers ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"failed listing sellers");
        }
        mysqli_close($conn);
        return $output;
    }

    public function listBuyerVerificationDetails(){
        $conn = $this->dbConnect->dbConnection();
        $query = "SELECT b.userID, u.name,u.email,u.phoneNumber,b.copyOfIDUrl,b.copyOfBankStatement FROM 
                    tempBuyerDetails b INNER JOIN users u ON b.userID = u.userID";

        if ($stmt = mysqli_prepare($conn,$query)){
            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$fetchedUserID,$fetchedName,$fetchedEmail,$fetchedPhoneNumber,
                    $fetchedIDUrl,$fetchedStatementUrl);
                while (mysqli_stmt_fetch($stmt)){
                    $data[]=array("user_id"=>$fetchedUserID,"name"=>$fetchedName,"email"=>$fetchedEmail,
                        "phone_number"=>$fetchedPhoneNumber,"id_url"=>$fetchedIDUrl,
                        "statement_url"=>$fetchedStatementUrl);
                }
                $output=array("error"=>"false","message"=>$data);
            }else{
                $this->mLogger->logger()->error("Failed listing buyer verification details ".mysqli_error($conn).
                    " ".mysqli_stmt_error($stmt));
                $output =array("error"=>"true","message"=>"failed listing buyer verification details");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed listing buyer verification details ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"failed listing buyer verification details");
        }
        mysqli_close($conn);
        return $output;
    }

    public function listSellerVerificationDetails(){
        $conn = $this->dbConnect->dbConnection();
        $query = "SELECT s.userID, u.name,u.email,u.phoneNumber,s.copyOfIDUrl,s.proofOfTitleUrl, s.propertyID, 
                    p.propertyTitle,s.transactionCode FROM tempSeller s INNER JOIN users u ON s.userID = u.userID INNER JOIN property p 
                    ON p.propertyID = s.propertyID";

        if ($stmt = mysqli_prepare($conn,$query)){
            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$fetchedUserID,$fetchedName,$fetchedEmail,$fetchedPhoneNumber,
                    $fetchedIDUrl,$fetchedTitleUrl,$fetchedPropertyID,$fetchedPropertyTitle,$fetchedTransactionCode);
                while (mysqli_stmt_fetch($stmt)){
                    $data[]=array("user_id"=>$fetchedUserID,"name"=>$fetchedName,"email"=>$fetchedEmail,
                        "phone_number"=>$fetchedPhoneNumber,"id_url"=>$fetchedIDUrl,
                        "ownership_title_url"=>$fetchedTitleUrl,"property_id"=>$fetchedPropertyID,
                        "property_title"=>$fetchedPropertyTitle,"transaction_code"=>$fetchedTransactionCode);
                }
                $output=array("error"=>"false","message"=>$data);
            }else{
                $this->mLogger->logger()->error("Failed listing seller verification details ".mysqli_error($conn).
                    " ".mysqli_stmt_error($stmt));
                $output =array("error"=>"true","message"=>"failed listing seller verification details");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed listing seller verification details ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"failed listing seller verification details");
        }
        mysqli_close($conn);
        return $output;
    }

    public function listSingleSellerDetails($userID){
        $conn = $this->dbConnect->dbConnection();
        $query = "SELECT s.userID, u.name,u.email,u.phoneNumber,s.isConfirmedID,s.isConfirmedTitleDeed FROM 
                    seller s INNER JOIN users u ON s.userID = u.userID WHERE s.isConfirmedID = 1 AND 
                    s.isConfirmedTitleDeed = 1 WHERE userID = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'i',$paramUserID);
            $paramUserID = $this->dataHandle->cleanData($userID);

            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$fetchedUserID,$fetchedName,$fetchedEmail,$fetchedPhoneNumber,
                    $fetchedIsConfirmedID,$fetchedIsConfirmedStatement);
                while (mysqli_stmt_fetch($stmt)){
                    $fetchedIsConfirmedID = 1 ? true:false;
                    $fetchedIsConfirmedStatement = 1 ? true:false;
                    $data=array("user_id"=>$fetchedUserID,"name"=>$fetchedName,"email"=>$fetchedEmail,
                        "phone_number"=>$fetchedPhoneNumber,"is_confirmed_id"=>$fetchedIsConfirmedID,
                        "is_confirmed_statement"=>$fetchedIsConfirmedStatement);
                }
                $output=array("error"=>"false","message"=>$data);
            }else{
                $this->mLogger->logger()->error("Failed listing seller $userID ".mysqli_error($conn).
                    " ".mysqli_stmt_error($stmt));
                $output =array("error"=>"true","message"=>"failed listing seller $userID");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed listing seller $userID ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"failed listing seller $userID");
        }
        mysqli_close($conn);
        return $output;
    }

    public function listSingleBuyerDetails($userID){
        $conn = $this->dbConnect->dbConnection();
        $query = "SELECT b.userID, u.name,u.email,u.phoneNumber,b.isConfirmedID,b.isConfirmedBankStatement FROM 
                    buyer b INNER JOIN users u ON b.userID = u.userID WHERE b.isConfirmedID = 1 AND 
                    b.isConfirmedBankStatement = 1 AND b.userID = ?";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'i',$paramUserID);
            $paramUserID = $this->dataHandle->cleanData($userID);

            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$fetchedUserID,$fetchedName,$fetchedEmail,$fetchedPhoneNumber,
                    $fetchedIsConfirmedID,$fetchedIsConfirmedStatement);
                while (mysqli_stmt_fetch($stmt)){
                    $fetchedIsConfirmedID = 1 ? true:false;
                    $fetchedIsConfirmedStatement = 1 ? true:false;
                    $data=array("user_id"=>$fetchedUserID,"name"=>$fetchedName,"email"=>$fetchedEmail,
                        "phone_number"=>$fetchedPhoneNumber,"is_confirmed_id"=>$fetchedIsConfirmedID,
                        "is_confirmed_statement"=>$fetchedIsConfirmedStatement);
                }
                $output=array("error"=>"false","message"=>$data);
            }else{
                $this->mLogger->logger()->error("Failed listing buyer $userID ".mysqli_error($conn).
                    " ".mysqli_stmt_error($stmt));
                $output =array("error"=>"true","message"=>"failed listing buyer $userID");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed listing buyer $userID ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"failed listing buyer $userID");
        }
        mysqli_close($conn);
        return $output;
    }

    public function listProperties($value,$acreage,$location,$propertyZone,$ownershipType,$seller,$propertyID){
        $conn = $this->dbConnect->dbConnection();
        $query = "SELECT p.propertyID,p.propertyDescription,p.propertyTitle,p.acreage,p.location,p.propertyValue,
        p.dateCreated,p.propertyZone,p.ownershipType, p.sellerID,u.name, u.phoneNumber,u.email FROM property p 
        INNER JOIN users u ON u.userID = p.sellerID WHERE ".$this->valueFilter($value)." AND 
        ".$this->acreageFilter($acreage)." AND ".$this->locationFilter($location)." AND 
        ".$this->propertyZoneFilter($propertyZone)." AND ".$this->ownershipTypeFilter($ownershipType)." AND ".
            $this->sellerFilter($seller)." AND ".$this->propertyIDFilter($propertyID) ." AND p.hideStatus = 0";

        if ($stmt = mysqli_prepare($conn,$query)){
            mysqli_stmt_bind_param($stmt,'sssssss',$paramValue,$paramAcreage,$paramLocation,
            $paramPropertyZone,$paramOwnershipType,$paramSellerID,$paramPropertyID);
            $paramValue = $this->dataHandle->cleanData($value) == null ? 0 : $this->dataHandle->cleanData($value);
            $paramAcreage = $this->dataHandle->cleanData($acreage) == null ? 0 : $this->dataHandle->cleanData($acreage);
            $paramLocation = $this->dataHandle->cleanData($location) == null ? '""' : $this->dataHandle->cleanData($location);
            $paramPropertyZone = $this->dataHandle->cleanData($propertyZone) == null ? '""' : $this->dataHandle->cleanData($propertyZone);
            $paramOwnershipType = $this->dataHandle->cleanData($ownershipType) == null ? '""' : $this->dataHandle->cleanData($ownershipType);
            $paramSellerID = $this->dataHandle->cleanData($seller) == null ? 0 : $this->dataHandle->cleanData($seller);
            $paramPropertyID = $this->dataHandle->cleanData($propertyID) == null ? 0 : $this->dataHandle->cleanData($propertyID);

            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$fetchedPropertyID,$fetchedPropertyDescription,
                    $fetchedPropertyTitle,$fetchedPropertyAcreage,$fetchedPropertyLocation,$fetchedPropertyValue,
                    $fetchedDateCreated,$fetchedPropertyZone,$fetchedOwnershipType,$fetchedSellerID,$fetchedSellerName,
                    $fetchedPhoneNumber,$fetchedEmail);
                while (mysqli_stmt_fetch($stmt)){
                    $data[] = array("property_id"=>$fetchedPropertyID,"description"=>$fetchedPropertyDescription,
                        "title"=>$fetchedPropertyTitle,"acreage"=>$fetchedPropertyAcreage,
                        "location"=>$fetchedPropertyLocation,"value"=>$fetchedPropertyValue,
                        "date_created"=>$fetchedDateCreated,"property_zone"=>$fetchedPropertyZone,
                        "ownership_type"=>$fetchedOwnershipType,"seller_id"=>$fetchedSellerID,
                        "seller_name"=>$fetchedSellerName,"phone_number"=>$fetchedPhoneNumber,
                        "email"=>$fetchedEmail);
                }
                $output=array("error"=>"false","message"=>$data);
            }else{
                $this->mLogger->logger()->error("Failed listing properties ".mysqli_stmt_error($stmt)." ".
                mysqli_error($conn));
                $output = array("error"=>"true","message"=>"Failed listing properties");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed listing properties ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"Failed listing properties");
        }
        mysqli_close($conn);
        return $output;
    }
    public function propertyIDFilter($propertyID){
        $sql = "";
        if ($propertyID != null){
            $sql = "p.propertyID = ? ";
        }else{
            $sql = "p.propertyID <> ?";
        }
        return $sql;
    }

    public function valueFilter($value){
        $sql = "";
        if ($value != null){
            $sql = "p.propertyValue >= ? ";
        }else{
            $sql = "p.propertyValue <> ?";
        }
        return $sql;
    }

    public function ownershipTypeFilter($ownershipType){
        $sql = "";
        if ($ownershipType != null){
            $sql = "p.ownershipType = ? ";
        }else{
            $sql = "p.ownershipType <> ?";
        }
        return $sql;
    }

    public function propertyZoneFilter($propertyZone){
        $sql = "";
        if ($propertyZone != null){
            $sql = "p.propertyZone = ? ";
        }else{
            $sql = "p.propertyZone <> ?";
        }
        return $sql;
    }

    public function acreageFilter($acreage){
        $sql = "";
        if ($acreage != null){
            $sql = "p.acreage >= ? ";
        }else{
            $sql = "p.acreage >= ?";
        }
        return $sql;
    }

    public function locationFilter($location){
        $sql = "";
        if ($location != null){
            $sql = "p.location = ? ";
        }else{
            $sql = "p.location <> ?";
        }
        return $sql;
    }

    public function sellerFilter($seller){
        $sql = "";
        if ($seller != null){
            $sql = "p.sellerID = ? ";
        }else{
            $sql = "p.sellerID <> ?";
        }
        return $sql;
    }

    public function listPropertyImages(){
        $conn = $this->dbConnect->dbConnection();
        $query = "SELECT propertyID,imageUrl FROM propertyImages";

        if($stmt = mysqli_prepare($conn,$query)){
            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$fetchedPropertyID,$fetchedImageUrl);
                $counter = 0;
                while (mysqli_stmt_fetch($stmt)){
                    $data[$counter."-".$fetchedPropertyID] = $fetchedImageUrl;
                    $counter++;
                }

                $imagesUrl = array();
                $tempDomain = "";
                $tempDomainFirst = 0;

                foreach($data as $idDomain => $idSa){
                    if( !$tempDomain && $tempDomainFirst == 0 ){
                        $tempDomain = substr(strrchr($idDomain, "-"), 1);
                        $tempDomainFirst = 1;
                    }
                    $currentDomain = substr(strrchr($idDomain, "-"), 1);
                    $imagesUrl[$currentDomain][] = $idSa;
                    $tempDomain = substr(strrchr($idDomain, "-"), 1);
                }

                $output=array("error"=>"false","message"=>$imagesUrl);
            }else{
                $this->mLogger->logger()->error("Failed listing image urls ".mysqli_error($conn)." ".
                mysqli_stmt_error($stmt));
                $output = array("error"=>"true","message"=>"Failed listing image urls");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed fetching image urls ".mysqli_error($conn));
            $output =array("error"=>"true","message"=>"Failed listing image urls");
        }
        mysqli_close($conn);
        return $output;
    }

    public function listUniqueLocations(){
        $query = "SELECT DISTINCT location FROM property WHERE hideStatus = 0 ORDER BY location ASC";
        $conn = $this->dbConnect->dbConnection();

        if ($stmt = mysqli_prepare($conn,$query)){
            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$fetchedLocation);
                while (mysqli_stmt_fetch($stmt)){
                    $data[]=array("location"=>$fetchedLocation);
                }
                $output=array("error"=>"false","message"=>$data);
            }else{
                $this->mLogger->logger()->error("Failed fetching unique locations ".mysqli_error($conn)." ".
                    mysqli_stmt_error($stmt));
                $output = array("error"=>"true","message"=>"failed fetching locations");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed fetching unique locations ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"failed fetching locations");
        }
        mysqli_close($conn);

        return $output;
    }

    public function listUniqueZones(){
        $query = "SELECT DISTINCT propertyZone FROM property";
        $conn = $this->dbConnect->dbConnection();

        if ($stmt = mysqli_prepare($conn,$query)){
            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$fetchedLocation);
                while (mysqli_stmt_fetch($stmt)){
                    $data[]=array("zone"=>$fetchedLocation);
                }
                $output=array("error"=>"false","message"=>$data);
            }else{
                $this->mLogger->logger()->error("Failed fetching unique locations ".mysqli_error($conn)." ".
                    mysqli_stmt_error($stmt));
                $output = array("error"=>"true","message"=>"failed fetching locations");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed fetching unique locations ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"failed fetching locations");
        }
        mysqli_close($conn);

        return $output;
    }
    public function listUniqueOwnershipTypes(){
        $query = "SELECT DISTINCT ownershipType FROM property";
        $conn = $this->dbConnect->dbConnection();

        if ($stmt = mysqli_prepare($conn,$query)){
            if (mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$fetchedLocation);
                while (mysqli_stmt_fetch($stmt)){
                    $data[]=array("ownership_type"=>$fetchedLocation);
                }
                $output=array("error"=>"false","message"=>$data);
            }else{
                $this->mLogger->logger()->error("Failed fetching unique locations ".mysqli_error($conn)." ".
                    mysqli_stmt_error($stmt));
                $output = array("error"=>"true","message"=>"failed fetching locations");
            }
            mysqli_stmt_close($stmt);
        }else{
            $this->mLogger->logger()->error("Failed fetching unique locations ".mysqli_error($conn));
            $output = array("error"=>"true","message"=>"failed fetching locations");
        }
        mysqli_close($conn);

        return $output;
    }

}