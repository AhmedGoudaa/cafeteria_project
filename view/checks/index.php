<h1><b>Checks</b> </h1>
<form method="POST" action="">  
<div class="container">
    

    <div class='col-md-5'>
        <div class="form-group">
            <div class='input-group date' id='datetimepicker6'>
               
                <input placeholder="Date From" type="date" class="form-control"  name="datefrom"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-5'>
        <div class="form-group">
            <div class='input-group date' id='datetimepicker7'>
                <input   placeholder="Date To" type="date" class="form-control" name="dateto" />
               
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span> 
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
 <select  id="userlist">
     <option value="" disabled selected hidden>User</option>

       <?php
           
        foreach ($data['usersArr'] as $user):
        ?>
                    <option value=<?php echo $user['id'];?>><?php echo $user['name'];?></option>
      
                 <?php                              
                    endforeach;
                    ?>
     
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
    <?php
    //print_r($data);
    if (!empty($data['usersOrder'])):
        $i = 1;
        foreach ($data['usersOrder'] as $uOrders):
            ?>


            <tr   data-toggle="collapse" data-target="<?php echo"#dem" . $i; ?>" class="accordion-toggle " >
                <td id="<?php echo"td" . $i; ?>"><span  class="glyphicon glyphicon-plus"></span></td>
                <td ><?= $uOrders['user_name'] ?></td>
                <td><?= $uOrders['total'] ?></td>

            </tr>

            <tr> 
                <!--//$ordersdetails-->
                <td colspan="12" class="hiddenRow"><div class="accordian-body collapse" id="<?php echo "dem" . $i; ?>">  
                        <table wight="70%" class='table table-condensed table-hover table-striped table-bordered'  style="text-align: center; border-collapse:collapse" >
                            <thead>
                                <tr>
                                    <th style="text-align: center;"> </th>
                                    <th style="text-align: center;"> Order Date  </th>
                                    <th style="text-align: center;">  amount </th>

                                </tr>
                            </thead>
                            <?php
                            foreach ($data['orders'] as $ods):
                                if ($uOrders['id'] === $ods['user_id']) {
                                    $i++;
                                    ?>
                                     
                                    <tr   data-toggle="collapse" data-target="<?php echo"#dem" . $i; ?>" class="accordion-toggle " >
                                        <td id="<?php echo"td" . $i; ?>"><span  class="glyphicon glyphicon-plus"></span></td>
                                        <td ><?php echo $ods['order_date']; ?></td>
                                        <td><?php echo$ods['total_price']; ?></td>

                                    </tr>
                                    
                                    <tr> 
                 <!--//$ordersdetails-->
                 <td colspan="12" class="hiddenRow"><div class="accordian-body collapse" id="<?php echo "dem".$i;?>">
                      
                         
                         
                         
                  <?php
                    foreach ($data['allOrdersDetails'] as $allods):
                        if($ods['id']===$allods['id'])
                            {
                            ?>
                            
                               <div class="row" id="ro">
                             <div class="col-md-3 col-sm-6 hero-feature clientdiv">
                                 <div class="thumbnail"><img  src="<?= BASE_URL ?>uploads/products/<?= $allods['photo']?>"  width='70' height='70'>
                                     <div class="caption">
                                         <h3><?php echo $allods['name']; ?></h3>
                                         <p><?php echo $allods['price']; ?></p>
                                         <p><?php echo $allods['quantity']; ?></p>
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
                                }


                                
                            endforeach;
                            ?>


                        </table>> </td>
            </tr>
        <?php
        $i ++;
    endforeach;
endif;
?>

</table>

<script>
   
    
    $(document).ready(function(){
         <?php
//         $k=1;
         for ($k=1;$k<(count($data['usersOrder'])+count($data['orders']) );$k++):
             
           ?>
               $("#<?=  "dem".$k;?>").on("hide.bs.collapse", function(){
               $("#<?=  "td".$k;?>").html('<span class="glyphicon glyphicon-plus"></span> '); 

               });
               $("#<?=  "dem".$k;?>").on("show.bs.collapse", function(){
                   $("#<?=  "td".$k;?>").html('<span class="glyphicon glyphicon-minus"></span> ');   
               });
      <?php
//      $k++;
     endfor; ?>
             
             
             $("#userlist").on('change', function () {
                  $('<form action="" method="POST">' + 
                '<input type="hidden" name="userId" value="' + $(this).val() + '">' +
                '</form>    ').submit();
//    alert($(this).val());
        });

    });
</script>