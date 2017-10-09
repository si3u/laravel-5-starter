<?php

if (!function_exists('format_date')) {
    /**
     * Format Date
     *
     * @param        $date
     * @param string $format
     * @return bool|string
     */
    function format_date($date, $format = "d F Y")
    {
        return date($format, strtotime($date));
    }
}

if (!function_exists('format_date_short')) {
    /**
     * Format Date Short
     *
     * @param        $date
     * @param string $format
     * @return bool|string
     */
    function format_date_short($date, $format = "d/m/Y")
    {
        return date($format, strtotime($date));
    }
}

if (!function_exists('profile_image')) {

    /**
     * Return the path of the logged in user's profile image
     * @return string
     */
    function profile_image()
    {
        $image = user()->image;
        $gender = user()->gender;
        if ($image && strlen($image) > 5) {
            return '/uploads/images/' . $image;
        }
        else {
            return "/images/admin/$gender.png";
        }
    }
}

if (!function_exists('activity_after')) {
    /**
     * Get the After Title of model
     * @param $activity
     * @return string
     */
    function activity_after($activity, $limit = 180)
    {
        if (strlen($activity->after) > $limit) {
            if ( !empty(json_decode($activity->after)->content)) {
			   return str_limit(strip_tags(json_decode($activity->after)->content), $limit);
			}
        }
        else if (isset($activity->subject->title)) {
            return $activity->subject->title;
        }

        return '';
    }
}


if (!function_exists('activity_before')) {
    /**
     * Get the Before Title of model
     * @param $activity
     * @return string
     */
    function activity_before($activity, $limit = 180)
    {
        if (strlen($activity->before) > $limit) {
            if ( !empty(json_decode($activity->before)->content)) {
				return str_limit(strip_tags(json_decode($activity->before)->content), $limit);
			}
        }
        else if (isset($activity->subject->title)) {
            return $activity->subject->title;
        }

        return '';
    }
}


function image_row_link($thumb, $image = null)
{
    return "<a target='_blank' href='" . uploaded_images_url(($image ? $image : $thumb)) . "'><img src='" . uploaded_images_url($thumb) . "' style='height: 50px'/></a>";
}

/**
 * Ajoute ce qu'il faut aux images pour FancyBox.js
 * @param OBJECT $item (avec un content...)
 * @return type
 */
function fancyboxIntoContent($item)
{
	if(isset($item['content']) && $item['title'] && $item['_token'])
	{
		$pattern = "\<a (.*)\>(.*)?<img\ (.*)\>";
		$replace = '<a $1 class="fancybox" rel="gallery_'. str_limit($item['_token'], 5, '').'" title="'.$item['title'].'"><img $3>';
		$item['content'] = preg_replace( "/$pattern/", "$replace", $item['content']);
	}
	return $item;
}


