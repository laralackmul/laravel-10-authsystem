$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function renderDataTable(target_data_table, data_url, data_column) {
    // console.log("delete success");
    // console.log(target_data_table);
    // console.log(data_url + "@@" + data_column);
    var table = target_data_table.DataTable({
        destroy: true,
        lengthMenu: [10, 50, 100],
        scrollCollapse: true,
        order: [
            ['0', 'asc']
        ],
        orderClasses: false,
        colReorder: true,
        processing: true,
        serverSide: true,
        ajax: data_url,
        columns: data_column
    });
}
function editOperation(callback, edit_url, files = false, edit_class = 'edit-row') {
    $(document).on('click', "." + edit_class, function (e) {
        console.log('edit url : ' + edit_url);
        
        const edit_data = {
            id: $(this).data('id')
        }
        console.log('edit data id : ' + $(this).data('id'));
        makeAjaxPostText(edit_data, edit_url).done(function (response) {
            console.log(response);
            // remove_loader();
            $('.add_edit').html(response);
            callback();
        });
    });
}
function deleteOperation(callback, delete_class, delete_url) {
    
    $(document).on('click', '.' + delete_class, function (e) {
        const id = $(this).data('id');
        console.log('Id For Delete : ' + id);
        swalConfirm("Do you really want to delete this ?").then(function (s) {
            if (s.value) {
                const url = delete_url;
                const data = {
                    id: id
                };
                makeAjaxPost(data, url).done(function (response) {
                    callback(response)
                });
            } else {

            }
        })
    });
}

function makeAjaxPost(data, url, load) {
    //console.log('Ajax Post Url : ' + url+data);
    return $.ajax({
        url: url ,
        type: 'post',
        dataType: 'json',
        data: data,
        cache: false,
        beforeSend: function () {
            // if (typeof (load) != "undefined" && load !== null) {
            //     load.ladda('start');
            // }
        }
    }).always(function () {
        // if (typeof (load) != "undefined" && load !== null) {
        //     load.ladda('stop');
        // }
    }).fail(function () {
        swalError();
        // if (typeof (load) != "undefined" && load !== null) {
        //     load.ladda('stop');
        // }

    });
}
function makeAjaxPostText(data, url, load) {
    return $.ajax({
        url: url,
        type: 'get',
        
        data: data,
        cache: false,
        beforeSend: function () {
        }
    }).always(function () {
    }).fail(function () {
        alert("error found");

    });
}

function swalError(msg) {
    var message = typeof (msg) != "undefined" && msg !== null ? msg : "Something went wrong";
    Swal.fire({
        title: "Sorry !!",
        html: message,
        type: "error",
        showConfirmButton: false,
        // timer: 1000
    });
}
function swalWarning(msg) {
    var message = typeof (msg) != "undefined" && msg !== null ? msg : "Something went wrong";
    Swal.fire({
        title: "Warning !!",
        html: message,
        type: "warning",
        showConfirmButton: false,
        // timer: 1000
    });
}
function swalSuccess(msg) {
    var message = typeof (msg) != "undefined" && msg !== null ? msg : "Action has been Completed Successfully";  
    Swal.fire({
        title: 'Successful !!',
        html: message,
        type: 'success',
        showConfirmButton: false,
        timer: 1500
    });
}
function swalRedirect(url, msg, mode) {
    var message = typeof (msg) != "undefined" && msg !== null ? msg : "Action has been Completed Successfully";
    var title = 'Successful !!';
    var type = 'info';
    if (typeof (mode) != "undefined" && mode !== null) {
        if (mode == 'success') {
            var title = 'Successful !!';
            var type = 'success';
        } else if (mode == 'error') {
            var title = 'Failed !!';
            var type = 'error';
        } else if (mode == 'warning') {
            var title = 'Warning !!';
            var type = 'warning';
        } else if (mode == 'question') {
            var title = 'Warning !!';
            var type = 'question';
        } else {
            var title = 'Successful !!';
            var type = 'info';
        }
    }
    return Swal.fire({
        title: title,
        html: message,
        type: type,
        reverseButtons: true,
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Thank You',
        allowOutsideClick: false
    }).then(function (s) {
        if (s.value) {
            if (typeof (url) != "undefined" && url !== null) {
                window.location.replace(url);
            } else {
                location.reload();
            }
        }
    });
}
function swalConfirm(msg) {
    var message = typeof (msg) != "undefined" && msg !== null ? msg : "You won't be able to revert this!";
    return Swal.fire({
        title: 'Are you sure?',
        html: message,
        type: 'warning',
        reverseButtons: true,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!',
        cancelButtonText: 'No'
    });
}
