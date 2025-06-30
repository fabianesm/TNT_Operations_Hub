// modal add
$("#addpermiso, #EquipmentType, #supervisor_form, #empleado, #status").bind(
    "focusout click change",
    function () {
      validaAddPermiso();
    }
  );

function validaAddPermiso() {
var varerror = 0;
if ($("#EquipmentType").val() == "") {
    $("#EquipmentType").parent().addClass("has-error");
    $("#EquipmentType").addClass("has-error2");
    varerror = 1;
} else {
    $("#EquipmentType").parent().removeClass("has-error");
    $("#EquipmentType").removeClass("has-error2");
}

if ($("#supervisor_form").val() == "") {
    $("#supervisor_form").parent().addClass("has-error");
    $("#supervisor_form").addClass("has-error2");
    varerror = 1;
} else {
    $("#supervisor_form").parent().removeClass("has-error");
    $("#supervisor_form").removeClass("has-error2");
}

if ($("#empleado").val() == "") {
    $("#empleado").parent().addClass("has-error");
    $("#empleado").addClass("has-error2");
    varerror = 1;
} else {
    $("#empleado").parent().removeClass("has-error");
    $("#empleado").removeClass("has-error2");
}
if ($("#status").val() == "") {
    $("#status").parent().addClass("has-error");
    $("#status").addClass("has-error2");
    varerror = 1;
} else {
    $("#status").parent().removeClass("has-error");
    $("#status").removeClass("has-error2");
}

if (varerror == 1) {
    $("#SaveEquipment").addClass("disabled");
    $("#SaveEquipment").prop("disabled", true);
    $("#SaveEquipment").each(function () {
    this.style.pointerEvents = "none";
    });
} else {
    $("#SaveEquipment").prop("disabled", false);
    $("#SaveEquipment").removeClass("disabled");
    $("#SaveEquipment").each(function () {
    this.style.pointerEvents = "auto";
    });
}
}

// validación modal edit
$("#btn_edit, #EquipmentType_edit, #supervisor_edit, #empleado_edit, #status_edit").bind(
    "focusout click change",
    function () {
      validaEditPermiso();
    }
  );

function validaEditPermiso() {
var varerror = 0;
if ($("#EquipmentType_edit").val() == "") {
    $("#EquipmentType_edit").parent().addClass("has-error");
    $("#EquipmentType_edit").addClass("has-error2");
    varerror = 1;
} else {
    $("#EquipmentType_edit").parent().removeClass("has-error");
    $("#EquipmentType_edit").removeClass("has-error2");
}

if ($("#supervisor_edit").val() == "") {
    $("#supervisor_edit").parent().addClass("has-error");
    $("#supervisor_edit").addClass("has-error2");
    varerror = 1;
} else {
    $("#supervisor_edit").parent().removeClass("has-error");
    $("#supervisor_edit").removeClass("has-error2");
}

if ($("#empleado_edit").val() == "") {
    $("#empleado_edit").parent().addClass("has-error");
    $("#empleado_edit").addClass("has-error2");
    varerror = 1;
} else {
    $("#empleado_edit").parent().removeClass("has-error");
    $("#empleado_edit").removeClass("has-error2");
}
if ($("#status_edit").val() == "") {
    $("#status_edit").parent().addClass("has-error");
    $("#status_edit").addClass("has-error2");
    varerror = 1;
} else {
    $("#status_edit").parent().removeClass("has-error");
    $("#status_edit").removeClass("has-error2");
}


if (varerror == 1) {
    $("#EditarEquipment").addClass("disabled");
    $("#EditarEquipment").prop("disabled", true);
    $("#EditarEquipment").each(function () {
    this.style.pointerEvents = "none";
    });
} else {
    $("#EditarEquipment").prop("disabled", false);
    $("#EditarEquipment").removeClass("disabled");
    $("#EditarEquipment").each(function () {
    this.style.pointerEvents = "auto";
    });
}
}

// // Traer datos del permiso modal edit
$(document).on("click", "#btn_edit", function () {
    var idPermiso = $(this).data("id");
    $("#idEquipmentEditar").val(idPermiso);
    $("#idEquipment_Editar").html("ID " + "# " + idPermiso + "");
    $.ajax({
    type: "POST",
    dataType: "json",
    url: "equipment_control_ajax.php?codaccion=mostrarpermisos&id=" + idPermiso,
    success: function (data) {
        $("#EquipmentType_edit").val(data[0].motivo);
        $("#supervisor_edit").val(data[0].jefatura);
        $("#empleado_edit").val(data[0].empleado);
        $("#status_edit").val(data[0].dias);
        $("#descripcion_edit").val(data[0].descripcion);
    },
    });
});

// // Confirmation Editar permiso
$("#EditarEquipment").confirmation({
    placement: "top",
    title: "Are you sure you want to save the information?",
    btnOkClass: "btn btn-sm btn-success",
    btnOkLabel: "Update",
    btnOkIcon: "glyphicon glyphicon-ok",
    btnCancelClass: "btn btn-sm btn-default",
    btnCancelLabel: "Cancel",
    btnCancelIcon: "glyphicon glyphicon-remove",
    onConfirm: function () {
      MensajeModal(
        "<i class='fa fa-spinner fa-spin' style='font-size:25px;'></i>Please wait, we are uploading the information.",
        "Green"
        );
        $("#EditarEquipment").addClass("disabled");
        $("#EditarEquipment").prop("disabled", true);
        $("#EditarEquipment").each(function () {
          this.style.pointerEvents = "none";
        })
        setTimeout(function () {
          $("#EquipmentForm_edit").submit();
      }, 1500);
    },
  });

//   // Traer datos del permiso modal eliminar
$(document).on("click", "#btn_delete", function () {
    var idPermiso = $(this).data("id");
    $("#idEquipmentEliminar").val(idPermiso);
    $("#idEquipment_Delete").html("ID " + "# " + idPermiso + "");
    $.ajax({
    type: "POST",
    dataType: "json",
    url: "equipment_control_ajax.php?codaccion=mostrarpermisos&id=" + idPermiso,
    success: function (data) {
        $("#EquipmentType_delete").val(data[0].motivo);
        $("#supervisor_delete").val(data[0].jefatura);
        $("#empleado_delete").val(data[0].empleado);
        $("#status_delete").val(data[0].dias);
        $("#descripcion_delete").val(data[0].descripcion);
    },
    });
});

// // Confirmation Eliminar Contrato
$("#EliminarEquipment").confirmation({
    placement: "top",
    title: "Are you sure you want to delete the information?",
    btnOkClass: "btn btn-sm btn-danger",
    btnOkLabel: "Delete",
    btnOkIcon: "glyphicon glyphicon-ok",
    btnCancelClass: "btn btn-sm btn-default",
    btnCancelLabel: "Cancel",
    btnCancelIcon: "glyphicon glyphicon-remove",
    onConfirm: function () {
      MensajeModal(
        "<i class='fa fa-spinner fa-spin' style='font-size:25px;'></i>Please wait, we are deleting the information.",
        "Green"
        );
        $("#EliminarEquipment").addClass("disabled");
        $("#EliminarEquipment").prop("disabled", true);
        $("#EliminarEquipment").each(function () {
          this.style.pointerEvents = "none";
        })
        setTimeout(function () {
          $("#EquipmentForm_delete").submit();
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