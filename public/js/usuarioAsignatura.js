$(document).on("click", ".inscribir", function () {
    if (!confirm("¿Está seguro de inscribir ésta asignatura?")){
        return;
    }
    asignatura_id=$(this).data("id");
    $.ajax({
        method:'post',
        url:urlInscribir,
        data:{asignatura_id:asignatura_id, _token:token}
    }).done(function (res) {
        console.log(res);
        new PNotify({
            title: 'Mensaje',
            text: res.mensaje,
            type: res.type
        });
        setTimeout(function(){
            location.reload();
        }, 2000);
    }).error(function (msj) {
        console.log(msj.responseText);
    });
});
$(document).on("click", ".retirar", function () {
    if (!confirm("¿Está seguro de inscribir ésta asignatura?")){
        return;
    }
    id=$(this).data("id");
    $.ajax({
        method:'post',
        url:urlRetirar,
        data:{id:id, _token:token}
    }).done(function (res) {
        console.log(res);
        new PNotify({
            title: 'Mensaje',
            text: res.mensaje,
            type: res.type
        });
        setTimeout(function(){
            location.reload();
        }, 2000);
    }).error(function (msj) {
        console.log(msj.responseText);
    });
});