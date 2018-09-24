
  var Joomla;

  Joomla = Joomla || {};

  (function($) {
    Joomla.livetoken = {
      findOldtoken: function($form) {
        var old;
        old = false;
        $form.find("input[name][type=hidden]").each(function() {
          if ($(this).attr("name").length === 32) {
            old = $(this).attr("name");
            return false;
          }
        });
        return old;
      },
      callbacks: [],
      findNewToken: function(callback) {
        var t = this;
        // Only request one time;
        if (t.callbacks.length >= 1) {
          this.callbacks.push(callback);
          t.processCallbacks();
          return ;
        }
        this.callbacks.push(callback);
        $.getJSON("/libraries/oliverjl/editable/js/token.php", function(data) {
          t.data = data;
          t.processCallbacks();
        });
      },
      processCallbacks: function() {
        var t = this
        if (!t.data) {
          return ;
        }
        $.each(this.callbacks, function() {
          this(t.data);
        });
      },
      disableForm: function() {
        var t = this;
        $("form").filter(':not(.livetoken)').addClass('livetoken').submit(function(e){
            if (!$(this).hasClass('livetoken-added')) {
              e.preventDefault();
            }
        }).each(function() {
          var oldToken;
          var $form = $(this);
          oldToken = t.findOldtoken($(this));
          if (!oldToken) {
            $(this).addClass('livetoken-added livetoken-notoken');
            return;
          }
          t.findNewToken(function(data) {
            var newToken;
            newToken = data.token || "na";
            if (Joomla.optionsStorage) {
              Joomla.optionsStorage["csrf.token"] = newToken;
            }
            $form.find("input[name='" + oldToken + "']").attr("name", newToken);
            $form.addClass('livetoken-added');
          });
        });
      },
      attach: function() {
        this.disableForm();
      }
    };
    Joomla.livetoken.attach();
  })(jQuery);
