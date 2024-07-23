<?php
    if(isset($_POST['old_string'])) {
        // Get the values from the form
        $old_string = $_POST['old_string'];
        $old_string = explode("\n", $old_string);
        $new_string = sanitize_text_field($_POST['new_string']);

        $flag = false;
        global $wpdb;
        foreach($old_string as $os){
            $os = trim($os);
            if(empty($os)) continue;
            if(mb_strlen($os) <= 2) continue;
            $flag = true;
            $wpdb->query("UPDATE $wpdb->posts SET post_content = replace(post_content, '$os', '$new_string')");
        }

        // Replace the string in the database
        if($flag){
            echo '<div class="p-4 mt-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    <span class="font-medium">Success!</span> The string has been replaced in the database.
                </div>';
        }else{
            echo '<div class="p-4 mt-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <span class="font-medium">Alert!</span> The string has not been replaced in the database.
                </div>';
        }
    }
?>
<form action="<?=$form_action?>" method="post" class="max-w-sm mx-left mt-5 ml-5 mb-5">
    <input type="hidden" name="page" value="botxbyte-replace-string-db-settings">
    <div class="mb-5">
        <label for="old_string" class="block mb-2 text-sm font-medium text-gray-900">Old String (Internal Links)</label>
        <textarea id="old_string" name="old_string" rows="3" cols="40" placeholder="url1&#10;url2" class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border border-slate-200"></textarea>
    </div>
    <div class="mb-5">
        <label for="new_string" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New String (#)</label>
        <input type="text" class="bg-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border border-2 border-slate-200 shadow-none" id="new_string" name="new_string" placeholder="#">
    </div>
    <button type="submit" class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 flex font-semibold ">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" strokeWidth="2" class="w-4 mr-2">
            <path d="M5 12l5 5l10 -10"></path>
        </svg>
        <span class="text-sm">Save changes</span>
    </button>
</form>
