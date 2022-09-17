// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js");
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: "AIzaSyANUovdt1apORq-aiSOARqsnkt4s2Q61Uo",
    authDomain: "gabapp-2d12b.firebaseapp.com",
    projectId: "gabapp-2d12b",
    storageBucket: "gabapp-2d12b.appspot.com",
    messagingSenderId: "55539172106",
    appId: "1:55539172106:web:2dc032dbb01d43f850b0f3",
    measurementId: "G-3X0NLCGS86",
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
// messaging.setBackgroundMessageHandler(function (payload) {
//     console.log("Message received.", payload);
//     const title = "Hello world is awesome";
//     const options = {
//         body: "Your notificaiton message .",
//         icon: "/firebase-logo.png",
//     };
//     return self.registration.showNotification(title, options);
// });

messaging.onBackgroundMessage(function (payload) {
    console.log("Received background message ", payload);

    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        // icon: "/logo-GBA.png",
        badge: "/logo-GBA.png",
    };

    self.registration
        .showNotification(notificationTitle, notificationOptions)
        .then(() => self.registration.getNotifications())
        .then((notifications) => {
            setTimeout(
                () =>
                    notifications.forEach((notification) =>
                        notification.close()
                    ),
                3000
            );
        });
});
