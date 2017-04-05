$(document).ready(function () {
    verificaSeVotou(ip, dataAtual);

    /* $('.btn-vote').click(function () {
        slug = $(this).val();
        votar(slug);
        $('.btn-vote').attr('disabled', true);
    }); */
}); 

function verificaSeVotou(ip, data) {
    $.ajax({
        url: path + 'verificaSeVotou',
        type: 'post',
        data: {ip: ip, data: data},
        dataType: 'html',
        beforeSend: function () {
        },
        success: function (retorno) {
            if (retorno === '0') {
                $('.btn-vote').attr('disabled', true);
            }
        },
        error: function (erro, er) {
            // Se houver um erro durante o processamento, exibe a mensagem na div correspondente                       
            alert('deu erro');
        }
    });
}

function votar(slug) {
    $.ajax({
        url: path + 'votar',
        type: 'post',
        data: {slug: slug},
        dataType: 'html',
        beforeSend: function () {
            $('.carregando').css('display', 'block');
        },
        success: function (retorno) {
            $('.carregando').css('display', 'none');
            // Atribui o retorno HTML para a div correspondente                       
//            console.log(retorno);
            $('span#' + slug).html(retorno);
        },
        error: function (erro, er) {
            // Se houver um erro durante o processamento, exibe a mensagem na div correspondente                       
            alert('deu erro');
        }
    });
}


/* Ativando tooltips */
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$('#example').tooltip(options)

/* Script de Voltar ao Topo */
jQuery(function () {

    jQuery('body').prepend('<div class="voltar-topo"></div>');
    var scrollButtonEl = jQuery('.voltar-topo');
    scrollButtonEl.hide();
    jQuery(window).scroll(function () {
        if (jQuery(window).scrollTop() < 100) {
            jQuery('.voltar-topo').fadeOut()
        } else {
            jQuery('.voltar-topo').fadeIn();
        }
    });
    scrollButtonEl.click(function () {
        jQuery("html, body").animate({scrollTop: 0}, 400);
        return false;
    });
});

