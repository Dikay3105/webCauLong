<?php
if(isset($_GET['control']))
$control = $_GET['control'];
$menu = '';
if($control=="IntroduceCategory") $menu='Introduce';
else if($control=="ContactCategory") $menu='Contact';
else if($control=="Cart") $menu='Cart';
else if($control=="checkDonHang") $menu='Order';
?>

<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">

        <a itemprop="item"><span itemprop="name"><?php echo $menu; ?></span></a>

        <meta itemprop="position" content="1">
        <span class="mr_lr">&nbsp;
</li>