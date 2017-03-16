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
    <title><?= (isset($tab_title))? $tab_title : 'GoSciences'?></title>
    <link rel="stylesheet" href="<?= css_url('app')?>" />
    <link rel="stylesheet" href="<?= css_url('style')?>" />
  </head>
  <body>