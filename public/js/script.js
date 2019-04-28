$(document).ready(function () {

    // Suppression de post
    $('.deletePostBtn').click(function(e) {
        e.preventDefault();

        // this vaut .deletePostBtn 'cliqué'
        // .parent().parent() permet de remonter à partir du bouton
        var postTitle = $(this).parent().parent().find('span[id^=postTitle]').html();
        var postDeleteUrl = $(this).attr('href');
        

        $('#modalText').html('l\'article ' + postTitle);
        $('#modalConfirmBtn').attr('href', postDeleteUrl);
        
        
    });

    // Suppression de commentaire
    $('.deleteCommentBtn').click(function(e) {
        e.preventDefault();

        // this vaut .deletePostBtn 'cliqué'
        // .parent().parent() permet de remonter à partir du bouton
        var commentAuthor = $(this).parent().parent().find('span[id^=commentAuthor]').html();

        var commentDeleteUrl = $(this).attr('href');

        $('#modalText').html('le commentaire de ' + commentAuthor);
        $('#modalConfirmBtn').attr('href', commentDeleteUrl);
        
        
    });



    
    // function checkPostAffectedLines() {
    //     $('#addedPost').fadeOut(5000);
    // }

    // setInterval(checkPostAffectedLines(), 1000);


    // supprime les message d'erreurs ou d'actions réussies
    function fadeOutMessages() {
        $('.errorMessage, .actionDone').fadeOut(4000);
    }
    setInterval(fadeOutMessages(), 1000);

    // Colore les commentaires signalés
    $('.reported').parent().find('.authorCommentBloc').css('background-color', '#FF687D');
    $('.isAuthor').parent().find('.authorCommentBloc').css('background-color', '#9CFF94');

});
