<link rel="stylesheet" href="<?= base_url() ?>assets/js/dropzonejs/min/dropzone.min.css">
<style>
    .border-3 {
        border-width: 3px !important;
    }
    .image-area {
        position: relative;
        width: 50%;
        /* background: #333; */
    }
    .image-area img{
        max-width: 100%;
        height: auto;
    }
    .remove-image {
        display: none;
        position: absolute;
        top: -10px;
        right: -10px;
        border-radius: 10em;
        padding: 2px 6px 3px;
        text-decoration: none;
        font: 700 21px/20px sans-serif;
        background: #555;
        border: 3px solid #fff;
        color: #FFF;
        box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 2px 4px rgba(0,0,0,0.3);
        text-shadow: 0 1px 2px rgba(0,0,0,0.5);
        -webkit-transition: background 0.5s;
        transition: background 0.5s;
    }
    .remove-image:hover {
        color: white;
        background: #E54E4E;
        padding: 3px 7px 5px;
        top: -11px;
        right: -11px;
    }
    .remove-image:active {
        background: #E54E4E;
        top: -10px;
        right: -11px;
    }
	.dropzoneDragArea {
		    background-color: #fbfdff;
		    border: 1px dashed #c0ccda;
		    border-radius: 6px;
		    padding: 60px;
		    text-align: center;
		    margin-bottom: 15px;
		    cursor: pointer;
		}
		.dropzone{
			box-shadow: 0px 2px 20px 0px #f2f2f2;
			border-radius: 10px;
		}
</style>

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
    <a class="breadcrumb-item" href="<?= base_url('admin/product') ?>">Product</a>
    <span class="breadcrumb-item active">Add Product</span>
</nav>

<form id="form_product" class="js-validation-product form-validate-summernote"  method="post" enctype="multipart/form-data" novalidate>
<div class="row">
    <div class="col-md-8">
        <div class="block block-themed block-rounded block-shadow">
            <div class="block-header block-header-default bg-gd-dusk">
                <h3 class="block-title">Add Product</h3>
            </div>

            <div class="block-content block-content-full">
                <div class="form-group row">
                    <label class="col-12" for="title">Barcode <label class="text-danger">*</label></label>
                    <div class="col-lg-12">
                        <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Barcode.." value="<?= $item->barcode ?>">
                        <input type="hidden" id="page" name="page" value="<?= $page ?>">
                        <input type="hidden" id="id" name="id" value="<?= encode_id($item->id) ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="title">Name <label class="text-danger">*</label></label>
                    <div class="col-lg-12">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name.." value="<?= $item->name ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="kategori">Category <label class="text-danger">*</label></label>
                    <div class="col-lg-12">
                        <select class="js-select2 form-control" id="category" name="category" style="width: 100%;" data-placeholder="Pilih satu..">
                            <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                            <?php foreach($category as $kat){ ?>
                            <option value="<?= $kat->id ?>" <?= $item->category_id == $kat->id ? 'selected' : '' ?>><?= $kat->category_name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-12" for="isi_berita">Description <label class="text-danger">*</label></label>
                    <div class="col-12">
                        <textarea id="description" name="description"><?= $item->description ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="ecom-product-description-short">Short Description<label class="text-danger">*</label></label>
                    <div class="col-12">
                        <textarea class="form-control" id="short_desc" name="short_desc" placeholder="Short Descriotion.." rows="5"><?= $item->short_desc?></textarea>
                    </div>
                </div>    
                        
            </div>

            <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                <div class="form-group row" style="margin-bottom: 0px;">
                    <div class="col-12">
                        <button type="submit" name="add" id="published" value="published" data-status_post="published" class="btn btn-primary float-right">Simpan dan Publish</button>
                        <button type="submit" name="add" id="draft" value="draft" data-status_post="draft" style="margin-right: 5px;" class="btn btn-alt-secondary float-right">Simpan sebagai Draft</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">

    <div class="block block-themed block-rounded block-shadow">
            <div class="block-header block-header-default bg-gd-dusk">
                <h3 class="block-title">Data</h3>
            </div>
            <div class="block-content">
            <div class="form-group row">
                    <label class="col-12" for="title">Weight <label class="text-danger">*</label></label>
                    <div class="col-lg-12">
                        <input type="number" class="form-control" id="weight" name="weight" placeholder="weight.." value="<?= $item->weight ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="kategori">Pilih Unit <label class="text-danger">*</label></label>
                    <div class="col-lg-12">
                        <select class="js-select2 form-control" id="unit" name="unit" style="width: 100%;" data-placeholder="Pilih satu..">
                            <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                            <?php foreach($unit as $unt){ ?>
                            <option value="<?= $unt->id ?>" <?= $item->unit_id == $unt->id ? 'selected' : '' ?>><?= $unt->unit_name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Condition</label>
                    <div class="col-12">
                        <label class="css-control css-control-primary css-radio">
                            <input type="radio" class="css-control-input" id="kondisi_baik" name="status_barang" value="baik" <?= $item->status_barang == 'baik' || $item->status_barang == null ? 'checked' : '' ?>>
                            <span class="css-control-indicator"></span> Baik
                        </label>
                        <label class="css-control css-control-secondary css-radio">
                            <input type="radio" class="css-control-input" id="kondisi_rusak" name="status_barang" value="rusak" <?= $item->status_barang == 'rusak' || $item->status_barang == null ? 'checked' : '' ?>>
                            <span class="css-control-indicator"></span> Rusak
                        </label>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="ecom-product-price">Price</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-fw fa-usd"></i>
                                </span>
                            </div>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Rp. 0" value="<?= $item->price?>">
                        </div>
                    </div>
                </div>    
            </div>                
        </div>
        <!-- <?php if($page == 'edit'){ ?>
        <div class="block block-themed block-rounded block-shadow">
        <div class="block-header block-header-default bg-gd-dusk">
                <h3 class="block-title">Photo</h3>
            </div>
            <div class="block-content block-content-full">
                                  
                <div class="row gutters-tiny items-push">
                <div class='table-responsive'>
                            <table width="100%" class='table' id='table_data_gambar'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table_body">
                                </tbody>
                            </table>
                        </div>
                    
                </div>
            </div>
            
            </div>
            <?php }?> -->

        <?php if($page == 'edit'){ ?>
        <div class="block block-rounded block-shadow">
            <div class="block-header block-header-default">
                <h3 class="block-title">Riwayat</h3>
            </div>
            <div class="block-content">
                <div class="form-group row">
                    <label class="col-12" for="thumbnail">Waktu dibuat</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="created_at" name="created_at" placeholder="Waktu dibuat" value="<?= $item->created_at ?>" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="thumbnail">Terakhir diubah</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="updated_at" name="updated_at" placeholder="Waktu dibuat" value="<?= $item->updated_at ?>" disabled>
                    </div>
                </div>
            </div>                
        </div>
        <?php } ?>

    </div>
</div>
</form>