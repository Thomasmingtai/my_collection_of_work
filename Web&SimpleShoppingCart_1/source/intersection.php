<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Intersection</title>
        <style>
            * {
                padding: 0;
                margin: 0;
                box-sizing: border-box;
            }
            body {
                margin: 0 auto;
                padding: 0 1.25rem;
            }

            * {
                scrollbar-color: transparent transparent; /* thumb and track color */
                scrollbar-width: 0px;
            }

            *::-webkit-scrollbar {
                width: 0;
            }

            * {
                -ms-overflow-style: none;
            }

            ol, li {
                list-style: none;
                margin: 0;
                padding: 0;
            }

            .carousel {
                width:80vw;
                height:80vh;
                position:absolute;
                top:0;
                right:0;
                left:0;
                bottom:0;
                margin:auto;
                filter: drop-shadow(0 0 10px #0003);
                perspective: 100px;
            }

            .carousel__viewport {
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                display: flex;
                overflow-x: scroll;
                counter-reset: item;
                scroll-behavior: smooth;
                scroll-snap-type: x mandatory;
            }
            .carousel__slide {
                position: relative;
                flex: 0 0 100%;
                width: 100%;
                counter-increment: item;
            }
            .carousel__snapper {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                scroll-snap-align: center;
            }
            @media (hover: hover) {
                .carousel__snapper {
                    animation-name: tonext, snap;
                    animation-timing-function: ease;
                    animation-duration: 4s;
                    animation-iteration-count: infinite;
                }
                .carousel__slide:last-child .carousel__snapper {
                    animation-name: tostart, snap;
                }
            }

            @media (prefers-reduced-motion: reduce) {
                .carousel__snapper {
                    animation-name: none;
                }
            }

            .carousel:hover .carousel__snapper,
            .carousel:focus-within .carousel__snapper {
                animation-name: none;
            }

            .carousel__navigation {
                position: absolute;
                right: 0;
                bottom: 0;
                left: 0;
                text-align: center;
            }

            .carousel__navigation-list,
            .carousel__navigation-item {
                display: inline-block;
            }

            .carousel__navigation-button {
                display: inline-block;
                width: 1.5rem;
                height: 1.5rem;
                background-color: #333;
                background-clip: content-box;
                border: 0.25rem solid transparent;
                border-radius: 50%;
                font-size: 0;
                transition: transform 0.1s;
            }
            .backP{
                height:80vh;
                width: 10vw;
                position: absolute;
                left: 0px;
                top: 10vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .nextP{
                height:80vh;
                width: 10vw;
                position: absolute;
                right: 0px;
                top: 10vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .btn{
                width: 50%;
                border-radius: 50%;
            }
            .btn img{
                width: 100%;
            }
              
            .contain{
                width:100%;
                height:100%;
                position:absolute;
                top:0;
                left:0;
            }
            .shoppingCart{
                display:flex;
                justify-content:center;
                align-items:center;
            }
            .shoppingCart img{
                height:70%;
            }
            .shoppingCart a{
                display:flex;
                justify-content:center;
                align-items:center;
            }
            .textArea{
                width: 100%;
                height: 100%;
                overflow-y: scroll;
                font-size: 1.2rem;
                padding: 8%;
                background-color: #e5d0cc;
            }
            .aligenText{
                text-align: center;
            }
            #logoutBtn:hover{
                border-bottom: 2px #bfacb5 solid;
            }
			
        </style>
        <script language="javascript">
            function backPage(){
                var index=parseInt(document.getElementById("index").value);
                var frame_number = document.getElementsByClassName('carousel__slide').length;
                
                index-=1;
                if(index < 0)
                    index+=frame_number;
                slidePage(index);
            }
                
            function nextPage(){
                var index=parseInt(document.getElementById("index").value);
                var frame_number = document.getElementsByClassName('carousel__slide').length;
                
                index+=1;
                if(index == frame_number)
                    index-=frame_number;
                slidePage(index);
            }
            function slidePage(index){
                document.getElementById("index").value=index;
                var frame_number = document.getElementsByClassName('carousel__slide').length;
                var hreff="#carousel__slide"+index;
                
                location.href="intersection.php"+hreff;
            }
        </script>
    </head>
    <body onload="slidePage(0);">
        
        <div class="backP">
            <div class="btn">
                <a href="javascript:backPage()"><img src="img/arrow-left.svg"></a>
            </div>
        </div>
            
        <section class="carousel">
            <input type="hidden" id="index" value="0">
            <ol class="carousel__viewport">
                <li id="carousel__slide0" tabindex="0" class="carousel__slide">
                    <div class="carousel__snapper">
                        <div class="contain" style="display: flex;align-items: center; background-color: #444554;">
                            <div style="font-size: 5rem;margin: 0 auto;">
                                <div style="width: 100%; height: 30%; text-align: center; color: #e5d0cc;">Wellcome!!</div>
                                <div style="width: 100%; height: 30%; text-align: center; color: #e5d0cc;">
                                    <?php echo$_COOKIE['nickname'] ; ?>
                                </div>
                                <div style="width: 100%; height: 40%; text-align: center;">
                                    <a href="index.php" id="logoutBtn" style="text-decoration: none; color: #bfacb5;">[Logout]</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li id="carousel__slide1" tabindex="0" class="carousel__slide">
                    <div class="carousel__snapper" style="background-color: #bfacb5;">
                        <div class="contain shoppingCart">
                            <a href="shoppingCart.php"><img src="img/shopping-cart.svg"></a>
                        </div>
                    </div>
                </li>
                <li id="carousel__slide2" tabindex="0" class="carousel__slide">
                    <div class="carousel__snapper">
                        <div class="textArea aligenText" style="color: #172121;">
                            <?php
                                $f=@fopen('DHMO.txt', 'r') or die('faile');
                                $count=0;
                                while(!feof($f)){
                                    echo fgets($f);
                                    $count++;
                                }
                                fclose($f);
                            ?>
                        </div>
                    </div>
                </li>
                <li id="carousel__slide3" tabindex="0" class="carousel__slide">
                    <div class="carousel__snapper">
                        <div class="contain" style="display: flex;align-items: center; background-color: #7f7b82;">
                            <div style="font-size: 5rem;margin: 0 auto;">
                                <div style="width: 100%; height: 30%; text-align: center; color: #e5d0cc;">
                                    <h1 style="font-size: 3rem;">Contact Us</h1>
                                    <h1 style="font-size: 2rem;">Line ID: <a href="#" style="text-decoration: none; color: #bfacb5;">20008907072000</a></h1>
                                    <h1 style="font-size: 2rem;">E-mail: <a href="#" style="text-decoration: none; color: #bfacb5;">thomasleemingtai@gmail.com</a></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ol>
            <aside class="carousel__navigation">
                <ol class="carousel__navigation-list">
                    <li class="carousel__navigation-item">
                        <a href="#carousel__slide0" class="carousel__navigation-button">Go to slide 1</a>
                    </li>
                    <li class="carousel__navigation-item">
                        <a href="#carousel__slide1" class="carousel__navigation-button">Go to slide 2</a>
                    </li>
                    <li class="carousel__navigation-item">
                        <a href="#carousel__slide2" class="carousel__navigation-button">Go to slide 3</a>
                    </li>
                    <li class="carousel__navigation-item">
                        <a href="#carousel__slide3" class="carousel__navigation-button">Go to slide 4</a>
                    </li>
                </ol>
            </aside>
        </section>
            
        <div class="nextP">
            <div class="btn">
                <a href="javascript:nextPage()"><img src="img/arrow-right.svg"></a>
            </div>
        </div>
    </body>
</html>
