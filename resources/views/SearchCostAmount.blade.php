@extends('Layout.app')
@section('content')
    <div class="container ">
        <div class="row ">
            <div class="col-md-12">
                <div class="row d-flex justify-content-start">
                    <div class="col-4">
                        <button data-toggle="modal" data-target="#SearchCostModal" class="btn mt-2 btn-dark">Search</button>
                    </div>

                </div>
            </div>
            <div class="col-md-12  col-lg-12 col-sm-12 mt-4">
                <h2>Total: <span id="total"></span></h2>
                <div class="card">
                    <div class="card-body">
                        <table id="SearchCostAmountDataTable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Catagories</th>
                                <th>day</th>
                                <th>month</th>
                                <th>year</th>
                                <th>amount</th>
                                <th>comment</th>

                            </tr>
                            </thead>
                            <tbody id="SearchCostAmountDataTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>


    <div class="modal animat animate__fadeIn" id="SearchCostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Search</h6>
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

                    <label for="exampleInputEmail1">From Month</label>
                    <select id="from_month" class="form-control">
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

                    <label for="exampleInputEmail1">To Month</label>
                    <select id="to_month" class="form-control">
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


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    <button id="SearchCostBtn" type="button" class="btn btn-dark">Confirm</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')


    <script type="text/javascript">



        $('#SearchCostBtn').on('click',function () {


let CatagoriesID= $('#CatagoriesID').val();
let from_month=  $('#from_month').val();
let to_month=  $('#to_month').val();
let year=  $('#year').val();



if(CatagoriesID.length==0){
    ErrorToast("Catagories Required");
}

else if(from_month.length==0){
    ErrorToast("day Required");
}

else if(to_month.length==0){
    ErrorToast("Month Required");
}


else if(year.length==0){
    ErrorToast("Year Required");
}




else {

    let URL="/SearchByMonthCostAmount/"+CatagoriesID+"/"+from_month+"/"+to_month+"/"+year;
    console.log(URL)




    $('#SearchCostBtn').html(BtnSpinner).prop("disabled", true);
    axios.get(URL).then(function (response) {
        $('#SearchCostBtn').html("Confirm").prop("disabled", false);
        if(response.status==200){
$('#total').html(response.data['tk']);
                    $('#LoadingDiv').addClass('d-none');
                    $('#MainDiv').removeClass('d-none')
                    $('#SearchCostAmountDataTable').DataTable().destroy();
                    $('#SearchCostAmountDataTableBody').empty();
                    console.log(response.data['tk'])
                    $.each(response.data['result'],function (i,item){
                        let tableRow="<tr>" +
                            "<td>"+item['catagories']+"</td>" +
                            "<td>"+item['day']+"</td>" +
                            "<td>"+item['month']+"</td>" +
                            "<td>"+item['year']+"</td>" +
                            "<td>"+item['price']+"</td>" +
                            "<td>"+item['comments']+"</td>" +

                            // "<td>" +
                            // "<div class='dropdown'>" +
                            // "<button class='btn btn-sm btn-dark  dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-cog'></i></button>" +
                            // "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>" +
                            // "<a class='dropdown-item deleteItem' data-id="+item['id']+" href='#'>Delete</a>"+
                            "</div>" +
                            "</div>" +
                            "</td>" +
                            "</tr>";
                        $('#SearchCostAmountDataTableBody').append(tableRow);
                    });
                    $('#SearchCostModal').modal('hide');
                    $('.deleteItem').on('click',function () {
                        let id=$(this).data('id');
                        $('#DeleteID').html(id);
                        $('#SearchCostModal').modal('hid');
                    })

                    $('#SearchCostAmountDataTable').DataTable({
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
        $('#AddSaveAmountBtn').html("Confirm").prop("disabled", false);

    });
}
})
    </script>
@endsection
