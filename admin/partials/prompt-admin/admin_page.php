<div class="max-w-2xl mx-left mt-5 ml-5 mb-5 grid grid-cols-2 gap-12">
    <div class="mb-5">
        <div class="flex items-center gap-3 md:pb-5 md:border-b border-slate-200 mb-5">
            <div class="text-blue-500"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" strokeWidth="2" class="tabler-icon tabler-icon-photo"><path d="M15 8h.01"></path><path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z"></path><path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5"></path><path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3"></path></svg></div>
            <h2 class="text-sm font-semibold text-slate-900"> Social Media Prompt Settings </h2>
        </div>
        <div class="mb-5">
            <label for="social_fb_caption_prompt" class="block mb-2 text-sm font-medium text-gray-900">Facebook Caption Prompt</label>
            <textarea id="social_fb_caption_prompt" name="social_fb_caption_prompt" rows="3" cols="40" placeholder="Write a caption for facebook on given title" class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border border-slate-200"><?=$social_fb_caption_prompt?></textarea>
        </div>
        <div class="mb-5">
            <label for="social_tw_caption_prompt" class="block mb-2 text-sm font-medium text-gray-900">Twitter Caption Prompt</label>
            <textarea id="social_tw_caption_prompt" name="social_tw_caption_prompt" rows="3" cols="40" placeholder="Write a caption for twitter on given title" class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border border-slate-200"><?=$social_tw_caption_prompt?></textarea>
        </div>
        <div class="mb-5">
            <label for="social_pt_caption_prompt" class="block mb-2 text-sm font-medium text-gray-900">Pinterest Caption Prompt</label>
            <textarea id="social_pt_caption_prompt" name="social_pt_caption_prompt" rows="3" cols="40" placeholder="Write a caption for pinterest on given title" class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border border-slate-200"><?=$social_pt_caption_prompt?></textarea>
        </div>
        <div class="mb-5">
            <label for="social_system_prompt" class="block mb-2 text-sm font-medium text-gray-900">System Prompt (Social Media)</label>
            <textarea id="social_system_prompt" name="social_system_prompt" rows="3" cols="40" placeholder="Write a system prompt for social media" class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border border-slate-200"><?=$social_system_prompt?></textarea>
        </div>
        <button onclick="prompt_admin()" class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2 text-center flex font-semibold ">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" strokeWidth="2" class="w-4 mr-2">
                <path d="M5 12l5 5l10 -10"></path>
            </svg>
            <span class="text-sm" >Save changes</span>
        </button>
    </div>
    <div class="mb-5">
        <div class="flex items-center gap-3 md:pb-5 md:border-b border-slate-200 mb-5">
            <div class="text-blue-500"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" strokeWidth="2" class="tabler-icon tabler-icon-photo"><path d="M15 8h.01"></path><path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z"></path><path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5"></path><path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3"></path></svg></div>
            <h2 class="text-sm font-semibold text-slate-900"> Rewrite Prompt Settings </h2>
        </div>
        <div class="mb-5">
            <label for="rp_title_prompt" class="block mb-2 text-sm font-medium text-gray-900">Title Prompt</label>
            <textarea id="rp_title_prompt" name="rp_title_prompt" rows="3" cols="40" placeholder="Write a rewritten version of the title" class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border border-slate-200"><?=$rp_title_prompt?></textarea>
        </div>
        <div class="mb-5">
            <label for="rp_meta_description_prompt" class="block mb-2 text-sm font-medium text-gray-900">Meta Description Prompt</label>
            <textarea id="rp_meta_description_prompt" name="rp_meta_description_prompt" rows="3" cols="40" placeholder="Write a rewritten version of the meta description " class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border border-slate-200"><?=$rp_meta_description_prompt?></textarea>
        </div>
        <div class="mb-5">
            <label for="rp_content_prompt" class="block mb-2 text-sm font-medium text-gray-900">Content Prompt</label>
            <textarea id="rp_content_prompt" name="rp_content_prompt" rows="3" cols="40" placeholder="Write a rewritten version of the content" class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border border-slate-200"><?=$rp_content_prompt?></textarea>
        </div>
        <div class="mb-5">
            <label for="" class="block mb-2 text-sm font-medium text-gray-900">System Prompt (Rewrite)</label>
            <textarea id="rp_system_prompt" name="rp_system_prompt" rows="3" cols="40" placeholder="You are writing content for blog posts. Write concise and precise data without giving advice." class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border border-slate-200"><?=$rp_system_prompt?></textarea>
        </div>
    </div>
</div>
