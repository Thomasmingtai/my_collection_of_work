<!DOCTYPE html>
<?php
    if(isset($_COOKIE['account']))
	setcookie("account", "", time()-86400);
    if(isset($_COOKIE['nickname']))
	setcookie("nickname", "", time()-86400);
    if(isset($_COOKIE['id']))
	setcookie("id",  "", time()-86400);
    if(isset($_COOKIE['customerOrder']))
	setcookie("customerOrder",  "", time()-86400);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Index</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            * {
                padding: 0;
                margin: 0;
                box-sizing: border-box;
            }
            .main{
                width:100%;
                height:100%;
                position:absolute;
                top:0;
                right:0;
                left:0;
                bottom:0;
                display: flex;
                border: 0px;
            }
            .contain{
                width:50%;
                border: 0px;
                margin: 10%;
                filter: drop-shadow(0 0 10px #0003); /*陰影描邊*/
            }
            .flip-box{
                width:100%;
                height:100%;
                margin:auto;
                perspective:120000px;
            }
            .flip-box > div{
                width:100%;
                height:100%;
                position:absolute;
                top:0;
                left:0;
                transition: 3s;
                line-height: 300px;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 100px;
                backface-visibility: hidden;
                transform-style:preserve-3d;
            }
            .front{
                background-color: #bad4aa;
                transform: rotateY(0deg);
            }
            .back{
                background-color: #ebf5df;
                transform:rotateY(180deg);
            }
            .flip-box:hover .front{transform:rotateY(180deg);}
            .flip-box:hover .back{transform:rotateY(360deg);}
            .back img, .front img{
                height:50%;
                width: 50%;
            }
            .back a, .front a{
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .back a:hover, .front a:hover{
                border: 2px #edb458 solid;
            }
        </style>
    </head>
    <body>
        <div class="main">
            <div class="contain">
                <div class="flip-box">
                    <div class="front">
                        <img src="img/login.png">
                    </div>
                    <div class="back">
                        <span><a href="login.php"><img src="img/log-in.png"></a></span>
                    </div>
                </div>
            </div>
            <div class="contain">
                <div class="flip-box">
                    <div class="front">
                        <img src="img/signup.png">
                    </div>
                    <div class="back">
                        <span><a href="signup.php"><img src="img/sign-up.png"></a></span>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
