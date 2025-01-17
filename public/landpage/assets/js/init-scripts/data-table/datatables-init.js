(function ($) {
    //    "use strict";


    /*  Data Table
    -------------*/

    $('#bootstrap-data-table').DataTable({
		lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
		pageLength: 10,
    });

    var t = $('#bootstrap-data-table-export').DataTable({
		lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
		buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
		pageLength: 10,
		//"order": [[ 1, 'asc' ]],

	});

	// untuk table m_PengesahanKehadiran dan m_UbahKehadiran
    var t = $('#bootstrap-data-table-export1').DataTable({
		lengthMenu: [[-1], ["All"]],
		buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
		pageLength: -1,
		lengthChange: false,
		paging: false,
		//"order": [[ 1, 'asc' ]],

	});

	// untuk table p_SemakSenaraiAhli
	var t = $('#bootstrap-data-table-export2').DataTable({
		lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
		buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
		pageLength: 10,
		//"order": [[ 1, 'asc' ]],

	});
	
	//tambah
	t.on( 'order.dt search.dt', function () {
		t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
			cell.innerHTML = i+1;
		} );
	} ).draw();
	//tutup tambah

	$('#row-select').DataTable( {
        initComplete: function () {
				this.api().columns().every( function () {
					var column = this;
					var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
							);

							column
								.search( val ? '^'+val+'$' : '', true, false )
								.draw();
						} );

					column.data().unique().sort().each( function ( d, j ) {
						select.append( '<option value="'+d+'">'+d+'</option>' )
					} );
				} );

			}
		} );

})(jQuery);




