<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pairs;
use App\Models\Currency;
use App\Models\Converts;
class AdminConvertsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $converts = Converts::all();

        // On retourne les informations des utilisateurs en JSON
        return response()->json($converts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $convert = new Converts;
        $convert->id_pair = $request->id_pair;
        $convert->count_conversion = $request->count_conversion;
        $convert->save();
        return response()->json($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


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

    public function convert($change, $currencyInit, $currencyDest)
    {

        $pairs = Pairs::All();
        $currency = Currency::All();
        $convert = Converts::All();

        $idInit = 0;
        $idDest = 0;
        $idPair = 0;
        $ratePair = 0.0;
        $convertPossible = false;

        foreach ($currency as $key => $valueCurrency) {
            if($valueCurrency->name == $currencyInit){
                $idInit = $valueCurrency->id;
            }else if($valueCurrency->name == $currencyDest){
                $idDest = $valueCurrency->id;
            }
        }

        for($i = 0; $i < count($pairs); $i++){
            foreach ((object) array($pairs[$i]) as $pair) {
                if($pair->{'currency_init'} == $idInit && $pair->{'currency_dest'} == $idDest){
                    $idPair = $pair->{'id'};
                    $ratePair = $pair->{'rate'};
                    $convertChange = $ratePair * $change;
                    $convertPossible = true;
                }
                echo "<br/>";
            }
        }

        $convertArray = $convert;
        for($j = 0; $j < count($convertArray); $j++){
            foreach ((object) array($convertArray[$j]) as $converts) {
                if($converts->{'id_pair'} == $idPair){
                    $convert = Converts::findOrFail($converts->{'id'});
                    $convert->count_conversion = $convert->count_conversion +1;
                    $convert->save();
                }
            }
        }

        if($convertPossible){
            return  $change." ".$currencyInit." = ".$convertChange." ".$currencyDest;
        }else{
            return "Désolé, la paire de conversion que vous avez choisi n'existe pas";
        }

    }
}

