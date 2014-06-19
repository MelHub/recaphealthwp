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
