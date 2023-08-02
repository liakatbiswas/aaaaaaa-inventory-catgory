<div class="container">
    <div class="row">
        <div class="col-md-10 col-lg-10">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>User Profile</h4>
                    <hr />
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>First Name</label>
                                <input id="firstName" placeholder="First Name" class="form-control" type="text" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Last Name</label>
                                <input id="lastName" placeholder="Last Name" class="form-control" type="text" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input id="email" placeholder="User Email" class="form-control" type="email" readonly />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Phone Number</label>
                                <input id="phone" placeholder="Phone" class="form-control" type="mobile" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control" type="password" />
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="registerUser()" class="btn mt-3 w-100  btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    getProfile();
    async function getProfile() {
        showLoader();
        let res = await axios.get("/user-profile");
        hideLoader();

        if (res.status === 200 && res.data['status'] === 'success') {
            let data = res.data['data'];
            document.getElementById('email').value = data['email'];
            document.getElementById('firstName').value = data['firstName'];
            document.getElementById('lastName').value = data['lastName'];
            document.getElementById('phone').value = data['phone'];
            document.getElementById('password').value = data['password'];

        } else {
            errorToast(res.data['message']);
        }
    }



    async function registerUser() {
        let firstName = document.getElementById('firstName').value;
        let lastName = document.getElementById('lastName').value;
        let phone = document.getElementById('phone').value;
        let password = document.getElementById('password').value;

        if (firstName.length == 0) {
            errorToast("First Name is required");
        } else if (lastName.length == 0) {
            errorToast("Last Name is required");
        } else if (phone.length == 0) {
            errorToast("Phone is required");
        } else if (password.length == 0) {
            errorToast("Password is required");
        } else {
            showLoader();
            let res = await axios.post("/user-profile-update", {
                firstName: firstName,
                lastName: lastName,
                phone: phone,
                password: password
            });
            hideLoader();

            if (res.status === 200 && res.data['status'] === 'success') {
                successToast(res.data['message']);
               await getProfile();
            } else {
                errorToast(res.data['message']);
            }
        }
    }
</script>
