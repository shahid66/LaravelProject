<div class="modal animat animate__fadeIn" id="SiteInfoUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Update</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input id="address" placeholder="Address" type="text" class="form-control"><br>
                <input id="email" placeholder="Email" type="email" class="form-control"><br>
                <input id="phone" placeholder="Phone" type="text" class="form-control"><br>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                <button id="SiteInfoUpdateConfirmBtn" type="button" class="btn btn-dark">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script>




    $("#SiteInfoUpdateConfirmBtn").on('click',function () {

        let address= $('#address').val();
        let email= $('#email').val();
        let phone= $('#phone').val();
        if(address.length==0){
            ErrorToast("Address Required")
        }
        else if(email.length==0){
            ErrorToast("email Required")
        }
        else if(phone.length==0){
            ErrorToast("phone Required")
        }
        else{

            let URL="/UpdateSiteInfo";
            let MyFormData=new FormData();
            MyFormData.append('address',address);
            MyFormData.append('email',email);
            MyFormData.append('phone',phone);

            $('#SiteInfoUpdateConfirmBtn').html(BtnSpinner).prop("disabled", true);

            axios.post(URL,MyFormData).then(function (response) {
                $('#SiteInfoUpdateConfirmBtn').html("Confirm").prop("disabled", false);
                if(response.status==200 && response.data==1){
                    SuccessToast("Request Success");
                    $('#SiteInfoUpdateModal').modal('hide');
                    GetSiteInfo();
                }
                else{
                    $('#SiteInfoUpdateModal').modal('hide');
                    ErrorToast("Request Fail ! Try Again");
                }

            }).catch(function (error) {
                $('#SiteInfoUpdateModal').modal('hide');
                $('#SiteInfoUpdateConfirmBtn').html("Confirm").prop("disabled", false);
                ErrorToast("Request Fail ! Try Again");
            });
        }
    })


</script>
