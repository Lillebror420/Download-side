window.onload=function(){
  var track=document.getElementById('track'),
    ap=document.getElementById('player'),
    playButt=document.getElementById('playbutt'),
    stopButt=document.getElementById('stopbutt'),
    muteButt=document.getElementById('mutebutt'),
    opl=document.getElementById('onplay'),
    opa=document.getElementById('onpause'),
    omu=document.getElementById('onmute'),
    ost=document.getElementById('onstop'),
    vol=document.querySelector('input'),
    pb=document.querySelector('progress');



 // non intrusive js on audio
 // remove controls and make it disappear
 track.removeAttribute('controls');
 //track.style.display='none';
 // make visible div elements for custom player
 divs=document.querySelector('.container').children;
 divs[1].style.display='block';
 divs[1].style.visibility='visible';
 divs[2].style.display='flex';
 divs[2].style.visibility='visible';
  
 function humanReadableTime(el,v){ 
	var s = parseInt(v % 60);
  var m = parseInt((v / 60) % 60);
    s = (s >= 10) ? s : "0" + s;
    m = (m >= 10) ? m : "0" + m;
    el.innerHTML = m + ':' + s ; 
  }
  
 playButt.onclick=function(){
   if(track.paused === true){
     track.play();
     opl.style.visibility='visible';
     opl.style.fill='chartreuse';
     opa.style.visibility='hidden';
     opa.style.fill='white';
     ost.style.fill='white';
   }
   else{
     track.pause();
     opa.style.visibility='visible';
     opa.style.fill="chartreuse";
     opl.style.visibility='hidden';
     opl.style.fill='white';
     ost.style.fill='white';
   }
 }

 stopButt.onclick=function(){
   if(track.paused === false){
     track.pause();
   }
   track.currentTime=0;
   opl.style.visibility='visible';
   opl.style.fill='white';
   opa.style.visibility='hidden';
   ost.style.fill='chartreuse';
 }

 muteButt.onclick=function(){
   if(track.muted === false){
     track.muted=true;
     omu.style.fill='coral';
   }
   else{
     track.muted=false;
     omu.style.fill='white';
   }
 }
 // volume slider
vol.addEventListener('input',function(){
  var v=vol.value;
  track.volume=v / 100;
  if(v === 0){
    track.muted=true;
    omu.style.fill='coral';
  }
  else if(v > 0 && track.muted === true){
    track.muted=false;
    omu.style.fill='white';
  }
 });

 // time elements
 var t=divs[1].children;

 // retrieve duration info after loaded enough data
 if(track.readyState === 4){
  var dur = track.duration;
   // progress bar max length
   pb.setAttribute('max',dur);

   if(dur !== 0 && isNaN(dur) === false){
     // if not streaming
         humanReadableTime(t[1],dur);
   }
   // if streaming
   else{
    t[1].innerHTML='on stream';
   }

  // progress bar during play
  track.addEventListener('timeupdate',function(){
     // if not streaming, set current time playing
     // duration is not 0 neither undefined
     if(dur !== 0 && isNaN(dur) === false){
       pb.setAttribute('value',track.currentTime);
       humanReadableTime(t[0],pb.value);
       t[0].innerHTML+='&nbsp;&gt; ';  
     } 
  });
 }
  // reset if end of track
  track.addEventListener('ended',function(){
    opl.style.fill='white';
    pb.setAttribute('value',0);
    track.currentTime=0;
  });
  
  // loop controller
  // span container to make click on loop button easier
  var span=document.querySelector('.loop');
  var olo=document.getElementById('onloop');
  

}