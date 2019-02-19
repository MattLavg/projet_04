

// document.getElementById("deleteBtn").addEventListener("click", function() {
//     document.getElementById("overlayDeletePost").style.display = "block";
// });

// document.getElementsByClassName("listPosts").style.backgroundColor = "blue";

// document.getElementById("overlayDeletePost").style.display = "block";

// function askDeletePost() {
//     document.getElementById("overlayDeletePost").style.display = "block";
// }

// var deleteBtn = document.getElementsByClassName("deleteBtn");

// for (var i = 0; i < deleteBtn.length; i++) {
//     var deleteBtn = deleteBtn[i];
//     deleteBtn.onclick = askDeletePost(); 

// }

// document.getElementsByClassName("deleteBtn").onclick = function() {askDeletePost()};

$(document).ready(function () {
    $('.deleteBtn').click(function() {
        document.getElementById("overlayDeletePost").style.display = "block";
    });

    $('.close').click(function() {
        document.getElementById("overlayDeletePost").style.display = "none";
    });

    $('.noDeletePost').click(function() {
        document.getElementById("overlayDeletePost").style.display = "none";
    });
});

