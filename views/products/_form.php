
<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger" role="alert">
        <?php foreach ($errors as $error) : ?>
            <?php echo "$error <br>" ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="POST" action="" enctype="multipart/form-data">
    <?php if ($product['image']) : ?>
        <img src="<?php echo "/" . $product['image'] ?>" alt="product image" class="product-img mb-4">
    <?php endif; ?>
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" value="<?php echo $product['title'] ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Image</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <input type="textarea" name="description" value="<?php echo $product['description']?>" class="form-control"
               id="exampleCheck1">
    </div>
    <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="number" name="price" value="<?php echo $product['price'] ?>" step="0.01" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>