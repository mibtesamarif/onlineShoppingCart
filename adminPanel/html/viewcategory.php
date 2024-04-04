<?php
include('query.php');
include('header.php');
?>


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
                <div class="col-md-6 ">
                    <h3> This is category page</h3>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>des</th>
                                <th>image</th>
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = $pdo->query("select * from category");
                            $allcat = $query->fetchAll(PDO::FETCH_ASSOC);
                            foreach($allcat as $cat){
                                ?>
                           
                            
                            <tr>
                                <td scope="row"><?php echo $cat['name']?></td>
                                <td><?php echo $cat['des']?></td>
                                <td><img height="100px" src="img/<?php echo $cat['image']?>" alt=""></td>
                                <td><a class = "btn btn-outline-info" href="editcategory.php?id=<?php echo $cat['id']?>">Edit</a></td>
                                <td><a class ="btn btn-outline-danger" href="?uid=<?php echo $cat['id']?>">Delete</a></td>

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