<?php if(isset($changed_posts_data)): ?>
    <div class="mx-left mt-5 ml-5 mb-5">
        <table class="bxb-sp-settings-table w-full border border-slate-100 mt-5 text-sm text-left text-gray-500 rounded-sm">
            <thead class="text-xs text-gray-900 uppercase bg-gray-50">
                <tr class="bg-white border-b hover:bg-gray-50">
                    <th scope="col" class="bxb-sp-settings-table-days-th px-6 py-3 border border-slate-200">Post Id</th>
                    <th scope="col" class="bxb-sp-settings-table-days-th px-6 py-3 border border-slate-200">New Post Date</th>
                    <th scope="col" class="bxb-sp-settings-table-days-th px-6 py-3 border border-slate-200">Old Post Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($changed_posts_data as $cpd) : ?>
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4 border border-slate-200 text-gray-900 w-32">
                            <a href="<?=$cpd['postEditLink']?>" target="_blank"><?=$cpd['postTitle']?></a>
                        </td>
                        <td class="px-6 py-4 border border-slate-200 text-gray-900 w-32">
                            <?= $cpd['newPostDate'] ?>
                        </td>
                        <td class="px-6 py-4 border border-slate-200 text-gray-900 w-32">
                            <?= $cpd['oldPostDate'] ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <form action="<?=$form_action?>" class="max-w-sm mx-left mt-5 ml-5 mb-5">
        <input type="hidden" name="page" value="botxbyte-post-date-change-settings">
        <?php wp_nonce_field('post_date_nonce', 'post_date_nonce_field'); ?>
        <div class="mb-5">
            <label for="urls" class="block mb-2 text-sm font-medium text-gray-900">Urls</label>
            <textarea id="urls" name="urls" rows="3" cols="40" placeholder="url1&#10;url2" class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "></textarea>
        </div>
        <div class="flex">
            <div class="mb-5">
                <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900">Start Date Time (Indian)</label>
                <input type="text" class="bg-white border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " id="start_time" name="start_time" placeholder="YYYY-MM-DD HH:MM:SS" value="<?=date('Y-m-d H:i:s', $two_day_before_timestamp)?>">
            </div>
            <div class="mb-5 ml-5">
                <label for="end_time" class="block mb-2 text-sm font-medium text-gray-900">End Date Time (Indian)</label>
                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " id="end_time" name="end_time" placeholder="YYYY-MM-DD HH:MM:SS" value="<?=date('Y-m-d H:i:s', $current_timestamp)?>">
            </div>
        </div>
        <div class="flex">
            <div class="mb-5">
                <label for="posts_limit" class="block mb-2 text-sm font-medium text-gray-900">Limit (Post count)</label>
                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " id="posts_limit" name="posts_limit" placeholder="limit" value="10">
            </div>
            <div class="mb-5 ml-5">
                <label for="end_time" class="block mb-2 text-sm font-medium text-gray-900">Offset (Skip posts)</label>
                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " id="posts_offset" name="posts_offset" placeholder="limit" value="0">
            </div>
        </div>
        <button type="submit" class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2 text-center flex font-semibold ">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" strokeWidth="2" class="w-4 mr-2">
                <path d="M5 12l5 5l10 -10"></path>
            </svg>
            <span class="text-sm">Save changes</span>
        </button>
    </form>
<?php endif; ?>
