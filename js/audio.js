var icono,
    pista,
    estado,
    load,
    load2,
    load3,
    rep,
    lastAudio,
    currentAudio,
    contAudio=0,
    cover,
    title,
    artist,
    repetir,
    stateRep=false,
    random,
    stateRandom=false,
    tiempoTotal,
    tiempoActual,
    duracion,
    barra,
    progreso,
    mInfo,
    controlBox;

function elementos(i){
	icono =document.getElementById('play-pause');
	pista =document.getElementById('music');
	estado=document.getElementsByClassName('max')[0];
        cover=document.getElementById('imgCover');
        title=document.getElementById('music-Title');
        artist=document.getElementById('music-Artist');
        repetir=document.getElementsByClassName('min')[3];
        random=document.getElementsByClassName('min')[0];
        tiempoTotal=document.getElementsByClassName('dur')[0];
        tiempoActual=document.getElementsByClassName('pro')[0];
        barra=document.getElementById('barra');
        progreso=document.getElementById('progreso');
        mInfo=document.getElementById('M-info');
        controlBox=document.getElementById('controlBox');
        
    estado.addEventListener('click', reproduccion, false);
    barra.addEventListener('click', posicion, false);
	
}

function setAudio(i){
    if(currentAudio!=i){
    pista.src=listAudio[i];
    //Informacion
    cover.src=listCover[i];
    title.innerHTML=listTitle[i];
    artist.innerHTML=listArtist[i];
    pista.onloadstart;
    //duracion
        getDuration();
    if(contAudio===1){
        lastAudio=currentAudio;
    }
    currentAudio=i;
    contAudio=1;
    }
    reproduccion();
}

function reproduccion(){
    if(currentAudio!=null){
    icono2=document.getElementById('play-pause2-'+currentAudio);
	if((pista.paused==false)&&(pista.ended==false)){
		pista.pause();
		icono.className="fa fa-play-circle";
                icono2.className="fa fa-play";
                
	}else{
		pista.play();
		icono.className="fa fa-pause-circle";
		icono2.className="fa fa-pause";
                if(lastAudio!=null){
                    icono3=document.getElementById('play-pause2-'+lastAudio);
                    icono3.className="fa fa-play";
                }

		load= setInterval(rep, 500);
                load2=setInterval(playAutomatic,1000);
                load3=setInterval(pista.onloadedmetadata,100);
	}
    }
}

function rep(){
    tiempoActual.innerHTML=mostrarTiempo(parseInt(pista.currentTime));
}

function getDuration(){
    pista.onloadedmetadata=function (){
        tiempoTotal.innerHTML=mostrarTiempo(parseInt(pista.duration));
        progreso.style.width=(pista.currentTime*100/pista.duration)+"%";
    };
}

function audioDuracion(dur){
    duracion=dur;
}

function mostrarTiempo(time){
    min=parseInt(time/60);
    sec=parseInt(time-min*60);
    if(sec<10){cad=":0";}
    else{cad=":";}
    return min+cad+sec;
}

function next(){
    if(stateRandom){
        var audioRandom = getRandomInt(0,(listAudio.length-1));
        if(currentAudio==audioRandom) next();
        else setAudio(audioRandom);
    }else{
        if(currentAudio!=(listAudio.length-1)){
        setAudio(currentAudio+1);}
    }
}

function previous(){
    if(currentAudio!=0){
        setAudio(currentAudio-1);
    }
}

function getRandomInt(min, max) {
  return Math.floor(Math.random() * ((max+1) - min)) + min;
}

function activarRepe(){
    if(stateRep){
        repetir.className="min mx-3";
    }else{
        repetir.className="min mx-3 text-success";
    }
    stateRep=!stateRep;
}

function activarRandom(){
    if(stateRandom){
        random.className="min mx-3";
    }else{
        random.className="min mx-3 text-success";
    }
    stateRandom=!stateRandom;
}

//implementar reproducir siguiente cancion automaticamente
function playAutomatic(){
    if(pista.ended){
        icono.className="fa fa-play-circle";
        icono2.className="fa fa-play";
        if(stateRep) setAudio(currentAudio);
        else next();
    }
}

function posicion(posicion){
    var raton=posicion.pageX-mInfo.offsetWidth-controlBox.offsetLeft+16;
    var raton2=parseInt((raton/barra.offsetWidth)*100);
    var nuevoTiempo=raton*pista.seekable.end(0)/barra.offsetWidth;
    pista.currentTime=nuevoTiempo;
    progreso.style.width=raton2+"%";
    console.log("Duration: "+pista.seekable.end(0));
}