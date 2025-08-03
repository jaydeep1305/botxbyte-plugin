

<table class="wcrp-settings-table">
    <thead>
        <tr>
            <th class="wcrp-settings-table-days-th">Days</th>
            <th class="wcrp-settings-table-articles-th">No. of Articles</th>
            <th class="wcrp-settings-table-delay-th">Minimum Delay</th>
            <th class="wcrp-settings-table-timing-th">Timing</th>
            <th class="wcrp-settings-table-change-th">What to change?</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Monday</td>
            <td><input type="text" placeholder="1-5" class="wcrp-articles-range-input" id="wcrp-articles-range-input-monday" value="<?php echo $articles_mon; ?>"/></td>
            <td><input type="text" placeholder="20" class="wcrp-delay-input" id="wcrp-delay-input-monday" value="<?php echo $delay_mon; ?>"/></td>
            <td><input type="text" placeholder="06:00-10:00" class="wcrp-timing-input" id="wcrp-timing-input-monday" value="<?php echo $timing_mon; ?>"/></td>
            <td>
                <select class="wcrp-change-input" id="wcrp-change-input-monday" multiple="multiple">

                    <?php
                        if(in_array('Title', $change_mon)){
                            echo '<option value="Title" selected>Title</option>';
                        } else {
                            echo '<option value="Title">Title</option>';
                        }

                        if(in_array('Meta Description', $change_mon)){
                            echo '<option value="Meta Description" selected>Meta Description</option>';
                        } else {
                            echo '<option value="Meta Description">Meta Description</option>';
                        }

                        if(in_array('Content', $change_mon)){
                            echo '<option value="Content" selected>Content</option>';
                        } else {
                            echo '<option value="Content">Content</option>';
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Tuesday</td>
            <td><input type="text" placeholder="1-5" class="wcrp-articles-range-input" id="wcrp-articles-range-input-tuesday" value="<?php echo $articles_tue; ?>"/></td>
            <td><input type="text" placeholder="20" class="wcrp-delay-input" id="wcrp-delay-input-tuesday"  value="<?php echo $delay_tue; ?>"/></td>
            <td><input type="text" placeholder="06:00-10:00" class="wcrp-timing-input" id="wcrp-timing-input-tuesday" value="<?php echo $timing_tue; ?>"/></td>
            <td>
                <select class="wcrp-change-input" id="wcrp-change-input-tuesday" multiple="multiple">
                    <?php
                        if(in_array('Title', $change_tue)){
                            echo '<option value="Title" selected>Title</option>';
                        } else {
                            echo '<option value="Title">Title</option>';
                        }

                        if(in_array('Meta Description', $change_tue)){
                            echo '<option value="Meta Description" selected>Meta Description</option>';
                        } else {
                            echo '<option value="Meta Description">Meta Description</option>';
                        }

                        if(in_array('Content', $change_tue)){
                            echo '<option value="Content" selected>Content</option>';
                        } else {
                            echo '<option value="Content">Content</option>';
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Wednesday</td>
            <td><input type="text" placeholder="1-5" class="wcrp-articles-range-input" id="wcrp-articles-range-input-wednesday" value="<?php echo $articles_wed; ?>"/></td>
            <td><input type="text" placeholder="20" class="wcrp-delay-input" id="wcrp-delay-input-wednesday" value="<?php echo $delay_wed; ?>"/></td>
            <td><input type="text" placeholder="06:00-10:00" class="wcrp-timing-input" id="wcrp-timing-input-wednesday" value="<?php echo $timing_wed; ?>"/></td>
            <td>
                <select class="wcrp-change-input" id="wcrp-change-input-wednesday" multiple="multiple">
                    <?php
                        if(in_array('Title', $change_wed)){
                            echo '<option value="Title" selected>Title</option>';
                        } else {
                            echo '<option value="Title">Title</option>';
                        }

                        if(in_array('Meta Description', $change_wed)){
                            echo '<option value="Meta Description" selected>Meta Description</option>';
                        } else {
                            echo '<option value="Meta Description">Meta Description</option>';
                        }

                        if(in_array('Content', $change_wed)){
                            echo '<option value="Content" selected>Content</option>';
                        } else {
                            echo '<option value="Content">Content</option>';
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Thursday</td>
            <td><input type="text" placeholder="1-5" class="wcrp-articles-range-input" id="wcrp-articles-range-input-thursday" value="<?php echo $articles_thu; ?>"/></td>
            <td><input type="text" placeholder="20" class="wcrp-delay-input" id="wcrp-delay-input-thursday" value="<?php echo $delay_thu; ?>"/></td>
            <td><input type="text" placeholder="06:00-10:00" class="wcrp-timing-input" id="wcrp-timing-input-thursday" value="<?php echo $timing_thu; ?>"/></td>
            <td>
                <select class="wcrp-change-input" id="wcrp-change-input-thursday" multiple="multiple">
                    <?php
                        if(in_array('Title', $change_thu)){
                            echo '<option value="Title" selected>Title</option>';
                        } else {
                            echo '<option value="Title">Title</option>';
                        }

                        if(in_array('Meta Description', $change_thu)){
                            echo '<option value="Meta Description" selected>Meta Description</option>';
                        } else {
                            echo '<option value="Meta Description">Meta Description</option>';
                        }

                        if(in_array('Content', $change_thu)){
                            echo '<option value="Content" selected>Content</option>';
                        } else {
                            echo '<option value="Content">Content</option>';
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Friday</td>
            <td><input type="text" placeholder="1-5" class="wcrp-articles-range-input" id="wcrp-articles-range-input-friday" value="<?php echo $articles_fri; ?>"/></td>
            <td><input type="text" placeholder="20" class="wcrp-delay-input" id="wcrp-delay-input-friday" value="<?php echo $delay_fri; ?>"/></td>
            <td><input type="text" placeholder="06:00-10:00" class="wcrp-timing-input" id="wcrp-timing-input-friday" value="<?php echo $timing_fri; ?>"/></td>
            <td>
                <select class="wcrp-change-input" id="wcrp-change-input-friday" multiple="multiple">
                    <?php
                        if(in_array('Title', $change_fri)){
                            echo '<option value="Title" selected>Title</option>';
                        } else {
                            echo '<option value="Title">Title</option>';
                        }

                        if(in_array('Meta Description', $change_fri)){
                            echo '<option value="Meta Description" selected>Meta Description</option>';
                        } else {
                            echo '<option value="Meta Description">Meta Description</option>';
                        }

                        if(in_array('Content', $change_fri)){
                            echo '<option value="Content" selected>Content</option>';
                        } else {
                            echo '<option value="Content">Content</option>';
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Saturday</td>
            <td><input type="text" placeholder="1-5" class="wcrp-articles-range-input" id="wcrp-articles-range-input-saturday" value="<?php echo $articles_sat; ?>"/></td>
            <td><input type="text" placeholder="20" class="wcrp-delay-input" id="wcrp-delay-input-saturday" value="<?php echo $delay_sat; ?>"/></td>
            <td><input type="text" placeholder="06:00-10:00" class="wcrp-timing-input" id="wcrp-timing-input-saturday" value="<?php echo $timing_sat; ?>"/></td>
            <td>
                <select class="wcrp-change-input" id="wcrp-change-input-saturday" multiple="multiple">
                    <?php
                        if(in_array('Title', $change_sat)){
                            echo '<option value="Title" selected>Title</option>';
                        } else {
                            echo '<option value="Title">Title</option>';
                        }

                        if(in_array('Meta Description', $change_sat)){
                            echo '<option value="Meta Description" selected>Meta Description</option>';
                        } else {
                            echo '<option value="Meta Description">Meta Description</option>';
                        }

                        if(in_array('Content', $change_sat)){
                            echo '<option value="Content" selected>Content</option>';
                        } else {
                            echo '<option value="Content">Content</option>';
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Sunday</td>
            <td><input type="text" placeholder="1-5" class="wcrp-articles-range-input" id="wcrp-articles-range-input-sunday" value="<?php echo $articles_sun; ?>"/></td>
            <td><input type="text" placeholder="20" class="wcrp-delay-input" id="wcrp-delay-input-sunday" value="<?php echo $delay_sun; ?>"/></td>
            <td><input type="text" placeholder="06:00-10:00" class="wcrp-timing-input" id="wcrp-timing-input-sunday" value="<?php echo $timing_sun; ?>"/></td>
            <td>
                <select class="wcrp-change-input" id="wcrp-change-input-sunday" multiple="multiple">
                    <?php
                        if(in_array('Title', $change_sun)){
                            echo '<option value="Title" selected>Title</option>';
                        } else {
                            echo '<option value="Title">Title</option>';
                        }

                        if(in_array('Meta Description', $change_sun)){
                            echo '<option value="Meta Description" selected>Meta Description</option>';
                        } else {
                            echo '<option value="Meta Description">Meta Description</option>';
                        }

                        if(in_array('Content', $change_sun)){
                            echo '<option value="Content" selected>Content</option>';
                        } else {
                            echo '<option value="Content">Content</option>';
                        }
                    ?>
                </select>
            </td>
        </tr>
    </tbody>
<table>

<button type="button" class="button wcrp-save-settings-btn" onclick="wcrp_save_settings();">Save Changes</button>