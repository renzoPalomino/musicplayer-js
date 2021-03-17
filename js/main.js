console.log("Ancho de pantalla: "+ screen.width);
console.log("Ancho de ventana: "+ document.body.clientWidth);

var anchoVentana = document.body.clientWidth;
var i=0;
var barra = document.querySelectorAll('.barra');
/*anime({
		targets: barra,
		width: function() {
      return anime.random(0, 270);
    },
  		easing: 'easeInOutQuad',
  		direction: 'alternate',
  		loop: true
});*/

function randomValues(number) {
	var i=0;
  anime({
    targets: barra,
    width: function() {
      return anime.random(100, anchoVentana*0.4);
    },
    easing: 'easeInOutSine',
    duration: 400,
    complete: randomValues
  });
}


randomValues(3);



