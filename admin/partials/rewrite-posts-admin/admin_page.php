<?php if(($page_variable['module'] != 'true') || ($page_variable['module_ai'] != 'true')) :?>
    <div class="max-w-lg mx-left mt-5 ml-5 mb-5">
        <div class="p-4 mt-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <span class="font-medium">Alert ! </span>The module is currently disabled. Please go to the dashboard to enable it.
        </div>
    </div>
    <?php exit();?>
<?php endif; ?>
<div class="mx-left mt-5 ml-5 mb-5">
    <?php $flag = true; ?>
    <?php foreach ($errors_html as $error) : ?>
        <?php $flag = false; ?>
        <div class="p-4 mb-4 w-full text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <span class="font-medium">Alert!</span> <?= $error ?>
        </div>
    <?php endforeach; ?>
    <?php if($flag) : ?>
        <table class="bxb-sp-settings-table w-full border border-slate-100 mt-5 text-sm text-left text-gray-500 rounded-sm">
            <thead class="text-xs text-gray-900 uppercase bg-gray-50">
                <tr class="bg-white border-b hover:bg-gray-50">
                    <th scope="col" class="bxb-sp-settings-table-days-th px-6 py-3 border border-slate-200">Days</th>
                    <th scope="col" class="bxb-sp-settings-table-days-th px-6 py-3 border border-slate-200">No. of Articles</th>
                    <th scope="col" class="bxb-sp-settings-table-days-th px-6 py-3 border border-slate-200">Minimum Delay</th>
                    <th scope="col" class="bxb-sp-settings-table-days-th px-6 py-3 border border-slate-200">Timing</th>
                    <th scope="col" class="bxb-sp-settings-table-days-th px-6 py-3 border border-slate-200">Changes</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $days = array(
                        "Mon" => "Monday",
                        "Tue" => "Tuesday",
                        "Wed" => "Wednesday",
                        "Thu" => "Thursday",
                        "Fri" => "Friday",
                        "Sat" => "Saturday",
                        "Sun" => "Sunday"
                    );
                ?>
                <?php foreach ($days as $day=>$full_day_name):
                    $articles_var = 'rp_articles_range_' . strtolower($day);
                    $delay_var = 'rp_delay_' . strtolower($day);
                    $timing_var = 'rp_timing_' . strtolower($day);
                    $change_var = 'rp_change_' . strtolower($day);
                ?>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4 border border-slate-200 text-gray-900 w-32"><?php echo $full_day_name; ?></td>
                    <td class="px-6 py-4 border border-slate-200 text-gray-900 w-32"><input type="text" placeholder="1-5" class="rp_articles_range_input w-24" id="<?php echo $articles_var; ?>" value="<?php echo $$articles_var; ?>"/></td>
                    
                    <td class="px-6 py-4 border border-slate-200 text-gray-900 w-32"><input type="text" placeholder="20" class="bxb-rp-delay-input w-24" id="<?php echo $delay_var; ?>" value="<?php echo $$delay_var; ?>"/></td>

                    <td class="px-6 py-4 border border-slate-200 text-gray-900 w-40"><input type="text" placeholder="06:00-10:00" class="bxb-rp-timing-input w-32" id="<?php echo $timing_var ?>" value="<?php echo $$timing_var; ?>"/></td>
                    <td class="px-6 py-4 border border-slate-200 text-gray-900">
                        <select class="bxb-rp-change-input" id="rp_change_<?php echo strtolower($day); ?>" multiple="multiple" >
                            <?php
                                if($$change_var){
                                    if(in_array('Title', $$change_var)){
                                        echo '<option value="Title" selected>Title</option>';
                                    }
                                    else {
                                        echo '<option value="Title">Title</option>';
                                    }    
                                    if(in_array('Meta Description', $$change_var)){
                                        echo '<option value="Meta Description" selected>Meta Description</option>';
                                    } else {
                                        echo '<option value="Meta Description">Meta Description</option>';
                                    }

                                    if(in_array('Content', $$change_var)){
                                        echo '<option value="Content" selected>Content</option>';
                                    } else {
                                        echo '<option value="Content">Content</option>';
                                    }
                                }
                                else{
                                    echo '<option value="Title">Title</option>';
                                    echo '<option value="Meta Description">Meta Description</option>';
                                    echo '<option value="Content">Content</option>';
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <button onclick="rewrite_posts_admin()" class="mt-5 text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2 text-center flex font-semibold ">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" strokeWidth="2" class="w-4 mr-2">
                <path d="M5 12l5 5l10 -10"></path>
            </svg>
            <span class="text-sm" >Save changes</span>
        </button>
    <?php endif; ?>
</div>

