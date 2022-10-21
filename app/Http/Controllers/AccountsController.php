<?php

namespace App\Http\Controllers;

use App\Models\AccountsDetailsModel;
use App\Models\CatagoriesModel;
use App\Models\CostAmountModel;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    function CatagoriesList(){
        $Catagories=CatagoriesModel::all();
        return $Catagories;
    }
    function AccountPage(){
        $Catagories=CatagoriesModel::all();
        $SaveAmountTotal=AccountsDetailsModel::sum('price');
        $CostAmountTotal=CostAmountModel::sum('price');
        $available=$SaveAmountTotal-$CostAmountTotal;
        return view('Accounts',compact('Catagories','SaveAmountTotal','CostAmountTotal','available'));
    }
    function SaveAmountList( ){
        $result=AccountsDetailsModel::all();
        return $result;
    }
    function CostAmountList( ){
        $result=CostAmountModel::all();
        return $result;
    }

    function SaveAmountAdd(Request $request){

        $CatagoriesID = $request->input('CatagoriesID');
        $day =$request->input('day');
        $month =$request->input('month');
        $year =$request->input('year');
        $SaveAmount =$request->input('SaveAmount');
        $Comments =$request->input('Comments');

        $result= AccountsDetailsModel::insert([
            'catagories'=>$CatagoriesID,
            'day'=> $day,
            'month'=>$month,
            'year'=>$year,
            'price'=>$SaveAmount,
            'comments'=>$Comments,

        ]);
        return $result;
    }
    function SaveAmountListDelete(Request $request){
        $id=$request->input('id');
        $result=AccountsDetailsModel::where('id','=',$id)->delete();
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }

    function CostAmountAdd(Request $request){

        $CatagoriesID = $request->input('CatagoriesID');
        $day =$request->input('day');
        $month =$request->input('month');
        $year =$request->input('year');
        $CostAmount =$request->input('CostAmount');
        $Comments =$request->input('Comments');

        $result= CostAmountModel::insert([
            'catagories'=>$CatagoriesID,
            'day'=> $day,
            'month'=>$month,
            'year'=>$year,
            'price'=>$CostAmount,
            'comments'=>$Comments,

        ]);
        return $result;
    }
    function CostAmountListDelete(Request $request){
        $id=$request->input('id');
        $result=CostAmountModel::where('id','=',$id)->delete();
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }


    function CatagoriestAdd(Request $request){

        $CatagoriesID = $request->input('catagoriesName');


        $result= CatagoriesModel::insert([
            'catagoriName'=>$CatagoriesID,


        ]);
        return $result;
    }

    function CatagoriesListDelete(Request $request){
        $id=$request->input('id');
        $cat=$request->input('cat');
        $checkSavingAmount=AccountsDetailsModel::where('catagories','=',$cat)->count();
        $checkCostAmount=CostAmountModel::where('catagories','=',$cat)->count();
        if($checkSavingAmount==0 && $checkCostAmount==0){
            $result=CatagoriesModel::where('id','=',$id)->delete();
            if ($result==true){
                return 1;
            }
            else{
                return 0;
            }
        }else{
            return 0;
        }
    }
}
