<html>
    <head>
        <title>Documentation</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../bootstrap.min.css" rel="stylesheet" media="screen">
    </head>    
    <body>   
        <?php
        $dh = @opendir(".");
        while (false !== ($obj = readdir($dh) )) {
            if ($obj == '.' || $obj == '..' || $obj == 'cgi-bin')
                continue;
            else if (is_dir($obj)) {                
            $dh1 = @opendir($obj);
            while (false !== ($obj1 = readdir($dh1) )) {
                if ($obj1 == '.' || $obj1 == '..' || $obj1 == 'cgi-bin')
                    continue;
                else if (is_dir($obj . "/" . $obj1)) {
                    ?>
                    <legend>
                        <?= $obj . " / " . $obj1 ?>
                    </legend>
                    <?php
                    $contentByVersion = array();
                    $dh2 = @opendir($obj . "/" . $obj1);
                    while (false !== ($obj2 = readdir($dh2) )) {
                        if ($obj2 == '.' || $obj2 == '..' || $obj2 == 'cgi-bin')
                            continue;
                        else if (is_dir($obj . "/" . $obj1 . "/" . $obj2)) {
						
                            $content = "$obj / $obj1 / <a href='/doc/".$obj . "/" . $obj1 . "/" . $obj2."' target='_parent' onclick=\"window.parent.open(this.href, '_blank');return false\">$obj2</a><br>";
                            $v = explode("_", $obj2);
                            $contentByVersion[$v[0]] = $content;
                        }
                    }
                    $keys = array_keys($contentByVersion);
                    rsort($keys);
                    foreach ($keys as $value) {
                        echo $contentByVersion[$value];
                    }
					echo "<br>";
                    closedir($dh2);
                }
            }
            closedir($dh1);
        }
    }
    closedir($dh);
    ?>
</body>
</html>