@extends('Layout.app')
@section('content')

    <div id="MainDiv" class="container ">
        <div class="row">
            <div class="col-md-8  col-lg-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                       <h2>Name: {{ $result[0]['name'] }}</h2>
                       <h2 id="userID"> {{ $result[0]['id'] }}</h2>
                    </div>
                </div>

            </div>
            <div class="col-md-4  col-lg-4 col-sm-12">
                <div class="card">

                    <div class="card-body">
                        {{-- <a data-toggle="modal" data-target="#AddPaymentModal" id={{ $result[0]['id'] }}  class="dropdown-item ttt">Add Payment</a> --}}
                        <button type="button" class="btn btn-info btn-lg passingID" data-id={{ $result[0]['id'] }}>ADD Amount</button><br><br>
                        <h4>Total: <span id='totalPrice'></span></h4>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 data-table-card col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <table id="PaymentDataTable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Day</th>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Amount</th>


                            </tr>
                            </thead>
                            <tbody id="PaymentDataTableBody">

                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal animat animate__fadeIn" id="AddPaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Add Payment</h6>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 id="uuuID"> </h3>
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
                    <input id="amount"  type="text" class="form-control" pattern=[0-9]>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    <button id="PaymentConfirmBtn" type="button" class="btn btn-dark">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    @include('Component.DeleteModal')
@endsection

@section('script')


    <script>

DataList();

        $(".passingID").click(function () {
    var ids = $(this).data('id');
    console.log(ids)
    $('#uuuID').html(ids);
    $('#AddPaymentModal').modal('show');
});


$('#PaymentConfirmBtn').on('click',function () {

    var ID=$(this).attr('data-id');
let day= $('#day').val();
let month= $('#month').val();
let year=  $('#year').val();
let userID= $('#uuuID').html();
let amount=  $('#amount').val();


if(day.length==0){
    ErrorToast("Day Required");
}

else if(month.length==0){
    ErrorToast("Month Required");
}

else if(year.length==0){
    ErrorToast("Year Required");
}
else if(amount.length==0){
    ErrorToast("Year Required");
}


else {

    let URL="/UserPaymentInsert";
    let MyFormData=new FormData();
    MyFormData.append('day',day);
    MyFormData.append('month',month)
    MyFormData.append('year',year)
    MyFormData.append('userID',userID)
    MyFormData.append('amount',amount)


    $('#PaymentConfirmBtn').html(BtnSpinner).prop("disabled", true);
    axios.post(URL,MyFormData).then(function (response) {
        $('#PaymentConfirmBtn').html("Confirm").prop("disabled", false);
        if(response.status==200 && response.data==1){
            SuccessToast("Request Success");
            $('#AddPaymentModal').modal('hide');
            setTimeout(function() {
                location.reload();
            }, 2000);
        }
        else{
            ErrorToast("Request Fail ! Try Again");
        }

    }).catch(function (error) {
        $('#PaymentConfirmBtn').html("Confirm").prop("disabled", false);
        ErrorToast("Request Fail ! Try Again");
    });
}
})



//list

var  ActionSpinnerBtn="<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing..";

        function DataList(){
            var ID=$('#userID').html();
            var URL='/userPaymentList/'+ID;
            axios.get(URL).then(function (response) {
                console.log(response)
                if(response.status===200){
                    $('#LoadingDiv').addClass('d-none');
                    $('#totalPrice').html(response.data[1]);
                    $('#MainDiv').removeClass('d-none');
                    $('#PaymentDataTable').DataTable().destroy();
                    $('#PaymentDataTableBody').empty();
                    $.each(response.data[0],function (i,item){
                        let tableRow="<tr>" +
                            "<td>"+item['date']+"</td>" +
                            "<td>"+item['month']+"</td>" +
                            "<td>"+item['year']+"</td>" +
                            "<td>"+item['price']+"</td>" +

                            "<td>" +
                            "<div class='dropdown'>" +
                            "<button class='btn btn-sm btn-dark  dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Dropdown button</button>" +
                            "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>" +
                            "<a class='dropdown-item deleteItem' data-id="+item['id']+" data-img="+item['imageName']+" href='#'>Delete</a>"+
                            "<a class='dropdown-item changeImage' data-id="+item['id']+" data-img="+item['imageName']+" href='#'>Change Image</a>"+
                            "<a class='dropdown-item changedata' data-id="+item['id']+" href='#'>Edit Data</a>"+
                            "</div>" +
                            "</div>" +
                            "</td>" +
                            "</tr>";
                        $('#PaymentDataTableBody').append(tableRow);
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


                    $('#PaymentDataTable').DataTable({
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


        $('#DeleteConfirm').click(function (event) {
            let id= $('#DeleteID').html();

            let DeleteBtn=$('#DeleteConfirm');
            PaymentListDelete(id,DeleteBtn);
        });

        function PaymentListDelete(deleteID,DeleteBtn){

            DeleteBtn.html(ActionSpinnerBtn);

            let URL="/PaymentListDelete";
            let AxiosConfig = { headers: { 'Content-Type': 'application/json' } };
            let blankData=" ";
            axios.post(URL,{id:deleteID},AxiosConfig).then(function (response) {

                DeleteBtn.html("Yes");

                if (response.data===1) {
                    $('#DeleteConfirm').attr('data-id',blankData);
                    $('#DeleteModal').modal('hide');
                    toastr.success("Deleted !");
                    setTimeout(function() {
                location.reload();
            }, 1000);
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

