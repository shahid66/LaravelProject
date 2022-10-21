<?php

namespace App\Http\Controllers;

use App\Models\NamajTimeModel;
use Illuminate\Http\Request;

class NamajTimeController extends Controller
{
    function NamajPage(){
        return view('Namaj');
    }
    function NamajData(){
        $result= NamajTimeModel::orderBy('id','asc')->get();
        return $result;
    }

    function NamajAdd(Request $request){
        $namaj=$request->input('namaj');
        $azan_time=$request->input('azan_time');
        $time=$request->input('time');




        $result=NamajTimeModel::insert([

            'namaj'=>$namaj,
            'time'=>$time,
            'azan_time'=>$azan_time


        ]);
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }

    function NamajDelete(Request $request){
        $id=$request->input('id');
        $imageURL=$request->input('imageURL');

        $OldPhotoURLArray= explode("/", $imageURL);
        $OldPhotoName=end($OldPhotoURLArray);

        $result=NamajTimeModel::where('id','=',$id)->delete();

        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }
}
