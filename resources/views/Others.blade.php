@extends('Layout.app')
@section('content')

    @include('Component.WentWrongDiv')
    @include('Component.RichTextEditorForSiteInfo')
    <div id="MainDiv" class="container ">
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <button data-toggle="modal" data-target="#OtherModal" class="btn mt-2 btn-dark">Add New</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12  col-lg-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <table id="OtherDataTable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>About Mosque</th>
                                <th>FB Link</th>
                                <th>Insta Link</th>
                                <th>Youtube Link</th>
                                <th>AmountCollect</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody id="OtherDataTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal animat animate__fadeIn" id="OtherModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Add Other Info</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <label for="exampleInputEmail1">About Mosque</label>
                    <input id="aboutMosque"  type="text" class="form-control mt-2">

                    <label for="exampleInputEmail1">FB Link</label>
                    <input id="fbLink"  type="text" class="form-control mt-2">

                    <label for="exampleInputEmail1">Insta Link</label>
                    <input id="InstaLink"  type="text" class="form-control mt-2">

                    <label for="exampleInputEmail1">Youtube Link</label>
                    <input id="youtubeLink"  type="text" class="form-control mt-2">

                    <label for="exampleInputEmail1">Saving Address</label>
                    <input id="savingAddress"  type="text" class="form-control mt-2">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    <button id="AddOthersBtn" type="button" class="btn btn-dark">Confirm</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal animat animate__fadeIn" id="OtherEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Add Other Info</h6>
                    <span id="DataID"></span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <label for="exampleInputEmail1">About Mosque</label>
                    <input id="edit_aboutMosque"  type="text" class="form-control mt-2">

                    <label for="exampleInputEmail1">FB Link</label>
                    <input id="edit_fbLink"  type="text" class="form-control mt-2">

                    <label for="exampleInputEmail1">Insta Link</label>
                    <input id="edit_InstaLink"  type="text" class="form-control mt-2">

                    <label for="exampleInputEmail1">Youtube Link</label>
                    <input id="edit_youtubeLink"  type="text" class="form-control mt-2">

                    <label for="exampleInputEmail1">Saving Address</label>
                    <input id="edit_savingAddress"  type="text" class="form-control mt-2">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    <button id="EditOthersBtn" type="button" class="btn btn-dark">Confirm</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

DataList()
        var  ActionSpinnerBtn="<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing..";

function DataList(){
    let URL="/GetOthersSiteInfoDetails";
    axios.get(URL).then(function (response) {
        if(response.status==200){
            $('#LoadingDiv').addClass('d-none');
            $('#MainDiv').removeClass('d-none')
            $('#OtherDataTable').DataTable().destroy();
            $('#OtherDataTableBody').empty();
            $.each(response.data,function (i,item){
                let tableRow="<tr>" +
                    "<td>"+item['aboutMosque']+"</td>" +
                    "<td>"+item['fb_link']+"</td>" +
                    "<td>"+item['insta_link']+"</td>" +
                    "<td>"+item['youtube_link']+"</td>" +
                    "<td>"+item['savingAddress']+"</td>" +


                    "<td>" +
                    "<div class='dropdown'>" +
                    "<button class='btn btn-sm btn-dark  dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-cog'></i></button>" +
                    "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>" +
                    "<a class='dropdown-item changedata' data-id="+item['id']+" href='#'>Edit Data</a>"+
                    "<a class='dropdown-item deleteItem' data-id="+item['id']+" href='#'>Delete</a>"+
                    "</div>" +
                    "</div>" +
                    "</td>" +
                    "</tr>";
                $('#OtherDataTableBody').append(tableRow);
            });

            $('.deleteItem').on('click',function () {
                let id=$(this).data('id');
                $('#DeleteID').html(id);
                $('#DeleteModal').modal('show');
            })

            $('.changedata').on('click',function () {
                        let id=$(this).data('id');
                        $('#DataID').html(id);
                        GetOtherEditData(id);
                    })

            $('#OtherDataTable').DataTable({
                "order":false,
                "lengthMenu": [5, 10, 20, 50]
            });
            $('.dataTables_length').addClass('bs-select');


        }
        else{
            $('#LoadingDiv').addClass('d-none')
            $('#WentWrongDiv').removeClass('d-none')
        }

    }).catch(function (error) {
        $('#LoadingDiv').addClass('d-none')

    });
}


$('#AddOthersBtn').on('click',function () {


let aboutMosque= $('#aboutMosque').val();
let fbLink= $('#fbLink').val();
let InstaLink=  $('#InstaLink').val();
let youtubeLink=  $('#youtubeLink').val();
let savingAddress=  $('#savingAddress').val();



if(aboutMosque.length==0){
    ErrorToast("about Required");
}

else if(fbLink.length==0){
    ErrorToast("fb link Required");
}

else if(InstaLink.length==0){
    ErrorToast("Insta link Required");
}


else if(youtubeLink.length==0){
    ErrorToast("Youtube link Required");
}
else if(savingAddress.length==0){
    ErrorToast("Saving Address Required");
}




else {

    let URL="/GetOthersSiteInfoDetailsAdd";
    let MyFormData=new FormData();
    MyFormData.append('aboutMosque',aboutMosque);
    MyFormData.append('fbLink',fbLink)
    MyFormData.append('InstaLink',InstaLink)
    MyFormData.append('youtubeLink',youtubeLink)
    MyFormData.append('savingAddress',savingAddress)



    $('#AddSaveAmountBtn').html(BtnSpinner).prop("disabled", true);
    axios.post(URL,MyFormData).then(function (response) {
        $('#AddOthersBtn').html("Confirm").prop("disabled", false);
        if(response.status==200 && response.data==1){
            SuccessToast("Request Success");
            $('#OtherModal').modal('hide');
            setTimeout(function() {
                location.reload();
            }, 3000);
        }
        else{
            ErrorToast("Request Fail ! Try Again");
        }

    }).catch(function (error) {
        $('#AddOthersBtn').html("Confirm").prop("disabled", false);
        ErrorToast("Request Fail ! Try Again");
    });
}
})


// edit

function GetOtherEditData(idDetails){

let URL="/GetOtherOnesEdit";
let AxiosConfig = { headers: { 'Content-Type': 'application/json' } };
axios.post(URL,{id:idDetails},AxiosConfig).then(function (response) {

    if (response.status===200) {
        $('#OtherEditModal').modal('show');
        let EditData=response.data;

        $('#edit_aboutMosque').val(EditData[0]['aboutMosque']);
        $('#edit_fbLink').val(EditData[0]['fb_link']);
        $('#edit_InstaLink').val(EditData[0]['insta_link']);
        $('#edit_youtubeLink').val(EditData[0]['youtube_link']);
        $('#edit_savingAddress').val(EditData[0]['savingAddress']);
    }
    else {
        $('#OtherEditModal').modal('hide');
        ErrorToast("Something went wrong !");
    }

}).catch(function (error) {
    $('#CatEditModal').modal('hide');
    ErrorToast("Something went wrong !");
});
}


$('#EditOthersBtn').on('click',function (){
            let id= $('#DataID').html();
            let edit_aboutMosque= $('#edit_aboutMosque').val();
            let edit_fbLink= $('#edit_fbLink').val();
            let edit_InstaLink= $('#edit_InstaLink').val();
            let edit_youtubeLink= $('#edit_youtubeLink').val();
            let edit_savingAddress= $('#edit_savingAddress').val();
            if(edit_aboutMosque.length===0){
                ErrorToast("About Required");
            }
            else if(edit_fbLink.length===0){
                ErrorToast("Fb link Required!");
            }
            else if(edit_InstaLink.length===0){
                ErrorToast("Insta linkduct Code Required!");
            }
            else if(edit_youtubeLink.length===0){
                ErrorToast("Youtube link Required!");
            }
            else if(edit_savingAddress.length===0){
                ErrorToast("Saving Address Required!");
            }
            else{
                $('#EditOthersBtn').html(ActionSpinnerBtn);
                let ConfirmBtn=$(this);
                ConfirmBtn.prop("disabled", true);

                let UploadFormData=new FormData();
                UploadFormData.append('id',id);
                UploadFormData.append('edit_aboutMosque',edit_aboutMosque);
                UploadFormData.append('edit_fbLink',edit_fbLink)
                UploadFormData.append('edit_InstaLink',edit_InstaLink)
                UploadFormData.append('edit_youtubeLink',edit_youtubeLink)
                UploadFormData.append('edit_savingAddress',edit_savingAddress)
                let URL="/GetOtherOnesEditConfirm";
                let AxiosHeaderConfig = {
                    headers: { 'Content-Type': 'multipart/form-data' },
                    onUploadProgress:function (progressEvent) {
                        let UpPer= ((progressEvent.loaded*100)/progressEvent.total).toFixed(2) +" %";
                        ConfirmBtn.html(UpPer +"Please Wait..");
                    }
                };
                axios.post(URL,UploadFormData,AxiosHeaderConfig).then(function (response){

                    ConfirmBtn.html("CONFIRM & SAVE");
                    ConfirmBtn.prop("disabled", false);

                    if(response.status==200){
                        SuccessToast("Request Success");
                        $('#OtherEditModal').modal('hide');
                        DataList();

                    }
                    else{
                        ErrorToast("Failed ! Please Try Again");
                    }

                }).catch(function (error){
                    ErrorToast("Something went wrong !");
                });
            }
        })
    </script>

@endsection



