<?php
/**
 * Layout of our team member grid block.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'team-grid-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'team-grid-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$gridSetting = get_field('number_of_columns'); ?>

<div id="<?php echo esc_attr__($id) ?>" class="<?php echo esc_attr($className) ?> grid-<?php echo $gridSetting ?>">
<?php
// Repeat team loop
if( have_rows('repeat_team') ):
    while( have_rows('repeat_team') ) : the_row(); 
    // Load values and assign defaults
$name = get_sub_field('name');
$position = get_sub_field('position');
$positionShow = get_sub_field('position_show');
$phoneNumber = get_sub_field('phone_number');
$profileImage = get_sub_field('profile_image');
$reviewer = get_sub_field('reviewer');
?>
<div> <?php
$imageID = $profileImage['id']; 
    $imageURL = wp_get_attachment_image_src($imageID, 'full')[0]; 
    $imageAlt = get_post_meta($imageID, '_wp_attachment_image_alt', true);  ?>
    <figure>
        <img src="<?php echo $imageURL ?>" alt="<?php echo esc_attr__($imageAlt) ?>">
    </figure>
    <p class="text-white font-bold"><?php echo esc_attr($name) ?></p>
    <a href="tel:<?php echo esc_attr($phoneNumber) ?>"><?php echo esc_attr($phoneNumber) ?></a>
   <?php if ($positionShow) { ?>
<p><?php echo esc_attr($position) ?></p>
    <?php } 
    if ($reviewer) {
    $user_id = $reviewer['ID'];
$posts_per_page = 5; 
$args = array(
    'post_type' => 'post', 
    'author' => $user_id,
    'posts_per_page' => $posts_per_page,
);

$loop = new WP_Query($args);

if ($loop->have_posts()) {
    while ($loop->have_posts()) { 
        $loop->the_post(); ?>
        <p><strong><?php the_title() ?></strong></p>
        <p><?php the_content() ?></p>
  <?php  }
    wp_reset_postdata(); 
} else {
    echo 'Post not found';
}}
?>
</div>
<?php endwhile;
endif;
?>
</div>