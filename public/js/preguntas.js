$(document).on("click", ".responder", function (e) {
    if(!confirm('¿Está seguro de responder?')){
        return;
    }
    pregunta_id=$(this).data("id");
    respuesta=$(this).parent().children()[0].value;
    console.log(respuesta);
    $.ajax({
        method:'post',
        url:urlResponder,
        data:{pregunta_id:pregunta_id,respuesta:respuesta,_token:token}
    }).done(function (res) {
        console.log(res);
        new PNotify({
            title: 'Mensaje',
            text: res.mensaje,
            type: res.type
        });
    }).error(function (msj) {
        console.log(msj);
    });
});