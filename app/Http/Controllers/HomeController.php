<?php

namespace App\Http\Controllers;

use App\Models\AccountsDetailsModel;
use App\Models\AdminLoginModel;
use App\Models\adminModel;
use App\Models\Blog;
use App\Models\Committee;
use App\Models\contactModel;
use App\Models\CostAmountModel;
use App\Models\CustomOrderModel;
use App\Models\notificationModel;
use App\Models\ProductOrderModel;
use App\Models\VideoModel;
use App\Models\visitorModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function HomePage(){
        return view('index');
    }

    function HomeSummary(){
        $TotalCost=CostAmountModel::sum('price');
        $TotalUser=adminModel::count();
        $TotalBlog=Blog::count();
        $TotalVideo=VideoModel::count();
        $TotalVisitor=visitorModel::count();
        $TotalCommetteMembers=Committee::count();
        $TotalSave=AccountsDetailsModel::sum('price');
        $AvailableTk=$TotalSave-$TotalCost;
        // $TotalOrder=ProductOrderModel::count();
        // $TotalPendingOrder=ProductOrderModel::where('order_status',$pending)->count();

        $SummaryArray=[
            'TotalUser'=>$TotalUser,
            'TotalBlog'=>$TotalBlog,
            'TotalVideo'=>$TotalVideo,
            'TotalVisitor'=>$TotalVisitor,
            'TotalCommetteMembers'=>$TotalCommetteMembers,
            'TotalSave'=>$TotalSave,
            'TotalCost'=>$TotalCost,
            'AvailableTk'=>$AvailableTk,

        ];

        return json_encode($SummaryArray);
    }
}
