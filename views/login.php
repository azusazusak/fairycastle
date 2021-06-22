<header>
    <div class="handle">
        <h1>Login to Fairy Castle</h1>
    </div>
</header>

<section>
    <article class="inputForm">
        <div class="handle">

        <?php
            if(isset($_GET["loginError"])){
                ?>
                <div class="alertMsg">
                    <p>ERROR: Username or Password is incorrect.</p>
                </div>
                <?php

            } else if(isset($_GET["registerSuccess"])) {
                ?>
                <div class="alertMsg">
                    <p>Registered successfully. Login to the main page.</p>
                </div>
                <?php
            }
        ?>        

            <form id="form" method="post" action="index.php?controller=process&action=processLogin"> <!-- Check the file name -->
                <div class="fieldset required half">
                    <input type="text" name="username" placeholder="Username"/>
                    <div class="errorMsg">
                        <p>This field is required.</p>
                    </div>
                </div>
                <div class="fieldset required half">
                    <input type="password" name="password" placeholder="Password"/>
                    <div class="errorMsg">
                        <p>This field is required.</p>
                    </div>
                </div>
                <div class="fieldset submit">
                    <input type="submit" value="Login" class="btn-1"/>
                </div>
            </form>
            <div class="notice">
                <p><span>New Here?</span> Let's get you <a href="index.php?controller=pages&action=register">Registered </a></p>
            </div>  
        </div>     
    </article>
</section>

<script type="text/javascript" src="js/form_validator.js"></script>
<script type="text/javascript" src="js/backgroundimage.js"></script>