            <article class="reservationForm" id="condition">
                <div class="container">
                    <?php
                        if(isset($_GET["inputError"])){
                            ?>
                            <div class="errorMsg">
                                <p>ERROR: Please fill out all fields.</p>
                            </div>
                            <?php
                        } else if (isset($_GET["unavailable"])) {
                            ?>
                            <div class="errorMsg">
                                <p>This period is already booked. Please select a different date.</p>
                            </div>
                            <?php                    
                        } else if (isset($_GET["overCapacity"])) {
                            ?>
                            <div class="errorMsg">
                                <p>The capacity of this accommodation is <span><?=$_SESSION["occupancy"]?></span> people.</p>
                            </div>
                            <?php                      
                        }
                    ?>
                    <div class="searchForm">
                        <form action="index.php?controller=pages&action=payment" method="post">
                            <input type="hidden" name="propertyId" value="<?=$_GET["propertyId"]?>">
                            <div class="fieldset pricePerNight">
                                <p>&#036;<?=$this->state["property"]->pricePerNight?>/night</p>                             
                            </div>
                            <div class="fieldset required half">
                                <label>Check in</label>
                                <?php
                                    date_default_timezone_set('America/Vancouver');
                                    $today = date('Y-m-d');
                                    $checkIn = isset($_POST["checkIn"]) ? $_POST["checkIn"] : $_SESSION["checkIn"];
                                ?>                                 
                                <input type="date" name="checkIn" id="checkIn" value="<?=$checkIn?>" min="<?=$today?>"/>
                                <div class="errorMsg">
                                    <p>This field is required.</p>
                                </div>
                            </div>
                            <div class="fieldset required half">
                                <label>Check out</label>
                                <?php
                                if($_SESSION["checkOut"]){
                                    ?>
                                    <input type="date" name="checkOut" value="<?=$_SESSION["checkOut"]?>"/>
                                    <div class="errorMsg">
                                        <p>This field is required.</p>
                                    </div>       
                                    <?php
                                } elseif($_POST["checkOut"]) {
                                    ?>
                                    <input type="date" name="checkOut" id="checkOut" value="<?=$_POST["checkOut"]?>"/>
                                    <div class="dateErrorMsg">
                                        <p>Check-out date must be after the check-in.</p>
                                    </div>
                                    <div class="errorMsg">
                                        <p>This field is required.</p>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <input type="date" name="checkOut" id="checkOut" value="" readonly/>
                                    <div class="dateErrorMsg">
                                        <p>Check-out date must be after the check-in.</p>
                                    </div>
                                    <div class="errorMsg">
                                        <p>This field is required.</p>
                                    </div>
                                    <?php                                    
                                }
                                ?>
                            </div>
                            <div class="fieldset required half">
                                <label>Number of guests</label>
                                <?php
                                    date_default_timezone_set('America/Vancouver');
                                    $today = date('Y-m-d');
                                    $numGuests = isset($_POST["numGuests"]) ? $_POST["numGuests"] : $_SESSION["numGuests"];
                                ?> 
                                <input type="number" min="1" step="1" name="numGuests" value="<?=$numGuests?>"/>
                                <div class="errorMsg">
                                    <p>This field is required.</p>
                                </div>  
                            </div>
                            <div class="fieldset priceDetail">
                                <table>
                                    <tr>
                                        <?php
                                        if($this->state["stay"] > 1){
                                            ?>
                                            <td class="item">&#036;<?=$this->state["property"]->pricePerNight?> X <?=$this->state["stay"]?> nights</td>
                                            <?php
                                        } else {
                                            ?>
                                            <td class="item">&#036;<?=$this->state["property"]->pricePerNight?> X <?=$this->state["stay"]?> night</td>
                                            <?php                                            
                                        }
                                        ?>                                        
                                        <td class="price">&#036;<?=($this->state["property"]->pricePerNight)*$this->state["stay"]?></td>
                                    </tr>
                                    <tr class="line">
                                        <td>Service fee</td>
                                        <td class="price">&#036;0</td>
                                    </tr>
                                    <tr class="total">
                                        <td class="item">Total</td>
                                        <td class="price">&#036;<?=($this->state["property"]->pricePerNight)*$this->state["stay"]?></td>
                                    </tr>
                                </table>
                            </div>                                         
                            <div class="fieldset submit">
                                <input type="submit" value="Reserve" class="btn-1">
                            </div><!-- fieldset -->
                        </form>
                    </div>
                </div>
            </article>
        </div>
    </div>

    <article class="reviews" id="reviews">        
        <div class="handle">
            <div class="title">
                <h2>Reviews</h2>
            </div>
            <div class="summary">
                <?php
                if($this->state["reviewSummary"]["aveRating"]){
                    ?>
                    <p class="star"><i class="fas fa-star"></i><?=$this->state["reviewSummary"]["aveRating"]?></p>
                    <?php
                } 
                if($this->state["reviewSummary"]["numOfReviews"] > 1){
                    ?>
                    <p>(<?=$this->state["reviewSummary"]["numOfReviews"]?> reviews)</p>
                    <?php
                } else {
                    ?>
                    <p>(<?=$this->state["reviewSummary"]["numOfReviews"]?> review)</p>
                    <?php                    
                }
                ?>                
            </div>  
            <div class="reviewList">
            <?php
            foreach ($this->state["reviews"] as $review) {
            ?>
                <div class="reviewCard">
                    <p class="star"><i class="fas fa-star"></i><?=$review->rating?></p>   
                    <h4 class="username"><?=$review->username?></h4>
                    <p class="date"><?=$review->date?></p>
                    <p class="comment"><?=$review->comment?></p>
                </div>
            <?php
            }
            ?>
            </div>
        </div>
    </article>

</section>

<script type="text/javascript" src="js/backgroundimage.js"></script>
<script type="text/javascript" src="js/datecheck.js"></script>
<script type="text/javascript" src="js/form_validator.js"></script>
<script type="text/javascript" src="js/modal.js"></script>