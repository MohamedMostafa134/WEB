<?php
include_once '../../env/database.php';

$selectCategories ="SELECT * FROM categories" ;
$AllCategories = mysqli_query($conn,$selectCategories );
$Massge =null ;
if (isset ($_POST['send'])){
    $name =$_POST ['name'];
    $price =$_POST ['price'];
    $category =$_POST ['category'];
    $insert ="INSERT INTO categories VALUES(null,'$name', $price , '$category' )";
   mysqli_query($conn, $insert );
   header("location: /WEB/data/products/list.php");
}

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
    header("location: /WEB/data/products/list.php");
   }
}




?>
<?php
include_once '../../shared/head.php'; 
include_once '../../shared/navbar.php';
?>
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

<?PHP include_once '../../shared/script.php'; ?>