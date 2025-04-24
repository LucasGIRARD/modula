<!DOCTYPE html>
<html>
    <head>
        <link type="text/css" rel='stylesheet' href='theme/default/style/default.css' />
		<script type="text/javascript" src="js/loading.js"></script>
        <title><?php echo $title; ?></title>
        <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34537753-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
    </head>
    <body>
        <header>            
            <img src='theme/default/image/banniere.jpg' alt='bannière' />
            <div>Développeur d'Applications</div>
        </header>
        <br />
        <nav>
            <?php include 'include/menu/index.php'; ?>
        </nav>
        <br />
        <div id='content'><?php include $content; ?></div>
        <br />
        <br />
        <footer>
            <div class="leftColumn3">© 2012 Lucas Girard - Tous droits réservés.</div><div class="middleColumn3">
                <a href="http://validator.w3.org/check?uri=referer"><img src="theme/default/image/valid-html5-blue-v.png" alt="Valid XHTML 1.1" height="22" /></a>
                <a href="http://jigsaw.w3.org/css-validator/check/referer"><img style="border:0;height:22px" src="http://www.w3.org/Icons/valid-css-blue.gif" alt="CSS Valide !" /></a>
            </div>
            <div class="rightColumn3"><a href="#" >remonter</a></div>
        </footer>
    </body>
</html>