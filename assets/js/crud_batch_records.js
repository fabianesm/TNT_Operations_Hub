$(document).ready(function(){
    $("#due_date, #due_date_edit, #delete_due_date").datepicker({
        dateFormat: "mm/dd/yy"
    });
});

// modal add
$("#product_name, #lot_number, #so_number, #due_date, #cases_amount, #folder_made_by, #qa_released_by, #base_complete, #qa_notes").bind(
    "focusout click change",
    function () {
      validaAddBatchRecord();
    }
  );

function validaAddBatchRecord() {
var varerror = 0;
if ($("#product_name").val() == "") {
    $("#product_name").parent().addClass("has-error");
    $("#product_name").addClass("has-error2");
    varerror = 1;
} else {
    $("#product_name").parent().removeClass("has-error");
    $("#product_name").removeClass("has-error2");
}

if ($("#lot_number").val() == "") {
    $("#lot_number").parent().addClass("has-error");
    $("#lot_number").addClass("has-error2");
    varerror = 1;
} else {
    $("#lot_number").parent().removeClass("has-error");
    $("#lot_number").removeClass("has-error2");
}

if ($("#so_number").val() == "") {
    $("#so_number").parent().addClass("has-error");
    $("#so_number").addClass("has-error2");
    varerror = 1;
} else {
    $("#so_number").parent().removeClass("has-error");
    $("#so_number").removeClass("has-error2");
}
if ($("#due_date").val() == "") {
    $("#due_date").parent().addClass("has-error");
    $("#due_date").addClass("has-error2");
    varerror = 1;
} else {
    $("#due_date").parent().removeClass("has-error");
    $("#due_date").removeClass("has-error2");
}
if ($("#cases_amount").val() == "") {
    $("#cases_amount").parent().addClass("has-error");
    $("#cases_amount").addClass("has-error2");
    varerror = 1;
} else {
    $("#cases_amount").parent().removeClass("has-error");
    $("#cases_amount").removeClass("has-error2");
}
if ($("#folder_made_by").val() == "") {
    $("#folder_made_by").parent().addClass("has-error");
    $("#folder_made_by").addClass("has-error2");
    varerror = 1;
} else {
    $("#folder_made_by").parent().removeClass("has-error");
    $("#folder_made_by").removeClass("has-error2");
}
if ($("#qa_released_by").val() == "") {
    $("#qa_released_by").parent().addClass("has-error");
    $("#qa_released_by").addClass("has-error2");
    varerror = 1;
} else {
    $("#qa_released_by").parent().removeClass("has-error");
    $("#qa_released_by").removeClass("has-error2");
}
if ($("#base_complete").val() == "") {
    $("#base_complete").parent().addClass("has-error");
    $("#base_complete").addClass("has-error2");
    varerror = 1;
} else {
    $("#base_complete").parent().removeClass("has-error");
    $("#base_complete").removeClass("has-error2");
}
if ($("#qa_notes").val() == "") {
    $("#qa_notes").parent().addClass("has-error");
    $("#qa_notes").addClass("has-error2");
    varerror = 1;
} else {
    $("#qa_notes").parent().removeClass("has-error");
    $("#qa_notes").removeClass("has-error2");
}

if (varerror == 1) {
    $("#SaveBatch").addClass("disabled");
    $("#SaveBatch").prop("disabled", true);
    $("#SaveBatch").each(function () {
    this.style.pointerEvents = "none";
    });
} else {
    $("#SaveBatch").prop("disabled", false);
    $("#SaveBatch").removeClass("disabled");
    $("#SaveBatch").each(function () {
    this.style.pointerEvents = "auto";
    });
}
}

// validación modal edit
$("#product_name_edit, #lot_number_edit, #so_number_edit, #due_date_edit, #cases_amount_edit, #folder_made_by_edit, #qa_released_by_edit, #base_complete_edit, #qa_notes_edit").bind(
    "focusout click change",
    function () {
      validaEditBatchRecord();
    }
  );

function validaEditBatchRecord() {
var varerror = 0;
if ($("#product_name_edit").val() == "") {
    $("#product_name_edit").parent().addClass("has-error");
    $("#product_name_edit").addClass("has-error2");
    varerror = 1;
} else {
    $("#product_name_edit").parent().removeClass("has-error");
    $("#product_name_edit").removeClass("has-error2");
}

if ($("#lot_number_edit").val() == "") {
    $("#lot_number_edit").parent().addClass("has-error");
    $("#lot_number_edit").addClass("has-error2");
    varerror = 1;
} else {
    $("#lot_number_edit").parent().removeClass("has-error");
    $("#lot_number_edit").removeClass("has-error2");
}

if ($("#so_number_edit").val() == "") {
    $("#so_number_edit").parent().addClass("has-error");
    $("#so_number_edit").addClass("has-error2");
    varerror = 1;
} else {
    $("#so_number_edit").parent().removeClass("has-error");
    $("#so_number_edit").removeClass("has-error2");
}
if ($("#due_date_edit").val() == "") {
    $("#due_date_edit").parent().addClass("has-error");
    $("#due_date_edit").addClass("has-error2");
    varerror = 1;
} else {
    $("#due_date_edit").parent().removeClass("has-error");
    $("#due_date_edit").removeClass("has-error2");
}
if ($("#cases_amount_edit").val() == "") {
    $("#cases_amount_edit").parent().addClass("has-error");
    $("#cases_amount_edit").addClass("has-error2");
    varerror = 1;
} else {
    $("#cases_amount_edit").parent().removeClass("has-error");
    $("#cases_amount_edit").removeClass("has-error2");
}
if ($("#folder_made_by_edit").val() == "") {
    $("#folder_made_by_edit").parent().addClass("has-error");
    $("#folder_made_by_edit").addClass("has-error2");
    varerror = 1;
} else {
    $("#folder_made_by_edit").parent().removeClass("has-error");
    $("#folder_made_by_edit").removeClass("has-error2");
}
if ($("#qa_released_by_edit").val() == "") {
    $("#qa_released_by_edit").parent().addClass("has-error");
    $("#qa_released_by_edit").addClass("has-error2");
    varerror = 1;
} else {
    $("#qa_released_by_edit").parent().removeClass("has-error");
    $("#qa_released_by_edit").removeClass("has-error2");
}
if ($("#base_complete_edit").val() == "") {
    $("#base_complete_edit").parent().addClass("has-error");
    $("#base_complete_edit").addClass("has-error2");
    varerror = 1;
} else {
    $("#base_complete_edit").parent().removeClass("has-error");
    $("#base_complete_edit").removeClass("has-error2");
}
if ($("#qa_notes_edit").val() == "") {
    $("#qa_notes_edit").parent().addClass("has-error");
    $("#qa_notes_edit").addClass("has-error2");
    varerror = 1;
} else {
    $("#qa_notes_edit").parent().removeClass("has-error");
    $("#qa_notes_edit").removeClass("has-error2");
}


if (varerror == 1) {
    $("#UpdateBatch").addClass("disabled");
    $("#UpdateBatch").prop("disabled", true);
    $("#UpdateBatch").each(function () {
    this.style.pointerEvents = "none";
    });
} else {
    $("#UpdateBatch").prop("disabled", false);
    $("#UpdateBatch").removeClass("disabled");
    $("#UpdateBatch").each(function () {
    this.style.pointerEvents = "auto";
    });
}
}

// Traer datos del modal edit
$(document).on("click", "#btn_edit", function () {
    var idBatch = $(this).data("id");
    $("#idBatchEdit").val(idBatch);
    $("#idBatch_Editar").html("ID # " + idBatch);

    $.ajax({
        type: "POST",
        dataType: "json",
        url: "batch_records_ajax.php?codaccion=mostrarBatch&id=" + idBatch,
        success: function (data) {
            $("#product_name_edit").val(data.product_name);
            $("#lot_number_edit").val(data.lot_number);
            $("#so_number_edit").val(data.so_number);

            // Convertir la fecha al formato MM/DD/YYYY
            if (data.due_date) {
                let dateParts = data.due_date.split("-");
                let formattedDate = dateParts[1] + "/" + dateParts[2] + "/" + dateParts[0];
                $("#due_date_edit").val(formattedDate);
            } else {
                $("#due_date_edit").val("");
            }

            $("#cases_amount_edit").val(data.amount_of_cases);
            $("#folder_made_by_edit").val(data.folder_created_by);
            $("#qa_released_by_edit").val(data.qa_released_by);
            $("#base_complete_edit").val(data.base_complete);
            $("#qa_notes_edit").val(data.qa_notes);
        }
    });
});


// // Confirmation Editar 
$("#UpdateBatch").confirmation({
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
        $("#UpdateBatch").addClass("disabled");
        $("#UpdateBatch").prop("disabled", true);
        $("#UpdateBatch").each(function () {
          this.style.pointerEvents = "none";
        })
        setTimeout(function () {
          $("#BatchRecordForm_edit").submit();
      }, 1500);
    },
  });

// Traer datos del modal delete
$(document).on("click", "#btn_delete", function () {
    var idBatch = $(this).data("id");
    $("#idBatchDelete").val(idBatch);
    $("#idBatch_Delete").html("ID # " + idBatch);

    $.ajax({
        type: "POST",
        dataType: "json",
        url: "batch_records_ajax.php?codaccion=mostrarBatch&id=" + idBatch,
        success: function (data) {
            $("#delete_product_name").val(data.product_name);
            $("#delete_lot_number").val(data.lot_number);
            $("#delete_so_number").val(data.so_number);

            // Convertir la fecha al formato MM/DD/YYYY
            if (data.due_date) {
                let dateParts = data.due_date.split("-");
                let formattedDate = dateParts[1] + "/" + dateParts[2] + "/" + dateParts[0];
                $("#delete_due_date").val(formattedDate);
            } else {
                $("#delete_due_date").val("");
            }

            $("#delete_cases_amount").val(data.amount_of_cases);
            $("#delete_folder_made_by").val(data.folder_created_by);
            $("#delete_qa_released_by").val(data.qa_released_by);
            $("#delete_base_complete").val(data.base_complete);
            $("#delete_qa_notes").val(data.qa_notes);
        }
    });
});

// // Confirmation Eliminar Batch
$("#ConfirmDeleteBatch").confirmation({
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
        $("#ConfirmDeleteBatch").addClass("disabled");
        $("#ConfirmDeleteBatch").prop("disabled", true);
        $("#ConfirmDeleteBatch").each(function () {
          this.style.pointerEvents = "none";
        })
        setTimeout(function () {
          $("#BatchRecordForm_delete").submit();
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