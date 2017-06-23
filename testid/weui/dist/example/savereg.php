<?php

//               var_dump($_POST) ;

               $varmb = $_POST["mobile"];
               
               $strmb = strval($varmb);  

               $name = $_POST["name"];
               $title = $_POST["title"];
               $remark = $_POST["remark"];
              
               $dbconn = pg_connect("host=localhost dbname=meeting user=postgres password=pgsql123 port=5432")or die('Could not connect: ' . pg_last_error());
	
              $id_sqls = "insert into tbl_peopleinfo VALUES ('$name','$strmb','$title','$remark');";
         		
                                           	//	$id_sqls = "select *  from tbl_peopleinfo where mobile= '$strmb'";
	      //添加记录	
              $result = pg_query($id_sqls) or die('Query failed: ' . pg_last_error());
                  

              $rec_sqls = "insert into tbl_signrecord (mobile,name,signtime) VALUES ('$strmb','$name',now());";
              $rec_result = pg_query($rec_sqls) or die('Query failed: ' . pg_last_error());
	
                
              header("Location: ok.php?mobile=$strmb&name=$name&title=$title");
              
                
              
          /*     if($val==false)          //no this mobile,need register
               {
                      header("Location: register.php");
                      echo "it is false\r\n";
               }
               else                     // mobile registed, need confirm sign into db
               {
                      $vals = json_encode($val);
                      $urls = "ok.php";
                //      http_post_json($urls,$vals);
     
                      header("Location: ok.php?mobile=$val[2]&name=$val[1]&title=$val[3]");
                      echo "it exists!\r\n";
               }*/
                

               echo "endok"."\r\n";
               


     /*           function http_post_json($url, $jsondata)
                {
                       $ch = curl_init();
                       curl_setopt($ch, CURLOPT_POST,1);
                       curl_setopt($ch, CURLOPT_URL,$url);
                       curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);
                       curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                       curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                   'Content-Type: application/json; charset=utf-8',
                                   'Content-Length:'.strlen($jsondata)
                                    )
                        );
                       $response =curl_exec($ch);

                //      $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                  //    return array($httpCode, $response);

                 }
        */    

?>
