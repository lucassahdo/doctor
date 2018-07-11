$(document).ready(function () {
    $('.selectpicker').on('change', function (e) {
        e.preventDefault();
        var option = $(this).find("option:selected");
        if (option.hasAttr('class') && option.attr('class') == 'option-new')
            window.location = option.val();
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
        var form = $('#form_patient');
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
                case 'jobtitle':
                    if (value.length < 2) {
                        swal("Oops...", 'Digite uma profissão válida', "warning");
                        return false;
                    }
                    break;   
                case 'cep':
                    var cep = value.replace(/[^0-9]/g, '');
                    if (cep.length < 8) {
                        swal("Oops...", 'Digite um cep válido', "warning");
                        return false;
                    }
                    break;
                case 'street':
                    if (value.length < 2) {
                        swal("Oops...", 'Digite uma rua válida', "warning");
                        return false;
                    }
                    break;
                case 'number':
                    if (value.length <= 0) {
                        swal("Oops...", 'Por favor, preencha o campo "número"', "warning");
                        return false;
                    }
                    break;
                case 'district':
                    if (value.length < 2) {
                        swal("Oops...", 'Digite um bairro válido', "warning");
                        return false;
                    }
                    break;
                case 'state':
                    if (value.length < 2) {
                        swal("Oops...", 'Digite um estado válido', "warning");
                        return false;
                    }
                    break;
                case 'city':
                    if (value.length < 2) {
                        swal("Oops...", 'Digite uma rua válida', "warning");
                        return false;
                    }
                    break;
                case 'cellphone':
                    var cep = value.replace(/[^0-9]/g, '');
                    if (cep.length < 11) {
                        swal("Oops...", 'Digite um celular válido', "warning");
                        return false;
                    }
                    break;
                case 'phone':
                    var cep = value.replace(/[^0-9]/g, '');
                    if (cep.length < 10) {
                        swal("Oops...", 'Digite um telefone válido', "warning");
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

        return true;
    });

    $('#input_cep').on('paste keyup', function (e) {
        var cep = $(this).val().replace(/[^0-9]/g, '');
        console.log('change');
        if (cep.length == 8) {
            var url = 'https://viacep.com.br/ws/' + cep + '/json';
            $('#loading').fadeIn();
            $.ajax({
                type: "get",
                url: url,
                dataType: 'json',
                success: function (data) {
                    rua = (typeof data['logradouro'] != 'undefined') ? data['logradouro'] : '';
                    bairro = (typeof data['bairro'] != 'undefined') ? data['bairro'] : '';
                    cidade = (typeof data['localidade'] != 'undefined') ? data['localidade'] : '';
                    estado = (typeof data['uf'] != 'undefined') ? data['uf'] : '';

                    document.getElementById("input_rua").value = rua;
                    document.getElementById("input_bairro").value = bairro;
                    document.getElementById("input_cidade").value = cidade;
                    document.getElementById("input_estado").value = estado;
                },
                error: function (jqXHR, text, error) {
                    console.log('[' + error + ']: ' + 'Entre em contato com o suporte');
                }
            }).done(function (data) {
                $('#loading').fadeOut();
            });
        }
    });

    setFormValidation('#form_patient');
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