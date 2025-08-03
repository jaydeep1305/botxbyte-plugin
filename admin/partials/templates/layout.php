<script src="https://cdn.tailwindcss.com"></script>
<style>
    input[type="text"], input[type="password"], input[type="color"], input[type="date"], input[type="datetime"], input[type="datetime-local"], input[type="email"], input[type="month"], input[type="number"], input[type="search"], input[type="tel"], input[type="time"], input[type="url"], input[type="week"], select, textarea{
        border: 1px solid ;
        border-color: rgb(226 232 240 / var(--tw-border-opacity));
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        background: none;
    }
    .select2-container--default .select2-selection--multiple{
        border-color: rgb(226 232 240 / var(--tw-border-opacity)) !important;
    }
</style>
<div class="">
    <div class="grid grid-cols-4 md:gap-4 md:flex-row ">
        <!-- Sidebar -->
        <div class="flex bg-white rounded-lg p-2 mt-4">
            <nav class=" p-5 md:!block  w-full">
                <div class="flex flex-wrap ml-4 mb-4">
                    <a href="#/" class="block w-32 text-center" >
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" x="0px" y="0px" viewBox="0 0 2000 1132" style="enable-background:new 0 0 2000 1132;" xml:space="preserve">
                            <style type="text/css">	.st0{fill:#FF0000;}	.st1{fill:#000;}</style><path class="st0" d="M1356.1,414h-30.7c0-94.8-101.3-171.7-161.3-171.7H835.9c-60,0-161.3,76.8-161.3,171.7h-30.7 c-19.5,0-35.4,15.8-35.4,35.4l0,0v44.4H732c0-100.7,81.6-182.3,182.3-182.3l0,0H1086c100.7,0,182.3,81.6,182.3,182.3l0,0h123.5 v-44.4c0-19.5-15.8-35.4-35.4-35.4C1356.3,414,1356.2,414,1356.1,414z"/><path class="st0" d="M1356.1,640.7h-30.7c0,94.8-101.3,171.7-161.3,171.7H835.9c-60,0-161.3-76.8-161.3-171.7h-30.7 c-19.5,0-35.4-15.8-35.4-35.4l0,0v-44.5H732c0,100.7,81.6,182.3,182.3,182.3l0,0H1086c100.7,0,182.3-81.6,182.3-182.3l0,0h123.5 v44.4c0,19.5-15.8,35.4-35.3,35.5C1356.3,640.7,1356.2,640.7,1356.1,640.7z"/><polygon class="st1" points="898.9,489.1 898.9,539.6 959,489.1 "/><polygon class="st1" points="974.4,564.4 974.4,514 914.4,564.4 "/><path class="st1" d="M1110.6,427.7H889.4c-34.5,0-62.5,28-62.5,62.5l0,0v74.4c0,34.5,28,62.4,62.5,62.4h221.2 c34.5,0,62.5-28,62.5-62.5l0,0v-74.4C1173.1,455.7,1145.1,427.7,1110.6,427.7z M1003.2,566c0,4.9-1.3,9.8-3.8,14 c-2.4,4.4-5.8,8.1-10,10.9c-4,2.8-8.8,4.3-13.7,4.2h-78.1c-4.9,0-9.7-1.4-13.7-4.2c-4.1-2.8-7.6-6.5-10-10.9 c-2.5-4.3-3.8-9.1-3.8-14v-78.4c0-4.9,1.3-9.7,3.8-13.9c2.4-4.2,5.9-7.7,10-10.2c4.1-2.6,8.9-3.9,13.7-3.9h78.1 c4.9,0,9.6,1.3,13.7,3.9c4.1,2.6,7.5,6.1,10,10.2c2.5,4.2,3.8,9,3.8,13.9V566z M1129.8,595.2H1101v-91.7l-6.1,7.7h-38.2l43.3-51.6 h29.9L1129.8,595.2z"/><rect x="978" y="160.3" class="st0" width="43.9" height="119"/><circle class="st0" cx="1000" cy="96.3" r="66.6"/><path class="st1" d="M30,927.9h137.2c5.6-0.1,11.2,1.4,16,4.3c4.8,2.8,8.7,6.8,11.5,11.5c2.9,4.9,4.3,10.4,4.3,16.1v36 c0,2.1-0.2,4.3-0.6,6.4c-0.4,2.1-1.1,4-2,5.9c2.9,4,5.4,8.3,7.5,12.9c1.7,3.8,2.6,7.9,2.6,12.1v39.5c0.1,5.6-1.4,11.2-4.3,16 c-2.8,4.8-6.8,8.8-11.7,11.5c-4.9,2.9-10.5,4.3-16.2,4.3H30V927.9z M62.6,1001.2h103.9c1.6,0,3.1-0.7,4.1-1.8 c1.1-1.1,1.7-2.7,1.7-4.3v-34.6c0-1.6-0.6-3.1-1.7-4.3c-1-1.2-2.5-1.8-4.1-1.8H62.6c-3.4,0.1-6.1,2.8-6.1,6.1v34.6 C56.5,998.4,59.3,1001.1,62.6,1001.2z M62.6,1077.9h111.3c1.6,0,3.1-0.7,4.1-1.8c1.1-1.1,1.7-2.7,1.7-4.3v-38c0-1.6-0.6-3.1-1.7-4.3 c-1-1.2-2.5-1.8-4.1-1.8H62.6c-3.4,0.1-6.1,2.8-6.1,6.1v38C56.5,1075.2,59.3,1077.9,62.6,1077.9L62.6,1077.9z"/><path class="st1" d="M294,1104.3c-5.6,0.1-11.2-1.4-16.1-4.3c-4.8-2.8-8.7-6.8-11.5-11.5c-2.9-4.9-4.3-10.4-4.3-16V959.8 c-0.1-5.6,1.4-11.2,4.3-16.1c2.8-4.8,6.8-8.7,11.5-11.5c4.9-2.9,10.4-4.4,16.1-4.3h112.7c5.6-0.1,11.2,1.4,16,4.3 c4.8,2.8,8.7,6.8,11.5,11.5c2.9,4.9,4.3,10.4,4.3,16.1v112.7c0.1,5.6-1.4,11.2-4.3,16c-2.8,4.8-6.8,8.7-11.5,11.5 c-4.9,2.9-10.4,4.3-16,4.3H294z M294.7,1077.8H406c1.6,0,3.1-0.7,4.1-1.8c1.1-1.1,1.7-2.7,1.7-4.3V960.5c0-1.6-0.6-3.1-1.7-4.3 c-1-1.2-2.5-1.8-4.1-1.8H294.7c-3.4,0.1-6.1,2.8-6.1,6.1v111.3C288.6,1075.1,291.3,1077.8,294.7,1077.8L294.7,1077.8z"/><path class="st1" d="M561.1,1104.3v-150h-75v-26.5h176.5v26.5h-75v150H561.1z"/><path class="st1" d="M1140.4,927.9h137.2c5.6-0.1,11.2,1.4,16.1,4.3c4.8,2.8,8.7,6.8,11.5,11.5c2.9,4.9,4.4,10.4,4.3,16.1v36 c0,2.1-0.2,4.3-0.6,6.4c-0.4,2.1-1.1,4-2,5.9c2.9,4,5.5,8.3,7.5,12.9c1.7,3.8,2.6,7.9,2.6,12.1v39.5c0.1,5.6-1.4,11.2-4.3,16 c-2.8,4.8-6.8,8.8-11.6,11.5c-4.9,2.9-10.5,4.3-16.2,4.3h-144.3L1140.4,927.9z M1173,1001.1h103.9c1.6,0,3.1-0.7,4.1-1.8 c1.1-1.1,1.7-2.7,1.7-4.3v-34.6c0-1.6-0.6-3.1-1.7-4.3c-1-1.2-2.5-1.8-4.1-1.8H1173c-3.4,0.1-6.1,2.8-6.1,6.1V995 C1167,998.4,1169.7,1001.1,1173,1001.1L1173,1001.1z M1173,1077.8h111.3c1.6,0,3.1-0.7,4.1-1.8c1.1-1.1,1.7-2.7,1.7-4.3v-38 c0-1.6-0.6-3.1-1.7-4.3c-1-1.2-2.5-1.8-4.1-1.8H1173c-3.4,0.1-6.1,2.8-6.1,6.1v38C1167,1075.1,1169.7,1077.8,1173,1077.8 L1173,1077.8z"/><path class="st1" d="M1437.2,1104.3v-66.2l-81.4-110.3h31.1l63.5,80.1l63.2-80.1h31.4l-81.4,110.3v66.2H1437.2z"/><path class="st1" d="M1658.5,1104.3v-150h-75v-26.5h176.4v26.5h-75v150H1658.5z"/><polygon class="st1" points="886.1,974.1 847.1,927.9 816.4,927.9 816.4,932.8 868.8,995.1 "/><polygon class="st0" points="921.1,1016.1 991.2,932.8 991.2,927.9 960.5,927.9 913.2,984.3 886.5,1016.1 886.5,1016.1  816.4,1099.4 816.4,1104.3 847.1,1104.3 903.7,1036.9 960.5,1104.3 991.4,1104.3 991.4,1099.4 "/><polygon class="st0" points="1808.3,927.9 1808.3,954.3 1835,954.3 1840.3,954.3 1970,954.3 1970,927.9 "/><polygon class="st1" points="1835,1029.3 1943.5,1029.3 1943.5,1002.9 1835,1002.9 1835,1002.8 1808.3,1002.8 1808.3,1104.3  1970,1104.3 1970,1077.8 1835,1077.8 "/></svg>
                    </a>
                </div>
                <ul class="grid gap-y-0.5 mb-4 mt-10 gj-nav-menu">
                    <li>
                        <a href="admin.php?page=botxbyte-dashboard" class="flex text-left border border-transparent items-center gap-3 px-3 py-2 text-slate-700 hover:text-indigo-800 w-full rounded transition" aria-current="page">
                        <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/icons/dashboard.svg'; ?>" alt=""/>
                            <p class="text-base md:text-sm font-medium md:font-semibold">Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="admin.php?page=botxbyte-image-converter-settings" class="flex text-left border border-transparent items-center gap-3 px-3 py-2 text-slate-700 hover:text-indigo-800 w-full rounded transition">
                            <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/icons/image-converter.svg'; ?>" alt=""/>
                            <p class="text-base md:text-sm font-medium md:font-semibold">Image Converter</p>
                        </a>
                    </li>
                    <li>
                        <a href="admin.php?page=botxbyte-post-date-change-settings" class="flex text-left border border-transparent items-center gap-3 px-3 py-2 text-slate-700 hover:text-indigo-800 w-full rounded transition">
                            <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/icons/post-date-change.svg'; ?>" alt=""/>
                            <p class="text-base md:text-sm font-medium md:font-semibold">Post Date Change</p>
                        </a>
                    </li>
                    <li>
                        <a href="admin.php?page=botxbyte-replace-string-db-settings" class="flex text-left border border-transparent items-center gap-3 px-3 py-2 text-slate-700 hover:text-indigo-800 w-full rounded transition">
                            <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/icons/replace-string-in-database.svg'; ?>" alt=""/>                        
                            <p class="text-base md:text-sm font-medium md:font-semibold">Replace String</p>
                        </a>
                    </li>
                    <li>
                        <a href="admin.php?page=botxbyte-configure-webhook" class="flex text-left border border-transparent items-center gap-3 px-3 py-2 text-slate-700 hover:text-indigo-800 w-full rounded transition">
                            <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/icons/prompts.svg'; ?>" alt=""/>
                            <p class="text-base md:text-sm font-medium md:font-semibold">Prompts</p>
                        </a>
                    </li>
                    <li>
                        <a href="admin.php?page=botxbyte-ai-config" class="flex text-left border border-transparent items-center gap-3 px-3 py-2 text-slate-700 hover:text-indigo-800 w-full rounded transition">
                            <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/icons/ai-configuration.svg'; ?>" alt=""/>
                            <p class="text-base md:text-sm font-medium md:font-semibold">AI Configuration</p>
                        </a>
                    </li>
                    <li>
                        <a href="admin.php?page=botxbyte-schedule-posts" class="flex text-left border border-transparent items-center gap-3 px-3 py-2 text-slate-700 hover:text-indigo-800 w-full rounded transition">
                            <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/icons/draft-to-schedule.svg'; ?>" alt=""/>
                            <p class="text-base md:text-sm font-medium md:font-semibold">Draft to Schedule</p>
                        </a>
                    </li>
                    <li>
                        <a href="admin.php?page=botxbyte-rewrite-posts" class="flex text-left border border-transparent items-center gap-3 px-3 py-2 text-slate-700 hover:text-indigo-800 w-full rounded transition">
                            <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/icons/rewrite-posts.svg'; ?>" alt=""/>
                            <p class="text-base md:text-sm font-medium md:font-semibold">Rewrite Posts</p>
                        </a>
                    </li>

                    <li>
                        <a href="admin.php?page=botxbyte-social-media" class="flex text-left border border-transparent items-center gap-3 px-3 py-2 text-slate-700 hover:text-indigo-800 w-full rounded transition">
                            <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/icons/social-media.svg'; ?>" alt=""/>
                            <p class="text-base md:text-sm font-medium md:font-semibold">Social Media</p>
                        </a>
                    </li>
                    <li>
                        <a href="admin.php?page=botxbyte-inline-related-posts" class="flex text-left border border-transparent items-center gap-3 px-3 py-2 text-slate-700 hover:text-indigo-800 w-full rounded transition">
                            <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/icons/inline-related-posts.svg?v=1'; ?>" alt=""/>
                            <p class="text-base md:text-sm font-medium md:font-semibold">Inline Related Posts</p>
                        </a>
                    </li>
                </ul>
                <script>
                    var active_class = "bg-indigo-50 !border-indigo-200 !text-indigo-700 router-link-exact-active";
                    jQuery(document).ready(function(){
                        jQuery('.gj-nav-menu a').each(function() {
                            if (this.href === window.location.href) {
                                jQuery(this).addClass(active_class);
                            }
                        });
                    });
                </script>
            </nav>
            <div class="absolute bottom-10 left-4 h-12">v<?= BOTXBYTE__VERSION ?></div>
        </div>
        <!-- Sidebar -->
        <div class="col-span-3 bg-white rounded-lg p-2 mt-4 min-h-screen">
            <div class="bg-white border md:p-0 rounded-2xl border-slate-200 md:border-none">
                <div class="flex justify-between md:border-b ">
                    <div class="flex items-center gap-3 pb-4 mt-4 border-slate-200 ml-5">
                        <div class="text-blue-500">
                            <img src="<?php echo str_replace(' ', '-', strtolower(plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/icons/'. $page_variable['page_title']. '.svg?v=1') ?? ''); ?>" />
                        </div>
                        <h1 class="text-xl font-semibold md:text-2xl text-slate-900"> <?= $page_variable['page_title'] ?> </h1>
                    </div>
                    <?php if(isset($page_variable['button'])): ?>
                        <a class="mt-3 mr-3 px-3 py-2 text-xs font-medium text-center text-white bg-blue-500 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 h-8" href="<?=$page_variable['button']?>">Logs</a>
                    <?php endif ?>
                </div>
                <?php require_once( WP_PLUGIN_DIR . '/botxbyte/admin/' . $page_variable['admin_page_path'] ); ?>
            </div>
        </div>
    </div>
</div>
