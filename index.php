<?php
$con = mysqli_connect("localhost","root","","pagination");
$per_page = 5;
$start = 0;
$current_page = 1;
if(isset($_GET['start'])){
    $start = $_GET['start'];
    if($start<=0){
    $start=0;
    $current_page = 1;
    }
    else{
    $current_page = $start;
    $start--;
    $start = $start*$per_page;
    }     
   }
$record = mysqli_num_rows(mysqli_query($con,"select * from pages"));
$page = ceil($record/$per_page);
if($start<$page){
}
$sql = "select * from pages limit $start, $per_page";
$res = mysqli_query($con,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<section class="col-lg-12">
   <?php
   if(mysqli_num_rows($res)>0){

   while($row = mysqli_fetch_assoc($res)){
    ?>
    <div class="col-md-6 bg-red"><?php echo $row['title']?></div><br>
    <?php
   }} else {
    echo "<h3>No Record Found</h3>";
   }?> 
</section>

<nav aria-label="...">
  <ul class="pagination">
  <?php  
  // for print no of pages
  for($i=1;$i<=$page;$i++){ 
    $class="";
    //for active class
   if($current_page == $i){
    ?>
    <li><a class="page-link active" <?php echo $class;?> href="javascript:void(0)"><?php echo $i;?></a></li>
    <?php
   }
   else{
   ?>
  <li><a class="page-link" <?php echo $class;?> href="?start=<?php echo $i;?>"><?php echo $i;?></a></li>
   <?php 
  } } 
?>   
  </ul>
</nav>
</body>
</html>
