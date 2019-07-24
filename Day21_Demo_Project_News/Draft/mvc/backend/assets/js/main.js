$(document).ready(function () {
    // tích hợp ckediter vào texteria
    CKEDITOR.replace( 'category-description', {
        filebrowserBrowseUrl: 'assets/ckfinder/ckfinder.html',
        filebrowserUploadUrl: 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    } );
    CKEDITOR.replace('content-description', {
            filebrowserBrowseUrl: 'assets/ckfinder/ckfinder.html',
            filebrowserUploadUrl: 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        }
    )
});

