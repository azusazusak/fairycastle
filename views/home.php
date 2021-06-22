<section>
    <article class="searchWindow">        
        <div class="handle">
            <div class="title">
                <h1>Put yourself in an extraordinary world!</h1>
                <p>Fairy Castle is an online booking app specializing in unique accommodation rentals around the world!</p>
            </div>
            <div class="searchForm">
                <h2>Where to next?</h2>
                <form action="index.php?controller=pages&action=results" method="post">                    
                    <div class="fieldset half">
                        <label>Location</label>
                        <input type="text" name="location" value=""/>
                    </div>
                    <div class="fieldset half">
                        <label>Property type</label>
                        <select name="type_id" id="type_id">
                            <option value="">- Select -</option>
                            <?php
                            foreach($this->state["poropertyTypes"] as $type) {
                            ?>
                            <option value="<?=$type["type_id"]?>"><?=$type["type"]?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="fieldset third">
                        <label>Number of guests</label>
                        <input type="number" min="1" step="1" name="numGuests" value=""/>
                    </div>
                    <div class="fieldset third">
                        <label>Check in</label>
                        <?php
                            date_default_timezone_set('America/Vancouver');
                            $today = date('Y-m-d');
                        ?>
                        <input type="date" name="checkIn" id="checkIn" value="" min="<?=$today?>"/>
                    </div>
                    <div class="fieldset third">
                        <label>Check out</label>
                        <input type="date" name="checkOut" id="checkOut" value="" readonly/>
                        <div class="dateErrorMsg">
                            <p>Check-out date must be after the check-in.</p>
                        </div>
                    </div>
                    <div class="fieldset submit">
                        <input type="submit" value="Search" class="btn-1">
                    </div><!-- fieldset -->
                </form>
            </div>
        </div>
    </article>

    <article class="gallery">
        <div class="photo" data-backgroundimage="imgs/pexels-rachel-claire-482570_edited.jpg"></div>
        <div class="photo" data-backgroundimage="imgs/pexels-pixabay-46970_edited.jpg"></div>
        <div class="photo" data-backgroundimage="imgs/pexels-richard-hunterrice-2416472_edited.jpg"></div>
        <div class="photo" data-backgroundimage="imgs/pexels-godson-bright-962464_edited.jpg"></div>
        <div class="photo" data-backgroundimage="imgs/pexels-thorsten-technoman-338504_edited.jpg"></div>
        <div class="photo" data-backgroundimage="imgs/pexels-patryk-kamenczak-775219_edited.jpg"></div>
        <div class="photo" data-backgroundimage="imgs/pexels-jeffrey-czum-4526153_edited.jpg"></div>
        <div class="photo" data-backgroundimage="imgs/matthew-harwood-THTAP-GzI_8-unsplash_edited.jpg"></div>
    </article>

    <article class="description_1">
        <div class="handle">
            <div class="image" data-backgroundimage="imgs/pexels-elina-sazonova-1838554_edited.jpg"></div>
            <div class="textBox">
                <div class="text">
                    <h2>Today, here is your "castle"</h2>
                    <p>A romantic tree house, a majestic castle, a cottage floating on the crystal clear sea.... Why not enjoy your vacation in such a special place? We will only introduce you to unique and exciting accommodations that are different from any other hotel you have ever stayed in.</p>
                </div>
            </div>
        </div>
    </article>

    <article class="description_2">
        <div class="handle">
            <div class="image">
                <img src="imgs/mobile.png" alt="Mobile App">
            </div>
            <div class="textBox">
                <div class="text">
                    <h2>Fairy Castle will take you to an extraordinary world</h2>
                    <p>The fairy tail starts from your laptop or cell phone. Fairy Castle offers more than 10,000 fantastic accommodations all over the world. You are sure to find the perfect "castle" to suit your desires.</p>
                </div>
            </div>
        </div>
    </article>

</section>

<script type="text/javascript" src="js/backgroundimage.js"></script>
<script type="text/javascript" src="js/datecheck.js"></script>