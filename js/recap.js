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
  }
};

$(function() {
  $(".team-pic").hover(recap.teamShow, function() {});  
});


/*********************************************************************************/
/* Portfolio                                                                     */
/*********************************************************************************/


var portfolio = {
  portfolioShow: function() {
    var company = $(this),
        companyID = company.data('logo'),
        logo = $("#" + companyID);

    logo.siblings('.portfolio-extended').addClass('hidden');
    logo.removeClass('hidden');
  }
};

$(function() {
  $(".portfolio-item").hover(portfolio.portfolioShow, function() {
    console.log('hey');
  }); 
});