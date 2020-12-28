$(document).ready(function(){

  displayData();
  //$('#pageNumDisplay').delay(100).hide(1);
//Ajax saving client
 $('#saveClient').click(function(){
  $('#dataDisplay').html("<img src='load.gif' width='100'/>");
  var q=$('#formClient').serialize();
  var url='traitement_eC.php';
  $("#formError").show();
  $.post(url, q, function(response){
  if(response=="<p class='alert labelInfo-danger col-lg-offset-3'>Completer les champs vides!</p>"){
	$("#formError").hide();
  $("#formError").html(response);
	$("#formError").show();
	$("#formError").delay(5000).fadeOut(300);
	}else if (response=="<p class='alert labelInfo-success col-lg-offset-3'>Client enregistré</p>"){
	$("#formError").hide();
	$("#formError").html(response);
	$("#formError").show();
	$('#formClient')[0].reset();
	$("#formError").delay(5000).fadeOut(300);
	}
    displayData();
  });
});



});
function displayData(){
  //AjaxDisplay
  $.post('../facturation/afficher_facturations.php',function(r){
    $('#dataDisplay').html(r);
  });
}
//Ajax search
function showHint(str) {
    if (str.length == 0) {
        document.getElementById("s_Field").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if ((xmlhttp.readyState == 4 || xmlHttp.readyState == 0) && xmlhttp.status == 200) {
                document.getElementById("s_Field").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "traitement_rC.php?q=" + str, true);
        xmlhttp.send();
    }
}
