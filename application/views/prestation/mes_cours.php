<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-8 columns">
        <? $this->load->view('include/pagetitle'); ?>
        <? if (isset($msg)) echo $msg; ?>
        
    </div>

    <? $this->load->view('include/sidebar'); ?>
</div>