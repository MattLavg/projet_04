
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= $title; ?></title>

    <link href="<?php echo ASSETS; ?>/css/style.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    
    

  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="<?= HOST; ?>">Jean Forteroche</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?= HOST; ?>">Accueil<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= HOST; ?>edit">Administration</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= HOST; ?>logout">Déconnexion</a>
      </li>
    </ul>
  </div>
</nav>


<main role="main" class="mainContainer container-fluid">

<div class="container-fluid">

    <div class="row">

        <div class="col-lg-4">
            <ul class="list-group">
                <a href="index.php?page=admin&param=addPost"><li class="list-group-item">Ajouter un article</li></a>
                <a href="index.php?page=admin&param=manageListPosts"><li class="list-group-item">Gérer les articles</li></a>
                <a href="index.php?page=admin&param=reportedCommentsView"><li class="list-group-item">Modérer les commentaires</li></a>
            </ul>
        </div>

        <div class="col-lg-8">
        
            <?= $content ?>

        </div>
    </div>

</div>


<!-- MODAL -->
<div id="deleteModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Souhaitez-vous vraiment effacer <span id="modalText"></span> ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <a id="modalConfirmBtn" href="">
            <button type="button" class="btn btn-primary">Effacer</button>
        </a>
      </div>
    </div>
  </div>
</div>



<footer class="container-fluid fixed-bottom d-flex justify-content-center align-items-center bg-dark p-2">
      <p><span class="text-light">Jean Forteroche - </span><a href="<?= HOST; ?>connection">Connexion</a></p>
</footer>

</main><!-- /.container -->

<!-- TINYMCE -->
<script src="/projet_04/public/tinymce/js/tinymce.min.js"></script>
<script type="text/javascript">
  tinymce.init({
    selector: '#tinymcetextarea',  // change this value according to your HTML
    plugins: [
      'advlist autolink autoresize link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor'
    ],
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons',
    entity_encoding : "raw"
  });
  </script>

  

  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<!-- BOOSTRAP JS -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js" integrity="sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp" crossorigin="anonymous"></script>

<script src="/projet_04/public/js/script.js"></script>

