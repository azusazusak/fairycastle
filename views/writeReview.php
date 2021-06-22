<header class="pageTitle">
    <div class="handle">
        <h1>Write a review</h1>
    </div>
</header>

<section>
    <div class="handle">
        <article class="reviewContainer">
            <div class="heading">
                <h2>Give rating and comment to <?=$this->state["reservation"]->propertyName?></h2>
            </div>
            <div class="reviewForm">
                <form method="post" action="index.php?controller=process&action=processWriteReview">
                    <input type="hidden" name="reservationId" value="<?=$_GET["reservationId"]?>">
                    <?php
                        date_default_timezone_set('America/Vancouver');
                        $today = date('Y-m-d');
                    ?>  
                    <input type="hidden" name="date" value="<?=$today?>">
                    <div class="fieldset required half">
                        <label>Rating</label>
                        <select name="rating" id="rating">
                            <option value="">- Select -</option>
                            <option value="1">1 - Poor</option>
                            <option value="2">2 - Fair</option>
                            <option value="3">3 - Average</option>
                            <option value="4">4 - Good</option>
                            <option value="5">5 - Excellent</option>
                        </select>
                        <div class="errorMsg">
                            <p>Please select one.</p>
                        </div> 
                    </div>
                    <div class="fieldset required">
                        <label>Comment</label>
                        <textarea name="comment"></textarea>
                        <div class="errorMsg">
                            <p>This field is required.</p>
                        </div>
                    </div>
                    <div class="fieldset submit">
                        <input type="submit" value="Submit" class="btn-1">
                    </div>
                </form>
            </div>

        </article>
    </div>
</section>

<script type="text/javascript" src="js/form_validator.js"></script>