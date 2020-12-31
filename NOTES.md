# File upload form : 

We're using the plugin "[Frontend Uploader](https://wordpress.org/plugins/frontend-uploader/)" 
Here is the shortcode to add to the submissions page : 
```
[fu-upload-form class="html-wrapper-class" form_layout="media" suppress_default_fields="true" success_page="/submission-success/"]
[input type="text" name="post_title" id="title" required="true" description="Title"]
[input type="email" name="email" required="true" description="Contact information"]
[input type="file" name="document" required="true" description="Upload"]
[input type="submit" class="btn" value="Submit"]
[/fu-upload-form]
```
The sortcode may be added using the shortcode block type. 