document.addEventListener("DOMContentLoaded", function () {
  var likeForm = document.getElementById("likeForm");
  var likeButton = document.getElementById("likeButton");
  var likeIcon = document.getElementById("likeIcon");

  // Fonction pour effectuer la requête AJAX
  function sendRequest(url, method, callback) {
    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        callback(xhr.responseText);
      }
    };
    xhr.send();
  }

  // Vérifier si l'utilisateur a déjà effectué un like
  function checkIfLiked() {
    var postId = "<?php echo $post['Post_Id']; ?>";
    var userId = "<?php echo $_SESSION['user']['User_Id']; ?>";
    var url = "../like/check-like/" + postId + "/" + userId;

    sendRequest(url, "GET", function (response) {
      var isLiked = response === "1";
      updateLikeButton(isLiked);
    });
  }

  // Mettre à jour l'apparence du bouton de like
  function updateLikeButton(isLiked) {
    if (isLiked) {
      likeButton.classList.add("btn-like-red");
      likeIcon.src = "/Bonnefete/src/public/assets/icon/heart-red.png";
      likeForm.addEventListener("submit", deleteLike);
    } else {
      likeButton.classList.remove("btn-like-red");
      likeIcon.src = "/Bonnefete/src/public/assets/icon/heart-white.png";
      likeForm.addEventListener("submit", createLike);
    }
  }

  // Fonction pour supprimer le like
  function deleteLike(event) {
    event.preventDefault();

    var postId = "<?php echo $post['Post_Id']; ?>";
    var userId = "<?php echo $_SESSION['user']['User_Id']; ?>";
    var url = "../like/delete-like/" + postId + "/" + userId;

    sendRequest(url, "POST", function (response) {
      checkIfLiked(); // Mettre à jour l'état du bouton après suppression du like
    });
  }

  // Fonction pour créer un like
  function createLike(event) {
    event.preventDefault();

    var postId = "<?php echo $post['Post_Id']; ?>";
    var userId = "<?php echo $_SESSION['user']['User_Id']; ?>";
    var url = "../like/create-like";

    // Envoyer une requête POST avec les données du like
    sendRequest(url, "POST", function (response) {
      checkIfLiked(); // Mettre à jour l'état du bouton après création du like
    });
  }

  // Vérifier l'état du like lors du chargement de la page
  checkIfLiked();
});
