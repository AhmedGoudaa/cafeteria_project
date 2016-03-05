<h1><b>Checks</b> </h1>
<form method="POST" action="<?= BASE_URL ?>test">  
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
        
         <input class="btn btn-success"  value="Filter"type="submit">
       
    </div>
     
</div>
    
 </form> 

<div class="form-group">
 <label for="sel1">Select :</label>
 <select   id="userlist">
     <option  value="" disabled selected hidden>User</option>

     
    </select>

</div>



<table class='table table-condensed table-hover table-striped table-bordered' style="text-align: center; border-collapse:collapse" >
    <thead>
        <tr>
            <th style="text-align: center;"> </th>
            <th style="text-align: center;"> Name  </th>
            <th style="text-align: center;"> total amount </th>

        </tr>
    </thead>
    <tbody>
        <tr id="table_head"></tr>


    </tbody>

</table>






<script>
    $(document).ready(function () {
        $("#userlist").on('change', function () {
                  $('<form action="<?= BASE_URL ?>test" method="POST">' + 
                '<input type="hidden" name="userId" value="' + $(this).val() + '">' +
                '</form>    ').submit();
//    alert($(this).val());
        });
  
        (function update() {
            $.ajax({
            type: "GET",
                    url: "<?= BASE_URL ?>test/update",
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

             var l=0;
             for(i = 0; i < data.insertData.usersArr.length; i++){
                 $("#userlist").append("<option class='detail' value="+data.insertData.usersArr[i]['id']+">"+data.insertData.usersArr[i]['name']+"</option>")
                 
        }
           for(i = 0; i < data.insertData.usersOrder.length; i++){
                 var  x="<tr  class='detail'  data-toggle='collapse' data-target='#adem"+i+"' class='accordion-toggle' ><td id='td"+i+"'><span  class='glyphicon glyphicon-plus'></span></td><td >"+data.insertData.usersOrder[i]['user_name'] +"</td><td>"+data.insertData.usersOrder[i]['total']+"</td></tr>" ;
                    var y=" <tr class='detail'><td colspan='3' class='hiddenRow'><div class='accordian-body collapse' id='adem"+i+"'> <table wight='70%' class='table table-condensed table-hover table-striped table-bordered'  style='text-align: center; border-collapse:collapse' ><thead><tr class='detail'><th style='text-align: center;'></th><th style='text-align: center;'> Order Date </th><th style='text-align: center;'> amount </th></tr></thead><tbody><tr class='detail' id='table2_head'></tr></tbody></table></div></td>></tr>"  
                                        var row=x+y;                                                            

						         $("#table_head").after(row);



                       for(j = 0; j < data.insertData.orders.length; j++){

                                                        if(data.insertData.orders[j]['user_id']=== data.insertData.usersOrder[i]['id']){


                                                        var dd ="<tr   class='detail' data-toggle='collapse' data-target='#dem"+l+"' class='accordion-toggle'><td id='td"+l+"'><span class='glyphicon glyphicon-plus'></span></td><td > "+data.insertData.orders[j]['order_date']+"</td><td>"+data.insertData.orders[j]['total_price']+"</td></tr><tr class='detail'><td colspan='5' class='hiddenRow'><div class='accordian-body collapse' id='dem"+l+"'><div class='row' ><div  id='" + j + "' class='col-md-12 col-lg-12 col-xs-12 col-sm-12 hero-feature clientdiv'></div> </div></div> </td>";
               
						        $("#table2_head").after(dd);


						        	for(k = 0; k < data.insertData.allOrdersDetails.length; k++){
                       
                                                                  if(data.insertData.orders[j]['id']===data.insertData.allOrdersDetails[k]['id']){

                                              			  var tt = "<div class='detail col-sm-4 col-md-4 col-lg-3 col-xs-6'><img  src='<?= BASE_URL ?>uploads/products/" + data.insertData.allOrdersDetails[k]['photo'] + "'  width='70' height='70'><div class='caption'><h3>" + data.insertData.allOrdersDetails[k]['name'] + "</h3><p>" + data.insertData.allOrdersDetails[k]['price'] + "</p><p>" + data.insertData.allOrdersDetails[k]['quantity'] + "</p></div></div> ";


                                              			  $("#" +j).after(tt);


                                                        }


                                                 }       







                                                    }
                                                    l++;
						        }  
						       
						        
						    
                                                      
                l++;
                                                                       }
                                                                       
                                                for(n=0;n<(data.insertData.orders.length+data.insertData.usersOrder);n++){
                                                
                                                 $("#dem"+n).on("hide.bs.collapse", function(){
                                                    $("#td"+n).html('<span class="glyphicon glyphicon-plus"></span> '); 

                                                    });
                                                    $("#dem"+n).on("show.bs.collapse", function(){
                                                        $("#td"+n).html('<span class="glyphicon glyphicon-minus"></span> ');   
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
