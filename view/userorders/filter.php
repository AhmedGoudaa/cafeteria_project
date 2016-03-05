<?php  
//    $i =0;
//    $k=0; 
    ?>
<h1><b>My Orders</b> </h1>

<form method="POST" action="">  
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
<script type="text/javascript">
    $(function () {
        $('#datetimepicker6').datetimepicker();
        $('#datetimepicker7').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>
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
   <?php
    if (!empty($data['orders'])):
        $i=1;
        foreach ($data['orders'] as $order):
        
         $action ;
         if ($order['status']==="processing") {
            $action='<form action="" method="POST"> 
                        <input type="text" name="orderId"  hidden value='.$order['id'].'><br>
                    <input type="submit" value="cancel">
                </form>'; 
             
         }else {
                $action="";
            }
                       ?>
    
    
            <tr   data-toggle="collapse" data-target="<?php echo"#dem".$i;?>" class="accordion-toggle " >
                <td id="<?php echo"td".$i;?>"><span  class="glyphicon glyphicon-plus"></span></td>
                <td ><?= $order['order_date'] ?></td>
                <td><?= $order['status'] ?></td>
                <td><?= $order['total_price'] ?></td>
                <td><?= $action ?></td>
            </tr>
             <tr> 
                 <!--//$ordersdetails-->
                 <td colspan="12" class="hiddenRow"><div class="accordian-body collapse" id="<?php echo "dem".$i;?>">
                      
                         
                         
                         
                  <?php
                    foreach ($data['ordersdetails'] as $ods):
                        if($order['id']===$ods['id'])
                            {
                            ?>
                            
                               <div class="row" id="ro">
                             <div class="col-md-3 col-sm-6 hero-feature clientdiv">
                                 <div class="thumbnail"><img  src="<?= BASE_URL ?>uploads/products/<?= $ods['photo']?>"  width='70' height='70'>
                                     <div class="caption">
                                         <h3><?php echo $ods['name']; ?></h3>
                                         <p><?php echo$ods['price']; ?></p>
                                         <p><?php echo $ods['quantity']; ?></p>
                                     </div>
                                 </div>
                             </div>
                         <?php
                            
                           }
                            
                     
                               
                    endforeach;
                    ?>
               	
              
              </div> </td>
        </tr>
            <?php
            $i ++;
        endforeach;
    endif;
    ?>
    
</table>
<span><h2><b>  <?php echo str_repeat('&nbsp;', 175)."  ";?>total </b><b>  <?php echo str_repeat('&nbsp;', 10).$data['total']." ";?>LE </b></span></h2></span> 

<script>
   
    
    $(document).ready(function(){
         <?php
         $k=1;
         foreach ($data['orders'] as $order):
             
           ?>
               $("#<?=  "dem".$k;?>").on("hide.bs.collapse", function(){
               $("#<?=  "td".$k;?>").html('<span class="glyphicon glyphicon-plus"></span> '); 

               });
               $("#<?=  "dem".$k;?>").on("show.bs.collapse", function(){
                   $("#<?=  "td".$k;?>").html('<span class="glyphicon glyphicon-minus"></span> ');   
               });
      <?php
      $k++;
     endforeach; ?>
    });
</script>

