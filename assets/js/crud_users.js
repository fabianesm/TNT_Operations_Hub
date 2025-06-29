// modal add
$("#adduser, #nombre_completo, #correo, #usuario, #rol_user, #contrasena").bind(
    "focusout click change",
    function () {
      validaAddUser();
    }
  );

function validaAddUser() {
var varerror = 0;
if ($("#nombre_completo").val() == "") {
    $("#nombre_completo").parent().addClass("has-error");
    $("#nombre_completo").addClass("has-error");
    varerror = 1;
} else {
    $("#nombre_completo").parent().removeClass("has-error");
    $("#nombre_completo").removeClass("has-error");
}

if ($("#correo").val() == "") {
    $("#correo").parent().addClass("has-error");
    $("#correo").addClass("has-error");
    varerror = 1;
} else {
    $("#correo").parent().removeClass("has-error");
    $("#correo").removeClass("has-error");
}

if ($("#usuario").val() == "") {
    $("#usuario").parent().addClass("has-error");
    $("#usuario").addClass("has-error");
    varerror = 1;
} else {
    $("#usuario").parent().removeClass("has-error");
    $("#usuario").removeClass("has-error");
}
if ($("#rol_user").val() == "") {
    $("#rol_user").parent().addClass("has-error");
    $("#rol_user").addClass("has-error2");
    varerror = 1;
} else {
    $("#rol_user").parent().removeClass("has-error");
    $("#rol_user").removeClass("has-error2");
}
if ($("#contrasena").val() == "") {
    $("#contrasena").parent().addClass("has-error");
    $("#contrasena").addClass("has-error");
    varerror = 1;
} else {
    $("#contrasena").parent().removeClass("has-error");
    $("#contrasena").removeClass("has-error");
}

if (varerror == 1) {
    $("#GuardarUsuario").addClass("disabled");
    $("#GuardarUsuario").prop("disabled", true);
    $("#GuardarUsuario").each(function () {
    this.style.pointerEvents = "none";
    });
} else {
    $("#GuardarUsuario").prop("disabled", false);
    $("#GuardarUsuario").removeClass("disabled");
    $("#GuardarUsuario").each(function () {
    this.style.pointerEvents = "auto";
    });
}
}

// validación modal edit
$("#btn_edit, #nombre_completo_edit, #correo_edit, #usuario_edit, #rol_user_edit, #contrasena_edit").bind(
    "focusout click change",
    function () {
      validaEditUser();
    }
  );

function validaEditUser() {
var varerror = 0;
if ($("#nombre_completo_edit").val() == "") {
    $("#nombre_completo_edit").parent().addClass("has-error");
    $("#nombre_completo_edit").addClass("has-error");
    varerror = 1;
} else {
    $("#nombre_completo_edit").parent().removeClass("has-error");
    $("#nombre_completo_edit").removeClass("has-error");
}

if ($("#correo_edit").val() == "") {
    $("#correo_edit").parent().addClass("has-error");
    $("#correo_edit").addClass("has-error");
    varerror = 1;
} else {
    $("#correo_edit").parent().removeClass("has-error");
    $("#correo_edit").removeClass("has-error");
}

if ($("#usuario_edit").val() == "") {
    $("#usuario_edit").parent().addClass("has-error");
    $("#usuario_edit").addClass("has-error");
    varerror = 1;
} else {
    $("#usuario_edit").parent().removeClass("has-error");
    $("#usuario_edit").removeClass("has-error");
}
if ($("#rol_user_edit").val() == "") {
    $("#rol_user_edit").parent().addClass("has-error");
    $("#rol_user_edit").addClass("has-error2");
    varerror = 1;
} else {
    $("#rol_user_edit").parent().removeClass("has-error");
    $("#rol_user_edit").removeClass("has-error2");
}
if ($("#contrasena_edit").val() == "") {
    $("#contrasena_edit").parent().addClass("has-error");
    $("#contrasena_edit").addClass("has-error");
    varerror = 1;
} else {
    $("#contrasena_edit").parent().removeClass("has-error");
    $("#contrasena_edit").removeClass("has-error");
}

if (varerror == 1) {
    $("#EditarUsuario").addClass("disabled");
    $("#EditarUsuario").prop("disabled", true);
    $("#EditarUsuario").each(function () {
    this.style.pointerEvents = "none";
    });
} else {
    $("#EditarUsuario").prop("disabled", false);
    $("#EditarUsuario").removeClass("disabled");
    $("#EditarUsuario").each(function () {
    this.style.pointerEvents = "auto";
    });
}
}

// Traer datos del usuario modal edit
$(document).on("click", "#btn_edit", function () {
    var idUser = $(this).data("id");
    $("#idUserEditar").val(idUser);
    $("#idUsuario_Editar").html("ID " + "# " + idUser + "");
    $.ajax({
    type: "POST",
    dataType: "json",
    url: "users_ajax.php?codaccion=mostrarusuario&id=" + idUser,
    success: function (data) {
        $("#nombre_completo_edit").val(data[0].nombre);
        $("#correo_edit").val(data[0].correo);
        $("#usuario_edit").val(data[0].usuario);
        $("#rol_user_edit").val(data[0].rol);
        $("#contrasena_edit").val(data[0].contrasena);
    },
    });
});

// Confirmation Editar Usuario
$("#EditarUsuario").confirmation({
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
        $("#EditarUsuario").addClass("disabled");
        $("#EditarUsuario").prop("disabled", true);
        $("#EditarUsuario").each(function () {
          this.style.pointerEvents = "none";
        })
        setTimeout(function () {
          $("#usuarioForm_edit").submit();
      }, 1500);
    },
  });

  // Traer datos del usuario modal eliminar
$(document).on("click", "#btn_delete", function () {
    var idUser = $(this).data("id");
    $("#idUserEliminar").val(idUser);
    $("#idUsuario_Delete").html("ID " + "# " + idUser + "");
    $.ajax({
    type: "POST",
    dataType: "json",
    url: "users_ajax.php?codaccion=mostrarusuario&id=" + idUser,
    success: function (data) {
        $("#nombre_completo_delete").val(data[0].nombre);
        $("#correo_delete").val(data[0].correo);
        $("#usuario_delete").val(data[0].usuario);
        $("#rol_user_delete").val(data[0].rol);
        $("#contrasena_delete").val(data[0].contrasena);
    },
    });
});

// Confirmation Eliminar Usuario
$("#EliminarUsuario").confirmation({
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
        $("#EliminarUsuario").addClass("disabled");
        $("#EliminarUsuario").prop("disabled", true);
        $("#EliminarUsuario").each(function () {
          this.style.pointerEvents = "none";
        })
        setTimeout(function () {
          $("#usuarioForm_delete").submit();
      }, 1500);
    },
  });

  // GENERIC CRUD
function MensajeModal(mensagem, coloralert) {
    $(".MensajeModal")
      .fadeIn(1000)
      .css({
        color: coloralert,
        visibility: "visible",
      })
      .html(mensagem);
  }