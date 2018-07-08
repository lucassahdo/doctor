$(document).ready(function () {
    $('.selectpicker').change(function () {
        var selected = $(this).find("option:selected").val();
        $('.card.pessoa .group').hide();
        $('#' + selected).show();
    });

    $('.btn#add-contact').on('click', function (e) {
        e.preventDefault();
        $(this).hide();
        $('.card.contact .group').hide();
        $('.card.contact .card-header').show();
        $('.card.contact input').removeAttr('disabled');
        $('.card.contact .group#group_contacts').show();
    });

    $('.btn#delete-contact').on('click', function (e) {
        e.preventDefault();
        $('.card.contact .group').hide();
        $('.card.contact .card-header').hide();
        $('.card.contact input').attr('disabled', '');
        $('.btn#add-contact').show();
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
        var data = $('#form_person').serializeArray();
        var selected = $('.selectpicker').find("option:selected").val();
        var params = {};

        if (selected.length <= 0) {
            swal("Atenção!", 'selecione o tipo de pessoa', "warning");
            return false;
        }

        // format result
        for (i in data) {
            var name = data[i]['name'];
            var value = data[i]['value'];

            if (name !== '_token')
                params[name] = value;
        }

        switch (selected) {
            case 'group_pfisica':
                params['type'] = 'natural';
                delete params['cnpj'];
                delete params['razao_social'];
                delete params['nome_fantasia'];
                break;
            case 'group_pjuridica':
                params['type'] = 'legal';
                delete params['cpf'];
                delete params['nome'];
                break;
        }

        for (key in params) {
            var value = params[key];
            switch (key) {
                case 'cpf':
                    var cpf = value.replace(/[^0-9]/g, '');
                    if (cpf.length < 11) {
                        swal("Oops...", 'Digite um cpf válido', "warning");
                        return false;
                    }
                    break;
                case 'nome':
                    if (value.length < 2) {
                        swal("Oops...", 'Digite um nome válido', "warning");
                        return false;
                    }
                    break;
                case 'noma_fantasia':
                    if (value.length < 2) {
                        swal("Oops...", 'Digite um nome fantasia válido', "warning");
                        return false;
                    }
                    break;
                case 'razao_social':
                    if (value.length < 2) {
                        swal("Oops...", 'Digite uma razão social válida', "warning");
                        return false;
                    }
                    break;
                case 'cnpj':
                    var cnpj = value.replace(/[^0-9]/g, '');
                    if (cnpj.length < 14) {
                        swal("Oops...", 'Digite um cnpj válido', "warning");
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
                case 'numero':
                    if (value.length <= 0) {
                        swal("Oops...", 'Por favor, preencha o campo "número"', "warning");
                        return false;
                    }
                    break;
            }
        }

        var url = $('#form_person').attr('action');

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

    setFormValidation('#form_person');
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