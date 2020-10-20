<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Random;
use App\Models\Breakdown;

class RandomController extends Controller
{
    public function getData() {
        if (Random::get()->where('flag', false)->first() == null) {
            $this->generateRandomAndBreakdownData();
        }
        return Random::join('breakdowns', 'breakdowns.random_id', '=', 'randoms.id')->where('flag', false)->get();

    }

    public function generateRandomAndBreakdownData() {
        $randomIteration = rand(5, 10);

        for ($i=0; $i <= $randomIteration ; $i++) { 
            $randomObject = Random::create([
                'values' => $this->generateFiveRandomCharacterString(),
                'flag' => false
            ]);
            
            $breakdownIteration = rand(5, 10);
            for ($j=0; $j <= $breakdownIteration ; $j++) { 
                $randomObject->breakdown()->create([
                    'values' => $this->generateFiveRandomCharacterString()
                ]);
            }
        }

       
    }

    private function generateFiveRandomCharacterString(){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $randomString = '';
        
        for ($i=0; $i < 5; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index];

        }

        return $randomString;
    }

    public function editFlag(Request $request) {
        $arr = $request->all();
        for ($i=0; $i < count($arr); $i++) { 
            Random::where('id', $arr[$i])->update([
                'flag' => true
            ]);
        }
    }
}
