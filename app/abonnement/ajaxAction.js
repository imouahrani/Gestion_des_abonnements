/**
 * Created by Marcellin DBFX on 19/10/2016.
 */
$(document).ready(function(){
    $('#renAb').click(function(){
        var q=$('#formRA').serialize();
        var url='traitement_ra.php';
        $('#formError').show();
        $.post(url, q, function(reponse){
            window.location='../client/enregistrer_Client.php';
        });
    });
});
