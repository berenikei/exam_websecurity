<?php
class Validation {

    public static function checkInput($input, $expectedType, $minLength, $maxLength ){
        // supported types string int boolean email 
        if($expectedType != ''){

            if($expectedType == 'email'){
                if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
                    echo '{"status": 0, "message": "Your email is not a valid email address"}';
                    exit();
                }
            }else{
                if(gettype($input) != $expectedType){
                    echo '{"status": 0, "message": "Invalid input type"}';
                    exit();
                }
            }
            
        }
        // Check the length
        if($minLength != ''){
            if(strlen($input)<$minLength){
                echo '{"status": 0, "message": "Invalid length (min)"}';
                exit();
            }
        }
        if($maxLength != ''){
            if(strlen($input)>$maxLength){
                echo '{"status": 0, "message": "Invalid length (max)"}';
                exit();
            }
        }
    }
    
    // this function cleans the empty spaces  
    //encoding the html special charecter and sanitize the data
    public static function sanitize_and_clean($data) {
        $Newdata = trim($data);   
        $Newdata = htmlspecialchars($data);
        $Newdata = filter_var($data,FILTER_SANITIZE_ENCODED);
        return $Newdata;
    }
    //cleans the empty fields and remove html tags
    public static function sanitize_inputs($data){
        $Newdata = trim($data);
        $Newdata = filter_var($data, FILTER_SANITIZE_STRING);
        return $data;
    }

    public static function sanitize_output($data){
        $Newdata = trim($data);
        $Newdata = filter_var($data, FILTER_SANITIZE_STRING);
        return $data;
    }

    public static function checkUploadedImage($file){
        $allowedTypes = ['jpeg', 'jpg', 'png'];
        $fileName = $file['name'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $ini_max = ini_get('upload_max_filesize');
        $maxUploadSize = (int)strstr($ini_max, 'M', true); 
        if(!in_array($fileExtension,$allowedTypes)){
            echo '{"status": 0, "message": "Please upload a .png, .jpg or .jpeg file."}';
            exit();
        }
        if($file['size'] == 0){
            echo '{"status": 0, "message": "Maximum image file size is '.$maxUploadSize.'MB."}';
            exit();
        }
    }
}
// $input = 'a@a.com';
// Validation::checkInput($input,'email',5,10);


