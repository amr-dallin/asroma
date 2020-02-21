<?php
require_once "vendor/autoload.php";

use PHPHtmlParser\Dom;

$dom = new Dom;
$dom->loadFromUrl('https://www.bbc.com/sport/football/italian-serie-a/table');

$data = [];
foreach($dom->find('table.gs-o-table')[0]->find('tbody tr') as $row) {
    $data['table'][] = [
        'teamName' => $row->find('td')[2]->find('a > abbr > span')[0]->text,
        'played'   => $row->find('td')[3]->text,
        'points'   => $row->find('td')[10]->text
    ];
}

if (!empty($data)) {
    $data['info'] = [
        'author' => 'Marat Dallin',
        'authorSite' => 'https://dallin.uz',
        'authorEmail' => 'mail@dallin.uz',
        'created' => date('c'),
        'source' => 'https://www.bbc.com/sport/football/italian-serie-a/table'
    ];

    $json = json_encode($data);
    file_put_contents('data.json', $json);
}

unset($dom);
