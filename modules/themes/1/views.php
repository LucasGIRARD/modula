<header>
    <img src='theme/default/image/banniere.jpg' alt='bannière' />
    <div>
        <?php echo $site[ 'headingTitle']; ?>
    </div>
</header>
<br />
<div>
    <?php echo $menu; ?>
</div>
<br />
<div id='content'>
    <?php include $page; ?>
</div>
<br />
<br />
<footer>
    <div class="leftColumn3">
        <?php echo $site[ 'footerCopyright']; ?>
    </div>
    <div class="middleColumn3">
        <a href="http://validator.w3.org/check?uri=referer">
            <img src="theme/default/image/valid-html5-blue-v.png" alt="Valid XHTML 1.1" height="22" />
        </a>
        <a href="http://jigsaw.w3.org/css-validator/check/referer">
            <img style="border:0;height:22px" src="http://www.w3.org/Icons/valid-css-blue.gif" alt="CSS Valide !" />
        </a>
    </div>
    <div class="rightColumn3"><a href="#">remonter</a>
    </div>
</footer>