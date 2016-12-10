jQuery(document).ready(function($) {
  $('.btn-remove').on('click', function(e) {
    if(!confirm('Are you sure?')) {
      e.preventDefault();
    }
  });
});