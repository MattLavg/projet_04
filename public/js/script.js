$(document).ready(function () {

    // BOOTSTRAP MODAL
    $('#deleteModal').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var author = button.data('author'); // Extract info from data-* attributes
        var title = button.data('title');
        var url = button.data('url');

        var modal = $(this);

        if (author) {
            modal.find('.modal-text').text('le commentaire de ' + author);
        } else {
            modal.find('.modal-text').text('l\'article ' + title);
        }

        modal.find('#modalConfirmBtn').attr('href', url);
    })

});
