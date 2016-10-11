------------------------------------------------
[[[[[[             FUNCTIONS:             ]]]]]]
------------------------------------------------

getPostList($dispLength)

Finds the amount declared in postCount.txt of posts starting from the biggest number
echoes a photo (posts/postNro.jpg), title (posts/postNrotitle.txt)
and data (posts/postNro.txt) associated. Everything will be inside <article> -tags and <a> -tags,
the title in <h3> -tags and the data inside <p> -tags.

There is also an option for posting shorter texts directly on the page.
These texts will be shown completely,
without a picture, in quotation marks. For this to happen the name of the post title must be
of the form "posts/postNrototdtitle.txt" and for the data "posts/postNrototd.txt"

VARIABLES:

    $dispLength [required]
    Integer - How many characters long is the part of the blog text displayed. I personally like 300 to be the value.
    
-----------------------------------------------------------

getPostData()

Gets the post data, including title and text and echoes it. So simple it really is.

The whole post, including text and title are contained in <article> -tags, the title in <h3> -tags
and the post in <p> -tags

THIS FUNCTION DOES NOT TAKE IN VARIABLES

-----------------------------------------------------------

getPostTitle($useGet, $postNro)

Gets the post title. Perfect for metadata.

VARIABLES:

    $useGet [required]
    Boolean - Set to true if you want the postnumber to be imported using GET.
    
    $postNro [optional]
    Integer - Give the number of the post you want the title shown of.

-----------------------------------------------------------

getPostDescription($useGet, $postNro)

Gets the post description. Perfect for metadata.

VARIABLES:

    $useGet [required]
    Boolean - Set to true if you want the postnumber to be imported using GET.
    
    $postNro [optional]
    Integer - Give the number of the post you want the title shown of.

-----------------------------------------------------------

createPost($addDate)

Gets the data sent to it through POST and edits them into files that the post loading
filesystem understands. Will then edit your RSS feed and Sitemap to include the
new blogpost you've made.

List of stuff here:

    - The title - POST with the name of "title"
    - The text - POST with the name of "post"
    - The description - POST with the name of "description"

VARIABLES:

    $addDate [required]
    Boolean - Set to true if you want the date when you made your blogpost to appear at the bottom of your text.

-----------------------------------------------------------

addString($haystack, $needle, $addition)

Looks through the $haystack until finds the $needle, then inserts the $addition
after the needle. This is not really a function that comes with the package, but the
createPost() -function requires it.

VARIABLES:

    $haystack [required]
    String - The text that is searched for the $needle
    
    $needle [required]
    String - The text that is searched in the $haystack
    
    $addition [required]
    String - The text that is pasted after the $needle into the $haystack