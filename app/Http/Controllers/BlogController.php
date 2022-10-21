<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    function BlogPage(){
        return view('Blog');
    }
    function BlogListData(){
        $result= Blog::orderBy('id','desc')->get();
        return $result;
    }
    function BlogAdd(Request $request){
        $name=$request->input('name');
        $details=$request->input('details');

        $filePath=$request->file('image')->store('public');
        $fileName=explode("/", $filePath)[1];

        $image="http://".$_SERVER['HTTP_HOST']."/storage/".$fileName;


        $result=Blog::insert([

            'imageName'=>$image,
            'name'=>$name,
            'details'=>$details,


        ]);
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }

    function BlogDelete(Request $request){
        $id=$request->input('id');
        $imageURL=$request->input('imageURL');

        $OldPhotoURLArray= explode("/", $imageURL);
        $OldPhotoName=end($OldPhotoURLArray);

        $result=Blog::where('id','=',$id)->delete();
        Storage::delete('public/'.$OldPhotoName);
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }

    function BlogListEditData(Request $request){
        $id=$request->input('id');
        $result=Blog::where('id','=',$id)->get();
        return $result;
    }

    function BlogDataEdit(Request $request){

        $id=$request->input('id');

        $name_edit=$request->input('name_edit');
        $details_edit=$request->input('details_edit');

        $result=Blog::where('id',$id)->update([
            'name'=>$name_edit,

            'details'=>$details_edit,

        ]);
        return $result;
    }

    function ChangeBlogImage(Request $request){

        $OldPhotoURL=$request->input('oldImage');
        $OldPhotoID=$request->input('ImageID');

        $OldPhotoURLArray= explode("/", $OldPhotoURL);
        $OldPhotoName=end($OldPhotoURLArray);


        $NewPhotoPath=$request->file('newImage')->store('public');
        $NewPhotoName=explode("/", $NewPhotoPath)[1];
        $NewPhotoURL="http://".$_SERVER['HTTP_HOST']."/storage/".$NewPhotoName;
        $UpdateResult= Blog::where('id','=',$OldPhotoID)->update(['imageName'=>$NewPhotoURL]);
        $DeleteResult= Storage::delete('public/'.$OldPhotoName);

        return $UpdateResult;
    }
}
