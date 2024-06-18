$(document).ready(function () {
  $("#summernote").summernote({
    height: 200,
  });
});

$(document).ready(function () {
  $("#selectAllBoxes").click(function (event) {
    if (this.checked) {
      $(".checkBoxes").each(function () {
        this.checked = true;
      });
    } else {
      $(".checkBoxes").each(function () {
        this.checked = false;
      });
    }
  });

// trying to create a loader.

//   var div_box = "<div id='load-screen'><div id='loading'></div></div>";
//   $("body").prepend(div_box);

//   $("#load-screen").delay(700).fadeOut(600, function () {
//       $(this).remove();
//     });



});


// Create the loader div
var divBox = document.createElement("div");
divBox.id = 'load-screen';

// Create the loading div inside the loader div
var loadingDiv = document.createElement("div");
loadingDiv.id = 'loading';
divBox.appendChild(loadingDiv);

// Prepend the loader to the body
document.body.insertBefore(divBox, document.body.firstChild);

// Function to remove the loader after delay
setTimeout(function() {
    divBox.style.transition = 'opacity 600ms';
    divBox.style.opacity = '0';

    setTimeout(function() {
        divBox.remove();
    }, 600); // 600ms corresponds to the fade out duration
}, 700); // 700ms delay before starting fade out


