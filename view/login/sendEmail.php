

<div class="row">
    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-3"></div>

    <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">

        <div class='panel panel-default'>
<<<<<<< HEAD
            <div class='panel-heading'>
                <h4 class='text-primary'>Reset your password</h4>
=======
            <div style="background:#3a2613;" class='panel-heading'>
                <h4 style="color:white;" class='text-primary'>Reset your password</h4>
>>>>>>> 449837dcd592cd5f3c6413ea3cac809ea9d4af5f
            </div>
            <div id='panel-content'>
                <span class="errorMsg" id="loginError"></span>
                <div class='panel-body'>
                    <label for="resetEmail">Email:</label>
                    <input class="form-control" type="email" id="resetEmail" name="resetEmail"
                           placeholder="Enter the Reigestered Email" required/>
                </div>
                <div class='panel-footer bg-primary' style="padding: 0px 14px;">
                    <div class="row">
<<<<<<< HEAD
                        <button id="sendEmail" class="btn btn-primary col-sm-12 col-md-12 col-lg-12 col-xs-12" href="<?= BASE_URL ?>login/resetPassword">Send Email</button>
=======
                        <button id="sendEmail" style="background:#3a2613; color:white;" class="btn btn-primary col-sm-12 col-md-12 col-lg-12 col-xs-12" href="<?= BASE_URL ?>login/resetPassword">Send Email</button>
>>>>>>> 449837dcd592cd5f3c6413ea3cac809ea9d4af5f
                        <span class="errorMsg" id="forgetPassSpan"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-3"></div>
</div>
<script>
    $(document).ready(function () {

        $("#sendEmail").on("click", function () {
            if ($("#resetEmail").val() != "") {
                var obj = {email: $("#resetEmail").val()}
                $.ajax({
                    url: "<?= BASE_URL ?>login/sendEmail",
                    method: 'POST',
                    dataType: "text",
                    data: obj,
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data.status == "fail") {
                            $('#forgetPassSpan').html('this email isn\'t exist');
                        } else if(data.status == "abort"){
                            alert("Error in connection");
                        } else if(data.status == "success"){
                            window.location = "<?= BASE_URL ?>login/confirmEmail";
                        }
                    },
                    error: function (errorData) {
                        console.log(errorData);
                        alert("Error in F process");
                    },
                });
                return false;
            } else {
                $('#forgetPassSpan').html('Enter your registered email');
            }
        });
    });
</script>