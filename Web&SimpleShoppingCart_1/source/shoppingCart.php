<!DOCTYPE html>
<?php  //抓資料
    $connect=new mysqli('localhost', 'root', "");
    $connect->select_db("final_project");
    $connect->set_charset("utf8");
    $commend="SELECT id, productName, imgLink FROM products";
    $result=$connect->query($commend);
    $productList=[];
    $i=0;
    while($row=$result->fetch_row()){
        for($j=0; $j < count($row); $j++){
            $productList[$i][$j]=$row[$j];
        }
        $i++;
    }
    if(!isset($_COOKIE['customerOrder'])){
        $customerOrder = array("start");
        setcookie("customerOrder",serialize($customerOrder) , time()+86400);
    }else{
        if(isset($_GET['submitOrder'])){
            $customerOrder=unserialize($_COOKIE['customerOrder']);
            $addOrder= array($_GET['productId'], $_GET['orderQuality']);
            $customerOrder= array_merge($customerOrder,$addOrder);
            setcookie("customerOrder",serialize($customerOrder) , time()+86400);
        } 
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>shoppingCart</title>
        <style>
            body {
                margin: 0 auto;
                padding: 0 1.25rem;
            }

            * {
                box-sizing: border-box;
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
            .innerbox{
                width:100%;
                height:50%;
                display: flex;
                align-items: center;
                padding: 5px;
            }
            .item-box{
                width:25%;
                height:100%;
                margin-top: 10px;
                margin-left: 13px;
                margin-right: 13px;
                margin-bottom: 10px;
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
                backface-visibility: hidden;
                transform-style:preserve-3d;
                border: 1px solid #cccccc;
                border-radius: 10px;
                filter: drop-shadow(0 0 10px #0003);
            }
            .front{
                background-color: #d5bdaf;
                transform: rotateY(0deg);
            }
            .back{
                background-color: #e3d5ca;
                transform:rotateY(180deg);
            }
            .flip-box:hover .front{transform:rotateY(180deg);}
            .flip-box:hover .back{transform:rotateY(360deg);}
            .front img, .back img{
                width:50%;
            }
            .foot{
                width: 100vw;
                height: 10vh;
                position:absolute;
                bottom:0;
            }
            .backPage{
                height: 100%;
                width: 100px;
                position:absolute;
                left:0;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .backPage img{
                height: 50%;
                width: 50%;
                opacity: .4;
            }
            .backPage a{
                padding-left: 25px;
            }
            .backPage img:hover{
                opacity: 1;
            }
            .forwardPage{
                height: 100%;
                width: 100px;
                position:absolute;
                right: 0;
                display: inline-grid;
                justify-content: center;
                align-items: center;
            }
            .forwardPage img{
                height: 50%;
                width: 50%;
                opacity: .4;
            }
            .forwardPage a{
                padding-right: 25px;
            }
            .forwardPage img:hover{
                opacity: 1;
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
                location.href="shoppingCart.php"+hreff;
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
                <?php  //輸出
                    $page=(int)(count($productList)/8);
                    if((count($productList)%8)!=0)
                        $page=$page+1;
                    echo $page;
                    for($i=0; $i<$page; $i++){
                        $value="";
                        echo"<li id='carousel__slide".$i."' tabindex='0' class='carousel__slide'>";
                        for($j=0; $j<8; $j++){
                            if($j==0||$j==4){
                                echo"<div class='innerbox'>";
                            }
                            $m=($i*8)+$j;
                            echo"<div class='item-box'>
                                    <div class='flip-box'>
                                        <div class='front'><img src='".$productList[$m][2]."'></div>
                                            <div class='back'>
                                                <form method='get' action='productView.php'>
                                                    <input type='hidden' name='id' value='".$productList[$m][0]."'>"
                                                 . "<input type='submit' name='purchase' value='".$productList[$m][1]."'>
                                                </form>
                                            </div>
                                        </div>
                                    </div>";
                            if($j==3||$j==7){
                                echo"</div>";
                            }
                            if($i==$page-1&&$j==(count($productList)%8)-1){
                                break;
                            }
                        }
                        echo"</li>";
                    }
                ?>
            </ol>
        </section>
        <div class="nextP">
            <div class="btn">
                <a href="javascript:nextPage()"><img src="img/arrow-right.svg"></a>
            </div>
        </div>
        <div class="foot">
            <div class="backPage">
                <a href="intersection.php"><img src="img/back.svg"></a>
            </div>
            <div class="forwardPage">
                <a href="sendOrder.php"><img src="img/forward.svg"></a>
            </div>
        </div>
    </body>
</html>
