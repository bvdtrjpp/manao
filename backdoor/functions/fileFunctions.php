<?php

require 'config.php';

function isFileCreated($filePath){
    if(file_exists($filePath)){
        return true;
    }
    else{
        return false;
    }
}

function isFileEmpty($filePath){
    $file = file_get_contents($filePath);
    if(empty($file)){
        return true;
    }
    else{
        return false;
    }
}
    
function createJSONFile($filePath){
    $fileJSON = fopen($filePath, 'w');
    fwrite($fileJSON, '[]');
    fclose($fileJSON);
}

function getJSONFileContent() {
    global $DataJSONFilePath;

    if (file_exists($DataJSONFilePath)) {
        $dataFile = file_get_contents($DataJSONFilePath);
        if ($dataFile !== false) {
            $dataJSON = json_decode($dataFile, true);
            if ($dataJSON !== null) {
                return $dataJSON;
            }
        }
    }

    return [];
}

// function addJSONFileContent($content, $isAppended = false) {
//     global $DataJSONFilePath;
  
//     if ($isAppended) {
//         $existingData = getJSONFileContent();
//         if (empty($existingData)) {
//             $dataJSON = "[" . PHP_EOL;
//         } else {
//             $dataJSON = rtrim(file_get_contents($DataJSONFilePath), "]" . PHP_EOL);
//             $dataJSON .= "," . PHP_EOL;
//         }
//         $dataJSON .= json_encode($content[0], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
//         $dataJSON .= PHP_EOL . "]" . PHP_EOL;
//     } else {
//         $dataJSON = '';
//         foreach ($content as $item) {
//             $dataJSON .= json_encode($item, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
//             $dataJSON .= "," . PHP_EOL;
//         }
//         if (!empty($dataJSON)) {
//             $dataJSON = "[" . PHP_EOL . rtrim($dataJSON, "," . PHP_EOL) . PHP_EOL . "]";
//         } else {
//             $dataJSON = "[]" . PHP_EOL;
//         }
//     }
  
//     file_put_contents($DataJSONFilePath, $dataJSON);
//     return $dataJSON;
// }
function addJSONFileContent($content, $isAppended = false) {
    global $DataJSONFilePath;

    // Проверяем, что $content является массивом
    if (!is_array($content)) {
        return false;
    }

    // Преобразуем содержимое массива в JSON-строку
    $dataJSON = json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Проверяем, что преобразование в JSON прошло успешно
    if ($dataJSON === false) {
        return false;
    }

    // Записываем JSON-строку в файл
    if (file_put_contents($DataJSONFilePath, $dataJSON) !== false) {
        return $dataJSON;
    } else {
        return false;
    }
}