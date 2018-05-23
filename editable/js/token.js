
  var Joomla;

  Joomla = Joomla || {};

  (function($) {
    Joomla.livetoken = {
      findOldtoken: function() {
        var old;
        old = false;
        $("input[name][type=hidden]").each(function() {
          if ($(this).attr("name").length === 32) {
            old = $(this).attr("name");
            return false;
          }
        });
        return old;
      },
      attach: function() {
        var oldToken;
        oldToken = this.findOldtoken();
        if (!oldToken) {
          return;
        }
        $.getJSON("/libraries/oliverjl/editable/js/token.php", function(data) {
          var newToken;
          newToken = data.token || "na";
          if (Joomla.optionsStorage) {
            Joomla.optionsStorage["csrf.token"] = newToken;
          }
          $("input[name='" + oldToken + "']").attr("name", newToken);
          console.warn(["got token", data]);
        });
      }
    };
    Joomla.livetoken.attach();
  })(jQuery);
