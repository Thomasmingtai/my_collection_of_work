<!DOCTYPE html>
<?php 
    $customerOrder=unserialize($_COOKIE['customerOrder']);
    $productQuality=(count($customerOrder)-1)/2;
    $order=array();
    $orderAdd=[];
    $real=0;
    for($i=1;$i<count($customerOrder);$i+=2){
        $isexist=false;
        for($j=0;$j<$real;$j++){
            if($order[$j][0]==$customerOrder[$i]){
                $order[$j][1]+=$customerOrder[$i+1];
                $isexist=true;
                break;
            }
        }
        if($isexist){
            continue;
        }
        $orderAdd[0]=$customerOrder[$i];
        $orderAdd[1]=$customerOrder[$i+1];
        $order[$real]=$orderAdd;
        $real++;
    }
    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Send Order</title>
        <style>
            *{
                padding: 0px;
                margin: 0px;
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
                padding: 5%;
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
            .forward{
                height: 100%;
                width: 100px;
                position:absolute;
                right: 0;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .forward img{
                height: 50%;
                width: 50%;
                opacity: .4;
            }
            .forward a{
                padding-right: 25px;
            }
            .forward img:hover{
                opacity: 1;
            }
        </style>
        <script>
            function minus(number, money){
                var Id="orderQuality"+number;
                if(parseInt(document.getElementById(Id).value) >0){
                    var quallity=parseInt(document.getElementById(Id).value)-1;
                    document.getElementById(Id).value=quallity;
                    changeSum(number, money);
                }
            }
            function plus(number, money){
                var Id="orderQuality"+number;
                var quallity=parseInt(document.getElementById(Id).value)+1;
                document.getElementById(Id).value=quallity;
                changeSum(number, money);
            }
            function changeSum(number, money){
                var Id="orderQuality"+number;
                var Dv="Dv"+number;
                var quallity=parseInt(document.getElementById(Id).value);
                document.getElementById(Dv).innerHTML="總價 $"+(quallity*money);
            }
        </script>
    </head>
    <body>
        <div class="main">
            <div class="contain">
                <form action="<?php $_SERVER['PHP_SELF']?>" method="get" style="height:100%;">
                    <div style="width:100%; height:  80%; overflow-y:scroll; background-color: #8854ab;">
                        <table style="width:100%; border-collapse: collapse;">
                            <?php
                                $connect=new mysqli('localhost', 'root', "");
                                $connect->select_db("final_project");
                                $connect->set_charset("utf8");
                                for($k=0;$k<$real;$k++){
                                    $commend="SELECT * FROM products WHERE id='".$order[$k][0]."'";
                                    $result=$connect->query($commend);
                                    $row=$result->fetch_row();
                                    $result->free();
                                    if(($k%2)!=0){
                                        echo "<tr style='height: 10px; background-color: #bfacb5;'>";
                                    }else{
                                        echo "<tr style='height: 10px; background-color: #7f7b82;'>";
                                    }
                                    echo "<td style='width:40%;'><input type='hidden' name='item".$k."' value='{$row[0]}'><p>".$row[1]."</p></td>";
                                    echo "<td style='width:20%;'><p>單價 $".$row[4]."</p></td>";
                                    echo "<td style='width:20%;'>"
                                           . "<input type='button' value='-' onclick='minus(".$k.",".$row[4].");' style='width:10%;'>
                                              <input type='text' name='orderQuality".$k."' id='orderQuality".$k."' oninput='changeSum(".$k.", ".$row[4].");' value='".$order[$k][1]."' style='width:75%;'  >"
                                            . "<input type='button' value='+' onclick='plus(".$k.",".$row[4].");' style='width:10%;'></td>";
                                    echo "<td style='width:20%;'><div id='Dv".$k."'>總價 $".$row[4]*$order[$k][1]."</div></td>";
                                    echo "</tr>";
                                }

                            ?>
                        </table>
                    </div>
                    <div  align="right">
                        <input name="submitOrder" type="submit" value="結帳" style="width: 80px;font-size: 1.5rem"/>
                    </div>
                </form>
                <?php 
                    if(isset($_GET['submitOrder'])){
                        $commend="SELECT * FROM member WHERE account ='{$_COOKIE['account']}'  ; ";
                        $result=$connect->query($commend);
                        $row=$result->fetch_row();
                        $result->free();
                        $commend="INSERT INTO ordercontent SET orderMember ='{$row[0]}';";
                        $connect->query($commend);
                        $commend="select id from ordercontent where orderMember ='{$row[0]}' order by id desc ; ";
                        $result=$connect->query($commend);
                        $row=$result->fetch_assoc();
                        $order=$row["id"];
                        $result->free();
                        for($l=0; $l<$real; $l++){
                            $commend="INSERT INTO orderlist SET id ='".$order."', productId ='".$_GET['item'.$l]."', quality='".$_GET['orderQuality'.$l]."'";
                            $connect->query($commend);
                        }
                            
                        $connect->close();
                        echo "<script language='javascript'>location.href='back.php'</script>";
                    }
                ?>
            </div>
        </div>
        <div class="foot">
            <div class="back">
                <a href="shoppingCart.php"><img src="img/back.svg"></a>
            </div>
        </div>
    </body>
</html>