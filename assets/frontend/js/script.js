;(function ($) {

  $('#helpscout-reply-form').on( 'submit', function (e) {
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

        if( !message == '') {
          this.remove();
        }
        
  } );

  viewBtn = $('.view-btn');
  replyBtn = $('.reply-btn');


  formWrap = $('#helpscout-reply-form');
  viewThread = $('#support-conversation-thread');

  viewThread.hide();
  formWrap.hide();

  replyBtn.on('click', function(e) {
    e.preventDefault();
    viewThread.hide();

    formWrap.slideDown( 500, function() {
      $( this ).show();
      
    });
  })

  viewBtn.on('click', function(e) {
    e.preventDefault();
    formWrap.hide();
    
    viewThread.slideDown( 500, function() {
      $( this ).show();
      
    });
  })



})(jQuery);
