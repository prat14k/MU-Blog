<!--
<html>
<h1>SMART ADS</h1>
<h2>
<form action="" method="post">Enter Video ID
<input type="text" id="textbox1" value="YqeW9_5kURI">
<button type="submit" id="button1">Go</button>
</form>
</h2>
-->
<html>
<head>
</head>
<body>
<style>
img1 {
position: absolute;";
left: 700px;";
top: 130px;";
z-index: -1;";
}
img2 {
    position: absolute;
    left: 700px;
    top: 300px;
    z-index: -1;
}
</style>


    <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
    <div id="player"></div>

    <script>
    
    
    
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      var trial=document.getElementById('textbox1');
      //var button=document.getElementById('button1');

      function onYouTubeIframeAPIReady() {

        player = new YT.Player('player', {
          height: '390',
          width: '1000',
          videoId: trial.value,
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        event.target.playVideo();
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
          setTimeout(stopVideo, 6000);
          done = true;
        }
      }
      function stopVideo() {
        player.stopVideo();
      }
</script>
</body>
<?php
$videoId=$_POST['videoid'];
$filename=$_POST['filename'];
$filename = str_replace(' ', '_', $filename);
 include 'one.php';
 //send2SpeechAPI("");

?>
</html>


