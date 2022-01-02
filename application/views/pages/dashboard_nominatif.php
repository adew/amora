<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Dashboard Nominatif</h1>
    </section>

    <section class="content  container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <?php
                        $i = 0;
                        foreach ($jenis as $kjenis => $vjenis) {
                            foreach (array('masuk', 'putus') as $perkara) {
                        ?>
                                <li class="<?= $i == 0 ? 'active' : null ?>"><a href="#<?= $kjenis . '-' . $perkara ?>" data-toggle="tab" aria-expanded="true">Perkara <?= ucfirst($vjenis) ?> <?= ucfirst($perkara) ?></a></li>
                        <?php
                                $i++;
                            }
                        }
                        ?>
                    </ul>
                    <div class="tab-content">
                        <?php
                        $i = 0;
                        foreach ($jenis as $kjenis => $vjenis) {
                            foreach (array('masuk', 'putus') as $perkara) {
                        ?>
                                <div class="tab-pane <?= $i == 0 ? 'active' : null ?>" id="<?= $kjenis . '-' . $perkara ?>">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="container-<?= $kjenis . '-' . $perkara ?>"></div>
                                            <div class="clearfix"></div>
                                            <div class="table-responsive" style="margin-top: 40px;">
                                                <table class="table table-bordered">
                                                    <thead style="background-color: antiquewhite;">
                                                        <tr>
                                                            <th rowspan="2" class="text-center">PELAKU</th>
                                                            <th rowspan="2" class="text-center">SISA <br>TAHUN <br><?= $tahun - 1 ?></th>
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
                                                        $total_sbl = array();
                                                        foreach ($pelaku as $kpelaku => $vpelaku) {
                                                            // $subtotal = $nominatif_sebelum[$kjenis][$kpelaku];
                                                            $subtotal = 0;
                                                            $total_sbl['sebelum'] += $nominatif_sebelum[$kjenis][$kpelaku];
                                                            switch ($vpelaku) {
                                                                case "TNI AD":
                                                                    $color = '#00a65a';
                                                                    break;
                                                                case "TNI AL":
                                                                    $color = '#0073b7';
                                                                    break;
                                                                case "TNI AU":
                                                                    $color = '#00c0ef';
                                                                    break;
                                                            }
                                                        ?>
                                                            <tr style="background-color:<?= $color ?>">
                                                                <td class="text-center"><strong><?= $vpelaku ?></strong></td>
                                                                <td class="text-right"><?= $nominatif_sebelum[$kjenis][$kpelaku] ?></td>
                                                                <?php foreach ($bulan as $kbulan => $vbulan) { ?>
                                                                    <td class="text-center">
                                                                        <?php
                                                                        echo number_format($nominatif[$kjenis][$kpelaku][$kbulan]['jml_perkara_' . $perkara]);
                                                                        $subtotal += $nominatif[$kjenis][$kpelaku][$kbulan]['jml_perkara_' . $perkara];
                                                                        $total[$kbulan] += $nominatif[$kjenis][$kpelaku][$kbulan]['jml_perkara_' . $perkara];
                                                                        ?>
                                                                    </td>
                                                                <?php } ?>
                                                                <td class="text-center  text-bold"><?= number_format($subtotal) ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                        <tr style="background: orange;">
                                                            <td class="text-center"><strong>JUMLAH</strong></td>
                                                            <td class="text-right"><?= number_format($total_sbl['sebelum']) ?></td>
                                                            <?php foreach ($bulan as $kbulan => $vbulan) { ?>
                                                                <td class="text-center"><?= number_format($total[$kbulan]) ?></td>
                                                            <?php } ?>
                                                            <td class="text-center"><?= number_format(array_sum($total)) ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                                $i++;
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
    </section>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script type="text/javascript">
    <?php
    foreach ($jenis as $kjenis => $vjenis) {
        foreach (array('masuk', 'putus') as $perkara) {
    ?>
            Highcharts.chart('container-<?= $kjenis . '-' . $perkara ?>', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Statistik Perkara <?= ucfirst($vjenis) ?> <?= ucfirst($perkara) ?> Tahun <?= $tahun ?>'
                },
                yAxis: {
                    title: {
                        text: 'Jumlah Perkara'
                    }
                },
                xAxis: {
                    title: false,
                    categories: ['<?= implode("','", $bulan) ?>'],
                    crosshair: true
                },
                credits: {
                    enabled: false
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                plotOptions: {
                    series: {
                        label: {
                            connectorAllowed: false
                        },
                    }
                },

                series: [
                    <?php
                    $series = array();
                    foreach ($pelaku as $kpelaku => $vpelaku) {
                        $data = array();
                        foreach ($bulan as $kbulan => $vbulan) {
                            $data[] = (int) $nominatif[$kjenis][$kpelaku][$kbulan]['jml_perkara_' . $perkara];
                        }
                        switch ($vpelaku) {
                            case "TNI AD":
                                $color = '#00a65a';
                                break;
                            case "TNI AL":
                                $color = '#0073b7';
                                break;
                            case "TNI AU":
                                $color = '#00c0ef';
                                break;
                        }
                        $series[] = "{color: '" . $color . "', name: '" . $vpelaku . "', data: [" . implode(',', $data) . "]}";
                    }
                    echo implode(',', $series);
                    ?>
                ],

                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }

            });
    <?php }
    }
    ?>
</script>