$(document).ready(function () {
    $('#enable_password').on('switchChange.bootstrapSwitch', function () {
        if ($(this).is(':checked')) {
            $('.password-area input').removeAttr('disabled');
        } 
        else {
            $('.password-area input').attr('disabled','');
        }
    });

    $('.btn#btn-cancel').on('click', function (e) {
        e.preventDefault();
        swal({
            title: 'Tem certeza?',
            text: "Suas modificações não serão salvas",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Sim, continuar',
            buttonsStyling: false
        }).then(function () {
            setTimeout(() => {
                window.location = '/';
            }, 300);
        });
    });

    $('.btn#btn-save').on('click', function (e) {
        e.preventDefault();
        var form = $('#form_profile');
        var data = form.serializeArray();     
        var params = {};       

        // format result
        for (i in data) {
            var name = data[i]['name'];
            var value = data[i]['value'];
            if (name !== '_token')
                params[name] = value;
        }

        // check fields
        for (key in params) {
            var value = params[key];
            switch (key) {
                case 'name':
                    if (value.length < 2) {
                        swal("Oops...", 'Digite um título válido', "warning");
                        return false;
                    }
                    break;
                case 'lastname':
                    if (value.length < 2) {
                        swal("Oops...", 'Digite um sobrenome válido', "warning");
                        return false;
                    }
                    break;  
                case 'email':                    
                    if (value.length < 2) {
                        swal("Oops...", 'Digite um email válido', "warning");
                        return false;
                    }
                    break;
            }
        }

        // ajax
        var url = form.attr('action');
        $.ajax({
            type: "post",
            url: url,
            data: params,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                status = (typeof data['status'] !== 'undefined') ? data['status'] : {
                    status: 'error'
                };
                message = (typeof data['message'] !== 'undefined') ? data['message'] : {
                    message: 'Erro ao executar ação. Contactar suporte'
                };
                switch (status) {
                    case 'ok':
                        swal({
                            title: "Feito!",
                            text: "Ação executada com sucesso",
                            buttonsStyling: false,
                            confirmButtonClass: "btn btn-success",
                            type: "success"
                        }).then(function (isConfirm) {
                            if (isConfirm) {
                                setTimeout(() => {
                                    window.location = data['redirect'];
                                }, 300);
                            }
                        });
                        break;
                    case 'warning':
                        swal("Oops...", message, "warning");
                        break;
                    case 'error':
                        swal("Oops...", message, "error");
                        break;
                    default:
                        swal("Oops...", 'Sem resposta do servidor. Entre em contato com o suporte', "warning");
                        break;
                }
            },
            error: function (jqXHR, text, error) {
                swal("Oops...", '[' + error + ']: ' + 'Entre em contato com o suporte', "error");
            }
        });
    });

    setFormValidation('#form_profile');
});

function setFormValidation(id) {
    $(id).validate({
        highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
            $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
        },
        success: function (element) {
            $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
            $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
        },
        errorPlacement: function (error, element) {
            $(element).append(error);
        },
    });
}