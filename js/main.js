/*
jQuery(function($){

$(document).ready(function() {
    $("body").addClass("bloqueado");
    $(".loading").addClass("entra");
});
}

*/
// $("body").addClass("loaded");


jQuery(function($){

/* CHAMA LOADING */
$(document).ready(function() {
    $("body").addClass("bloqueado");
    $(".loading").addClass("entra");
});



function abreMenu(){
   $("body").addClass("menuAberto");
   $(".desloca").addClass("menuAberto");
   $(".menu").addClass("aberto");
   $("body").removeClass("scrolling").addClass("bloqueado");
}

function fechaMenu(){
  $("body").removeClass("menuAberto");
   $(".desloca").removeClass("menuAberto");
   $(".menu").removeClass("aberto");
     if($("body").hasClass("bloqueado")){ $("body").removeClass("bloqueado").addClass("scrolling");  }
}


// Clicar em links animato
$('.abreMenu').click(function(e){

if(!$(".menu").hasClass("aberto")){
  abreMenu();
}else{
  fechaMenu();
}
    return false;
});


$('.barra .fechar').click(function(e){
  fechaMenu();
    return false;
});


/*
LOADING
*/

function Loading(){
var width = 100, // width of a progress bar in percentage
    perfData = window.performance.timing, // The PerformanceTiming interface
    EstimatedTime = -(perfData.loadEventEnd - perfData.navigationStart), // Calculated Estimated Time of Page Load which returns negative value.
    time = parseInt((EstimatedTime/1000)%60)*100; //Converting EstimatedTime from miliseconds to seconds.

// Percentage Increment Animation
        var start = 0,
        end = 100,
        durataion = time;
        animateValue(start, end, durataion);

function animateValue(start, end, duration) {

    var range = end - start,
      current = start,
      increment = end > start? 1 : -1,
      stepTime = Math.abs(Math.floor(duration / range));

/*
if(stepTime < 15){ stepTime = 15; }
*/

    var timer = setInterval(function() {
        current += increment;
       $(".loading .loader").stop().animate({height: ""+ current +"%"});
       /* $(".loading .porcentagem span.num").html(current); */

      //obj.innerHTML = current;
        if (current == end) {
            clearInterval(timer);
     $("body").addClass("loaded"); 
     $("body").removeClass("bloqueado").addClass("scrolling");
    
        }
    }, stepTime);
}
}

 Loading(); 
/*
 Loading(); 


  $("body").addClass("loaded"); 
  $("body").removeClass("bloqueado").addClass("scrolling");
*/


$("#submit").click(function(e){

    var form = $(".contato .form");
    var nomeCampo = form.find("#nome");
    var emailCampo = form.find("#email");
    var assuntoCampo = form.find("#assunto");
    var comentariosCampo = form.find("#msg");
    var submit = form.find("#submit");

    /* Conta */
var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
var errors = "0";
if(nomeCampo.attr("value")){ nomeCampo.removeClass("erro"); }else{ errors++; nomeCampo.addClass("erro"); }
if(emailCampo.attr("value") && regex.test(emailCampo.attr("value"))){ emailCampo.removeClass("erro"); }else{ errors++; emailCampo.addClass("erro"); }
if(assuntoCampo.attr("value")){ assuntoCampo.removeClass("erro"); }else{ errors++; assuntoCampo.addClass("erro"); }
if(comentariosCampo.attr("value")){ comentariosCampo.removeClass("erro");  comentariosCampo.parent().removeClass("erro"); }else{ errors++; comentariosCampo.parent().addClass("erro"); comentariosCampo.addClass("erro"); }

if(errors > 0){ submit.addClass("erro"); }
/* Se não tiver erros */
if(errors < 1){
   e.preventDefault(); // Bloqueia de clicar novamente

   $(".contato .form").addClass("carregando");

    /* Bloqueia os campos */
    nomeCampo.addClass("bloqueado");
    emailCampo.addClass("bloqueado");
    assuntoCampo.addClass("bloqueado");
    comentariosCampo.parent().addClass("bloqueado");
    submit.removeClass("erro").addClass("bloqueia");

    /* Passa os valores */
    var nomeValor = nomeCampo.attr("value");
    var emailValor = emailCampo.attr("value");
   var assuntoValor = assuntoCampo.attr("value");
    var comentariosValor = comentariosCampo.attr("value");

 $.ajax({
           url: mainjs_params.ajaxurl,
           dataType: 'json',
           type: 'post',
           data: {'action':'siteWideMessage', 'nome': nomeValor, 'assunto': assuntoValor, 'email': emailValor, 'msg': comentariosValor}, // serializes the form's elements.
           success: function (data) {
            if(data == true){
          $(".contato .form").addClass("enviado");
        }else{
          $(".contato .form").addClass("falha");
        }
},
            error: function (data) {
              $(".contato .form").addClass("falha");
            },
         });
}
return false;

});



/// fn
});