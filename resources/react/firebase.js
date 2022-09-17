import { initializeApp } from "firebase/app";
import {
    getMessaging,
    getToken,
    onMessage,
    // onBackgroundMessage,
} from "firebase/messaging";
// import { onBackgroundMessage } from "firebase/messaging/sw";

var firebaseConfig = {
    apiKey: "AIzaSyANUovdt1apORq-aiSOARqsnkt4s2Q61Uo",
    authDomain: "gabapp-2d12b.firebaseapp.com",
    projectId: "gabapp-2d12b",
    storageBucket: "gabapp-2d12b.appspot.com",
    messagingSenderId: "55539172106",
    appId: "1:55539172106:web:2dc032dbb01d43f850b0f3",
    measurementId: "G-3X0NLCGS86",
};

const firebaseApp = initializeApp(firebaseConfig);
const messaging = getMessaging(firebaseApp);

export const fetchToken = (setTokenFound) => {
    return getToken(messaging, {
        vapidKey:
            "BCTiSuRkN71sKQaXyYmufcNi0RqcZec-TODF7RHnLmnHGGTNdquvG4LtWX4TtZk9utfOKujQqMY2Nm3UwuGoav0",
    })
        .then((currentToken) => {
            if (currentToken) {
                console.log("current token for client: ", currentToken);
                setTokenFound(true);
                // Track the token -> client mapping, by sending to backend server
                // show on the UI that permission is secured
            } else {
                console.log(
                    "No registration token available. Request permission to generate one."
                );
                setTokenFound(false);
                // shows on the UI that permission is required
            }
        })
        .catch((err) => {
            console.log("An error occurred while retrieving token. ", err);
            // catch error while creating client token
        });
};

export const onMessageListener = () =>
    new Promise((resolve) => {
        onMessage(messaging, (payload) => {
            resolve(payload);
        });
    });

export const onBackgroundMessageListener = () =>
    new Promise((resolve) => {
        onBackgroundMessage(messaging, (payload) => {
            resolve(payload);
        });
    });

// onBackgroundMessage(messaging, (payload) => {
//     console.log(
//         "[firebase-messaging-sw.js] Received background message ",
//         payload
//     );
//     // Customize notification here
//     const notificationTitle = "Background Message Title";
//     const notificationOptions = {
//         body: "Background Message body.",
//         icon: "/firebase-logo.png",
//     };

//     self.registration.showNotification(notificationTitle, notificationOptions);
// });
