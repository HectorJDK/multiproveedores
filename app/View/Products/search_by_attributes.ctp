<!-- receives $result -->

<?php foreach ($result as $product): ?>
 
  <div>
     <?php echo $product->manufacturer_id ?>
	    <?php foreach ($product->attributes as $attribute): ?>
	    	<div> <?php echo $attribute[2] ?> </div>
	    <?php endforeach; ?>
  </div>

<?php endforeach; ?>