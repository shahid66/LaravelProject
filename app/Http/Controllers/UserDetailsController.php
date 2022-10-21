<?php

namespace App\Http\Controllers;

use App\Models\adminModel;
use App\Models\PriceColuctionModel;
use Illuminate\Http\Request;

class UserDetailsController extends Controller
{
    public function UserDetailsIndex( $id){

        // $day=[1,2,3];
        $result= adminModel::where('id',$id)->get();
        return view('UserDetails',['result'=>$result]);
    }
    public function UserPaymentInsert(Request $req){

        $userID=$req->input('userID');
        $day=$req->input('day');
        $month=$req->input('month');
        $year=$req->input('year');
        $amount=$req->input('amount');
        $result=PriceColuctionModel::insert(['userId'=>$userID,'month'=>$month,'year'=>$year,'date'=>$day,'price'=>$amount]);
        if($result){
            return 1;
        }else{
            return 0;
        }

    }
    public function UserDetailsDataList( $id){

        // $day=[1,2,3];
        $datalist= PriceColuctionModel::where('userID',$id)->get();
        $total= PriceColuctionModel::where('userID',$id)->sum('price');
        return [$datalist,$total];
    }
    function PaymentListDelete(Request $request){
        $id=$request->input('id');
        $result=PriceColuctionModel::where('id','=',$id)->delete();
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }
}
