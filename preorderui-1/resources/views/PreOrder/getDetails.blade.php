<htlm>
<head>
	<script> 
$(document).ready(function(){
  $(".check").click(function(){
	  var t = $(this).attr('aid');   
	 
   $(".box"+t).slideDown("slow");
   document.getElementById("rrt"+t).style.display="none";
   document.getElementById("up"+t).style.display="block";
    document.getElementById("acct"+t).style.display="block";
   document.getElementById("rej"+t).style.display="block";
  });
   $(".up").click(function(){
    var t = $(this).attr('aid'); 
    
   $(".box"+t).slideUp("slow");
    document.getElementById("rrt"+t).style.display="block";
   document.getElementById("up"+t).style.display="none";
  });
});
</script>

<style>
.modal {
display: block; /* Hidden by default */
position: fixed; /* Stay in place */
z-index: 1; /* Sit on top */
left: 0;
top: -50px;
width: 120%; /* Full width */
height: 150%; /* Full height */
overflow: auto; /* Enable scroll if needed */
background-color: rgb(0,0,0); /* Fallback color */
background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
padding-top: 60px;
padding-left: 600px;
}

/* Modal Content/Box */
.modal-content {
background-color: #FEFEFE;
margin: 1% auto 5% auto; /* 5% from the top, 15% from the bottom and centered */
border: 1px solid #888;
width: 300%; /* Could be more or less, depending on screen size */
}

* {
box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
float: left;
width: 40%;
padding: 10px;
margin:0px 40px;
height: 350px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
content: "";
display: table;
clear: both;
}


</style>

<script>
// Get the modal
var modal = document.getElementById('id01');
var modal1 = document.getElementById('id02');

var modal2 = document.getElementById('id02');
var modal3 = document.getElementById('id03');


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
if (event.target == modal) {
modal.style.display = "none";
}
}

window.onclick = function(event) {
if (event.target == modal1) {
modal1.style.display = "none";
}
}

window.onclick = function(event) {
if (event.target == modal2) {
modal2.style.display = "none";
}
}
</script>
</head>
</htlm>

<?php
if(isset($_POST['getnot']))
{
?>
<div id="abc" style="; text-align: center;margin:0px 50px">
			<br></br>

     <b><a href="#"" id="del" class="newitem">New</span></a></b>

     <b><a  href='#' id="acct" class="acceptitem">Accepted</span></a></b>

     <b><a  href='#' id="var" class="getendorders">Ended</span></a></b>

    <hr></hr>
        <br><br>
      	
		</div>';
<?php
}



if(isset($_POST['getitem']))
{
?>

<div id="gtv" style=" text-align: center; margin-left:100px;">
<?php
$sel = DB::table('ordersTable')->groupBy('loginTable.userId')
              ->join('orderDetails', 'orderDetails.orderId', '=', 'ordersTable.orderId')
            ->join('loginTable','loginTable.userId','=','ordersTable.userId')

            ->select('*')->where('hotelId', Auth::id())->where('orderDetails.status','=',0)
            ->get();

            $cnt = DB::table('ordersTable')->groupBy('loginTable.userId')
              ->join('orderDetails', 'orderDetails.orderId', '=', 'ordersTable.orderId')
            ->join('loginTable','loginTable.userId','=','ordersTable.userId')

            ->select('*')->where('hotelId', Auth::id())->where('orderDetails.status','=',0)
            ->count();

if($cnt != 0)
{
            
        foreach($sel as $sett)
        {
    $uid =$sett->userId;

    echo $uid;
    echo $sett->orderId;


    $selus = DB::table('ordersTable')
           
            ->join('orderDetails', 'orderDetails.orderId', '=', 'ordersTable.orderId')
            ->join('loginTable','loginTable.userId','=','ordersTable.userId')
               ->join('menuList','menuList.recipeId','=','ordersTable.recipeId')
            ->select('*')->where('ordersTable.userId','=',$uid)->where('hotelId', Auth::id())->get();
      echo "
    <div id='yt' >";

       $id = $sett ->userId;
       echo $sett ->name;
       ?>

        <p2> <?php echo $sett ->estimatedTime;?> </p2>
       <b><button id="rrt{{$id}}" aid="{{$id}}" class="btn btn-danger check" style=";float:right;">Check</button>
       <button id="up{{$id}}" aid="{{$id}}" class="btn btn-danger up" style="display:none;float:right;">Up</button></b>
        
              <div id="box" class="box{{$id}}">
               <b style="float:left;"> PhoneNo:<?php echo $sett ->mobileNumber;?></b>
               <br>
          <table id="example" style="margin:0px 80px;">
                  <tr>

<th>
               RecipeID
            </th>
           
            <th>
               cost
           </th>
           
</tr>
       <?php
    foreach ($selus as $seld) {
  
$rid= $seld ->recipeId;
  $selres = DB::table('menuList')->select('recipeName')->where('recipeId','=',$rid)->get();
foreach ($selres as $resname) {
  $res = $resname->recipeName;
}
      ?>
     
<tr>
  <td><?php echo $res; ?></td>
  <td><?php echo $seld->totalAmount;?></td>
  
  </tr>
    <?php  

    }
    ?>
  </table>
  <br>
   <b><button  id="rej{{$id}}" aid="{{$id}}" class="btn btn-danger reject" style="display:none;float:right;margin:0px 50px 0px;">Reject</button></b>
      <b><button  id="acct{{$id}}" aid="{{$id}}" class="btn btn-danger accept" style="visibility: :none;float:right; ">Accept</button></b>
      <div>
<?php  $seldb=DB::table('ordersTable')->where('hotelId', Auth::id())->where('userId','=',$uid)->select(DB::raw("SUM(totalAmount) as count"))->groupBy('userId')->get();

  foreach($seldb as $ddd)
  {
    $tt = $ddd->count;
    echo "<b>Totalcost==".$tt."</b>";
  }  

  ?>
    
    </div>
                     
  </div>
                    <?php
      echo "</div>";

    }
  }
  else
  {
    echo "no items";
  }
}
    ?>
<?php
if(isset($_POST['getbox'])){

$rid = $_POST['aid'];

?>
<div id="id02" class="modal" >
<br>
<br>
<p></p>
<form method="post" class="modal-content animate" style="margin-left:90px;text-align:center;font-size:16px;width:30%">
<center>
<div>
<input type="hidden" name="rid" value="<?php echo $rid; ?>" id="hidden">
</div>
<h3>Reject Reason</h3>
<br>
<div>
Comments<br>
<textarea rows="6" cols="30" name="message" id="reason" placeholder="reason" required></textarea>

</div>
<br>
{{csrf_field()}}
<div>
<input type="button" id="adminmsg" name="box" value="submit">
</div>
<br>
<div>
</div>
<br>
</center>

</form>


</div>';
<?php

}
?>




<?php
    if(isset($_POST['getacceptitems']))
{
?>

<div id="gtv" style=" text-align: center; margin-left:100px;">
<?php
$sel = DB::table('ordersTable')->groupBy('loginTable.userId')
              ->join('orderDetails', 'orderDetails.orderId', '=', 'ordersTable.orderId')
            ->join('loginTable','loginTable.userId','=','ordersTable.userId')

            ->select('*')->where('hotelId', Auth::id())->where('orderDetails.status','=',1)
            ->get();

            $cnt1 = DB::table('ordersTable')->groupBy('loginTable.userId')
              ->join('orderDetails', 'orderDetails.orderId', '=', 'ordersTable.orderId')
            ->join('loginTable','loginTable.userId','=','ordersTable.userId')

            ->select('*')->where('hotelId', Auth::id())->where('orderDetails.status','=',1)
            ->count();

            if($cnt1 != 0)
            {
            
        foreach($sel as $sett)
        {
    $uid =$sett->userId;



    $selus = DB::table('ordersTable')
           
            ->join('orderDetails', 'orderDetails.orderId', '=', 'ordersTable.orderId')
            ->join('loginTable','loginTable.userId','=','ordersTable.userId')
               ->join('menuList','menuList.recipeId','=','ordersTable.recipeId')
            ->select('*')->where('ordersTable.userId','=',$uid)->where('hotelId', Auth::id())->get();
      echo "
    <div id='yt' >";

       $id = $sett ->userId;
       echo "<p><b> customerId:".$id."</b></p>";
       echo $sett ->name;
        echo"orderId-".$sett->orderId;
       ?>

        <p2> <?php echo $sett ->estimatedTime;?> </p2>
       <b><button id="rrt{{$id}}" aid="{{$id}}" class="btn btn-danger check" style=";float:right;">Check</button>
       <button id="up{{$id}}" aid="{{$id}}" class="btn btn-danger up" style="display:none;float:right;">Up</button></b>
        
              <div id="box" class="box{{$id}}">
               <b style="float:left;"> PhoneNo:<?php echo $sett ->mobileNumber;?></b>
               <br>
                <table id="example" style="margin:0px 80px;">
                	<tr>

<th>
               RecipeID
            </th>
           
            <th>
               cost
           </th>
           
</tr>
       <?php
    foreach ($selus as $seld) {
  
$rid= $seld ->recipeId;
  $selres = DB::table('menuList')->select('recipeName')->where('recipeId','=',$rid)->get();
foreach ($selres as $resname) {
  $res = $resname->recipeName;
}
      ?>
     
<tr>
	<td><?php echo $res; ?></td>
	<td><?php echo $seld->totalAmount;?></td>
	
	</tr>
    <?php  

    }
    ?>
  </table>
  <br>
   
      <b><button  id="acct{{$id}}" aid="{{$id}}" class="btn btn-success endorder" style="visibility: :none;float:right; ">End Order</button></b>
      <div>
<?php  $seldb=DB::table('ordersTable')->where('hotelId', Auth::id())->where('userId','=',$uid)->select(DB::raw("SUM(totalAmount) as count"))->groupBy('userId')->get();

	foreach($seldb as $ddd)
	{
		$tt = $ddd->count;
		echo "<b>Totalcost==".$tt."</b>";
	}  

	?>
		
    </div>

                     
  </div>


                    <?php
      echo "</div>";

    }
  }
  else
  {
echo "no item to show";

  }
    ?>
    


<?php
}

    ?>



    <?php
    if(isset($_POST['getendorders']))
{
?>

<div id="gtv" style=" text-align: center; margin-left:100px;">
<?php
$sel = DB::table('ordersTable')->groupBy('loginTable.userId')
              ->join('orderDetails', 'orderDetails.orderId', '=', 'ordersTable.orderId')
            ->join('loginTable','loginTable.userId','=','ordersTable.userId')

            ->select('*')->where('hotelId', Auth::id())->where('orderDetails.status','=',2)
            ->get();

            $cnt1 = DB::table('ordersTable')->groupBy('loginTable.userId')
              ->join('orderDetails', 'orderDetails.orderId', '=', 'ordersTable.orderId')
            ->join('loginTable','loginTable.userId','=','ordersTable.userId')

            ->select('*')->where('hotelId', Auth::id())->where('orderDetails.status','=',2)
            ->count();

            if($cnt1 != 0)
            {
            
        foreach($sel as $sett)
        {
    $uid =$sett->userId;



    $selus = DB::table('ordersTable')
           
            ->join('orderDetails', 'orderDetails.orderId', '=', 'ordersTable.orderId')
            ->join('loginTable','loginTable.userId','=','ordersTable.userId')
               ->join('menuList','menuList.recipeId','=','ordersTable.recipeId')
            ->select('*')->where('ordersTable.userId','=',$uid)->where('hotelId', Auth::id())->get();
      echo "
    <div id='yt' >";

       $id = $sett ->userId;
       echo "<p><b> customerId:".$id."</b></p>";
       echo $sett ->name;
       echo"orderId-".$sett->orderId;

       ?>

        <p2> <?php echo $sett ->estimatedTime;?> </p2>
       <b><button id="rrt{{$id}}" aid="{{$id}}" class="btn btn-danger check" style=";float:right;">Check</button>
       <button id="up{{$id}}" aid="{{$id}}" class="btn btn-danger up" style="display:none;float:right;">Up</button></b>
        
              <div id="box" class="box{{$id}}">
               <b style="float:left;"> PhoneNo:<?php echo $sett ->mobileNumber;?></b>
               <br>
                <table id="example" style="margin:0px 80px;">
                  <tr>

<th>
               RecipeID
            </th>
           
            <th>
               cost
           </th>
           
</tr>
       <?php
    foreach ($selus as $seld) {
  
$rid= $seld ->recipeId;
  $selres = DB::table('menuList')->select('recipeName')->where('recipeId','=',$rid)->get();
foreach ($selres as $resname) {
  $res = $resname->recipeName;
}
      ?>
     
<tr>
  <td><?php echo $res; ?></td>
  <td><?php echo $seld->totalAmount;?></td>
  
  </tr>
    <?php  

    }
    ?>
  </table>
  <br>
   
      <b><button  id="acct{{$id}}" aid="{{$id}}" class="btn btn-success endorder" style="visibility: :none;float:right; ">End Order</button></b>
      <div>
<?php  $seldb=DB::table('ordersTable')->where('hotelId', Auth::id())->where('userId','=',$uid)->select(DB::raw("SUM(totalAmount) as count"))->groupBy('userId')->get();

  foreach($seldb as $ddd)
  {
    $tt = $ddd->count;
    echo "<b>Totalcost==".$tt."</b>";
  }  

  ?>
    
    </div>

                     
  </div>


                    <?php
      echo "</div>";

    }
  }
  else
  {
echo "no item to show";

  }
    ?>
    


<?php
}

    ?>