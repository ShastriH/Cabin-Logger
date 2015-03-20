<?php
	// Acquire global data
	require_once('includes/common.php');
	
    // Variable to track if an operation was successful
	$check = 1;
	
    // If the URL does not contain a search term the user will be redirected to this page
	if(empty($_GET['s']))
	{
		$homeURL .= 'index.php';
		die(header('Location: ' . $homeURL));
	}
	else
	{
		$userSearchTerm = mysqli_real_escape_string($dbc, trim($_GET['s']));
	}
    // Acquire the sort setting
	if(empty($_GET['t']))
	{
		$sort = 1;
	}
	else
	{
		$sort = $_GET['t'];
	}

	// This function builds a search query from the search keywords and sort setting
	function buildQuery($userSearchTerm, $sort)
	{
		$searchQuery = "SELECT * FROM article_tbl";
		// Extract the search keywords into an array
		$cleanSearch = str_replace(',', ' ', $userSearchTerm);
		$searchWords = explode(' ', $cleanSearch);
		$finalSearchWords = array();
		if(count($searchWords) > 0)
		{
			foreach($searchWords as $word)
			{
				if(!empty($word))
				{
					$finalSearchWords[] = $word;
				}
			}
		}
		// Generate a WHERE clase using all of the search keywords
		$whereList = array();
		if(count($finalSearchWords) > 0)
		{
			foreach($finalSearchWords as $word)
			{
				$whereList[] = "articleTitle LIKE '%$word%'";
			}
		}
		$whereClause = implode(' OR ', $whereList);
		// Add the keyword WHERE clause to the search query
		if(!empty($whereClause))
		{
			$searchQuery .= " WHERE $whereClause";
		}
		// Sort the search query using the sort setting
		switch($sort)
		{
			// Ascending by article ID (newest first) (default)
			case 1:
				$searchQuery .= " ORDER BY articleID DESC";
				break;
			// Descending by article ID (oldest first)
			case 2:
				$searchQuery .= " ORDER BY articleID";
				break;
			// Ascending by article title (newest first)
			case 3:
				$searchQuery .= " ORDER BY articleTitle DESC";
				break;
			// Descending by article Title (oldest first)
			case 4:
				$searchQuery .= " ORDER BY articleTitle";
				break;
			default:
				// No sort setting provided, so don't sort the query by not appending anything
		}
		return $searchQuery;
	}
    // Build the main part of the query
	$searchQuery = buildQuery($userSearchTerm, $sort);
	
	// This function builds heading links based on the specified sort setting
	function sortLinksGenerator($userSearchTerm, $sort)
	{
		$sortLinks = '';
		switch($sort)
		{
			case 1:
				$sortLinks .= '            <td><a href = "' . $_SERVER['PHP_SELF'] . '?s=' . $userSearchTerm . '&amp;t=2" class="btn">Order Published (Oldest First)</a></td>' . "\n";
				$sortLinks .= '            <td><a href = "' . $_SERVER['PHP_SELF'] . '?s=' . $userSearchTerm . '&amp;t=4" class="btn">Title (A...Z)</a></td>' . "\n";
				break;
			case 2:
				$sortLinks .= '            <td><a href = "' . $_SERVER['PHP_SELF'] . '?s=' . $userSearchTerm . '&amp;t=1" class="btn">Order Published (Newest First)</a></td>' . "\n";
				$sortLinks .= '            <td><a href = "' . $_SERVER['PHP_SELF'] . '?s=' . $userSearchTerm . '&amp;t=4" class="btn">Title (Z...A)</a></td>' . "\n";
				break;
			case 3:
				$sortLinks .= '            <td><a href = "' . $_SERVER['PHP_SELF'] . '?s=' . $userSearchTerm . '&amp;t=2" class="btn">Order Published (Newest First)</a></td>' . "\n";
				$sortLinks .= '            <td><a href = "' . $_SERVER['PHP_SELF'] . '?s=' . $userSearchTerm . '&amp;t=4" class="btn">Title (A...Z)</a></td>' . "\n";
				break;
			case 4:
				$sortLinks .= '            <td><a href = "' . $_SERVER['PHP_SELF'] . '?s=' . $userSearchTerm . '&amp;t=2" class="btn">Order Published (Newest First)</a></td>' . "\n";
				$sortLinks .= '            <td><a href = "' . $_SERVER['PHP_SELF'] . '?s=' . $userSearchTerm . '&amp;t=3" class="btn">Title (Z...A)</a></td>' . "\n";
				break;
			default:
				$sortLinks .= '            <td><a href = "' . $_SERVER['PHP_SELF'] . '?s=' . $userSearchTerm . '&amp;t=1" class="btn">Order Published (Newest First)</a></td>' . "\n";
				$sortLinks .= '            <td><a href = "' . $_SERVER['PHP_SELF'] . '?s=' . $userSearchTerm . '&amp;t=4" class="btn">Title (A...Z)</a></td>' . "\n";
				break;
		}	
		return $sortLinks;
	}
	
	// This function builds navigational page links based on the current page and the number of pages
	function pageLinksGenerator($userSearchTerm, $sort, $curPage, $numPages)
	{
		$pageLinks = '';
		//If this page is not the first page, generate the "Previous" link
		if($curPage > 1)
		{
			$pageLinks .= '            <li><a href="' . $_SERVER['PHP_SELF'] . '?s=' . $userSearchTerm . '&amp;t=' . $sort . '&amp;page=' . ($curPage - 1) . '" class="btn">&lt;</a></li>' . "\n"; // We still have to pass along the user search data and the sort order in each link URL
		}
		else
		{
			// The "previous" link appears as a left arrow, as in "<-"
		}
		// Loop through the pages generating the page number links
		for($i = 1; $i <= $numPages; $i++)
		{
			if($curPage === $i)
			{
				$pageLinks .= '            <li><span class="psuedoBtn">' . $i . '</span></li>' . "\n";
			}
			else
			{
				// Make sure each page link points back to the same script - we're just passing a different page number with each link
				$pageLinks .= '            <li><a href="' . $_SERVER['PHP_SELF'] . '?s=' . $userSearchTerm . '&amp;t=' . $sort . '&amp;page=' . $i . '" class="btn">' . $i . '</a></li>' . "\n"; // The link to a specific page is just the page number
			}
		}
		// If this page is not the last page, generate the "Next" link
		if($curPage < $numPages)
		{
			$pageLinks .= '            <li><a href="' . $_SERVER['PHP_SELF'] . '?s=' . $userSearchTerm . '&amp;t=' . $sort . '&amp;page=' . ($curPage + 1) . '" class="btn">&gt;</a></li>' . "\n"; //The "next" link appears as a right arrow, as in "->"
		}
		return $pageLinks;
	}
	// Calculate pagination information
	$curPage = isset($_GET['page']) ? $_GET['page'] : 1; // Initialise the pagination variables because they will be needed to LIMIT the query and build the pagination links
	$resultsPerPage = 5; // number of results per page;
	$skip = (($curPage - 1) * $resultsPerPage);
	// Query to get the total results
	$searchQueryResult = mysqli_query($dbc, $searchQuery) or $errorMsg = 'There was an error with acquiring the search results. Please try again or contact support if the problem persists.';
	$totalSearchResults = mysqli_num_rows($searchQueryResult);
    // Check to see if the qeury found something
	if($totalSearchResults === 0)
	{
		$check = 0;
	}
    
    // Add the page header
    $pageTitle = $aCName . " - Search - " . $userSearchTerm;
    
    // Add image URL
    $imageURL = $homeURL . 'images/';
    
    // Add the breadcrumbs
    $breadcrumbs = array("index.php", $aCName . " Home", $aCName . " Home", "Article Search");
    ?>
<!doctype html>
<!--
    Site Version: 0.1.2.1
-->
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $aCName; ?> - Search</title>
    <?php
    require_once('includes/head.php');
    ?>
</head>
<body>
        <?php require_once('includes/header.php'); ?>
        <main id="mainContent">
        	<section id="search">
                <h2>Search results for: "<?php echo $userSearchTerm ?>"</h2>
    <?php
	// If an error was encountered, echo the error markup, otherwise there was no error and no operation had just been successfully executed, so skip echoing the markup
    if(isset($errorMsg))
    {
        echo '<p class="errorMsg">' . $errorMsg . '</p>' . "\n";
    }
	// If the query found something, display the results
	if($check !== 0)
	{
		$numPages = ceil($totalSearchResults / $resultsPerPage);
		
		// Start generating the table of results
        echo '    <table id="searchResultsHeadingTable">' . "\n";	
		//Generate the search result headings
		echo '        <tr>' . "\n";
		echo sortLinksGenerator($userSearchTerm, $sort); // Call the sortLinksGenerator() function to create the links for the results headings then display them
		echo '        </tr>' . "\n";
        echo'    </table>' . "\n";
		
		// Query again to get just the subset of results
		$searchQuery = $searchQuery . " LIMIT $skip, $resultsPerPage"; // The LIMIT clause created to query only a subset of results
		$searchQueryResult = mysqli_query($dbc, $searchQuery) or $errorMsg = 'There was an error with acquiring the results. Please try again or contact support if the problem persists.';
		while($row = mysqli_fetch_array($searchQueryResult))
		{
			$articleID = $row['articleID'];
			$getCurrentArticleCategoryIDQuery = "SELECT categoryID FROM article_category_tbl WHERE articleID = $articleID";
			$getCurrentArticleCategoryIDResult = mysqli_query($dbc, $getCurrentArticleCategoryIDQuery);
			$getCurrentArticleCategoryIDRow = mysqli_fetch_array($getCurrentArticleCategoryIDResult);
			$categoryID = $getCurrentArticleCategoryIDRow['categoryID'];
		    echo '        <article>
            <h2>' . $row['articleTitle'] . '</h2>
			<div class="articleInfo">
                ';
				// Get category information
				$getCategoryQuery = "SELECT * FROM category_tbl WHERE categoryID = $categoryID";
				$getCategoryResult = mysqli_query($dbc, $getCategoryQuery);
				$getCategoryRow = mysqli_fetch_array($getCategoryResult);
				// Convert the default MySQL date format to a regular human-readable format
				$dateAdded = date("d/m/Y", strtotime($row['dateAdded']));
				echo '<time class="postDate" datetime="' . $row['dateAdded'] . '"><a href="articles.php?d=' . $row['dateAdded'] . '" title="Published on ' . $dateAdded . '">' . $dateAdded . '</a></time>
                <span class="category"><a href="categories.php?c=' . $getCategoryRow['categoryID'] . '" title="' . $getCategoryRow['categoryDescription'] . '">' . $getCategoryRow['categoryName'] . '</a></span>
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
                        echo '<a href="tags.php?t=' . $getIndividualTagRow['tagID'] . '" title="' . $getIndividualTagRow['tagDescription'] . '">' . $getIndividualTagRow['tagName'] . '</a>';
                        if ($numTags > 1)
                        {
                            echo ', ';
                        }
                        $numTags--;
                    }
                }
                echo '</span>
            </div>
            ' . $row['articleContent'] . '
        </article>';
		}
		echo '    </section>' . "\n";
		// Generate navigational links if we have more than one page
		if($numPages > 1)
		{
		    echo '    <div id="paginationLinks">' . "\n";
            echo '    <ul>' . "\n";
			echo pageLinksGenerator($userSearchTerm, $sort, $curPage, $numPages); // Call the pageLinksGenerator() function to generate the page links then display them
			echo '    </ul>' . "\n";
			echo '    </div>' . "\n";
		}
	}
	else
	{
		echo '            <p id="emptyResult">No articles were found.</p>' . "\n";
        echo '          </section>' . "\n";
	}
	// "Housekeeping"
	//mysqli_close($dbc);
	
?>
    </main>
    <?php require_once('includes/footer.php'); ?>
</body>
</html>