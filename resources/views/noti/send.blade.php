<!DOCTYPE html>
<html>

<head>
    <title>NOTI</title>
    <!-- firebase integration started -->
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
    <!-- Firebase App is always required and must be first -->
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>

</head>

<body>
    FIREBASE
    <a href="{{url("noti/send")}}">Send noti</a>
</body>
< <script type="text/javascript">
        // Your web app's Firebase configuration
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
        firebase.initializeApp(firebaseConfig);
        // app =   firebase.initializeApp(firebaseConfig);
        // const analytics = firebase.getAnalytics(app);

        //firebase.analytics();
        const messaging = firebase.messaging();
        messaging
            .requestPermission()
            .then(function() {
                //MsgElem.innerHTML = "Notification permission granted." 
                console.log("Notification permission granted.");

                // get the token in the form of promise
                return messaging.getToken()
            })
            .then(function(token) {
                // print the token on the HTML page     
                console.log(token);




            })
            .catch(function(err) {
                console.log("Unable to get permission to notify.", err);
            });

        messaging.onMessage(function(payload) {
            console.log(payload);
            var notify;
            notify = new Notification(payload.notification.title, {
                body: payload.notification.body,
                icon: payload.notification.icon,
                tag: "Dummy"
            });
            console.log(payload.notification);
        });

        firebase.initializeApp(config);
        var database = firebase.database().ref().child("/users/");

        database.on('value', function(snapshot) {
            renderUI(snapshot.val());
        });

        // On child added to db
        database.on('child_added', function(data) {
            console.log("Comming");
            if (Notification.permission !== 'default') {
                var notify;

                notify = new Notification('CodeWife - ' + data.val().username, {
                    'body': data.val().message,
                    'icon': 'bell.png',
                    'tag': data.getKey()
                });
                notify.onclick = function() {
                    alert(this.tag);
                }
            } else {
                alert('Please allow the notification first');
            }
        });

        self.addEventListener('notificationclick', function(event) {
            event.notification.close();
        });
    </script>

</html>