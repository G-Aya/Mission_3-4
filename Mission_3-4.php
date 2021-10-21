 <?php
        /* 変数定義*/
        $filename="Mission_3-4.txt";
        
        if(empty($_POST["name"]) === false && empty($_POST["comment"]) === false){
        $name = $_POST["name"];
        $comment =$_POST["comment"];
        $date =date("Y/m/d H:i:s");
     
        if(empty($_POST["edit"])){
        
             if(file_exists($filename)){
             $strs = file($filename,FILE_IGNORE_NEW_LINES);
              /* ファイルが存在するときは行番号に一加えていく*/
        /* ファイルが存在しないときは行番号を一から始める*/
        
             foreach($strs as $str){
             $log = explode("<>",$str);
             $number = $log[0]+1;
             }
        }else {
            $number =1;
        }    
            $str = "$number<>$name<>$comment<>$date";
                 $fp = fopen($filename,"a");
                 fwrite($fp, $str.PHP_EOL);
                 fclose($fp);
                 
            }else {
                $strs = file($filename);
                // $str = $number. "<> ". $name."<> " .$comment."<> " .$date;
                $fp = fopen($filename , "w");
                foreach($strs as $str){
                   $log = explode("<>",$str);
                   if($log[0] === $_POST["edit"]){
                      $edit = $_POST["edit"];
                       fwrite($fp,"$edit<>$name<>$comment<>$date". PHP_EOL);
                   }else {
                       fwrite($fp,$str);
                   }
                }
                   fclose($fp);
            }
        
        
        
         /*削除番号の指定がある場合*/
         }
         
         if(empty($_POST["dnum"]) == false){
         $delete = $_POST["dnum"];    
         $strs = file($filename,FILE_IGNORE_NEW_LINES);
         $fp = fopen($filename,"w");
            foreach($strs as $str){
             $log = explode("<>",$str);
             $com = $log[0];
             if($com != $delete){
             fwrite($fp, $str.PHP_EOL);
          }
         }
         fclose($fp); 
        
     }    
     /*編集選択のとき*/
    if(isset($_POST["enum"])){
        $enum = $_POST["enum"];
        $edit = $_POST["edit"];
        $strs = file($filename,FILE_IGNORE_NEW_LINES);
         
            foreach($strs as $str){
             $log = explode("<>",$str);
             $com = $log[0];
             if($com === $enum){
                 $esub = $_POST["esub"];
                 $editnumber = $log[0];
                 $editname = $log[1];
                 $editcomment =$log[2];
             }
             } 
           
    }
 /*表示*/
                $strs = file($filename);
                 if(file_exists($filename)){
                 foreach($strs as $str){
                     $log = explode("<>",$str);
                     echo $log[0] . " " . $log[1] . " " . $log[2] . " " . $log[3] ;
                     echo "<br>";
                    
                 
        }    
    }
                 
        ?>
        <!DOCHTYPE html>
<html lang="ja">
    <head>
       <meta charset="utf-8"
       <title>Mission_3-4</title>
    </head>
    <body>
        <!--送信フォーム-->
        <form action="" method="post">
          <input type="text" name="name" 
          value= "<?php if (empty($_POST["esub"])===false)
          { echo $editname;} 
          else { echo "名前";}?>">
          <input type="text" name="comment" 
          value="<?php if (empty($_POST["esub"])===false)
          { echo $editcomment;} 
          else {echo "コメント";}?>">
          <input type = "number" name = "edit"　
          value="<?php if (empty($_POST["esub"])===false)
          { echo $editnumber;} ?>">
          <input type="submit" name="submit" value="送信">
          
          <br>
        </form>
        <form action="" method="post">
          <input type="number" name="dnum" place holder = "削除番号">
          <input type="submit" name="submit" value="削除">
        </form>
        <form action = " " method = "post"> 
        <input type = "number" name = "enum" place holder = "編集番号">
        <input type = "submit" name = "esub" value = "編集">
        </form>
    </body>
</html>