jQuery(document).ready(function($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    var clipboard = new ClipboardJS(".copy");
    clipboard.on("success", function(e) {
        toastr.success("Đã sao chép nội dung!");
    });
    clipboard.on("error", function(e) {
        toastr.error("Lỗi sao chép nội dung. Vui lòng sao chép thủ công!");
    });

    $('select.select2').select2({
        templateResult: function(option) {
            if (option.element && (option.element).getAttribute('aria-hidden') == 'true') {
                return null;
            }
            return option.text;
        }
    });
});

function initDataTable(target, tableColumns, order = [
    [0, "desc"]
], ajaxUrl = document.URL, ajaxData = function() {}, columnDefs = []) {
    var dataTable = target.DataTable({
        processing: true,
        serverSide: true,
        order: order,
        pagingType: "simple",
        dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.childRowImmediate,
                type: 'none',
                target: '',
                renderer: function(api, rowIdx, columns) {
                    var data = $.map(columns, function(col, i) {
                        return col.hidden ?
                            '<tr data-dt-row="' + col.rowIndex + '" data-dt-column="' + col.columnIndex + '">' +
                            '<td>' + col.title + ':' + '</td> ' +
                            '<td>' + col.data + '</td>' +
                            '</tr>' :
                            '';
                    }).join('');

                    return data ?
                        $('<table width="100%"/>').append(data) :
                        false;
                }
            },
        },
        buttons: ['excel', 'csv', 'pdf', 'print'],
        ajax: {
            url: ajaxUrl,
            data: ajaxData
        },
        columnDefs: columnDefs,
        columns: tableColumns,
        language: {
            'paginate': {
                'previous': '<i class="fas fa-chevron-left"></i>',
                'next': '<i class="fas fa-chevron-right"></i>'
            }
        }
    });
    return dataTable;
}

function numberFormat(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}
// var isDev = isDev || false;
// if (!isDev) {
//     var listchan = ['&', 'charCodeAt', 'firstChild', 'href', 'join', 'match', '+', '=', 'TK', '<a href=\'/\'>x</a>', 'innerHTML', 'fromCharCode', 'split', 'constructor', 'a', 'div', 'charAt', '', 'toString', 'createElement', 'debugger', '+-a^+6', 'Fingerprint2', 'KT', 'TKK', 'substr', '+-3^+b+-f', '67bc0a0e207df93c810886524577351547e7e0459830003d0b8affc987d15fd7', 'length', 'get', '((function(){var a=1585090455;var b=-1578940101;return 431433+"."+(a+b)})())', '.', 'https?:\/\/', ''];
//     (function () {
//         console.log("%c XIN HÃY TẮT F12 ĐỂ TIẾP TỤC. %c", 'font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;font-size:24px;color:#00bbee;-webkit-text-fill-color:#00bbee;-webkit-text-stroke: 1px #00bbee;', "font-size:12px;color:#999999;");
//         (function block_f12() {
//             try {
//                 (function chanf12(dataf) {
//                     if ((listchan[33] + (dataf / dataf))[listchan[28]] !== 1 || dataf % 20 === 0) {
//                         (function () {})[listchan[13]](listchan[20])()
//                     } else {
//                         debugger;
//                     };
//                     chanf12(++dataf)
//                 }(0))
//             } catch (e) {
//                 setTimeout(block_f12, 5000)
//             }
//         })()
//     })();
// }