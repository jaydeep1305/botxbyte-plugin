<?php if($page_variable['module'] != 'true') :?>
    <div class="max-w-lg mx-left mt-5 ml-5 mb-5">
        <div class="p-4 mt-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <span class="font-medium">Alert ! </span>The module is currently disabled. Please go to the dashboard to enable it.
        </div>
    </div>
    <?php exit();?>
<?php endif; ?>

<div class="max-w-sm mx-left mt-5 ml-5 mb-5">
    <div class="mb-5">
        <label for="inline_related_posts" class="block mb-2 text-sm font-medium text-gray-900">Categories</label>
        <select class="bxb-inline-related-posts-input" name="inline_related_posts" id="inline_related_posts" multiple="multiple" >
        <?php foreach($all_categories as $category):
                $selected = "";
                if(is_array($inline_related_posts)){
                    if(in_array($category->term_id, $inline_related_posts))
                    {
                        $selected = 'selected';
                    }    
                }
            ?>
                <option value="<?php echo $category->term_id; ?>" <?php echo $selected; ?>><?php echo $category->name; ?></option>
        <?php endforeach; ?>
        </select>
        
        <button onclick="inline_related_posts_admin()" class="mt-5 text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2 text-center flex font-semibold ">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" strokeWidth="2" class="w-4 mr-2">
                <path d="M5 12l5 5l10 -10"></path>
            </svg>
            <span class="text-sm" >Save changes</span>
        </button>
        
    </div>
</div>

<div class="max-w-lg ml-5 mt-12 mb-10">
    <h4 class="mb-4 text-2xl font-extrabold text-gray-900 dark:text-white">How to install <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Jnews Child Theme</span>.</h4>
    <div class="ml-4">
        <h4 id="widget" class="text-xl font-semibold mb-4">1. Import and Export Theme Settings</h4>
        <hr class="border-gray-300 mb-4">
        <p class="mb-6">
        You need to move your theme settings. You can use the Customizer Export/Import
        <a href="https://wordpress.org/plugins/customizer-export-import/" class="text-blue-600 underline hover:text-blue-800">plugin</a>.
        </p>
        <a href="https://support.jegtheme.com/wp-content/uploads/2023/07/wordpress.org_plugins_customizer-export-import_.png"
        data-rel="lightbox-gallery-qeseE4x1" data-rl_title="" data-rl_caption="" title=""
        class="block mx-auto mb-6">
        <img fetchpriority="high" decoding="async" class="mx-auto rounded shadow-lg"
            src="https://support.jegtheme.com/wp-content/uploads/2023/07/wordpress.org_plugins_customizer-export-import_-1024x481.png"
            alt="Customizer Export/Import Plugin"
            srcset="https://support.jegtheme.com/wp-content/uploads/2023/07/wordpress.org_plugins_customizer-export-import_-1024x481.png 1024w, https://support.jegtheme.com/wp-content/uploads/2023/07/wordpress.org_plugins_customizer-export-import_-300x141.png 300w, https://support.jegtheme.com/wp-content/uploads/2023/07/wordpress.org_plugins_customizer-export-import_-768x361.png 768w, https://support.jegtheme.com/wp-content/uploads/2023/07/wordpress.org_plugins_customizer-export-import_-1536x721.png 1536w, https://support.jegtheme.com/wp-content/uploads/2023/07/wordpress.org_plugins_customizer-export-import_-600x282.png 600w, https://support.jegtheme.com/wp-content/uploads/2023/07/wordpress.org_plugins_customizer-export-import_.png 1953w"
            sizes="(max-width: 1024px) 100vw, 1024px"
            width="1024" height="481">
        </a>
        <p class="mb-8">
        After the plugin is installed, please go to <span class="bg-black text-white px-2 py-1 rounded">Customizer</span> →
        <span class="bg-black text-white px-2 py-1 rounded">Export/Import</span>. In the parent theme, you can export the settings.
        The file will be downloaded, and you can import it later after switching to the child theme.
        </p>

        <h4 id="widget" class="text-xl font-semibold mb-4">2. Import and Export Widget</h4>
        <hr class="border-gray-300 mb-4">
        <p class="mb-6">
        To move your widgets, you can use the Widget Importer &amp; Exporter
        <a href="https://wordpress.org/plugins/widget-importer-exporter/" class="text-blue-600 underline hover:text-blue-800">plugin</a>.
        </p>
        <a href="https://support.jegtheme.com/wp-content/uploads/2023/07/wordpress.org_plugins_widget-importer-exporter_.png"
            data-rel="lightbox-gallery-qeseE4x1" data-rl_title="" data-rl_caption="" title=""
            class="block mx-auto mb-6">
        <img decoding="async" class="mx-auto rounded shadow-lg"
                src="https://support.jegtheme.com/wp-content/uploads/2023/07/wordpress.org_plugins_widget-importer-exporter_-1024x481.png"
                alt="Widget Importer & Exporter Plugin"
                srcset="https://support.jegtheme.com/wp-content/uploads/2023/07/wordpress.org_plugins_widget-importer-exporter_-1024x481.png 1024w, https://support.jegtheme.com/wp-content/uploads/2023/07/wordpress.org_plugins_widget-importer-exporter_-300x141.png 300w, https://support.jegtheme.com/wp-content/uploads/2023/07/wordpress.org_plugins_widget-importer-exporter_-768x361.png 768w, https://support.jegtheme.com/wp-content/uploads/2023/07/wordpress.org_plugins_widget-importer-exporter_-1536x722.png 1536w, https://support.jegtheme.com/wp-content/uploads/2023/07/wordpress.org_plugins_widget-importer-exporter_-600x282.png 600w, https://support.jegtheme.com/wp-content/uploads/2023/07/wordpress.org_plugins_widget-importer-exporter_.png 1941w"
                sizes="(max-width: 1024px) 100vw, 1024px"
                width="1024" height="481">
        </a>

        <p class="mb-8">
        After the plugin is installed, go to <span class="bg-black text-white px-2 py-1 rounded">WP Admin Dashboard</span> →
        <span class="bg-black text-white px-2 py-1 rounded">Tools</span> →
        <span class="bg-black text-white px-2 py-1 rounded">Widget Importer & Exporter</span>. In the parent theme, export all widgets.
        The widget data file will be downloaded. You can import it later after switching to the child theme.
        </p>

        <h4 id="theme" class="text-xl font-semibold mb-4">3. Installing Child Theme</h4>
        <hr class="border-gray-300 mb-4">
        <p class="mb-6">
        After downloading the <strong>JNews</strong> child theme from
        <a href="https://drive.google.com/file/d/1uEdLwctf2GbjPOiTMqs1-TYHfho59Yyk/view?usp=sharing" target="_blank" rel="noopener noreferrer" class="text-blue-600 underline hover:text-blue-800">Here</a>, Upload and Install It.
        </p>

        <img decoding="async" class="mx-auto rounded shadow-lg"
            src="https://support.jegtheme.com/wp-content/uploads/2020/10/Screenshot-2020-10-28-152904.jpg"
            alt="Child Theme Installation"
            width="617" height="152">
    </div>
</div>