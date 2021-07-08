<script src="<?= base_url(); ?>assets/js/plugins/bootstrap-datepicker.js"></script>
<script src="<?= base_url(); ?>assets/js/buttons/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>assets/js/buttons/jszip.min.js"></script>
<script src="<?= base_url(); ?>assets/js/buttons/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>assets/js/buttons/vfs_fonts.js"></script>
<script src="<?= base_url(); ?>assets/js/buttons/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>assets/js/buttons/buttons.print.min.js"></script>
<script>
  $(document).ready(function () {
     $('#table_yearly').DataTable({
        "dom": 'Bfrtip',
        "buttons": [
            {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
                titleAttr: 'Copy',
                footer:     true
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel',
                footer:     true
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-text-o"></i>',
                titleAttr: 'CSV',
                footer:     true
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF',
                footer:     true
            }
        ],
     })
  })
</script>