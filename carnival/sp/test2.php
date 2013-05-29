<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>test</title>
  <script type="text/javascript" src="common/jquery-1.6.2.min.js"></script>
  <script type="text/javascript" src="js/jquery.progressbar.min.js"></script>
  <style type="text/css">
    #pb1_pbImage{height:100px;}
    
  </style>
</head>
<body>

<span id="pb1" class="progressBar"></span>
<a onclick="$('#pb1').progressBar(20);" href="#">20</a>

<a onclick="$('#pb1').progressBar(40);" href="#">40</a>

<a onclick="$('#pb1').progressBar(60);" href="#">60</a>

<a onclick="$('#pb1').progressBar(80);" href="#">80</a>

<a onclick="$('#pb1').progressBar(100);" href="#">100</a>
  <script type="text/javascript">
$(document).ready(function() {
    $("#pb1").progressBar();
    var x=0;
    var int=self.setInterval(function(){
      if(x>=99){
        window.clearInterval(int);
      }
      x++;
      $('#pb1').progressBar(x);
    },50);
    //$("#pb2").progressBar({ barImage: 'images/pbar-ani.gif'} );
    //$("#pb3").progressBar({ barImage: 'images/progressbg_orange.gif', showText: false} );
    //$("#pb4").progressBar(65, { showText: false, barImage: 'images/progressbg_red.gif'} );
    //$(".pb5").progressBar({ max: 2000, textFormat: 'fraction', callback: function(data) { if (data.running_value == data.value) { alert("Callback example: Target reached!"); } }} );
    //$("#uploadprogressbar").progressBar();
});
  </script>

    </body>

</html>