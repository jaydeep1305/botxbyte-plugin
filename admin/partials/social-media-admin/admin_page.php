<?php if($page_variable['module'] != 'true') :?>
    <div class="max-w-lg mx-left mt-5 ml-5 mb-5">
        <div class="p-4 mt-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium">Alert ! </span>The module is currently disabled. Please go to the dashboard to enable it.
        </div>
    </div>
    <?php exit();?>
<?php endif; ?>

<div class="max-w-sm mx-left mt-5 ml-5 mb-5">
    <?php $flag = true; ?>
    <?php foreach ($errors_html as $error) : ?>
        <?php $flag = false; ?>
        <div class="p-4 mb-4 w-full text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium">Alert!</span> <?= $error ?>
        </div>
    <?php endforeach; ?>
    <?php if($flag) : ?>
        <div class="mb-5 mt-5">
            <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Steps to Automate Social Media</h2>
            <ul class="space-y-4 text-left text-gray-900 ms-2 text-sm font-medium">
                <li class="flex items-center space-x-3 rtl:space-x-reverse">
                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                    </svg>
                    <span>Login to IFTTT (with pro+ plan) <a href="https://ifttt.com/login" class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded" target="_blank">Login</a> </span>
                </li>
                <li class="flex items-center space-x-3 rtl:space-x-reverse">
                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                    </svg>
                    <span>Create New Applet : <a href="https://ifttt.com/p/ifttt_botxbyte_com/applets/new?from_applet=t7yDjRZd" target="_blank" class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">Click Here</a></span>
                </li>
                <li class="flex items-center space-x-3 rtl:space-x-reverse">
                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                    </svg>
                    <span>Set <strong>Event Name : </strong><?=str_replace(":","_",str_replace(".","_",$_SERVER['HTTP_HOST'] ?? '') ?? '')?> 
                    </span>
                </li>
                <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/img/event-name.png'; ?>" class="h-32 border-solid border-2 border-gray-100 rounded-lg p-2"/>
                <li class="flex items-center space-x-3 rtl:space-x-reverse">
                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                    </svg>
                    <span>Set <strong>Applet Title : </strong><?=str_replace(":","_",str_replace(".","_",$_SERVER['HTTP_HOST'] ?? '') ?? '')?>  
                    </span>
                </li>
                <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/img/applet-title.png'; ?>" class=" border-solid border-2 border-gray-100 rounded-lg p-2"/>

                <li class="flex items-center space-x-3 rtl:space-x-reverse">
                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                    </svg>
                    <span>Save</span>
                </li>
                <li class="flex items-center space-x-3 rtl:space-x-reverse">
                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                    </svg>
                    <span>Now Click on Blue Tab</span>
                </li>
                <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/img/blue-tab.png'; ?>" class="h-32 border-solid border-2 border-gray-100 rounded-lg p-2"/>
                <li class="flex items-center space-x-3 rtl:space-x-reverse">
                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                    </svg>
                    <span>Now Click Connect</span>
                </li>
                <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/img/connect.png'; ?>" class="w-32 border-solid border-2 border-gray-100 rounded-lg p-2"/>
                <li class="flex items-center space-x-3 rtl:space-x-reverse">
                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                    </svg>
                    <span>Post Tweet Image - Add new account</span>
                </li>
                <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/img/post-tweet-image.png'; ?>" class="h-36 border-solid border-2 border-gray-100 rounded-lg p-2"/>
                <li class="flex items-center space-x-3 rtl:space-x-reverse">
                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                    </svg>
                    <span>Facebook Page Account - Add new account</span>
                </li>
                <img src="<?php echo plugin_dir_url( dirname(dirname( __FILE__ )) ) . 'assets/img/post-fb-image.png'; ?>"  class="h-36 border-solid border-2 border-gray-100 rounded-lg p-2"/>
                <li class="flex items-center space-x-3 rtl:space-x-reverse">
                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                    </svg>
                    <span>Save</span>
                </li>
            </ul>
        </div>
        <div class="mb-5">
            <label for="ifttt_url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ifttt URL</label>
            <input type="text" class="bg-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border border-2 border-slate-200 shadow-none" id="ifttt_url" name="ifttt_url" placeholder="#" value="https://maker.ifttt.com/trigger/<?=str_replace(":","_",str_replace(".","_",$_SERVER['HTTP_HOST'] ?? '') ?? '')?>/json/with/key/jy5W2pNU5B7rhWs5z7-fEEbhysVeuMGdVITm2obGJCx" readonly>
        </div>
</div>
<?php endif; ?>
<?php if($flag) : ?>
    <div class="flex max-w-lg">
        <button onclick="test_social_media('working')" class="text-white bg-indigo-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 flex font-semibold ">
            <span class="text-sm" >Test It !</span>
        </button>
        <button onclick="save_social_media('working')" class="ml-5 text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 flex font-semibold ">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" strokeWidth="2" class="w-4 mr-2">
                <path d="M5 12l5 5l10 -10"></path>
            </svg>
            <span class="text-sm" >Yes ! It's Working.</span>
        </button>
        <button onclick="save_social_media('not working')" class="ml-5 text-white bg-red-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 flex font-semibold ">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" strokeWidth="2" class="w-4 mr-2">
                <path d="M5 12l5 5l10 -10"></path>
            </svg>
            <span class="text-sm" >Not Working.</span>
        </button>
    </div>
<?php endif; ?>

