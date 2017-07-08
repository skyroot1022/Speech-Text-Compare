<!DOCTYPE HTML>
<?php include 'db.php'; ?>

<html>
  <head>
    <title>Chatbox</title> 
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.1/css/font-awesome.min.css" />
    <link rel="stylesheet" href="style.css" media="all"/>
	
     <script type="text/javascript">

		          <!--recognition-->
			var r = document.getElementByName('msg');

			function startConverting () {
				if('webkitSpeechRecognition' in window){
					var speechRecognizer = new webkitSpeechRecognition();
					speechRecognizer.continuous = true;
					speechRecognizer.interimResults = true;
					speechRecognizer.lang = 'en-IN';
					speechRecognizer.start();

					var finalTranscripts = '';

					speechRecognizer.onresult = function(event){
						var interimTranscripts = '';
						for(var i = event.resultIndex; i < event.results.length; i++){
							var transcript = event.results[i][0].transcript;
							transcript.replace("\n", "<br>");
							if(event.results[i].isFinal){
								finalTranscripts += transcript;
							}else{
								interimTranscripts += transcript;
							}
						}
						r.innerHTML = finalTranscripts + interimTranscripts ;
					};
					speechRecognizer.onerror = function (event) {
					};
				}else{
					r.innerHTML = 'Your browser is not supported. If google chrome, please upgrade!';
				}
			}   
		                  <!--AJAX function-->
  
	    function ajax(){
			var req=new XMLHttpRequest();
			req.onreadystatechange=function(){
				if(req.readyState == 4 && req.status==200 ){
					document.getElementById('chat').innerHTML=req.responseText;
					
				}
				
				
			}
			req.open('GET','chat.php',true);
			req.send();
		}
	   
	    setInterval(function(){ajax()},1000);
</script>
  
  </head>
  <body onload="ajax();">
     <div id="container">
		<div id="chat_box">
		<div id="chat"></div>		   
		</div>
	       <?php
	    if(isset($_POST['submit'])){
			
			$name=$_POST['name'];
			 $msg=$_POST['msg'];
			
			$insert="INSERT INTO chat (name,msg) VALUES('$name','$msg')";
			$run=$conn->query($insert);
			/*if($run){
				echo"<embed loop='false' src='tone.mp3' hidden='true' autoplay='true'>";
				
			}*/
			}
	    ?>  
	  <form action="index.php" method="POST"> 
	    
		<div class="name"><input type="text" name="name" placeholder="Enter name"/></div>
		<textarea class="msg_input" name="msg" ></textarea>
		<input type="submit" name="submit" value="Send"/>
		<button onclick="startConverting();"><i class="fa fa-microphone"></i></button>
	  </form>
	</div>
  </body>

</html>