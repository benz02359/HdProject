export const inicializarFirebase = () => {
    firebase.initializeApp({
      messagingSenderId: 'your messagingSenderId'
    });
  navigator.serviceWorker
      .register('/my-sw.js')
      .then((registration) => {
        firebase.messaging().useServiceWorker(registration);
      });
  }

  importScripts('https://www.gstatic.com/firebasejs/4.8.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/4.8.1/firebase-messaging.js');
firebase.initializeApp({
    messagingSenderId: "your messagingSenderId again"
});
const messaging = firebase.messaging();