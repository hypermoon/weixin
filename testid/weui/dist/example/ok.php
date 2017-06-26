<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <link rel="stylesheet" href="../style/weui.css"/>
    <link rel="stylesheet" href="./example.css"/>
    <title> 签到成功 </title>
    <script>
     function returnback()
     {
          //window.history.back(-1);
          window.location.href='meeting.html';
     }
    </script>
</head>


<body>
    <br/>
         <label for="" class="weui-cells__title">微信签到体验</label>
    <br/>
    <br/>
    <p>
         <div align="center">
         <label for="" class="weui-label"><h3>签到成功!</h3></label>
         </div>
    <p/>
    <div class="weui-cell__hd">
         <div class="weui-cell">
         <label for="" class="weui-label">姓名:</label>
         <label for="" class="weui-label"><?php echo $_GET["name"]; ?> </label>
         </div> 
       <br/>
         <div class="weui-cell">
         <label for="" class="weui-label">手机号:</label>
         <label for="" class="weui-label"><?php echo $_GET["mobile"]; ?> </label>
         </div>  
      <br/>
         <div class="weui-cell">
         <label for="" class="weui-label">职务:</label>
         <label for="" class="weui-label"><?php echo $_GET["title"]; ?> </label>
         </div> 
       <br/>
    </div>

     <div>
        <a href="javascript:returnback()" class="weui-btn weui-btn_primary">返回 </a> 
     </div>
</body>
</html>
<!--
    <div class="weui-cell__hd">

    <div class="weui-cell__hd">
-->
