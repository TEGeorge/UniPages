<?php

function fail($msg) {
	$meta["ok"] = false;
	$debug[] = $msg;
	sendResults(array(), $meta, $debug);
    exit(-1);
}

/**
 * @param $results
 */
function sendResults($results)
{
    global $_REQUEST;

    $jsonFormatParameter = isset($_REQUEST['format']) && ($_REQUEST['format'] == 'json');
    $jsonHeaderRequest = !(stripos($_SERVER['HTTP_ACCEPT'], 'application/json') === false);
    $json = $jsonHeaderRequest || $jsonFormatParameter;

    if (isset($results["meta"]["ok"]) && $results["meta"]["ok"] === false) {
        $status = isset($results["meta"]["status"]) ? $results["meta"]["status"] : 599;
        $msg = isset($results["meta"]["msg"]) ? $results["meta"]["msg"] : "Oh 'eck!";
    } else {
        $status = isset($results["meta"]["status"]) ? $results["meta"]["status"] : 200;
        $msg = isset($results["meta"]["msg"]) ? $results["meta"]["msg"] : "OK";
    }
    header("HTTP/1.1 $status $msg");

    if ($json) {
        header("Content-Type: application/json");
        echo json_encode($results);
    } else {
        header("Content-Type: text/plain");
        echo("results: ");
        var_dump($results);
    }
}

 ?>
