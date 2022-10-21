@extends('Layout.app')
@section('content')
    {{-- @include('Component.LoadingDiv') --}}
    @include('Component.WentWrongDiv')



    <div id="MainDiv" class="container-fluid ">
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <button data-toggle="modal" data-target="#AddVideoModal" class="btn mt-2 btn-dark">Add New</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="VideoDataTable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Url</th>
                                <th>Thumbline</th>
                                <th>Title</th>
                                <th>status</th>

                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="VideoDataTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal animat animate__fadeIn" id="AddVideoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Add New Video</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <label for="exampleInputEmail1">URL</label>
                    <input id="url" placeholder="url" type="text" class="form-control mt-2">
                    <label for="exampleInputEmail1">Title</label>
                    <input id="title" placeholder="title" type="text" class="form-control mt-2">
                    <label for="exampleInputEmail1">Status</label>
                    <select id="status" class="form-control mt-2">
                        <option value="0">Unpin</option>
                        <option value="1">Pin</option>
                    </select>

                    <label>Slider Image</label>
                    <input id="image" class="form-control" type="file">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    <button id="VideoAddConfirmBtn" type="button" class="btn btn-dark">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title" id="exampleModalLabel">Slider Data Edit</p>
                    <span id="DataID"></span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-12">
                                <label>Title</label>
                                <input id="title_edit" class="form-control" type="text">
                            </div>
                            <div class="col-md-4 col-sm-12 col-12">
                                <label>Sub Title</label>
                                <input id="sub_title_edit" class="form-control" type="text">
                            </div>
                            <div class="col-md-4 col-sm-12 col-12">
                                <label>Product Code</label>
                                <input readonly id="product_code_edit" class="form-control" type="text">
                            </div>
                            <div class="col-md-4 col-sm-12 col-12">
                                <label>Text Color</label>
                                <input id="text_color_edit" class="form-control" type="color">
                            </div>
                            <div class="col-md-4 col-sm-12 col-12">
                                <label>Background Color</label>
                                <input id="bg_color_edit" class="form-control" type="color">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="" type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <button id="DataEditBtn" type="button" class="btn btn-dark">Edit</button>
                </div>
            </div>
        </div>
    </div>

    @include('Component.DeleteModal')
    @include('Component.ChangeImageModal')


@endsection

@section('script')
    <script>
DataList()
var  ActionSpinnerBtn="<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing..";

        function DataList(){
            let URL="/VideoDataList";
            axios.get(URL).then(function (response) {
                if(response.status==200){
                    $('#LoadingDiv').addClass('d-none');
                    $('#MainDiv').removeClass('d-none')
                    $('#VideoDataTable').DataTable().destroy();
                    $('#VideoDataTableBody').empty();
                    $.each(response.data,function (i,item){
                        let tableRow="<tr>" +
                            "<td>"+item['url']+"</td>" +
                            "<td><img style='height: 50px;width: 50px;' src='"+item['thumbline']+"'></td>" +
                            "<td>"+item['title']+"</td>" +
                            "<td>"+item['status']+"</td>" +


                            "<td>" +
                            "<div class='dropdown'>" +
                            "<button class='btn btn-sm btn-dark  dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-cog'></i></button>" +
                            "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>" +
                            "<a class='dropdown-item deleteItem' data-id="+item['id']+" href='#'>Delete</a>"+
                            "</div>" +
                            "</div>" +
                            "</td>" +
                            "</tr>";
                        $('#VideoDataTableBody').append(tableRow);
                    });

                    $('.deleteItem').on('click',function () {
                        let id=$(this).data('id');
                        $('#DeleteID').html(id);
                        $('#DeleteModal').modal('show');
                    })

                    $('#VideoDataTable').DataTable({
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



        $('#VideoAddConfirmBtn').on('click',function () {


let url= $('#url').val();
let title= $('#title').val();
let status=  $('#status').val();

let image=$('#image').prop('files');


if(url.length==0){
    ErrorToast("url Required");
}

else if(title.length==0){
    ErrorToast("title Required");
}

else if(status.length==0){
    ErrorToast("status Required");
}


else if(image.length==0){
    ErrorToast("image Required");
}

else{
                $('#VideoAddConfirmBtn').html(ActionSpinnerBtn);
                let ConfirmBtn=$(this);
                ConfirmBtn.prop("disabled", true);

                let UploadFormData=new FormData();
                UploadFormData.append('url',url);
                UploadFormData.append('title',title);
                UploadFormData.append('status',status);



                UploadFormData.append('image',image[0]);
                let URL="/VideoAdd";
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

                        $('#image').val("");
                        $('#url').val("");
                        $('#title').val("");
                        $('#status').val("");



                        $('#AddVideoModal').modal('hide');
                        location.reload();
                        DataList();

                    }
                    else{
                        ErrorToast("Failed ! Please Try Again");
                    }

                }).catch(function (error){
                    alert(error)
                    ErrorToast("Something went wrong !");
                });
            }
})

$('#DeleteConfirm').click(function (event) {
            let id= $('#DeleteID').html();

            let DeleteBtn=$('#DeleteConfirm');
            VideoListDelete(id,DeleteBtn);
        });

        function VideoListDelete(deleteID,DeleteBtn){

            DeleteBtn.html(ActionSpinnerBtn);

            let URL="/VideoDelete";
            let AxiosConfig = { headers: { 'Content-Type': 'application/json' } };
            let blankData=" ";
            axios.post(URL,{id:deleteID},AxiosConfig).then(function (response) {

                DeleteBtn.html("Yes");

                if (response.data===1) {
                    $('#DeleteConfirm').attr('data-id',blankData);
                    $('#DeleteModal').modal('hide');
                    toastr.success("Deleted !");
                    DataList();
                }
                else {
                    $('#DeleteModal').modal('hide');
                    toastr.error("Failed ! Please Try Again");
                }

            }).catch(function (error) {
                DeleteBtn.html("Yes");
                $('#DeleteModal').modal('hide');
                toastr.error("Something Went Wrong");
            });
        }




    </script>
@endsection
