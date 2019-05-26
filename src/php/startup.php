<?php
session_start();

$project    = "fantasyFootball";
$siteTitle  = "Fantasy Value Draft";
$pageTitle  = "Fantasy Value Draft";
$image      = "https://football.religionandstory.com/images/football.jpg";
$description= "Use this Fantasy Football Draft tool to determine the most efficient draft picks. Compare to FantasyFootballAnalytics.NET.";
$keywords   = "fantasy football,sports,football,draft,efficient,statistics";
$homeUrl    = "https://football.religionandstory.com";

function getRootPath()
{
    $public = "public_html";
    $path = $_SERVER['DOCUMENT_ROOT'];
    $length = strpos( $path, $public ) + strlen( $public );
    return substr( $path, 0, $length ) . "/";
}

function getSubPath()
{
    return getRootPath() . "football/";
}

function includeHeadInfo()
{
    global $siteTitle;
    global $pageTitle;
    global $image;
    global $description;
    global $keywords;
    include(getRootPath() . "common/html/head.php");
}

function includeHeader()
{
    //todo - different header
    global $homeUrl;
    include(getRootPath() . "common/html/header.php");
}

function includeModals()
{
    include(getRootPath() . "common/html/modal.html");
    include(getRootPath() . "common/html/modal-binary.html");
    include(getRootPath() . "common/html/modal-prompt.html");
    include(getRootPath() . "common/html/modal-prompt-big.html");
    include(getRootPath() . "common/html/toaster.html");
}

function getHelpImage()
{
    echo "https://religionandstory.com/common/images/question-mark.png";
}

function getConstructionImage()
{
    echo "https://image.freepik.com/free-icon/traffic-cone-signal-tool-for-traffic_318-62079.jpg";
}

?>