<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <title>Wilford Brimley Outlasted</title>
        <link rel="stylesheet" href="lib/css/style.css" />
		<!—[if lt IE 7]>
  		<link rel="stylesheet" type="text/css" href="lib/css/ie6.css" />
		<![endif]—>
		
        <script type="text/javascript" src=<JQUERY LINK>></script>
        <script type="text/javascript" src=<QTIP LINK>jquery.qtip-1.0.0-rc3.min.js"></script>
        <script type="text/javascript" src="lib/js/wbol.js"></script>
        
    </head>

    <body>
        <div id="container">
            <div id="header">
                <h1 wtf="mate">I want to play!</h1>
            </div>
            <?php
                include 'lib/functions/makerich.php';
                $term = urlencode("#wbol");
                $pattern = "/http:\/\/\S+/";
                $rpp = 3;
                if(!isset($_GET['pg']))
                    {
                        $page = 1;
                    } else {
                        $page = $_GET['pg'];
                    }
                $surl = 'http://search.twitter.com/search.json';

                // build the query
                $json = file_get_contents($surl. "?q=" .$term. "&rpp=" .$rpp. "&page=" .$page);
                $root = json_decode($json);
                printf("<h2>Tweet your own <a href='http://twitter.com/home?status=%s '>%s</a><h2>",$term, urldecode($term));
                // cheap pag
                $page = $page + 1;
                if($page > 2)
                {
                    echo "<a id='pagination' href='" .$_SERVER['PHP_SELF']. "?pg=" .($page - 2). "'>Prev</a> -- ";
                }
                if(isset($root->next_page))
                {
                echo " <a id='pagination' href='" .$_SERVER['PHP_SELF']. "?pg=" .$page. "'>Next</a>\n";
                }
                // loop through the messages
                foreach($root->results as $r)
                {
                    $text = $r->text;
                    $text = makeRich($text);
                    $pic = $r->profile_image_url;
                    $fromName = $r->from_user;
                    $fromProfile = "http://twitter.com/" .$r->from_user;
                    printf("<div id='msg'><a href='%s'><img src='%s' /><br />\n%s</a><h4>Wilford Brimley outlasted %s</h4>\n</div>\n", $fromProfile, $pic, $fromName, $text);
                }
                //$page = $page + 1;
                if(isset($root->next_page))
                {
                echo "<a href='" .$_SERVER['PHP_SELF']. "?pg=" .$page. "'>Next</a>";
                }
                //echo "<pre>";
                //var_dump($root);
                //echo "</pre>";
            ?>
			
        </div> <!-- end of container -->
		<div class="clearfooter"></div>
		<?php require 'lib/includes/footer.inc.php' ?>
    </body>
</html>
