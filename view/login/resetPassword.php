<div class="col-sm-5 col-md-5 col-lg-5 col-xs-5"></div>

<div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">

    <div class='panel panel-default'>
        <div class='panel-heading'>
            <h4 class='text-primary'>Enter your new password</h4>
        </div>
        <div id='panel-content'>
            <form role="form" method="post">
                <div class='panel-body'>

                    <label for="id_new_password1">New password:</label>
                    <input class="form-control" type="password" id="resetPassword" name="resetPassword"
                           placeholder="Enter New Password" required/>

                    <label for="id_new_password2">Confirm password:</label>
                    <input class="form-control" type="password" id="resetCoPassword" name="resetCoPassword"
                           placeholder="Confirm Password" required/>
                </div>
                <div class='panel-footer bg-primary' style="padding: 0px 14px;">
                    <div class="row">
                        <button type="submit" class="btn btn-primary col-sm-12 col-md-12 col-lg-12 col-xs-12"
                                style="border-radius:0px">Change Password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-sm-1 col-md-1 col-lg-1 col-xs-1"></div>
<script>
    $("form#addUserForm").submit(function () {
        var form = $('#addUserForm')[0];
        var formData = new FormData(this);
        $(".errorMsg").html("");
        if ($('#user_co_password').val() != $('#user_password').val()) {
            alert("Password isn't matched");
        } else {
            $.ajax({
                url: "<?= BASE_URL ?>user/addUser",
                type: 'POST',
                enctype: "multipart/form-data",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.status == "success") {
                        var newRow = "";
                        newRow = createRow(data.insertData);
                        if ($("#usersTable tbody").length == 0) {
                            newRow = "<tbody>" + newRow + "</tbody>";
                            $("#usersTable").append(newRow);
                        } else {
                            $("#usersTable tbody").append(newRow);
                        }

                        $('#addUserModal').modal('hide');
                    } else if (data.status == "failed") {
                        for (var key in data.error) {
                            if (!data.error.hasOwnProperty(key))
                                continue;
                            var errorMsg = data.error[key];
                            $("#" + key).html(errorMsg);
                        }
                    } else if (data.status == "errorUpload") {
                        alert("Error in  file uploading!! .. try again");
                    } else if (data.status == "errorInsert") {
                        alert("Error in  add user!! .. try again");
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