<?php
include('query.php');
include('header.php');
?>
<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = $pdo->prepare("select products.*,categories.name as cName,categories.id as catId from products inner join categories on products.c_id = categories.id where products.id = :pId");
    $query->bindparam('pId',$id);
    $query->execute();
    $product = $query->fetch(PDO::FETCH_ASSOC);
    //print_r($cat)
}
?>

            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
                <div class="col-md-6 ">
                    <h3> update Product</h3>
                    
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" value="<?php echo $product['name']?>" name="pName" id="" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>

                        <div class="form-group">
                            <label for="">Des</label>
                            <input type="text" value="<?php echo $product['des']?>"  name="pDes" id="" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>

                        <div class="form-group">
                            <label for="">Price</label>
                            <input type="text" value="<?php echo $product['price']?>"  name="pPrice" id="" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>

                        <div class="form-group">
                            <label for="">Qty</label>
                            <input type="text" value="<?php echo $product['qty']?>"  name="pQty" id="" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>

                        <div class="form-group">
                          <label for="">select category</label>
                          <select class="form-control" name="cId" id="">
                            <option value="<?php echo $product['catId']?>"><?php echo $product['cName']?></option>
                            <?php
                            $query = $pdo->prepare("select * from categories where name != :cName");
                            $query->bindparam('cName',$product['cName']);
                            $query->execute();
                            $allcat = $query->fetchAll(PDO::FETCH_ASSOC);
                            foreach($allcat as $cat){
                                ?>
                           <option value="<?php echo $cat['id']?>"><?php echo $cat['name']?></option>
                            <?php
                            }
                            ?>
                          </select>
                          
                        </div>

                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" name="pImage" id="" class="form-control" placeholder=""
                            aria-describedby="helpId">
                            <span><?php echo $product['image']?></span>
                        </div>  
                        <button class="btn btn-primary mt-3" name="updateProduct"
                        type="submit">update Product</button>
                    </form>
                    </div>
                </div>
            </div>
            <!-- Blank End -->


            <?php
           include('footer.php')
           ?>