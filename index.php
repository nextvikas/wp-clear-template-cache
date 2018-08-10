<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jQuery Simple MobileMenu Plugin Example</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dist/styles/jquery-simple-mobilemenu.css">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700" rel="stylesheet"> 
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="dist/jquery-simple-mobilemenu.min.js"></script>
    <style>
    body { overflow:hidden;}
    </style>
</head>

<body>
    <header>
        <div class="logo-port"><img src="https://www.dorcode.com/assets/main/img/logo.png"></div>
    </header>







<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "core";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}   



        function buildCategory($parent, $category) {
            $html = "";
            if (isset($category['parent_cats'][$parent])) {
              if($parent!=0)
                $html .= "<ul class='submenu'>\n";
                foreach ($category['parent_cats'][$parent] as $cat_id) {
                    if (!isset($category['parent_cats'][$cat_id])) {
                        $html .= "<li>\n  <a href='" . $category['categories'][$cat_id]['category_link'] . "'>" . $category['categories'][$cat_id]['category_name'] . "</a>\n</li> \n";
                    }
                    if (isset($category['parent_cats'][$cat_id])) {
                        $html .= "<li>\n  <a href='" . $category['categories'][$cat_id]['category_link'] . "'>" . $category['categories'][$cat_id]['category_name'] . "</a> \n";
                        $html .= buildCategory($cat_id, $category);
                        $html .= "</li> \n";
                    }
                }
                if($parent!=0)
                $html .= "</ul> \n";
            }
            return $html;
        }
  
    $search_sql = "SELECT
            category_id, category_name, category_link, parent_id, sort_order
            FROM category
            ORDER BY parent_id, sort_order, category_name";
    //select all rows from the category table
        $result = mysqli_query($conn, $search_sql);

        //create a multidimensional array to hold a list of category and parent category
        $category = array(
            'categories' => array(),
            'parent_cats' => array()
        );

        //build the array lists with data from the category table
        while ($row = mysqli_fetch_assoc($result)) {
            //creates entry into categories array with current category id ie. $categories['categories'][1]
            $category['categories'][$row['category_id']] = $row;
            //creates entry into parent_cats array. parent_cats array contains a list of all categories with children
            $category['parent_cats'][$row['parent_id']][] = $row['category_id'];
        }

  //echo '<pre>'; print_r($category); exit;
  
echo '<ul class="mobile_menu">';
echo buildCategory(0, $category); 
echo '</ul>';
?>


    <script>
    $(document).ready(function() {
        $(".mobile_menu").slideMobileMenu({
            onMenuLoad: function(menu) {
                console.log(menu)
                console.log("menu loaded")
            },
            onMenuToggle: function(menu, opened) {
                console.log(opened)
            }
        });
    })
    </script>
</body> 
</html>