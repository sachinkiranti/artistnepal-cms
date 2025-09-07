# Issues
### Unisharp/FileManager

**Fix issue : file manager page not reload after upload completed**
````
/vendor/unisharp/laravel-filemanager/src/Controllers/UploadController.php
replace
line 46
$response = count($error_bag) > 0 ? $error_bag : parent::$success_response;
by
$response = count($error_bag) > 0 ? $error_bag : array(parent::$success_response);
````
