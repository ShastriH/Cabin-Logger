<?php
    // Acquire global data
    require_once("includes/common.php");
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $aCName; ?> - Contact Cabin Blogger</title>
    <?php require_once("includes/head.php"); ?>
</head>
<body>
    <?php require_once("includes/header.php"); ?>
    <main>
    	<section id="boxMenu">
            <h1>Contact Form</h1>
	        <form action="contact.php" method="post" name="contactForm" id="contactForm">
                <fieldset>
                    <legend>Personal information</legend>
                    <ul class="formList">
                        <li>
                            <label for="name" class="text">Name</label>
                            <input type="text" name="name" id="name" tabindex="10">
                        </li>
                        <li>
                            <label for="email" class="text">Email</label>
                            <input type="email" name="email" id="email" tabindex="20">
                        </li>
                    </ul>
                </fieldset>
                <fieldset class="message">
                    <legend>Message</legend>
                    <ul>
                        <li>
                            <label for="comments" class="text">Your Message</label>
                            <textarea name="comments" id="comments" tabindex="130"></textarea>
                        </li>
                        <li>
                            <input type="submit" name="submit" id="submit" value="Submit" tabindex="140" class="btn">
                            <input type="reset" name="clear" id="clear" value="Reset" tabindex="150" class="btn">
                        </li>
                    </ul>
                </fieldset>
              </form>
        </section>
    </main>
    <?php require_once("includes/footer.php"); ?>
</body>
</html>