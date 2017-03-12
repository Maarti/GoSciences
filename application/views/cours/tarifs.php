<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-8 columns">
        <? $this->load->view('include/pagetitle'); ?>

        <table class="hover stack">
        <thead>
          <tr>
            <th width="150">Période</th>
            <th>Descritpion</th>
            <th width="200">Tarif</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center"><b>Semaine</b></td>
            <td>Commeatus adfatim consilio post deverti ad pagos quaeso itinerum miretur.</td>
            <td class="text-center"><span class="stat">22,50€/h</span><br>
                <span class="price_detail">45€/h -50% déduit des impôts</span>
            </td>
          </tr>
          <tr>
            <td class="text-center"><b>Week-end</b></td>
            <td>Sedentem qui esset una tum consul sedentem enim incidere eum.</td>
            <td class="text-center"><span class="stat">25€/h</span><br>
                <span class="price_detail">50€/h -50% déduit des impôts</span>
            </td>
          </tr>
          <tr>
            <td class="text-center"><b>Vacances</b></td>
            <td>Suspendit omnium latent in umbraculorum vel Campanam quae aurigarum studiorum.</td>
            <td class="text-center"><span class="stat">28€/h</span><br>
                <span class="price_detail">56€/h -50% déduit des impôts</span>
            </td>
          </tr>
        </tbody>
      </table>

    </div>
    <? $this->load->view('include/sidebar'); ?>

</div>