<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>        

<ul class="menu expanded">
    <li class="active text-center"><a href="<?=site_url('admin/utilisateurs')?>">Utilisateurs</a></li>
    <li class="active text-center"><a href="<?=site_url('admin/classes')?>">Classes</a></li>
    <li class="active text-center"><a href="<?=site_url('admin/prestations')?>">Prestations</a></li>
    <li class="active text-center"><a href="#">Textes</a></li>
    <li class="active text-center"><a href="<?=site_url('admin/logs')?>">Logs</a></li>
</ul>

<h1 class="text-center"><?=(isset($page_title))? htmlspecialchars($page_title) : 'Administration'?></h1>