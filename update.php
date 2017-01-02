<?php
require_once "vendor/autoload.php";

use Sunra\PhpSimple\HtmlDomParser;

try {
    $html = HtmlDomParser::file_get_html("http://www.bbc.com/sport/football/italian-serie-a/table");
} catch(Exception $e) {
    print_r($e);
}

$data = [];
foreach($html->find("#trc-20-italian-serie-a-CFBB212016S1R1", 0)->find("tr") as $row) {
    $data["table"][] = [
        "teamName" => $row->find("td.team-name", 0)->plaintext,
        "played" => $row->find("td.played", 0)->plaintext,
        "points" => $row->find("td.points", 0)->plaintext
    ];
}

if (!empty($data)) {
    $data["info"] = [
        "author" => "Marat Dallin",
        "authorSite" => "https://dallin.pro",
        "authorEmail" => "amr@dallin.pro",
        "created" => date("c"),
        "source" => "http://www.bbc.com/sport/football/italian-serie-a/table"
    ];
    
    $json = json_encode($data);
    file_put_contents('data.json', $json);
}

$html->clear();
unset($html);
