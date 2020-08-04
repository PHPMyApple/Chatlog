<?php
    function fillTemplateHeader($data, $tran) {
        echo   '<img src="https://minotar.net/helm/'.$data['players'][$data['targetUUID']].'/60.png" alt="Loading error" class="img">
                </div>
                <div class="wrapper-right">
                <p class="reported-player">'.$tran['chat']['chatreportFrom'].'</p>
                <p class="reported-player__name">'.$data['players'][$data['targetUUID']].'</p>
                </div>
                </div>
                <div class="card--mid">
                <div class="icon-container">
                <svg class="icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="terminal" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M257.981 272.971L63.638 467.314c-9.373 9.373-24.569 9.373-33.941 0L7.029 444.647c-9.357-9.357-9.375-24.522-.04-33.901L161.011 256 6.99 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L257.981 239.03c9.373 9.372 9.373 24.568 0 33.941zM640 456v-32c0-13.255-10.745-24-24-24H312c-13.255 0-24 10.745-24 24v32c0 13.255 10.745 24 24 24h304c13.255 0 24-10.745 24-24z"></path></svg>
                </div>
                </div>
                <div class="card--right">
                <div class="wrapper-left">
                <p class="creation-date">'.$tran['chat']['createdOn'].'</p>
                <p class="creation-server">'.$tran['chat']['server'].'</p>
                </div>
                <div class="wrapper-right">
                <p class="creation-date__value">'.$data['creationTime'].'</p>
                <p data-servers="'.$data['servers']['allServers'].'" class="creation-server__value">'.$data['servers']['displayServers'].'</p>';
    }
    
    function fillTemplateBody($data, $tran) {
        if ($data['valid'] == true) {
            $counter = 0;
            for ($i = 0; $i < count($data['chats']); $i++) {
                $chat = $data['chats'][$i];
                $commandHighlight = '';
                $display = '';
                if ($chat['message'][0] == '/' && strpos($chat['message'], '/a ') === false && strpos($chat['message'], '/all ') === false) {
                    $chat['message'] = '<span class="chat-tooltip">████████████████████████</span>';
                    $commandHighlight = 'command-highlight';
                    $display = 'none';
                } else {
                    $chat['message'] = htmlspecialchars($chat['message']);
                    $display = 'unset';
                }
                if ($chat['playerUUID'] == $data['targetUUID']) {
                    $highlight = 'highlight';
                } else {
                    $highlight = '';
                }
                echo   '<div style="display:'.$display.';" class="card '.$chat['playerUUID'].' player-chatlog-card '.$highlight.' '.$commandHighlight.'">
                        <div class="card--top">
                        <div class="card--top-left">
                        <div class="wrapper-left">
                        <img class="card__img" src="https://minotar.net/helm/'.$data['players'][$chat['playerUUID']].'/60.png" alt="Loading error">
                        </div>
                        <div class="wrapper-right">
                        <p class="card__username">'.$data['players'][$chat['playerUUID']].'</p>
                        </div>
                        </div>
                        <div class="card--top-right">
                        <p class="geo-information"><span class="server">'.$chat['server'].'</span> - <span class="timestamp">'. local_getTimeFromTimestamp($chat['timestamp']).'</span></p>
                        </div>
                        </div>
                        <div class="card--middle"></div>
                        <div class="card--bottom">
                        <div class="card--bottom-left">
                        <p class="card__chat">'.$chat['message'].'</p>
                        </div>
                        <div class="card--bottom-right">
                        <div class="card__icon-wrapper">
                        <!-- COPYRIGHT NOTICE: These Icons are published by Material.io and licensed under the Apache 2 license -->
                        <svg class="card__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 '.($highlight == '' ? $data['svgOutlined'] : $data['svgFilled']).'"/></svg>
                        </div>
                        </div>
                        </div>
                    </div>';
            }
        } else {
            echo    '<div class="card"><h3 style="text-align: center;" class="error">'.$tran['error']['invalidID'].'</h3>'.
                    '<p style="text-align: center;" class="description">'.$tran['error']['noEntriesAvailable'].'</p></div>';
        }
    }
    

    function local_getTimeFromTimestamp($timestamp) {
        $time = explode('T', $timestamp);
        $time = $time[1];
        return $time;
    }
    

    function local_encodingISOToUTF($text) {
        return iconv("ISO-8859-1", "UTF-8", $text);
    }
?>
