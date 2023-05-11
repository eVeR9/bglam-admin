<h2>PRODUCTS</h2>
	
<!-- Cart basket -->
<div class="cart-view">
    <a href="<?php echo base_url('cart'); ?>" title="View Cart"><i class="icart"></i> (<?php echo ($this->cart->total_items() > 0)?$this->cart->total_items().' Items':'Empty'; ?>)</a>
</div>

<!-- List all products -->
<div class="row col-lg-12">
    <?php if(!empty($products)){ foreach($products as $row){ ?>
        <div class="card col-lg-3">
            <img class="card-img-top" src="<?php echo base_url('public/uploads/imagenes_productos/'.$row['imagen']); ?>" alt="" width="30">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row["nombre"]; ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">Price: <?php echo '$'.$row["precio"].' USD'; ?></h6>
                <p class="card-text"><?php echo $row["marca_id"]; ?></p> 
                <a href="<?php echo base_url('products/addToCart/'.$row['id']); ?>" class="btn btn-primary">Add to Cart</a>
            </div>
        </div>
    <?php } }else{ ?>
        <p>Product(s) not found...</p>
    <?php } ?>
</div>