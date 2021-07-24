<section class="breadcrumb-section pb-3 pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order</li>
            </ol>
        </div>
    </section>
    <section class="products-grid pb-4 pt-4">
        <div class="container">
            <div class="row">
            <div class="widget-title">
                                <h3>Tracking Order</h3>
                            </div>
                            <div class="card shadow">
                <div class="card-body">
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
        <table class="table">
   
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
            <p class="description">Order anda telah di kirim, mohon tunggu barang anda sedang dalam proses pengiriman. Berikut adalah informasi order, saat sudah sampai anda dapat mengklik tombol complete untuk menyelesaikan proses order.</p>

                    </div>
                    </div>
                    </div>
                    </div>
                    <br>
                    <div class="card shadow">
                <div class="card-body">
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                <table class="table">
                
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
        <p class="description">Order anda telah di kirim, mohon tunggu barang anda sedang dalam proses pengiriman. Berikut adalah informasi tujuan order, saat sudah sampai anda dapat mengklik tombol complete untuk menyelesaikan proses order.</p>

                    </div>
                    </div>
                    </div>
                    </div>
                    <br>
                    <div class="card shadow">
                <div class="card-body">
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
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
        <p class="description">Order anda telah di kirim, mohon tunggu barang anda sedang dalam proses pengiriman. Berikut adalah informasi history dari order yang sudah dikirim, saat sudah sampai anda dapat mengklik tombol complete untuk menyelesaikan proses order.</p>

                    </div>
                    </div>
                    </div>
                    </div>

</div>
            </div>
</section>
      <br>