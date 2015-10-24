$(".carousel").jCarouselLite({
     btnNext: ".next",
      btnPrev: ".prev",
      btnGo: [".0", ".1", ".2", ".3", ".4", ".5"],
	  mouseWheel: true,
	  auto: 800,
     speed: 15000,
     easing: "easeInQuad",
    visible: 5,
     scroll: 2
});