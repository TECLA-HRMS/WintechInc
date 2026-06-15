// DataTable Functionlity
if ($("table.first").length) {
    
$(document).ready(function () {
    $('table.first').DataTable({
        language: {
            lengthMenu: "Show _MENU_ entries",
            paginate: {
                previous: "<button class='btn-pagination'>Previous</button>",
                next: "<button class='btn-pagination'>Next</button>"
            }
        },
        pagingType: "simple_numbers",  // Shows "Previous," "Next," and page numbers without "First" and "Last"
        initComplete: function () {
            var pagination = $('#myTable_paginate');
            pagination.addClass('custom-pagination');
            
            pagination.find('a').each(function () {
                if ($(this).hasClass('current')) {
                    $(this).wrap("<button class='btn-pagination current-page'></button>");
                } else {
                    $(this).wrap("<button class='btn-pagination'></button>");
                }
                $(this).contents().unwrap();
            });
        }
    });
});
  
}



