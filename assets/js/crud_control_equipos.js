// modal add
$("#addpermiso, #motivo, #jefatura, #empleado, #dias").bind(
    "focusout click change",
    function () {
      validaAddPermiso();
    }
  );

function validaAddPermiso() {
var varerror = 0;
if ($("#motivo").val() == "") {
    $("#motivo").parent().addClass("has-error");
    $("#motivo").addClass("has-error2");
    varerror = 1;
} else {
    $("#motivo").parent().removeClass("has-error");
    $("#motivo").removeClass("has-error2");
}

if ($("#jefatura").val() == "") {
    $("#jefatura").parent().addClass("has-error");
    $("#jefatura").addClass("has-error2");
    varerror = 1;
} else {
    $("#jefatura").parent().removeClass("has-error");
    $("#jefatura").removeClass("has-error2");
}

if ($("#empleado").val() == "") {
    $("#empleado").parent().addClass("has-error");
    $("#empleado").addClass("has-error2");
    varerror = 1;
} else {
    $("#empleado").parent().removeClass("has-error");
    $("#empleado").removeClass("has-error2");
}
if ($("#dias").val() == "" || $("#dias").val() <=0 || $("#dias").val() >4) {
    $("#dias").parent().addClass("has-error");
    $("#dias").addClass("has-error");
    MensajeModal("Los días administrativos no pueden ser menores a 0 o mayores a 4", "red");
    varerror = 1;
} else {
    $("#dias").parent().removeClass("has-error");
    $("#dias").removeClass("has-error");
    MensajeModal("","");
}

if (varerror == 1) {
    $("#GuardarPermiso").addClass("disabled");
    $("#GuardarPermiso").prop("disabled", true);
    $("#GuardarPermiso").each(function () {
    this.style.pointerEvents = "none";
    });
} else {
    $("#GuardarPermiso").prop("disabled", false);
    $("#GuardarPermiso").removeClass("disabled");
    $("#GuardarPermiso").each(function () {
    this.style.pointerEvents = "auto";
    });
}
}

// validación modal edit
$("#btn_edit, #motivo_edit, #jefatura_edit, #empleado_edit, #dias_edit").bind(
    "focusout click change",
    function () {
      validaEditPermiso();
    }
  );

function validaEditPermiso() {
var varerror = 0;
if ($("#motivo_edit").val() == "") {
    $("#motivo_edit").parent().addClass("has-error");
    $("#motivo_edit").addClass("has-error2");
    varerror = 1;
} else {
    $("#motivo_edit").parent().removeClass("has-error");
    $("#motivo_edit").removeClass("has-error2");
}

if ($("#jefatura_edit").val() == "") {
    $("#jefatura_edit").parent().addClass("has-error");
    $("#jefatura_edit").addClass("has-error2");
    varerror = 1;
} else {
    $("#jefatura_edit").parent().removeClass("has-error");
    $("#jefatura_edit").removeClass("has-error2");
}

if ($("#empleado_edit").val() == "") {
    $("#empleado_edit").parent().addClass("has-error");
    $("#empleado_edit").addClass("has-error2");
    varerror = 1;
} else {
    $("#empleado_edit").parent().removeClass("has-error");
    $("#empleado_edit").removeClass("has-error2");
}
if ($("#dias_edit").val() == "0" || $("#dias_edit").val() <=0 || $("#dias_edit").val() >4) {
    $("#dias_edit").parent().addClass("has-error");
    $("#dias_edit").addClass("has-error");
    MensajeModal("Los días administrativos no pueden ser menores a 0 o mayores a 4", "red");
    varerror = 1;
} else {
    $("#dias_edit").parent().removeClass("has-error");
    $("#dias_edit").removeClass("has-error");
    MensajeModal("", "");
}

if (varerror == 1) {
    $("#EditarPermiso").addClass("disabled");
    $("#EditarPermiso").prop("disabled", true);
    $("#EditarPermiso").each(function () {
    this.style.pointerEvents = "none";
    });
} else {
    $("#EditarPermiso").prop("disabled", false);
    $("#EditarPermiso").removeClass("disabled");
    $("#EditarPermiso").each(function () {
    this.style.pointerEvents = "auto";
    });
}
}

// // Traer datos del permiso modal edit
$(document).on("click", "#btn_edit", function () {
    var idPermiso = $(this).data("id");
    $("#idPermisoEditar").val(idPermiso);
    $("#idPermiso_Editar").html("ID " + "# " + idPermiso + "");
    $.ajax({
    type: "POST",
    dataType: "json",
    url: "control_equipos_ajax.php?codaccion=mostrarpermisos&id=" + idPermiso,
    success: function (data) {
        $("#motivo_edit").val(data[0].motivo);
        $("#jefatura_edit").val(data[0].jefatura);
        $("#empleado_edit").val(data[0].empleado);
        $("#dias_edit").val(data[0].dias);
        $("#descripcion_edit").val(data[0].descripcion);
    },
    });
});

// // Confirmation Editar permiso
$("#EditarPermiso").confirmation({
    placement: "top",
    title: "¿Est\u00E1 seguro de guardar la información?",
    btnOkClass: "btn btn-sm btn-success",
    btnOkLabel: "Editar",
    btnOkIcon: "glyphicon glyphicon-ok",
    btnCancelClass: "btn btn-sm btn-default",
    btnCancelLabel: "Cancelar",
    btnCancelIcon: "glyphicon glyphicon-remove",
    onConfirm: function () {
      MensajeModal(
        "<i class='fa fa-spinner fa-spin' style='font-size:25px;'></i>Por favor espere, estamos subiendo la informaci&oacute;n.",
        "Green"
        );
        $("#EditarPermiso").addClass("disabled");
        $("#EditarPermiso").prop("disabled", true);
        $("#EditarPermiso").each(function () {
          this.style.pointerEvents = "none";
        })
        setTimeout(function () {
          $("#permisoForm_edit").submit();
      }, 1500);
    },
  });

//   // Traer datos del permiso modal eliminar
$(document).on("click", "#btn_delete", function () {
    var idPermiso = $(this).data("id");
    $("#idPermisoEliminar").val(idPermiso);
    $("#idPermiso_Delete").html("ID " + "# " + idPermiso + "");
    $.ajax({
    type: "POST",
    dataType: "json",
    url: "control_equipos_ajax.php?codaccion=mostrarpermisos&id=" + idPermiso,
    success: function (data) {
        $("#motivo_delete").val(data[0].motivo);
        $("#jefatura_delete").val(data[0].jefatura);
        $("#empleado_delete").val(data[0].empleado);
        $("#dias_delete").val(data[0].dias);
        $("#descripcion_delete").val(data[0].descripcion);
    },
    });
});

// // Confirmation Eliminar Contrato
$("#EliminarPermiso").confirmation({
    placement: "top",
    title: "¿Est\u00E1 seguro de eliminar la información?",
    btnOkClass: "btn btn-sm btn-danger",
    btnOkLabel: "Eliminar",
    btnOkIcon: "glyphicon glyphicon-ok",
    btnCancelClass: "btn btn-sm btn-default",
    btnCancelLabel: "Cancelar",
    btnCancelIcon: "glyphicon glyphicon-remove",
    onConfirm: function () {
      MensajeModal(
        "<i class='fa fa-spinner fa-spin' style='font-size:25px;'></i>Por favor espere, estamos eliminando la informaci&oacute;n.",
        "Green"
        );
        $("#EliminarPermiso").addClass("disabled");
        $("#EliminarPermiso").prop("disabled", true);
        $("#EliminarPermiso").each(function () {
          this.style.pointerEvents = "none";
        })
        setTimeout(function () {
          $("#permisoForm_delete").submit();
      }, 1500);
    },
  });

//   // GENERIC CRUD
function MensajeModal(mensagem, coloralert) {
    $(".MensajeModal")
      .fadeIn(1000)
      .css({
        color: coloralert,
        visibility: "visible",
      })
      .html(mensagem);
  }