<?php
/**
 * Header template
 * 
 * @package argotest
 */
?>

<!DOCTYPE html>
<html lang="<?php language_attributes() ?>">
<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('title') ?></title>
    <?php wp_head() ?>
</head>
<body <?php body_class() ?> itemtype="https://schema.org/WebPage" itemscope>
    <?php if(function_exists('wp_body_open')) {
wp_body_open();
    } ?>
    <main>