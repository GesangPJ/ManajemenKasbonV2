<!-- jQuery untuk tabel-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!--Datatables
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>-->

<!-- non jquery styling-->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

<!-- DataTables JS
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>-->



<!-- datatables option and addons-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></scrip>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/scroller/2.4.3/js/dataTables.scroller.min.js"></script>
<script src="https://cdn.datatables.net/searchpanes/2.3.1/js/dataTables.searchPanes.min.js"></script>



<script>
    $(document).ready(function() {
    var table = $('#tablekasbon').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/2.0.8/i18n/id.json',
        },
        responsive: true,
        paging: true,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        //dom: 'plrftiB',
        //dom: '<lfr<t>ipB>',
        //dom: '<"wrapper"plrftiB>',
        //dom: '<"top"lf>rt<"bottomStart"B><"bottomEnd"ip>',
        layout:{
            //bottomStart:'pageLength',
            //top1End:'search',
            top3Start:{
                buttons: [
                    {
                        extend: 'pdf',
                        text: 'Simpan Ke PDF',
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Simpan Ke Excel',
                        autoFilter: true,
                    },
                    {
                        extend: 'print',
                        text: 'Print Tabel',
                        //autoPrint: false
                    }
                ],
            },
            bottomEnd:'paging'
        },
        columnDefs: [
            { orderable: false, targets: [0,9] } // Disable ordering on the numbering column
        ],
        order: [],
        info:true, // Initial no order
        rowCallback: function(row, data, index) {
            // Add numbering column content
            $('td:eq(0)', row).html(index + 1);
        }
    });

    table.columns.adjust().responsive.recalc();
});
</script>
