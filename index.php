<?php
    // Acquire global data
    require_once("includes/common.php");
?>
<!doctype html>
<!--
    Site Version: 0.1.7.3
-->
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $aCName; ?> - Home</title>
    <?php require_once("includes/head.php"); ?>
</head>
<body>
    <?php require_once("includes/header.php"); ?>
    <main>
    	<section id="boxMenu">
	        <h1>Featured Content</h1>
            <div id="webDevAd"><h3>Web Development</h3><p>Check out the web development articles.</p></div>
            <div id="digitalMediaAd"><h3>Digital Media</h3><p>Check out the digital media articles.</p></div>
            <div id="programmingAd"><h3>Programming</h3><p>Check out the programming articles.</p></div>
        </section>
        <section id="latestNews">
            <h1>Latest News</h1>
            <?php
            // Acquire the articles under the page's category
			$getAllPageArticlesQuery = "SELECT * FROM article_category_tbl WHERE categoryID = 5 ORDER BY articleID DESC LIMIT 1";
            $getAllPageArticlesResults = mysqli_query($dbc, $getAllPageArticlesQuery);
            while($getAllPageArticlesRow = mysqli_fetch_array($getAllPageArticlesResults))
            {
                $articleID = $getAllPageArticlesRow['articleID'];
                $getCurrentArticleQuery = "SELECT * FROM article_tbl where articleID = $articleID";
                $getCurrentArticleResult = mysqli_query($dbc, $getCurrentArticleQuery);
                $getCurrentArticleRow = mysqli_fetch_array($getCurrentArticleResult);
                echo '        <article>
            <h2><a href="articles.php?a=' . $getCurrentArticleRow['articleID'] . '" title="' . $getCurrentArticleRow['articleTitle'] . '">' . $getCurrentArticleRow['articleTitle'] . '</a></h2>
			<div class="articleInfo">
                ';
				// Get category information
				$getCategoryQuery = "SELECT * FROM category_tbl WHERE categoryID = 5";
				$getCategoryResult = mysqli_query($dbc, $getCategoryQuery);
				$getCategoryRow = mysqli_fetch_array($getCategoryResult);
				// Convert the default MySQL date format to a regular human-readable format
				$dateAdded = date("d/m/Y", strtotime($getCurrentArticleRow['dateAdded']));
				echo '<time class="postDate" datetime="' . $getCurrentArticleRow['dateAdded'] . '"><a href="articles.php?d=' . $getCurrentArticleRow['dateAdded'] . '" title="Published on ' . $dateAdded . '">' . $dateAdded . '</a></time>
                <span class="category"><a href="articles.php?c=' . $getCategoryRow['categoryID'] . '" title="' . $getCategoryRow['categoryDescription'] . '">' . $getCategoryRow['categoryName'] . '</a></span>
                <span class="tag">';
				$getAllTagsQuery = "SELECT tagID FROM article_tag_tbl WHERE articleID = $articleID";
                $getAllTagsResults = mysqli_query($dbc, $getAllTagsQuery);
				$numTags = mysqli_num_rows($getAllTagsResults);
				while($getAllTagsRow = mysqli_fetch_array($getAllTagsResults))
                {
                    $tagID = $getAllTagsRow['tagID'];
                    $getIndividualTagQuery = "SELECT * FROM tag_tbl WHERE tagID = $tagID";
                    $getIndividualTagResult = mysqli_query($dbc, $getIndividualTagQuery);
                    while($getIndividualTagRow = mysqli_fetch_array($getIndividualTagResult))
                    {
                        echo '<a href="articles.php?t=' . $getIndividualTagRow['tagID'] . '" title="' . $getIndividualTagRow['tagDescription'] . '">' . $getIndividualTagRow['tagName'] . '</a>';
                        if ($numTags > 1)
                        {
                            echo ', ';
                        }
                        $numTags--;
                    }
                }
                echo '</span>
            </div>
            ' . $getCurrentArticleRow['articleContent'] . '
        </article>';
            }         
        ?>
        </section>
    </main>
    <?php require_once("includes/footer.php"); ?>
</body>
</html>