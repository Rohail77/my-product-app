<h1>Product List</h1>
<a href="products/create" class="btn btn-success mt-2 mb-4">Create Product</a>
<form>
    <div class="input-group mb-3">
        <button type="submit" class="btn btn-secondary input-group-text">Search</button>
        <input type="text" name="search" value="<?php echo $search ?>" class="form-control" placeholder="Search Product">
    </div>
</form>
<div class="table-responsive">
    <table class="table align-middle">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Image</th>
            <th scope="col">Price</th>
            <th scope="col">Create Date</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $i => $product) { ?>
            <tr>
                <th scope="row"><?php echo $i + 1 ?></th>
                <td><?php echo $product['title'] ?></td>

                <td>
                    <?php if ($product['image']) : ?>
                        <img src="<?php echo "/" . $product['image'] ?>" class="thumb-img" alt="product-image">
                    <?php endif; ?>
                </td>

                <td><?php echo $product['price'] ?></td>
                <td><?php echo $product['create_date'] ?></td>
                <td>
                    <a href="/products/update?id=<?php echo $product['id'] ?>" type="button"
                       class="btn btn-outline-primary btn-sm">Edit</a>
                    <form action="/products/delete" method="POST" class="d-inline-block">
                        <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        <?php }; ?>
        </tbody>
    </table>
</div>