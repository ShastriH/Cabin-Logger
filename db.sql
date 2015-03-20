-- Database Creation
DROP DATABASE IF EXISTS *;
CREATE DATABASE IF NOT EXISTS *;
USE *;
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE article_tbl (
	articleID TINYINT(3) NOT NULL UNIQUE  AUTO_INCREMENT PRIMARY KEY,
	articleTitle VARCHAR(255) NOT NULL,
    articleContent MEDIUMTEXT NOT NULL,
    dateAdded DATE NOT NULL
);
CREATE TABLE tag_tbl (
	tagID TINYINT(2) NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY,
	tagName VARCHAR(255) NOT NULL,
    tagDescription VARCHAR(255) NOT NULL
);
CREATE TABLE article_tag_tbl (
	articleTagID SMALLINT(3) NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY,
    articleID TINYINT(3),
    tagID TINYINT(2),
	FOREIGN KEY (articleID) REFERENCES article_tbl(articleID),
	FOREIGN KEY (tagID) REFERENCES tag_tbl(tagID)
);
CREATE TABLE category_tbl (
	categoryID TINYINT(2) NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY,
	categoryName VARCHAR(255) NOT NULL,
    categoryDescription VARCHAR(255) NOT NULL
);
CREATE TABLE article_category_tbl (
	articleCategoryID SMALLINT(3) NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY,
    articleID TINYINT(3),
    categoryID TINYINT(2),
	FOREIGN KEY (articleID) REFERENCES article_tbl(articleID),
	FOREIGN KEY (categoryID) REFERENCES category_tbl(categoryID)
);

-- Data Seeding
INSERT INTO article_tbl (articleTitle, articleContent, dateAdded) VALUES
("Web Programming 1 Introduction", "<p>Let&#8217;s start with a bit of theory. Yeah, I know, zzz... but bear with me for a few.</p>
<p>On a basic level, HTML is just a way for a web designer to tell a browser what content it wants to be displayed, but most importantly, it is there to tell the browser what type of content it is. For example, you might want to put up an image and some text to describe your latest vacation, but how does the browser know what to do with the content you give it? The answer... you use something called tags.</p>
<strong>Tags</strong>
<p>What is a tag? It&#8217;s simple, it&#8217;s an opening angle bracket followed by a little text, followed by a closing angle bracket.</p>
<p>There are also two types of tags, an opening and closing tag. Let&#8217;s use the paragraph tag as an example.</p>
<p>1) &#60;p&#62;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2) &#60;/p&#62;</p>
<p>The first tag is an opening &#8220;p&#8221; or paragraph tag. The second tag is a closing &#8220;p&#8221; or paragraph tag. Together, these tags form an element, i.e. &#60;p&#62; &#60;/p&#62;  is a paragraph element.</p>
<strong>Elements</strong>
<p>What is an element? An element is effectively just a way for a web designer to tell the browser how to treat whatever text they put between its tags. For example, &#8216;&#60;p&#62;Hello&#60;/p&#62;&#8217; and &#8216;&#60;h1&#62;Hello&#60;/h1&#62;&#8217; will display very differently by a browser (by default). It is important to remember to include your closing tags as this can cause issues and just poorly written code.</p>
<p>So, what if someone said to you: &#8220;change that line to a header&#8221;. What would you do? Take a few seconds to think... All that means is you take whatever text you have and put it between some matching header tags. For example, &#8216;My latest vacation&#8217; becomes &#8216;&#60;h1&#62;My latest vacation&#60;/h1&#62;&#8217; or &#8216;&#60;h2&#62; My latest vacation&#60;/h2&#62;&#8217;.</p>
<p>Now that you have some basic HTML know-how, let&#8217;s take a look at the basic structure of a web page/document (Figure 1, below).</p>
<figure>
    <img src=\"http://i1302.photobucket.com/albums/ag128/CabinLogger/Cabin%20Logger/Articles/figure1_zps24312a28.jpg\" alt=\"Figure 1\">
     <figcaption>Figure 1</figcaption>
</figure>
<p>At the very top you will see a special tag... in that it isn&#8217;t really one, &#8216;&#60;!doctype html&#62;&#8217; really is just an instruction (code) to tell the browser what version of HTML is being used in the document (hence doc+type). In previous version of HTML/XHTML this was fairly convoluted and therefore difficult to remember, so the W3C (the people in charge of working on HTML) decided to change it to its present version. So that&#8217;s why, if you viewed the source of an older web page, you might see something different.</p>
<p>Next we have the &#8216;html&#8217; element. This is another instruction to the browser telling it &#8220;Hey, I&#8217;m holding HTML code&#8221;.</p>
<p>Immediately after that is a very important element, the &#8216;head&#8217; element, as far as programming is concerned, because this is where the majority of your code (everything other than your content and markup) should go. This is where you will include CSS (used for styling a page with colour, font styles, certain effects...) as well as JavaScript (JS). This can be in the form of CSS/JS code you include in the page or documents you attach via a link. Without those two, your page will be very, very plain, as in just black text on a white background.</p>
<p>A key point to know is the &#8216;head&#8217; element is a way for a developer to provide the browser with some information, such as the CSS/JS code they want to be applied to the page as mentioned above. Other than very specific pieces of information, nothing between the opening and closing tags will be displayed to anyone viewing the page normally. For example, as you can see, the &#8217;title&#8217; element is inside the &#8216;head&#8217; element. This element tells the browser the title of the page, which is then displayed on the browser tab, so whatever is between the &#8216;title&#8217; element tags will be displayed there.</p>
<p>Finally we have the &#8216;body&#8217; element. Here is where you put your content, such as some text, images, video, forms and so on. Whatever you type between these tags will be displayed in the browser window (unless you manipulate it with CSS/JS, but ignore that for now).</p>
<p>There you have it! A quick intro into the basic structure of a web page.</p>", "2014-09-26"),

-- Article 2
("DMPT Class Notes - 23/09/2014", "<h3>Photoshop Functions</h3>
<table>
<tr>
	<th>Function</th><th>Shortcut</th>
</tr>
<tr>
<td>Unlock background layer</td><td>Alt + double-click</td>
</tr>
<tr>
<td>Duplicate layer</td><td>Ctrl + J / right-click</td>
</tr>
<tr>
<td>Save</td><td>Ctrl + S</td>
</tr>
<tr>
<td>100% clarity</td><td>Double-click Zoom tool</td>
</tr>
<tr>
<td>Optimal size</td><td>Double-click Hand tool</td>
</tr>
<tr>
<td>Close one image/tab</td><td>Ctrl + W / click the &lsquo;x&rsquo;</td>
</tr>
<tr>
<td>Layer styles</td><td>Double-click layer (not text)</td>
</tr>
</table>
<p>Stroke &#45; An outline (of an image/shape).</p>
<p>When using strokes, if the Position is set to outside the stroke will not be seen.</p>
<p>There are two types of editing in graphics:</p>
<ul>
    <li>Destructive (permanent)</li>
    <li>Non-destructive (retain original image (layer) by placing an adjustment layer above it).</li>
</ul>
<p>Adjustment Layers are a &lsquo;ghost layer&rsquo; which is placed above the layer for which it was made. All changes affect only this ghost layer, while the original layer remains unaffected.</p>
<p>The workspace in Photoshop is the various components, such as the menus and toolbox, which fill the screen.</p>
<p>To reset the workspace follow these steps using the menu bar at the top of the screen: Window -> Workspace -> Reset Essentials (third section).</p>
<p>This resets the components to their default positions.</p>", "2014-09-26"),

-- Article 3
("DMPT Class Notes - 25/09/2014", "<h3>Photoshop Functions</h3>
<table>
<tr>
<th>Function</th>
<th>Shortcut</th>
</tr>
<tr>
<td>Show rulers</td>
<td>Ctrl + R</td>
</tr>
<tr>
<td>Show/hide guides</td>
<td>Ctrl + ;</td>
</tr>
<tr>
<td>Zoom</td>
<td>Ctrl + +/-</td>
</tr>
<tr>
<td>Step backward</td>
<td>Alt + Shift + Z</td>
</tr>
<tr>
<td>Step forward</td>
<td>Ctrl + Shift + Z</td>
</tr>
<tr>
<td>Shape tool</td>
<td>U</td>
</tr>
<tr>
<td>Duplicate</td>
<td>Alt + click and drag</td>
</tr>
<tr>
<td>Select a layer</td>
<td>Ctrl + click</td>
</tr>
<tr>
<td>Transform</td>
<td>Ctrl + T</td>
</tr>
<tr>
<td>Cycle full screen modes</td>
<td>F</td>
</tr>
<tr>
<td>List layers</td>
<td>Right-click layer</td>
</tr>
</table>
<p>By using an adjustment layer the original integrity of the image is retained.</p>
<p>Tools are one letter, example Move (V), Brush (B), etc.</p>
<p>To do/apply something the shortcut is Ctrl followed by a letter, example show guides (Ctrl + ;).</p>
<p>To set guides, place the mouse on the ruler and drag down/right.</p>
<p>To change the colour of a shape, double-click on the rectangle showing the shape in the Layers panel.</p>
<p>When the Colour Picker window appears, the colour of the shape can be changed to that of another layer. When the mouse is moved above a layer, the icon changes to the Eyedropper tool. With one left-click, Photoshop will change the colour of the shape to that colour.</p>
<p>Pressing Alt with the move tool duplicates a layer.</p>
<p>An efficient method of duplicating a layer, perhaps to quickly copy a shape, is to press and hold the Alt key when using the Move tool. The icon will change to a white mouse pointer shadowing the regular black one. If a layer were to be clicked and held and if the mouse was moved, the layer would be copied.</p>
<p>A layer can be selected by moving the mouse over the layer, holding the Ctrl key and clicking it. Alternatively, by right-clicking a layer Photoshop will display the name of the layer and some, if not all, of the layers below it. This can be useful if one layer is hidden behind another and it needs to be selected.</p>", "2014-09-26"),

-- Article 4
("Multimedia Authoring Class Notes - 26/09/2014", "<h3>Flash Functions</h3>
<table>
<tr>
<th>Function</th>
<th>Shortcut</th>
</tr>
<tr>
<td>Insert frame</td>
<td>F5</td>
</tr>
<tr>
<td>Delete frame</td>
<td>Shift + F5</td>
</tr>
<tr>
<td>Insert keyframe</td>
<td>F6</td>
</tr>
<tr>
<td>Clear keyframe</td>
<td>Shift + F6</td>
</tr>
<tr>
<td>Undo</td>
<td>Ctrl + Z</td>
</tr>
<tr>
<td>Redo</td>
<td>Ctrl + Y</td>
</tr>
</table>
<p>Key frames are frames where things (a property, such as the position of an image) change in an animation. They are represented by little circles in the timeline of Flash. Initially it is clear, but when something is placed on the layer at the key frame it becomes black. This can be a drawing, an element or code.</p>
<p>End frames are frames indicating the end of something which appears on the stage.</p>
<p>To loop video playback, go to the Control menu and select Loop Playback.</p>
<p>While in Maths (x, y) coordinates get larger while moving right (for x) and up (for y), in computer terms, usually x gets larger moving right as well, but y gets larger while moving downward.</p>
<p>To adjust snapping settings, use the menu path: View -&#62; Snapping.</p>
<p>To view the History panel, which shows a list of the actions taken, follow the menu path: Window -&#62; History/Ctrl + F10.</p>
<p>Visibility, locking and the displaying of the outline of the elements on the layers can be toggled by the icons to the left of the timeline.</p>
<p>The layers can be grouped into folders by using the New Folder icon below the layers to create a folder and dragging the layers into the folder.</p>
<p>In Flash the order of the layers in the timeline reflects the order of the layers on the stage, i.e. the bottom layer in the timeline is the bottom layer on the stage. The layers can be reordered by dragging them to the left of the timeline.</p>
<br>
<p>Creating the class example:</p>
<p>Step 1: Create new file (Ctrl + N or File -&#62; New...). Select ActionScript 3.0 and set the resolution.</p>
<p>Step 2: Import the images into the library (File -&#62; Import -&#62; Import to Library...).</p>
<p>Step 3: Drag the image from the library onto the stage.</p>
<p>Step 4: Rename the layer &#8216;background&#8217; by double-clicking on the layer text.</p>
<p>Step 5: Create another layer by clicking on the New Layer icon and name it layer 1.</p>
<p>Step 6: Drag photo 1 onto that layer (on the timeline).</p>
<p>Step 7: Expand the duration of what is visible on the timeline. Do this by clicking on frame 48 in the timeline and inserting a frame (F5/right-click and select Insert Frame/Insert -&#62; Timeline -&#62; Frame). This is only keeping what is on the first key frame up to the end key frame.</p>
<p>Step 8: Add the remaining three photos by adding a layer for each and naming them, setting a keyframe at the desired frame by clicking on the frame and inserting a keyframe (or clicking on the black circle and dragging it along the timeline with the mouse if the photo was already placed on the layer), and then drag the photo onto the timeline at the new keyframe.</p>", "2014-09-28"),

-- Article 5
("DMPT Class Notes - 30/09/2014", "<h3>Photoshop Functions</h3>
<table>
<tr>
<th>Function</th>
<th>Shortcut</th>
</tr>
<tr>
<td>Horizontal Type Tool (Text)</td>
<td>T</td>
</tr>
</table>
<p>The process of creating work, the first iteration should be reflected upon before being refined.</p>
<p>Such work is created for the purpose of visual communication/ solve problems. This communication can be achieved via such tools as alignment, symbols and typography.</p>
<p>Symmetry occurs when both sides of an image are reflected on either side.</p>
<p>Hierarchy is another way to provide additional communication. Using different sizes of text, the degrees of importance of the information being communicated along with the information itself.</p>
<p>Grids are a way to achieve alignment in design.</p>
<br>
<p>When reflecting on something, the acronym CRAP can be used:</p>
<p>Contrast (colour) - making something stand out, perhaps to communicate a function.</p>
<p>Repetition - consistency to reinforce a message or to make use of universal settings.</p>
<p>Alignment - making something appear more appealing to the human eye.</p>
<p>Proximity - where something is placed in relation to others.</p>
<br>
<p>Change colour of a layer by using layer styles by double-clicking on the layer (the blue highlighted part of the layer) -&#62; Select Color Overlay -&#62; Click colour box -&#62; Select colour.</p>", "2014-09-30"),

-- Article 6
("Multimedia Authoring Class Notes - 01/10/2014", "<p>Continuing from the previous class...</p>
<p>Step 9: Select a photo on the stage, open the Transform panel by clicking on the Transform icon on the vertical menu immediately to the right of the stage. Manipulate the rotate value by scrolling with the mouse or entering a value. Repeat this for all of the photos.</p>
<p>Step 10: Create a new keyframe at frame 36.</p>
<p>Step 11: Select the Text tool, click on the stage, add the message and adjust it.</p>
<br>
<h3>Flash Functions</h3>
<table>
<tr>
<th>Function</th>
<th>Shortcut</th>
</tr>
<tr>
<td>Free Transform Tool</td>
<td>Q</td>
</tr>
<tr>
<td>Test movie</td>
<td>Ctrl + Enter</td>
</tr>
<tr>
<td>Text Tool</td>
<td>T</td>
</tr>
<tr>
<td>Rectangle Tool</td>
<td>R</td>
</tr>
<tr>
<td>Oval Tool</td>
<td>O</td>
</tr>
<tr>
<td>Free Transform Tool</td>
<td>Q</td>
</tr>
<tr>
<td>Multiple selection</td>
<td>Hold Shift and click</td>
</tr>
<tr>
<td>Taper</td>
<td>Ctrl + Shift + drag</td>
</tr>
</table>
<p>To rotate an object, select the element to be rotated, click the Transform panel (the 5th icon on the first column to the right of the stage). Alternatively, select the Free Transform Tool (Q) on the tools column to the far right of the screen and click on the handles and drag to the left or right.</p>
<p>Note: the selected frame is displayed on the row at the bottom of the screen.</p>
<br>
<p>Creating the class example:</p>
<p>Step 1: Select the Rectangle Tool (R). Draw a rectangle.</p>
<p>Step 2: Switch to the Selection Tool (V) and double-click the edge of the shape to highlight the stroke.</p>
<p>Step 3: Select a colour for the stroke by clicking on the coloured box next to the pencil icon in the Fill and Stroke section of the Properties Panel.</p>
<p>Step 4: Set the height of the stroke to 2px by entering 2 in the box next to the Stroke slider option, which is immediately below the colour selection option used in step 3.</p>
<p>Step 5: Select the entire shape by double-clicking inside the shape. Under the Position and Size section of the Properties Panel click the number next to width and enter 130 and enter 150 for the height.</p>
<p>Step 6: Select the Oval Tool (O) and draw an oval starting from the top left corner of the rectangle and draw until the shape snaps to the right side of the rectangle.</p>
<p>Step 7: Select the shapes remaining at both top corners of the rectangle by holding the Shift key and selecting the fill and the two stroke edges for each shape and hit the Delete key.</p>
<p>Step 8: Select the entire shape, Ctrl + A or highlighting the entire shape, and select the Free Transform Tool (Q).</p>
<p>Step 9: Move the mouse over a bottom corner of the shape and taper it (move the selected corner and the adjoining corner equal distances from their origins) inward by dragging toward the other corner.</p>", "2014-10-05"),

-- Article 7
("DMPT Class Notes - 07/10/2014", "<h3>Photoshop Functions</h3>
<table>
<tr>
<th>Function</th>
<th>Shortcut</th>
</tr>
<tr>
<td>Select contents of a layer</td>
<td>Ctrl and click layer thumbnail</td>
</tr>
</table>
<p>Rules of Typography:</p>
<ol>
    <li>Keep it simple</li>
    <li>Keep it in the family</li>
    <li>Hierarchy</li>
</ol>
<p>To select the contents of a layer, Ctrl and click the contents of that layer.</p>
<p>To set a layer to the size of another, select the inverse of the layer to be trimmed.</p>
<p>Step 1: Ctrl-click the thumbnail of the layer to be used.</p>
<p>Step 2: Select the layer to be trimmed.</p>
<p>Step 3: Go to Select -&#62; Inverse (Shift + Ctrl + I).</p>
<p>Step 4: Go to Image -&#62;</p>", "2014-10-07"),

-- Article 8
("DMPT Class Notes - 09/10/2014", "<h3>Photoshop Functions</h3>
<table>
<tr>
<th>Function</th>
<th>Shortcut</th>
</tr>
<tr>
<td>Magic Wand Tool</td>
<td>W</td>
</tr>
<tr>
<td >Deselect</td>
<td >Ctrl + D</td>
</tr>
<tr>
<td >Add to selection</td>
<td >Shift + click</td>
</tr>
<tr>
<td>Remove from selection</td>
<td>Alt + click</td>
</tr>
</table>
<p>The Magic Wand Tool (W)selects colours of one value. When this tool is selected, click on a colour which you want to remove, and once the marquee is moving around the colour you want, hit Delete to remove that colour. Once that is done, hit Ctrl + D to deselect the area to deactivate the Magic Wand Tool. You can also add or remove areas to be removed by holding Shift and clicking and holding Alt and clicking respectively.</p>
<p>Note: Hold Shift to force an item to move along a straight line.</p>", "2014-10-12"),

-- Article 9
("Multimedia Authoring Class Notes - 10/10/2014", "<p>Continuing from the previous class...</p>
<p>Note: When using the Paint Bucket Tool (K) to fill a shape with colour, the fill sometimes goes beyond the area due to holes in the shape. If this happens, you have to fill any gaps which might be present by going to the right tool bar column and selecting Gap Size near the bottom. The options there refer to the size of the holes in the shape, therefore the one which would work may vary depending on the type of gap.</p>
<p>Step 10: Click on the fill of the main area of the coffee cup so dots cover it. Click on the Color tab on the tool column immediately to the right of the stage. Click on the drop-down menu and select &#8220;Linear gradient&#8221;. Click on the first marker on the left of the horizontal bar of colour (the top will be black to signify it is selected), and select the first colour (#ffcccc) then click on the right marker and select the second colour (#ba6241). Then click in the middle of the colour bar to add another colour and set it to white.</p>
<p>Gradient: A flow from one colour to another.</p>
<p>Note: By clicking on the gradient bar you will be adding another colour to the gradient. These markers can also be moved around to modify how the gradient is created.</p>
<p>Step 11: Fill the area representing the inside of the coffee cup with the same gradient by using the same tool.</p>
<p>Step 12: Change the gradient orientation by clicking on the Gradient Transform Tool (F) and rotating it 180&deg; by clicking on the corner and dragging the mouse so the light seems to be striking the cup from one source.</p>
<p>Step 13: Use a bitmap image as the coffee by going back to the Color tab and select Bitmap fill. To get the image it must be imported by selecting &#8220;Import...&#8221;.</p>
<p>Step 14: Once the image is displayed as the coffee, go back to the Gradient Transform Tool, click on the coffee area, zoom out until the border of the image is visible and shrink it so the border is closer to the edges of the cup so the coffee looks more realistic.</p>
<p>Step 15: Group all of the coffee shapes by selecting all of them and go to Modify -&#62; Group (Ctrl + G).</p>
<p>Step 16: Insert a new symbol by going to Insert -&#62; New Symbol... (Ctrl + F8), name it line and set the type to &#8220;Graphic&#8221;.</p>
<p>Step 17: Click on the Line Tool (N), go to the Properties tab, go to Style, set it to &#8220;Hairline&#8221;, leave the colour as black and draw a vertical line.</p>
<p>Step 18: Go to the Selection Tool and select the line. Go to the Properties tab and set the height to 25px.</p>
<p>Step 19: Go back to the  stage by clicking the left arrow near the top of the screen. Name the layer with the coffee cup shapes as &#8220;coffee cup&#8221;. Create a new layer and call it &#8220;coffee aroma&#8221;.</p>
<p>Step 20: Select the Deco Tool (U), click on the Symmetry brush. Click on the stage and hold the mouse button and create a star using the newly created line.</p>
<p>Note: The Deco tool, along with many other features, have been deprecated in Flash CC and therefore are only available in Flash CS6.</p>
<p>Step 21: Create the circle for the star by going to the Oval Tool (O). Go to the Properties tab, click the fill colour box and select no fill by clicking on the icon with the red diagonal line. Create a circle by holding Shift and drawing the circle to create a perfect circle.</p>
<p>Step 22: Align the circle and the lines by selecting them, going to the Align tab in the column immediately to the right of the stage and clicking &#8220;Align hortizontal center&#8221; and &#8220;Align vertical centre&#8221; under the first section named &#8220;Align:&#8221;.</p>
<p>Step 23: Group the star shapes and move it above the coffee cup. Create copies of the now grouped shape.</p>
<p>Step 24: Use the Decorated Brush and a dashed line to create the aroma lines.</p>
<h3>Flash Functions</h3>
<table>
<tr>
<th>Function</th>
<th>Shortcut</th>
</tr>
<tr>
<td>Paint Bucket Tool</td>
<td>K</td>
</tr>
<tr>
<td>Gradient Transform Tool</td>
<td>F</td>
</tr>
<tr>
<td>Group</td>
<td>Ctrl + G</td>
</tr>
<tr>
<td>New Symbol</td>
<td>Ctrl + F8</td>
</tr>
<tr>
<td>Line Tool</td>
<td>N</td>
</tr>
<tr>
<td>Deco Tool* (deprecated in Flash CC)</td>
<td>U</td>
</tr>
<tr>
<td>Oval Tool</td>
<td>O</td>
</tr>
</table>", "2014-10-12"),

-- Article 10
("DMPT Class Notes - 14/10/2014", "<p>Selections in PS - Magic Wand Tool
<p>Tolerance, which is the degree to which PS will search for pixels darker and lighter than the colour selected, defaults at 32.</p>
<p>If you select a colour, PS will look at all the pixels around it and select all those of the same colour, but it wont only select pixels of that exact colour.</p>
<p>For example, if the background is white it wont only select white pixels because it looks for 16 shades darker (towards black) and lighter (towards white) than the selected colour.</p>
<br>
<p>To apply an adjustment layer to only one layer, select the adjustment layer, press and hold Alt and click between the layers.</p>", "2014-10-14"),

-- Article 11
("Programming - The Basics (Part 1)", "<p>We know programming is about creating software, but how exactly do programmers do this? Let&#8217;s start at the basics so we can pull everything together later.</p>
<br>
<strong>Variables</strong>
<p>Programmers need a way for the software their developing to retain certain information. Variables are blocks in memory (RAM) in which information, such as a person&#8217;s name or their age, is stored. There are many types of variables, some more complicated than others. Let&#8217;s run through the core set.</p>
<p>Integers - This type of variable stores integer numbers. By default, it stores a certain range of values, stretching from the negative to the positive. For example, 1, -15 and 200 are all valid values to store in a normal integer.</p>
<p>Float/Double - These are used to store numbers which either have decimal places in them, or through a calculation could get them. For example, 1.01, -15.52 and 1500.5 are valid values. The main difference between a Float and a Double is a Double can store more data and as a result is more precise.</p>
<p>Char - A char is simply a single character, whether that be a letter, number or symbol. Note, however, if the value of a char variable is set to a number, e.g. char c = &#8220;1&#8221;;, the number will be treated as a symbol and therefore no mathematical functions could be done on it. Valid values include &#8220;a&#8221;, &#8220;10&#8221; and &#8220;!&#8221;.</p>
<p>String - This is a special type of variable compared to the previous two. It stores strings of characters (which in itself is a type of variable), but String is also a class (more on those in a bit). Valid values include &#8220;Hello&#8221;, &#8220;asdfg&#8221; and &#8220;My name is John Doe.&#8221;.</p>
<p>Array - This is another special type of variable because it stores an array (set/group/collection...) of variables including integers, doubles and Strings. It can even store an array of arrays, but that&#8217;s for another lesson. Think of arrays like shelves containing the same type of item, such as books or clothes. Each array is restricted to one type of value, so you can&#8217;t mix integers with doubles or doubles with Strings. Arrays are critical in that they allow multiple pieces of information to be processed at one time, for example, when you register on a website, all the information you enter into the form is sent to the server (and processed initially) as an array.</p>
<br>
<strong>Statements</strong>
<p>Statements in Java are individual instructions a programmer uses to get a system to do something basic and consists of one line of code. On occasion a single statement can include multiple instructions using specific shorthand options available in the language being used. In Java (as well as with some other languages including JavaScript and PHP), statements are terminated (finished) with a semicolon (&#8220;;&#8221;) in much the same way and for similar reasons a sentence in English is terminated with a full stop.</p>
<br>
<strong>Loops</strong>
<p>Loops are simply blocks of code between braces/curly brackets (&#8220;{&#8221;,&#8220;&#8221;) which allow the code between the brackets to be executed multiple times depending on whether a certain check passes or fails. Loops are often used to go through arrays automatically.</p>
<br>
<strong>Structure of a Basic Program</strong>
<p>Let&#8217;s take a look at the most basic program which can be written in Java:</p>
<pre>public class HelloWorld
{
     public static void main(String[] args)
     {
          System.out.println(\"Hello World!\");
     }
}</pre>
<p>At the top you have &#8220;public class HelloWorld&#8221;. HelloWorld is the name of the program, while public and class are keywords in Java used by the programmer to provide information to the Java related software, such as the Java compiler. Let&#8217;s step through the information for the method signature for the main method:</p>
<p>public static void main(String[] args)</p>
<p>&#8220;public&#8221; means the main method can be accessed by any object;</p>
<p>&#8220;static&#8221; means the main method can be called by any class method;</p>
<p>&#8220;void&#8221; means the main method returns nothing;</p>
<p>&#8220;main(String[] args)&#8221; means the runtime system is allowed to pass information to the application. This allows users to modify the operation of the application without needing to adjust the code and recompile it.</p>
<p>It is not critical to know exactly what this means at first, but later on you will need to know what each of those parts of the method signature means when you need to use them or create your own method.</p>", "2014-10-14"),

-- Article 12
("Programming - The Basics (Part 2)", "<strong>Core Java Elements</strong>
<p>In Java there are some common elements which are used countless times in Java applications. Those which will be used most in the Programming module will be covered below.</p>
<strong>Getting information from the user</strong>
<p>When you need to get information from the user, you will need to create a Scanner object, a variable to store the data, and a method call using the Scanner object. The various variations of the code will look as follows:</p>
<pre>
1  import java.util.Scanner;
2 
3  public static void main(String[] args)
4  {
5     Scanner in = new Scanner(System.in);
6     int number = 0;
7 
8     System.out.print(\"Please enter a number: \");
9     number = in.nextInt();
10 }
</pre>
<p>Lines 6 and 9 would vary depending on what type of data you&#8217;re expecting...</p>
<pre>
&#8942;
6     String name = \"\";
&#8942;
9     name = in.nextLine(); // this can also be \"name = in.next();\" if only one word is expected
</pre>
<strong>Loops</strong>
<p>For Loop</p>
<p>The for loop is a tool which can be used to dynamically do something a specific number of times, or go through some thing such as an array.</p>
<pre>
for(int i = 0; i < 10; i++)
{
&#8942;
}
</pre>
<p>In the above example, an integer variable is declared before the loop is started, the loops is then started, with the integer &#8220;i&#8221; checked to see if it matches a certain condition, and if it does the code inside the loop is executed. Once that is done, &#8220;i&#8221; is incremented and the loop starts again. This will continue until &#8220;i&#8221; is not less than 10.</p>
<p>While Loop</p>
<p>The while loop is a tool similar to a for loop, however, with this loop something can be done an unspecific number of times.</p>
<pre>
int i = 0;
while(i < 10)
{
&#8942;
     i++;
}
</pre>
<p>As you can see, the while loop can contain many of the components of a for loop. A while loop can be used interchangeably with a for loop, but there are cases when you do not know how many times you will have to do something, and if so you will have to use the while loop instead of the for loop.</p>", "2014-10-14"),

-- Article 13
("DMPT Class Notes - 30/10/2014", "<strong>Marquee Selection</strong>
<p>Once a selection is made, the mouse can be used to move the selection by clicking and dragging. However, if the Move Tool (V) was used, a scissors icon appears and the actual pixels are moved.</p>
<p>Note: To select all the contents of a layer, Ctrl-click the thumbnail of the layer.</p>
<br>
<strong>Masking Tool</strong> (rectangular icon with a circle inside)
<ul>
    <li>Always use a brush.</li>
    <li>Use just two colours: black and white.</li>
    <li>Initiate masking mode by selecting the layer and clicking the icon.</li>
    <li>When you paint in black, it is deleted (non-destructive editing).</li>
    <li>Painting with white reveals.</li>
    <li>If a mistake is made while hiding pixels, painting white can be used to reveal it: quick recover.</li>
    <li>To switch between white and black, use the X key.</li>
    <li>When working with the selection tool, use a hard brush, zoom in, and you will get precision graphics.</li>
    <li>While working, use the space-bar to move the screen while zoomed in.</li>
</ul>", "2014-10-30"),

-- Article 14
("Multimedia Authoring Class Notes - 17/10/2014", "<p>Points to remember while creating a heart:</p>
<ul>
	<li>Use the Pen Tool.</li>
	<li>To create a heart, only 4 anchor points are needed.</li>
	<li>To begin: click in the middle of the screen and drag outward to create a curve going around.</li>
	<li>Press the Alt key to individually select the handles.</li>
	<li>The Sub-selection tool can be used to change the position of the points.</li>
	<li>Click and hold at point 1, pull it out, drag and release at point 2, click and hold at point 3, drag and release at point 4, click and hold at point 5. At the peak of the heart hold the Alt key and pull the other handle up to get the peak shape.</li>
</ul>", "2014-10-31"),

-- Article 15
("Multimedia Authoring Class Notes - 24/10/2014", "<p>TBD.</p>", "2014-10-31"),

-- Article 16
("Multimedia Authoring Class Notes - 31/10/2014", "<strong>Motion Tweens</strong>
<p>Step 1: Add asset to stage.</p>
<p>Step 2: Select Frame 24.</p>
<p>Step 3: Right-click asset and select create motion tween.</p>
<p>Step 4: Drag asset diagonally down. A diamond is created in the frame. A circle is created to represent every frame.</p>
<p>Note: Select your path with the Selection Tool to adjust the path. Use the mouse to bend the path.</p>
<p>Step 5: Click the path, go to the Properties panel, and check the box &#8220;Orient to path&#8221; to move the asset.</p>
<p>Step 6: To slow motion tween, select the last frame, and drag to the desired frame. This will increase the number of dots and the animation would be extended.</p>
<p>Note: To adjust the speed of the animation at the beginning or end, adjust Ease in the Properties panel for the path.</p>
<p>Step 7: Change the alpha level by selecting the asset at the last frame, go to the Properties panel, go to Colour Effect, click on the Style drop-down menu, select Alpha and change Alpha to 0.</p>
<br>
<p>To rotate an asset:</p>
<p>Step 1: Select the last frame of the desired layer and click on the asset.</p>
<p>Step 2: Go to Properties, go to Rotation and set Rotate to 2.</p>
<br>
<p>To animate asset:</p>
<p>Step 1: Extend the frames by selecting the desired frame and creating a frame there.</p>
<p>Step 2: Create a key frame at the end and in the middle. This is a trick to get the motion tween to return to the original position at the end.</p>
<p>Step 3: Establish the motion by going to the middle key frame, going to the Free Transform Tool and adjust the asset.</p>
<p>Note: If there is nested animation, it will only be seen in the final compiled version.</p>", "2014-10-31"),

-- Article 17
("DMPT Class Notes - 06/11/2014", "<p>When selecting colours for a website, follow these steps:</p>
<ol>
    <li>Take a screenshot of something (website).</li>
    <li>Go to Photoshop and create a new style.</li>
    <li>Paste in the screenshot.</li>
    <li>Switch to the Eyedropper Tool.</li>
    <li>Sample the colour.</li>
    <li>Go to the colour boxes on the left vertical toolbar and click on the front one.</li>
    <li>Copy the hex code for the colour from the bottom textbox.</li>
    <li>Go to dribbble.com, hover over the &#8216;...&#8217; at the end of the menu and select Colors.</li>
    <li>Paste the copied hex code into the textbox on the right and click Update.</li>
    <li>Click on a website.</li>
</ol>
<p>Use the colour group on the right to find complimentary colours.</p>", "2014-11-06"),

-- Article 18
("Multimedia Authoring Class Notes - 07/11/2014", "<p>TBD.</p>", "2014-11-07"),

-- Article 19
("DMPT Class Notes - 11/11/2014", "<h3>Photoshop Functions</h3>
<table>
<tr>
<th>Function</th>
<th>Shortcut</th>
</tr>
<tr>
<td>Clone Stamp tool</td>
<td>S</td>
</tr>
<tr>
<td>Sample with Clone Stamp tool</td>
<td>Alt-click</td>
</tr>
</table>
<strong>Clone Stamp Tool</strong>
<p>The Clone Stamp Tool (S) is used to copy pixels from one part of an image (a process called sampling) to another. To copy some pixels, select the tool and Alt-click the area of the image, then move the mouse click on the area to be covered (with the pixels which were just copied).</p>
<p>It is advised to sample often, with just a few clicks of the mouse between samples, in order to achieve a realistic look for the edited area of the image. This is particularly important in areas of an image which are random in nature, such as clouds, rocks, water, etc.</p>", "2014-11-11"),

-- Article 20
("Website Launch", "<p>The website has just been launched.</p>
                <p>To learn about this website, see the <a href=\"aboutus.php\">About Us</a> page.", "2015-01-14"),

-- Article 21
("Website Update #001", "<p>The website <a href=\"contact.php\">contact form</a> has been designed. Functionality to be implemented.</p>", "2015-03-07");

INSERT INTO category_tbl (categoryName, categoryDescription) VALUES
("Web Development", "The languages and techniques involved in developing a website."),
("Digital Media", "The various forms of multimedia designed and produced for websites."),
("Programming", "The languages, techniques and processes involved in programming."),
("Other", "All uncategorised articles."),
("News", "News regarding this website.");

INSERT INTO article_category_tbl (articleID, categoryID) VALUES
(1, 1),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 3),
(12, 3),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 5),
(21, 5);

INSERT INTO tag_tbl (tagName, tagDescription) VALUES
("Web Design", "The aspect of web development specifically focused on the visual design and creation of a website."),
("Web Development", "The aspect of web development specifically focused on the back-end development of a website."),
("Java", "Information relating to the Java Programming Language"),
("Digital Media Production Techniques", "Notes for the Digital Media Production Techniques class."),
("Multimedia Authoring", "Notes for the Multimedia Authoring class."),
("Photoshop", "Information relating to Adobe Photoshop."),
("Flash", "Information relating to Adobe Flash."),
("Illustrator", "Information relating to Adobe Illustrator."),
("Audition", "Information relating to Adobe Audition."),
("Premiere", "Information relating to Adobe Premiere"),
("Cabin Logger", "Information regarding this website.");

INSERT INTO article_tag_tbl (articleID, tagID) VALUES
(1, 1),
(2, 4),
(2, 6),
(3, 4),
(3, 6),
(4, 5),
(4, 7),
(5, 4),
(5, 6),
(6, 5),
(6, 7),
(7, 4),
(7, 6),
(8, 4),
(8, 6),
(9, 5),
(9, 7),
(10, 4),
(10, 6),
(11, 3),
(12, 3),
(13, 4),
(13, 6),
(14, 5),
(14, 7),
(15, 5),
(15, 7),
(16, 5),
(16, 7),
(17, 4),
(17, 6),
(18, 5),
(18, 7),
(19, 4),
(19, 6),
(20, 11),
(21, 11);