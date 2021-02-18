function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#image-ava').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#input-ava").change(function(){
    readURL(this);
});