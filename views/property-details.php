<section>

    <article class="backButton">
        <div class="handle">
        <?php
        if(preg_match('/admin/', '/'.$_SERVER['REQUEST_URI'].'/')){
            ?>
            <a href="index.php?controller=admin&action=properties" class="btn-2">Back</a>
            <?php
        }
        ?>
        </div>        
    </article>

    <article class="mainInfo">
        <div class="handle">
            <div class="title">
                <h1><?=$this->state["property"]->name?></h1>
                <div class="container">
                    <p>Type: <?=$this->state["property"]->type?></p>
                    <?php
                    if(preg_match('/admin/', '/'.$_SERVER['REQUEST_URI'].'/')){
                        ?>
                        <p class="reviewScore">
                            <?php
                            if($this->state["reviewSummary"]["aveRating"]){
                                ?>
                                <i class="fas fa-star"></i><span><?=$this->state["reviewSummary"]["aveRating"]?></span> 
                                <?php
                            }
                            ?>                        
                            (<?=$this->state["reviewSummary"]["numOfReviews"]?> reviews)
                        </p>
                        <?php
                    } else if (preg_match('/pages/', '/'.$_SERVER['REQUEST_URI'].'/')){
                        ?>
                        <a href="#reviews">
                            <p class="reviewScore">
                                <?php
                                if($this->state["reviewSummary"]["aveRating"]){
                                    ?>
                                    <i class="fas fa-star"></i><span><?=$this->state["reviewSummary"]["aveRating"]?></span> 
                                    <?php
                                }
                                if($this->state["reviewSummary"]["numOfReviews"] > 1){
                                    ?>
                                    (<?=$this->state["reviewSummary"]["numOfReviews"]?> reviews)
                                    <?php
                                } else {
                                    ?>
                                    (<?=$this->state["reviewSummary"]["numOfReviews"]?> review)
                                    <?php                                    
                                }
                                ?>                        
                                
                            </p>
                        </a>
                        <?php
                    }
                    ?>
                </div>                
            </div>
            <div class="photos">
                <div class="container">
                    <div class="photoL modalImage" data-backgroundimage="assets/<?=$this->state["property"]->image_1?>"></div>
                </div>
                <div class="container">
                    <div class="photoS modalImage" data-backgroundimage="assets/<?=$this->state["property"]->image_2?>"></div>
                    <div class="photoS modalImage" data-backgroundimage="assets/<?=$this->state["property"]->image_3?>"></div>
                    <div class="photoS modalImage" data-backgroundimage="assets/<?=$this->state["property"]->image_4?>"></div>
                    <div class="photoS modalImage" data-backgroundimage="assets/<?=$this->state["property"]->image_5?>"></div>
                </div>
            </div>
        </div>   
    </article>

    <div class="detailsContainer">
        <div class="handle">
            <article class="detailInfo">
                <div class="facility">
                    <h3>Facilities</h3>
                    <div class="facilityList">
                        <p><?=$this->state["property"]->occupancy?> guests</p>
                        <?php
                        if($this->state["property"]->bedrooms > 1){
                            ?>
                            <p><?=$this->state["property"]->bedrooms?> bedrooms</p>
                            <?php
                        } else {
                            ?>
                            <p><?=$this->state["property"]->bedrooms?> bedroom</p>
                            <?php                        
                        }
                        if($this->state["property"]->bathrooms > 1){
                            ?>
                            <p><?=$this->state["property"]->bathrooms?> bathrooms</p>
                            <?php
                        } else {
                            ?>
                            <p><?=$this->state["property"]->bathrooms?> bathroom</p>
                            <?php                        
                        }
                        ?>
                    </div>
                </div>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <div class="amenityList">
                        <?php
                        $wifi = $this->state["property"]->wifi ? "" : "unavailable";
                        $kitchen = $this->state["property"]->kitchen ? "" : "unavailable";
                        $microwave = $this->state["property"]->microwave ? "" : "unavailable";
                        $refrigerator = $this->state["property"]->refrigerator ? "" : "unavailable";
                        $washer = $this->state["property"]->washer ? "" : "unavailable";
                        $dryer = $this->state["property"]->dryer ? "" : "unavailable";
                        $heating = $this->state["property"]->heating ? "" : "unavailable";
                        $tv = $this->state["property"]->tv ? "" : "unavailable";
                        $parking = $this->state["property"]->parking ? "" : "unavailable";
                        ?>
                        <p class="<?=$wifi?>">Wi-Fi</p>
                        <p class="<?=$kitchen?>">Kitchen</p>
                        <p class="<?=$microwave?>">Microwave</p>
                        <p class="<?=$refrigerator?>">Refrigerator</p>
                        <p class="<?=$washer?>">Washer</p>
                        <p class="<?=$dryer?>">Dryer</p>
                        <p class="<?=$heating?>">Heating</p>
                        <p class="<?=$tv?>">TV</p>
                        <p class="<?=$parking?>">Parking</p>                      
                    </div>
                </div>
                <div class="description">
                    <h3>Description</h3>
                    <p><?=$this->state["property"]->description?></p>
                </div>
                <div class="address">
                    <h3>Address</h3>
                    <p><?=$this->state["property"]->street?>, <?=$this->state["property"]->city?>, <?=$this->state["property"]->province?> <?=$this->state["property"]->country?></p>
                </div>            
            </article>

        
