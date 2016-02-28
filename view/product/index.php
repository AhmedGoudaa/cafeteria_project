
<button class='btn btn-success' data-toggle='modal' data-target='#addProductModal'><span class="glyphicon glyphicon-plus"></span> Add Product</button>
<table id="productsTable" class='table table-hover table-striped table-bordered' style="text-align: center;">
    <thead>
        <tr>
            <th style="text-align: center;"> Product </th>
            <th style="text-align: center;"> Price </th>
            <th style="text-align: center;"> image </th>
            <th style="text-align: center;"> Action </th>
        </tr>
    </thead>
    <?php
    if (!empty($data['products'])):
        foreach ($data['products'] as $product):
            ?>
            <tr class='info' id="<?= $product['id'] ?>">
                <td class="product_name"><?= $product['name'] ?></td><td class="product_price"><?= $product['price'] ?> EGP</td><td class="product_photo"><img width='150px' height='100px' src="<?= BASE_URL ?>uploads/products/<?= $product['photo'] ?>"/></td><td><button class="btn btn-default">unavailable</button>|<button class="btn btn-info fillEditProduct" data-toggle='modal' data-target='#editProductModal'><span class='glyphicon glyphicon-pencil'>Edit</span></button>|<button class="btn btn-danger deleteProduct" id="<?= $product['id'] ?>"><span class='glyphicon glyphicon-remove'>Delete</span></button></td>
            </tr>
            <?php
        endforeach;
    endif;
    ?>
</table>

<div class='modal fade' id='addProductModal'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-heading'>
                <div class='modal-title'>
                    <h2 class='bg-primary'>Add Product</h2>
                </div>
            </div>
            <div class='modal-body'>

                <form role="form" id="addProductForm">
                    <div class="form-group has-success">
                        <label for="text">Name:  </label>
                        <input type="text" id="product_name" name="product_name" class="form-control" required/>
                        <span class="errorMsg" id="p_nameError"></span>
                    </div>
                    <div class="form-group  has-success " >
                        <label >Choose Category:</label>
                        <select id="product_cat" name="product_cat" required>
                            <?php foreach ($data['categories'] as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= $cat['cat_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="errorMsg" id="p_catError"></span>
                    </div>
                    <div class="form-group  has-success " >
                        <label >Upload image:</label>
                        <span class="btn btn-default btn-file">
                            Browse <input type="file" id="product_photo" class="form-control" name="product_photo" required/>
                        </span>
                        <label id="filePath"></label>
                        <span class="errorMsg" id="fileError"></span>
                    </div>
                    <div class="form-group  has-success">
                        <label >Unit price:</label>
                        <input min="1" type="number" id="product_price" name="product_price"  class="form-control" required/>
                        <span class="errorMsg" id="p_priceError"></span>
                    </div>

                    <div class='modal-footer'>
                        <button id="addProduct" type="submit" class="btn btn-info">Add product</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='editProductModal'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-heading'>
                <div class='modal-title'>
                    <h2 class='bg-primary'>Edit Product</h2>
                </div>
            </div>
            <div class='modal-body'>

                <form role="form" id="editProductForm">
                    <div class="form-group has-success">
                        <label for="text">Name:  </label>
                        <input type="text" id="e_product_name" name="e_product_name" class="form-control" required/>
                        <span class="errorMsg" id="e_p_nameError"></span>
                    </div>
                    <div class="form-group  has-success " >
                        <label >Choose Category:</label>
                        <select id="e_product_cat" name="e_product_cat" required>
                            <?php foreach ($data['categories'] as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= $cat['cat_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="errorMsg" id="e_p_catError"></span>
                    </div>
                    <div class="form-group  has-success " >
                        <label >Upload image(upload new one or keep the old):</label>
                        <span class="btn btn-default btn-file">
                            Browse <input type="file" id="e_product_photo" class="form-control" name="e_product_photo" />
                        </span>
                        <label id="filePath"></label>
                        <span class="errorMsg" id="e_fileError"></span>
                    </div>
                    <div class="form-group  has-success">
                        <label >Unit price:</label>
                        <input min="1" type="number" id="e_product_price" name="e_product_price"  class="form-control" required/>
                        <span class="errorMsg" id="e_p_priceError"></span>
                    </div>
                    <input type="hidden" id="editID" name="editID">
                    <div class='modal-footer'>
                        <button id="editProduct" type="submit" class="btn btn-info">Edit product</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('.btn-file #product_photo').change(function () {
            $(".btn-file ~ #filePath").text("");
            $(".btn-file ~ #filePath").text($(this).val());
        });

        $('.btn-file #e_product_photo').change(function () {
            $(".btn-file ~ #filePath").text("");
            $(".btn-file ~ #filePath").text($(this).val());
        });
//////////////Delete Product//////////////////        
        $(document).on("click", ".deleteProduct", function () {
            var productRow = $(this);
            var obj = {
                product_id: $(this).attr("id"),
            }
//        console.log(JSON.stringify(obj))
            $.ajax({
                url: "<?= BASE_URL ?>product/deleteProduct",
                method: "post",
                dataType: "text",
//            contentType: 'application/json',
                data: obj,
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.status == "success") {
                        $(productRow).parent().parent().remove();
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


//////////////Add Product//////////////////
        function createRow(obj) {
            return "<tr class='info' id=" + obj['id'] + "><td class='product_name'>" + obj["name"] + "</td><td class='product_price'>" + obj["price"] + " EGP</td><td class='product_photo'><img width='150px' height='100px' src='<?= BASE_URL ?>uploads/products/" + obj["photo"] + "'/></td><td><button class='btn btn-default'>unavailable</button>|<button class='btn btn-info fillEditProduct' data-toggle='modal' data-target='#editProductModal'><span class='glyphicon glyphicon-pencil'>Edit</span></button>|<button class='btn btn-danger deleteProduct' id=" + obj['id'] + "><span class='glyphicon glyphicon-remove'>Delete</span></button></td></tr>";
        }

        $("form#addProductForm").submit(function () {
            var form = $('#addProductForm')[0];
            var formData = new FormData(this);
            $(".errorMsg").html("");
            $.ajax({
                url: "<?= BASE_URL ?>product/addProduct",
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
                        if ($("#productsTable tbody").length == 0) {
                            newRow = "<tbody>" + newRow + "</tbody>";
                            $("#productsTable").append(newRow);
                        } else {
                            $("#productsTable tbody").append(newRow);
                        }

                        $('#addProductModal').modal('hide');
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
                        alert("Error in  add product!! .. try again");
                    }
                },
                error: function (errorData) {
                    console.log(errorData);
                    alert("Error in F process");
                },
            });
            return false;
        });


//////////////Edit Product//////////////////
        $(document).on("click", ".fillEditProduct", function () {
            $.ajax({
                url: "<?= BASE_URL ?>product/editProduct",
                method: "get",
                dataType: "text",
                data: {"product_id": $(this).parent().parent().attr("id")},
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.status == "success") {
                        $('#editProductModal #e_product_name').val(data.editRow[0].name);
                        $('#editProductModal #e_product_price').val(data.editRow[0].price);
                        $('#editProductModal #e_product_cat option[value="' + data.editRow[0].cat_id + '"]').prop('selected', true)
                        $('#editProductModal #editID').val(data.editRow[0].id);
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

        $("form#editProductForm").submit(function () {
            var form = $('#editProductForm')[0];
            var formData = new FormData(this);
            $(".errorMsg").html("");
            $.ajax({
                url: "<?= BASE_URL ?>product/editProduct",
                type: 'POST',
                enctype: "multipart/form-data",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.status == "success") {
                        var imgPath = "<?= BASE_URL ?>uploads/products/" + data.editData.photo;
                        $("#productsTable tr#" + data.editData.id).children(".product_photo").children("img").attr("src", imgPath);
                        $("#productsTable tr#" + data.editData.id).children(".product_name").text(data.editData.name);
                        $("#productsTable tr#" + data.editData.id).children(".product_price").text(data.editData.price + " EGP");
                        $('#editProductModal').modal('hide');

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
                        alert("Error in edit product!! .. try again \n don't use special character");
                    }
                },
                error: function (errorData) {
                    console.log(errorData);
                    alert("Error in F process");
                },
            });
            return false;
        });



        $('#addProductModal').on('hidden.bs.modal', function () {
            $('input').val('');
            $('.errorMsg').html('');
            $(".btn-file ~ #filePath").text("");
        });

        $('#editProductModal').on('hidden.bs.modal', function () {
            $('input').val('');
            $('.errorMsg').html('');
            $(".btn-file ~ #filePath").text("");
        });
    });
</script>