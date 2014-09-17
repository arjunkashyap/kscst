<?php

session_start();

$header = "\n";
$header .= "<!DOCTYPE html>\n";
$header .= "<html lang=\"en\">\n";
$header .= "<head>\n";
$header .= "    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n";
$header .= "    <title>Home | KSCST | Student Project Program</title>\n";
$header .= "    <meta name=\"description\" content=\"Student Project Programme, KSCST\">\n";
$header .= "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";
$header .= "    <link href=\"php/style/normalize.css\" media=\"all\" rel=\"stylesheet\" type=\"text/css\" />\n";
$header .= "    <link href=\"php/style/indexstyle.css\" media=\"all\" rel=\"stylesheet\" type=\"text/css\" />\n";
$header .= "    <link href=\"php/style/font-awesome-4.1.0/css/font-awesome.min.css\" media=\"all\" rel=\"stylesheet\" type=\"text/css\" />\n";
$header .= "    <script type=\"text/javascript\" src=\"php/js/jquery-1.11.1.min.js\"></script>\n";
$header .= "    <script type=\"text/javascript\" src=\"php/js/jquery-ui.min.js\"></script>\n";
$header .= "</head>\n";
$header .= "<body>\n";
$header .= "    <header class=\"app-bar\">\n";
$header .= "        <div class=\"htitle short\"><img src=\"php/images/logo.png\" alt=\"KSCST Logo\"/> <p>KSCST</p></div>\n";
$header .= "        <div class=\"htitle long\"><img src=\"php/images/logo.png\" alt=\"KSCST Logo\"/> <p>Karnataka State Council for Science and Technology</p></div>\n";
$header .= "        <nav class=\"navdrawer-container\">\n";
$header .= "            <ul>\n";
$header .= "                <li><span class=\"typ-a\"><a href=\"php/../index.php\">Home</a></span></li>\n";
$header .= "                <li><span class=\"typ-a\"><a href=\"php/about.php\">About SPP</a></span></li>\n";
$header .= "                <li><span class=\"typ-a\"><a href=\"php/search.php\">Search</a></span></li>\n";
$header .= "                <li>\n";
$header .= "                    <span class=\"typ-a\">";

if(isset($_SESSION['login']))
{
    ($_SESSION['login'] == 1) ? $header .= "<a href=\"php/logout.php\">Logout</a>" : $header .= "<a href=\"php/login.php\">Login</a>";
}
else
{
    $header .= "<a href=\"php/login.php\">Login</a>";
}

$header .= "                    </span>\n";
$header .= "                </li>\n";
$header .= "            </ul>\n";
$header .= "        </nav>\n";
$header .= "        <button class=\"menu\">☰</button>\n";
$header .= "    </header>\n";
    
if(!(isset($isIndex)))
{
    $header = preg_replace("/\"php\//", "\"", $header);
}

echo $header;

?>
