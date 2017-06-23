<?php


		/*$dbconn = pg_connect("host=localhost dbname=WlMonitor user=postgres password=pgsql123 port=5432")
			or die('Could not connect: ' . pg_last_error());
			
		$id_sql = "select max(id) as m_id from water_monitor";
		$result = pg_query($id_sql) or die('Query failed: ' . pg_last_error());
		$val = pg_fetch_array($result);
		echo $val['m_id']+1; 
                echo "\r\n";
                echo "end";
                exit;*/


		// 执行 SQL 查询
		//$query = 'SELECT * FROM water_monitor';
		//$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		
		//$query = "update water_monitor set site='test123321' where id=1";
		//$result = pg_query($query) or die('Query failed: ' . pg_last_error());
 
               $varmb = $_POST["mobile"];
               //echo $varmb;
               //exit;		
               $strmb = strval($varmb);  
              
               $dbconn = pg_connect("host=localhost dbname=meeting user=postgres password=pgsql123 port=5432") or die('Could not connect: ' . pg_last_error());
			
		$id_sql = "select *  from tbl_peopleinfo where mobile= '$strmb'";
		$result = pg_query($id_sql) or die('Query failed: ' . pg_last_error());
                
              
        	$val = pg_fetch_row($result);
                
               // echo $val[1];
              
               if($val==false)          //no this mobile,need register
               {
                      header("Location: register.php?mobile=$strmb");
                      echo "it is false\r\n";
               }
               else                     // mobile registed, need confirm sign into db
               {
                   //   $vals = json_encode($val);
                   //   $urls = "ok.php";
     


                // $mobile = $_GET["mobile"];
                // $name = $_GET["name"];
     

             // $dbconn = pg_connect("host=localhost dbname=meeting user=postgres password=pgsql123 port=5432") or die('Could not connect: ' . pg_last_error());
                  $rec_sqls = "insert into tbl_signrecord (mobile,name,signtime) VALUES ('$val[1]','$val[0]',now());";
                  $result = pg_query($rec_sqls) or die('Query failed: ' . pg_last_error());


                  header("Location: ok.php?mobile=$val[1]&name=$val[0]&title=$val[2]");
                      echo "it exists!\r\n";
               }
                

               echo "end"."\r\n";
               
                // echo $id_sql; 
                // echo $val;
                // echo "\r\n";
                // echo $val['m_num']."\r\n";
                // exit;
	        // echo $result;


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
