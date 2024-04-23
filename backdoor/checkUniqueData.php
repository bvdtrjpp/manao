<?php

include('functions/fileFunctions.php');


if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $inputKey = key($_POST);
    $inputValue = $_POST[$inputKey];
    $filePath = '../data/data.json';
    if(isFileCreated($filePath)){

        if(!isFileEmpty($filePath)){

            $jsonData = file_get_contents($filePath);
            
            $data = json_decode($jsonData, true);
            $isValueFound = false;
            if ($data !== null) {
                $isValueFound = false;

                foreach ($data as $obj) {
                    if ($obj[$inputKey] === $inputValue) {
                        $isValueFound = true;
                        break;
                    }
                }

                if($isValueFound)
                    echo $inputKey . " " . $inputValue;
                else
                    echo 'false';
            } else {
                echo "error to open json";
            }
               
        }
        else{
            echo 'false';
        }

    }
    else{

        createJSONFile($filePath);
        echo 'false';

    }
}
else{
    if (isset($_SERVER['HTTP_REFERER'])) {
        $previousPage = $_SERVER['HTTP_REFERER'];
        header("Location: ".$previousPage);
    } else {
        header("Location: ../index.php");
    }
}


