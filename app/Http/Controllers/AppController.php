<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    /** @var array */
    private $players = [];

    public function createGame(Request $request)
    {
        for ($el = 1; $el <= $request->gamers; $el++) {
            $tmp = 'player' . $el;
            if ($request->$tmp === null)
                return redirect()->route('russian.roulette')->with(['error' => 'Имя не может быть пустым']);
            else
                $this->players[] = $request->$tmp;
        }
        $shoot_value = 1;
        $shoot = 0;
        $player_id = 0;
        $players = $this->players;
        $game = DB::table('players')->insert([
            'player' => json_encode($players),
            'shoot_value' => $shoot_value
        ]);
        if ($shoot_value == 1){
            $dead = 1;
        }else {
            $dead = 0;
        }

        return view('games.russian-roulette', compact('shoot_value', 'players', 'shoot', 'player_id', 'dead'));
    }

    public function makeShoot(Request $request)
    {
        $player_id_tmp = $request->player_id + 1;
        $game = DB::table('players')->latest('id')->first();

        if ($request->shoot + 1 == $game->shoot_value) {
            $dead = 1;
            if ($player_id_tmp == count(json_decode($game->player))) {
                $player_id = 0;
            }
            else{
                $player_id = $player_id_tmp;
            }
            $players = json_decode($game->player);
            return view('games.russian-roulette', compact('dead', 'players', 'player_id'));
        } else {
            if ($player_id_tmp == count(json_decode($game->player))) {
                $player_id = 0;
            }
            else{
                $player_id = $player_id_tmp;
            }
            $shoot_value = $game->shoot_value;
            $shoot = $request->shoot;
            $players = json_decode($game->player);
            $dead = 0;

            return view('games.russian-roulette', compact('shoot_value', 'players', 'dead', 'shoot', 'player_id'));
        }
    }
}
