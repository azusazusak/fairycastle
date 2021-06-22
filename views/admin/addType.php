<header class="pageTitle">
    <div class="handle">
        <h1>Add New Type</h1>
    </div>
</header>

<section>
    <div class="handle">
        <article>
            <form action="index.php?controller=process&action=processAddType" method="post">
                <div class="fieldset required half">
                    <label>Property Type Name</label>
                    <input type="text" name="type"/>
                    <div class="errorMsg">
                        <p>This field is required.</p>
                    </div>
                </div>
                <div class="fieldset submit">
                    <input type="submit" value="Register" class="btn-1"/>
                </div>
            </form>
        </article>
    </div>
</section>