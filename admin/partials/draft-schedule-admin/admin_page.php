<?php if($page_variable['module'] != 'true') :?>
    <div class="max-w-lg mx-left mt-5 ml-5 mb-5">
        <div class="p-4 mt-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium">Alert ! </span>The module is currently disabled. Please go to the dashboard to enable it.
        </div>
    </div>
    <?php exit();?>
<?php endif; ?>

<div class="max-w-2xl mx-left mt-5 ml-5 mb-5">
    <table class="bxb-sp-settings-table w-full border border-slate-100 mt-5 text-sm text-left text-gray-500 rounded-sm">
        <thead class="text-xs text-gray-900 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="bxb-sp-settings-table-days-th px-6 py-3 border border-slate-200">Days</th>
                <th scope="col" class="bxb-sp-settings-table-articles-th px-6 py-3 w-1 border border-slate-200">No. of Articles</th>
                <th scope="col" class="bxb-sp-settings-table-delay-th px-6 py-3 border border-slate-200">Minimum Delay</th>
                <th scope="col" class="bxb-sp-settings-table-timing-th px-6 py-3 border border-slate-200">Timing</th>
                <th scope="col" class="bxb-sp-settings-table-author-th px-6 py-3 border border-slate-200">Authors</th>
            </tr>
        </thead>
        <tbody class="">
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
                $articles_var = 'sp_articles_range_' . strtolower($day);
                $delay_var = 'sp_delay_' . strtolower($day);
                $timing_var = 'sp_timing_' . strtolower($day);
                $author_var = 'sp_author_' . strtolower($day);
            ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4 border border-slate-200 text-gray-900"><?php echo $full_day_name; ?></td>
                <td class="px-6 py-4 border border-slate-200 text-gray-900"><input type="text" placeholder="1-5" class="sp_articles_range_input w-24" id="<?php echo $articles_var; ?>" value="<?php echo $$articles_var; ?>"/></td>
                
                <td class="px-6 py-4 border border-slate-200 text-gray-900"><input type="text" placeholder="20" class="bxb-sp-delay-input w-20" id="<?php echo $delay_var; ?>" value="<?php echo $$delay_var; ?>"/></td>

                <td class="px-6 py-4 border border-slate-200 text-gray-900"><input type="text" placeholder="06:00-10:00" class="bxb-sp-timing-input w-20" id="<?php echo $timing_var ?>" value="<?php echo $$timing_var; ?>"/></td>
                <td class="px-6 py-4 border border-slate-200 text-gray-900">
                    <select class="bxb-sp-author-input border-slate-200" id="sp_author_<?php echo strtolower($day); ?>" multiple="multiple" >
                        <?php foreach($all_users as $user):
                            if($$author_var):
                                $selected = in_array($user->ID, $$author_var) ? 'selected' : '';
                            else:
                                $selected = "";
                            endif;
                        ?>
                        <option value="<?php echo $user->ID; ?>" <?php echo $selected; ?>><?php echo $user->user_nicename; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <button onclick="draft_schedule_admin()" class="mt-5 text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 flex font-semibold ">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" strokeWidth="2" class="w-4 mr-2">
            <path d="M5 12l5 5l10 -10"></path>
        </svg>
        <span class="text-sm" >Save changes</span>
    </button>

</div>
