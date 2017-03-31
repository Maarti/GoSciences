<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!doctype html>
<html class="no-js" lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="57x57" href="<?= favicon_folder()?>/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= favicon_folder()?>/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= favicon_folder()?>/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= favicon_folder()?>/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= favicon_folder()?>/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= favicon_folder()?>/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= favicon_folder()?>/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= favicon_folder()?>/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= favicon_folder()?>/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?= favicon_folder()?>/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= favicon_folder()?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= favicon_folder()?>/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= favicon_folder()?>/favicon-16x16.png">
    <link rel="manifest" href="<?= favicon_folder()?>/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta property="og:type" content="business.business">
    
    <!-- Open Graph -->
    <meta property="og:title" content="GoSciences">
    <meta property="og:url" content="<?=site_url()?>">
    <meta property="og:image" content="<?=img_url('gosciences-logo-opti.png')?>">
    <meta property="business:contact_data:street_address" content="undefined">
    <meta property="business:contact_data:locality" content="La Ferté Saint Aubin">
    <meta property="business:contact_data:region" content="France">
    <meta property="business:contact_data:postal_code" content="45240">
    <meta property="business:contact_data:country_name" content="France">
    
    <meta name="description" content="<?= (isset($meta_desc))? $meta_desc : 'GoSciences propose de l\'aide scolaire en Région Centre dans les matières scientifiques.'?>" />
    <title><?= (isset($tab_title))? $tab_title : 'GoSciences - Cours particuliers en Région Centre'?></title>
    <link rel="stylesheet" href="<?= css_url('app')?>" />
    <link rel="stylesheet" href="<?= css_url('style')?>" />
    <link rel="stylesheet" href="<?= css_url('foundation-icons')?>" />
    <?if(isset($tinymce)){?>
        <script src="<?=(ENVIRONMENT == 'development')? '//cloud.tinymce.com/stable/tinymce.min.js' : js_url('vendor/tinymce/tinymce.min')?>"></script>
        <script type="text/javascript">
            tinymce.init({
              <?=$tinymce?>              
            });
        </script>
    <?}?>
  </head>
  <body>
  <? $this->load->view('include/analyticstracking'); ?>