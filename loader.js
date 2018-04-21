$(document).ajaxStart(function(){
  $("#loader").removeClass('hide');
}).ajaxStop(function(){
    $("#loader").addClass('hide');
});

$(window).on('load', function () {
  $("#loader").removeClass('hide');
  setTimeout(function(){
    $("#loader").addClass('hide');
},500);
});
