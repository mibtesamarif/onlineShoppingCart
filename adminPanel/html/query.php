<?php
session_start();
include('dbcon.php');

//add category

if(isset($_POST['addCategory'])){
    $cName = $_POST['cName'];
     $cDes = $_POST['cDes'];
      $cImageName = $_FILES['cImage']['name'];
      $cImageTmpName = $_FILES['cImage']['tmp_name'];
      $extension = pathinfo($cImageName,PATHINFO_EXTENSION);
      $destination = "../assets/img/".$cImageName;
      if($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension == "webp" || $extension == "jfif"){
            if(move_uploaded_file($cImageTmpName,$destination)){
                        $query = $pdo->prepare("insert into category(name , des, image) values(:cName , :cDes, :cImage)");
                        $query->bindParam('cName',$cName);
                           $query->bindParam('cDes',$cDes);
                              $query->bindParam('cImage',$cImageName);
                              $query->execute();
                               echo "<script>alert('category added successfully');
                             location.assign('index.php')</script>";
            }
      }
      else{
         echo "<script>alert('invalid extension');
                            </script>";
      }
}

// edit category

if(isset($_POST['updateCategory'])){
    $id =$_GET['id'];
    $cName = $_POST['cName'];
     $cDes = $_POST['cDes'];
     $query =$pdo->prepare("update category set name = :cName , des = :cDes where id = :id");
     if(isset($_FILES['cImage'])){
      $cImageName = $_FILES['cImage']['name'];
      $cImageTmpName = $_FILES['cImage']['tmp_name'];
      $extension = pathinfo($cImageName,PATHINFO_EXTENSION);
      $destination = "img/".$cImageName;
      if($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension == "webp" || $extension == "jfif"){
            if(move_uploaded_file($cImageTmpName,$destination)){
             $query =$pdo->prepare("update category set name = :cName , des = :cDes 
             , image = :cImage where id = :id");
                       
                              $query->bindParam('cImage',$cImageName);
                            
                              
            }
      }
    }
      $query->bindparam('id',$id);
      $query->bindParam('cName',$cName);
      $query->bindParam('cDes',$cDes);
      $query->execute();
      echo "<script>alert('category update successfully');
      </script>";
     
 }

 // delete work
if(isset($_GET['uid'])){
    $uid =$_GET['uid'];
    $query=$pdo->prepare("delete from category where id = :cid");
    $query->bindparam('cid',$uid);
    $query->execute();
 }

// add product

if(isset($_POST['addProduct'])){
    $pName = $_POST['pName'];
     $pDes = $_POST['pDes'];
     $pPrice = $_POST['pPrice'];
     $pQty = $_POST['pQty'];
     $cId = $_POST['cId'];
      $pImageName = $_FILES['pImage']['name'];
      $pImageTmpName = $_FILES['pImage']['tmp_name'];
      $extension = pathinfo($pImageName,PATHINFO_EXTENSION);
      $destination = "img/".$pImageName;
      if($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension == "webp" || $extension == "jfif"){
            if(move_uploaded_file($pImageTmpName,$destination)){
                        $query = $pdo->prepare("insert into product(name , des, price , qty , c_id , image) values(:pName , :pDes, :pPrice , :pQty ,:cId , :pImage)");
                        $query->bindParam('pName',$pName);
                           $query->bindParam('pDes',$pDes);
                           $query->bindParam('pPrice',$pPrice);
                           $query->bindParam('pQty',$pQty);
                           $query->bindParam('cId',$cId);
                              $query->bindParam('pImage',$pImageName);
                              $query->execute();
                               echo "<script>alert('Product added successfully');
                         </script>";
            }
      }
      else{
         echo "<script>alert('invalid extension');
                            </script>";
      }
 }

 // edit product

if(isset($_POST['updateProduct'])){
    $pId =$_GET['id'];
    $pName = $_POST['pName'];
     $pDes = $_POST['pDes'];
     $pPrice = $_POST['pPrice'];
     $pQty = $_POST['pQty'];
     $cId = $_POST['cId'];
     $query =$pdo->prepare("update product set name = :pName , des = :pDes , price = :pPrice , qty = :pQty
     ,c_id = :cId where id = :pId");
     if(isset($_FILES['pImage'])){
      $peImageName = $_FILES['pImage']['name'];
      $peImageTmpName = $_FILES['pImage']['tmp_name'];
      $extension = pathinfo($peImageName,PATHINFO_EXTENSION);
      $destination = "img/".$peImageName;
      if($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension == "webp" || $extension == "jfif"){
            if(move_uploaded_file($peImageTmpName,$destination)){
             $query = $pdo->prepare("update product set name = :pName , price = :pPrice , des = :pDes , qty = :pQty ,c_id= :cId , image = :pImage where id = :pId"); 
                       
                              $query->bindParam('pImage',$peImageName);
                            
                              
            }
      }
    }
    $query->bindParam('pId',$pId);
    $query->bindParam('pName',$pName);
    $query->bindParam('pPrice',$pPrice);
    $query->bindParam('pDes',$pDes);
    $query->bindParam('pQty',$pQty);
     $query->bindParam('cId',$cId);
     $query->execute();
      echo "<script>alert('product updated successfully');
      location.assign('viewProduct.php');
                        </script>";
  
      
      
 }
 
 // delete work
 if(isset($_GET['pid'])){
    $pid =$_GET['pid'];
    $query=$pdo->prepare("delete from product where id = :cid");
    $query->bindparam('cid',$pid);
    $query->execute();
 }
?>