var index = 0,
  amount = 0,
  currTransl = [],
  outerIndex = [],
  translationComplete = true,
  moveOffset = 0;
const NUM_OF_SKIP = 1;
var transitionCompleted = function () {
  translationComplete = true;
};

let carousel = document.getElementById("carousel");

document.addEventListener("DOMContentLoaded", function (event) {
  if (carousel) {
    amount = document.getElementsByClassName("slide").length;
    // get the width of the container
    // move offset relative to container
    // moveOffset = parseInt(
    //   window.getComputedStyle(document.getElementById("carousel-container"))
    //     .width,
    //   10
    // );
    // move offset relative to width of image
    moveOffset = parseInt(
      window.getComputedStyle(document.querySelectorAll("li.slide img")[0])
        .width,
      10
    );
    // calcuate the width of the carousel
    document.getElementById("carousel").style.width =
      amount * moveOffset + "px";
    // prevent multiple click when transition
    for (var i = 0; i < amount; i++) {
      currTransl[i] = -moveOffset * NUM_OF_SKIP;
      const slide = document.getElementsByClassName("slide")[i];

      // set translateX value in style
      slide.style.transform = `translateX(${currTransl[i]}px)`;
      slide.addEventListener("transitionend", transitionCompleted, true);
      slide.addEventListener("webkitTransitionEnd", transitionCompleted, true);
      slide.addEventListener("oTransitionEnd", transitionCompleted, true);
      slide.addEventListener("MSTransitionEnd", transitionCompleted, true);
    }
    // add the last item to the start so that translateX(-moveOffset) works (In case the first click is the previous button)
    for (var i = 0; i < NUM_OF_SKIP; i++) {
      document
        .getElementById("carousel")
        .insertBefore(
          document.getElementById("carousel").lastElementChild,
          document.getElementById("carousel").children[0]
        );
    }
  }
});

function prev() {
  if (translationComplete === true) {
    // set translation complete to false
    translationComplete = false;
    for (var x = 0; x < NUM_OF_SKIP; x++) {
      // looping for decrease current translateX
      for (var i = 0; i < amount; i++) {
        // getting slide element
        var slide = document.getElementsByClassName("slide")[i];
        // check outer index of slide for updating opacity if index not included in array outerIndex set opacity to 1
        if (!outerIndex.includes(i)) slide.style.opacity = "1";
        // calculate current translateX
        // set style, opacity and transform : translateX
        currTransl[i] += moveOffset;
        slide.style.transform = "translateX(" + currTransl[i] + "px)";
      }
      // decrease index every loop
      index--;
      // get max index if index equals -1
      if (index == -1) {
        index = amount - 1;
      }
      // get current outer index using modulus oprator
      var currOuterIndex = index % amount;
      // push current outer index to variable array outerIndex
      outerIndex.push(currOuterIndex);
      // getting current outer slide
      var outerSlide = document.getElementsByClassName("slide")[currOuterIndex];
      // set opacity outer slide to 1
      outerSlide.style.opacity = "0";
      // decrease current translateX of outer slide
      currTransl[currOuterIndex] -= moveOffset * amount;
      // set transform style, translateX
      outerSlide.style.transform =
        "translateX(" + currTransl[currOuterIndex] + "px)";
    }
    // set outerIndex to empty array
    outerIndex = [];
  }
}

function next() {
  if (translationComplete === true) {
    translationComplete = false;
    for (var j = 0; j < NUM_OF_SKIP; j++) {
      for (var i = 0; i < amount; i++) {
        var slide = document.getElementsByClassName("slide")[i];
        if (!outerIndex.includes(i)) slide.style.opacity = "1";
        currTransl[i] -= moveOffset;
        slide.style.transform = "translateX(" + currTransl[i] + "px)";
      }
      var currOuterIndex = index % amount;
      outerIndex.push(currOuterIndex);
      index++;
      var outerSlide = document.getElementsByClassName("slide")[currOuterIndex];
      outerSlide.style.opacity = "0";
      outerSlide.style.transform =
        "translateX(" +
        (currTransl[currOuterIndex] + moveOffset * amount) +
        "px)";
      currTransl[currOuterIndex] =
        currTransl[currOuterIndex] + moveOffset * amount;
    }
    outerIndex = [];
  }
}

carousel && setInterval(next, 20000);
