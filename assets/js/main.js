// loader-spinner
$(document).ready(function(){
  $('.loader').fadeOut(10000);
  $('.spinner').fadeOut(5000);
  $('body').css('overflow','unset');
  $('.carousel-controll').css('display','unset');
});

// navbar-color
$(window).scroll(function(){
  let t = $(window).scrollTop();

  if(t>=50){
      $('.navbar').addClass('fixed-top');
      $('.navbar').addClass('z-3');
      $('.navbar').css('transition','5s');
  }
  else{
      $('.navbar').removeClass('fixed-top');
  }
});

//top-button
$('.btnTop').click(function(){
  $(window).scrollTop(0);
});
$(window).scroll(function(){
  let t = $(window).scrollTop();

  if(t>=300){
      $('.btnTop').css('display','block');
  }
  else{
      $('.btnTop').css('display','none');
  }
});

// color-box
let colors = ['red','yellow','blue','purple','teal'];
for(let i=0; i<colors.length; i++){
    $('.color-option li').eq(i).css('background',colors[i]);
}
$('.color-option li').click(function(){
    let currentBG = $(this).css("backgroundColor");
    $('.change-color').css('color',currentBG);
});
$('.color-box i').click(function(){
    let optionsWidth = $('.color-option').outerWidth();
    if($('.color-box').css('left')=='0px'){
        $('.color-box').animate({'left':-optionsWidth},3000);
    }
    else{
        $('.color-box').animate({'left':0},3000);
    }
});
// function openForm() {
//   document.getElementById("myForm").style.display = "block";
// }

// function closeForm() {
//   document.getElementById("myForm").style.display = "none";
// }

