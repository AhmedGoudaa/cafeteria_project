<div class="row">
    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-3"></div>

    <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
        <div class='panel panel-default'>
<<<<<<< HEAD
            <div class='panel-heading'>
                <h4 class='text-primary'>Enter your new password</h4>
=======
            <div style="background:#3a2613;" class='panel-heading'>
                <h4 style="color:white;" class='text-primary'>Enter your new password</h4>
>>>>>>> 449837dcd592cd5f3c6413ea3cac809ea9d4af5f
            </div>
            <div id='panel-content'>
                <form role="form" method="post" id="resetPasswordForm">
                    <div class='panel-body'>

                        <label for="id_new_password1">New password:</label>
                        <input class="form-control" type="password" id="resetPassword" name="resetPassword"
                               placeholder="Enter New Password" required/>
                        <span class="errorMsg" id="r_u_passError"></span>

                        <label for="id_new_password2">Confirm password:</label>
                        <input class="form-control" type="password" id="resetCoPassword" name="resetCoPassword"
                               placeholder="Confirm Password" required/>
                        <span class="errorMsg" id="r_u_copassError"></span>
                    </div>
                    <div class='panel-footer bg-primary' style="padding: 0px 14px;">
                        <div class="row">
<<<<<<< HEAD
                            <button type="submit" class="btn btn-primary col-sm-12 col-md-12 col-lg-12 col-xs-12"
=======
                            <button style="background:#3a2613;" type="submit" class="btn btn-primary col-sm-12 col-md-12 col-lg-12 col-xs-12"
>>>>>>> 449837dcd592cd5f3c6413ea3cac809ea9d4af5f
                                    style="border-radius:0px">Change Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-3"></div>
</div>
<script>
    $("form#resetPasswordForm").submit(function () {
        var form = $('#resetPasswordForm')[0];
        var formData = new FormData(this);
        $(".errorMsg").html("");
        if ($('#resetPassword').val() != $('#resetCoPassword').val()) {
            alert("Password isn't matched");
        } else {
            $.ajax({
                url: "<?= BASE_URL ?>login/resetPassword",
                type: 'POST',
                enctype: "multipart/form-data",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.status == "failed") {
                        for (var key in data.error) {
                            if (!data.error.hasOwnProperty(key))
                                continue;
                            var errorMsg = data.error[key];
                            $("#" + key).html(errorMsg);
                        }
                    } else if (data.status == "errorPassword") {
                        alert("Error in update Password");
                    } else if (data.status == "success") {
                        window.location = "<?= BASE_URL ?>login/resetDone";
                    }
                },
                error: function (errorData) {
                    console.log(errorData);
                    alert("Error in F process");
                },
            });
        }
        return false;
    });
</script>