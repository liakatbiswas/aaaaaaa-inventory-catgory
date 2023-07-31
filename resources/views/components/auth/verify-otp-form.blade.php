<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90  p-4">
                <div class="card-body">
                    <h4>ENTER OTP CODE</h4>
                    <br />
                    <label>4 Digit Code Here</label>
                    <input id="otp" placeholder="Code" class="form-control" type="text" />
                    <br />
                    <button onclick="verifyOtp()" class="btn w-100 float-end btn-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    async function verifyOtp() {
        let otp = document.getElementById('otp').value;

        if (otp.length !== 4) {
            errorToast("4 Digit OTP code is required");
        } else {
            showLoader();
            let res = await axios.post("/verify-otp", {
                email: sessionStorage.getItem('email'),
                otp: otp
            });
            hideLoader();

            if (res.status === 200 && res.data['status'] === 'success') {
                successToast(res.data['message']);
                sessionStorage.clear();
                setTimeout(function () {
                    window.location.href = "/resetPassword";
                }, 500)

            } else {
                errorToast(res.data['message']);
            }
        }
    }
</script>
