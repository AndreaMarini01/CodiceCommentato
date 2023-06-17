
$(function() {
    function ricercaFiltribyNameAndWords() {
        //Seleziona l'elemento del DOM avente id=ricercaParola
        //e gli assegna un event handler con l'evento 'keyup'
        $('#ricercaParola').on('keyup', function() {
            var $value1 = $('#ricercaAzienda').val();
            var $value2 = $(this).val();
            if ($value1 || $value2) {
                $('#all-data').hide();
                $('#searched-content').show();
            } else {
                $('#all-data').show();
                $('#searched-content').hide();
            }
            //la rotta in corrispondenza della quale si trova l'action da attivare
            //data indica i dati che devono essere inviati all'action
            //success è la callback function che indica consa fare con i dati inviati dal controller,
            //in seguito all'elaborazione
            $.ajax({
                type: 'GET',
                url: './listaPromozioni/filtered',
                data: {'ricercaParola': $value2, 'ricercaAzienda': $value1},
                success: function(data) {
                    console.log(data);
                    //la funzione html inserisce il codice html nell'elemento avente
                    //id=searched-content
                    //data, in questo caso, sono i dati response in JSON come risultato dell'action del controller
                    $('#searched-content').html(data);
                }
            });
        });

        $('#ricercaAzienda').on('keyup', function() {
            var $value1 = $(this).val();
            var $value2 = $('#ricercaParola').val();
            if ($value1 || $value2) {
                $('#all-data').hide();
                $('#searched-content').show();
            } else {
                $('#all-data').show();
                $('#searched-content').hide();
            }
            $.ajax({
                type: 'GET',
                url: './listaPromozioni/filtered',
                data: {'ricercaParola': $value2, 'ricercaAzienda': $value1},
                success: function(data) {
                    console.log(data);
                    $('#searched-content').html(data);
                }
            });
        });
    }

    ricercaFiltribyNameAndWords();
});



$(function aperturaFiltri() {
    $('#filter-button').click(function () {
        $('#filtri').slideToggle();
    })
})

$(function chiusuraFiltri() {
    $('#close-button').click(function () {
        $('#filtri').slideToggle();
    })
})

//Serve per aggiungere le rotte di visualizza e modifica ai bottoni
//delle promozioni ricercate tramite filtri
function redirectToRoute(route) {
    window.location.href = route;
}
