<?php
require_once "../template/navbar.php";
?>
<link rel="stylesheet" href="../css/cart.css">
<script src="../js/cart.js"></script>

<body>

<div class="container">
  <div class="heading">
    <h1>
      <span class="shopper">S</span>hopping Cart
    </h1>
    
  </div>
  
  <div class="cart transition is-open">
        
    
    <div class="table">
      
      <div class="layout-inline row th">
        <div class="col col-pro">Product</div>
        <div class="col col-price align-center "> 
          Price
        </div>
        <div class="col col-qty align-center">QTY</div>
        <div class="col">VAT</div>
        <div class="col">Total</div>
      </div>
      
      <div class="layout-inline row">
        
        <div class="col col-pro layout-inline">
          <img src="../images/5700xt.jpg" alt="kitten" />
          <p>rx 5700xt</p>
        </div>
        
        <div class="col col-price col-numeric align-center ">
          <p>£59.99</p>
        </div>

        <div class="col col-qty layout-inline">
          <a href="#" class="qty qty-minus">-</a>
            <input type="numeric" value="3" />
          <a href="#" class="qty qty-plus">+</a>
        </div>
        
        <div class="col col-vat col-numeric">
          <p>£2.95</p>
        </div>
        <div class="col col-total col-numeric">               <p> £182.95</p>
        </div>
      </div>
      
      <div class="layout-inline row row-bg2">

        <div class="col col-pro layout-inline">
          <img src="http://lovemeow.com/wp-content/uploads/2012/05/kitten81.jpg" alt="kitten" />
          <p>Scared Little Kittie</p>
        </div>
        
        <div class="col col-price col-numeric align-center ">
          <p>£23.99</p>
        </div>

        <div class="col col-qty  layout-inline">
          <a href="#" class="qty qty-minus ">-</a>
            <input type="numeric" value="1" />
          <a href="#" class="qty qty-plus">+</a>
        </div>
        
        <div class="col col-vat col-numeric">
          <p>£1.95</p>
        </div>
        <div class="col col-total col-numeric">
          <p>£25.94</p>
        </div>      
      
      </div>
      
       <div class="layout-inline row">
        
        <div class="col col-pro layout-inline">
          <img src="http://cdn.cutestpaw.com/wp-content/uploads/2012/04/l-my-first-kitten.jpg" alt="kitten" />
          <p>Curious Little Begger</p>
        </div>
        
        <div class="col col-price col-numeric align-center ">
          <p>£59.99</p>
        </div>

        <div class="col col-qty layout-inline">
          <a href="#" class="qty qty-minus">-</a>
            <input type="numeric" value="3" />
          <a href="#" class="qty qty-plus">+</a>
        </div>
        
        <div class="col col-vat col-numeric">
          <p>£2.95</p>          
        </div>
         <div class="col col-total col-numeric">  
           <p>£182.95</p>
         </div>         
      </div>
  
       <div class="tf">
         <div class="row layout-inline">
           <div class="col">
             <p>VAT</p>
           </div>
           <div class="col"></div>
         </div>
         <div class="row layout-inline">
           <div class="col">
             <p>Shipping</p>
           </div>
           <div class="col"></div>
         </div>
          <div class="row layout-inline">
           <div class="col">
             <p>Total</p>
           </div>
           <div class="col"></div>
         </div>
       </div>         
  </div>
    
    <a href="#" class="btn btn-update">Update cart</a>
  
</div>
 
</body>
<?php
require_once "../template/footer.php";
?>