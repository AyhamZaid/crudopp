<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php
// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// set number of records per page
$records_per_page = 5;

// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

// include database and object files
include_once 'config/database.php';
include 'model/product.php';
include 'model/category.php';

// instantiate database and objects
$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$category = new Category($db);

// query products
$stmt = $product->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();
$page_title = "Read Products";
include_once "layout/header.html";
echo('<div class="container">');
echo "<div class='right-button-margin'>
    <a href='create_product.php' class='btn btn-default pull-right'>Create Product</a>
</div>";
// display the products if there are any
$name=$price=$description=$category_id ="";
if ($num >0) {

    echo "<table class='table table-hover table-responsive table-bordered'>";
    echo "<tr>";
    echo "<th>Product</th>";
    echo "<th>Price</th>";
    echo "<th>Description</th>";
    echo "<th>Category</th>";
    echo "<th>Actions</th>";
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        echo "<tr>";
        echo "<td>{$name}</td>";
        echo "<td>{$price}</td>";
        echo "<td>{$description}</td>";


        echo "<td>";
        $category->id = $category_id;
        $category->readName();
        echo $category->name;
        echo "</td>";

        echo "<td>";
        // read, edit and delete buttons
        echo "  
 
<a href='update_product.php?id={$id}' class='btn btn-info left-margin'>
    <span class='glyphicon glyphicon-edit'></span> Edit
</a>
 
<a delete-id='{$id}' class='btn btn-danger delete-object'>
    <span class='glyphicon glyphicon-remove'></span> Delete
</a>";
        echo "</td>";

        echo "</tr>";

    }

    echo "</table>";

    // the page where this paging is used
    $page_url = "index.php?";

// count all products in the database to calculate total pages
    $total_rows = $product->countAll();

// paging buttons here
    include_once 'pagination.php';
} // tell the user there are no products
else {
    echo "<div class='alert alert-info'>No products found.</div>";
}
echo('</div>');
// set page footer
include_once "layout/footer.html";
?>

</body>
</html>