<?php

namespace App\Http\Controllers;

use App\Models\AccountsDetailsModel;
use App\Models\CatagoriesModel;
use App\Models\CostAmountModel;
use App\Models\VideoModel;
use Illuminate\Http\Request;

class VideController extends Controller
{
    function VideoIndex(){
        return view('Video');
    }
    function VideoDataList(){
        $result=VideoModel::orderBy('id','desc')->get();
        return $result;
    }
    function VideoDataListLimit(){
        $result=VideoModel::where('status','=',1)->limit(3)->get();
        if($result==!null){
            return $result;
        }else{
            return 0;
        }
    }


    function VideoAdd(Request $request){
        $url=$request->input('url');
        $title=$request->input('title');
        $status=$request->input('status');

        $filePath=$request->file('image')->store('public');
        $fileName=explode("/", $filePath)[1];

        $image="http://".$_SERVER['HTTP_HOST']."/storage/".$fileName;


        $result=VideoModel::insert([

            'url'=>$url,
            'thumbline'=>$image,
            'title'=>$title,
            'status'=>$status


        ]);
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }
    function VideoDelete(Request $request){
        $id=$request->input('id');
        $result=VideoModel::where('id','=',$id)->delete();
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }

    function searchSaveAmountIndex(){
        $Catagories=CatagoriesModel::all();
        return view('SeaarchSavingAmount',compact('Catagories'));
    }
    function searchSaveCostIndex(){
        $Catagories=CatagoriesModel::all();
        return view('SearchCostAmount',compact('Catagories'));
    }

    // function SearchByMonth(Request $request){
    //     // $fromYear=$request->input('fromYear');

    //     $fromDate=$request->input('fromDate');
    //     $toDate=$request->input('toDate');
    //     // $catagories=$request->input('catagories');

    //     $result=['fromDate'=>$fromDate,'toDate'=>$toDate];
    //     return $result;
    // }

    // function SearchByMonth(Request $request){
    //     $fromYear=$request->input('fromYear');

    //     $fromDate=$request->input('fromDate');
    //     $toDate=$request->input('toDate');
    //     $catagories=$request->input('catagories');

    //     $result=AccountsDetailsModel::whereBetween('month',[$fromDate,$toDate])->where('year','=',$fromYear)->whrer('catagoriName','=',$catagories)->get();
    //     return $result;
    // }

    function SearchByMonth( $catagories,$fromDate,$toDate,$fromYear){

        $result=AccountsDetailsModel::whereBetween('month',[$fromDate,$toDate])->where('year','=',$fromYear)->where('catagories','=',$catagories)->get();
        $tk=AccountsDetailsModel::whereBetween('month',[$fromDate,$toDate])->where('year','=',$fromYear)->where('catagories','=',$catagories)->sum('price');
        return ['result'=>$result,'tk'=>$tk];
    }

    function SearchByMonthCostAmount( $catagories,$fromDate,$toDate,$fromYear){

        $result=CostAmountModel::whereBetween('month',[$fromDate,$toDate])->where('year','=',$fromYear)->where('catagories','=',$catagories)->get();
        $tk=CostAmountModel::whereBetween('month',[$fromDate,$toDate])->where('year','=',$fromYear)->where('catagories','=',$catagories)->sum('price');
        return ['result'=>$result,'tk'=>$tk];
    }
}
