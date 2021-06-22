<!-- <h2 class="content-heading">DataTables Plugin</h2> -->
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
    <a class="breadcrumb-item" href="<?= base_url('admin/dashboard') ?>">Dashboard</a>
    <span class="breadcrumb-item active">Product</span>
</nav>

                    <div class="row">
                        <div class="col-xl-4">

                            <!-- Instructor -->
                            <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">
                                        <i class="fa fa-fw fa-image"></i>
                                        Image
                                    </h3>
                                </div>
                                <div class="block-content block-content-full">
                                                            
                                <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="true" data-arrows="true">
                                <?php foreach ($foto as $key) : ?>
                                        <div>
                                            <img class="img-fluid" src=" <?= base_url($key->foto_path.'/'.$key->foto_name) ?>" alt="Project Promo 1">
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    
                                    <!-- <div class="font-w600 mb-5">John Doe</div>
                                    <div class="text-muted">Web Designer</div> -->
                                </div>
                            </a>
                            <!-- END Instructor -->

                            <!-- Course Info -->
                            <div class="block block-rounded">
                                <div class="block-header block-header-default text-center">
                                    <h3 class="block-title">
                                        <i class="fa fa-fw fa-info"></i>
                                        Data Product
                                    </h3>
                                </div>
                                <div class="block-content">
                                    
                                    <table class="table table-borderless table-striped">
                                        <tbody>
                                        <tr>
                                                <td>
                                                <?php
                                                $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
                                                echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($data->barcode, $generator::TYPE_CODE_128)) . '"  style="width: 250px">';
                                                ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="fa fa-fw fa-barcode mr-10"></i> <?= $data->barcode?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="fa fa-fw fa-wpforms mr-10"></i> <?= $data->name?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                               
                                                    <i class="fa fa-fw fa-tags mr-10"></i><a class="badge badge-primary"  href="javascript:void(0)"> <?= $data->category_name?></a>
                                              
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                               
                                                    <i class="fa fa-fw fa-dollar mr-10"></i> <?= indo_currency($data->price)?>
                                                </td>
                                               
                                            </tr>
                                            
                                            <tr>
                                                <td>
                                                    <i class="fa fa-fw fa-balance-scale mr-10"></i> <?= $data->weight.' '.$data->unit_name?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="fa fa-fw fa-balance-scale mr-10"></i> <?= $data->qty?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="fa fa-fw fa-calendar mr-10"></i><?= $data->created_at ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END Course Info -->
                        </div>
                        <div class="col-xl-8">
                            <!-- Lesson -->
                            <div class="block block-themed block-rounded block-shadow">
                                <div class="block-header block-header-default bg-gd-dusk">
                                    <h3 class="block-title">Deskripsi Product</h3>
                                </div>
                         
                            <div class="block block-rounded">
                                <div class="block-content">
                                    <h3 ><center><?= $data->name?></center></h3>
                                    <p><?= $data->description?></p>
                                  
                                    <div class="block block-themed block-rounded block-shadow">
                                    <p class="block-header block-header-default bg-gd-dusk">
                                         Deskripsi Singkat Produk
                                    </p>
                                    </div>
                                   <p> <?= $data->short_desc?> </p>
                                 
                                    <!-- <p class="alert alert-success font-w600 text-center">
                                        <i class="fa fa-thumbs-up"></i> Congrats! Let's head up to the next lesson.
                                    </p> -->
                                </div>
                            </div>
                            <!-- END Lesson -->
                        </div>
                    </div>
                    </div>
