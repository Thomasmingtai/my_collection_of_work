<!DOCTYPE html>
<?php 
    setcookie("customerOrder",  "", time()-86400);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Back to Intersection</title>
        <style>
            *{
                padding: 0px;
                margin: 0px;
            }
            .main{
                width:80vw;
                height:80vh;
                position:absolute;
                top:0;
                right:0;
                left:0;
                bottom:0;
                margin:auto;
            }
            .contain{
                width:100%;
                height:100%;
                position:absolute;
                top:0;
                left:0;
                background-color: #cccccc;
            }
            .alert{
                height:20%;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: lightcoral;
                width:100%;
                font-size:3.5rem;
            }
            .link{
                height:80%;
                display: flex;
                justify-content: center;
                align-items: center;
                width:100%;
            }
            .link img{
                height:50%;
                width: 50%;
                border:5px #aa0000 solid;
                border-radius: 50%;
            }
            .link a{
                display: flex;
                justify-content: center;
                align-items: center;
            }
            
        </style>
    </head>
    <body>
        <div class="main">
            <div class="contain">
                <div class='alert'>訂單成立</div>
                <div class="link"><a href="intersection.php#carousel__slide1"><img src="img/home.svg"></a></div>
            </div>
        </div>
    </body>
</html>
