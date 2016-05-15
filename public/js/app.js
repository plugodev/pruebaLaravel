$(document).ready(function(){
    $("#asignaturas").dataTable({
        language:{
            url:'js/Spanish.json'
        }
    });
});
$(document).on("click", ".modificar", function () {
    id=$(this).data("id");
    tr=$(this).closest('tr');
    button=$(this);
    console.log(tr);
    nombre=$(this).data('nombre');
    $("#id").val(id);
    $("#edit-nombre").val(nombre);
    $("#edit-modal").modal();
});
$(document).on("click", "#guardar", function () {
    id=$("#id").val();
    nombre=$("#edit-nombre").val();
    $.ajax({
        method:'post',
        url:urlModificar,
        data:{id:id,nombre:nombre,_token:token}
    }).done(function (res) {
        new PNotify({
            title: 'Mensaje',
            text: res.mensaje,
            type: res.type
        });
        $("#edit-modal").modal("hide");
        tr.children()[1].textContent=nombre;
        button.data('nombre', nombre);
    }).error(function (msj) {
        console.log(msj);
    });
});