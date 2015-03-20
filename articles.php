<?php
    // Acquire global data
	require_once('includes/common.php');
	
	// Connect to the database
	require_once('includes/common.php');
	
    // Variable to track if a specific article was requested
	$check = 0;
	$articleID;
	$categoryID;
	$tagID;
	$getArticleRow;
	
	if(empty($_GET['a']) && empty($_GET['c']) && empty($_GET['t']))
	{
		$check = 1;
	}
	else if(!empty($_GET['a']))
	{
		$articleID = mysqli_real_escape_string($dbc, trim($_GET['a']));
		$getArticleQuery = "SELECT * FROM article_tbl WHERE articleID = $articleID";
		$getArticleResult = mysqli_query($dbc, $getArticleQuery);
		$getArticleRow = mysqli_fetch_array($getArticleResult);
	}
	else if(!empty($_GET['c']))
	{
		$categoryID = mysqli_real_escape_string($dbc, trim($_GET['c']));
		$getCategoryQuery = "SELECT * FROM category_tbl WHERE categoryID = $categoryID";
		$getCategoryResult = mysqli_query($dbc, $getCategoryQuery);
		$getCategoryRow = mysqli_fetch_array($getCategoryResult);
	}
	else if(!empty($_GET['t']))
	{
		$tagID = mysqli_real_escape_string($dbc, trim($_GET['t']));
		$getTagQuery = "SELECT * FROM tag_tbl WHERE tagID = $tagID";
		$getTagResult = mysqli_query($dbc, $getTagQuery);
		$getTagRow = mysqli_fetch_array($getTagResult);
	}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $aCName; ?> - About Us</title>
    <?php require_once("includes/head.php"); ?>
</head>
<body>
    <?php require_once("includes/header.php"); ?>
    <main>
        <section id="latestArticle">
    	<?php
			if($check === 1)
			{
				echo '<h1>Most Recent Article</h1>' . "\n";
				$latestArticleQuery = "SELECT * FROM article_tbl ORDER BY articleID DESC LIMIT 1";
				$latestArticleResult = mysqli_query($dbc, $latestArticleQuery);
				$latestArticleRow = mysqli_fetch_array($latestArticleResult);
				$articleID = $latestArticleRow['articleID'];
				$getArticleCategoryIDQuery = "SELECT categoryID FROM article_category_tbl WHERE articleID = $articleID";
				$getArticleCategoryIDResult = mysqli_query($dbc, $getArticleCategoryIDQuery);
				$getArticleCategoryIDRow = mysqli_fetch_array($getArticleCategoryIDResult);
				$categoryID = $getArticleCategoryIDRow["categoryID"];
				$getArticleCategoryQuery = "SELECT * FROM category_tbl WHERE categoryID = $categoryID";
				$getArticleCategoryResult = mysqli_query($dbc, $getArticleCategoryQuery);
				$getArticleCategoryRow = mysqli_fetch_array($getArticleCategoryResult);
				echo '        <article>
				<h2>' . $latestArticleRow['articleTitle'] . '</h2>
				<div class="articleInfo">
					';
					// Convert the default MySQL date format to a regular human-readable format
					$dateAdded = date("d/m/Y", strtotime($latestArticleRow['dateAdded']));
					echo '<time class="postDate" datetime="' . $latestArticleRow['dateAdded'] . '"><a href="articles.php?d=' . $latestArticleRow['dateAdded'] . '" title="Published on ' . $dateAdded . '">' . $dateAdded . '</a></time>
					<span class="category"><a href="articles.php?c=' . $getArticleCategoryRow['categoryID'] . '" title="' . $getArticleCategoryRow['categoryDescription'] . '">' . $getArticleCategoryRow['categoryName'] . '</a></span>
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
				' . $latestArticleRow['articleContent'] . '
			</article>'. "\n";
			}
			else if(!empty($_GET['a']))
			{
                echo '<h1>Article</h1>' . "\n";
				$getArticleCategoryIDQuery = "SELECT categoryID FROM article_category_tbl WHERE articleID = $articleID";
				$getArticleCategoryIDResult = mysqli_query($dbc, $getArticleCategoryIDQuery);
				$getArticleCategoryIDRow = mysqli_fetch_array($getArticleCategoryIDResult);
				$categoryID = $getArticleCategoryIDRow["categoryID"];
				$getArticleCategoryQuery = "SELECT * FROM category_tbl WHERE categoryID = $categoryID";
				$getArticleCategoryResult = mysqli_query($dbc, $getArticleCategoryQuery);
				$getArticleCategoryRow = mysqli_fetch_array($getArticleCategoryResult);
				echo '        <article>
				<h2>' . $getArticleRow['articleTitle'] . '</h2>
				<div class="articleInfo">
					';
					// Convert the default MySQL date format to a regular human-readable format
					$dateAdded = date("d/m/Y", strtotime($getArticleRow['dateAdded']));
					echo '<time class="postDate" datetime="' . $getArticleRow['dateAdded'] . '"><a href="articles.php?d=' . $getArticleRow['dateAdded'] . '" title="Published on ' . $dateAdded . '">' . $dateAdded . '</a></time>
					<span class="category"><a href="articles.php?c=' . $getArticleCategoryRow['categoryID'] . '" title="' . $getArticleCategoryRow['categoryDescription'] . '">' . $getArticleCategoryRow['categoryName'] . '</a></span>
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
				' . $getArticleRow['articleContent'] . '
			</article>';
			}
			else if(!empty($_GET['c']))
			{
				$getCategoryQuery = "SELECT categoryName FROM category_tbl WHERE categoryID = $categoryID";
				$getCategoryResult = mysqli_query($dbc, $getCategoryQuery);
				$getCategoryRow = mysqli_fetch_array($getCategoryResult);
				echo '<h1>' . $getCategoryRow['categoryName'] . '</h1>';
				// Get category information
				$getCategoryQuery = "SELECT * FROM category_tbl WHERE categoryID = $categoryID";
				$getCategoryResult = mysqli_query($dbc, $getCategoryQuery);
				$getCategoryRow = mysqli_fetch_array($getCategoryResult);
				// Acquire the articles under the page's category
				$getAllPageArticlesQuery = "SELECT * FROM article_category_tbl WHERE categoryID = $categoryID ORDER BY articleID DESC";
				$getAllPageArticlesResults = mysqli_query($dbc, $getAllPageArticlesQuery);
				while($getAllPageArticlesRow = mysqli_fetch_array($getAllPageArticlesResults))
				{
					$articleID = $getAllPageArticlesRow['articleID'];
					$getCurrentArticleQuery = "SELECT * FROM article_tbl where articleID = $articleID";
					$getCurrentArticleResult = mysqli_query($dbc, $getCurrentArticleQuery);
					$getCurrentArticleRow = mysqli_fetch_array($getCurrentArticleResult);
					echo '        <article>
				<h2>' . $getCurrentArticleRow['articleTitle'] . '</h2>
				<div class="articleInfo">
					';
					
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
			}
			else if(!empty($_GET['t']))
			{
				$getTagQuery = "SELECT tagName FROM tag_tbl WHERE tagID = $tagID";
				$getTagResult = mysqli_query($dbc, $getTagQuery);
				$getTagRow = mysqli_fetch_array($getTagResult);
				echo '<h1>' . $getTagRow['tagName'] . '</h1>';
				// Acquire the articles under the page's category
				$getAllPageArticlesQuery = "SELECT * FROM article_tag_tbl WHERE tagID = $tagID ORDER BY articleID DESC";
				$getAllPageArticlesResults = mysqli_query($dbc, $getAllPageArticlesQuery);
				while($getAllPageArticlesRow = mysqli_fetch_array($getAllPageArticlesResults))
				{
					$articleID = $getAllPageArticlesRow['articleID'];
					$getCurrentArticleQuery = "SELECT * FROM article_tbl where articleID = $articleID";
					$getCurrentArticleResult = mysqli_query($dbc, $getCurrentArticleQuery);
					$getCurrentArticleRow = mysqli_fetch_array($getCurrentArticleResult);
					echo '        <article>
				<h2>' . $getCurrentArticleRow['articleTitle'] . '</h2>
				<div class="articleInfo">
					';
					// Get category information
					$getCategoryIDQuery = "SELECT categoryID FROM article_category_tbl WHERE articleID = $articleID";
					$getCategoryIDResult = mysqli_query($dbc, $getCategoryIDQuery);
					$getCategoryIDRow = mysqli_fetch_array($getCategoryIDResult);
					$categoryID = $getCategoryIDRow['categoryID'];
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
			</article>' . "\n";
				}
			}
		?>
        </section>
    </main>
    <?php require_once("includes/footer.php"); ?>
</body>
</html>