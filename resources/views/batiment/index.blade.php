@extends('layouts.app')

@section('content')
  <h1>Batiment-index</h1>
  <form action="{{route('batiment.index')}}" method="get">
      @csrf
      <label for="ville">Entrez une adresse: </label>
      <input type="text" name="ville" id="ville">
      <input type="submit" value="Envoyer !">
  </form>
  <h1>Adresse : {{$ville}}</h1>
  <div class="container-fluid mb-5" style="margin-bottom: 150px !important">
    <div class="row mr-4">
      @if ($responseBody != null)
      <?php
        $i = 0
      ?>
      <ul>
        @foreach ($responseBody as $response)
          <?php
          $adresse = $response->{"attrs"}->{"detail"};
          $egid = $response->{"attrs"}->{"featureId"};
          // dd($infos)
          ?>
        <li>Egid: <a href= 'https://api3.geo.admin.ch/rest/services/ech/MapServer/ch.bfs.gebaeude_wohnungs_register/{{$egid}}/extendedHtmlPopup?lang=fr' target="popup" >{{$egid}}</a>, adresse: {{ $adresse }}</li>
        <ul>
          <li>{{$infos[$i][34]}} : {{$infos[$i][35]}}</li>
          <li>{{$infos[$i][62]}} : {{$infos[$i][63]}}</li>
          <li>{{$infos[$i][50]}} : {{$infos[$i][51]}}</li>
        </ul>
        <?php
        $i = $i + 1;
        ?>
        @endforeach
      </ul>
      @endif
    </div>
</div>

@endsection
