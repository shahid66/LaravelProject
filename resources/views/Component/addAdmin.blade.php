<div class="modal animat animate__fadeIn" id="AddAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Add New Member</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input id="AdminNameID" placeholder="Name" type="text" class="form-control">
                <input id="AdminEmailID" placeholder="Email" type="text" class="form-control mt-2">
                <input id="AdminMobileID" placeholder="Mobile" type="text" class="form-control mt-2">
                <textarea id="AdminAddressID" placeholder="User Address" type="text" class="form-control mt-2"></textarea>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                <button id="AddAdminBtn" type="button" class="btn btn-dark">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script>

    $('#AddAdminBtn').on('click',function () {


        let AdminName= $('#AdminNameID').val();
        let AdminEmail= $('#AdminEmailID').val();
        let AdminMobile=  $('#AdminMobileID').val();
        let AdminAddress=  $('#AdminAddressID').val();


        if(AdminName.length==0){
            ErrorToast("Name Required");
        }
        else if(!NameRegx.test(AdminName)){
            ErrorToast("Invalid Name");
        }
        else if(AdminEmail.length==0){
            ErrorToast("Email Required");
        }
        else if(!EmailRegx.test(AdminEmail)){
            ErrorToast("Invalid Email");
        }
        else if(AdminMobile.length==0){
            ErrorToast("Mobile Required");
        }
        else if(!MobileRegx.test(AdminMobile)){
            ErrorToast("Invalid Mobile No");
        }

        else if(AdminAddress.length==0){
            ErrorToast("User Name Required");
        }




        else {

            let URL="/AdminAdd";
            let MyFormData=new FormData();
            MyFormData.append('AdminName',AdminName);
            MyFormData.append('AdminEmail',AdminEmail)
            MyFormData.append('AdminMobile',AdminMobile)
            MyFormData.append('AdminAddress',AdminAddress)


            $('#AddAdminBtn').html(BtnSpinner).prop("disabled", true);
            axios.post(URL,MyFormData).then(function (response) {
                $('#AddAdminBtn').html("Confirm").prop("disabled", false);
                if(response.status==200 && response.data==1){
                    SuccessToast("Request Success");
                    $('#AddAdminModal').modal('hide');
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                }
                else{
                    ErrorToast("Request Fail ! Try Again");
                }

            }).catch(function (error) {
                $('#AddAdminBtn').html("Confirm").prop("disabled", false);
                ErrorToast("Request Fail ! Try Again");
            });
        }
    })


</script>

