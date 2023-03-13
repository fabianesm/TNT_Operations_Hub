// modal add
$("#addcontrato, #empleado, #tipo_contrato, #tipo_prestacion, #sueldo, #moneda").bind(
    "focusout click change",
    function () {
      validaAddContrato();
    }
  );

function validaAddContrato() {
var varerror = 0;
if ($("#empleado").val() == "") {
    $("#empleado").parent().addClass("has-error");
    $("#empleado").addClass("has-error2");
    varerror = 1;
} else {
    $("#empleado").parent().removeClass("has-error");
    $("#empleado").removeClass("has-error2");
}

if ($("#tipo_contrato").val() == "") {
    $("#tipo_contrato").parent().addClass("has-error");
    $("#tipo_contrato").addClass("has-error2");
    varerror = 1;
} else {
    $("#tipo_contrato").parent().removeClass("has-error");
    $("#tipo_contrato").removeClass("has-error2");
}

if ($("#tipo_prestacion").val() == "") {
    $("#tipo_prestacion").parent().addClass("has-error");
    $("#tipo_prestacion").addClass("has-error2");
    varerror = 1;
} else {
    $("#tipo_prestacion").parent().removeClass("has-error");
    $("#tipo_prestacion").removeClass("has-error2");
}
if ($("#sueldo").val() == "" || $("#sueldo").val() <=0) {
    $("#sueldo").parent().addClass("has-error");
    $("#sueldo").addClass("has-error");
    varerror = 1;
} else {
    $("#sueldo").parent().removeClass("has-error");
    $("#sueldo").removeClass("has-error");
}
if ($("#moneda").val() == "") {
    $("#moneda").parent().addClass("has-error");
    $("#moneda").addClass("has-error2");
    varerror = 1;
} else {
    $("#moneda").parent().removeClass("has-error");
    $("#moneda").removeClass("has-error2");
}

if (varerror == 1) {
    $("#GuardarContrato").addClass("disabled");
    $("#GuardarContrato").prop("disabled", true);
    $("#GuardarContrato").each(function () {
    this.style.pointerEvents = "none";
    });
} else {
    $("#GuardarContrato").prop("disabled", false);
    $("#GuardarContrato").removeClass("disabled");
    $("#GuardarContrato").each(function () {
    this.style.pointerEvents = "auto";
    });
}
}

// validación modal edit
$("#btn_edit, #empleado_edit, #tipo_contrato_edit, #tipo_prestacion_edit, #sueldo_edit, #moneda_edit").bind(
    "focusout click change",
    function () {
      validaEditContrato();
    }
  );

function validaEditContrato() {
var varerror = 0;
if ($("#empleado_edit").val() == "") {
    $("#empleado_edit").parent().addClass("has-error");
    $("#empleado_edit").addClass("has-error2");
    varerror = 1;
} else {
    $("#empleado_edit").parent().removeClass("has-error");
    $("#empleado_edit").removeClass("has-error2");
}

if ($("#tipo_contrato_edit").val() == "") {
    $("#tipo_contrato_edit").parent().addClass("has-error");
    $("#tipo_contrato_edit").addClass("has-error2");
    varerror = 1;
} else {
    $("#tipo_contrato_edit").parent().removeClass("has-error");
    $("#tipo_contrato_edit").removeClass("has-error2");
}

if ($("#tipo_prestacion_edit").val() == "") {
    $("#tipo_prestacion_edit").parent().addClass("has-error");
    $("#tipo_prestacion_edit").addClass("has-error2");
    varerror = 1;
} else {
    $("#tipo_prestacion_edit").parent().removeClass("has-error");
    $("#tipo_prestacion_edit").removeClass("has-error2");
}
if ($("#sueldo_edit").val() == "0") {
    $("#sueldo_edit").parent().addClass("has-error");
    $("#sueldo_edit").addClass("has-error");
    varerror = 1;
} else {
    $("#sueldo_edit").parent().removeClass("has-error");
    $("#sueldo_edit").removeClass("has-error");
}
if ($("#moneda_edit").val() == "") {
    $("#moneda_edit").parent().addClass("has-error");
    $("#moneda_edit").addClass("has-error2");
    varerror = 1;
} else {
    $("#moneda_edit").parent().removeClass("has-error");
    $("#moneda_edit").removeClass("has-error2");
}

if (varerror == 1) {
    $("#EditarContrato").addClass("disabled");
    $("#EditarContrato").prop("disabled", true);
    $("#EditarContrato").each(function () {
    this.style.pointerEvents = "none";
    });
} else {
    $("#EditarContrato").prop("disabled", false);
    $("#EditarContrato").removeClass("disabled");
    $("#EditarContrato").each(function () {
    this.style.pointerEvents = "auto";
    });
}
}

// // Traer datos del contrato modal edit
$(document).on("click", "#btn_edit", function () {
    var idContrato = $(this).data("id");
    $("#idContratoEditar").val(idContrato);
    $("#idContrato_Editar").html("ID " + "# " + idContrato + "");
    $.ajax({
    type: "POST",
    dataType: "json",
    url: "contratos_ajax.php?codaccion=mostrarcontrato&id=" + idContrato,
    success: function (data) {
        $("#empleado_edit").val(data[0].empleado);
        $("#tipo_contrato_edit").val(data[0].tipo_contrato);
        $("#tipo_prestacion_edit").val(data[0].tipo_prestacion);
        $("#sueldo_edit").val(data[0].sueldo);
        $("#moneda_edit").val(data[0].moneda);
    },
    });
});

// // Confirmation Editar Contrato
$("#EditarContrato").confirmation({
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
        $("#EditarContrato").addClass("disabled");
        $("#EditarContrato").prop("disabled", true);
        $("#EditarContrato").each(function () {
          this.style.pointerEvents = "none";
        })
        setTimeout(function () {
          $("#contratoForm_edit").submit();
      }, 1500);
    },
  });

//   // Traer datos del Contrato modal eliminar
$(document).on("click", "#btn_delete", function () {
    var idContrato = $(this).data("id");
    $("#idContratoEliminar").val(idContrato);
    $("#idContrato_Delete").html("ID " + "# " + idContrato + "");
    $.ajax({
    type: "POST",
    dataType: "json",
    url: "contratos_ajax.php?codaccion=mostrarcontrato&id=" + idContrato,
    success: function (data) {
        $("#empleado_delete").val(data[0].empleado);
        $("#tipo_contrato_delete").val(data[0].tipo_contrato);
        $("#tipo_prestacion_delete").val(data[0].tipo_prestacion);
        $("#sueldo_delete").val(data[0].sueldo);
        $("#moneda_delete").val(data[0].moneda);
    },
    });
});

// // Confirmation Eliminar Contrato
$("#EliminarContrato").confirmation({
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
        $("#EliminarContrato").addClass("disabled");
        $("#EliminarContrato").prop("disabled", true);
        $("#EliminarContrato").each(function () {
          this.style.pointerEvents = "none";
        })
        setTimeout(function () {
          $("#contratoForm_delete").submit();
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