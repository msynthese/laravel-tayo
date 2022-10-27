<?php

namespace App\Http\Controllers;


use RoachPHP\Http\Response;
use RoachPHP\Spider\BasicSpider;


class LaravelDocsSpider extends BasicSpider
{
    /**
     * @var string[]
     */
    public array $startUrls = [
     ' https://api3.geo.admin.ch/rest/services/ech/MapServer/ch.bfs.gebaeude_wohnungs_register/886352_0/extendedHtmlPopup?lang=fr'
    ];

    public function parse(Response $response): \Generator
    {
      dd($response);
      $text = $response->filter('td')->text();
      dd(text);
      yield $this->item([
        'title' => $text
    ]);
    }

}
