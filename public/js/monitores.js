$(document).ready(function () {
    $("#monitores").dataTable({
        language:{
            url:'js/Spanish.json'
        }
    });
});
$(document).on("clicl", ".eliminar", function (e) {
    e.preventDefault();
    alert("asddqwe");
});
$(document).on("change", "#asignatura_id", function () {
    if ($(this).val()==""){
        $("#usuario_id").html("<option value=''>Seleccione</option>");
        $("#usuario_id").attr('disabled', true);
        return;
    }
    asignatura_id=$(this).val();
    $.ajax({
        method:'post',
        url:urlGetUsuarios,
        data:{asignatura_id:asignatura_id, _token:token}
    }).done(function (res) {
        strSelect="<option value=''>Seleccione</option>";
        cont=0;
        $.each(res["usuarios_asignatura"], function (k, v) {
            cont++;
            strSelect+="<option value='"+v["id"]+"'>"+v["nombre"]+" "+v["apellido"]+"</option>";
        });
        $("#usuario_id").html(strSelect);
        if (!cont){
            $("#usuario_id").attr('disabled', true);
        }else{
            $("#usuario_id").attr('disabled', false);
        }
    }).error(function (msj) {
        console.log(msj.responseText);
    });
});