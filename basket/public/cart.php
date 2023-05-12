<?php session_start(); ?>


<head>
  <link rel="stylesheet" href="basket.css" />
</head>
<body>
<div class="basket">

<!-- Title -->
<div class="b-title">
  Your Basket
</div>


   
      <?php
      if (isset($_SESSION['basket'])) :
        $i = 1;
        foreach ($_SESSION['basket'] as $basket) :
      ?>
          <?php echo $i; ?>
      <!-- Product -->
      <div class="b-item">
        <div class="b-img">
          <!-- Product image -->
          <div class="b-image">
            <img src="<?= $basket['img']; ?>" alt="" />
          </div>
        </div>
        <!-- Product  description -->
        <div class="b-description">
          <span><?= $basket['name']; ?></span>
          <span><?= $basket['author']; ?></span>
        </div>
        <!-- Product  price -->
        <div class="b-total-price"><?= $basket['price']; ?></div>
        <!--Remove product from basket -->
        <a class="b-deleteBtn" href="removecartitem.php?id=<?= $basket['id']; ?>">Remove</a></td>
     
    </div>
      <?php
          $i++;
        endforeach;
      endif;
      ?>
    
</div>



    </body>


