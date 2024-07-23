<div class="mx-left mt-5 ml-5 mb-5">
    <table class="bxb-sp-settings-table w-full border border-slate-100 mt-5 text-sm text-left text-gray-500 rounded-sm">
        <thead class="text-xs text-gray-900 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="col" class="bxb-sp-settings-table-days-th px-6 py-3 border border-slate-200">Record ID</th>
                <th scope="col" class="bxb-sp-settings-table-days-th px-6 py-3 border border-slate-200">Time</th>
                <th scope="col" class="bxb-sp-settings-table-days-th px-6 py-3 border border-slate-200">Post ID</th>
                <th scope="col" class="bxb-sp-settings-table-days-th px-6 py-3 border border-slate-200">Change Type</th>
                <th scope="col" class="bxb-sp-settings-table-days-th px-6 py-3 border border-slate-200">Old Value</th>
                <th scope="col" class="bxb-sp-settings-table-days-th px-6 py-3 border border-slate-200">New Value</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($records as $record) {
                    
                    $user_info = get_userdata($record->author);
                    if($user_info) {
                        $display_name = $user_info->display_name;
                    } else {
                        $display_name = '';
                    }

                    $post_title = get_the_title( $record->post_id );
                    $post_link = get_edit_post_link( $record->post_id );
                    ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 border border-slate-200 text-gray-900"> <?php echo $record->id; ?></td>
                            <td class="px-6 py-4 border border-slate-200 text-gray-900"> <?php echo $record->timeofchange; ?></td>
                            <td class="px-6 py-4 border border-slate-200 text-gray-900">
                                <a href="<?php echo get_edit_post_link($record->post_id); ?>">
                                    <?php echo $record->post_id; ?>
                                </a>
                            </td>
                            <td class="px-6 py-4 border border-slate-200 text-gray-900"> <?php echo $record->change_type; ?></td>
                            <td class="px-6 py-4 border border-slate-200 text-gray-900"> <?php echo $record->old_value; ?></td>
                            <td class="px-6 py-4 border border-slate-200 text-gray-900"> <?php echo $record->new_value; ?></td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
    

    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
        <div class="flex flex-1 justify-between sm:hidden">
            <a href="<?php echo $current_page_url;?>&pagination=<?php echo $prev_page; ?>" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
            <a href="<?php echo $current_page_url;?>&pagination=<?php echo $next_page; ?>" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                    <a href="<?php echo $current_page_url;?>&pagination=<?php echo $prev_page; ?>" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                        <span class="sr-only">Previous</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                        <?php if ($i == 1 || $i == 2 || $i > $total_pages - 1) : ?>
                            <a class="relative hidden items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 md:inline-flex" href="<?php echo $current_page_url;?>&pagination=<?php echo $i; ?>"><?php echo $i; ?></a>
                        <?php else : ?>
                            <?php if($flag): ?>
                                <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0"> ...... </span>
                                <?php $flag = false; ?>
                            <?php endif;?>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <a href="<?php echo $current_page_url;?>&pagination=<?php echo $next_page; ?>" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                        <span class="sr-only">Next</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </nav>
            </div>
        </div>
    </div>
