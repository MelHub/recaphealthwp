/*********************************************************************************/
/* Team bio section                                                              */
/*********************************************************************************/

var recap = {
  teamShow: function() {
    var team = $(this),
        bioID = team.data('bio'),
        bio = $("#"+bioID);

    bio.siblings('.team-extended-bio').addClass('hidden');
    bio.removeClass('hidden');
  },  
	portfolioShow: function() {
    var company = $(this),
				blurbID = company.data('logo'),
        blurb = $("#"+blurbID);


		blurb.siblings('.portfolio-extended').addClass('hidden');
    blurb.removeClass('hidden');
    
  },
	contactForm: function() {
		var name = $("#contact_name").val(),
				email = $("#contact_email").val(),
				msg		= $("#contact_message").val(),
				formData = {name: name, email: email, message: msg},
				form	= $(this);

		$.post('/php_lib/mailer.php', formData, function(data) {
				if (data.result) {
					form.replaceWith('<h2>Thank you for submitting.</h2>');
				}
		}, 'json');
	}
};

$(function() {
  $(".team-pic").hover(recap.teamShow, function() {});  
  $(".portfolio-item").hover(recap.portfolioShow, function() {});
	$("#contactForm").on('submit', recap.contactForm);
});

