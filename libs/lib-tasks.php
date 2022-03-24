<?php defined("BASE_PATH") OR die("Permision Denied!");


// alternative to top code

// if (!defined("BASE_PATH")) {
//   echo "Permision Denied!";
//   die();
// }




/** Folder Function*/
// function AddFolders($data){
//     global $pdo;
//     $sql = "select * from folders";
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute();
//     $records = $stmt->fetchAll(PDO::FETCH_OBJ);
//     return $records;

// }



function addFolder($folder_name)
{
    global $pdo;
    $current_user_id = getCurrentUserId();
    $sql = "INSERT INTO `folders` (name,user_id)
    VALUES (:folder_name,:user_id);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':folder_name'=>$folder_name,':user_id'=>$current_user_id]);
    return $stmt->rowCount(); 
}



function doneSwitch($task_id)
{
    global $pdo;
    $current_user_id = getCurrentUserId();
    $sql = "UPDATE `tasks` SET is_done = 1 - is_done WHERE user_id = :userID AND id = :taskID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':taskID'=>$task_id,':userID'=>$current_user_id]);
    return $stmt->rowCount(); 
}






function deleteFolder($folder_id){
    global $pdo;
    $sql = "delete from folders where id=$folder_id";
    $stmt = $pdo->query($sql);
    $stmt->execute();
    return $stmt->rowcount(); 
}


function getFolders(){
    global $pdo;
    $current_user_id = getCurrentUserId();
    $sql = "select * from folders where user_id = $current_user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;

}



/** Task Function*/
function deleteTask($task_id){
    global $pdo;
    $sql = "delete from tasks where id=$task_id";
    $stmt = $pdo->query($sql);
    $stmt->execute();
    return $stmt->rowcount(); 
}



function addTask($taskTitle, $folderId){
    global $pdo;
    $current_user_id = getCurrentUserId();
    $sql = "INSERT INTO `tasks` (title,user_id,folder_id)
    VALUES (:title,:user_id,:folder_id);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':title'=>$taskTitle,':user_id'=>$current_user_id,':folder_id'=>$folderId]);
    return $stmt->rowCount(); 
} 




function getTasks(){
    global $pdo;
    $folder = $_GET["folder_id"] ?? null;
    $folderCondition = "";
    if (isset($folder) and is_numeric($folder)) {
        $folderCondition = "and folder_id=$folder";
    }




    $current_user_id = getCurrentUserId();
    $sql = "select * from tasks where user_id = $current_user_id $folderCondition";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
} 


