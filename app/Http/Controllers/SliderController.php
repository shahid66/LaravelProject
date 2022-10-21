<?php

namespace App\Http\Controllers;

use App\Models\Committee;

use App\Models\SliderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class SliderController extends Controller
{
    function SliderListPage(){
        return view('Slider');
    }

    function SliderListData(){
        $result= SliderModel::orderBy('id','desc')->get();
        return $result;
    }




    function SliderAdd(Request $request){
        $filePath=$request->file('image')->store('public');
        $fileName=explode("/", $filePath)[1];

        $image="http://".$_SERVER['HTTP_HOST']."/storage/".$fileName;


        $result=SliderModel::insert([

            'imageName'=>$image,

        ]);
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }

    function SliderDelete(Request $request){
        $id=$request->input('id');
        $imageURL=$request->input('imageURL');

        $OldPhotoURLArray= explode("/", $imageURL);
        $OldPhotoName=end($OldPhotoURLArray);

        $result=SliderModel::where('id','=',$id)->delete();
        Storage::delete('public/'.$OldPhotoName);
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }
    function ChangeSliderImage(Request $request){

        $OldPhotoURL=$request->input('oldImage');
        $OldPhotoID=$request->input('ImageID');

        $OldPhotoURLArray= explode("/", $OldPhotoURL);
        $OldPhotoName=end($OldPhotoURLArray);


        $NewPhotoPath=$request->file('newImage')->store('public');
        $NewPhotoName=explode("/", $NewPhotoPath)[1];
        $NewPhotoURL="http://".$_SERVER['HTTP_HOST']."/storage/".$NewPhotoName;
        $UpdateResult= SliderModel::where('id','=',$OldPhotoID)->update(['imageName'=>$NewPhotoURL]);
        $DeleteResult= Storage::delete('public/'.$OldPhotoName);

        return $UpdateResult;
    }

    function CommitteeListPage(){
        return view('Committee');
    }

    function CommitteeListData(){
        $result= Committee::orderBy('id','desc')->get();
        return $result;
    }




    function CommitteeAdd(Request $request){
        $name=$request->input('name');
        $title=$request->input('title');
        $phone=$request->input('phone');
        $filePath=$request->file('image')->store('public');
        $fileName=explode("/", $filePath)[1];

        $image="http://".$_SERVER['HTTP_HOST']."/storage/app/public/".$fileName;


        $result=Committee::insert([

            'imageName'=>$image,
            'name'=>$name,
            'title'=>$title,
            'phone'=>$phone,

        ]);
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }

    function CommitteeDelete(Request $request){
        $id=$request->input('id');
        $imageURL=$request->input('imageURL');

        $OldPhotoURLArray= explode("/", $imageURL);
        $OldPhotoName=end($OldPhotoURLArray);

        $result=Committee::where('id','=',$id)->delete();
        Storage::delete('public/'.$OldPhotoName);
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }
    function ChangeCommitteeImage(Request $request){

        $OldPhotoURL=$request->input('oldImage');
        $OldPhotoID=$request->input('ImageID');

        $OldPhotoURLArray= explode("/", $OldPhotoURL);
        $OldPhotoName=end($OldPhotoURLArray);


        $NewPhotoPath=$request->file('newImage')->store('public');
        $NewPhotoName=explode("/", $NewPhotoPath)[1];
        $NewPhotoURL="http://".$_SERVER['HTTP_HOST']."/storage/".$NewPhotoName;
        $UpdateResult= SliderModel::where('id','=',$OldPhotoID)->update(['imageName'=>$NewPhotoURL]);
        $DeleteResult= Storage::delete('public/'.$OldPhotoName);

        return $UpdateResult;
    }


}
