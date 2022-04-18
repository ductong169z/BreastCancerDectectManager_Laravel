@extends('layouts.admin')

@section('main-content')


<div class="bg-light p-4 rounded">
    <h1>Notifications</h1>
    <div id="token"></div>

</div>
<script src="{{url('js/firebase-app.js')}}"></script>
    <script src="{{url('js/firebase-messaging.js')}}"></script>

    <script type="module">
        // Give the service worker access to Firebase Messaging.
        // Note that you can only use Firebase Messaging here. Other Firebase libraries
        // are not available in the service worker.


        // Initialize the Firebase app in the service worker by passing in
        // your app's Firebase config object.
        // https://firebase.google.com/docs/web/setup#config-object
        const firebaseConfig = {
            apiKey: "AIzaSyDvGuj8QiRIroi61EgAbBtfhpxuoOtbg5U",
            authDomain: "bcds-6d294.firebaseapp.com",
            projectId: "bcds-6d294",
            storageBucket: "bcds-6d294.appspot.com",
            messagingSenderId: "237181161183",
            appId: "1:237181161183:web:ae93d14a4ee13166e6236a",
            measurementId: "G-CRB8QXYRQP"
        };

        // Initialize Firebase
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);


        // Initialize Firebase Cloud Messaging and get a reference to the service
        const messaging = firebase.messaging();


        // Get registration token. Initially this makes a network call, once retrieved
        // subsequent calls to getToken will return from cache.
        messaging.getToken({
            vapidKey: 'BLmMsb_xT87duSJa8dB1tQUsBOW10xkjm5tLRtQcXRb2cxCIqqd4uegGPqG18nyspRzcVMZj3vAJTi2MBLjO5lc'
        }).then((currentToken) => {
            if (currentToken) {
                console.log(currentToken)
                document.getElementById('token').innerText = currentToken;
            } else {
                // Show permission request UI
                console.log('No registration token available. Request permission to generate one.');

                // ...
            }
        }).catch((err) => {
            console.log('An error occurred while retrieving token. ', err);
            // ...
        });

        messaging.onMessage(function(payload)) {

        }

    </script>

@endsection
