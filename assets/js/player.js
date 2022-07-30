window.onload=function(){
    var track=document.getElementById('track'),
    ap=document.getElementById('player'),
    playButt=document.getElementById('playbutt'),
    
    muteButt=document.getElementById('mutebutt'),
   
    vol=document.querySelector('input'),
    pb=document.querySelector('progress'),
    muteimg = document.getElementById('muteimg'),
    playimg = document.getElementById('playimg');

    track.removeAttribute('controls');
    divs=document.querySelector('.container').children;
    divs[1].style.display='block';
    divs[1].style.visibility='visible';
    divs[2].style.visibility='visible';

   
  
    function humanReadableTime(el,v){
	    var s = parseInt(v % 60);
        var m = parseInt((v / 60) % 60);
        s = (s >= 10) ? s : "0" + s;
        m = (m >= 10) ? m : "0" + m;
        el.innerHTML = m + ':' + s ;
    }
  
    playButt.onclick=function(){
        console.log(track.paused);
        if (track.paused) {
            track.play();
            track.muted=false;
            muteimg.style.display='block';
            playimg.style.display='none';
        } else {
            if(track.muted === true){
                track.muted=false;
                muteimg.style.display='block';
                playimg.style.display='none';
    
            } else if(track.muted === false) {
                track.muted=true;
                muteimg.style.display='none';
                playimg.style.display='block';
               
            }
        }
    }

    function updatesangNP() {
        $.ajax({url:'https://partyfm.dk/title', timeout: 5000, success:function(data){
          var nextPlay = data;
          var nowPlay = $("#sangNP").html();
        
          if(nextPlay != nowPlay) {
            $("#sangNP").fadeOut('slow',function(){ $(this).html(nextPlay).fadeIn("slow"); });
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
        console.log(v);
        track.volume=v / 100;
        if(v === 0){
            track.muted=true;
        }
        else if(v > 0 && track.muted === true){
            track.muted=false;
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
        pb.setAttribute('value',0);
        track.currentTime=0;
    });
}

$(document).on('change' , '#volume' , function () {
    var v=$(this).val();
    track.volume=v / 100;
    if(v === 0){
        track.muted=true;
    }
    else if(v > 0 && track.muted === true){
        track.muted=false;
    }
});