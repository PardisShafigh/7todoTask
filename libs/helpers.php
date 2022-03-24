<?php defined("BASE_PATH") OR die("Permision Denied!");



function getCurrentUrl($user, $password){
    return 1;
} 


function isAjaxRequest(){
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
        return true;
    }
    return false;
}



function site_url($uri = ""){
    return BASE_URL . $uri;


}



function redirect($url){
    header("Location: $url");
    die();
}



function diePage($msg){
echo "<div style='padding: 30px; width: 80%; margin: 50px auto; background: #efc3c3; border: 1px solid #c39292; color: #7c3232; border-radius: 5px; font-family: sans-serif;'>$msg</div>";
    die();
} 

function message($msg,$cssClass = "info"){
echo "<div  class= $cssClass style='padding: 20px; width: 80%; margin: 10px auto; background: #59d273; border: 1px solid #327c38; color: #277a33; border-radius: 5px; font-family: sans-serif;'>$msg</div>";
} 

function dd($var){
    echo "<pre style='color: orange; background-color: #fff; z-index: 999; position: relative; padding: 10px; margin: 10px; border-radius: 5px; border: 3px solid orange;'>";
    var_dump($var);
    echo "</pre>";
}
