<div class="block block-rounded">
    <div class="block-content" style="background-image: url('<?= base_url(); ?>assets/img/illust/header-dashboard.png'); background-size: cover;">
        <div class="py-20 text-center">
            <h1 class="h3 mb-5"><?= $title; ?></h1>
            <p class="mb-10 text-muted">
                <em>Hidroponik Store Phicos</em>
            </p>
        </div>
    </div>
</div>

<nav class="breadcrumb bg-white push">
    <a class="breadcrumb-item" href="<?= base_url('admin/order') ?>">Dashboard</a>
    <span class="breadcrumb-item active">Shipments</span>
</nav>

                  

                    <!-- Addresses -->
                   
                    <!-- END Addresses -->

                    <!-- Products -->
                    <!-- <h2 class="content-heading">Shipment (<?=$total_tabelprd?>)</h2> -->
                    <div class="block block-rounded">
                        <div class="block-content">
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped">
                                    <tbody>
                                    <tr>
                                            <td class="font-weight-bold">NO RESI</td>
                                            <td>:</td>
                                            <td><?= $hasil['summary']['awb']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">KURIR</td>
                                            <td>:</td>
                                            <td><?= $hasil['summary']['courier']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">SERVICE</td>
                                            <td>:</td>
                                            <td><?= $hasil['summary']['service']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">STATUS</td>
                                            <td>:</td>
                                            <td><?= $hasil['summary']['status']; ?></td>
                                        </tr>

                                        <tr>
                                            <td class="font-weight-bold">TANGGAL</td>
                                            <td>:</td>
                                            <td><?= $hasil['summary']['date']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">DESKRIPSI</td>
                                            <td>:</td>
                                            <td><?= $hasil['summary']['desc']; ?></td>
                                        </tr>

                                        <tr>
                                            <td class="font-weight-bold">JUMLAH</td>
                                            <td>:</td>
                                            <td><?= $hasil['summary']['amount']; ?></td>
                                        </tr>

                                        <tr>
                                            <td class="font-weight-bold">BERAT</td>
                                            <td>:</td>
                                            <td><?= $hasil['summary']['weight']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="block block-rounded">
                        <div class="block-content">
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped">
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold">ASAL</td>
                                        <td>:</td>
                                        <td><?= $hasil['detail']['origin']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">TUJUAN</td>
                                        <td>:</td>
                                        <td><?= $hasil['detail']['destination']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">PENGIRIM</td>
                                        <td>:</td>
                                        <td><?= $hasil['detail']['shipper']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">PENERIMA</td>
                                        <td>:</td>
                                        <td><?= $hasil['detail']['receiver']; ?></td>
                                    </tr>

                            </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="block block-rounded">
                        <div class="block-content">
                        <ul class="timeline">
					<?php 

                    $datanya = $hasil['history'];

                    foreach ($datanya as $key => $row) {
                        $mid[$key]  = $row['date'];
                    }
                    array_multisort($mid, SORT_DESC, $datanya);


                                        for($i = $countnya - 1; $i >= 0; $i--) {?>
                                            <li>
                                            <p><?= $datanya[$i]['date'] ?></p>
                                            <p><?= $datanya[$i]['desc'] ?></p>
                                            <p><?= $datanya[$i]['location'] ?></p>
                                            </li>
                                        <?php } ?>
                                    </ul>
                        </div>
                    </div>