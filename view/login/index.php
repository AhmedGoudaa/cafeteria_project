<div class="row">
    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-3"></div>

    <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">

        <div class='panel panel-default'>
<<<<<<< HEAD
            <div class='panel-heading'>
                <h4 class='text-primary'>Login with your account</h4>
=======
            <div style="background:#3a2613;" class='panel-heading'>
                <h4 style="color:white;" class='text-primary'>Login with your account</h4>
>>>>>>> 449837dcd592cd5f3c6413ea3cac809ea9d4af5f
            </div>
            <div id='panel-content'>
                <span class="errorMsg" id="loginError"></span>
                <form role="form" method="post" id="loginForm">
                    <div class='panel-body'>
<<<<<<< HEAD
                        <label for="accountEmail">Email:</label>
=======
                        <label  for="accountEmail">Email:</label>
>>>>>>> 449837dcd592cd5f3c6413ea3cac809ea9d4af5f
                        <input class="form-control" type="email" id="accountEmail" name="accountEmail"
                               placeholder="Enter Email" required/>

                        <label for="accountPass">Password:</label>
                        <input class="form-control" type="password" id="accountPass" name="accountPass"
                               placeholder="Enter Password" required/>
                        <p></p>
                    </div>
                    <div class='panel-footer bg-primary' style="padding: 0px 14px;">
<<<<<<< HEAD
                        <div class="row">
                            <button type="submit" class="btn btn-primary col-sm-12 col-md-12 col-lg-12 col-xs-12"
                                    style="border-radius:0px">Login
=======
                        <div  class="row">
                            <button  type="submit" style="background:#3a2613; color:white;" class="btn btn-primary col-sm-12 col-md-12 col-lg-12 col-xs-12"
                                    style="border-radius:0px; ">Login
>>>>>>> 449837dcd592cd5f3c6413ea3cac809ea9d4af5f
                            </button>
                        </div>
                    </div>
                </form>
<<<<<<< HEAD
                <a id="forget_password" href="<?= BASE_URL ?>login/sendEmail">Forget Your Password?</a>
=======
                <a id="forget_password" style="color:green;" href="<?= BASE_URL ?>login/sendEmail">Forget Your Password?</a>
>>>>>>> 449837dcd592cd5f3c6413ea3cac809ea9d4af5f
                <span class="errorMsg" id="forgetPassSpan"></span>
            </div>
        </div>
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-3"></div>
</div>
<script>
    $(document).ready(function () {
        $("form#loginForm").submit(function () {
            var obj = {"email": $("#accountEmail").val(), "password": $("#accountPass").val()};
            $.ajax({
                url: "<?= BASE_URL ?>login/index",
                method: 'POST',
                dataType: "text",
                data: obj,
<<<<<<< HEAD
//                processData: false,
//                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.status == "success" && data.type == 1) {
                        window.location = "<?= BASE_URL ?>product/index";
=======
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.status == "success" && data.type == 1) {
                        window.location = "<?= BASE_URL ?>orders/index";
>>>>>>> 449837dcd592cd5f3c6413ea3cac809ea9d4af5f
                    } else if (data.status == "success" && data.type == 0) {
                        window.location = "<?= BASE_URL ?>userpanel/index";
                    } else if (data.status == "failed") {
                        $("#loginError").html("Error in Username or Password !!")
<<<<<<< HEAD
//                        alert("Error in Login .. !!");
=======
>>>>>>> 449837dcd592cd5f3c6413ea3cac809ea9d4af5f
                    }
                },
                error: function (errorData) {
                    console.log(errorData);
                    alert("Error in F process");
                },
            });
            return false;
        });
    });

</script>
