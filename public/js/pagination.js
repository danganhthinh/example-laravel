const ViewData = {
    loadPage(queryData = '') {
        $.ajax({
            type: "GET",
            url: ajaxUrl,
            data: {
                'action': actionPagination,
                'queryData': queryData
            },
            dataType: "html",
            beforeSend: function () {
            },
            success: function (response) {
                const data = JSON.parse(response);
                $('#table-students').html(data.htmlTable);
                $('#paginate_links').html(data.linkPagination);
            }
        });
    },

    init() {
        ViewData.loadPage();
    }
};
(() => {
    ViewData.init();
})();
