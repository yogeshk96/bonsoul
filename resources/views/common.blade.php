<div class="modal fade" id="login-modal" style="overflow:hidden;">
    <div class="row login-container" style="padding: 2em 0;">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                class="sr-only">Close</span></button>
        <h3 class="modal-title">Login into BonSoul</h3>

        <div class="classic-login col-sm-6" style="padding-top:0;min-height:120px;">
            <div class="login-form" id="signin">
                <div class="form-group">
                    <input class="form-control bms-txt-back" type="email" placeholder="E-Mail" id="email">
                </div>
                <div class="form-group">
                    <input class="form-control bms-txt-back" type="password" placeholder="Password" id="password">
                </div>
                <div class="form-group" style="width:100%;">
                    <button class="btn btn-bms btn-login"><span style="font-size:12px;">Sign In</span></button>
                    <div class="p-reset-btn">
                        <a href="#p-reset-modal" data-dismiss="modal" data-toggle="modal">Forgot Password?</a>
                    </div>
                </div>
                <div class="form-toggle-info text-center">
                    <p style="font-size:13px;">Don't have a BonSoul account?</p>
                    <a href="#signup">Sign Up</a>
                </div>
            </div>
            <div class="login-form hide" id="signup">
                <div class="form-group">
                    <input class="form-control bms-txt-back" type="text" placeholder="Name" id="name">
                </div>
                <div class="form-group">
                    <input class="form-control bms-txt-back" type="email" placeholder="E-Mail" id="email">
                </div>
                <div class="form-group">
                    <input class="form-control bms-txt-back" type="password" placeholder="Password" id="password">
                </div>
                <div class="form-group">
                    <button class="btn btn-bms btn-login"><span>Sign Up</span></button>
                </div>
                <div class="form-toggle-info text-center">
                    <p>Have a BonSoul account?</p>
                    <a href="#signin">Sign In</a>
                </div>
            </div>

        </div>
        <div class="social-login col-sm-6" style="padding-top:0;min-height:150px;">
            <div class="login-row">
                <button class="btn btn-bms btn-login fb-login">
                    <i class="fa fa-facebook" ></i><span>Sign In with Facebook</span>
                </button>
            </div>
            <div class="login-row">
                <button class="btn btn-bms btn-login google-login">
                    <i class="fa fa-google-plus"></i><span>Sign In with Google</span>
                </button>
            </div>
        </div>
        <div class="col-xs-12 guest-login hide">
            <a href="#">Continue as a guest!</a>
        </div>
    </div>
</div>



<div class="modal fade" id="p-reset-modal">
    <div class="row login-container">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                class="sr-only">Close</span></button>
        <h3 class="modal-title">Reset your password</h3>

        <div class="text-center">
            <div class="login-form" id="forgot-password">
                <div class="form-group">
                    <input class="form-control bms-txt-back" type="email" placeholder="E-Mail" id="email">
                </div>
                <div class="form-group">
                    <button class="btn btn-bms btn-login">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>