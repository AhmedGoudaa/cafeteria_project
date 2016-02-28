
<button class='btn btn-success' data-toggle='modal' data-target='#addUserModal'><span class="glyphicon glyphicon-plus"></span> Add User</button>
<table id="usersTable" class='table table-hover table-striped table-bordered' style="text-align: center;">
    <thead>
        <tr>
            <th style="text-align: center;"> Name </th>
            <th style="text-align: center;"> Room </th>
            <th style="text-align: center;"> Image </th>
            <th style="text-align: center;"> Ext. </th>
            <th style="text-align: center;"> Action </th>
        </tr>
    </thead>
    <?php
    if (!empty($data['users'])):
        foreach ($data['users'] as $user):
            ?>
            <tr class='info' id="<?= $user['id'] ?>">
                <td class="user_name"><?= $user['fname'] ?> <?= $user['lname'] ?></td><td class="user_room"><?= $user['room_no'] ?></td><td class="user_photo"><img width='150px' height='100px' src="<?= BASE_URL ?>uploads/users/<?= $user['picture'] ?>"/></td><td class="user_ext"><?= $user['ext'] ?></td><td><button class="btn btn-info fillEditUser" data-toggle='modal' data-target='#editUserModal'><span class='glyphicon glyphicon-pencil'>Edit</span></button><?php if ($user["type"] != 1) { ?>|<button class="btn btn-danger deleteUser" id="<?= $user['id'] ?>"><span class='glyphicon glyphicon-remove'>Delete</span></button><?php } ?></td>
            </tr>
            <?php
        endforeach;
    endif;
    ?>
</table>

<div class='modal fade' id='addUserModal'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-heading'>
                <div class='modal-title'>
                    <h2 class='bg-primary'>Add User</h2>
                </div>
            </div>
            <div class='modal-body'>

                <form role="form" id="addUserForm">
                    <div class="form-group has-success">
                        <label for="text">First name:  </label>
                        <input type="text" id="user_fname" name="user_fname" class="form-control" required/>
                        <span class="errorMsg" id="u_fnameError"></span>
                    </div>
                    <div class="form-group has-success">
                        <label for="text">Last name:  </label>
                        <input type="text" id="user_lname" name="user_lname" class="form-control" required/>
                        <span class="errorMsg" id="u_lnameError"></span>
                    </div>
                    <div class="form-group  has-success " >
                        <label >Choose Room:</label>
                        <select id="user_room" name="user_room" required>
                            <?php foreach ($data['rooms'] as $room): ?>
                                <option value="<?= $room['id'] ?>"><?= $room['room_no'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="errorMsg" id="u_roomError"></span>
                    </div>
                    <div class="form-group has-success">
                        <label for="text">Ext.:  </label>
                        <input type="text" id="user_ext" name="user_ext" class="form-control" required/>
                        <span class="errorMsg" id="u_extError"></span>
                    </div>
                    <div class="form-group  has-success " >
                        <label >Upload image:</label>
                        <span class="btn btn-default btn-file">
                            Browse <input type="file" id="user_photo" class="form-control" name="user_photo" required/>
                        </span>
                        <label id="filePath"></label>
                        <span class="errorMsg" id="fileError"></span>
                    </div>
                    <div class="form-group has-success">
                        <label for="text">Email:  </label>
                        <input type="email" id="user_email" name="user_email" class="form-control" required/>
                        <span class="errorMsg" id="u_emailError"></span>
                    </div>

                    <div class="form-group has-success">
                        <label for="text">Password:  </label>
                        <input type="password" id="user_password" name="user_password" class="form-control" required/>
                        <span class="errorMsg" id="u_passError"></span>
                    </div>
                    <div class="form-group has-success">
                        <label for="text">Confirm password:  </label>
                        <input type="password" id="user_co_password" name="user_co_password" class="form-control" required/>
                        <span class="errorMsg" id="u_copassError"></span>
                    </div>

                    <div class='modal-footer'>
                        <button id="addUser" type="submit" class="btn btn-info">Add User</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='editUserModal'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-heading'>
                <div class='modal-title'>
                    <h2 class='bg-primary'>Edit User</h2>
                </div>
            </div>
            <div class='modal-body'>

                <form role="form" id="editUserForm">
                    <div class="form-group has-success">
                        <label for="text">First name:  </label>
                        <input type="text" id="e_user_fname" name="e_user_fname" class="form-control" required/>
                        <span class="errorMsg" id="e_u_fnameError"></span>
                    </div>
                    <div class="form-group has-success">
                        <label for="text">Last name:  </label>
                        <input type="text" id="e_user_lname" name="e_user_lname" class="form-control" required/>
                        <span class="errorMsg" id="e_u_lnameError"></span>
                    </div>
                    <div class="form-group  has-success " >
                        <label >Choose Room:</label>
                        <select id="e_user_room" name="e_user_room" required>
                            <?php foreach ($data['rooms'] as $room): ?>
                                <option value="<?= $room['id'] ?>"><?= $room['room_no'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="errorMsg" id="e_u_roomError"></span>
                    </div>
                    <div class="form-group has-success">
                        <label for="text">Ext.:  </label>
                        <input type="text" id="e_user_ext" name="e_user_ext" class="form-control" required/>
                        <span class="errorMsg" id="e_u_extError"></span>
                    </div>
                    <div class="form-group  has-success " >
                        <label >Upload image(upload new one or keep the old):</label>
                        <span class="btn btn-default btn-file">
                            Browse <input type="file" id="e_user_photo" class="form-control" name="e_user_photo"/>
                        </span>
                        <label id="filePath"></label>
                        <span class="errorMsg" id="e_fileError"></span>
                    </div>
                    <div class="form-group has-success">
                        <label for="text">Email:  </label>
                        <input type="email" id="e_user_email" name="e_user_email" class="form-control" required/>
                        <span class="errorMsg" id="e_u_emailError"></span>
                    </div>

                    <div class="form-group has-success">
                        <label for="text">Password(change to a new password or keep the old):  </label>
                        <input type="password" id="e_user_password" name="e_user_password" class="form-control"/>
                        <span class="errorMsg" id="e_u_passError"></span>
                    </div>
                    <div class="form-group has-success">
                        <label for="text">Confirm password:  </label>
                        <input type="password" id="e_user_co_password" name="e_user_co_password" class="form-control"/>
                        <span class="errorMsg" id="e_u_copassError"></span>
                    </div>
                    <input type="hidden" id="editID" name="editID">
                    <div class='modal-footer'>
                        <button id="editUser" type="submit" class="btn btn-info">Edit User</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('.btn-file #user_photo').change(function () {
            $(".btn-file ~ #filePath").text("");
            $(".btn-file ~ #filePath").text($(this).val());
        });
        $('.btn-file #e_user_photo').change(function () {
            $(".btn-file ~ #filePath").text("");
            $(".btn-file ~ #filePath").text($(this).val());
        });
//////////////Delete User//////////////////        
        $(document).on("click", ".deleteUser", function () {
            var userRow = $(this);
            var obj = {
                user_id: $(this).attr("id"),
            }
//        console.log(JSON.stringify(obj))
            $.ajax({
                url: "<?= BASE_URL ?>user/deleteUser",
                method: "post",
                dataType: "text",
//            contentType: 'application/json',
                data: obj,
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.status == "success") {
                        $(userRow).parent().parent().remove();
                    } else {
                        alert("Error in delete process");
                    }
                },
                error: function (errorData) {
                    console.log(errorData);
                    alert("Error in F process");
                },
            });
        });
//////////////Add User//////////////////
        function createRow(obj) {
            return "<tr class='info' id=" + obj['id'] + "><td class='user_name'>" + obj["fname"] + " " + obj["lname"] + "</td><td class='user_room'>" + obj["room_no"] + "</td><td class='user_photo'><img width='150px' height='100px' src='<?= BASE_URL ?>uploads/users/" + obj["picture"] + "'/></td><td class='user_ext'>" + obj["ext"] + "</td><td><button class='btn btn-info fillEditUser' data-toggle='modal' data-target='#editUserModal'><span class='glyphicon glyphicon-pencil'>Edit</span></button>|<button class='btn btn-danger deleteUser' id=" + obj['id'] + "><span class='glyphicon glyphicon-remove'>Delete</span></button></td></tr>";
        }

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
//////////////Edit User//////////////////
        $(document).on("click", ".fillEditUser", function () {
            $.ajax({
                url: "<?= BASE_URL ?>user/editUser",
                method: "get",
                dataType: "text",
                data: {"user_id": $(this).parent().parent().attr("id")},
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.status == "success") {
                        $('#editUserModal #e_user_fname').val(data.editRow.fname);
                        $('#editUserModal #e_user_lname').val(data.editRow.lname);
                        $('#editUserModal #e_user_room option[value="' + data.editRow.room_id + '"]').prop('selected', true)
                        $('#editUserModal #e_user_ext').val(data.editRow.ext);
                        $('#editUserModal #e_user_email').val(data.editRow.email);
                        $('#editUserModal #editID').val(data.editRow.id);
                    } else {
                        alert("Error in delete process");
                    }
                },
                error: function (errorData) {
                    console.log(errorData);
                    alert("Error in fill process");
                },
            });
        });

        $("form#editUserForm").submit(function () {
            var form = $('#editUserForm')[0];
            var formData = new FormData(this);
            $(".errorMsg").html("");
            if ($('#e_user_co_password').val() != $('#e_user_password').val()) {
                alert("Password isn't matched");
            } else {
                $.ajax({
                    url: "<?= BASE_URL ?>user/editUser",
                    type: 'POST',
                    enctype: "multipart/form-data",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data.status == "success") {
                            var imgPath = "<?= BASE_URL ?>uploads/users/" + data.editData.picture;
                            $("#usersTable tr#" + data.editData.id).children(".user_photo").children("img").attr("src", imgPath);
                            $("#usersTable tr#" + data.editData.id).children(".user_name").text(data.editData.fname + " " + data.editData.lname);
                            $("#usersTable tr#" + data.editData.id).children(".user_room").text(data.editData.room_no);
                            $("#usersTable tr#" + data.editData.id).children(".user_ext").text(data.editData.ext);
                            $('#editUserModal').modal('hide');
                        } else if (data.status == "failed") {
                            for (var key in data.error) {
                                if (!data.error.hasOwnProperty(key))
                                    continue;
                                var errorMsg = data.error[key];
                                $("#" + key).html(errorMsg);
                            }
                        } else if (data.status == "errorUpload") {
                            alert("Error in  file uploading!! .. try again");
                        } else if (data.status == "errorEdit") {
                            alert("Error in edit User!! .. try again \n don't use special character");
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
        $('#addUserModal').on('hidden.bs.modal', function () {
            $('input').val('');
            $('.errorMsg').html('');
            $(".btn-file ~ #filePath").text("");
        });
        $('#editUserModal').on('hidden.bs.modal', function () {
            $('input').val('');
            $('.errorMsg').html('');
            $(".btn-file ~ #filePath").text("");
        });
    });
</script>