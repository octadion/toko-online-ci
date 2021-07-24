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
    <span class="breadcrumb-item active">Sale</span>
</nav>

<!-- Dynamic Table Full -->
<div class="row">
<div class="col-md-4">
<div class="block block-themed block-rounded block-shadow">
            <div class="block-header block-header-default bg-gd-dusk">
                <h3 class="block-title">Daily</h3>
            </div>
            <div class="block-content">
            <?php echo form_open('admin/sale/daily')?>
            <div class="row">  
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <select class="js-select2 form-control" id="tanggal" name="tanggal" style="width: 100%;">
                            <?php
                            $mulai = 1;
                            for ($i=$mulai;$i<$mulai+31;$i++){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Bulan</label>
                        <select class="js-select2 form-control" id="tanggal" name="bulan" style="width: 100%;">
                        <?php
                            $mulai = 1;
                            for ($i=$mulai;$i<$mulai+12;$i++){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Tahun</label>
                        <select class="js-select2 form-control" id="tanggal" name="tahun" style="width: 100%;">
                        <?php
                            $mulai = date('Y') - 1;
                            for ($i=$mulai;$i<$mulai+7;$i++){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                     <button type="submit" class="btn btn-primary">Cetak</button>
                    </div>
                </div>
               
            </div> 
            <?php echo form_close()?>
            </div>                
        </div>
</div>
<div class="col-md-4">
<div class="block block-themed block-rounded block-shadow">
            <div class="block-header block-header-default bg-gd-dusk">
                <h3 class="block-title">Monthly</h3>
            </div>
            <div class="block-content">
            <?php echo form_open('admin/sale/monthly')?>
            <div class="row">
                <div class="col-sm-6">
                <div class="form-group">
                        <label>Bulan</label>
                        <select class="js-select2 form-control" id="tanggal" name="bulan" style="width: 100%;">
                        <?php
                            $mulai = 1;
                            for ($i=$mulai;$i<$mulai+12;$i++){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group">
                        <label>Tahun</label>
                        <select class="js-select2 form-control" id="tanggal" name="tahun" style="width: 100%;">
                        <?php
                            $mulai = date('Y') - 1;
                            for ($i=$mulai;$i<$mulai+7;$i++){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                     <button type="submit" class="btn btn-primary">Cetak</button>
                    </div>
                </div>
            </div> 
            <?php echo form_close()?>
            </div>                
        </div>
</div>
<div class="col-md-4">
<div class="block block-themed block-rounded block-shadow">
            <div class="block-header block-header-default bg-gd-dusk">
                <h3 class="block-title">Yearly</h3>
            </div>
            <div class="block-content">
            <?php echo form_open('admin/sale/yearly')?>
            <div class="row">
                <div class="col-sm-12">
                <div class="form-group">
                        <label>Tahun</label>
                        <select class="js-select2 form-control" id="tanggal" name="tahun" style="width: 100%;">
                        <?php
                            $mulai = date('Y') - 1;
                            for ($i=$mulai;$i<$mulai+7;$i++){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                     <button type="submit" class="btn btn-primary">Cetak</button>
                    </div>
                </div>
            </div>  
            <?php echo form_close()?>
            </div>                
        </div>
</div>
</div>

<!-- END Dynamic Table Full -->


<!-- END Top Modal -->