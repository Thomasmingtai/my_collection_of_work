<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Product View</title>
        <style>
            * {
                padding: 0;
                margin: 0;
                box-sizing: border-box;
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
                display: flex;
            }
            .imgBox{
                width:50%;
                height:100%;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .textBox{
                width:50%;
                height: 90%;
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                margin: 40px;
                border: 5px #0003 dashed;
                padding: 30px;
            }
            .fix{
                clear: both;
            }
            .foot{
                width: 100vw;
                height: 10vh;
                position:absolute;
                bottom:0;
            }
            .back{
                height: 100%;
                width: 100px;
                position:absolute;
                left:0;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .back img{
                height: 50%;
                width: 50%;
                opacity: .4;
            }
            .back a{
                padding-left: 25px;
            }
            .back img:hover{
                opacity: 1;
            }
            
        </style>
        <script>
            function setvalue(){
                document.getElementById("orderQuality").value=0;
            };
            function minus(){
                if(parseInt(document.getElementById("orderQuality").value) >0){
                    document.getElementById("orderQuality").value=parseInt(document.getElementById("orderQuality").value)-1;
                }
            }
            function plus(){
                document.getElementById("orderQuality").value=parseInt(document.getElementById("orderQuality").value)+1;
            }
        </script>
    </head>
    <body onload="setvalue();">
        <?php 
            $id=$_GET['id'];
            $connect=new mysqli('localhost', 'root', "");
            $connect->select_db("final_project");
            $connect->set_charset("utf8");
            
            $commend="SELECT * FROM products WHERE id='$id'";
            $result=$connect->query($commend);
            $row=$result->fetch_row();
            $result->free();
            $connect->close();
            
        ?>
        <div class="main">
            <div class="contain">
                <div class="imgBox">
                    <img src="<?php echo$row[2];?>">
                </div>
                <div class="textBox">
                    <h1><?php echo$row[1];?></h1><br>
                    <h3>庫存量=><?php echo$row[5];?></h3><br>
                    <h3>價格=><?php echo$row[4];?></h3><br>
                    <p><?php echo$row[3];?></p>
                    <form method="get" action="shoppingCart.php">
                        <input type="button" value="-" onclick="minus();" style="width:25px;">
                        <input type="text" name="orderQuality" id="orderQuality" >
                        <input type="button" value="+" onclick="plus();" style="width:25px;">
                        <input type="hidden" name="productId" value="<?php echo$row[0];?>">
                        <br>
                        <input type="submit" value="加入購物車" name="submitOrder">
                    </form>
                </div>
            </div>
        </div>
        <div class="foot">
            <div class="back">
                <a href="shoppingCart.php"><img src="img/back.svg"></a>
            </div>
        </div>
    </body>
</html>
