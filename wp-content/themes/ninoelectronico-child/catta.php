<?php

/* Template Name: Catego */

get_header();

$total = 0;

$args = array(
    'taxonomy' => 'product_cat',
    'hide_empty' => false,
    'parent'   => 0,
    'show_count' => 1
);
$product_cat = get_terms( $args );

foreach ($product_cat as $parent_product_cat)
{

echo '
<ul>
  <li><a href="'.get_term_link($parent_product_cat->term_id).'">'.$parent_product_cat->name.'</a>
  <ul>
    ';
$child_args = array(
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
        'parent'   => $parent_product_cat->term_id,
        'show_count' => 1
    );
$child_product_cats = get_terms( $child_args );
foreach ($child_product_cats as $child_product_cat)
{
echo '<li><a href="'.get_term_link($child_product_cat->term_id).'">'.$child_product_cat->name.'</a> ('.$child_product_cat->count.')</li>';
$total = $total + $child_product_cat->count;
}


echo $total;


echo '</ul>
</li>
</ul>';
}

?>