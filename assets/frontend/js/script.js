;(function ($) {

  $('#support-conversation-wrap').on( 'submit', function (e) {
        e.preventDefault();
        var message = $('#message').val();
        $.ajax({
          url: Ticket.ajax_url,
          method: 'post',
          data: {
            action: 'crete_thread',
            message: message,
            conversation_id:'',
          },
          success: function (success) {
            console.log(success);
          }
        });
  } );

})(jQuery);
