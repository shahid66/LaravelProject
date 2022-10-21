@extends('Layout.app')
@section('content')


    @include('Component.WentWrongDiv')

    <div id="MainDiv" class="container-fluid ">

        <div class="row">
            <div class="col-md-12">
                <div class="row d-flex justify-content-center">
                    <div class="col-4">
                        <button data-toggle="modal" data-target="#AddAmountModal" class="btn mt-2 btn-dark">Saving Amount</button>
                    </div>
                    <div class="col-4">
                        <button data-toggle="modal" data-target="#AddCatagoriesModal" class="btn mt-2 btn-dark">Add Catagories</button>
                    </div>
                    <div class="col-4">
                        <button data-toggle="modal" data-target="#CostAmountModal" class="btn mt-2 btn-dark">Cost Amount</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6  col-lg-6 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <table id="SaveAmountDataTable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Catagories</th>
                                <th>day</th>
                                <th>month</th>
                                <th>year</th>
                                <th>amount</th>
                                <th>comment</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="SaveAmountDataTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-md-6  col-lg-6 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <table id="CostAmountDataTable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Catagories</th>
                                <th>day</th>
                                <th>month</th>
                                <th>year</th>
                                <th>amount</th>
                                <th>comment</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="CostAmountDataTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h4>Accounts Summary</h4>
                <div class="card">
                    <div class="card-body">
                        <h6>Saving Amount: {{ $SaveAmountTotal }}</h6>
                        <h6>Cost Amount: {{ $CostAmountTotal }}</h6>
                        <h6>Available Amount: {{ $available }}</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">

            <div class="col-md-6 text-center ">
                <h4>Categories List</h4>
                <div class="card">
                    <div class="card-body">
                        <table id="CatagoriesDataTable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody id="CatagoriesDataTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal animat animate__fadeIn" id="AddAmountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Add Amoun</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="exampleInputEmail1">Catagories</label>
                    <select id="CatagoriesID"  class="form-control">
                        @foreach ($Catagories as $item)
                        <option value={{ $item['catagoriName'] }}>{{ $item['catagoriName'] }}</option>
                        @endforeach
                    </select>
                    <label for="exampleInputEmail1">Day</label>
                    <select id="day" class="form-control">
                        <option value="" selected >--Select--</option>
                        @php
                            $i=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31]
                        @endphp
                       @foreach ($i as $day)
                       <option value={{$day}}>{{$day}}</option>
                       @endforeach



                    </select>
                    <label for="exampleInputEmail1">Month</label>
                    <select id="month" class="form-control">
                        <option value=" " selected >--SELECT--</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>


                    </select>
                    <label for="exampleInputEmail1">Years</label>
                    <select id="year" class="form-control">
                        <option value="" selected >--SELECT--</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                        <option value="2031">2031</option>
                        <option value="2032">2032</option>


                    </select>
                    <label for="exampleInputEmail1">Amount</label>
                    <input id="SaveAmount" placeholder="amount" type="text" class="form-control mt-2">
                    <label for="exampleInputEmail1">Comments</label>
                    <textarea id="Comments" placeholder="Comments" type="text" class="form-control mt-2"></textarea>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    <button id="AddSaveAmountBtn" type="button" class="btn btn-dark">Confirm</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal animat animate__fadeIn" id="AddCatagoriesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Add New Categories</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input id="catagoriesName" placeholder="Name" type="text" class="form-control">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    <button id="AddCatagoriesBtn" type="button" class="btn btn-dark">Confirm</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal animat animate__fadeIn" id="CostAmountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Add Cost Amoun</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="exampleInputEmail1">Catagories</label>
                    <select id="CatagoriesID"  class="form-control">
                        @foreach ($Catagories as $item)
                        <option value={{ $item['catagoriName'] }}>{{ $item['catagoriName'] }}</option>
                        @endforeach
                    </select>
                    <label for="exampleInputEmail1">Day</label>
                    <select id="cost_day" class="form-control">
                        <option value="" selected >--Select--</option>
                        @php
                            $i=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31]
                        @endphp
                       @foreach ($i as $day)
                       <option value={{$day}}>{{$day}}</option>
                       @endforeach



                    </select>
                    <label for="exampleInputEmail1">Month</label>
                    <select id="cost_month" class="form-control">
                        <option value=" " selected >--SELECT--</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>


                    </select>
                    <label for="exampleInputEmail1">Years</label>
                    <select id="cost_year" class="form-control">
                        <option value="" selected >--SELECT--</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                        <option value="2031">2031</option>
                        <option value="2032">2032</option>


                    </select>
                    <label for="exampleInputEmail1">Amount</label>
                    <input id="CostAmount" placeholder="amount" type="text" class="form-control mt-2">
                    <label for="exampleInputEmail1">Comments</label>
                    <textarea id="cost_Comments" placeholder="Comments" type="text" class="form-control mt-2"></textarea>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    <button id="AddCostAmountBtn" type="button" class="btn btn-dark">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    @include('Component.DeleteModal2')
    @include('Component.DeleteModal')
    @include('Component.DeleteModal3')
@endsection

@section('script')


    <script>

        DataList()
        DataCostList()
        CatagoriesDataList()
        var  ActionSpinnerBtn="<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing..";

        function DataList(){
            let URL="/SaveAmountList";
            axios.get(URL).then(function (response) {
                if(response.status==200){
                    $('#LoadingDiv').addClass('d-none');
                    $('#MainDiv').removeClass('d-none')
                    $('#SaveAmountDataTable').DataTable().destroy();
                    $('#SaveAmountDataTableBody').empty();
                    $.each(response.data,function (i,item){
                        let tableRow="<tr>" +
                            "<td>"+item['catagories']+"</td>" +
                            "<td>"+item['day']+"</td>" +
                            "<td>"+item['month']+"</td>" +
                            "<td>"+item['year']+"</td>" +
                            "<td>"+item['price']+"</td>" +
                            "<td>"+item['comments']+"</td>" +

                            "<td>" +
                            "<div class='dropdown'>" +
                            "<button class='btn btn-sm btn-dark  dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-cog'></i></button>" +
                            "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>" +
                            "<a class='dropdown-item deleteItem' data-id="+item['id']+" href='#'>Delete</a>"+
                            "</div>" +
                            "</div>" +
                            "</td>" +
                            "</tr>";
                        $('#SaveAmountDataTableBody').append(tableRow);
                    });

                    $('.deleteItem').on('click',function () {
                        let id=$(this).data('id');
                        $('#DeleteID').html(id);
                        $('#DeleteModal').modal('show');
                    })

                    $('#SaveAmountDataTable').DataTable({
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

        // costlist

        function DataCostList(){
            let URL="/CostAmountList";
            axios.get(URL).then(function (response) {
                if(response.status==200){
                    $('#LoadingDiv').addClass('d-none');
                    $('#MainDiv').removeClass('d-none')
                    $('#CostAmountDataTable').DataTable().destroy();
                    $('#CostAmountDataTableBody').empty();
                    $.each(response.data,function (i,item){
                        let tableRow="<tr>" +
                            "<td>"+item['catagories']+"</td>" +
                            "<td>"+item['day']+"</td>" +
                            "<td>"+item['month']+"</td>" +
                            "<td>"+item['year']+"</td>" +
                            "<td>"+item['price']+"</td>" +
                            "<td>"+item['comments']+"</td>" +

                            "<td>" +
                            "<div class='dropdown'>" +
                            "<button class='btn btn-sm btn-dark  dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-cog'></i></button>" +
                            "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>" +
                            "<a class='dropdown-item deleteItem2' data-id="+item['id']+" href='#'>Delete</a>"+
                            "</div>" +
                            "</div>" +
                            "</td>" +
                            "</tr>";
                        $('#CostAmountDataTableBody').append(tableRow);
                    });

                    $('.deleteItem2').on('click',function () {
                        let id=$(this).data('id');
                        $('#DeleteID').html(id);
                        $('#DeleteModal2').modal('show');
                    })

                    $('#CostAmountDataTable').DataTable({
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


        var  ActionSpinnerBtn="<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing..";

        function CatagoriesDataList(){
            let URL="/CatagoriesList";
            axios.get(URL).then(function (response) {
                if(response.status==200){
                    $('#LoadingDiv').addClass('d-none');
                    $('#MainDiv').removeClass('d-none')
                    $('#CatagoriesDataTable').DataTable().destroy();
                    $('#CatagoriesDataTableBody').empty();
                    $.each(response.data,function (i,item){
                        let tableRow="<tr>" +
                            "<td>"+item['id']+"</td>" +
                            "<td>"+item['catagoriName']+"</td>" +


                            "<td>" +
                            "<div class='dropdown'>" +
                            "<button class='btn btn-sm btn-dark  dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-cog'></i></button>" +
                            "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>" +
                            "<a class='dropdown-item deleteItem' data-cat="+item['catagoriName']+" data-id="+item['id']+" href='#'>Delete</a>"+
                            "</div>" +
                            "</div>" +
                            "</td>" +
                            "</tr>";
                        $('#CatagoriesDataTableBody').append(tableRow);
                    });

                    $('.deleteItem').on('click',function () {
                        let id=$(this).data('id');
                        let catr=$(this).data('cat');
                        $('#DeleteID').html(id);
                        $('#catagoriName').html(catr);
                        $('#DeleteModal3').modal('show');
                    })

                    $('#CatagoriesDataTable').DataTable({
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




        $('#AddSaveAmountBtn').on('click',function () {


let CatagoriesID= $('#CatagoriesID').val();
let day= $('#day').val();
let month=  $('#month').val();
let year=  $('#year').val();
let SaveAmount=  $('#SaveAmount').val();
let Comments=  $('#Comments').val();


if(CatagoriesID.length==0){
    ErrorToast("Catagories Required");
}

else if(day.length==0){
    ErrorToast("day Required");
}

else if(month.length==0){
    ErrorToast("Month Required");
}


else if(year.length==0){
    ErrorToast("Year Required");
}
else if(SaveAmount.length==0){
    ErrorToast("Amount Required");
}
else if(Comments.length==0){
    ErrorToast("Comments Required");
}



else {

    let URL="/SaveAmountAdd";
    let MyFormData=new FormData();
    MyFormData.append('CatagoriesID',CatagoriesID);
    MyFormData.append('day',day)
    MyFormData.append('month',month)
    MyFormData.append('year',year)
    MyFormData.append('SaveAmount',SaveAmount)
    MyFormData.append('Comments',Comments)


    $('#AddSaveAmountBtn').html(BtnSpinner).prop("disabled", true);
    axios.post(URL,MyFormData).then(function (response) {
        $('#AddSaveAmountBtn').html("Confirm").prop("disabled", false);
        if(response.status==200 && response.data==1){
            SuccessToast("Request Success");
            $('#AddAmountModal').modal('hide');
            setTimeout(function() {
                location.reload();
            }, 3000);
        }
        else{
            ErrorToast("Request Fail ! Try Again");
        }

    }).catch(function (error) {
        $('#AddSaveAmountBtn').html("Confirm").prop("disabled", false);
        ErrorToast("Request Fail ! Try Again");
    });
}
})

        $('#DeleteConfirm').click(function (event) {
            let id= $('#DeleteID').html();

            let DeleteBtn=$('#DeleteConfirm');
            SaveAmountListDelete(id,DeleteBtn);
        });

        function SaveAmountListDelete(deleteID,DeleteBtn){

            DeleteBtn.html(ActionSpinnerBtn);

            let URL="/SaveAmountListDelete";
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


        // costAmount

        $('#AddCostAmountBtn').on('click',function () {


let CatagoriesID= $('#CatagoriesID').val();
let day= $('#cost_day').val();
let month=  $('#cost_month').val();
let year=  $('#cost_year').val();
let CostAmount=  $('#CostAmount').val();
let Comments=  $('#cost_Comments').val();


if(CatagoriesID.length==0){
    ErrorToast("Catagories Required");
}

else if(day.length==0){
    ErrorToast("day Required");
}

else if(month.length==0){
    ErrorToast("Month Required");
}


else if(year.length==0){
    ErrorToast("Year Required");
}
else if(CostAmount.length==0){
    ErrorToast("Amount Required");
}
else if(Comments.length==0){
    ErrorToast("Comments Required");
}



else {

    let URL="/CostAmountAdd";
    let MyFormData=new FormData();
    MyFormData.append('CatagoriesID',CatagoriesID);
    MyFormData.append('day',day)
    MyFormData.append('month',month)
    MyFormData.append('year',year)
    MyFormData.append('CostAmount',CostAmount)
    MyFormData.append('Comments',Comments)


    $('#AddSaveAmountBtn').html(BtnSpinner).prop("disabled", true);
    axios.post(URL,MyFormData).then(function (response) {
        $('#AddSaveAmountBtn').html("Confirm").prop("disabled", false);
        if(response.status==200 && response.data==1){
            SuccessToast("Request Success");
            $('#CostAmountModal').modal('hide');
            setTimeout(function() {
                location.reload();
            }, 3000);
        }
        else{
            ErrorToast("Request Fail ! Try Again");
        }

    }).catch(function (error) {
        $('#AddSaveAmountBtn').html("Confirm").prop("disabled", false);
        ErrorToast("Request Fail ! Try Again");
    });
}
})

$('#DeleteConfirm2').click(function (event) {
            let id= $('#DeleteID').html();

            let DeleteBtn=$('#DeleteConfirm2');
            CostAmountListDelete(id,DeleteBtn);
        });

function CostAmountListDelete(deleteID,DeleteBtn){

            DeleteBtn.html(ActionSpinnerBtn);

            let URL="/CostAmountListDelete";
            let AxiosConfig = { headers: { 'Content-Type': 'application/json' } };
            let blankData=" ";
            axios.post(URL,{id:deleteID},AxiosConfig).then(function (response) {

                DeleteBtn.html("Yes");

                if (response.data===1) {
                    $('#DeleteConfirm2').attr('data-id',blankData);
                    $('#DeleteModal2').modal('hide');
                    toastr.success("Deleted !");
                    DataCostList()
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

        // catagories



$('#AddCatagoriesBtn').on('click',function () {


let catagoriesName= $('#catagoriesName').val();



if(catagoriesName.length==0){
    ErrorToast("Catagories Required");
}


else {

    let URL="/CatagoriestAdd";
    let MyFormData=new FormData();
    MyFormData.append('catagoriesName',catagoriesName);



    $('#AddCatagoriesBtn').html(BtnSpinner).prop("disabled", true);
    axios.post(URL,MyFormData).then(function (response) {
        $('#AddCatagoriesBtn').html("Confirm").prop("disabled", false);
        if(response.status==200 && response.data==1){
            SuccessToast("Request Success");
            $('#AddCatagoriesModal').modal('hide');
            setTimeout(function() {
                location.reload();
            }, 3000);
        }
        else{
            ErrorToast("Request Fail ! Try Again");
        }

    }).catch(function (error) {
        $('#AddCatagoriesBtn').html("Confirm").prop("disabled", false);
        ErrorToast("Request Fail ! Try Again");
    });
}
})


$('#DeleteConfirm3').click(function (event) {
            let id= $('#DeleteID').html();
            let cat= $('#catagoriName').html();

            let DeleteBtn=$('#DeleteConfirm3');
            CatagroriesListDelete(id,DeleteBtn,cat);
        });

        function CatagroriesListDelete(deleteID,DeleteBtn,cat){

            DeleteBtn.html(ActionSpinnerBtn);

            let URL="/CatagoriesListDelete";
            let AxiosConfig = { headers: { 'Content-Type': 'application/json' } };
            let blankData=" ";
            axios.post(URL,{id:deleteID,cat},AxiosConfig).then(function (response) {

                DeleteBtn.html("Yes");

                if (response.data===1) {
                    $('#DeleteConfirm3').attr('data-id',blankData);
                    $('#DeleteModal3').modal('hide');
                    toastr.success("Deleted !");
                    CatagoriesDataList()
                }
                else {
                    // $('#DeleteModal3').modal('hide');
                    toastr.error("Failed ! Please Try Again or Categories some where used");
                }

            }).catch(function (error) {
                DeleteBtn.html("Yes");
                $('#DeleteModal').modal('hide');
                toastr.error("Something Went Wrong");
            });
        }


    </script>

@endsection

