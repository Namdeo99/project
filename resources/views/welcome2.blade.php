<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=1">
<title>Home</title>
{{-- <link rel="stylesheet" type="text/css" href="css/style.css"> --}}
<style>
    *,*:after,*:before{
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	-ms-box-sizing: border-box;
	box-sizing: border-box;
}
body{
	font-family: arial;
	font-size: 16px;
	margin: 0;
	line-height: 1.4;
	background: #bdffcb;
	color: #000;
}
img{ max-width: 100%; }
.header{
	padding:20px 0;
	position: fixed;
	left: 0;
	width: 100%;
	z-index: 10;
	transition: all 0.1s ease-in-out;
	background: #00c343
}
.container{
	max-width: 1200px;
	margin:0 auto;
	padding:0 15px;
	display: flex;
	align-items: center;
	justify-content: space-between;
}
.logo{
	width: 150px;
	display: block;

}
.logo img{
	max-width: 100%;
	vertical-align: top;
}
.nav-icon{
	width: 40px;
}


/*Notification
----------------------------------------------*/

.notify-alert-box{
	width: 400px;
	position: fixed;
	left: 50%;
	margin-left: -200px;
	top: 0; /*top: -100%;*/
	padding: 20px;
	z-index: 100000;
	background:#fff;
	color: #333;
	transition: all 1s ease-in-out;
}
.notify-alert-box img{
	width: 70px;
	float: left;
	margin-right: 10px;
}

.buttons{
	text-align: right;
}
.buttons button{
	background:#024e73;
	color: #fff;
	border:0;
	padding: 8px 15px;
	font-size: 18px;
	cursor: pointer;
}
</style>
</head>
<body>

<header class="header">
	<div class="container">
		<a href="#" class="logo"><img src="images/logo.png"></a>
		<span class="nav-icon"><img src="images/nav_icon.png"></span>
	</div>
</header>


<div class="notify-alert-box">
	<img src="images/notify-logo.png">
	<p>We'd like to send you notifications of the latest posts and updates.</p>
	<div class="buttons">
		<button class="alert-btn" id="notify-cancel-button">Cancel</button>
		<button class="alert-btn" id="notify-button">Allow</button>
	</div>

</div>

{{-- <script type="text/javascript" src="js/custom.js"></script> --}}
<script>
    setTimeout(function(){
	document.querySelector('.notify-alert-box').style.top='0';
},1000)

document.querySelector('#notify-button').onclick = async () => {
	localStorage.setItem('notify','true')
	notifyTrue()
	//notifyOption()
}
function notifyTrue(){
	if(localStorage.getItem('notify','true')){
		document.querySelector('.notify-alert-box').style.display='none';
	}
}
notifyTrue()

document.querySelector('#notify-cancel-button').onclick = async () => {
	localStorage.setItem('notify','false')
	notifyFalse()	
}
function notifyFalse(){
	if(localStorage.getItem('notify','false')){
		document.querySelector('.notify-alert-box').style.display='none';
	}
}
notifyFalse()


function showNotification(){
	var notificationBody = new Notification('New Message from IT',{
		body:'Hi Google',
        
		//icon:'images/notify-logo.png',
	});
	/*notificationBody.onclick = (e) =>{
		window.location.href = 'https://google.com'
	}*/
}
/*function showNotification2(){
	var notificationBody = new Notification('New Message2 from IT',{
		body:'Hi Invention Tricks'
	});
	notificationBody.onclick = (e) =>{
		window.location.href = 'https://youtube.com'
	}
}*/

//console.log(Notification.permission);
function notifyOption(){
	if(localStorage.notify == 'true'){
		const timestamp = new Date().getTime() + 5 * 1000;
		if(Notification.permission == "granted"){
			showNotification()
			if(localStorage.notifyMessage === undefined){
				localStorage.setItem('notifyMessage', timestamp)
				showNotification()
			}
			if(localStorage.notifyMessage2 === undefined){
				localStorage.setItem('notifyMessage2', timestamp)
				showNotification2()
			}
		}else if(Notification.permission !== "denied"){
			Notification.requestPermission().then(permission =>{
				//console.log(permisshion)
				//
				if(permission == "granted"){
					showNotification()
					if(localStorage.notifyMessage === undefined){
						localStorage.setItem('notifyMessage', timestamp)
						showNotification()
					}
					
					
				}
				
			})
		}

	}

}
notifyOption()



</script>
</body>
</html>
