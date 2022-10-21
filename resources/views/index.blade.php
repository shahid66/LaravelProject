@extends('Layout.app')
@section('content')
    <div class="container ">
        <div class="row ">

            <div class="col-md-3 p-1 col-sm-6 col-6 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-light"><i class="fa fa-chart-bar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Visitor</span>
                        <span id="SummaryVisitorTotal" class="info-box-number">10<small>%</small></span>
                    </div>
                </div>
            </div>


            <div class="col-md-3 p-1 col-sm-6 col-6 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-light"><i class="fas fa-video"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Video  </span>
                        <span id="SummaryTotalVideo"  class="info-box-number">10<small>%</small></span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 p-1 col-sm-6 col-6 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-light"><i class="fas fa-rss-square"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Blog </span>
                        <span id="SummaryContactTotal" class="info-box-number">10<small>%</small></span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 p-1 col-sm-6 col-6 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-light"><i class="fa fa-user-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total USER</span>
                        <span id="SummaryAdminTotal" class="info-box-number">10<small>%</small></span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 p-1 col-sm-6 col-6 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-light"><i class="fas fa-dollar-sign"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Cost Amount</span>
                        <span id="SummaryPendingOrder" class="info-box-number text-danger">00<small>%</small></span>
                        <a href="{{ url('searchSaveCostIndex') }}">Search</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 p-1 col-sm-6 col-6 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-light"><i class="fas fa-dollar-sign"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Save Amount</span>
                        <span  class="info-box-number"><span id="SummaryTotalOrder"></span> TK</span>
                        <a href="{{ url('searchSaveAmountIndex') }}">Search</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 p-1 col-sm-6 col-6 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-light"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Committee Members</span>
                        <span id="SummaryTotalCustomOrder" class="info-box-number">10<small>%</small></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 p-1 col-sm-6 col-6 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-light"><i class="fas fa-dollar-sign" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Available TK</span>
                        <span id="SummaryTotalAvailable" class="info-box-number">10<small>%</small></span>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')


    <script type="text/javascript">
        getHomeSummary();
        function getHomeSummary() {
            let  SummaryVisitorTotal= $('#SummaryVisitorTotal');
            let  SummaryContactTotal= $('#SummaryContactTotal');
            let  SummaryTotalVideo=$('#SummaryTotalVideo');
            let  SummaryAdminTotal= $('#SummaryAdminTotal');
            let  SummaryPendingOrder= $('#SummaryPendingOrder');
            let  SummaryTotalOrder= $('#SummaryTotalOrder');
            let  SummaryTotalCustomOrder= $('#SummaryTotalCustomOrder');
            let  SummaryTotalAvailable= $('#SummaryTotalAvailable');

            SummaryVisitorTotal.html(BtnSpinner);
            SummaryContactTotal.html(BtnSpinner);
            SummaryTotalVideo.html(BtnSpinner);
            SummaryAdminTotal.html(BtnSpinner);

            let URL="/HomeSummary";
            axios.get(URL).then(function (response) {

                if(response.status==200){
                    SummaryVisitorTotal.html((response.data)['TotalVisitor']);
                    SummaryContactTotal.html((response.data)['TotalBlog']);
                    SummaryTotalVideo.html((response.data)['TotalVideo']);
                    SummaryAdminTotal.html((response.data)['TotalUser']);
                    SummaryPendingOrder.html((response.data)['TotalCost']);
                    SummaryTotalOrder.html((response.data)['TotalSave']);
                    SummaryTotalCustomOrder.html((response.data)['TotalCommetteMembers']);
                    SummaryTotalAvailable.html((response.data)['AvailableTk']);
                }
                else{
                    SummaryVisitorTotal.html("....");
                    SummaryContactTotal.html("....");
                    SummaryTotalVideo.html("....");
                    SummaryAdminTotal.html("....");
                    SummaryPendingOrder.html("....");
                    SummaryTotalOrder.html("....");
                    SummaryTotalCustomOrder.html("....");
                    SummaryTotalAvailable.html("....");
                }
            }).catch(function (error) {
                SummaryVisitorTotal.html("....");
                SummaryContactTotal.html("....");
                SummaryTotalVideo.html("....");
                SummaryAdminTotal.html("....");
                SummaryPendingOrder.html("....");
                SummaryTotalOrder.html("....");
                SummaryTotalCustomOrder.html("....");
                SummaryTotalAvailable.html("....");
            })
        }
    </script>
@endsection
