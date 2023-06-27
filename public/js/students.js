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
        console.log('month: ', month, text_search)

        $.ajax({
            type: 'GET',
            url: ajaxUrl,
            data: {
                'action': actionPagination,
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

let uploadUserInputs = []

const ExcelToJSON = function () {
    this.parseExcel = function (file) {
        const reader = new FileReader()

        reader.onload = function (e) {
            const data = e.target.result
            const workbook = XLSX.read(data, {
                type: 'binary',
                dateNF: 'mm/dd/yyyy',
            })

            workbook.SheetNames.forEach(function (sheetName) {
                const XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName], {
                    defval: '',
                    raw: false,
                    blankrows: true,
                })
                const productList = JSON.parse(JSON.stringify(XL_row_object))

                for (i = 0; i < productList.length; i++) {
                    console.log(`productList[i]: `, productList[i])
                    const columns = Object.values(productList[i])
                    uploadUserInputs.push(columns)
                }
            })
        }
        reader.onerror = function (ex) {
            console.log(ex)
        }

        reader.readAsBinaryString(file)
    }
}

function handleFileSelect(evt) {
    uploadUserInputs = []
    const files = evt.target.files // FileList object
    $('#message-upload-user').html(' ')

    for (var i = 0, file; file = files[i]; i++) {
        var sFileName = file.name
        var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase()
        console.log('sFileExtension: ', sFileExtension)
        const extensionAccess = ['csv', 'xlsx']

        if (!extensionAccess.includes(sFileExtension)) {
            $('#message-upload-user').html('ファイルの形式が正しくありません')
            return
        }

        $('#file-name-upload-user').html(sFileName)
    }

    const xl2json = new ExcelToJSON()
    console.log('xl2json: ', xl2json)
    xl2json.parseExcel(files[0])
}

// document.getElementById('fileuploadUser').addEventListener('change', handleFileSelect, false)

function handleFileSelectTwo(evt) {
    uploadUserInputs = []
    const files = evt.target.files // FileList object
    $('#message-upload-user').html(' ')

    for (var i = 0, file; file = files[i]; i++) {
        var sFileName = file.name
        var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase()
        const extensionAccess = ['csv', 'xlsx']

        if (!extensionAccess.includes(sFileExtension)) {
            $('#message-upload-user').html('ファイルの形式が正しくありません')
            return
        }

        $('#file-name-upload-user').html(sFileName)
    }

    // Read the contents of the CSV file
    const reader = new FileReader();
    reader.readAsText(files[0], 'Shift-JIS');

    // Parse the CSV data using PapaParse
    reader.onload = function () {
        const csvData = reader.result;
        const parsedData = Papa.parse(csvData, {
            header: true,
        });

        parsedData.data.forEach((h) => {
            h.Date = Date.parse(h.Date);
        });

        const productList = parsedData.data;

        for (i = 0; i < productList.length; i++) {
            console.log(`productList[i]: `, productList[i])
            const columns = Object.values(productList[i])
            uploadUserInputs.push(columns)
        }

        console.log('uploadDataUserInputs: ', uploadUserInputs)
    };
}

document.getElementById('fileuploadUser').addEventListener('change', handleFileSelectTwo, false);

$('#submitUploadUser').on('click', function (e) {
    e.preventDefault()
    if (uploadUserInputs.length <= 0) {
        $('#message-upload-user').html('ファイルを空にすることはできません')
        return
    }

    $.ajax({
        type: 'POST',
        url: ajaxUrl,
        data: {
            'action': 'ExcelAction',
            'excel': JSON.stringify(uploadUserInputs)
        },
        beforeSend: function () {
        },
        success: function (response) {
            $('#message-upload-user').html('Upload successfully')
            setTimeout(function () {
                window.location.reload()
            }, 2000)
        },
        error: function () {
            $('#message-upload-user').html('Upload failed');
        }
    })
})

//upload data by user

let uploadDataUserInputs = []

const ExcelToJSONByUploadDataUser = function () {
    this.parseExcel = function (file) {
        const reader = new FileReader()
        reader.onload = function (e) {
            console.log(2)

            const data = e.target.result
            const workbook = XLSX.read(data, {
                type: 'binary',
                dateNF: 'mm/dd/yyyy',
            })

            console.log('workbook: ', workbook)

            workbook.SheetNames.forEach(function (sheetName) {
                const XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName], {
                    defval: '',
                    raw: false,
                    blankrows: true,
                })
                const productList = JSON.parse(JSON.stringify(XL_row_object))
                const keys = Object.keys(productList[0])
                uploadDataUserInputs = [keys]

                for (i = 0; i < productList.length; i++) {
                    const columns = Object.values(productList[i])
                    uploadDataUserInputs = [...uploadDataUserInputs, columns]
                }
            })
        }

        reader.onerror = function (ex) {
            console.log(ex)
        }

        reader.readAsBinaryString(file)
    }
}

function handleFileSelectUploadDataUser(evt) {
    uploadDataUserInputs = []
    const files = evt.target.files // FileList object
    $('#message-upload-data-user').html(' ')

    for (var i = 0, file; file = files[i]; i++) {
        var sFileName = file.name
        var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase()
        const extensionAccess = ['csv', 'xlsx']

        if (!extensionAccess.includes(sFileExtension)) {
            $('#message-upload-data-user').html('ファイルの形式が正しくありません')
            return
        }

        $('#file-name-upload-data-user').html(sFileName)
    }

    const xl2json = new ExcelToJSONByUploadDataUser()
    xl2json.parseExcel(files[0])
}

// document.getElementById('fileuploadDataUser').addEventListener('change', handleFileSelectUploadDataUser, false);

function handleFileSelectUploadDataUserTwo(event) {
    const input = event.target;

    uploadDataUserInputs = []

    const files = event.target.files // FileList object
    $('#message-upload-data-user').html(' ')

    for (var i = 0, file; file = files[i]; i++) {
        var sFileName = file.name
        var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase()
        const extensionAccess = ['csv', 'xlsx']

        if (!extensionAccess.includes(sFileExtension)) {
            $('#message-upload-data-user').html('ファイルの形式が正しくありません')
            return
        }

        $('#file-name-upload-data-user').html(sFileName)
    }


    // Read the contents of the CSV file
    const reader = new FileReader();
    reader.readAsText(input.files[0], 'Shift-JIS');

    // Parse the CSV data using PapaParse
    reader.onload = function () {
        const csvData = reader.result;
        const parsedData = Papa.parse(csvData, {
            header: true, dateNF: 'mm/dd/yyyy',
        });

        parsedData.data.forEach((h) => {
            h.Date = Date.parse(h.Date);
        });

        const keys = Object.values(parsedData.meta.fields);
        const productList = parsedData.data;

        uploadDataUserInputs = [keys];

        for (i = 0; i < productList.length; i++) {
            const columns = Object.values(productList[i]);
            if (columns.length == 1)
                continue;
            uploadDataUserInputs = [...uploadDataUserInputs, columns]
        }

        console.log('uploadDataUserInputs: ', uploadDataUserInputs)
    };
}

document.getElementById('fileuploadDataUser').addEventListener('change', handleFileSelectUploadDataUserTwo)

$('#submitUploadDataUser').on('click', function (e) {
    e.preventDefault();

    const overwrite_data = $('#overwrite_data').is(':checked');

    if (uploadDataUserInputs.length <= 0) {
        $('#message-upload-data-user').html('ファイルを空にすることはできません')
        return
    }

    $.ajax({
        type: 'POST',
        url: ajaxUrl,
        data: {
            'action': 'uploadDataUserAction',
            'excel': JSON.stringify(uploadDataUserInputs),
            'overwrite_data': overwrite_data,
        },
        beforeSend: function () {
        },
        success: function (response) {
            $('#message-upload-data-user').html('Upload successfully')
            setTimeout(function () {
                window.location.reload()
            }, 2000)
        },
        error: function () {
            $('#message-upload-user').html('Upload failed');
        }
    })
})

$('#upload-user').on('hidden.bs.modal', function () {
    $('#message-upload-user').html(' ')
})

$('#upload-data-user').on('hidden.bs.modal', function () {
    $('#message-upload-data-user').html('')
})
