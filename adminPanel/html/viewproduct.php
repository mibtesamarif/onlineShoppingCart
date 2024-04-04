<?php
include('query.php');
include('header.php');
?>

            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
                <div class="col-md-6 ">
                    <h3> product page</h3>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>des</th>
                                <th>qty</th>
                                <th>price</th>
                                <th>Category Name</th>                  
                                <th>image</th>
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = $pdo->query("select product.*,category.name as cName,category.id as catId from product inner join category on product.c_id = category.id");
                            $allproduct = $query->fetchAll(PDO::FETCH_ASSOC);
                            foreach($allproduct as $product){
                                ?>
                           
                            
                            <tr>
                                <td scope="row"><?php echo $product['name']?></td>
                                <td><?php echo $product['des']?></td>
                                <td><?php echo $product['price']?></td>
                                <td><?php echo $product['qty']?></td>
                                <td><?php echo $product['cName']?></td>
                                <td><img height="100px" src="img/<?php echo $product['image']?>" alt=""></td>
                                <td><a class = "btn btn-outline-info" href="editproduct.php?id=<?php echo $product['id']?>">Edit</a></td>
                                <td><a class ="btn btn-outline-danger" href="?pid=<?php echo $product['id']?>">Delete</a></td>

                                </tr>
                            <?php

                            }?>

                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <!-- Blank End -->

            <?php
           include('footer.php')
           ?>