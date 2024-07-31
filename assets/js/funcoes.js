function chamaExcluir(id, str){
    $('#modalExcluir').modal('show');
    $('#idexcluir').val(id);
    $('#txt-excluir').html(str);
}

function chamaDeslogar(id, str){
    $('#modalDeslogar').modal('show');
    $('#iddeslogar').val(id);
    $('#txt-deslogar').html(str);
}

// function chamaAnularQuestao(id, str){
//     $('#modalAnular').modal('show');
//     $('#idanular').val(id);
//     $('#txt-anular').html(str);
// }

function notify(from, align, icon, type, animIn, animOut, title, message) {
    $.growl({
        icon: icon,
        title: title,
        message: message,
        url: ''
    }, {
        element: 'body',
        type: type,
        allow_dismiss: true,
        placement: {
            from: from,
            align: align
        },
        offset: {
            x: 30,
            y: 30
        },
        spacing: 10,
        z_index: 999999,
        delay: 2500,
        timer: 5000,
        url_target: '_blank',
        mouse_over: false,
        animate: {
            enter: animIn,
            exit: animOut
        },
        icon_type: 'class',
        template: '<div data-growl="container" class="alert" role="alert">' +
            '<button type="button" class="close" data-growl="dismiss">' +
            '<span aria-hidden="true">&times;</span>' +
            '<span class="sr-only">Close</span>' +
            '</button>' +
            '<span data-growl="icon"></span>' +
            '<span data-growl="title"></span>' +
            '<span data-growl="message"></span>' +
            '<a href="#!" data-growl="url"></a>' +
            '</div>'
    });
}

$('.notifications.btn').on('click', function(e) {
    e.preventDefault();
    var nFrom = $(this).attr('data-from');
    var nAlign = $(this).attr('data-align');
    var nIcons = $(this).attr('data-notify-icon');
    var nType = $(this).attr('data-type');
    var nAnimIn = $(this).attr('data-animation-in');
    var nAnimOut = $(this).attr('data-animation-out');
    var title = $(this).attr('data-title');
    var msg = $(this).attr('data-msg');
    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, title, msg);
});