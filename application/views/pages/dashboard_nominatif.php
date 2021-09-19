<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title ?>
        </h1>
    </section>
    <section class="content container-fluid">
        <?php
        foreach ($jenis as $kjenis => $vjenis) {
            foreach (array('masuk', 'putus') as $perkara) {
        ?>
                <div class="box box-primary" style="margin-top: 10px;">
                    <div class="box-header">
                        <h4>Perkara <?= ucfirst($vjenis) ?> <?= ucfirst($perkara) ?></h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center">PELAKU</th>
                                        <th rowspan="2" class="text-center">SISA TAHUN <?= $tahun - 1 ?></th>
                                        <th colspan="<?= count($bulan) ?>" class="text-center">PERKARA <?= strtoupper($vjenis) ?> <?= strtoupper($perkara) ?> TAHUN <?= $tahun ?></th>
                                        <th rowspan="2" class="text-center">Jumlah</th>
                                    </tr>
                                    <tr>
                                        <?php foreach ($bulan as $kbulan => $vbulan) { ?>
                                            <th class="text-center"><?= $vbulan ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = array();
                                    foreach ($pelaku as $kpelaku => $vpelaku) {
                                        $subtotal = $nominatif_sebelum[$kjenis][$kpelaku];
                                        $total['sebelum'] += $nominatif_sebelum[$kjenis][$kpelaku];
                                    ?>
                                        <tr>
                                            <td class="text-center"><strong><?= $vpelaku ?></strong></td>
                                            <td class="text-right"><?= $nominatif_sebelum[$kjenis][$kpelaku] ?></td>
                                            <?php foreach ($bulan as $kbulan => $vbulan) { ?>
                                                <td class="text-right">
                                                    <?php
                                                    echo number_format($nominatif[$kjenis][$kpelaku][$kbulan]['jml_perkara_' . $perkara]);
                                                    $subtotal += $nominatif[$kjenis][$kpelaku][$kbulan]['jml_perkara_' . $perkara];
                                                    $total[$kbulan] += $nominatif[$kjenis][$kpelaku][$kbulan]['jml_perkara_' . $perkara];
                                                    ?>
                                                </td>
                                            <?php } ?>
                                            <td class="text-right"><?= number_format($subtotal) ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td class="text-center"><strong>JUMLAH</strong></td>
                                        <td class="text-right"><?= number_format($total['sebelum']) ?></td>
                                        <?php foreach ($bulan as $kbulan => $vbulan) { ?>
                                            <td class="text-right"><?= number_format($total[$kbulan]) ?></td>
                                        <?php } ?>
                                        <td class="text-right"><?= number_format(array_sum($total)) ?></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
        <?php }
        }
        ?>


    </section>
</div>