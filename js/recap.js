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
    
    company.css('width', '100%');
  }

};

$(function() {
  $(".team-pic").hover(recap.teamShow, function() {});  
  $(".portfolio-item").hover(recap.portfolioShow, function() {});
});

