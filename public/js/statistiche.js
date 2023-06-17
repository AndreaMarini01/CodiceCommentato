$(function retroPromozioni(){
    $('button').click(function (){
        var buttonId=$(this).attr('id');
        var buttonNumber = buttonId.replace('visualInfoPromozione','');
        mostraRetroPromozione(buttonNumber)
    });
});

$(function avantiPromozioni(){
    $('button').click(function (){
        var buttonId=$(this).attr('id');
        var buttonNumber = buttonId.replace('retro_promozione_button','');
        mostraAvantiPromozione(buttonNumber)
    });
});

$(function retroUtenti(){
    $('button').click(function (){
        var buttonId=$(this).attr('id');
        var buttonNumber = buttonId.replace('visualInfoUtente','');
        mostraRetroUtente (buttonNumber)
    });
});

$(function avantiUtenti(){
    $('button').click(function (){
        var buttonId=$(this).attr('id');
        var buttonNumber = buttonId.replace('retro_utente_button','');
        mostraAvantiUtente(buttonNumber)
    });
});

function mostraRetroPromozione (buttonNumber){
    $("#promozione"+buttonNumber).hide();
    $("#retropromozione"+buttonNumber).show();
}

function mostraAvantiPromozione(buttonNumber){
    $("#promozione"+buttonNumber).show();
    $("#retropromozione"+buttonNumber).hide();
}

function mostraRetroUtente (buttonNumber){
    $("#utente"+buttonNumber).hide();
    $("#retroutente"+buttonNumber).show();
}

function mostraAvantiUtente(buttonNumber){
    $("#utente"+buttonNumber).show();
    $("#retroutente"+buttonNumber).hide();
}
