<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>


     li{
        /*border: 1px solid blue;*/
         padding: 10px;
         margin: 2px;
    }
</style>
<body>

</body>
</html>



<?php
echo "<ul class='pagination'>";

// button for first page
//$page_url=$total_rows=" ";
if($page>1){
    echo "<li><a href='{$page_url}' title='Go to the first page.'>";
    echo "First";
    echo "</a></li>";
}

// calculate total pages
$total_pages = ceil($total_rows / $records_per_page);

// range of links to show
$range = 2;

// display links to 'range of pages' around 'current page'
$initial_num = $page - $range;
$condition_limit_num = ($page + $range)  + 1;

for ($x=$initial_num; $x<$condition_limit_num; $x++) {

    // be sure '$x is greater than 0' AND 'less than or equal to the $total_pages'
    if (($x > 0) && ($x <= $total_pages)) {

        // current page
        if ($x == $page) {
            echo "<li class='active'><a href=\"#\">$x <span class=\"sr-only\">(current)</span></a></li>";
        }

        // not current page
        else {
            echo "<li><a href='{$page_url}page=$x'>$x</a></li>";
        }
    }
}




// button for last page
if($page<$total_pages){
    echo "<li><a href='" .$page_url. "page={$total_pages}' title='Last page is {$total_pages}.'>";
    echo "Last";
    echo "</a></li>";
}

echo "</ul>";


?>



