@extends('Layout.app')
@section('content')
    @include('Component.LoadingDiv')
    @include('Component.WentWrongDiv')



    <div id="MainDiv" class="container-fluid d-none">
        @include('Component.addNewBtn')
        <div class="row">
            <div class="col-md-12 data-table-card col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <table id="NamajDataTable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>

                                <th>Name</th>
                                <th>Azan Time</th>
                                <th>Time</th>



                            </tr>
                            </thead>
                            <tbody id="NamajDataTableBody">
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="AddNewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title" id="exampleModalLabel">Add New Namaj Time</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">



                            <div class="col-md-4 col-sm-12 col-12">
                                <label>Namaj</label>
                                <input id="namaj" class="form-control" type="text">
                            </div>

                            <div class="col-md-4 col-sm-12 col-12">
                                <label>Azan Time</label>
                                <input id="azan_time" class="form-control" type="text">
                            </div>

                            <div class="col-md-4 col-sm-12 col-12">
                                <label>Time</label>
                                <input id="time" class="form-control" type="text">
                            </div>


                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="ModalCloseBtn" type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <button id="AddNamajTimeBtn" type="button" class="btn btn-dark">Add</button>
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

        DataList();



        var  ActionSpinnerBtn="<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing..";

        function DataList(){
            let URL="/NamajListData";
            axios.get(URL).then(function (response) {
                console.log(response)
                if(response.status===200){
                    $('#LoadingDiv').addClass('d-none');

                    $('#MainDiv').removeClass('d-none');
                    $('#NamajDataTable').DataTable().destroy();
                    $('#NamajDataTableBody').empty();
                    $.each(response.data,function (i,item){
                        let tableRow="<tr>" +
                            "<td>"+item['id']+"</td>" +

                            "<td><h4>"+item['namaj']+"</h4></td>" +

                            "<td><h4>"+item['azan_time']+"</h4></td>" +
                            "<td><h4>"+item['time']+"</h4></td>" +



                            "<td>" +
                            "<div class='dropdown'>" +
                            "<button class='btn btn-sm btn-dark  dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Dropdown button</button>" +
                            "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>" +
                            "<a class='dropdown-item deleteItem' data-id="+item['id']+" data-img="+item['imageName']+" href='#'>Delete</a>"+
                            // "<a class='dropdown-item changeImage' data-id="+item['id']+" data-img="+item['imageName']+" href='#'>Change Image</a>"+
                            // "<a class='dropdown-item changedata' data-id="+item['id']+" href='#'>Edit Data</a>"+
                            "</div>" +
                            "</div>" +
                            "</td>" +
                            "</tr>";
                        $('#NamajDataTableBody').append(tableRow);
                    });


                    $('.deleteItem').on('click',function () {
                        let id=$(this).data('id');
                        let img=$(this).data('img');
                        $('#DeleteID').html(id);
                        $('#imageURL').html(img);
                        $('#DeleteModal').modal('show');
                    })
                    $('.changeImage').on('click',function () {
                        let id=$(this).data('id');
                        let image=$(this).data('img');
                        $('#ImageID').html(id);
                        $('#imageChangeURL').attr('src',image);
                        $('#ChangeImageModal').modal('show');
                    })


                    $('#NamajDataTable').DataTable({
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
                // $('#WentWrongDiv').removeClass('d-none')

            });
        }




        $('#AddNamajTimeBtn').on('click',function (){


            let namaj= $('#namaj').val();
            let time= $('#time').val();
            let azan_time= $('#azan_time').val();


             if(namaj.length===0){
                ErrorToast("Slider Image Required!");
            }
            else if(time.length===0){
                ErrorToast("Time Required!");
            }
            else if(azan_time.length===0){
                ErrorToast("azan time Required!");
            }

            else{
                $('#AddNamajTimeBtn').html(ActionSpinnerBtn);
                let ConfirmBtn=$(this);
                ConfirmBtn.prop("disabled", true);

                let UploadFormData=new FormData();
                UploadFormData.append('namaj',namaj);
                UploadFormData.append('time',time);
                UploadFormData.append('azan_time',azan_time);




                let URL="/NamajAdd";
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


                        $('#namaj').val("");
                        $('#time').val("");


                        $('#AddNewModal').modal('hide');
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
            let imageURL= $('#imageURL').html();

            let DeleteBtn=$('#DeleteConfirm');
            NamajDelete(id,imageURL,DeleteBtn);
        });

        function NamajDelete(deleteID,imageURL,DeleteBtn){

            DeleteBtn.html(ActionSpinnerBtn);

            let URL="/NamajDelete";
            let AxiosConfig = { headers: { 'Content-Type': 'application/json' } };
            let blankData=" ";
            axios.post(URL,{id:deleteID,imageURL:imageURL},AxiosConfig).then(function (response) {

                DeleteBtn.html("Yes");

                if (response.data===1) {
                    $('#DeleteConfirm').attr('data-id',blankData);
                    $('#DeleteModal').modal('hide');
                    toastr.success("Deleted !");
                    location.reload();
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

        // $('#ChangeImageBtn').on('click',function (){
        //     let ImageID=$('#ImageID').html();
        //     let oldImage= $('#imageChangeURL').attr('src');
        //     let newImage=$('#newImage').prop('files');

        //     if(newImage.length===0){
        //         ErrorToast("New Image Required");
        //     }
        //     else{
        //         $('#ChangeImageBtn').html(ActionSpinnerBtn);
        //         let ConfirmBtn=$(this);
        //         ConfirmBtn.prop("disabled", true);

        //         let UploadFormData=new FormData();
        //         UploadFormData.append('ImageID',ImageID);
        //         UploadFormData.append('oldImage',oldImage);
        //         UploadFormData.append('newImage',newImage[0]);
        //         let URL="/ChangeCommitteeImage";
        //         let AxiosHeaderConfig = {
        //             headers: { 'Content-Type': 'multipart/form-data' },
        //             onUploadProgress:function (progressEvent) {
        //                 let UpPer= ((progressEvent.loaded*100)/progressEvent.total).toFixed(2) +" %";
        //                 ConfirmBtn.html(UpPer +"Please Wait..");
        //             }
        //         };
        //         axios.post(URL,UploadFormData,AxiosHeaderConfig).then(function (response){

        //             ConfirmBtn.html("CONFIRM & SAVE");
        //             ConfirmBtn.prop("disabled", false);

        //             if(response.status==200){
        //                 SuccessToast("Request Success");

        //                 $('#newImage').val("");
        //                 $('#ChangeImageModal').modal('hide');
        //                 DataList();

        //             }
        //             else{
        //                 $('#ChangeImageModal').modal('hide');
        //                 ErrorToast("Failed ! Please Try Again");
        //             }

        //         }).catch(function (error){
        //             $('#ChangeImageModal').modal('hide');
        //             ErrorToast("Something went wrong !");
        //         });
        //     }
        // })








    </script>
@endsection
