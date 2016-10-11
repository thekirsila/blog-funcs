<?php
function getPostList($dispLength) {
$countFile = fopen("postCount.txt", "r");
$postCount = intval(fread($countFile, filesize("postCount.txt")));
fclose($countFile);

for ($x = $postCount; $x > 0; $x--) {
    //Declare paths of data and title files
    $postDataFilePath = "posts/$x.txt";
    $postTitleFilePath = "posts/" . $x . "title.txt";
    
    if (file_exists($postDataFilePath)) {
        //Fetch post data to variable
        $dataFile = fopen($postDataFilePath, "r");
        $postData = fread($dataFile, $dispLength);
        fclose($dataFile);
        
        //Fetch post title to variable
        $dataFile = fopen($postTitleFilePath, "r");
        $titleData = fread($dataFile, filesize($postTitleFilePath));
        fclose($dataFile);
        
        //Echo post container
        echo '<article id="picture">';
        
        //Echo post link
        echo '<a href="post.php?postNumber=' . $x . '">';
        
        //Echo image
        echo '<img src="posts/' . $x . '.jpg" class="img-responsive">';
        
        //Echo title
        echo '<h3>';
        echo strval($titleData);
        echo '</h3>';
        
        //Echo data
        echo '<p>';
        echo strval($postData);
        echo '...';
        echo '</p>';
        
        //Echo closings
        echo '</a>';
        echo '</article>';
    } else {
        //Declare paths of data and title files
        $postDataFilePath = "posts/" . $x . "totd.txt";
        $postTitleFilePath = "posts/" . $x . "totdtitle.txt";
                            
        //Fetch post data to variable
        $dataFile = fopen($postDataFilePath, "r");
        $postData = fread($dataFile, filesize($postDataFilePath));
        fclose($dataFile);
                            
        //Echo post container
        echo '<article id="quote">';
                            
        //Echo start quote
        echo '<i class="fa fa-quote-left fa-2x" aria-hidden="true"></i>';
                        
        //Echo data
        echo '<p>';
        echo strval($postData);
        echo '</p>';
                        
        //Echo end quote
        echo '<p align="right"><i class="fa fa-quote-right fa-2x" aria-hidden="true"></i></p>';
                        
        //Echo closings
        echo '</article>';
        }
    }
}

function getPostData() {
    $postNumber = $_GET["postNumber"];
    
    $postTitleFilePath = "posts/" . $postNumber . "title.txt";
    $postDataFilePath = "posts/" . $postNumber . ".txt";
                
    //Get post title data
    $myFile = fopen($postTitleFilePath, "r");
    $postTitle = fread($myFile, filesize($postTitleFilePath));
    fclose($myFile);
                
    //Get post text data
    $myFile = fopen($postDataFilePath, "r");
    $postData = fread($myFile, filesize($postDataFilePath));
    fclose($myFile);
    
    //Echo beginnings
    echo '<article>';
                    
    //Echo title and post content
    echo '<h3>';
    echo $postTitle;
    echo '</h3>';
                
    echo '<p>';
    //echo $postData;
    for ($i = 0; $i < filesize($postDataFilePath); $i = $i + 500) {
        //Get post text data
        $myFile = fopen($postDataFilePath, "r");
        fseek($myFile, $i);
        $postData = fread($myFile, 500);
        echo $postData;
    }
    
    //Echo endings
    echo '</p>';
    echo '</article>';
}

function getPostTitle($useGet, $postNro) {
    if ($useGet) {
        $postNumber = $_GET["postNumber"];
    } else {
        $postNumber = $postNro;
    }
    $filepathToOpen = "posts/" . $postNumber . "title.txt";
    $myFile = fopen($filepathToOpen, "r");
    $title = fread($myFile, filesize($filepathToOpen));
    fclose($myFile);
    echo $title;
}

function getPostDescription($useGet, $postNro) {
    if ($useGet) {
        $postNumber = $_GET["postNumber"];
    } else {
        $postNumber = $postNro;
    }
    $filepathToOpen = "posts/" . $postNumber . "desc.txt";
    $myFile = fopen($filepathToOpen, "r");
    $desc = fread($myFile, filesize($filepathToOpen));
    fclose($myFile);
    echo $desc;
}

function addString($haystack, $needle, $addition) {
    $pos = strpos($haystack, $needle) + strlen($needle);
    
    // Cut the dataBlock into two parts and put all parts together
    $dataBlockFir = substr($haystack, 0, $pos);
    $dataBlockSec = substr($haystack, $pos, (strlen($haystack) - $pos));
    //$date = date("D, d M Y h:i:s");
    
    $haystack = $dataBlockFir . $addition . $dataBlockSec;
    
    return $haystack;
}

function createPost($addDate) {
    //Get the data
    $title = $_POST["title"];
    $post = $_POST["post"];
    $desc = $_POST["description"];
    $date = date("D, d M Y h:i:s");
    
    //Add date to the end of the post if the user so wants
    if ($addDate) {
        $post = $post . "<br><br><b>" . date("jS F Y") . "</b>";
    }
    
    //Update the current filenumber file
    $myFile = fopen("../postCount.txt", "r");
    $postCount = intval(fread($myFile, filesize("../postCount.txt")));
    fclose($myFile);
    
    $postCount = $postCount + 1;
    echo $postCount;
    
    $myFile = fopen("../postCount.txt", "w");
    fwrite($myFile, $postCount);
    fclose($myFile);
    
    //Move photo to posts
    $_FILES["photo"]["name"] = $postCount . ".jpg";
    if (file_exists("../posts/" . $_FILES["photo"]["name"])) {
        echo "File already exists, skipping...<br>";
    } else {
        move_uploaded_file($_FILES["photo"]["tmp_name"], "../posts/" . $_FILES["photo"]["name"]);
    }
    
    //Create filenames
    $txt_filename = "../posts/" . $postCount . ".txt";
    $title_filename = "../posts/" . $postCount . "title.txt";
    $desc_filename = "../posts/" . $postCount . "desc.txt";
    
    //Create files and set their data
    $myFile = fopen($txt_filename, "w");
    fwrite($myFile, $post);
    fclose($myFile);
    
    $myFile = fopen($title_filename, "w");
    fwrite($myFile, $title);
    fclose($myFile);
    
    $myFile = fopen($desc_filename, "w");
    fwrite($myFile, $desc);
    fclose($myFile);
    
    echo "Files created, data set. Good to go.";
    
    // Add item to RSS feed
    // Open RSS feed
    $myFile = fopen("../rssfeed.rss", "r");
    $rssData = fread($myFile, filesize("../rssfeed.rss"));
    fclose($myFile);
    
    $newRssData = addString($rssData, "<language>en-us</language>", "<item><title>" . $title . "</title><pubDate>" . $date . "</pubDate><link>apreviewblog.com/post.php?postNumber=" . $postCount . "</link><guid isPermaLink='true'>apreviewblog.com/post.php?postNumber=" . $postCount ."</guid><description>" . $desc . "</description></item>");
    
    $myFile = fopen("../rssfeed.rss", "w");
    fwrite($myFile, $newRssData);
    fclose($myFile);
    
    // Add item to Sitemap
    // Open Sitemap
    $myFile = fopen("../sitemap.xml", "r");
    $smData = fread($myFile, filesize("../sitemap.xml"));
    fclose($myFile);
    
    $newSmData = addString($smData, "<!-- created with Free Online Sitemap Generator www.xml-sitemaps.com -->", "<url><loc>http://apreviewblog.com/post.php?postNumber=" . $postCount . "</loc><lastmod>" . date("Y-m-d") . "T" . date("H:i:s") . "+00:00" . "</lastmod><changefreq>weekly</changefreq><priority>0.80</priority></url>");
    
    $myFile = fopen("../sitemap.xml", "w");
    fwrite($myFile, $newSmData);
    fclose($myFile);
    
    echo "It would seem that everything was a success!";
}
?>