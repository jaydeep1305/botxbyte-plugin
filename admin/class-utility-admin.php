<?php
namespace Botxbyte;
class UtilityAdmin {
    
    public static function update_option($key, $value=''){
        update_option( PREFIX . $key, isset($_POST[$key]) ? $_POST[$key] : $value);
    }
    
    public static function get_option($key){
        return get_option( PREFIX . $key, isset($_POST[$key]) ? $_POST[$key] : '');
    }

    public static function textarea($id, $label, $sublabel, $placeholder, $value) {
        echo '<label class="block mt-4 ml-8"><div><p class="font-semibold text-slate-700 text-base">'.$label.'</p><span class="text-sm text-slate-600">'.$sublabel.'</span></div><textarea id="'.$id.'" name="'.$id.'" rows="3" cols="40" placeholder="'.$placeholder.'" class="block w-full p-3 mt-3 shadow-sm border-slate-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500 mt-5">'.$value.'</textarea></label>';
    }

    public static function textbox($id, $label, $sublabel, $placeholder, $value) {
        echo '<label class="block mt-4 ml-8"><div><p class="font-semibold text-slate-700 text-base">'.$label.'</p><span class="text-sm text-slate-600">'.$sublabel.'</span></div><input type="text" id="'.$id.'" name="'.$id.'" rows="3" cols="40" placeholder="'.$placeholder.'"  value="'.$value.'"></label>';
    }
}
