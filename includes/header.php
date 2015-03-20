<?php
echo '<header id="pageHeader">
        <a id="top"></a>
		<span>' . $fCName .'</span>
        <nav id="mainNavMenu">
            <ul>
                <li><a href="index.php" title="The Homepage">Home</a></li>
                <li><a href="webdev.php" title="The Web Development Section">Web Development</a></li>
                <li><a href="media.php" title="The Digital Media Asset Production Section">Digital Media</a></li>
                <li><a href="programming.php" title="The Software Programming Section">Programming</a></li>
                <li><a href="other.php" title="The Additional Topics">Other</a></li>
                <li><a href="news.php" title="News on this Website">Website News</a></li>
            </ul>
        </nav>
        <div id="breadcrumbs">
            <ul>
                <li class="search">
                    <form id="searchBar" method="get" action="search.php">
                    <input type="text" id="searchInput" name="s" size="30" maxlength="120" placeholder=" Search ' . $aCName . '&#8217;s Articles">
                    <input type="submit" value="Search" class="btn">
                    </form>
                </li>
            </ul>
        </div>
    </header>
';