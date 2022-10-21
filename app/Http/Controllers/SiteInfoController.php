<?php

namespace App\Http\Controllers;

use App\Models\OthersInfoModel;
use App\Models\SiteInfoModel;
use Illuminate\Http\Request;

class SiteInfoController extends Controller
{



    function AddressPage(){
        return view('address');
    }



    function GetSiteInfoDetails(){
       $result= SiteInfoModel::get();
       return $result;
    }

    function UpdateSiteInfo(Request $request){
        $address=$request->input('address');
        $email=$request->input('email');
        $phone=$request->input('phone');
        $result= SiteInfoModel::where('id','=',1)->update(['address'=>$address,'email'=>$email,'phone'=>$phone]);
        return $result;
    }


    function GetOthersSiteInfoDetails(){
        $result= OthersInfoModel::get();
        return $result;
     }

     function GetOthersSiteInfoIndex(){
        return view('Others');
    }



     function GetOthersSiteInfoDetailsAdd(Request $request){

        $aboutMosque = $request->input('aboutMosque');
        $fbLink =$request->input('fbLink');
        $InstaLink =$request->input('InstaLink');
        $youtubeLink =$request->input('youtubeLink');
        $savingAddress =$request->input('savingAddress');


        $result= OthersInfoModel::insert([
            'aboutMosque'=>$aboutMosque,
            'fb_link'=> $fbLink,
            'insta_link'=>$InstaLink,
            'youtube_link'=>$youtubeLink,
            'savingAddress'=>$savingAddress,

        ]);
        return $result;
    }

    function GetOtherOnesEdit(Request $request){
        $id=$request->input('id');
        $result=OthersInfoModel::where('id','=',$id)->get();
        return $result;
    }

    function GetOtherOnesEditConfirm(Request $request){
        $id=$request->input('id');
        $edit_aboutMosque=$request->input('edit_aboutMosque');
        $edit_fbLink=$request->input('edit_fbLink');
        $edit_InstaLink=$request->input('edit_InstaLink');
        $edit_youtubeLink=$request->input('edit_youtubeLink');
        $edit_savingAddress=$request->input('edit_savingAddress');
        $result=OthersInfoModel::where('id','=',$id)->update([

            'aboutMosque'=>$edit_aboutMosque,
            'fb_link'=> $edit_fbLink,
            'insta_link'=>$edit_InstaLink,
            'youtube_link'=>$edit_youtubeLink,
            'savingAddress'=>$edit_savingAddress,
        ]);

        return $result;

    }
}
