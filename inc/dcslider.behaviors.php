<?php
// +-----------------------------------------------------------------------+
// | dcSlider - a plugin for dotclear                                      |
// +-----------------------------------------------------------------------+
// | Copyright(C) 2014 Nicolas Roudaire             http://www.nikrou.net  |
// +-----------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify  |
// | it under the terms of the GNU General Public License version 2 as     |
// | published by the Free Software Foundation                             |
// |                                                                       |
// | This program is distributed in the hope that it will be useful, but   |
// | WITHOUT ANY WARRANTY; without even the implied warranty of            |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU      |
// | General Public License for more details.                              |
// |                                                                       |
// | You should have received a copy of the GNU General Public License     |
// | along with this program; if not, write to the Free Software           |
// | Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,            |
// | MA 02110-1301 USA.                                                    |
// +-----------------------------------------------------------------------+

class dcSliderBehaviors
{
    public static function publicHeadContent($core) {
        $res = '';
        $plugin_root =

        $res .= sprintf(
            '<script type="text/javascript" src="%s/js/jquery.bxslider.js"></script>'."\n",
            html::stripHostURL($core->blog->getQmarkURL().'pf=dcSlider')
        );
        $res .= sprintf(
            '<link rel="stylesheet" type="text/css" href="%s/css/jquery.bxslider.css">'."\n",
            html::stripHostURL($core->blog->getQmarkURL().'pf=dcSlider')
        );

        echo $res;
    }

    public static function publicTopAfterContent($core) {
        if (!$core->blog->settings->dcslider->images) {
            return;
        }
        $images = json_decode($core->blog->settings->dcslider->images, true);
        $res = '';
        $res .= '<ul class="bxslider">';
        foreach ($images as $image) {
            $res .= sprintf('<li><img src="%s" alt=""></li>', $image);
        }
        $res .= '</ul>';

        $res .= '<script type="text/javascript">';
        $res .= '$(function() {'."\n";
        $res .= "\t".'$(\'.bxslider\').bxSlider({'."\n";
        $res .= "\t".'});';
        $res .= '});';
        $res .= '</script>';
        echo $res;
    }
}