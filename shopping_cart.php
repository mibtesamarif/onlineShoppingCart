<?php
  include('header.php');
  ?>
    <?php
	if(isset($_POST['addtocart'])){
		if(isset($_SESSION['finalCart'])){
			$productId = array_column($_SESSION['finalCart'],'pId');
			if(in_array($_POST['p_id'],$productId)){
				echo "<script>alert('product is already added')</script>";
			}
			else{
			$count = count($_SESSION['finalCart']);
			$_SESSION['finalCart'][$count] = array("pId"=>$_POST['p_id'],
			"pName"=>$_POST['p_name'],"pPrice"=>$_POST['p_price'],"pQty"=>$_POST['num-product'],"pDes"=>$_POST['p_des'],"pImage"=>$_POST['p_image']);
			echo"<script>alert('cart added successfully')</script>";
			}
		}
		else{
			$_SESSION['finalCart'][0] = array("pId"=>$_POST['p_id'],
			"pName"=>$_POST['p_name'],"pPrice"=>$_POST['p_price'],"pQty"=>$_POST['num-product'],"pDes"=>$_POST['p_des'],"pImage"=>$_POST['p_image']);
			echo"<script>alert('cart added successfully')
			</script>";
		}
	}
	//remove
	if(isset($_GET['remove'])){
		$id = $_GET['remove'];
		foreach($_SESSION['finalCart'] as $key => $value){
			if($id == $value['pId']){
				unset($_SESSION['finalCart'][$key]);
				//reset
				$_SESSION['finalCart'] = array_values($_SESSION['finalCart']);
				echo"<script>alert('cart remove successfully');
				location.assign('shoping-cart.php')</script>";
			}
		}
	}
	// Update quantity
    if(isset($_POST['update'])){
        $newQuantities = $_POST['quantity']; // Get new quantities array
        foreach($newQuantities as $key => $quantity){
            $_SESSION['finalCart'][$key]['pQty'] = $quantity; // Update quantity for each item
        }
        echo "<script>alert('Cart updated successfully')</script>";
    }

	//checkout
	if(isset($_GET['checkout'])){
		$uId = $_SESSION['userId'];
		$uName = $_SESSION['userName'];
		$uEmail = $_SESSION['userEmail'];
		foreach($_SESSION['finalCart'] as $key => $value){
			$pId = $value['pId'];
			$pName = $value['pName'];
			$pPrice = $value['pPrice']*$value['pQty'];
			$pQty = $value['pQty'];
			$query =$pdo->prepare("insert into orders (p_id , p_name , p_price , p_qty , u_id , u_name , u_email) values (:pId , :pName , :pPrice , :pQty , :uId , :uName , :uEmail)");
			$query->bindparam('uId',$uId);
			$query->bindparam('uName',$uName);
			$query->bindparam('uEmail',$uEmail);
			$query->bindparam('pId',$pId);
			$query->bindparam('pName',$pName);
			$query->bindparam('pPrice',$pPrice);
			$query->bindparam('pQty',$pQty);
			$query->execute();
			echo"<script>alert('order placed successfully');
				location.assign('index.php')</script>";
		}
		
		// invoice

			$invoice_query= $pdo->prepare("insert into invoice (u_id, u_name, u_email, total_qty, total_amount) values (:u_id, :u_name, :u_email, :total_qty, :total_amount)");

			$invoice_query->bindParam('u_id', $uId);
			$invoice_query->bindParam('u_name',$uName);
			$invoice_query->bindParam('u_email', $uEmail );
			$totalQty = 0;
			$totalAmount = 0;

foreach($_SESSION ['finalCart'] as $key=>$value){
	$totalQty += $value['pQty'];
	$totalAmount += $value['pPrice']*$value['pQty'];
	$invoice_query->bindparam('total_qty',$totalQty);
	$invoice_query->bindparam('total_amount',$totalAmount);
}
		$invoice_query->execute();
		unset($_SESSION['finalCart']);
	}
	?>
	<!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Shopping Cart</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->
  
  

  <!--================Cart Area =================-->
  <section class="cart_area">
      <div class="container">
          <div class="cart_inner">
              <div class="table-responsive">
                  <table class="table">
                      <thead>
                          <tr>
                              <th scope="col">Product</th>
                              <th scope="col">Price</th>
                              <th scope="col">Quantity</th>
                              <th scope="col">Total</th>
                          </tr>
                      </thead> 
                             
                          <tr>
                              <td>
                                  <div class="media">
                                      <div class="d-flex">
                                          <img src="../assets/img/<?php echo $value['pImage']?>" alt="IMG">
                                      </div>
                                      <div class="media-body">
                                          <p>Minimalistic shop for multipurpose use</p>
                                      </div>
                                  </div>
                              </td>
                              <td>
                                  <h5>$360.00</h5>
                              </td>
                              <td>
                                  <div class="product_count">
                                      <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:"
                                          class="input-text qty">
                                      <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                          class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                      <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) && sst > 0 ) result.value--;return false;"
                                          class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                                  </div>
                              </td>
                              <td>
                                  <h5>$720.00</h5>
                              </td>
                          </tr>
                          
                          <tr class="bottom_button">
                              <td>
                                  <a class="button" href="#">Update Cart</a>
                              </td>
                              <td>

                              </td>
                              <td>

                              </td>
                              <td>
                                  <div class="cupon_text d-flex align-items-center">
                                      <input type="text" placeholder="Coupon Code">
                                      <a class="primary-btn" href="#">Apply</a>
                                      <a class="button" href="#">Have a Coupon?</a>
                                  </div>
                              </td>
                          </tr>
                          <!-- <tr>
                              <td>

                              </td>
                              <td>

                              </td>
                              <td>
                                  <h5>Subtotal</h5>
                              </td>
                              <td>
                                  <h5>$2160.00</h5>
                              </td>
                          </tr> -->
                          <tr class="shipping_area">
                              <td class="d-none d-md-block">

                              </td>
                              <td>

                              </td>
                              <td>
                                  <h5>Shipping</h5>
                              </td>
                              <td>
                                  <div class="shipping_box">
                                      <ul class="list">
                                          <li><a href="#">Flat Rate: $5.00</a></li>
                                          <li><a href="#">Free Shipping</a></li>
                                          <li><a href="#">Flat Rate: $10.00</a></li>
                                          <li class="active"><a href="#">Local Delivery: $2.00</a></li>
                                      </ul>
                                      <h6>Calculate Shipping <i class="fa fa-caret-down" aria-hidden="true"></i></h6>
                                      <select class="shipping_select">
                                          <option value="1">Bangladesh</option>
                                          <option value="2">India</option>
                                          <option value="4">Pakistan</option>
                                      </select>
                                      <select class="shipping_select">
                                          <option value="1">Select a State</option>
                                          <option value="2">Select a State</option>
                                          <option value="4">Select a State</option>
                                      </select>
                                      <input type="text" placeholder="Postcode/Zipcode">
                                      <a class="gray_btn" href="#">Update Details</a>
                                  </div>
                              </td>
                          </tr>
                          <tr class="out_button_area">
                              <td class="d-none-l">

                              </td>
                              <td class="">

                              </td>
                              <td>

                              </td>
                              <td>
                                  <div class="checkout_btn_inner d-flex align-items-center">
                                      <a class="gray_btn" href="#">Continue Shopping</a>
                                      <a class="primary-btn ml-2" href="#">Proceed to checkout</a>
                                  </div>
                              </td>
                          </tr>
                    
                  </table>
              </div>
          </div>
      </div>
  </section>
  <!--================End Cart Area =================-->



  <?php
  include('footer.php');
  ?>