
<table   id="myTableId" class='table table-condensed table-hover table-striped table-bordered' style="text-align: center; border-collapse:collapse" >
     <thead>
        <tr >
            <th style="text-align: center;"> Order date </th>
            <th style="text-align: center;"> Name </th>
            <th style="text-align: center;"> Room </th>
            <th style="text-align: center;"> Ext </th>
            <th style="text-align: center;"> Action </th>
            
        </tr>
     </thead>
     <tbody>
           <tr id="table_head"></tr>
         
         
     </tbody>
 
</table>

<script>
$(document).ready(function(){
    
   (function update() {
		    	$.ajax({
		    			type: "GET",
		        		url: "<?= BASE_URL ?>orders/update",             
		        		dataType: "text",   //expect html to be returned                
		        		success:   function(response){                    
           							 //$("#responsecontainer").html(response); 
//            							alert(response);
            							var data=JSON.parse(response);
//                                                               console.log("hi");
////            							var products=data.insertData[0];
////            							console.log(data.insertData[0][1]);
////            							alert(data.insertData);
//            							console.log(data.insertData);
//            				
//						    if (data.insertData){
						    	$(".detail").remove();
						        for(i = 0; i < data.insertData.orders.length; i++){
//						           
                                                        var row = "<tr class='detail' id="+i+"><td >"+data.insertData.orders[i]['order_date']+"</td><td >"+data.insertData.orders[i]['name']+"</td><td>"+data.insertData.orders[i]['room_no']+"</td><td>"+data.insertData.orders[i]['ext']+"</td><td><form action='' method='POST'><input type='text' name='orderId'  hidden value="+data.insertData.orders[i]['id']+"><br><input type='submit' value='Deliver'></form></td></tr><tr class='detail'><td colspan='5'><div class='row' ><div  id="+i+" class='col-md-12 col-lg-12 col-xs-12 col-sm-12 hero-feature clientdiv'><p style='position:absolute; margin:auto; bottom:0; right:50px;'> <b>Total "+data.insertData.orders[i]['total_price']+" LE<b> </p></div> </div> </td></tr> "
//					        	var pros_div= "<div class='col-sm-6 col-md-4 col-lg-4 col-xs-6 mainList' > <button id='addProduct' style='width:100%' prod_id="+data.insertData[i][0]+" prod_name=\""+data.insertData[i][1]+"\" prod_price="+data.insertData[i][2] +"><img width='100%' height='100px'  src='<?= BASE_URL ?>uploads/products/"+data.insertData[i][4]+"'/></button> <span style='color:blue; font-size:20px; display:block;'>"+data.insertData[i][1]+" "+"<span style='color:red;font-weight:bold ; font-size:25px;'>"+data.insertData[i][2]+" L.E</span></span> </div>"	;					           
						         $("#table_head").after(row);
                                                          for(j = 0; j < data.insertData.proOrdersDetails.length; j++){
//						   <tr><td colspan="12" >
                                                        if(data.insertData.orders[i]['id']===data.insertData.proOrdersDetails[j]['orderId']){
                                                        var dd ="<div class='detail col-sm-4 col-md-4 col-lg-3 col-xs-6'><img  src='<?= BASE_URL ?>uploads/products/"+data.insertData.proOrdersDetails[j]['photo']+"'  width='70' height='70'><div class='caption'><h3>"+data.insertData.proOrdersDetails[j]['name']+"</h3><p>"+data.insertData.proOrdersDetails[j]['price']+"</p><p>"+data.insertData.proOrdersDetails[j]['quantity']+"</p></div></div>";
               
						        $("#"+i).after(dd);
                                                    }
						        }  
						       
						        }
//						    }    
						     
						    
       								 }                  

		   				}).then(function() {           // on completion, restart
		       				setTimeout(update,5000);  // function refers to itself
                                               

		    				});
			})();
   
   
   
   
    
});



</script>
