	<?php
		$type = $_SESSION['type'];
		$usrId= $_SESSION['user_id'];
		//echo $usrId;


	?>

    	<div id="main" class="container-fluid">
    		<div class="row">

    			<!--  data entry form -->
				<div  class="col-lg-4 col-md-4 col-lg-4 col-xs-4">

					<div class="row">
						<label >Selected Products:</label>
						<div id="selectedProducts">
						</div>

					</div>

					<div>
						<form role="form"  method="post">

							<input class="form-control" type="hidden" name="order_id" 	 id="order_id"		value=""/>
							<input class="form-control" type="hidden" name="user_id" 	 id="user_id"		value=""/>
							<!--<input class="form-control" type="hidden" name="room_id" 	 id="room_id"		value=""/> -->

							    		<?php $time=time(); 
											$timeNow=date('Y-m-d H:i:s',$time ) ;?>
			
							<input class="form-control" type="hidden" name="order_date"  id="order_date"	value="<?=$timeNow?>"/>


							<input class="form-control" type="hidden" name="status" 	 id="status"		value="processing"/>
							<input class="form-control" type="hidden" name="t_price" 	 id="t_price"	value=""/>
							<input class="form-control" type="hidden" name="product_id"  id="product_id"	value=""/>
							<input class="form-control" type="hidden" name="quantity"    id="quantity"	    value=""/>

							<input class="form-control" type="hidden" name="order_details"    id="order_details"	    value=""/>

							<div class="form-group">
								<label for="notes">Notes:</label>
							    <textarea  class="form-control" rows="6" name="note" id="notes"></textarea>
						 	</div>

						 	<div class="form-group">
						 		<label for="room">Room:</label>
						 		<select name="room_id" class="form-control" id="room">

						 		<?php  
						   			 if (!empty($data[0])){
						        			for($i = 0; $i < count($data[0]); $i++){ ?>
						           
						            	<option  value="<?=$data[0][$i][0]?>"><?=$data[0][$i][1]?></option>						           
						       <?php }
						   		 }    
    							?>
								</select>
						 	</div>

							<div  class='row alert alert-success fade in'>
								<div class='col-sm-8 col-md-8 col-lg-8 col-xs-8 '></div>
								<div class=' col-sm-4 col-md-4 col-lg-4 col-xs-4 '>Total=<span class="tot_price">0</span> L.E</div>

							</div>


						  	<button type="submit" class="btn btn-success">Submit</button>
						</form>
					</div>






				</div>

				<!--  search field  -->
				<div  class="col-lg-2 col-md-2 col-lg-2 col-xs-2">





				</div>



				<!-- products list  -->
				<div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
					
							<div id="userSelect" class="">
						 		<label for="idUser">Add To User:</label>
						 		<select name="idUser" class="form-control" id="idUser">

						 		<?php  
						   			 if (!empty($data[2])){
						        			for($i = 0; $i < count($data[2]); $i++){ ?>
						           
						            	<option  value="<?=$data[2][$i][0]?>"><?=$data[2][$i][1].' ' ?><?=$data[2][$i][2] ?></option>						           
						       <?php }
						   		 }    
    							?>
								</select>
						 	</div>
						 	<hr/>

						 	
						 	<div class='col-sm-12 col-md-12 col-lg-12 col-xs-12' id="mostRequested" >
						 		<div><label >Most Requested Products:</label></div>
						 	<?php
						    if (!empty($data[3])){
						    	
						        for($i = 0; $i < count($data[3]); $i++){?>
						           
						            
						        	<div id="" class='col-sm-3 col-md-3 col-lg-3 col-xs-3' >
						        		<button ><img width='100%' height='80px'  src="<?= BASE_URL ?>/uploads/products/<?= $data[3][$i][3] ?>"/></button>
						        		<span style="color:blue; display:block;"><?=$data[3][$i][2].' ' ?><span style="color:red;font-weight:bold ;"><?= $data[3][$i][4].' L.E' ?></span> </span>
						        		
						        	</div>	
						        						           
						           
						       <?php }

						    }    
						     
						    
    						?>
		
						 	</div>
					 	
						 	<hr/>



						 <div id="">

							<!-- Main Title -->
							<div class="icon"></div>
							<h4 class="text-danger"><span class="glyphicon glyphicon-search"></span> Search Products</h4>
							

							<!-- Main Input -->
							<input type="text" id="search" >

							<!-- Show Results -->
							<h4 id="results-text">Showing results for: <b id="search-string"></b></h4>
							


						</div>

					<div class='col-sm-12 col-md-12 col-lg-12 col-xs-12'>
						<?php
						    if (!empty($data[1])){
						        for($i = 0; $i < count($data[1]); $i++){ ?>
						           
						            
						        	<div class='col-sm-5 col-md-3 col-lg-3 col-xs-5 mainList'>
						        		<button id="addProduct" style='width:100%' prod_id="<?=$data[1][$i][0]?>" prod_name="<?=$data[1][$i][1]?>" prod_price="<?=$data[1][$i][2]?>"><img width='100%' height='100px'  src="<?= BASE_URL ?>/uploads/products/<?= $data[1][$i][4] ?>"/></button>
						        		<span style="color:blue; font-size:20px"><?=	$data[1][$i][1].' ' ?><span style="color:red;font-weight:bold ; font-size:25px"><?= $data[1][$i][2].'L.E' ?></span></span>
						        		
						        	</div>						           
						           
						       <?php }

						    }    
						     
						    
    					?>


					<div id="productsList">
					</div>
				  </div>
				</div>

    		</div>

    	</div>


<script>
    $(document).ready(function () {

	var checkSearch = 0; 
/////////////////////////////////////search field///////////////////////////////
	// Icon Click Focus
	// $('div.icon').click(function(){
	// 	$('input#search').focus();
	// });

	//$("#search").delegate('#main',"change", search);
	$('input#search').on("change keyup paste mouseup",search);
	////// Live Search
	function search() {
		var query_value = $('input#search').val();
		$('b#search-string').text(query_value);
		if(query_value !== ''){
			$.ajax({
				type: "POST",
				dataType: "text", 
				url: "<?= BASE_URL ?>userpanel/search",
				data: { query: query_value },
				cache: false,
				success: function(response){
					var x= JSON.stringify(response);
					 var data=JSON.parse(x);
					 data=JSON.parse(data);
					if (data.insertData){

						checkSearch=1;

						$(".mainList").hide();
						$(".searchList").remove();
				        for(i = 0; i < data.insertData.length; i++){
				           
				            
			        	var pros_div= "<div class='col-sm-6 col-md-4 col-lg-4 col-xs-6 searchList' > <button id='addProduct' style='width:100%' prod_id="+data.insertData[i][0]+" prod_name=\""+data.insertData[i][1]+"\" prod_price="+data.insertData[i][2] +"><img width='100%' height='100px'  src='<?= BASE_URL ?>uploads/products/"+data.insertData[i][4]+"'/></button> <span style='color:blue; font-size:20px; display:block;'>"+data.insertData[i][1]+" "+"<span style='color:red;font-weight:bold ; font-size:25px;'>"+data.insertData[i][2]+" L.E</span></span> </div>"	;					           
				        
				        $("#productsList").before(pros_div);
				        }  

				    }  
				}


			});
		}else{
			checkSearch=0;
			$(".searchList").hide();
			$(".mainList").show();

		}    
	}

///////////////////////////////////////////////////////////////////////////////////////









    	<?php
    		if($type==1){ ?>
    				$("#userSelect").show();
				var uID= $("#idUser").val();

    			    $("#user_id").val(uID);

				    	$("#idUser").on("change", function() {
							var va =this.value;
				  			 $("#user_id").val(va); 
						});

					$("#mostRequested").hide();
		<?php
    		}else
    		{
			
    				echo '$("#mostRequested").show();';
    			    echo '$("#user_id").val('.$usrId.');';

    			    echo '$("#userSelect").hide();';


    		}

    	?>

  //   	$("#user_id").val($("#idUser").val());

  //   	$("#idUser").on("change", function() {
  // 			 $("#user_id").val(this.val()); 
		// });


    	(function update() {
		    	$.ajax({
		    			type: "GET",
		        		url: "<?= BASE_URL ?>userpanel/update",             
		        		dataType: "text",   //expect html to be returned                
		        		success:   function(response){                    
           							 //$("#responsecontainer").html(response); 
            							//alert(response.insertData);
            							var data=JSON.parse(response);
            							//var products=data.insertData[0];
            							//console.log(data.insertData[0][1]);
            							//alert(data.insertData);

            							//console.log(data.insertData);
            				
						    if (data.insertData){
						    	$(".mainList").remove();
						        for(i = 0; i < data.insertData.length; i++){
						           
						            
					        	var pros_div= "<div class='col-sm-6 col-md-4 col-lg-4 col-xs-6 mainList' > <button id='addProduct' style='width:100%' prod_id="+data.insertData[i][0]+" prod_name=\""+data.insertData[i][1]+"\" prod_price="+data.insertData[i][2] +"><img width='100%' height='100px'  src='<?= BASE_URL ?>uploads/products/"+data.insertData[i][4]+"'/></button> <span style='color:blue; font-size:20px; display:block;'>"+data.insertData[i][1]+" "+"<span style='color:red;font-weight:bold ; font-size:25px;'>"+data.insertData[i][2]+" L.E</span></span> </div>"	;					           
						        
						        $("#productsList").before(pros_div);


						        }

						        if(checkSearch==1){
						        	$(".mainList").hide();
						        }else{$(".mainList").show();}

						    }    
						     
						    
       								 }                  
		   
		            	//alert(response);
		                // pass existing options
		   				}).then(function() {           // on completion, restart
		       				setTimeout(update,5000);  // function refers to itself
		    				});
			})(); 


    	var noOfOccurance=[];
    	var requested_products = {};
    	var quantity=0;
    	var total_item_price=0;

    	var requested_products_details = {};

    	$('#main').delegate('#addProduct','click', addProduct_fn);




    	function addProduct_fn(){

    		
  
    		var exists=0;
    		var exist_prod_id;
    		var pro_id=$(this).attr("prod_id");
    			pro_id=parseInt(pro_id);
    		var pro_nam=$(this).attr("prod_name");
    		//alert(pro_nam);

    		var pro_pric=$(this).attr("prod_price");
    			pro_pric=parseFloat(pro_pric);
    			
    		for(var i=0;i<=noOfOccurance.length;i++)
    		{

    			if(noOfOccurance[i]===pro_id)
    			{
    				exist_prod_id=pro_id;
    				exists=1;
    				//alert("again");
    				img_plus_fn(pro_id,pro_pric);
    				break;
    			}


    		}

			//alert(exist_prod_id);

    		if (exists===0)
    			{

					var addPro = "<div id=" + (10000 + pro_id) + " class='row alert alert-success fade in'><div class='col-sm-3 col-md-3 col-lg-3 col-xs-3 '>"+pro_nam+"</div><div class='col-sm-5 col-md-5 col-lg-5 col-xs-5 '><label><a id='min_btn' min_id=" + (100 + pro_id) + "  class='minus  btn-lg btn btn-warning'  href='#'><i class='glyphicon glyphicon-minus'></i></a><span id="+(20+pro_id)+"  class='qu" + pro_id + " label label-primary'>1</span><a id='plus_btn' plus_id=" +pro_id + " class='plus  btn-lg btn btn-info' href='#'><i class='glyphicon glyphicon-plus'></i></a></label></div><div class='col-sm-2 col-md-2 col-lg-2 col-xs-2 '><span id="+(10+pro_id)+">" + pro_pric+"</span>L.E</div><div class='col-sm-2 col-md-2 col-lg-2 col-xs-2 '><a href='#' id='close_btn' class='close' close_id=" + (1000 + pro_id)  + " data-dismiss='alert' aria-label='close'>&times;</a></div></div>";
					$("#selectedProducts").after(addPro);
					noOfOccurance.push(pro_id);
					//total_item_price=pro_pric;
					requested_products[pro_id] = pro_pric;

					/////////////////////////item total prices counter//////////////
					requested_products_details[pro_id] = 1;

					//$('#order_details').val(requested_products_details);

					$('#order_details').val(JSON.stringify(requested_products_details));
					
					////////////////////////////////////////////////////////////////

					//////////////////total price counter////////////
								var total_price=$('.tot_price').text();
								//alert(total_price);
								total_price=parseFloat(total_price);
								total_price=total_price+pro_pric;
								$('.tot_price').text(total_price);

								$('#t_price').val(total_price);


					/////////////////////////////////////////////////			

    			}

    		
			

        };




        $('#main').delegate('#min_btn','click', min_fn);
		$('#main').delegate('#plus_btn','click', plus_fn);
		$('#main').delegate('#close_btn','click', close_fn);

//////////////////////////Select & Add prodauct/////////////////////////
		function plus_fn(e) {
			
			var ide=$(this).attr("plus_id");
			var k=parseInt(ide);
			
			e.preventDefault();
			var sp = parseFloat($(this).prev('span').text());
			var current_price = requested_products[k];
				$(this).prev('span').text(sp + 1);

					total_item_price=current_price * (sp+1)  ;

					/////////////////////////item total prices counter//////////////
					requested_products_details[k] = sp+1;
					//$('#order_details').val(requested_products_details);
					$('#order_details').val(JSON.stringify(requested_products_details));
					////////////////////////////////////////////////////////////////

				var requested_pric="#"+(10+k);
					$(requested_pric).text(total_item_price);


//////////////////total price counter////////////
			var total_price=$('.tot_price').text();
			//alert(total_price);
			total_price=parseFloat(total_price);
			total_price=total_price+current_price;
			$('.tot_price').text(total_price);
			$('#t_price').val(total_price);


/////////////////////////////////////////////////	


		};

		function img_plus_fn(proId,proPrice){
			var k=proId;
			
			var sp = parseFloat($("#"+(20+k)).text());

			var current_price = requested_products[k];
				$("#"+(20+k)).text(sp + 1);

					total_item_price=current_price * (sp+1)  ;

				/////////////////////////item total prices counter//////////////
					requested_products_details[k] = sp+1;

					//$('#order_details').val(requested_products_details);
					$('#order_details').val(JSON.stringify(requested_products_details));
				////////////////////////////////////////////////////////////////



				var requested_pric="#"+(10+k);
					$(requested_pric).text(total_item_price);


	//////////////////total price counter////////////
				var total_price=$('.tot_price').text();
				//alert(total_price);
				total_price=parseFloat(total_price);
				total_price=total_price+current_price;
				$('.tot_price').text(total_price);
				$('#t_price').val(total_price);


	/////////////////////////////////////////////////	

		};
///////////////////////////////////////////////////////////////////////////

/////////////////////////////minus operation///////////////////////////////

	function min_fn(e) {
			var idee=$(this).attr("min_id");
			var l=parseInt(idee)-100;
					e.preventDefault();
				var sp = parseFloat($(this).next('span').text());

				if (!isNaN(sp) && sp > 0) {


					$(this).next('span').text(sp - 1);

					var current_price = requested_products[l];

					total_item_price=current_price * (sp-1)  ;

					/////////////////////////item total prices counter//////////////
					//requested_products_details[l] = sp-1;
					//$('#order_details').val(requested_products_details);

					//$('#order_details').val(JSON.stringify(requested_products_details));

					////////////////////////////////////////////////////////////////



					var requested_pric="#"+(10+l);
					$(requested_pric).text(total_item_price);




			//////////////////total price counter////////////
						var total_price=$('.tot_price').text();
						//alert(total_price);
						total_price=parseFloat(total_price);
						total_price=total_price-current_price;
						$('.tot_price').text(total_price);
						$('#t_price').val(total_price);


			/////////////////////////////////////////////////////////////////////
			/////////////////////check if user removed an item///////////////////
				if(total_item_price===0){
					delete requested_products_details[l];
					//$('#order_details').val(requested_products_details);
					$('#order_details').val(JSON.stringify(requested_products_details));
				}
			/////////////////////////////////////////////////////////////////////	

				//alert(requested_products_details.toSource());


				} else if(sp===0) {
					$(this).next('span').text(0);


					//////////////remove element from array to be able to add again//////////////////////
					var index = noOfOccurance.indexOf(l);
					if (index > -1) {
    					noOfOccurance.splice(index, 1);
					}
					/////////////////////////////////////////////////////////////////////////////////////

					/////////////////////////item total prices counter//////////////
					
					//requested_products_details[k] = total_item_price;
					delete requested_products_details[l];
					//$('#order_details').val(requested_products_details);
					$('#order_details').val(JSON.stringify(requested_products_details));
					//alert(requested_products_details.toSource());
					////////////////////////////////////////////////////////////////
					
					$("#"+(10000+l)+"").remove();

				}

			};

///////////////////////////////////////////////////////////////////////////


////////////////////////////Close operation////////////////////////////////

		function close_fn(e) {

					
			 var ideee=$(this).attr("close_id");
			 var m=parseInt(ideee)-1000;
			 	e.preventDefault();

					//////////////remove element from array to be able to add again//////////////////////
					var index = noOfOccurance.indexOf(m);
					if (index > -1) {
    					noOfOccurance.splice(index, 1);
					}
					/////////////////////////////////////////////////////////////////////////////////////

					/////////////////////////item total prices counter//////////////

					//requested_products_details[k] = total_item_price;
					delete requested_products_details[m];
					//$('#order_details').val(requested_products_details);
					$('#order_details').val(JSON.stringify(requested_products_details));
					////////////////////////////////////////////////////////////////

					//alert(requested_products_details.toSource());

					//////////////////total price counter////////////
						var requested_pric="#"+(10+m);
						var current_price=$(requested_pric).text();

						var total_price=$('.tot_price').text();
						//alert(total_price);
						total_price=parseFloat(total_price);
						total_price=total_price-current_price;
						$('.tot_price').text(total_price);
						$('#t_price').val(total_price);


					/////////////////////////////////////////////////	
					
					$("#"+(10000+m)+"").remove();
			};


///////////////////////////////////////////////////////////////////////////



    });
</script>