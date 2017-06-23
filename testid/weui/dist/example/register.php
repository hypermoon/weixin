<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <link rel="stylesheet" href="../style/weui.css"/>
    <link rel="stylesheet" href="./example.css"/>
    <title> 参会注册 </title>
    <script>
     function returnback()
     {
          //window.history.back(-1);
          window.location.href='meeting.html';
     }
    </script>
</head>

<body>
    <p>
    <br/>
         <label for="" class="weui-label">微信参会注册</label>
    <br/>
    <br/>

    <p/>
    <hr/>
    <br/>
      <form action="savereg.php" method="post">
                <div class="weui-cell__hd"><label class="weui-label">* 姓名:</label></div>
             </br>
                <div class="weui-cell__bd">
                    <input class="weui-input" name="name" type="text" border="1" placeholder="请输入名字"/>
                </div>
             </br>
                <div class="weui-cell__hd"><label class="weui-label" width ="50">* 手机号码:</label></div>
             </br>
                <div class="weui-cell__bd">
                    <input class="weui-input" name="mobile" type="number" border="1" pattern="[0-9]*" value="<?php echo $_GET['mobile']; ?>"/>
                </div>
             </br>
                <div class="weui-cell__hd"><label class="weui-label">职务:</label></div>
             </br>
                <div class="weui-cell__bd">
                    <input class="weui-input" name="title" type="text" border="1"  placeholder="可不填"/>
                </div>
             </br>
                <div class="weui-cell__hd"><label class="weui-label">备注:</label></div>
             </br>
                <div class="weui-cell__bd">
                    <input class="weui-input" name="remark" type="text" border="1"  placeholder="可不填"/>
                </div>
             </br>
             </br>
                   <label class="wegui-label">*为必填项 </label>
             </br>
              <input type="submit" class="weui-btn weui-btn_primary" value="注册签到">
             </form>

             </br>

     <div>
        <a href="javascript:returnback()" class="weui-btn weui-btn_primary">返回 </a> 
     </div>
</body>
</html>
<!--
    <div class="weui-cell__hd">

    <div class="weui-cell__hd">
-->
