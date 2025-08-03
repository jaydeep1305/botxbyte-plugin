<?php if($page_variable['module'] != 'true') :?>
    <div class="max-w-lg mx-left mt-5 ml-5 mb-5">
        <div class="p-4 mt-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <span class="font-medium">Alert ! </span>The module is currently disabled. Please go to the dashboard to enable it.
        </div>
    </div>
    <?php exit();?>
<?php endif; ?>

<div class="max-w-lg mx-left mt-5 ml-5 mb-5">
    <div class="flex items-center mb-4">        
        <input id="default-checkbox" type="checkbox" name="image_converter_enabled" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"  <?php echo !$is_imagick_enabled ? 'disabled' : ''; ?> <?= isset($is_image_converter_enabled)?$is_image_converter_enabled: ''?>>
        <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900">Enable Image Converter (convert jpg to webp)</label>
    </div>

    <?php if (!$is_imagick_enabled): ?>
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <span class="font-medium">Alert ! </span>Imagick is not enabled.
        </div>
    <?php endif; ?>

<div class="relative overflow-x-auto border border-slate-200 sm:rounded-lg max-w-lg">
    <table class="text-sm w-full text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Check
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white hover:bg-gray-50">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    Imagick Extension
                </td>
                <td class="px-6 py-4">
                    <?php echo $is_imagick_enabled ? 'Enabled' : 'Disabled'; ?>
                </td>
            </tr>
            <tr class="bg-white hover:bg-gray-50">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    PHP Version
                </th>
                <td class="px-6 py-4">
                    <?php echo $current_php_version; ?>
                </td>
            </tr>
            <tr class="bg-white hover:bg-gray-50">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    Rename Function
                </th>
                <td class="px-6 py-4">
                    <?php echo $is_rename_function_available ? 'Available' : 'Not Available'; ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<br/>
<?php if (!$is_imagick_enabled): ?>
<div class="relative max-w-lg mb-5">
    <div class="bg-gray-900 text-white p-4 rounded-md">
        <div class="flex justify-between items-center mb-2">
            <span class="text-gray-400">ImageMagick Installation Instructions:</span>
        </div>
        <div class="overflow-x-auto">
            <pre id="code" class="text-gray-300"><code>
# login to your server using root
ssh root@&lt;youripaddress&gt;
# install imagick module
apt-get install php<?php echo $php_major_version; ?>rc-pecl-imagick
# reload PHP-FPM
systemctl reload php<?php echo $php_major_version; ?>rc-fpm

# check / verify if imagick is installed
php -i | grep imagemagick
            </code></pre>
        </div>
    </div>
</div>
<?php endif; ?>

    <button onclick="image_converter_admin()" class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2 text-center flex font-semibold mb-5">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" strokeWidth="2" class="w-4 mr-2">
            <path d="M5 12l5 5l10 -10"></path>
        </svg>
        <span class="text-sm" >Save changes</span>
    </button>
</div>
