<?php
    // Acquire global data
    require_once("includes/common.php");

    // Acquire pagination data
    require_once("includes/pagination-variables.php");
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $aCName; ?> - Programming</title>
    <?php require_once("includes/head.php"); ?>
</head>
<body>
    <?php require_once("includes/header.php"); ?>
    <main>
        <section id="programmingArticles">
        <h1>Programming Articles</h1>
<?php
            $categoryID = 3;
            // Acquire the articles under the page's category
			$getAllPageArticlesQuery = "SELECT * FROM article_category_tbl WHERE categoryID = $categoryID ORDER BY articleID DESC";
            $getAllPageArticlesResultsOriginal = mysqli_query($dbc, $getAllPageArticlesQuery);

            // Acquire the articles under the page's category
            $getAllPageArticlesQuery .= " LIMIT $skip, $limit";
            $getAllPageArticlesResults = mysqli_query($dbc, $getAllPageArticlesQuery);
            echo '        <p>There are ' . mysqli_num_rows($getAllPageArticlesResultsOriginal) . ' Programming articles (5 articles per page).</p>';
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
				$getCategoryQuery = "SELECT * FROM category_tbl WHERE categoryID = $categoryID";
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
            // Add pagination
            $i = ceil(mysqli_num_rows($getAllPageArticlesResultsOriginal)/5);
            $j = 1;
            $k = 0;
            $set = false;
            if($i > 1) {
                echo '<div id="paginationLinks">
                                <ul>
                                    ';
                while($i > 0) {
                    echo '<li><a href="' . $currentFile;
                    if($j === (($skip + $limit) / $limit)) {
                        $set = true;
                    } else {
                        // reset the current link checker
                        $set = false;
                    }
                    if($k !== 0) {
                        echo '?s=' . $k;
                    }
                    echo '" title="Go to page ' . $j . '"';
                    if($set === true) {
                        echo $currentPage;
                    }
                    echo '>' . $j . '</a></li>' . "\n";
                    $i--;
                    $j++;
                    if($k < mysqli_num_rows($getAllPageArticlesResultsOriginal)) {
                        $k+=5;
                    }
                }
                echo '</ul></div>';
            }
        ?>
        </section>
    </main>
    <?php require_once("includes/footer.php"); ?>
</body>
</html>