<?php

namespace Olooeez\CoursesSearcher;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Searcher
{
    private $client;
    private $crawler;

    public function __construct(ClientInterface $client, Crawler $crawler)
    {
        $this->client = $client;
        $this->crawler = $crawler;
    }

    public function search(string $url): array
    {
        $response = $this->client->request("GET", $url);

        $html = $response->getBody();

        $this->crawler->addHtmlContent($html);

        $elementCourses = $this->crawler->filter("span.card-curso__nome");

        $courses = [];

        foreach ($elementCourses as $elementCourse) {
            $courses[] = $elementCourse->textContent;
        }

        return $courses;
    }
}
