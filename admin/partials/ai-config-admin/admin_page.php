<?php if($page_variable['module'] != 'true') :?>
    <div class="max-w-lg mx-left mt-5 ml-5 mb-5">
        <div class="p-4 mt-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <span class="font-medium">Alert ! </span>The module is currently disabled. Please go to the dashboard to enable it.
        </div>
    </div>
    <?php exit();?>
<?php endif; ?>
    
<div class="max-w-sm mx-left mt-5 ml-5 mb-5">
    <div class="flex">
        <div class="flex items-center mb-5">
            <input id="rp-Openai" type="radio" value="Openai" name="rp_type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2"  <?php if($rp_type == 'Openai') echo 'checked'; ?> onchange="rp_handle_type_change(this);">
            <label for="rp-Openai" class="ms-2 text-sm font-medium text-gray-900">Open AI</label>
        </div>
        <div class="flex items-center mb-5 ml-5">
            <input id="rp-Azure" type="radio" value="Azure" name="rp_type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2"  <?php if($rp_type == 'Azure') echo 'checked'; ?> onchange="rp_handle_type_change(this);">
            <label for="rp-Azure" class="ms-2 text-sm font-medium text-gray-900">Azure AI</label>
        </div>
    </div>
</div>
        <!-- Openai -->  
        <?php
            if($rp_type == 'Openai'){
                echo '<div id="bxb-rp-openai-settings" class="max-w-sm mx-left mt-5 ml-5 mb-5">';
            } else {
                echo '<div id="bxb-rp-openai-settings" style="display:none;" class="max-w-sm mx-left mt-5 ml-5 mb-5">';
            }
        ?>
            <div class="mb-5">
                <label for="rp_openai_key" class="block mb-2 text-sm font-medium text-gray-900">Openai Key</label>
                <input type="text" id="rp_openai_key" name="rp_openai_key" rows="3" cols="40" placeholder="xxxx-xxx-xxxx" class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border border-slate-200" value="<?php echo $rp_openai_key ;?>"/>
            </div>

            <div class="mb-5">
                <label for="rp_openai_model" class="block mb-2 text-sm font-medium text-gray-900">Model</label>
                <input type="text" id="rp_openai_model" name="rp_openai_model" rows="3" cols="40" placeholder="gpt-4" class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border border-slate-200" value="<?php echo $rp_openai_model ;?>"/>
            </div>
        </div>

        <!-- Azure -->
        <?php
            if($rp_type == 'Azure'){
                echo '<div id="bxb-rp-azure-settings" class="max-w-sm mx-left mt-5 ml-5 mb-5">';
            } else {
                echo '<div id="bxb-rp-azure-settings" style="display:none;" class="max-w-sm mx-left mt-5 ml-5 mb-5">';
            }
        ?>
            <div class="mb-5">
                <label for="rp_azure_api_version" class="block mb-2 text-sm font-medium text-gray-900">API Version</label>
                <input type="text" id="rp_azure_api_version" name="rp_azure_api_version" rows="3" cols="40" placeholder="xxxx-xxx-xxxx" class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border border-slate-200" value="<?php echo $rp_azure_api_version ;?>"/>
            </div>
            <div class="mb-5">
                <label for="rp_azure_api_base" class="block mb-2 text-sm font-medium text-gray-900">API Base</label>
                <input type="text" id="rp_azure_api_base" name="rp_azure_api_base" rows="3" cols="40" placeholder="https://gajiya.openai.azure.com" class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border border-slate-200" value="<?php echo $rp_azure_api_base ;?>"/>
            </div>
            <div class="mb-5">
                <label for="rp_azure_api_key" class="block mb-2 text-sm font-medium text-gray-900">API Key</label>
                <input type="text" id="rp_azure_api_key" name="rp_azure_api_key" rows="3" cols="40" placeholder="xxxx-xxx-xxx" class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border border-slate-200" value="<?php echo $rp_azure_api_key ;?>"/>
            </div>
            <div class="mb-5">
                <label for="rp_azure_api_engine" class="block mb-2 text-sm font-medium text-gray-900">Engine</label>
                <input type="text" id="rp_azure_api_engine" name="rp_azure_api_engine" rows="3" cols="40" placeholder="gpt35turbo" class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border border-slate-200" value="<?php echo $rp_azure_api_engine ;?>"/>
            </div>
        </div>

        <button onclick="ai_config_admin()" class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2 text-center flex font-semibold ml-5 mb-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" strokeWidth="2" class="w-4 mr-2">
                <path d="M5 12l5 5l10 -10"></path>
            </svg>
            <span class="text-sm" >Save changes</span>
        </button>
