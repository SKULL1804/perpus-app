// $(document).ready(function(){
//     $('#image').change(function(e){
//         var reader = new FileReader();
//         reader.onload = function(e){
//             $('#showimage').attr('src',e.target.result);
//         }
//         reader.readAsDataURL(e.target.files['0']);
//     });
// });
$(document).ready(function(){
    $('input[type="file"]').change(function(e){
        if ($(this).attr('id') === 'image' || $(this).attr('id') === 'image_buku')  {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showimage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });
});


