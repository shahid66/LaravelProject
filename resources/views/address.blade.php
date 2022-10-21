@extends('Layout.app')
@section('content')
    {{-- @include('Component.LoadingDiv') --}}
    @include('Component.WentWrongDiv')
    @include('Component.RichTextEditorForSiteInfo')
    <div id="MainDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 data-table-card col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div id="">
                        <h4 id="SiteAddress"></h4>
                        <h4 id="SiteEmail"></h4>
                        <h4 id="SiteNumber"></h4>
                        </div>
                        <div>
                            <button id="SiteInfoChange"  class="btn btn-dark"><i class="fa fa-edit"></i> Change  </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#SiteInfoChange').on('click',function () {
            $('#SiteInfoUpdateModal').modal('show');
            let SiteInfoHtml=$('#SiteInfoText').html();
            $('#SummerNoteArea').summernote("code", SiteInfoHtml);
            $('#siteInfoCloumnName').val('address');
        })



        GetSiteInfo();
        function GetSiteInfo(){
            let URL="/GetSiteInfoDetails"
            axios.get(URL).then(function (response){
                if(response.status==200) {
                    $('#LoadingDiv').addClass('d-none');
                    $('#MainDiv').removeClass('d-none')
                    let SiteAddress=(response.data)[0]['address'];
                    let SiteEmail=(response.data)[0]['email'];
                    let SiteNumber=(response.data)[0]['phone'];
                    $('#SiteAddress').html(SiteAddress)
                    $('#SiteEmail').html(SiteEmail)
                    $('#SiteNumber').html(SiteNumber)
                }
                else{
                    $('#LoadingDiv').addClass('d-none')
                    $('#WentWrongDiv').removeClass('d-none')
                }
            }).catch(function (error) {
                $('#LoadingDiv').addClass('d-none')
                // $('#WentWrongDiv').removeClass('d-none')
            });

        }
    </script>

@endsection



