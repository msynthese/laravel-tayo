<?php

namespace App\Http\Controllers;

// require __DIR__ . "../vendor/autoload.php";
use Illuminate\Http\Request;
use app\Models\Batiment;
use App\Spiders\MySpider;
use RoachPHP\Roach;
use Goutte\Client;

class BatimentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $responseBody = null;
        $infos = [];
        $adresse = $request->input('adresse');
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = "https://api3.geo.admin.ch/rest/services/api/SearchServer?searchText={$adresse}&type=locations&sr=2056&origins=address";
        if ($adresse != ''){
          $i = 0;
          $infosReturn = array();
          $response = $client->request('GET', $url);
          $responseBody = json_decode($response->getBody());
          $responseBody = $responseBody->{'results'};
          $infos = $this->parsing($responseBody);
        }
        return view('batiment.index', ['responseBody' => $responseBody, 'adresse' => $adresse, 'infos'=> $infos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function parsing($responseBody)
    {
      $infos =array();
      foreach ($responseBody as $response) {
        $egid = $response->{"attrs"}->{"featureId"};
        $url_egit = "https://api3.geo.admin.ch/rest/services/ech/MapServer/ch.bfs.gebaeude_wohnungs_register/{$egid}/extendedHtmlPopup?lang=fr";
        $client = new Client();
        $crawler = $client->request('GET', $url_egit);
        array_push( $infos,$crawler->filter('td.cell-meta-small')->each( function ($node) {
            $nom = trim($node->filter('td')->text());
            return $nom;
          }));
      }
      return $infos;

  }
}
