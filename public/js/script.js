$(document).ready(function () {

    // Suppression de post
    $('.deletePostBtn').click(function(e) {
        e.preventDefault();

        $('#overlayDelete').css('display', 'block');

        // this vaut .deletePostBtn 'cliqué'
        // .parent().parent() permet de remonter à partir du bouton
        var postTitle = $(this).parent().parent().find('span[id^=postTitle]').html();
        var postDeleteUrl = $(this).attr('href');
        

        $('#overlayText').html('l\'article ' + postTitle);
        $('#overlayConfirmBtn').attr('href', postDeleteUrl);
        
        
    });

    // Suppression de commentaire
    $('.deleteCommentBtn').click(function(e) {
        e.preventDefault();

        $('#overlayDelete').css('display', 'block');

        // this vaut .deletePostBtn 'cliqué'
        // .parent().parent() permet de remonter à partir du bouton
        var commentAuthor = $(this).parent().parent().find('span[id^=commentAuthor]').html();
        console.log(commentAuthor);
        var commentDeleteUrl = $(this).attr('href');

        $('#overlayText').html('le commentaire de ' + commentAuthor);
        $('#overlayConfirmBtn').attr('href', commentDeleteUrl);
        
        
    });

    $('.closeDelete').click(function() {
        $('#overlayDelete').css('display', 'none');
    });

    $('.noDelete').click(function() {
        $('#overlayDelete').css('display', 'none');
    });



    
    
    function checkPostAffectedLines() {
        $('#addedPost').fadeOut(5000);
    }

    setInterval(checkPostAffectedLines(), 1000);

    $('.reported').parent().find('.authorCommentBloc').css('background-color', '#FF687D');

});
