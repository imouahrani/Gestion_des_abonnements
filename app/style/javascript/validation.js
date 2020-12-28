$(document).ready(function(){
  displayData();
//Ajax saving client
 $('#saveClient').click(function(){
  //$('#dataDisplay').html("<img src='load.gif' width='100'/>");
  var q=$('#formClient').serialize();
  var url='../../control/traitement/index.php?ttt=eC';
  $("#formError").show();
  $.post(url, q, function(response){

    $("#formError").html(response);

    //displayData();
  });
  $('#formClient')[0].reset();
  $("#formError").delay(5000).fadeOut(300);
});

});
function displayData(){
  //AjaxDisplay
  $.post('display.php',function(r){
    $('#dataDisplay').html(r);
  });
}