/*
* My functions for admin panel
*/
$(function () {
    
    $("#dataTable").DataTable({
        
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
        "bJQueryUI": true,
        "oLanguage": {
            "sProcessing":   "Processando...",
            "sLengthMenu":   "Mostrar _MENU_ registros",
            "sZeroRecords":  "Não foram encontrados resultados",
            "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
            "sInfoFiltered": "",
            "sInfoPostFix":  "",
            "sSearch":       "Buscar:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Primeiro",
                "sPrevious": "Anterior",
                "sNext":     "Seguinte",
                "sLast":     "Último"
            }
        }
      }).buttons().container().appendTo('#dataTable_wrapper .col-md-6:eq(0)');
});

function preloader() {
    $(".loader-in").fadeOut();
    $(".loader").delay(150).fadeOut("fast");
    $(".wrapper").fadeIn("fast");
    $("#app").fadeIn("fast");
}

$(".cnpj").mask("00.000.000/0000-00");
$(".telefone").mask("(00) 00000-0000");
$(".cpf").mask("000.000.000-00");
$(".fab").mask("00/00");
$(".validade").mask("00/00"); 
$(".cartao").mask("0000-0000-0000-0000");
$(".cep").mask("00000-000");
$(".valor").mask('##0.00', {reverse: true});

//Initialize Select2 Elements
$('.select2').select2({
    theme: 'bootstrap4'
});

//Initialize Select2 Elements
$('.select2bs4').select2({
    theme: 'bootstrap4'
});

//select all
$("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);

});

$('.duallistbox').bootstrapDualListbox({
    nonSelectedListLabel: 'Não é permitido',
    selectedListLabel: 'Permitido',
});

$(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});

function alertMessage(message = '',type = 'default') {

    let messageDiv =
        '<div class="alert alert-default-'+type+' alert-dismissible fade show" role="alert">\n' +
        message+'\n' +
        '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
        '    <span aria-hidden="true">&times;</span>\n' +
        '  </button>\n' +
        '</div>';

    return messageDiv;
}

$('form').submit(function() {
    let button = $(this).find("button[type=submit]:focus");
    button.prop('disabled',true);
    button.html('<i class="spinner-border spinner-border-sm text-light"></i> '+$(button).text() + '...');
});

$('.submitButton').click(function () {

    if(confirm('Confirm action'))
    {
        $(this).prop('disabled',true);
        $(this).html('<i class="spinner-border spinner-border-sm text-light"></i> '+$($(this)).text() + '...');
        $(this).parents('form:first').submit();
    }

});

function SpinnerGo(obj) {
    $(obj).prop('disabled',true);
    $(obj).html('<i class="spinner-border spinner-border-sm text-light"></i> '+$($(obj)).text());
}

function SpinnerStop(obj) {
    $(obj).prop('disabled',false);
    $(obj).html($($(obj)).text());
}

function afterSubmit(obj){
    $(obj).prop('disabled',true);
    $(obj).html('<i class="spinner-border spinner-border-sm text-light"></i> '+$($(obj)).text());
    obj.form.submit();
}
function toggle_avtospisaniya(client_id,token,obj) {

    $.ajax({
        url: '/clients/auto-toggle',
        type: "post", //send it through post method
        data: {
            _token: token,
            client_id:client_id
        },
        beforeSend:function () {
            // $(obj).removeAttr('class');
            $(obj).attr('class','spinner-border spinner-border-sm text-secondary');
        },
        success:function (result) {

            if (result.auto === true)
            {
                $(obj).attr('class','fas fa-check-circle text-success');
            }else if (result.auto === false)
            {
                $(obj).attr('class','fas fa-times-circle text-danger');
            } else
            {
                $(obj).attr('class','fas fa-question-circle text-warning');
            }
        },
        error:function (err) {
            $(obj).attr('class','fas fa-question-circle text-warning');
        }
    })
}




