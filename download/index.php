<html>
    <head>
        <title>Download</title>
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
                            $content = "$obj / $obj1 / $obj2";
                            $content .= "<ul>";
                            $dh3 = @opendir($obj . "/" . $obj1 . "/" . $obj2);
                            while (false !== ($obj3 = readdir($dh3) )) {
                                if ($obj3 == '.' || $obj3 == '..' || $obj3 == 'cgi-bin' || !preg_match("/\.zip$/", $obj3))
                                    continue;
                                else if (is_file($obj . "/" . $obj1 . "/" . $obj2 . "/" . $obj3)) {
                                    $content .= '<li><a href="dl.php?dl=' . $obj . "/" . $obj1 . "/" . $obj2 . "/" . $obj3 . '"' . ">$obj3</a></li>";
                                }
                            }
                            $content .= "</ul>";
                            $v = explode("_", $obj2);
                            $contentByVersion[$v[0]] = $content;
                            closedir($dh3);
                        }
                    }
                    $keys = array_keys($contentByVersion);
                    rsort($keys);
                    foreach ($keys as $value) {
                        echo $contentByVersion[$value];
                    }
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