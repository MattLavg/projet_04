$(document).ready(function () {

    // // Suppression de post
    // $('.deletePostBtn').click(function(e) {
    //     e.preventDefault();

    //     // this vaut .deletePostBtn 'cliqué'
    //     // .parent().parent() permet de remonter à partir du bouton
    //     var postTitle = $(this).parent().parent().find('span[id^=postTitle]').html();
    //     var postDeleteUrl = $(this).attr('href');
        

    //     $('#modalText').html('l\'article ' + postTitle);
    //     $('#modalConfirmBtn').attr('href', postDeleteUrl);
        
        
    // });

    // // Suppression de commentaire
    // $('.deleteCommentBtn').click(function(e) {
    //     e.preventDefault();

    //     // this vaut .deletePostBtn 'cliqué'
    //     // .parent().parent() permet de remonter à partir du bouton
    //     var commentAuthor = $(this).parent().parent().find('span[id^=commentAuthor]').html();

    //     var commentDeleteUrl = $(this).attr('href');

    //     $('#modalText').html('le commentaire de ' + commentAuthor);
    //     $('#modalConfirmBtn').attr('href', commentDeleteUrl);
        
        
    // });

    // BOOTSTRAP MODAL
    $('#deleteModal').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var author = button.data('author'); // Extract info from data-* attributes
        var title = button.data('title');
        var url = button.data('url');
        // console.log(recipient);

        var modal = $(this);

        if (author) {
            modal.find('.modal-text').text('le commentaire de ' + author);
        } else {
            modal.find('.modal-text').text('l\'article ' + title);
        }

        modal.find('#modalConfirmBtn').attr('href', url);
    })

    
    // function checkPostAffectedLines() {
    //     $('#addedPost').fadeOut(5000);
    // }

    // setInterval(checkPostAffectedLines(), 1000);


    // supprime les message d'erreurs ou d'actions réussies
    // function fadeOutMessages() {
    //     $('.errorMessage, .actionDone').fadeOut(8000);
    // }

    // if ($('.errorMessage, .actionDone')) {
    //     fadeOutMessages();
    // }

});
