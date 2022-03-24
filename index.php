<?php

use Illuminate\Support\Facades\Redirect;

include "bootstrap/init.php";


if (isset($_GET["logout"])) {
    logout();
}


if (!isLoggedIn()) {
    // redirect to aut form
    redirect(site_url("auth.php"));
}
// user is LoggedIn
$user = getLoggedInUser();



// use Hekmatinasser\Verta\Verta;
// $v = new Verta();
// var_dump(Verta::now());

if (isset($_GET["delete_folder"]) && is_numeric($_GET["delete_folder"])) {
    $deletedCount= deleteFolder($_GET["delete_folder"]);
    // echo "$deletedCount folders successfully deleted!";
}


if (isset($_GET["delete_task"]) && is_numeric($_GET["delete_task"])) {
    $deletedCount1= deleteTask($_GET["delete_task"]);
    echo "$deletedCount1 Tasks successfully deleted!";
}





// connect to db and get tasks
$folders = getFolders();
$tasks = getTasks();

// dd($tasks);

include "tpl/tpl-index.php";