<?php

require_once "vendor/autoload.php";

use GuzzleHttp\Client;
use Olooeez\CoursesSearcher\Searcher;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client(["base_uri" => "https://www.alura.com.br/"]);
$crawler = new Crawler();

$searcher = new Searcher($client, $crawler);
$courses = $searcher->search("/cursos-online-programacao/php");

foreach ($courses as $course)
{
    echo $course . PHP_EOL;
}
