var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
    if ($(document).scrollTop() > 300) {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos < currentScrollPos) {
            document.getElementById("TopNavbar").style.top = "-100px";
        } else {
            document.getElementById("TopNavbar").style.top = "0";
        }
        prevScrollpos = currentScrollPos;
    }
}

$(window).scroll(function() {
    if ($(document).scrollTop() > 100) {
        $('.navbar').addClass('affix');
        $('.imgNavbar').addClass('affix-img');
        $('.dropdown-content').addClass('affix-dropdown');
        // console.log("OK");
    } else {
        $('.navbar').removeClass('affix');
        $('.imgNavbar').removeClass('affix-img');
        $('.dropdown-content').removeClass('affix-dropdown');
    }
  });
