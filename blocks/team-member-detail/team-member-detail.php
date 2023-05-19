<?php
/**
 * Layout of our team member detail block.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'team-detail-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'team-detail-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$name = get_field('name');
$position = get_field('position');
$description = get_field('description');
$profileImage   = get_field('profile_image');
$email = get_field('e-mail');
?>

<div id="<?php echo esc_attr__($id) ?>" class="<?php echo esc_attr($className) ?>">
<?php if ($profileImage) {
    $imageID = $profileImage['id']; 
    $imageURL = wp_get_attachment_image_src($imageID, 'full')[0]; 
    $imageAlt = get_post_meta($imageID, '_wp_attachment_image_alt', true);  ?>
    <figure>
        <img src="<?php echo $imageURL ?>" alt="<?php echo esc_attr__($imageAlt) ?>">
    </figure>
    <p><?php echo esc_attr($name) ?></p>
    <p><?php echo esc_attr($position) ?></p>
    <?php echo esc_attr($description) ?>

<?php } ?>
</div>