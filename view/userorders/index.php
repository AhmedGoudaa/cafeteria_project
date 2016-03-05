<h1><b>My Orders</b> </h1>

<form method="POST" action="<?= BASE_URL ?>userorder">  
    <div class="container">


        <div class='col-md-5'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker6'>

                 <input type="Text" placeholder="Date From" id="demo1" maxlength="25" size="25"  name="datefrom" />
        <img src="<?= BASE_URL ?>static/js/images2/cal.gif" onclick="javascript:NewCssCal('demo1')" style="cursor:pointer"/>                
            </div>
        </div>
    </div>
    <div class='col-md-5'>
        <div class="form-group">
            <div class='input-group date' id='datetimepicker7'>
                <input type="Text"  placeholder="Date to" id="demo2" maxlength="25" size="25"  name="dateto"    />
        <img src="<?= BASE_URL ?>static/js/images2/cal.gif" onclick="javascript:NewCssCal('demo2')" style="cursor:pointer"/> 
                </div>

            </div>

        </div>
        <div class='col-md-2'>

            <input id="checkFilter" class="btn btn-success"  value="Filter"type="submit">

        </div>

    </div>

</form> 


<table class='table table-condensed table-hover table-striped table-bordered' style="text-align: center; border-collapse:collapse" >
    <thead>
        <tr>
            <th style="text-align: center;"> </th>
            <th style="text-align: center;"> Order date </th>
            <th style="text-align: center;"> Status </th>
            <th style="text-align: center;"> Amount </th>
            <th style="text-align: center;"> Action </th>
        </tr>
    </thead>
    <tbody>
        <tr id="table_head"></tr>


    </tbody>

</table>
<span><h2><b>  <?php echo str_repeat('&nbsp;', 175) . "  "; ?>total </b><b>  <?php echo str_repeat('&nbsp;', 10) . $data['total'] . " "; ?>LE </b></span></h2></span> 
<script>


    $(document).ready(function () {
<?php
$k = 1;
foreach ($data['orders'] as $order):
    ?>
            $("#<?= "dem" . $k; ?>").on("hide.bs.collapse", function () {
                $("#<?= "td" . $k; ?>").html('<span class="glyphicon glyphicon-plus"></span> ');

            });
            $("#<?= "dem" . $k; ?>").on("show.bs.collapse", function () {
                $("#<?= "td" . $k; ?>").html('<span class="glyphicon glyphicon-minus"></span> ');
            });
    <?php
    $k++;
endforeach;
?>
    });
</script>


    


<script>
    $(document).ready(function () {

        (function update() {
            $.ajax({
            type: "GET",
                    url: "<?= BASE_URL ?>userorder/update",
                    dataType: "text", //expect html to be returned                
                    success:   function (response) {
                        //$("#responsecontainer").html(response); 
//                        alert(response);
                        var data = JSON.parse(response);
//                        console.log("hi");
////            							var products=data.insertData[0];
//            							console.log(data.insertData[0][1]);
//            							alert(data.insertData);
//                        console.log(data.insertData);
//            				
		   if (data.insertData){
                        $(".detail").remove();

                        for (i = 0; i < data.insertData.orders.length; i++){
                        action = "";
                                if (data.insertData.orders[i]['status'] === "processing"){
                        action = "<form action='' method='POST'><input type='text' name='orderId'  hidden value=" + data.insertData.orders[i]['id'] + "><br><input type='submit' value='cancel'></form>";
                        } else {
                        action = "";
                        }

                        var row = "<tr  class='detail'  data-toggle='collapse' data-target='#dem" + i + "' class='accordion-toggle'><td id='td" + i + ">'><span  class='glyphicon glyphicon-plus'><span></td><td >" + data.insertData.orders[i]['order_date'] + "</td><td>" + data.insertData.orders[i]['status'] + "</td><td>" + data.insertData.orders[i]['total_price'] + "</td><td>" + action + " </td></tr><tr  class='detail'><td colspan='5' class='hiddenRow'><div class='accordian-body collapse' id='dem"+i+"'><div class='row' ><div  id=" + i + " class='col-md-12 col-lg-12 col-xs-12 col-sm-12 hero-feature clientdiv'></div> </div></div> </td>";
                                $("#table_head").after(row);
                                for (j = 0; j < data.insertData.ordersdetails.length; j++){
                                          if (data.insertData.orders[i]['id'] === data.insertData.ordersdetails[j]['id']) {
                                             var dd = "<div class='detail col-sm-4 col-md-4 col-lg-3 col-xs-6'><img  src='<?= BASE_URL ?>uploads/products/" + data.insertData.ordersdetails[j]['photo'] + "'  width='70' height='70'><div class='caption'><h3>" + data.insertData.ordersdetails[j]['name'] + "</h3><p>" + data.insertData.ordersdetails[j]['price'] + "</p><p>" + data.insertData.ordersdetails[j]['quantity'] + "</p></div></div> ";

                                                                               $("#" + i).after(dd);
                                                                                }
                                                                            }
                           $("#dem"+i).on("hide.bs.collapse", function(){
               $("#td"+i).html('<span class="glyphicon glyphicon-plus"></span> '); 

               });
               $("#dem"+i).on("show.bs.collapse", function(){
                   $("#td"+i).html('<span class="glyphicon glyphicon-minus"></span> ');   
               });                                        

                                                                       }
                                                                       }


        }               

                                                           }).then(function () {           // on completion, restart
		       				setTimeout(update,5000);  // function refers to itself


                                                           });
                                               })();
                                                       });



</script>
