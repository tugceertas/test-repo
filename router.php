<?php 
// Controller includer

foreach (glob('Controllers/*.php') as $filename)
{
    require_once $filename;
}



$uri = $_SERVER['REQUEST_URI'];
$path = null;
$query = null;

$parsedURL = parse_url($uri);
$path = $parsedURL['path'];
$array = [];
$array =  explode("/",$path);

//if query is set 
if(isset($parsedURL['query'])){
    $query = $parsedURL['query'];
}

//the last part of URI
$request = $array[count($array) - 1];

//build controller file name and class name
$controllerPath = $request.".controller.php";
$controllerName = $request."Controller"; 
$directoryPath = 'Controllers/'.$controllerPath;

// all controller has renderView function
$method = "renderView";
if (file_exists($directoryPath)){

$dispatch = new $controllerName;
call_user_func_array(array($dispatch, $method), array());

}


else{
echo 'fail';

}



?>