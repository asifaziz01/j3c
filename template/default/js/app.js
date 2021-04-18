window.addEventListener("load", async (e) => {
  // Register Servie-worker
  if ("serviceWorker" in navigator) {
    navigator.serviceWorker
      .register('sw.js')
      .then(function (swReg) {
        swRegistration = swReg;
      }).catch(function (error) {
        console.error("Service Worker Error", error);
      });
  }
});
