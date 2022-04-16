// importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js');
// importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js');

// // Initialize the Firebase app in the service worker by passing in the
// // messagingSenderId.
// firebase.initializeApp({
//   apiKey: "AIzaSyA4w5Q9sjRwWKF4Is_xnPscnVPMgZYRBak",
//   authDomain: "laravel-c5e14.firebaseapp.com",
//   projectId: "laravel-c5e14",
//   storageBucket: "laravel-c5e14.appspot.com",
//   messagingSenderId: "318096901092",
//   appId: "1:318096901092:web:26e860a7ffaf17a509fdf1",
//   measurementId: "G-B6D7SCKZCY"
// });

// // Retrieve an instance of Firebase Messaging so that it can handle background
// // messages.
// const messaging = firebase.messaging();

// messaging.setBackgroundMessageHandler(function(payload) {
//   console.log('[firebase-messaging-sw.js] Received background message ', payload);
//   // Customize notification here
//   const notificationTitle = 'Background Message Title';
//   const notificationOptions = {
//     body: 'Background Message body.',
//     icon: 'https://images.theconversation.com/files/93616/original/image-20150902-6700-t2axrz.jpg' //your logo here
//   };

//   return self.registration.showNotification(notificationTitle,
//       notificationOptions);
// });
/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
  apiKey: "AIzaSyA4w5Q9sjRwWKF4Is_xnPscnVPMgZYRBak",
  authDomain: "laravel-c5e14.firebaseapp.com",
  projectId: "laravel-c5e14",
  storageBucket: "laravel-c5e14.appspot.com",
  messagingSenderId: "318096901092",
  appId: "1:318096901092:web:26e860a7ffaf17a509fdf1",
  measurementId: "G-B6D7SCKZCY"
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
  console.log(
    "[firebase-messaging-sw.js] Received background message ",
    payload,
  );
  /* Customize notification here */
  const notificationTitle = "Background Message Title";
  const notificationOptions = {
    body: "Background Message body.",
    icon: "/itwonders-web-logo.png",
  };

  return self.registration.showNotification(
    notificationTitle,
    notificationOptions,
  );
});