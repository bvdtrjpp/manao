<?php

include 'fileFunctions.php';
include 'user.php';



function createUser($login, $name, $email, $password) {
    $user = new User($login, $name, $email, $password);

    $userData = [
        'login' => $user->getLogin(),
        'name' => $user->getName(),
        'email' => $user->getEmail(),
        'password' => $user->getPassword(),
        'salt' => $user->getSalt()
    ];

    $existingData = getJSONFileContent();
    $existingData[] = $userData;

    if (addJSONFileContent($existingData, true) !== false) {
        return $user;
    } else {
        return false;
    }
}



function readUser($login) {
    $usersJSONData = getJSONFileContent();
    $user = new User();

    if ($usersJSONData !== false) {
        foreach ($usersJSONData as $item) {
            if (isset($item['login']) && $login === $item['login']) {
                $user = new User($item['login'], $item['name'], $item['email'], $item['password']);
                break;
            }
        }
    }

    return $user;
}

function updateUser($user, $changeTarget, $changeTargetValue){

    return $user->$changeTarget = $changeTargetValue;

}
// function deleteUser($login) {
//     $usersJSONData = getJSONFileContent();
//     if ($usersJSONData !== false) {
//         foreach ($usersJSONData as $key => $item) {
//             if (isset($item['login']) && $item['login'] === $login) {
//                 unset($usersJSONData[$key]);
//                 break;
//             }
//         }
//         addJSONFileContent($usersJSONData, true);
//     }
// }
function deleteUser($login) {
    $usersJSONData = getJSONFileContent();
    if ($usersJSONData !== false) {
        $updatedData = array_filter($usersJSONData, function ($item) use ($login) {
            return isset($item['login']) && $item['login'] !== $login;
        });
        addJSONFileContent($updatedData, false);
    }
}


function readUserLogin($login) {
    $usersJSONData = getJSONFileContent();
    if ($usersJSONData !== null) {
        foreach ($usersJSONData as $item) {
            if ($login === $item['login']) {
                $userPasswordInfo = array('password' => $item['password'], 'salt' => $item['salt']);
                return $userPasswordInfo;
            }
        }
    }
    
    return false;
}