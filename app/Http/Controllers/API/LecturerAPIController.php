<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use Illuminate\Http\Request;

class LecturerAPIController extends Controller
{
    public function index(){
        return Lecturer::all();
    }

    public function show($id){
        return Lecturer::find($id);
    }

    public function store(Request $request){
        $lecturer=new Lecturer();
        $lecturer->name=$request->name;
        $lecturer->surname=$request->surname;
        $lecturer->email=$request->email;
        $lecturer->birthdate=$request->birthdate;
        $lecturer->user_id=null;
        $lecturer->save();

        return $lecturer;
    }

    public function update(Request $request,$id){
        $lecturer=Lecturer::find($id);
        $lecturer->name=$request->name;
        $lecturer->surname=$request->surname;
        $lecturer->email=$request->email;
        $lecturer->birthdate=$request->birthdate;
        $lecturer->save();
        return $lecturer;
    }

    public function destroy($id){
        Lecturer::destroy($id);
        return $id;
    }
}
