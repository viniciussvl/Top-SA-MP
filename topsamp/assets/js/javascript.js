/* Script de Voltar ao Topo */
jQuery(function (){
    
    jQuery('body').prepend('<div class="voltar-topo"></div>');
    var scrollButtonEl = jQuery('.voltar-topo');
    scrollButtonEl.hide();
    
    jQuery(window).scroll(function(){
        if(jQuery(window).scrollTop() < 100 ){
            jQuery('.voltar-topo').fadeOut()
        }
        else{
            jQuery('.voltar-topo').fadeIn();
        }
    } );
    
    scrollButtonEl.click(function(){
        jQuery("html, body").animate( {scrollTop: 0}, 400 );
        return false;
    } );
                          
                          
} );

/* Ancora com Efeito de Transição */
var $doc = $('html, body');
$('.scrollSuave').click(function() {
    $doc.animate({
        scrollTop: $( $.attr(this, 'href') ).offset().top
    }, 500);
    return false;
});



/* Validando Campos vazios */
function validar(){
    var login = document.getElementById("login").value;
    var senha = document.getElementById("senha").value;
    if(login == ""){
        alert("Preencha os campos corretamente!");
        form-login.login.focus();
        return true;
    }
}


/* Manipulando Datas e Hora */
