<section>
    <div class="handle">
        <article class="searchConditions">

            <div class="searchForm">
                <header class="found">
                    <?php
                    if($this->state["numOfProperties"] > 1) {
                        ?>
                        <h3><?=$this->state["numOfProperties"]?> properties found</h3>
                        <?php
                    } else {
                        ?>
                        <h3><?=$this->state["numOfProperties"]?> property found</h3>
                        <?php                        
                    }
                    ?>                    
                </header>                
                <form action="index.php?controller=pages&action=results" method="post">
                    <div class="fieldset half">
                        <label>Location</label>
                        <input type="text" name="location" value="<?=$_POST["location"]?>"/>
                    </div>
                    <div class="fieldset half">
                        <label>Property type</label>
                        <select name="type_id" id="type_id">
                            <option value="">- Select -</option>
                            <?php
                            foreach($this->state["poropertyTypes"] as $type) {
                            ?>
                            <option value="<?=$type["type_id"]?>" <?=$_POST['type_id']!= $type["type_id"] ?: 'selected'?>><?=$type["type"]?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="fieldset third">
                        <label>Number of guests</label>
                        <input type="number" min="1" step="1" name="numGuests" value="<?=$_POST["numGuests"]?>"/>
                    </div>
                    <div class="fieldset third">
                        <label>Check in</label>
                        <?php
                            date_default_timezone_set('America/Vancouver');
                            $today = date('Y-m-d');
                        ?>                        
                        <input type="date" name="checkIn" id="checkIn" value="<?=$_POST["checkIn"]?>" min="<?=$today?>"/>
                    </div>
                    <div class="fieldset third">
                        <label>Check out</label>
                        <?php
                        if($_POST["checkOut"]){
                            ?>
                            <input type="date" name="checkOut" id="checkOut" value="<?=$_POST["checkOut"]?>"/>
                            <div class="dateErrorMsg">
                                <p>Check-out date must be after the check-in.</p>
                            </div>
                            <?php
                        } else {
                            ?>
                            <input type="date" name="checkOut" id="checkOut" value="" readonly/>
                            <div class="dateErrorMsg">
                                <p>Check-out date must be after the check-in.</p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="fieldset submit">
                        <input type="submit" value="Search" class="btn-1">
                    </div><!-- fieldset -->
                </form>
            </div>

        </article>



<script type="text/javascript" src="js/datecheck.js"></script>

