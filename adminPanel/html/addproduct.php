<?php
// include('query.php');
include('header.php');
?>


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
                <div class="col-md-6 ">
                    <h3> ADD PRODUCT</h3>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="pName" id="" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>

                        <div class="form-group">
                            <label for="">Des</label>
                            <input type="text" name="pDes" id="" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="">Qty</label>
                            <input type="text" name="pQty" id="" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>

                        <div class="form-group">
                            <label for="">price</label>
                            <input type="text" name="pPrice" id="" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>

                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" name="pImage" id="" class="form-control" placeholder=""
                            aria-describedby="helpId">
                        </div>  
                        <div class="form-group">
                          <label for="">Select Category</label>
                          <select class="form-control" name="cId" id="">
                            <option>Select category</option>
                            <?php
                            $query = $pdo->query("select * from categories");
                            $allcategories = $query->fetchAll(PDO::FETCH_ASSOC);
                            foreach($allcategories as $key => $cat){
                             ?>
                             <option value="<?php echo $cat['id']?>"><?php
                             echo $cat['name']?></option>
                             <?php   
                            }
                            ?>
                          </select>
                        </div>
                        <button class="btn btn-primary mt-3" name="addProduct"
                        type="submit">Add Product</button>
                    </form>
                    </div>
                </div>
            </div>
            <!-- Blank End -->


            <?php
           include('footer.php')
           ?>