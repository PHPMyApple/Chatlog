<?php

    function getListOfServers($chats)
    {
        $servers = array();
        for ($i = 0; $i < count($chats); $i++) {
            array_push($servers, $chats[$i]['server']);
        }
        $servers = array_filter(array_unique($servers));
        if (count($servers) > 2) {
            $displayServers = $servers[0].', ...';
        } elseif (count($servers) > 1) {
            $displayServers = implode(', ', $servers);
        } else {
            $displayServers = $servers[0];
        }
        $servers = implode(', ', $servers);
        if ($servers == '') {
            $servers = $displayServers;
        }
        return array('allServers'=>$servers, 'displayServers'=>$displayServers);
    }

 
    function encodingISOToUTF($text)
    {
        return iconv("ISO-8859-1", "UTF-8", $text);
    }
    
    function getTimeFromTimestamp($timestamp)
    {
        $time = explode('T', $timestamp);
        $time = explode(':', $time[1]);
        $time = $time[1].':'.$time[2];
        return $time;
    }
    

    function uuidToMojangUsername($uuid)
    {
        $uuid = str_replace('-', '', $uuid);
        $json = file_get_contents('https://api.mojang.com/user/profiles/' . $uuid . '/names');
        if (!empty($json)) {
            $data = json_decode($json, true);
            if (!empty($data) and is_array($data)) {
                $last = array_pop($data);
                if (is_array($last) and isset($last['name'])) {
                    return $last['name'];
                }
            }
        }
    }
    
    function uuidToUsername($uuid)
    {
        $url = 'http://api.example.org:8080/nameutil/requestBase?value='.$uuid;
        $fields = [
        'empty' => 'Submit'
    ];
        $fields_string = http_build_query($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        $data = json_decode($result, true);
        return $data['name'];
    }
    
    function getChatlogFromID($id)
    {
        $url = 'http://example.org:8585/chatlog/'.$id;
        $result = file_get_contents($url);
        $data = json_decode($result, true);
        return $data;
    }
