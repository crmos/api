<?php
/**
 * Created by PhpStorm.
 * User: Saurav KC
 */


if (!function_exists('pagination_links')) {

    /**
     * @param $data
     * @param null $view
     *
     * @return mixed
     */
    function pagination_links($data, $view = null)
    {
        if ($query = Request::query()) {
            $request = array_except($query, 'page');

            return $data->appends($request)->render($view);
        }

        return $data->render($view);
    }

}

if (!function_exists('getPermissionList')) {
    function getPermissionList()
    {
        $permission_lists = [];
        $permissions = \App\Models\Auth\Permission::latest()->pluck('name', 'id');
        foreach ($permissions as $key => $value) {
            if ($pos = strpos($value, '-')) {
                $key_one = substr($value, 0, $pos);
                $permission_lists[$key_one][$key] = $value;
            } else {
                $permission_lists[$key] = $value.'1';
            }
        }
        return $permission_lists;
    }
}

if(!function_exists('pluckRoleList'))
{
    /**
     * Pluck role ID and Name in Array
     * @return mixed
     */
    function pluckRoleList()
    {
        return \App\Models\Auth\Role::pluck('name','id');
    }
}


if(!function_exists('optionsToArray')) {
    function optionsToArray($options, $id = 'id')
    {
        $array = [];
        foreach($options as $option)
        {
            $array[] = $option->$id;
        }
        return $array;
    }
}

if(! function_exists('getStatusList')){
    function getStatusList()
    {
        $status = [
            'draft' => 'Draft',
            'hidden' => 'Hidden',
            'published' => 'Published',
            'spam' => 'Spam',
            'suspended' => 'Suspended'
        ];
        return $status;
    }
}


if(!function_exists('checkForPermission')) {
    /**
     * @param $permission_name
     * @return bool
     */
    function checkForPermission($permission_name)
    {
        $user = Auth::User();
        if(Auth::check() && ($user->isSuperAdmin() || $user->can($permission_name))) {
            return true;
        }
        else {
            return false;
        }
    }
}

if (! function_exists('uploadedAsset')) {
    /**
     * Generates an asset path for the uploads.
     * @param null $path
     * @param null $file_name
     * @return string
     */
    function uploadedAsset($path = null, $file_name = null)
    {
        //$path  = Storage::url($path.'/'.$file_name);
        $path = asset('uploads/'.$path.$file_name);
        return $path;
    }
}

if(!function_exists('imageNotFound')) {
    /**
     * @param null $type
     * @return string
     */
    function imageNotFound($type = null)
    {
        switch ($type){
            case 'user':
                return asset('images/face.png');
                break;
            case 'small':
                return asset('images/default.png');
                break;
            default:
                return asset('images/default.png');

        }
    }
}

if(!function_exists('getDateFormat'))
{
    function getDateFormat($date = null)
    {
        if(is_null($date)) {
            $date = now();
        }
        return date('jS M, Y', strtotime($date));
    }

}

if(!function_exists('getActiveInactiveStatus'))
{
    function getActiveInactiveStatus()
    {
        return ['active' => 'Active', 'in-active' => 'In Active'];
    }

}


if(!function_exists('getCountryList'))
{
    function getCountryList()
    {
        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        foreach ($countries as $country)
        {
            $new_array[$country] = $country;
        }
        return $new_array;
    }

}

if(!function_exists('generateSlug'))
{
    /**
     * Generates the alias equivalent for the provided string
     *
     * @param $string
     * @return mixed|string
     */
    function generateSlug($string)
    {
        $string = strtolower($string);
        $string = str_replace(" ", "-", $string);
        $string = str_replace(".", "-", $string);
        $string = str_replace("--", "-", $string);
        $string = str_replace("--", "-", $string);
        $string = str_replace("--", "-", $string);
        $string = str_replace("&", "and", $string);
        $string = str_replace("@", "", $string);
        $string = str_replace("(", "", $string);
        $string = str_replace(")", "", $string);
        $string = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $string);
        return $string;
    }

}


if(!function_exists('getYesNo')) {
    function getYesNo()
    {
        $array = [
            'yes' => 'Yes', 'no' => 'No'
        ];
        return $array;
    }
}

if(!function_exists('getSalutation')) {
    function getSalutation()
    {
        return ['Mr.' => 'Mr.','Ms.' => 'Ms.','Mrs.' => 'Mrs.','Mx.' => 'Mx.', 'Sir' => 'Sir', 'Madam' => 'Madam'];
    }
}