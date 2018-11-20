(function () {

  'use strict';


  // Hide flash messages on click
  var flash_hide = document.querySelector('#flash-container-close');

  flash_hide.onclick = function(e) {
    var flash_container = document.querySelector('.flash-container');
    flash_container.classList.add('hidden');
  };

})();
