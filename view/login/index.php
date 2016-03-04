<div class="row">
    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-3"></div>

    <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">

        <div class='panel panel-default'>
            <div class='panel-heading'>
                <h4 class='text-primary'>Login with your account</h4>
            </div>
            <div id='panel-content'>
                <span class="errorMsg" id="loginError"></span>
                <form role="form" method="post" id="loginForm">
                    <div class='panel-body'>
                        <label for="accountEmail">Email:</label>
                        <input class="form-control" type="email" id="accountEmail" name="accountEmail"
                               placeholder="Enter Email" required/>

                        <label for="accountPass">Password:</label>
                        <input class="form-control" type="password" id="accountPass" name="accountPass"
                               placeholder="Enter Password" required/>
                        <p></p>
                    </div>
                    <div class='panel-footer bg-primary' style="padding: 0px 14px;">
                        <div class="row">
                            <button type="submit" class="btn btn-primary col-sm-12 col-md-12 col-lg-12 col-xs-12"
                                    style="border-radius:0px">Login
                            </button>
                        </div>
                    </div>
                </form>
                <a id="forget_password" href="<?= BASE_URL ?>login/sendEmail">Forget Your Password?</a>
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
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.status == "success" && data.type == 1) {
                        window.location = "<?= BASE_URL ?>orders/index";
                    } else if (data.status == "success" && data.type == 0) {
                        window.location = "<?= BASE_URL ?>userpanel/index";
                    } else if (data.status == "failed") {
                        $("#loginError").html("Error in Username or Password !!")
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
