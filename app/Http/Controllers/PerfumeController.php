<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Perfume;
use App\Http\Requests\UpdateEmployeeRequest;


class PerfumeController extends Controller
{
    public function getPerfumes() {

        $perfumes = Perfume::all();

        return view("/perfumes",["perfumes"=>$perfumes]);

        // return view( "/perfumes" );
    }

    public function newPerfume() {

        return view( "new_perfume" );
    }

    public function storePerfume( Request $request ) {

        $perfume = new Perfume;

        $perfume->name = $request->name;
        $perfume->type = $request->type;
        $perfume->price = (int)$request->price;

        $perfume->save();

        return redirect( "/new-perfume" );
    }

    public function editPerfume( $id ) {

        $perfume = Perfume::find( $id );

        return view( "edit_perfume", [
            "perfume" => $perfume
        ]);
    }

    public function updatePerfume( Request $request ) {


            $perfume = Perfume::find( $request[ "id" ]);
     
            $perfume->name = $request[ "name" ];
            $perfume->type = $request[ "type" ];
            $perfume->price = $request[ "price" ];
         
            $perfume->save();
         
            session()->flash( "success", "Sikeres frissítés" );
            return redirect("/perfumes");
        
        // return redirect('');

        // $perfume = DB::update( "UPDATE perfumes SET name = ? WHERE id = ?", [ "valamiModositottnev", 10 ]);

        // print_r($perfume);

    }

    public function deletePerfume( $id ) {

        $perfume = Perfume::find( $id );
        $perfume->delete();

        return redirect( "/perfumes" );
    }

    
}
