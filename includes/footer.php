<?php
echo '<footer id="pageFooter">
        <div id="footerMenus">
            <div class="footerBox">
                <h3>Categories</h3>
                <ul>
					';
				$getAllCategoriesQuery = "SELECT * FROM category_tbl";
                $getAllCategoriesResults = mysqli_query($dbc, $getAllCategoriesQuery);
				$numCategories = mysqli_num_rows($getAllCategoriesResults);
				while($getAllCategoriesRow = mysqli_fetch_array($getAllCategoriesResults))
                {
                    echo'<li><a href="articles.php?c=' . $getAllCategoriesRow['categoryID'] . '" title="' . $getAllCategoriesRow['categoryDescription'] . '">' . $getAllCategoriesRow['categoryName'] . '</a></li>';
					if ($numCategories > 1)
					{
						echo '
					';
					}
					else {
						echo '
				';
					}
					$numCategories--;
                }
                echo '</ul>
            </div>
			<div class="footerBox">
                <h3>Tags</h3>
                <ul>
					';
				$getAllTagsQuery = "SELECT * FROM tag_tbl";
                $getAllTagsResults = mysqli_query($dbc, $getAllTagsQuery);
				$numTags = mysqli_num_rows($getAllTagsResults);
				while($getAllTagsRow = mysqli_fetch_array($getAllTagsResults))
                {
                    echo'<li><a href="articles.php?t=' . $getAllTagsRow['tagID'] . '" title="' . $getAllTagsRow['tagDescription'] . '">' . $getAllTagsRow['tagName'] . '</a></li>';
					if ($numTags > 1)
					{
						echo '
					';
					}
					else {
						echo '
				';
					}
					$numTags--;
                }
                echo '</ul>
            </div>
            <div class="footerBox">
                <h3>Recent Articles</h3>
                <ul>
					';
				$getRecentArticlesQuery = "SELECT articleID, articleTitle, dateAdded FROM article_tbl ORDER BY articleID DESC LIMIT 5";
                $getRecentArticlesResults = mysqli_query($dbc, $getRecentArticlesQuery);
				$numArticles = mysqli_num_rows($getRecentArticlesResults);
				while($getRecentArticlesRow = mysqli_fetch_array($getRecentArticlesResults))
                {
                    echo'<li><a href="articles.php?a=' . $getRecentArticlesRow['articleID'] . '" title="Published on ' . $getRecentArticlesRow['dateAdded'] . '">' . $getRecentArticlesRow['articleTitle'] . '</a></li>';
					if ($numArticles > 1)
					{
						echo '
					';
					}
					else {
						echo '
				';
					}
					$numArticles--;
                }
                echo '</ul>
            </div>
            <div class="footerBox">
                <h3>Resources</h3>
                <ul>
                    <li><a href="https://shastri.me" title="Return to the Main Site">Return to the Main Site</a></li>
                    <li><a href="articles.php" title="View all published articles">All Published Articles</a></li>
					<li><a href="aboutus.php" title="Learn about this website">About Us</a></li>
                </ul>
            </div> 
        </div>
        <div id="toTop">
            <a href="#top">Back to Top</a>
        </div>
        <div id="copy">
            &copy; 2015 Shastri Harrinanan
        </div>
    </footer>
';