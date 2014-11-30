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

if (!defined('DC_CONTEXT_ADMIN')) { exit; }

if (!empty($_SESSION['dcslider_message'])) {
    $message = $_SESSION['dcslider_message'];
    unset($_SESSION['dcslider_message']);
}

$is_super_admin = $core->auth->isSuperAdmin();
$core->blog->settings->addNameSpace('dcslider');
$dcslider_active = $core->blog->settings->dcslider->active;
$dcslider_images = implode("\n", json_decode($core->blog->settings->dcslider->images, true));
$dcslider_was_actived = $dcslider_active;

$default_tab = 'settings';

if (!empty($_POST['saveconfig'])) {
    try {
        $dcslider_active = (empty($_POST['dcslider_active']))?false:true;
        $core->blog->settings->dcslider->put('active', $dcslider_active, 'boolean');

        // change other settings only if they were in html page
        if ($dcslider_was_actived) {
            if (isset($_POST['dcslider_images'])) {
                $dcslider_images = explode("\n", trim($_POST['dcslider_images']));
                $core->blog->settings->dcslider->put('images', json_encode($dcslider_images), 'string');
            }
        }

        $_SESSION['dcslider_message'] = __('The configuration has been updated.');
        http::redirect($p_url);
    } catch(Exception $e) {
        http::redirect($p_url);
    }
}

include(dirname(__FILE__).'/tpl/index.tpl');
