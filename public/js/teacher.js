(function ($) {
    $(document).ready(function () {
        $('.quatrang').on('click', '.paginate_links a', function (e) {
            e.preventDefault()
            const hrefThis = $(this).prop('href')
            const url = new URL(hrefThis)
            const paged = url.searchParams.get('paged') || 1

            getData(paged)
        })

        $('#btn-search').on('click', function () {
            getData()
        })
    })

    function getData(paged = 1) {
        const text_search = $('#text_search').val()
        const month = $('#month').val()

        $.ajax({
            type: 'GET',
            url: ajaxUrl,
            data: {
                'action': 'teacher_pagination',
                paged,
                month,
                text_search
            },
            dataType: 'html',
            beforeSend: function () {
            },
            success: function (response) {
                const data = JSON.parse(response)
                console.log('data: ', data)
                $('#table-students').html(data.htmlTable)
                $('#paginate_links').html(data.linkPagination)
            }
        })
    }
})(jQuery)

const ViewData = {
    loadPage(queryData = '') {
        $.ajax({
            type: "GET",
            url: ajaxUrl,
            data: {
                'action': 'teacher_pagination',
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
