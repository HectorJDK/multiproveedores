<!-- receives $result -->
<?php foreach ($result as $product): ?>
 
  <div class="row striped slim" id= "<?php echo $product->id ?>">
  	<div class="col-9">
  		<div class="row">
  			<div class="col-6">
  				<?php echo $product->manufacturer_id ?>
  			</div>
  		</div>
  		<div class="row">
  			<div class="text-left light">
  				Atributos:
  			</div>
		    	<?php foreach ($product->attributes as $attribute): ?>
		    	<div class="row">
		    		<div> <?php echo $attribute[2] ?> </div>
		    	</div>
		    	<?php endforeach; ?>
		</div>
  </div>
  	<div class="col-3">
	  	<select class="select_id" id="<?php echo $product->id ?>">
	      <option value="0"></option>
	      <option value="1">Solo Originales</option>
	      <option value="2">Solo Genericos</option>
	      <option value="3">Originales y Genericos</option>
		</select>
 	</div>
</div>

<?php endforeach; ?>

<div class="btn btn-success" onclick="selected()">Buscar Proveedores</div>

<script script type="text/javascript">
function selected(){
	var s =  document.getElementsByTagName("select");
    var products = [];
    for (i = 0; i < s.length; i++){
	    var p_id = s[i].id;
	    var options = s[i].options;
	    var value  = options[options.selectedIndex].value;
	    if(value != '0') {
	    	products.push([p_id, value]);
	    }
    }
    console.log(products);
    return JSON.stringify(products);
}
</script>