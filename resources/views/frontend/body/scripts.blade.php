<!-- script file here -->
<script src="{{asset ('frontend/./public/assets/plugins/js/jquery.js') }}"></script>
<script src="{{asset ('frontend/./public/assets/plugins/js/swipper.js') }}"></script>
<script src="{{asset ('frontend/./public/assets/plugins/js/select2.js') }}"></script>
<script src="{{asset ('frontend/./public/assets/plugins/js/mixitUp.js') }}"></script>
<script src="{{asset ('frontend/./public/js/app.js') }}"></script>
<script>
    function dismiss(el){
    el.parentNode.style.display='none';
    };
</script>
<script>
    $('.test').change(function(){
   
     if($(this).is(":checked")) {
         $('.changeme').removeClass('hidden');
     } else {
         $('.changeme').addClass('hidden');
     }
 });

//         $("#change-color").change(function() {
//     if(this.checked) {
//         $("#dynamic-color").addClass('new-class');
//     } else {
//         $("#dynamic-color").removeClass("new-class")
//     }
//   });

$("#chkFacility3").click(function () {
         if ($(this).is(":checked")) {
             $("#div3").removeClass('hidden');
         } else {
             $("#div3").addClass('hidden');
         }
     });

</script>