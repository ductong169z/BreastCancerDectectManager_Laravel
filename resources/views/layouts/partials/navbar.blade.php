<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow ">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>

    </button>

    {{-- <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form> --}}

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Nav Item - Alerts -->

        <li class="nav-item dropdown no-arrow mx-1">
            @can('notification.index')
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="loadNotifications()">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span id="number_noti" class="badge badge-danger badge-counter"></span>
            </a>
            @endcan

            <!-- Dropdown - Alerts -->
            <div id="noti_data" class="dropdown-list dropdown-menu dropdown-scrollbar dropdown-menu-right shadow animated--grow-in" style='min-height:190px;max-height:500px;overflow: scroll;' aria-labelledby="alertsDropdown">


            </div>
        </li>

        {{-- <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                    Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div class="font-weight-bold">
                        <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                        <div class="small text-gray-500">Emily Fowler ?? 58m</div>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                        <div class="status-indicator"></div>
                    </div>
                    <div>
                        <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                        <div class="small text-gray-500">Jae Chun ?? 1d</div>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                        <div class="status-indicator bg-warning"></div>
                    </div>
                    <div>
                        <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                        <div class="small text-gray-500">Morgan Alvarez ?? 2d</div>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div>
                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                        <div class="small text-gray-500">Chicken the Dog ?? 2w</div>
                    </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
            </div>
        </li> --}}

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                <figure class="img-profile rounded-circle avatar font-weight-bold" data-initial="{{ Auth::user()->name[0] }}"></figure>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('profile') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('Profile') }}
                </a>
                <a class="dropdown-item" href="{{ route('profile.reset_password', Auth::user()->id) }}">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('Change Password') }}
                </a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('Logout') }}
                </a>
            </div>
        </li>

    </ul>

</nav>


<!--  reload bell number every 1 second  -->
<script>
    

    //load and render unread notification
    function loadNotifications() {
        var n_data = document.getElementById("noti_data");

        var req = new XMLHttpRequest();
        req.open("GET", "{{route('notification.load')}}", true);
        req.send();
        n_data.innerHTML = "<h6 class='dropdown-header'>Notification Center</h6>";

        //render notifications
        req.onreadystatechange = function() {
            if (req.readyState == 4 && req.status == 200) {
                var obj = JSON.parse(req.responseText);
                if (obj.notifications.length == 0) {
                    n_data.innerHTML += "<div class='dropdown-item text-center text-gray-500'>You do not have any new notify yet</div>";
                } else {
                    $("#number_noti").text(obj.noticationsBell.length);
                    n_data.innerHTML += "<div class='dropdown-list dropdown-menu dropdown-scrollbar dropdown-menu-right shadow animated--grow-in' style='height: 500px;overflow: scroll;' aria-labelledby='alertsDropdown'>";
                    for (i = 0; i < obj.notifications.length; i++) {
                        n_data.innerHTML +=
                            "<a class='dropdown-item d-flex align-items-center '  href='{{ route('notification.update','') }}/" + obj.notifications[i]['id'] + "'" +
                            "<div class='col mr-3'>" +
                            "<div class='col mr-3'>" +
                            "<div class='icon-circle bg-primary'>" +
                            "<i class='fas fa-file-alt text-white'></i>" +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            "<div>" +
                            "<div class='small text-gray-500'>" + obj.notifications[i]['title'] + "</div>" +
                            "<span class='font-weight-bold'>" + obj.notifications[i]['body'] + "</span>" +
                            "</div>" +
                            "</a>";


                    }
                    n_data.innerHTML += "</div>";

                }
                n_data.innerHTML += "<a class='dropdown-item text-center small text-gray-500' href='{{ route('notification.index') }}'>Show All Notifications</a>";

            }

        }
    }
    loadNotifications();
</script>


<!--inplement firebase-->
<script src="{{url('js/firebase-app.js')}}"></script>
<script src="{{url('js/firebase-messaging.js')}}"></script>
<!--inplement jquery-->
<script src="{{url('js/jquery.min.js')}}" type="text/javascript"></script>

<!--Receive message on client end-->
<script>
    var firebaseConfig = {
        apiKey: "AIzaSyA4w5Q9sjRwWKF4Is_xnPscnVPMgZYRBak",
        authDomain: "laravel-c5e14.firebaseapp.com",
        projectId: "laravel-c5e14",
        storageBucket: "laravel-c5e14.appspot.com",
        messagingSenderId: "318096901092",
        appId: "1:318096901092:web:26e860a7ffaf17a509fdf1",
        measurementId: "G-B6D7SCKZCY"
    };

    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    messaging
        .requestPermission()
        .then(function() {
            return messaging.getToken()
        })
        .then(function(token) {
            console.log(token);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route("notification.send_token") }}',
                type: 'POST',
                data: {
                    token: token
                },
                dataType: 'JSON',
                success: function(response) {
                    // alert('Token saved successfully.');
                },
                error: function(err) {
                    console.log('User Chat Token Error' + err);
                },
            });

        }).catch(function(err) {
            console.log('User Chat Token Error' + err);
        });


    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,

        };
        new Notification(noteTitle, noteOptions);
    });
</script>


<!-- End of Topbar -->