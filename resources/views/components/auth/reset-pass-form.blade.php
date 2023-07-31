<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90 p-4">
                <div class="card-body">
                    <h4>SET NEW PASSWORD</h4>
                    <br />
                    <label>New Password</label>
                    <input id="password" placeholder="New Password" class="form-control" type="password" />
                    <br />
                    <label>Confirm Password</label>
                    <input id="confirm_password" placeholder="Confirm Password" class="form-control" type="password" />
                    <br />
                    <button onclick="resetPass()" class="btn w-100  btn-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function resetPass() {
        let password = document.getElementById('password').value;
        let confirm_password = document.getElementById('confirm_password').value;

        if (password.length == 0) {
            errorToast("Password is required");
        } else if (confirm_password.length == 0) {
            errorToast("Confirm Password is required");
        } else if (password !== confirm_password) {
            errorToast("Password and Confirm Password should be matched");

        }

        else {
            showLoader();
            let res = await axios.post("/reset-password", {
                password: password,
            });
            hideLoader();

            if (res.status === 200 && res.data['status'] === 'success') {
                successToast(res.data['message']);
                setTimeout(function () {
                    window.location.href = "/login";
                }, 500)

            } else {
                errorToast(res.data['message']);
            }

        }

    }

</script>
