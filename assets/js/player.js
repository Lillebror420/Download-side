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
  
  

  function humanReadableTime(el,v){
    var s = parseInt(v % 60);
      var m = parseInt((v / 60) % 60);
      s = (s >= 10) ? s : "0" + s;
      m = (m >= 10) ? m : "0" + m;
      el.innerHTML = m + ':' + s ;
  }

     
  function updatesangNP() {
    $.ajax({url:'https://partyfm.dk/title', timeout: 5000, success:function(data){
      var newTrack = data;
      var currentTrack = $("#sangNP").html();
    
      if(newTrack != currentTrack) {
        $("#sangNP").fadeOut('slow',function(){ $(this).html(newTrack).fadeIn("slow"); });
  }

    $("#sangNP").load("https://partyfm.dk/title");
            }
    })
  }
  
updatesangNP();
setInterval(function() {
  updatesangNP();
}, 5000);
  


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

}