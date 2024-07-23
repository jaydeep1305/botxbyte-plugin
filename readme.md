# Rest route for article creation : /wp-json/dynamic-article-publisher/v1/publish/
Data passing : {
  "post_title": "Your Article Title",
  "content": "Your article content here.",
  "networth": "$1 M",
  "category": "Finance",
  "price": "200"
}


<label class="block mt-4 ml-8">
    <div>
        <p class="font-semibold text-slate-700 text-base">MainLabel</p>
        <span class="text-sm text-slate-600">SubLabel</span>
    </div>
    <textarea id="name" name="name" rows="3" cols="40" placeholder="placeholder" class="block w-full p-3 mt-3 shadow-sm border-slate-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500 mt-5"><?php echo $value ;?></textarea>
</label>

<label class="block mt-4 ml-8">
    <div>
        <p class="font-semibold text-slate-700 text-base">MainLabel</p>
        <span class="text-sm text-slate-600">SubLabel</span>
    </div>
    <input type="text" class="form-control datetime-picker mt-5" id="name" name="name" placeholder="placeholder" value="<?php echo $value ;?>">
</label>

<button type="submit" class="transition flex rounded-md items-center bg-blue-500 text-white font-semibold px-4 py-2 mt-6 hover:bg-blue-600 ml-8">
    <span class="text-sm">Save changes</span>
</button>