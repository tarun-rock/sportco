$(document).ready(function() {
	function scroll_chk(){
	  if ($(document).scrollTop() > 100) {
	    $(".scroll").fadeIn(400);
	  } else {
	    $(".scroll").fadeOut(400);
	  }
	}
	scroll_chk();
	$(window).scroll(function() {
	    scroll_chk();
	 });
	$(".scroll").click(function(event){   
      event.preventDefault();
      $('html,body').animate({scrollTop:$(this.hash).offset().top},700);
    });
    $(".subscribe").click(function(event){
        event.preventDefault();
        $('html,body').animate({scrollTop:$('#contactSection').offset().top},700);
    });
});//ready function