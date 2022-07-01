<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Http;

class Bodega extends Controller
{
    public function create_ingredient(Request $request)
    {
        $new_ingredient = new Ingredient;
        $new_ingredient->name           = $request->input('name');
        $new_ingredient->units          = $request->input('units');
        $new_ingredient->is_available   = $request->input('is_available');
        $request = $new_ingredient->save();
        return $request;
    }
    public function get_ingredients()
    {
        $ingredients = Ingredient::all();
        return view('ingredients', ['ingredients' => $ingredients]);
    }
    public static function ingredient_is_available($id)
    {
        try {
            $ingredient = Ingredient::find($id);
            if ($ingredient->units > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        } catch (\Throwable $th) {
            return 'error';
        }
    }

    public static function buy_ingredients($id)
    {
        try {
            $ingredient = Ingredient::find($id);
            $response = Http::get('https://recruitment.alegra.com/api/farmers-market/buy?ingredient='.$ingredient->name);
            $units = $response->json()['quantitySold'];
            if ($units > 0)
            {
                $ingredient->units += $units;
                $ingredient->save();
                return true;
            }
            else
            {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function subtract_ingredient($id)
    {
        try {
            $ingredient = Ingredient::find($id);
            $ingredient->units = $ingredient->units - 1;
            $ingredient->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
