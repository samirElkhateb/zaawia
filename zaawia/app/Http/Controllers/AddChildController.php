<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\child;
use Illuminate\Support\Facades\Auth;


class AddChildController extends Controller
{
    public function  store_child(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string',
        //     'icon' => 'required|string'
        // ]);

        // $father_id = Auth::id();

        // $child = new Child();
        // $child->name = $request->name;
        // $child->icon = $request->icon;
        // $child->user_id = $father_id;
        // $child->save();



        // return response()->json($child, 201);
        // Check if the user is authenticated
        if (Auth::check()) {


            $request->validate([
                'name' => 'required|string',
                'icon' => 'required|string'
            ]);

            $father_id = Auth::id();

            $child = new Child();
            $child->name = $request->name;
            $child->icon = $request->icon;
            $child->user_id = $father_id;
            $child->save();

            return response()->json($child, 201);
        } else {

            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
