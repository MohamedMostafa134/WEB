<?php
$count =1 ;
$host ="localhost";
$user ="root";
$pasword ="";
$dbName = "shop";


try {
    $conn = mysqli_connect($host,$user,$pasword,$dbName);
} catch (Exception $e) {
echo $e-> getMessage ();
}
$selectCategories ="SELECT * FROM categories" ;
$AllCategories = mysqli_query($conn,$selectCategories );
$Massge =null ;
if (isset ($_POST['send'])){
    $name =$_POST ['name'];
    $price =$_POST ['price'];
    $category =$_POST ['category'];
    $insert ="INSERT INTO categories VALUES(null,'$name', $price , '$category' )";
   mysqli_query($conn, $insert );
    
}
$selectProducts ="SELECT * FROM product_with_category order BY id DESC" ;
$allProducts =mysqli_query($conn, $selectProducts);
if (isset ($_GET['view'])){
   $id = $_GET ['view'];
   $selectOneProducts ="SELECT * FROM `product_with_category` where id=$id";
   $selectOneProductsItem =mysqli_query($conn,$selectOneProducts);
  $rowData = mysqli_fetch_assoc($selectOneProductsItem);
}else 
#update
$name =null;
$price =null;
$categoryID =null;
$update= false ;
if(isset($_GET['edit'])){
    $update= true ;
    $id =$_GET['edit'];
    $selectOneProducts ="SELECT * FROM `products` where id=$id";
    $selectOneProductsItem =mysqli_query($conn,$selectOneProducts);
   $rowData = mysqli_fetch_assoc($selectOneProductsItem);
   $name =$rowData['name'];
   $name =$rowData['price'];
   $categoryID =$rowData['categoryID'];
   if(isset($_POST['update'])){
    $name =$_POST ['name'];
    $price =$_POST ['price'];
    $category =$_POST ['category'];
    $update ="UPDATE products SET name = '$name' , price =$price , categoryID = $category where id= $id  " ;
    mysqli_query($conn, $update );
    header("location: Task SQL.php");
   }
}


#Delte
# DELETE From products Where ID =1;
if (isset($_GET['delete'])){
    $id =$_GET['delete'];
    $delete ="DELETE From products Where ID =$id";
    mysqli_query($conn,$delete);
    header("location: Task SQL.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/al2l.main.css">
    <link rel="stylesheet" href="./css/all.main.css">
    <link rel="stylesheet" href="./css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body class="container col-md-6">
    
<h2 class ="text-center text-red my-4">CRUD DataBase</h2>

<div class="container coi-md-6">
    <div class="card">
        
        <div class="card-body">
            <Form method="post" >
            
           <div class="form-group">
            <input value="<?= $name ?>" name="name" type="text" placeholder="ProName" class="form-control"></div>
        </div>
           <div class="form-group">
            <input value="<?= $price ?>" name= "price" type="text" placeholder="ProPrice" class="form-control"></div>
        </div>
        <div class="form-group">
            <select name="category" id="" class="form-select">
                <option disabled selected>Select Category</option>
                <?php foreach ($AllCategories as $item): ?>
                    <?php if($item['id']==$categoryID) : ?>
                    <option selected value="<?= $item['id'] ?>"> <?= $item['name'] ?> </option>
                    <?php else: ?>
                    <option  value="<?= $item['id'] ?>"> <?= $item['name'] ?> </option>

                    <?php endif; ?>
                    <?php endforeach; ?>
            </select>
        </div>
        <div class="g-gri">
            <?php if($update): ?>
            <button name="update" class ="btn btn-warning w-50"> UPDATE </button>
            <?php else: ?>
            <button name="send" type="submit"  class="max-auto w-50 btn btn-info">ADD Product </button>
            <?php endif; ?>
        </div>
        </div>
        </Form>
    </div>
</div>


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
                        <th> <a href="Task SQL.php?view=<?= $item['id']?>"> <i class="text-info fa-solid fa-eye"></i> </a> </th>
                        <th> <a href="Task SQL.php?edit=<?= $item['id']?>"> <i class="text-warning fa-solid fa-pen-to-square"></i> </a> </th>
                        <th> <a href="Task SQL.php?delete=<?= $item['id']?>"> <i class="text-danger fa-solid fa-trash"></i> </a> </th>
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
             <a class ="float-end" href="task SQL.php"><i class="fa-solid fa-square-xmark"></i></a>
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
    
</body>

</html>