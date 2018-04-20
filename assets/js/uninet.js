$(document).ready(function() {


//Button for profile post
	$('#postbutton1').click(function(){
		
		$.ajax({
			type: "POST",
			url: "includes/handlers/ajaxSendPost.php",
			data: $('form.profileP').serialize(),
			success: function(msg) {
				$("#postform").modal('hide');
				location.reload();
			},
			error: function() {
				alert('Failure');
			}
		});

	});
});

