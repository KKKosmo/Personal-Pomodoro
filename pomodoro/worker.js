// this is responsible for keeping the tab awake at all times
setInterval(function() {
  self.postMessage('');
}, 1000);