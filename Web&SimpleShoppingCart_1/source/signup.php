<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sign Up</title>
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
                display: flex;
                justify-content: center;
                align-items: center;
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
                display: inline-block;
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
            .contain form{
                width:100%;
                height:100%;
            }
            .inputBlock{
                width:100%;
                clear: both;
                display: flex;
                justify-content: center;
                align-items: center;
                margin: auto;
            }
            .column{
                height:25%;
            }
            .btn{
                height:25%;
            }
            .inputColumn{
                height:8vh;
                width: 50%;
                border-radius: 10px;
                font-size: 3rem;
            }
            .submitBtn{
                height:5vh;
                width:20%;
                border-radius: 5px;
                font-size: 2rem;
            }
        </style>
    </head>
    <body>
        <div class="main">
            <div class="contain">
                <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                    <div class="inputBlock column">
                        <input type="text" name="account" placeholder="account" class="inputColumn">
                    </div>
                    <div class="inputBlock column">
                        <input type="text" name="password" placeholder="password" class="inputColumn">
                    </div>
                    <div class="inputBlock column">
                        <input type="text" name="nickname" placeholder="nickname" class="inputColumn">
                    </div>
                    <div class="inputBlock btn">
                        <input type="submit" name="submitButton" value="Login" class="submitBtn">
                    </div>
                    <?php
                        if(isset($_POST['submitButton'])){
                            $account=$_POST['account'];
                            $password=$_POST['password'];
                            $nickname=$_POST['nickname'];
                                   
                            $connect=@new mysqli('localhost', 'root', "");
                            $connect->select_db("final_project");
                            $connect->set_charset("utf8");
                                  
                            $commend="SELECT * FROM member WHERE account='$account'";
                            $result=$connect->query($commend);
                            $row=$result->fetch_row();
                            if(empty($row)){
                                $result->free();
                                $commend="INSERT INTO member SET account ='$account', password='$password', nickname='$nickname'";
                                $connect->query($commend);
                                ob_start();
                                setcookie("account", $account, time()+86400);
                                setcookie("nickname", $nickname, time()+86400);
                                echo "<script language='javascript'>location.href='intersection.php'</script>";
                                ob_end_flush();
                            }else{
                                echo "<script>alert('???????????????'); location.href = 'signup.php';</script>";
                            }
                        }
                    ?>
                </form>
            </div>
        </div>
        <div class="foot">
            <div class="back">
                <a href="index.php"><img src="img/back.svg"></a>
            </div>
        </div>
    </body>
</html>
