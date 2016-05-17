$(document).on("click", ".correcta", function (e) {
    if (!confirm('¿Está seguro de que ésta es la respuesta correcta?')){
        e.preventDefault();
    }
    return true;
});
$(document).on("click", "#preguntar", function (e) {
    e.preventDefault();
    if (!confirm('¿Está seguro de realizar ésta pregunta?')){
        return;
    }
    $("#form_preguntar").submit();
});
$(document).on("click", ".responder", function (e) {
    if(!confirm('¿Está seguro de responder?')){
        return;
    }
    pregunta_id=$(this).data("id");
    respuesta=$(this).closest('div').children('textarea').val();
    ul=$(this).closest('div').children('ul');
    $.ajax({
        method:'post',
        url:urlResponder,
        data:{pregunta_id:pregunta_id,respuesta:respuesta,_token:token}
    }).done(function (res) {
        console.log(res);
        if (res.mensaje){
            new PNotify({
                title: 'Mensaje',
                text: res.mensaje,
                type: res.type
            });
            setTimeout(function(){
                location.reload();
            }, 1000);
        }
    }).error(function (msj) {
        resp = $.parseJSON(msj.responseText);
        strErrores="<ul>";
        $.each(resp, function (k, v) {
            strErrores+="<li>"+k+"<ul>";
            $.each(v, function (m, n) {
                strErrores+="<li>"+n+"</li>";
            });
            strErrores+="</ul></li>";
        });
        strErrores+="</ul>";
        new PNotify({
            title: 'Mensaje',
            text: strErrores,
            type: 'error'
        });
    });
});

$(document).on("click", ".valorar", function () {
    $("#pregunta_id").val($(this).data('id'));
    $("#modal-valoracion").modal();
});
$(document).on("change mouseover", "#valoracion", function () {
    cantidad=$(this).val();
    cant=0;
    strStars="";
    for(i=0;i<cantidad;i++){
        if (i==0){
            strStars+='<i class="fa fa-star-o fa-lg" aria-hidden="true"></i>';
        }else{
            strStars+='<i class="fa fa-star-o fa-'+(parseInt(i)+1)+'x" aria-hidden="true"></i>';
        }
    }
    $("#estrellas").html(strStars);
});

$(document).on("click", "#valorar", function (e) {
    if (!confirm('¿Está seguro de realizar ésta valoración?')){
        e.preventDefault();
    }
    return true;
});