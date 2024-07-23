<div class="max-w-2xl mx-left mt-5 ml-5 mb-5">
    <div class="mb-4 bg-white rounded-lg dark:bg-gray-800">
        <dl class="grid grid-cols-2 text-gray-900 gap-y-6 ">
            <div class="flex p-2 border rounded mr-5">
                <div>
                    <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/icons/google-analytics-4.svg?v=5'; ?>" class="w-10 mr-5"/>
                </div>
                <div class="flex-1">
                    <dt class="text-xl font-extrabold">Google Analytics</dt>
                    <div class="flex items-center">
                        <dd class="text-gray-500 dark:text-gray-400 mr-1"><?=$analytics_html?></dd>
                        <?php if($analytics_html == "Connected") : ?>
                            <svg width="12px" height="12px" stroke="1px" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 102.97"><defs><style>.cls-1{fill:#10a64a;}</style></defs><title>small-check-mark</title><path class="cls-1" d="M4.82,69.68c-14.89-16,8-39.87,24.52-24.76,5.83,5.32,12.22,11,18.11,16.27L92.81,5.46c15.79-16.33,40.72,7.65,25.13,24.07l-57,68A17.49,17.49,0,0,1,48.26,103a16.94,16.94,0,0,1-11.58-4.39c-9.74-9.1-21.74-20.32-31.86-28.9Z"/></svg>
                        <?php endif; ?>
                    </div>
                </div>
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer bxb-dashboard-switch" name="analytics_status" <?= $analytics_status; ?> />
                    <div class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                </label>
            </div>
            <div class="flex p-2 border rounded mr-5">
                <div>
                    <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/icons/google-search-console.svg?v=1.1'; ?>" class="w-12 mr-5"/>
                </div>
                <div class="flex-1">
                    <dt class="text-xl font-extrabold">Search Console</dt>
                    <div class="flex items-center">
                        <dd class="text-gray-500 dark:text-gray-400 mr-1"><?=$search_console_html?></dd>
                        <?php if($search_console_html == "Connected") : ?>
                            <svg width="12px" height="12px" stroke="1px" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 102.97"><defs><style>.cls-1{fill:#10a64a;}</style></defs><title>small-check-mark</title><path class="cls-1" d="M4.82,69.68c-14.89-16,8-39.87,24.52-24.76,5.83,5.32,12.22,11,18.11,16.27L92.81,5.46c15.79-16.33,40.72,7.65,25.13,24.07l-57,68A17.49,17.49,0,0,1,48.26,103a16.94,16.94,0,0,1-11.58-4.39c-9.74-9.1-21.74-20.32-31.86-28.9Z"/></svg>
                        <?php endif; ?>
                    </div>
                </div>
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer bxb-dashboard-switch" name="search_console_status" <?= $search_console_status; ?> />
                    <div class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                </label>
            </div>

            <div class="flex p-2 border rounded mr-5">
                <div class="">
                    <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/icons/image-converter.svg'; ?>" class="w-10 mr-5 "/>
                </div>
                <div class="flex-1">
                    <dt class="text-xl font-extrabold">Image Converter</dt>
                    <div class="flex items-center">
                        <dd class="text-gray-500 dark:text-gray-400 mr-1"><?=$image_converter_html?></dd>
                        <?php if($image_converter_html == "Connected") : ?>
                            <svg width="12px" height="12px" stroke="1px" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 102.97"><defs><style>.cls-1{fill:#10a64a;}</style></defs><title>small-check-mark</title><path class="cls-1" d="M4.82,69.68c-14.89-16,8-39.87,24.52-24.76,5.83,5.32,12.22,11,18.11,16.27L92.81,5.46c15.79-16.33,40.72,7.65,25.13,24.07l-57,68A17.49,17.49,0,0,1,48.26,103a16.94,16.94,0,0,1-11.58-4.39c-9.74-9.1-21.74-20.32-31.86-28.9Z"/></svg>
                        <?php endif; ?>
                    </div>
                </div>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer bxb-dashboard-switch" name="image_converter_status" <?= $image_converter_status; ?> />
                    <div class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                </label>
            </div>

            <div class="flex p-2 border rounded mr-5">
                <div class="">
                    <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/icons/draft-to-schedule.svg'; ?>" class="w-12 mr-5 "/>
                </div>
                <div class="flex-1">
                    <dt class="text-xl font-extrabold">Draft To Schedule</dt>
                    <div class="flex items-center">
                        <dd class="text-gray-500 dark:text-gray-400 mr-1"><?=$draft_to_schedule_html?></dd>
                        <?php if($draft_to_schedule_html == "Connected") : ?>
                            <svg width="12px" height="12px" stroke="1px" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 102.97"><defs><style>.cls-1{fill:#10a64a;}</style></defs><title>small-check-mark</title><path class="cls-1" d="M4.82,69.68c-14.89-16,8-39.87,24.52-24.76,5.83,5.32,12.22,11,18.11,16.27L92.81,5.46c15.79-16.33,40.72,7.65,25.13,24.07l-57,68A17.49,17.49,0,0,1,48.26,103a16.94,16.94,0,0,1-11.58-4.39c-9.74-9.1-21.74-20.32-31.86-28.9Z"/></svg>
                        <?php endif; ?>
                    </div>
                </div>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer bxb-dashboard-switch" name="draft_to_schedule_status" <?= $draft_to_schedule_status; ?> />
                    <div class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                </label>
            </div>

            <div class="flex p-2 border rounded mr-5">
                <div class="">
                    <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/icons/ai-configuration.svg'; ?>" class="w-12 mr-5 "/>
                </div>
                <div class="flex-1">
                    <dt class="text-xl font-extrabold">AI Configuration</dt>
                    <div class="flex items-center">
                        <dd class="text-gray-500 dark:text-gray-400 mr-1"><?=$ai_configuration_html?></dd>
                        <?php if($ai_configuration_html == "Connected") : ?>
                            <svg width="12px" height="12px" stroke="1px" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 102.97"><defs><style>.cls-1{fill:#10a64a;}</style></defs><title>small-check-mark</title><path class="cls-1" d="M4.82,69.68c-14.89-16,8-39.87,24.52-24.76,5.83,5.32,12.22,11,18.11,16.27L92.81,5.46c15.79-16.33,40.72,7.65,25.13,24.07l-57,68A17.49,17.49,0,0,1,48.26,103a16.94,16.94,0,0,1-11.58-4.39c-9.74-9.1-21.74-20.32-31.86-28.9Z"/></svg>
                        <?php endif; ?>
                    </div>
                </div>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer bxb-dashboard-switch" name="ai_configuration_status" <?= $ai_configuration_status; ?> />
                    <div class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                </label>
            </div>

            <div class="flex p-2 border rounded mr-5">
                <div class="">
                    <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/icons/rewrite-posts.svg'; ?>" class="w-12 mr-5 "/>
                </div>
                <div class="flex-1">
                    <dt class="text-xl font-extrabold">Rewrite Posts</dt>
                    <div class="flex items-center">
                        <dd class="text-gray-500 dark:text-gray-400 mr-1"><?=$rewrite_posts_html?></dd>
                        <?php if($rewrite_posts_html == "Connected") : ?>
                            <svg width="12px" height="12px" stroke="1px" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 102.97"><defs><style>.cls-1{fill:#10a64a;}</style></defs><title>small-check-mark</title><path class="cls-1" d="M4.82,69.68c-14.89-16,8-39.87,24.52-24.76,5.83,5.32,12.22,11,18.11,16.27L92.81,5.46c15.79-16.33,40.72,7.65,25.13,24.07l-57,68A17.49,17.49,0,0,1,48.26,103a16.94,16.94,0,0,1-11.58-4.39c-9.74-9.1-21.74-20.32-31.86-28.9Z"/></svg>
                        <?php endif; ?>
                    </div>
                </div>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer bxb-dashboard-switch" name="rewrite_posts_status" <?= $rewrite_posts_status; ?> />
                    <div class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                </label>
            </div>

            <div class="flex p-2 border rounded mr-5">
                <div class="">
                    <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/icons/social-media.svg'; ?>" class="w-12 mr-5 "/>
                </div>
                <div class="flex-1">
                    <dt class="text-xl font-extrabold">Social Media</dt>
                    <div class="flex items-center">
                        <dd class="text-gray-500 dark:text-gray-400 mr-1"><?=$social_media_html?></dd>
                        <?php if($social_media_html == "Connected") : ?>
                            <svg width="12px" height="12px" stroke="1px" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 102.97"><defs><style>.cls-1{fill:#10a64a;}</style></defs><title>small-check-mark</title><path class="cls-1" d="M4.82,69.68c-14.89-16,8-39.87,24.52-24.76,5.83,5.32,12.22,11,18.11,16.27L92.81,5.46c15.79-16.33,40.72,7.65,25.13,24.07l-57,68A17.49,17.49,0,0,1,48.26,103a16.94,16.94,0,0,1-11.58-4.39c-9.74-9.1-21.74-20.32-31.86-28.9Z"/></svg>
                        <?php endif; ?>
                    </div>
                </div>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer bxb-dashboard-switch" name="social_media_status" <?= $social_media_status; ?> />
                    <div class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                </label>
            </div>            

        </dl>
    </div>

    <div class="mt-16">
        <?php foreach ($errors_html as $error) : ?>
            <div class="p-4 mb-4 w-full text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <span class="font-medium">Alert!</span> <?= $error ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
