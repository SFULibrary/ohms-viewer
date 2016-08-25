var vars = [];
var hash;
var q = document.URL.split('?')[1];
if (q !== undefined) {
  q = q.split('&');
  for (var i = 0; i < q.length; i++) {
    hash = q[i].split('=');
    vars.push(hash[1]);
    vars[hash[0]] = hash[1];
  }
}

var preg_quote = function (str) {
  return (str + '').replace(/([\\\.\+\*\?\[\^\]\$\(\)\{\}\=\!\<\>\|\:])/gi, "\\$1");
};

var prevSearch = {
  keyword: '',
  highLines: []
};

var prevIndex = {
  keyword: '',
  matches: []
};

if(typeof searchUrl == 'undefined') {
	searchUrl = 'viewer.php';
}

var clearSearchResults = function (e) {
  if ((e.type == "keypress" && e.which == 13) || e.type == "click") {
    e.preventDefault();
    jQuery('#search-results').empty();
    jQuery('#kw').val('');
    jQuery('span.highlight').removeClass('highlight');
    jQuery("#kw").prop('disabled', false);
    jQuery("#submit-btn").css("display", "inline-block");
    jQuery("#clear-btn").css("display", "none");
  }
};

var activeIndex = false;

if ('index' in vars) {
  activeIndex = parseInt(vars.index);
  if (isNaN(activeIndex)) {
    activeIndex = false;
  }
}

jQuery(document).ready(function ($) {
  $('#kw').on('focus', function (e) {
    if ($('#kw').val() === 'Keyword') {
      $('#kw').toggleClass('kw-entry');
      $('#kw').val('');
    }
  });
  $('#kw').on('blur', function (e) {
    if ($('#kw').val() === '') {
      $('#kw').toggleClass('kw-entry');
      $('#kw').val('Keyword');
    }
  });

  $('#kw').focus();

  $('#accordionHolder').accordion({
    autoHeight: false,
    collapsible: true,
    active: false,
    fillSpace: false,
    change: function (e, ui) {
      $('#index-panel').scrollTo($('.ui-state-active'), 800, {
        easing: 'easeInOutCubic'
      });
    }
  });
});
