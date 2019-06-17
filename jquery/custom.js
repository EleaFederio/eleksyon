$(document).ready(function(){

$(".ctype").click(function(){
var id = $(this).attr("id");
			$.post("ajax.php?ctype="+id,function(data){
					if(data){
						$(".cposition").html(data);
					}
			});	
});
		
$('.item_name').change(function () {
  $('.item_name option').show(0);
  $('.item_name option:selected').each(function () {
	 oIndex = $(this).index();
	 if (oIndex > 0) {
		$('.item_name').each(function (){
		   $(this).children('option').eq(oIndex).not(':selected').hide(0);
		});
	 }
  });
});

});

