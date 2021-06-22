<header>
    <div class="handle">
        <h1>Register for Fairy Castle</h1>
    </div>
</header>

<section>
    <article class="inputForm">
        <div class="handle">

        <?php
            if(isset($_GET["exists"])){
                ?>
                <div class="alertMsg">
                    <p>ERROR: Email address or username already exists.</p>
                </div>
                <?php
            } 
        ?>    

            <form id="form" method="post" action="index.php?controller=process&action=processRegister"> <!-- Check the file name -->
                <div class="fieldset required half">
                    <input type="email" name="email" placeholder="email"/>
                    <div class="errorMsg">
                        <p>This field is required.</p>
                    </div>
                </div>
                <div class="fieldset required half">
                    <input type="text" name="username" placeholder="Username"/>
                    <div class="errorMsg">
                        <p>This field is required.</p>
                    </div>
                </div>
                <div class="fieldset required half">
                    <input type="text" name="firstName" placeholder="First Name"/>
                    <div class="errorMsg">
                        <p>This field is required.</p>
                    </div>
                </div>
                <div class="fieldset required half">
                    <input type="text" name="lastName" placeholder="Last Name"/>
                    <div class="errorMsg">
                        <p>This field is required.</p>
                    </div>
                </div>
                <div class="fieldset required half">
                    <input type="password" name="password" placeholder="Password" id="password"/>
                    <div class="errorMsg">
                        <p>This field is required.</p>
                    </div>
                </div>
                <div class="fieldset required half">
                    <input type="password" name="confirmPassword" placeholder="Confirm Password" id="confirmPassword"/>
                    <div class="errorMsg">
                        <p>This field is required.</p>
                    </div>
                </div>
                <div class="fieldset submit">
                    <input type="submit" value="Register" class="btn-1"/>
                </div>
            </form>
            <div class="notice">
                <p><span>Already Registered?</span> Head back to <a href="index.php?controller=pages&action=login"> Login</a></p>
            </div>  
        </div>     
    </article>

</section>

<script type="text/javascript" src="js/form_validator.js"></script>
<script type="text/javascript" src="js/backgroundimage.js"></script>