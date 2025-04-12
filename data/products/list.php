<?php 
$count =1 ;
include_once '../env/database.php';
$selectProducts ="SELECT * FROM product_with_category order BY id DESC" ;
$allProducts =mysqli_query($conn, $selectProducts);
if (isset ($_GET['view'])){
   $id = $_GET ['view'];
   $selectOneProducts ="SELECT * FROM `product_with_category` where id=$id";
   $selectOneProductsItem =mysqli_query($conn,$selectOneProducts);
  $rowData = mysqli_fetch_assoc($selectOneProductsItem);
}else 
#Delte
# DELETE From products Where ID =1;
if (isset($_GET['delete'])){
    $id =$_GET['delete'];
    $delete ="DELETE From products Where ID =$id";
    mysqli_query($conn,$delete);
    header("location: Task SQL.php");
}
if (isset ($_GET['view'])){
    $id = $_GET ['view'];
    $selectOneProducts ="SELECT * FROM `product_with_category` where id=$id";
    $selectOneProductsItem =mysqli_query($conn,$selectOneProducts);
   $rowData = mysqli_fetch_assoc($selectOneProductsItem);
 }else 
?>
<?php 
include_once '../shared/head.php'; 
include_once '../shared/navbar.php';
?>
<h2 class ="text-center text-red my-6">All Product</h2>
<div class="container coi-md-6">
    <div class="card">
        <div class="card-body">
            <table class="table table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th colspan="3"> Action </th>
                   
                </tr>
                <?php foreach ($allProducts as $item):?>
                    <tr>
                        <th> <?= $count++ ?> </th>
                        <th> <?= $item ['prodName']?> </th>
                        <th> <a href="/WEB/data/products/list.php?view=<?= $item['id']?>"> <i class="text-info fa-solid fa-eye"></i> </a> </th>
                        <th> <a href="/WEB/data/products/ADD.php?edit=<?= $item['id']?>"> <i class="text-warning fa-solid fa-pen-to-square"></i> </a> </th>
                        <th> <a href="/WEB/data/products/list.php?delete=<?= $item['id']?>"> <i class="text-danger fa-solid fa-trash"></i> </a> </th>
                    </tr>
                <?php endforeach;?>
            </table>
        </div>
    </div>
    </div>
    <?php if (isset($_GET['view'])): ?>
        <h2 class ="text-center text-red my-4">CRUD DataBase<?= $rowData['prodName']?> </h2>
    <div class="mymodel">
    <div class="myconent"></div>
        
        <div class="card p-5">
        <h2>View Product 
             <a class ="float-end" href="/WEB/data/products/list.php"><i class="fa-solid fa-square-xmark"></i></a>
        </h2>
            <div class="card-body p-4">
         <h6>name :<?= $rowData['prodName']?></h6>
         <hr>
         <h6>price :<?= $rowData['price']?></h6>
         <hr>
         <h6>CategoryName :<?= $rowData['CategoryName']?></h6>
         <hr>
         <h6>description :<?= $rowData['description']?></h6>
         <hr>
            </div>
        </div>
    </div>
    <?php endif ;?>
    <?PHP include_once '../shared/script.php'; ?>