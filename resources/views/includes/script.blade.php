<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    @if(auth()->check())
    
      var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
        cluster: 'ap2'
      });
    
      @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
      var channel = pusher.subscribe('notification');
          channel.bind('task.update', function(data) {
              toastr.info("Task Updates", data.message);
          });
      @endif
    @endif
  
  </script>